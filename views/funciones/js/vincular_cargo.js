$(function() {
    let params = $('#bind_function_script').data('params');
    $('#bind_function_script').removeAttr('data-params');

    $('#btn_success').on('click', function() {
        if ($('#function').val().length) {
            saveRelations();
        } else {
            top.notification({
                type: 'error',
                message: 'Debe indicar las funciones'
            });
        }
    });

    (function init() {
        createAutocomplete();
    })();

    function createAutocomplete() {
        $('#function').select2({
            minimumInputLength: 3,
            language: 'es',
            ajax: {
                url: `${params.baseUrl}app/funciones/autocompletar.php`,
                dataType: 'json',
                data: function(params) {
                    return {
                        term: params.term,
                        key: localStorage.getItem('key'),
                        token: localStorage.getItem('token')
                    };
                },
                processResults: function(response) {
                    return response.success ? { results: response.data } : {};
                }
            }
        });
    }

    function saveRelations() {
        $.post(
            `${params.baseUrl}app/funciones/vincular_cargo.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                position: params.position,
                functions: $('#function').val()
            },
            function(response) {
                if (response.success) {
                    top.notification({
                        type: 'success',
                        message: response.message
                    });
                    top.successModalEvent();
                    top.closeTopModal();
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
