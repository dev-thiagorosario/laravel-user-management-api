<?php

declare(strict_types=1);

namespace App\Usecases;

use App\DTO\ChangePasswordInputDTO;
use App\Exceptions\InvalidCurrentPasswordException;
use App\Repositories\ChangePasswordRepositoryInterface;
use App\Repositories\FindUserRepositoryInterface;
use App\Services\PasswordVerifyServiceInterface;

class ChangePasswordUsecase implements ChangePasswordUsecaseInterface
{
    public function __construct(
        private readonly ChangePasswordRepositoryInterface $changePasswordRepository,
        private readonly FindUserRepositoryInterface $findUserRepository,
        private readonly PasswordVerifyServiceInterface $passwordHasher,
    ){}

    public function __invoke(ChangePasswordInputDTO $dto): void
    {
        $user = $this->findUserRepository->findById($dto->userId);

        if (!$this->passwordHasher->verify($dto->currentPassword, $user->password)) {
            throw new InvalidCurrentPasswordException();
        }

        $newHash = $this->passwordHasher->hash($dto->newPassword);

        $this->changePasswordRepository->changePassword(
            userId: $dto->userId,
            newPasswordHash: $newHash,
        );
    }
}
