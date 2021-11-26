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
     * @OA\Post(
     * path="/login",
     * summary="Sign in",
     * description="Login by email, password",
     * operationId="authLogin",
     * tags={"Authentication"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="nteeje@gmail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="password")
     *    ),
     * ),
     *  @OA\Response(
     *          response=401,
     *          description="Invalid credentials.Please try again with correct credentials.",
     *  ),
     * @OA\Response(
     *    response=422,
     *    description="Unprocessable Entity",
     *    @OA\JsonContent(
     *      @OA\Property(property="success", type="boolean", example="false")
     *        ),
     *       @OA\Property(property="message", type="string", example="The given data was invalid.")
     *        ),
     *      @OA\Property(property="data", type="array", example="[]")
     *        )
     *     )
     * )
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
     * @OA\Post(
     * path="/register",
     * operationId="Register",
     * tags={"Authentication"},
     * summary="User Register",
     * description="User Register here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"name","email", "password", "password_confirmation"},
     *               @OA\Property(property="name", type="text"),
     *               @OA\Property(property="email", type="text"),
     *               @OA\Property(property="password", type="password"),
     *               @OA\Property(property="password_confirmation", type="password")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Register Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Register Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'mobile_number' => 'required',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $success['token'] =  $user->createToken('authToken')->accessToken;
        $success['name'] =  $user->name;
        return response()->json(['success' => $success]);
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
