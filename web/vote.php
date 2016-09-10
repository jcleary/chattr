<?php
require_once '../lib/app.php';

class VoteController extends Rest {

    public function post() {
        $sessionId = session_id();
        $surveyId = $_REQUEST['survey_id'];
        $optionId = $_REQUEST['option_id'];

        SurveyManager::vote($optionId, $sessionId);
    }
}

new VoteController();

