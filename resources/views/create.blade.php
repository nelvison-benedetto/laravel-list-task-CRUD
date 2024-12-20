@extends('layouts.app')

@section('title', 'Add Task')
@section('content')
    {{-- {{$errors}}  see the errors in web page --}}
    <form method='POST' action='{{route('tasks.store')}}'>
        @csrf
        <div>
            <label for="title"> Title</label>
            <input type="text" name='title' id='title'> {{--name x server, id x DOM document object model--}}
        </div>
        <div>
            <label for='description'>Description</label>
            <textarea name="description" id="description" rows="3"></textarea>
        </div>
        <div>
            <label for='long_description'>Long Description</label>
            <textarea name="long_description" id="long_description" rows="8"></textarea>
        </div>
        <div>
            <button type='submit'>Add Task</button>
        </div>
    </form>
@endsection

{{-- csfr middleware by laravel protect the users from the csrf attacks --}}
