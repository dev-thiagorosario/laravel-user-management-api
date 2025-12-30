<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Request;

class UrlSignatureValidatorService implements UrlSignatureValidatorServiceInterface
{
    public function isValidSignedUrl(string $signedUrl): bool
    {
        $request = Request::create($signedUrl, 'GET');
        return $request->hasValidSignature();
    }
}
