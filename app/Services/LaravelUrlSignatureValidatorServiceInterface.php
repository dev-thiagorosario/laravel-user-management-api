<?php

declare(strict_types=1);

namespace App\Services;

interface LaravelUrlSignatureValidatorServiceInterface
{
    public function isValidSignedUrl(string $signedUrl): bool;
}
