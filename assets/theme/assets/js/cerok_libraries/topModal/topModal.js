var topModalDefaults = {
    url: "", // url to open
    params: {}, //params for url ej: baseUrl
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

function topModal(options) {
    var modal = $('#dinamic_modal', window.top.document);
    var modalDialog = modal.find('.modal-dialog');
    var options = $.extend({}, topModalDefaults, options);

    modal.find("#btn_success").off("click");
    modal.find('#modal_body').html('');
    modal.find('#modal_title').text(options.title);
    modalDialog.removeClass('modal-lg modal-sm modal-xl');

    if (options.centerAlign) {
        modalDialog.addClass('modal-dialog-centered');
    } else {
        modalDialog.removeClass('modal-dialog-centered');
    }

    if ($.inArray(options.size, ['modal-lg', 'modal-sm', 'modal-xl']) != -1) {
        modalDialog.removeClass('modal-lg modal-sm modal-xl');
        modalDialog.addClass(options.size);
    }

    if (options.buttons.success || options.buttons.cancel) {
        modal.find('.modal-footer').show();
        if (options.buttons && options.buttons.success) {
            modal.find("#btn_success").show()
                .text(options.buttons.success.label)
                .addClass(options.buttons.success.class);
        } else {
            modal.find("#btn_success").hide();
        }

        if (options.buttons && options.buttons.cancel) {
            modal.find("#close_modal").show()
                .text(options.buttons.cancel.label)
                .addClass(options.buttons.cancel.class);
        } else {
            modal.find("#close_modal").hide();
        }
    } else {
        modal.find('.modal-footer').hide();
    }

    if (options.url) {
        modal.find('#modal_body').load(options.url, options.params, function (response, status, xhr) {
            if (status == 'success') {
                modal.find('#modal_body').prepend('<hr class="mt-1">');
            } else {
                console.error('failed to load');
                modal.find('#modal_body').html('');
            }

            openModal(options);
        });
    } else {
        console.error('debe indicar la url');
    }
}

function openModal(options) {
    if (!$('#dinamic_modal', window.top.document).is(':visible')) {
        $("[data-target='#dinamic_modal']", window.top.document).trigger('click');
        window.modalOptions = options;
    } else {
        options.oldSource = window.modalOptions;
        window.modalOptions = options;
    }
}

function closeTopModal() {
    if (window.modalOptions.oldSource) {
        top.topModal(window.modalOptions.oldSource);
        window.modalOptions = {};
    } else {
        $('#dinamic_modal', window.top.document).modal('hide');
    }
}