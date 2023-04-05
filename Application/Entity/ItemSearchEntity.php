<?php

namespace Application\Entity;

class ItemSearchEntity
{
    private ?string $searchBar = null;
    private ?string $reservationId = null;
    private ?string $borrowingId = null;
    private ?string $itemId = null;
    private ?string $type = null;
    private ?string $state = null;
    private ?string $status = null;

    /**
     * Get the value of searchBar
     */
    public function getSearchBar(): ?string
    {
        return $this->searchBar;
    }

    /**
     * Set the value of searchBar
     */
    public function setSearchBar(?string $searchBar): self
    {
        $this->searchBar = $searchBar;

        return $this;
    }

    /**
     * Get the value of reservationId
     */
    public function getReservationId(): ?string
    {
        return $this->reservationId;
    }

    /**
     * Set the value of reservationId
     */
    public function setReservationId(?string $reservationId): self
    {
        $this->reservationId = $reservationId;

        return $this;
    }

    /**
     * Get the value of borrowingId
     */
    public function getBorrowingId(): ?string
    {
        return $this->borrowingId;
    }

    /**
     * Set the value of borrowingId
     */
    public function setBorrowingId(?string $borrowingId): self
    {
        $this->borrowingId = $borrowingId;

        return $this;
    }

    /**
     * Get the value of itemId
     */
    public function getItemId(): ?string
    {
        return $this->itemId;
    }

    /**
     * Set the value of itemId
     */
    public function setItemId(?string $itemId): self
    {
        $this->itemId = $itemId;

        return $this;
    }

    /**
     * Get the value of type
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * Set the value of type
     */
    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of state
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * Set the value of state
     */
    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * Set the value of status
     */
    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
