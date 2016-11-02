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
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."class_transferencia.php");	
echo(librerias_notificaciones());

function recibir_datos($idformato, $iddoc){
	global $ruta_db_superior, $conn;
	$datos_correo = json_decode($_REQUEST['datos_correo']);
	$asunto = $datos_correo->asunto;
	$contenido = $datos_correo->contenido;
	$de = $datos_correo->from;
	$para = $datos_correo->to;
  	$fecha= $datos_correo->fecha_oficio_entrada;
	$anexos = $datos_correo->anexos;
	
	$lista_anexo=array_pop(explode("/",$anexos));
	print_r($lista_anexo);
	$tipo_radicado=$datos_correo->tipo_radicado;
	if($tipo_radicado=="Sent"){
		$tipo_radicado="radicacion_salida";	
	}else if($tipo_radicado=="INBOX"){//INBOX
		$tipo_radicado="radicacion_entrada";
	}else {
		$tipo=explode("/",$tipo_radicado);
		if($tipo[1]=='Enviados');
		$tipo_radicado="radicacion_salida";
	}

	$cadena_anexos='';
  if($anexos){
  	$cadena_anexos='<tr><td class="encabezado">Anexos</td><td>';
  	$cant_anexo=explode(",",$anexos);
  	for ($i=0; $i <count($cant_anexo) ; $i++) { 
		  $cadena_anexos.="<li>".array_pop(explode("/",$cant_anexo[$i]))."</li>";
	  }

    $cadena_anexos.="</td></tr>";
  }
	    
 /* if($anexos){
    $cadena_anexos='<tr><td class="encabezado">Anexos</td><td>';
    $cadena_anexos.="<li>".implode("</li><li>",explode(",",$anexos))."</li>";
    $cadena_anexos.="</td></tr>";
  }*/
?>
<script type="text/javascript">
	$(document).ready(function(){

			$('#asunto').val('<?php echo($asunto);?>');
			$('#de').val('<?php echo($de);?>');
			$("input[name=tipo_radicado]").val('<?php echo($tipo_radicado);?>');
			$('#para').val('<?php echo($para);?>');
			$('input[name=anexos]').val('<?php echo($anexos);?>');
			$('#fecha_oficio_entrada').val('<?php echo($fecha);?>');
			$("#formulario_formatos").find("tr:last").prev().prev().after('<?php echo($cadena_anexos);?>');
	});
	
</script>
<?php
}
function guardar_anexos($idformato, $iddoc){
	  
	  require_once($ruta_db_superior."anexosdigitales/funciones_archivo.php");    
    //require_once($ruta_db_superior."pantallas/lib/librerias_adicionales.php");
    //require_once($ruta_db_superior."pantallas/ocr/librerias.php");
    
    $datos=busca_filtro_tabla('','ft_correo_saia','documento_iddocumento='.$iddoc,'',$conn);
    $vector=explode(',',$datos[0]['anexos']);
    //$vector=$datos[0]['anexos'];
	
    for($i=0;$i<count($vector);$i++){
        $dir_anexos=selecciona_ruta_anexos("",$iddoc,'archivo');
		//print_r($dir_anexos."-----");
        
        $ruta_real=array('');
        $ruta_real[1]=$vector[$i];
     
        //$ruta_real[1]='index.jpeg';
        $archivo_actual = basename($ruta_db_superior.$ruta_real[1]);    
        $vec_ext=explode('.',$archivo_actual);
        $extencion=$vec_ext[1];
        $nombre_temporal=time().".".$extencion;
        mkdir($ruta_db_superior.$dir_anexos,0777);
        
          $tmpVar = 1;
            while(file_exists($ruta_db_superior.$dir_anexos. $tmpVar . '_' . $nombre_temporal)){
                $tmpVar++;
            }
          $nombre_temporal=$tmpVar . '_' . $nombre_temporal;    
        
         //print_r($ruta_real[1]."<------->".$dir_anexos.$nombre_temporal);
       // die();          
        //copy($ruta_db_superior.$ruta_real[1],$ruta_db_superior.$dir_anexos.$nombre_temporal);
		rename($ruta_db_superior.$ruta_real[1], $ruta_db_superior.$dir_anexos.$nombre_temporal);
		
// 		
		// print_r($dir_anexos);
        
 $sql="INSERT INTO anexos(documento_iddocumento,ruta,tipo,etiqueta,fecha_anexo,formato,campos_formato) values(".$iddoc.",'".$dir_anexos.$nombre_temporal."','".$extencion."','".$archivo_actual."'".",".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",'".$idformato."','7358')";        
         phpmkr_query($sql,$conn);
        $idanexo=phpmkr_insert_id();
        
        $sql1="insert into permiso_anexo(anexos_idanexos, idpropietario, caracteristica_propio, caracteristica_total)values('".$idanexo."', '".usuario_actual('idfuncionario')."', 'lem', 'l')";
        phpmkr_query($sql1);
          /*  DESARROLLO NUEVA TABLA anexos_adicionales  */

    }
}

function despachar_correo($idformato,$iddoc){
	global $ruta_db_superior,$conn;
	
	$tipo=busca_filtro_tabla("tipo_radicado","documento","iddocumento=".$iddoc,"",$conn);
	
	if($tipo[0]["tipo_radicado"]=="2"){
		despachar_documento($iddoc);
	}
}

function redirreciona_correo($idformato,$iddoc){
	global $ruta_db_superior,$conn;
	$numero=busca_filtro_tabla("numero","documento","iddocumento=".$iddoc,"",$conn);
?>
<script>
notificacion_saia('El documento ha sido radicado con el numero <?php echo($numero[0]["numero"]); ?>','success','',4000);
</script>
<?php
	redirecciona($ruta_db_superior."index_correo.php");
}


function despachar_documento($iddoc){
  
  
  $_REQUEST["lista_despachos"]=$iddoc;
  $_REQUEST["x_empresa0"]=usuario_actual("nombres")." ".usuario_actual("apellidos");
  $_REQUEST["guia"]="0";
  $_REQUEST["x_responsable0"]=usuario_actual("nombres")." ".usuario_actual("apellidos");

  global $conn,$sql; 
  $notificacion = false;
  $envio = busca_filtro_tabla("valor","configuracion","nombre='correo_despacho'","",$conn);
  if($envio["numcampos"]>0 && $envio[0]["valor"]==1)
   $notificacion = true;
  $destinos=explode(",",$_REQUEST["lista_despachos"]);
  $empresa=@$_REQUEST["x_empresa0"];
  $guia=@$_REQUEST["guia"];
  $responsable=htmlentities(htmlspecialchars_decode(html_entity_decode(utf8_decode(trim($_REQUEST["x_responsable0"])))));
  $lresponsable=busca_filtro_tabla("A.*","ejecutor A","A.nombre LIKE '".$responsable."'","",$conn); 
  if($lresponsable["numcampos"] ){
    $idresponsable=$lresponsable[0]["idejecutor"];
  } 
  else if($responsable<>"")
  {
    $sql="INSERT INTO ejecutor(nombre) VALUES('".$responsable."')";    
    phpmkr_query($sql,$conn);
    $idresponsable=phpmkr_insert_id();
  }  
  $lempresa=busca_filtro_tabla("A.*","ejecutor A","A.nombre LIKE'".$empresa."'","",$conn); 
  if($lempresa["numcampos"] ){
    $idempresa=$lempresa[0]["idejecutor"];
  }
  else if($empresa<>""){
    $sql="INSERT INTO ejecutor(nombre) VALUES('".$empresa."')";
    phpmkr_query($sql,$conn);
    $idempresa=phpmkr_insert_id();
  }  
  if($idresponsable<>"" ){
    $datos["origen"]=usuario_actual("funcionario_codigo");
    $enviado=usuario_actual("login");
    for($i=0;$i<count($destinos);$i++){
    	$ejecutores=array();
      $ejecutor["numcampos"]=0;
      $ejecutor=busca_filtro_tabla("ejecutor","documento","iddocumento=".$destinos[$i],"",$conn);
      if($ejecutor["numcampos"]){
        array_push($ejecutores,$ejecutor[0]["ejecutor"]);
        $ejecutores=array_unique($ejecutores);
      }
      if($idempresa=="")
         $valores="'".$guia."','".$destinos[$i]."',NULL,'$idresponsable'";
      elseif($idresponsable=="")
         $valores="'".$guia."','".$destinos[$i]."','".$idempresa."',NULL";
      else 
         $valores="'".$guia."','".$destinos[$i]."','".$idempresa."','$idresponsable'";    
      $valores.= ",".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s"); 
      $sql="INSERT INTO salidas(numero_guia,documento_iddocumento,empresa,responsable,fecha_despacho,tipo_despacho) VALUES (".$valores.",'1')";
      //die($sql);
      phpmkr_query($sql,$conn);
       $sql="update documento set estado='GESTION',tipo_despacho='1' where iddocumento=".$destinos[$i];      
      phpmkr_query($sql,$conn);
      $datos["archivo_idarchivo"]=$destinos[$i];
      $datos["tipo_destino"]=1;
      $datos["tipo"]="";
      $datos["nombre"]="DISTRIBUCION";
     // $otros["notas"]="'Documento despachado En $empresa ($responsable) con Guia: $guia Por $enviado'";  
	  $otros["notas"]="Se despacho el documento por correo electronico";
      transferir_archivo_prueba($datos,$ejecutores,$otros);
      //Envio de notificacion sobre el despacho de un documento al ejecutor
      /*if($notificacion)
      {
      $documento_mns = busca_filtro_tabla("descripcion,plantilla","documento","iddocumento=".$destinos[$i],"",$conn);
      $mensaje = "Tiene un nuevo documento para su revision: Tipo: ".ucfirst($documento_mns[0]["plantilla"])." - Descripcion: ".$documento_mns[0]["descripcion"];
      $x_tipo_envio[] = 'msg';
      $x_tipo_envio[] = 'e-interno';                         
      $destino_mns[0] = $ejecutores;             
      enviar_mensaje("origen",$destino_mns,$mensaje);
     } */
    }
  }
  else {
    alerta("No se puede realizar el despacho");
  }
	
}
function transferencia_copia_correo($idformato,$iddoc){
	global $conn;
	transferencia_automatica($idformato,$iddoc,"copia_correo",2,'COPIA');
}
function mostrar_anexos_correo($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	require_once($ruta_db_superior."anexosdigitales/funciones_archivo.php"); 
	$datos=busca_filtro_tabla('','anexos','documento_iddocumento='.$iddoc,'',$conn);
	if($datos['numcampos']){
		$anexo="<br/><br/><b>Anexos: </b><br/>";
		for($i=0;$i<$datos['numcampos'];$i++){
			if($_REQUEST['tipo']!=5){	
				if($datos[$i]['tipo']=='jpg' || $datos[$i]['tipo']=='png' || $datos[$i]['tipo']=='pdf'){
					$anexo.="<a href='".$ruta_db_superior.$datos[$i]['ruta']."' target='_self'>".$datos[$i]['etiqueta']."</a><br/>";
				}else{
					$anexo.='<a href="'.$ruta_db_superior.'anexosdigitales/parsea_accion_archivo.php?idanexo='.$datos[$i]['idanexos'].'&accion=descargar" border="0px">'.$datos[$i]['etiqueta']."</a><br/>";
				}
			}else{
				$anexo.=$datos[$i]['etiqueta']."<br/>";
			}
		}
		echo $anexo;
	}
}
?>