<?php

namespace App\Http\Controllers\Admin;

use App\Models\Master;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Services\BookingService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function create()
    {
        $masters = Master::all();
        $services = Service::all();
        return view('admin.bookings.create', compact('masters', 'services'));
    }

    public function index()
    {
        $bookings = Booking::all();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'master_id' => 'required|exists:masters,id',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date_format:d.m.Y',
            'booking_time' => 'required|date_format:H:i',
            'client_name' => 'required|string|max:255',
            'client_phone' => 'required|string|max:20',
            'email' => 'required|email',
        ]);

        try {
            $bookingDateTime = Carbon::createFromFormat('d.m.Y H:i', $validatedData['booking_date'] . ' ' . $validatedData['booking_time']);
        } catch (\Exception $e) {
            return back()->withErrors(['booking_date' => 'Неверный формат даты или времени.'])->withInput();
        }

        // Проверка доступности слота
        $service = Service::find($validatedData['service_id']);
        $endTime = $bookingDateTime->copy()->addMinutes($service->duration);

        $isAvailable = !Booking::where('master_id', $validatedData['master_id'])
            ->where(function($query) use ($bookingDateTime, $endTime) {
                $query->whereBetween('booking_date', [$bookingDateTime, $endTime])
                      ->orWhere(function($query) use ($bookingDateTime, $endTime) {
                          $query->where('booking_date', '<', $bookingDateTime)
                                ->whereRaw('DATE_ADD(booking_date, INTERVAL (SELECT duration FROM services WHERE id = bookings.service_id) MINUTE) > ?', [$bookingDateTime]);
                      });
            })
            ->exists();

        if (!$isAvailable) {
            return back()->withErrors(['booking_time' => 'Выбранное время уже занято.'])->withInput();
        }

        // Создаем бронирование
        $booking = new Booking();
        $booking->master_id = $validatedData['master_id'];
        $booking->service_id = $validatedData['service_id'];
        $booking->booking_date = $bookingDateTime;
        $booking->client_name = $validatedData['client_name'];
        $booking->client_phone = $validatedData['client_phone'];
        $booking->email = $validatedData['email'];
        $booking->save();

        return redirect()->route('bookings.index')->with('success', 'Запись успешно создана!');
    }

// app/Http/Controllers/BookingController.php
public function slotsJson(Request $request)
{
    try {
        $masterId = $request->query('master_id');
        $serviceId = $request->query('service_id');

        if (!$masterId || !$serviceId) {
            return response()->json([]); // Если мастер или услуга не выбраны, возвращаем пустой массив
        }

        // Получаем доступные слоты
        $events = $this->bookingService->getAvailableSlots($masterId, $serviceId);

        // Логируем данные
        Log::info('Generated slots:', ['events' => $events]);

        return response()->json($events); // Возвращаем слоты в формате JSON
    } catch (\Exception $e) {
        Log::error('Error in slotsJson:', ['error' => $e->getMessage()]);
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Бронирование успешно удалено!');
    }

    public function getAvailableSlots(Request $request)
    {
        $request->validate([
            'master_id' => 'required|exists:masters,id',
            'service_id' => 'required|exists:services,id'
        ]);

        // Принудительно обновляем соединение с БД
        DB::reconnect();

        return response()->json(
            $this->bookingService->getAvailableSlots(
                $request->master_id,
                $request->service_id
            )
        );
    }

    public function getServices(Master $master)
    {
        return response()->json($master->services);
    }
}
