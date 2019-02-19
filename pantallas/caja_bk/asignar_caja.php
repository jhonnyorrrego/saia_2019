<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	} $ruta .= "../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/lib/librerias_componentes.php");
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");

$caja=busca_filtro_tabla("","caja","idcaja=".$_REQUEST["idcaja"],"",$conn);
$nombre=($caja[0]["codigo_serie"]."-".$caja[0]["codigo_dependencia"]."-".$caja[0]["no_consecutivo"]);
$seleccionados = busca_filtro_tabla("idfuncionario,nombres,apellidos,permiso", "entidad_caja e,funcionario f", "e.llave_entidad=f.idfuncionario and e.caja_idcaja=" . @$_REQUEST["idcaja"] . " AND e.entidad_identidad=1 and f.idfuncionario<>" . $caja[0]["funcionario_idfuncionario"], "", $conn);
$table = '<table class="table table-bordered" id="funcionarios_seleccionados">
<thead>
<tr>
  <th style="text-align:center; vertical-align:middle" rowspan="2">Funcionario</th>
  <th style="text-align:center" colspan="4">Permisos</th>
</tr>
<tr><th style="text-align:center">Ver</th> <th style="text-align:center">Editar</th> <th style="text-align:center">Eliminar</th> <th style="text-align:center">Compartir</th></tr>
</thead>';
$idfuncionarios = array();
for ($i = 0; $i < $seleccionados["numcampos"]; $i++) {
	$idfuncionarios[] = $seleccionados[$i]["idfuncionario"];
	$m = "";
	$e = "";
	if (strpos($seleccionados[$i]["permiso"], "m") !== false) {
		$m = "checked=true";
	}
	if (strpos($seleccionados[$i]["permiso"], "e") !== false) {
		$e = "checked=true";
	}
	if (strpos($seleccionados[$i]["permiso"], "p") !== false) {
		$p = "checked=true";
	}
	$table .= '<tr id="fila_' . $seleccionados[$i]["idfuncionario"] . '">
		<td><input type="hidden" name="idfuncionario[]" value="' . $seleccionados[$i]["idfuncionario"] . '">' . ucwords(strtolower($seleccionados[$i]["nombres"] . ' ' . $seleccionados[$i]["apellidos"])) . ' <img style="cursor:pointer" src="' . $ruta_db_superior . 'imagenes/eliminar_nota.gif" onclick="eliminar_asociado(' . $seleccionados[$i]["idfuncionario"] . ')"/></td>
		<td style="text-align:center"><input type="checkbox" name="permisos_' . $seleccionados[$i]["idfuncionario"] . '[]" value="l" disabled checked=true></td>
		<td style="text-align:center"><input type="checkbox" name="permisos_' . $seleccionados[$i]["idfuncionario"] . '[]" value="m" ' . $m . ' class="realizar_submit"></td>
		<td style="text-align:center"><input type="checkbox" name="permisos_' . $seleccionados[$i]["idfuncionario"] . '[]" value="e" ' . $e . ' class="realizar_submit"></td>
		<td style="text-align:center"><input type="checkbox" name="permisos_' . $seleccionados[$i]["idfuncionario"] . '[]" value="p" ' . $p . ' class="realizar_submit"></td>
	</tr>';
}
$table .= "</table>";

echo (librerias_jquery("1.7"));
echo(librerias_arboles());
echo (estilo_bootstrap());
echo (librerias_notificaciones());
?>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style >
	.ac_results {
		padding: 0px;
		border: 0px solid black;
		background-color: white;
		overflow: hidden;
		z-index: 99999;
	}

	.ac_results ul {
		width: 100%;
		list-style-position: outside;
		list-style: none;
		padding: 0;
		margin: 0;
	}
	.ac_results li:hover {
		background-color: A9E2F3;
	}

	.ac_results li {
		margin: 0px;
		padding: 2px 5px;
		cursor: default;
		display: block;
		font: menu;
		font-size: 10px;
		line-height: 10px;
		overflow: hidden;
	}
</style>
</head>
<body>
	<div class="container">
		<form name="formulario_asignar_caja" id="formulario_asignar_caja">	
			<legend>Asignar acceso a Caja <?php echo($nombre); ?></legend>
			<div class="control-group element">
			<b>Asignar permiso a:*</b>
			<input type="hidden" name="propietario" value="<?php echo $caja[0]["funcionario_idfuncionario"]; ?>">
			<input type='hidden' id='idfuncionario_sel' size='50' name='idfuncionario_sel' value="<?php echo implode(",", $idfuncionarios); ?>">
			<input type='text' id='buscar_radicado' size='50' name='buscar_radicado'> <div id='ul_completar' class='ac_results'></div>
			<?php
				echo $table;
			?>
			</div>
			<input type="hidden" name="idcaja" id="idcaja" value="<?php echo($_REQUEST["idcaja"]); ?>">
			<input type="hidden" name="ejecutar_caja" value="asignar_permiso_caja">
			<input type="hidden" name="accion_caja" id="accion_caja" value="1">
			<input type="hidden" name="tipo_entidad" value="1">
			<input type="hidden" name="tipo_retorno" value="1">
			<input type="hidden" name="key_formulario_saia" value="<?php echo(generar_llave_md5_saia()); ?>">
			
			<div class="form-actions" style="display:none;">
				<button class="btn btn-primary" id="submit_formulario_asignar_caja">Aceptar</button>
			</div>
			<div id="cargando_enviar" class="pull-right">
		</form>
	</div>
</body>

<script type="text/javascript">
$(document).ready(function(){    
 $('.realizar_submit').live('click',function(){
     $('#submit_formulario_asignar_caja').click();
 });
    
$("#submit_formulario_asignar_caja").click(function(){  
	var formulario_asignar_caja=$("#formulario_asignar_caja");
  $('#cargando_enviar').html("<div id='icon-cargando'></div>Procesando");
	$(this).attr('disabled', 'disabled');
  <?php encriptar_sqli("formulario_asignar_caja",0,"form_info",$ruta_db_superior); ?>
  $.ajax({
    type:'POST',
    async:false,
    url: "<?php echo($ruta_db_superior);?>pantallas/caja/ejecutar_acciones.php",
    data: formulario_asignar_caja.serialize(),
    dataType:'json',
    success: function(objeto){    	
      if(objeto.exito==1){              
         notificacion_saia(objeto.mensaje,"success","",2500);
      }else{
        notificacion_saia(objeto.mensaje,"error","",8500);
      }
      $('#cargando_enviar').html(""); 
      window.location.reload();
    },error:function (a,b,c){
    	notificacion_saia("Error al procesar la solicitud","error","",8500);
    	$('#cargando_enviar').html("");
    }
	});
}); 	
	
	
var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();

	$("#buscar_radicado").keyup(function (){
	  delay(function(){
      var valor=$("#buscar_radicado").val();
      var seleccionados=$("#idfuncionario_sel").val();
      if(valor==0 || valor==""){
         $("#ul_completar").empty();
      }else{
        $("#ul_completar").empty().load( "<?php echo($ruta_db_superior);?>pantallas/expediente/autocompletar.php", { valor:valor,seleccionados:seleccionados,propietario:'<?php echo $caja[0]["funcionario_idfuncionario"];?>',opt:1});
      }
    }, 500 );
	});

});
	
function cargar_datos(idfunc,nombre){
	$("#ul_completar").empty();
	$("#buscar_radicado").val("");
	if(idfunc!=0){
		$("#funcionarios_seleccionados").append("<tr id='fila_"+idfunc+"'><td><input type='hidden' name='idfuncionario[]' value='"+idfunc+"'>"+nombre+" <img style='cursor:pointer' src='<?php echo($ruta_db_superior); ?>imagenes/eliminar_nota.gif' onclick='eliminar_asociado("+idfunc+");'></td> <td style='text-align:center'><input type='checkbox' name='permisos_"+idfunc+"[]' value='l' disabled checked=true></td><td style='text-align:center'><input type='checkbox' name='permisos_"+idfunc+"[]' value='m' class='realizar_submit'></td><td style='text-align:center'><input type='checkbox' name='permisos_"+idfunc+"[]' value='e' class='realizar_submit'></td> <td style='text-align:center'><input type='checkbox' name='permisos_"+idfunc+"[]' value='p' class='realizar_submit'></td> </tr>");
		var sel=$("#idfuncionario_sel").val();
		if(sel!=""){
			$("#idfuncionario_sel").val(sel+","+idfunc);
		}else{
			$("#idfuncionario_sel").val(idfunc);
		}
	}  
	$('#submit_formulario_asignar_caja').click();
}

function eliminar_asociado(idfunc){
	$("#fila_"+idfunc).remove();
	var datos=$("#idfuncionario_sel").val().split(",");
	var cantidad=datos.length;
	var nuevos_datos=new Array();
	var a=0;
	for(var i=0;i<cantidad;i++){
		if(idfunc!=datos[i]){
			nuevos_datos[a]=datos[i];
			a++;
		}
	}
	var datos_guardar=nuevos_datos.join(",");
	$("#idfuncionario_sel").val(datos_guardar);
	$('#submit_formulario_asignar_caja').click();
}
</script>