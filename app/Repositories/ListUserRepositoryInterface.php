<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\ListUsersInputDTO;

interface ListUserRepositoryInterface
{
    public function all(ListUsersInputDTO $dto): array;
}
