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
            return response()->json([
                'message' => 'Não foi possível cadastrar o usuário '
            ], status: 403);
        }

        return response()->json([
            'message'   => 'Sucesso',
            'user'      => $user,
            'status'    => 200
        ], 200);
    }

    public function login(Request $request): JsonResponse
    {
        try {
            $response = $this->userServices->findOne($request);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return response()->json([
            'status'    => 'success',
            'data'      => [
                'token' => $response,
                'token_type' => 'Bearer',
            ],
        ], 200);
    }

    public function update(Request $request): JsonResponse
    {
        try {
            $response = $this->userServices->update($request);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return response()->json([
            'status'    => 'success',
            'data'      => $response,
            'message'   => "Usuário atualizado com sucesso!",
        ], 200);
    }

    public function authUser(): JsonResponse    
    {
        try {
            $user = $this->userServices->authUser();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível resgatar usuário'
            ], status: 500);
        }

        return response()->json([
            'message' => 'success',
            'user' => $user,
        ], 200);
    }

}
