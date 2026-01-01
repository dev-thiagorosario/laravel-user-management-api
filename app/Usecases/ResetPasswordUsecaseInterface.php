<?php

declare(strict_types=1);

namespace App\Usecases;

use App\DTO\ResetPasswordInputDTO;

interface ResetPasswordUsecaseInterface
{
    public function __invoke(ResetPasswordInputDTO $dtp): void;
}
