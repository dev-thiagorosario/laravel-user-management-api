<?php

namespace App\Providers;

use App\Repositories\CreateUserRepository;
use App\Repositories\CreateUserRepositoryInterface;
use App\Repositories\FindUserRepository;
use App\Repositories\FindUserRepositoryInterface;
use App\Repositories\LoginRepository;
use App\Repositories\LoginRepositoryInterface;
use App\Usecases\CreateUserUsecase;
use App\Usecases\CreateUserUsecaseInterface;
use App\Usecases\LoginUsecase;
use App\Usecases\LoginUsecaseInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CreateUserRepositoryInterface::class, CreateUserRepository::class);
        $this->app->bind(CreateUserUsecaseInterface::class, CreateUserUsecase::class);
        $this->app->bind(FindUserRepositoryInterface::class, FindUserRepository::class);
        $this->app->bind(LoginRepositoryInterface::class, LoginRepository::class);
        $this->app->bind(LoginUsecaseInterface::class, LoginUsecase::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
