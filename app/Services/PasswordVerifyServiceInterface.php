<?php

declare(strict_types=1);

namespace App\Services;

interface PasswordVerifyServiceInterface
{
    public function verify(string $plainPassword, string $hashedPassword): bool;
    public function hash(string $plainPassword): string;
}
