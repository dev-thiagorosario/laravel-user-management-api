<?php

declare(strict_types=1);

namespace App\Repositories;

interface LogoutRepositoryInterface
{
    public function logout(int $userId): void;
}
