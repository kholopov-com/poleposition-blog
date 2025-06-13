<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NewPasswordController extends Controller
{
    /**
     * Показать форму сброса пароля
     */
    public function create(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    /**
     * Обработать сброс пароля
     */
    public function store(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => [
                'required',
                'string',
                'min:6',
                'regex:/[A-ZА-ЯЁ]/u',
                'confirmed',
            ],
        ], [
            'email.required' => 'Введите email.',
            'email.email' => 'Введите корректный email.',
            'password.required' => 'Введите новый пароль.',
            'password.min' => 'Пароль должен быть не короче 6 символов.',
            'password.regex' => 'Пароль должен содержать хотя бы одну заглавную букву.',
            'password.confirmed' => 'Пароли не совпадают.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
                Auth::login($user);
            }
        );

if ($status !== Password::PASSWORD_RESET) {
return back()->withErrors([
    'system' => match ($status) {
        Password::INVALID_TOKEN => 'Ссылка устарела или недействительна. Запросите новую.',
        Password::INVALID_USER => 'Пользователь с таким email не найден.',
        default => 'Ошибка сброса пароля. Попробуйте ещё раз.',
    },
])->withInput();
}

    return redirect()->intended(
        auth()->user()->is_admin ? '/dashboard' : '/cabinet'
    )->with('status', 'Пароль успешно обновлён.');
    }
}
