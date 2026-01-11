<?php

declare(strict_types=1);

namespace App\Usecases;

use App\DTO\ListUsersInputDTO;
use App\Repositories\ListUserRepositoryInterface;

class ListUserUsecase implements ListUserUsecaseInterface
{
    public function __construct(
        private readonly ListUserRepositoryInterface $listUserRepository
    ){}

    public function __invoke(ListUsersInputDTO $dto): array
    {
        return $this->listUserRepository->all($dto);
    }
}
