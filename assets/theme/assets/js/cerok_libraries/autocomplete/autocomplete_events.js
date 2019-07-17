$(function () {
    var baseUrl = Session.getBaseUrl();

    $('#document_finder').select2({
        minimumInputLength: 2,
        language: 'es',
        ajax: {
            url: `${baseUrl}app/documento/autocompletar.php`,
            dataType: 'json',
            data: function (params) {
                return {
                    query: params.term,
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token')
                };
            },
            processResults: function (response) {
                return response.success ? { results: response.data } : {};
            }
        }
    });

    $('#clean_finder').on('click', function () {
        $('#document_finder')
            .val(null)
            .trigger('change');
    });

    $('.finder_option').on('click', function () {
        switch ($(this).data('type')) {
            case 'folder':
                var file = 'busqueda_general_expedientes.php';
                break;
            case 'task':
                var file = 'busqueda_general_tareas.php';
                break;
            case 'file':
                var file = 'busqueda_general_anexos.php';
                break;
            case 'document':
            default:
                var file = 'busqueda_general_documentos.php';
                break;
        }

        topModal({
            url: `${baseUrl}views/buzones/${file}`,
            size: 'modal-lg',
            title: 'Búsqueda avanzada',
            centerAlign: false,
            keep: true,
            buttons: {}
        });
    });
});
