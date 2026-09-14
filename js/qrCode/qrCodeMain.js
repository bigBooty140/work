function drawQrCode(elem, textToCode, widgetWidth) {

    $(elem).empty();
    
    if($.browser.msie && $.browser.version<9) {
        $(elem).qrcode({
            render : "table",
            text : textToCode,
            correctLevel : QRErrorCorrectLevel.L,
            width : widgetWidth,
            height : widgetWidth
        });
    }
    else {
        $(elem).qrcode({
            text : textToCode,
            correctLevel : QRErrorCorrectLevel.L,
            width : widgetWidth,
            height : widgetWidth
        });
    }
}