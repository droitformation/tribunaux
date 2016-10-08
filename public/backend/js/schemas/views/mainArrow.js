// Arrows view
MainArrow = Backbone.View.extend({
    el: $("#application"),
    initialize: function (options) {

        // Keep this as the main view
        _.bindAll(this, "addArrow", "updateArrow","deleteAll");

        // Bind add button event from menu to view and update to drag event
        options.vent.bind("addArrow", this.addArrow);
        options.vent.bind("updateArrow", this.updateArrow);
        options.vent.bind("deleteAll", this.deleteAll);

        this.vent = options.vent;

        this.projet_id = options.projet_id;

        // Create new collection and bind events to rerender on reset and add
        this.collection = new Arrows(null,{ projet_id:this.projet_id, view: this });

        this.collection.on('add',   this.render() , this);
        this.collection.on('reset', this.render() , this);

        this.update();

    },
    update: function(){

        // Keep view reference
        var self = this;
        // Fetch collection from server
        this.collection.fetch({
            success: function(response,xhr)
            {
                console.log(response);
                // if the fetching is done, render the view
                self.render();
            },
            error: function (errorResponse) { console.log(errorResponse); }
        });
    },
    deleteAll: function(){
        this.collection.reset(null);
    },
    events: {
        "mouseenter .arrows" : "hover",
        "mouseleave .arrows" : "hover"
    },
    hover: function(e){

    },
    removeArrow : function(opt){
        // Keep view reference
        var self  = this;
        // Get arrow div refrence, id and model
        var arrow = opt.$trigger;
        var id    = arrow.attr("id");

        var model = this.collection.get(id);

        // Destroy model, delet it from server and remove it from the view
        model.destroy({
            success: function(model, response) {
                if(response.error === false)
                {
                    self.collection.remove(model);
                    arrow.remove();
                }
            }
        });
    },
    initMenu:function(){

        // Keep view reference
        var self = this;

        // Context menu
        $.contextMenu({
            // define which elements trigger this menu
            selector: ".arrows",
            zIndex: 1000,
            // define the elements of the menu
            items: {
                //editBox     : {name: "Editer le texte ",    icon:'edit' , callback: function(key, opt){ self.showTextarea(key, opt); }},
                changeColor : {name: "Changer la couleur &nbsp;", icon:'tint' , callback: function(key, opt){ self.updateArrowColor(opt); }},
                //addBorder   : {name: "Ajouter/Supprimer bordure &nbsp;", icon:'check-empty' , callback: function(key, opt){ self.updateBoxBorder(opt); }},
                deleteBox   : {name: "Supprimer ", icon:'trash', callback: function(key, opt){ self.removeArrow(opt); }}
            }
            // there's more, have a look at the demos and docs...
        });

    },
    updateArrow : function(el){

        // Get the id of the box moved or resized
        var id   = el.attr('id');
        // Get the model from id
        var arrow = this.collection.get(id);
        // Get the new values
        var position  =  el.position();
        // Save new values and update the model
        arrow.save({"left": position.left , "top" : position.top });

    },
    updateArrowColor : function(opt){

        // Get the id of the box
        var arrow = opt.$trigger;
        var id    = arrow.attr("id");

        // Get the model from id
        var model = this.collection.get(id);
        // Get the new values
        var colorPicker  = $("#colorPicker").val();

        // Save new values and update the model
        model.save({"couleur": colorPicker });
        arrow.css({'color' : model.get('couleur')});

    },
    addArrow:function(position){

        // Keep view reference
        var self = this;

        // Get color choosen and create new box model with it
        var colorPicker = $("#colorPicker").val();
        var arrow       = new Arrow({ projet_id:self.projet_id , couleur: colorPicker ,top:0, left:20 , position: position });

        // Save the new model
        arrow.save({},
        {
            success: function (model, response) {

                // Get new id created and set to the model
                arrow.set('id', response.items.id);
                // Create new box in the view
                self.createArrow(arrow);
                // Addd to collection
                self.collection.add(arrow);
            },
            error: function (model, response) {
                console.log(response)
            }
        });
    },
    createArrow: function(model){

        // Create instance of box view
        var arrowview = new ArrowView({ model:model , vent: this.vent});
        // Append to the view
        this.$el.append(arrowview.render().el);

        this.initMenu();

    },
    render : function(){
        // Render each box in view
        this.collection.forEach(this.createArrow, this);
    }
});
