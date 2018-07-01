<?php

namespace InFact;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Websocket implements MessageComponentInterface {

    public $clients;
    public $games;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->games = array();
        consolelog("server started");
    }

    public function onOpen(ConnectionInterface $player) {
        $this->clients->attach($player);
        consolelog("connected: {$player->resourceId}");
    }

    public function onClose(ConnectionInterface $player) {
        consolelog("disconnected: {$player->resourceId}");
        $this->clients->detach($player);
    }

    public function onMessage(ConnectionInterface $player, $message) {

        $router = new Router($this);
        $router->message($player, $message);

        consolelog("message {$player->resourceId}: $message");
    }

    public function onError(ConnectionInterface $player, \Exception $e) {
        consolelog("error: {$e->getMessage()}");
        $player->close();
    }

}