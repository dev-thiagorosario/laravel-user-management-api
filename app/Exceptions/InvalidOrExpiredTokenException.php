<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeExceptionUser;

class InvalidOrExpiredTokenException extends \RuntimeException
{
    public function __construct(
        string $message = 'Token invalido ou expirado',
        int $code = CodeExceptionUser::INVALID_OR_EXPIRED_TOKEN->value,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
