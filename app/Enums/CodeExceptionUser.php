<?php

declare(strict_types=1);

namespace App\Enums;

enum CodeExceptionUser: int
{
    case USER_CREATE_ERROR = 1001;
    case USER_NOT_FOUND = 1002;
    case USER_LIST_ERROR = 1003;
    case INVALID_CREDENTIALS = 1004;
    case LOGIN_OR_PASSWORD_INVALID = 1005;
    case USER_INACTIVE = 1006;
    case USER_BLOCKED = 1007;
    case INVALID_OR_EXPIRED_SIGNATURE = 1008;
    case INVALID_OR_EXPIRED_TOKEN = 1009;
    case EMAIL_ALREADY_VERIFIED = 1010;
    case INVALID_CURRENT_PASSWORD = 1011;
}
