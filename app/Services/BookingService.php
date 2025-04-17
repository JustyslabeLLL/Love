<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use App\Models\Master;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Support\Facades\Log;

class BookingService
{
    public function getAvailableSlots($masterId, $serviceId)
    {
        try {
            $service = Service::findOrFail($serviceId);
            $master = Master::findOrFail($masterId);

            $startDate = now()->startOfDay();
            $endDate = now()->addDays(14)->endOfDay();

            // Получаем бронирования с актуальными данными
            $bookings = Booking::with(['service' => function($query) {
                    $query->select('id', 'name', 'duration');
                }])
                ->where('master_id', $masterId)
                ->whereBetween('booking_date', [$startDate, $endDate])
                ->get(['id', 'master_id', 'service_id', 'booking_date']);

            \Log::debug('Bookings found', ['count' => $bookings->count()]);

            $slots = [];
            $workingHours = ['09:00', '21:00'];
            $breakTimes = ['13:00' => '13:30'];

            for ($day = 0; $day < 14; $day++) {
                $currentDate = $startDate->copy()->addDays($day);

                if ($currentDate->isWeekend()) {
                    continue;
                }

                $startWork = Carbon::parse($currentDate->format('Y-m-d') . ' ' . $workingHours[0]);
                $endWork = Carbon::parse($currentDate->format('Y-m-d') . ' ' . $workingHours[1]);

                for ($time = $startWork; $time <= $endWork->subMinutes($service->duration); $time->addMinutes(15)) {
                    $slotEnd = $time->copy()->addMinutes($service->duration);

                    // Проверка на обед
                    $isBreak = false;
                    $breakStart = Carbon::parse($currentDate->format('Y-m-d') . ' 13:00');
                    $breakEnd = Carbon::parse($currentDate->format('Y-m-d') . ' 13:30');

                    if ($time < $breakEnd && $slotEnd > $breakStart) {
                        $isBreak = true;
                    }

                    if (!$isBreak) {
                        $isAvailable = true;

                        foreach ($bookings as $booking) {
                            $bookingEnd = $booking->booking_date->copy()->addMinutes($booking->service->duration);

                            if ($time < $bookingEnd && $slotEnd > $booking->booking_date) {
                                $isAvailable = false;
                                break;
                            }
                        }

                        if ($isAvailable) {
                            $slots[] = [
                                'title' => $service->name . ' (' . $service->duration . ' мин)',
                                'start' => $time->format('Y-m-d H:i:s'),
                                'end' => $slotEnd->format('Y-m-d H:i:s'),
                                'color' => '#28a745',
                                'extendedProps' => [
                                    'isAvailable' => true,
                                    'service' => $service->name,
                                    'duration' => $service->duration
                                ]
                            ];
                        }
                    }
                }
            }

            \Log::debug('Slots generated', ['count' => count($slots)]);
            return $slots;

        } catch (\Exception $e) {
            \Log::error('Error in getAvailableSlots: ' . $e->getMessage());
            return [];
        }
    }
    protected function isDuringBreak($start, $end, $date, $breakTimes)
    {
        foreach ($breakTimes as $breakStart => $breakEnd) {
            $breakStart = Carbon::parse($date->format('Y-m-d') . ' ' . $breakStart);
            $breakEnd = Carbon::parse($date->format('Y-m-d') . ' ' . $breakEnd);

            if ($start < $breakEnd && $end > $breakStart) {
                return true;
            }
        }
        return false;
    }

    protected function isSlotAvailable($start, $end, $bookings)
    {
        foreach ($bookings as $booking) {
            $bookingStart = $booking->booking_date;
            $bookingEnd = $bookingStart->copy()->addMinutes($booking->service->duration);

            // Проверка на полное или частичное пересечение
            if ($start < $bookingEnd && $end > $bookingStart) {
                return false;
            }
        }
        return true;
    }

    protected function createAvailableSlot($start, $end, $service)
    {
        return [
            'title' => $service->name . ' (' . $service->duration . ' мин)',
            'start' => $start->toDateTimeString(),
            'end' => $end->toDateTimeString(),
            'color' => '#00C851',
            'extendedProps' => [
                'isAvailable' => true,
                'serviceName' => $service->name,
                'duration' => $service->duration
            ]
        ];
    }

    protected function createBookedSlot($booking)
    {
        $end = $booking->booking_date->copy()->addMinutes($booking->service->duration);
        return [
            'title' => $booking->service->name . ' (Занято)',
            'start' => $booking->booking_date->toDateTimeString(),
            'end' => $end->toDateTimeString(),
            'color' => '#ff4444',
            'extendedProps' => [
                'isAvailable' => false,
                'serviceName' => $booking->service->name,
                'duration' => $booking->service->duration
            ]
        ];
    }
}
