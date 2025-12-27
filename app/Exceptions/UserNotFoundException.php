<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeExceptionUser;

class UserNotFoundException extends \RuntimeException
{
    public function __construct(
        string $message = 'Usuario nao encontrado',
        int $code = CodeExceptionUser::USER_NOT_FOUND->value,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
