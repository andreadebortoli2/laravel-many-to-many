<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use Illuminate\Support\Str;

// validator utilities
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.types.index', ['types' => Type::paginate()]);
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
    /* public function store(StoreTypeRequest $request)
    {
        $validated = $request->validated();

        $slug = Str::slug($request->name, '-');
        $validated['slug'] = $slug;
        Type::create($validated);

        return to_route('admin.types.index')->with('status', "$request->name - Type created");
    } */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|unique:types|max:50'
        ])->validateWithBag('create');

        $validated['slug'] = Str::slug($request->name, '-');

        Type::create($validated);

        return to_route('admin.types.index')->with('status', "$request->name - Type created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    /* public function update(UpdateTypeRequest $request, Type $type)
    {
        $validated = $request->validated();

        $validated['slug'] = Str::slug($request->name, '-');

        $type->update($validated);

        return to_route('admin.types.index')->with('status', "$request->name - Type successfully edited");
    } */
    public function update(Request $request, Type $type)
    {
        $validated = Validator::make($request->all(), [
            'name' => ['required', 'max:50', Rule::unique('types')->ignore($type)]
        ])->validateWithBag($type->id);

        $validated['slug'] = Str::slug($request->name, '-');

        $type->update($validated);

        return to_route('admin.types.index')->with('status', "$request->name - Type successfully edited");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return back()->with('status', "$type->name - Type deleted");
    }
}
