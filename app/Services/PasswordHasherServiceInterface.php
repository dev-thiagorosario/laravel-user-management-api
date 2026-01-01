<?php

declare(strict_types=1);

namespace App\Services;

interface PasswordHasherServiceInterface
{
    public function hash(string $password): string;
}
