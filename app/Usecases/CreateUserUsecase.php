<?php

declare(strict_types=1);

namespace App\Usecases;

use App\Entities\UserEntity;
use App\Exceptions\UserCreateException;
use App\Repositories\CreateUserRepositoryInterface;
use Throwable;

class CreateUserUsecase implements CreateUserUsecaseInterface
{
    public function __construct(
        private readonly CreateUserRepositoryInterface $createUserRepository
    ){}
    public function __invoke(array $data): UserEntity
    {
        $data['first_login'] = $data['first_login'] ?? true;
        $data['is_active'] = $data['is_active'] ?? true;

        try {
            return $this->createUserRepository->create($data);
        } catch (Throwable $e) {
            throw new UserCreateException(previous: $e);
        }
    }
}
