<?php

declare(strict_types=1);

namespace App\DTO;

class ConfirmEmailInputDTO
{
    public function __construct(
        public readonly int $userId,
        public readonly string $hash,
        public readonly string $token,
        public readonly string $fullUrl,
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            userId: (int) $data['userId'],
            hash: (string) $data['hash'],
            token: (string) $data['token'],
            fullUrl: (string) $data['full_url'],
        );
    }
}
