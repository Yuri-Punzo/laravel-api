@extends('layouts.app')

@section('content')

<div class="container mb-5">
    <h1 class="py-5">Create a new Project</h1>
    @include('partials.errors')
    <form action="{{route('admin.projects.store')}}" method="post" class="card p-3">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="" aria-describedby="titleHlper" value="{{old('title')}}">
            <small id="titleHlper" class="text-muted">Add the product title here</small>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="4">{{old('description')}}</textarea>
        </div>
        <div class="mb-3">
            <label for="type_id" class="form-label">Type</label>
            <select class="form-select form-select-lg @error('type_id') 'is-invalid' @enderror" name="type_id" id="type_id">
                <option selected>Select one</option>

                @foreach ($types as $type )
                <option value="{{$type->id}}">{{$type->name}}</option>
                @endforeach

            </select>
        </div>
        <div class="mb-3">
            <label for="technologies" class="form-label">Technologies</label>
            <select multiple class="form-select form-select-lg" name="technologies[]" id="technologies">
                <option value="" disabled>Select one</option>
                @forelse ($technologies as $technology)
                <option value="{{$technology->id}}" {{in_array($technology->id, old('technologies', [])) ? 'selected' : ''}}>{{$technology->name}}</option>
                @empty
                <h6>Sorry.No technologies inside the database yet.</h6>
                @endforelse
            </select>
        </div>
        @error('technologies')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
</div>

@endsection