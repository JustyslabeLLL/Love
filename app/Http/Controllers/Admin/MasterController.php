<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Master;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    // Список мастеров
    public function index()
    {
        $masters = Master::all();
        return view('admin.masters.index', compact('masters'));
    }

    // Форма создания мастера
    public function create()
    {
        return view('admin.masters.create');
    }

    // Сохранение мастера
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:masters,name',
            'description' => 'nullable|string',
        ]);

        Master::create($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Мастер успешно добавлен!');
    }

    // Форма редактирования мастера
    public function edit(Master $master)
    {
        return view('admin.masters.edit', compact('master'));
    }

    // Обновление данных
    public function update(Request $request, Master $master)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            // Добавьте другие поля, если необходимо
        ]);

        $master->update($validatedData);

        return redirect()->route('masters.index')->with('success', 'Мастер успешно обновлен!');
    }

    // Удаление мастера
    public function destroy(Master $master)
    {
        $master->delete();
        return redirect()->route('masters.index')->with('success', 'Мастер успешно удален!');
    }

    public function getServices(Master $master)
    {
        return response()->json($master->services);
    }
}
