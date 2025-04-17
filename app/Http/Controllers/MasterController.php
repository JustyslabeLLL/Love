<?php

namespace App\Http\Controllers;

use App\Models\Master;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function index()
    {
        $masters = Master::all();
        return view('masters.index', compact('masters'));
    }

    public function create()
    {
        return view('masters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Master::create($request->all());
        return redirect()->route('masters.index')->with('success', 'Мастер успешно добавлен!');
    }

    public function show(Master $master)
    {
        return view('masters.show', compact('master'));
    }

    public function edit(Master $master)
    {
        return view('masters.edit', compact('master'));
    }

    public function update(Request $request, Master $master)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $master->update($request->all());
        return redirect()->route('masters.index')->with('success', 'Мастер успешно обновлен!');
    }

    public function destroy(Master $master)
    {
        $master->delete();
        return redirect()->route('masters.index')->with('success', 'Мастер успешно удален!');
    }

    // MasterController.php
    public function getServices(Master $master)
    {
        return response()->json($master->services);
    }
}
