<?php

declare(strict_types=1);

namespace App\Usecases;

use App\DTO\SendEmailConfirmationInputDTO;

interface SendEmailConfirmationUsecaseInterface
{
    public function __invoke(SendEmailConfirmationInputDTO $dto): void;
}
