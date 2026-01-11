<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\ListUsersInputDTO;
use App\Entities\ResponseJsend;
use App\Exceptions\UserListException;
use App\Usecases\ListUserUsecaseInterface;
use Illuminate\Http\JsonResponse;

class ListUserController extends Controller
{
   public function __construct(
       private readonly ListUserUsecaseInterface $listUserUsecase
   ){}

    public function __invoke(): JsonResponse
    {
        try {
            $request = ListUsersInputDTO::fromArray(request()->all());

            $listUserUseCase = $this->listUserUsecase;

            $result = $listUserUseCase($request);

            $response = new ResponseJsend($result);

            return response()
                ->json($response->toArray(), 200);
        }catch (UserListException $e){

            $response = new ResponseJsend(
                status: 'error',
                message: $e->getMessage(),
                code: $e->getCode()
            );

            return response()
                ->json($response->toArray(), 500);
        } catch (\Exception $e){

            $response = new ResponseJsend(
                status: 'error',
                message: 'An unexpected error occurred.',
                code: 500
            );

            return response()
                ->json($response->toArray(), 500);
        }
    }
}
