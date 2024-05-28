<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use Illuminate\Support\Str;

// validator utilitiesd
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.technologies.index', ['technologies' => Technology::paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    /* public function store(StoreTechnologyRequest $request)
    {
        $validated = $request->validated();

        $slug = Str::slug($request->name, '-');
        $validated['slug'] = $slug;

        Technology::create($validated);

        return to_route('admin.technologies.index')->with('status', "$request->name - Technology created");
    } */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|unique:technologies|max:20'
        ])->validateWithBag('create');

        $validated['slug'] = Str::slug($request->name, '-');

        Technology::create($validated);

        return to_route('admin.technologies.index')->with('status', "$request->name - Technology created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    /* public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $validated = $request->validated();

        $slug = Str::slug($request->name, '-');
        $validated['slug'] = $slug;

        $technology->update($validated);

        return to_route('admin.technologies.index')->with('status', "$request->name - Technology successfully edited");
    } */
    public function update(Request $request, Technology $technology)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|unique:technologies|max:20'
        ])->validateWithBag($technology->id);

        $validated['slug'] = Str::slug($request->name, '-');

        $technology->update($validated);

        return to_route('admin.technologies.index')->with('status', "$request->name - Technology successfully edited");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();

        return back()->with('status', "$technology->name - Technology deleted");
    }
}
