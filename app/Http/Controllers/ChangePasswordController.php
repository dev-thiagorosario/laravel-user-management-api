<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\ChangePasswordInputDTO;
use App\Entities\ResponseJsend;
use App\Exceptions\InvalidCurrentPasswordException;
use App\Exceptions\UserNotFoundException;
use App\Http\Requests\ChangePasswordRequest;
use App\Usecases\ChangePasswordUsecaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    public function __construct(
        private readonly ChangePasswordUsecaseInterface $changePasswordUsecase,
    ){}

    public function __invoke(ChangePasswordRequest $request): JsonResponse
    {
        try {
            $data = $request->all();
            $data['userId'] = (int) Auth::id();

            $dto = ChangePasswordInputDTO::fromArray($data);

            $this->changePasswordUsecase->__invoke($dto);

            $response = new ResponseJsend(
                status: 'success',
                message: 'Senha alterada com sucesso!',
                code: 200
            );
            return response()->json($response->toArray(), 200);
        } catch (InvalidCurrentPasswordException $e) {
            $response = new ResponseJsend(
                status: 'error',
                message: $e->getMessage(),
                code: $e->getCode()
            );
            return response()->json($response->toArray(), 400);
        } catch (UserNotFoundException $e) {
            $response = new ResponseJsend(
                status: 'error',
                message: $e->getMessage(),
                code: $e->getCode()
            );
            return response()->json($response->toArray(), 404);
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
