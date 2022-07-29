@extends('admin.layouts.base')

@section('mainContent')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>Slug</th>
                <th>Title</th>
                {{-- <th>Birth</th> --}}
                <th class="actions">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr data-id="{{ $post->id }}">
                    <td>{{ $post->id}} </td>
                    <td>{{ $post->slug}} </td>
                    <td>{{ $post->title}} </td>
                    {{-- <td>{{ $post->user}} </td>   decommentare e analizzare  --}}
                    {{-- <td>{{ $post->user->userDetails->birth}} </td> --}}
                    {{-- creare il seeder di UserDetailsSeeder e stampare qui qualche dato --}}
                    <td class="actions">
                        <a href="{{ route('admin.posts.show', ['post' => $post])}}" class="btn btn-primary">View</a>

                        <a href="{{ route('admin.posts.edit', ['post' => $post])}}" class="btn btn-warning">Edit</a>

                        <form action="{{ route('admin.posts.destroy', ['post' => $post])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>

                        {{-- <button type="submit" class="btn btn-danger js-delete">Delete</button> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}

    {{-- <section class="overlay d-none">
        <form class="popup" data-action="{{ route('admin.posts.destroy', ['post' => '*****'])}}" method="post">
            @csrf
            @method('DELETE')
            <h3>Sei Sicuro?</h3>
            <button type="submit" class="btn btn-warning js-yes">Yes</button>
            <button type="submit" class="btn btn-warning js-no">No</button>
        </form>
    </section> --}}
@endsection


