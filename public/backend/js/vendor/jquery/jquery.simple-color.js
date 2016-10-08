/*
 * jQuery simple-color plugin
 * @requires jQuery v1.4.2 or later
 *
 * See http://recursive-design.com/projects/jquery-simple-color/
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Version: 1.1.4 (201305301304)
 */
 (function($) {
/**
 * simpleColor() provides a mechanism for displaying simple color-pickers.
 *
 * If an options Object is provided, the following attributes are supported:
 *
 *  defaultColor:       Default (initially selected) color.
 *                      Default value: '#FFF'
 *
 *  border:             CSS border properties.
 *                      Default value: '1px solid #000'
 *
 *  cellWidth:          Width of each individual color cell.
 *                      Default value: 10
 *
 *  cellHeight:         Height of each individual color cell.
 *                      Default value: 10
 *
 *  cellMargin:         Margin of each individual color cell.
 *                      Default value: 1
 *
 *  boxWidth:           Width of the color display box.
 *                      Default value: 115px
 *
 *  boxHeight:          Height of the color display box.
 *                      Default value: 20px
 *
 *  columns:            Number of columns to display. Color order may look strange if this is altered.
 *                      Default value: 16
 *
 *  insert:             The position to insert the color picker. 'before' or 'after'.
 *                      Default value: 'after'
 *
 *  colors:             An array of colors to display, if you want to customize the default color set.
 *                      Default value: default color set - see 'default_colors' below.
 *
 *  displayColorCode:   Display the color code (eg #333333) as text inside the button. true or false.
 *                      Default value: false
 *
 *  colorCodeAlign:     Text alignment used to display the color code inside the button. Only used if 'displayColorCode' is true. 'left', 'center' or 'right'
 *                      Default value: 'center'
 *
 *  colorCodeColor:     Text color of the color code inside the button. Only used if 'displayColorCode' is true.
 *                      Default value: '#FFF'
 *
 *  onSelect:           Callback function to call after a color has been chosen.
 *                      Default value: null
 *                      Returns:       hex value
 *
 *  onCellEnter:        Callback function that excecutes when the mouse enters a cell.
 *                      Default value: null
 *                      Returns:       hex value
 *
 *  onClose:            Callback function that executes when the chooser is closed.
 *                      Default value: null
 *
 *  livePreview:        The color display will change to show the color of the hovered color cell.
 *                      The display will revert if no color is selected.
 *                      Default value: false
 */
  $.fn.simpleColor = function(options) {

    var default_colors = ['ffffff','000000','cccccc','999999','666666',
    		'a5128e', '8a386d', '996386', 'c1a5b7', 'ded1d9',
		    '1961b0', '345a8c', '60799b', 'a4b1c1', 'd0d6de',
			'00ade0', '3592b9', '619fb9', 'a4c3d0', 'd0dfe5', 
            '284238', '33413d', '5f6966', 'a4a8a7', 'd0d2d1',
		    '00724a', '24614e', '557e72', '9fb3ad', 'cdd7d4',
			'66c54e', '5ba164', '7aa980', 'b1c8b4', 'd6e1d7', 
			'efa50b', 'cb8d43', 'c39a69', 'd6c1a8', 'e8ded2',
			'f47814', 'cd6b30', 'c5845c', 'd7b6a3', 'e3d4ca',
			'cd6b30', 'c7865e', 'd7b6a3', 'e8d9cf', 'e7d8ce',
			'c64c21', 'a44d2b','ab715a', 'c9aca1', 'e2d4ce',
			'd20f45', 'af3738', 'b26263', 'cba3a3','e2cfcf'];
			
    // Option defaults
    options = $.extend({
      defaultColor:     this.attr('defaultColor') || '#FFF',
      border:           this.attr('border') || 'none',
      cellWidth:        this.attr('cellWidth') || 20,
      cellHeight:       this.attr('cellHeight') || 25,
      cellMargin:       this.attr('cellMargin') || 1,
      boxWidth:         this.attr('boxWidth') || '35px',
      boxHeight:        this.attr('boxHeight') || '33px',
      columns:          this.attr('columns') || 5,
      insert:           this.attr('insert') || 'after',
      buttonClass:      this.attr('buttonClass') || '',
      colors:           this.attr('colors') || default_colors,
      displayColorCode: this.attr('displayColorCode') || false,
      colorCodeAlign:   this.attr('colorCodeAlign') || 'center',
      colorCodeColor:   this.attr('colorCodeColor') || '#FFF',
      onSelect:         null,
      onCellEnter:      null,
      onClose:          null,
      livePreview:      false
    }, options || {});

    // Hide the input
    this.hide();

    // Figure out the cell dimensions
    options.totalWidth = options.columns * (options.cellWidth + (2 * options.cellMargin));
    
    // this should probably do feature detection - I don't know why we need +2 for IE
    // but this works for jQuery 1.9.1
    if (navigator.userAgent.indexOf("MSIE")!=-1){
      options.totalWidth += 2;
    }
    
    options.totalHeight = Math.ceil(options.colors.length / options.columns) * (options.cellHeight + (2 * options.cellMargin));

    // Store these options so they'll be available to the other functions
    // TODO - must be a better way to do this, not sure what the 'official'
    // jQuery method is. Ideally i want to pass these as a parameter to the 
    // each() function but i'm not sure how
    $.simpleColorOptions = options;

    function buildSelector(index) {
      options = $.simpleColorOptions;

      // Create a container to hold everything
      var container = $("<div class='simpleColorContainer' />");
      
      // Absolutely positioned child elements now 'work'.
			container.css('position', 'relative');

      // Create the color display box
      var default_color = (this.value && this.value != '') ? this.value : options.defaultColor;

      var display_box = $("<div class='simpleColorDisplay' />");
      display_box.css({
        'backgroundColor': default_color,
        'border':          options.border,
        'width':           options.boxWidth,
        'height':          options.boxHeight,
        // Make sure that the code is vertically centered.
        'line-height':     options.boxHeight,
        'cursor':          'pointer'
      });
      container.append(display_box);
      
      // If 'displayColorCode' is turned on, display the currently selected color code as text inside the button.
      if (options.displayColorCode) {
        display_box.text(this.value);
        display_box.css({
          'color':     options.colorCodeColor,
          'textAlign': options.colorCodeAlign
        });
      }
      
      var select_callback = function (event) {

        // Bind and namespace the click listener only when the chooser is 
        // displayed. Unbind when the chooser is closed.
        $('html').bind("click.simpleColorDisplay", function(e) {
          $('html').unbind("click.simpleColorDisplay");
          $('.simpleColorChooser').hide();

          // If the user has not selected a new color, then revert the display.
          // Makes sure the selected cell is within the current color selector.
          var target = $(e.target);
          if (target.is('.simpleColorCell') === false || $.contains( $(event.target).closest('.simpleColorContainer')[0], target[0]) === false) {
            display_box.css('backgroundColor', default_color);
            if (options.displayColorCode) {
              display_box.text(default_color);
            }
          }
          // Execute onClose callback whenever the color chooser is closed.
          if (options.onClose) {
            options.onClose();
          }
        });

        // Use an existing chooser if there is one
        if (event.data.container.chooser) {
          event.data.container.chooser.toggle();
      
        // Build the chooser.
        } else {

          // Make a chooser div to hold the cells
          var chooser = $("<div class='simpleColorChooser'/>");
          chooser.css({
            'border':   options.border,
            'margin':   '0 0 0 5px',
            'width':    options.totalWidth,
            'height':   options.totalHeight,
            'top':      0,
            'left':     options.boxWidth,
            'position': 'absolute'
          });
      
          event.data.container.chooser = chooser;
          event.data.container.append(chooser);
      
          // Create the cells
          for (var i=0; i<options.colors.length; i++) {
            var cell = $("<div class='simpleColorCell' id='" + options.colors[i] + "'/>");
            cell.css({
              'width':           options.cellWidth + 'px',
              'height':          options.cellHeight + 'px',
              'margin':          options.cellMargin + 'px',
              'cursor':          'pointer',
              'lineHeight':      options.cellHeight + 'px',
              'fontSize':        '1px',
              'float':           'left',
              'backgroundColor': '#'+options.colors[i]
            });
            chooser.append(cell);
            if (options.onCellEnter || options.livePreview) {
              cell.bind('mouseenter', function(event) {
                if (options.onCellEnter) {
                  options.onCellEnter(this.id);
                }
                if (options.livePreview) {
                  display_box.css('backgroundColor', '#' + this.id);
                  if (options.displayColorCode) {
                    display_box.text('#' + this.id);
                  }
                }
              });
            }
            cell.bind('click', {
              input: event.data.input, 
              chooser: chooser, 
              display_box: display_box
            }, 
            function(event) {
              event.data.input.value = '#' + this.id;
              $(event.data.input).change();
              event.data.display_box.css('backgroundColor', '#' + this.id);
              event.data.chooser.hide();
              event.data.display_box.show();

              // If 'displayColorCode' is turned on, display the currently selected color code as text inside the button.
              if (options.displayColorCode) {
                event.data.display_box.text('#' + this.id);
              }
              // If an onSelect callback function is defined then excecute it.
              if (options.onSelect) {
                options.onSelect(this.id);
              }

            });
          }
        }
      };
      
      var callback_params = {
        container: container, 
        input: this, 
        display_box: display_box
      };

      // Also bind the display box button to display the chooser.
      display_box.bind('click', callback_params, select_callback);

      $(this).after(container);

    };

    this.each(buildSelector);

    $('.simpleColorDisplay').each(function() {
      $(this).click(function(e){
        e.stopPropagation();
      });
    });

    return this;
  };

  /*
   * Close the given color selectors
   */
  $.fn.closeSelector = function() {
    this.each( function(index) {
      var container = $(this).parent().find('div.simpleColorContainer');
      container.find('.simpleColorChooser').hide();
      container.find('.simpleColorDisplay').show();
    });

    return this;
  };

})(jQuery);
