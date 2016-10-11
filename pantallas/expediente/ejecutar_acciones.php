<?php
  $max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
  include_once($ruta_db_superior."db.php");
  include_once($ruta_db_superior."pantallas/expediente/librerias.php");  
if(@$_REQUEST["ejecutar_expediente"]){  
  if(!@$_REQUEST["tipo_retorno"]){
    $_REQUEST["tipo_retorno"]=1;
  }
  if($_REQUEST["tipo_retorno"]){
    echo(json_encode($_REQUEST["ejecutar_expediente"]()));
  }  
  else{
    $_REQUEST["ejecutar_expediente"]();
  }
}

function set_expediente(){
    $retorno=new stdClass;
    $retorno->exito=0;
    $retorno->mensaje="Error al guardar Prueba";
    $exito=0;
    $campos=array("nombre","descripcion","cod_padre","codigo","fecha", "serie_idserie", "codigo_numero", "fondo", "proceso", "fecha_extrema_i", "fecha_extrema_f", "no_unidad_conservacion", "no_folios", "no_carpeta", "soporte", "frecuencia_consulta", "ubicacion", "unidad_admin", "estado_archivo", "estado_cierre","fk_idcaja","notas_transf");
    $valores=array();
    foreach($campos AS $key=>$campo){
      if(@$_REQUEST[$campo]){
        array_push($valores,$_REQUEST[$campo]);
      }
      else{
        array_push($valores,"");
      }
    }
    $sql2="INSERT INTO expediente(".implode(",",$campos).",propietario,tomo_no) VALUES('".implode("','",$valores)."',".usuario_actual("funcionario_codigo").",1)";
    phpmkr_query($sql2);
    $idexpediente=phpmkr_insert_id();
    $cod_padre=busca_filtro_tabla("cod_arbol","expediente A","A.idexpediente=".$_REQUEST["cod_padre"],"",$conn);
    if($cod_padre["numcampos"]){
    	$codigo_arbol=$cod_padre[0]["cod_arbol"].".".$idexpediente;
    }
    else{
    	$codigo_arbol=$idexpediente;
    }
    $sql3="UPDATE expediente SET cod_arbol='".$codigo_arbol."' where idexpediente=".$idexpediente;
    phpmkr_query($sql3);
    $retorno->sql=$sql2;
    if($idexpediente){
		if (asignar_expediente($idexpediente, 1, usuario_actual("idfuncionario"), "m,e,p")) {
			$exito = 1;
		}
    }
    if($exito){
      $retorno->idexpediente=$idexpediente;
      $retorno->exito=1;
      $retorno->mensaje="Expediente guardado con &eacute;xito;"; 
    }
    return($retorno);
}


function set_expediente_documento(){
$retorno=new stdClass;
$retorno->exito=0;
$retorno->mensaje="Error al guardar Prueba";
$exito=0;
$campos=array("nombre","descripcion","cod_padre","codigo","fecha");
$valores=array();
foreach($campos AS $key=>$campo){
  if(@$_REQUEST[$campo]){
    array_push($valores,$_REQUEST[$campo]);
  }
  else{
    array_push($valores,"");
  }
}
$sql2="INSERT INTO expediente(".implode(",",$campos).",propietario) VALUES('".implode("','",$valores)."',".usuario_actual("funcionario_codigo").")";
phpmkr_query($sql2);
$idexpediente=phpmkr_insert_id();
$cod_padre=busca_filtro_tabla("cod_arbol","expediente A","A.idexpediente=".$_REQUEST["cod_padre"],"",$conn);
$sql3="UPDATE expediente SET cod_arbol='".$cod_padre[0]["cod_arbol"].".".$idexpediente."' where idexpediente=".$idexpediente;
phpmkr_query($sql3);
$retorno->sql=$sql2;
$sql4="INSERT INTO expediente_doc(expediente_idexpediente,documento_iddocumento,fecha) VALUES('".$idexpediente."', '".@$_REQUEST["iddoc"]."',".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").")";
phpmkr_query($sql4);
if($idexpediente){
  if(asignar_expediente($idexpediente,1,usuario_actual("idfuncionario"))){
    $exito=1; 
  }  
}
if($exito){
  $retorno->idexpediente=$idexpediente;
  $retorno->exito=1;
  $retorno->mensaje="Expediente guardado con &eacute;xito;"; 
}
return($retorno);
}
function update_expediente(){
$retorno=new stdClass;
$retorno->exito=0;
$retorno->mensaje="Error al guardar";
$exito=0;
$campos=array("nombre","descripcion","fecha","fk_idcaja","cod_padre", "codigo_numero", "fondo", "proceso", "fecha_extrema_i", "fecha_extrema_f", "no_unidad_conservacion", "no_folios", "no_carpeta", "soporte", "frecuencia_consulta", "ubicacion", "serie_idserie", "unidad_admin","notas_transf");
$valores=array();
$update=array();
foreach($campos AS $key=>$campo){
	$update[]=$campo."='".$_REQUEST[$campo]."'";
}

$antiguo=busca_filtro_tabla("cod_padre","expediente A","A.idexpediente=".$_REQUEST["idexpediente"],"",$conn);
$antiguo_padre=busca_filtro_tabla("idexpediente,cod_arbol","expediente A","A.idexpediente=".$antiguo[0]["cod_padre"],"",$conn);

$sql2="UPDATE expediente SET ".implode(",",$update)." WHERE idexpediente=".$_REQUEST["idexpediente"];
phpmkr_query($sql2);
$idexpediente=$_REQUEST["idexpediente"];

$cod_padre=busca_filtro_tabla("cod_arbol","expediente A","A.idexpediente=".$_REQUEST["cod_padre"],"",$conn);
if($cod_padre["numcampos"]){
	$codigo_arbol=$cod_padre[0]["cod_arbol"].".".$idexpediente;
}
else{
	$codigo_arbol=$idexpediente;
}
$sql3="UPDATE expediente SET cod_arbol='".$codigo_arbol."' where idexpediente=".$idexpediente;
phpmkr_query($sql3);
if($_REQUEST["cod_padre"]!=$antiguo[0]["cod_padre"]){
	$cod_nuevo=$codigo_arbol.".";
	if($antiguo_padre[0]["cod_arbol"]){
		$cod_antiguo=$antiguo_padre[0]["cod_arbol"].".".$idexpediente.".";
	}
	else{
		$cod_antiguo=$idexpediente.".";
	}
	$sql4="update expediente set cod_arbol=replace(cod_arbol,'".$cod_antiguo."','".$cod_nuevo."') where cod_arbol like '".$cod_antiguo."%'";
	phpmkr_query($sql4);
}
$retorno->sql=$sql2;
if($idexpediente){  
	$exito=1;
}
if($exito){
  $retorno->idexpediente=$idexpediente;
  $retorno->exito=1;
  $retorno->mensaje="Expediente actualizado con &eacute;xito"; 
}
return($retorno);
}

function delete_expediente(){
$retorno=new stdClass;
$retorno->exito=0;
$retorno->mensaje="Error al eliminar";
$exito=0;

$sql2="DELETE FROM expediente WHERE idexpediente=".$_REQUEST["idexpediente"];
phpmkr_query($sql2);
$sql3="DELETE FROM expediente_doc WHERE expediente_idexpediente=".$_REQUEST["idexpediente"];
phpmkr_query($sql3);
$sql4 = "DELETE FROM entidad_expediente WHERE expediente_idexpediente=" . $_REQUEST["idexpediente"];
phpmkr_query($sql4);
$idexpediente=$_REQUEST["idexpediente"];
$retorno->sql=$sql2;
if($idexpediente){
	$exito=1;
}
if($exito){
  $retorno->idexpediente=$idexpediente;
  $retorno->exito=1;
  $retorno->mensaje="Expediente eliminado con &eacute;xito"; 
}
return($retorno);
}


function crear_tomo_expediente(){
    global $conn,$ruta_db_superior;
    
    $retorno=new stdClass;
    $retorno->exito=0;
    $retorno->mensaje="Error al crear tomo";
    
    $idexpediente=$_REQUEST["idexpediente"];
    $expediente_actual=busca_filtro_tabla("tomo_padre","expediente","idexpediente=".$idexpediente,"",$conn);
    $tomo_padre=$idexpediente;
    if($expediente_actual[0]['tomo_padre']){
        $tomo_padre=$expediente_actual[0]['tomo_padre'];
    }

    $ccantidad_tomos=busca_filtro_tabla("idexpediente","expediente","tomo_padre=".$tomo_padre,"",$conn);
    $cantidad_tomos=$ccantidad_tomos['numcampos']+1; //tomos + el padre
    $tomo_siguiente=$cantidad_tomos+1; //tomo siguiente
    
    $datos_padre=busca_filtro_tabla("nombre,serie_idserie,tomo_no,estado_archivo,descripcion","expediente","idexpediente=".$tomo_padre,"",$conn);
    
    if(!$datos_padre[0]['tomo_no']){
        $up="UPDATE expediente SET tomo_no=1 WHERE idexpediente=".$tomo_padre;
        phpmkr_query($up);        
    }
    
   
    if( !is_numeric($datos_padre[0]['serie_idserie'])){
        $datos_padre[0]['serie_idserie']=0;
    }
    $sql="INSERT INTO expediente 
        (serie_idserie,nombre,fecha,propietario,ver_todos,editar_todos,tomo_padre,tomo_no,estado_archivo,descripcion) 
            VALUES 
                (".$datos_padre[0]['serie_idserie'].",'".$datos_padre[0]['nombre']."',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",".usuario_actual('funcionario_codigo').",0,0,".$tomo_padre.",".$tomo_siguiente.",".$datos_padre[0]['estado_archivo'].",'".$datos_padre[0]['descripcion']."')";
   // print_r($sql);die();            
    phpmkr_query($sql);
    $id_insertado=phpmkr_insert_id();
    if($id_insertado){
        
        if($id_insertado){
    		if (asignar_expediente($id_insertado, 1, usuario_actual("idfuncionario"), "m,e,p")) {
    			$exito = 1;
    		}
        }        
        
        $retorno->exito=1;
        $retorno->mensaje="Tomo creado con exito";   
        $retorno->insertado=$id_insertado;   
    }
    return($retorno);
}




function vincular_expediente_documento(){
$retorno=new stdClass;
$retorno->exito=0;
$retorno->mensaje="Error al guardar Prueba";
$exito=1;
if(!@$_REQUEST["expedientes"]){
  $retorno->exito=0;
  $retorno->mensaje="Debe seleccionar al menos 1 expediente";
}
elseif(!@$_REQUEST["iddoc"]){
  $retorno->exito=0;
  $retorno->mensaje="Debe seleccionar al menos 1 documento";
}
else{
  $lexpedientes=explode(",",$_REQUEST["expedientes"]);  
  $cant_expedientes=count($lexpedientes);
  for($i=0;$i<$cant_expedientes;$i++){
    $expediente=busca_filtro_tabla("","expediente_doc","expediente_idexpediente=".$lexpedientes[$i]." AND documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
    if(!$expediente["numcampos"]){
      $sql2="INSERT INTO expediente_doc(expediente_idexpediente,documento_iddocumento,fecha) VALUES(".$lexpedientes[$i].",".$_REQUEST["iddoc"].",".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").")";
      phpmkr_query($sql2);
      if(!phpmkr_insert_id()){
        $exito=0;
      }
    }      
  }
  if($exito){
    $retorno->exito=1;
    $retorno->mensaje="Todos los expedientes han sido vinculados";
  }
  else{
    $retorno->exito=1;
    $retorno->mensaje="Algunos expedientes han sido vinculados";
  }
}
return($retorno);
}
/*
function asignar_permiso_expediente(){
$retorno=new stdClass;
$retorno->exito=0;
$retorno->mensaje="Error al asignar el expediente";
if(@$_REQUEST["idexpediente"] && @$_REQUEST["tipo_entidad"]){  
  //$llaves_entidad=busca_filtro_tabla("idfuncionario","funcionario","funcionario_codigo IN(".$_REQUEST["entidad_identidad"].")","",$conn);
	$llaves_entidad=busca_filtro_tabla("distinct (funcionario_idfuncionario) as idfuncionario","dependencia_cargo","iddependencia_cargo IN(".$_REQUEST["entidad_identidad"].")","",$conn);
	if($_REQUEST["tipo_entidad"]==5)$_REQUEST["tipo_entidad"]=1;
	
	$funcionarios_almacenados=extrae_campo($llaves_entidad,"idfuncionario");
	
	$datos=busca_filtro_tabla("A.llave_entidad","entidad_expediente A","A.expediente_idexpediente=".$_REQUEST["idexpediente"]." AND A.entidad_identidad=1","",$conn);
  $datos_array=extrae_campo($datos,"llave_entidad","U");
	
	$quitar=array_diff($datos_array,$funcionarios_almacenados);
 	$quitar=array_merge($quitar);
 	
 	$adicionales=array_diff($funcionarios_almacenados,$datos_array);
 	$adicionales=array_merge($adicionales);
 
 	$cantidad_eliminar=count($quitar);
 	$cantidad_adicionar=count($adicionales);
	
	if($cantidad_eliminar){
 		$sql1="DELETE FROM entidad_expediente WHERE expediente_idexpediente=".$_REQUEST["idexpediente"]." AND entidad_identidad=1 AND llave_entidad IN(".implode(",",$quitar).")";
	 	phpmkr_query($sql1);
 	}
	
  $exito=1;
  if($cantidad_adicionar){
	  for($i=0;$i<$cantidad_adicionar;$i++){
	    if(asignar_expediente($_REQUEST["idexpediente"], $_REQUEST["tipo_entidad"], $adicionales[$i])){
	    }
	  }  
  }
  if($exito){
    $retorno->exito=1;
    $retorno->mensaje="Asignaciones al expediente realizadas con &eacute;xito";
  }
  else if($exito==0){
    $retorno->exito=0;  
    $retorno->mensaje="No se realizan asignaciones al expediente";
  }
  else{
    $retorno->exito=0;  
    $retorno->mensaje="Se realizan algunas asignaciones al expediente se presentan errores";
  }
}
return($retorno);
}*/
function asignar_permiso_expediente() {
	$retorno = new stdClass;
	$retorno -> exito = 0;
	$retorno -> mensaje = "Error al asignar el expediente";
	if (@$_REQUEST["idexpediente"] && @$_REQUEST["tipo_entidad"] && $_REQUEST["idfuncionario"] && $_REQUEST["propietario"] != "") {
		if ($_REQUEST["tipo_entidad"] == 5) {
			$_REQUEST["tipo_entidad"] = 1;
		}
		$sql1 = "DELETE FROM entidad_expediente WHERE expediente_idexpediente=" . $_REQUEST["idexpediente"] . " AND entidad_identidad=1 AND llave_entidad NOT IN(" . implode(",", $_REQUEST["idfuncionario"]) . "," . $_REQUEST["propietario"] . ")";
		phpmkr_query($sql1) or die($retorno);
		foreach ($_REQUEST["idfuncionario"] as $idfunc) {
			$permiso = "";
			if (isset($_REQUEST["permisos_" . $idfunc])) {
				$permiso = implode(",", $_REQUEST["permisos_" . $idfunc]);
			}
			asignar_expediente($_REQUEST["idexpediente"], $_REQUEST["tipo_entidad"], $idfunc, $permiso);
		}
		$exito = 1;
		if ($exito) {
			$retorno -> exito = 1;
			$retorno -> mensaje = "Asignaciones al expediente realizadas con &eacute;xito";
		} else if ($exito == 0) {
			$retorno -> exito = 0;
			$retorno -> mensaje = "No se realizan asignaciones al expediente";
		} else {
			$retorno -> exito = 0;
			$retorno -> mensaje = "Se realizan algunas asignaciones al expediente se presentan errores";
		}
	} else if (!$_REQUEST["idfuncionario"]) {
		$retorno -> exito = 2;
		$retorno -> mensaje = "Por favor ingrese los funcionarios";
	}
	return ($retorno);
}

function delete_documento_expediente(){
$retorno=new stdClass;
$retorno->exito=0;
$retorno->mensaje="Error al eliminar";
$exito=0;

$sql3="DELETE FROM expediente_doc WHERE documento_iddocumento=".$_REQUEST["iddocumento"]." AND expediente_idexpediente=".$_REQUEST["idexpediente"];
phpmkr_query($sql3);
$idexpediente=$_REQUEST["idexpediente"];
$retorno->sql=$sql3;
if($idexpediente){
	$exito=1;
}
if($exito){
  $retorno->idexpediente=$idexpediente;
  $retorno->exito=1;
  $retorno->mensaje="Documento eliminado de este expediente con exito"; 
}
return($retorno);
}
function abrir_cerrar_expediente(){
	global $conn;
	
	$retorno=new stdClass;
	$retorno->exito=0;
	$retorno->mensaje="Error al realizar la accion";
	
	$idexpediente=@$_REQUEST["idexpediente"];
	$accion=@$_REQUEST["accion"];
    $update_adicional='';
	if(intval($accion)==1){ //si abren expedidiente se retira de proxima transferencia documental
	    $update_adicional="prox_estado_archivo=0, ";
	   
	}
	
	$sql1="update expediente set ".$update_adicional."estado_cierre='".$accion."', fecha_cierre=".fecha_db_almacenar(date('Y-m-d'),'Y-m-d').", funcionario_cierre='".usuario_actual('idfuncionario')."' where idexpediente=".$idexpediente;
	phpmkr_query($sql1);
	
	

	
	$retorno->idexpediente=$idexpediente;
  $retorno->exito=1;
  $retorno->mensaje="Accion realizada";
  
  return($retorno);
}


function obtener_rastro_documento_expediente(){
	global $conn;
	
	
	$funcionario_radicador=busca_filtro_tabla("funcionario_codigo","funcionario","login='radicador_salida'","",$conn);
	$estados_validar=array("'borrador'","'transferido'","'revisado'","'aprobado'");
	$consulta=busca_filtro_tabla("destino","buzon_salida","archivo_idarchivo=".@$_REQUEST['iddoc']." AND tipo_destino=1 AND lower(nombre) IN(".implode(',',$estados_validar).") AND destino NOT IN(".$funcionario_radicador[0]['funcionario_codigo'].")","",$conn);
	
	$funs=busca_filtro_tabla("CONCAT(nombres,' ', apellidos)as nombre_funcionario","funcionario","funcionario_codigo IN(".implode(',',extrae_campo($consulta,'destino')).")","",$conn);
	
	$vector_nombres=extrae_campo($funs,'nombre_funcionario');
	$vector_nombres=array_map('strtolower',$vector_nombres);
	$vector_nombres=array_map('html_entity_decode',$vector_nombres);
	$vector_nombres=array_map('ucwords',$vector_nombres);
	$cadena_nombres=implode(', ',$vector_nombres);
	
	$retorno=new stdClass;
	$retorno->exito=1;
	$retorno->msn=$cadena_nombres;
	return($retorno);
	
}
function cambiar_responsable_expediente(){
	global $conn;
	
	$retorno=new stdClass;	
	$idexpediente=$_REQUEST['idexpediente'];
	
	
	$cantidad_folios=busca_filtro_tabla("","expediente","tomo_padre=".$idexpediente,"",$conn);
	if($cantidad_folios['numcampos']){ //tiene folios
	    $propietario_todos=1;
	    for($i=0;$i<$cantidad_folios['numcampos'];$i++){
	        if($cantidad_folios[0]['propietario']==''){
	            
	        }
	    }
	}
	
	$retorno->sql=$cantidad_folios['sql'];
	

	$retorno->exito=1;
	$retorno->msn='llego: '.$idexpediente;
	return($retorno);	
	
}



?>