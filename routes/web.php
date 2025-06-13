<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DashboardApplicationController;
use App\Models\Application;
use App\Http\Controllers\CabinetController;

// Публичные страницы
Route::get('/', [PageController::class, 'show'])->name('welcome');
Route::get('/about', [PageController::class, 'show'])->name('about');
Route::get('/services', [PageController::class, 'show'])->name('services');
Route::get('/news', [PageController::class, 'show'])->name('news');
Route::get('/contacts', [PageController::class, 'show'])->name('contacts');

// Админка (только для админа)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [PageController::class, 'editAll'])->name('dashboard');
    Route::post('/dashboard', [PageController::class, 'updateAll'])->name('dashboard.update');

    Route::get('/dashboard/applications', [DashboardApplicationController::class, 'index'])->name('applications.index');
    Route::post('/dashboard/applications/{id}/approve', [DashboardApplicationController::class, 'approve'])->name('applications.approve');
    Route::post('/dashboard/applications/{id}/reject', [DashboardApplicationController::class, 'reject'])->name('applications.reject');
});

// Пользовательские страницы
Route::middleware('auth')->group(function () {
    Route::get('/cabinet', [CabinetController::class, 'index'])->name('cabinet');
    Route::post('/cabinet/delete/{id}', [CabinetController::class, 'delete'])->name('cabinet.delete');

    Route::get('/application', fn () => view('application'))->name('application');
    Route::post('/application', function (Request $request) {
        $validated = $request->validate([
            'author' => 'required|string|min:2',
            'title' => 'required|string|min:2',
            'type' => 'required|in:' . implode(',', array_keys(config('book.types'))),
            'publisher' => 'nullable|string',
            'year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'cover' => 'nullable|in:' . implode(',', config('book.covers')),
            'condition' => 'nullable|in:' . implode(',', config('book.conditions')),
        ]);

        \App\Models\Application::create(array_merge($validated, [
            'user_id' => auth()->user()->id,
            'status' => 'новая',
        ]));

        return redirect('/application')->with('success', 'Заявка успешно отправлена.');
    });
});

// Аутентификация
require __DIR__.'/auth.php';
