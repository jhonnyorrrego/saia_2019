$(function () {
    let params = $('#adicionar_script').data('params');
    $('#adicionar_script').removeAttr('data-params');

    let sDependencia = $('#dependencia').select2();
    let optionsDepSerie = null;
    let idSerieTemp = 1;
    let idSubserieTemp = 1;
    let idTipoTemp = 1;

    (function init() {
        loadDepOptions();

        sDependencia.on('select2:select', function (e) {
            let id = +e.params.data.id;
            if (id) {
                $("#pAddSerie").show();
            } else {
                $("#pAddSerie").hide();
            }
            optionsDepSerie = null;
            $("#hiddenSerie").addClass("required");
            $("#divSerie").empty();
            idSerieTemp = 1;
            idSubserieTemp = 1;
            idTipoTemp = 1;
        });


        $("#addSerie").click(function () {
            data = {
                id: idSerieTemp,
                iddep: sDependencia.val()
            };
            newTemplateSerie(data);
            $("#hiddenSerie").removeClass("required");
            idSerieTemp++;
        });

        $(document).off('select2:select', '.selectSerie').
            on('select2:select', '.selectSerie', function (e) {

                let idserie = +e.params.data.id;
                let idselector = $(this).data('key');

                if (idserie) {
                    $("#pAddSubserie-" + idselector).show();
                    $("#addTipoSerie-" + idselector).show();
                    $("#addSubserie-" + idselector).show();
                } else {
                    $("#pAddSubserie-" + idselector).hide();
                }

                validateFields(1, idserie, idselector);

                $("#hiddenSubTipo-" + idselector).addClass("required");
                $("#divSubserie-" + idselector).empty();
                $("#divTipoSerie-" + idselector).empty();
            });


        $(document).off('click', '.addSubserie').
            on('click', '.addSubserie', function () {

                let idselector = $(this).data('key');

                $("#addTipoSerie-" + idselector).hide();
                data = {
                    id: idSubserieTemp,
                    idserie: $("#serie-" + idselector).val(),
                    idselectorPadre: idselector,
                    namePadre: $(this).data('name')
                };
                $("#hiddenSubTipo-" + idselector).removeClass("required");
                newTemplateSubserie(data);
                idSubserieTemp++;
            });

        $(document).off('change', '[name$="[disposicion]"]').
            on('change', '[name$="[disposicion]"]', function () {
                let id = $(this).data('key');

                if ($(this).data('type') == "subserie") {
                    if ($(this).val() == 'S' || $(this).val() == 'CT') {
                        $("#divMicrofilmaSubserie-" + id).show()
                    } else {
                        $("#microfilmaSubserie-" + id).prop('checked', false);
                        $("#divMicrofilmaSubserie-" + id).hide();
                    }
                } else {
                    if ($(this).val() == 'S' || $(this).val() == 'CT') {
                        $("#divMicrofilmaSerie-" + id).show()
                    } else {
                        $("#microfilmaSerie-" + id).prop('checked', false);
                        $("#divMicrofilmaSerie-" + id).hide();
                    }
                }

            });

        $(document).off('select2:select', '.selectSubserie').
            on('select2:select', '.selectSubserie', function (e) {

                let idserie = +e.params.data.id;
                let idselector = $(this).data('key');

                validateFields(2, idserie, $(this).data('key'));
                $("#divTipoSubserie-" + idselector).empty();
            });

        $(document).off('click', '.addTipo').
            on('click', '.addTipo', function () {
                let idselector = $(this).data('key');
                data = {
                    id: idTipoTemp,
                    idselectorPadre: idselector,
                    namePadre: $(this).data('name'),
                    div: $(this).data('div'),
                };
                if ($(this).data("type") == "serie") {
                    $("#addSubserie-" + idselector).hide();
                    $("#hiddenSubTipo-" + idselector).removeClass("required");

                    let idserie = $("#serie-" + idselector).val();
                    validateFields(3, idserie, idselector);

                } else {
                    $("#hiddenTipo-" + idselector).removeClass("required");
                }

                newTemplateTipo(data);
                idTipoTemp++;
            });

        $('#btn_success').on('click', function () {
            $('#trd_form').trigger('submit');
        });

    })();

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
                }
            }
        });
    }

    function newTemplateSerie(data) {
        let name = `serie[${data.id}]`;
        let template = `
        <div class="card card-default" id="card-serie-${data.id}">
            <div class="card-header">
                <div class="card-title">Serie # ${data.id} </div>
                <div class="card-controls">
                    <ul>
                        <li>
                            <a href="#" class="card-collapse" data-toggle="collapse">
                                <i class="card-icon card-icon-collapse"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="card-close" data-toggle="close">
                                <i class="card-icon card-icon-close"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card-body">

                <div class="form-group form-group-default form-group-default-select2 required">
                    <label>Serie</label>
                    <select class="full-width required selectSerie" name="${name}[idserie]" id="serie-${data.id}"  data-key="${data.id}">
                        <option value="">Seleccione ...</option>
                        <option value="-1">NUEVA SERIE</option>
                    </select>
                </div>

                <div class="form-group form-group-default required" style="display:none">
                    <label>Código de la serie:</label>
                    <input name="${name}[codigo]" id="codigo_serie-${data.id}" type="text" class="form-control">
                </div>

                <div class="form-group form-group-default required" style="display:none">
                    <label>Nombre de la serie:</label>
                    <input name="${name}[nombre]" id="nombre_serie-${data.id}" type="text" class="form-control">
                </div>

                <div class="form-group form-group-default required" style="display:none">
                    <label>Retención gestión:</label>
                    <input name="${name}[gestion]" id="ret_gestionSerie-${data.id}" type="text" class="form-control">
                </div>

                <div class="form-group form-group-default required" style="display:none">
                    <label>Retención central:</label>
                    <input name="${name}[central]" id="ret_centralSerie-${data.id}" type="text" class="form-control">
                </div>

                <div class="form-group form-group-default" style="display:none">
                    <label>Procedimiento:</label>
                    <textarea name="${name}[procedimiento]" id="procedimientoSerie-${data.id}" class="form-control"></textarea>
                </div>

                <div class="form-group form-group-default required" id="divDisposicionSerie-${data.id}" style="display:none">
                    <label class="pl-1 mb-0 mt-1">Disposición</label>

                    <div class="radio radio-success input-group my-0">
                        <input type="radio" value="E" name="${name}[disposicion]" data-key="${data.id}" data-type="serie" id="ESerie-${data.id}">
                        <label for="ESerie-${data.id}">E</label>

                        <input type="radio" value="S" name="${name}[disposicion]" data-key="${data.id}" data-type="serie" id="SSerie-${data.id}">
                        <label for="SSerie-${data.id}">S</label>

                        <input type="radio" value="CT" name="${name}[disposicion]" data-key="${data.id}" data-type="serie" id="CTSerie-${data.id}">
                        <label for="CTSerie-${data.id}">CT</label>
                    </div>

                    <div style="display:none" class="checkbox check-success input-group my-0" id="divMicrofilmaSerie-${data.id}">
                        <input type="checkbox" value="1" name="${name}[microfilma]" id="microfilmaSerie-${data.id}">
                        <label for="microfilmaSerie-${data.id}">M/D</label>
                    </div>
                </div>

                <!-- SUBSERIE -->
                <p id="pAddSubserie-${data.id}" style="display:none">
                    <button type="button" class="btn btn-complete btn-xs addSubserie" id="addSubserie-${data.id}" data-name="${name}" data-key="${data.id}" title="Adicionar Subserie">
                        <i class="fa fa-plus"></i>
                        <span class="d-none d-sm-inline">Subserie</span>
                    </button>

                    <button type="button" class="btn btn-complete btn-xs addTipo" 
                        id="addTipoSerie-${data.id}" 
                        data-name="${name}" 
                        data-key="${data.id}" 
                        data-type="serie"
                        data-div="divTipoSerie-${data.id}"
                        title="Adicionar Tipo"
                    >
                        <i class="fa fa-plus"></i>
                        <span class="d-none d-sm-inline">Tipo</span>
                    </button>
                    <input type="hidden" id="hiddenSubTipo-${data.id}" class="required">
                </p>
                
                <div id="divSubserie-${data.id}"></div>
                <div id="divTipoSerie-${data.id}"></div>

                <!-- TERMINA SUBSERIE -->

            </div>
        </div>`;

        $("#divSerie").append(template);
        $('#card-serie-' + data.id).card();
        $('#serie-' + data.id).select2();

        if (!optionsDepSerie) {
            optionsDepSerie = loadDepSerieOptions(data.iddep, data.id);
        }

        optionsDepSerie.forEach(element => {
            $('#serie-' + data.id).append(
                $('<option>', {
                    value: element.idserie,
                    text: element.codigo + ' - ' + element.nombre
                })
            );
        });

    }

    function loadDepSerieOptions(iddep) {
        options = null;

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
            async: false,
            success: function (response) {
                if (response.success) {
                    options = response.data;
                }
            }
        });

        return options;
    }

    function validateFields(type, idserie, idselector) {

        switch (type) {
            case 1:
                if (idserie == -1) {

                    $("#codigo_serie-" + idselector).rules("add", {
                        required: true
                    });

                    $("#nombre_serie-" + idselector).rules("add", {
                        required: true
                    });

                    $("#codigo_serie-" + idselector + ",#nombre_serie-" + idselector).parent().show();

                } else {

                    $.ajax({
                        type: 'POST',
                        url: `${params.baseUrl}app/serie/valida_subserie.php`,
                        data: {
                            key: localStorage.getItem('key'),
                            token: localStorage.getItem('token'),
                            idserie: idserie
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (response.onlyType) {
                                $("#addSubserie-" + idselector).hide();
                            } else {
                                $("#addTipoSerie-" + idselector).hide();
                            }
                        }
                    });

                    $("#codigo_serie-" + idselector + ",#nombre_serie-" + idselector).val("");
                    $("#codigo_serie-" + idselector + ",#nombre_serie-" + idselector).parent().hide();
                    $("#codigo_serie-" + idselector).rules("remove");
                    $("#nombre_serie-" + idselector).rules("remove");

                    validateFields(3, idserie, idselector)
                }
                break;

            case 2:

                fieldHiden = {
                    codigo: `codigo_subserie-${idselector}`,
                    nombre: `nombre_subserie-${idselector}`,
                    ret_gestion: `ret_gestion-${idselector}`,
                    ret_central: `ret_central-${idselector}`,
                    procedimiento: `procedimiento-${idselector}`
                };

                if (idserie == -1) {

                    $("#codigo_subserie-" + idselector).rules("add", {
                        required: true
                    });

                    $("#nombre_subserie-" + idselector).rules("add", {
                        required: true
                    });

                    $("#ret_gestion-" + idselector).rules("add", {
                        required: true,
                        number: true
                    });

                    $("#ret_central-" + idselector).rules("add", {
                        required: true,
                        number: true
                    });

                    $("#ESubserie-" + idselector).rules("add", {
                        required: true
                    });

                    for (key in fieldHiden) {
                        $("#" + fieldHiden[key]).parent().show();
                    }
                    $("#divDisposicionSubserie-" + idselector).show();

                } else {

                    for (key in fieldHiden) {
                        $("#" + fieldHiden[key]).val("");
                        $("#" + fieldHiden[key]).rules("remove");
                        $("#" + fieldHiden[key]).parent().hide();
                    }
                    $("#ESubserie-" + idselector).rules("remove");
                    $("#divDisposicionSubserie-" + idselector).hide();

                }
                break;

            case 3:

                fieldHiden = {
                    ret_gestion: `ret_gestionSerie-${idselector}`,
                    ret_central: `ret_centralSerie-${idselector}`,
                    procedimiento: `procedimientoSerie-${idselector}`
                };

                if (idserie == -1) {

                    $("#ret_gestionSerie-" + idselector).rules("add", {
                        required: true,
                        number: true
                    });

                    $("#ret_centralSerie-" + idselector).rules("add", {
                        required: true,
                        number: true
                    });

                    $("#ESerie-" + idselector).rules("add", {
                        required: true
                    });


                    for (key in fieldHiden) {
                        $("#" + fieldHiden[key]).parent().show();
                    }
                    $("#divDisposicionSerie-" + idselector).show();

                } else {

                    for (key in fieldHiden) {
                        $("#" + fieldHiden[key]).val("");
                        $("#" + fieldHiden[key]).rules("remove");
                        $("#" + fieldHiden[key]).parent().hide();
                    }
                    $("#ESerie-" + idselector).rules("remove");
                    $("#divDisposicionSerie-" + idselector).hide();

                }
                break;
            default:
                console.error("undefined type");
                break;
        }

    }

    function newTemplateSubserie(data) {
        let name = `${data.namePadre}[subserie][${data.id}]`;
        let template = `
        <div class="card card-default" id="card-subserie-${data.id}">

            <div class="card-header">
                <div class="card-title">Subserie</div>
                <div class="card-controls">
                    <ul>
                        <li>
                            <a href="#" class="card-collapse" data-toggle="collapse"><i class="card-icon card-icon-collapse"></i></a>
                        </li>
                        <li>
                            <a href="#" class="card-close" data-toggle="close"><i class="card-icon card-icon-close"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card-body">

                <div class="form-group form-group-default form-group-default-select2">
                    <label>Subserie</label>
                    <select class="full-width required selectSubserie" name="${name}[idsubserie]" id="subserie-${data.id}" data-key="${data.id}">
                        <option value="">Seleccione ...</option>
                        <option value="-1">NUEVA SUBSERIE</option>
                    </select>
                </div>

                <div class="form-group form-group-default required" style="display:none">
                    <label>Código de la subserie:</label>
                    <input name="${name}[codigo]" id="codigo_subserie-${data.id}" type="text" class="form-control">
                </div>

                <div class="form-group form-group-default required" style="display:none">
                    <label>Nombre de la subserie:</label>
                    <input name="${name}[nombre]" id="nombre_subserie-${data.id}" type="text" class="form-control">
                </div>

                <div class="form-group form-group-default required" style="display:none">
                    <label>Retención gestión:</label>
                    <input name="${name}[gestion]" id="ret_gestion-${data.id}" type="text" class="form-control">
                </div>

                <div class="form-group form-group-default required" style="display:none">
                    <label>Retención central:</label>
                    <input name="${name}[central]" id="ret_central-${data.id}" type="text" class="form-control">
                </div>

                <div class="form-group form-group-default" style="display:none">
                    <label>Procedimiento:</label>
                    <textarea name="${name}[procedimiento]" id="procedimiento-${data.id}" class="form-control"></textarea>
                </div>

                <div class="form-group form-group-default required" id="divDisposicionSubserie-${data.id}" style="display:none">
                    <label class="pl-1 mb-0 mt-1">Disposición</label>

                    <div class="radio radio-success input-group my-0">
                        <input type="radio" value="E" name="${name}[disposicion]" data-key="${data.id}" data-type="subserie" id="ESubserie-${data.id}">
                        <label for="ESubserie-${data.id}">E</label>

                        <input type="radio" value="S" name="${name}[disposicion]" data-key="${data.id}" data-type="subserie" id="SSubserie-${data.id}">
                        <label for="SSubserie-${data.id}">S</label>

                        <input type="radio" value="CT" name="${name}[disposicion]" data-key="${data.id}" data-type="subserie" id="CTSubserie-${data.id}">
                        <label for="CTSubserie-${data.id}">CT</label>
                    </div>

                    <div style="display:none" class="checkbox check-success input-group my-0" id="divMicrofilmaSubserie-${data.id}">
                        <input type="checkbox" value="1" name="${name}[microfilma]" id="microfilmaSubserie-${data.id}">
                        <label for="microfilmaSubserie-${data.id}">M/D</label>
                    </div>
                </div>

                <!-- TIPO DOCUMENTAL -->
                
                <p>
                    <button type="button" class="btn btn-complete btn-xs addTipo" 
                        id="addTipoSubserie-${data.id}" 
                        data-name="${name}" 
                        data-key="${data.id}" 
                        data-div="divTipoSubserie-${data.id}"
                        data-type="subserie"
                        title="Adicionar Tipo"
                    >
                        <i class="fa fa-plus"></i>
                        <span class="d-none d-sm-inline">Tipo</span>
                    </button>
                    <input type="hidden" id="hiddenTipo-${data.id}" class="required">
                </p>
                <!-- TERMINA TIPO DOCUMENTAL -->
                <div id="divTipoSubserie-${data.id}"></div>
            </div>
        </div>`;

        $("#divSubserie-" + data.idselectorPadre).append(template);
        $('#card-subserie-' + data.id).card();
        $('#subserie-' + data.id).select2();

        loadDepSerieSubOptions(data.idserie, data.id);

    }

    function loadDepSerieSubOptions(idserie, selector) {

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

                        response.data.forEach(element => {
                            $('#subserie-' + selector).append(
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

    function newTemplateTipo() {
        let name = `${data.namePadre}[tipo][${data.id}]`;
        let template = `
        <div class="card card-default" id="card-tipo-${data.id}">

            <div class="card-header">
                <div class="card-title">Tipo</div>
                <div class="card-controls">
                    <ul>
                        <li>
                            <a href="#" class="card-collapse" data-toggle="collapse"><i class="card-icon card-icon-collapse"></i></a>
                        </li>
                        <li>
                            <a href="#" class="card-close" data-toggle="close"><i class="card-icon card-icon-close"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="form-group form-group-default required">
                    <label>Tipo documental:</label>
                    <input name="${name}[nombre]" type="text" class="form-control required">
                </div>

                <div class="form-group form-group-default required">
                    <label>Dias para responder:</label>
                    <input name="${name}[dias_respuesta]" id="dias_resp-${data.id}" type="text" class="form-control">
                </div>

                <div class="form-group form-group-default required">
                    <label class="pl-1 mb-0 mt-1">Soporte</label>
                    <div class="checkbox check-success input-group my-0" id="divSoporte-${data.id}">

                        <input type="checkbox" value="P" name="${name}[soporte][]" data-key="${data.id}" id="P-${data.id}" class="required">
                        <label for="P-${data.id}">P</label>

                        <input type="checkbox" value="EL" name="${name}[soporte][]" data-key="${data.id}" id="EL-${data.id}">
                        <label for="EL-${data.id}">EL</label>
                    </div>
                </div>
            </div>

        </div>`;

        $("#" + data.div).append(template);
        $('#card-tipo-' + data.id).card();
        $("#dias_resp-" + data.id).rules("add", {
            required: true,
            number: true
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
            url: `${params.baseUrl}app/serie/guardar.php`,
            data,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    top.notification({
                        message: 'Datos guardados!',
                        type: 'success'
                    });

                } else {
                    top.notification({
                        message: response.message,
                        type: 'error'
                    });
                }
                top.closeTopModal();
            }
        });
    }
});