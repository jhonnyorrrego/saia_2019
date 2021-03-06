var topModalDefaults = {
    content: '', //html a mostrar en caso de no suministrar una url
    url: '', // ruta archivo a cargar
    params: {}, //parametros a enviar a url
    backdrop: true,
    keyboard: true,
    size: '', //tamaño de la ventana 'modal-lg', 'modal-sm' , 'modal-xl'
    title: '', //titulo
    centerAlign: true, //centrar verticalmente
    keep: false, //mantener el contenido en caso de volver a llamarse la misma configuracion
    buttons: {
        success: {
            label: 'Guardar',
            class: 'btn btn-complete'
        },
        cancel: {
            label: 'Cancelar',
            class: 'btn btn-danger'
        }
    },
    beforeShow: function(event) {
        return true;
    }, //evento ejecutado antes de mostrar
    afterShow: function(event) {
        return true;
    }, //evento ejecutado despues de mostrar
    beforeHide: function(event) {
        return true;
    }, //evento ejecutado antes de cerrar
    afterHide: function(event) {
        return true;
    }, //evento ejecutado despues de cerrar
    onSuccess: function() {
        return true;
    }
};

var topJsPanelDefaults = {
    iconfont: 'fa',
    theme: 'dark',
    contentOverflow: 'hidden',
    position: {
        my: 'center-top',
        at: 'center-top'
    }
};

function topModal(options) {
    if (typeof window.modalClone == 'undefined') {
        window.modalClone = $('#dinamic_modal', window.top.document).prop(
            'outerHTML'
        );
    }

    if (
        window.modalOptions &&
        window.modalOptions.keep &&
        window.modalOptions.url == options.url
    ) {
        return openModal(options);
    }

    var modal = $('#dinamic_modal', window.top.document);
    var modalDialog = modal.find('.modal-dialog');
    var modalBody = modal.find('#modal_body');
    var options = $.extend({}, topModalDefaults, options);

    setEvents(options, modal);

    modal.find('#btn_success').off('click');
    modalBody.html('');
    modal.find('#modal_title').text(options.title);
    modalDialog.removeClass('modal-lg modal-sm modal-xl');

    modal.attr('data-backdrop', options.backdrop);
    modal.attr('data-keyboard', options.keyboard);

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
            modal
                .find('#btn_success')
                .show()
                .text(options.buttons.success.label)
                .addClass(options.buttons.success.class);
        } else {
            modal.find('#btn_success').hide();
        }

        if (options.buttons && options.buttons.cancel) {
            modal
                .find('#close_modal')
                .show()
                .text(options.buttons.cancel.label)
                .addClass(options.buttons.cancel.class)
                .off('click')
                .on('click', function() {
                    top.closeTopModal();
                });
        } else {
            modal.find('#close_modal').hide();
        }
    } else {
        modal.find('.modal-footer').hide();
    }

    if (options.url) {
        modalBody.load(
            Session.getBaseUrl() + options.url,
            options.params,
            function(response, status, xhr) {
                if (status == 'success') {
                    modalBody.prepend('<hr class="mt-1">');
                } else {
                    console.error('failed to load');
                    modalBody.html('');
                }

                openModal(options);
            }
        );
    } else if (options.content) {
        modalBody.prepend('<hr class="mt-1">');
        modalBody.append(options.content);
        openModal(options);
    } else {
        console.error('must set some source');
    }
}

function setEvents(options, modal) {
    modal.off('show.bs.modal').on('show.bs.modal', function(e) {
        options.beforeShow(e);
    });

    modal.off('shown.bs.modal').on('shown.bs.modal', function(e) {
        options.afterShow(e);
    });

    modal.off('hide.bs.modal').on('hide.bs.modal', function(e) {
        options.beforeHide(e);
    });

    modal.off('hidden.bs.modal').on('hidden.bs.modal', function(e) {
        if (!window.modalOptions.keep) {
            $('#dinamic_modal', window.top.document).modal('hide');

            $('#dinamic_modal', window.top.document).remove();
            $("[data-target='#dinamic_modal']", window.top.document).after(
                window.modalClone
            );
        }
        options.afterHide(e);
    });
}

function openModal(options) {
    if (!$('#dinamic_modal', window.top.document).is(':visible')) {
        $("[data-target='#dinamic_modal']", window.top.document).trigger(
            'click'
        );
        window.modalOptions = options;
    } else {
        if (!options.oldSource) {
            options.oldSource = window.modalOptions;
        }
        window.modalOptions = options;
    }
}

function closeTopModal() {
    if (window.modalOptions && window.modalOptions.oldSource) {
        let source = window.modalOptions.oldSource;
        window.modalOptions = null;
        top.topModal(source);
    } else {
        $('#dinamic_modal', window.top.document).modal('hide');
    }
}

function successModalEvent(data) {
    window.modalOptions.onSuccess(data);
}

function topJsPanel(options) {
    if (typeof top.jsPanel == 'undefined') {
        let baseUrl = top
            .jQuery('script[data-baseurl]', window.top.document)
            .data('baseurl');
        top.jQuery.get(
            `${baseUrl}node_modules/jspanel4/dist/jspanel.min.css`,
            function(r) {
                $('head').append($('<style>').html(r));
                top.jQuery.getScript(
                    `${baseUrl}node_modules/jspanel4/dist/jspanel.min.js`,
                    function() {
                        showJsPanel(options);
                    }
                );
            }
        );
    } else {
        showJsPanel(options);
    }
}

function showJsPanel(options) {
    options = $.extend({}, topJsPanelDefaults, options);
    jsPanel.ziBase = 10000;
    jsPanel.create(options);
}
