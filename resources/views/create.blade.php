@extends('layouts.app')

@section('title', 'Add Task')
@section('styles')
    <style>
        .error-message{color:red; font-size: 0.8rem;}
    </style>
@endsection
@section('content')
    {{--IF YOU WANT USE REUSABLING FORM (form.blade.php) INSTEAD OF THIS CONTENT--}}
        {{--include('form')--}}
    {{-- {{$errors}}  see the errors in web page --}}
    <form method='POST' action='{{route('tasks.store')}}'>
        @csrf
        <div>
            <label for="title">XXTitle</label>
            <input type="text" name='title' id='title' value='{{old('title')}}' {{--name x server, id x DOM document object model--}}
            @class(['border-red-500'=>$errors->has('title')])
            class='border @error('title') border-red-500 @enderror'>
            @error('title')
                <p class='error-message'>{{$message}}<p/>
            @enderror
        </div>
        <div>
            <label for='description'>Description</label>
            <textarea name="description" id="description" rows="3" @class(['border-red-500'=>$errors->has('description')])>
                {{old('description')}}  {{--old() ,works with only POST & don't use with passwords!!, retains the value in the form if corrected after the submit with some errors--}}
            </textarea>
            @error('description')
                <p class='error-message'>{{$message}}<p/>
            @enderror
        </div>
        <div>
            <label for='long_description'>Long Description</label>
            <textarea name="long_description" id="long_description" rows="8" @class(['border-red-500'=>$errors->has('long_description')])>
                {{old('long_description')}}
            </textarea>
            @error('long_description')
                <p class='error-message'>{{$message}}<p/>
            @enderror
        </div>
        <div class='flex items-center gap-2'>
            <button type='submit' class='mybtn'>Add Task</button>
            <a href="{{route('tasks.index')}}" class='mylink'>Cancel</a>
        </div>
    </form>
@endsection

{{-- csfr middleware by laravel protect the users from the csrf attacks --}}
