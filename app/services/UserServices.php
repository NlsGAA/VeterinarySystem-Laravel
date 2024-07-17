<?php

namespace App\Services;

use App\Http\Requests\Api\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserServices 
{
    public function create(AuthRequest $request)
    {    
        $user = User::create([
            'email'     => $request->email,
            'name'      => $request->name,
            'password'  => Hash::make($request->password)
        ]);
    
        return $user;
    }

    public function findOne(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password))
        {
            throw ValidationException::withMessages([
                'data' => 'Email/Senha incorretos'
            ]);
        }

        // desloga o usuário de todos outros dispositivos
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;

        return $token;
    }
}