@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="d-flex gap-4">
        <div class="details">
            <h1>{{$project->title}}</h1>
            @if($project->cover_image)
            <img class="img-fluid" style="width:150px" src="{{asset('storage/' . $project->cover_image)}}" alt="">
            @else
            <div class="placeholder p-5 bg-secondary" style="width:100px">Placeholder</div>

            @endif
            <p>{{$project->description}}</p>
            <span>{{$project->type ? $project->type->name : 'Null'}}</span>
            <div class="tecnologie">
                @if (count($project->technologies) > 0)
                <span>Tecnologie: </span>
                @foreach ($project->technologies as $techology)
                <span>{{ $techology->name }}</span>
                @endforeach
                @else
                <span>Tecnologie: Nessuna tecnologia associata a questo progetto.</span>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection