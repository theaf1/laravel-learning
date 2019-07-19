@extends('layouts.app')

@section('title', 'Task')

@section('content')

<h1 class="text-center">Tasks</h1>
@include('tasks._form')
<p>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th style="width: 5%;word-wrap: break-word;">Type</th>
            <th>Task Name</th>
            <th style="width: 15%;word-wrap: break-word;">Detail</th>
            <th>Status</th>
            <th>Creator</th>
            <th>Action</th>
            <th>Manage</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
        <tr>
            <th>{{ $task->id }}</th>
            {{-- <td>{{ $task->type->name }}</td>--}} 
            <td>{{ $task->type_name }}</td>
            <td>{{ $task->name }}</td>
            <td>{{ $task->detail }}</td>
            <td>{{ $task->status ? 'Completed':'Incomplete' }}</td>
            {{-- <td>{{ $task->user->username }}</td> --}}
            <td>{{ $task->username }}</td>
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
                <form id="delete-task-{{ $task->id }}" action="/tasks/{{ $task->id }}" method="POST" style="display: none;">
                    @csrf
                    @method('delete')
                </form>
                @if(!$task->status)
                    <button
                        class="btn btn-sm btn-danger"
                        onclick="document.getElementById('delete-task-{{ $task->id }}').submit()"
                    >Delete</button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</p>
@endsection