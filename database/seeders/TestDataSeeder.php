<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        // Создаем тестовых пользователей
        for ($i = 1; $i <= 50; $i++) {
            $user = User::create([
                'name' => 'test_user_' . $i,
                'email' => 'test_user_' . $i . '@example.com',
                'password' => Hash::make('password'),
                'phone' => '+7' . rand(9000000000, 9999999999),
                'role' => rand(0, 1) ? 'user' : 'partner',
                'balance' => rand(0, 10000),
                'total_spent' => rand(0, 50000),
                'repeat_purchases' => rand(0, 10),
                'payment_rating' => rand(0, 100),
            ]);

            // Создаем тестовые аккаунты для каждого пользователя
            $accountCount = rand(1, 3); // 1-3 аккаунта на пользователя
            for ($j = 1; $j <= $accountCount; $j++) {
                Account::create([
                    'type' => rand(0, 1) ? 'yandex' : 'vk',
                    'subtype' => rand(0, 1) ? 'created' : 'added',
                    'login' => 'test_account_' . $i . '_' . $j,
                    'password' => 'test_password_' . $i . '_' . $j,
                    'oauth_token' => 'test_token_' . $i . '_' . $j,
                    'status' => rand(0, 1) ? 'active' : (rand(0, 1) ? 'archived' : 'paused'),
                    'user_id' => $user->id,
                    'balance' => rand(0, 5000),
                ]);
            }
        }
    }
} 