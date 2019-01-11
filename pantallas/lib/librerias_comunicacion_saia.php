<?php
function enviar_email_pantalla($destino,$copia,$copia_oculta,$asunto,$contenido){
	global $conn,$ruta_db_superior;
	include_once($ruta_db_superior."pantallas/transferencia/class_transferencia_saia.php");
	$transferencia=new transferencia_saia();
  $retorno=new stdClass;
  $retorno->exito=0;
  $retorno->mensaje="Existen errores en el env&iacute;o de los mensajes";
  $email=busca_filtro_tabla("valor","configuracion","nombre='servidor_correo'","",$conn);
  $puerto=busca_filtro_tabla("valor","configuracion","nombre='puerto_servidor_correo'","",$conn);
  include_once($ruta_db_superior."email/class.phpmailer.php");
  $mail = new PHPMailer;
  $mail->ClearAttachments();
  if($email["numcampos"]){
    $asunto = html_entity_decode($asunto);
    $destinos=$destino;
    $contenido=pc_html2ascii_pantalla($contenido);
    $from = "Gestion Documental SAIA";
  	$mail->FromName = "Gestion Documental SAIA";
  	$mail->Host     = $email[0]["valor"];
  	$mail->Port     = $puerto[0]["valor"];
  	$mail->Mailer   = "mail";       // Alternative to IsSMTP()
  	$mail->WordWrap = 75;
  	$mail->From    = $from;
  	$mail->Subject = $asunto;
  	$mail->ClearAddresses();
  	$mail->ClearBCCs();
  	$mail->ClearCCs();
  	$para=explode(",",$destinos);
  	foreach($para as $direccion){
  	 $mail->AddAddress("$direccion","$direccion");
  	}
  	if($copia<>""){
  		$para=explode(",",$copia);
  	 	foreach($para as $direccion){
  	  	$mail->AddCC("$direccion","$direccion");
  	 	}
  	}
  	if($copia_oculta<>""){
  		$para=explode(",",$copia_oculta);
  	  foreach($para as $direccion){
  	   	$mail->AddBCC($direccion);
  	  }
  	}
  	$mail->Body = $contenido;

		$anexo=@$_REQUEST["anexos"];
    if($anexo!=""){
      $anexos=busca_filtro_tabla("ruta,etiqueta,idanexos","anexos","idanexos IN(".implode(",",$anexo).")","",$conn);
      if($anexos["numcampos"]){
        for($i=0;$i<$anexos["numcampos"];$i++){
          $mail->AddAttachment($anexos[$i]["ruta"],$anexos[$i]["etiqueta"]);
        }
      }
    }
		if(@$_REQUEST["paginas"]!="" && @$_REQUEST["nombre_paginas"]){
      $mail->AddAttachment($_REQUEST["paginas"],$_REQUEST["nombre_paginas"]);
    }
    if(@$_REQUEST["pdf"]!="" && @$_REQUEST["nombre_pdf"]){
      $mail->AddAttachment($_REQUEST["pdf"],$_REQUEST["nombre_pdf"]);
    }

  	if(!$mail->Send()){
      $retorno->mensaje="<br />Su correo contiene errores y no puede ser enviado";
      $retorno->exito=0;
  	}
    else{
    	if(@$_REQUEST["iddoc"]||@$_REQUEST["iddocumento"]){
    		if(@$_REQUEST["iddoc"])$iddoc=$_REQUEST["iddoc"];
				else if(@$_REQUEST["iddocumento"])$iddoc=$_REQUEST["iddocumento"];

	    	$radicador_salida=busca_filtro_tabla("","configuracion","nombre LIKE 'radicador_salida'","",$conn);
	      if($radicador_salida["numcampos"]){
	        $funcionario=busca_filtro_tabla("","funcionario","login LIKE '".$radicador_salida[0]["valor"]."'","",$conn);
	        if($funcionario["numcampos"]){
	          $ejecutores=array($funcionario[0]["funcionario_codigo"]);
	        }
	        else {
	          $ejecutores=array(usuario_actual("funcionario_codigo"));
	        }
	      }
	      if(!count($ejecutores))
	        $ejecutores=array(usuario_actual("funcionario_codigo"));
	      $otros["notas"]="'Documento enviado por e-mail por medio del correo: ".$mail->FromName;
	      for($i=0;$i<count($mail->to);$i++){
	        if(!in_array($mail->to[$i][0],$para))
	          array_push($para,$mail->to[$i][0]);
	      }
	      for($i=0;$i<count($mail->cc);$i++){
	        if(!in_array($mail->cc[$i][0],$copia))
	          array_push($copia,$mail->cc[$i][0]);
	      }
	      for($i=0;$i<count($mail->bcc);$i++){
	        if(!in_array($mail->bcc[$i][0],$copio))
	          array_push($copiao,$mail->bcc[$i][0]);
	      }
	      if(count($para)){
	        $otros["notas"].= " Para :".implode(",",$para);
	      }
	      if(count($copia)){
	        $otros["notas"].= " Con copia a :".implode(",",$copia);
	      }
	      if(count($copiao)){
	        $otros["notas"].= " Con copia oculta a :".implode(",",$copiao);
	      }
	      $otros["notas"].="'";
	      $datos["archivo_idarchivo"]=$iddoc;
	      $datos["tipo_destino"]=1;
	      $datos["tipo"]="";
	      $datos["nombre"]="DISTRIBUCION";
	      $transferencia->transferir($datos,array(usuario_actual('funcionario_codigo')),"");
	    }
      $retorno->mensaje="<br />Su correo se ha enviado con &eacute;xito";
      $retorno->exito=1;
    }
  }
  return($retorno);
}
function pc_html2ascii_pantalla($s){
$s = preg_replace('/<a\s+.*?href="?([^\" >]*)"?[^>]*>(.*?)<\/a>/i',
'$2 ($1)', $s);
$s = preg_replace('@<(b|h)r[^>]*>@i',"\n",$s);
$s = preg_replace('@<p[^>]*>@i',"\n\n",$s);
$s = preg_replace('@<div[^>]*>(.*)</div>@i',"\n".'$1'."\n",$s);
$s = preg_replace('@<b[^>]*>(.*?)</b>@i','*$1*',$s);
$s = preg_replace('@<i[^>]*>(.*?)</i>@i','/$1/',$s);
$s = strtr($s,array_flip(get_html_translation_table(HTML_ENTITIES)));
//$s = preg_replace('//e','chr(\\1)',$s);
$s = strip_tags($s);
return $s;
}
function parsear_transferencia($iddoc,$destino,$contenido,$visible,$tipo_destino,$nombre){
	global $conn;
  $exito=1;
  if($destino!=''){
  	$transferir=realizar_transferencia($iddoc, $destino,$contenido,$visible,$tipo_destino,$nombre);
    if(!$transferir)
      $exito=0;
  }
  else{
    $exito=0;
  }
  if($exito){
    return(true);
  }
  return(false);
}
function realizar_transferencia($iddoc, $destino, $contenido,$visible,$tipo_destino=1,$nombre_transferencia){
	$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; }
	include_once($ruta_db_superior."pantallas/transferencia/class_transferencia_saia.php");
	$transferencia=new transferencia_saia();

  $datos=array();
  if($tipo_destino==1){
    //cuando es una lista de funcionarios fijos (roles)
    $vector=explode(",",$destino);
  }
  elseif($tipo_destino==3){
    //cuando es una lista de funcionarios fijos (funcionario_codigo)
    $vector=explode(",",$destino);
  }
  $adicionales=array();
  if($contenido<>""){
    $adicionales["notas"]="'".$contenido."'";
    $datos["ver_notas"]=$visible;
  }
  foreach($vector as $fila){
    if(!strpos($fila,"#")){
      if($tipo==3){
        $lista=array($fila);
      }
      else{
        $codigos=busca_filtro_tabla("funcionario_codigo","funcionario,dependencia_cargo","funcionario_idfuncionario=idfuncionario and iddependencia_cargo=$fila","",$conn);
        $lista=array($codigos[0]["funcionario_codigo"]);
      }
    }
    else{
      $lista=buscar_funcionarios(str_replace("#","",$fila));
    }
    $datos["tipo_destino"]="1";
    $datos["archivo_idarchivo"]=$iddoc;
    $datos["origen"]=usuario_actual("funcionario_codigo");
    $datos["nombre"]=$nombre_transferencia;
    $datos["tipo"]="";
    $datos["tipo_origen"]="1";
    $transferencia->transferir($datos,$lista,$adicionales);
  }
}

function transferir_documento_saia($datos,$destino,$adicionales){
 global $conn;
 sort($destino);
 $idarchivo = $datos["archivo_idarchivo"];
 if(!isset($datos["ruta_idruta"]))
    $datos["ruta_idruta"]="";
  if(array_key_exists("origen",$datos))
    $origen=$datos["origen"];
  else if(@usuario_actual("funcionario_codigo"))
    $origen=usuario_actual("funcionario_codigo");
  else
    $origen = usuario_actual("funcionario_codigo");

  //bloqueo los registros del mismo nodo de la ruta
  if(array_key_exists("ruta_idruta",$datos) && $datos["nombre"]=="TRANSFERIDO"){
    $bloqueante=busca_filtro_tabla("A.orden,A.restrictivo,B.idtransferencia as trans","ruta A, buzon_entrada B","B.ruta_idruta=A.idruta and B.nombre='TRANSFERIDO' and B.origen=".$origen." and B.archivo_idarchivo=$idarchivo","B.idtransferencia desc", $conn);
    if(@$bloqueante[0]["restrictivo"]==1){
      $where="A.archivo_idarchivo=$idarchivo and B.orden=".$bloqueante[0]["orden"]." and A.ruta_idruta=B.idruta and A.idtransferencia<>".$bloqueante[0]["trans"];
      $bloqueados=busca_filtro_tabla("A.idtransferencia","buzon_entrada A, ruta B",$where,"", $conn);
      if($bloqueados<>""){
        phpmkr_query("UPDATE buzon_entrada A, ruta B SET A.nombre='BLOQUEADO' WHERE ".$where, $conn);
      }
    }
  }
  if($adicionales<>Null && $adicionales<>"" && is_array($adicionales)){
    $otras_llaves=",".implode(",",array_keys($adicionales));
    $otros_valores=",".implode(",",array_values($adicionales));
    if($otros_valores ==",")
      $otros_valores=",";
  }
  else{
    $otras_llaves="";
    $otros_valores="";
  }
  if($destino<>"" && $origen<>""){
    $values_out="$idarchivo,'".$datos["nombre"]."',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",";
    if($datos["tipo_destino"]=="1" || $datos["tipo_destino"]=="4" || $datos["tipo_destino"]=="5"){
      $tipo_destino=1;
      $datos_origen="";
      if($datos["tipo_destino"]=="4" && count($destino)==1){
        $dependencia=busca_filtro_tabla("d.dependencia_iddependencia as dep","dependencia_cargo d,funcionario f","d.funcionario_idfuncionario=f.idfuncionario and f.funcionario_codigo=$origen","", $conn);
        $datos_destino=busca_cargofuncionario(4,$destino[0],$dependencia[0]["dep"]);
        if($datos_destino<>""){
          $destino[0]=$datos_destino[0]["funcionario_codigo"];
        }
      }
      else if($datos["tipo_destino"]=="5" && count($destino)==1){
        $datos_destino=busca_cargofuncionario(5,$destino[0],"");
        if($datos_destino<>""){
          $destino[0]=$datos_destino[0]["funcionario_codigo"];
        }
      }
      if($datos["ruta_idruta"]==""){
        $datos["ruta_idruta"] = 0;
      }
      //buzon de salida
      $values_out.="'".$origen."',1,1".$otros_valores.",'".@$datos["ver_notas"]."'";
      $values_in="$idarchivo,'".$datos["nombre"]."',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",'$origen',1,".$datos["ruta_idruta"].",$tipo_destino".$otros_valores.",'".@$datos["ver_notas"]."'";
      foreach($destino as $user){
        if($datos["nombre"]!="POR_APROBAR"){
          $sql="INSERT INTO buzon_salida (archivo_idarchivo,nombre,fecha,origen,tipo_origen,tipo_destino".$otras_llaves.",ver_notas,destino) values (".$values_out.",".$user.")";
          //echo $sql."<br />";
          phpmkr_query($sql, $conn);
        }
        //buzon de entrada
        $sql="INSERT INTO buzon_entrada(archivo_idarchivo,nombre,fecha,destino,tipo_origen,ruta_idruta,tipo_destino".$otras_llaves.",ver_notas,origen) values(".$values_in.",".$user.")";
        //echo $sql."<br />"; die();
        phpmkr_query($sql, $conn);
        procesar_estados($origen,$user,$datos["nombre"],$idarchivo);
      }
    }
    else if($datos["tipo_destino"]=="2"){
      //busco los funcionarios de la dependencia
      if($datos["nombre"]!="POR_APROBAR")
        $destinos = buscar_funcionarios(str_replace("#","",$fila), $destino);
      for($i=0;$i<count($destinos);$i++){
        //buzon de entrada
        $destinos[$i]=reemplazo($destino[$i]);
        $values="$idarchivo,'".$datos["nombre"]."',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",$origen,".$destinos[$i].",1,1".$otros_valores.",'".@$datos["ver_notas"]."'";
        $values1="$idarchivo,'".$datos["nombre"]."',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",".$destinos[$i].",$origen,1,1".$otros_valores;
        $enlace=busca_filtro_tabla("descripcion","documento","iddocumento=$idarchivo","",$conn);
        $enlace=$enlace[0]["descripcion"];
        $sql="INSERT INTO buzon_entrada(archivo_idarchivo,nombre,fecha,destino,origen,tipo_origen,tipo_destino".$otras_llaves.",ver_notas) values(".$values.")";
        phpmkr_query($sql, $conn);
        $sql="INSERT INTO buzon_salida(archivo_idarchivo,nombre,fecha,origen,destino,tipo_origen,tipo_destino".$otras_llaves.") values(".$values1.")";
        phpmkr_query($sql, $conn);
        $mensaje="Acaba de Recibir el Documento: $enlace del usuario ".$destinos[$i]['login']." !!!";
      }
    }
    else{
      $values="$idarchivo,'".$datos["nombre"]."',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",$origen,$destino,$tipo_origen,$tipo_destino".$otros_valores.",'".@$datos["ver_notas"]."'";
      $sql="insert into buzon_entrada(archivo_idarchivo,nombre,fecha,destino,origen,tipo_origen,tipo_destino".$otras_llaves.",ver_notas) values (".$values.")";
      phpmkr_query($sql, $conn);
    }
  }
  return (TRUE);
}
function procesar_estados($idorigen,$iddestino,$nombre_transferencia,$iddocumento=NULL,$fecha_final=NULL){
  switch($nombre_transferencia){
    case "TRANSFERIDO":
      eliminar_asignacion($idorigen,$iddocumento);
      asignar_tarea_buzon($iddocumento,NULL,2,$iddestino,1,NULL,$fecha_final,"PENDIENTE");
    break;
    case "DELEGADO":
      eliminar_asignacion($idorigen,$iddocumento);
      //asignar_tarea_buzon($iddocumento,NULL,2,$iddestino,1,NULL,$fecha_final,"PENDIENTE");
    break;
    case "REVISADO":
      eliminar_asignacion($idorigen,$iddocumento);
      //asignar_tarea_buzon($iddocumento,NULL,2,$iddestino,1,NULL,$fecha_final,"PENDIENTE");
    break;
    case "APROBADO":
      eliminar_asignacion($idorigen,$iddocumento);
      //asignar_tarea_buzon($iddocumento,NULL,2,$iddestino,1,NULL,$fecha_final,"PENDIENTE");
    break;
    case "DEVOLUCION":
      eliminar_asignacion($idorigen,$iddocumento);
      asignar_tarea_buzon($iddocumento,NULL,2,$iddestino,1,NULL,$fecha_final,"PENDIENTE");
    break;
    case "RESPONDIDO":
      eliminar_asignacion($idorigen,$iddocumento);
    break;
    case "BORRADOR" :
      //asignar_tarea_buzon($iddocumento,NULL,2,$iddestino,1,NULL,$fecha_final,"PENDIENTE");
    break;
    case "TERMINADO":
      eliminar_asignacion($idorigen,$iddocumento);
    break;
    case "DISTRIBUCION":
      eliminar_asignacion($idorigen,$iddocumento);
    break;
    default:
      return;
    break;
    //Tener encuenta en el case aprobado que si el destino es el radicador de salida solo se cancela la tarea y yap sino se reasigna.
  }
return true;
}
/*
<Clase>
<Nombre>eliminar_asignacion</Nombre>
<Parametros>$funcionario:codigo del funcionario;$iddocumento:identifador del documento</Parametros>
<Responsabilidades>Elimina los registros en la tabla asignacion que corresponde con el funcionario y el documento<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function eliminar_asignacion($funcionario,$iddocumento){
  global $conn;
  $datos_asignacion = busca_filtro_tabla("idasignacion","asignacion","documento_iddocumento=$iddocumento AND entidad_identidad=1 AND llave_entidad=$funcionario and tarea_idtarea=2","",$conn);
  if ($datos_asignacion["numcampos"]){
    for($i=0; $i<$datos_asignacion["numcampos"]; $i++){
      phpmkr_query("delete from asignacion where idasignacion=".$datos_asignacion[$i]["idasignacion"],$conn);
    }
  }
  else {
    return FALSE;
  }
  return TRUE;
}
/*
<Clase>
<Nombre>asignar_tarea_buzon</Nombre>
<Parametros>$iddocumento:identificador del documento;$idserie:identificador de la serie(No se utiliza);$idtarea:identifcador de la tarea (pendientes);$list_entidad:codigo del funcionario destino;$identidad:tipo de entidad;$fecha_inicial:Null;$fecha_final:fecha de la accion (No se utiliza);$estado:estado de la asignacion;</Parametros>
<Responsabilidades>Adicionar en la tabla asignacion el registro para el documento y el funcionario<Responsabilidades>
<Notas>La fecha inicial es la fecha actual</Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones>Campos obligatorios iddocumento y idtarea<Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function asignar_tarea_buzon($iddocumento,$idserie=NULL,$idtarea=NULL,$list_entidad=NULL,$identidad=NULL,$fecha_inicial=NULL,$fecha_final=NULL,$estado = "PENDIENTE"){
  global $conn;
  $formato = "Y-m-d H:i:s";
  if(!$fecha_inicial)
    $fecha_inicial=fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s');
  if(($idserie||$iddocumento) && isset($idtarea)){
    $sql = "INSERT INTO asignacion (documento_iddocumento,tarea_idtarea,fecha_inicial,estado,entidad_identidad,llave_entidad) VALUES ($iddocumento,$idtarea,$fecha_inicial,'$estado',1,$list_entidad)";
    phpmkr_query($sql);
  }
  else{
    return FALSE;
  }
  return TRUE;
}
/*
<Clase>
<Nombre>informacion_documento</Nombre>
<Parametros>$iddoc:identificador del documento;</Parametros>
<Responsabilidades>Se encarga de mostrar la informacion basica del documento que esta recibiendo<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function informacion_documento($iddoc=""){
	global $conn;
	$texto='';
  if($iddoc==""){
    $iddoc=$_REQUEST["iddocumento"];
  }
	if($iddoc){
		$documento=busca_filtro_tabla("","documento a","a.iddocumento=".$iddoc,"",$conn);
		$serie=busca_filtro_tabla("","serie a","a.idserie=".$documento[0]["serie"],"",$conn);
		$etiqueta_serie="<span style='color:red'><b>Sin serie asignada</b></span>";
		if($serie["numcampos"])$etiqueta_serie=$serie[0]["nombre"];
		$texto='<div class="control-group element"><label class="control-label" for="datos"><b>Documento:</b>
</label><div class="controls"><label class="control-label" for="radicado" style="width:auto;text-align:left"><b>Radicado No</b> '.$documento[0]["numero"].' - '.$etiqueta_serie.'</label></div></div>
<div class="control-group element"><label class="control-label" for="datos"><b>Descripcion del documento:</b>
</label><div class="controls"><label class="control-label" for="descripcion" style="width:auto;text-align:left">'.$documento[0]["descripcion"].'</label></div></div>
';
	}
	else{
		$texto='<span style="color:red"><b>No existe documento vinculado</b></span>';
	}
	return ($texto);
}
/*
<Clase>
<Nombre>redirecciona_transferencia</Nombre>
<Parametros>$iddoc:identificador del documento;</Parametros>
<Responsabilidades>Funcion que se ejecuta posterior al enviar que redirecciona al documento<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function redirecciona_transferencia($iddoc){
	global $ruta_db_superior;
	if($iddoc==''){
		$iddoc=$_REQUEST["iddocumento"];
	}
	$adicionales_enlace="";
	if(@$_REQUEST["bpmni"]){
		$adicionales_enlace="&bpmni=".$_REQUEST["bpmni"]."&idbpmn=".@$_REQUEST["idbpmn"];
	}
	$documento=busca_filtro_tabla("a.numero, b.nombre, b.ruta_pantalla, b.idpantalla, a.iddocumento","documento a, pantalla b","a.pantalla_idpantalla=b.idpantalla and a.iddocumento=".$iddoc,"",$conn);
	$idregistro=busca_filtro_tabla("",$documento[0]["nombre"]." a","a.documento_iddocumento=".$iddoc,"",$conn);
	$texto='window.open("'.$ruta_db_superior.$documento[0]["ruta_pantalla"].'/'.$documento[0]["nombre"].'/mostrar_'.$documento[0]["nombre"].'.php?id'.$documento[0]["nombre"].'='.$idregistro[0]["id".$documento[0]["nombre"]].'&iddocumento='.$documento[0]["iddocumento"].$adicionales_enlace.'","_self");';
	echo $texto;
}
/*
<Clase>
<Nombre>actualizar_codigo_arbol</Nombre>
<Parametros>$id=id del registro insertado
$cod_padre=id del codigo del padre
$campo=Nombre del campo sobre el cual se va a actualizar
$tabla=Nombre de la pantalla a actualizar
</Parametros>
<Responsabilidades>Se encarga de guardar sobre campo definido el codigo del registro<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function actualizar_codigo_arbol($id,$cod_padre,$campo,$tabla){
	global $conn,$ruta_db_superior;
	$cod_arbol=busca_filtro_tabla($campo,$tabla,"id".$tabla."='".$cod_padre."'","",$conn);
	$sql1="update ".$tabla." set ".$campo."='".$cod_arbol[0]["cod_arbol"].".".$id."' where id".$tabla."=".$id;
	phpmkr_query($sql1);
}
/*
<Clase>
<Nombre>redirecciona_mostrar_pantalla</Nombre>
<Parametros>$idpantalla:identificador de la pantalla;</Parametros>
<Responsabilidades>Funcion que se ejecuta posterior al enviar que redirecciona a la pantalla<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function redirecciona_mostrar_pantalla($nombre_pantalla){
	global $ruta_db_superior;
	$pantalla=busca_filtro_tabla("ruta_pantalla","pantalla a","a.nombre='".$nombre_pantalla."'","",$conn);
	$texto='window.open("'.$ruta_db_superior.$pantalla[0]["ruta_pantalla"].'/'.$nombre_pantalla.'/mostrar_'.$nombre_pantalla.'.php?id'.$nombre_pantalla.'="+objeto.id'.$nombre_pantalla.',"_self");';
	echo $texto;
}
/*
<Clase>
<Nombre>redirecciona_mostrar_formato</Nombre>
<Parametros>$idpantalla:identificador de la pantalla;</Parametros>
<Responsabilidades>Funcion que se ejecuta posterior al enviar que redirecciona a la pantalla<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function redirecciona_mostrar_formato($ruta,$target,$nombre_pantalla){
	global $ruta_db_superior;
	$adicional2="";
	$request_documento='';
	$texto='';
	$ruta_enlace='';
	foreach($_REQUEST as $llave=>$valor){
		$adicional2.="&".$llave."=".$valor;
	}
	$pantalla=busca_filtro_tabla("","pantalla a","a.nombre='".$nombre_pantalla."'","",$conn);
	if(@$_REQUEST["opener"]=='arbol_documento'){
		$ruta_enlace=$ruta_db_superior.$ruta.'?id'.$nombre_pantalla.'="+objeto.id'.$nombre_pantalla.'+"&iddocumento="+objeto.documento_iddocumento+"&idpantalla='.$pantalla[0]["idpantalla"].$adicional2;
	}
	else if(strpos($_SERVER["PHP_SELF"],"adicionar_".$nombre_pantalla.".php")!==false || strpos($_SERVER["PHP_SELF"],"editar_".$nombre_pantalla.".php")!==false){
		$adicional="?";
		if(strpos($ruta,"?")!==false){
			$adicional="&";
		}
		$ruta_enlace=$ruta_db_superior.$ruta.$adicional.'id'.$nombre_pantalla.'="+objeto.id'.$nombre_pantalla.'+"&iddocumento="+objeto.documento_iddocumento+"&idpantalla='.$pantalla[0]["idpantalla"].$adicional2;
	}
	else if($_REQUEST["id".$nombre_pantalla]){
		$adicional="?";
		if(strpos($ruta,"?")!==false){
			$adicional="&";
		}
		if(@$_REQUEST["iddocumento"] && is_numeric($_REQUEST["iddocumento"])){
			$request_documento='&iddocumento='.@$_REQUEST["iddocumento"];
		}
		$ruta_enlace=$ruta_db_superior.$pantalla[0]["ruta_pantalla"]."/".$pantalla[0]["nombre"]."/mostrar_".$pantalla[0]["nombre"].'.php?id'.$nombre_pantalla.'='.$_REQUEST["id".$nombre_pantalla].$request_documento.'&idpantalla='.$pantalla[0]["idpantalla"].$adicional2;
	}
	if(!$ruta_enlace){
		if($adicional2[0]=="&"){
			$adicional2[0]="?";
		}
		$ruta_enlace= $ruta_db_superior.$ruta.$adicional2;
	}
	if(!$target){
		$target='_self';
	}
	if($target=='kaiten_self'){
		$substr = substr($ruta_enlace,0,3);
		if ($substr == '../') {
			$ruta_enlace=substr($ruta_enlace,3,strlen($ruta_enlace)-1);
		}
		$texto=	'datos={ kConnector:"iframe", url:"'.$ruta_enlace.'", kTitle:"'.$pantalla[0]["etiqueta"].'"}
		parent.$(".k-focus").closest("#contenedor_busqueda").kaiten("reload",parent.$(".k-focus"),datos);';
	}
	else{
		$texto='window.open("'.$ruta_enlace.'","'.$target.'");';
		//die($texto);
	}
	echo $texto;
}
function procesar_estado_pendiente($estado,$iddocumento,$destino,$origen){
	global $conn;
}
function procesar_estado_proceso($estado,$iddocumento,$destino,$origen){
	global $conn;
	$consulta=busca_filtro_tabla("","documento_pendientes a","a.documento_iddocumento=".$iddocumento." and funcionario_idfuncionario=".$origen,"",$conn);
	if($consulta["numcampos"]){
		$sql1="delete from documento_pendientes where iddocumento_pendientes=".$consulta[0]["iddocumento_pendientes"];
		phpmkr_query($sql1);
	}
	$sql2="insert into documento_proceso(documento_iddocumento, funcionario_idfuncionario, nombre_estado, fecha)values('".$iddocumento."', '".$destino."', '".$estado."', ".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').")";
	phpmkr_query($sql2);
}
//Utilizado para mostrar en el adicionar de algunos formatos la fecha de hoy en letras
function info_fecha_actual($fecha=""){
	global $conn;
	if(!$fecha){
		$fecha=date("Y-m-d");
	}
	$datos=date_parse($fecha);
	$texto=$datos["day"]." de ".mes($datos["month"])." del ".$datos["year"];
	return($texto);
}
//Muestra el numero de radicado del documento
function formato_numero($iddocumento){
	global $conn;
	$radicado=busca_filtro_tabla("numero","documento A","A.iddocumento=".$iddocumento,"",$conn);
	return($radicado[0]["numero"]);
}
//Muestra codigo de la dependencia
function dependencia_codigo($rol){
	global $conn;
	$dependencia=busca_filtro_tabla("A.codigo","dependencia A,dependencia_cargo C","C.dependencia_iddependencia=A.iddependencia and C.iddependencia_cargo=".$rol,"",$conn);
	return($dependencia[0]["codigo"]);
}
//Muestra el nombre de la dependencia
function dependencia_nombre($rol){
	global $conn;
	$dependencia=busca_filtro_tabla("A.nombre","dependencia A,dependencia_cargo C","C.dependencia_iddependencia=A.iddependencia and C.iddependencia_cargo=".$rol,"",$conn);
	return($dependencia[0]["nombre"]);
}
//Muestra el codigo de la serie
function serie_subserie($idserie){
	global $conn;
	$serie=busca_filtro_tabla("A.codigo","serie A","A.idserie=".$idserie,"",$conn);
	if($serie["numcampos"]){
		$texto=$serie[0]["codigo"];
	}
	else{
		$texto="?";
	}
	return($texto);
}
//Muestra la ciudad que se encuentra guardada en configuracion
function ciudad(){
	global $conn;
 	$ciudad=busca_filtro_tabla("valor","configuracion","nombre='ciudad'","",$conn);
  if($ciudad["numcampos"]){
  	$nombre_ciudad=busca_filtro_tabla("nombre","municipio","idmunicipio=".$ciudad[0]["valor"],"",$conn);
    $ciudad_valor=$ciudad[0][0];
    $valor= ucwords(strtolower($nombre_ciudad[0][0]));
  }
  else{
    $ciudad_valor="658";
    $valor= "Pereira";
  }
 	return($valor);
}
//Muestra las iniciales de la persona quien elaboro dicho documento, en este caso sale todo el nombre en base a ucm
function iniciales_funcionario_mostrar($iddocumento){
	global $conn;
	$nombres=busca_filtro_tabla("A.nombres,A.apellidos","funcionario A, documento B","A.funcionario_codigo=B.ejecutor AND B.iddocumento=".$iddocumento,"",$conn);

	return(ucwords(strtolower($nombres[0]["nombres"]." ".$nombres[0]["apellidos"])));
}
//Valida si seleccionaron si en el campo desea digitalizar para redireccionar a la pantalla de digitalizacion
function redireccionar_digitalizacion(){
	global $conn,$ruta_db_superior;
	$ruta_digitalizacion=busca_filtro_tabla("ruta_pantalla,nombre","pantalla A","A.nombre='digitalizacion_saia'","",$conn);
	?>
	var digitalizacion=$("input[name='digitalizar']:checked").val();
	if(digitalizacion==1){
		var adicional="";
		if($("#fk_idbpmni").val() && $("#fk_idbpmn_tarea").val()){
			adicional="bpmni="+$("#fk_idbpmni").val()+"&idbpmn="+$("#fk_idbpmn_tarea").val();
		}
		window.open("<?php echo($ruta_db_superior.$ruta_digitalizacion[0]["ruta_pantalla"]); ?>/<?php echo($ruta_digitalizacion[0]["nombre"]); ?>/adicionar_<?php echo($ruta_digitalizacion[0]["nombre"]); ?>.php?iddocumento="+objeto.documento_iddocumento+"&"+adicional+"&externo=1","_self");
		return false;
	}
	<?php
}
//Muestra la imagen del logo de la empresa
function logo_empresa(){
	global $conn,$ruta_db_superior;
	$configuracion=busca_filtro_tabla("","configuracion A","A.nombre='logo'","",$conn);
	return('<img src="'.PROTOCOLO_CONEXION.RUTA_PDF."/".$configuracion[0]["valor"].'">');
}
function mes($mes){
  switch ($mes){
    case 1:return "enero";
    case 2:return "febrero";
    case 3:return "marzo";
    case 4:return "abril";
    case 5:return "mayo";
    case 6:return "junio";
    case 7:return "julio";
    case 8:return "agosto";
    case 9:return "septiembre";
    case 10:return "octubre";
    case 11:return "noviembre";
    case 12:return "diciembre";
  }
}
?>
