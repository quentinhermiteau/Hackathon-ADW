<?php

namespace App\Http\Controllers;

use App\ProjectUser;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectUserRequest;

class ProjectUserController extends Controller
{
    public function __invoke(ProjectUserRequest $request)
    {
        $projectUser = ProjectUser::where([
            "user_id" => $request->user_id,
            "project_id" => $request->project_id
        ])->first();

        if (!$projectUser) {
            ProjectUser::create([
                "positioned" => true,
                "user_id" => $request->user_id,
                "project_id" => $request->project_id
            ]);

            return response()->json("Created", 201);
        }

        $projectUser->delete();

        return response()->json("Modified", 200);
    }
}
