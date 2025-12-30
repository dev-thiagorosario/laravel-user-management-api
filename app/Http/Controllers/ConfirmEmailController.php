<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\ConfirmEmailInputDTO;
use App\Entities\ResponseJsend;
use App\Exceptions\EmailAlreadyVerifiedException;
use App\Exceptions\InvalidOrExpiredSignatureException;
use App\Exceptions\InvalidOrExpiredTokenException;
use App\Usecases\ConfirmEmailUsecaseInterface;
use App\Exceptions\UserNotFoundException;
use App\Http\Requests\ConfirmEmailRequest;
use Illuminate\Http\JsonResponse;

class ConfirmEmailController extends Controller
{
    public function __construct(
        private readonly ConfirmEmailUsecaseInterface $confirmEmailUsecase
    ){}

    public function __invoke(ConfirmEmailRequest $request): JsonResponse
    {
        try {
            $dto = ConfirmEmailInputDTO::fromArray($request->validated());

            $this->confirmEmailUsecase->__invoke($dto);
            $response = new ResponseJsend(
                status: 'success',
                message: 'Email confirmado com sucesso!',
            );
            return response()->json($response->toArray(), 200);
        } catch (InvalidOrExpiredSignatureException $e){
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
        } catch (InvalidOrExpiredTokenException $e){
            $response = new ResponseJsend(
                status: 'error',
                message: $e->getMessage(),
                code: $e->getCode()
            );
            return response()->json($response->toArray(), 400);
        } catch (EmailAlreadyVerifiedException $e) {
            $response = new ResponseJsend(
                status: 'error',
                message: $e->getMessage(),
                code: $e->getCode()
            );
            return response()->json($response->toArray(), 400);
        }catch (\Exception $e) {
            return response()->json(['message' => 'An unexpected error occurred.'], 500);
        }
    }
}
