@extends('layouts.admin')

@section('content')
    <div class="container py-3">
        <div class="row">
            <div class="col-7">
                <img src="{{ $project->image }}" alt="{{ $project->title }}">
            </div>
            <div class="col-5 p-4">
                <div class="actions d-flex justify-content-end pb-4">
                    <a class="btn btn-secondary me-3" href="{{ url()->previous() }}">Back</a>
                    <a class="btn btn-primary" href="">Edit</a>
                </div>
                <h2>{{ $project->title }}</h2>
                <h6>{{ $project->author }}</h6>
                <p>{{ $project->description }}</p>
            </div>
        </div>

    </div>
@endsection
