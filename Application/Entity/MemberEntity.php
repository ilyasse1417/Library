<?php

namespace Application\Entity;

class MemberEntity
{
    private ?int $id = null;
    public ?string $nickname = null;
    private ?string $fullName = null;
    private ?string $password = null;
    private ?string $role = null;
    private ?string $address = null;
    private ?string $email = null;
    private ?string $phone = null;
    private ?string $cin = null;
    private ?string $type = null;
    private ?int $penaltyCount = null;
    private ?string $birthDate = null;
    private ?string $createdAt = null;

    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nickname
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * Set the value of nickname
     */
    public function setNickname(?string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get the value of fullName
     */
    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    /**
     * Set the value of fullName
     */
    public function setFullName(?string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * Set the value of role
     */
    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of address
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * Set the value of address
     */
    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of phone
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     */
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of cin
     */
    public function getCin(): ?string
    {
        return $this->cin;
    }

    /**
     * Set the value of cin
     */
    public function setCin(?string $cin): self
    {
        $this->cin = $cin;

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
     * Get the value of penaltyCount
     */
    public function getPenaltyCount(): ?int
    {
        return $this->penaltyCount;
    }

    /**
     * Set the value of penaltyCount
     */
    public function setPenaltyCount(?int $penaltyCount): self
    {
        $this->penaltyCount = $penaltyCount;

        return $this;
    }

    /**
     * Get the value of birthDate
     */
    public function getBirthDate(): ?string
    {
        return $this->birthDate;
    }

    /**
     * Set the value of birthDate
     */
    public function setBirthDate(?string $birthDate): self
    {
        $this->birthDate = $birthDate;

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
}
