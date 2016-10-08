
var base_url = location.protocol + "//" + location.host+"/api/";
// Arrows collection
Arrows = Backbone.Collection.extend({
        //This is our Boxes collection and holds our Boxes models
        model: Arrow,
        parse: function(response) {
            console.log(response);
            return response.items;
        },
        initialize: function (models, options) {
            options || (options = {});
            // Pass the projet id to the querie of the collection
            this.projet_id = options.projet_id;
        },
        url: function () {
            return base_url+'arrow/projet/' + this.projet_id + '';
        }
});
