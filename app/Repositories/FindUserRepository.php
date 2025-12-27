<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Exceptions\UserNotFoundException;
use App\Models\User;

class FindUserRepository implements FindUserRepositoryInterface
{
    public function findByEmail(string $email): User
    {
        $user = User::query()
            ->where('email', $email)
            ->first();

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
