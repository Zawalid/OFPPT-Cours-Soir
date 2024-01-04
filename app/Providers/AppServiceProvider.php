<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\Filier;
use App\Models\Evenement;
use App\Models\Article;
use Illuminate\Database\Eloquent\Relations\Relation;

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
    Relation::morphMap([
        'filier' => Filier::class,
        'evenement' => Evenement::class,
        'article' => Article::class,
    ]);
    }
}
