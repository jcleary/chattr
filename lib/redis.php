<?php

$redis = new Predis\Client([
    'host' => 'redis'
]);
$redis->connect();

function vote_for($surveyId, $optionId, $sessionId) {
    global $redis;

    $redis->set("$surveyId:$sessionId", $optionId);
}

