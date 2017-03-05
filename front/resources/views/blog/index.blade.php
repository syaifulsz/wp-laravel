@extends('layouts.blog')

@section('content')
    <div class="container">
        @foreach ($posts as $post)
            {{-- {{ var_dump($post->featured_media->media_details['sizes']) }} --}}
            {{-- {{ var_dump($post->toArray()) }} --}}
            <div class="panel  panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $post->title }}</h3>
                </div>
                <div class="panel-body  clearfix">
                    @if ($post->featured_media->media())
                        <a href="{{ $post->link }}" class="thumbnail  pull-left">
                            <img src="{{ $post->featured_media->media() }}" alt="{{ $post->title }}">
                        </a>
                    @endif
                    <pre>{{ $post->excerpt() }}</pre>
                    <div class="clearfix">
                        <a href="{{ $post->link }}" class="btn  btn-primary  pull-right" role="button">Read More</a>
                    </div>
                    <hr>
                    <div class="text-muted cf">
                        @if ($post->author->avatar())
                            <a href="{{ $post->link }}" class="pull-left">
                                <img src="{{ $post->author->avatar() }}" alt="{{ $post->title }} - {{ $post->author->name }}" class="img-circle">
                            </a>
                        @endif
                        <strong>Author:</strong> {{ $post->author->name }}
                    </div>
                    <div class="text-muted">
                        <strong>Created at:</strong> {{ $post->created_at->format('Y-m-d') }}, <strong>Modified at:</strong> {{ $post->modified_at->format('Y-m-d') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
