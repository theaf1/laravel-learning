<div class="col-12 mx-auto mt-2">
    @if ( $message = Session::get('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ $message }}
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger ">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    @if(isset($task))
        <form action="{{ url('/tasks',$task->id)}}" method="post">
        <input type="hidden" name="_method" value="PUT">
    @else
        <form action="{{ url('/tasks/store')}}" method="post">
    @endif
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="type_id">Type :</label>
            <select class="form-control" name="type_id">
                <option value="" hidden></option>
                @foreach($types as $type )
                    @if( old('type_id', isset($task) ? $task->type : '') == $type['id'])
                        <option value="{{ $type['id'] }}" selected>{{ $type['name'] }}</option>
                    @else
                        <option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                    @endif
                @endforeach
            </select>   
        </div>
        <div class="form-group">
            <label for="name">Name : </label>
            <input  type="text" class="form-control" name="name" value="{{ old('name', isset($task) ? $task->name : '') }}" 
            />
        </div>
        <div class="form-group">
            <label for="detail">Detail :</label>
            <textarea type="text" class="form-control" rows="3" name="detail">{{ old('detail',isset($task) ? $task->detail : '')}}</textarea>
        </div>
        <div class="form-group">
            <label class="text-inline">Status :</label>
            @foreach($statuses as $status)
                @if( old('status', isset($task) ? $task->status :-1) == $status['id'])
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