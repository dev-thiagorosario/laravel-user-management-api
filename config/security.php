<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Password Settings
    |--------------------------------------------------------------------------
    |
    | Configuration used when the system needs to reset a user's password.
    | This password should be temporary and combined with a forced password
    | change on the next login.
    |
    */

    'default_reset_password' => env(
        'DEFAULT_RESET_PASSWORD',
        'Padrao01'
    ),

    /*
    |--------------------------------------------------------------------------
    | Force Password Change After Reset
    |--------------------------------------------------------------------------
    |
    | If true, users will be forced to change their password on the next login
    | after a reset performed by the system or an administrator.
    |
    */

    'force_password_change_on_reset' => true,
];
