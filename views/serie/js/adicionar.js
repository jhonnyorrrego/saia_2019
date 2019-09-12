$(function () {
    let params = $('#adicionar_script').data('params');
    $('#adicionar_script').removeAttr('data-params');

    let sDependencia = $('#dependencia').select2();
    let optionsDepSerie=null;
    
    (function init() {
        loadDepOptions();
        
        sDependencia.on('select2:select', function (e) {
            let id = +e.params.data.id;
            if(id){
                $("#addSerie").show();
            }else{
                $("#addSerie").hide();
            }
            optionsDepSerie=null;
            $("#divSerie").empty();
        });

        idSerieTemp=1;
        $("#addSerie").click(function (){
            data={
                id:idSerieTemp,
                iddep:sDependencia.val()
            };
            newTemplateSerie(data);
            idSerieTemp++;  
        });
        
        $(document).on('select2:select','.selectSerie', function (e) {
            
            let idserie = +e.params.data.id;
            let idselector=$(this).data('key');

            if(idserie){
                $("#pAddSubserie-"+idselector).show();
            }else{
                $("#pAddSubserie-"+idselector).hide();
            }
            validateFields(1,idserie,idselector)
            $("#divSubSerie-"+idselector).empty();
            //loadDepSerieSubOptions(idserie,idselector);
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
                    <select class="full-width required selectSerie" id="serie-${data.id}" name="serie-${data.id}" data-key="${data.id}">
                        <option value="">Seleccione ...</option>
                        <option value="-1">NUEVA SERIE</option>
                    </select>
                </div>

                <div class="form-group form-group-default required" style="display:none">
                    <label>Código de la serie:</label>
                    <input name="codigo_serie-${data.id}" id="codigo_serie-${data.id}" type="text" class="form-control">
                </div>

                <div class="form-group form-group-default required" style="display:none">
                    <label>Nombre de la serie:</label>
                    <input name="nombre_serie-${data.id}" id="nombre_serie-${data.id}" type="text" class="form-control">
                </div>

                <!-- SUBSERIE -->
                <p id="pAddSubserie-${data.id}" style="display:none">
                    <button type="button" class="btn btn-complete btn-xs addSubserie" title="Adicionar Subserie">
                        <i class="fa fa-plus"></i>
                        <span class="d-none d-sm-inline">Subserie</span>
                    </button>

                    <button type="button" class="btn btn-complete btn-xs addSubserie" title="Adicionar Tipo">
                        <i class="fa fa-plus"></i>
                        <span class="d-none d-sm-inline">Tipo</span>
                    </button>
                </p>
                
                <div id="divSubSerie-${data.id}"></div>

                <!-- TERMINA SUBSERIE -->

            </div>
        </div>`;

        $("#divSerie").append(template);
        $('#card-serie-'+data.id).card();
        $('#serie-'+data.id).select2();
        
        if(!optionsDepSerie){
            optionsDepSerie=loadDepSerieOptions(data.iddep,data.id);
        }
        
        optionsDepSerie.forEach(element => {
            $('#serie-'+data.id).append(
                $('<option>', {
                    value: element.idserie,
                    text: element.codigo + ' - ' + element.nombre
                })
            );
        });

    }
    
    function loadDepSerieOptions(iddep) {
        options=null;

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
            async:false,
            success: function (response) {
                if (response.success) {
                    options=response.data;
                }
            }
        });
        
        return options;
    }

    function validateFields(type, idserie, idselector, newSerie = 0) {
    
        switch (type) {
            case 1:
                //validateFields(2, 0);

                if (idserie == -1) {

                    $("#codigo_serie-"+idselector).rules("add", {
                        required: true
                    });

                    $("#nombre_serie-"+idselector).rules("add", {
                        required: true
                    });

                    $("#codigo_serie-"+idselector+",#nombre_serie-"+idselector).parent().show();
                    //validateFields(2, -1, 1);

                } else {
                    if (idserie) {
                        loadFields(idserie);
                    }
                    $("#codigo_serie-"+idselector+",#nombre_serie-"+idselector).val("");
                    $("#codigo_serie-"+idselector+",#nombre_serie-"+idselector).parent().hide();
                    $("#codigo_serie-"+idselector).rules("remove");
                    $("#nombre_serie-"+idselector).rules("remove");
                }
                break;

            case 2:

                $("#ret_gestion,#ret_central,#procedimiento").val("");
                $("#ret_gestion,#ret_central,#procedimiento").removeAttr("readonly");

                if (idserie == -1) {

                    if (newSerie == 1) {
                        //defaultOptions('subserie', 1);
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

    function loadDepSerieSubOptions(idserie,selector) {
    
        //validateFields(1, idserie);

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

                            response.data.forEach(element => {
                                $('#subserie-'+selector).append(
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

    function templateSubSerie(){
        let template = `
        <div class="card card-default" id="card-subserie">

            <div class="card-header">
                <div class="card-title">Subserie # 1 </div>
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
                    <select class="full-width" id="subserie" name="subserie">
                        <option value="">Seleccione ...</option>
                    </select>
                </div>

                <div class="form-group form-group-default" style="display:none">
                    <label>Código de la subserie:</label>
                    <input name="codigo_subserie" id="codigo_subserie" type="text" class="form-control">
                </div>

                <div class="form-group form-group-default" style="display:none">
                    <label>Nombre de la subserie:</label>
                    <input name="nombre_subserie" id="nombre_subserie" type="text" class="form-control">
                </div>

                <div class="form-group form-group-default required">
                    <label>Retención gestión:</label>
                    <input name="ret_gestion" id="ret_gestion" type="text" class="form-control">
                </div>

                <div class="form-group form-group-default required">
                    <label>Retención central:</label>
                    <input name="ret_central" id="ret_central" type="text" class="form-control">
                </div>

                <div class="form-group form-group-default">
                    <label>Procedimiento:</label>
                    <textarea name="procedimiento" id="procedimiento" class="form-control"></textarea>
                </div>

                <div class="form-group form-group-default required">
                    <label class="pl-1 mb-0 mt-1">Disposición</label>

                    <div class="radio radio-success input-group my-0">
                        <input type="radio" value="E" name="disposicion" id="E">
                        <label for="E">E</label>

                        <input type="radio" value="S" name="disposicion" id="S">
                        <label for="S">S</label>

                        <input type="radio" value="CT" name="disposicion" id="CT">
                        <label for="CT">CT</label>
                    </div>

                    <div style="display:none" class="checkbox check-success input-group my-0" id="divMicrofilma">
                        <input type="checkbox" value="M/D" name="disposicion2" id="microfilma">
                        <label for="microfilma">M/D</label>
                    </div>
                </div>

                <!-- TIPO DOCUMENTAL -->
                <p>
                    <button class="btn btn-default btn-xs" title="Adicionar Subserie">
                        <i class="fa fa-plus"></i>
                        <span class="d-none d-sm-inline">Tipo</span>
                    </button>
                </p>

                <div class="card card-default" id="card-tipo">

                    <div class="card-header">
                        <div class="card-title">Tipo # 1 </div>
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
                            <input name="tipo_documental" type="text" class="form-control">
                        </div>

                        <div class="form-group form-group-default required">
                            <label>Dias para responder:</label>
                            <input name="dias_respuesta" type="text" class="form-control">
                        </div>

                        <div class="form-group form-group-default required">
                            <label class="pl-1 mb-0 mt-1">Soporte</label>
                            <div class="checkbox check-success input-group my-0" id="divSoporte">

                                <input type="checkbox" value="P" name="soporte[]" id="P">
                                <label for="P">P</label>

                                <input type="checkbox" value="EL" name="soporte[]" id="EL">
                                <label for="EL">EL</label>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- TERMINA TIPO DOCUMENTAL -->

            </div>
        </div>`;
    }
});


$('#trd_form').validate({
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


    /*
        $("#card-serie,#card-subserie,#card-tipo").card();
    
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
    
    
 
    
        })();*/
    

