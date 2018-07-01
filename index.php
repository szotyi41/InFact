<!DOCTYPE html>
<html>
<head>
    <title>Demo</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="Demo project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.2/angular.min.js"></script>
    <script src="scripts/main.js"></script>
</head>
<body ng-app="app">

<div ng-controller="gameconnecting">

    <input type="radio" name="device" id="player-device" ng-model="device" ng-value="'player'">
    <label for="player-device">Player</label>
    <input type="radio" name="device" id="remote-device" ng-model="device" ng-value="'remote'">
    <label for="remote-device">Remote</label>

    <div class="" ng-show="device == 'remote'">
        <h1>Local code is</h1>
    </div>

    <div class="" ng-show="device == 'player'">

        <label for="player-name">Player name</label>
        <input type="text" id="player-name" ng-model="playerName">

        <label for="remote-code">Remote code</label>
        <input type="text" id="remote-code" ng-model="remoteCode">

        <button ng-click="playerconnect()">Connect</button>
    </div>

    <div class="">
        <h1>Waiting for players</h1>

        <div class="" ng-repeat="player in playerList">
            <div class="">{{player.playerName}}</div>
        </div>

        <button ng-click="startgame()">Start game</button>
    </div>

    <div class="">
        <h1>Select a category</h1>

        <div class="" ng-repeat="category in categoryList">
            <div class="">{{category.categoryName}}</div>
        </div>
    </div>
</div>

</body>
</html>