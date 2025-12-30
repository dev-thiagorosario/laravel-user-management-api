<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeExceptionUser;

class EmailAlreadyVerifiedException extends \RuntimeException
{
    public function __construct(
        string $message = 'Email ja verificado',
        int $code = CodeExceptionUser::EMAIL_ALREADY_VERIFIED->value,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
