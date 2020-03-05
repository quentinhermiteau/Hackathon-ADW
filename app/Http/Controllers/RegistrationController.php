<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\User;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\RegistrationRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(RegistrationRequest $request)
    {
        $request->merge([
            "role" => "LEARNER",
            "password" => Hash::make($request->password)
        ]);

        User::create($request->input());

        return response()->json("Created", 201);
    }
}
