<?php

namespace App\Providers;

use App\Models\Tag;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Schema::defaultStringLength(125);

        View::composer('partials._search', function($view) {
            $tags = Tag::all();
            $view->with('tags', $tags);
        });

        View::composer('listings.create', function($view) {
            $tags = Tag::all();
            $view->with('tags', $tags);
        });
    }
}
