<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\UpdateUserInputDTO;
use App\Entities\ResponseJsend;
use App\Exceptions\UpdateUserException;
use App\Exceptions\UserNotFoundException;
use App\Http\Requests\UpdateUserRequest;
use App\Usecases\UpdateUserUsecaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UpdateUserController extends Controller
{
    public function __construct(
        private readonly UpdateUserUsecaseInterface $updateUserUseCase
    ){}

    public function __invoke(UpdateUserRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $data['userId'] = (int) Auth::id();

            $dto = UpdateUserInputDTO::fromArray($data);

            $result = $this->updateUserUseCase->__invoke($dto);

            $response = new ResponseJsend($result->toArray());

            return response()->json($response->toArray(), 200);
        } catch (UserNotFoundException $e) {
            $response = new ResponseJsend(
                status: 'error',
                message: $e->getMessage(),
                code: $e->getCode()
            );

            return response()->json($response->toArray(), 404);
        } catch (UpdateUserException $e) {
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
