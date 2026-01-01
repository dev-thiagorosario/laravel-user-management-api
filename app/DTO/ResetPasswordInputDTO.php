<?php

declare(strict_types=1);

namespace App\DTO;

class ResetPasswordInputDTO
{
    public function __construct(
        public readonly int $userId,
    ) {}
    public static function fromArray(array $data): self
    {
        return new self(
            userId: (int) $data['userId'],
        );
    }
}
