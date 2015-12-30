<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");
//ini_set("display_errors", true);

function total_horas($idformato,$iddoc){
	global $conn;
	$hora_salida = busca_filtro_tabla("fecha_salida, hora_salida","ft_datos_solicitante","documento_iddocumento=".$iddoc,"",$conn);
	$hora_entrada = busca_filtro_tabla("fecha_entrada, hora_entrada","ft_datos_solicitante","documento_iddocumento=".$iddoc,"",$conn);
	$fecha_final=$hora_entrada[0]["fecha_entrada"]." ".$hora_entrada[0]['hora_entrada'];
	$fecha_inicial=$hora_salida[0]["fecha_salida"]." ".$hora_salida[0]['hora_salida'];
	$seg=strtotime($fecha_final) - strtotime($fecha_inicial);

	$h = floor(($seg - ($d * 86400)) / 3600);
	$m = floor(($seg - ($d * 86400) - ($h * 3600)) / 60);

	$s = $seg % 60;
	if($h<10){ $h="0".$h; }
	if($m<10){ $m="0".$m; }
	if($s<10){ $s="0".$s; }

	$cadena='<br>';
	if($h!=0){
	$cadena.="$h";
	}	
	if($m!=0){
$cadena.="$m";
}	

echo $cadena;


}

function ocultar_mostrar_motivo($idformato, $iddoc){	
?>	
	<script>	
		$(document).ready(function(){
				$('#motivo_permiso').parent().parent().hide();
			$('#motivo_salida0').click(function(){
				$('#motivo_permiso').parent().parent().show();
			});	
			$('#motivo_salida1').click(function(){
				$('#motivo_permiso').parent().parent().show();
			});
			$('#motivo_salida2').click(function(){
				$('#motivo_permiso').parent().parent().hide();
			});
				$('#motivo_salida3').click(function(){
				$('#motivo_permiso').parent().parent().hide();
			});
				$('#motivo_salida4').click(function(){
				$('#motivo_permiso').parent().parent().hide();
			});
		});
	</script>
<?php
}

function mostrar_nombre_apellido_funcionario($idformato, $iddoc){
	global $conn;
	$dependencia= busca_filtro_tabla("","ft_datos_solicitante","documento_iddocumento=".$iddoc,"",$conn);
	$dependencia2=$dependencia[0]['dependencia'];
	$datos= busca_filtro_tabla("","vfuncionario_dc","iddependencia_cargo=".$dependencia2,"",$conn);
  echo(" ".$datos[0]['nombres']." ".$datos[0]['apellidos']);
}
function mostrar_codigo_nomina_funcionario($idformato, $iddoc){
	global $conn;
	$dependencia= busca_filtro_tabla("","ft_datos_solicitante","documento_iddocumento=".$iddoc,"",$conn);
	$dependencia2=$dependencia[0]['dependencia'];
	$datos= busca_filtro_tabla("funcionario_codigo","vfuncionario_dc","iddependencia_cargo=".$dependencia2,"",$conn);
  echo(" ".$datos[0]['funcionario_codigo']);
}
function mostrar_cargo_dependencia_funcionario($idformato, $iddoc){
	global $conn;
	$dependencia= busca_filtro_tabla("","ft_datos_solicitante","documento_iddocumento=".$iddoc,"",$conn);
	$dependencia2=$dependencia[0]['dependencia'];
	$datos= busca_filtro_tabla("","vfuncionario_dc","iddependencia_cargo=".$dependencia2,"",$conn);
  echo(" ".$datos[0]['cargo']." ".$datos[0]['dependencia']);
}
function validar_fecha_menor_formato_autorizacion_salida($idformato,$iddoc){
	?>
		<script>
			$(document).ready(function(){
				$("#formulario_formatos").validate({
					submitHandler: function(form){
					var fecha_salida=$('#fecha_salida').val();
					var fecha_entrada=$('#fecha_entrada').val();
					salida= new Date(fecha_salida);
        	entrada= new Date(fecha_entrada);
        	if(entrada<salida){
        	alert('La fecha de entrada debe de ser mayor a la fecha de salida');
        	}
        }
				});
			});
		</script>
	<?php
}
function crear_ruta_aprobacion_formato_aut_salida($idformato,$iddoc){
	global $conn;
	$ruta=array();
	$datos=busca_filtro_tabla("motivo_salida","ft_datos_solicitante a","a.documento_iddocumento=".$iddoc,"",$conn);
	$usuario = usuario_actual("funcionario_codigo");
		
	array_push($ruta,array("funcionario"=>$usuario,"tipo_firma"=>0));
	
	if($datos[0]["motivo_salida"]==1122){//Autorizador salud ocupacional
		$cargo1 = busca_filtro_tabla("a.funcionario_codigo","vfuncionario_dc a","lower(a.cargo) like '%autorizador salud ocupacional%' and a.estado=1 and a.estado_dc=1","",$conn);
		array_push($ruta,array("funcionario"=>$cargo1[0]["funcionario_codigo"],"tipo_firma"=>1));
	}
	$cargo2 = busca_filtro_tabla("a.funcionario_codigo","vfuncionario_dc a","lower(a.cargo) like '%jefe autorizador salida%' and a.estado=1 and a.estado_dc=1","",$conn);
	array_push($ruta,array("funcionario"=>$cargo2[0]["funcionario_codigo"],"tipo_firma"=>1));
	
	$cargo3 = busca_filtro_tabla("a.funcionario_codigo","vfuncionario_dc a","lower(a.cargo) like '%gerente autorizador salida%' and a.estado=1 and a.estado_dc=1","",$conn);
	array_push($ruta,array("funcionario"=>$cargo3[0]["funcionario_codigo"],"tipo_firma"=>1));
	if(count($ruta)>1){
		$radicador_salida=busca_filtro_tabla("f.funcionario_codigo",DB.".configuracion c,".DB.".funcionario f","c.nombre='radicador_salida' and f.login=c.valor","",$conn);
		array_push($ruta,array("funcionario"=>$radicador_salida[0][0],"tipo_firma"=>0));
	}
	insertar_ruta_cierre($ruta,$iddoc);
}
function insertar_ruta_cierre($ruta,$iddoc){
  global $conn;
  for($i=0;$i<count($ruta)-1;$i++){
    if(!isset($ruta[$i]["tipo_firma"]))
      $ruta[$i]["tipo_firma"]=1;
    $sql="insert into ".DB.".ruta(destino,origen,documento_iddocumento,condicion_transferencia,tipo_origen,tipo_destino,orden,obligatorio) values('".$ruta[$i+1]["funcionario"]."','".$ruta[$i]["funcionario"]."','$iddoc','POR_APROBAR',1,1,$i,".$ruta[$i]["tipo_firma"].")" ;
    phpmkr_query($sql);
    $idruta=phpmkr_insert_id();
    $sql="insert into ".DB.".buzon_entrada(origen,destino,archivo_idarchivo,activo,tipo_origen,tipo_destino,ruta_idruta,nombre) values('".$ruta[$i+1]["funcionario"]."','".$ruta[$i]["funcionario"]."','$iddoc',1,1,1,$idruta,'POR_APROBAR')" ;
    phpmkr_query($sql);
  }
}
function terminar_actividad_manual_sol($idformato,$iddoc){
	global $conn;
	$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
	$ruta_db_superior=$ruta="";
	while($max_salida>0){
	  if(is_file($ruta."db.php")){
	    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	  }
	  $ruta.="../";
	  $max_salida--;
	}
	$datos=busca_filtro_tabla("","ft_datos_solicitante a, documento b","a.documento_iddocumento=".$iddoc." and a.documento_iddocumento=b.iddocumento","",$conn);
	if($datos[0]["motivo_salida"]==1122){
		if(usuario_actual('funcionario_codigo')==$datos[0]["ejecutor"]){
  		include_once($ruta_db_superior."workflow/libreria_paso.php");
  		$paso_documento=busca_filtro_tabla("","paso_documento a","a.documento_iddocumento=".$iddoc." AND estado_paso_documento=4","idpaso_documento desc",$conn);
  		$actividad_paso=busca_filtro_tabla("","paso_actividad","descripcion LIKE 'Informaci&oacute;n EPS'","",$conn);
      if($actividad_paso["numcampos"]){
        terminar_actividad_paso($iddoc,"",1,$paso_documento[0]["idpaso_documento"],$actividad_paso[0]["idpaso_actividad"]);  
      }
		}
	}
}
function mostrar_campos_fecha_motivo_documento($idformato, $iddoc){
	global $conn;
	$campos= busca_filtro_tabla("","ft_datos_solicitante","documento_iddocumento=".$iddoc,"",$conn);
	$serie= busca_filtro_tabla("","serie","idserie=".$campos[0]['motivo_salida'],"",$conn);
	$cadena='Motivo: '.$serie[0]["nombre"].'<br/>Fecha Salida: '.$campos[0]["fecha_salida"].'<br/>Hora Salida '.$campos[0]["hora_salida"].'<br/> Fecha entrada: '.$campos[0]["fecha_entrada"].'<br/>Hora Entrada: '.$campos[0]["hora_entrada"];
	$sql='Update documento SET descripcion="'.$cadena.'" Where iddocumento='.$iddoc;
	phpmkr_query($sql);
}
function transferir_porteria($idformato,$iddoc){
  global $conn,$ruta_db_superior;
  include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
  $porteria=busca_filtro_tabla("","vfuncionario_dc","lower(cargo)='porteria'","",$conn);
  if($porteria["numcampos"]){
    transferencia_automatica($idformato,$iddoc,$porteria[0]["funcionario_codigo"],3);
  }
}
function hora_entrada_reportada($idformato,$iddoc){
   global $conn;
   $paso_documento=busca_filtro_tabla("","paso_documento A, diagram_instance B, paso_enlace C","A.diagram_iddiagram_instance=B.iddiagram_instance AND  B.diagram_iddiagram=C.diagram_iddiagram AND A.documento_iddocumento=".$iddoc." AND (A.estado_paso_documento=2 OR A.estado_paso_documento=1) AND C.destino=-2 AND C.origen=A.paso_idpaso","idpaso_documento desc",$conn);
   $fecha_final='<br>No reportada';
   if($paso_documento["numcampos"]){
    $fecha_final="<br>".$paso_documento[0]["fecha"];
   }
   echo($fecha_final);
}



function ver_boton_cierre($idformato,$iddoc){
   global $conn;
	$porteria=busca_filtro_tabla("","ft_datos_solicitante","documento_iddocumento=".$iddoc,"",$conn);
	
	
	if($porteria[0]['fecha_control']=='' and  $porteria[0]['control_interno']==''){
		echo('<input type="button" id="cerrar" value="Autorizar"><div id="valores"></div>');
	}
	else{
		$fun=busca_filtro_tabla("","vfuncionario_dc","funcionario_codigo=".$porteria[0]['control_interno'],"",$conn);
		
		echo $fun[0]['nombres'].' '.$fun[0]['apellidos'].'<br>'.$porteria[0]['fecha_control'];
	}
	
	$user=usuario_actual('funcionario_codigo');
	
?>
    <script type="text/javascript">
        $(document).ready(function(){
                $("#cerrar").click(function () {
                	var user='<?php echo $user; ?>';
                	var doc='<?php echo $iddoc; ?>';
                    $.ajax({
                        type:'POST',
                        dataType: 'json',
                        url: "actualizar_cierre.php",
                        data: {
                                        usuario:user,
                                        iddoc:doc
                                        
                        },
                        success: function(datos){
                        	 $("#cerrar").hide();
                        	 $('#valores').html(datos.cadena);
                        	 
                        }
                    });      
                });
            });
    </script>
<?php	
	
}



?>