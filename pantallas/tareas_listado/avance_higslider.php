<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php"); 
echo(estilo_bootstrap());
echo(librerias_jquery("1.7"));
echo(librerias_bootstrap());
echo(librerias_datepicker_bootstrap());
echo(librerias_notificaciones());





$usu_actual=usuario_actual("idfuncionario");
if(!isset($_REQUEST["idtareas_listado"])){
	die();
}



if(intval(@$_REQUEST['horas'])==0 && intval(@$_REQUEST['minutos'])==0){
	$_REQUEST['minutos']=1;
}

$datos = busca_filtro_tabla("nombre_tarea", "tareas_listado", "idtareas_listado=" . $_REQUEST['idtareas_listado'], "", $conn);
?>
<div class="tab-pane" id="tab3_<?php echo $_REQUEST["idtareas_listado"];?>">
	<table style="border:0px; width:100%; font-size: 10px; font-family: verdana,tahoma,arial;">
		<tr style="text-align: center;font-weight: bold; font-size: 16px;"><td colspan="3"><?php echo $datos[0]["nombre_tarea"]; ?></td></tr>
		<tr><td colspan="3">&nbsp;</td></tr>
		<tr>
			<td>Fecha*
			<br>
			<div id="datetimepicker_fecha_ini_<?php echo $_REQUEST["idtareas_listado"]; ?>" idtarea="<?php echo $_REQUEST["idtareas_listado"]?>" class="input-append">
				<input data-format="yyyy-MM-dd" idtarea="<?php echo $_REQUEST["idtareas_listado"]?>" id="fecha_inicio_<?php echo $_REQUEST["idtareas_listado"]; ?>"  name="fecha_inicio_<?php echo $_REQUEST["idtareas_listado"]; ?>" type="text" value="<?php echo $_REQUEST["fecha_ini"]; ?>" class="required" >
				</input>
				<span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i> </span>
			</div></td>
			<td style="border:0px;"> Hora Inicio*
			<br>
			<div id="datetimepicker_hora_ini_<?php echo $_REQUEST["idtareas_listado"]; ?>" idtarea="<?php echo $_REQUEST["idtareas_listado"]?>" class="input-append">
				<input data-format="hh:mm" idtarea="<?php echo $_REQUEST["idtareas_listado"]?>" id="hora_inicio_<?php echo $_REQUEST["idtareas_listado"]; ?>" name="hora_inicio_<?php echo $_REQUEST["idtareas_listado"]; ?>" type="text" value="<?php echo $_REQUEST["hora_ini"]; ?>">
				</input>
				<span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i> </span>
			</div></td>

			<td style="border:0px;"> Hora Final*
			<br>
			<div id="datetimepicker_hora_fin_<?php echo $_REQUEST["idtareas_listado"]; ?>" idtarea="<?php echo $_REQUEST["idtareas_listado"]?>" class="input-append">
				<input data-format="hh:mm" idtarea="<?php echo $_REQUEST["idtareas_listado"]?>" id="hora_final_<?php echo $_REQUEST["idtareas_listado"]; ?>" name="hora_final_<?php echo $_REQUEST["idtareas_listado"]; ?>" type="text">
				</input>
				<span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i> </span>
			</div></td>
		</tr>
	</table>
	<br>
	<div class="row-fluid">
		Estado Tarea*:
		<select id="estado_tarea_<?php echo $_REQUEST["idtareas_listado"]; ?>">
			<option value="EJECUCION">EJECUCION</option>
			<option value="STAND BY">STAND BY</option>
			<option value="CANCELADA">CANCELADA</option>
		</select>
		<div class="pull-right" style="text-align:center;">
			<input type="text" id="minutos_tiempo_<?php echo $_REQUEST["idtareas_listado"]; ?>" idtarea="<?php echo $_REQUEST["idtareas_listado"]?>" name="minutos_tiempo_<?php echo $_REQUEST["idtareas_listado"]?>" maxlength="2" class="input-mini" value="<?php echo $_REQUEST["minutos"];?>">
			<br>
			Minutos
		</div>
		<div class="pull-right"  style="width: 30px;">
			&nbsp;
		</div>
		<div class="pull-right" style="text-align:center;">
			<input type="text" id="horas_tiempo_<?php echo $_REQUEST["idtareas_listado"]?>" idtarea="<?php echo $_REQUEST["idtareas_listado"]?>" name="horas_tiempo_<?php echo $_REQUEST["idtareas_listado"]?>" maxlength="2" class="input-mini" value="<?php echo $_REQUEST["horas"];?>">
			<br>
			Horas
		</div>
		<div class="pull-right"  style="width: 30px;">
			&nbsp;
		</div>
	</div>
	<br>

	<div class="row-fluid">
		<textarea style="width: 750px;" id="comentario_avance_tarea_<?php echo $_REQUEST["idtareas_listado"]?>" name="comentario_avance_tarea_<?php echo $_REQUEST["idtareas_listado"]?>"></textarea>
	</div>
	<div class="row-fluid">
		<div class="btn btn-mini btn-primary guardar_avance_tarea" idtarea="<?php echo $_REQUEST["idtareas_listado"]?>">
			Aceptar
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	$("[id^='datetimepicker_fecha_ini_']").datetimepicker({
			language: 'es',
			pick12HourFormat: true,
			pickTime: false
		}).on('changeDate', function(e){
			$(this).datetimepicker('hide');
		});
		
	$("[id^='datetimepicker_hora_ini_'],[id^='datetimepicker_hora_fin_']").datetimepicker({
		pickDate: false,
		pickSeconds: false
	}).on('changeDate', function(e){
			validar_tiempo(1,$(this).attr("idtarea"));
	});
	
	$("[id^='hora_inicio_'],[id^='hora_final_']").blur(function (){
		validar_tiempo(1,$(this).attr("idtarea"));
	});
	$("[id^='horas_tiempo_'],[id^='minutos_tiempo_']").keyup(function (){
    this.value = (this.value + '').replace(/[^0-9]/g, '');
  });
  $("[id^='horas_tiempo_']").blur(function (){
    var valor=parseInt($(this).val());
    if(valor>23){
    	$(this).val("23");
    }
    if(valor<10){
    	$(this).val("0"+valor);
    }
    validar_tiempo(2,$(this).attr("idtarea"));
  });
  $("[id^='minutos_tiempo_']").blur(function (){
    var valor=parseInt($(this).val());
    if(valor>59){
    	$(this).val("59");
    }
    if(valor<10){
    	$(this).val("0"+valor);
    }
    validar_tiempo(2,$(this).attr("idtarea"));
  });
	
	function validar_tiempo(opt,idtarea){
		if(opt==1){
			var h_ini=$("#hora_inicio_"+idtarea).val();
			var h_fin=$("#hora_final_"+idtarea).val();	
			if(h_ini>=h_fin){
				$("#horas_tiempo_"+idtarea).val("");
				$("#minutos_tiempo_"+idtarea).val("");
				return false;
			}else{
				$.ajax({
			    type:'POST',
			    dataType: 'json',
			    url: "ejecutar_acciones.php",
			    data:{idtarea:idtarea,hora_ini:h_ini,hora_fin:h_fin,ejecutar_accion_tarea:"obtenter_tiempo_tareas", mensaje_exito:"Tiempo Cargado"},
			    success: function(datos){
			    	if(datos.exito!=1){
			    		notificacion_saia(datos.mensaje,"error","",3000);
			    	}else{
			    		tiempo=datos.tiempo.split("-");
			    		$("#horas_tiempo_"+idtarea).val(tiempo[0]);
			    		$("#minutos_tiempo_"+idtarea).val(tiempo[1]);
			    	}
			    } 
			  });
			}
		}else if(opt==2){
			var hora_ini=$("#hora_inicio_"+idtarea).val();
			var h=parseInt($("#horas_tiempo_"+idtarea).val());
			if(isNaN(h)){h=0}
			var m=parseInt($("#minutos_tiempo_"+idtarea).val());
			if(isNaN(m)){m=0}
			if(hora_ini==""){
				$("#horas_tiempo_"+idtarea).val("");
				$("#minutos_tiempo_"+idtarea).val("");
				notificacion_saia("Ingrese Hora Inicial","error","",3000);
				return false;
			}else if(h!=0 || m!=0){
				$.ajax({
			    type:'POST',
			    dataType: 'json',
			    url: "ejecutar_acciones.php",
			    data:{idtarea:idtarea,hora:h,minutos:m,hora_inicial:hora_ini,ejecutar_accion_tarea:"obtenter_fecha_final_tareas", mensaje_exito:"Tiempo Cargado"},
			    success: function(datos){
			    	if(datos.exito!=1){
			    		notificacion_saia(datos.mensaje,"error","",3000);
			    	}else{
			    		$("#hora_final_"+idtarea).val(datos.tiempo);
			    	}
			    } 
			  });
			}else{
				$("#hora_final_"+idtarea).val("");
			}
		}
	}
	
  $(".guardar_avance_tarea").click(function(){
    var idtarea=$(this).attr("idtarea");
    var hora_fin=$("#hora_final_"+idtarea).val();
    if(hora_fin!=""){
	    var fecha_ini=$("#fecha_inicio_"+idtarea).val();
	    var hora_ini=$("#hora_inicio_"+idtarea).val();
	    var estado=$("#estado_tarea_"+idtarea).val();
	    var comentario=$("#comentario_avance_tarea_"+idtarea).val();
	    var minutos=parseInt($("#minutos_tiempo_"+idtarea).val())*60;
	    if(isNaN(minutos)){minutos=0;}
	    var horas=parseInt($("#horas_tiempo_"+idtarea).val())*3600;
	    if(isNaN(horas)){horas=0;}
	    var tiempo_tarea=minutos+horas;
	    
			$.ajax({
		    type:'POST',
		    dataType: 'json',
		    url: "ejecutar_acciones.php",
		    data:{idtarea:idtarea,tiempo_tarea:tiempo_tarea,fecha_inicial:fecha_ini,hora_inicio:hora_ini,hora_final:hora_fin,estado:estado,comentario:comentario,ejecutar_accion_tarea:"registrar_tiempo_tarea_listado", mensaje_exito:"Tiempo Guardado"},
		    success: function(datos){
		    	if(datos.exito!=1){
		    		notificacion_saia(datos.mensaje,"error","",3000);
		    	}else{
		    		notificacion_saia(datos.mensaje,"success","",3000);		    		
		    		window.parent.hs.close();
		    	}
		    } 
		  });
	 	}else{
	 		notificacion_saia("Por favor ingrese el Tiempo","error","",3000);
	 	}
  });
  
	validar_tiempo(2,<?php echo $_REQUEST["idtareas_listado"]; ?>);
});
</script>