/**
 * @param text
 * @param type - null is default message, type = 1 is warning, type = 2 is error
 * @param duration - message lifetime in milliseconds (0 - sticky)
 */
function jalert(text, type, duration) {
	duration = duration || 0;

    var params = {};

    // Location (IE10)
    if (!window.location.origin) {
        window.location.origin = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port: '');
    }

    // Verification and templates for relogin msg
    var RELOGIN_VERIFICATION = 'Your session has expired, please relogin';
    var RELOGIN_TEMPLATE = 'Your session has expired, please <a href="' + window.location.origin + '/dms/login' + '" target="_blank">relogin</a>';

    // Message type
    if(text == RELOGIN_VERIFICATION) {
        text = RELOGIN_TEMPLATE;
    }

	switch (type) {
		case 1:
		case 'warning':
            params.theme = 'jgrowl_warning_alert';
			break;
		case 2:
		case 'error':
            params.theme = 'jgrowl_error_alert';
            params.header = 'ERROR:';
			break;
		default:
            params.theme = 'jgrowl_default_alert';
            duration = duration || 3000;
	}

    if (duration) {
        params.life = duration;
    } else {
        params.sticky = true;
    }

    $.jGrowl(text, params);
}


function getClientWidth()
{
    return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientWidth:document.body.clientWidth;
}

function getClientHeight()
{
    return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientHeight:document.body.clientHeight;
            }


jQuery.fn.center = function()
{
    var w = $(window);
    this.css("position","absolute");
    this.css("top",(getClientHeight()-this.height())/2 + "px");
    this.css("left",(getClientWidth()-this.width())/2 + "px");
    return this;
}