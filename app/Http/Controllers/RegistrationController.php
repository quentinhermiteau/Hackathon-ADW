<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Requirement;
use App\RequirementUser;
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

        $user = User::create($request->input());

        $requirements = Requirement::where(['specialization_id' => $request->specialization_id])->get();

        foreach ($requirements as $requirement) {
            RequirementUser::create(['requirement_id' => $requirement->id, 'user_id' => $user->id]);
        }

        return response()->json("Created", 201);
    }
}
