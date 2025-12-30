<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\URL;
use Carbon\CarbonInterface;

class EmailConfirmationLinkGeneratorService implements LinkGeneratorServiceInterface
{
    public function generate(int $userId, string $email, string $plainToken, CarbonInterface $expiration): string
    {
        return URL::temporarySignedRoute(
            name: 'confirm-email',
            expiration: $expiration,
            parameters: [
                'userId' => $userId,
                'hash'=>sha1($email),
                'token' => (string) $plainToken,
            ]
        );
    }
}
