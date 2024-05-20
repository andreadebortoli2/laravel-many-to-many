@extends('layouts.admin')

@section('content')
    <div class="container py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Prortfolio</h2>
            <a class="btn btn-primary" href="{{ route('admin.projects.create') }}">Add a project</a>
        </div>

        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                        <tr class="">
                            <td scope="row">{{ $project->id }}</td>
                            <td>
                                <img width="100" src="{{ $project->image }}" alt="">
                            </td>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->author }}</td>
                            <th scope="col">
                                <a href="{{ route('admin.projects.show', $project) }}">show</a>
                                /
                                <a href="{{ route('admin.projects.edit', $project) }}">edit</a>
                                /delete
                            </th>
                        </tr>
                    @empty

                        <tr class="">
                            <td scope="row" colspan="5">No projects yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $projects->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endsection
