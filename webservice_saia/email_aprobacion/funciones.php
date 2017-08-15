<?php
@set_time_limit(0);
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
if(!@$_SESSION["LOGIN".LLAVE_SAIA]){
	@session_start();
	$_SESSION["LOGIN".LLAVE_SAIA]="cerok";
	$_SESSION["usuario_actual"]="1";
	$usuactual=$_SESSION["LOGIN".LLAVE_SAIA];
	global $usuactual;
}
include_once($ruta_db_superior."class_transferencia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_acciones.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");

function ejecuta_funciones($datos){
	global $conn;
	$datos = json_decode($datos,true);
	if($datos['accion']=="REVISADO"){
		llama_funcion_accion($datos['iddoc'],$datos['idformato'],"confirmar","POSTERIOR");
	}else if($datos['accion']=="APROBADO"){
		$borrar_pdf="UPDATE documento set pdf='' where iddocumento=".$datos['iddoc'];
		phpmkr_query($borrar_pdf);
		$ch = curl_init();
	  $fila = "".PROTOCOLO_CONEXION.RUTA_PDF_LOCAL."/class_impresion.php?plantilla=carta&iddoc=".$datos['iddoc']."&conexion_remota=1&conexio_usuario=".$_SESSION["LOGIN".LLAVE_SAIA]."&usuario_actual=".$_SESSION["usuario_actual"]."&LOGIN=".$_SESSION["LOGIN".LLAVE_SAIA]."&LLAVE_SAIA=".LLAVE_SAIA;
        if (strpos(PROTOCOLO_CONEXION, 'https') !== false) {	  
	  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
	  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	  }
	  curl_setopt($ch, CURLOPT_URL,$fila);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	  $contenido=curl_exec($ch);
	  curl_close ($ch);
		llama_funcion_accion($datos['iddoc'],$datos['idformato'],"aprobar","POSTERIOR");
	}
}
function validar_login_ingreso($datos){
  global $conn,$ruta_db_superior,$usuactual;
  $datos = json_decode($datos);
  $retorno=array();
  $retorno['exito']=0;
  $retorno['destino']=0;
  if($datos->ingreso==1 && $datos->iddoc!=0){
    if($datos->login!="" && $datos->password!=""){
      $verifica=busca_filtro_tabla("clave,estado,funcionario_codigo","funcionario","login='".$datos->login."'","",$conn);
      $clave=trim($datos->password);
			$clave_encriptada=md5(md5($clave));
      if(trim($verifica[0]['clave'])==$clave_encriptada){
          $valida_iddoc=busca_filtro_tabla("estado","documento","iddocumento=".$datos->iddoc,"",$conn);
          if($valida_iddoc[0]['estado']=='ACTIVO'){
            $usuario_confirma=busca_filtro_tabla("destino","buzon_entrada","nombre='POR_APROBAR' and activo=1 and archivo_idarchivo=".$datos->iddoc,"idtransferencia asc",$conn);
            if($usuario_confirma[0]['destino']==$verifica[0]['funcionario_codigo']){
            	$retorno['destino']=$usuario_confirma[0]['destino'];
              $_SESSION["LOGIN"]=$datos->login;
              $_SESSION["usuario_actual"]=$verifica[0]['funcionario_codigo'];
			        $usuactual=$_SESSION["LOGIN"];
              $idformato=busca_filtro_tabla("idformato","formato f,documento d","lower(f.nombre)=lower(d.plantilla) and iddocumento=".$datos->iddoc,"",$conn);
              $retorno['idformato']=$idformato[0]['idformato'];
              if($datos->accion==2){
              	$_REQUEST["x_notas"]=$datos->notas;
                $retorno['exito']=1;
								$retorno['accion']="DEVOLUCION";
                $usuario_devolucion=busca_filtro_tabla("destino","buzon_entrada","nombre='POR_APROBAR' and activo=0 and origen=".$usuario_confirma[0]['destino']." and archivo_idarchivo=".$datos->iddoc,"idtransferencia asc",$conn);

                //$retorno['msn']="Documento Devuelto!";
				 $retorno['msn']="Saludos,<br/><br/>
				Usted ha RECHAZADO el documento, se notificará al responsable de elaboración para que realice la gestión respectiva.<br/><br/>
				Gracias por su gestión.";

                $_REQUEST['iddoc']=$datos->iddoc;
                $_REQUEST["x_nombre"]="DEVOLUCION";
                $_REQUEST["x_funcionario_destino"]=$usuario_devolucion[0]['destino'];
								$_REQUEST['refrescar']=1;
                devolucion2();
              }else{
              	$_REQUEST['refrescar']=1;
                $iddocumento=aprobar2($datos->iddoc);// la funcion tiene comentariado las acciones o funciones "llama_funcion_accion"
                $retorno['accion']=$iddocumento['accion'];
                $retorno['exito']=1;
								$retorno['iddoc']=$datos->iddoc;
                //$retorno['msn']="Documento Gestionado";
                  $retorno['msn']="Saludos,<br/><br/>
									Usted ha APROBADO el documento con número de radicado ".$iddocumento['numero'].".<br/><br/>
									Gracias por su gestión.
					";

              }
            }else{
              $retorno['msn']="El documento NO se encuentra en su Bandeja";
            }
          }else{
            $retorno['msn']="El documento NO se encuentra Activo";
          }
      }else{
        $retorno['msn']="Clave o Usuario Incorrecto";
      }
    }else{
      $retorno['msn']="Ingrese los Datos";
    }
  }else{
     $retorno['msn']="Por Favor ingrese nuevamente desde el link enviado al correo";
  }
	@session_destroy();
  $datos_retorno = json_encode($retorno);
  return($datos_retorno);
}

function devolucion2(){
  global $conn,$ruta_db_superior;
  $theValue = ($_REQUEST["iddoc"] != "") ? intval($_REQUEST["iddoc"]) : "NULL";
  $datos["archivo_idarchivo"] = $theValue;
  $datos["tipo_destino"]=1;
  $datos["tipo"]="";
  $datos["ruta_idruta"]="";
  if(isset($_REQUEST['campo_reemplazo']) && $_REQUEST['campo_reemplazo']!=0 && isset($_REQUEST['campo_idruta']) && $_REQUEST['campo_idruta']!=0 ){
    include_once($ruta_db_superior."pantallas/reemplazos/procesar_reemplazo.php");
    actualiza_ruta_devolucion($_REQUEST['campo_reemplazo'],$datos["archivo_idarchivo"],$_REQUEST['campo_idruta']);
  }
  $idformato=busca_filtro_tabla("idformato","formato f,documento d","lower(f.nombre)=lower(d.plantilla) and iddocumento=".$datos["archivo_idarchivo"],"",$conn);
  //llama_funcion_accion($datos["archivo_idarchivo"],$idformato[0]["idformato"],"devolver","ANTERIOR");
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($_REQUEST["x_nombre"]) : $_REQUEST["x_nombre"];
  $theValue = ($theValue != "") ? $theValue : "NULL";
  $datos["nombre"] = $theValue;
  $destino=explode(",",$_REQUEST["x_funcionario_destino"]);
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($_REQUEST["x_notas"]) : $_REQUEST["x_notas"];
  $theValue = ($theValue != "") ? $theValue : NULL;
  $adicionales["notas"] = "'".$theValue."'";
  $documento = busca_filtro_tabla("","documento","iddocumento=".$datos["archivo_idarchivo"],"",$conn);
  $temp="";
  if($documento["numcampos"]>0)
  {
    $temp=$documento[0]["serie"];
    $mensaje = "Acaba de Recibir el Documento: ".$documento[0]["numero"]." Descripcion: ".$documento[0]["descripcion"];
  }
  /*transferir_archivo_prueba($datos,$destino,$adicionales);
  $estado_doc = busca_filtro_tabla("estado","documento","iddocumento=".$_REQUEST["iddoc"],"",$conn);
  if($estado_doc[0]["estado"]=='ACTIVO')
  { $update="update buzon_entrada set activo=1 where archivo_idarchivo=".$_REQUEST["iddoc"]." AND nombre='POR_APROBAR' AND destino=".$_REQUEST["x_funcionario_destino"]." AND origen=".usuario_actual("funcionario_codigo");
    phpmkr_query($update,$conn);
  }
  llama_funcion_accion($datos["archivo_idarchivo"],$idformato[0]["idformato"],"devolver","POSTERIOR");*/

  //NUEVO DESARROLLO DEVOLVER

	$sql1=" UPDATE buzon_salida SET nombre='ELIMINA_REVISADO' WHERE archivo_idarchivo=".$_REQUEST["iddoc"]." AND origen=".$_REQUEST["x_funcionario_destino"]." AND destino=".usuario_actual('funcionario_codigo')." AND nombre='REVISADO'; ";
	phpmkr_query($sql1);

	$sql2=" UPDATE buzon_entrada SET nombre='ELIMINA_REVISADO' WHERE archivo_idarchivo=".$_REQUEST["iddoc"]." AND destino=".$_REQUEST["x_funcionario_destino"]." AND origen=".usuario_actual('funcionario_codigo')."  AND nombre='REVISADO';";
	phpmkr_query($sql2);

	$sql3=" UPDATE buzon_entrada SET activo=1 WHERE archivo_idarchivo=".$_REQUEST["iddoc"]." AND destino=".$_REQUEST["x_funcionario_destino"]." AND origen=".usuario_actual('funcionario_codigo')."  AND nombre='POR_APROBAR'; ";
	phpmkr_query($sql3);

	$sql4=" UPDATE asignacion SET tarea_idtarea=-1 WHERE documento_iddocumento=".$_REQUEST["iddoc"]." AND llave_entidad='".usuario_actual('funcionario_codigo')."'; ";
	phpmkr_query($sql4);


   $strsql = "INSERT INTO asignacion (tarea_idtarea,fecha_inicial,documento_iddocumento,serie_idserie,estado,entidad_identidad,llave_entidad)";
   $strsql .= "VALUES";
   $strsql .= "(2,'".date('Y-m-d H:i:s')."',".$_REQUEST["iddoc"].",0,'PENDIENTE',1,'".$_REQUEST["x_funcionario_destino"]."')";
   $sql5=$strsql;
   phpmkr_query($sql5);


   $strsql = "INSERT INTO buzon_entrada (archivo_idarchivo,nombre,destino,tipo_destino,fecha,origen,tipo_origen,notas,tipo,activo,ruta_idruta)";
   $strsql .= "VALUES";
   $strsql .= "(".$_REQUEST["iddoc"].",'DEVOLUCION','".usuario_actual('funcionario_codigo')."',1,'".date('Y-m-d H:i:s')."','".$_REQUEST["x_funcionario_destino"]."',1,'".$_REQUEST["x_notas"]."','ARCHIVO',0,0)";
   $sql6=$strsql;
   phpmkr_query($sql6);


   $strsql = "INSERT INTO buzon_salida (archivo_idarchivo,nombre,destino,tipo_destino,fecha,origen,tipo_origen,notas,tipo,ruta_idruta)";
   $strsql .= "VALUES";
   $strsql .= "(".$_REQUEST["iddoc"].",'DEVOLUCION','".$_REQUEST["x_funcionario_destino"]."',1,'".date('Y-m-d H:i:s')."','".usuario_actual('funcionario_codigo')."',1,'".$_REQUEST["x_notas"]."','ARCHIVO',0)";
   $sql7=$strsql;
   phpmkr_query($sql7);

   //FIN NUEVO DESARROLLO DEVOLVER
}
function aprobar2($iddoc=0,$url=""){
	global $conn;
  $transferir=1;
  if(isset($_REQUEST["iddoc"])&&$_REQUEST["iddoc"]){
  	$iddoc=$_REQUEST["iddoc"];
	}
	$tipo_radicado = busca_filtro_tabla("documento.*,contador.nombre,idformato,contador.consecutivo","documento,contador,formato","idcontador=tipo_radicado and iddocumento=".$iddoc." and lower(plantilla)=lower(formato.nombre)","",$conn);

  $formato=strtolower($tipo_radicado[0]["plantilla"]);

  $registro_actual=busca_filtro_tabla("A.*","buzon_entrada A","A.archivo_idarchivo=".$iddoc." and A.activo=1 and (A.nombre='POR_APROBAR') and A.destino=".$_SESSION["usuario_actual"],"A.idtransferencia",$conn);

  /*Se adiciona esta linea para las ejecutar las acciones sobre los formatos*/
  //llama_funcion_accion($iddoc,$tipo_radicado[0]["idformato"],"confirmar","ANTERIOR");

	if($registro_actual["numcampos"]>0){

		$registro_anterior=busca_filtro_tabla("A.*","buzon_entrada A","A.nombre='POR_APROBAR' and A.activo=1 and A.idtransferencia<".$registro_actual[0]["idtransferencia"]." and A.archivo_idarchivo=".$iddoc." and origen=".$_SESSION["usuario_actual"],"A.idtransferencia desc",$conn);

	$terminado=busca_filtro_tabla("A.*","buzon_entrada A","A.archivo_idarchivo=".$iddoc." and A.nombre='POR_APROBAR' and A.activo=1","A.idtransferencia",$conn);
		//realizar la transferencia
    if($registro_actual["numcampos"]>0 && $registro_anterior["numcampos"]==0){

    	$destino=$registro_actual[0]["destino"];
      $origen=$registro_actual[0]["origen"];
      //cambie count($terminado)

      if(($terminado["numcampos"]==$registro_actual["numcampos"]) || ($terminado["numcampos"]==1 && $terminado[0]["destino"]==$_SESSION["usuario_actual"])){
      	$estado="APROBADO";
			}else{
      	$estado="REVISADO";
			}

      $campos="archivo_idarchivo,nombre,origen,fecha,destino,tipo,tipo_origen,tipo_destino,ruta_idruta";

      //buzon de salida
      for($i=0;$i<$registro_actual["numcampos"];$i++){
      	//--------------Actualizacion para cuando se cree una ruta se le pueda mandar a una misma persona-----------
        $registro_intermedio= busca_filtro_tabla("A.*","buzon_entrada A","A.archivo_idarchivo=".$iddoc." and A.activo=1 and (A.nombre='POR_APROBAR') and idtransferencia<".$registro_actual[$i]["idtransferencia"],"A.idtransferencia",$conn);

        if($registro_intermedio["numcampos"]){
        	break;
				}

        $valores=$iddoc.",'$estado',".$registro_actual[$i]["destino"].",".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",".$registro_actual[$i]["origen"].",'DOCUMENTO',1,1";

        if($registro_actual[$i]["ruta_idruta"]<>""){
        	$valores.=",".$registro_actual[$i]["ruta_idruta"];
				}else{
        	$valores.=",''";
        }

			$sql_buzon_salida="INSERT INTO buzon_salida (".$campos.") VALUES (".$valores.")";
       phpmkr_query($sql_buzon_salida);
				$id_salida=phpmkr_insert_id();

				//buzon de entrada
        phpmkr_query("UPDATE buzon_entrada SET activo=0 WHERE idtransferencia=".$registro_actual[$i]["idtransferencia"],$conn);
        $valores=$iddoc.",'$estado',$origen,".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",$destino,'DOCUMENTO',1,1,";
			}

      if($registro_actual[0]["ruta_idruta"]<>""){
      	$valores.=$registro_actual[0]["ruta_idruta"];
			}else{
				$valores.="''";
			}
      //reviso si la ruta es restrictiva
      if($registro_actual[0]["ruta_idruta"]>0){
      	$restrictiva=busca_filtro_tabla("restrictivo","ruta","idruta=".$registro_actual[0]["ruta_idruta"],"",$conn);

        if($restrictiva["numcampos"] && $restrictiva[0]["restrictivo"]==1){

        	//busco cuantos faltan por aprobar si es restrictiva
          $cuantos_faltan=busca_filtro_tabla("count(idtransferencia) as cuantos","buzon_entrada","nombre='POR_APROBAR' and activo=1 and ruta_idruta=".$registro_actual[0]["ruta_idruta"]." and archivo_idarchivo=".$_REQUEST["iddoc"],"",$conn);

          if($cuantos_faltan[0]["cuantos"]){
          	$valores=$iddoc.",'VERIFICACION',$origen,".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",$destino,'DOCUMENTO',1,1";

            if($registro_actual[$i]["ruta_idruta"]<>""){
            	$valores.=",".$registro_actual[$i]["ruta_idruta"];
						}else{
            	$valores.=",''";
						}
           phpmkr_query("INSERT INTO buzon_entrada(".$campos.") VALUES (".$valores.")",$conn);

         	}else{
         		$update="update buzon_entrada set nombre='TRANSFERIDO' where ruta_idruta=".$registro_actual[0]["ruta_idruta"]." and archivo_idarchivo=$iddoc and nombre='VERIFICACION'";
           	phpmkr_query($update,$conn);
            $transferir=1;
         	}
      	}
    	}

			if($transferir==1){
      	for($i=0;$i<$registro_actual["numcampos"];$i++){
        	$registro_intermedio= busca_filtro_tabla("A.*","buzon_entrada A","A.archivo_idarchivo=".$iddoc." and A.activo=1 and (A.nombre='POR_APROBAR') and idtransferencia<".$registro_actual[$i]["idtransferencia"],"A.idtransferencia",$conn);

					if($registro_intermedio["numcampos"]){
          	break;
					}

					$valores=$iddoc.",'$estado',".$registro_actual[$i]["origen"].",".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",".$registro_actual[$i]["destino"].",'DOCUMENTO',1,1,";

					if($registro_actual[$i]["ruta_idruta"]<>""){
          	$valores.=$registro_actual[$i]["ruta_idruta"];
					}else{
         		$valores.="''";
					}

          phpmkr_query("INSERT INTO buzon_entrada(".$campos.") VALUES (".$valores.")",$conn);

          if($registro_actual[$i]["origen"] != $registro_actual[$i]["destino"]){
          	$documento_mns = busca_filtro_tabla("descripcion,plantilla","documento","iddocumento=$iddoc","",$conn);

            $mensaje = "Tiene un nuevo documento para su revision: Tipo: ".ucfirst($documento_mns[0]["plantilla"])." - Descripcion: ".$documento_mns[0]["descripcion"];

          	$x_tipo_envio[] = 'msg';
            $x_tipo_envio[] = 'e-interno';
            $destino_mns[0] = $registro_actual[$i]["origen"];
        	}
      	}
    	}

			if(($terminado["numcampos"]==$registro_actual["numcampos"]) || ($terminado["numcampos"]==1 && $terminado[0]["destino"]==$_SESSION["usuario_actual"])){

				//llama_funcion_accion($iddoc,$tipo_radicado[0]["idformato"],"aprobar","ANTERIOR");

				$tipo_radicado=busca_filtro_tabla("documento.*,contador.nombre,plantilla,idformato","documento,contador,formato C","idcontador=tipo_radicado and iddocumento=$iddoc AND lower(plantilla)=lower(C.nombre)","",$conn);
       	if($tipo_radicado[0]["numero"]==0){
       		$numero=contador($iddoc,$tipo_radicado[0]["nombre"]);
          phpmkr_query("UPDATE documento SET estado='APROBADO', fecha=".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').", dias='".$dias_entrega[0]["dias_entrega"]."' WHERE iddocumento=".$iddoc,$conn);
      	}else{
       		phpmkr_query("UPDATE documento SET estado='APROBADO',activa_admin=0, fecha=".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s')." WHERE iddocumento=".$iddoc,$conn);
			$numero= $tipo_radicado[0]["numero"];
				}
        //llama_funcion_accion($iddoc,$tipo_radicado[0]["idformato"],"aprobar","POSTERIOR");
    	}

    		$radicado=busca_filtro_tabla("numero","documento","iddocumento=".$iddoc,"",$conn);

			$dato=array();
			$dato['numero']=$radicado[0]['numero'];
			$dato['accion']=$estado;
			$dato['iddoc']=$iddoc;
  	}
 	}else{
  	aprobar_reemplazo($iddoc);
	}
	//llama_funcion_accion($iddoc,$tipo_radicado[0]["idformato"],"confirmar","POSTERIOR");
	return($dato);
}
?>
