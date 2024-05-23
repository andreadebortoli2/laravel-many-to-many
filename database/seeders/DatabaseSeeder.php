<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Type;
use Illuminate\Database\Seeder;
use Database\Seeders\ProjectSeeder;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\TypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(
            [TypeSeeder::class, ProjectSeeder::class, AdminUserSeeder::class]
        );
    }
}
