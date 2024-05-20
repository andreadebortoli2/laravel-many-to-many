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
                                <a class="btn btn-primary" href="{{ route('admin.projects.show', $project) }}">show</a>
                                <a class="btn btn-primary" href="{{ route('admin.projects.edit', $project) }}">edit</a>
                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalId-delete">
                                    delete
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalId-delete" tabindex="-1" data-bs-backdrop="static"
                                    data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId">
                                                    DELETING PROJECT
                                                </h5>
                                            </div>
                                            <div class="modal-body">You're deleting {{ $project->title }}, it will not be
                                                possible to bring it back</div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <form action="{{ route('admin.projects.destroy', $project) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        DELETE
                                                    </button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
