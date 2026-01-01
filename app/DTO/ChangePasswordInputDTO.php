<?php

declare(strict_types=1);

namespace App\DTO;

class ChangePasswordInputDTO
{
    public function __construct(
        public readonly int $userId,
        public readonly string $currentPassword,
        public readonly string $newPassword,
        public readonly string $newPasswordConfirmation,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            userId: (int) $data['userId'],
            currentPassword: (string) $data['current_password'],
            newPassword: (string) $data['new_password'],
            newPasswordConfirmation: (string) $data['new_password_confirmation'],
        );
    }
}
