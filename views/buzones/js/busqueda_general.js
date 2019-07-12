$(function() {
    let baseUrl = $('script[data-baseurl]').data('baseurl');

    $('#btn_success').on('click', function() {
        $.post(
            `${baseUrl}pantallas/busquedas/procesa_filtro_busqueda.php`,
            $('#kformulario_saia').serialize(),
            function(data) {
                if (data.exito) {
                    top.successModalEvent(data);
                } else {
                    top.notification({
                        message: data.mensaje,
                        type: 'error'
                    });
                }
            },
            'json'
        );
    });

    (function init() {
        findComponent();
        createPicker();
    })();

    function findComponent() {
        $.post(
            `${baseUrl}app/busquedas/consulta_componente.php`,
            {
                token: localStorage.getItem('token'),
                key: localStorage.getItem('key'),
                name: 'busqueda_general'
            },
            function(response) {
                if (response.success) {
                    $('#component').val(response.data.idbusqueda_componente);
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

    function createPicker() {
        $('#fecha_inicial,#fecha_final').datetimepicker({
            locale: 'es',
            format: 'YYYY-MM-DD'
        });
    }
});
