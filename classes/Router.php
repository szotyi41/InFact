<?php
/**
 * Created by PhpStorm.
 * User: Szotyi Lehet
 * Date: 2018. 06. 30.
 * Time: 22:46
 */

namespace InFact;

use Ratchet\ConnectionInterface;

class Router
{

    public $websocket;
    public $message;
    public $player;
    public $action;

    function __construct($websocket)
    {
        $this->websocket = $websocket;
    }

    public function message(ConnectionInterface $player, $message) {

        $this->player = $player;
        $this->message = json_decode($message, true);
        $this->action = $this->message["action"];

        /* Player connecting route */
        $this->action("player-connect", function() {

            $remoteCode = $this->message["remoteCode"];

            $this->websocket->games[$remoteCode]["players"][] = array("playerName" => $this->message["playerName"], "resourceId" => $this->player->resourceId);

            $this->sendToGroup($this->websocket->games[$remoteCode], $this->websocket->games[$remoteCode]["players"]);
        });

    }

    public function sendToGroup($message, $playerGroup) {
        foreach ($this->websocket->clients as $client) {
            foreach ($playerGroup as $player) {
                if($player["resourceId"] == $client->resourceId) {
                    $client->send(json_encode($message, JSON_UNESCAPED_UNICODE));
                }
            }
        }
    }

    public function sendTo($message, ConnectionInterface $player) {
        foreach($this->websocket->clients as $client) {
            if($client == $player) {
                $client->send(json_encode($message, JSON_UNESCAPED_UNICODE));
                return;
            }
        }
    }

    public function sendToAll($message) {
        foreach($this->websocket->clients as $client) {
            $client->send(json_encode($message, JSON_UNESCAPED_UNICODE));
        }
    }

    public function action($actionString, $function) {
        if($actionString == $this->action) {
            $function();
        }
    }
}