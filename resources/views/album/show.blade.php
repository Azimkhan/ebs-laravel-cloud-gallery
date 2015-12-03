@extends('layouts.master')

@section('content')
    @foreach($album->photos as $photo)
        <img src="{{ $photo->fileUrl() }}" alt="" style="width:400px; display:block;"/>
    @endforeach

    <hr>
    <a href="{{ route('photo.create', ['album_id' => $album->id]) }}">Upload photo</a>
@endsection
