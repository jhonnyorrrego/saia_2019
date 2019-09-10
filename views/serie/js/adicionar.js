$(function () {
    let params = $('#adicionar_script').data('params');
    $('#adicionar_script').removeAttr('data-params');

    let sDependencia = $('#dependencia').select2();
    let sSerie = $('#serie').select2();
    let sSubserie = $('#subserie').select2();

    (function init() {

        loadDepOptions();

        sDependencia.on('select2:select', function (e) {
            let id = +e.params.data.id;
            loadDepSerieOptions(id);
        });

        sSerie.on('select2:select', function (e) {
            let id = +e.params.data.id;
            loadDepSerieSubOptions(id);
        });

        sSubserie.on('select2:select', function (e) {
            let id = +e.params.data.id;
            validateFields(2, id);
        });

        $("[name='disposicion']").change(function () {
            if ($(this).val() == 'S' || $(this).val() == 'CT') {
                $("#divMicrofilma").show()
            } else {
                $("#microfilma").attr('checked', false);
                $("#divMicrofilma").hide();
            }
        });


        $('#btn_success').on('click', function () {
            $('#trd_form').trigger('submit');
        });

    })();

    function defaultOptions(idSelector, add = 0) {
        $('#' + idSelector).empty().append(
            $('<option>', {
                value: 0,
                text: 'Seleccione ...'
            })
        );

        if (add) {
            $('#' + idSelector).append(
                $('<option>', {
                    value: -1,
                    text: 'NUEVA ' + idSelector.toUpperCase()
                })
            );
        }

    }

    function loadDepOptions() {
        $.ajax({
            type: 'POST',
            url: `${params.baseUrl}app/dependencia/obtener_dependencias.php`,
            data: {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token')
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    response.data.forEach(element => {
                        $('#dependencia').append(
                            $('<option>', {
                                value: element.iddependencia,
                                text: element.codigo + ' - ' + element.nombre
                            })
                        );
                    });

                    if (typeof params.request.iddependencia != "undefined") {
                        sDependencia.val(params.request.iddependencia).trigger("change");
                        loadDepSerieOptions(params.request.iddependencia);
                    }
                }
            }
        });
    }

    function loadDepSerieOptions(iddep) {

        defaultOptions('serie');
        defaultOptions('subserie');
        validateFields(0, iddep);

        if (iddep) {
            $.ajax({
                type: 'POST',
                url: `${params.baseUrl}app/dependencia_serie/obtener_serie_dep.php`,
                data: {
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token'),
                    iddependencia: iddep,
                    type: 1
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {

                        defaultOptions('serie', 1);

                        response.data.forEach(element => {
                            $('#serie').append(
                                $('<option>', {
                                    value: element.idserie,
                                    text: element.codigo + ' - ' + element.nombre
                                })
                            );
                        });

                        if (typeof params.request.idserie != "undefined") {
                            sSerie.val(params.request.idserie).trigger("change");
                            loadDepSerieSubOptions(params.request.idserie);
                        }
                    }
                }
            });
        }
    }

    function loadDepSerieSubOptions(idserie) {

        defaultOptions('subserie');
        validateFields(1, idserie);

        if (idserie) {

            if (idserie != -1) {

                $.ajax({
                    type: 'POST',
                    url: `${params.baseUrl}app/dependencia_serie/obtener_serie_dep.php`,
                    data: {
                        key: localStorage.getItem('key'),
                        token: localStorage.getItem('token'),
                        iddependencia: $("#dependencia").val(),
                        idserie: idserie,
                        type: 2
                    },
                    dataType: 'json',
                    success: function (response) {

                        if (response.success) {

                            defaultOptions('subserie', 1);

                            response.data.forEach(element => {
                                $('#subserie').append(
                                    $('<option>', {
                                        value: element.idserie,
                                        text: element.codigo + ' - ' + element.nombre
                                    })
                                );
                            });

                            if (typeof params.request.idsubserie != "undefined") {
                                sSubserie.val(params.request.idsubserie).trigger("change");
                                validateFields(2, params.request.idsubserie);
                            }
                        }
                    }
                });
            }
        }
    }

    function validateFields(type, idserie, newSerie = 0) {

        switch (type) {
            case 0:
                validateFields(1, 0)
                break;

            case 1:
                validateFields(2, 0);

                if (idserie == -1) {

                    $("#codigo_serie").rules("add", {
                        required: true
                    });

                    $("#nombre_serie").rules("add", {
                        required: true
                    });

                    $("#codigo_serie,#nombre_serie").parent().show();
                    validateFields(2, -1, 1);

                } else {
                    if (idserie) {
                        loadFields(idserie);
                    }
                    $("#codigo_serie,#nombre_serie").val("");
                    $("#codigo_serie,#nombre_serie").parent().hide();
                    $("#codigo_serie").rules("remove");
                    $("#nombre_serie").rules("remove");
                }
                break;

            case 2:

                $("#ret_gestion,#ret_central,#procedimiento").val("");
                $("#ret_gestion,#ret_central,#procedimiento").removeAttr("readonly");

                if (idserie == -1) {

                    if (newSerie == 1) {
                        defaultOptions('subserie', 1);
                    } else {
                        $("#codigo_subserie,#nombre_subserie").parent().show();

                        $("#codigo_subserie").rules("add", {
                            required: true
                        });

                        $("#nombre_subserie").rules("add", {
                            required: true
                        });
                    }

                } else {
                    if (idserie) {
                        loadFields(idserie);
                    }
                    $("#codigo_subserie,#nombre_subserie").val("");
                    $("#codigo_subserie,#nombre_subserie").parent().hide();
                    $("#codigo_subserie").rules("remove");
                    $("#nombre_subserie").rules("remove");
                }
                break;
            default:
                console.error("undefined type");
                break;
        }

    }

    function loadFields(idserie) {
        $.ajax({
            type: 'POST',
            url: `${params.baseUrl}app/serie/obtener_campos.php`,
            data: {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                idserie: idserie
            },
            dataType: 'json',
            success: function (response) {

                if (response.success) {
                    $("#ret_gestion").val(response.data.gestion);
                    $("#ret_central").val(response.data.central);
                    $("#procedimiento").val(response.data.procedimiento);

                    $("#ret_gestion,#ret_central,#procedimiento").attr("readonly", true);
                }
            }
        });
    }

});


$('#trd_form').validate({
    rules: {
        dependencia: {
            required: true
        },
        serie: {
            required: true
        },
        ret_gestion: {
            required: true,
            number: true
        },
        ret_central: {
            required: true,
            number: true
        },
        tipo_documental: {
            required: true
        },
        'soporte[]': {
            required: true
        },
        disposicion: {
            required: true
        },
        dias_respuesta: {
            number: true
        }
    },
    errorPlacement: function (error, element) {
        let node = element[0];
        if (
            node.tagName == 'SELECT' &&
            node.className.indexOf('select2') !== false
        ) {
            element.next().append(error);
        } else if (node.name == 'disposicion') {
            error.insertAfter("#divMicrofilma");
        } else if (node.name == 'soporte[]') {
            error.insertAfter("#divSoporte");
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function (form) {

        let params = $('#adicionar_script').data('params');
        let data = $('#trd_form').serialize();
        data =
            data +
            '&' +
            $.param({
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token')
            });

        $.ajax({
            type: 'POST',
            url: `${params.baseUrl}app/serie/guardar_serie.php`,
            data,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    top.notification({
                        message: 'Datos guardados!',
                        type: 'success'
                    });

                    if (response.add) {
                        let options = top.window.modalOptions;
                        options.params = {
                            iddependencia: response.data.iddependencia,
                            idserie: response.data.idserie,
                            idsubserie: response.data.idsubserie
                        };
                        top.closeTopModal();
                        top.topModal(options);
                    } else {

                    }

                } else {
                    top.notification({
                        message: response.message,
                        type: 'error'
                    });
                }

            }
        });
    }
});
