<?php

namespace App\Providers;

use App\Repositories\CreateUserRepository;
use App\Repositories\CreateUserRepositoryInterface;
use App\Repositories\ChangePasswordRepository;
use App\Repositories\ChangePasswordRepositoryInterface;
use App\Repositories\EmailConfirmationTokenRepository;
use App\Repositories\EmailConfirmationTokenRepositoryInterface;
use App\Repositories\FindUserRepository;
use App\Repositories\FindUserRepositoryInterface;
use App\Repositories\LoginRepository;
use App\Repositories\LoginRepositoryInterface;
use App\Repositories\ListUserRepository;
use App\Repositories\ListUserRepositoryInterface;
use App\Repositories\LogoutRepository;
use App\Repositories\LogoutRepositoryInterface;
use App\Repositories\UpdateUserRepository;
use App\Repositories\UpdateUserRepositoryInterface;
use App\Usecases\LogoutUsecase;
use App\Usecases\LogoutUsecaseInterface;
use App\Usecases\CreateUserUsecase;
use App\Usecases\CreateUserUsecaseInterface;
use App\Usecases\ChangePasswordUsecase;
use App\Usecases\ChangePasswordUsecaseInterface;
use App\Usecases\LoginUsecase;
use App\Usecases\LoginUsecaseInterface;
use App\Usecases\ListUserUsecase;
use App\Usecases\ListUserUsecaseInterface;
use App\Usecases\UpdateUserUsecase;
use App\Usecases\UpdateUserUsecaseInterface;
use App\Usecases\SendEmailConfirmationUsecase;
use App\Usecases\SendEmailConfirmationUsecaseInterface;
use App\Services\EmailConfirmationLinkGeneratorService;
use App\Services\EmailConfirmationHashValidatorService;
use App\Services\EmailConfirmationHashValidatorServiceInterface;
use App\Services\EmailConfirmationLinkGeneratorServiceInterface;
use App\Services\PasswordHasherService;
use App\Services\PasswordHasherServiceInterface;
use App\Services\PasswordVerifyService;
use App\Services\PasswordVerifyServiceInterface;
use App\Services\ResetPasswordProviderService;
use App\Services\ResetPasswordProviderServiceInterface;
use App\Services\TokenGuardService;
use App\Services\TokenGuardServiceInterface;
use App\Services\TokenGeneratorService;
use App\Services\TokenGeneratorServiceInterface;
use App\Services\UrlSignatureValidatorService;
use App\Services\UrlSignatureValidatorServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Usecases\ConfirmEmailUsecase;
use App\Usecases\ConfirmEmailUsecaseInterface;
use App\Usecases\ResetPasswordUsecase;
use App\Usecases\ResetPasswordUsecaseInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CreateUserRepositoryInterface::class, CreateUserRepository::class);
        $this->app->bind(CreateUserUsecaseInterface::class, CreateUserUsecase::class);

        $this->app->bind(ChangePasswordRepositoryInterface::class, ChangePasswordRepository::class);
        $this->app->bind(ChangePasswordUsecaseInterface::class, ChangePasswordUsecase::class);
        $this->app->bind(PasswordHasherServiceInterface::class, PasswordHasherService::class);
        $this->app->bind(PasswordVerifyServiceInterface::class, PasswordVerifyService::class);

        $this->app->bind(FindUserRepositoryInterface::class, FindUserRepository::class);

        $this->app->bind(LoginRepositoryInterface::class, LoginRepository::class);
        $this->app->bind(LoginUsecaseInterface::class, LoginUsecase::class);

        $this->app->bind(ListUserRepositoryInterface::class, ListUserRepository::class);
        $this->app->bind(ListUserUsecaseInterface::class, ListUserUsecase::class);

        $this->app->bind(UpdateUserRepositoryInterface::class, UpdateUserRepository::class);
        $this->app->bind(UpdateUserUsecaseInterface::class, UpdateUserUsecase::class);

        $this->app->bind(LogoutRepositoryInterface::class, LogoutRepository::class);
        $this->app->bind(LogoutUsecaseInterface::class, LogoutUsecase::class);

        $this->app->bind(EmailConfirmationTokenRepositoryInterface::class, EmailConfirmationTokenRepository::class);
        $this->app->bind(EmailConfirmationLinkGeneratorServiceInterface::class, EmailConfirmationLinkGeneratorService::class);
        $this->app->bind(TokenGeneratorServiceInterface::class, TokenGeneratorService::class);
        $this->app->bind(TokenGuardServiceInterface::class, TokenGuardService::class);
        $this->app->bind(UrlSignatureValidatorServiceInterface::class, UrlSignatureValidatorService::class);
        $this->app->bind(EmailConfirmationHashValidatorServiceInterface::class, EmailConfirmationHashValidatorService::class);
        $this->app->bind(SendEmailConfirmationUsecaseInterface::class, SendEmailConfirmationUsecase::class);

        $this->app->bind(ConfirmEmailUsecaseInterface::class, ConfirmEmailUsecase::class);

        $this->app->bind(ResetPasswordUsecaseInterface::class, ResetPasswordUsecase::class);
        $this->app->bind(ResetPasswordProviderServiceInterface::class, ResetPasswordProviderService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
