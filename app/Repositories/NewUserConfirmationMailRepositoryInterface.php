<?php

declare(strict_types=1);

namespace App\Repositories;

interface NewUserConfirmationMailRepositoryInterface
{
    public function deletePendingTokens(int $userId): void;
    public function createToken(int $userId, string $token, \Carbon\Carbon $expiresAt): void;
}
