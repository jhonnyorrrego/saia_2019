$(function() {
    let baseUrl = $('script[data-baseurl]').data('baseurl');

    (function init() {
        $('#filtro_usuario, #filtro_fecha').select2();
        createPicker();
        createAutocomplete();
        findComponent();
    })();

    $('#clear').on('click', function() {
        $('#filtro_usuario,#filtro_fecha')
            .val(1)
            .trigger('change');
        $('#task_name').val('');
        $('#select_responsable')
            .val(null)
            .trigger('change');
        $('#fecha_inicial')
            .data('DateTimePicker')
            .clear();
        $('#fecha_final')
            .data('DateTimePicker')
            .clear();
    });

    $('#find_tasks_form').on('submit', function(e) {
        e.preventDefault();

        top.notification({
            type: 'info',
            message: 'Esto puede tardar un momento'
        });

        $.post(
            `${baseUrl}pantallas/busquedas/procesa_filtro_busqueda.php`,
            $('#find_tasks_form').serialize(),
            function(response) {
                if (response.exito) {
                    let route = baseUrl + response.url;
                    $('#iframe_workspace').attr('src', route);
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            },
            'json'
        );

        $('#dinamic_modal').modal('hide');
    });

    $('#filtro_usuario').on('select2:select', function(e) {
        $('#select_responsable')
            .val(null)
            .trigger('change');

        switch (e.params.data.id) {
            case '1':
                $('#user_container').hide();
                break;
            case '2':
                defaultUser();
                $('#user_container').hide();
                break;
            case '3':
                $('#user_container').show();
                break;
        }
    });

    $('#filtro_fecha').on('select2:select', function(e) {
        $('#fecha_inicial')
            .data('DateTimePicker')
            .clear();
        $('#fecha_final')
            .data('DateTimePicker')
            .clear();
        $('#date_container').hide();

        let today = moment().set({
            hour: 0,
            minute: 0,
            second: 0,
            millisecond: 0
        });

        switch (e.params.data.id) {
            case '2':
                var initial = today.clone();
                var final = today.clone();
                break;
            case '3':
                var initial = today.clone().subtract(1, 'days');
                var final = today.clone().subtract(1, 'days');
                break;
            case '4':
                var initial = today.clone().subtract(7, 'days');
                var final = today.clone();
                break;
            case '5':
                var initial = today.clone().subtract(30, 'days');
                var final = today.clone();
                break;
            case '6':
                var initial = today.clone().subtract(90, 'days');
                var final = today.clone();
                break;
            default:
                $('#date_container').show();
                break;
        }

        if (initial && final) {
            $('#fecha_inicial')
                .data('DateTimePicker')
                .defaultDate(initial);
            $('#fecha_final')
                .data('DateTimePicker')
                .defaultDate(final);
        }
    });

    $('#select_responsable').on('select2:select change', function(e) {
        let values = $('#select_responsable').val();
        $('#user_list').val(values.join(','));
    });

    function defaultUser() {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: `${baseUrl}app/funcionario/autocompletar.php`,
            data: {
                defaultUser: localStorage.getItem('key'),
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token')
            },
            success: function(response) {
                response.data.forEach(u => {
                    var option = new Option(u.text, u.id, true, true);
                    $('#select_responsable')
                        .append(option)
                        .trigger('change');
                });
            }
        });
    }

    function createPicker() {
        $('#fecha_inicial,#fecha_final').datetimepicker({
            locale: 'es',
            format: 'YYYY-MM-DD'
        });
    }

    function findComponent() {
        $.post(
            `${baseUrl}app/busquedas/consulta_componente.php`,
            {
                token: localStorage.getItem('token'),
                key: localStorage.getItem('key'),
                name: 'busqueda_general_documentos'
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

    function createAutocomplete() {
        $('#select_responsable').select2({
            minimumInputLength: 3,
            language: 'es',
            ajax: {
                url: `${baseUrl}app/funcionario/autocompletar.php`,
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
});
