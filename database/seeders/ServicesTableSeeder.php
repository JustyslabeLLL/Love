<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $services = [
            // Маникюрные услуги
            ['name' => 'Маникюр классический без покрытия', 'price' => 0, 'duration' => 30,],
            ['name' => 'Маникюр с покрытием', 'price' => 0, 'duration' => 90,],
            ['name' => 'Маникюр комбинированный', 'price' => 0, 'duration' => 45,],
            ['name' => 'Маникюр гель-лак + укрепление', 'price' => 0, 'duration' => 90,],
            ['name' => 'Снятие + маникюр + гель-лак', 'price' => 0, 'duration' => 90,],
            ['name' => 'Снятие + гель-лак', 'price' => 0, 'duration' => 15,],

            // Педикюрные услуги
            ['name' => 'Педикюр классический без покрытия', 'price' => 0, 'duration' => 45,],
            ['name' => 'Педикюр комбинированный', 'price' => 0, 'duration' => 50,],
            ['name' => 'Педикюр + гель-лак', 'price' => 0, 'duration' => 80,],
            ['name' => 'Снятие педикюр + покрытия гель-лак', 'price' => 0, 'duration' => 90,],

            // Дополнительные услуги
            ['name' => 'Ремонт ногтя / 1 ногтя', 'price' => 0, 'duration' => 15,],
            ['name' => 'Спа-уход руки / ноги', 'price' => 0, 'duration' => 20,],
            ['name' => 'Выравнивание ногтевой пластины базовой', 'price' => 0, 'duration' => 15,],
            ['name' => 'Укрепление гель', 'price' => 0, 'duration' => 30,],

            // Брови
            ['name' => 'Коррекция брови и окрашивание', 'price' => 0, 'duration' => 30,],
            ['name' => 'Коррекция брови', 'price' => 0, 'duration' => 15,],

            // Депиляция
            ['name' => 'Депиляция верхняя губа', 'price' => 0, 'duration' => 5,],
            ['name' => 'Депиляция подбородок сахар', 'price' => 0, 'duration' => 5,],
            ['name' => 'Депиляция голень воск / сахар', 'price' => 0, 'duration' => 30,],
            ['name' => 'Депиляция бедро воск / сахар', 'price' => 0, 'duration' => 30,],
            ['name' => 'Депиляция руки полностью воск / сахар', 'price' => 0, 'duration' => 30,],
            ['name' => 'Депиляция руки до локтя воск / сахар', 'price' => 0, 'duration' => 15,],
            ['name' => 'Депиляция ноги полностью воск / сахар', 'price' => 0, 'duration' => 60,],
            ['name' => 'Депиляция глубоко бикини сахар', 'price' => 0, 'duration' => 30,],
            ['name' => 'Депиляция подмышки', 'price' => 0, 'duration' => 15,],
        ];

        foreach ($services as $service) {
            DB::table('services')->updateOrInsert(
                ['name' => $service['name']],
                $service
            );
        }
    }
}
