<div class="starter-template">
    <h1>Chattr</h1>
    <p class="lead">Your opinions matter</p>
</div>

<div>
    <?php

    $surveys = SurveyManager::all(1);
    foreach($surveys as $survey) {
        $survey_id = $survey['id'];
        $survey_name = $survey['name'];
        $can_vote = $survey['can_vote'];
        include '../partials/_survey.php';
    }
    ?>
</div>