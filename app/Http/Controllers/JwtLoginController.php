<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class JwtLoginController extends Controller
{
    /**
     * @param \App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $foundUser = User::where(["email" => $request->email, "status" => "ENABLED"])->first();

        if (!$foundUser) {
            return response()->json("User not found", 404);
        }

        if (!Hash::check($request->password, $foundUser->password)) {
            return response()->json("Bad credentials", 401);
        }

        $httpHost = $request->getHttpHost();
        $today = new \DateTime();
        $issuedAt = $today->format("U");
        $notBefore = $today->modify("+1 second")->format("U");
        $expire = $today->modify("+1 hour")->format("U");

        $payload = [
            "iss" => $httpHost,
            "aud" => $httpHost,
            "iat" => $issuedAt,
            "nbf" => $notBefore,
            "data" => [
                "id" => $foundUser->id
            ],
            "exp" => $expire
        ];

        $key = env("APP_KEY", false);

        if (!$key) {
            return response()->json("Internal Server Error", 500);
        }

        return response()->json(Crypt::encryptString(JWT::encode($payload, $key)), 200);
    }
}
