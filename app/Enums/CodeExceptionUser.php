<?php

declare(strict_types=1);

namespace App\Enums;

enum CodeExceptionUser: int
{
    case USER_CREATE_ERROR = 1001;
    case USER_NOT_FOUND = 1002;
    case USER_LIST_ERROR = 1003;
}
