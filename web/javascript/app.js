APP = {
    init: function() {
        APP.linkVoteButtons();
        APP.setupChartRefresh();
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

    setupChartRefresh: function() {
        setInterval(function(){
            $('.graph-canvas').each(function(_index, canvas) {
                var surveyId = $(canvas).data('survey-id');
                APP.refreshChartData(surveyId);
            })
        }, 2000);
    }

}

$(function() {
    APP.init();
});