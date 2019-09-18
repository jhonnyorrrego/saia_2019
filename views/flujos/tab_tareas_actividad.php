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

include_once $ruta_db_superior . 'assets/librerias.php';

include_once $ruta_db_superior . 'assets/librerias.php';
include_once $ruta_db_superior . 'core/autoload.php';

$idactividad = null;
//$tipo_destinatario = TipoDestinatario::TIPO_EXTERNO;
if (!empty($_REQUEST["idactividad"])) {
    $idactividad = $_REQUEST["idactividad"];
}
?>
<div class="container">
    <form id="frmTareaActividad">
        <input type="hidden" name="fk_actividad" value="<?= $idactividad ?>">
        <div class="row py-1 mt-1">
            <div class="col col-md-8">
                <div class="form-group-default">
                <label for="nombre_tarea">Nombre</label>
                <input class="form-control form-control-sm" id="nombre_tarea" name="nombre" type="text" placeholder="Qu&eacute; desea que se realice &quest;">
                </div>
            </div>
            <div class="col col-md-4">
                <div class="form-check align-middle">
                    <input class="form-check-input" type="checkbox" value="" id="chkObligatorio" name="obligatorio">
                    <label class="form-check-label" for="chkObligatorio">
                        Obligatoria
                    </label>
                </div>
            </div>
        </div>
        <div class="row pr-2 mt-1">
            <div class="col col-md-8">
                <button type="button" class="btn btn-primary btn-sm float-right" id="btnGuardarTareaActividad">Guardar</button>
            </div>
        </div>

    </form>
</div>
<div class="container-fluid">
    <div id="toolbar_tabla_tareas">
        <a href="#" id="boton_eliminar_tarea" class="btn btn-secondary" title="Eliminar"><i class="f-12 fa fa-trash"></i></a>
    </div>
    <table class="table table-striped table-bordered table-hover" id="tabla_tareas"
           data-toggle="table"
           data-url="listado_tareas_actividad.php?idactividad=<?= $idactividad ?>"
           data-click-to-select="true"
           data-show-toggle="true"
           data-show-columns="true"
           data-toolbar="#toolbar_tabla_tareas"
           data-pagination="true">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="true"></th>
                <th data-field="idtarea" data-visible="false">IdTarea</th>
                <th data-field="obligatorio" data-formatter="obligatorioFormatterTask">Tipo</th>
                <th data-field="nombre">Nombre</th>
            </tr>
        </thead>
    </table>
</div>

<script>
    var $tabla = $("#tabla_tareas");
    $tabla.bootstrapTable();

    var $botonEliminarTarea = $('#boton_eliminar_tarea')
    var $botonGuardarTarea = $('#btnGuardarTareaActividad')

    var idactividad = "<?= $idactividad ?>";
    //var tipo_tarea = "<?= $tipo_destinatario ?>";
    var obligatorio = 0;

    $botonGuardarTarea.click(function () {
        var datos = $tabla.bootstrapTable('getData');

        var nombre = $("#frmTareaActividad #nombre_tarea").val();
        if($("#frmTareaActividad #chkObligatorio").is(':checked')) {
            obligatorio = 1;
        }
        //console.log("obligatorio", obligatorio);
        var existe = false;
        for (var key in datos) {
            var obj = datos[key];
            if (obj.nombre == nombre) {
                existe = true;
                break;
            }
        }
        console.log("existe", existe);
        if (!existe) {
            var data = {obligatorio: obligatorio, nombre: nombre};
            var id = guardarTareaActividad(idactividad, data);
            data["idtarea"] = id;
            $tabla.bootstrapTable('append', data);
        }
    });

    $botonEliminarTarea.click(function () {
        var ids = $.map($tabla.bootstrapTable('getSelections'), function (row) {
            return row.idtarea_actividad
        });
        var estado = eliminarTareaActividad(idactividad, ids.join(","));
        if (estado) {
            $tabla.bootstrapTable('remove', {
                field: 'idtarea_actividad',
                values: ids
            });
        }
    });

    function guardarTareaActividad(idactividad, data) {
        if (data) {
            data['key'] = localStorage.getItem("key");
            data["fk_actividad"] = idactividad;
            data["obligatorio"] = obligatorio;
            data["fk_funcionario"] = data.idfuncionario;

            //console.log(idactividad, data);
            //return false;
            var pk = false;
            $.ajax({
                dataType: "json",
                url: "<?= $ruta_db_superior ?>app/flujo/guardarTareaActividad.php",
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

    function eliminarTareaActividad(idactividad, ids) {
        if (ids) {
            var data = {
                key: localStorage.getItem("key"),
                fk_actividad: idactividad,
                obligatorio: obligatorio,
                ids: ids
            };

            //console.log(idactividad, data);
            //return false;
            //TODO: Falta pedir confirmacion al usuario

            var pk = false;
            $.ajax({
                dataType: "json",
                url: "<?= $ruta_db_superior ?>app/flujo/borrarTareaActividad.php",
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

    function obligatorioFormatterTask(value, row, index) {
    	//console.log(value);
        if(value == '1') {
            return "Obligatoria";
        } else {
            return "Opcional";
        }
    }

</script>
