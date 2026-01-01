<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\ChangePasswordInputDTO;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\password;

class PasswordVerifyService implements PasswordVerifyServiceInterface
{
   public function verify(string $password, string $hashedPassword): bool
   {
       return Hash::check($password, $hashedPassword);
   }
   
   public function hash(string $plainPassword): string
   {
       return Hash::make($plainPassword);
   }
}
