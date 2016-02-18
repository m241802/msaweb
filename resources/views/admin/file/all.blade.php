@extends('app2')

@section('content')
    <h1>Upload file(s)</h1>
    <form action="/admin/files/upload"  method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
        <input name="_token" ng-model="token" type="hidden" value="{!! csrf_token() !!}" />
        <input type='file' id="uploadFiles" name="images" multiple><br>
        <br>
        <div type="submit" ng-click="uploadFiles()">Submit</div>
    </form>
    <h3>Список картинок</h3>
    <div data-ng-init="filesLoad('id-file', 'files')">
        <p>Общее количество картинок: {{ files.length }}</p>
        <input type="text" ng-model="query" placeholder="Поиск в картинках">
        <ul class="gallery">
            <li id="{{ file.id }}" ng-repeat="file in files | filter:query">
                <img ng-click="bigImage($index)" ng-src="{{ file.url }}" alt="{{ file.title }}" data-toggle="modal" data-target="#bigImage" class="img-thumbnail">
            </li>
        </ul>
    </div>
@stop
<div class="modal fade" id="bigImage" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ files[imageSize2].title }}</h4>
            </div>
            <div class="modal-body">
                <img ng-click="nextImage(imageSize2)" ng-src="{{ files[imageSize2].url2 }}" alt="{{ files[imageSize2].title }}" class="img-responsive centred">
                <div class="glyphicon glyphicon-menu-left"></div>
                <div class="glyphicon glyphicon-menu-right"></div>
            </div>
        </div>

    </div>
</div>