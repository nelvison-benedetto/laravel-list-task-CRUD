@extends('layouts.app')

@section('title', isset($task)? 'Edit Task': 'Add Task')
@section('styles')
    <style>
        .error-message{color:red; font-size: 0.8rem;}
    </style>
@endsection
@section('content')
    {{-- {{$errors}}  see the errors in web page --}}
    <form method='POST' action='{{isset($task) ? route('tasks.update',['task'=>$task->id])  : route('tasks.store')}}'>
        @csrf
        @isset($task)  {{--check if the var exists or not, se lo è executes his body--}}
            @method('PUT');
        @endisset
        <div>
            <label for="title"> Title</label>
            <input type="text" name='title' id='title' value='{{$task->title ?? old('title')}}'> {{--name x server, id x DOM document object model--}}
            @error('title')
                <p class='error-message'>{{$message}}<p/>
            @enderror
        </div>
        <div>
            <label for='description'>Description</label>
            <textarea name="description" id="description" rows="3">
                {{ $task->description ?? old('description')}}
            </textarea>  {{--old() ,works with only POST & don't use with passwords!!, retains the value in the form if corrected after the submit with some errors--}}
            @error('description')
                <p class='error-message'>{{$message}}<p/>
            @enderror
        </div>
        <div>
            <label for='long_description'>Long Description</label>
            <textarea name="long_description" id="long_description" rows="8">
                {{ $task->long_description ?? old('long_description')}}
            </textarea>
            @error('long_description')
                <p class='error-message'>{{$message}}<p/>
            @enderror
        </div>
        <div>
            <button type='submit'>
                @isset($task)
                        Update Task
                    @else
                        Add Task
                @endisset
            </button>
        </div>
    </form>
@endsection

{{-- csfr middleware by laravel protect the users from the csrf attacks --}}
