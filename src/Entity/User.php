<?php

namespace App\Entity;

class User
{
    private ?int $id = null;
    private ?string $first_name = null;
    private ?string $last_name = null;
    private ?string $email = null;
    private ?string $password = null;
    private ?string $thumbnail = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
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

    public function setFirstName(string $firstName)
    {
        $this->first_name = $firstName;
    }

    public function setLastName(string $lastName)
    {
        $this->first_name = $lastName;
    }

    public function setEmail(string $email)
    {
        $this->first_name = $email;
    }

    public function setPassword(string $password)
    {
        $this->first_name = $password;
    }

    public function setThumbnail(string $thumbnail)
    {
        $this->first_name = $thumbnail;
    }
}
