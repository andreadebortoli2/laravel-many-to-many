<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.projects.index', ['projects' => Project::orderByDesc('id')->paginate(8)], compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        // validate data
        $validated = $request->validated();

        // add image to storage
        if ($request->has('image')) {
            $image = Storage::put('project-images', $request['image']);
            $validated['image'] = $image;
        }

        // create and add slug
        $slug = Str::slug($request->title, '-');
        $validated['slug'] = $slug;

        $project = Project::create($validated);

        // add connection to technologies pivot table
        if ($request->has('technologies')) {
            $project->technologies()->attach($validated['technologies']);
        };

        return to_route('admin.projects.index')->with('status', "$request->title - Project created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.show', compact('project', 'types'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        // validate data
        $validated = $request->all();

        // add image to storage
        if ($request->has('image')) {
            if ($project->image) {
                Storage::delete($project->image);
            }
            $image = Storage::put('project-images', $request['image']);
            $validated['image'] = $image;
        }

        // create and add slug
        $slug = Str::slug($request->title, '-');
        $validated['slug'] = $slug;

        $project->update($validated);

        // syncronize connections to technologies pivot teable
        if ($request->has('technologies')) {
            $project->technologies()->sync($validated['technologies']);
        } else {
            $project->technologies()->sync([]);
        };

        return to_route('admin.projects.show', $project)->with('status', 'Project correctly edited');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // delete image from storage
        if ($project->image) {
            Storage::delete($project->image);
        }

        $project->delete();

        return to_route('admin.projects.index')->with('status', "$project->title - Project deleted");
    }
}
