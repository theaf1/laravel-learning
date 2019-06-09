<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks/create',function(){
    $types[] = [ 'id' => 1 , 'name' => 'Support' ];
    $types[] = [ 'id' => 2 , 'name' => 'Maintain' ];
    $types[] = [ 'id' => 3 , 'name' => 'Change Requirement' ];

    $statuses[] = ['id' => 0, 'name' => 'Incomplete'];
    $statuses[] = ['id' => 1, 'name' => 'completed'];
    return view('tasks.create')->with([ 'types'=> $types,'statuses' => $statuses ]);
});

Route::post('/tasks/store',function(Illuminate\Http\Request $request){ 
    // $task = new App\Task();
    // $task->type = $request->type;
    // $task->name = $request->name;
    // $task->detail = $request->detail;
    // $task->status = $request->status;
    // $task->save();
    $validation = $request->validate([
        'type' => 'required',
        'name' => 'required|max:255',
        'status' => 'required'
    ]);
    App\Task::create($request->all());
    return redirect()->back()->with('success','Created Successfully !!');
});

Route::get('/tasks/{id}',function($id){
    $types[] = [ 'id' => 1 , 'name' => 'Support' ];
    $types[] = [ 'id' => 2 , 'name' => 'Maintain' ];
    $types[] = [ 'id' => 3 , 'name' => 'Change Requirement' ];

    $statuses[] = ['id' => 0, 'name' => 'Incomplete'];
    $statuses[] = ['id' => 1, 'name' => 'completed'];

    $task = App\Task::find($id);
    return view('tasks.edit')->with(['types'=> $types,'statuses' => $statuses, 'task'=> $task]);
});

Route::put('/tasks/{id}',function(Illuminate\Http\Request $request,$id){
    $validation = $request->validate([
        'type' => 'required',
        'name' => 'required|max:255',
        'status' => 'required'
    ]);
    
    App\Task::find($id)->update($request->all());
    return redirect()->back()->with('success','Edited Successfully !!');
});