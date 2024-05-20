<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 1; $i++) {

            $admin = new User();
            $admin->name = 'andrea';
            $admin->email = 'test@example.com';
            $admin->password = 'password';
            $admin->save();
        }
    }
}
