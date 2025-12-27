<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeExceptionUser;

class UserCreateException extends \RuntimeException
{
    public function __construct(
        string $message = "Erro ao criar um usuario",
        int $code = CodeExceptionUser::USER_CREATE_ERROR->value,
        ?\Throwable $previous = null
    ){
        parent::__construct($message, $code, $previous);
    }
}
