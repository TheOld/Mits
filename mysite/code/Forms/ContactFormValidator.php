<?php

namespace MitsubishiMotors\Forms;

use SilverStripe\Forms\Validator;

class ContactFormValidator extends Validator
{
    /**
     * @param array $data
     * @return bool
     */
    public function php($data)
    {
        $valid = true;
        $fields = $this->form->Fields();

        foreach ($fields as $field) {
            $valid = ($field->validate($this) && $valid);
        }

        if (empty($data['EnquiryType'])) {
            $this->validationError('EnquiryType', 'Please select an Enquiry Type', 'required');
        }

        if (empty($data['Name'])) {
            $this->validationError('Name', 'Please enter your name', 'required');
        }

        if (empty($data['Email']) && empty($data['Phone'])) {
            $this->validationError('Email', 'Please enter either your email or your phone number', 'required');
            $this->validationError('Phone', 'Please enter either your email or your phone number', 'required');
        }

        if (empty($data['Message'])) {
            $this->validationError('Message', 'Please enter your message', 'required');
        }

        return $valid;
    }
}
