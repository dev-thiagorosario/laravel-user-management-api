<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\SendEmailConfirmationInputDTO;
use App\Entities\ResponseJsend;
use App\Entities\UserEntity;
use App\Exceptions\InvalidOrExpiredSignatureException;
use App\Exceptions\InvalidOrExpiredTokenException;
use App\Exceptions\EmailAlreadyVerifiedException;
use App\Exceptions\UserNotFoundException;
use App\Models\User;
use App\Usecases\SendEmailConfirmationUsecaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class SendEmailConfirmationController extends Controller
{
    public function __construct(
     private readonly SendEmailConfirmationUsecaseInterface $sendEmailConfirmationUsecase
    ){}

    public function __invoke(): JsonResponse
    {
        try {
            $user = Auth::user();

            if (!$user instanceof User) {
                $exception = new UserNotFoundException();
                $response = new ResponseJsend(
                    status: 'error',
                    message: $exception->getMessage(),
                    code: $exception->getCode()
                );

                return response()->json($response->toArray(), 404);
            }

            $userEntity = UserEntity::fromModel($user);

            $dto = new SendEmailConfirmationInputDTO(
                userId: $userEntity->getId(),
                name: (string) $userEntity->getName(),
                email: (string) $userEntity->getEmail()
            );

            $this->sendEmailConfirmationUsecase->__invoke($dto);

            $response = new ResponseJsend(
                status: 'success',
                message: 'Email enviado com sucesso!',
                code: 200
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
