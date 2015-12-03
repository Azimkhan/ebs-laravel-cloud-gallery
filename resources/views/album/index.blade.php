@extends('layouts.master')

@section('content')
@foreach($albums as $album)
    <div class="album">
        <a href="{{ route('album.show', [$album->id])}}">{{ $album->name }}</a>
    </div>

@endforeach
<hr>
<a href="{{ route('album.create')}}">Create</a>
@endsection
