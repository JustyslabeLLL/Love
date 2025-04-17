<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Запуск всех сидеров.
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            MastersTableSeeder::class,
            ServicesTableSeeder::class,
            MasterServiceTableSeeder::class,
            SlotsTableSeeder::class,
            // BookingsTableSeeder должен идти последним, если он есть
        ]);
    }
}
