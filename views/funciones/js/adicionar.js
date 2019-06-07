$(function() {
    let functionData = new Object();
    let params = $('#add_function_script').data('params');
    $('#add_function_script').removeAttr('data-params');

    $('#btn_success').on('click', function() {
        $('#function_form').trigger('submit');
    });

    (function init() {
        if (+params.functionId) {
            functionData = findFunction();
        }

        showState(functionData.estado);
        $("[name='name']").val(functionData.nombre);
    })();

    function findFunction() {
        let data = null;
        $.ajax({
            type: 'POST',
            dataType: 'json',
            async: false,
            url: `${params.baseUrl}app/funciones/detalles.php`,
            data: {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                functionId: params.functionId
            },
            success: function(response) {
                if (response.success) {
                    data = response.data;
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            }
        });

        return data;
    }

    function showState(state = 0) {
        if (+params.functionId) {
            $(`[name='state'][value='${state}']`).prop('checked', true);
        } else {
            $('#state_container').hide();
        }
    }
});

$('#function_form').validate({
    ignore: '',
    rules: {
        name: {
            required: true
        },
        state: {
            required: true
        }
    },
    messages: {
        name: {
            required: 'Debe indicar el nombre de la función'
        },
        state: {
            required: 'Debe indicar un estado'
        }
    },
    submitHandler: function(form) {
        let params = $('#add_function_script').data('params');
        let data = $('#function_form').serialize();
        data =
            data +
            '&' +
            $.param({
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                functionId: params.functionId
            });

        $.post(
            `${params.baseUrl}app/funciones/adicionar.php`,
            data,
            function(response) {
                if (response.success) {
                    top.notification({
                        message: response.message,
                        type: 'success'
                    });
                    top.successModalEvent();
                    top.closeTopModal();
                } else {
                    top.notification({
                        message: response.message,
                        type: 'error',
                        title: 'Error!'
                    });
                }
            },
            'json'
        );
    }
});
