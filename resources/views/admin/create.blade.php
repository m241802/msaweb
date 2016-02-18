@extends('app2')

@section('content')
    @include('admin.template.ang-images')
    <form action="{!! $route !!}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
        <h3>Create <span>{!! $type_content !!}</span></h3>
        <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
        <input type="hidden" name="type-content" id="type-content" value="{!! $type_content !!}">
        <div class="admin-title">
            <label >Name</label>
            <input type="text" name="title" size="40"/>
        </div>
        <div class="admin-slug">
            <label>Slug</label>
            <input type="text" name="slug" size="40"/>
        </div>
        <div class="post-gallery">
            <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
            <input type="file" name="images[]"multiple>
            <div ng-click="startLoop('id-file', 'files')">Выбрать из картинок</div>
        </div>
        <h4>Content</h4>
        <textarea id="content" name="content"></textarea>
        <h4>Exert</h4>
        <textarea id="excerpt" name="excerpt"></textarea>
        <p><input type="submit"></p>
    </form>
@endsection
