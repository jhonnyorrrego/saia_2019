<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}

include_once($ruta_db_superior."db.php");

include_once($ruta_db_superior."assets/librerias.php");


function fecha_bloqueada_valoracion($idformato,$iddoc){//A.A
	echo "<td><input type='text' name='fecha_valoracion' value='".date('Y-m-d')."' readonly='readonly'/></td>";
}

function adicionar_modificaciones($idformato,$iddoc){//A.A
	//funcionario_idfuncionario,fecha,documento_iddocumento
	$idfun=usuario_actual("idfuncionario");
	$fecha=fecha_db_almacenar(date('Y-m-d H:i'),'Y-m-d H:i');
	$sql="INSERT INTO ft_cr_historial (funcionario_idfuncionario, fecha, documento_iddocumento) VALUES (".$idfun.",".$fecha.",".$iddoc.")";
	phpmkr_query($sql);
}
function modificaciones($idformato,$iddoc){//A.A
	$datos=busca_filtro_tabla(fecha_db_obtener("A.fecha","Y-m-d H:i")." as fecha,B.nombres,B.apellidos","ft_cr_historial A,funcionario B","A.funcionario_idfuncionario=B.idfuncionario and A.documento_iddocumento=$iddoc","");
	
	$html="";
	$html.="<table width='100%' border='1' style='border-collapse:collapse'>";
	$html.="<tr>
	<td class='encabezado'>Fecha</td> 
	<td class='encabezado'>Nombre</td>
 	</tr>";
	for($i=0;$i<$datos['numcampos'];$i++){
		$html.="<tr>
		<td>".$datos[$i]['fecha']."</td>
		<td>".$datos[$i]['nombres']." ".$datos[$i]['apellidos']."</td>
		</tr>";
	}
	$html.="</table>";
	echo $html;
}
function consecutivo_funcion_control($idformato,$iddoc){
	
	$ultimo2=busca_filtro_tabla("max(consecutivo_control) as ultimo","ft_control_riesgos a","ft_riesgos_proceso=".$_REQUEST["padre"],"");
	echo '<td><input type="text" readonly="readonly" name="consecutivo_control" value="'.($ultimo2[0]["ultimo"]+1).'"></td>';
}
function llenar_orientacion($idformato,$iddoc){
	global $conn, $ruta_db_superior;
	?>
	<script>
	$(document).ready(function(){
		$("#desc_herramienta").parent().parent().hide();
		$('[name="anexar_herramienta[]"]').parent().parent().parent().hide();
		$("#desc_documento").parent().parent().hide();
		$('[name="anexar_documento[]"]').parent().parent().parent().hide();
		$("#responsable_seg").parent().parent().hide();
		$("#respon_seguimiento").parent().parent().hide();
		$("#cual_frecuencia").parent().parent().hide();
				
		$('[name="herramienta_ejercer"]').change(function(){
			if($(this).val()==1){
				$("#desc_herramienta").parent().parent().show();
				$('[name="anexar_herramienta[]"]').parent().parent().parent().show();
			}else{
				$("#desc_herramienta").parent().parent().hide();
				$('[name="anexar_herramienta[]"]').parent().parent().parent().hide();
			}
		});
		
		$('[name="procedimiento_herram"]').change(function(){
			if($(this).val()==1){
				$("#desc_documento").parent().parent().show();
				$('[name="anexar_documento[]"]').parent().parent().parent().show();
			}else{
				$("#desc_documento").parent().parent().hide();
				$('[name="anexar_documento[]"]').parent().parent().parent().hide();
			}
		});
		
		$('[name="responsables_ejecuci"]').change(function(){
			if($(this).val()==1){
				$("#responsable_seg").parent().parent().show();
				$("#respon_seguimiento").parent().parent().show();
			}else{
				$("#responsable_seg").parent().parent().hide();
				$("#respon_seguimiento").parent().parent().hide();
			}
		});
		
		$('[name="frecuencia_ejecucion"]').change(function(){
			if($(this).val()==1){
				$("#cual_frecuencia").parent().parent().show();
			}else{
				$("#cual_frecuencia").parent().parent().hide();
			}
		});
		
	});
	$('input[name$="tipo_control"]').click(function(){
		
		if($(this).val()=="1"){
			$('input[name$="desplazamiento"]').val("1");
		}
		if($(this).val()=="2"){
			$('input[name$="desplazamiento"]').val("2");
		}
	});
	</script>
	<?php
}

function validar_revision_aprobacion_control_riesgos($idformato, $iddoc){
	/*global $conn, $ruta_db_superior;
	echo(librerias_notificaciones());		
	
	$proceso = busca_filtro_tabla("a.documento_iddocumento, a.fecha_aprobacion_riesgo,a.fecha_revision_riesgo,a.nombre","
ft_proceso a, ft_riesgos_proceso b","a.idft_proceso=b.ft_proceso AND b.documento_iddocumento=".$_REQUEST['anterior'],"");
	
	if($proceso[0]['fecha_aprobacion_riesgo'] && $proceso[0]['fecha_revision_riesgo']){	
?>
<script type="text/javascript">
$(document).ready(function(){
	notificacion_saia('Los riesgos del proceso <b><?php echo($proceso[0]['nombre']);?></b> est&aacute;n aprobados y revisados.<br /> no es posible adicionar mas Valoraciones control riesgos','warning','',6500);
})
</script>
<?php	
	abrir_url($ruta_db_superior.'formatos/proceso/mostrar_proceso.php?iddoc='.$proceso[0]['documento_iddocumento'].'&idformato=9','_self');
	}*/
}
function validar_tipo_riesgo($idformato, $iddoc){
	
	
	/*if($iddoc){
		$tipo_riesgo = busca_filtro_tabla("lower(b.tipo_riesgo) as tipo_riesgo, a.responsables_ejecucion, a.frecuencia_ejecucion","ft_control_riesgos a, ft_riesgos_proceso b","a.ft_riesgos_proceso=b.idft_riesgos_proceso AND a.documento_iddocumento=".$iddoc,"");	
		
		if($tipo_riesgo[0]['tipo_riesgo'] != 'corrupcion'){
			$tabla ='
						<tr>
							<td class="encabezado_list" style="text-align: center;" colspan="2">SEGUIMIENTO AL CONTROL</td>
						</tr>
						<tr>
							<td class="encabezado_list" style="text-align: left;">4. Estan definidos los responsables de la ejecuci&oacute;n del control y del seguimiento?</td>';
							$responsable = 'No';
							if($tipo_riesgo[0]['responsables_ejecucion'] == 1){
								$responsable = 'Si';
							}
			$tabla .=       '<td>'.$responsable.'</td>
						</tr>
						<tr>
							<td class="encabezado_list" style="text-align: left;">5. La frecuencia de la ejecuci&oacute;n del control y seguimiento es adecuado?</td>';
							
							$frecuencia = 'No';
							if($tipo_riesgo[0]['frecuencia_ejecucion'] == 1){
								$frecuencia = 'Si';
							}
							
			$tabla	.=		'<td>'.$frecuencia.'</td>
						<tr>';		
		}
		
		echo($tabla);
	}elseif($_REQUEST['anterior']){
		$tipo_riesgo = busca_filtro_tabla("lower(tipo_riesgo) as tipo_riesgo","ft_riesgos_proceso","documento_iddocumento=".$_REQUEST['anterior'],"");
	}elseif($_REQUEST['iddoc']){
		$tipo_riesgo = busca_filtro_tabla("lower(b.tipo_riesgo) as tipo_riesgo","ft_control_riesgos a, ft_riesgos_proceso b","a.ft_riesgos_proceso=b.idft_riesgos_proceso AND a.documento_iddocumento=".$_REQUEST['iddoc'],"");
	}
	
	if($tipo_riesgo[0]['tipo_riesgo'] == 'corrupcion'){
	
?>
<script type="text/javascript">
	$(document).ready(function(){	
		$("input[name='responsables_ejecucion']").removeClass('required');
		$("input[name='frecuencia_ejecucion']").removeClass('required');
		$("input[name='responsables_ejecucion']").parent().parent().parent().parent().parent().parent().parent().hide();
		$("input[name='frecuencia_ejecucion']").parent().parent().parent().parent().parent().parent().parent().hide();	
	});
</script>
<?php
	} */ 
}

function botones_valoracion_riesgos($idformato, $iddoc){
  global $ruta_db_superior;
  if($_REQUEST['tipo']!=5){
  $control = busca_filtro_tabla("a.documento_iddocumento","ft_riesgo_proceso a, ft_control_riesgos b","a.idft_riesgos_proceso=b.ft_riesgos_proceso AND b.documento_iddocumento=".$iddoc,"");
  $ejecutor=busca_filtro_tabla("ejecutor","documento","iddocumento=".$iddoc,"");
 $area=busca_filtro_tabla("b.area_responsable","ft_control_riesgos a, ft_riesgos_proceso b","a.ft_riesgos_proceso=b.idft_riesgos_proceso and a.documento_iddocumento=".$iddoc,"");  
  $funcionario=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc","iddependencia in (".$area[0]["area_responsable"].")","group by funcionario_codigo");
		
	if(usuario_actual("funcionario_codigo")==$ejecutor[0]["ejecutor"]){
	  		$boton  = '<button type="button" id = "editar_valoracion_riesgo">Editar</button>';
			$boton .= '<button type="button" id = "eliminar_valoracion_riesgo" >Eliminar</button>';
			echo ($boton);
  	}else{
		for ($i=0; $i <$funcionario["numcampos"] ; $i++) { 
			if(usuario_actual("funcionario_codigo")==$funcionario[$i]["funcionario_codigo"]){
				$boton  = '<button type="button" id = "editar_valoracion_riesgo">Editar</button>';
				$boton .= '<button type="button" id = "eliminar_valoracion_riesgo" >Eliminar</button>';
				echo ($boton);
			}		
	  	}
	 }
?>
<script type="text/javascript">
  $(document).ready(function(){    
    
    $("#editar_valoracion_riesgo").click(function(){
      window.open("<?php echo($ruta_db_superior);?>formatos/control_riesgos/editar_control_riesgos.php?iddoc=<?php echo($iddoc); ?>&idformato=<?php echo($idformato);?>","_self");
    });
    
    $("#eliminar_valoracion_riesgo").click(function(){        
      $.ajax({
        url: 'cambiar_estado_documento_riesgo.php',
        type: 'POST',
        dataType: 'json',
        data: {
          iddocumento: '<?php echo($iddoc); ?>'      
        },
        success: function(result){
        window.open("<?php echo($ruta_db_superior);?>/formatos/riesgos_proceso/mostrar_riesgos_proceso.php?iddoc=<?php echo($control[0]["documento_iddocumento"]); ?>&idformato=13","_self");  
        }
    });
  });
 });
</script>
<?php
}
}

function registrar_edicion_documento($idformato, $iddoc){ 

$nombre  = usuario_actual('nombres').' '.usuario_actual('apellidos');
$mensaje = 'Se edita el documeto por el funcionario '.$nombre;  
registrar_accion_digitalizacion($iddoc,'EDICI&Oacute;N DEL DOCUMENTO',$mensaje);
}
?>