<?php

declare(strict_types=1);

namespace App\Usecases;

use App\DTO\ConfirmEmailInputDTO;
use App\Exceptions\EmailAlreadyVerifiedException;
use App\Exceptions\InvalidOrExpiredSignatureException;
use App\Repositories\EmailConfirmationTokenRepositoryInterface;
use App\Repositories\FindUserRepositoryInterface;
use App\Services\EmailConfirmationHashValidatorServiceInterface;
use App\Services\TokenGuardServiceInterface;
use App\Services\UrlSignatureValidatorServiceInterface;

class ConfirmEmailUsecase implements ConfirmEmailUsecaseInterface
{
    public function __construct(
        private readonly UrlSignatureValidatorServiceInterface $urlSignatureValidatorService,
        private readonly EmailConfirmationTokenRepositoryInterface $tokenRepository,
        private readonly FindUserRepositoryInterface $userRepository,
        private readonly EmailConfirmationHashValidatorServiceInterface $hashValidatorService,
        private readonly TokenGuardServiceInterface $tokenGuardService
    ){}

    public function __invoke(ConfirmEmailInputDTO $dto): void
    {
       if (!$this->urlSignatureValidatorService->isValidSignedUrl($dto->fullUrl)) {
            throw new InvalidOrExpiredSignatureException();
       }

       $user = $this->userRepository->findById($dto->userId);

       if ($user->email_verified_at !== null) {
            throw new EmailAlreadyVerifiedException();
        }

        $this->hashValidatorService->assertValid($user->email, $dto->hash);

        $token = $this->tokenGuardService->assertValid($dto->userId, $dto->token);

        $this->tokenRepository->markAsUsed((int) $token->id);
        $user->forceFill(['email_verified_at' => now()])->save();
}
}
