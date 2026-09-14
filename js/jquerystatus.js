var ua = navigator.userAgent.toLowerCase();
var isOpera = (ua.indexOf('opera') > -1);
var isIE = (!isOpera && ua.indexOf('msie') > -1);
var imageGifSrc = 'data:image/gif;base64,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';
var imageBackground = 'url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAAwklEQVRYhe3XXQqDMBhE0dtsIKvNwrOC+mIhTfNrlAzlm0eR4ShomFcI4U2WGGN+6Sfe++49d/S5O8tKWe37AqrhIAEq4uAEquIAnDIOCh/JStkTD9sE7sZB4w0q4KACVMFBAaiEgwyohoMEqIiDE6iKA3DKOBj4Uc+UPfGwQ8Cdx2EXuPusbgJ346ABVMBBBaiCA9sktknmyj6xTXK1zDbJalkrtklGykqxTTJTlsY2yZUysE2yVjYa2yS1sl7+cpMcegPyrqBRcaoAAAAASUVORK5CYII=)';

function statusOpen(text, el_id) {
    if ($('#' + el_id + ':visible').length || el_id == 0) {
        
        if ($('#idBackRect').length) {
            $('#idBackRect').remove();
        }

        var myWidth = 0;
        var myHeight = 0;
        var documentWidth = false;

        if (el_id == 0) {
            if ($('.mat-desk').length && ($(document).width() > $(window).width())) {

                myWidth = $(document).width();
                documentWidth = true;

            } else {
                myWidth = $(window).width();
            }
            myHeight = $(document).height();
        } else {
            myWidth = $('#' + el_id).width();
            myHeight = $('#' + el_id).height();
        }

        var left = 0;
        var top = 0;
        if (el_id != 0) {
            offset = $('#' + el_id).offset();
            left = offset.left;
            top = offset.top;
        }

        var top2 = ($(window).height() / 2) - 32;
        var elem_top = (myHeight / 2) - 20;	
        
        var idBackRect = '\n\
            <div id="idBackRect" style="z-index:10001;padding:0px;margin:0px;position:fixed;left:'+left+'px;top:'+top+'px;width:100%;height:110%;">\n\
                <div id="idBackCont" style="text-align:center;padding-top:'+(el_id == 0 ? top2 : elem_top)+'px"><img border="0" src="' + imageGifSrc + '"/>\n\
                    <br/>\n\
                    <font style="font-size:24px;color:#000">'+text+'</font>\n\
                </div>\n\
                <div style="background:' + imageBackground + ' repeat #AAAAAA;padding:0px;margin:0px;width:100%;height:100%;position:absolute;filter:progid:DXImageTransform.Microsoft.Alpha(opacity=30);-moz-opacity: 0.3;-khtml-opacity: 0.3;opacity: 0.3;zoom: 1;left:0px;top:0px"></div>\n\
            </div>';

        $('BODY').append(idBackRect);
        //$('BODY').attr('scrollTop', 0);

        var $idBackRect = $('#idBackRect');

        $idBackRect.data({
            'in_elem': (el_id != 0 ? el_id : false),
            'documentWidth': documentWidth
        });
        
        /*$idBackRect.css({
            'width':  myWidth.toString() + 'px',
            'height': myHeight.toString() +'px'
        });*/
    }
}

function statusRemove() {
    $('#idBackRect').remove();
    //$(window).trigger('resize');
}

