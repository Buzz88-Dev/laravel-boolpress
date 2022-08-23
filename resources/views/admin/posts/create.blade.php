@extends('admin.layouts.base')

@section('mainContent')
    <h1>Create new post</h1>
    {{-- quando faccio il submit del form, il  form va a finire in posts.store; metodo store() in PostController --}}
    {{-- <form action="{{ route('admin.posts.store') }}" method="post" novalidate> --}}
    <form action="{{ route('admin.posts.store') }}" method="post" novalidate enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label" for="title">Title</label>
            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') }}">
            @error('title')
            {{-- se c e l errore mi stampa questo messaggio di errore (is-invalid); @error è una specie di if --}}
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label" for="slug">Slug</label>
            <input class="form-control @error('slug') is-invalid @enderror" type="text" name="slug" id="slug" value="{{ old('slug') }}">
            <button type="button" class="btn btn-primary">Reset</button>
            @error('slug')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- <div class="mb-3">
            <label class="form-label" for="image">Image</label>
            <input class="form-control @error('image') is-invalid @enderror" type="url" name="image" id="image" value="{{ old('image') }}">
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div> --}}

        <div class="mb-3">
            <label class="form-label" for="image">Image</label>
            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image" accept="image/*" value="{{ old('image') }}">
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label" for="category_id">Category</label>
            {{-- creo le opzioni con tutte le categories che arrivano dal database; guardare metodo create() in PostController --}}
            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                <option @if(!old('category_id')) selected @endif disabled value="">Choose...</option>
                {{-- stampo le categories; dati arrivano dal metodo create() --}}
                @foreach ($categories as $category)
                    {{-- analizzare e comprendere @if ($category->id === old('category')) selected @endif; lezione 26/07 minuto 02 04 00 circa --}}
                    <option value="{{ $category->id }}" @if($category->id == old('category_id')) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <fieldset class="mb-3">
            <legend>Tags</legend>
            @foreach ($tags as $tag)
                <div class="form-check">
                    {{-- ricordarsi di aggiungere [] al name per avere un array come valore di ritorno --}}
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="tags[]"
                        value="{{ $tag->id }}"
                        id="tag-{{ $tag->id }}"
                        @if(in_array($tag->id, old('tags') ?: [])) checked @endif
                    >
                    <label class="form-check-label" for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                </div>
            @endforeach

            {{-- @foreach ($errors->get('tags.*') as $messages) --}}
                {{-- @dd($message) --}}
                {{-- @foreach ($messages as $message)
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @endforeach
            @endforeach --}}

            @error('tags')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </fieldset>

        <div class="mb-3">
            <label class="form-label" for="content">Content</label>
            <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content">{{ old('content') }}</textarea>
            @error('content')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label" for="excerpt">Excerpt</label>
            <textarea class="form-control @error('excerpt') is-invalid @enderror" name="excerpt" id="excerpt">{{ old('excerpt') }}</textarea>
            @error('excerpt')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
