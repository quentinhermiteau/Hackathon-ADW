<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserDestroyRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(User::with('specializations.skills')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserStoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserStoreRequest $request)
    {
        return response()->json("Successfully created", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $user = User::with('specializations.skills')->where(['id' => $id])->first();
        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserUpdateRequest  $request
     * @param  \App\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->input());
        return response()->json("Successfully modified", 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Request\UserDestroyRequest $request
     * @param  \App\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(UserDestroyRequest $request, User $user)
    {
        $user->update(['status' => 'DISABLED']);
        return response()->json("Successfully deleted", 204);
    }
}
