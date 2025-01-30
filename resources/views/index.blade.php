@extends('layouts.app') {{-- layouts= views/layouts/ app=app.blade.php --}}
  {{--ha come base lo script app.blade.php e poi questo--}}

@section('title','Blade Template by Me!')  {{--set the @yield('title')--}}

@section('content')  {{--set the @yield('content')--}}
    @isset($lastname) {{--play this only if found $lastname in the --}}
        the last name is {{$lastname}}
    @endisset
    {{--@if(count($tasks))
            <div>There are tasks!</div>
            @foreach ($tasks as $task)
                <div>{{$task->title}}</div>
            @endforeach
        @else
            <div>There are no tasks!</div>
        @endif --}}
    <div>
        <a href="{{route('tasks.create')}}" class='mylink'>ADD A TASK!</a>
    </div>

    @forelse ($tasks as $task)
         {{--crea un link per ogni title di ogni task--}}
        <a href="{{ route('tasks.show',['id'=>$task->id]) }}" @class(['font-bold','line-through'=>$task->completed])>  {{--assign the class only if the task is completed--}}
            @class(['font-bold','line-through'=>$task->completed]){{$task->title}}
        </a><br>
          {{--route() redirect + [] are given parameters --}}
          {{--['id'=>$task->id] la var id della singola route diventa uguale all'id proprietà della singola task--}}
    @empty  {{--playied only if $tasks is empty--}}
        <div>There are no task!</div>
    @endforelse
    @if($tasks->count())  {{--PAGINATION, used with pagination() in route insetad of get()--}}
        <nav class='mt-4'>
            {{$tasks->links()}}
        </nav>
    @endif
@endsection



