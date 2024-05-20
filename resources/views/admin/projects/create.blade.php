@extends('layouts.admin')

@section('content')
    @if ($errors->all())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container py-3">
        <form action="{{ route('admin.projects.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    aria-describedby="helpIdTitle" placeholder="Title" value="{{ old('title') }}" />
                <small id="helpIdTitle" class="form-text text-muted">Write the project title</small>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Author</label>
                <input type="text" class="form-control @error('author') is-invalid @enderror" name="author"
                    id="author" aria-describedby="helpIdAuthor" placeholder="Name" value="{{ old('author') }}" />
                <small id="helpIdAuthor" class="form-text text-muted">Write the name of the author</small>
                @error('author')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Image</label>
                <input type="text" class="form-control @error('image') is-invalid @enderror" name="image"
                    id="image" aria-describedby="helpIdImage" placeholder="Https://" value="{{ old('Image') }}" />
                <small id="helpIdImage" class="form-text text-muted">Insert the image URL</small>
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                    rows="6" placeholder="Write the description of the project">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <a class="btn btn-secondary" href="{{ url()->previous() }}">Cancel</a>
            <button type="submit" class="btn btn-primary">
                Create
            </button>


        </form>
    </div>
@endsection
