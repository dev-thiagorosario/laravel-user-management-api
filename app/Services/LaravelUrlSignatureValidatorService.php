<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Request;

class LaravelUrlSignatureValidatorService implements LaravelUrlSignatureValidatorServiceInterface
{
    public function isValidSignedUrl(string $signedUrl): bool
    {
        $request = Request::create($signedUrl, 'GET');
        return $request->hasValidSignature();
    }
}
