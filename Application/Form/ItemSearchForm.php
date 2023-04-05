<?php

namespace Application\Form;

use Application\Form\AbstractForm;

class ItemSearchForm extends AbstractForm
{
    function build()
    {
        $this->add('searchBar', $this->input([
            'name' => 'searchBar',
            'type' => 'text',
            'label' => 'Search',
            'value' => $this->data->getSearchBar(),
            'placeholder' => 'By title or author name'
        ]));

        $this->add('reservationId', $this->input([
            'name' => 'reservationId',
            'type' => 'text',
            'label' => 'Search',
            'value' => $this->data->getReservationId(),
            'placeholder' => 'By reservation code'
        ]));

        $this->add('borrowingId', $this->input([
            'name' => 'borrowingId',
            'type' => 'text',
            'label' => 'Search',
            'value' => $this->data->getBorrowingId(),
            'placeholder' => 'By borrowing code'
        ]));

        $this->add('itemId', $this->input([
            'name' => 'itemId',
            'type' => 'text',
            'label' => 'Search',
            'value' => $this->data->getItemId(),
            'placeholder' => 'By item code'
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
                'old' => "old",
                'Broken' => "Broken"
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

        $this->add('submit', $this->submit([
            'name' => 'submit',
            'value' => 'Search',
            'class' => 'btn-primary'
        ]));
    }

    function isValid()
    {
        return true;
    }
}
