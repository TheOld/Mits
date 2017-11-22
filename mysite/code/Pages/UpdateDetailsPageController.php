<?php

namespace MitsubishiMotors\Pages;

use MitsubishiMotors\Forms\UpdateDetailsForm;
use SilverStripe\Control\HTTPRequest;

/**
 * Class UpdateDetailsPageController
 * @package MitsubishiMotors\Pages
 */
class UpdateDetailsPageController extends PageController
{
    /**
     * @var array
     */
    private static $allowed_actions = [
        'UpdateDetailsForm',
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
        $submitted = $request->getSession()->get(UpdateDetailsForm::SESSION_IDENTIFYIER . $this->ID . 'submitted');

        if (!$submitted) {
            return $this->redirect($this->Link());
        }

        $request->getSession()->clear(UpdateDetailsForm::SESSION_IDENTIFYIER . $this->ID . 'submitted');

        return $this;
    }

    /**
     * @return UpdateDetailsForm
     */
    public function UpdateDetailsForm()
    {
        return UpdateDetailsForm::create($this, 'UpdateDetailsForm');
    }
}
