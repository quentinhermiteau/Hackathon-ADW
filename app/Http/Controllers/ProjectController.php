<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProjectDestroyRequest;
use App\Http\Requests\ProjectRequest;
use App\Project;
use App\ProjectSpecialization;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Project::with(["agent", "referent"])->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProjectRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProjectRequest $request)
    {
        $project = Project::create($request->input());
        $request->merge(['project_id' => $project->id]);
        ProjectSpecialization::create($request->input());

        return response()->json("Created", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Project $project)
    {
        return response()->json($project, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProjectRequest $request
     * @param  \App\Project $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->input());

        return response()->json("Updated", 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\ProjectDestroyRequest $request
     * @param  \App\Project $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ProjectDestroyRequest $request, Project $project)
    {
        $project->delete();

        return response()->json("Delete", 204);
    }
}
