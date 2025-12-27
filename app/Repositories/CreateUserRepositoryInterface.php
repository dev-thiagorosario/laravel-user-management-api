<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\CreateUserDTO;
use App\Entities\UserEntity;

interface CreateUserRepositoryInterface
{
    public function create(CreateUserDTO $dto): UserEntity;
}
