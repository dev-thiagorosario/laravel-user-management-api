<?php

declare(strict_types=1);

namespace App\Usecases;

use App\DTO\CreateUserDTO;
use App\Entities\UserEntity;
use App\Exceptions\UserCreateException;
use App\Repositories\CreateUserRepositoryInterface;
use Throwable;

class CreateUserUsecase implements CreateUserUsecaseInterface
{
    public function __construct(
        private readonly CreateUserRepositoryInterface $createUserRepository
    ){}
    public function __invoke(CreateUserDTO $dto): UserEntity
    {
        try {
            return $this->createUserRepository->create($dto);
        } catch (Throwable $e) {
            throw new UserCreateException(previous: $e);
        }
    }
}
