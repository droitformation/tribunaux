
ArrowView = Backbone.View.extend({
    tagName   : 'p',
    className : function(){ return "icon-large arrows icon-caret-" + this.model.get('position'); },
    initialize: function (options) {
        options || (options = {});
        this.vent = options.vent;
    },
    update : function(el){
        this.vent.trigger("updateArrow",el);
    },
    render : function(){

        // Keep view reference
        var self     = this;
        //The parameter passed is a reference to the model that was added
        var colorPicker = $("#colorPicker").val();
        var nbr         = $("#content-application > div.arrows").size();
        var newNbr      = nbr + 1;
        var position    = this.model.get('position');

        // Set id from model to box div
        this.el.id = this.model.get('id');

        this.$el.css({
                    'color' : this.model.get('couleurBg_arrow'),
                    'position' : 'absolute',
                    'top'      : this.model.get('topCoord_arrow') +'px',
                    'left'     : this.model.get('leftCoord_arrow') +'px'
                }).draggable({
                    grid: [ 5,5 ],
                    containment: $('#all') ,
                    stop: function(event, ui ) {
                        self.update($(this));
                    }
                });
        return this;
    }
});
