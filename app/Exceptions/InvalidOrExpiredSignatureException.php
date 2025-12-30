<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeExceptionUser;

class InvalidOrExpiredSignatureException extends \RuntimeException
{
    public function __construct(
        string $message = 'Assinatura invalida ou expirada',
        int $code = CodeExceptionUser::INVALID_OR_EXPIRED_SIGNATURE->value,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
