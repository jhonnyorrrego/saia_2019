$(function() {
    var baseUrl = Session.getBaseUrl();
    var userId = localStorage.getItem('key');
    var params = {
        key: userId,
        number: 0,
        string: '',
        date: ''
    };

    $('#document_finder').select2({
        minimumInputLength: 2,
        language: 'es',
        ajax: {
            url: `${baseUrl}app/documento/autocompletar.php`,
            dataType: 'json',
            data: function(params) {
                return {
                    query: params.term,
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token')
                };
            },
            processResults: function(response) {
                return response.success ? { results: response.data } : {};
            }
        }
    });

    $('#clean_finder').on('click', function() {
        $('#document_finder')
            .val(null)
            .trigger('change');
    });

    $('.finder_option').on('click', function() {
        $('#document_finder').trigger('blur');

        switch ($(this).data('type')) {
            case 'folder':
                var file = 'busqueda_general_expedientes.php';
                var component = 'busqueda_general_expedientes';
                break;
            case 'task':
                var file = 'busqueda_general_tareas.php';
                var component = 'busqueda_general_tareas';
                break;
            case 'file':
                var file = 'busqueda_general_anexos.php';
                var component = 'busqueda_general_anexos';
                break;
            case 'document':
            default:
                var file = 'busqueda_general_documentos.php';
                var component = 'busqueda_general_documentos';
                break;
        }

        $.post(
            `${baseUrl}app/busquedas/consulta_componente.php`,
            {
                key: localStorage.getItem('key'),
                name: component
            },
            function(response) {
                if (response.success) {
                    let options = {
                        url: `${baseUrl}views/buzones/${file}`,
                        params: {
                            idbusqueda_componente: response.data
                        },
                        size: 'modal-lg',
                        title: 'Búsqueda avanzada',
                        centerAlign: false,
                        buttons: {}
                    };

                    topModal(options);
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            },
            'json'
        );
    });
});
