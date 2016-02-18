@extends('app2')

@section('content')
    <h1>Upload file(s)</h1>
    <form action="/admin/files/upload"  method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
    <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
    <input type="file" name="images[]"multiple>
    <br>
    <button type="submit">Submit</button>
    </form>
    <div ng-click="addFiles('files')">Добавить файлы</div>
    <h3>Список картинки</h3>
    @foreach($images as $image)
        <article class="loop-images">
            <h4>{!! $image->title !!}</h4>
            <p>
                <a title="увиличить" rel="example_group" href="/uploads/{!! $image->destinationPath !!}/{!! $image->slug !!}.{!! $image->type !!}" class="button">
                    <img src="/uploads/{!! $image->destinationPath !!}/{!! $image->slug !!}-{!! $image->size[1] !!}.{!! $image->type !!}" alt="{!! $image->title !!}">
                </a>
            </p>
            <p>
              {!! $image->created_at !!}
            </p>
        </article>
    @endforeach
@stop