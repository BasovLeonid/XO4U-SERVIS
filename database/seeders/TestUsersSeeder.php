<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Создаем 50 тестовых пользователей
        for ($i = 1; $i <= 50; $i++) {
            $user = User::create([
                'name' => "test_user_{$i}",
                'email' => "test_user_{$i}@example.com",
                'password' => Hash::make('password'),
                'phone' => "+7" . rand(9000000000, 9999999999),
                'role' => 'user',
                'balance' => rand(1000, 10000),
                'total_spent' => rand(1000, 50000),
                'repeat_purchases' => rand(0, 10),
                'payment_rating' => rand(1, 5),
            ]);

            // Для каждого пользователя создаем 1-3 аккаунта
            $accountCount = rand(1, 3);
            for ($j = 1; $j <= $accountCount; $j++) {
                Account::create([
                    'user_id' => $user->id,
                    'type' => rand(0, 1) ? 'yandex_direct' : 'vk_ads',
                    'subtype' => rand(0, 1) ? 'business' : 'personal',
                    'login' => "test_account_{$i}_{$j}",
                    'password' => "test_password_{$i}_{$j}",
                    'oauth_token' => "test_token_{$i}_{$j}",
                    'status' => 'active',
                    'balance' => rand(1000, 10000),
                ]);
            }
        }
    }
} 