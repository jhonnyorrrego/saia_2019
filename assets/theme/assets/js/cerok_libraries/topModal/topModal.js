var topModalDefaults = {
    url: "", // url to open
    params: {}, //params for url ej: baseUrl
    size: "", //'modal-lg', 'modal-sm'
    title: "", //title for modal
    backdrop: true,
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

    if(options.url){
        modal.find('#modal_body').load(options.url, options.params,function(response, status, xhr){
            if (status == 'success'){                
                modal.find('#modal_body').prepend('<hr>');
                modal.find('#modal_title').text(options.title);
                modal.modal({backdrop : options.backdrop});
    
                if ($.inArray(options.size, ['modal-lg', 'modal-sm']) != -1){
                    modal.find('.modal-dialog').removeClass('modal-lg modal-sm');
                    modal.find('.modal-dialog').addClass(options.size);
                }
    
                modal.find("#btn_success")
                    .text(options.buttons.success.label)
                    .addClass(options.buttons.success.class)
    
                modal.find("#close_modal")
                    .text(options.buttons.cancel.label)
                    .addClass(options.buttons.cancel.class)
            }else{
                console.error('failed to load');
            }
        });
    }else{
        console.error('undefined url');
    }
}