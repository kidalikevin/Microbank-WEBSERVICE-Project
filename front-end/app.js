var myApp = angular.module('bankApp', ['ngRoute', 'ngAnimate']);

myApp.config(function($routeProvider) {
  $routeProvider
  .when('/', {
    templateUrl: 'page-home.html',
    controller: 'BankController'
  })
  .when('/balance', {
    templateUrl: 'page-balance.html',
    controller: 'balanceController'
  })
  .when('/withdraw', {
    templateUrl: 'page-withdraw.html',
    controller: 'withdrawController'
  })
  .when('/deposit', {
    templateUrl: 'page-deposit.html',
    controller: 'depositController'
  });

});


// SENDING INFORMATION TO THE API END POINT

myApp.controller('depositController', function ($scope, $http, $interval) {

  $scope.fail = true;
  $scope.pass = true;

  $scope.deposit = function(){

    if($scope.account_balance.length == '')
    {
    alert('Filled can not be empty!');
    }else
    {

    var url = 'http://127.0.0.1:8000/bank/1';
    var config = {
      headers : {
        'Content-Type': 'application/json'
      }
    }

    var data = {
      'account_balance' : $scope.account_balance
    }

  var info = JSON.stringify(data);

    $http.put(url, info, config).then(function (response, status, headers, config) {
      // This function handles success
      $scope.pass = false;
      $scope.success = response.data;

      $interval(function () {
          $scope.pass = true;
	    }, 7000);

    }, function (response) {
      $scope.fail = false;
      // this function handles error
      $scope.warnings = response.data;

      $interval(function () {
            $scope.fail = true;
      }, 7000);

    });
  }

  }

});

// WITHDRAW FROM ACCOUNT
myApp.controller('withdrawController', function ($scope, $http, $interval) {

  $scope.fail = true;
  $scope.pass = true;

  $scope.withdraw = function(){

    if($scope.account_balance.length == '')
    {
    alert('Filled can not be empty!');
    }else
    {

    var url = 'http://127.0.0.1:8000/deduct/1';
    var config = {
      headers : {
        'Content-Type': 'application/json'
      }
    }

    var data = {
      'account_balance' : $scope.account_balance
    }

  var info = JSON.stringify(data);

    $http.put(url, info, config).then(function (response, status, headers, config) {
      // This function handles success
      $scope.pass = false;
      $scope.success = response.data;

      $interval(function () {
          $scope.pass = true;
	    }, 7000);

    }, function (response) {
      $scope.fail = false;
      // this function handles error
      $scope.warnings = response.data;

      $interval(function () {
            $scope.fail = true;
      }, 7000);

    });

  }

  }

});

myApp.controller('balanceController', function ($scope, $http) {
  $http.get("http://127.0.0.1:8000/bank/1").then(function(response) {
    $scope.balance = response.data;
    console.log(response);
  });
});


myApp.controller('BankController', function ($scope, $http) {
	   $scope.resetaccount = function(){

$http.get("http://127.0.0.1:8000/resetaccount").then(function(response) {
   location.reload();
  });

}

});
