var app = angular.module('myApp', []);
app.constant('myConfig', {
    url: "?route=webstore/sites",
    imgUrl: 'view/img/',
    postUrl: '?route=user/store/addtouserstore'

})
app.run(function ($rootScope) {

    $rootScope.webStore = true;
    $rootScope.category = 'Tools';
    $rootScope.abc = true;
    $rootScope.checkStatus = " ? 'fa-plus' : 'fa-check' ";
    $rootScope.getStatus = function (value) {
        console.log(value);
        return parseInt(value);
    }

});
app.factory('fetchFactory', function ($http, myConfig, $rootScope) {

//console.log(myConfig);
    var factory = {};
    factory.getData = function () {

        var promise = $http.get(myConfig.url + "&email=" + usermail);
        //var promise = $http.get('test.json');
        return promise;
    };
    return factory;
});
app.controller('genericCtrl', ['$scope', 'fetchFactory', 'myConfig', '$rootScope', '$http', '$filter', function ($scope, fetchFactory, myConfig, $rootScope, $http, $filter) {

        var completeData = [];
        var categoryDataValue = [];
        fetchFactory.getData().then(function (response) {

            for (var o in response.data.data) {
                var obj = response.data.data[o];
                var temp = {};
                temp.id = obj.id;
                temp.image = myConfig.imgUrl + obj.image;
                temp.title = obj.title;
                temp.site = obj.site;
                temp.detail = obj.detail;
                temp.category = obj.category;
                temp.status = obj.status;
                completeData.push(temp);
            }
            $scope.$broadcast('getResult', {message: completeData});
        }, function (err) {
            console.log(err);
        });
        $scope.$on('categoryData', function (event, args) {

            console.log(args.data);
            categoryDataValue = $filter('filter')(completeData, {category: args.data});
            $rootScope.webStore = false;
            $scope.$broadcast('getCategoryData', {'data': categoryDataValue, 'category': args.data});
        });
        $scope.addItem = function (id) {
            /*$http.post(myConfig.postUrl,{id:id,email:'kly@gmail.com'}).then(function(data){console.log(data);},function(err){	console.log(err);});*/
            $http({
                url: myConfig.postUrl,
                method: "GET",
                params: {id: id, email: usermail},
            }).then(
                    function (data) {
                        console.log(data);
                        $scope.sendNewData(id, 0);
                    },
                    function (err) {
                        console.log(err);
                    });
        };
        $scope.sendNewData = function (id, newStatus) {
            for (var o in completeData) {
                var obj = completeData[o];
                if (obj.id == id) {
                    obj.status = newStatus;
                    break;
                }

            }
            $scope.$broadcast('getResult', {message: completeData});
        };
    }]);
app.controller('categoriesCtrl', ['$scope', 'fetchFactory', 'myConfig', function ($scope, fetchFactory, myConfig) {

        $scope.$on('getResult', function (event, args) {
            $scope.curvalue = 'category';
            var categories = [];
            $scope.result = [];
            for (var o in args.message) {
                var obj = args.message[o];
                if (obj.category != 'Featured' && obj.category != 'New' && search(categories, obj.category) == 0) {
                    $scope.result.push(obj);
                }
            }
        });
        function search(categories, prop) {
            for (var o in categories) {
                var obj = categories[o];
                if (obj == prop)
                    return 1;
            }
            categories.push(prop);
            return 0;
        }

        $scope.goCategory = function (val) {
            $scope.$emit('categoryData', {'data': val});
        };
    }]);
app.controller('featuredCtrl', ['$scope', 'myConfig', '$filter', function ($scope, myConfig, $filter) {

        $scope.$on('getResult', function (event, args) {
            $scope.result = $filter('filter')(args.message, {category: 'Featured'});
        });
        $scope.go = function () {
            $scope.$emit('categoryData', {'data': 'Featured'});
        };
    }]);
app.controller('lifeStyleCtrl', ['$scope', 'myConfig', '$filter', function ($scope, myConfig, $filter) {

        $scope.$on('getResult', function (event, args) {
            $scope.result = $filter('filter')(args.message, {category: 'Life Style'});
        });
        $scope.go = function () {
            $scope.$emit('categoryData', {'data': 'Life Style'});
        };
    }]);
app.controller('newCtrl', ['$scope', 'myConfig', '$filter', function ($scope, myConfig, $filter) {

        $scope.$on('getResult', function (event, args) {
            $scope.result = $filter('filter')(args.message, {category: 'Featured'});
        });
        $scope.go = function () {
            $scope.$emit('categoryData', {'data': 'Featured'});
        };
    }]);
app.controller('toolCtrl', ['$scope', 'myConfig', '$filter', function ($scope, myConfig, $filter) {

        $scope.$on('getResult', function (event, args) {
            $scope.result = $filter('filter')(args.message, {category: 'Tools'});
        });
        $scope.go = function () {
            $scope.$emit('categoryData', {'data': 'Tools'});
        };
    }]);
app.controller('videoMusicCtrl', ['$scope', 'myConfig', '$rootScope', '$filter', function ($scope, myConfig, $rootScope, $filter) {

        $scope.$on('getResult', function (event, args) {
            $scope.result = $filter('filter')(args.message, {category: 'Video&Music'});
        });
        $scope.go = function () {
            $scope.$emit('categoryData', {'data': 'Video&Music'});
        };
    }]);
app.controller('mainCategoryCtrl', ['$scope', 'myConfig', '$rootScope', function ($scope, myConfig, $rootScope) {


        $scope.$on('getCategoryData', function (event, args) {
            $scope.result = args.data;
            $scope.curCategory = args.category;
            //$("body").scrollTop(0);		
            document.getElementsByTagName('body')[0].scrollTop = 0;
        });
        $scope.back = function () {

            $rootScope.webStore = true;
        };
    }]);
app.directive('categoryDirective', function () {

    return {
        restrict: 'E',
        template:
                "<ul class='col-xs-12 col-sm-12 col-md-12 col-lg-12' ng-repeat='val in result | limitTo : 5 track by $index' style= 'border:1px solid grey'>" +
                "<ul class='col-xs-2 col-sm-1 col-md-1 col-lg-1 iconImageHeight' >" +
                "<li class='iconImagePosition'><a href='{{val.site}}'><img ng-src = '{{val.image}}' class='icon'></img></a></li>" +
                "</ul>" +
                "<ul class='col-xs-8 col-sm-10 col-md-10 col-lg-10' style= 'display:inline-block;>" +
                "<li class='title'><a class='news' href='{{val.site}}'> {{val.title}} </a> </li>" +
                "<li><i ng-class ='{colorStar:true == true}' class='fa fa-star' ng-repeat = 'x in [1,2,3,4,5] track by $index'></i></li>" +
                "<li><a class='news' href='{{val.site}}'> {{val.detail}} </a> </li>" +
                "</ul>" +
                "<ul class='col-xs-2 col-sm-1 col-md-1 col-lg-1 plusTable' '>" +
                "<li class='plusCell' ng-click='addItem(val.id)'><a href='#'><i ng-class = getStatus(val.status){{checkStatus}} class='fa fa-2x'></i></a></li>" +
                "</ul>" +
                "</a>" +
                "</ul>" +
                "<button ng-click='go()' class='btn btn-default col-xs-12 col-sm-12 col-md-12 col-lg-12 seeMore'> See More ></button>"

    }

});
app.directive('mainDirective', function () {

    return {
        restrict: 'E',
        template:
                "<ul class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>" +
                "<li class='col-xs-1 col-sm-1 col-md-1 col-lg-1 verticalLine'><a href ='#'><i class='fa fa-chevron-left' ng-click='back()'></i></a></i></li><li class='col-xs-11 col-sm-11 col-md-11 col-lg-11 text-center'><strong>{{curCategory}}</strong></li>" +
                "</ul>" +
                "<hr/>" +
                "<ul class='col-xs-12 col-sm-12 col-md-12 col-lg-12' ng-repeat='val in result track by $index' style= 'border:1px solid grey'>" +
                "<ul class='col-xs-2 col-sm-1 col-md-1 col-lg-1 iconImageHeight' >" +
                "<li class='iconImagePosition'><a href='{{val.site}}'><img ng-src = '{{val.image}}' class='icon'></img></a></li>" +
                "</ul>" +
                "<ul class='col-xs-8 col-sm-10 col-md-10 col-lg-10 verticalLine' style= 'display:inline-block;'>" +
                "<li class='title'><a class='news' href='{{val.site}}'> {{val.title}} </a> </li>" +
                "<li ng-class ='{colorStar:true == true}' style='display:inline-block;' ng-repeat = 'x in [1,2,3,4,5] track by $index'><i class='fa fa-star'></i></li>" +
                "<li><a class='news' href='{{val.site}}'> {{val.detail}} </a> </li>" +
                "</ul>" +
                "<ul class='col-xs-2 col-sm-1 col-md-1 col-lg-1 plusTable' >" +
                "<li class='plusCell' ng-click='addItem(val.id)'><a href='#'><i ng-class = getStatus(val.status){{checkStatus}} class='fa fa-2x'></i></a></li>" +
                "</ul>" +
                "</a>" +
                "</ul>" + "<hr/>"


    }

});
app.controller('SettingsController', function ($scope) {
    $scope.obj = {
        value1: 0,
        value2: 1
    }

    $scope.checkValue1 = function () {
        return $scope.obj.value1;
    }
});