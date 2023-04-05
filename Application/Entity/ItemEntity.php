<?php

namespace Application\Entity;

class ItemEntity
{
    private ?int $id = null;
    private ?string $title  = null;
    private ?string $authorName  = null;
    private ?string $coverImage  = null;
    private ?string $state  = null;
    private ?string $status  = null;
    private ?string $type  = null;
    private ?int $typeValue  = null;
    private ?string $editionDate  = null;
    private ?string $purchaseDate  = null;

    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of authorName
     */
    public function getAuthorName(): ?string
    {
        return $this->authorName;
    }

    /**
     * Set the value of authorName
     */
    public function setAuthorName(?string $authorName): self
    {
        $this->authorName = $authorName;

        return $this;
    }

    /**
     * Get the value of coverImage
     */
    public function getCoverImage(): ?string
    {
        return $this->coverImage;
    }

    /**
     * Set the value of coverImage
     */
    public function setCoverImage(?string $coverImage): self
    {
        $this->coverImage = $coverImage;

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
     * Get the value of typeValue
     */
    public function getTypeValue(): ?int
    {
        return $this->typeValue;
    }

    /**
     * Set the value of typeValue
     */
    public function setTypeValue(?int $typeValue): self
    {
        $this->typeValue = $typeValue;

        return $this;
    }

    /**
     * Get the value of editionDate
     */
    public function getEditionDate(): ?string
    {
        return $this->editionDate;
    }

    /**
     * Set the value of editionDate
     */
    public function setEditionDate(?string $editionDate): self
    {
        $this->editionDate = $editionDate;

        return $this;
    }

    /**
     * Get the value of purchaseDate
     */
    public function getPurchaseDate(): ?string
    {
        return $this->purchaseDate;
    }

    /**
     * Set the value of purchaseDate
     */
    public function setPurchaseDate(?string $purchaseDate): self
    {
        $this->purchaseDate = $purchaseDate;

        return $this;
    }
}
