<?php

namespace App\Entity;

class User
{
    private ?int $id = null;
    private ?string $firstName = null;
    private ?string $lastName = null;
    private ?string $email = null;
    private ?string $password = null;
    private ?string $thumbnail = null;
    private ?int $isAdmin = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function getAdmin(): ?int
    {
        return $this->isAdmin;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function setThumbnail(string $thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }

    public function setAdmin(int $is_admin)
    {
        $this->isAdmin = $is_admin;
    }
}