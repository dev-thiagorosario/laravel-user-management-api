<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\UpdateUserInputDTO;
use App\Entities\UserEntity;
use App\Models\User;

interface UpdateUserRepositoryInterface
{
    public function update(User $user, UpdateUserInputDTO $dto): UserEntity;
}
