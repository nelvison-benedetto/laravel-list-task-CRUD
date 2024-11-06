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


    @forelse ($tasks as $task)
         {{--crea un link per ogni title di ogni task--}}
        <a href="{{ route('tasks.show',['id'=>$task->id]) }}"> {{$task->title}} </a><br>
          {{--route() redirect + [] are given parameters --}}
          {{--['id'=>$task->id] la var id della singola route diventa uguale all'id proprietà della singola task--}}
    @empty  {{--playied only if $tasks is empty--}}
        <div>There are no task!</div>
    @endforelse
@endsection



