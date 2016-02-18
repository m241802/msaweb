<div ng-show="listFiles" class="right-gallery">
    <h4>Картинки</h4>
    <p>Общее количество картинок: {{ files.length }}</p>
    <input type="text" ng-model="query" placeholder="Поиск в картинках">
    <ul class="gallery">
        <li id="{{ file.id }}" ng-repeat="file in files | filter:query">
            <div>
                <img ng-click="bigImage($index)" ng-src="{{ file.url }}" alt="{{ file.title }}" data-toggle="modal" data-target="#bigImage" class="img-thumbnail">
            </div>
            <a href="{{ file.url2 }}" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>
            <span class="in-gallery" ng-click="addItem($index)">+</span>
        </li>
    </ul>
</div>
<div class="modal fade" id="bigImage" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ files[imageSize2].title }}</h4>
            </div>
            <div class="modal-body">
                <img ng-click="nextImage(imageSize2, file)" ng-click="nextImage($index)" ng-src="{{ files[imageSize2].url2 }}" alt="{{ files[imageSize2].title }}" class="img-responsive centred">
                <div class="glyphicon glyphicon-menu-left"></div>
                <div class="glyphicon glyphicon-menu-right"></div>
            </div>
        </div>
    </div>
</div>