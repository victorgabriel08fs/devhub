<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show($user)
    {
        $user = User::findOrFail($user);
        return response()->json(['message' => 'User retrivied', 'user' => $user]);
    }

    public function projects($username)
    {
        $user = User::where('username', $username)->get()->first();
        if (!isset($user->id))
            return response()->json(['message' => 'User does not exists']);
        $projects = $user->projects;
        return response()->json(['message' => 'Projects retrivied', 'projects' => $projects]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
