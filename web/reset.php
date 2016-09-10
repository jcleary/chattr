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

        SurveyManager::create('Which do you prefer, tabs or spaces?', ['Tabs', 'Spaces'], 1, 0);
        SurveyManager::create('Is this an interesting talk?', ['Sort of', 'Not so much'], 1, 1);
        SurveyManager::create('Who east the most Pizza?', ['John', 'Hassan', 'Reiss', 'Brandon', 'Robin'], 1, 1);
    }
}

new ResetRequest();