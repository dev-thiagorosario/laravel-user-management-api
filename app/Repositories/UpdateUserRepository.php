<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\UpdateUserInputDTO;
use App\Entities\UserEntity;
use App\Models\User;

class UpdateUserRepository implements UpdateUserRepositoryInterface
{
    public function update(User $user, UpdateUserInputDTO $dto): UserEntity
    {
        $user->name = $dto->name;
        $user->email = $dto->email;

        $user->save();

        return UserEntity::fromModel($user);
    }

}
