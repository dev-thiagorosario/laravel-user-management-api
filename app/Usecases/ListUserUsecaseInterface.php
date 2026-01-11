<?php

declare(strict_types=1);

namespace App\Usecases;

use App\DTO\ListUsersInputDTO;

interface ListUserUsecaseInterface
{
    public function __invoke(ListUsersInputDTO $dto): array;
}
