@extends('layouts.admin')

@section('content')
<div class="container p-5">

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h4>{{ $title }}</h4>

    <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method($method)

        <div class="mb-3">
            <label for="text" class="form-label">Titolo</label>
            <input
            class="form-control @error('title') is-invalid @enderror"
            id="title"
            value="{{ old('title', $project?->title) }}"
            type="text"
            name="title"
            placeholder="Titolo">
            @error('title')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Tipologia</label>
            <select class="form-select" name="category_id">
                <option selected>Seleziona Tipologia</option>
                @foreach ($categories as $category)
                <option
                value="{{ $category->id }}"
                @if ($category->id == old('category_id')) selected @endif
                >{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <p  class="form-label">Tecnologie</p>
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">

                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">

                    @foreach ($technologies as $technology)
                        <input
                            id="technology{{ $loop->iteration }}"
                            class="btn-check"
                            autocomplete="off"
                            type="checkbox"
                            value="{{ $technology->id }}"
                            name="technologies[]"

                            @if (!$errors->any() && $project?->technologies->contains($technology))
                                checked
                            @elseif ($errors->any() && in_array($technology->id, old('technologies',[])))
                                checked
                            @endif
                        >
                        <label class="btn btn-check-custom" for="technology{{ $loop->iteration }}">{{ $technology->name }}</label>
                    @endforeach

                </div>

            </div>
        </div>

        <div class="mb-3">
            <label for="text" class="form-label">Data di creazione</label>
            <input
            class="form-control"
            id="date"
            value="{{ old('date') }}"
            type="text"
            name="date"
            placeholder="Data">
        </div>

        <div class="mb-3">
            <label for="text" class="form-label">Descrizione progetto</label>
            <textarea
            id="text"
            class="form-control @error('description') is-invalid @enderror"
            type="text"
            name="description"
            cols="30"
            rows="10">{{ old('description', $project?->description) }}</textarea>
            @error('title')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input
            id="formFile"
            onchange="showImage(event)"
            class="form-control mb-3"
            name="thumb"
            type="file">
            <img width="150" id="prev-image" src="{{ asset('storage/' . $project?->thumb) }}" onerror="this.src='/img/image-placeholder.jpg'">

            <input type="radio" name="noImage" onchange="removeImage()"> <label for="">No image</label>
        </div>

        <button type="submit" class="btn btn-success">Invia</button>

    </form>

</div>


<script>
    ClassicEditor
        .create( document.querySelector( '#text' ) )
        .catch( error => {
            console.error( error );
        } );

    function showImage(event){
        const tagImage = document.getElementById('prev-image');
        tagImage.src = URL.createObjectURL(event.target.files[0]);
    }

</script>

@endsection
