<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeExceptionUser;

class UpdateUserException extends \RuntimeException
{
    public function __construct(
        string $message = "Erro ao atualizar usuario",
        int $code = CodeExceptionUser::USER_UPDATE_ERROR->value,
        ?\Throwable $previous = null
    ){
        parent::__construct($message, $code, $previous);
    }
}
