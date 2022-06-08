<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            User::NAME  =>  "admin",
            User::EMAIL =>  "admin@admin.com",
            User::PASSWORD => Hash::make("password")
        ]);
    }
}
