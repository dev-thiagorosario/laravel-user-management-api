<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;

class PasswordHasherService implements PasswordHasherServiceInterface
{
    public function hash(string $password): string
    {
        return Hash::make($password);
    }
}
