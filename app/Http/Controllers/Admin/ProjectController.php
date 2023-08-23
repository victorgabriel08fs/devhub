<?php


namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

public function __construct() {
    $this->middleware('super-admin')->only(['index']);
}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projects = Project::search($request)->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        return view('project.index', ['projects' => $projects,'owner'=>false]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('project.show', ['project' => $project]);
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
