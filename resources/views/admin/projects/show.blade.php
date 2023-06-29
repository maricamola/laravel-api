@extends('layouts.admin')

@section('content')

<div class="container p-5">
        <div class="d-flex align-items-center">
            <h1 class="me-4">{{ $project->title}}</h1>

            @include('admin.partials.form-delete',[
                'title'=>'Eliminazione Progetto',
                'id'=> $project->id,
                'message'=> "Confermi l'eliminazione del progetto {{ $project->title }} ?",
                'route'=> route('admin.projects.destroy', $project)
            ])
        </div>

        <div>
            <span class="badge bg-secondary mb-2">{{ $project->category?->name}}</span></h5>
        </div>

        <div>
            <span>Tecnologie utilizzate:</span>
            @forelse ($project->technologies as $technology)
                <span class="badge text-bg-warning">{{ $technologies->name }}</span>
            @empty
                <span>No technologies</span>
            @endforelse
        </div>

        <div class="mt-4">
            <p class="mt-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, iusto aperiam cum vero inventore ab consectetur explicabo modi non natus quasi totam, ut minima provident, nobis repellat dolore libero itaque. {!! $project->description !!} </p>
        </div>

        <div>
            <span>Data di creazione: {{ $project->date_creation}}</span>
        </div>

        {{-- Immagine qui!!!! --}}
        <div class="d-flex justify-content-center">
            <img class="w-40" src="{{ asset('storage/' . $project->thumb) }}"
            alt="{{  $project->title }}"
            onerror="this.src='/img/image-placeholder.jpg'">
        </div>
        <p>{{ $project->thumb_original_name }}</p>

</div>

@endsection
