<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
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
require_once($ruta_db_superior."class.funcionarios.php");
//include_once("funciones_binario.php");
// "Suma" permisos retornando el permiso consolidado considerando valores repetidos  o parciales 
function suma_permiso($per1,$per2){
  $arper1=str_split($per1);
  $arper2=str_split($per2);
  $perm=array_merge($arper1,$arper2);
  $perm=array_unique($perm);
  $perm= implode("", $perm);
  return($perm);
}

/****************************************************************************
 *
 * FUNCIONES DE PERMISOS SOBRE UNA TABLA debe existir la tabla permiso_tabla
 *
 *****************************************************************************/   

function asignar_permiso($idexpediente,$tipo,$tabla="expediente",$permiso=NULL,$idpropietario=NULL){ 
global $conn; 
$expediente=busca_filtro_tabla("",$tabla,"id".$tabla."=".$idexpediente,"",$conn);
// Exite un expediente coincidente 
if($expediente["numcampos"]>0){
  $permiso_expediente=busca_filtro_tabla("","permiso_".$tabla,$tabla."_id".$tabla."=".$idexpediente,"",$conn);
  // Ya esta el permiso creado para el expediente

  if($permiso_expediente["numcampos"]>0){ 
    // Se actualiza TODO permiso y propietario 
    //Cambio de propietario
    if($idpropietario!=NULL){ 
      //Se va a actualizar un permiso y a cambiar de propietario
      if($permiso!=NULL&&($tipo=="CARACTERISTICA_PROPIO"||$tipo=="CARACTERISTICA_DEPENDENCIA"||$tipo=="CARACTERISTICA_CARGO"||$tipo=="CARACTERISTICA_TOTAL")){  
        $sql="UPDATE permiso_".$tabla." set propietario=".$idpropietario.",".$tipo."='".$permiso."' WHERE ".$tabla."_id".$tabla."=".$idexpediente;
      }
      else  // Solo el propietario
        $sql="UPDATE permiso_".$tabla." set propietario=".$idpropietario." WHERE ".$tabla."_id".$tabla."=".$idexpediente;
      //echo $sql;   
      phpmkr_query($sql,$conn);
    }       
    elseif(/*$permiso!=NULL&&*/($tipo=="CARACTERISTICA_PROPIO"||$tipo=="CARACTERISTICA_DEPENDENCIA"||$tipo=="CARACTERISTICA_CARGO"||$tipo=="CARACTERISTICA_TOTAL")){ 
      //Se actualiza solo el permiso
      $sql="UPDATE permiso_".$tabla." set ".$tipo."='".$permiso."' WHERE ".$tabla."_id".$tabla."=".$idexpediente;
      //echo $sql;
      phpmkr_query($sql,$conn);
    }
  }
  elseif($idpropietario!=NULL&&$tipo=="CARACTERISTICA_PROPIO"){  
    // Se creea el permiso por primera vez
    //Asigna un permiso inicial  normalmente $tipo="CARACTERISTICA_PROPIO" por que es quien lo crea
    $sql="INSERT INTO permiso_".$tabla."(".$tabla."_id".$tabla.",idpropietario,$tipo) VALUES ($idexpediente,$idpropietario,'$permiso')";
    phpmkr_query($sql,$conn);
  }
  else{
    alerta( "El primer Permiso debe asignar el propietario");
  } 
}
else{
  alerta( "El permiso no puede asignarse el identificador no fue encontrado");
}  
}


// Retorna los permisos  sobre un anexo para un funcionario determinado toma en cuenta permisos del propietario dependencia y cargo
function func_permiso_expediente($idfunc,$idexpediente,$tabla="expediente"){ 
global $conn;	
$TOTAL="le"; // Se considera como "todos los permisos" para verificacion y evitar procesos innecesarios 
$permiso_expediente=busca_filtro_tabla("","permiso_".$tabla,$tabla."_id".$tabla."=".$idexpediente,"",$conn);
if($permiso_expediente["numcampos"]){
  // TODOS tienen todos los permisos  por rendimiento no es necesario mirar nada mas 
  if($permiso_expediente[0]["caracteristica_total"]==$TOTAL){
    return($TOTAL);
  }	      
  else{
    // Se busca 
	  $permisos=$permiso_expediente[0]["caracteristica_total"]; // Inicia con los permisos globales
  	$id_propietario=$permiso_expediente[0]["idpropietario"];
	  if($id_propietario==$idfunc){   
      // Es el propietario
      // Permisos totales  y permiso del cargo
      $permisos=suma_permiso($permisos,$permiso_expediente[0]["caracteristica_propio"]);
	    return($permisos);
	  }
	  else{
      // Se buscan permisos relacionados por cargo dependencia
      $datos_prop=busca_datos_administrativos_funcionario($id_propietario);
	    // print_r($datos_prop);
      $datos_func=busca_datos_administrativos_funcionario($idfunc);
	    //  print_r($datos_func);
	    if($permiso_expediente[0]["caracteristica_propio"]!=NULL){
        // Hay permisos definidos para los cargos 
		    $cargos_prop=$datos_prop["cargos"];
	      $cargos_func=$datos_func["cargos"];
	      $cargos_compartidos=array_intersect($cargos_prop,$cargos_func);
	      if(count($cargos_compartidos) > 0){
	        // El funcionario comparte cargos con el propietario
          // Permisos totales  y permiso del cargo
		      $permisos=suma_permiso($permisos,$permiso_expediente[0]["caracteristica_cargo"]);
		    }
	    }
	    if($permiso_expediente[0]["caracteristica_dependencia"]!=NULL){
        $dep_prop=$datos_prop["dependencias"];
	      $dep_func=$datos_func["dependencias"];
	      $dependencias_compartidas=array_intersect($dep_prop,$dep_func);
        if(count($dependencias_compartidas) > 0){
          // El funcionario comparte cargos con el propietario   
          // Concateno permisos totales  y permiso del cargo
		      $permisos=suma_permiso($permisos,$permiso_expediente[0]["caracteristica_dependencia"]);
	      }
	    }
	  } // Fin else  si no es propietario
    return($permisos); 
  } // Fin else principal   
}	   
else {
  return(''); // sin permisos sobre el anexo
} 
}

// Retorna los Vinculos con  las opciones adecuadas acorde al permiso del func sobre el anexos
// Tambien puede recibir un listado con restricciones para mostrar solo algunas opciones que debeb venir separadas or |
function acciones_tabla_usuario($idfunc,$idexpediente,$tabla,$campo_mostrar,$limita_accion=NULL){
global $conn,$ruta_db_superior;
$ruta=$ruta_db_superior;
if(!$idfunc){
  $idfunc=usuario_actual("idfuncionario");
}
//FILTRO VISUAL NO TIENE QUE VER CON PERMISOS REALES ES LO QUE SE PUEDE VISUALIZAR POR EJEMPLO EN EL MOSTRAR SOLO SE MUESTRA  DESCARGAR SIN ICONOS
if($limita_accion!=NULL)    
  $limita_accion=explode("|",$limita_accion);
else 
  $limita_accion=array("PERMISOS","ELIMINAR","EDITAR","ICONO");
$resultado="";   
$expediente=busca_filtro_tabla("",$tabla,"id".$tabla."=".$idexpediente,"",$conn);
if($expediente["numcampos"]){
  //OBTIENE LOS PERMISOS REALES   
  $permisos=func_permiso_expediente($idfunc,$idexpediente,$tabla);

  $arper1=str_split($permisos);
  $resultado="<table ><tr>"; 
  if(in_array("ENCABEZADO",$limita_accion))
    $resultado.="<td>".html_entity_decode($expediente[0][$campo_mostrar])."</td>";
  $resultado.=enlace_permiso_usuario("l",$arper1,"MOSTRAR",$limita_accion,$tabla,$idexpediente,$tabla."view.php","");
  $resultado.=enlace_permiso_usuario("e",$arper1,"ELIMINAR",$limita_accion,$tabla,$idexpediente,$tabla."delete.php","_delete");
  $resultado.=enlace_permiso_usuario("m",$arper1,"MODIFICAR",$limita_accion,$tabla,$idexpediente,$tabla."edit.php","_edit");
  /*Busca el propietario es el unico que puede asignar permisos*/  
  $datos_permisos=$permiso_expediente=busca_filtro_tabla("","permiso_".$tabla,$tabla."_id".$tabla."=".$idexpediente,"",$conn);
  if($datos_permisos["numcampos"]){ 
    if(in_array("ICONO",$limita_accion)){ 
   	  //enlace con icono
	    $objeto='<img name="permisos" src="'.$ruta.'botones/anexos/application_key.png" alt="Administrar Permisos">';    
	  }
	  else{ 
	   $objeto="Permisos";
    }
	  if($datos_permisos[0]["idpropietario"]==$idfunc && in_array("PERMISOS",$limita_accion)){
      // Si es el propietario ademas se agrega el permiso para modificar permisos
      $resultado.= '<td><div class="textwrapper">
		<a href="'.$ruta.'permiso_add.php?key='.$idexpediente.'&tabla='.$tabla.'" id="el_'.$idexpediente.'" class="highslide" onclick="return hs.htmlExpand( this, {
		objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
		outlineWhileAnimating: true, preserveContent: false } )">'.$objeto.'</a>
		</div></td>';
	  }
  }
$resultado.="</tr></table>";
}  
return ($resultado);
}
function enlace_permiso_usuario($accion,$arper1,$etiqueta_accion,$limita_accion,$tabla,$idexpediente,$enlace,$boton="view"){
global $ruta_db_superior;
$ruta=$ruta_db_superior;
$texto="";
  /*Ver Registro*/  
if (in_array ($accion, $arper1)&&in_array($etiqueta_accion,$limita_accion)){
  // Verifica el permismo y que no se pida solo mostrar la opcion de descarga
  if(in_array("ICONO",$limita_accion)){ 
    //enlace con icono 
	  $objeto='<img name="permisos" src="'.$ruta.'botones/anexos/application'.$boton.'.png" alt="'.$etiqueta_accion.'">';    
  }
  else{   
   $objeto="Ver";
  }
  $texto= '<td><div class="textwrapper">
	<a href="'.$ruta.$enlace.'?key='.$idexpediente.'" id="el_'.$idexpediente.'" target="_self">'.$objeto.'</a>
	</div></td>';
}
return($texto);	
}
function expediente_usuario($idfunc){
global $conn;
$funcionarios=array();
$datos_prop=busca_datos_administrativos_funcionario($idfunc);
$cargo_compartido=busca_filtro_tabla("","dependencia_cargo A,cargo B","A.cargo_idcargo=B.idcargo AND A.cargo_idcargo IN(".implode(",",$datos_prop["cargos"]).")","",$conn);
$dependencia_compartido=busca_filtro_tabla("","dependencia_cargo A,dependencia B","A.dependencia_iddependencia=B.iddependencia AND funcionario_idfuncionario IN(".implode(",",$datos_prop["dependencias"]).")","",$conn);
$cargos=extrae_campo($cargo_compartido,"funcionario_idfuncionario","U");
$dependencias=extrae_campo($dependencia_compartido,"funcionario_idfuncionario","U");
$funcionarios=array_unique(array_merge((array)$cargos,(array)$dependencias));
sort($funcionarios);
$expedientes=busca_filtro_tabla("","permiso_expediente","caracteristica_total LIKE '%l%' OR idpropietario IN(".implode(",",$funcionarios).")","",$conn);
return($expedientes);
}

?>
