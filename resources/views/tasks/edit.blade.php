@extends('layouts.app')

@section('title','Task')

@section('content')
<div class="col-12 mx-auto mt-2">
    @if ( $message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="text-center"><h2>Edit Task</h2></div>
    <form action="{{ url('/tasks',$task->id)}}" method="post">

    <input type="hidden" name="_method" value="PUT">

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="type">Type :</label>
            <select class="form-control" name="type">
                <option value="" hidden></option>
                @foreach($types as $type )
                    @if( old('type',$task->type) == $type['id'])
                        <option value="{{ $type['id'] }}" selected>{{ $type['name'] }}</option>
                    @else
                        <option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                    @endif
                @endforeach
            </select>   
        </div>
        <div class="form-group">
            <label for="name">Name : </label>
            <input  type="text" class="form-control" name="name" value="{{ old('name',$task->name) }}" 
            />
        </div>
        <div class="form-group">
            <label for="detail">Detail :</label>
            <textarea type="text" class="form-control" rows="3" name="detail">{{ old('detail',$task->detail)}}</textarea>
        </div>
        <div class="form-group">
            <label class="text-inline">Status :</label>
            @foreach($statuses as $status)
                @if( old('status',$task->status) == $status['id'])
                <label class="radio-inline">
                    <input type="radio" name="status"  value = "{{ $status['id']}}" checked>{{ $status['name']}}
                </label>&nbsp;
                @else
                <label class="radio-inline">
                    <input type="radio" name="status"  value = "{{ $status['id']}}">{{ $status['name']}}
                </label>&nbsp;
                @endif 
            @endforeach
        </div> 
        <div class="text-center">
            <button type="submit" class="btn btn-success">Submit</button>   
        </div>
    </form>
</div>
@endsection