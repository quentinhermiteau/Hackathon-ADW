<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ReviewDestroyRequest;
use App\Http\Requests\ReviewRequest;
use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json("TODO: ReviewController@index", 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ReviewRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ReviewRequest $request)
    {
        return response()->json("TODO: ReviewController@store", 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review $review
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Review $review)
    {
        return response()->json("TODO: ReviewController@show", 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ReviewRequest $request
     * @param  \App\Review $review
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ReviewRequest $request, Review $review)
    {
        return response()->json("TODO: ReviewController@update", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\ReviewDestroyRequest  $review
     * @param  \App\Review  $review
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ReviewDestroyRequest $request, Review $review)
    {
        return response()->json("TODO: ReviewController@destroy", 200);
    }
}
