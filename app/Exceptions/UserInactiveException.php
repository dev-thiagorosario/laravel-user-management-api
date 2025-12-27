<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeExceptionUser;

class UserInactiveException extends \RuntimeException
{
    public function __construct(
        string $message = 'Usuario inativo',
        int $code = CodeExceptionUser::USER_INACTIVE->value,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
