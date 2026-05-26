<?php

use Carbon\Laravel\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider {
    public function boot(): void {
        Paginator::useBootstrapFive();
    }
}

return [
    App\Providers\AppServiceProvider::class,
];