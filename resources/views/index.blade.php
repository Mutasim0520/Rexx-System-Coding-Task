@extends('layouts.layout')
@section('content')
    <div>
        Welcome
        <form enctype="multipart/form-data" method="post" action="{{Route('store.json')}}">
        {{csrf_field()}}
        Upload JSON file <input type ='file' name='json_file'>
        <input type='submit' value = 'Submit'>
        </form>
    </div>
@endsection