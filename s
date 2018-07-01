#!/usr/bin/php
<?php

require_once "vendor/autoload.php";
require_once "functions.php";

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use InFact\Websocket;

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Websocket()
        )
    ),
    8080
);

$server->run();