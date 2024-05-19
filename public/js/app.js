var app = angular.module('myApp', []).constant('API', 'http://127.0.0.1:8000/');

// Định nghĩa một controller
app.controller('MyController', function ($scope, $http, $rootScope, API, $httpParamSerializerJQLike) {
    $http.get(API + 'user').then(function (response) {
        $scope.users = response.data;
    });

    // $scope.modal = function (state) {
    //     $scope.state = state;
    //     if (state == "add") {
    //         $scope.formTitle = "Add User";
    //     }
    //     if (state == "edit") {
    //         $scope.formTitle = "Edit User";
    //     }
    //     $("#formInsertUser").modal('show');
    // }

    // $scope.save = function (state) {
    //     if (state == "add") {
    //         var url = API + 'add-user';
    //         var data = $httpParamSerializerJQLike($scope.user);
    //         $http({
    //             method: 'POST',
    //             url: url,
    //             data: data,
    //             headers: {
    //                 'Content-Type': 'application/x-www-form-urlencoded'
    //             }
    //         })
    //         .then(function (response) {
    //             console.log(response.data);
    //             location.reload();
    //         })
    //         .catch(function (response) {
    //             console.error(response.data);
    //             alert("Error occurred while saving user.");
    //         });
    //     }
    // };

});