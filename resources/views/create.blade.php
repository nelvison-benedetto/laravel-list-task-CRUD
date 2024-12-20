@extends('layouts.app')

@section('title', 'Add Task')
@section('content')
    <form method='POST' action='{{route('tasks.store')}}'>
        @csrf
        <div>
            <label for="formtitle">
                Title
            </label>
            <input type="text" name='formtitle' id='formtitle'> {{--name x server, id x DOM document object model--}}
        </div>
        <div>
            <label for='formdescription'>Description</label>
            <textarea name="formdescription" id="formdescription" rows="3"></textarea>
        </div>
        <div>
            <label for='formlongdescription'>Long Description</label>
            <textarea name="formlongdescription" id="formlongdescription" rows="8"></textarea>
        </div>
        <div>
            <button type='submit'>Add Task</button>
        </div>
    </form>
@endsection

{{-- csfr middleware by laravel protect the users from the csrf attacks --}}
