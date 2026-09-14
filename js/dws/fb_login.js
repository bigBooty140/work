function FacebookLogin(){}
FacebookLogin.prototype = {
    init: function(id){
        this.appId = parseFloat(id);
        var _this = this;
        (function(d){
            var js, id = 'facebook-jssdk';if (d.getElementById(id)) {return;}
            js = d.createElement('script');js.id = id;js.async = true;
            js.src = "//connect.facebook.net/en_US/all.js";
            d.getElementsByTagName('head')[0].appendChild(js);
        }(document));

        $(document).ready(function(){
            $('.fb-login-button').attr('onlogin', 'fbAuth()');
            window.fbAsyncInit = function() {
                FB.init({appId:_this.appId,status:true,cookie:true,xfbml:true,oauth:true});
            };
        });
    }
};
function fbAuth()
{
    FB.getLoginStatus(function(response) {
        if (response.status == 'connected') {
            statusOpen("Loading User Info...",0);
            $.ajax({
                type: 'POST',
                url: "/ajax",
                data: {token: response['authResponse']['accessToken'], oper: 'fb_login'},
                success: function(result){
                    if ( result['success']) {
                        location.reload();
                    } else {
                        var errorBlock = $('.dws_login_messages');
                        var errorText = result['error'];
                        if (errorBlock.length > 0) {
                            $('.dws_login_messages').html(errorText).css({color: 'red'});
                        } else {
                            alert(errorText);
                        }
                        statusRemove();
                    }
                }
            })
        }
    });
}

