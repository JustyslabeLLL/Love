<?php

namespace Database\Seeders;

use App\Models\Master;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterServiceTableSeeder extends Seeder
{
    public function run()
    {
        // Очищаем таблицу связей
        DB::table('master_service')->truncate();

        // Для каждого мастера привязываем случайные услуги
        Master::each(function ($master) {
            $services = \App\Models\Service::inRandomOrder()
                ->limit(rand(5, 10))
                ->pluck('id');

            $master->services()->attach($services);
        });
    }
}
