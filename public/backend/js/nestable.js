$(function(){

    var base_url = location.protocol + "//" + location.host+"/";

    function updateOutput(e) {

        var list = e.length ? e : $(e.target),
            output = list.data('output');

        var data = list.nestable('serialize');

        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }

        $.ajax({
            dataType: "json",
            type    : 'POST',
            url     : base_url + 'admin/hierarchy',
            data    : { data : data, _token: $("meta[name='token']").attr('content') },
            success: function(data) {
                console.log('added');
            },
            error: function(data) {
                console.log('error');
            }
        });

    }

    // activate Nestable for list 1
    //$('.nestable_list').nestable().on('change', updateOutput);

/*    if($('.nestable_list').length){
        // output initial serialised data
        updateOutput($('#nestable').data('output', $('#nestable-output')));
    }*/

});
