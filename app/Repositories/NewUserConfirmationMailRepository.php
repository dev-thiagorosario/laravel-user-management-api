<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\EmailConfirmationToken;
use Carbon\Carbon;

class NewUserConfirmationMailRepository implements NewUserConfirmationMailRepositoryInterface
{
    public function deletePendingTokens(int $userId): void
    {
        EmailConfirmationToken::query()
            ->where('user_id', $userId)
            ->whereNull('used_at')
            ->delete();
    }

    public function createToken(int $userId, string $token, Carbon $expiresAt): void
    {
        EmailConfirmationToken::query()->create([
            'user_id' => $userId,
            'token' => $token,
            'expires_at' => $expiresAt,
        ]);
    }
}
