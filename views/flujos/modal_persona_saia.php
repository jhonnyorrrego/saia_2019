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
$tipo_destinatario = TipoDestinatario::TIPO_FUNCIONARIO;
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

<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen">
<?= estilo_tabla_bootstrap("1.13") ?>

<?= jquery() ?>
<?= bootstrap() ?>
<?= icons() ?>
<?= librerias_tabla_bootstrap("1.13", false, false) ?>

</head>
<body>
<p>&nbsp;</p>
<div class="container">
<input type="hidden" value="<?= $idnotificacion ?>">
	<div class="row">
	    <div class="col">
	        <div class="form-group">
	            <label class="my-0" for="funcionario">Destinatarios</label>
	            <select class="form-control" style="width:400px;" id="funcionario"></select>
	        </div>
	    </div>
	</div>

	<div class="row">
	    <div class="col-12" id="funcionario_list">
	    <div id="toolbar">
  		<a href="#" id="boton_eliminar" class="btn btn-secondary" title="Eliminar"><i class="f-12 fa fa-trash"></i></a>
		</div>
		<table class="table table-striped table-bordered table-hover" cellspacing="0" id="tabla_destinatarios"
		  data-toggle="table"
  data-url="listado_destinatarios_saia.php?idnotificacion=<?= $idnotificacion?>"
		data-click-to-select="true"
		data-show-toggle="true"
		data-show-columns="true"
		data-pagination="true">
		    <thead>
		    <tr>
		      <th data-field="state" data-checkbox="true"></th>
		        <th data-field="iddestinatario" data-visible="false">IdDest</th>
		        <th data-field="idfuncionario" data-visible="false">IdFunc</th>
		        <th data-field="nombres" >Nombre</th>
		        <th data-field="apellidos">Apellido</th>
		        <th data-field="email" >Correo</th>
		    </tr>
		    </thead>
		</table>
	    </div>
	</div>
</div>

<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/js/select2.min.js"></script>
<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/js/i18n/es.js"></script>

<script>
var $tabla = $("#tabla_destinatarios");

var $botonEliminar = $('#boton_eliminar')

var idnotificacion = "<?= $idnotificacion ?>";
var tipodestinatario = "<?= $tipo_destinatario?>";

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

$('#funcionario').select2({
	language: "es",
	multiple: false,
	ajax: {
	    url: 'buscar_funcionario.php',
	    dataType: 'json',
	    data: parametrosBusqueda,
	    processResults: procesarResultados
	},
	placeholder: 'Buscar funcionario',
	escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
	minimumInputLength: 2,
	templateResult: formatearRespuesta,
	templateSelection: formatRepoSelection

});
$('#funcionario').on('select2:select', function (e) {
	//console.log(e.params.data);
	var datos = $tabla.bootstrapTable('getData');

    var existe = false;
    for (var key in datos) {
    	var obj = datos[key];
    	if(obj.idfuncionario == e.params.data.idfuncionario) {
    		existe = true;
    		break;
    	}
    }
	if(!existe) {
		var datos = e.params.data;
		var id = guardarDestinatario(idnotificacion, e.params.data);
		e.params.data["iddestinatario"] = id;
		$tabla.bootstrapTable('append', e.params.data);
	}
	$(this).val(null).trigger('change');
});

//$('#tabla_destinatarios tbody tr').append('<td><a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a><a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a></td>');
function procesarResultados(data) {
	var datos = $.map(data, function (obj) {
		  obj.id = obj.idfuncionario || obj.funcionario_codigo; // replace pk with your identifier
		  obj.text = obj.nombres + " " + obj.apellidos;
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

function formatearRespuesta (repo) {
	//console.log(repo);
	if (repo.loading) {
	  return repo.text;
	}
	let nombre = repo.nombres + " " + repo.apellidos;
	var markup = "<div class='select2-result-repository clearfix'>" +
	  "<div class='select2-result-repository__meta'>" +
	    "<div class='select2-result-repository__title'>" + nombre + "</div>";

	if (repo.email) {
	  markup += "<div class='select2-result-repository__description'>" + repo.email + "</div>";
	}
	return markup;
}

function formatRepoSelection (repo) {
	//console.log(repo);
	return repo.email || repo.text;
}

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
			url: "<?= $ruta_db_superior ?>app/flujo/borrarDestinatarioSaia.php",
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

</script>
</body>