@extends('app')
@section('content')
    <div class="container">
        <div class="right-column">
            @foreach($posts as $post)
                <article class="item-page">
                    <div class="top-article">
                        <a href="/faqs/{!! $post->slug !!}">
                            <h2>{!! $post->title !!}</h2>
                        </a>
                        <div class="public-excerpt">
                            @if(isset($post->files))
                                <div class="main-image">
                                    <img src="{!! reset($post->files)[1] !!}">
                                </div>
                            @endif
                            {!! $post->excerpt !!}
                        </div>
                    </div>
                    <div class="gallery-page">
                        @if(isset($post->files))
                            <h4>Галерея</h4>
                            @foreach($post->files as $file)
                                <img src="{!! $file[0] !!}" class="img-thumbnail">
                            @endforeach
                        @endif
                    </div>
                </article>
            @endforeach
            <div class="pagination-wrap">
                {!! $posts->render() !!}
            </div>
        </div>
    </div>
@stop