<?php

namespace App\Http\Controllers;

use App\Requirement;
use App\RequirementUser;
use App\User;
use Illuminate\Http\Request;

class RequirementUserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(User $user, Requirement $requirement, Request $request)
    {
        $requirementUser = RequirementUser::where(['requirement_id' => $requirement->id, 'user_id' => $user->id])->first();

        $requirementUser->update(['status' => $request->status]);

        return response()->json("Updated", 204);
    }
}
