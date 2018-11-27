var topModalDefaults = {
    url: "", // url to open
    params: {}, //params for url ej: baseUrl
    html: false, //for show specific html
    content: '', //string to put on modal
    size: "", //'modal-lg', 'modal-sm'
    title: "", //title for modal
    buttons: {
        success: {
            label: 'Enviar',
            class: 'btn btn-complete'
        },
        cancel: {
            label: 'Cancelar',
            class: 'btn btn-danger'
        }
    },
};

function topModal(options){
    var modal = $('#dinamic_modal', window.top.document);
    var options = $.extend({}, topModalDefaults, options);

    modal.find("#btn_success").off("click");
    modal.find('#modal_body').html('');
    modal.find('#modal_title').text(options.title);
    //evita error de backdrop en iframes
    $("[data-target='#dinamic_modal']", window.top.document).trigger('click');
    if ($.inArray(options.size, ['modal-lg', 'modal-sm']) != -1) {
        modal.find('.modal-dialog').removeClass('modal-lg modal-sm');
        modal.find('.modal-dialog').addClass(options.size);
    }

    if(options.buttons && options.buttons.success){
        modal.find("#btn_success").show()
            .text(options.buttons.success.label)
            .addClass(options.buttons.success.class);
    }else{
        modal.find("#btn_success").hide();
    }

    if(options.buttons && options.buttons.cancel){
        modal.find("#close_modal").show()
            .text(options.buttons.cancel.label)
            .addClass(options.buttons.cancel.class);
    }else{
        modal.find("#close_modal").hide();
    }

    if(options.url && !options.html){
        modal.find('#modal_body').load(options.url, options.params,function(response, status, xhr){
            if (status == 'success'){                
                modal.find('#modal_body').prepend('<hr>');
            }else{
                console.error('failed to load');
                modal.find('#modal_body').html('');
            }
        });
    }else if(options.html && options.content){
        modal.find('#modal_body').html(options.content);
        modal.find('#modal_body').prepend('<hr>');
    }
}