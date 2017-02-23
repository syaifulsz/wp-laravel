@extends('layouts.blog')

@section('content')
    <div class="container">
        <h1>List of available posts</h1>
        <ul>
            @foreach ($posts as $post)
                <li><a href="{{ $post->link }}">{{ $post->title }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
