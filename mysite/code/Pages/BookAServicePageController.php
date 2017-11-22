<?php

namespace MitsubishiMotors\Pages;

use MitsubishiMotors\Forms\BookAServiceForm;
use SilverStripe\Control\HTTPRequest;

/**
 * Class BookAServicePageController
 * @package MitsubishiMotors\Pages
 */
class BookAServicePageController extends PageController
{
    /**
     * @var array
     */
    private static $allowed_actions = [
        'BookAServiceForm',
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
        $submitted = $request->getSession()->get(BookAServiceForm::SESSION_IDENTIFYIER . $this->ID . 'submitted');

        if (!$submitted) {
            return $this->redirect($this->Link());
        }

        $request->getSession()->clear(BookAServiceForm::SESSION_IDENTIFYIER . $this->ID . 'submitted');

        return $this;
    }

    /**
     * @return BookAServiceForm
     */
    public function BookAServiceForm()
    {
        return BookAServiceForm::create($this, 'BookAServiceForm');
    }
}
