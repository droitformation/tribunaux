if (!RedactorPlugins) var RedactorPlugins = {};

RedactorPlugins.advanced = function()
{
    return {
        init: function()
        {
            if (!this.opts.imageManagerJson) return;

            var button = this.button.add('advanced', 'Image en popup');

            // make your added button as Font Awesome's icon
            this.button.setAwesome('advanced', 'fa-picture-o');
            this.modal.addCallback('image', this.advanced.load);

            //this.button.addCallback(button, $.proxy(this.advanced.insertFromMyModal, this));

        },
        load: function()
        {
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

                        var img = $('<img src="' + val.thumb + '" rel="' + val.image + '" data-thumb="' + val.thumb + '" title="' + thumbtitle + '" style="width: 100px; height: 75px; cursor: pointer;" />');
                        $('#redactor-image-manager-box').append(img);
                        $(img).click($.proxy(this.advanced.insertFromMyModal, this));

                    }, this));

                }, this)
            });


        },
        insertFromMyModal: function(e)
        {
            //this.image.insert('<img data-thumb="' + $(e.target).data('thumb') + '" src="' + $(e.target).attr('rel') + '" alt="' + $(e.target).attr('title') + '">');

            this.selection.get();
            this.selection.save();

            var block   = this.selection.getBlock();
            var anchor  = $(block).find('a');

            var src   = anchor.attr('href');
            var text  = anchor.text();

            var link = '<p><a href="' + $(e.target).attr('rel') + '" class="popup_modal">' + text + '</a></p>';

            block.remove();

            console.log(link);

            //this.selection.replaceSelection(link);
           // this.selection.restore();

        }

    };
};