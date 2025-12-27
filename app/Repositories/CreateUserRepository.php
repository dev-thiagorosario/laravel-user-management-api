<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\CreateUserDTO;
use App\Entities\UserEntity;
use App\Models\User;

class CreateUserRepository implements CreateUserRepositoryInterface
{
    public function create(CreateUserDTO $dto): UserEntity
    {
        $user = User::query()->create($dto->toArray());

        return UserEntity::fromModel($user);
    }
}
