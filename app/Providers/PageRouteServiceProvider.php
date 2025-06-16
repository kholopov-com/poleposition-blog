<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\Page;

class PageRouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Отложенная загрузка маршрутов после загрузки всех сервисов
        $this->app->booted(function () {
            $this->mapPageRoutes();
        });
    }

    protected function mapPageRoutes(): void
    {
        try {
            $pages = Page::all();

            foreach ($pages as $page) {
                Route::get($page->slug === 'welcome' ? '/' : '/' . $page->slug, [
                    \App\Http\Controllers\PageController::class, 'show'
                ])->name($page->slug);
            }
        } catch (\Throwable $e) {
            // Не паникуем в момент сборки, если БД недоступна
            logger()->error("Ошибка при генерации маршрутов страниц: " . $e->getMessage());
        }
    }
}
