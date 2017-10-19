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

});