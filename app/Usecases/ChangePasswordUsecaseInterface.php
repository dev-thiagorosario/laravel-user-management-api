<?php

declare(strict_types=1);

namespace App\Usecases;

use App\DTO\ChangePasswordInputDTO;

interface ChangePasswordUsecaseInterface
{
    public function __invoke(ChangePasswordInputDTO $dto): void;
}
