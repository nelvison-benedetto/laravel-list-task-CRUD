@extends('layouts.app')  {{-- layouts= views/layouts/ app=app.blade.php --}}

@section('title', $task->title)  {{--set the @yield('title')--}}
{{-- //@endsection  //no thml code so not necessary --}}

@section('content')   {{--set the @yield('content')--}}
    {{-- <h1>{{$task->title}}</h1> --}}
    <div class='mb-4 '>
        <a href="{{route('tasks.index')}}" class='font-medium text-gray-700 underline decoration-pink-500'>🔙 Go back to the task list!</a>
    </div>

    <p class='mb-4 text-slate-700'>{{$task->description}}</p>

    @if ($task->long_description)
        <p class='mb-4 text-slate-700'>{{$task->long_description}}</p>
    @endif

    <p class='mb-4 text-sm text-slate-500'>Created {{$task->created_at->diffForHumans()}} - Updated {{$task->updated_at->diffForHumans()}}</p>

    <p class='mb-4'>
        @if($task->completed)
          <span class='font-medium text-green-500'>Completed</span>
        @else
        <span class='font-medium text-red-500'>Not completed</span>
        @endif
    </p>

    <div class='flex gap-2'>
        <a href="{{route('tasks.edit',['task'=>$task->id])}}"
            class='mybtn'>
            Edit
        </a>

        <form method='POST' action="{{route('task.toggle-complete',['task'=>$task])}}">
            @csrf  {{--x security--}}
            @method('PUT')
            <button type='submit' class='mybtn'>
                Mark as {{$task->completed? 'not completed' : 'completed'}}
            </button>
        </form>

        <form action="{{route('tasks.destroy',['task'=>$task->id])}}" method='POST'>  {{--spoofing, http forms only support GET and POST methods by default --}}
            @csrf  {{--Adds a CSRF (Cross-Site Request Forgery) token to the form x security--}}
            @method('DELETE')
            <button type='submit' class='mybtn'>Delete</button>
        </form>
    </div>
@endsection



