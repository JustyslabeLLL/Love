<?php

namespace Database\Seeders;

use App\Models\Master;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlotsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('slots')->truncate(); // Очищаем таблицу перед заполнением

        $masters = Master::all();
        $services = Service::all();
        $daysToGenerate = 14; // Генерируем слоты на 2 недели вперед
        $workingHours = ['start' => 9, 'end' => 21]; // Рабочие часы с 9 до 21

        foreach ($masters as $master) {
            foreach ($services as $service) {
                $currentDate = Carbon::now()->startOfDay();

                for ($day = 0; $day < $daysToGenerate; $day++) {
                    $date = $currentDate->copy()->addDays($day);

                    // Генерируем слоты с шагом 15 минут в рабочих часах
                    for ($hour = $workingHours['start']; $hour < $workingHours['end']; $hour++) {
                        for ($minute = 0; $minute < 60; $minute += 15) {
                            $startTime = $date->copy()->setTime($hour, $minute);
                            $endTime = $startTime->copy()->addMinutes($service->duration);

                            // Проверяем, что слот не выходит за рабочие часы
                            if ($endTime->hour >= $workingHours['end'] && $endTime->minute > 0) {
                                continue;
                            }

                            DB::table('slots')->insert([
                                'master_id' => $master->id,
                                'service_id' => $service->id,
                                'start_time' => $startTime,
                                'end_time' => $endTime,
                                'is_available' => true,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            }
        }
    }
}
