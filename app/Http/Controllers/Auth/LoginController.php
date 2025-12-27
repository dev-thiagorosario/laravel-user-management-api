<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Entities\ResponseJsend;
use App\DTO\LoginInputDTO;
use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\UserBlockedException;
use App\Exceptions\UserInactiveException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Traits\PresentLoginTrait;
use App\Usecases\LoginUsecaseInterface;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    use PresentLoginTrait;

    public function __construct(
        private readonly LoginUsecaseInterface $loginUsecase
    ){}

    public function __invoke(LoginRequest $request): JsonResponse
    {
        try {
            $dto = LoginInputDTO::fromArray($request->validated());

            $auth = $this->loginUsecase->__invoke($dto);

            $data = $this->initializePresentLoginTrait($auth);
            
            $response = new ResponseJsend($data);

            return response()
                ->json($response->toArray(), 200);
        } catch (InvalidCredentialsException $e) {
            $response = new ResponseJsend(
                status: 'error',
                message: $e->getMessage(),
                code: $e->getCode()
            );

            return response()->json($response->toArray(), 401);
        } catch (UserInactiveException|UserBlockedException $e) {
            $response = new ResponseJsend(
                status: 'error',
                message: $e->getMessage(),
                code: $e->getCode()
            );

            return response()->json($response->toArray(), 403);
        } catch (\Exception $e) {
            $response = new ResponseJsend(
                status: 'error',
                message: 'An unexpected error occurred.',
                code: 500
            );
            return response()->json($response->toArray(), 500);
        }
    }
}
