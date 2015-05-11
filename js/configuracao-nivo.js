    $(window).load(function() {
        $('.slider').nivoSlider({pauseTime:10000,controlNav:true});
        var m =  ($(".nivo-controlNav").width() / 2);
        $(".nivo-controlNav").css('marginLeft', '-'+m+'px');
    });