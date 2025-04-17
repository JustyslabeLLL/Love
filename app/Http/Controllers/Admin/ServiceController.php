<?php

namespace App\Http\Controllers\Admin;

use App\Models\Master;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    // Список услуг
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    // Форма создания услуги
public function create()
{
    $masters = Master::all();
    return view('admin.services.create', compact('masters'));
}

    // Сохранение услуги
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:services,name',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'master_id' => 'required|exists:masters,id',
        ]);

        $service = Service::create($request->only(['name', 'price', 'duration']));

        // Привязываем мастера к услуге
        $service->masters()->sync($request->master_id);

        return redirect()->route('admin.dashboard')->with('success', 'Услуга успешно добавлена!');
    }

    // Форма редактирования услуги
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    // Обновление данных
    public function update(Request $request, Service $service)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            // Добавьте другие поля, если необходимо
        ]);

        $service->update($validatedData);

        return redirect()->route('services.index')->with('success', 'Услуга успешно обновлена!');
    }


    // Удаление услуги
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Услуга успешно удалена!');
    }
}
