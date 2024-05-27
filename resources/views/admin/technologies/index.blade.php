@extends('layouts.admin')

@section('content')
    <div class="container py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Technologies</h2>
            <a class="btn btn-success" href="{{ route('admin.technologies.create') }}">
                <i class="fa-solid fa-plus"></i>
                Add a new technology
            </a>
        </div>
        @if (session('status'))
            <div class="bg-light my-2 p-3 border border-secondary">{{ session('status') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-success">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($technologies as $technology)
                        <tr class="">
                            <td scope="row">{{ $technology->id }}</td>
                            <td>{{ $technology->name }}</td>
                            <td scope="col">
                                <a class="btn btn-primary btn-sm m-2"
                                    href="{{ route('admin.technologies.edit', $technology) }}">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <!-- Modal trigger button -->
                                <button technology="button" class="btn btn-danger btn-sm m-2" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $technology->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalId-{{ $technology->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitle-{{ $technology->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitle-{{ $technology->id }}">
                                                    DELETING TECHNOLOGY
                                                </h5>
                                            </div>
                                            <div class="modal-body">
                                                You're deleting <span class="text-danger">{{ $technology->name }}</span>, it
                                                will not be possible to bring it back
                                            </div>
                                            <div class="modal-footer">
                                                <button technology="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">
                                                    <i class="fa-solid fa-arrow-left"></i>
                                                </button>
                                                <form action="{{ route('admin.technologies.destroy', $technology) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button technology="submit" class="btn btn-danger">
                                                        DELETE
                                                    </button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td scope="row" colspan="3">No technologies yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $technologies->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endsection
