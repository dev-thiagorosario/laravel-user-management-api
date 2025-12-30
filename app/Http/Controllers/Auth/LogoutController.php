<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Entities\ResponseJsend;
use App\Http\Controllers\Controller;
use App\Usecases\LogoutUsecaseInterface;
use Illuminate\Http\JsonResponse;

class LogoutController extends Controller
{
    public function __construct(
        protected readonly LogoutUsecaseInterface $logoutUsecase
) {}
    public function __invoke(): JsonResponse
    {
        try {
            $logout = $this->logoutUsecase;

            $logout();

            $data =[
                'message' => 'Logout Efetuado com sucesso'
            ];

            $response = new ResponseJsend($data);
            return response()
                ->json($response->toArray(), 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An unexpected error occurred.'], 500);
        }
    }
}
