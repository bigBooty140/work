$(function() {
    $(".btn-r-custom .btn:not(.notransition)").mouseenter(function() {
        $(this).addClass("in");
    }).mouseleave(function() {
        $(this).removeClass("in");
    });
});