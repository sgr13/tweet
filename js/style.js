$(document).ready(function () {

    var p1 = $("#wtf");
    var offset1 = p1.offset();
    console.log(offset1);

    $('#wtf').animate({right: "+=150"}, 1);

    var p2 = $("#wtf");
    var offset2 = p2.offset();


    $('#wtf').mouseover(function() {
        var p1 = $("#wtf");
        var offset2 = p1.offset();
        console.log(offset1);
        $("#wtf").offset({ top: offset2.top, left: offset1.left});
    })

    $('#wtf').mouseleave(function() {
        var p1 = $("#wtf");
        var offset3 = p1.offset();
        $("#wtf").offset({ top: offset3.top, left: offset1.left});
        $("#wtf").offset({ top: offset3.top, left: -151.916671752929688});
    });

    $('.nav li').click(function () {
        $('.nav li').removeClass('active');
        $(this).addClass('active');
    })

});