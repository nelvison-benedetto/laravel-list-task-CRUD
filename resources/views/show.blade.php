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
@endsection



