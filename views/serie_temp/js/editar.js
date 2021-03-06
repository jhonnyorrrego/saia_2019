$(function () {
    let params = $('#editar_script').data('params');
    $('#editar_script').removeAttr('data-params');

    $('#card-editar').card();
    $('#card-eliminar').card();
    $('#card-eliminar .card-collapse').click();

    (function init() {
        loadData();

        $('#btn_success').on('click', function () {
            $('#trd_form').trigger('submit');
        });

        $('#btn_delete').on('click', function () {
            deleteSerie();
        });

    })();

    function deleteSerie() {
        top.confirm({
            id: 'error',
            type: 'error',
            message: '¿Está seguro de eliminar el registro?',
            position: 'center',
            timeout: 0,
            overlay: true,
            overlayClose: true,
            closeOnEscape: true,
            closeOnClick: true,
            buttons: [
                [
                    '<button><b>SI</b></button>',
                    function (instance, toast) {

                        instance.hide({
                            transitionOut: 'fadeOut'
                        },
                            toast,
                            'button'
                        );

                        $.ajax({
                            type: 'POST',
                            url: `${params.baseUrl}app/trd/serie_temp/eliminar.php`,
                            data: {
                                key: localStorage.getItem('key'),
                                token: localStorage.getItem('token'),
                                idserie: params.idserie
                            },
                            dataType: 'json',
                            success: function (response) {

                                if (response.success) {

                                    top.notification({
                                        message: 'Registro Eliminado!',
                                        type: 'success'
                                    });
                                    top.successModalEvent();
                                } else {
                                    top.notification({
                                        message: response.message,
                                        type: 'error'
                                    });
                                }
                            }
                        });
                    },
                    true
                ],
                [
                    '<button>NO</button>',
                    function (instance, toast) {
                        instance.hide({
                            transitionOut: 'fadeOut'
                        },
                            toast,
                            'button'
                        );
                    },
                    true
                ]
            ]
        });
    }

    function loadData() {
        $.ajax({
            type: 'POST',
            url: `${params.baseUrl}app/trd/serie/obtener_datos.php`,
            data: {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                idserie: params.idserie,
                iddependencia: params.iddependencia,
                onlyType: params.onlytype,
                className: 'SerieTemp'
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    viewTemplate(response.data, response.data.tipo);
                } else {
                    top.notification({
                        message: response.message,
                        type: 'error'
                    });
                }
            }
        });
    }

    function viewTemplate(data, tipo) {
        switch (tipo) {
            case 1:
                viewSerieForm(data);
                break;
            case 2:
                viewSubserieForm(data);
                break;
            case 3:
                viewTipoForm(data);
                break;
            case 4:
                viewSerieRetencionForm(data);
                break;
            default:
                console.error('Tipo indefinido!');
                break;
        }
    }

    function viewSerieForm(data) {
        let template = `
        <div class="form-group form-group-default required">
            <label>Código:</label>
            <input name="codigo" id="codigo" type="text" value="${data.codigo}" class="form-control required">
        </div>

        <div class="form-group form-group-default required">
            <label>Nombre:</label>
            <input name="nombre" id="nombre" type="text" value="${data.nombre}" class="form-control required">
        </div>`;
        $("#viewContentForm").append(template);
    }

    function viewSubserieForm(data) {
        let template = `
        <div class="form-group form-group-default required">
            <label>Dependencia de la subserie:</label>
            <select class="full-width required" name="dependencia" id="dependencia">
                <option value="">Seleccione ...</option>
            </select>
            <input type="hidden" value="${data.idserie_dependencia}" name="idserie_dependencia" id="idserie_dependencia" >
        </div>

        <div class="form-group form-group-default required">
            <label>Código:</label>
            <input name="codigo" id="codigo" type="text" value="${data.codigo}" class="form-control required">
        </div>

        <div class="form-group form-group-default required">
            <label>Nombre:</label>
            <input name="nombre" id="nombre" type="text" value="${data.nombre}" class="form-control required">
        </div>

        <div class="form-group form-group-default required">
            <label>Retención gestión:</label>
            <input name="retencion_gestion" id="retencion_gestion" value="${data.gestion}" type="text" class="form-control required">
        </div>

        <div class="form-group form-group-default required">
            <label>Retención central:</label>
            <input name="retencion_central" id="retencion_central" type="text" value="${data.central}" class="form-control required">
        </div>

        <div class="form-group form-group-default">
            <label>Procedimiento:</label>
            <textarea name="procedimiento" id="procedimiento" class="form-control">${data.procedimiento}</textarea>
        </div>

        <div class="form-group form-group-default required">
            <label class="pl-1 mb-0 mt-1">Disposición</label>

            <div class="radio radio-success input-group my-0">
                <input type="radio" value="E" name="disposicion" ${data.disp_e} id="E" class="required">
                <label for="E">E</label>

                <input type="radio" value="S" name="disposicion" ${data.disp_s} id="S">
                <label for="S">S</label>

                <input type="radio" value="CT" name="disposicion" ${data.disp_ct} id="CT">
                <label for="CT">CT</label>
            </div>

            <div class="checkbox check-success input-group my-0" id="divMicrofilma">
                <input type="checkbox" value="1" name="dis_microfilma" ${data.dis_micro} id="dis_microfilma">
                <label for="dis_microfilma">M/D</label>
            </div>
        </div>`;

        $("#viewContentForm").append(template);
        $("#retencion_gestion").rules("add", {
            required: true,
            number: true
        });

        $("#retencion_central").rules("add", {
            required: true,
            number: true
        });

        $("[name='disposicion']").change(function () {
            if ($(this).val() == 'S' || $(this).val() == 'CT') {
                $("#divMicrofilma").show()
            } else {
                $("#dis_microfilma").prop('checked', false);
                $("#divMicrofilma").hide()
            }
        });
        $("[name='disposicion']:checked").trigger('change');
        $('#dependencia').select2();
        loadOptionsDependencia(data.iddependencia);
    }

    function viewTipoForm(data) {
        let template = `<div class="form-group form-group-default required">
            <label>Tipo documental:</label>
            <input name="nombre" id="nombre" type="text" value="${data.nombre}" class="form-control required">
        </div>

        <div class="form-group form-group-default required">
            <label>Dias para responder:</label>
            <input name="dias_respuesta" id="dias_respuesta" type="text" value="${data.dias_respuesta}" class="form-control">
        </div>

        <div class="form-group form-group-default required">
            <label class="pl-1 mb-0 mt-1">Soporte</label>
            <div class="checkbox check-success input-group my-0">

                <input type="checkbox" value="P" name="soporte[]" id="P" ${data.sop_p} class="required">
                <label for="P">P</label>

                <input type="checkbox" value="EL" name="soporte[]" ${data.sop_el} id="EL">
                <label for="EL">EL</label>
            </div>
        </div>`;

        $("#viewContentForm").append(template);
        $("#dias_respuesta").rules("add", {
            required: true,
            number: true
        });
    }

    function viewSerieRetencionForm(data) {

        let template = `
        <div class="form-group form-group-default required">
            <label>Dependencia de la serie:</label>
            <select class="full-width required" name="dependencia" id="dependencia">
                <option value="">Seleccione ...</option>
            </select>
            <input type="hidden" value="${data.idserie_dependencia}" name="idserie_dependencia" id="idserie_dependencia" >
        </div>

    <div class="form-group form-group-default required">
            <label>Código:</label>
            <input name="codigo" id="codigo" type="text" value="${data.codigo}" class="form-control required">
        </div>

        <div class="form-group form-group-default required">
            <label>Nombre:</label>
            <input name="nombre" id="nombre" type="text" value="${data.nombre}" class="form-control required">
        </div>

        <div class="form-group form-group-default required">
            <label>Retención gestión:</label>
            <input name="retencion_gestion" id="retencion_gestion" value="${data.gestion}" type="text" class="form-control required">
        </div>

        <div class="form-group form-group-default required">
            <label>Retención central:</label>
            <input name="retencion_central" id="retencion_central" type="text" value="${data.central}" class="form-control required">
        </div>

        <div class="form-group form-group-default">
            <label>Procedimiento:</label>
            <textarea name="procedimiento" id="procedimiento" class="form-control">${data.procedimiento}</textarea>
        </div>

        <div class="form-group form-group-default required">
            <label class="pl-1 mb-0 mt-1">Disposición</label>

            <div class="radio radio-success input-group my-0">
                <input type="radio" value="E" name="disposicion" ${data.disp_e} id="E" class="required">
                <label for="E">E</label>

                <input type="radio" value="S" name="disposicion" ${data.disp_s} id="S">
                <label for="S">S</label>

                <input type="radio" value="CT" name="disposicion" ${data.disp_ct} id="CT">
                <label for="CT">CT</label>
            </div>

            <div class="checkbox check-success input-group my-0" id="divMicrofilma">
                <input type="checkbox" value="1" name="dis_microfilma" ${data.dis_micro} id="dis_microfilma">
                <label for="dis_microfilma">M/D</label>
            </div>
        </div>`;

        $("#viewContentForm").append(template);
        $("#retencion_gestion").rules("add", {
            required: true,
            number: true
        });

        $("#retencion_central").rules("add", {
            required: true,
            number: true
        });

        $("[name='disposicion']").change(function () {
            if ($(this).val() == 'S' || $(this).val() == 'CT') {
                $("#divMicrofilma").show()
            } else {
                $("#dis_microfilma").prop('checked', false);
                $("#divMicrofilma").hide()
            }
        });
        $("[name='disposicion']:checked").trigger('change');

        $('#dependencia').select2();
        loadOptionsDependencia(data.iddependencia);
    }

    function loadOptionsDependencia(idselected) {
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
                                text: element.codigo + ' - ' + element.nombre,
                                selected: (element.iddependencia == idselected) ? true : false
                            })
                        );
                    });
                }
            }
        });
    }

});


$('#trd_form').validate({
    ignore: [],
    errorPlacement: function (error, element) {
        let node = element[0];
        if (
            node.tagName == 'SELECT' &&
            node.className.indexOf('select2') !== false
        ) {
            element.next().append(error);
        } else if (node.type == 'radio') {
            let id = node.dataset.key;
            if (node.dataset.type == "subserie") {
                error.insertAfter("#divMicrofilmaSubserie-" + id);
            } else {
                error.insertAfter("#divMicrofilmaSerie-" + id);
            }

        } else if (node.type == 'checkbox') {
            let id = node.dataset.key
            error.insertAfter("#divSoporte-" + id);
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function (form) {

        let params = $('#editar_script').data('params');
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
            url: `${params.baseUrl}app/trd/serie_temp/editar.php`,
            data,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    top.notification({
                        message: 'Datos actualizados!',
                        type: 'success'
                    });
                    top.successModalEvent();
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