<?php

declare(strict_types=1);

namespace App\Usecases;

use App\DTO\ResetPasswordInputDTO;
use App\Repositories\ChangePasswordRepositoryInterface;
use App\Repositories\FindUserRepositoryInterface;
use App\Services\PasswordHasherServiceInterface;
use App\Services\ResetPasswordProviderServiceInterface;

class ResetPasswordUsecase implements ResetPasswordUsecaseInterface
{
    public function __construct(
        private readonly ResetPasswordProviderServiceInterface $resetPasswordProviderService,
        private readonly FindUserRepositoryInterface $findUserRepository,
        private readonly PasswordHasherServiceInterface $passwordHasher,
        private readonly ChangePasswordRepositoryInterface $changePasswordRepository
    ){}

    public function __invoke(ResetPasswordInputDTO $dto): void
    {
        $user = $this->findUserRepository->findById($dto->userId);

        $plainPassword = $this->resetPasswordProviderService->provide();

        $hash = $this->passwordHasher->hash($plainPassword);

        $this->changePasswordRepository->changePassword($user->id, $hash);
    }

}
