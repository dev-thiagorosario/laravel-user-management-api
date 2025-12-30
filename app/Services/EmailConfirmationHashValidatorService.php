<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\InvalidOrExpiredSignatureException;

class EmailConfirmationHashValidatorService implements EmailConfirmationHashValidatorServiceInterface
{
    public function assertValid(string $email, string $hash): void
    {
        if (!hash_equals(sha1($email), $hash)) {
            throw new InvalidOrExpiredSignatureException;
        }
    }
}
