<?php

namespace App\Http\Controllers\Api;

use App\Actions\Auth\AttemptLogin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request, AttemptLogin $attemptLogin): JsonResponse
    {
        $validated = $request->validated();
        $user = $attemptLogin->execute($validated['email'], $validated['password']);

        if (! $user) {
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')],
            ]);
        }

        $token = $user->createToken($validated['device_name'] ?? 'api-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $accessToken = $request->user()->currentAccessToken();

        if ($accessToken) {
            $accessToken->delete();
        }

        return response()->json([
            'message' => 'Logged out successfully.',
        ]);
    }
}
