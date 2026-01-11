<?php

declare(strict_types=1);

namespace App\DTO;

class UpdateUserInputDTO
{
    public function __construct(
        public readonly int $userId,
        public readonly string $name,
        public readonly string $email
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            userId: (int) $data['userId'],
            name: (string) $data['name'],
            email: (string) $data['email'],
        );
    }
}
