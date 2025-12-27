<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeExceptionUser;

class InvalidCredentialsException extends \RuntimeException
{
    public function __construct(
        string $message = 'Credenciais invalidas',
        int $code = CodeExceptionUser::INVALID_CREDENTIALS->value,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
