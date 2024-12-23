@extends('layouts.app')  {{-- layouts= views/layouts/ app=app.blade.php --}}

@section('title', $task->title)  {{--set the @yield('title')--}}
{{-- //@endsection  //no thml code so not necessary --}}

@section('content')   {{--set the @yield('content')--}}
    {{-- <h1>{{$task->title}}</h1> --}}
    <p>{{$task->description}}</p>

    @if ($task->long_description)
        <p>{{$task->long_description}}</p>
    @endif

    <p>{{$task->created_at}}</p>
    <p>{{$task->updated_at}}</p>

    <span>
        @if($task->completed) Completed
        @else Not completed
        @endif
    </span>

    <div>
        <a href="{{route('tasks.edit',['task'=>$task->id])}}">Edit</a>
    </div>

    <div>
        <form method='POST' action="{{route('task.toggle-complete',['task'=>$task])}}">
            @csrf  {{--x security--}}
            @method('PUT')
            <button type='submit'>
                Oriana as {{$task->completed? 'not completed' : 'completed'}}
            </button>
        </form>
    </div>

    <div>
        <form action="{{route('tasks.destroy',['task'=>$task->id])}}" method='POST'>  {{--spoofing, http forms only support GET and POST methods by default --}}
            @csrf  {{--Adds a CSRF (Cross-Site Request Forgery) token to the form x security--}}
            @method('DELETE')
            <button type='submit'>Delete</button>
        </form>
    </div>
@endsection



