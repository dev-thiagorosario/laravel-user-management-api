<?php

declare(strict_types=1);

namespace App\Services;

interface UrlSignatureValidatorServiceInterface
{
    public function isValidSignedUrl(string $signedUrl): bool;
}
