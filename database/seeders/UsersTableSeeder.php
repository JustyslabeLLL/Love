<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Запуск сидера.
     */
    public function run()
    {
        // Создаем пользователя-админа, если его нет
        User::firstOrCreate(
            ['email' => 'admin@example.com'], // Проверяем по email
            [
                'name' => 'Admin',
                'password' => Hash::make('password'), // Пароль: password
                'is_admin' => 1, // Администратор
            ]
        );

        // Создаем тестового пользователя, если его нет
        User::firstOrCreate(
            ['email' => 'user@example.com'], // Проверяем по email
            [
                'name' => 'Test User',
                'password' => Hash::make('password'), // Пароль: password
                'is_admin' => 0, // Обычный пользователь
            ]
        );
    }
}
