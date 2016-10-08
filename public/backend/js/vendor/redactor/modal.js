if (!RedactorPlugins) var RedactorPlugins = {};

RedactorPlugins.onemodal = function()
{
    return {
        getTemplate: function()
        {
            return String()
                + '<section id="redactor-modal-onemodal">'
                + '<label>Titre du bouton</label>'
                + '<input type="text" value="" id="mymodal-text">'
                + '<label>Style du bouton</label>'
                + '<select id="style-btn">'
                + '<option value="">Aucun</option>'
                + '<option value="btn btn-danger">Rouge</option>'
                + '<option value="btn btn-info">Bleu</option>'
                + '</select>'
                + '<label>Choix de l\'image</label>'
                + '<div id="redactor-image-manager-box"></div>'
                + '</section>';
        },
        init: function ()
        {
            var button = this.button.add('onemodal', 'onemodal');
            this.button.addCallback(button, this.onemodal.show);

            // make your added button as Font Awesome's icon
            this.button.setAwesome('onemodal', 'fa-flag');
        },
        show: function()
        {
            this.modal.addTemplate('onemodal', this.onemodal.getTemplate());
            this.modal.load('onemodal', 'onemodal Modal', 600);
            this.modal.createCancelButton();

            var button = this.modal.createActionButton('Insert');
            button.on('click', this.onemodal.insert);

            $.ajax({
                dataType: "json",
                cache: false,
                url: this.opts.imageManagerJson,
                success: $.proxy(function(data)
                {
                    $.each(data, $.proxy(function(key, val)
                    {
                        // title
                        var thumbtitle = '';
                        if (typeof val.title !== 'undefined') thumbtitle = val.title;

                        var img = $('<img src="' + val.thumb + '" rel="' + val.image + '" data-thumb="' + val.thumb + '" title="' + thumbtitle + '" style="max-width: 50px; height: auto; cursor: pointer;margin:5px;" />');
                        $('#redactor-image-manager-box').append(img);
                        $(img).click($.proxy(this.onemodal.insert, this));

                    }, this));

                }, this)
            });

            this.selection.save();
            this.modal.show();

            $('#mymodal-textarea').focus();
        },
        insert: function(e)
        {
            var html = $('#mymodal-text').val();
            var btn  = $('#style-btn').val();
            //var html = '<img data-thumb="' + $(e.target).data('thumb') + '" src="' + $(e.target).attr('rel') + '" alt="' + $(e.target).attr('title') + '">';
            var button = '<a title="'+ html +'" href="' + $(e.target).attr('rel') + '" class="fancybox '+ btn +'">'+ html +'</a>';

            this.modal.close();
            this.selection.restore();

            this.insert.html(button);

            this.code.sync();

        }
    };
};