<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;

class LoginRepository implements LoginRepositoryInterface
{
    public function markLoggedIn(User $user): User
    {
        $user->last_login = Carbon::now();

        if ($user->first_login === true){
            $user->first_login = false;
        }

        $user->save();

        return $user->fresh();
    }

    public function createToken(User $user): string
    {
        return $user->createToken('auth_token')->plainTextToken;
    }
}
