<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Hash;

class PasswordVerifyService implements PasswordVerifyServiceInterface
{
    public function verify(string $password, string $hashedPassword): bool
    {
        return Hash::check($password, $hashedPassword);
    }
}
