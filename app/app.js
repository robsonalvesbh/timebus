var myApp = angular.module('appBus', [], function($interpolateProvider) {
   $interpolateProvider.startSymbol('[[');
   $interpolateProvider.endSymbol(']]');
});

myApp.controller("MyCtrl", function($scope, $http)
{
   $scope.bus = [];
   $scope.horarios = [];

   $http.get('http://timebus.encontreumdoador.com.br/onibus')
   .success(function(response) {
      if (response.status == 200)
      {
         $scope.bus = angular.fromJson(response.dados);
      }
   }).error(function() {
      console.error('Arquivo .JSON não encontrado!')
   });

   $scope.getBus = function( ) {
      var linha = $scope.onibus.split(" - ");

      $http.get('http://timebus.encontreumdoador.com.br/onibus/'+ linha[0])
      .success(function(response) {
         if (response.status == 200)
         {
            $scope.horarios = angular.fromJson(response.dados.horarios);
         }
      }).error(function() {
         console.error('Arquivo .JSON não encontrado!');
      });
   }

   $scope.download = function( ) {
      alert('ok');
   }

});

