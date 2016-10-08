
DropView = Backbone.View.extend({
   el: $("#trash"),
   initialize: function (options) {
       options || (options = {});
       this.vent = options.vent;
   },
   update : function(ui){
        this.vent.trigger("dropped",ui);
   },
   render: function() {
        var self = this;
        this.$el.droppable({
             hoverClass: "trash-highlight",
             drop: function( event, ui )
             {
                 ui.draggable.data('dropped', true);
                 self.update(ui);
             }
        });
        return this;
   }
});
