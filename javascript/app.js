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
                }
            );
        });
    }
}


$(function() {
    APP.init();
});