ArrowView = Backbone.View.extend({
    tagName   : 'p',
    className : function(){ return "icon-large arrows fa fa-long-arrow-" + this.model.get('position'); },
    initialize: function (options) {
        options || (options = {});
        this.vent = options.vent;
    },
    update : function(el){
        this.vent.trigger("updateArrow",el);
    },
    render : function(){

        var params = {
            // Callback fired on rotation start.
            start: function(event, ui) {
            },
            // Callback fired during rotation.
            rotate: function(event, ui) {
            },
            // Callback fired on rotation end.
            stop: function(event, ui) {
            },
            // Set the rotation center at (25%, 75%).
            rotationCenterX: 15.0,
            rotationCenterY: 85.0,
            snap : 25
        };

        // Keep view reference
        var self     = this;
        //The parameter passed is a reference to the model that was added
        var colorPicker = $("#colorPicker").val();
        var nbr         = $("#application > div.arrows").size();
        var newNbr      = nbr + 1;
        var position    = this.model.get('position');

        // Set id from model to box div
        this.el.id = this.model.get('id');

        this.$el.css({
            'color'    : this.model.get('couleur'),
            'position' : 'absolute',
            'top'      : this.model.get('top') +'px',
            'left'     : this.model.get('left') +'px'
        }).draggable({
            grid: [ 5,5 ],
            containment: $('#compose') ,
            stop: function(event, ui ) {
                self.update($(this));
            }
        }).rotatable(params);

        return this;
    }
});
