@extends('layouts.admin')

@section('content')

<div class="container p-5">

    @if (session('deleted'))

        <div class="alert alert-success" role="alert">
            {{ session('deleted') }}
        </div>
    @endif

    <h2 class="pb-4">
        Tipologie progetto
    </h2>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Numero Progetti</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->name }}</th>
                    <td>{{ count($category->projects) }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>


</div>

@endsection
