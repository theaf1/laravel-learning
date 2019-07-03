@extends('layouts.app')

@section('title', 'Task')

@section('content')

<h1 class="text-center">Tasks</h1>
@include('tasks._form')
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Type</th>
            <th>Task Name</th>
            <th>Detail</th>
            <th>Status</th>
            <th>Action</th>
            <th>Manage</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
        <tr>
            <th>{{ $task->id }}</th>
            <td>{{ $task->type->name }}</td>
            <td>{{ $task->name }}</td>
            <td>{{ $task->detail }}</td>
            <td>{{ $task->status ? 'Completed':'Incomplete' }}</td>
            <td>
                <form id="check-complate-{{ $task->id }}" action="/tasks/{{ $task->id }}" method="POST" style="display: none;">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="status" value="1">
                </form>
                @if(!$task->status)
                    <button
                        class="btn btn-sm btn-info"
                        onclick="document.getElementById('check-complate-{{ $task->id }}').submit()"
                    >Completed</button>
                @endif
            </td>
            <td>
                <a class="btn btn-sm btn-success" role="button" href="{{ url('/tasks',$task->id) }}">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection