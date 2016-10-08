if (!RedactorPlugins) var RedactorPlugins = {};

RedactorPlugins.schema = function()
{
    return {
        getTemplate: function()
        {
            return String()
                + '<section id="redactor-modal-schema">'
                + '<label>Titre du bouton</label>'
                + '<input type="text" value="" id="link-text">'
                + '<label>Schéma</label>'
                + '<select id="schemas-list">'
                + '<option value="">Choisir</option>'
                + '</select>'
                + '</section>';
        },
        init: function ()
        {
            var button = this.button.add('schema', 'schema');
            this.button.addCallback(button, this.schema.show);

            // make your added button as Font Awesome's icon
            this.button.setAwesome('schema', 'fa-flag');
        },
        show: function()
        {
            this.modal.addTemplate('schema', this.schema.getTemplate());
            this.modal.load('schema', 'schema Modal', 600);
            this.modal.createCancelButton();

            var button = this.modal.createActionButton('Insert');
            button.on('click', this.schema.insert);

            $.ajax({
                dataType: "json",
                cache: false,
                url  : this.opts.linkManagerJson,
                success: $.proxy(function(data)
                {
                    $.each(data, $.proxy(function(key, val)
                    {
                        var option = $('<option value="' + val.link + '">' + val.title + '</option>');
                        $('#schemas-list').append(option);
                        $(option).click($.proxy(this.schema.insert, this));

                    }, this));

                }, this)
            });

            this.selection.save();
            this.modal.show();

            $('#mymodal-textarea').focus();
        },
        insert: function(e)
        {
            var base_url = location.protocol + "//" + location.host+"/";

            var title = $('#link-text').val();
            var link  = '<a title="'+ title +'" href="'+ base_url + 'schema/' + $(e.target).attr('value') + '">'+ title +'</a>';

            this.modal.close();
            this.selection.restore();

            this.insert.html(link);

            this.code.sync();

        }
    };
};