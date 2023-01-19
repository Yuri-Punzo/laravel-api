@extends('layouts.app')

@section('content')

<div class="container mb-5">
    <h1 class="py-5">Edit Project</h1>
    @include('partials.errors')
    <form action="{{route('admin.projects.update', $project->slug)}}" method="post" class="card p-3">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="" aria-describedby="titleHlper" value="{{old('title', $project->title)}}">
            <small id="titleHlper" class="text-muted">Add the product title here</small>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="4">{{old('description', $project->description)}}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label" for="type_id" class="form-label">Types</label>
            <select class="form-select form-select-lg @error('type_id') 'is-invalid' @enderror" name="type_id" id="type_id">
                <option selected>Select one</option>

                @foreach ($types as $type)
                <option value="{{$type->id}}" {{ $project->type->id == $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                @endforeach

            </select>
        </div>
        <div class="mb-3">
            <label for="technologies" class="form-label">Technologies</label>
            <select multiple class="form-select form-select-lg" name="technologies[]" id="technologies">
                <option value="" disabled>Select one</option>

                @forelse ($technologies as $technology)
                @if ($errors->any())
                <option value="{{ $technology->id }}" {{ in_array($technology->id, old('technologies', [])) ? 'selected' : '' }}>
                    {{ $technology->name }}
                </option>
                @else
                <option value="{{ $technology->id }}" {{ $project->technologies->contains($technology->id) ? 'selected' : '' }}>
                    {{ $technology->name }}
                </option>
                @endif
                @empty
                <h6>Sorry.No technologies inside the database yet.</h6>
                @endforelse
            </select>

        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
</div>

@endsection