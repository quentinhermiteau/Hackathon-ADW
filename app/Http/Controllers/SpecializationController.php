<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SpecializationDestroyRequest;
use App\Http\Requests\SpecializationRequest;
use App\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json("TODO: SpecializationController@index", 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SpecializationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SpecializationRequest $request)
    {
        return response()->json("TODO: SpecializationController@store", 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Specialization $specialization
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Specialization $specialization)
    {
        return response()->json("TODO: SpecializationController@show", 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SpecializationRequest $request
     * @param  \App\Specialization $specialization
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SpecializationRequest $request, Specialization $specialization)
    {
        return response()->json("TODO: SpecializationController@update", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Request\SpecializationDestroyRequest $request
     * @param  \App\Specialization $specialization
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(SpecializationDestroyRequest $request, Specialization $specialization)
    {
        return response()->json("TODO: SpecializationController@destroy", 200);
    }
}
