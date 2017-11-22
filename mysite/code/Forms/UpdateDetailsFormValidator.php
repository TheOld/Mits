<?php

namespace MitsubishiMotors\Forms;

use SilverStripe\Forms\Validator;

class UpdateDetailsFormValidator extends Validator
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

        if (empty($data['FirstName'])) {
            $this->validationError('FirstName', 'First name is required', 'required');
        }

        if (empty($data['LastName'])) {
            $this->validationError('LastName', 'Last name is required', 'required');
        }

        if (empty($data['Email']) && empty($data['Phone'])) {
            $this->validationError('Email', 'Please enter either your email or your phone number', 'required');
            $this->validationError('Phone', 'Please enter either your email or your phone number', 'required');
        }

        if (empty($data['Details'])) {
            $this->validationError('Details', 'Please enter your details', 'required');
        }

        return $valid;
    }
}
