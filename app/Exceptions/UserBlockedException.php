<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeExceptionUser;

class UserBlockedException extends \RuntimeException
{
    public function __construct(
        \DateTimeInterface|string|null $blockedUntil = null,
        int $code = CodeExceptionUser::USER_BLOCKED->value,
        ?\Throwable $previous = null
    ) {
        $message = 'Usuario bloqueado';

        if ($blockedUntil instanceof \DateTimeInterface) {
            $message .= ' ate ' . $blockedUntil->format('Y-m-d H:i:s');
        } elseif (is_string($blockedUntil) && $blockedUntil !== '') {
            $message = $blockedUntil;
        }

        parent::__construct($message, $code, $previous);
    }
}
