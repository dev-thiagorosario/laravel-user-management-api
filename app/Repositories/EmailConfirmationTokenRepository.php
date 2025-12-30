<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\EmailConfirmationToken;
use Carbon\CarbonInterface;

class EmailConfirmationTokenRepository implements EmailConfirmationTokenRepositoryInterface
{
    public function deletePendingTokens(int $userId): void
    {
        EmailConfirmationToken::query()
            ->where('user_id', $userId)
            ->whereNull('used_at')
            ->delete();
    }
    public function createToken(int $userId, string $tokenHash, CarbonInterface $expiresAt): void
    {
        EmailConfirmationToken::query()->create([
            'user_id'    => $userId,
            'token_hash' => $tokenHash,
            'expires_at' => $expiresAt,
        ]);
    }

    public function findValidPendingToken(int $userId, string $tokenHash): ?EmailConfirmationToken
    {
        return EmailConfirmationToken::query()
            ->where('user_id', $userId)
            ->where('token_hash', $tokenHash)
            ->whereNull('used_at')
            ->where('expires_at', '>', now())
            ->first();
    }

    public function markAsUsed(int $tokenId): void
    {
        EmailConfirmationToken::query()
            ->whereKey($tokenId)
            ->update(['used_at' => now()]);
    }
}
