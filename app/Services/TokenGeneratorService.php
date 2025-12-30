<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Str;

class TokenGeneratorService implements TokenGeneratorServiceInterface
{
    public function generatePlainToken(): string
    {
        return Str::random(40);
    }
    public function hashToken(string $plainToken): string
    {
        return hash('sha256', $plainToken);
    }
}
