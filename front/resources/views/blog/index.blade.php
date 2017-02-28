@extends('layouts.blog')

@section('content')
    <div class="container">
        {{-- <li><a href="{{ $post->link }}">{{ $post->title }}</a></li> --}}
        <div class="row">
        @foreach ($posts as $post)
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="http://placehold.it/350x150" alt="{{ $post->title }}">
                        <div class="caption">
                            <h2>{{ $post->title }}</h2>
                            {!! $post->excerpt !!}
                            <p><a href="{{ $post->link }}" class="btn btn-primary" role="button">Read</a>
                        </div>
                    </div>
                </div>
        @endforeach
        </div>
    </div>
@endsection
