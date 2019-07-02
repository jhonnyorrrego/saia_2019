$(function() {
    let params = $('#user_script').data('params');
    let baseUrl = params.baseUrl;

    $('#user_script').removeAttr('data-params');

    (function init() {
        if (params.userId) {
            find(params.userId);
        } else {
            showMultipleSelect();
        }
    })();

    $('#btn_success').on('click', function() {
        $('#user_form').trigger('submit');
    });

    function find(userId) {
        $.post(
            `${baseUrl}app/remitente/detalles.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                userId: userId
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
                case 'tipo_ejecutor':
                    $(`[name="tipo_ejecutor"][value="${data[name]}"]`).attr(
                        'checked',
                        true
                    );
                    break;
                default:
                    let e = $(`[name="${name}"]`);

                    if (e.length) {
                        e.val(data[name]).trigger('change');
                    }
                    break;
            }
        }

        showMultipleSelect(data.ciudad);
    }

    function showMultipleSelect(city) {
        if (typeof MultipleSelect === 'undefined') {
            $.getScript(
                `${baseUrl}assets/theme/assets/js/cerok_libraries/multipleSelect/multipleSelect.js`,
                r => {
                    createComponent(city);
                }
            );
        } else {
            createComponent(city);
        }
    }

    function createComponent(city) {
        let options = {
            selector: '#location_component',
            baseUrl: baseUrl,
            identificator: 'ciudad',
            defaultValues: true,
            defaultCity: city || null
        };
        new MultipleSelect(options);
    }
});

$('#user_form').validate({
    rules: {
        tipo: {
            required: true
        },
        nombre: {
            required: true
        },
        identificacion: {
            required: true
        }
    },
    messages: {
        tipo: {
            required: 'Campo requerido'
        },
        nombre: {
            required: 'Campo requerido'
        },
        identificacion: {
            required: 'Campo requerido'
        }
    },
    submitHandler: function(form) {
        let params = $('#user_script').data('params');
        let data = $('#user_form').serialize();
        data =
            data +
            '&' +
            $.param({
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                userId: params.userId
            });

        $.post(
            `${params.baseUrl}app/remitente/adicionar.php`,
            data,
            function(response) {
                if (response.success) {
                    top.notification({
                        message: response.message,
                        type: 'success'
                    });
                    top.successModalEvent();
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
