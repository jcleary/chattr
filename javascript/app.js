APP = {
    init: function() {
        APP.loggedIn();
    },

    loggedIn: function() {
        return false;
    }
}


$(function() {
    APP.init();
});