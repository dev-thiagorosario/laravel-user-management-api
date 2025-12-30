<?php

declare(strict_types=1);

namespace App\Services;

interface TokenGeneratorServiceInterface
{
    public function generatePlainToken(): string;
    public function hashToken(string $plainToken): string;
}

