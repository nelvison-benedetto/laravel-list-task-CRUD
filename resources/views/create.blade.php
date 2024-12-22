@extends('layouts.app')

@section('title', 'Add Task')
@section('styles')
    <style>
        .error-message{color:red; font-size: 0.8rem;}
    </style>
@endsection
@section('content')
    {{-- {{$errors}}  see the errors in web page --}}
    <form method='POST' action='{{route('tasks.store')}}'>
        @csrf
        <div>
            <label for="title"> Title</label>
            <input type="text" name='title' id='title'> {{--name x server, id x DOM document object model--}}
            @error('title')
                <p class='error-message'>{{$message}}<p/>
            @enderror
        </div>
        <div>
            <label for='description'>Description</label>
            <textarea name="description" id="description" rows="3"></textarea>
            @error('description')
                <p class='error-message'>{{$message}}<p/>
            @enderror
        </div>
        <div>
            <label for='long_description'>Long Description</label>
            <textarea name="long_description" id="long_description" rows="8"></textarea>
            @error('long_description')
                <p class='error-message'>{{$message}}<p/>
            @enderror
        </div>
        <div>
            <button type='submit'>Add Task</button>
        </div>
    </form>
@endsection

{{-- csfr middleware by laravel protect the users from the csrf attacks --}}
