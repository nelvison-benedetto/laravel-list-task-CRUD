<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;  //import specific response fo errors (i.e.404)
use Illuminate\Support\Facades\Route;  //import routes methods ect
use App\Models\Task;  // \App\Models\Task
use App\Http\Requests\TaskRequest;   //set of rules x request a task, created with php artisan make:request TaskRequest

// Route::get('/', function () {  //main page
//     return view('index', [  //laravel knows view ='resources/views' and .blade.php is default, so take the file index
//         'name' => 'Nelvison'  //pass vars, in index.blade.php use it with {{$name}}
//     ]);  //se al posto di Nelvison vuoi un <br>Nel<br> devi usare dentro un <script>
// });

// Route::get('/hello', function(){return 'Hello!';})->name('thehello');
// Route::get('/hello/{name}',function($name){return 'Hello '.$name.'!';});
// Route::get('/halloo',function(){return redirect()->route('thehello');});
// Route::fallback(function(){return 'Ex-page 404!';}); // in case of page 404 ( ../not-exist)

// class Task
// {
//     public function __construct(
//         public int $id,
//         public string $title,
//         public string $description,
//         public ?string $long_description,
//         public bool $completed,
//         public string $created_at,
//         public string $updated_at
//     ) {
//     }
// }
// $tasks = [
//     new Task(
//         1,
//         'Buy groceries',
//         'Task 1 description',
//         'Task 1 long description',
//         false,
//         '2023-03-01 12:00:00',
//         '2023-03-01 12:00:00'
//     ),
//     new Task(
//         2,
//         'Sell old stuff',
//         'Task 2 description',
//         null,
//         false,
//         '2023-03-02 12:00:00',
//         '2023-03-02 12:00:00'
//     ),
//     new Task(
//         3,
//         'Learn programming',
//         'Task 3 description',
//         'Task 3 long description',
//         true,
//         '2023-03-03 12:00:00',
//         '2023-03-03 12:00:00'
//     ),
//     new Task(
//         4,
//         'Take dogs for a walk',
//         description: 'Task 4 description',
//         long_description: null,
//         completed: false,
//         created_at: '2023-03-04 12:00:00',
//         updated_at: '2023-03-04 12:00:00'
//     ),
// ];

Route::get('/',function() {
    return redirect() -> route('tasks.index'); //Reindirizza!!
});
Route::fallback(function(){return 'my error 404';});

 //use($tasks) importa la var esterna $tasks
//Route::get('/tasks',function() use($tasks){
//    return view('index',[  //passa anche oggetto con params
          //view:'index' , view= folder resources/views/  +  index = index.blade.php(.blade.php laravel knows is default)
//        'name' => 'Nelvison',
//        'tasks' => $tasks
        //'tasks'=>\App\Models\Task::latest()->where('completed',true)->get()  //order from latest timestamp (in column 'created_at') + filter Where x column 'completed'
//    ]);
//})->name('tasks.index');  //custom name of the route

Route::get('/tasks',function(){
    return view('index',[
        'tasks'=>Task::latest()->get()
    ]);
})->name('tasks.index');

//PRENDE I DATI DALL'ARRAY TASKS QUA SOPRA
// Route::get('/tasks/{id}',function($id) use($tasks){
//     $task = collect($tasks)->firstWhere('id',$id);
//        //collect() convert in laravel collection and
//        //return the first task where id property == $id parameter
//     if(!$task){
//         abort(Response::HTTP_NOT_FOUND);  //interrupt del app and return a 404
//     }
//     return view('show',['task'=>$task]);
// })->name('tasks.show');  //custom name
Route::view('/tasks/create','create')->name('tasks.create');

Route::get('/tasks/{task}/edit',function(Task $task){  //ROUTE MODEL BINDING, better than '/{id}/'
    return view('edit',[
        //'task'=>Task::findOrFail($id)
        'task'=>$task  //if not find the task id return 'model not found' which means 404
    ]);
})->name('tasks.edit');  //file edit.blade.php


//PRENDE I DATI DAL DB
Route::get('/tasks/{id}', function($id){
    return view('show',[
        'task'=>Task::findOrFail($id)  //find don't return page 404 but lines of code,better findOrFail
    ]);
})->name('tasks.show');

Route::post('/tasks',function(TaskRequest $request){  //!use template TaskRequest.php instead of 'Request' and no need findOrFail() anymore
    //dd($request->all()); //dd stamp the result (and stop the esecution, dump() non lo fa)
    // $data = $request->validate([  //validation before post on db is a MUST!!
    //     'title' => 'required|max:255',
    //     'description' => 'required',
    //     'long_description' => 'required'
    // ]);

    //$data = $request->validated();
    // $task = new Task;
    // $task->title=$data['title'];
    // $task->description=$data['description'];
    // $task->long_description=$data['long_description'];
    // $task->save(); //post new task on db in tab tasks
    $task = Task::create($request->validated());  //MASS ASSIGNMENT you set/change multiple attributes of a model at once
        //validated() laravel apply the validation rules(in the TaskRequest.php), if pass ok return only those data
        //create() take the validated data and creates a new task in the db
     //with PUT would be  $task->update($request->validated())
    return redirect()->route('tasks.show',['id'=>$task->id])
        ->with('success','Task created successfully!');  //append a custom message x user, here only appears when a new tak is created
})->name('tasks.store');

Route::put('/tasks/{id}', function($id, Request $request){   //here i'm not using TaskRequest.php x $data
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);
    $task = Task::findOrFail($id);
    $task->title=$data['title'];
    $task->description=$data['description'];
    $task->long_description=$data['long_description'];
    $task->save();
    return redirect()->route('tasks.show',['id'=>$task->id])
        ->with('success','Task updated successfully!');
})->name('tasks.update'); //test with url http://127.0.0.1:8000/tasks/{id}/edit
