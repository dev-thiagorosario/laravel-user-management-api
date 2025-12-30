<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\EmailConfirmationToken;
use Carbon\CarbonInterface;

interface EmailConfirmationTokenRepositoryInterface
{
    public function deletePendingTokens(int $userId): void;

    public function createToken(int $userId, string $tokenHash, CarbonInterface $expiresAt): void;

    public function findValidPendingToken(int $userId, string $tokenHash): ?EmailConfirmationToken;

    public function markAsUsed(int $tokenId): void;
}
