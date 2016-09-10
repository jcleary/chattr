<?php
require_once '../lib/app.php';

class SurveyController extends Rest {

    public function get() {
        $surveyId = $_REQUEST['survey_id'];

        $survey = SurveyManager::find($surveyId);
        $options = SurveyManager::options($surveyId);

        $responseOptions = [];
        foreach($options as $option) {
            $responseOptions[] = [
                'id' => $option['id'],
                'name' => $option['name'],
                'votes' => $option['votes']
            ];
        }

        $response = [
            'id' => $surveyId,
            'name' => $survey['name'],
            'options' => $responseOptions
        ];

        echo json_encode($response);
    }
}

new SurveyController();