
var base_url = location.protocol + "//" + location.host+"/";

Main = Backbone.View.extend({

    el: $("#application"),
    initialize: function (options) {

        // Keep this as the main view
        _.bindAll(this, "addBox", "updateBox","deleteAll");

        // Bind add button event from menu to view and update to drag event
        options.vent.bind("addBox", this.addBox);
        options.vent.bind("updateBox", this.updateBox);
        options.vent.bind("deleteAll", this.deleteAll);

        this.vent      = options.vent;
        this.projet_id = options.projet_id;

        // Create new collection and bind events to rerender on reset and add
        this.collection = new Boxes(null,{ projet_id:this.projet_id, view: this , base_url:this.base_url });

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
                $('#empty').hide();
                // if the fetching is done, render the view
                self.render();
            },
            error: function (errorResponse) {
                 console.log(errorResponse);
                 $('#empty').show();
            }
        });
    },
    deleteAll: function(){

        // Keep view reference
        var self   = this;
        // Confirmation
        var answer = confirm("Voulez-vous vraiment tout effacer?");

        if (answer)
        {
            $.ajax({
                 type: "POST",
                 url: base_url+"deleteAll/"+this.projet_id ,
                 success: function(msg)
                 {
                    self.collection.reset(null);

                    $(".box").remove();
                    $(".arrows").remove();
                 }
            });
        }
    },
    events: {
        "click .ok" : "addText"
    },
    showTextarea: function(key, opt) {

        // Current div
        var box = opt.$trigger;

        // Show textarea and disable draggable
        box.find('span.textarea').show();
        box.css('z-index',2000);
        box.draggable( "disable" );

    },
    addText: function(e) {

        // Get current target, get div and hide the span textarea
        var that = $(e.currentTarget);
        var div  = that.closest('div')
        var span = that.parent().hide();

        // Get the textarea, grab the text and put it in the inner div
        var textarea = span.find('textarea');
        var text = textarea.val();
        div.find('div.inner').html(text);

        // Get the id of the box and reenable the dragging
        var id = $(e.currentTarget).parent().parent().attr("id");
        $( "#"+id ).draggable( "enable" );
        $( "#"+id ).css('z-index',55);

        // Get the model from id
        var box = this.collection.get(id);

        // Save new values and update the model
        box.save({"text": text });

    },
    removeBox: function(key, opt) {

        var answer = confirm("Voulez-vous vraiment effacer?");

        if (answer){
            // Keep view reference
            var self  = this;
            // Get box div refrence, id and model
            var box   = opt.$trigger;
            var id    = box.attr("id");
            var model = this.collection.get(id);

            // Destroy model, delet it from server and remove it from the view
            model.destroy({
                success: function(model, response) {
                    console.log(response);
                    if(response.error === false)
                    {
                        self.collection.remove(model);
                        box.remove();

                        var nbr  = $("#application > div.box").size();
                        if( nbr === 0 ){
                            $('#empty').show();
                            $('#application').css('height', 60 );
                        }
                    }
                },
                error: function (errorResponse) {
                     console.log(errorResponse);
                }
            });
        }
    },
    updateBox : function(el){

        // Get the id of the box moved or resized
        var id   = el.attr('id');

        // Get the model from id
        var box = this.collection.get(id);
        // Get the new values
        var position  =  el.position();
        var width     =  el.width();
        var height    =  el.height();

        // Save new values and update the model
        box.save({"left": position.left , "top" : position.top , "width" : width , "height" : height });

    },
    updateBoxColor : function(opt){

        // Get the id of the box
        var box   = opt.$trigger;
        var id    = box.attr("id");

        // Get the model from id
        var model = this.collection.get(id);
        // Get the new values
        var colorPicker  = $("#colorPicker").val();

        // Change color of text div if bg is white if no color defined in textarea
        if(colorPicker == '#ffffff')
        {
            var inner  = $('div#'+id).find('.inner');
            var newTxt = inner.css('color','#000000');
        }
        else
        {
            var inner  = $('div#'+id).find('.inner');
            var newTxt = inner.css('color','#ffffff');
        }

        // Save new values and update the model
        model.save({"couleur": colorPicker });
        box.css({'background-color' : model.get('couleur')});

    },
    updateBoxBorder : function(opt){

        // Get the id of the box
        var box   = opt.$trigger;
        var id    = box.attr("id");

        // Get the model from id
        var model  = this.collection.get(id);
        var border = model.get('border');

        if(border){
            // Save new values and update the model
            model.save({"border": '' });

            box.css({'border' : 'none' });
        }
        else
        {
            // Get the new values
            var borderPicker  = $("#colorPicker").val();

            // Save new values and update the model
            model.save({"border": borderPicker });

            var border = '2px solid ' + model.get('border');
            box.css({'border' : border });
        }

    },
    addBox:function(){

        // Keep view reference
        var self   = this;

        var nbr    = $("#application > div.box").size();
        var newNbr = nbr + 1;

        if( newNbr == 1 )
        {
             $('#empty').hide();
             $('#application').css('height', 210 );
        }

        // Get color choosen and create new box model with it
        var colorPicker = $("#colorPicker").val();
        var text        = '';

        var box = new Box({
            projet_id : self.projet_id,
            couleur   : colorPicker,
            border    : '',
            noe       : newNbr,
            text      : text,
            width     : 120,
            height    : 120,
            left      : 40,
            top       : 40
        });

        // Save the new model
        box.save({},
        {
            success: function (model, response)
            {
                // Get new id created and set to the model
                console.log(response);
                box.set('id', response.items.id);
                // Addd to collection
                self.collection.add(box);
                // Create new box in the view
                self.createBox(box);
            },
            error: function (model, response) {
                console.log(response)
            }
        });
    },
    displayFront: function(opt){

        // Put all box on the same level
        // $('.box').css('z-index', 60 );

        var box = opt.$trigger;
        var id  = box.attr("id");

        var zindex = box.css( "z-index" );
        var newzindex = parseInt(zindex) + 10;

        // Chosen box to the front
        box.css( 'z-index' , newzindex );

        // Get the model from id
        var model  = this.collection.get(id);

        // Save position
        model.save({"zindex": newzindex});

    },
    initMenu:function(){

        // Keep view reference
        var self = this;

        // Context menu
        $.contextMenu({
            // define which elements trigger this menu
            selector: '.box',
            zIndex: 1000,
            // define the elements of the menu
            items: {
                editBox     : {name: "Editer le texte ",    icon:'edit' , callback: function(key, opt){ self.showTextarea(key, opt); }},
                changeColor : {name: "Changer la couleur &nbsp;", icon:'tint' , callback: function(key, opt){ self.updateBoxColor(opt); }},
                addBorder   : {name: "Ajouter/Supprimer bordure &nbsp;", icon:'check-empty' , callback: function(key, opt){ self.updateBoxBorder(opt); }},
                displayFront: {name: "Mettre en avant &nbsp;", icon:'level-up' , callback: function(key, opt){ self.displayFront(opt); }},
                deleteBox   : {name: "Supprimer ", icon:'trash', callback: function(key, opt){ self.removeBox(key, opt); }}
            }
            // there's more, have a look at the demos and docs...
        });

    },
    createBox: function(model){

        // Create instance of box view
        var boxview = new BoxView({ model:model , vent: this.vent });
        // Append to the view
        var newBox = boxview.render().el;

        var button = ['formatting','bold','italic','|','unorderedlist','orderedlist','|','link','alignment'];

        this.$el.append(newBox);

        var id  = model.get('id');

        $('.box_'+id).redactor({
            focus     : true,
            buttons   : button,
            linkAnchor: true,
            fileUpload : 'uploadFileRedactor?_token=' + $('meta[name="_token"]').attr('content'),
            imageUpload: 'uploadRedactor?_token=' + $('meta[name="_token"]').attr('content'),
            imageManagerJson: 'imageJson',
            fileManagerJson: 'fileJson',
            linkManagerJson: 'linkJson',
            plugins: ['fontcolor','fontsize','schema']
        });
        // Initalize contxtmenu and wysiwyg editor

    },
    render : function(){

        // Render each box in view
        this.collection.forEach(this.createBox, this);
        // Initalize contxtmenu and wysiwyg editor
        // Set the container to correct height
        var big = 0;
        var h   = 0;

        this.initMenu();

        $('.box').each(function(){
             var position = $(this).position();
             var height   = $(this).height();
             var top = position.top;
             if(top > big){
                 h   = height;
                 big = top;
             }
        });

        $('#application').css('height', big+h+60 );

        // Show the div when all is loaded
        //$("#menuButtons").fadeIn(400);
        //$("#application").fadeIn(400);
    }
});

