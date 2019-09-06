$(function () {
    let params = $('#adicionar_script').data('params');
    $('#adicionar_script').removeAttr('data-params');

    let sDependencia = $('#dependencia').select2();
    let sSerie = $('#serie').select2();
    let sSubserie = $('#subserie').select2();

    (function init() {

        findDepOptions();

        sDependencia.on('select2:select', function (e) {
            let id = +e.params.data.id;
            findDepSerieOptions(id);
        });

        sSerie.on('select2:select', function (e) {
            let id = +e.params.data.id;
            findDepSerieSubOptions(id);
        });


    })();

    function findDepOptions() {
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
                }
            }
        });
    }

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

    function findDepSerieOptions(iddep) {

        defaultOptions('serie');
        defaultOptions('subserie');

        if (iddep) {
            if (iddep == -1) {
                //nueva serie
            } else {
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
                        }
                    }
                });
            }
        }
    }

    function findDepSerieSubOptions(idserie) {
        if (idserie) {
            if (idserie == -1) {
                //nueva subserie
            } else {
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
                        }
                    }
                });
            }
        } else {
            defaultOptions('subserie');
        }
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
        retencion_gestion: {
            required: true,
            number: true
        },
        retencion_central: {
            required: true,
            number: true
        },
        tipo_documental: {
            required: true
        },
        soporte: {
            required: true
        },
        disposicion: {
            required: true
        }
    },
    messages: {
        dependencia: {
            required: 'Campo requerido'
        },
        serie: {
            required: 'Campo requerido'
        },
        retencion_gestion: {
            required: 'Campo requerido',
            number: 'Número invalido'
        },
        retencion_central: {
            required: 'Campo requerido',
            number: 'Número invalido'
        },
        tipo_documental: {
            required: 'Campo requerido'
        },
        soporte: {
            required: 'Campo requerido'
        },
        disposicion: {
            required: 'Campo requerido',
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

                    if (response.success) {
                        top.notification({
                            message: response.message,
                            type: 'success'
                        });
                        //top.successModalEvent(response.data);
                    } else {
                        top.notification({
                            message: response.message,
                            type: 'error',
                            title: 'Error!'
                        });
                    }
                }
            }
        });
    }
});
