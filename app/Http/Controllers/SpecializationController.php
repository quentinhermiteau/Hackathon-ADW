<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SpecializationRequest;
use App\Http\Requests\SpecializationDeleteRequest;
use App\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json("TODO: SpecializationController@index", 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecializationRequest $request)
    {
        return response()->json("TODO: SpecializationController@store", 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function show(Specialization $specialization)
    {
        return response()->json("TODO: SpecializationController@show", 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function update(SpecializationRequest $request, Specialization $specialization)
    {
        return response()->json("TODO: SpecializationController@update", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecializationDeleteRequest $specialization)
    {
        return response()->json("TODO: SpecializationController@destroy", 200);
    }
}
