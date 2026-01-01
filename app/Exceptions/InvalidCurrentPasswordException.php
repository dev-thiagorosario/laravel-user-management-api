<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeExceptionUser;

class InvalidCurrentPasswordException extends \RuntimeException
{
    public function __construct(
        string $message = 'Senha atual invalida',
        int $code = CodeExceptionUser::INVALID_CURRENT_PASSWORD->value,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
