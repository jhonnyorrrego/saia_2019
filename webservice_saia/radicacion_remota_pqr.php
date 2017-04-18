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

include_once($ruta_db_superior."asignacion.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
@set_time_limit(0);
if(!@$_SESSION["LOGIN".LLAVE_SAIA]){
	@session_start();
	$_SESSION["LOGIN".LLAVE_SAIA]="radicador_web";
	$_SESSION["usuario_actual"]="111222333";
	$_SESSION["conexion_remota"]=1;
}
radicar_documento_remoto($datos);

function radicar_documento_remoto($datos){
	global $conn,$ruta_db_superior;
	include_once("class_transferencia2.php");
	$datos = json_decode($datos);



	$formato=busca_filtro_tabla("idformato","formato","nombre_tabla='".$datos->tabla."'","",$conn);

	foreach ($datos as $key => $value){
		$_REQUEST[$key] = $value;
	}

	$_POST = $_REQUEST;

	$email=$_POST['email'];

	$iddoc=radicar_plantilla2();
	//return($iddoc);
	$_REQUEST["funcionario_codigo"] = $_SESSION["usuario_actual"];
	$documento = obtener_datos_documento($iddoc);

	if($iddoc && sizeof($datos->anexos)){
		$info = cargar_anexos_documento_web($documento,$datos->anexos);
	}

	$documento['email']=$email;
	return(json_encode($documento));
}
function enviar_mail($iddocumento){
	global $conn,$ruta_db_superior;
	//$iddocumento=json_decode($iddocumento);

	/*GENERACION DEL PDF*/
	//$abrir=fopen("log_curl.txt","a+");
		$ch = curl_init();
		$fila = PROTOCOLO_CONEXION.RUTA_PDF_LOCAL."/class_impresion.php?iddoc=".$iddocumento."&conexion_remota=1";
		curl_setopt($ch, CURLOPT_URL,$fila);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		$contenido=curl_exec($ch);
		//fwrite($abrir,"En la fecha ".date('Y-m-d H:i:s')." ".$fila." Termina el proceso =>  ".$contenido." \n \n");
		curl_close ($ch);
		//fclose($abrir);
		/*TERMINA GENERACION*/

	$datos_documento=busca_filtro_tabla("a.numero,a.pdf,b.email","documento a, ft_pqrsf b","a.iddocumento=b.documento_iddocumento AND b.documento_iddocumento=".$iddocumento,"",$conn);

	$mensaje="Gracias por contactarnos, su número de radicado es el ".$datos_documento[0]['numero']."<br/><br/>
	Su solicitud ya esta siendo gestionada y próximamente nos comunicaremos con usted para darle una respuesta<br/><br/>
				Para consultarlo ingrese al siguiente enlace:<br/>
				<a href='http://www.umanizales.edu.co/pqrsf/formulario_solicitud_documentos.php'>http://www.umanizales.edu.co/pqrsf/formulario_solicitud_documentos.php</a><br /><br />
				<b>Universidad de Manizales.</b><br/><br/>";
	$mensaje.="Antes de imprimir este mensaje, asegurese que es necesario. Proteger el medio ambiente tambien esta en nuestras manos.<br /><br />
				Nota: Por favor no responder a este correo, este email es exclusivamente para fines informativos.";
	enviar_mensaje("","email",array($datos_documento[0]['email']),"Notificacion PQR",$mensaje,"e-interno",array($ruta_db_superior.$datos_documento[0]['pdf']));
	return(json_encode($datos_documento));
}
function transferir_documento_encargado($datos){
	global $conn, $ruta_db_superior;
	include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
	include_once($ruta_db_superior.FORMATOS_CLIENTE . "recepcion_peticion/funciones.php");

	$datos = json_decode($datos);
	//transferir_recepcion_peciticion_secretario_encargado($datos->idformato,$datos->iddocumento);
}

function radicar_plantilla2()
  {
   global $conn,$sql,$ruta_db_superior;
   //print_r($_REQUEST); die("aquiii");
   if(!$ruta_db_superior)$ruta_db_superior="../../";
   $valores=array();
   $plantilla="";
   $idformato=0;

   //hace el ejecutor igual al codigo del funcionario logueado actualmente
   if(!@$_POST["ejecutor"])
      $_POST["ejecutor"]=$_SESSION["usuario_actual"];

    if(@$_POST["formato"]){
      $plantilla="'".strtoupper($_POST["formato"])."'";
      $formato=busca_filtro_tabla("idformato,nombre_tabla","formato A","A.nombre LIKE '".strtolower($_POST["formato"])."'","",$conn);
      //print_r($formato);
      if($formato["numcampos"]){
        $idformato=$formato[0]["idformato"];
        $campos=busca_filtro_tabla("","campos_formato","formato_idformato=".$formato[0]["idformato"]." AND banderas LIKE '%u%'","",$conn);
        //print_r($campos);
        for($l=0;$l<$campos["numcampos"];$l++){
          if($_REQUEST[$campos[$l]["nombre"]]){
            $dato=busca_filtro_tabla("",$formato[0]["nombre_tabla"],$campos[$l]["nombre"]."=".$_REQUEST[$campo[$l]["nombre"]],"",$conn);
            //print_r($dato);
            if($dato["numcampos"]){
              alerta("El campo ".$campos[$l]["nombre"]." Debe ser Unico por Favor Vuelva a Insertar la informacion");
              volver(1);
            }
          }
        }

      }
    }

 	//busco los valores del formulario que van en la tabla documento
    $buscar = phpmkr_query("SELECT A.* FROM documento A WHERE 1=0",$conn);

    $lista_campos = array();
    for($i=0;$i<phpmkr_num_fields($buscar);$i++)
      array_push($lista_campos,strtolower(phpmkr_field_name($buscar,$i)));

    /////////////////////////////////////////////////////////////////////
    $valores=array("fecha"=>fecha_db_almacenar(date("Y-m-d H:i:s"),'Y-m-d H:i:s'));
    //print_r($_POST);
    //echo("<br />-------<br />");
    foreach($_POST as $key=>$valor){
      if(in_array($key,$lista_campos)&&$key<>"estado"){
        if($valor[0]!="'")
          $valor="'".$valor."'";
        $valores[$key]=$valor;
	   }
    }

    //si le env?o el tipo de radicado
    if(isset($_POST["serie_idserie"]) && $_POST["serie_idserie"]){
      $valores["serie"]=$_POST["serie_idserie"];
    }
    else $valores["serie"]=0;
    $valores["plantilla"]=$plantilla;
    if(isset($_REQUEST["dependencia"]) && $_REQUEST["dependencia"]<>"")
      $valores["responsable"]=$_REQUEST["dependencia"];
    if(@$_POST["tipo_radicado"]){
      $tipo_radicado=busca_filtro_tabla("idcontador","contador","nombre='".$_POST["tipo_radicado"]."'","",$conn);
      if($tipo_radicado["numcampos"]){
        $valores["tipo_radicado"]=$tipo_radicado[0]["idcontador"];
      }
      else if(isset($formato)&&$formato["numcampos"]){
        $valores["tipo_radicado"]=$formato[0]["contador_idcontador"];
      }
      else $valores["tipo_radicado"]=0;
    }

    if(isset($formato) && $formato["numcampos"] && $valores["tipo_radicado"]){
      $tipo_rad=busca_filtro_tabla("","contador","idcontador=".$valores["tipo_radicado"],"",$conn);
      if($tipo_rad["numcampos"])
        $_POST["tipo_radicado"]=$tipo_rad[0]["nombre"];
    }
    else{
    	return "No hay consecutivo";
    }

    $valores["numero"]=0;
    if(isset($_POST["municipio"]))
        $valores["municipio_idmunicipio"]=$_POST["municipio"];
    else if(isset($_POST["municipio_idmunicipio"]))
        $valores["municipio_idmunicipio"]=$_POST["municipio_idmunicipio"];
    else
    {$mun=busca_filtro_tabla("valor","configuracion","nombre='ciudad'","",$conn);
      if($mun["numcampos"])
          $valores["municipio_idmunicipio"]=$mun[0][0];
     else
          $valores["municipio_idmunicipio"]=633;
    }

    //radico el documento
    //print_r($valores);
    /*Se adiciona esta linea para las ejecutar las acciones sobre los formatos*/

   // llama_funcion_accion(NULL,$idformato,"radicar","ANTERIOR");

    $_POST["iddoc"]=radicar_documento_prueba(trim($_POST["tipo_radicado"]),$valores,Null);

    $iddoc=$_POST["iddoc"];

    include_once($ruta_db_superior."anexosdigitales/funciones_archivo.php");
   $permisos=NULL;
   cargar_archivo($_POST["iddoc"],$permisos);
    /*Se adiciona esta linea para las ejecutar las acciones sobre los formatos*/
    llama_funcion_accion($iddoc,$idformato,"radicar","POSTERIOR");
   if(!array_key_exists("destino",$_POST))
        {
         if($_POST["tabla"]=="encabezado_factura")
         		{$_POST["destino"]=$_POST["revisa"];
      		  }
         else
         		{$_POST["destino"]=$_POST["revisado"];
      		  }
      	}

   //  echo "Request  :"; print_r($_REQUEST);
   //  echo "Valores :"; print_r($valores);
   //  die();
    //guardo la relaci?n del documento creado como respuesta con su antecesor
    if(array_key_exists("anterior",$_REQUEST))
      {
       /*Se adiciona esta linea para las ejecutar las acciones sobre los formatos*/
       llama_funcion_accion($_REQUEST["anterior"],$idformato,"responder","ANTERIOR");
       $idbuzon=busca_filtro_tabla("max(A.idtransferencia) as idbuzon","buzon_entrada A","A.archivo_idarchivo=".$_REQUEST["anterior"],"",$conn);
       phpmkr_query("INSERT INTO respuesta(fecha,destino,origen,idbuzon,plantilla) VALUES (".fecha_db_almacenar(date("Y-m-d H:i:s"),'Y-m-d H:i:s').",".$_POST["iddoc"].",".$_REQUEST["anterior"].",".$idbuzon[0]["idbuzon"].",".$plantilla.")",$conn);
       $estado_anterior=busca_filtro_tabla("A.estado,B.nombre_tabla","documento A,formato B","A.plantilla=B.nombre AND A.iddocumento=".$_REQUEST["anterior"],"",$conn);
        if($estado_anterior["numcampos"]){
          if($estado_anterior[0]["estado"]=="ACTIVO"){
          phpmkr_query("update documento set estado='TRAMITE' where iddocumento=".$_REQUEST["anterior"],$conn);
          //arreglo con los datos que necesita transferir archivo
          }
          $formato_detalle=busca_filtro_tabla("id".$estado_anterior[0]["nombre_tabla"],$estado_anterior[0]["nombre_tabla"],"documento_iddocumento=".$_REQUEST["anterior"],"",$conn);
          if($formato_detalle["numcampos"])
            $valores[$estado_anterior[0]["nombre_tabla"]]=$formato_detalle[0]["id".$estado_anterior[0]["nombre_tabla"]];
        }
        else
         { $estado_anterior=busca_filtro_tabla("A.estado","documento A","A.iddocumento=".$_REQUEST["anterior"],"",$conn);
           if($estado_anterior["numcampos"] && $estado_anterior[0]["estado"]=="ACTIVO")
             phpmkr_query("update documento set estado='TRAMITE' where iddocumento=".$_REQUEST["anterior"],$conn);
         }
        $datos["archivo_idarchivo"]=$_REQUEST["anterior"];
        $datos["nombre"]="TRAMITE";
        $datos["tipo_destino"]=1;
        $datos["tipo"]="";
        $destino_tramite[]=usuario_actual("funcionario_codigo");
        transferir_archivo_prueba($datos,$destino_tramite,"","");
        /*Se adiciona esta linea para las ejecutar las acciones sobre los formatos*/
        llama_funcion_accion($_REQUEST["anterior"],$idformato,"responder","POSTERIOR");
      }

    $ins_calidad["numcampos"]=0;
    if(isset($_REQUEST["tabla"]))
      $ins_calidad=busca_filtro_tabla("*","estructura_calidad","nombre LIKE '".strtolower($_REQUEST["tabla"])."'","",$conn);
    //guardo los datos del formulario principal del documento (plantilla)
    if($_POST["tabla"]=="scdp")
      phpmkr_query("UPDATE scdp SET documento_iddocumento=".$_POST["iddoc"]." WHERE num_previo=".$_POST["num_previo"],$conn);
    elseif($ins_calidad["numcampos"]){
      $estructuras=explode(",",$_REQUEST["estructura"]);
      foreach($estructuras as $fila){
        $datos_est=explode("#",$fila);
        $sql_calidad="insert into doc_calidad(documento_iddocumento,estructura_idestructura,cod_padre) values(".$_POST["iddoc"].",".$datos_est[0].",".$datos_est[1].")";
        phpmkr_query($sql_calidad,$conn);
      }
      if(!isset($_POST["descripcion"])){
        if(isset($_POST["nombre_".strtolower($REQUEST["tabla"])])){
          $_POST["descripcion"]=$_POST["nombre_".strtolower($REQUEST["tabla"])];
        }
        $_POST["encabezado"]=1;
      }
    }

    llama_funcion_accion($iddoc,$idformato,"adicionar","ANTERIOR");

   /* if($_POST["iddoc"] && $_POST["tabla"]=="ft_decision_disciplinaria")
      $idplantilla=guardar_decision_disciplinaria($_POST["iddoc"]);
    else*/if($_POST["iddoc"])
      $idplantilla=guardar_documento($_POST["iddoc"]);
 	  //die();

    if(!$idplantilla)
      {alerta("No se ha podido Crear el Formato..");

       phpmkr_query("update documento set estado='ELIMINADO' where iddocumento=".$_POST["iddoc"],$conn);
      }
    else
    {
    //si es una factura busco el id de la ruta donde voy
    $formato=busca_filtro_tabla("","formato","nombre_tabla LIKE '".@$_POST["tabla"]."'","",$conn);
    $banderas=array();
    if($formato["numcampos"])
      $banderas=explode(",",$formato[0]["banderas"]);
    //print_r($banderas);
    //arreglo con los datos que necesita transferir archivo
    $datos["archivo_idarchivo"]=$_POST["iddoc"];
    $datos["nombre"]="BORRADOR";
    $datos["tipo_destino"]=1;
    $datos["tipo"]="";
    $aux_destino[0]=$_SESSION["usuario_actual"];
    if(!isset($adicionales))
      $adicionales="";
    //realizo la primera transferencia del creador de la plantilla para el mismo,
    //para poder editarla antes de enviarla
    transferir_archivo_prueba($datos,$aux_destino,$adicionales,"");
    //para enviarla a los otros destinos si los tiene
    $datos["archivo_idarchivo"]=$_POST["iddoc"];
    $datos["nombre"]="POR_APROBAR";
    $datos["tipo"]="";
    $adicionales["activo"]="1";
    if( (!isset($_POST["firmado"]) || (isset($_POST["firmado"]) && $_POST["firmado"]=="una")))
    {
      //lo transfiero al radicador de salida
      $radicador=busca_filtro_tabla("f.funcionario_codigo","configuracion c,funcionario f","c.nombre='radicador_salida' and f.login=c.valor","",$conn);
      if($radicador["numcampos"]){
        $aux_destino[0]=$radicador[0]["funcionario_codigo"];
        transferir_archivo_prueba($datos,$aux_destino,$adicionales);
      }
    }
    elseif(isset($_POST["firmado"]) && $_POST["firmado"]=="varias")
    {
     die();
    }
    if(in_array("e",$banderas)){
      aprobar2($_POST["iddoc"]);
    }
   llama_funcion_accion($iddoc,$idformato,"adicionar","POSTERIOR");
   //transferir_documento_encargado($idformato,$iddoc);
   return $_POST["iddoc"];
   }
}

function aprobar2($iddoc=0,$url=""){
	global $conn;

  $transferir=1;

  if(isset($_REQUEST["iddoc"])&&$_REQUEST["iddoc"]){
  	$iddoc=$_REQUEST["iddoc"];
	}

	$tipo_radicado = busca_filtro_tabla("documento.*,contador.nombre,idformato","documento,contador,formato","idcontador=tipo_radicado and iddocumento=".$iddoc." and lower(plantilla)=lower(formato.nombre)","",$conn);

  $formato=strtolower($tipo_radicado[0]["plantilla"]);
  $registro_actual=busca_filtro_tabla("A.*","buzon_entrada A","A.archivo_idarchivo=".$iddoc." and A.activo=1 and (A.nombre='POR_APROBAR') and A.destino=".$_SESSION["usuario_actual"],"A.idtransferencia",$conn);

  /*Se adiciona esta linea para las ejecutar las acciones sobre los formatos*/
  llama_funcion_accion($iddoc,$tipo_radicado[0]["idformato"],"confirmar","ANTERIOR");

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

        phpmkr_query("INSERT INTO buzon_salida (".$campos.") VALUES (".$valores.")",$conn,$_SESSION["usuario_actual"]);

				//buzon de entrada
        phpmkr_query("UPDATE buzon_entrada SET activo=0 WHERE idtransferencia=".$registro_actual[$i]["idtransferencia"],$conn,$_SESSION["usuario_actual"]);
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

            phpmkr_query("INSERT INTO buzon_entrada(".$campos.") VALUES (".$valores.")",$conn,$_SESSION["usuario_actual"]);

            if($registro_actual[$i]["origen"] != $registro_actual[$i]["destino"]){
            	$documento_mns = busca_filtro_tabla("descripcion,plantilla","documento","iddocumento=$iddoc","",$conn);

              $mensaje = "Tiene un nuevo documento para su revision: Tipo: ".ucfirst($documento_mns[0]["plantilla"])." - Descripcion: ".$documento_mns[0]["descripcion"];

             	$x_tipo_envio[] = 'msg';
              $x_tipo_envio[] = 'e-interno';
              $destino_mns[0] = $registro_actual[$i]["origen"];

              //enviar_mensaje("origen",$destino_mns,$mensaje);
           	}
            $transferir=0;
         	}else{
         		$update="update buzon_entrada set nombre='TRANSFERIDO' where ruta_idruta=".$registro_actual[0]["ruta_idruta"]." and archivo_idarchivo=$iddoc and nombre='VERIFICACION'";

           	phpmkr_query($update,$conn,$_SESSION["usuario_actual"]);
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

          phpmkr_query("INSERT INTO buzon_entrada(".$campos.") VALUES (".$valores.")",$conn,$_SESSION["usuario_actual"]);
         	procesar_estados($registro_actual[$i]["destino"],$registro_actual[$i]["origen"],$estado,$iddoc);

          if($registro_actual[$i]["origen"] != $registro_actual[$i]["destino"]){
          	$documento_mns = busca_filtro_tabla("descripcion,plantilla","documento","iddocumento=$iddoc","",$conn);

            $mensaje = "Tiene un nuevo documento para su revision: Tipo: ".ucfirst($documento_mns[0]["plantilla"])." - Descripcion: ".$documento_mns[0]["descripcion"];

          	$x_tipo_envio[] = 'msg';
            $x_tipo_envio[] = 'e-interno';
            $destino_mns[0] = $registro_actual[$i]["origen"];
            //enviar_mensaje("origen",$destino_mns,$mensaje,$x_tipo_envio);
        	}
      	}
    	}

			if(($terminado["numcampos"]==$registro_actual["numcampos"]) || ($terminado["numcampos"]==1 && $terminado[0]["destino"]==$_SESSION["usuario_actual"])){
				llama_funcion_accion($iddoc,$tipo_radicado[0]["idformato"],"aprobar","ANTERIOR");

				$tipo_radicado=busca_filtro_tabla("documento.*,contador.nombre,plantilla,idformato","documento,contador,formato C","idcontador=tipo_radicado and iddocumento=$iddoc AND lower(plantilla)=lower(C.nombre)","",$conn);

       	if($tipo_radicado[0]["numero"]==0){
       		$numero=contador($iddoc,$tipo_radicado[0]["nombre"]);
                   phpmkr_query("UPDATE ".DB.".documento SET estado='APROBADO', fecha=".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s')." WHERE iddocumento=".$iddoc,$conn);
      	}else{
       		phpmkr_query("UPDATE documento SET estado='APROBADO',activa_admin=0, fecha=".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s')." WHERE iddocumento=".$iddoc,$conn,$_SESSION["usuario_actual"]);
				}
        // Para los casos de los formatos mensajes (e-mail)
        if($tipo_radicado[0]["plantilla"]=='MENSAJE'){
        	require("email/email_doc.php");
          enviar_email($iddoc);
        }

				//si el formato tiene el campo de la fecha con el nombre predeterminado lo actualizo tambien
				$nombre_tabla=busca_filtro_tabla("nombre_tabla,banderas","formato","nombre like '$formato'","",$conn);
        $tabla=$nombre_tabla[0]["nombre_tabla"];
        $campos_formato=listar_campos_tabla($tabla);

        if(in_array('fecha_'.$formato,$campos_formato)){
        	$sql="update ".$tabla." set fecha_".$formato."=".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s')." where documento_iddocumento=".$iddoc;
					phpmkr_query($sql,$conn,$_SESSION["usuario_actual"]);
       	}

        $respuestas=busca_filtro_tabla("origen,estado","respuesta,documento","iddocumento=origen and destino='".$iddoc."' and estado in('TRAMITE','ACTIVO','APROBADO')","",$conn);

				if($respuestas["numcampos"]>0){

					$origen_respuesta = busca_filtro_tabla("origen","buzon_salida","archivo_idarchivo=$iddoc and nombre='BORRADOR'","",$conn);
          $datos["origen"]=$origen_respuesta[0]["origen"];
          $datos["nombre"]="RESPONDIDO";
          $datos["tipo"]="";
          $datos["tipo_origen"]="1";
          $datos["tipo_destino"]="1";

          for($i=0;$i<$respuestas["numcampos"];$i++){

          	if($respuestas[$i]["estado"]=="TRAMITE" || $respuestas[$i]["estado"]=="ACTIVO"){
          		$sql="UPDATE documento set estado='APROBADO' where iddocumento='".$respuestas[$i]["origen"]."'";
              phpmkr_query($sql,$conn,$_SESSION["usuario_actual"]);
            }
            $datos["archivo_idarchivo"]=$respuestas[$i]["origen"];
            $destino_respuesta[0]=$origen_respuesta[0]["origen"];
            $destino_respuesta[0]=usuario_actual("funcionario_codigo");
            transferir_archivo_prueba($datos,$destino_respuesta,"","");
          }
       	}

				//para enviarla a los otros destinos si los tiene
        $datos["archivo_idarchivo"]=$iddoc;
        $datos["nombre"]="APROBADO";
        $datos["tipo"]="";
        $destino=array();

        //llama_funcion_accion($iddoc,$tipo_radicado[0]["idformato"],"aprobar","POSTERIOR");
    	}

      $array_banderas=explode(",",$nombre_tabla[0]["banderas"]);
  	}
 	}else{
  	aprobar_reemplazo($iddoc);
	}
	//return(llama_funcion_accion($iddoc,$tipo_radicado[0]["idformato"],"confirmar","POSTERIOR"));
  return($iddoc);
}
?>
