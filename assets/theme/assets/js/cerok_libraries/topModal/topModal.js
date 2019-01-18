var topModalDefaults = {
    url: "", // url to open
    params: {}, //params for url ej: baseUrl
    html: false, //for show specific html
    content: '', //string to put on modal
    size: "", //'modal-lg', 'modal-sm' , 'modal-xl'
    title: "", //title for modal
    centerAlign: true, //true for center align, false for top align
    buttons: {
        success: {
            label: 'Enviar',
            class: 'btn btn-complete'
        },
        cancel: {
            label: 'Cancelar',
            class: 'btn btn-danger'
        }
    }
};

function topModal(options){
    var modal = $('#dinamic_modal', window.top.document);
    var options = $.extend({}, topModalDefaults, options);

    modal.find("#btn_success").off("click");
    modal.find('#modal_body').html('');
    modal.find('#modal_title').text(options.title);

    if(options.centerAlign){
        modal.find('.modal-dialog').addClass('modal-dialog-centered');
    }else{
        modal.find('.modal-dialog').removeClass('modal-dialog-centered');
    }
    
    if ($.inArray(options.size, ['modal-lg', 'modal-sm', 'modal-xl']) != -1) {
        modal.find('.modal-dialog').removeClass('modal-lg modal-sm modal-xl');
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

            $("[data-target='#dinamic_modal']", window.top.document).trigger('click');
        });
    }else if(options.html && options.content){
        modal.find('#modal_body').html(options.content);
        modal.find('#modal_body').prepend('<hr>');
        
        $("[data-target='#dinamic_modal']", window.top.document).trigger('click');
    }
}