<?php

namespace Modules\User\Application\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Modules\Shared\Application\Http\Controllers\Controller;
use Modules\User\Application\Http\Requests\UserRegistrationRequest;
use Modules\User\Domain\Services\UserService;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */
    public function login(): JsonResponse
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function register(UserRegistrationRequest $request, UserService $userService): JsonResponse
    {
        $token = $userService->register($request->getDto());

        return response()->json([
            'message' => 'User successfully registered',
            'token' => $token,
        ], 200);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }
}
