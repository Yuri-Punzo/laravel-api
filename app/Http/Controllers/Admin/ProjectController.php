<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->get();
        //dd($projects);
        return view("admin.projects.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $val_data = $request->validated();

        $project_slug = Project::generateSlug($val_data['title']);
        $val_data['slug'] = $project_slug;

        $project = Project::create($val_data);
        if ($request->has('technologies')) {
            $project->technologies()->attach($val_data['technologies']);
        }

        //dd($project);

        return to_route('admin.projects.index')->with('message', "$project->title added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $val_data = $request->validated();

        $project_slug = Project::generateSlug($val_data['title']);
        $val_data['slug'] = $project_slug;

        $project->update($val_data);
        if ($request->has('technologies')) {
            $project->technologies()->sync($val_data['technologies']);
        } else {
            $project->technologies()->sync([]);
        }

        return to_route('admin.projects.index')->with('message', "$project->title update successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.projects.index')->with('message', "$project->title deleted successfully");
    }
}
