<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function projects(Request $request, $username)
    {
        $user = User::where('username', $username)->get()->first();
        if (!isset($user->id)) {
            return redirect()->back();
        }
        $projects = Project::search($request)->where('user_id', $user->id)->when(auth()->id() != $user->id && !auth()->user()->hasRole('Super Admin'), function ($q) {
            return $q->where('visibility', 'Public');
        })->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        return view('project.index', ['projects' => $projects, 'owner' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('project.show', ['project' => $project]);
    }

    public function store(StoreProjectRequest $request)
    {
        function formatSlug($name)
        {
            $slug = strtolower($name);
            $slug = str_replace(' ', '_', $slug);
            return $slug;
        }

        $data = $request->validated();

        $data['slug'] = formatSlug($data['name']);
        $data['user_id'] = auth()->id();

        $project = Project::create($data);

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->back();
    }
}
