<?php

declare(strict_types=1);

namespace App\Traits;

use App\Entities\AuthEntity;

trait PresentLoginTrait
{
    protected function initializePresentLoginTrait(AuthEntity $auth, string $message = 'Login Success'): array
    {
        return [
            'token' => [
                'token' => $auth->getToken(),
                'token_type' => 'bearer',
                'expires_in' => $auth->getExpiresIn(),
            ],
            'user' => $auth->getUser()?->toArray(),
            'message' => $message,
        ];
    }
}
