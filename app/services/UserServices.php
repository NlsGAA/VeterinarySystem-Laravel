<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\AuthRequest;
use App\Repositories\Users\UserRepository;

class UserServices
{
    public function __construct(
        private UserRepository $userRepository,
    ){
    }

    /**
     * Display a list of all users
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        return $this->userRepository->getAll($request);
    }

    /**
     * Create a new user
     *
     * @param AuthRequest $request
     * @return User
     */
    public function create(AuthRequest $request)
    {
        $user = User::create([
            'email'     => $request->email,
            'name'      => $request->name,
            'password'  => Hash::make($request->password)
        ]);

        return $user;
    }

    /**
     * Update a user
     *
     * @param Request $request
     * @return User
     */
    public function update(Request $request)
    {
        $user = $this->userRepository->findOne($request->id);
        $user->update($request->all());
        return $user;
    }

    /**
     * Delete a user
     *
     * @param Request $request
     * @return User
     */
    public function findOne(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if(!Auth::attempt($credentials)) {
            throw new \InvalidArgumentException('Email/Senha incorretos!');
        }

        $user = User::where('email', $request->email)->first();
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;
        return $token;
    }

    /**
     * Display the authenticated user
     *
     * @return array
     */
    public function authUser(): array
    {
        return Auth::user()->toArray();
    }
}