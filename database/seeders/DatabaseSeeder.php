<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Создание тестового пользователя
        //User::factory()->create([
        //    'name' => 'Test User',
        //    'email' => 'test@example.com',
        //]);

        $this->call([
            UserSeeder::class,
            TestUsersSeeder::class,
            SiteTemplateSeeder::class,
            TestTemplateSeeder::class,
        ]);
    }
}
