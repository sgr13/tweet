$(document).ready(function () {

    var p1 = $("#wtf");
    var offset1 = p1.offset();

    $('#wtf').animate({right: "+=150"}, 1);

    var p2 = $("#wtf");
    var offset2 = p2.offset();


    $('#wtf').mouseover(function() {
        var p1 = $("#wtf");
        var offset2 = p1.offset();
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

    $('.commentMain').hide();

    $('.commentButton').click(function () {
        if (!$(this).parent().parent().parent().next().hasClass('visible')) {
            $(this).parent().parent().parent().next().show();
            $(this).parent().parent().parent().next().addClass('visible');
            $(this).html('Ukryj');
        } else {
            $(this).parent().parent().parent().next().hide();
            $(this).parent().parent().parent().next().removeClass('visible');
            $(this).html('Pokaż');
        }
    })

    $('#dataChange').hide();

    $('#dataChangeBtn').click(function() {
        if (!$(this).parent().next().children().hasClass('visible')) {
            $(this).parent().next().attr('id', 'mainUnlogged');
            $(this).parent().next().children().show();
            $(this).html('Ukryj');
            $(this).parent().next().children().addClass('visible');
        } else {
            $(this).parent().next().children().hide();
            $(this).html('Zmień');
            $(this).parent().next().children().removeClass('visible');
            $(this).parent().next().attr('id', '');
        }
    })

    $('#deleteUser').hide();

    $('#deleteBtn').click(function() {
        if (!$(this).parent().next().children().hasClass('visible')) {
            $(this).parent().next().attr('id', 'mainUnlogged');
            $(this).parent().next().children().show();
            $(this).html('Anuluj');
            $(this).parent().next().children().addClass('visible');
        } else {
            $(this).parent().next().children().hide();
            $(this).html('Usuń');
            $(this).parent().next().children().removeClass('visible');
            $(this).parent().next().attr('id', '');
        }
    })


});