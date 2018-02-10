<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE = edge">
        <meta http-equiv="Content-type" name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width">
        <script src = "view/js/jquery-1.11.3.min.js"></script>
        <script src = "view/js/jquery-1.11.3.min.js"></script>
        <script src= "view/js/angular.min.js"></script> 
        <script src= "view/js/category.js"></script> 
        <script src= "view/js/bootstrap.min.js"></script> 
        <link href="view/css/bootstrap.min.css" rel="stylesheet">
        <link href="view/css/font-awesome.css" rel="stylesheet">
        <link href="view/css/category.css" rel="stylesheet">
        <style>
            .test {
                color: red;
            }

            .test1 {color:green;}
        </style>
        <script>
            var usermail = "<?php echo $email; ?>";
        </script>
    </head>
    <body ng-app = "myApp">
        <div id="category" class="container-fluid" ng-controller = "genericCtrl" >

            <div ng-show="webStore">
                <fieldset class="responsive-fieldset" ng-controller = "featuredCtrl">
                    <legend>Featured</legend>
                    <category-directive></category-directive>
                </fieldset>

                <hr/>

                <fieldset class="responsive-fieldset" ng-controller = "categoriesCtrl">
                    <legend>Categories</legend>
                    <ul class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-center" ng-repeat='val in result track by $index' style= "display:inline-block;border:1px solid grey;margin-bottom:0px">
                        <li style="padding-top:5px" ng-click="goCategory(val.category)"><a href="#"><img ng-src = "{{val.image}}" class="icon"></img></a></li>				
                        <li><strong>{{val.category}}</strong></li>
                    </ul>

                </fieldset>

                <hr/>

                <fieldset class="responsive-fieldset" ng-controller = "newCtrl">
                    <legend>New</legend>
                    <category-directive></category-directive>
                </fieldset>

                <hr/>
                <fieldset class="responsive-fieldset" ng-controller = "videoMusicCtrl">
                    <legend>Video & Music</legend>
                    <category-directive></category-directive>				
                </fieldset>


                <hr/>
                <fieldset class="responsive-fieldset" ng-controller = "toolCtrl">
                    <legend>Tool</legend>
                    <category-directive></category-directive>
                </fieldset>

                <hr/>			 
                <fieldset class="responsive-fieldset" ng-controller = "lifeStyleCtrl">
                    <legend>Life Style</legend>
                    <category-directive></category-directive>
                </fieldset>

            </div>
            <div id="mainCategory" ng-show="!webStore" ng-controller = "mainCategoryCtrl">

                <main-directive></main-directive>
            </div>

        </div>

    </body>
</html>
<hr/>
