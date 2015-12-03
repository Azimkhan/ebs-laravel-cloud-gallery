@extends('layouts.master')

@section('content')
    {!! Form::open(['route' => 'photo.store','files' => true]) !!}
        {!! Form::file('picture') !!}<br/>
        {!! Form::select('album_id', $choices, $albumId) !!}<br/>
        <input id="" type="submit" value="Upload">
    {!! Form::close() !!}
@endsection
