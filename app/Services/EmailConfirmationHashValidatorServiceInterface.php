<?php

declare(strict_types=1);

namespace App\Services;

interface EmailConfirmationHashValidatorServiceInterface
{
    public function assertValid(string $email, string $hash): void;
}
