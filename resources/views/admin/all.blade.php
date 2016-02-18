@extends('app2')

@section('content')
    @foreach($posts as $post)
        <article>
            <a href="{!! $base_url !!}/{!! $post->id !!}">
                <h2>{!! $post->title !!}</h2>
            </a>
            {!! $post->excerpt !!}
            @if(isset($post->files))
                @foreach($post->files as $file)
                    <img src="{!! $file[0] !!}">
                @endforeach
            @endif
            <p>
                published: {!! $post->published_at !!}
            </p>
        </article>
    @endforeach
    <div class="pagination-wrap">
        {!! $posts->render() !!}
    </div>
@stop