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

include_once $ruta_db_superior . 'librerias_saia.php';
include_once $ruta_db_superior . 'controllers/autoload.php';

$idnotificacion = null;
$tipo_destinatario = TipoDestinatario::TIPO_EXTERNO;
if(!empty($_REQUEST["idnotificacion"])) {
    $idnotificacion = $_REQUEST["idnotificacion"];
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<meta name="description" content="">


<?= jquery() ?>
<?= bootstrap() ?>
<?= icons() ?>
<?= theme() ?>
<?= bootstrapTable() ?>

</head>
<body>
<p>&nbsp;</p>
<div class="container">

	<form id="formDestExt">
		<input type="hidden" name="fk_notificacion" value="<?= $idnotificacion ?>">
		<div class="row">
    		<div class="col col-md-5">
				<input class="form-control form-control-sm" id="nombre" name="nombre" type="text" placeholder="Nombre">
			</div>
    		<div class="col col-md-5">
				<input class="form-control form-control-sm" id="email" name="email" type="text" placeholder="Email"></label>
			</div>
    		<div class="col col-md-2">
				<button type="button" class="btn btn-primary btn-sm" id="btnSaveExtPerson">Guardar</button>
			</div>
		</div>
	</form>

</div>

    <div id="toolbar">
  		<a href="#" id="boton_eliminar" class="btn btn-secondary" title="Eliminar"><i class="f-12 fa fa-trash"></i></a>
	</div>
	<table class="table table-striped table-bordered table-hover" id="tabla_destinatarios"
		data-toggle="table"
		data-url="listado_destinatarios_externos.php?idnotificacion=<?= $idnotificacion?>"
		data-click-to-select="true"
		data-show-toggle="true"
		data-show-columns="true"
		data-toolbar="#toolbar"
		data-pagination="true">
		    <thead>
		    <tr>
		      <th data-field="state" data-checkbox="true"></th>
		        <th data-field="iddestinatario" data-visible="false">IdDest</th>
		        <th data-field="nombre">Nombre</th>
		        <th data-field="email">Correo</th>
		    </tr>
		    </thead>
	</table>


<script>
var $tabla = $("#tabla_destinatarios");

var $botonEliminar = $('#boton_eliminar')
var $botonGuardar = $('#btnSaveExtPerson')

var idnotificacion = "<?= $idnotificacion ?>";
var tipodestinatario = "<?= $tipo_destinatario?>";

$botonGuardar.click(function () {
	var datos = $tabla.bootstrapTable('getData');

	var iddestinatario = $("#iddestinatario").val();
	var email = $("#email").val();
	var nombre = $("#nombre").val();
    var existe = false;
    for (var key in datos) {
    	var obj = datos[key];
    	if(obj.email == email) {
    		existe = true;
    		break;
    	}
    }
	if(!existe) {
		var data = {email: email, nombre: nombre};
		var id = guardarDestinatario(idnotificacion, data);
		data["iddestinatario"] = id;
		$tabla.bootstrapTable('append', data);
	}
});

$botonEliminar.click(function () {
    var ids = $.map($tabla.bootstrapTable('getSelections'), function (row) {
      return row.iddestinatario
    });
    var estado = eliminarDestinatarios(idnotificacion, ids.join(","));
    if(estado) {
        $tabla.bootstrapTable('remove', {
            field: 'iddestinatario',
            values: ids
        });
    }
});

function guardarDestinatario(idnotificacion, data) {
	if(data) {
		data['key'] = localStorage.getItem("key");
		data["fk_notificacion"] = idnotificacion;
		data["fk_tipo_destinatario"] = tipodestinatario;
		data["fk_funcionario"] = data.idfuncionario;

	    //console.log(idnotificacion, data);
		//return false;
		var pk = false;
		$.ajax({
			dataType: "json",
			url: "<?= $ruta_db_superior ?>app/flujo/guardarDestinatario.php",
			type: "POST",
			data: data,
			async: false,
			success: function(response) {
			  if(response["success"] == 1) {
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
function eliminarDestinatarios(idnotificacion, ids) {
	if(ids) {
		var data = {
			key: localStorage.getItem("key"),
			fk_notificacion: idnotificacion,
			fk_tipo_destinatario: tipodestinatario,
			ids: ids
		};

	    //console.log(idnotificacion, data);
		//return false;
		//TODO: Falta pedir confirmacion al usuario

		var pk = false;
		$.ajax({
			dataType: "json",
			url: "<?= $ruta_db_superior ?>app/flujo/borrarDestinatarioExterno.php",
			type: "POST",
			data: data,
			async: false,
			success: function(response) {
			  if(response["success"] == 1) {
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

</script>
</body>