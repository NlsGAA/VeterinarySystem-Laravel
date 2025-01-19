<?php

namespace App\Services;

use App\Http\Requests\Api\AuthRequest;
use App\Models\User;
use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class UserServices 
{
    public function __construct(
        private UserRepository $userRepository,
    ){
    }

    public function index($request)
    {
        return $this->userRepository->getAll($request);
    }

    public function create(AuthRequest $request)
    {    
        $user = User::create([
            'email'     => $request->email,
            'name'      => $request->name,
            'password'  => Hash::make($request->password)
        ]);
    
        return $user;
    }

    public function update(Request $request)
    {
        $user = $this->userRepository->findOne($request->id);
        $user->update($request->all());
        return $user;
    }

    public function findOne(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if(!Auth::attempt($credentials)) {
            throw new InvalidArgumentException('Email/Senha incorretos!');
        }
        
        $user = User::where('email', $request->email)->first();
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;
        return $token;
    }

    public function authUser()
    {
        return Auth::user();
    }
}