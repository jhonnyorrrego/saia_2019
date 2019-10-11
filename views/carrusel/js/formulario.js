$(function() {
    let params = $('#carousel_script').data('params');
    let baseUrl = params.baseUrl;

    (function init() {
        if (params.carouselId) {
            find(params.carouselId);
        }
    })();

    $('#btn_success').on('click', function() {
        $('#carousel_form').trigger('submit');
    });

    function find(carouselId) {
        $.post(
            `${baseUrl}app/carrusel/consulta.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                carouselId: carouselId
            },
            function(response) {
                if (response.success) {
                    $(`[name="nombre"]`).val(response.data.nombre);
                    $(`[name="estado"][value="${response.data.estado}"]`).attr(
                        'checked',
                        true
                    );
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

$('#carousel_form').validate({
    rules: {
        nombre: {
            required: true
        },
        estado: {
            required: true
        }
    },
    messages: {
        estado: {
            required: 'Campo requerido'
        },
        nombre: {
            required: 'Campo requerido'
        }
    },
    submitHandler: function(form) {
        let params = $('#carousel_script').data('params');
        let data = $('#carousel_form').serialize();
        data =
            data +
            '&' +
            $.param({
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                carouselId: params.carouselId
            });

        $.post(
            `${params.baseUrl}app/carrusel/guardar.php`,
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
