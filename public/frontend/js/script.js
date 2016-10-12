$(function(){
	///////////////////

	/*$("div.lm-letters a").mouseenter(function() {
        $('div.lm-menu').hide();
        $('div.lm-submenu').hide();

        var letter = $(this).attr('class');

        $('div.lm-menu').show();

        $('#'+letter).show();

        $('div.lm-menu').stop(true, true);
        $('div.lm-submenu').stop(true, true);

        console.log('enter');

    }).on('mouseleave', function() {
          // $('div.lm-menu').hide();
          // $('div.lm-submenu').hide();
    });

   	$('div.lm-menu').on('mouseleave', function() {
           $('div.lm-menu').hide();
           $('div.lm-submenu').hide();
    });

    $('div#recherche').on('mouseleave', function() {
           $('div.lm-menu').hide();
           $('div.lm-submenu').hide();
    });*/
/*

    $('.ajaxloader').fadeIn();

    $('#recherche').hide().load('communes', function() {
        $('.ajaxloader').hide();

        $(this).fadeIn();
    });*/


///////////////////
});

$(document).ready(function(){

    $("div.lm-letters a").on({
        mouseenter: function () {
            $('div.lm-menu').hide();
            $('div.lm-submenu').hide();

            var letter = $(this).attr('class');

            $('div.lm-menu').show();

            $('#'+letter).show();

            $('div.lm-menu').stop(true, true);
            $('div.lm-submenu').stop(true, true);
        },
        mouseleave: function () {

        }
    });

    $('div.lm-menu').on('mouseleave', function() {
        $('div.lm-menu').hide();
        $('div.lm-submenu').hide();
    });

    $('#recherche').on('mouseleave', function(e) {
        $('div.lm-menu').hide();
        $('div.lm-submenu').hide();
    });
});


jQuery(document).ready(function() {
///////////////////////////		

    jQuery("#map-container AREA").mouseover(function(){
        var regionMap = '.'+$(this).attr('id')+'-map';
        var regionList = '.'+$(this).attr('id')+'-list';
        jQuery(regionMap).css('display', 'inline');

        // Check if a click event has occurred and only change the Region hover state accordingly
        if (! jQuery('#practice-container ul').hasClass('selected')) {
            jQuery(regionList).css('display', 'inline');
        }
    }).mouseout(function(){
        var regionMap = '.'+$(this).attr('id')+'-map';
        var regionList = '.'+$(this).attr('id')+'-list';

        // Check if a click event has occurred and only change the Region hover state accordingly
        if (! jQuery(regionMap).hasClass('selected')) {
            jQuery(regionMap).css('display', 'none');
        }

        // Check if a click event has occurred and only change the Region hover state accordingly
        if (! jQuery('#practice-container ul').hasClass('selected')) {
            jQuery(regionList).css('display', 'none');
        }
    });

    jQuery("#map-container AREA").click(function(){
        jQuery('#map-container img.region').removeClass('selected').css('display', 'none');
        jQuery('#practice-container ul').removeClass('selected').css('display', 'none');

        var regionMap = '.'+$(this).attr('id')+'-map';
        var regionList = '.'+$(this).attr('id')+'-list';
        jQuery(regionMap).addClass('selected').css('display', 'inline');
        jQuery(regionList).addClass('selected').css('display', 'inline');
    });

///////////////////////////

  $('div.accordion').delay(300).show();

///////// summit forms

    $(function ()
    {
          $("form.EnvoiDonnees").on("change keyup", function () {
                this.submit();
          });
    });

///////////////////////////
});


(function( $ ) {
    $.widget( "ui.combobox", {
        _create: function() {
            var self = this,
                select = this.element.hide(),
                selected = select.children( ":selected" ),
                value = selected.val() ? selected.text() : "";
            var input = this.input = $( "<input>" )
                .insertAfter( select )
                .val( value )
                .autocomplete({
                    delay: 200,
                    minLength: 2,
                    source: function( request, response ) {
                        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
                        response( select.children( "option" ).map(function() {
                            var text = $( this ).text();
                            if ( this.value && ( !request.term || matcher.test(text) ) )
                                return {
                                    label: text,
                                    value: text,
                                    option: this
                                };
                        }) );
                    },
                    select: function( event, ui ) {
                        ui.item.option.selected = true;
                        self._trigger( "selected", event, {
                            item: ui.item.option
                        });
                    },
                    change: function( event, ui ) {
                        if ( !ui.item ) {
                            var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" ),
                                valid = false;
                            select.children( "option" ).each(function() {
                                if ( $( this ).text().match( matcher ) ) {
                                    this.selected = valid = true;
                                    return false;
                                }
                            });
                            if ( !valid ) {
                                // remove invalid value, as it didn't match anything
                                $( this ).val( "" );
                                select.val( "" );
                                input.data( "autocomplete" ).term = "";
                                return false;
                            }
                        }
                    }
                })
                .addClass( "ui-widget ui-widget-content ui-corner-left" );

            input.data( "autocomplete" )._renderItem = function( ul, item ) {
                    return $( "<li></li>" )
                        .data( "item.autocomplete", item )
                        .append( "<a>" + item.label + "</a>" )
                        .appendTo( ul );
                };

            this.button = $( "<button type='button'>&nbsp;</button>" )
                .attr( "tabIndex", -1 )
                .attr( "title", "Show All Items" )
                .insertAfter( input )
                .button({
                    icons: {
                        primary: "ui-icon-triangle-1-s"
                    },
                    text: false
                })
                .removeClass( "ui-corner-all" )
                .addClass( "ui-corner-right ui-button-icon" )
                .click(function() {
                    // close if already visible
                    if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
                        input.autocomplete( "close" );
                        return;
                    }

                    // work around a bug (likely same cause as #5265)
                    $( this ).blur();

                    // pass empty string as value to search for, displaying all results
                    input.autocomplete( "search", "" );
                    input.focus();
                });
        },
        destroy: function() {
            this.input.remove();
            this.button.remove();
            this.element.show();
            $.Widget.prototype.destroy.call( this );
        }
    });
})( jQuery );

$(function() {

    $( "#combobox" ).combobox({
        appendTo: "#formCombobox"
    });
    $( "#toggle" ).click(function() {
        $( "#combobox" ).toggle();
    });

    $(".chosen-select").chosen();

    $('.chosen-select').on('change', function(evt, params) {
        $('#selected').submit();
    });

});
	










