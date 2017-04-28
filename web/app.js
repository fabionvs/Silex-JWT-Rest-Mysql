(function () {
    'use strict';

    angular
            .module('app', ['ui.router', 'ngMessages', 'ngStorage'])
            .config(config)
            .run(run);

    function config($stateProvider, $urlRouterProvider) {
        // default route
        $urlRouterProvider.otherwise("/");

        // app routes
        $stateProvider
                .state('home', {
                    url: '/',
                    templateUrl: 'home/index.view.html',
                    controller: function ($http, $scope, $stateParams) {
                        $http({
                            url: '/api/v1/cars',
                            method: 'GET',
                        }).success(function (response) {
                            $scope.cars = response;
                            // login successful if there's a token in the response
                        }).error(function (response) {
                            console.log(response);
                        });
                    },
                })
                .state('show', {
                    url: '/car/show/:id',
                    templateUrl: 'home/car.view.html',
                    controller: function ($http, $scope, $stateParams) {
                        var id = $stateParams.id;
                        $http({
                            url: '/api/v1/cars/' + id,
                            method: 'GET',
                        }).success(function (response) {
                            $scope.cars = response;
                            console.log(response);
                            // login successful if there's a token in the response
                        }).error(function (response) {
                            console.log(response);
                        });
                    },
                })
                .state('excluir', {
                    url: '/car/excluir/:id',
                    templateUrl: 'home/index.view.html',
                    controller: function ($http, $scope, $stateParams) {
                        var id = $stateParams.id;
                        $http({
                            url: '/api/v1/cars/' + id,
                            method: 'DELETE',
                        }).success(function (response) {
                            $scope.cars = response;
                            console.log(response);
                            window.location = '#/';
                            // login successful if there's a token in the response
                        }).error(function (response) {
                            console.log(response);
                        });
                    },
                })
                .state('new', {
                    url: '/car/new',
                    templateUrl: 'home/carForm.view.html',
                    controller: function ($http, $scope, $stateParams) {
                        $scope.myFunc = function (form) {
                            $http({
                                url: '/api/v1/cars/new',
                                method: 'POST',
                                data: form
                            }).success(function (response) {
                                $scope.cars = response;
                                console.log(response);
                                window.location = '#/';
                                // login successful if there's a token in the response
                            }).error(function (response) {
                                console.log(response);
                            });
                        }
                    },
                })
                .state('update', {
                    url: '/car/edit/:id',
                    templateUrl: 'home/carUpdate.view.html',
                    controller: function ($http, $scope, $stateParams) {
                        var id = $stateParams.id;
                        $http({
                            url: '/api/v1/cars/' + id,
                            method: 'GET',
                        }).success(function (response) {
                            $scope.cars = response;
                            console.log(response);
                            // login successful if there's a token in the response
                        }).error(function (response) {
                            console.log(response);
                        });
                        $scope.myFunc = function (form) {
                            $http({
                                url: '/api/v1/cars/edit/'+id,
                                method: 'POST',
                                data: form
                            }).success(function (response) {
                                $scope.cars = response;
                                console.log(response);
                                window.location = '#/';
                                // login successful if there's a token in the response
                            }).error(function (response) {
                                console.log(response);
                            });
                        }
                    },
                })
                .state('parts_new', {
                    url: '/parts/new/:id',
                    templateUrl: 'home/partsForm.view.html',
                    controller: function ($http, $scope, $stateParams) {
                        var id = $stateParams.id;
                        $http({
                            url: '/api/v1/cars/' + id,
                            method: 'GET',
                        }).success(function (response) {
                            $scope.cars = response;
                            console.log(response);
                            // login successful if there's a token in the response
                        }).error(function (response) {
                            console.log(response);
                        });
                        $scope.myFunc = function (form) {
                            $http({
                                url: '/api/v1/parts/new/'+id,
                                method: 'POST',
                                data: form
                            }).success(function (response) {
                                $scope.cars = response;
                                console.log(response);
                                window.location = '#/';
                                // login successful if there's a token in the response
                            }).error(function (response) {
                                console.log(response);
                            });
                        }
                    },
                })
                .state('parts_excluir', {
                    url: '/parts/excluir/:id',
                    templateUrl: 'home/index.view.html',
                    controller: function ($http, $scope, $stateParams) {
                        var id = $stateParams.id;
                        $http({
                            url: '/api/v1/parts/' + id,
                            method: 'DELETE',
                        }).success(function (response) {
                            $scope.cars = response;
                            console.log(response);
                            window.location = '#/';
                            // login successful if there's a token in the response
                        }).error(function (response) {
                            console.log(response);
                        });
                    },
                })
                .state('parts_update', {
                    url: '/parts/edit/:id',
                    templateUrl: 'home/partsUpdate.view.html',
                    controller: function ($http, $scope, $stateParams) {
                        var id = $stateParams.id;
                        $http({
                            url: '/api/v1/parts/part/' + id,
                            method: 'GET',
                        }).success(function (response) {
                            $scope.cars = response;
                            console.log(response);
                            // login successful if there's a token in the response
                        }).error(function (response) {
                            console.log(response);
                        });
                        $scope.myFunc = function (form) {
                            console.log(form);
                            $http({
                                url: '/api/v1/parts/edit/'+id,
                                method: 'POST',
                                data: {nome: form.nome, opcional: form.opcional}
                            }).success(function (response) {
                                console.log(response);
                                window.location = '#/';
                                // login successful if there's a token in the response
                            }).error(function (response) {
                                console.log(response);
                            });
                        }
                    },
                })
                .state('login', {
                    url: '/login',
                    templateUrl: 'login/index.view.html',
                    controller: 'Login.IndexController',
                    controllerAs: 'vm'
                });
    }

    function run($rootScope, $http, $location, $localStorage) {
        // keep user logged in after page refresh
        if ($localStorage.currentUser) {
            $http.defaults.headers.common.Authorization = 'Bearer ' + $localStorage.currentUser.token;
        }

        // redirect to login page if not logged in and trying to access a restricted page
        $rootScope.$on('$locationChangeStart', function (event, next, current) {
            var publicPages = ['/login'];
            var restrictedPage = publicPages.indexOf($location.path()) === -1;
            if (restrictedPage && !$localStorage.currentUser) {
                $location.path('/login');
            }
        });
    }
})();