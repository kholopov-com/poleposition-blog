<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\Page;

class PageRouteServiceProvider extends ServiceProvider
{
public function boot(): void
    {
        // Ждём, пока все статические маршруты будут зарегистрированы
        $this->app->booted(function () {
            Page::all()->each(function (Page $page) {
                // если маршрут с таким именем уже есть — пропускаем
                if (Route::has($page->slug)) {
                    return;
                }
                $uri = $page->slug === 'welcome' ? '/' : "/{$page->slug}";
                Route::get($uri, [\App\Http\Controllers\PageController::class, 'show'])
                     ->name($page->slug);
            });
        });
    }

protected function mapPageRoutes(): void
{
    try {
        $excludedSlugs = ['calendar', 'results', 'teams', 'circuits', 'blog'];
        $pages = Page::all();

        foreach ($pages as $page) {
            if (in_array($page->slug, $excludedSlugs)) {
                continue; // пропускаем эти маршруты
            }

            Route::get($page->slug === 'welcome' ? '/' : '/' . $page->slug, [
                \App\Http\Controllers\PageController::class, 'show'
            ])->name($page->slug);
        }
    } catch (\Throwable $e) {
        logger()->error("Ошибка при генерации маршрутов страниц: " . $e->getMessage());
    }
}

}
