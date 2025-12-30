<?php

declare(strict_types=1);

namespace App\Usecases;

use App\DTO\SendEmailConfirmationInputDTO;
use App\Mail\NewUserConfirmationMail;
use App\Repositories\EmailConfirmationTokenRepositoryInterface;
use App\Repositories\FindUserRepositoryInterface;
use App\Services\EmailConfirmationLinkGeneratorServiceInterface;
use App\Services\TokenGeneratorServiceInterface;
use App\Exceptions\EmailAlreadyVerifiedException;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Mail;

class SendEmailConfirmationUsecase implements SendEmailConfirmationUsecaseInterface
{
    public function __construct(
        private readonly FindUserRepositoryInterface                    $findUserRepository,
        private readonly EmailConfirmationLinkGeneratorServiceInterface $linkGeneratorService,
        private readonly TokenGeneratorServiceInterface                 $tokenGeneratorService,
        private readonly EmailConfirmationTokenRepositoryInterface      $tokenRepository,
    ){}

    public function __invoke(SendEmailConfirmationInputDTO $dto): void
    {
        $user = $this->findUserRepository->findByEmail($dto->email);

        if ($user->email_verified_at !== null) {
            throw new EmailAlreadyVerifiedException();
        }

        $this->tokenRepository->deletePendingTokens($dto->userId);
        $plainToken = $this->tokenGeneratorService->generatePlainToken();
        $tokenHash = $this->tokenGeneratorService->hashToken($plainToken);

        $expiration = CarbonImmutable::now()->addMinutes(10);

        $this->tokenRepository->createToken(
            userId: $dto->userId,
            tokenHash: $tokenHash,
            expiresAt: $expiration,
        );

        $confirmationLink = $this->linkGeneratorService->generate(
            userId: $dto->userId,
            email: $dto->email,
            plainToken: $plainToken,
            expiration: $expiration,
        );

        Mail::to($dto->email)->send(new NewUserConfirmationMail($dto->name, $confirmationLink));
    }
}
