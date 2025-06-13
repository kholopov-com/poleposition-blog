<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }
    public function store(Request $request): RedirectResponse
    {
$request->validate([
    'username' => ['required', 'string', 'min:6', 'regex:/^[А-Яа-яЁё\s\-]+$/u', 'unique:users'],
    'full_name' => ['required', 'regex:/^[А-Яа-яЁё\s\-]+$/u'],
    'phone' => ['required', 'regex:/^\+7\(\d{3}\)-\d{3}-\d{2}-\d{2}$/'],
    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    'password' => ['required', 'string', 'min:6', 'confirmed'],
], [
    'username.required' => 'Введите логин.',
    'username.min' => 'Логин должен быть не менее 6 символов.',
    'username.regex' => 'Логин должен содержать только кириллицу.',
    'username.unique' => 'Этот логин уже занят.',
    
    'full_name.required' => 'Введите ФИО.',
    'full_name.regex' => 'ФИО должно содержать только кириллицу и пробелы.',
    
    'phone.required' => 'Введите телефон.',
    'phone.regex' => 'Телефон должен быть в формате +7(XXX)-XXX-XX-XX.',
    
    'email.required' => 'Введите email.',
    'email.email' => 'Введите корректный email.',
    'email.unique' => 'Этот email уже зарегистрирован.',
    
    'password.required' => 'Введите пароль.',
    'password.min' => 'Пароль должен быть не менее 6 символов.',
    'password.confirmed' => 'Пароли не совпадают.',
]);
        $user = User::create([
            'username' => $request->username,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Auth::login($user);
        return $user->is_admin
            ? redirect()->route('dashboard')
            : redirect()->route('welcome');
    }
}