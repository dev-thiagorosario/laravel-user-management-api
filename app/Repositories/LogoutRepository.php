<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

class LogoutRepository implements LogoutRepositoryInterface
{
    public function logout(int $userId): void
    {
        $user = User::query()->findOrFail($userId);
        $user->update(['last_logged_in_at' => now()]);
    }
}
