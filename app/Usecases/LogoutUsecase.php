<?php

declare(strict_types=1);

namespace App\Usecases;

use App\Repositories\LogoutRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class LogoutUsecase implements LogoutUsecaseInterface
{
    public function __construct(
      private readonly LogoutRepositoryInterface $logoutRepository
    ){}
    public function __invoke(): void
    {
        $user = Auth::user(); 
        $userId = $user?->getAuthIdentifier();

        if ($user !== null && method_exists($user, 'currentAccessToken')) {
            $token = $user->currentAccessToken();
            if ($token !== null) {
                $token->delete();
            }
        }

        if ($userId !== null) {
            $this->logoutRepository->logout($userId);
        }
    }
}
