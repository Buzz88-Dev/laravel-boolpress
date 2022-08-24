@extends('admin.layouts.base')

@section('mainContent')
    <h1>{{ $post->title }}</h1>
    <h2>Written by: {{ $post->user->name }}</h2>
    <h2>Categoria: {{ $post->category->name }}</h2>
    {{-- <h2>Id Tags: {{ $post->tags }}</h2> --}}
    {{-- analizzare cosa mi stampa con la sintassi sopra --}}

    {{-- Opzione 1 immagine di default --}}
    {{-- <img class="img-fluid" src="{{ asset($post->image ? 'storage/' . $post->image : 'img/fallback.jpg') }}" alt="{{ $post->title }}"> --}}

    {{-- Opzione 2: senza immagine --}}
    {{-- @if ($post->image)
        <img class="img-fluid" src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
    @endif --}}

    {{-- <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"> --}}
    <img src="{{ $post->image }}" alt="{{ $post->title }}">
    <a href="{{ route('admin.posts.index')}}">Posts Home</a>
@endsection
