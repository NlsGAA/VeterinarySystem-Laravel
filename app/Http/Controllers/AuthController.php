<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\UserServices;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthRequest;

//4|IpTDLDusunMszovdIk6tXvqBo2raSG5FCfn2QKIp69c394eb
class AuthController extends Controller
{
    public function __construct(
        protected UserServices $userServices
    ){
    }

    public function register(AuthRequest $request): JsonResponse
    {
        try {
            $user = $this->userServices->create($request);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 403);
        }

        return $this->sendResponse("Usuário cadastrado com sucesso!", $user);
    }

    public function login(Request $request): JsonResponse
    {
        try {
            $response = $this->userServices->findOne($request);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse("Usuário logado com sucesso!", [
            'token' => $response,
            'token_type' => 'Bearer',
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        try {
            $response = $this->userServices->update($request);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse("Usuário atualizado com sucesso!", $response->toArray());
    }

    public function authUser(): JsonResponse
    {
        try {
            $user = $this->userServices->authUser();
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage());
        }

        return $this->sendResponse("Usuário autenticado com sucesso!", $user);
    }

}
