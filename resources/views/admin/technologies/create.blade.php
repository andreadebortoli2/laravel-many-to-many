@extends('layouts.admin')

@section('content')
    <div class="container py-3">
        <form action="{{ route('admin.technologies.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Technology name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    aria-describedby="helpId" placeholder="Technology" value="{{ old('name') }}" />
                <small id="helpId" class="form-text text-muted">Write the technology name</small>
            </div>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary">
                Create
            </button>
        </form>
    </div>
@endsection
