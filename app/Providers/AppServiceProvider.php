<?php

namespace App\Providers;

use App\Repositories\CreateUserRepository;
use App\Repositories\CreateUserRepositoryInterface;
use App\Repositories\EmailConfirmationTokenRepository;
use App\Repositories\EmailConfirmationTokenRepositoryInterface;
use App\Repositories\FindUserRepository;
use App\Repositories\FindUserRepositoryInterface;
use App\Repositories\LoginRepository;
use App\Repositories\LoginRepositoryInterface;
use App\Repositories\LogoutRepository;
use App\Repositories\LogoutRepositoryInterface;
use App\Usecases\LogoutUsecase;
use App\Usecases\LogoutUsecaseInterface;
use App\Usecases\CreateUserUsecase;
use App\Usecases\CreateUserUsecaseInterface;
use App\Usecases\LoginUsecase;
use App\Usecases\LoginUsecaseInterface;
use App\Usecases\SendEmailConfirmationUsecase;
use App\Usecases\SendEmailConfirmationUsecaseInterface;
use App\Services\EmailConfirmationLinkGeneratorService;
use App\Services\LinkGeneratorServiceInterface;
use App\Services\TokenGeneratorService;
use App\Services\TokenGeneratorServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Usecases\ConfirmEmailUsecase;
use App\Usecases\ConfirmEmailUsecaseInterface;


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

        $this->app->bind(LogoutRepositoryInterface::class, LogoutRepository::class);
        $this->app->bind(LogoutUsecaseInterface::class, LogoutUsecase::class);

        $this->app->bind(EmailConfirmationTokenRepositoryInterface::class, EmailConfirmationTokenRepository::class);
        $this->app->bind(LinkGeneratorServiceInterface::class, EmailConfirmationLinkGeneratorService::class);
        $this->app->bind(TokenGeneratorServiceInterface::class, TokenGeneratorService::class);
        $this->app->bind(SendEmailConfirmationUsecaseInterface::class, SendEmailConfirmationUsecase::class);

        $this->app->bind(ConfirmEmailUsecaseInterface::class, ConfirmEmailUsecase::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
