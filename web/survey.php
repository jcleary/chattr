<?php
require_once '../lib/app.php';

$surveyId = $_REQUEST['survey_id'];

$survey = get_survey($surveyId);
$options = get_survey_options($surveyId);

$responseOptions = [];
foreach($options as $option) {
    $responseOptions[] = [
        'id' => $option[0],
        'name' => $option[1],
        'votes' => get_votes_for($option[0])
        ];
}

$response = [
    'id' => $surveyId,
    'name' => $survey[1],
    'options' => $responseOptions
];

echo json_encode($response);
