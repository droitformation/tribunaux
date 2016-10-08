$( function() {

    $('.redactor').redactor({
        minHeight  : 250,
        maxHeight: 450,
        focus: true,
        lang: 'fr',
        plugins: ['advanced','imagemanager','filemanager'],
        fileUpload : 'admin/uploadFileRedactor?_token=' + $('meta[name="_token"]').attr('content'),
        imageUpload: 'admin/uploadRedactor?_token=' + $('meta[name="_token"]').attr('content'),
        imageManagerJson: 'admin/imageJson',
        fileManagerJson: 'admin/fileJson',
        buttons    : ['html','|','formatting','bold','italic','|','unorderedlist','orderedlist','outdent','indent','|','image','file','link','alignment']
    });

    $('.redactorSimple').redactor({
        minHeight  : 80,
        maxHeight: 150,
        focus: true,
        lang: 'fr',
        plugins: ['imagemanager'],
        imageUpload: 'admin/uploadRedactor?_token=' + $('meta[name="_token"]').attr('content'),
        imageManagerJson: 'admin/imageJson',
        buttons    : ['html','|','formatting','bold','italic','|','link','alignment','image']
    });

    $.fn.datepicker.dates['fr'] = {
        days: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
        daysShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
        daysMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
        months: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
        monthsShort: ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'],
        today: "Aujourd'hui",
        clear: "Clear"
    };

    $('.datePicker').datepicker({
        format: 'yyyy-mm-dd',
        language: 'fr'
    });

    $('body').on('click','.deleteAction',function(event){

        var $this  = $(this);
        var action = $this.data('action');
        var answer = confirm('Voulez-vous vraiment supprimer : '+ action +' ?');

        if (answer){
            return true;
        }
        return false;
    });

    // The url to the application
    var base_url = location.protocol + "//" + location.host+"/";

    var $accordion = $('#accordionParent');

    $accordion.on('show','.collapse', function() {
        console.log($(this));
        $accordion.find('.collapse.in').collapse('hide');
    });

    $('#accordionParent').find('.accordion-toggle').click(function()
    {
        var $toggle = $(this).data('toggle');

        console.log($toggle);
        //Expand or collapse this panel
        $('#'+$toggle).slideToggle('fast');
        //Hide the other panels
        $(".collapse").not( $('#'+$toggle) ).slideUp('fast');
    });

    // The url to the application
    var url = location.protocol + "//" + location.host+"/";

    $( "#sortable" ).sortable({
        axis: 'y',
        update: function (event, ui) {
            var data = $(this).sortable('serialize');
            var data = $(this).sortable('serialize') +"&_token=" + $("meta[name='_token']").attr('content');
            // POST to server using $.post or $.ajax
            $.ajax({
                data: data,
                type: 'POST',
                url: url+ 'admin/donnee/sorting'
            });
        }
    });

    $( "#sortable2" ).sortable({
        axis: 'y',
        update: function (event, ui) {
            var data = $(this).sortable('serialize');
            var data = $(this).sortable('serialize') +"&_token=" + $("meta[name='_token']").attr('content');
            // POST to server using $.post or $.ajax
            $.ajax({
                data: data,
                type: 'POST',
                url: url+ 'admin/menu/sorting'
            });
        }
    });

    $('.selectLevel').on('change',function(){

        var level = $(this).data('level');
        var id    = $(this).val();

        $.ajax({
            type     : 'GET',
            url      : base_url + 'admin/autorites/'+ level + '/' + id,
            success: function (data) {
                console.log(data);
                $('#selectAutorite').empty().append(data);
            },
            error: function (data) {}
        });

    });

    if( $( "#droppable").length)
    {
        $( "#draggable" ).draggable({
            create: function( event, ui ) {
                var top  = $(this).data('top');
                var left = $(this).data('left');

                $(this).css({'top' : top, 'left' : left});
            }
        });
        $( "#droppable" ).droppable({
            drop: function( event, ui ) {
                var position = ui.position.top + ',' + ui.position.left;
                var $input = $('#position');
                $input.val(position);
            }
        });
    }

    $('#selectCanton').on('change',function(){

        var id = $(this).val();

        $.ajax({
            type   : 'GET',
            url    : base_url + 'admin/canton/map/' + id,
            success: function (data) {
                console.log(data);
                $('#droppableMap').empty().append(data);
            },
            error: function (data) {}
        });
    });

});