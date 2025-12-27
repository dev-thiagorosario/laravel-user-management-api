<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\UserEntity;
use App\Models\User;

class CreateUserRepository implements CreateUserRepositoryInterface
{
    public function create(array $data): UserEntity
    {
       $user = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'first_login' => $data['first_login'] ?? true,
            'is_active' => $data['is_active'] ?? true,
            'last_login' => $data['last_login'] ?? null,
            'blocked_until' => $data['blocked_until'] ?? null,
        ]);

        return UserEntity::fromModel($user);
    }
}
