APP = {
    init: function() {
        APP.linkVoteButtons();
    },

    linkVoteButtons: function() {
        $('.vote-button').click( function() {
            var $surveyId = $(this).data('survey-id');
            var $optionId = $(this).data('option-id');
            $.post(
                '/vote.php',
                {
                    survey_id: $surveyId,
                    option_id: $optionId
                },
                function() {
                    APP.refreshChartData($surveyId);
                }
            );
        });
    },

    refreshChartData: function(surveyId) {

        $.post(
            '/survey.php',
            { survey_id: surveyId },
            function(data) {
                var surveyData = JSON.parse(data);
                var dataset = [];

                surveyData.options.forEach( function(entry) {
                    dataset.push(entry.votes);
                });

                var chart = charts[surveyId];
                chart.data.datasets[0].data = dataset;
                chart.update();
            }
        );

    },

    refreshGraphData: function() {
        setInterval(function(){
            // Add two random numbers for each dataset
            myLiveChart.addData([Math.random() * 100, Math.random() * 100], ++latestLabel);
            // Remove the first point so we dont just add values forever
            myLiveChart.removeData();
        }, 2000);
    }

}

$(function() {
    APP.init();
});