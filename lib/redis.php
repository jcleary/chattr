<?php

$redis = new Predis\Client([
    'host' => 'redis'
]);
$redis->connect();

function vote_for($optionId, $sessionId) {
    global $redis;
    $redis->sadd("option_id:session:$optionId", $sessionId);
    $redis->incr("option_id:counter:$optionId");
}

function get_votes_for($optionId) {
    global $redis;
    return $redis->get("option_id:counter:$optionId");
}

