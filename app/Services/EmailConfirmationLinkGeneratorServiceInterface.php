<?php

declare(strict_types=1);

namespace App\Services;

use Carbon\CarbonInterface;

interface LinkGeneratorServiceInterface
{
    public function generate(int $userId, string $email, string $plainToken, CarbonInterface $expiration): string;
}
