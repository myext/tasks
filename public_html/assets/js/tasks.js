
$(document).ready(function() {

    $( ".done" ).click(function(e){

        let form = $(this).parents('form').first();

        $.ajax({
            url: form.attr('action') + '/done',
            method: 'post',
            dataType: 'json',
            data: form.serialize(),
            success: function(data){
                $('#success').modal('show');
                $('#successText').text(data.message);
            },
            error: function (jqXHR, exception) {
                if(typeof(jqXHR.responseJSON) != "undefined" && jqXHR.responseJSON !== null) {
                    $('#error').modal('show');
                    $('#errorText').text(jqXHR.responseJSON.message);
                }
            }
        });
    })


    $( ".update" ).click(function(e){

        e.preventDefault();

        let form = $(this).parents('form').first();

        $.ajax({
            url: form.attr('action') + '/update',
            method: 'post',
            dataType: 'json',
            data: form.serialize(),
            success: function(data){
                $('#success').modal('show');
                $('#successText').text(data.message);
                $(form).find('.is_censored').first().removeAttr('hidden');
            },
            error: function (jqXHR, exception) {
                if(typeof(jqXHR.responseJSON) != "undefined" && jqXHR.responseJSON !== null) {
                    $('#error').modal('show');
                    $('#errorText').text(jqXHR.responseJSON.message);
                }

            }
        });
    })

    //////////////////////////////////////////////////////////////

    var tasksContainer = $('#tasks');


    if(type = $.cookie('sort_type')){
        sort(type, $.cookie(type+'_direction'));
    }

    function sort(name, direction){

        if(direction) {direct = Number(direction)}
        else direct = 1;

        if($.cookie('name_sort')) {name_sort = Number($.cookie('name_sort'))}
        else name_sort = -1;

        $(".task").sort(function (a, b) {

            let val_a = $(a).find("[sort='"+ name +"']").attr('state');
            let val_b = $(b).find("[sort='"+ name +"']").attr('state');

            if (val_a < val_b) return -direct;
            if (val_a > val_b) return direct;
            return 0;

        }).appendTo(tasksContainer);
    }


    $( ".mysort" ).click(function(e){

        let type = $(this).attr( "type" );

        switch (type) {
            case 'name':
                let name_direction = Number($.cookie('name_direction'));
                if(name_direction){ $.cookie('name_direction', -name_direction)
                }else { $.cookie('name_direction', '1')}
                $.cookie('sort_type', 'name');
                sort('name', -name_direction);
                break;
            case 'email':
                let email_direction = Number($.cookie('email_direction'));
                if(email_direction){ $.cookie('email_direction', -email_direction)
                }else { $.cookie('email_direction', '1')}
                $.cookie('sort_type', 'email')
                sort('email', -email_direction);
                break;
            case 'status':
                let status_direction = Number($.cookie('status_direction'));
                if(status_direction){ $.cookie('status_direction', -status_direction)
                }else { $.cookie('status_direction', '1')}
                $.cookie('sort_type', 'status')
                sort('status', -status_direction);
                break;
        }
    });


});



