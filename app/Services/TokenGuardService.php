<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\EmailConfirmationToken;
use App\Repositories\EmailConfirmationTokenRepositoryInterface;
use App\Exceptions\InvalidOrExpiredTokenException;

class TokenGuardService implements TokenGuardServiceInterface
{
    public function __construct(
        private readonly EmailConfirmationTokenRepositoryInterface $emailConfirmationTokenRepository,
        private readonly TokenGeneratorServiceInterface $tokenGeneratorService
    ){}

    public function assertValid(int $userId, string $plainToken): EmailConfirmationToken
    {
        if ($plainToken === '') {
            throw new InvalidOrExpiredTokenException;
        }

        $tokenHash = $this->tokenGeneratorService->hashToken($plainToken);

        $token = $this->emailConfirmationTokenRepository->findValidPendingToken($userId, $tokenHash);

        if ($token === null) {
            throw new InvalidOrExpiredTokenException();
        }

        return $token;
    }
}
