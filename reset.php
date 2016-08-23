<?php

require_once('lib/app.php');

$commands = [
    'DROP DATABASE IF EXISTS chattr',
    'CREATE DATABASE chattr',
    'CREATE TABLE chattr.surveys (id INT NOT NULL AUTO_INCREMENT, name varchar(255), PRIMARY KEY (id))',
    'CREATE TABLE chattr.survey_options (id INT NOT NULL AUTO_INCREMENT, survey_id INT NOT NULL, value varchar(255), PRIMARY KEY (id))'
];

global $redis;
$redis->flushAll();

db_exec($commands);

create_survey('Which do you prefer, tabs or spaces?', ['Tabs', 'Spaces']);
create_survey('Is this an interesting talk?', ['Sort of', 'Not so much']);



