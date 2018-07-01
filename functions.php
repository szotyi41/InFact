<?php

function consolelog($message) {
    $date = new DateTime("now");
    echo ($date->format("Y-m-d h:i:s"))." $message\n";
}