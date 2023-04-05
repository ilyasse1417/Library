<?php

namespace Application\Form;

abstract class AbstractForm
{
    public $entity;
    public $data;
    public $fields;
    public $errors = [];

    function __construct($entity, $data)
    {
        $this->entity = $entity;
        $this->data = $data;
        $this->fields = new \stdClass;
    }

    function add($field, $data)
    {
        $this->fields->$field = $data;
        return $this;
    }

    abstract function build();
    abstract function isValid();

    public function start($data = [])
    {
        $name = $data['name'] ?? 'form';
        $method = $data['type'] ?? 'post';
        $id = $data['id'] ?? 'form';
        $action = $data['action'] ?? '';
        $class = $data['class'] ?? '';
        $enctype = $data['enctype'] ?? '';
        return sprintf(
            '<form action="%s" method="%s" name="%s" id="%s" class="%s" enctype="%s" autocomplete="off">',
            $action,
            $method,
            $name,
            $id,
            $class,
            $enctype
        );
    }

    public function input($data = [])
    {
        $type = $data['type'] ?? 'text';
        $name = $data['name'] ?? 'name_' . uniqid();
        $label = $data['label'] ?? $name;
        $id = $data['id'] ?? $name;
        $class = $data['class'] ?? '';
        $value = $data['value'] ?? '';
        $placeholder = $data['placeholder'] ?? '';

        $html = '<div class="my-1" >';

        if ($type === 'submit') {
            $class = 'btn ' . $class;
        } else {
            $class = 'form-control ' . $class;
            $html .=  sprintf(
                '<label for="%s" class="form-label">%s</label>',
                $id,
                $label
            );
        }

        $html .=  sprintf(
            '<input type="%s" name="%s" value="%s" id="%s" class="%s" placeholder="%s" autocomplete="off"/>',
            $type,
            $name,
            $value,
            $id,
            $class,
            $placeholder
        );
        $html .= '</div>';

        if (isset($this->errors[$name])) {
            $html .= sprintf('<div class="text-danger"/>%s</div>', $this->errors[$name]);
        }

        return $html;
    }

    public function textarea($data = [])
    {
        $name = $data['name'] ?? 'name_' . uniqid();
        $id = $data['id'] ?? $name;
        $class = $data['class'] ?? '';
        $value = $data['value'] ?? '';
        $label = $data['label'];

        $html = '<div class="my-1" >';

        $class = 'form-control ' . $class;
        $html .=  sprintf(
            '<label for="%s" class="form-label">%s</label>',
            $id,
            $label
        );

        $html .= '</div>';
        $html .=  sprintf(
            '<textarea name="%s" id="%s" class="%s" autocomplete="off">%s</textarea>',
            $name,
            $id,
            $class,
            $value
        );

        if (isset($this->errors[$name])) {
            $html .= sprintf('<div class="text-danger"/>%s</div>', $this->errors[$name]);
        }

        return $html;
    }

    public function submit($data = [])
    {
        $data['type'] = 'submit';
        $data['value'] = $data['value'] ?? 'Submit';
        return $this->input($data);
    }

    public function select($data = [])
    {
        $name = $data['name'] ?? 'name_' . uniqid();
        $label = $data['label'] ?? $name;
        $id = $data['id'] ?? $name;
        $class = $data['class'] ?? '';
        $selectedValue = $data['selectedValue'] ?? '';
        $choices = $data['choices'] ?? [];

        $html = '<div class="my-1" >';
        $class = 'form-select ' . $class;
        $html .=  sprintf(
            '<label for="%s" class="form-label">%s</label>',
            $id,
            $label
        );

        $html .=  sprintf(
            '<select name="%s" id="%s" class="%s">',
            $name,
            $id,
            $class
        );

        foreach ($choices as $key => $value) {
            $disabled = '';
            $selected = '';
            if ($value === '--') {
                $disabled = 'disabled';
                $selected = 'selected';
            }
            if ($selectedValue == $value) {
                $selected = 'selected';
            }
            $html .= sprintf('<option value="%s" %s %s>%s</option>', $key, $selected, $disabled, $value);
        }

        $html .= '</select>';
        $html .= '</div>';

        if (isset($this->errors[$name])) {
            $html .= sprintf('<div class="text-danger"/>%s</div>', $this->errors[$name]);
        }

        return $html;
    }

    public function end()
    {
        return '</form>';
    }

    public function createView()
    {
        $this->build();
        return $this;
    }

    public function isSubmited()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            return true;
        }
        return false;
    }

    public function handle(&$data)
    {
        $postedData = $_POST;
        foreach ($postedData as $key => $value) {
            if (!property_exists($this->entity, $key)) {
                continue;
            }
            $setter = 'set' . ucfirst($key);
            $data->$setter($value);
        }
    }
}
