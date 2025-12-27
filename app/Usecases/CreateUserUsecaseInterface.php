<?php

declare(strict_types=1);

namespace App\Usecases;

use App\DTO\CreateUserDTO;
use App\Entities\UserEntity;

interface CreateUserUsecaseInterface
{
    public function __invoke(CreateUserDTO $dto): UserEntity;
}
