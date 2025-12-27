<?php

declare(strict_types=1);

namespace App\DTO;

class CreateUserDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly bool $firstLogin = true,
        public readonly bool $isActive = true
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            name: (string) $data['name'],
            email: (string) $data['email'],
            password: (string) $data['password'],
            firstLogin: (bool) ($data['first_login'] ?? true),
            isActive: (bool) ($data['is_active'] ?? true)
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'first_login' => $this->firstLogin,
            'is_active' => $this->isActive,
            'last_login' => null,
            'blocked_until' => null,
        ];
    }
}
