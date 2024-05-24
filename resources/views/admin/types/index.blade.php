@extends('layouts.admin')

@section('content')
    <div class="container py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Types</h2>
            <a class="btn btn-success" href="{{ route('admin.types.create') }}">
                <i class="fa-solid fa-plus"></i>
                Add a new type
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
                    @forelse ($types as $type)
                        <tr class="">
                            <td scope="row">{{ $type->id }}</td>
                            <td>{{ $type->name }}</td>
                            <td scope="col">
                                <a class="btn btn-primary btn-sm m-2" href="{{ route('admin.types.edit', $type) }}">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-danger btn-sm m-2" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $type->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalId-{{ $type->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitle-{{ $type->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitle-{{ $type->id }}">
                                                    DELETING TYPE
                                                </h5>
                                            </div>
                                            <div class="modal-body">
                                                You're deleting <span class="text-danger">{{ $type->name }}</span>, it
                                                will not be possible to bring it back
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="fa-solid fa-arrow-left"></i>
                                                </button>
                                                <form action="{{ route('admin.types.destroy', $type) }}" method="post">
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
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td scope="row" colspan="3">No types yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $types->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endsection
