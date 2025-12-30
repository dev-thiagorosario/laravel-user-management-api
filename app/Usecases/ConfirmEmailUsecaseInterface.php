<?php

declare(strict_types=1);

namespace App\Usecases;

use App\DTO\ConfirmEmailInputDTO;

interface ConfirmEmailUsecaseInterface
{
    public function __invoke(ConfirmEmailInputDTO $dto): void;
}
