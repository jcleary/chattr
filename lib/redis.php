<?php

$redis = new Predis\Client(['host' => 'redis']);
$redis->connect();

function vote_for($optionId, $sessionId) {
    global $redis;
    $redis->sadd("option_id:session:$optionId", $sessionId);
    $redis->incr("option_id:counter:$optionId");
}


