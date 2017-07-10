<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Cat;
use App\News;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $arCats = Cat::all();
        $arNews = News::all();
        View::share(compact('arCats', 'arNews'));

        View::share('publicUrl', getenv('PUBLIC_TEMPLATES_URL'));
        View::share('adminUrl', getenv('ADMIN_TEMPLATES_URL'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
