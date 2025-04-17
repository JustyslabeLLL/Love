<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Master;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Services\BookingService;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    /**
     * Отображает список всех бронирований.
     */
    public function index()
    {
        $bookings = Booking::where('email', auth()->user()->email)->get();
        return view('bookings.index', compact('bookings'));
    }

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Отображает форму для создания нового бронирования.
     */
// BookingController.php
    public function create()
    {
        $masters = Master::with('services')->get();
        return view('bookings.create', compact('masters'));
    }

    /**
     * Сохраняет новое бронирование в базе данных.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'master_id' => 'required|exists:masters,id',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date_format:d.m.Y',
            'booking_time' => 'required|date_format:H:i',
            'client_name' => 'required|string|max:255',
            'client_phone' => 'required|string|max:20',
            'email' => 'required|email'
        ]);

        // Создаем объект DateTime для бронирования
        $bookingDateTime = Carbon::createFromFormat(
            'd.m.Y H:i',
            $validated['booking_date'] . ' ' . $validated['booking_time']
        );

        // Получаем длительность услуги
        $service = Service::find($validated['service_id']);
        $bookingEnd = $bookingDateTime->copy()->addMinutes($service->duration);

        // Проверка на пересечение с другими бронированиями
        $isAvailable = !Booking::where('master_id', $validated['master_id'])
            ->where(function($query) use ($bookingDateTime, $bookingEnd) {
                $query->whereBetween('booking_date', [$bookingDateTime, $bookingEnd])
                      ->orWhere(function($query) use ($bookingDateTime, $bookingEnd) {
                          $query->where('booking_date', '<', $bookingDateTime)
                                ->whereRaw('DATE_ADD(booking_date, INTERVAL (SELECT duration FROM services WHERE id = bookings.service_id) MINUTE) > ?', [$bookingDateTime]);
                      });
            })
            ->exists();

        if (!$isAvailable) {
            return back()->withErrors(['booking_time' => 'Выбранное время уже занято.'])->withInput();
        }

        // Создание бронирования
        Booking::create([
            'master_id' => $validated['master_id'],
            'service_id' => $validated['service_id'],
            'booking_date' => $bookingDateTime,
            'client_name' => $validated['client_name'],
            'client_phone' => $validated['client_phone'],
            'email' => $validated['email'],
            'total_duration' => $service->duration // Добавляем длительность из услуги
        ]);

        return redirect()->route('bookings.index')->with('success', 'Бронирование создано!');
    }

    /**
     * Отображает информацию о конкретном бронировании.
     */
    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    /**
     * Отображает форму для редактирования бронирования.
     */
    public function edit(Booking $booking)
    {
        $masters = Master::all();
        $services = Service::all();
        return view('bookings.edit', compact('booking', 'masters', 'services'));
    }

    /**
     * Обновляет бронирование в базе данных.
     */
    public function update(Request $request, Booking $booking)
{
    // Проверяем, что $booking существует
    if (!$booking) {
        return redirect()->route('bookings.index')->with('error', 'Бронирование не найдено.');
    }

    // Проверяем, что у бронирования есть связанная услуга
    if (!$booking->service) {
        return redirect()->route('bookings.index')->with('error', 'Услуга для этого бронирования не найдена.');
    }

    // Валидация данных
    $request->validate([
        'master_id' => 'required|exists:masters,id',
        'service_id' => 'required|exists:services,id',
        'booking_date' => 'required|date_format:d.m.Y', // Формат даты
        'booking_time' => 'required|date_format:H:i',   // Формат времени
        'client_name' => 'required|string|max:255',
        'client_phone' => 'required|string|max:20',
    ]);

    // Объединяем дату и время
    try {
        $bookingDateTime = Carbon::createFromFormat('d.m.Y H:i', $request->booking_date . ' ' . $request->booking_time);
    } catch (\Exception $e) {
        return back()->withErrors([
            'booking_date' => 'Неверный формат даты или времени.',
        ])->withInput();
    }

    // Проверяем, что $bookingDateTime был успешно создан
    if (!$bookingDateTime) {
        return back()->withErrors([
            'booking_date' => 'Не удалось обработать дату и время.',
        ])->withInput();
    }

    // Проверяем, занят ли мастер в это время (исключая текущее бронирование)
    $existingBooking = Booking::where('master_id', $request->master_id)
        ->where('id', '!=', $booking->id) // Исключаем текущее бронирование
        ->where(function ($query) use ($bookingDateTime, $booking) {
            $query->where('booking_date', '<', $bookingDateTime->copy()->addMinutes($booking->service->duration))
                  ->whereRaw('DATE_ADD(booking_date, INTERVAL (SELECT duration FROM services WHERE id = bookings.service_id) MINUTE) > ?', [$bookingDateTime]);
        })
        ->exists();

    if ($existingBooking) {
        return back()->withErrors([
            'booking_time' => 'Мастер уже занят на это время. Выберите другой интервал.'
        ])->withInput();
    }

    // Обновляем бронирование
    $booking->update([
        'master_id' => $request->master_id,
        'service_id' => $request->service_id,
        'booking_date' => $bookingDateTime,
        'client_name' => $request->client_name,
        'client_phone' => $request->client_phone,
    ]);

    return redirect()->route('bookings.index')->with('success', 'Бронирование успешно обновлено!');
}
    /**
     * Удаляет бронирование из базы данных.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Бронирование успешно удалено!');
    }

        public function getServices(Master $master)
    {
        // Возвращаем услуги мастера в формате JSON
        return response()->json($master->services);
    }


}

