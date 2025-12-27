<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\UserEntity;

interface CreateUserRepositoryInterface
{
    public function create(array $data): UserEntity;
}
