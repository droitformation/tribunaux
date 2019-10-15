$(document).ready(function(){
    
    $(".accordion").accordion({
        autoHeight: false,
        navigation: true,
        active: 0
    });

    $('#slideMenu li a').on('click',function()
    {
        $('#slideMenu li a').removeClass('current');
        // cache les div
        $('#slideMenuOpen div.hold').css('display', 'none');
        // attrape la classe choisie
        var n = $(this).parent().data('id');

        console.log(n);

        // montre la dive choisie
        $('div#'+n).css('display', 'block');
        $('#slideMenuOpen div.holder').css('display', 'block');

        $(this).addClass('current');

        return false;
    });

    $('a.close').click(function()
    {
        $('#slideMenuOpen li a').removeClass('current');
        $('#slideMenuOpen div.hold').css('display', 'none');
        $('#slideMenuOpen div.holder').css('display', 'none');
        return false;
    });

    $('#all').click(function() {
        $('#slideMenuOpen li a').removeClass('current');
        // cache les div
        $('#slideMenuOpen div.holder').css('display', 'none');
        $('#slideMenuOpen div.hold').css('display', 'none');
    });

    $('[data-toggle="popover"]').popover();

    $('.canton-select').select2();
    $('.search-select').select2({});

    $("form.EnvoiDonnees").on("change keyup", function () {
        this.submit();
    });

    function hide_menu(is){
        if(is){
            $('#main-content').addClass('is-close');
            $('#sidebar').addClass('is-close');
        }
        else{
            $('#main-content').removeClass('is-close');
            $('#sidebar').removeClass('is-close');
        }
    }

    $('#btn-sidebar-menu').on("change", function (e) {
        var is = $(this).is(':checked');
        hide_menu(is);
    });

    if ($(window).width() < 1030) {
        console.log('removeClass');
        $('#btn-sidebar-menu').prop('checked', true);
        hide_menu(true);
    }

    //$("img[usemap]").mapify();

    calculation();
    $(window).resize(calculation);

    function calculation() {

        var compensate_t = 1;
        var compensate_l = 1;

        if(window.devicePixelRatio === 3 && screen.width < 415){
             compensate_t = 1;
             compensate_l = 0.87;
        }

        if(window.devicePixelRatio === 2 && screen.width < 415){
             compensate_t = 0.94;
             compensate_l = 0.8;
        }

        if(window.devicePixelRatio > 1 && screen.width > 415){
            compensate_t = 0.9;
            compensate_l = 1;
        }

        console.log(compensate_t);
        console.log(compensate_l);

        $('.pin-map').each(function (index, value) {

            let top  = $(this).data('top');
            let left = $(this).data('left');

            let o_width  = $('#map-container').data('width');
            let o_height = $('#map-container').data('height');

            let n_width  = $('#map-container').width();
            let n_height = $('#map-container').height();

            let w_precent  = n_width/o_width;
            let h_percent  = n_height/o_height;

            let n_top  = parseInt(top) * w_precent;
            let n_left = (parseInt(left) * h_percent);

            $(this).css({
                'position': 'absolute',
                'top': (n_top * compensate_t) + 'px',
                'left': (n_left * compensate_l) + 'px'
            });
        });
    }

});