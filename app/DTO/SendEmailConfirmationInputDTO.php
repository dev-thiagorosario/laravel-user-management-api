<?php

declare(strict_types=1);

namespace App\DTO;

class SendEmailConfirmationInputDTO
{
    public function __construct(
        public readonly int $userId,
        public readonly string $name,
        public readonly string $email,
    ) {}

    public static function fromArray(array $data): self
    {
        $userId = $data['userId'] ?? $data['user_id'] ?? null;

        return new self(
            userId: (int) $userId,
            name: (string) $data['name'],
            email: (string) $data['email'],
        );
    }
}
