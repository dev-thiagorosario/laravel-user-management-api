<?php

namespace App\Services;

class ResetPasswordProviderService implements ResetPasswordProviderServiceInterface
{
    public function provide(): string
    {
        $default = (string) config('security.default_reset_password', 'Padrao01');

        return $default;
    }
}
