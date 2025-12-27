<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        for ($index = 1; $index <= 20; $index ++){
            User::create([
                'name' => 'User '.$index,
                'email' => 'user'.$index.'@gmail.com',
                'password' => bcrypt('Aa123456'),
                'email_verified_at' => Carbon::now(),
                'is_active' => true,
                'first_login' => false,
                'last_login' => Carbon::now()->subDays(rand(1, 15)),
            ]);
        }
    }
}
