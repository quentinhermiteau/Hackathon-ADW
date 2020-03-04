<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SkillDestroyRequest;
use App\Http\Requests\SkillRequest;
use App\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json("TODO: SkillController@index", 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SkillRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SkillRequest $request)
    {
        return response()->json("TODO: SkillRequest@store", 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Skill $skill)
    {
        return response()->json("TODO: SkillRequest@show", 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SkillRequest $request
     * @param  \App\Skill $skill
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SkillRequest $request, Skill $skill)
    {
        return response()->json("TODO: SkillRequest@update", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\SkillDestroyRequest $request
     * @param  \App\Skill $skill
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(SkillDestroyRequest $request, Skill $skill)
    {
        return response()->json("TODO: SkillRequest@destroy", 200);
    }
}
