<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RoleSeeder::class,
            LibrarySeeder::class,
            CategorySeeder::class,
        ]);

        \App\Models\User::factory(10)->create(['role_id'=>1]);
        \App\Models\User::factory(10)->create(['role_id'=>2]);
        \App\Models\Book::factory(20)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
