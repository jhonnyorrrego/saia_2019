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

include_once $ruta_db_superior . 'controllers/autoload.php';

$idflujo = $_REQUEST['idflujo'];
$actividad = null;
$idactividad = null;
if (!empty($_REQUEST["idactividad"])) {
    $idactividad = $_REQUEST["idactividad"];
}
?>

<div class="container">
	<div class="row">
	    <div class="col">
	        <div class="form-group">
	            <label class="my-0" for="colaborador">Colaboradores</label>
	            <select class="form-control" style="width:400px;" id="colaborador" data-placeholder="Qui&eacute;n debe estar enterado"></select>
	        </div>
	    </div>
	</div>

	<div class="row">
	    <div class="col-12" id="colaborador_list">
	    <div id="toolbar_tabla_funcionario_actividad">
  		<a href="#" id="boton_eliminar_funcionario_actividad" class="btn btn-secondary" title="Eliminar"><i class="f-12 fa fa-trash"></i></a>
		</div>
		<table class="table table-striped table-bordered table-hover" cellspacing="0" id="tabla_funcionario_actividad"
    		data-toggle="table"
      		data-url="listado_funcionario_actividad.php?idactividad=<?= $idactividad?>"
    		data-click-to-select="true"
    		data-show-toggle="true"
    		data-show-columns="true"
    		data-toolbar="#toolbar_tabla_funcionario_actividad"
    		data-pagination="true">
		    <thead>
		    <tr>
		      <th data-field="state" data-checkbox="true"></th>
		        <th data-field="idfuncionario_actividad" data-visible="false">IdDest</th>
		        <th data-field="fk_funcionario" data-visible="false">IdFunc</th>
		        <th data-field="nombres" >Nombre</th>
		        <th data-field="apellidos">Apellido</th>
		        <th data-field="login" >Usuario</th>
		    </tr>
		    </thead>
		</table>
	    </div>
	</div>
</div>

<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/js/select2.min.js"></script>
<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/js/i18n/es.js"></script>

<script>
var $tabla = $("#tabla_funcionario_actividad");
$tabla.bootstrapTable();

var $botonEliminar = $('#boton_eliminar_funcionario_actividad')

var idactividad = "<?= $idactividad ?>";

$botonEliminar.click(function () {
    var ids = $.map($tabla.bootstrapTable('getSelections'), function (row) {
      return row.idfuncionario_actividad
    });
    var estado = eliminarFuncionarioActividad(idactividad, ids.join(","));
    if(estado) {
        $tabla.bootstrapTable('remove', {
            field: 'idfuncionario_actividad',
            values: ids
        });
    }
});

$('#colaborador').select2({
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

$('#colaborador').on('select2:select', function (e) {
	//console.log(e.params.data);
	var datos = $tabla.bootstrapTable('getData');

    var existe = false;
    for (var key in datos) {
    	var obj = datos[key];
    	if(obj.fk_funcionario == e.params.data.idfuncionario) {
    		existe = true;
    		break;
    	}
    }
	if(!existe) {
		var datos = e.params.data;
		var id = guardarFuncionarioActividad(idactividad, e.params.data);
		e.params.data["idfuncionario_actividad"] = id;
		$tabla.bootstrapTable('append', e.params.data);
	}
	$(this).val(null).trigger('change');
});

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

	if (repo.login) {
	  markup += "<div class='select2-result-repository__description'>" + repo.login + "</div>";
	}
	return markup;
}

function formatRepoSelection (repo) {
	//console.log(repo);
	return repo.login || repo.text;
}

function guardarFuncionarioActividad(idactividad, data) {
	if(data) {
		data['key'] = localStorage.getItem("key");
		data["fk_actividad"] = idactividad;
		data["fk_funcionario"] = data.idfuncionario;

	    //console.log(idactividad, data);
		//return false;
		var pk = false;
		$.ajax({
			dataType: "json",
			url: "<?= $ruta_db_superior ?>app/flujo/guardarFuncionarioActividad.php",
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
			}
		});
		return pk;
	}
	return false;
}
function eliminarFuncionarioActividad(idactividad, ids) {
	if(ids) {
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
			url: "<?= $ruta_db_superior ?>app/flujo/borrarFuncionarioActividad.php",
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
