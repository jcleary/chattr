<?php require_once 'lib/app.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="John Cleary">

  <title>Chattr</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.bundle.min.js"></script>
  <script src="javascript/app.js"></script>


  <style>
    body {
      padding-top: 50px;
    }
    .starter-template {
      padding: 10px 15px 15px;
      text-align: center;
    }
  </style>
</head>

<body>
  <script>
    charts = {}
  </script>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Chattr</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="add_survey.php">Add a Survey</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>

<div class="container">

  <div class="starter-template">
    <h1>Chattr</h1>
    <p class="lead">Your opinions ... in real-time</p>
  </div>

  <div>
    <?php
    $survey = get_current_survey();
    $id = $survey[0];
    $name = $survey[1];
    $options = get_survey_options($id);
    ?>
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title"><?=$name ?></h3>
      </div>
      <div class="panel-body">
        <canvas id="canvas-survey-<?= $id ?>" width="400" height="100" data-survey-id="<?= $id ?>"></canvas>
        <script>
          var surveyId = <?= $id ?>;
          charts[surveyId] = new Chart($("#canvas-survey-<?= $id ?>"), {
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
          echo '<button type="button" class="btn btn-success vote-button" data-survey-id="' . $id . '" data-option-id="' . $option[0] . '">' . $option[1] . '</button> ';
        }
        ?>

      </div>
    </div>

  </div>

</div><!-- /.container -->

</body>
</html>
