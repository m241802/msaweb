@extends('app2')

@section('content')
    @include('admin.template.ang-images')
    <form action="{!! $route !!}" method="post"  accept-charset="UTF-8" enctype="multipart/form-data">
        <h3>Edit <span>{!! $type_content !!}</span>: {!! $post[0]->title !!}</h3>
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input type="hidden" name="id" id="id" value="{!! $post[0]->id !!}">
        <input type="hidden" name="type-content" id="type-content" value="{!! $type_content !!}">
        <div class="admin-title">
            <label >Name</label>
            <input type="text" name="title" size="40" value="{!! $post[0]->title !!}">
        </div>
        <div class="admin-slug">
            <label>Slug</label>
            <input type="text" name="slug" size="40" value="{!! $post[0]->slug !!}">
        </div>
        <div class="post-gallery">
             <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
            <div class="gallery-panel">
                <h4>Галерея</h4>
                <button type="button" class="btn btn-primary" ng-click="startLoop('id-file', 'files')">Выбрать из уже загруженных</button>
                <div class="new-upload-button">
                    <a class='btn btn-primary' href='javascript:;'>
                        Загрузить новые
                        <input type="file" name="images[]" multiple size="40"  onchange='$("#upload-file-info").html($(this).val());'>
                    </a>
                    &nbsp;
                    <span class='label label-info' id="upload-file-info"></span>
                </div>
            </div>
            <ul class="gallery">
                <li id="{{ file.id }}" ng-repeat="file in pageFiles | filter:query">
                    <div>
                        <img ng-click="bigImage($index, 'pageFile')" ng-src="{{ file.url }}" alt="{{ file.title }}" data-toggle="modal" data-target="#bigImage" class="img-thumbnail">
                    </div>
                    <input class="id-file" name="images[]" type="hidden" value="{{ file.id }}">
                    <span class="in-gallery" ng-click="removeItem($index)">-</span>
                </li>
            </ul>
        </div>
        <h4>Content</h4>
        <textarea id="content" name="content">{!! $post[0]->content !!}</textarea>
        <h4>Exert</h4>
        <textarea id="excerpt" name="excerpt">{!! $post[0]->excerpt !!}</textarea>
        <button class="btn btn-primary">Отправить</button>
    </form>
@endsection