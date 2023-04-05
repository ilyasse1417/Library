<?php

namespace Application\Form;

use Application\Form\AbstractForm;

class MemberLoginForm extends AbstractForm
{
    function build()
    {
        $this->add('nickname', $this->input([
            'name' => 'nickname',
            'type' => 'text',
            'label' => 'Nickname',
            'value' => $this->data->getNickname(),
            'placeholder' => 'Nickname'
        ]));

        $this->add('password', $this->input([
            'name' => 'password',
            'type' => 'password',
            'label' => 'Password',
            'value' => $this->data->getPassword(),
            'placeholder' => 'Password'
        ]));

        $this->add('submit', $this->submit([
            'name' => 'submit',
            'value' => 'Log in',
            'class' => 'btn-primary'
        ]));
    }

    function isValid()
    {
        //TODO
        $valid = true;
        return $valid;
    }
}
