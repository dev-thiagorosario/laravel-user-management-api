<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeExceptionUser;

class UserListException extends \RuntimeException
{
        public function __construct(
        string $message = 'Erro ao listar usuários',
        int $code = CodeExceptionUser::LIST_USER_ERROR->value,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
