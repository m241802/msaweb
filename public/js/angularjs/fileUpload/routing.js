var codingTerminal = angular.module('codingTerminal', ['ui.router'])
    .config(function ($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.otherwise("/index.html");
        $stateProvider
            .state('fileUpload', {
                url: "/fileUpload",
                templateUrl: "fileUpload.html",
                controller: "fileUploadCtrl"
            });
});