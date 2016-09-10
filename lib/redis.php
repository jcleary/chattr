<?php

$redis = new Predis\Client(['host' => 'redis']);
$redis->connect();
