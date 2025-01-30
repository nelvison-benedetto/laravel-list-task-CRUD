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
        <div class='mb-4'>
            <label for="title">Title_ThisFormIsAlreadyInCreateBaldePhp</label>
            <input type="text" name='title' id='title'
                @class(['border-red-500'=>$errors->has('title')])
               class='border @error('title') border-red-500 @enderror'
            value='{{$task->title ?? old('title')}}'> {{--name x server, id x DOM document object model--}}
            @error('title')
                <p class='myerror'>{{$message}}</p>
            @enderror
        </div>
        <div class='mb-4'>
            <label for='description'>Description_ThisFormIsAlreadyInCreateBaldePhp</label>
            <textarea name="description" id="description" rows="5"
            @class(['border-red-500'=>$errors->has('description')])>
                {{ $task->description ?? old('description')}}
            </textarea>  {{--old() ,works with only POST & don't use with passwords!!, retains the value in the form if corrected after the submit with some errors--}}
            @error('description')
                <p class='myerror'>{{$message}}</p>
            @enderror
        </div>
        <div class='mb-4'>
            <label for='long_description'>Long Description_ThisFormIsAlreadyInCreateBaldePhp</label>
            <textarea name="long_description" id="long_description" rows="8"
            @class(['border-red-500'=>$errors->has('long_description')])>
                {{ $task->long_description ?? old('long_description')}}
            </textarea>
            @error('long_description')
                <p class='myerror'>{{$message}}</p>
            @enderror
        </div>
        <div class='flex gap-2'>
            <button type='submit' class='rounded-md px-4 py-2 text-white bg-blue-500 hover:bg-blue-600'>
                @isset($task)
                        Update Task
                    @else
                        Add Task
                @endisset
            </button>
            <a href="{{route('tasks.index')}}">Cancels</a>
        </div>
    </form>
@endsection

{{-- csfr middleware by laravel protect the users from the csrf attacks --}}
