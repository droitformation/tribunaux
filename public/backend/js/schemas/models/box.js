
var base_url = location.protocol + "//" + location.host+"/";

// Box model
Box = Backbone.Model.extend({
        //Create a model to hold box atribute and set defaults
        defaults: {
            id        : null,
            no        : 0,
            couleur   : null,
            border    : null,
            zindex    : 55,
            left      : 60,
            top       : 60,
            width     : 150,
            height    : 150 ,
            base_url  : this.base_url ,
            projet_id : this.projet_id ,
            text      : ''
        },
        initialize: function (options) {
            options || (options = {});
            // Pass the projet id to the querie of the collection
            this.projet_id = options.projet_id;
        },
        url: function(){
            return base_url+'box/' + this.get('id');
        },
        methodUrl:  function(method){
            if(method == "delete")
            {
                return base_url+'box/' + this.get('id');
            }
            else if(method == "update")
            {
                return base_url+'box/' + this.get('id');
            }
            else if(method == "create")
            {
                return base_url+'box';
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
