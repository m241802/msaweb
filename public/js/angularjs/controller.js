var app = angular.module('catsApp', []);
app.directive('customOnChange', function() {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            var onChangeFunc = scope.$eval(attrs.customOnChange);
            element.bind('change', onChangeFunc);
        }
    };
});
app.controller('catsListCtrl', function($scope, $http) {
    /**
     * Get files
     * @param className
     * @param http_p
     */
    function getFiles(className, http_p) {
        var wrapp_attrs = document.getElementsByClassName(className);
        var attrs = [];
        for (var i = 0; i < wrapp_attrs.length; i++) {
            attrs[i] = wrapp_attrs[i].value;
        };
        $http.post('/'+'get-'+ http_p, { attrs }).success(function(response) {
            $scope.files = response;
        });
    }
    $scope.custom = false;
    $scope.newFiles = [];
    $scope.pageFiles = [];
    $scope.files = [];
    /**
     * get files pages
     *
     * @type {Element}
     */
    var postId = document.getElementById('id');
    if(postId != null){
        postId = postId.value;
        var typeContent = document.getElementById('type-content').value;
        $http.post('/initial-files', { postId, typeContent}).success(function(response) {
            $scope.pageFiles = response;
        });
    }
    /**
     * get rest files
     *
     * @param className
     * @param http_p
     */
    $scope.startLoop = function(className, http_p) {
        $scope.listFiles = $scope.listFiles === true ? false: true;
        getFiles(className, http_p);
    }
    /**
     * get all files
     *
     * @param className
     * @param http_p
     */
    $scope.filesLoad = function(className, http_p) {
        getFiles(className, http_p);
    }


    $scope.nextImage = function(index, file) {
        if(($scope.files.length-1) > index){
            $scope.imageSize2 = ++index;
        }
        else {
            $scope.imageSize2 = 0;
        }
        console.log($scope.imageSize2, $scope.files.length, file);
    }



    /**
     * add file in gallery
     *
     * @param index
     */
    $scope.addItem = function(index) {
        $scope.pageFiles.push($scope.files[index]);
        $scope.file = {};
        $scope.files.splice(index, 1)
    }
    /**
     * remove file in gallery
     *
     * @param index
     */
    $scope.removeItem = function(index) {
        $scope.files.push($scope.pageFiles[index]);
        $scope.file = {};
        $scope.pageFiles.splice(index, 1)
    }
    $scope.bigImage = function(index) {
        $scope.imageDisplay = $scope.imageDisplay === true ? false: true;
        $scope.imageSize2 = index;

        console.log(index);
    }


    $scope.increaseFile = function(obj) {
        console.log(obj);
    }








    /**
     * get rest files
     */
    $scope.uploadFiles = function() {
        var input = document.getElementById('uploadFiles');
        var file = input.files[0];
        var file2 = input.files;
        var objectFiles = new FileReader();
        objectFiles.readAsDataURL(file);
        console.log(objectFiles, file2);
        $http.post('/admin/files/upload', { objectFiles }).success(function(response) {
            $scope.newFiles = response;
        });
    }


});