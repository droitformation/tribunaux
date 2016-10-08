$(document).ready(function(){
///////////////////////////////////
///////////////////////////////////

    $('#slides').cycle({
        fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
    });

    $('.selector').qtip({
        content: {
            attr: 'title'
        },
        style: {
            classes: 'ui-tooltip-light ui-tooltip-shadow'
        }
    });

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

    $(".chzn-select").chosen();

    $('[data-toggle="popover"]').popover();
			
///////////////////////////////////
///////////////////////////////////			
			
});