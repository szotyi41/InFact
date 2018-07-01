
(function() {
    'use strict';

    var $ws = new WebSocket('ws://localhost:8080');

    var app = angular.module("app", []);
    app.controller("gameconnecting", function($scope, $rootScope) {

        $scope.categoryList = [{categoryName: "Sport"}, {categoryName: "History"}];

        $ws.onopen = function(e) {
            console.log("You are in good place");
        };

        $ws.onclose = function(e) {
            console.log("You are in wrong place");
        }

        $ws.onmessage = function(e) {
            $scope.playerList = JSON.parse(e.data).players;
            console.log($scope.playerList);
            $scope.$apply();
        };

        $scope.playerconnect = function() {

            var message = {
                action: "player-connect",
                remoteCode: $scope.remoteCode,
                playerName: $scope.playerName
            };

            $ws.send(JSON.stringify(message));
        }

    });

}());

