@extends('layouts.guest')

@section('content')

<div class="container my-5">
    <h1 class="text-center mb-3">Welcome to Boolfolio</h1>
    {{-- <h5>Questi sono gli ultimi 5 progetti</h5> --}}

    <div class="row">
{{--
        @foreach ($projects as $project)

        <div class="col-3 mb-3 align-items-stretch d-flex">
            <div class="card h-20" style="width: 18rem;">

                @if($project->thumb)
                    <img src="{{ asset('storage/' . $project->thumb) }}" class="card-img-top" alt="{{ $project->title }}">
                @endif

                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title">{{ $project->title }}</h5>
                    {{-- <p class="card-text sc-card-text">{!! $project->description !!}</p> --}}
                    {{-- <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>

            </div>
        </div>


        @endforeach --}}

    </div>
</div>

@endsection
