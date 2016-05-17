<?php
  $max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");
include_once($ruta_db_superior."workflow/libreria_paso.php");
//ini_set("display_errors",true);
echo(estilo_bootstrap());

function mostrar_informacion_paso($idpaso){
  $texto='<tr><td colspan="2">';
  $paso=busca_filtro_tabla("","paso","idpaso=".$idpaso,"",$conn);
  $texto.='<b>'.$paso[0]["nombre_paso"].'</b></td></tr>';
  $actividades_paso=busca_filtro_tabla("","paso_actividad A","A.paso_idpaso=".$paso[0]["idpaso"]." AND estado=1","",$conn);
 
 for($i=0;$i<$actividades_paso["numcampos"];$i++){
    $dato_usuarios=array();
    if($actividades_paso[$i]["llave_entidad"]==-1){
      array_push($dato_usuarios,"Cualquier usuario");
    }
    else{
      $usuarios=listado_funcionarios(4,$actividades_paso[$i]["llave_entidad"]);
		
     for($j=0;$j<$usuarios["numcampos"];$j++){
        array_push($dato_usuarios,'<div class="detalle_cargo" tipo_actividad="4" idcargo="'.$usuarios[$j]["idcargo"].'"><legend>'.$usuarios[$j]["cargo"].'</legend></div');
      }        
    }
    $texto.='<tr><td>'.$actividades_paso[$i]["descripcion"].'</td><td>'.implode("<br>",$dato_usuarios).'</td></tr>';
  }
  return($texto);
}
function verificar_fechas(){
	
}
function listado_funcionarios($entidad,$llave_entidad){
	global $conn;
	$condicion='';
	$funcionario_codigo=array();
	switch($entidad){
	    case 1://funcionario
	        $condicion="funcionario_codigo IN(".$llave_entidad.")";
	    break;
	    case 2://dependencia
	    		$condiciones=array();
	    		$dependencias=busca_filtro_tabla("","dependencia","iddependencia IN(".$llave_entidad.")","",$conn);
	    		$codigos=extrae_campo($dependencias,"cod_arbol");
	    		$cant_codigos=count($codigos);
	    		for($j=0;$j<$cant_codigos;$j++){
	    			array_push($condiciones,"cod_arbol_dep LIKE '".$codigos[$j].".%' ");
	    		}
	    		$condicion="(".implode(" OR ",$condiciones).")";
	    break;
	    case 3://ejecutor
	    break;
	    case 4://cargo
	        $condicion='idcargo IN('.$llave_entidad.")";
	    break;
	    case 5://dependencia cargo
	    		$condicion='iddependencia_cargo IN('.$llave_entidad.')';
	    break;            
	}
	$dato=busca_filtro_tabla("","vfuncionario_dc",$condicion." AND estado_dc=1 AND estado_dep=1 AND estado=1","GROUP BY funcionario_codigo",$conn);
	return($dato);
}
function actividades_terminadas_paso($idactividad,$documento){
	$paso_documento=busca_filtro_tabla("B.idpaso_instancia,B.fecha, B.responsable","paso_instancia_terminada B","B.documento_iddocumento=".$documento." AND estado_actividad<3 AND actividad_idpaso_actividad=".$idactividad,"",$conn);
return($paso_documento);
}


$paso=busca_filtro_tabla("","paso A, paso_actividad B","A.idpaso=B.paso_idpaso AND A.idpaso=".$_REQUEST["idpaso"]." AND B.estado=1","orden",$conn);

if($paso['numcampos']){
	


$paso_doc='';
if(@$_REQUEST["idpaso_documento"]){
	$paso_doc=busca_filtro_tabla("","paso_documento","idpaso_documento=".$_REQUEST["idpaso_documento"],"",$conn);

}
else if(@$_REQUEST["iddocumento"] && @$_REQUEST["idpaso"]){
	$paso_doc=busca_filtro_tabla("","paso_documento","paso_idpaso=".$_REQUEST["idpaso"]." AND documento_iddocumento=".$_REQUEST["iddocumento"],"",$conn);
}
//plazo en paso guarda en la posicion 0 (antes del @) el tiempo obligatorio en horas y en la posicion 1 (después del @) el tiempo opcional
$plazo_ejecucion=explode("@",$paso[0]["plazo_paso"]);
$date_ini = new DateTime();
$date_fin = clone($date_ini); 
$date_fin->Add(new DateInterval("PT".($plazo_ejecucion[0])."H"));
$diff=$date_ini->diff($date_fin);
$plazo=strip_tags(texto_atraso_saia($diff,"ymdh"));
if($paso_doc["numcampos"]){
  $inicio=mostrar_fecha_saia($paso_doc[0]["fecha_asignacion"]);
}
else{
  $inicio='SIN INICIAR';
}
?>
<style type="text/css">
  .table_no_borde td{
    border-top:0px;
    padding-bottom: 0px;
  }
  .tabla_lista th, .tabla_lista td{
    padding:0px;
    border-top:0px;
  }
  
  .tabla_lista{
    margin-bottom:0px;
  }
  .well{
    padding-top:9px;
    margin-bottom: 0px;
  }
  .detalle_cargo legend{
    border-bottom: 0px;
    cursor:hand;
  }
  .image_icon{
    max-width:24px;
  }
</style>
<legend> <?php echo($paso[0]["nombre_paso"]);?> &nbsp; 
	
	<?php 
	$estados_no_permitidos=array(1,2,6);  //1: ejecutado , 2: cerrado , 3: cancelado , 6: iniciado
	
	if(!in_array($paso_doc[0]['estado_paso_documento'], $estados_no_permitidos)){
		$permiso_mod=new Permiso();
		$ok=$permiso_mod->acceso_modulo_perfil("cancelar_paso_flujo");
		
		if($ok){
	?>
		<i class="icon-remove" title="Cancelar Paso" style="cursor:pointer;" id="cancelar_paso" iddocumento="<?php echo($paso_doc[0]['documento_iddocumento']); ?>" idpaso_documento="<?php echo($paso_doc[0]['idpaso_documento']); ?>" idpaso="<?php echo($paso_doc[0]['paso_idpaso']); ?>"></i> 
	<?php 
		}
	} 
	?>
	
</legend>
<br>
<?php 
$texto='';
$texto2='';
$acciones_mostrar=array("aprobar","confirmar","leer");
if($paso_doc["numcampos"] && $paso["numcampos"]){
  //saca el primer documento asociado con el diagrama por medio del paso_documento actual
  $doc_diagram=busca_filtro_tabla("","paso_documento","diagram_iddiagram_instance=".$paso_doc[0]["diagram_iddiagram_instance"],"idpaso_documento ASC",$conn);
  if($paso_doc["numcampos"]){
    $documento_principal=$doc_diagram[0]["documento_iddocumento"];
  }
	$arreglo_fechas=array();
	if($paso_doc[0]["fecha_limite"]!=''){
		$obj_fecha_limite=new DateTime($paso_doc[0]["fecha_limite"]);
	}
  $estado_paso=estado_paso_documento($paso_doc[0]["idpaso_documento"]);
	$texto.='<table class="table tabla_lista">';
  $texto.='<thead><th>&nbsp;</th><th>Descripci&oacute;n</th><th>Responsable</th><th>Acciones</th><th>Estado</th></thead>';
	$class_vencido='';
	for($i=0;$i<$paso["numcampos"];$i++){
	  $icono_tipo_actividad='';
		$dato_usuarios=array();
		$actividad=actividades_terminadas_paso($paso[$i]["idpaso_actividad"],$paso_doc[0]["documento_iddocumento"]);
		if($actividad["numcampos"]){
		  $estado_actividad='<div class="label label-success">Terminado</div>';
      $usuarios=listado_funcionarios(1,$actividad[0]["responsable"]);
      
      for($j=0;$j<$usuarios["numcampos"];$j++){
        array_push($dato_usuarios,$usuarios[$j]["nombres"]." ".$usuarios[$j]["apellidos"]);
      }
			if($paso_doc[0]["fecha_limite"]==''){
				$obj_fecha_limite=new DateTime($actividad[0]["fecha"]);
				array_push($arreglo_fechas,$obj_fecha_limite->format("Y-m-d H:I:s"));
			}
			$icono_informacion='<i class="icon-info-sign actividad ejecutada" tipo_actividad="1" id="instanciai_'.$actividad["idpaso_instancia"].'" idactividad_instancia="'.$actividad[0]["idpaso_instancia"].'" idpaso_documento="'.$paso_doc[0]["idpaso_documento"].'" idactividad="'.$paso[0]["idpaso_actividad"].'"></i>';
		}
		else{
		  if($paso[$i]["llave_entidad"]==-1){
		    array_push($dato_usuarios,"Cualquier usuario");
		  }
      else{
        $usuarios=listado_funcionarios(4,$paso[$i]["llave_entidad"]);
		  $j=0;
        //for($j=0;$j<$usuarios["numcampos"];$j++){ //SE COMENTA YA QUE REPETIA LOS CARGOS DE UN FUNCIONARIO
          array_push($dato_usuarios,'<div class="detalle_cargo" tipo_actividad="4" idcargo="'.$usuarios[$j]["idcargo"].'"><legend>'.$usuarios[$j]["cargo"].'</legend></div>');
        //}        
      }
			$actividad_no=busca_filtro_tabla("","paso_documento B, paso_actividad C","B.idpaso_documento=".$paso_doc[0]["idpaso_documento"]." AND C.idpaso_actividad=".$paso[$i]["idpaso_actividad"],"",$conn);
			//$icono_actividad='<i class="icon-uncheck actividad" tipo_actividad="2" idactividad="'.$paso[$i]["idpaso_actividad"].'"  idpaso_documento="'.$paso_doc[0]["idpaso_documento"].'" id="actividad_'.$paso[$i]["idpaso_actividad"].'"></i>';
			if($actividad_no["numcampos"]){
				//Si no esta asignada ninguna fecha limite toma la fecha de la asignacion y calcula basado en cada 
				if($paso_doc[0]["fecha_limite"]==''){
					$cad_interval="P";
					if($actividad_no[0]["tipo_plazo"]=="hour"){
						$cad_interval.="T";
					}
					$plazo_actividad=new DateInterval($cad_interval.$actividad_no[0]["plazo"].strtoupper($actividad_no[0]["tipo_plazo"][0]));
					$obj_fecha_limite=new DateTime($actividad_no[0]["fecha_asignacion"]);
					$obj_fecha_limite->add($plazo_actividad);
					array_push($arreglo_fechas,$obj_fecha_limite->format("Y-m-d H:I:s"));
				}
				$obj_fecha_asignacion=new DateTime($actividad_no[0]["fecha_asignacion"]);
				$obj_hoy=new DateTime();
				$diff=resta_dos_fechas_saia('',$obj_fecha_limite->format("Y-m-d H:i:s"));
				if($diff->invert){
					//$icono_actividad.='<i class="icon-warning-sign actividad" tipo_actividad="3" id="actividadi_'.$actividad["idpaso_actividad"].'" idactividad="'.$paso[$i]["idpaso_actividad"].'" idpaso_documento="'.$paso_doc[0]["idpaso_documento"].'"></i>';
          $estado_actividad='<div class="label label-important">Vencido</div>';
				}
				else{
					$estado_actividad='<div class="label label-warning">Pendiente</div>';  					
				}
			 $icono_informacion='<i class="icon-info-sign actividad" tipo_actividad="3" id="actividadi_'.$actividad["idpaso_actividad"].'" idactividad="'.$paso[$i]["idpaso_actividad"].'" idpaso_documento="'.$paso_doc[0]["idpaso_documento"].'"></i>';
      }
		}
    //$verifica almacena si el usuario que esta conectado es el asignado a la  actividad retorna true si puede hacerlo y false en cualquier otro caso
    $verifica_funcionario=verificar_existencia_funcionario($paso[$i]["entidad_identidad"],$paso[$i]["llave_entidad"],$_SESSION["usuario_actual"]);
    if($paso[$i]["tipo"]){
      if($paso[$i]["accion_idaccion"]){
        //se obtienen los datos del modulo para mostrar la imagen de la accion
        $accion=busca_filtro_tabla("B.imagen,A.etiqueta, B.enlace,A.nombre","accion A, modulo B","A.modulo_idmodulo=B.idmodulo AND A.idaccion=".$paso[$i]["accion_idaccion"],"",$conn);
        if($accion["numcampos"]){
          if($verifica_funcionario){
            if(in_array($accion[0]["nombre"],$acciones_mostrar)){
              echo("Accion de mostrar<br>");
              $accion[0]["nombre"]="mostrar";
            }
            if($accion[0]["nombre"]=="adicionar"){
              //TODO:El tema de adicionar
              $icono_tipo_actividad.='<span  border="0" class="tooltip_saia" title="'.$accion[0]["etiqueta"].'"><a href="'.$ruta_db_superior.'ordenar.php?key='.$documento_principal."&seleccionado=".$paso_doc[0]["documento_iddocumento"].'&mostrar=1&mostrar_formato=1&accion_default='.$accion[0]["nombre"].'&formato_hijo='.$paso[$i]["formato_idformato"].'" target="_parent"><img src="'.$ruta_db_superior.$accion[0]["imagen"].'" class="image_icon"></span></a>'; 
            }
            else{
              //No se a realizado la accion y el funcionario es el que esta conectado          
              /*datos={ kConnector:'iframe', url:"<?php echo($ruta_db_superior);? >index.php", kTitle:"Prueba"}  parent.$(".k-focus").closest("#contenedor_busqueda").kaiten("reload",parent.$(".k-focus"),datos); */
              $icono_tipo_actividad.='<span  border="0" class="tooltip_saia" title="'.$accion[0]["etiqueta"].'"><a href="'.$ruta_db_superior.'ordenar.php?key='.$documento_principal."&seleccionado=".$paso_doc[0]["documento_iddocumento"].'&mostrar=1&mostrar_formato=1&accion_default='.$accion[0]["nombre"].'" target="_parent"><img src="'.$ruta_db_superior.$accion[0]["imagen"].'" class="image_icon"></span></a>'; 
            }
          }
          else{
            //No se a realizado la accion        
            //$_REQUEST["idpaso"]

			
            $icono_tipo_actividad.='<span  border="0" class="tooltip_saia" title="'.$accion[0]["etiqueta"].'"><img src="'.$ruta_db_superior.$accion[0]["imagen"].'" class="image_icon"></span>'; 
          }          
        }
        /*else if (!$verifica_funcionario){
          $icono_tipo_actividad.='<span class="tooltip_saia" title="'.$accion[0]["etiqueta"].'"><img src="'.$ruta_db_superior.$accion[0]["imagen"].'"></span>';
        }*/
      }
      /*else {
        $icono_tipo_actividad.='<span class="icon-question-sign"></span>';
      }*/
    }
    else{
      /*if($actividad["numcampos"]){
        $estado_actividad=1;
      }
      else{
        $estado_actividad=0;
      }*/
      //actividad manual
      if($verifica_funcionario && !$actividad["numcampos"]){
        $icono_tipo_actividad.='<div class="actividad tooltip_saia" style="cursor:hand;" title="actividad manual" tipo_actividad="2" idactividad="'.$paso[$i]["idpaso_actividad"].'" id="actividad_'.$paso[$i]["idpaso_actividad"].'" idpaso_documento="'.$paso_doc[0]["idpaso_documento"].'"><i class="icon-user"></i></div>';        
      }
      else{
      		//CUANDO LA ACTIVIDAD ES PARA CUALQUIER USUARIO HABILITA ENLACE PARA TERMINARLA
      		$cualquier_usuario=busca_filtro_tabla("","paso_actividad","idpaso_actividad=".$paso[$i]["idpaso_actividad"],"",$conn);
			
			if($cualquier_usuario[0]['llave_entidad']==-1 && !$actividad["numcampos"]){
				$icono_tipo_actividad.='<div class="actividad tooltip_saia" style="cursor:hand;" title="actividad manual" tipo_actividad="2" idactividad="'.$paso[$i]["idpaso_actividad"].'" id="actividad_'.$paso[$i]["idpaso_actividad"].'" idpaso_documento="'.$paso_doc[0]["idpaso_documento"].'"><i class="icon-user"></i></div>';        
			}else{
				$icono_tipo_actividad.='<div class="tooltip_saia" title="actividad manual" tipo_actividad="2"><i class="icon-user"></i></div>';
			}
		
        
      }
    }
		$texto.='<tr><td>'.$icono_informacion.'</td><td>'.$paso[$i]["descripcion"].'</td><td>'.implode(", ",$dato_usuarios).'</td><td>'.$icono_tipo_actividad.'</td><td>'.$estado_actividad.'</td></tr>';
  }
	$texto.='</table>';
	
	if(count($arreglo_fechas) && $paso_doc["numcampos"]){		
		$obj_fecha_limite=new DateTime(max($arreglo_fechas));
		$sql="UPDATE paso_documento SET fecha_limite='".$obj_fecha_limite->format("Y-m-d H:i:s")."' WHERE idpaso_documento=".$paso_doc[0]["idpaso_documento"];
		phpmkr_query($sql);
	}
	if(!in_array($paso_doc[0]["estado_paso_documento"],array(1,2))){
		$texto2.='<div class="pull-left"><div class="input-append date" id="datepicker">
						<input class="required" id="fecha_limite" name="fecha_limite" data-format="yyyy-MM-dd hh:mm:ss" value="'.$obj_fecha_limite->format("Y-m-d H:i:s").'">
						<span class="add-on"><i class="icon-th"></i></span>
						<label class="error" for="fecha_limite"></label>
					</div></div>';
	}
	else{
		$texto2.=' &nbsp;'.mostrar_fecha_saia($obj_fecha_limite->format("Y-m-d H:i:s"));
	}
	$texto.='';
}
else{
	$texto='<div class="well alert-error">No es posible encontrar el Paso que busca por favor intente de nuevo o comuniquese con el administrador del sistema</div>';
	
}
?>
<table class="table table_no_borde tabla_lista">
  <tr>
    <td width="40%"><b>Inicio:</b> <?php echo($inicio);?></td>
    <td><b>Plazo de ejecuci&oacute;n:</b><?php echo($plazo);?></td>
  </tr>
  <tr>
    <td><b>Finalizado:</b> <?php if($estado_paso[0]["estado_paso_documento"]<3) echo(mostrar_fecha_saia($estado_paso["fecha_final"])); ?></td>
    <td><b>Estado:</b><span id="estado_paso" ><?php echo(imprimir_estado_paso_documento($estado_paso[0]["estado_paso_documento"]));?></span></td>
  </tr>
  <tr>
    <td><b>Terminados:</b> <?php echo($estado_paso["terminados"]."/".($estado_paso["restrictivas"]+$estado_paso["opcionales"]));?></td>
    <td><span class="pull-left"><b>Vencimiento:  </b></span><?php echo($texto2);?></td>
  </tr>
  <!--tr>
    <td><a href="<?php echo($ruta_db_superior."bpmn/paso/cancelar_paso.php?idpaso_doc=".$paso_doc[0]["idpaso_documento"]."&paso=".$paso_doc[0]["paso_idpaso"]);?>">Cancelar paso</a></td>
    <td>&nbsp</td>
  </tr-->
</table>
<div data-toggle="collapse" data-target="#div_actividades_paso">
  <i class="icon-minus-sign"></i>  <b>Actividades del paso</b>
</div>
  <?php 
  echo('<div id="div_actividades_paso" class="opcion_informacion collapse in"><div class="well">'.$texto.'</div></div>');
  $pasos_siguientes=busca_filtro_tabla("","paso A, paso_enlace B","A.idpaso=B.origen AND B.tipo_origen='bpmn_tarea' AND B.origen=".$_REQUEST["idpaso"]." AND B.tipo_destino='bpmn_tarea'","",$conn);
  $texto_pasos_siguientes='<table class="table tabla_lista">';
  if($pasos_siguientes["numcampos"]){
    for($i=0;$i<$pasos_siguientes["numcampos"];$i++){
      $texto_pasos_siguientes.=mostrar_informacion_paso($pasos_siguientes[$i]["destino"]);
    }
  }
  $pasos_condicional=busca_filtro_tabla("","paso A, paso_enlace B","A.idpaso=B.origen AND B.tipo_origen='bpmn_tarea' AND B.origen=".$_REQUEST["idpaso"]." AND B.tipo_destino='bpmn_condicional'","",$conn);
  if($pasos_condicional["numcampos"]){
   // for($j=0;$j<$pasos_condicional["numcampos"];$j++){ //SE COMENTA YA QUE MOSTRABA EL PASO SIGUIENTE X VECES
      $pasos_siguientes=busca_filtro_tabla("","paso A, paso_enlace B","A.idpaso=B.origen AND B.tipo_origen='bpmn_condicional' AND B.origen=".$pasos_condicional[0]["destino"]." AND B.tipo_destino='bpmn_tarea'","",$conn);
     //for($h=0;$h<$pasos_siguientes["numcampos"];$h++){
     	$texto_pasos_siguientes.=mostrar_informacion_paso($pasos_siguientes[0]["destino"]);  
     //}
        
    //}
  }
  $texto_pasos_siguientes.='</table>';
  if($pasos_siguientes["numcampos"]){
    echo('<div data-toggle="collapse" data-target="#div_informacion_paso_siguiente"><i class="icon-plus-sign"></i>  <b>Informaci&oacute;n paso(s) siguiente(s)</b></div>');
    echo('<div id="div_informacion_paso_siguiente" class="opcion_informacion collapse"><div class="well">'.$texto_pasos_siguientes.'</div></div>');
  }
  ?>
  <div id="detalles_actividad"></div>
<?php

echo(librerias_jquery("1.7"));
echo(librerias_bootstrap());
echo(librerias_datepicker_bootstrap());
echo(librerias_notificaciones());
?>
<script type="text/javascript">
$(document).ready(function(){
  $(".opcion_informacion").on("hide",function(){
    $(this).prev().children("i").removeClass();
    $(this).prev().children("i").addClass("icon-plus-sign");
  });
  $(".opcion_informacion").on("show",function(){
    $(this).prev().children("i").removeClass();
    $(this).prev().children("i").addClass("icon-minus-sign");
  });
	$('#datepicker').datetimepicker({
		language: 'es',
		pick12HourFormat: true,
		pickTime: true
	}).on('changeDate', function(e){
		$(this).datetimepicker('hide');
		$.ajax({
      type:'POST',
      url: "<?php echo($ruta_db_superior);?>bpmn/paso/actualizar_paso_fecha_limite.php",
      data:"fecha_limite="+$("#fecha_limite").val()+"&idpaso_documento=<?php echo($paso_doc[0]['idpaso_documento']);?>",
      success: function(html){
        if(html){
          var objeto=jQuery.parseJSON(html);
          if(objeto.exito){
           	//$("#detalles_actividad").find(".");
           	$("#estado_paso").html(objeto.estado);
           	notificacion_saia("Fecha actualizada","success","",3500);
         	} 
          else{
          	//No es exitosa la carga de la informaion
            notificacion_saia("No es posible actualizar la informaci&oacute;n","error","",4500)
          }   
        }
        else{
            //No se envia el registro html error 
        }
      }
	  });
	});
	$(".actividad").click(function(){
		var idactividad=$(this).attr("idactividad");
		var idpaso_documento=$(this).attr("idpaso_documento");
		var idpaso='<?php echo(@$_REQUEST['idpaso']); ?>';
		var diagrama='<?php echo(@$_REQUEST['diagrama']); ?>';
		//0,pendiente de ejecucion;  1,ejecutada; 
		var tipo_actividad=0;
		var datos="idactividad="+idactividad+"&idpaso_documento="+idpaso_documento;
		var este=$(this);
		if($(this).hasClass("ejecutada")){
			tipo_actividad=1;
			var idinstancia=$(this).attr("idactividad_instancia");
			datos+='&idactividad_instancia='+idinstancia;
		}
		if(este.attr("tipo_actividad")==="2"){
			window.open("<?php echo($ruta_db_superior)?>bpmn/paso/terminar_actividad.php?idactividad="+idactividad+"&idpaso_documento="+idpaso_documento+"&documento=<?php echo($paso_doc[0]['documento_iddocumento']); ?>&idpaso="+idpaso+"&diagrama="+diagrama,"_self");
		}
		else if(este.attr("tipo_actividad")==="0"){
			alert("Pendiente cancelar actividades del paso");
		}
		else{
			$.ajax({
	      type:'POST',
	      url: "<?php echo($ruta_db_superior);?>bpmn/paso/actividades_paso_detalle.php",
	      data:datos+="&tipo_accion="+este.attr("tipo_actividad"),
	      success: function(html){
	        if(html){
	          var objeto=jQuery.parseJSON(html);
	          if(objeto.exito){
	              //exito al cargar la informacion
	        	  $("#detalles_actividad").html(objeto.html);
	         	} 
	          else{
	          	//No es exitosa la carga de la informaion
	          }   
	        }
	        else{
	            //No se envia el registro html error 
	        }
	      }
		  });
		}
	});
	$(".detalle_cargo").click(function(){
	  var este=$(this);
    $.ajax({
      type:'POST',
      url: "<?php echo($ruta_db_superior);?>bpmn/paso/actividades_paso_detalle.php",
      data:"idcargo="+este.attr("idcargo")+"&tipo_accion="+este.attr("tipo_actividad"),
      success: function(html){
        if(html){
          var objeto=jQuery.parseJSON(html);
          if(objeto.exito){
              //exito al cargar la informacion
            $("#detalles_actividad").html(objeto.html);
          } 
          else{
            //No es exitosa la carga de la informaion
          }   
        }
        else{
            //No se envia el registro html error 
        }
      }
    });
	});
});
</script>
<script>
	$(document).ready(function(){
		$('#cancelar_paso').click(function(){
			if(confirm('Esta seguro/a de cancelar el paso?')){	
				$.ajax({
		        	type:'POST',
		            dataType: 'json',
		            url: "<?php echo($ruta_db_superior);?>bpmn/paso/ejecutar_acciones.php",
		            data: {
		            	iddocumento:$(this).attr('iddocumento'),
		            	idpaso_documento:$(this).attr('idpaso_documento'),
		            	idpaso:$(this).attr('idpaso'),
		            	ejecutar_accion:2  
		            },
		            success: function(datos){
		            	
		            	if(datos.exito==1){
		            		
		            		if(datos.doc_aprobado==1){
		            			notificacion_saia("No es posible cancelar el paso, el documento esta aprobado","error","",3500);
		            		}else{
		            			notificacion_saia("Paso cancelado Satisfactoriamente","success","",3500);
		            		}
		            		
		            		window.parent.hs.close();
		            		window.parent.location.reload();
		            		
		            	}else{
		            		notificacion_saia("No es posible cancelar el paso, no hay ninguna actividad terminada","warning","",3500);    
		            	}
						
		            }
		         });	  			
			}
		});
	});
</script>

<?php
}
else{
	?>
		<div class="well alert-warning"><center>ATENCI&Oacute;N<br>Este paso no tiene actividades definidas aun</center></div>
	<?php
}
?>

