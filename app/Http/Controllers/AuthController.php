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
            $token = $this->userServices->findOne($request);
        } catch (Exception $e) {
            throw new Exception('Usuário inválido ' . $e);
        }

        return response()->json([
            'message'   => 'success',
            'data'      => [
                'token' => $token,
                'token_type' => 'Bearer'
            ],
            'status' => 200,
        ], 200);
    }

}
