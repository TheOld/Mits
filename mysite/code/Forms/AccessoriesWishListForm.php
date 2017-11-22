<?php

namespace MitsubishiMotors\Forms;

use Exception;
use GuzzleHttp\RequestOptions;
use MitsubishiMotors\DataObjects\AccessoriesWishListSubmission;
use MitsubishiMotors\Constants\VehicleHubURIs;
use MitsubishiMotors\Traits\VehicleHubCommunicationTrait;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\GroupedDropdownField;
use SilverStripe\Forms\FormAction;
use SilverStripe\Control\Email\Email;
use SilverStripe\Control\Controller;
use MitsubishiMotors\Traits\CustomValidationResponse;

/**
 * Class AccessoriesWishListForm
 * @package MitsubishiMotors\Forms
 */
class AccessoriesWishListForm extends Form
{
    use CustomValidationResponse, VehicleHubCommunicationTrait;

    const SESSION_IDENTIFYIER = 'wish';

    protected $controller;

    /**
     * @param Controller $controller
     * @param String $name
     */
    public function __construct($controller, $name)
    {
        $this->controller = $controller;

        $this->setAttribute('data-form', 'true');
        $this->setAttribute('novalidate', 'true');

        $fields = new FieldList(
            Injector::inst()->create(TextField::class, "FullName")->setTitle("Full Name"),
            Injector::inst()->create(EmailField::class, "Email"),
            Injector::inst()->create(NumericField::class, "Phone")->setAttribute('onkeypress', 'return (event.keyCode === 9 || event.keyCode === 16 || event.keyCode === 8 || event.keyCode === 46 || (event.keyCode >= 35 && event.keyCode <= 40)) || (event.charCode >= 48 && event.charCode <= 57)'),
            Injector::inst()->create(TextField::class, "Location"),
            Injector::inst()->create(HiddenField::class, 'Address1'),
            Injector::inst()->create(HiddenField::class, 'Address2'),
            Injector::inst()->create(HiddenField::class, 'Suburb'),
            Injector::inst()->create(HiddenField::class, 'City'),
            Injector::inst()->create(GroupedDropdownField::class, "ClosestDealer", "Closest dealer")
                ->setEmptyString('Pick a dealer')
                ->setSource($this->getDealerShips())
        );

        $actions = new FieldList(
            Injector::inst()->create(FormAction::class, "submit")->setTitle("submit")->addExtraClass('button')
        );

        $validator = RequiredFields::create(['FullName', 'Email']);

        $this->setValidationResponseCallback([$this, 'formatAsJson']);

        parent::__construct($controller, $name, $fields, $actions, $validator);
    }

    /**
     * @return array
     */
    private function getDealerShips()
    {
        try {
            $response = $this->getClient()->post(VehicleHubURIs::GET_DEALERS, [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $this->getAuthenticationToken(),
                    'Accept' => 'application/json'
                ],
                RequestOptions::JSON => [
                    'query' => '{dealers {name location}}'
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            if (isset($data['data']) && isset($data['data']['dealers'])) {

                $dealerList = [];

                foreach($data['data']['dealers'] as $dealer){
                    $dealerList[$dealer['location']][] = $dealer['name'];
                }

                return $dealerList;
            }

        } catch (Exception $e) {
            $this->handleVehicleHubCommunicationException($e);
        }
    }

    /**
     * @param $data
     * @param $form
     * @param $request
     * @return string
     */
    public function submit($data, $form, $request)
    {
        $submission = AccessoriesWishListSubmission::create();
        $submission->AccessoriesPageID = $this->controller->ID;
        $this->saveInto($submission);
        $submission->Address1 = $data['Location']; //todo: update this to saving out address fields

        if ($submission->write()) {

            $request->getSession()->set(self::SESSION_IDENTIFYIER . $this->controller->ID . 'submitted', true);

            // Send emails to Call Center and User
            $this->sendConfirmationEmail($submission);
            $this->sendCallCentreEmail($submission);

            $this->sessionMessage(
                "Thank you we will be in touch.",
                "good"
            );

            // this removes the success message as we will not see the success message, only if we return to form
            $this->clearMessage();

            if ($this->getRequest()->isAjax()) {

                return json_encode([
                    "success" => true,
                    "message" => "Thank you we will be in touch.",
                    "type" => "good"
                ]);

            } else {
                return $this->controller->redirect($this->controller->Link('success'));
            }

        } else {

            $this->sessionMessage(
                "Sorry there has been a problem, please try again.",
                "bad"
            );

            if ($this->getRequest()->isAjax()) {

                return json_encode([
                    "success" => false,
                    "message" => "Sorry there has been a problem, please try again.",
                    "type" => "bad"
                ]);

            } else {
                return $this->controller->redirect($this->controller->Link());
            }
        }
    }

    /**
     * @param $submission
     */
    public function sendConfirmationEmail($submission)
    {
        $from = 'no-reply@mmnz.co.nz';

        // To user
        $to = $submission->Email;
        $subject = "Thank you for your enquiry";
        $email = new Email($from, $to, $subject);
        $email->setHTMLTemplate('Emails/AccessoriesWishListEmail.ss');
        $email->setData($submission);
        $email->send();
    }

    /**
     * @param $submission
     */
    public function sendCallCentreEmail($submission)
    {
        $from = 'no-reply@mmnz.co.nz';

        // To Call Centre (from Enquiry Type)
        $to = !empty($this->controller->EmailSubmissionsTo) ? $this->controller->EmailSubmissionsTo : 'info@mmnz.co.nz';
        $subject = "Website book a service request received";
        $email = new Email($from, $to, $subject);
        $email->setHTMLTemplate('Emails/CallCentreBookAServiceEmail.ss');
        $email->setData($submission);
        $email->send();
    }
}
