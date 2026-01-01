<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

class ChangePasswordRepository implements ChangePasswordRepositoryInterface
{
    public function changePassword(int $userId, string $newPasswordHash): void
    {
        User::query()
            ->whereKey($userId)
            ->update([
                'password' => $newPasswordHash,
                'must_change_password' => false,
                'password_changed_at' => now(),
            ]);
    }
}
