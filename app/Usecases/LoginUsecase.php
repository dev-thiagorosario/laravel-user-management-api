<?php

declare(strict_types=1);

namespace App\Usecases;

use App\DTO\LoginInputDTO;
use App\Entities\AuthEntity;
use App\Entities\UserEntity;
use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\UserBlockedException;
use App\Exceptions\UserInactiveException;
use App\Exceptions\UserNotFoundException;
use App\Repositories\FindUserRepositoryInterface;
use App\Repositories\LoginRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class LoginUsecase implements LoginUsecaseInterface
{
    public function __construct(
        private readonly FindUserRepositoryInterface $findUserRepository,
        private readonly LoginRepositoryInterface $loginRepository
    ){}

    public function __invoke(LoginInputDTO $dto): AuthEntity
    {
        try {
            $user = $this->findUserRepository->findByEmail($dto->email);
        } catch (UserNotFoundException) {
            throw new InvalidCredentialsException();
        }

        if (!Hash::check($dto->password, $user->password)) {
            throw new InvalidCredentialsException();
        }

        if (!$user->is_active){
            throw new UserInactiveException();
        }

        if ($user->blocked_until !== null){
            $now = Carbon::now();

            if ($now->lessThan($user->blocked_until)){
                throw new UserBlockedException($user->blocked_until);
            }
        }

        $user = $this->loginRepository->markLoggedIn($user);

        $token = $this->loginRepository->createToken($user);

        return (new AuthEntity())
            ->setToken($token)
            ->setUserId($user->id)
            ->setUser(UserEntity::fromModel($user));
    }
}
