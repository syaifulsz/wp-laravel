@extends('layouts.blog')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        {!! $post->content !!}
    </div>
@endsection
