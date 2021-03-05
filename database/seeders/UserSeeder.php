<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;

        $user->name = "admin";
        $user->email = "admin@gmail.com";
        $user->password = "admin123";
        $user->role = "admin";
        $user->status = "0";
        $user->save();

        $user = new User;

        $user->name = "alex";
        $user->email = "alex@gmail.com";
        $user->password = "alex1234";
        $user->role = "user";
        $user->status = "0";
        $user->save();
    }
}
