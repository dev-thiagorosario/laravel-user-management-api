<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\EmailConfirmationToken;

interface TokenGuardServiceInterface
{
    public function assertValid(int $userId, string $plainToken): EmailConfirmationToken;
}
