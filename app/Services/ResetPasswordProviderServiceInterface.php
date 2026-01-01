<?php

declare(strict_types=1);

namespace App\Services;

interface ResetPasswordProviderServiceInterface
{
    public function provide(): string;
}
