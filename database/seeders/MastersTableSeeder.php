<?php

namespace Database\Seeders;

use App\Models\Master;
use Illuminate\Database\Seeder;

class MastersTableSeeder extends Seeder
{
    public function run()
    {
        // Очищаем таблицу перед заполнением
        Master::query()->delete();

        $masters = [
            [
                'name' => 'Анна',
                'description' => 'Специалист по маникюру и педикюру'
            ],
            [
                'name' => 'Мария',
                'description' => 'Мастер депиляции'
            ],
            [
                'name' => 'Елена',
                'description' => 'Специалист по наращиванию ногтей'
            ],
            [
                'name' => 'Ольга',
                'description' => 'Универсальный мастер'
            ]
        ];

        foreach ($masters as $master) {
            Master::create($master);
        }
    }
}
