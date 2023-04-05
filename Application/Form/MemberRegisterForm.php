<?php

namespace Application\Form;

use Application\Form\AbstractForm;

class MemberRegisterForm extends AbstractForm
{
    function build()
    {
        $this->add('nickname', $this->input([
            'name' => 'nickname',
            'type' => 'text',
            'label' => 'Nickname',
            'value' => $this->data->getNickname(),
            'placeholder' => 'example123'
        ]));

        $this->add('email', $this->input([
            'name' => 'email',
            'type' => 'email',
            'label' => 'Email',
            'value' => $this->data->getEmail(),
            'placeholder' => 'example@example.com'
        ]));

        $this->add('password', $this->input([
            'name' => 'password',
            'type' => 'password',
            'label' => 'Password',
            'value' => $this->data->getPassword(),
            'placeholder' => 'Password'
        ]));

        $this->add('fullName', $this->input([
            'name' => 'fullName',
            'type' => 'text',
            'label' => 'Full name',
            'value' => $this->data->getFullName(),
            'placeholder' => 'Last & first name'
        ]));

        $this->add('address', $this->input([
            'name' => 'address',
            'type' => 'text',
            'label' => 'Address',
            'value' => $this->data->getAddress(),
            'placeholder' => '123 Street example'
        ]));

        $this->add('phone', $this->input([
            'name' => 'phone',
            'type' => 'tel',
            'label' => 'Phone',
            'value' => $this->data->getPhone(),
            'placeholder' => '0612345678'
        ]));

        $this->add('cin', $this->input([
            'name' => 'cin',
            'type' => 'text',
            'label' => 'CIN',
            'value' => $this->data->getCin(),
            'placeholder' => 'KB123456'
        ]));

        $this->add('type', $this->input([
            'name' => 'type',
            'type' => 'text',
            'label' => 'Occupation',
            'value' => $this->data->getType(),
            'placeholder' => '(Student, Employee...)'
        ]));

        $this->add('birthDate', $this->input([
            'name' => 'birthDate',
            'type' => 'date',
            'label' => 'Date of birth',
            'value' => $this->data->getBirthDate(),
            'placeholder' => 'Birth date'
        ]));

        $this->add('submit', $this->submit([
            'name' => 'submit',
            'value' => 'Register',
            'class' => 'btn-primary'
        ]));
        //TODO terms and conditions
    }

    function isValid()
    {
        $valid = true;
        if (strlen($this->data->getNickname()) <= 6) {
            $this->errors['nickname'] = 'Nickname must be greater than 6 characters';
            $valid = false;
        }
        if (strlen($this->data->getPassword()) <= 8) {
            $this->errors['password'] = 'Password must be greater than 8 characters';
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
