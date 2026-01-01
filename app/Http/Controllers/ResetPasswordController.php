<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\ResetPasswordInputDTO;
use App\Entities\ResponseJsend;
use App\Exceptions\UserNotFoundException;
use App\Usecases\ResetPasswordUsecaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    public function __construct(
        private readonly ResetPasswordUsecaseInterface $resetPasswordUsecase,
    ){}

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $data = $request->all();
            $data['userId'] = (int) Auth::id();
            $dto = ResetPasswordInputDTO::fromArray($data);

            ($this->resetPasswordUsecase)($dto);

            $response = new ResponseJsend(
                status: 'success',
                message: 'Senha resetada com sucesso!',
                code: 200
            );
            return response()->json($response->toArray(), 200);
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
