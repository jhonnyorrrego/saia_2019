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

require_once $ruta_db_superior . "controllers/autoload.php";

$identidadSerie = $_REQUEST['identidad_serie'];
if (!$identidadSerie) {
	alerta('Identificador NO encontrado', 'error');
	return false;
}
$EntidadSerie = new EntidadSerie($identidadSerie);
$Serie = $EntidadSerie->getRelationFk('Serie');
$Dependencia = $EntidadSerie->getRelationFk('Dependencia');

$instance3 = $EntidadSerie->getPermisoSerieFk();
$seleccionados = [
	1 => [],
	2 => [],
	4 => []
];
if ($instance3) {
	foreach ($instance3 as $inst) {
		$seleccionados[$inst->fk_entidad][] = $inst->llave_entidad;
	}
}

$params = [
	'sel' => $seleccionados,
	'identidadSerie' => $identidadSerie
];

include_once $ruta_db_superior . 'assets/librerias.php';
include_once $ruta_db_superior . "librerias_saia.php";
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>SAIA - SGDEA</title>
		<?= jquery() ?>
		<?= bootstrap() ?>
		<?= theme() ?>
		<?= librerias_UI("1.12") ?>
		<?= librerias_arboles_ft("2.24", 'filtro'); ?>
		<?= librerias_highslide(); ?>	
	</head>

	<body>
		<div class="container m-0 p-0 mw-100 mx-100">
			<div class="row mx-0">
				<div class="col-12">
					<form name="formulario" id="formulario" method="post">
						<table class="table tabled-bordered">
							<tr>
								<td>ASIGNAR PERMISOS A*</td>
								<td>
									<strong>SERIE:</strong> <?= $Serie->nombre; ?><br/>
									<strong>DEPENDENCIA:</strong> <?= $Dependencia->nombre; ?><br/>
									<input type="hidden" name="identidad_serie" id="identidad_serie" value="<?= $identidadSerie; ?>">
								</td>
							</tr>
							<tr>
								<td>TIPO ENTIDAD*</td>
								<td>
									<select id="fk_entidad" name="fk_entidad" class="required">
										<option value="">Seleccione</option>
										<option value="1">Asignado a Funcionario(s)</option>
										<option value="2">Asignado a Dependencia(s)</option>
		   								<option value="4">Asignado a Cargo(s)</option>		   
									</select>
								</td>
							</tr>
							<tr>
								<td>ENTIDAD*</td>
								<td><div id="sub_entidad"></div></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>

		<script type='text/javascript'>
		hs.graphicsDir = '<?= $ruta_db_superior ?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
		hs.outlineType = 'rounded-white';
		var params = <?= json_encode($params); ?>;

		$(document).ready(function (){
			$("#fk_entidad").change(function () {
				let option=$(this).val();				
				if(option != "") {
					seleccionados=params.sel[option].join(',');					
					switch(option) {
						case '1'://Funcionario
							url1="arboles/arbol_funcionario.php?idcampofun=idfuncionario&checkbox=true&sin_padre=1";
						break;

						case '2'://Dependencia
							url1="arboles/arbol_dependencia.php?estado=1&checkbox=true";
						break;

						case '4'://Cargo
							url1="arboles/arbol_cargo.php?estado=1&checkbox=true";
						break;
					}
					$.ajax({
						url : "<?= $ruta_db_superior ?>arboles/crear_arbol.php",
						data:{ 
							xml:url1,
							campo:"llave_entidad",
							selectMode:2,
							ruta_db_superior:"../../",
							seleccionados:seleccionados,
							onNodeSelect:"asignarPermisoLectura",
							onNodeClick:"asignarPermisoAdicion",
							busqueda_item:1
						},
						type : "POST",
						async:false,
						success : function(html) {
							$("#sub_entidad").empty().html(html);
						},error: function () {
							top.notification({
								message: 'No se pudo cargar la información',
								type: 'error',
								duration: 5000
							});
						}
					});
				}else{
					$("#sub_entidad").empty();
				}
			});
			
		});

		function asignarPermisoLectura(event,data){
			let identidadSerie = params.identidadSerie;
			let fk_entidad = $("#fk_entidad").val();
			let id = data.node.key;
			let selected = data.node.selected ? 1 : 0;
			
			$.ajax({
				url: 'asignar_permiso.php',
				dataType: 'json',
				type:'post',
				data:{
					fk_entidad:fk_entidad,
					id:id,
					selected:selected,
					identidad_serie:identidadSerie,
					accion:1
				},
				success: function(response){
					top.notification({
						message: response.message,
						type: response.type,
						duration: 5000
					});
					if(response.exito){
						if(selected){
							params.sel[fk_entidad].push(id);	
						}else{
							let newinfo=params.sel[fk_entidad];
							params.sel[fk_entidad]=newinfo.filter(x => x != id);	
						}
					}
				},error:function(){
					top.notification({
						message: 'Error al actualizar la informacion',
						type: 'error',
						duration: 5000
					});
				}
			});
		}

		function asignarPermisoAdicion(event,data){
			let evento = $.ui.fancytree.getEventTargetType(event.originalEvent);
			let selected = data.node.selected ? 1 : 0;

			if(evento=="title" && selected){
				let identidadSerie = params.identidadSerie;
				let fk_entidad = $("#fk_entidad").val();
				let id = data.node.key;
				let enlace="highslide_permiso_serie.php?identidad_serie="+identidadSerie+"&fk_entidad="+fk_entidad+"&llave_entidad="+id;

				hs.htmlExpand(this, {
					objectType: 'iframe',
					width: 300,
					height: 150,
					preserveContent:false,
					src:enlace,
					outlineType: 'rounded-white',
					wrapperClassName:'highslide-wrapper drag-header'
				});
			}
		}

		</script>
	</body>
</html>