<?php
declare(strict_types=1);

namespace User\Model;

class UserModel
{
    /** @var int|null */
    private $id;

    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /** @var string */
    private $email;

    public function getId(): int
    {
        return (int) $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setId($id): void
    {
        $this->id = (int) $id;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
