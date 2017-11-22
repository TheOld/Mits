<?php

namespace MitsubishiMotors\Forms;

use Exception;
use GuzzleHttp\RequestOptions;
use MitsubishiMotors\Constants\VehicleHubURIs;
use MitsubishiMotors\Traits\VehicleHubCommunicationTrait;
use SilverStripe\Forms\GroupedDropdownField;
use MitsubishiMotors\Pages\BookAServicePageController;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Injector\Injector;
use MitsubishiMotors\DataObjects\BookAServiceSubmission;
use SilverStripe\Forms\DatetimeField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\FormAction;
use SilverStripe\Control\Email\Email;
use MitsubishiMotors\Traits\CustomValidationResponse;

/**
 * Class BookAServiceForm
 * @package MitsubishiMotors\Forms
 */
class BookAServiceForm extends Form
{
    use CustomValidationResponse, VehicleHubCommunicationTrait;

    const SESSION_IDENTIFYIER = 'book';

    const SERVICE_TYPES = [
        '<1000km',
        '15,000kms/12mths',
        '30,000kms/24mths',
        '45,000kms/36mths',
        '60,000kms/48mnths',
        '75,000kms/60mnths',
        '90,000kms/72mnths',
        '105,000kms/84mnths',
        '120,000kms/96mnths',
        '135,000kms/108mnths',
        '150,000/120mnths',
        'Other'
    ];

    /**
     * @var BookAServicePageController
     */
    protected $controller;

    /**
     * @param BookAServicePageController $controller
     * @param String $name
     */
    public function __construct($controller, $name)
    {
        $this->controller = $controller;
        $serviceTypes = array_combine(self::SERVICE_TYPES, self::SERVICE_TYPES);

        $this->setAttribute('data-form', 'true');
        $this->setAttribute('novalidate', 'true');

        $fields = new FieldList(
            Injector::inst()->create(TextField::class, "FirstName")->setTitle("First Name")->setAttribute('placeholder', 'Please type here'),
            Injector::inst()->create(TextField::class, "LastName")->setTitle("Last Name")->setAttribute('placeholder', 'Please type here'),
            Injector::inst()->create(EmailField::class, "Email")->setAttribute('placeholder', 'Enter email'),
            Injector::inst()->create(NumericField::class, "Phone")->setAttribute('placeholder', 'Enter phone number')->setAttribute('onkeypress', 'return (event.keyCode === 9 || event.keyCode === 16 || event.keyCode === 8 || event.keyCode === 46 || (event.keyCode >= 35 && event.keyCode <= 40)) || (event.charCode >= 48 && event.charCode <= 57)'),
            Injector::inst()->create(TextareaField::class, "Location")->setAttribute('placeholder', 'Enter address'),
            Injector::inst()->create(GroupedDropdownField::class, "PreferredDealer", "Preferred Dealer")
                ->setEmptyString('Please choose a dealer')
                ->setSource($this->getDealerShips()),
            Injector::inst()->create(HiddenField::class, 'Address1'),
            Injector::inst()->create(HiddenField::class, 'Address2'),
            Injector::inst()->create(HiddenField::class, 'Suburb'),
            Injector::inst()->create(HiddenField::class, 'City'),
            Injector::inst()->create(DatetimeField::class, 'PreferredDropOff'),
            Injector::inst()->create(DatetimeField::class, 'PreferredPickUp'),
            Injector::inst()->create(TextField::class, "RegistrationPlate")->setAttribute('placeholder', 'Rego'),
            Injector::inst()->create(DropdownField::class, 'ServiceType', 'Service Type')->setSource($serviceTypes),
            Injector::inst()->create(TextField::class, "OtherServiceType")->setAttribute('placeholder', 'Please type here')
        );

        $actions = new FieldList(
            Injector::inst()->create(FormAction::class, "submit")->setTitle("submit")->addExtraClass('button')
        );

        $validator = RequiredFields::create(['FirstName', 'LastName', 'Email', 'Location', 'RegistrationPlate', 'ServiceType']);

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
    public function submit($data, $form, HTTPRequest $request)
    {
        $submission = BookAServiceSubmission::create();
        $submission->BookAServicePageID = $this->controller->ID;
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
                    "Success" => true,
                    "Message" => "Thank you we will be in touch.",
                    "Type" => "good"
                ]);

            } else {
                $this->controller->redirect($this->controller->Link('success'));
            }

        } else {

            $this->sessionMessage(
                "Sorry there has been a problem, please try again.",
                "bad"
            );

            if ($this->getRequest()->isAjax()) {

                return json_encode([
                    "Success" => false,
                    "Message" => "Sorry there has been a problem, please try again.",
                    "Type" => "bad"
                ]);

            } else {
                $this->controller->redirect($this->controller->Link());
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
        $email->setHTMLTemplate('Emails/BookAServiceEmail.ss');
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
