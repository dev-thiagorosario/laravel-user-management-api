<?php

declare(strict_types=1);

namespace App\Usecases;

use App\DTO\LoginInputDTO;
use App\Entities\AuthEntity;

interface LoginUsecaseInterface
{
    public function __invoke(LoginInputDTO $dto): AuthEntity;
}
