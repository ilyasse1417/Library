<?php

namespace Entity\Reservation;

class ReservationEntity
{
    private ?int $id;
    private ?string $createdAt;
    private ?int $itemId;
    private ?int $memberId; 

    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of createdAt
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     */
    public function setCreatedAt(?string $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of itemId
     */
    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    /**
     * Get the value of memberId
     */
    public function getMemberId(): ?int
    {
        return $this->memberId;
    }
}