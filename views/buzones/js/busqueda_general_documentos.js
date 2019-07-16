$(function() {
    let baseUrl = $('script[data-baseurl]').data('baseurl');

    (function init() {
        $('#filtro_usuario, #filtro_fecha').select2();
        createPicker();
        createAutocompletes();
        findComponent();
        checkAdministrator();
    })();

    $('#clear').on('click', function() {
        $('#filtro_usuario,#filtro_fecha')
            .val(1)
            .trigger('change');
        $('#document_description').val('');
        $('#selectOwner')
            .val(null)
            .trigger('change');
        $('#fecha_inicial')
            .data('DateTimePicker')
            .clear();
        $('#fecha_final')
            .data('DateTimePicker')
            .clear();
    });

    $('#find_document_form').on('submit', function(e) {
        e.preventDefault();

        top.notification({
            type: 'info',
            message: 'Esto puede tardar un momento'
        });

        if ($('[name="bqsaia_w@nombre"]').length) {
            $('#filtro_adicional').val(
                'buzon_entrada w@ AND iddocumento=w.archivo_idarchivo'
            );
        } else {
            $('#filtro_adicional').val('');
        }

        $.post(
            `${baseUrl}pantallas/busquedas/procesa_filtro_busqueda.php`,
            $('#find_document_form').serialize(),
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
        createHiddenFields(e.params.data.id);
        $('#selectOwner')
            .empty()
            .val(null)
            .trigger('change');

        if (+e.params.data.id == 1) {
            $('#user_container').hide();
        } else if ([2, 3, 4, 5].indexOf(+e.params.data.id) != -1) {
            $('#user_container').show();
            defaultUser();
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

    $('#selectOwner').on('select2:select change', function(e) {
        let values = $('#selectOwner').val();
        $('.userList').val(values.join(','));
    });

    $('#selectTemplate').on('select2:select change', function(e) {
        if (e.params && e.params.data.name) {
            $('#template').val(e.params.data.name);
        } else {
            $('#template').val('');
        }
    });

    function checkAdministrator() {
        $.post(
            `${baseUrl}app/funcionario/consulta_perfiles.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                userId: localStorage.getItem('key')
            },
            function(response) {
                if (response.success) {
                    response.data.forEach(p => {
                        if (
                            ['ADMINISTRADOR', 'ADMIN_INTERNO'].indexOf(
                                p.nombre
                            ) != -1
                        ) {
                            $('#adminSearch').removeClass('d-none');
                        }
                    });
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

    function createHiddenFields(type) {
        switch (+type) {
            case 2:
                var fields = `
                    <input name="bqsaia_b@ejecutor" type="hidden" class="userList">
                    <input type="hidden" name="bksaiacondicion_b@ejecutor" value="in">
                    <input type="hidden" name="bqsaiaenlace_b@ejecutor" value="y" />
                `;
                break;
            case 3:
                var fields = `
                    <input name="bqsaia_a@destino" type="hidden" class="userList">
                    <input type="hidden" name="bksaiacondicion_a@destino" value="in">
                    <input type="hidden" name="bqsaiaenlace_a@destino" value="y" />

                    <input type="hidden" name="bksaiacondicion_a@nombre__1" value="in">
                    <input type="hidden" name="bqsaia_a@nombre__1" value="'transferido'">
                    <input type="hidden" name="bqsaiaenlace_a@nombre__1" value="y">
                `;
                break;
            case 4:
                var fields = `
                    <input name="bqsaia_a@origen__1" type="hidden" class="userList">
                    <input type="hidden" name="bksaiacondicion_a@origen__1" value="in">
                    <input type="hidden" name="bqsaiaenlace_a@origen__1" value="y" />

                    <input type="hidden" name="bksaiacondicion_a@nombre__2" value="in">
                    <input type="hidden" name="bqsaia_a@nombre__2" value="'transferido'">
                    <input type="hidden" name="bqsaiaenlace_a@nombre__2" value="y">
                        `;
                break;
            case 5:
                var fields = `
                    <input name="bqsaia_w@destino" type="hidden" class="userList">
                    <input type="hidden" name="bksaiacondicion_w@destino" id="bksaiacondicion_w@destino" value="in">
                    <input type="hidden" name="bqsaiaenlace_w@destino" value="y">

                    <input type="hidden" name="bksaiacondicion_w@nombre" id="bksaiacondicion_w-nombre" value="in">
                    <input type="hidden" id="bqsaia_w-nombre" name="bqsaia_w@nombre" value="'aprobado'">
                    <input type="hidden" name="bqsaiaenlace_w@nombre" value="y">
                        `;
                break;
            default:
                var fields = '';
                break;
        }

        $('#hidden_fields').html(fields);
    }

    function defaultUser() {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: `${baseUrl}app/funcionario/autocompletar.php`,
            data: {
                defaultUser: localStorage.getItem('key'),
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                identificator: 'funcionario_codigo'
            },
            success: function(response) {
                response.data.forEach(u => {
                    var option = new Option(u.text, u.id, true, true);
                    $('#selectOwner')
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

    function createAutocompletes() {
        $('#selectOwner').select2({
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

        $('#selectTemplate').select2({
            minimumInputLength: 3,
            language: 'es',
            ajax: {
                url: `${baseUrl}app/formato/autocompletar.php`,
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
