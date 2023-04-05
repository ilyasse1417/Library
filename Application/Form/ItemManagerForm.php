<?php

namespace Application\Form;

use Application\Form\AbstractForm;

class ItemManagerForm extends AbstractForm
{
    function build()
    {
        $this->add('title', $this->input([
            'name' => 'title',
            'type' => 'text',
            'label' => 'Title',
            'value' => $this->data->getTitle(),
            'placeholder' => 'Title'
        ]));

        $this->add('authorName', $this->input([
            'name' => 'authorName',
            'type' => 'text',
            'label' => 'Author name',
            'value' => $this->data->getAuthorName(),
            'placeholder' => 'Author name'
        ]));

        $this->add('coverImage', $this->input([
            'name' => 'coverImage',
            'type' => 'file',
            'label' => 'Cover image',
            'value' => $this->data->getCoverImage(),
            'placeholder' => 'Cover image'
        ]));

        $this->add('type', $this->select([
            'name' => 'type',
            'label' => 'Type',
            'selectedValue' => $this->data->getType(),
            'choices' => [
                '' => "--",
                'Book' => "Book",
                'Movie' => "Movie",
                'Music' => "Music",
                'Audio book' => "Audio book",
                'Comics' => "Comics"
            ]
        ]));

        $this->add('typeValue', $this->input([
            'name' => 'typeValue',
            'type' => 'number',
            'label' => 'Pages / Duration',
            'value' => $this->data->getTypeValue(),
            'placeholder' => 'Pages / Duration'
        ]));

        $this->add('state', $this->select([
            'name' => 'state',
            'label' => 'State',
            'selectedValue' => $this->data->getState(),
            'choices' => [
                '' => "--",
                'New' => "New",
                'Used - like new' => "Used - like new",
                'Used' => "Used",
                'Used - like old' => "Used - like old",
                'old' => "old"
            ]
        ]));

        $this->add('status', $this->select([
            'name' => 'status',
            'label' => 'Status',
            'selectedValue' => $this->data->getStatus(),
            'choices' => [
                '' => "--",
                'Available' => "Available",
                'Reserved' => "Reserved",
                'Borrowed' => "Borrowed",
                'Unavailable' => "Unavailable"
            ]
        ]));

        $this->add('editionDate', $this->input([
            'name' => 'editionDate',
            'type' => 'date',
            'label' => 'Edition date',
            'value' => $this->data->getEditionDate(),
            'placeholder' => 'Edition date'
        ]));

        $this->add('purchaseDate', $this->input([
            'name' => 'purchaseDate',
            'type' => 'date',
            'label' => 'Purchase date',
            'value' => $this->data->getPurchaseDate(),
            'placeholder' => 'Purchase date'
        ]));

        $this->add('submit', $this->submit([
            'name' => 'submit',
            'value' => 'Add',
            'class' => 'btn-primary'
        ]));

        $this->add('search', $this->submit([
            'name' => 'submit',
            'value' => 'Search',
            'class' => 'btn-primary'
        ]));

        $this->add('edit', $this->submit([
            'name' => 'submit',
            'value' => 'Edit',
            'class' => 'btn-primary'
        ]));
    }

    function isValid()
    {
        // TODO
        return true;
    }
}
