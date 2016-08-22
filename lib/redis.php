<?php

$redis = new Predis\Client([
    'host' => 'redis'
]);
$redis->connect();

function vote_for($optionId, $sessionId) {
    global $redis;

    $key = "option_id:$optionId";
    $redis->sadd($key, $sessionId);
}

function get_votes_for($optionId) {
    global $redis;

    $key = "option_id:$optionId";
    return count($redis->smembers($key));
}

