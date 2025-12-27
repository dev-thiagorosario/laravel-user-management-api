<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\UserCreateException;
use App\Http\Requests\CreateUserRequest;
use App\Entities\ResponseJsend;
use App\DTO\CreateUserDTO;
use Illuminate\Http\JsonResponse;
use App\Usecases\CreateUserUsecaseInterface;

class CreateUserController extends Controller
{
    public function __construct(
        private CreateUserUsecaseInterface $createUserUsecase
    ){}

    public function __invoke(CreateUserRequest $request): JsonResponse
    {
        try {
            $dto = CreateUserDTO::fromArray($request->validated());

            $result = $this->createUserUsecase->__invoke($dto);

            $response = new ResponseJsend($result->toArray());

            return response()->json($response->toArray(), 201);
        } catch (UserCreateException $e) {
            $response = new ResponseJsend(
                status: 'error',
                message: $e->getMessage(),
                code: $e->getCode()
            );

            return response()->json($response->toArray(), 500);
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
