<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where("email", "admin@gmail.com")->first();

        if (!$user) {
            User::create([
                "name" => "Laur Bala",
                "email" => "admin@gmail.com",
                "role" => "admin",
                "password" => Hash::make('password')
            ]);
        }
    }
}
