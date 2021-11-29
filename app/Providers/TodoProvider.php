<?php

namespace App\Providers;

use App\Contracts\TodoInterface;
use App\Repositories\TodoRepository;
use Illuminate\Support\ServiceProvider;

class TodoProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TodoInterface::class, TodoRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
