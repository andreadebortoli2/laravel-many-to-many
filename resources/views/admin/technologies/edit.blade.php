@extends('layouts.admin')

@section('content')
    <div class="container py-3">
        <form action="{{ route('admin.technologies.update', $technology) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Technology name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    aria-describedby="helpId" placeholder="Technology" value="{{ old('name', $technology->name) }}" />
                <small id="helpId" class="form-text text-muted">Write the technology name</small>
            </div>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary">
                Edit
            </button>
        </form>
    </div>
@endsection
