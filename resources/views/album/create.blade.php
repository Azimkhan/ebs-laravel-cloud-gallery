@extends('layouts.master')

@section('content')
    {!! Form::open(['route' => 'album.store']) !!}
    {!! Form::text('name'); !!}
    <input type="submit" value="Add">
    {!! Form::close() !!}
@endsection
