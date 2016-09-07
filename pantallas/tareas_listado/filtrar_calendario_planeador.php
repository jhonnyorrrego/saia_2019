<?php $max_salida = 10;
// Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
		//Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");

if(@$_REQUEST['variable_busqueda']){
	$vector_variable_busqueda=explode('|',@$_REQUEST['variable_busqueda']);
	for($i=0;$i<count($vector_variable_busqueda);$i++){
		$vector_valores=explode('@',$vector_variable_busqueda[$i]);
		switch($vector_valores[0]){
			case 'listado_tareas_fk':
				$vector_listado_tareas_fk=explode(',',$vector_valores[1]);
				$_REQUEST ["listado_tareas_fk"]=$vector_listado_tareas_fk[0];
				break;
			default:
				break;	
		}
	}	
}
?>

<div class="control-group">
	<label class="string required control-label" for="responsable_asignado"> <b>Macroproceso / proceso</b>
	</label>
	<div class="controls">
		<input type="text" name="listado_tareas_fk" id="listado_tareas_fk" >

	
	</div>
	<input type="hidden" id="idbusqueda_componente" name="idbusqueda_componente" value="<?php echo(@$_REQUEST["idbusqueda_componente"]); ?>" />
	<input type="hidden" id="idcalendario" name="idcalendario" value="<?php echo(@$_REQUEST["idcalendario"]); ?>" />
	<input type="hidden" id="variable_busqueda" name="variable_busqueda">
	
</div>	

<?php
autocompletar_listado_tareas();
function autocompletar_listado_tareas() {
	global $ruta_db_superior;
	global $raiz_saia;
	$raiz_saia = $ruta_db_superior;
	
	if (@$_REQUEST ["listado_tareas_fk"] || @$_REQUEST ["idlistado_tareas"]) {
			
		if(@$_REQUEST ["idlistado_tareas"]){
			$_REQUEST ["listado_tareas_fk"]=$_REQUEST ["idlistado_tareas"];
		}	
			
			
		$proceso=busca_filtro_tabla("cod_padre,nombre,idserie","serie","idserie=".$_REQUEST ["listado_tareas_fk"],"",$conn);			
		$macro=busca_filtro_tabla("nombre","serie","idserie=".$proceso[0]['cod_padre'],"",$conn);
		$id = $_REQUEST["listado_tareas_fk"];
		$descripcion = $macro[0]['nombre']." / ".$proceso[0]['nombre'];
		$cadena = "<table id='informacion_buscar_radicado_listado_tareas'><tr id='fila_listado_tareas_" . $id . "'><td>" . $descripcion . "</td><td><img style='cursor:pointer' src='../imagenes/eliminar_nota.gif' registro='" . $id . "' onclick='eliminar_asociado_listado_tareas(" . $id . ");'></td></tr></table>";
	}
	

	?>
<style>

#informacion_buscar_radicado_listado_tareas tr td{
	font-size:10px;
}

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
	text-align:left;
}
.highslide-move {
   display: none;
}

</style>
<script>
$(document).ready(function(){
	$('[name="info_recurrencia"]').hide();	


  var delay = (function(){
          var timer = 0;
          return function(callback, ms){
                  clearTimeout (timer);
                  timer = setTimeout(callback, ms);
          };
  })();
  
  $("#listado_tareas_fk").hide();
  $("#listado_tareas_fk").parent().append("<input type='text' id='buscar_radicado_listado_tareas' size='50' name='buscar_radicado_listado_tareas'><div id='ul_completar_listado_tareas' class='ac_results'></div>");
  $("#buscar_radicado_listado_tareas").keyup(function (){
          if($(this).val()==0 || $(this).val()==""){
                  //alert("Ingrese Numero de Radicado");
          }else{
                  var x_valor=$(this).val();
                  delay(function(){
                          $("#ul_completar_listado_tareas").load( "../pantallas/tareas_listado/autocompletar_listado_tareas.php", { nombre_lista: x_valor,calendario_planeador:1 });
                  },500);			  		$('#from_generica').val(0);  
					
					$('#informacion_buscar_radicado_listado_tareas').remove();
		  			$("#listado_tareas_fk").val('');
		  			$("#buscar_radicado_listado_tareas").attr('readonly',false);			
					if($('#info_recurrencia').val()!=''){
						$('#info_recurrencia').val('');
						$('#enlace_recurrencia').attr('disabled',false);
					}	
					for(i=0;i<=3;i++){ 
						$('#prioridad'+i).show();
						$('#prioridad'+i).attr('checked',false);
					}
					if($('#tiempo_estimado').val()!=''){
						$('#tiempo_estimado').val('');
						$('#h').val('');
						$('#i').val('');
						$('#i,#h').attr('readonly',false);
					}
					//refrescar_select_tareas();
          }
  });
  
  <?php if(@$_REQUEST ["listado_tareas_fk"] || @$_REQUEST ["idlistado_tareas"]){ ?>
  $("#buscar_radicado_listado_tareas").after("<?php echo(addslashes($cadena)); ?>");
  $("#listado_tareas_fk").val("<?php echo($_REQUEST["listado_tareas_fk"]); ?>");
  $("#buscar_radicado_listado_tareas").attr('readonly',true);

  <?php } ?>
});
function cargar_datos_listado_tareas(iddoc,descripcion){
  $("#ul_completar_listado_tareas").empty();
  if(iddoc!=0){
          if(!$("#informacion_buscar_radicado_listado_tareas").length){
                  $("#buscar_radicado_listado_tareas").after("<table id='informacion_buscar_radicado_listado_tareas'></table>");
          }
          $("#informacion_buscar_radicado_listado_tareas").append("<tr id='fila_listado_tareas_"+iddoc+"'><td>"+descripcion+"</td><td><img style='cursor:pointer' src='../imagenes/eliminar_nota.gif' registro='"+iddoc+"' onclick='eliminar_asociado_listado_tareas("+iddoc+");'></td></tr>");
          $("#listado_tareas_fk").val(iddoc);
          $("#buscar_radicado_listado_tareas").val("");
          $("#buscar_radicado_listado_tareas").attr('readonly',true);


		    var idbusqueda_componente=$('#idbusqueda_componente').val();
			var idcalendario=$('#idcalendario').val();
			var listado_tareas_fk=$('#listado_tareas_fk').val();
			
			var variable_busqueda="listado_tareas_fk@"+listado_tareas_fk;
			$('#variable_busqueda').val(variable_busqueda);
			
			//window.location="../calendario/fullcalendar.php?idcalendario="+idcalendario+"&idbusqueda_componente="+idbusqueda_componente+"&variable_busqueda="+$('#variable_busqueda').val();   
		  $('#external-events').html('<legend>Mis tareas pendientes</legend>');	
		  $("#fila_actual").val(0);
		  $("#busqueda_pagina").val(0);
		  $("#cantidad_total").val(10);
		  $('#cantidad_total_copia').val(-1);
		  $("#loadmoreajaxloader_parent").removeClass('disabled');
		  setTimeout(function(){
              cargar_datos_scroll();
          }, 50);
          setTimeout(function(){
              contador_buzon("<?php echo(@$_REQUEST["idbusqueda_componente"]);?>+",'cantidad_maxima');
          }, 300);
          
          
  }else{
          $("#buscar_radicado_listado_tareas").val("");
  }
  
}
function eliminar_asociado_listado_tareas(iddoc){
  $("#fila_listado_tareas_"+iddoc).remove();
  $("#listado_tareas_fk").val('');
  $("#buscar_radicado_listado_tareas").attr('readonly',false);
   
    var idbusqueda_componente=$('#idbusqueda_componente').val();
	var idcalendario=$('#idcalendario').val();
    $('#variable_busqueda').val('');
	//window.location="../calendario/fullcalendar.php?idcalendario="+idcalendario+"&idbusqueda_componente="+idbusqueda_componente;     
  
	$('#external-events').html('<legend>Mis tareas pendientes</legend>');	
	$("#fila_actual").val(0);
	$("#busqueda_pagina").val(0);
	$("#cantidad_total").val(10);  
	 $('#cantidad_total_copia').val(-1);
	$("#loadmoreajaxloader_parent").removeClass('disabled');
	setTimeout(function(){
        cargar_datos_scroll();
    }, 50);
    setTimeout(function(){
        contador_buzon("<?php echo(@$_REQUEST["idbusqueda_componente"]);?>+",'cantidad_maxima');
    }, 300);
}



</script>
<?php
}
?>
