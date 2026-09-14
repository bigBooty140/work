$(document).ready(function () {
    if (typeof ga !== 'undefined') {
        ga(function (tracker) {
            var clientId = tracker.get('clientId');

            document.cookie = 'clientId=' + clientId;
        });
    }
});
