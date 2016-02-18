<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="/js/ckeditor/ckeditor.js" type="text/javascript" charset="utf-8" ></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
    <script src="/js/angularjs/controller.js"></script>
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
</head>
<body ng-app="catsApp" ng-controller="catsListCtrl">
    @include('menu-left-admin')
    <div class="col-md-9">
        <div class="panel panel-default">

            @yield('content')

        </div>
    </div>
    <script type="text/javascript">
        var element=document.getElementById('content');
        if(element){CKEDITOR.replace( 'content' );}
        var element=document.getElementById('excerpt');
        if(element){CKEDITOR.replace( 'excerpt' );}
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
