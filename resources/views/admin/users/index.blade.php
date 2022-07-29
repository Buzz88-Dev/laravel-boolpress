@extends('admin.layouts.base')
@section('mainContent')
    <h1>Users</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Birth</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr data-id="{{ $user->id }}">
                    <td>{{ $user->id}} </td>
                    <td>{{ $user->name}} </td>
                    <td>{{ $user->email}} </td>
                    {{-- questi sopra sono i dati che arrivano dalla prima tabella (users) --}}
                    {{-- ora sfrutto la funzione userDetails() in Models/User.php per stampare i dati della tabella users_details --}}
                    {{-- @if ($user->userDetails()->first())          // questo if è un metodo per stampare i details
                        <td>{{ $user->userDetails()->first()->address}} </td>
                        <td>{{ $user->userDetails()->first()->phone}} </td>
                        <td>{{ $user->userDetails()->first()->birth}} </td>
                    @endif --}}

                    @php
                        $details = $user->userDetails()->first()
                    @endphp
                    <td>{{ $details ?  $details->address : '-'}} </td>
                    <td>{{ $details ?  $details->phone : '-'}} </td>
                    <td>{{ $details ?  $details->birth : '-'}} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
