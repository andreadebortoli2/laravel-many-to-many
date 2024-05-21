@extends('layouts.admin')

@section('content')
    <div class="container py-3">
        <div class="row">
            <div class="col-7">
                <img src="{{ $project->image }}" alt="{{ $project->title }}">
            </div>
            <div class="col-5 p-4">
                <div class="actions d-flex justify-content-end pb-4">
                    <a class="btn btn-secondary" href="{{ route('admin.projects.index') }}">Back</a>
                    <a class="btn btn-primary mx-2" href="{{ route('admin.projects.edit', $project) }}">Edit</a>
                    <!-- Modal trigger button -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalId-delete">
                        delete
                    </button>

                    <!-- Modal Body -->
                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                    <div class="modal fade" id="modalId-delete" tabindex="-1" data-bs-backdrop="static"
                        data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
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
                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="post">
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
                </div>
                @if (session('status'))
                    <div class="bg-light my-2 p-3 border border-secondary">{{ session('status') }}</div>
                @endif
                <h2>{{ $project->title }}</h2>
                <h6>{{ $project->author }}</h6>
                <p>{{ $project->description }}</p>
            </div>
        </div>

    </div>
@endsection
