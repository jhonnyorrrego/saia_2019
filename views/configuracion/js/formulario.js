$(function() {
    let params = $('#configuration_script').data('params');
    let baseUrl = params.baseUrl;

    $('#configuration_script').removeAttr('data-params');

    (function init() {
        if (params.configurationId) {
            find(params.configurationId);
        }
    })();

    $('#btn_success').on('click', function() {
        $('#configuration_form').trigger('submit');
    });

    function find(configurationId) {
        $.post(
            `${baseUrl}app/configuracion/consulta.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                configurationId: configurationId
            },
            function(response) {
                if (response.success) {
                    fillForm(response.data);
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

    function fillForm(data) {
        for (let name in data) {
            switch (name) {
                case 'encrypt':
                case 'acceso_root':
                    $(`[name="${name}"][value="${data[name]}"]`).attr(
                        'checked',
                        true
                    );
                    break;
                default:
                    $(`[name="${name}"]`).val(data[name]);
                    1;
                    break;
            }
        }
    }
});

$('#configuration_form').validate({
    rules: {
        nombre: {
            required: true
        },
        valor: {
            required: true
        },
        tipo: {
            required: true
        }
    },
    messages: {
        nombre: {
            required: 'Campo requerido'
        },
        valor: {
            required: 'Campo requerido'
        },
        tipo: {
            required: 'Campo requerido'
        }
    },
    submitHandler: function(form) {
        let params = $('#configuration_script').data('params');
        let data = $('#configuration_form').serialize();
        data =
            data +
            '&' +
            $.param({
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                configurationId: params.configurationId
            });

        $.post(
            `${params.baseUrl}app/configuracion/guardar.php`,
            data,
            function(response) {
                if (response.success) {
                    top.notification({
                        message: response.message,
                        type: 'success'
                    });
                    top.successModalEvent(response.data);
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
