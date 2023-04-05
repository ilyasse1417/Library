<?php

namespace Application\Entity;
// Borrowing\BorrowingEntity.php

class BorrowingEntity
{
    private ?int $id;
    private ?int $reservationId;
    private ?string $createdAt;
    private ?string $returnedAt;


    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of reservationId
     */
    public function getReservationId(): ?int
    {
        return $this->reservationId;
    }

    /**
     * Set the value of reservationId
     */
    public function setReservationId(?int $reservationId): self
    {
        $this->reservationId = $reservationId;

        return $this;
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
     * Get the value of returnedAt
     */
    public function getReturnedAt(): ?string
    {
        return $this->returnedAt;
    }

    /**
     * Set the value of returnedAt
     */
    public function setReturnedAt(?string $returnedAt): self
    {
        $this->returnedAt = $returnedAt;

        return $this;
    }
}