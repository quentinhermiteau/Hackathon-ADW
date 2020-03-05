<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequirementDestroyRequest;
use App\Http\Requests\RequirementRequest;
use App\Requirement;
use Illuminate\Http\Request;

class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Requirement::with('specialization')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RequirementRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RequirementRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Requirement  $requirement
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Requirement $requirement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RequirementRequest  $request
     * @param  \App\Requirement  $requirement
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RequirementRequest $request, Requirement $requirement)
    {
        $requirement->update($request->input());
        return response()->json("Successfully modified", 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\RequirementDestroyRequest $request
     * @param  \App\Requirement  $requirement
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RequirementDestroyRequest $request, Requirement $requirement)
    {
        $requirement->delete();
        return response()->json("Successfully deleted", 204);
    }
}
