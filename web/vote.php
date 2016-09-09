<?php
require_once 'lib/app.php';

$sessionId = session_id();
$surveyId = $_REQUEST['survey_id'];
$optionId = $_REQUEST['option_id'];


vote_for($optionId, $sessionId);