<?php

declare(strict_types=1);

namespace App\Repositories;

interface ChangePasswordRepositoryInterface
{
    public function changePassword(int $userId, string $newPasswordHash): void;
}