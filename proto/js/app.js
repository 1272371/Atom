var app = angular.module('myDashboard', ['ngRoute'])

app
.config(function($routeProvider) {
    $routeProvider
    .when('/', {
        templateUrl: 'pages/home.html',
        controller: 'HomeController'
    })
    .when('/grade-book', {
        templateUrl: 'pages/grade-book.html',
        controller: 'GradeBookController'
    })
    .when('/statistics', {
        templateUrl: 'pages/statistics.html',
        controller: 'StatisticsController'
    })
    .when('/upload-marks', {
        templateUrl: 'pages/upload-marks.html',
        controller: 'UploadMarksController'
    })
    .otherwise({redirectTo: '/'})
})
.run(function($rootScope, $location, $routeParams) {
    $rootScope.$on('$routeChangeSuccess', function() {

        // visual change change active tab
        var path = $location.path().substr(1)

        if (path === '') {
            $('li').attr('class', '')
            $('#home-tab').attr('class', 'active')
        }
        else if (path === 'grade-book') {
            $('li').attr('class', '')
            $('#grade-book-tab').attr('class', 'active')
        }
        else if (path === 'statistics') {
            $('li').attr('class', '')
            $('#statistics-tab').attr('class', 'active')
        }
        else if (path === 'upload-marks') {
            $('li').attr('class', '')
            $('#upload-marks-tab').attr('class', 'active')
        }
    })
})
// controls and binds data for the home page
.controller('HomeController', function($scope) {
    $scope.title = 'Home'

    // toggle sidebar on click
    $scope.sidebar = function() {
        $('#sidebar').toggleClass('active')
    }
})
// controls and binds data for the grade book page
.controller('GradeBookController', function($scope) {
    $scope.title = 'Grade Book'

    // toggle sidebar on click
    $scope.sidebar = function() {
        $('#sidebar').toggleClass('active')
    }
})
.controller('StatisticsController', function($scope) {
    $scope.title = 'Statistics'

    // toggle sidebar on click
    $scope.sidebar = function() {
        $('#sidebar').toggleClass('active')
    }
})
.controller('UploadMarksController', function($scope) {
    $scope.title = 'Upload Marks'

    // toggle sidebar on click
    $scope.sidebar = function() {
        $('#sidebar').toggleClass('active')
    }
})