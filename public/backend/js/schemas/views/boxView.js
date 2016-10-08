
 // View for one box
BoxView = Backbone.View.extend({
    tagName   : 'div',
    className : 'box resize',
    initialize: function (options) {
        options || (options = {});
        this.vent = options.vent;
    },
    update : function(el){
        this.vent.trigger("updateBox",el);
    },
    render : function(){

        // Keep view reference
        var self   = this;
        // Set id from model to box div
        this.el.id = this.model.get('id');
        var id     = this.model.get('id');
        // Get text
        var text   = this.model.get('text');
        var bg     = this.model.get('couleur');
        var inner  = '<div class="inner" style="color:#000000;">';

        // Adding elements: textarea inner div and button
        var elements  =  inner + text + '</div>';
            elements += '<span class="textarea"><textarea name="text' +id+ '" class="redactorBox box_'+this.model.get('id')+'">' +text+ '</textarea><button class="ok button buttonOk">ok</button></span>';

        var borderColor = this.model.get('border');

        if(borderColor){
            var border = '2px solid ' + this.model.get('border');
        }
        else{
            var border = 'none';
        }

        // Set the the css infos from model to the div and bind draggable and resizable then append the elements to it.
        this.$el.css({
                    'background-color' : this.model.get('couleur'),
                    'border'   : border,
                    'position' : 'absolute',
                    'width'    : this.model.get('width') +'px',
                    'height'   : this.model.get('height') +'px',
                    'z-index'  : this.model.get('zindex'),
                    'top'      : this.model.get('top') +'px',
                    'left'     : this.model.get('left') +'px'
                })
                .draggable({
                    grid: [ 10,10 ],
                    containment: 'parent',
                    start: function()
                    {
                        //$('.box').css('z-index',55);
                        //$(this).css('z-index',65);
                    },
                    drag: function( event, ui )
                    {
                        var boxPosition = 0;
                        var boxHeight   = 0;
                        var boxOffset   = 0;

                        boxPosition = ui.position.top;
                        boxHeight   = $(this).height();

                        var boxOffset  = boxPosition + boxHeight + 2;
                        var posContent = $('#application').height();

                        if(boxOffset > posContent){
                            var newPos = posContent + 40;
                            $('#application').css('height', newPos);
                        }
                    },
                    stop: function()
                    {
                        self.update($(this));
                    }
                })
                .resizable({grid: 10 , containment: 'parent', stop: function() { self.update($(this)) } })
                .append(elements);

        return this;
    }
});
