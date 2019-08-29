<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Task;
use \Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Storage;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        // $types[] = [ 'id' => 1 , 'name' => 'Support' ];
        // $types[] = [ 'id' => 2 , 'name' => 'Maintain' ];
        // $types[] = [ 'id' => 3 , 'name' => 'Change Requirement' ];
        
        $statuses[] = ['id' => 0, 'name' => 'Incomplete'];
        $statuses[] = ['id' => 1, 'name' => 'completed'];

        $types = \App\Type::all();
        
        // $role =\Auth::user()->roles()->where('role_id',1)->first();
        $role = \Auth::user()->roles()->AdminOrstaff()->first();
        if(!empty($role)){
            // $tasks = Task::all();
            // $tasks = DB::table('tasks')
            // ->join('types','tasks.type_id','=','types.id')
            // ->join('users','tasks.user_id','=','users.id')
            // ->select(
            //     'tasks.*',
            //     'types.name as type_name',
            //     'users.username as username'
            // )
            // ->get();
            $sort = 'DESC';
            $tasks = Task::taskAll($sort)->paginate(10);
        }else{
            $tasks = Task::where('user_id',\Auth::id())
            ->taskAll('DESC')
            ->paginate(10);
        }
    
        // $tasks = Task::all();
        return view('tasks.index')
                ->with([
                    'tasks'=> $tasks,
                    'types' => $types,
                    'statuses' => $statuses
                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types[] = [ 'id' => 1 , 'name' => 'Support' ];
        $types[] = [ 'id' => 2 , 'name' => 'Maintain' ];
        $types[] = [ 'id' => 3 , 'name' => 'Change Requirement' ];
    
        $statuses[] = ['id' => 0, 'name' => 'Incomplete'];
        $statuses[] = ['id' => 1, 'name' => 'completed'];
        return view('tasks.create')->with([ 'types'=> $types,'statuses' => $statuses ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $validation = $request->validate([
            'type_id' => 'required',
            'name' => 'required|max:255',
            'status' => 'required'
        ]);
        $task = Task::create($request->all() + ['user_id' => \Auth::id() ]);
        if($request->hasFile('file_upload')){
            $path = $request->file('file_upload')->store('/public');
            // $path = $request->file('file_upload')->storeAs('/', $request->file('file_upload')->getClientOriginalName());
            $filename = pathinfo($path);
            $task->file_upload = $filename['basename'];
            $task->update();
            // return Storage::download($path);
            return Storage::url($path);
        }else{
            return 'no file';
        }
        return redirect()->back()->with('success','Created Successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $types = \App\Type::all();
    
        $statuses[] = ['id' => 0, 'name' => 'Incomplete'];
        $statuses[] = ['id' => 1, 'name' => 'completed'];
    
        // $task = Task::find($id);
        $task = DB::table('tasks')->where('id','=',$id)->first();
        $tasks = Task::all();
        if(empty($task)){
            return "Not found";
        }
        return  view('tasks.index')
                ->with([
                        'types'=> $types,
                        'statuses' => $statuses, 
                        'task'=> $task,
                        'tasks' => $tasks,
                    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Task $task)
    {
        $validation = request()->validate([
            'type_id' => 'required',
            'name' => 'required|max:255',
            'status' => 'required'
        ]);
        
        $task->update(request()->all());
        return redirect('/tasks')->with('success','Edited Successfully !!');
    }

    public function updateStatus(Task $task){
        $task->update(request()->all());
        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::find($id)->delete();
        return redirect('/tasks')->with('success','Delete Successfully !!');
    }
}
