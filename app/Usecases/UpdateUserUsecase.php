<?php

declare(strict_types=1);

namespace App\Usecases;

use App\DTO\UpdateUserInputDTO;
use App\Repositories\FindUserRepositoryInterface;
use App\Repositories\UpdateUserRepositoryInterface;
use App\Entities\UserEntity;
use App\Exceptions\UpdateUserException;
use Throwable;

class UpdateUserUsecase implements UpdateUserUsecaseInterface
{
    public function __construct(
        private readonly FindUserRepositoryInterface $findUserRepository,
        private readonly UpdateUserRepositoryInterface $updateUserRepository
    ){}

    public function __invoke(UpdateUserInputDTO $dto): UserEntity
    {
        $user = $this->findUserRepository->findById($dto->userId);

        try {
            return $this->updateUserRepository->update($user, $dto);
        } catch (Throwable $e) {
            throw new UpdateUserException(previous: $e);
        }
    }
}
