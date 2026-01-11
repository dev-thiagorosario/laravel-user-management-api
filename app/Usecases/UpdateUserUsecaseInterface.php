<?php

declare(strict_types=1);

namespace App\Usecases;

use App\DTO\UpdateUserInputDTO;
use App\Entities\UserEntity;

interface UpdateUserUsecaseInterface
{
    public function __invoke(UpdateUserInputDTO $dto): UserEntity;
}
