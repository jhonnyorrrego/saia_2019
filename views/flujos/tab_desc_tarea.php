<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';

require_once ($ruta_db_superior . "app/arbol/crear_arbol_ft.php");

$idflujo = $_REQUEST['idflujo'];
$actividad = null;
$idactividad = null;
if (!empty($_REQUEST["idactividad"])) {
    $actividad = new Elemento($_REQUEST["idactividad"]);
    $idactividad = $actividad->getPk();
}


$opciones_arbol = ["keyboard" => true, "selectMode" => 2, "onNodeClick" => "seleccionarFormato"];
$extensiones = array("filter" => array());

if(!empty($_REQUEST["idactividad"])) {

    $lista_seleccionados = obtenerListaFormatos($idactividad);
    $origenFormatos = array("url" => "app/arbol/wf_arbol_formatos.php", "ruta_db_superior" => $ruta_db_superior,
        "params" => array(
            "seleccionable" => "checkbox",
            "obligatorio" => 1,
            "idflujo" => $idflujo
        ));

    if(!empty($lista_seleccionados)) {
        $origenFormatos["params"]["seleccionados"] = implode(",", $lista_seleccionados);
    }

    $arbolFormatos = new ArbolFt("campos_formato_actividad", $origenFormatos, $opciones_arbol, $extensiones);

}

?>

<div class="container">
    <form id="frmActividad">
        <div class="form-group form-group-default">
            <label for="nombre_actividad">Nombre del paso *</label>
            <input type="text" class="form-control form-control-sm" id="nombre_actividad" name="nombre" placeholder="Escriba el nombre del paso" value="<?= $actividad->nombre ?>">
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tipo_responsable" id="radioCargo1" value="cargo">
            <label class="form-check-label" for="radioCargo1">Rol o Cargo</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tipo_responsable" id="radioCargo2" value="funcionario">
            <label class="form-check-label" for="radioCargo2">Funcionario</label>
        </div>
        <div class="form-group">
            <label class="my-0" for="funcionario" id="lbl_rol_func">Qui&eacute;n es el responsable</label>
            <select class="form-control" style="width:400px;" id="funcionario" data-placeholder="Seleccione el cargo"></select>
        </div>

        <div class="row">
            <div class=col col-md-12">
                <div id="toolbar_tabla_responsable">
                    <a href="#" id="boton_eliminar_responsable_actividad" class="btn btn-secondary" title="Eliminar"><i class="f-12 fa fa-trash"></i></a>
                </div>
                <table class="table table-striped table-bordered table-hover" cellspacing="0" id="tabla_responsable"
                       data-toggle="table"
                       data-url="listado_responsables_actividad.php?idactividad=<?= $idactividad ?>"
                       data-click-to-select="true"
                       data-show-toggle="true"
                       data-show-columns="true"
                       data-toolbar="#toolbar_tabla_responsable"
                       data-pagination="true">
                    <thead>
                        <tr>
                            <th data-field="state" data-checkbox="true"></th>
                            <th data-field="idresponsable_actividad" data-visible="false">IdResp</th>
                            <th data-field="fk_responsable" data-visible="false">FkTipo</th>
                            <th data-field="tipo_responsable" data-visible="false">IdTipo</th>
                            <th data-field="texto_tipo">Tipo</th>
                            <th data-field="nombre" >Nombre</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <div class="form-group form-group-default">
            <label for="info_actividad">Instrucciones adicionales</label>
            <textarea class="form-control" id="info_actividad" name="info" placeholder="Puede describir con mas detalle la tarea"><?= $actividad->info ?></textarea>
        </div>

        <div class="row">
            <div class="row mt-3">
                <div class="col col-md-12">
                    <div style="height:150px; overflow: auto;">
                    <label>Elija los formatos que intervienen en este proceso</label>
                    <?php
                    	echo $arbolFormatos->generar_html();
                    ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row py-1 mt-1">
            <div class="col col-md-12">
                <div class="float-right">
                    <button type="button" id="cancelarDescTarea" class="btn btn-danger">Cancelar</button>
                    <button type="button" id="guardarDescTarea" class="btn btn-primary">Guardar cambios</button>
    	        </div>
	        </div>
        </div>

    </form>
</div>

<script>
    var $tablaRespAct = $("#tabla_responsable");
    var idactividad = "<?= $idactividad ?>";
    $tablaRespAct.bootstrapTable();

    $("#guardarDescTarea").click(function () {
        var datos = $tablaRespAct.bootstrapTable('getData');

        let nombre = $("#frmActividad #nombre_actividad").val();
        let info = $("#frmActividad #info_actividad").val();

        if (nombre) {
            var data = {idelemento: idactividad, nombre: nombre, info: info};
            var id = guardarInfoActividad(data);
            if(id) {
                parent.postMessage({accion: "actualizarDiagrama", bpmn_id: id.bpmn_id, nombreTarea: nombre}, "*");
            }
        }
    });

    $("#boton_eliminar_responsable_actividad").click(function () {
        var ids = $.map($tablaRespAct.bootstrapTable('getSelections'), function (row) {
          return row.idresponsable_actividad
        });
        var estado = eliminarResponsables(idactividad, ids.join(","));
        if(estado) {
            $tablaRespAct.bootstrapTable('remove', {
                field: 'idresponsable_actividad',
                values: ids
            });
        }
    });

    $('#funcionario').select2({
        language: "es",
        multiple: false,
        ajax: {
            url: function () {
                let tipo = $('input[name=tipo_responsable]:checked', '#frmActividad').val();
                if (tipo === 'funcionario') {
                    return 'buscar_funcionario.php';
                } else {
                    return 'buscar_cargo.php';
                }
            },
            dataType: 'json',
            data: parametrosBusqueda,
            processResults: procesarResultados
        },
        escapeMarkup: function (markup) {
            return markup;
        }, // let our custom formatter work
        minimumInputLength: 2,
        templateResult: formatearRespuesta,
        templateSelection: formatRepoSelection

    });

    $('input[type=radio][name=tipo_responsable]').change(function () {
        //select2-selection__placeholder
        var ph = "";
        if (this.value == 'cargo') {
            ph = "Seleccione el cargo";
        } else if (this.value == 'funcionario') {
            ph = "Seleccione el funcionario";
        }
        $("#funcionario").attr("placeholder", ph);
        $('.select2-selection__placeholder').html(ph);
    });

    $("#funcionario").on("select2:opening", function () {
        if ($('input:checked[type=radio][name=tipo_responsable]').length == 0) {
        	jsPanel.hint.create({
                autoclose:      3000,
        	    position:    'center-top 0 15 down',
        	    headerControls: 'closeonly',
        	    iconfont:    'fa',
        	    contentSize: '330 auto',
        	    content:     '<p>Debe seleccionar un tipo de responsable</p>',
        	    theme:       'warning',
        	    headerTitle: '<i class="fa fa-exclamation-triangle"></i> Atenci&oacute;n'
        	});
            return false;
        }
        $(this).data("open", true);
    });

    $('#funcionario').on('select2:select', function (e) {
        //console.log("par entrada", e.params.data);
        var datos = $tablaRespAct.bootstrapTable('getData');
        //console.log("Tabla", datos);
        var existe = false;
        for (var key in datos) {
            var obj = datos[key];
            if (obj.fk_responsable == e.params.data.fk_responsable) {
                existe = true;
                break;
            }
        }
        if (!existe) {
            var datos = e.params.data;
            var id = guardarResponsable(idactividad, e.params.data);
            if(id) {
                datos["idresponsable_actividad"] = id;
                $tablaRespAct.bootstrapTable('append', datos);
            }
        }
        $(this).val(null).trigger('change');
    });

//$('#tabla_responsable tbody tr').append('<td><a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a><a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a></td>');
    function procesarResultados(data) {
        var datos = $.map(data, function (obj) {
            if ("idfuncionario" in obj || "funcionario_codigo" in obj) {
                obj.id = obj.idfuncionario || obj.funcionario_codigo; // replace pk with your identifier
                obj.text = obj.nombres + " " + obj.apellidos;
                obj["texto_tipo"] = "Funcionario";
                obj["tipo_responsable"] = 2;
            } else if ("idcargo" in obj) {
                obj.id = obj.idcargo; // replace pk with your identifier
                obj.text = obj.cargo;
                obj["texto_tipo"] = "Rol - Cargo";
                obj["tipo_responsable"] = 1;
            }
            obj["fk_responsable"] = obj.id;
            obj["nombre"] = obj.text;
            return obj;
        });
        return {
            results: datos
        };
    }

    function parametrosBusqueda(params) {
        var query = {
            termino: params.term,
            page: params.page || 1
        }

        // Query parameters will be ?search=[term]&page=[page]
        return query;
    }

    function formatearRespuesta(repo) {
        //console.log(repo);
        if (repo.loading) {
            return repo.text;
        }
        var nombre = "";
        if ("idfuncionario" in repo || "funcionario_codigo" in repo) {
            nombre = repo.nombres + " " + repo.apellidos;
        } else if ("idcargo" in repo) {
            nombre = repo.cargo
        }
        var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + nombre + "</div>";
        return markup;
    }

    function formatRepoSelection(repo) {
        //console.log(repo);
        return repo.email || repo.text;
    }

    function guardarResponsable(idactividad, data) {
        if (data) {
            data['key'] = localStorage.getItem("key");
            data["fk_actividad"] = idactividad;
            data["tipo_responsable"] = data.tipo_responsable;
            data["fk_responsable"] = data.fk_responsable;

            //console.log("Guardar", idactividad, data);
            //return false;
            var pk = false;
            $.ajax({
                dataType: "json",
                url: "<?= $ruta_db_superior ?>app/flujo/guardarResponsableActividad.php",
                type: "POST",
                data: data,
                async: false,
                success: function (response) {
                    if (response["success"] == 1) {
                        top.notification({type: "success", message: response.message});
                        pk = response.data.pk;
                        parent.parent.postMessage({accion: "recargarTabla", id: pk}, "*");
                    } else {
                        top.notification({type: "error", message: response.message});
                    }
                }
            });
            return pk;
        }
        return false;
    }

    function eliminarResponsables(idactividad, ids) {
        if (ids) {
            var data = {
                key: localStorage.getItem("key"),
                fk_actividad: idactividad,
                ids: ids
            };

            //console.log(idactividad, data);
            //return false;
            //TODO: Falta pedir confirmacion al usuario

            var pk = false;
            $.ajax({
                dataType: "json",
                url: "<?= $ruta_db_superior ?>app/flujo/borrarResponsableActividad.php",
                type: "POST",
                data: data,
                async: false,
                success: function (response) {
                    if (response["success"] == 1) {
                        top.notification({type: "success", message: response.message});
                        pk = true;
                        parent.parent.postMessage({accion: "recargarTabla", id: pk}, "*");
                    } else {
                        top.notification({type: "error", message: response.message});
                    }
                }
            });
            return pk;
        }
        return false;
    }

    function seleccionarFormato(event, data) {
    	//var elemento_evento = $.ui.fancytree.getEventTargetType(event.originalEvent);
        //console.log(event, data);
        //return false;

        	//console.log(data.node);
        	//console.log(data);
        	//return false;
    	var idformato = $("#idformato").val();
    	var fk_formato_flujo = data.node.key;
    	//Si lo va a seleccionar es false o undefined
    	if(!data.node.selected) {
    		var datos = {fk_formato_flujo: fk_formato_flujo};
    		var id = guardarFormatoActividad(idactividad, datos);
    		if(id) {
        		data.node.data["idformato"] = id;
        		//destinos.push(id);
        		return true;
    		}
    		return false;
    	} else {
    	    var ids = data.node.data.idformato;
    	    return eliminarFormatoActividad(idactividad, ids);
    	}
    }

    function guardarFormatoActividad(idactividad, data) {
    	if(data) {
    		data['key'] = localStorage.getItem("key");
    		data["fk_actividad"] = idactividad;

    	    console.log(idactividad, data);
    		//return false;
    		var pk = false;
    		$.ajax({
    			dataType: "json",
    			url: "<?= $ruta_db_superior ?>app/flujo/guardarFormatoActividad.php",
    			type: "POST",
    			data: data,
    			async: false,
    			success: function(response) {
    			  if(response["success"] == 1) {
    				top.notification({type: "success", message: response.message});
    				pk = response.data.pk;
    			  } else {
    				top.notification({type: "error", message: response.message});
    			  }
    			},
    			error: function(response) {
    				top.notification({type: "error", message: "No se pudo guardar"});
    				pk = false;
    			}
    		});
    		return pk;
    	}
    	return false;
    }

    function eliminarFormatoActividad(idactividad, ids) {
    	if(ids) {
    		var data = {
    			key: localStorage.getItem("key"),
    			fk_actividad: idactividad,
    			fk_tipo_destinatario: tipodestinatario,
    			ids: ids
    		};

    	    //console.log(idactividad, data);
    		//return false;
    		//TODO: Falta pedir confirmacion al usuario

    		var pk = false;
    		$.ajax({
    			dataType: "json",
    			url: "<?= $ruta_db_superior ?>app/flujo/borrarFormatoActividad.php",
    			type: "POST",
    			data: data,
    			async: false,
    			success: function(response) {
    			  if(response["success"] == 1) {
    				top.notification({type: "success", message: response.message});
    				pk = true;
    			  } else {
    				  top.notification({type: "error", message: response.message});
    			  }
    			}
    		});
    		return pk;
    	}
    	return false;
    }

    function guardarInfoActividad(data) {
        if (data) {
            data['key'] = localStorage.getItem("key");
            var pk = false;
            $.ajax({
                dataType: "json",
                url: "<?= $ruta_db_superior ?>app/flujo/guardarInfoActividad.php",
                type: "POST",
                data: data,
                async: false,
                success: function (response) {
                    if (response["success"] == 1) {
                        top.notification({type: "success", message: response.message});
                        pk = response.data;
                    } else {
                        top.notification({type: "error", message: response.message});
                    }
                }
            });
            return pk;
        }
        return false;
    }

</script>

<?php
function obtenerListaFormatos($idactividad) {
    

    $lista_campos = [];
    $formatos = busca_filtro_tabla("ff.idformato_flujo",
        "wf_formato_actividad fa join wf_formato_flujo ff on fa.fk_formato_flujo = ff.idformato_flujo",
        "fa.fk_actividad = " . $idactividad, "");
    for ($i = 0; $i < $formatos["numcampos"]; $i++) {
        $lista_campos[] = $formatos[$i]["idformato_flujo"];
    }
    return $lista_campos;
}

?>