<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDescribeRequest;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Describe;
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

        return redirect()->route('project.edit', ['project' => $project->id]);
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

    public function edit(Project $project)
    {
        return view('project.edit', ['project' => $project]);
    }

    public function storeDescribe(StoreDescribeRequest $request, Project $project)
    {
        $data = $request->validated();
        $lastDescribe = $project->describes->last();
        $describe = Describe::create(['title' => $data['title'], 'color' => $data['color'], 'content' => $data['content'], 'project_id' => $project->id, 'order' => isset($lastDescribe->order) ? $lastDescribe->order + 1 : 1]);
        if (isset($request->image)) {
            $image = $request->file('image')->store('projects/' . $project->id . '/', 'public');
            $describe->update(['image' => 'storage/' . $image]);
        }
        return redirect()->back();
    }

    public function describeOrder(Request $request, Describe $describe, $order)
    {
        $oldDescribe = Describe::where('project_id', $describe->project_id)->where('order', $order)->get()->first();
        $op = $order > $describe->order ? -1 : 1;
        $describe->update(['order' => $order]);
        $oldDescribe->update(['order' => $order + $op]);

        return redirect()->back();
    }

    public function describeDestroy(Describe $describe)
    {
        $project = $describe->project;

        $describe->delete();

        $describes = Describe::where('project_id', $project->id)->orderBy('order')->get();
        $i = 1;
        foreach ($describes as $item) {
            $item->update(['order' => $i]);
            $i++;
        }

        return redirect()->back();
    }
}
