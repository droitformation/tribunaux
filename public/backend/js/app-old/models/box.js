
var base_url = location.protocol + "//" + location.host+"/api/";
// Box model
Box = Backbone.Model.extend({
        //Create a model to hold box atribute and set defaults
        defaults: { id: null,
                    no_node        : 0,
                    couleurBg_node : null,
                    borderBg_node  : null,
                    zindex         : 55,
                    leftCoord_node : 60,
                    topCoord_node  : 60,
                    width_node     : 150,
                    height_node    : 150 ,
                    base_url       : this.base_url ,
                    projet_id      : this.projet_id ,
                    text           : ''
        },
        initialize: function (options) {
            options || (options = {});
            // Pass the projet id to the querie of the collection
            this.projet_id = options.projet_id;
        },
        url: function(){
            return base_url+'boxe/' + this.get('id') + '';
        },
        methodUrl:  function(method){
            if(method == "delete")
            {
                return base_url+'boxe/' + this.get('id');
            }
            else if(method == "update"){
                return base_url+'boxe/' + this.get('id');
            }
            else if(method == "create"){
                return base_url+'boxe';
            }

            return false;
        },
        sync: function(method, model, options) {
            if (model.methodUrl && model.methodUrl(method.toLowerCase())) {
                options = options || {};
                options.url = model.methodUrl(method.toLowerCase());
            }
           Backbone.sync(method, model, options);
        }
});
