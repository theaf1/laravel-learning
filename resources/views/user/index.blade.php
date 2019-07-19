@extends('layouts.app')

@section('title', 'Task')

@section('content')

<h1 class="text-center">users</h1>
<p>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->username}}</td>
            <td>{{$user->email}}
        </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination justify-content-center">
{{ $users->links() }}
</div>
</p>
@endsection