<div class="starter-template">
    <h1>Chattr</h1>
    <p class="lead">Your opinions ... in real-time</p>
</div>

<div>
    <?php
    $surveys = get_visible_surveys();
    foreach($surveys as $survey) {
        $survey_id = $survey[0];
        $survey_name = $survey[1];
        $can_vote = $survey[2];
        include '../partials/_survey.php';
    }
    ?>
</div>