<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Database\Seeders\TestUsersSeeder;

class SeedTestUsers extends Command
{
    protected $signature = 'seed:test-users';
    protected $description = 'Создает 50 тестовых пользователей';

    public function handle()
    {
        $this->info('Создание тестовых пользователей...');
        
        $seeder = new TestUsersSeeder();
        $seeder->run();
        
        $this->info('Тестовые пользователи успешно созданы!');
    }
} 