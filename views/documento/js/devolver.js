$(function() {
    let params = $('script[data-returnparams]').data('returnparams');
    $('script[data-returnparams]').removeAttr('data-returnparams');

    (function init() {
        top.notification({
            type: 'error',
            message: 'PENDIENTE DESARROLLAR DEVOLUCIONES CON REEMPLAZOS'
        });
        findData();
    })();

    $("[name='motivo']").on('change', function() {
        $('#observation').val($(this).val());
    });

    $('#btn_success').on('click', function() {
        if ($("[name='motivo']:checked").length) {
            if (!$('#observation').val()) {
                top.notification({
                    type: 'error',
                    message: 'Debe indicar las observaciones'
                });
            } else {
                submitForm();
            }
        } else {
            top.notification({
                type: 'error',
                message: 'Debe indicar el motivo'
            });
        }
    });

    function findData() {
        $.post(
            `${params.baseUrl}app/documento/datos_devolver.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                documentId: params.documentId
            },
            function(response) {
                if (response.success) {
                    putData(response.data);
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            },
            'json'
        );
    }

    function putData(data) {
        $('#document_description').text(`${data.number} - ${data.description}`);
        $('#return_date').text(`${data.date}`);
        $("[name='fecha']").val(`${data.date}`);
        $('#username').text(`${data.username}`);
        $("[name='userId']").val(`${data.userId}`);
    }

    function submitForm() {
        $.post(
            `${params.baseUrl}app/documento/devolver.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                documentId: params.documentId,
                destination: $("[name='userId']").val(),
                description: $('#observation').val()
            },
            function(response) {
                if (response.success) {
                    top.notification({
                        type: 'success',
                        message: response.message
                    });
                    top.closeTopModal();
                    top.successModalEvent();
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            },
            'json'
        );
    }
});
