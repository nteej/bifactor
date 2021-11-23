<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 *Authentication handler
 */
class AuthController extends APIController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $inputs = $request->validated();
        if (!auth('web')->attempt($inputs)) {
            return $this->respondNotOk([
                'error' => 'Login failed.',
            ]);
        }

        /** @var User $user */
        $user = Auth::user();
        $user->tokens()->delete();
        $token = $user->createToken($user->name);

        return $this->respondOk([
            'access_token' => $token->plainTextToken,
            'user' => new UserResource($user),
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function me(Request $request)
    {
        return $request->user();
    }

    public function logout(LogoutRequest $request): JsonResponse
    {
        $request->user()->tokens()->delete();
        return $this->respondOk([]);
    }
}
