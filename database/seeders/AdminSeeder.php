<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "username" => "Admin",
            "email" => "admin@gmail.com",
            "password" => "1",
            "role" => "admin"
        ]);
    }
}
