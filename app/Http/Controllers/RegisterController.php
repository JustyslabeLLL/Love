<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create() {
        return view('auth.registration');
    }
    public function store(Request $request){
        $request->validate([
            'name' => ['regex:/^[А-Яа-я\- ]{1,}$/u', 'required'],
            'email'=>['email', 'unique:users', 'required'],
            'password'=>['min:3', 'required'],
        ]);

        $user = User::create([
        'name'=> $request->name,
        'email'=> $request->email,
        'password'=> bcrypt($request->password),
        'is_admin' => false, // По умолчанию пользователь не администратор
        ]);

        Auth::login($user);
        $request->session()->regenerate();
        return redirect('/')->with('info', value: 'Вы успешно зарегистрировались!');
    }

// выход с профиля
    public function logout(){
        Auth::logout();
        return redirect('/')->with('info','Выход выполнен!');
    }

// авторизация
    public function authorization(){
        return view('auth.authorization');
    }

// авторизация
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        if (Auth::user()->isAdmin()) {
            // Администратор перенаправляется на админ-панель
            return redirect()->route('admin.dashboard')->with('info', 'Вы вошли как администратор!');
        } else {
            // Обычный пользователь перенаправляется на главный экран
            return redirect('/')->with('info', 'Вход выполнен!');
        }
    }

    return back()->withErrors([
        'email' => 'Неверные учетные данные.',
    ]);
}

public function logoutToHome(Request $request)
{
    Auth::logout(); // Выход пользователя

    $request->session()->invalidate(); // Очистка сессии
    $request->session()->regenerateToken(); // Регенерация CSRF-токена

    return redirect('/')->with('info', 'Вы вышли из системы.'); // Перенаправление на главный экран
}
}

class AuthenticatedSessionController extends Controller
{
    // Форма входа
    public function create()
    {
        return view('auth.authorization');
    }

    // Обработка входа
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Перенаправление в админ-панель
            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'email' => 'Неверные учетные данные.',
        ]);
    }

    // Выход из системы
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

        public function logoutToHome(Request $request)
    {
        Auth::logout(); // Выход пользователя

        $request->session()->invalidate(); // Очистка сессии
        $request->session()->regenerateToken(); // Регенерация CSRF-токена

        return redirect('/')->with('info', 'Вы вышли из системы.'); // Перенаправление на главный экран
    }
}

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.registration');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false, // По умолчанию пользователь не администратор
        ]);

        return redirect('/login')->with('success', 'Регистрация прошла успешно!');
    }
}
