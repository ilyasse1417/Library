<?php

namespace Application\Form;

use Application\Form\AbstractForm;
use Application\Controller\MemberController;

class MemberProfileForm extends AbstractForm
{
    function build()
    {
        $this->add('nickname', $this->input([
            'name' => 'nickname',
            'type' => 'text',
            'label' => 'Nickname',
            'value' => $this->data->getNickname()
        ]));

        $this->add('email', $this->input([
            'name' => 'email',
            'type' => 'email',
            'label' => 'Email',
            'value' => $this->data->getEmail()
        ]));

        $this->add('fullName', $this->input([
            'name' => 'fullName',
            'type' => 'text',
            'label' => 'Full name',
            'value' => $this->data->getFullName()
        ]));

        $this->add('address', $this->input([
            'name' => 'address',
            'type' => 'text',
            'label' => 'Address',
            'value' => $this->data->getAddress()
        ]));

        $this->add('phone', $this->input([
            'name' => 'phone',
            'type' => 'tel',
            'label' => 'Phone',
            'value' => $this->data->getPhone()
        ]));

        $this->add('cin', $this->input([
            'name' => 'cin',
            'type' => 'text',
            'label' => 'CIN',
            'value' => $this->data->getCin()
        ]));

        $this->add('type', $this->input([
            'name' => 'type',
            'type' => 'text',
            'label' => 'Occupation',
            'value' => $this->data->getType()
        ]));

        $this->add('birthDate', $this->input([
            'name' => 'birthDate',
            'type' => 'date',
            'label' => 'Date of birth',
            'value' => $this->data->getBirthDate()
        ]));

        $this->add('submit', $this->submit([
            'name' => 'submit',
            'value' => 'Update',
            'class' => 'btn-primary'
        ]));
    }

    function isValid()
    {
        $valid = true;
        if (strlen($this->data->getNickname()) <= 6) {
            $this->errors['nickname'] = 'Nickname must be greater than 6 characters';
            $valid = false;
        }

        if (!filter_var($this->data->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Email invalid';
            $valid = false;
        }

        if (strlen($this->data->getFullName()) <= 3) {
            $this->errors['fullName'] = 'Full name must be greater than 3 characters';
            $valid = false;
        }

        if (strlen($this->data->getAddress()) <= 0) {
            $this->errors['address'] = 'Address cannot be empty';
            $valid = false;
        }

        if (!(preg_match("/^[0-9]{10}$/", $this->data->getPhone()))) {
            $this->errors['phone'] = 'Enter a valid phone number. Ex : 0612345678';
            $valid = false;
        }

        if (strlen($this->data->getCin()) < 3 || strlen($this->data->getCin()) > 8) {
            $this->errors['cin'] = 'CIN number must be between 3 and 8';
            $valid = false;
        }

        if (strlen($this->data->getType()) <= 0) {
            $this->errors['type'] = 'Occupation cannot be empty';
            $valid = false;
        }

        if ($this->data->getBirthDate() >= date("Y-m-d") || $this->data->getBirthDate() == null) {
            $this->errors['birthDate'] = 'Please choose a valid date';
            $valid = false;
        }

        return $valid;
    }
}
