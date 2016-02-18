codingTerminal.controller('fileUploadCtrl', ['$scope', '$q', 'FileInputService', function ($scope, $q, FileInputService) {

    $scope.fileInputContent = "";
    $scope.onFileUpload = function (element) {
        $scope.$apply(function (scope) {
            var file = element.files[0];
            FileInputService.readFileAsync(file).then(function (fileInputContent) {
                $scope.fileInputContent = fileInputContent;
            });
        });
    };

}]);