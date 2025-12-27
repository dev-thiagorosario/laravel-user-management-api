<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeExceptionUser;

class LoginOrPasswordInvalidException extends \RuntimeException
{
    public function __construct(
        string $message = 'Login ou senha invalidos',
        int $code = CodeExceptionUser::LOGIN_OR_PASSWORD_INVALID->value,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
