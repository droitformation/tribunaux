// Menu view
ButtonsView = Backbone.View.extend({

    el: $("#controls"),
    initialize: function (options) {
        this.vent = options.vent;
    },
    events: {
        // Event from the menu
        "click #add"       : "addBox",
        "click .arrow"     : "addArrow",
        "click #save"      : "saveProjet",
        "click #deleteAll" : "deleteAll"
    },
    deleteAll : function(){
        this.vent.trigger("deleteAll");
    },
    addBox : function(){
        this.vent.trigger("addBox");
    },
    addArrow : function(e){
        var position = $(e.currentTarget).data("position");
        this.vent.trigger("addArrow" , position);
    },
    saveProjet: function(e){
        var href = $(e.currentTarget).attr('href');
        // location.href
        console.log(href);
    }
});