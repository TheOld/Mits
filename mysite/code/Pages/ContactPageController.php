<?php

namespace MitsubishiMotors\Pages;

use MitsubishiMotors\Forms\ContactForm;
use SilverStripe\Control\HTTPRequest;

/**
 * Class ContactPageController
 * @package MitsubishiMotors\Pages
 */
class ContactPageController extends PageController
{
    /**
     * @var array
     */
    private static $allowed_actions = [
        'ContactForm',
        'submit',
        'success'
    ];

    /**
     * @param HTTPRequest $request
     * @return $this|\SilverStripe\Control\HTTPResponse
     */
    public function success(HTTPRequest $request)
    {
        // return to index if session identifier for form submission not set
        $submitted = $request->getSession()->get(ContactForm::SESSION_IDENTIFYIER . $this->ID . 'submitted');

        if (!$submitted) {
            return $this->redirect($this->Link());
        }

        $request->getSession()->clear(ContactForm::SESSION_IDENTIFYIER . $this->ID . 'submitted');

        return $this;
    }

    /**
     * @return ContactForm
     */
    public function ContactForm()
    {
        return ContactForm::create($this, 'ContactForm');
    }
}
