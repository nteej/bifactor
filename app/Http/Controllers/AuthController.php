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
class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $inputs = $request->validated();
        if (!auth('web')->attempt($inputs)) {
            return $this->respondUnAuthorized('Invalid credentials.Please try again with correct credentials.');
        }

        /** @var User $user */
        $user = Auth::user();
        $user->tokens()->delete();
        $token = $user->createToken($user->name);

        return $this->respondWithResource([
            'access_token' => $token->plainTextToken,
            'user' => new UserResource($user),
        ],'User login successful.');
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
