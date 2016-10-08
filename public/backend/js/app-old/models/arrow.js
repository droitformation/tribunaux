

var base_url = location.protocol + "//" + location.host+"/api/";
// Arrow model
Arrow = Backbone.Model.extend({
        //Create a model to hold box atribute and set defaults
        defaults: {id: null, couleurBg_arrow : null, leftCoord_arrow:0, topCoord_arrow: 0 , no_arrow:0 ,projet_id :this.projet_id  ,position :'' },
        initialize: function (models, options) {
            options || (options = {});
            // Pass the projet id to the querie of the collection
            this.projet_id = options.projet_id;
        },
        url: function(){
            return base_url+'arrow/' + this.get('id') + '';
        },
        methodUrl:  function(method){
            if(method == "delete")
            {
                return base_url+'arrow/' + this.get('id');
            }
            else if(method == "update"){
                return base_url+'arrow/' + this.get('id');
            }
            else if(method == "create"){
                return base_url+'arrow';
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
