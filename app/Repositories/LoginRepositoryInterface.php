<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

interface LoginRepositoryInterface
{
    public function markLoggedIn(User $user): User;

    public function createToken(User $user): string;
}
