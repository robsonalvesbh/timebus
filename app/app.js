var myApp = angular.module('appBus', [], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

myApp.controller("appCtrl", function ($scope, $http) {
    $scope.bus = [];
    $scope.horarios = [];

    $http.get('http://timebus.encontreumdoador.com.br/onibus')
        .success(function (response) {
            if (response.status == 200) {
                $scope.bus = angular.fromJson(response.dados);
            }
        }).error(function () {
        console.error('Arquivo .JSON não encontrado!');
    });

    $scope.getBus = function () {
        var linha = $scope.onibus.split(" - ");

        $http.get('http://timebus.encontreumdoador.com.br/onibus/' + linha[0])
            .success(function (response) {
                if (response.status == 200) {
                    $scope.horarios = angular.fromJson(response.dados.horarios);
                    $('html,body').animate({scrollTop: '520px'}, 'slow');
                }
            }).error(function () {
            console.error('Arquivo .JSON não encontrado!');
        });
    };

    $scope.download = function () {
        $scope.getBus();
        setTimeout(function () {

            var pdf = new jsPDF('p', 'pt', 'letter');
            var source = document.querySelector('#quadroHorario').innerHTML;

            var specialElementHandlers = {
                '#bypassme': function (element, renderer) {
                    return true;
                }
            };

            var margins = {
                top: 80,
                bottom: 60,
                left: 40,
                width: 522
            };

            pdf.fromHTML(
                source,
                margins.left,
                margins.top,
                {
                    'width': margins.width,
                    'elementHandlers': specialElementHandlers
                },
                function (dispose) {
                },
                margins
            );

            pdf.save($scope.onibus + '.pdf');

        }, 1000);
    };


    $scope.user = [];
    $scope.user = angular.fromJson(localStorage.getItem("TBClienteDados"));

    $scope.logar = function (login) {

        var transform = function (data) {
            return $.param(data);
        };

        $http({
            method: 'POST',
            url: 'http://timebus.encontreumdoador.com.br/usuario/logar',
            data: {
                email: login.email,
                senha: login.senha
            },
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            transformRequest: transform
        }).success(function (response) {

            if (response.status == 200) {
                if (typeof(Storage) !== "undefined") {
                    localStorage.setItem("TBClienteDados", angular.toJson(response.dados));
                } else {
                    alert("Encontramos um erro em seu Browser, utilize uma versão mais recente ou outro browser");
                }
                location.href = 'index.html';
            }
        }, function errorCallback(response) {
            alert("Dados incorretos");
        });
    }

    $scope.deslogar = function () {
        localStorage.removeItem('TBClienteDados');
        location.reload();
    }

    $scope.cadastrar = function (cadastro) {

        var transform = function (data) {
            return $.param(data);
        };

        $http({
            method: 'POST',
            url: 'http://timebus.encontreumdoador.com.br/usuario/cadastrar',
            data: {
                nome: cadastro.nome,
                email: cadastro.email,
                senha: cadastro.senha
            },
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            transformRequest: transform
        }).success(function (response) {
            if (response.status == 200) {
                if (typeof(Storage) !== "undefined") {
                    location.href = 'login.html';
                } else {
                    alert("Encontramos um erro em seu Browser, utilize uma versão mais recente ou outro browser");
                }
            }
        }, function errorCallback(response) {
            alert("Dados incorretos");
        });
    }

});

