
var AppRouter = Backbone.Router.extend({
    routes: {
        '': 'home',
        'projet/:id': 'projet'
    },
    initialize: function(options){

    },
    projet: function(id) {

       var default_colors = [
            ['ffffff','000000','cccccc','999999','666666','83146a','74055b','65004c','560033','47002e'],
            ['ffffff','000000','cccccc','999999','666666','004685','003775','002866','001957','000a48'],
            ['ffffff','000000','cccccc','999999','666666','0066cc','0057bd','0048ae','00399f','002a90'],
            ['ffffff','000000','cccccc','999999','666666','0092be','0083af','0074a0','006591','005682'],
            ['ffffff','000000','cccccc','999999','666666','102720','102720','011811','000902','000000'],
            ['ffffff','000000','cccccc','999999','666666','005d35','004e26','003f1c','00300d','002100'],
            ['ffffff','000000','cccccc','999999','666666','57ac4a','489d3b','398e2c','2a7f1d','1b700e'],
            ['ffffff','000000','cccccc','999999','666666','ffcc00','f0bd00','e1ae00','d29f00','c39000'],
            ['ffffff','000000','cccccc','999999','666666','e19720','d28811','c37902','b46a00','a55b00'],
            ['ffffff','000000','cccccc','999999','666666','e06a22','6d5b13','5e4c04','4f3d00','402c00'],
            ['ffffff','000000','cccccc','999999','666666','a84424','993515','892506','7a1600','6b0700'],
            ['ffffff','000000','cccccc','999999','666666','8e2c23','7f1d14','700e05','610000','520000'],
            ['ffffff','000000','cccccc','999999','666666','b10535','a20025','930016','840007','750000']
       ];

       var base_url = location.protocol + "//" + location.host+"/api/";

        $.ajax({
           type: 'GET', // Le type de ma requete
           async:false,
           success: function(data) {

                console.log(data);

                data = data.items.id - 1;
                var colors = default_colors[data];

                $('.simple_color').simpleColor({ colors: colors , defaultColor: '#eeeeee'});
           },
           url: base_url+'projet/'+id
        });

        // extend events to pass them from views to views
        var vent = _.extend({}, Backbone.Events);
        // app box view
        var appboxview   = new AppBoxView({ projet_id: id , vent: vent });
        // app arrows view
        var apparrowview = new AppArrowView({ projet_id : id , vent: vent });
        // The menu view
        var buttonview   = new ButtonsView({ vent: vent });

        appboxview.render();
        apparrowview.render();

        $("#loader").fadeOut(800);
        $("#controls").fadeIn(800);
    }
});

var init = function() {

    // Emulating REST andd Json
    Backbone.emulateJSON = true ;
    Backbone.emulateHTTP = true ;

    var app_router = new AppRouter();
    Backbone.history.start();
};
