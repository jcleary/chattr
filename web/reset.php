<?php
require_once '../lib/app.php';

class ResetRequest extends Rest {

    public function get() {
        $commands = [
            'DROP DATABASE IF EXISTS chattr',
            'CREATE DATABASE chattr',
            'CREATE TABLE chattr.surveys (id INT NOT NULL AUTO_INCREMENT, name varchar(255), visible BOOL NOT NULL DEFAULT 1, can_vote BOOL NOT NULL DEFAULT 1, PRIMARY KEY (id))',
            'CREATE TABLE chattr.survey_options (id INT NOT NULL AUTO_INCREMENT, survey_id INT NOT NULL, value varchar(255), PRIMARY KEY (id))'
        ];

        global $redis;
        $redis->flushAll();

        db_exec($commands);

        SurveyManager::create('Do you use Docker?', ['No', 'Not yet, but am considering it', 'Yes, in development', 'Yes, in production'], 1, 1);
        SurveyManager::create("What do you think is Docker\'s killer feature?", ['Its Cool', 'Can setup my dev like production', 'Easy to use', 'Better utilisation of production hardware'], 1, 1);
        SurveyManager::create('Do you think Docker is production ready?', ['Yes', 'Maybe', 'No'], 1, 1);
        SurveyManager::create('How much did you learn from this talk?', ['Heard it all before', 'A couple of useful bits of info', 'Quite a bit', 'Was too hard to follow'], 1, 1);
    }
}

new ResetRequest();