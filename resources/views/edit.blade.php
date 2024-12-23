@extends('layouts.app')

@section('title', 'Edit Task')
@section('styles')
    <style>
        .error-message{color:red; font-size: 0.8rem;}
    </style>
@endsection
@section('content')
    {{--IF YOU WANT USE REUSABLING FORM (form.blade.php) INSTEAD OF THIS CONTENT--}}
        {{--include('form',['task'=>$task])  --}}
    {{-- {{$errors}}  see the errors in web page --}}
    <form method='POST' action='{{route('tasks.update',['id'=>$task->id])}}'>
        @csrf
        @method('PUT') {{--enables http method SPOOFING, you can use restful http verbs like PUT in html form that natively support only GET and POST. --}}
        <div>
            <label for="title"> Title</label>
            <input type="text" name='title' id='title' value='{{$task->title}}'> {{--name x server, id x DOM document object model--}}
            @error('title')
                <p class='error-message'>{{$message}}<p/>
            @enderror
        </div>
        <div>
            <label for='description'>Description</label>
            <textarea name="description" id="description" rows="3">{{$task->description}}</textarea>
            @error('description')
                <p class='error-message'>{{$message}}<p/>
            @enderror
        </div>
        <div>
            <label for='long_description'>Long Description</label>
            <textarea name="long_description" id="long_description" rows="8">{{$task->long_description}}</textarea>
            @error('long_description')
                <p class='error-message'>{{$message}}<p/>
            @enderror
        </div>
        <div>
            <button type='submit'>Edit Task</button>
        </div>
    </form>
@endsection

{{-- csfr middleware by laravel protect the users from the csrf attacks --}}
