
var AppRouter = Backbone.Router.extend({
    routes: {
        'projet/:id': 'projet'
    },
    projet: function(id) {

        var colors = ['ffffff','000000','cccccc','999999','666666','83146a','74055b','65004c','560033','47002e'];

        $('.simple_color').simpleColor({ colors: colors , defaultColor: '#eeeeee'});

        // extend events to pass them from views to views
        var vent = _.extend({}, Backbone.Events);

        // The menu view
        var buttonview  = new ButtonsView({ vent: vent });

        var box   = new Main({ projet_id: id , vent: vent });
        var arrow = new MainArrow({ projet_id : id , vent: vent });

        box.render();
        arrow.render();

        //$("#loader").fadeOut(800);
        //$("#controls").fadeIn(800);
    }
});
