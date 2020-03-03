<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\User;

class JwtLoginController extends Controller
{
    public function login(Request $request)
    {
        $foundUser = User::find([ "email" => $request->email, "status" => "ENABLED" ]);

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

        $payload = [
            "iss" => $httpHost,
            "aud" => $httpHost,
            "iat" => $issuedAt,
            "nbf" => $notBefore,
            "data" => [
                "id" => $foundUser->id
            ]
        ];

        $key = env("APP_KEY", false);

        if (!$key) {
            return response()->json("Internal Server Error", 500);
        }

        return response()->json(Crypt::encryptString(JWT::encode($payload, $key), 200));
    }
}
