<?php

namespace MitsubishiMotors\Forms;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\FormAction;
use MitsubishiMotors\DataObjects\Submission;
use SilverStripe\Control\Email\Email;
use MitsubishiMotors\DataObjects\EnquiryType;
use MitsubishiMotors\Traits\CustomValidationResponse;

/**
 * Class ContactForm
 * @package MitsubishiMotors\Forms
 */
class ContactForm extends Form
{
    use CustomValidationResponse;

    const SESSION_IDENTIFYIER = 'contact';

    /**
     * ContactForm constructor.
     * @param \SilverStripe\Control\RequestHandler $controller
     * @param string $name
     */
    public function __construct($controller, $name)
    {
        $this->setAttribute('data-form', 'true');
        $this->setAttribute('novalidate', 'true');

        $enquiryTypes = $controller->dataRecord->EnquiryTypes()->map('Title', 'Title');

        $fields = new FieldList(
            TextField::create('Name', 'Name'),
            EmailField::create('Email', 'Email'),
            HiddenField::create('PageID', 'PageID', $controller->dataRecord->ID),
            NumericField::create('Phone', 'Phone')->setAttribute('onkeypress', 'return (event.keyCode === 9 || event.keyCode === 16 || event.keyCode === 8 || event.keyCode === 46 || (event.keyCode >= 35 && event.keyCode <= 40)) || (event.charCode >= 48 && event.charCode <= 57)'),
            DropdownField::create('EnquiryType', 'Enquiry Type')->setSource($enquiryTypes),
            TextareaField::create('Message', 'Message')
        // TODO NEED TO ADD THE HONEYPOT FIELD
        );

        $actions = new FieldList(
            FormAction::create('submit')->setTitle('send enquiry')->addExtraClass('button')
        );

        $validator = Injector::inst()->create(ContactFormValidator::class);
        $validator = RequiredFields::create(['Name', 'Email', 'Phone', 'Message']);

        $this->setValidationResponseCallback([$this, 'formatAsJson']);

        parent::__construct($controller, $name, $fields, $actions, $validator);
    }

    /**
     * Form submission - email the details to WBC
     *
     * @param array $data
     * @param Form $form
     * @return array
     */
    public function submit($data, $form, HTTPRequest $request)
    {
        $submission = Submission::create();
        $submission->ContactPageID = $this->controller->dataRecord->ID;
        $this->saveInto($submission);

        if ($submission->write()) {

            $request->getSession()->set(self::SESSION_IDENTIFYIER . $this->controller->ID . 'submitted', true);

            $parentPage = SiteTree::get()->byID($data['PageID']);
            $enquiryType = $parentPage->EnquiryTypes()->filter('Title', $data['EnquiryType'])->first();

            // Send emails to Call Center and User
            $this->sendConfirmationEmail($submission);
            $this->sendCallCentreEmail($enquiryType, $submission);

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
                $this->controller->redirect($this->controller->Link('success'));
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
        $email->setHTMLTemplate('Emails/ContactEmail.ss');
        $email->setData($submission);
        $email->send();
    }

    /**
     * @param $enquiryType
     * @param $submission
     */
    public function sendCallCentreEmail($enquiryType, $submission)
    {
        $from = 'no-reply@mmnz.co.nz';

        // To Call Centre (from Enquiry Type)
        $to = !empty($enquiryType->EmailTo) ? $enquiryType->EmailTo : 'info@mmnz.co.nz';
        $subject = "Website {$submission->EnquiryType} enquiry";
        $email = new Email($from, $to, $subject);
        $email->setHTMLTemplate('Emails/CallCentreContactEmail.ss');
        $email->setData($submission);
        $email->send();
    }
}
