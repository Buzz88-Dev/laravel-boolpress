@extends('admin.layouts.base')
@section('mainContent')
    <h1>{{ $post->title }}</h1>
    <h2>Written by: {{ $post->user->name }}</h2>
    <h2>Categoria: {{ $post->category->name }}</h2>
    <h2>Id Tags: {{ $post->tags }}</h2>
    {{-- analizzare cosa mi stampa con la sintassi sopra --}}
    <img src="{{ $post->image }}" alt="{{ $post->title }}">
    <a href="{{ route('admin.posts.index')}}">Posts Home</a>
@endsection
