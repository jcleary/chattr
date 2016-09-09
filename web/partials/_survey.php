<?php

$options = get_survey_options($survey_id);
?>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"><?=$survey_name ?></h3>
    </div>
    <div class="panel-body">
        <canvas id="canvas-survey-<?= $survey_id ?>" width="400" height="100" data-survey-id="<?= $survey_id ?>" class="graph-canvas"></canvas>
        <script>
            var surveyId = <?= $survey_id ?>;
            charts[surveyId] = new Chart($("#canvas-survey-<?= $survey_id ?>"), {
                type: 'bar',
                data: {
                    labels: [<? foreach($options as $option) { echo "\"$option[1]\","; } ?>],
                    datasets: [{
                        label: '# of votes',
                        data: [<? foreach($options as $option) { echo get_votes_for($option[0]) . ","; } ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        </script>

        <h4>Vote now!</h4>
        <?php

        foreach($options as $option) {
            echo '<button type="button" class="btn btn-success vote-button" data-survey-id="' . $survey_id . '" data-option-id="' . $option[0] . '">' . $option[1] . '</button> ';
        }
        ?>

    </div>
</div>
