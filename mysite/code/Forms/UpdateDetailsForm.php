<?php

namespace MitsubishiMotors\Forms;

use MitsubishiMotors\DataObjects\UpdateDetailsSubmission;
use MitsubishiMotors\Pages\UpdateDetailsPageController;
use MitsubishiMotors\Traits\CustomValidationResponse;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\FormAction;
use SilverStripe\Control\Email\Email;
use SilverStripe\Forms\RequiredFields;

/**
 * Class UpdateDetailsForm
 * @package MitsubishiMotors\Forms
 */
class UpdateDetailsForm extends Form
{
    use CustomValidationResponse;

    const SESSION_IDENTIFYIER = 'update';

    protected $controller;

    /**
     * @param UpdateDetailsPageController $controller
     * @param String $name
     */
    public function __construct($controller, $name)
    {
        $this->controller = $controller;

        $this->setAttribute('data-form', 'true');
        $this->setAttribute('novalidate', 'true');

        $fields = new FieldList(
            TextField::create("FirstName", "First Name"),
            TextField::create("LastName", "Last Name"),
            TextField::create("VIN", "VIN or Registration number"),
            EmailField::create("Email", "Email"),
            NumericField::create("Phone", "Phone")->setAttribute('onkeypress', 'return (event.keyCode === 9 || event.keyCode === 16 || event.keyCode === 8 || event.keyCode === 46 || (event.keyCode >= 35 && event.keyCode <= 40)) || (event.charCode >= 48 && event.charCode <= 57)'),
            TextareaField::create("Details", "What details would you like to update?")
        // TODO NEED TO ADD THE HONEYPOT FIELD / OR recapture
        );

        $actions = new FieldList(
            FormAction::create("submit")->setTitle("send update")->addExtraClass('button')
        );

        $validator = RequiredFields::create(['FirstName', 'LastName', 'Email', 'Phone', 'Details']);

        $this->setValidationResponseCallback([$this, 'formatAsJson']);

        parent::__construct($controller, $name, $fields, $actions, $validator);
    }

    /**
     * @param $data
     * @param $form
     * @param $request
     * @return string
     */
    public function submit($data, $form, $request)
    {
        $request = $this->getRequest();

        $submission = UpdateDetailsSubmission::create();
        $submission->UpdateDetailsPageID = $this->controller->ID;
        $this->saveInto($submission);

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
        $email->setHTMLTemplate('Emails/UpdateDetailsEmail.ss');
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
        $subject = "Website update your details request received";
        $email = new Email($from, $to, $subject);
        $email->setHTMLTemplate('Emails/CallCentreUpdateDetailsEmail.ss');
        $email->setData($submission);
        $email->send();
    }
}
