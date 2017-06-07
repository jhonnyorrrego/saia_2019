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
$estilo='   style="font-size:10px; font-family: Verdana,Tahoma,arial;" ';

require_once($ruta_db_superior."db.php");
require_once($ruta_db_superior."class.funcionarios.php");
$extensiones= busca_filtro_tabla("valor","configuracion","nombre='extensiones_upload'","",$conn);
if($extensiones["numcampos"]>0)
 {
    $extensiones=str_replace(",","|",$extensiones[0]["valor"]);   
 } 
else  // Si no se encuentra en configuracion se restringe a unas extensiones basicas 
 { 
     $extensiones='jpg|gif|doc|ppt|xls|txt|pdf|pps|crd|cad|xlsx|docx|pptx|ppsx|pps|ppsx|swf|flv';
  }
//include_once("funciones_binario.php");

function suma_permiso($per1,$per2) // "Suma" permisos retornando el permiso consolidado considerando valores repetidos  o parciales 
{
  $arper1=str_split($per1);
  $arper2=str_split($per2);
  $perm=array_merge($arper1,$arper2);
  $perm=array_unique($perm);
  $perm= implode("", $perm);
  return($perm);
 }

/****************************************************************************
 *
 * FUNCIONES DE PERMISOS SOBRE LOS FORMATOS
 *
 *****************************************************************************/   

function asignar_permiso_formato($idformato,$tipo,$permiso=NULL,$idpropietario=NULL)
{ global $conn; 

  $formato=busca_filtro_tabla("","formato","idformato=".$idformato,"",$conn);

  if($formato["numcampos"]>0) // Exite un formato coincidente 
    {
     $permiso_formato=busca_filtro_tabla("","permiso_formato","permiso_formato.formato_idformato=".$idformato,"",$conn);
     //print_r($permiso_formato);
      if($permiso_formato["numcampos"]>0) // Ya esta el permiso creado para el formato
        { 
	   // Se actualiza TODO permiso y propietario 
	  
	      if($idpropietario!=NULL)   //Cambio de propietario
	      { 
		  //Se va a actualizar un permiso y a cambiar de propietario
	        if($permiso!=NULL&&($tipo=="CARACTERISTICA_PROPIO"||$tipo=="CARACTERISTICA_DEPENDENCIA"||$tipo=="CARACTERISTICA_CARGO"||$tipo=="CARACTERISTICA_TOTAL"))
	          {  
	            $sql="UPDATE permiso_formato set propietario=".$idpropietario.",".$tipo."='".$permiso."' WHERE formato_idformato=".$idformato;
      		  }
      		else  // Solo el propietario
	            $sql="UPDATE permiso_formato set propietario=".$idpropietario." WHERE formato_idformato=".$idformato;
		  //echo $sql;   
		phpmkr_query($sql,$conn);
		
	       }       
	      elseif($permiso!=NULL&&($tipo=="CARACTERISTICA_PROPIO"||$tipo=="CARACTERISTICA_DEPENDENCIA"||$tipo=="CARACTERISTICA_CARGO"||$tipo=="CARACTERISTICA_TOTAL"))  
	       { //Se actualiza solo el permiso
		$sql="UPDATE permiso_formato set ".$tipo."='".$permiso."' WHERE formato_idformato=".$idformato;
	        //echo $sql; 
		phpmkr_query($sql,$conn);
	       }
	}
     elseif($idpropietario!=NULL&&$tipo=="CARACTERISTICA_PROPIO")  // Se creea el permiso por primera vez 
        {  //Asigna un permiso inicial  normalmente $tipo="CARACTERISTICA_PROPIO" por que es quien lo crea
   	    
    	   $sql="INSERT INTO permiso_formato(formato_idformato,idpropietario,$tipo) VALUES ($idformato,$idpropietario,'$permiso')";
    	   echo $sql;
    	   phpmkr_query($sql,$conn);
	    }
	   else 
       {
           alerta( "El primer Permiso debe asignar el propietario del formato, ",'error');
         } 
 }
  else 
   {
     alerta( "El permiso no puede asignarse .. el identificador del anexo no fue encontrado",'error',4000);
   }  
}


// Retorna los permisos  sobre un anexo para un funcionario determinado toma en cuenta permisos del propietario dependencia y cargo
function func_permiso_formato($idfunc,$idformato) 
{ 
   global $conn;	
   $TOTAL="le"; // Se considera como "todos los permisos" para verificacion y evitar procesos innecesarios 
   $permiso_formato=busca_filtro_tabla("","permiso_formato","permiso_formato.formato_idformato=".$idformato,"",$conn);
  
   if($permiso_formato["numcampos"]>0)
    {
      if($permiso_formato[0]["caracteristica_total"]==$TOTAL) // TODOS tienen todos los permisos  por rendimiento no es necesario mirar nada mas 
      {
         return($TOTAL);
      }	      
      else // Se busca
      { 
	$permisos=$permiso_formato[0]["caracteristica_total"]; // Inicia con los permisos globales
	      
	 $id_propietario=$permiso_formato[0]["idpropietario"];
	 if($id_propietario==$idfunc) // Es el propietario 
	  {   // Permisos totales  y permiso del cargo
	      $permisos=suma_permiso($permisos,$permiso_formato[0]["caracteristica_propio"]);
	      return($permisos);
	  }
	 else	 // Se buscan permisos relacionados por cargo dependencia
	  {  
             $datos_prop=busca_datos_administrativos_funcionario($id_propietario);
	    // print_r($datos_prop);
             $datos_func=busca_datos_administrativos_funcionario($idfunc);
	   //  print_r($datos_func);
	    if($permiso_formato[0]["caracteristica_propio"]!=NULL) // Hay permisos definidos para los cargos
	     { 
		$cargos_prop=$datos_prop["cargos"];
	        $cargos_func=$datos_func["cargos"];
	        $cargos_compartidos=array_intersect($cargos_prop,$cargos_func);
	        if(count($cargos_compartidos) > 0) // El funcionario comparte cargos con el propietario  
	          {   // Permisos totales  y permiso del cargo
		      $permisos=suma_permiso($permisos,$permiso_formato[0]["caracteristica_cargo"]);
		  }
	     }
	    if($permiso_formato[0]["caracteristica_dependencia"]!=NULL) 
	    {
	        $dep_prop=$datos_prop["dependencias"];
	        $dep_func=$datos_func["dependencias"];
	        $dependencias_compartidas=array_intersect($dep_prop,$dep_func);
		if(count($dependencias_compartidas) > 0) // El funcionario comparte cargos con el propietario  
	          {   // Concateno permisos totales  y permiso del cargo
		      $permisos=suma_permiso($permisos,$permiso_formato[0]["caracteristica_dependencia"]);
	          }
	    }
	  
	  } // Fin else  si no es propietario
	
	 return($permisos); 
      } // Fin else principal 
      
    }	   
  else 
  {
   return(''); // sin permisos sobre el anexo
  } 
   
}



/****************************************************************************
 *
 * FUNCIONES DE PERMISOS SOBRE LOS ANEXOS
 *
 *****************************************************************************/   

function asignar_permiso($idanexo,$tipo,$permiso=NULL,$idpropietario=NULL)
{ global $conn; 
  $anexo=busca_filtro_tabla("","anexos","idanexos=".$idanexo,"",$conn);
   //print_r($permiso);die();
  if($anexo["numcampos"]>0) // 
    {
     $permiso_anexo=busca_filtro_tabla("","permiso_anexo","permiso_anexo.anexos_idanexos=".$idanexo,"",$conn);
     
      if($permiso_anexo["numcampos"]>0) // Ya esta el permiso creado para el anexo 
        { 
	   // Se actualiza TODO permiso y propietario 
	  
	      if($idpropietario!=NULL)   //Cambio de propietario
	      { 
		 // Se va a actualizar un permiso y a cambiar de propietario
	        if($permiso!=NULL&&($tipo=="CARACTERISTICA_PROPIO"||$tipo=="CARACTERISTICA_DEPENDENCIA"||$tipo=="CARACTERISTICA_CARGO"||$tipo=="CARACTERISTICA_TOTAL"))
	          {  
	            $sql="UPDATE permiso_anexo set propietario=".$idpropietario.",".$tipo."='".$permiso."' WHERE anexos_idanexos=".$idanexo;
		  }
		else  // Solo el propietario
	            $sql="UPDATE permiso_anexo set propietario=".$idpropietario." WHERE anexos_idanexos=".$idanexo;
		 //echo $sql;   
		phpmkr_query($sql,$conn);
		
	       }       
	      elseif($permiso!=NULL&&($tipo=="CARACTERISTICA_PROPIO"||$tipo=="CARACTERISTICA_DEPENDENCIA"||$tipo=="CARACTERISTICA_CARGO"||$tipo=="CARACTERISTICA_TOTAL"))  
	       { //Se actualiza solo el permiso
		$sql="UPDATE permiso_anexo set ".strtolower($tipo)."=".$permiso." WHERE anexos_idanexos=".$idanexo;
	        //echo $sql; 
		phpmkr_query($sql,$conn);
	       }
	}
     elseif($idpropietario!=NULL&&$tipo=="CARACTERISTICA_PROPIO")  // Se creea el permiso por primera vez 
        {  //Asigna un permiso inicial  normalmente $tipo="CARACTERISTICA_PROPIO" por que es quien lo crea
   	    
	   $sql="INSERT INTO permiso_anexo(anexos_idanexos,idpropietario,$tipo) VALUES ($idanexo,$idpropietario,'$permiso')";
	  // die( $sql);
	   phpmkr_query($sql,$conn);
	}
    }
  else 
   {
     alerta( "El permiso no puede asignarse .. el identificador del anexo no fue encontrado",'error',4000);
   }  
}


// Retorna los permisos  sobre un anexo para un funcionario determinado toma en cuenta permisos del propietario dependencia y cargo

function func_permiso_anexo($idfunc,$idanexo) 
{ 
   global $conn;	
   $TOTAL="le"; // Se considera como "todos los permisos" para verificacion y evitar procesos innecesarios 
   $permiso_anexo=busca_filtro_tabla("","permiso_anexo","permiso_anexo.anexos_idanexos=".$idanexo,"",$conn);
   if(@$_REQUEST["tipo"]==5)return($TOTAL);
   if($permiso_anexo["numcampos"]>0)
    {
      if($permiso_anexo[0]["caracteristica_total"]==$TOTAL) // TODOS tienen todos los permisos  por rendimiento no es necesario mirar nada mas 
      {
         return($TOTAL);
      }	      
      else // Se busca
      { 
	$permisos=$permiso_anexo[0]["caracteristica_total"]; // Inicia con los permisos globales
	      
	 $id_propietario=$permiso_anexo[0]["idpropietario"];
	 if($id_propietario==$idfunc) // Es el propietario 
	  {   
         // Permisos totales  y permiso del cargo
	      $permisos=suma_permiso($permisos,$permiso_anexo[0]["caracteristica_propio"]);
	      return($permisos);
	  }
	 else	 // Se buscan permisos relacionados por cargo dependencia
	  {  
             $datos_prop=busca_datos_administrativos_funcionario($id_propietario);
	    // print_r($datos_prop);
             $datos_func=busca_datos_administrativos_funcionario($idfunc);
	   //  print_r($datos_func);
	    if($permiso_anexo[0]["caracteristica_propio"]!=NULL) // Hay permisos definidos para los cargos
	     { 
		$cargos_prop=$datos_prop["cargos"];
	        $cargos_func=$datos_func["cargos"];
	        $cargos_compartidos=array_intersect($cargos_prop,$cargos_func);
	        if(count($cargos_compartidos) > 0) // El funcionario comparte cargos con el propietario  
	          {   // Permisos totales  y permiso del cargo
		      $permisos=suma_permiso($permisos,$permiso_anexo[0]["caracteristica_cargo"]);
		  }
	     }
	    if($permiso_anexo[0]["caracteristica_dependencia"]!=NULL) 
	    {
	        $dep_prop=$datos_prop["dependencias"];
	        $dep_func=$datos_func["dependencias"];
	        $dependencias_compartidas=array_intersect($dep_prop,$dep_func);
		if(count($dependencias_compartidas) > 0) // El funcionario comparte cargos con el propietario  
	          {   // Concateno permisos totales  y permiso del cargo
		      $permisos=suma_permiso($permisos,$permiso_anexo[0]["caracteristica_dependencia"]);
	          }
	    }
	  
	  } // Fin else  si no es propietario
	
	 return($permisos); 
      } // Fin else principal 
      
    }	   
  else 
  {
   return(''); // sin permisos sobre el anexo
  } 
   
}

// Retorna los Vinculos con  las opciones adecuadas acorde al permiso del func sobre el anexos
// Tambien puede recibir un listado con restricciones para mostrar solo algunas opciones que debeb venir separadas or |
function acciones_anexos_usuario($idfunc,$idanexo,$limita_accion=NULL,$num=-1){
  global $conn,$ruta_db_superior;
	$ruta=$ruta_db_superior;
//FILTRO VISUAL NO TIENE QUE VER CON PERMISOS REALES ES LO QUE SE PUEDE VISUALIZAR POR EJEMPLO EN EL MOSTRAR SOLO SE MUESTRA  DESCARGAR SIN ICONOS
 	if($limita_accion!=NULL)
  	$limita_accion=explode("|",$limita_accion);
  else
		$limita_accion = array(
				"PERMISOS",
				"ELIMINAR",
				"DESCARGAR",
				"ICONO",
				"PROPIETARIO",
				"EDITAR"
		);
  
 	$anexo=busca_filtro_tabla("","anexos","idanexos=".$idanexo,"",$conn);
 	$propietario=busca_filtro_tabla("nombres,apellidos,funcionario_codigo,idfuncionario","permiso_anexo,funcionario","idpropietario=idfuncionario and anexos_idanexos=".$idanexo,"",$conn);
  if($anexo["numcampos"]>0){
		//OBTIENE LOS PERMISOS REALES
    $permisos=func_permiso_anexo($idfunc,$idanexo);
    $arper1=str_split($permisos);
    $resultado="";
		if (html_entity_decode($anexo[0]["etiqueta"]) != "") {
    	$etiqueta=($anexo[0]["etiqueta"]);
		} else {
    	$etiqueta=substr(html_entity_decode($anexo[0]["ruta"]),(strrpos(html_entity_decode($anexo[0]["ruta"]),"/")+1));
		}
		if (in_array("ICONO", $limita_accion)) {
    	$resultado.=($etiqueta);
		}
    if(in_array ("l", $arper1)&&in_array("DESCARGAR",$limita_accion)){// Simpre se muestra la opcion de descarga
   		if(in_array("ICONO",$limita_accion)){ // IMPRIME CON ICONOS
   		
   		    if(@$_REQUEST['tipo']!=5){
   		        
					$ruta64 = base64_encode($anexo[0]["ruta"]);
					$resultado .= '<a title="Ver" class="" onclick="return top.hs.htmlExpand(this, { objectType: \'iframe\',width: 1000, height: 600,contentId:\'cuerpo_paso\', preserveContent:false} )" href="' . $ruta . 'pantallas/documento/visor_pdf.php?ruta=' . $ruta64 . '" border="0px"><img title="Descargar" src="' . $ruta . 'botones/anexos/application.png" style="border-width:0px; cursor:auto;" /></a>';
        
    		$resultado.='<a href="'.$ruta.'anexosdigitales/parsea_accion_archivo.php?idanexo='.$idanexo.'&accion=descargar" border="0px"><img title="Descargar" src="'.$ruta.'botones/anexos/application.png" style="border-width:0px; cursor:auto;" /></a>';	
   		    }
			} else { // ES SOLO LA OPCION DE DESCARGA SE IMPRIME EL LINK CON EL NOMBRE DEL ARCHIVO
				if(@$_REQUEST["tipo"]==5)
					$resultado.=($anexo[0]["etiqueta"]);
				else{
					$resultado.='<a title="Descargar" href="'.$ruta.'anexosdigitales/parsea_accion_archivo.php?idanexo='.$idanexo.'&accion=descargar" border="0px">'.($anexo[0]["etiqueta"]).'</a>';
				}
      }
    }
    if(in_array ("e", $arper1)&&in_array("ELIMINAR",$limita_accion)){// Verifica el permismo y que no se pida solo mostrar la opcion de descarga
    	if(in_array("ICONO",$limita_accion)){//enlace con icono
    		$objeto='<img title="Eliminar" name="permisos" src="'.$ruta.'botones/anexos/application_delete.png" style="border-width:0px">';
			} else {
    		$objeto="Eliminar";
    	}
  	  $resultado.= '<a href="'.$ruta.'anexosdigitales/borrar_anexos.php?idanexo='.$idanexo.'" id="el_'.$idanexo.'" class="highslide" onclick="return hs.htmlExpand( this, {objectType: \'iframe\', outlineWhileAnimating: true, width: 250 });">'.$objeto.'</a>';
	  }
	  if(in_array("m",$arper1)&&in_array("EDITAR",$limita_accion)){// Verifica el permismo y que no se pida solo mostrar la opcion de descarga
	  	if(in_array("ICONO",$limita_accion)){//enlace con icono
    		$objeto='<img title="Editar" name="editar" src="'.$ruta.'botones/anexos/application_edit.png" style="border-width:0px; cursor:wait;">';
			} else {
    		$objeto="Editar";
    	}
  	  $resultado.= '<a href="'.$ruta.'anexosdigitales/anexos_permiso_edit.php?idanexo='.$idanexo.'" id="el_'.$idanexo.'" class="highslide" onclick="return hs.htmlExpand(this,{objectType: \'iframe\', outlineWhileAnimating: true, width: 250,preserveContent:false } )" style="border-width:0px; cursor:auto;">'.$objeto.'</a>';
		}
    $datos_permisos=$permiso_anexo=busca_filtro_tabla("","permiso_anexo","permiso_anexo.anexos_idanexos=".$idanexo,"",$conn);
    if($datos_permisos["numcampos"]>0){ 
    	if(in_array("ICONO",$limita_accion)){//enlace con icono
    		$objeto='<img title="Permisos" name="permisos" src="'.$ruta.'botones/anexos/application_key.png" style="border-width:0px; cursor:wait;">';
			} else {
    		$objeto="Permisos";
    	}
	    if($datos_permisos[0]["idpropietario"]==$idfunc&&in_array("PERMISOS",$limita_accion)){// Si es el propietario ademas se agrega el permiso para modificar permisos
      	//$resultado.= '<a href="'.$ruta.'anexosdigitales/anexos_permiso_add.php?idanexo='.$idanexo.'" id="el_'.$idanexo.'" class="highslide" onclick="return hs.htmlExpand(this,{objectType: \'iframe\', outlineWhileAnimating: true, width: 250 } )" style="border-width:0px; cursor:auto;">'.$objeto.'</a>';
	     }
		}
   	if(!isset($_REQUEST["idfunc"])){ 
    	$idfunc=usuario_actual("id");
		} else {
    	$func=busca_filtro_tabla("idfuncionario","funcionario","funcionario_codigo=".$_REQUEST["idfunc"],"",$conn);
      $idfunc=$func[0][0];
    }  
		if ($idfunc != $propietario[0]["idfuncionario"] && (! isset($_REQUEST["tipo"]) || $_REQUEST["tipo"] == 1)) {
   		$objeto='<img title="Propietario&nbsp;del&nbsp;anexo:&nbsp;'.str_replace(" ","&nbsp;",$propietario[0]["nombres"]." ".$propietario[0]["apellidos"]).'" name="permisos" src="'.$ruta.'botones/anexos/application_home.png" style="border-width:0px;">';
      $resultado.= '<a>'.$objeto.'</a>';
		}
	}
	return ($resultado);
}


// Genera uan tabla con los anexos acciones para documentos o formatos 
function listar_anexos_documento($iddocumento, $idformato = NULL, $idcampo = NULL, $tipo = NULL, $limita_accion = NULL) {
	global $conn;
	if (!$limita_accion) {
		$limita_accion = "DESCARGAR|ELIMINAR|PERMISOS|PROPIETARIO|ICONO|ENCABEZADO|EDITAR";
	}
	if (!$idformato && !$idcampo) {//Se muestran todos los anexos
		$anexos = busca_filtro_tabla("a.*,d.estado", "anexos a,documento d", "a.documento_iddocumento=d.iddocumento and d.iddocumento=" . $iddocumento, "", $conn);
	} else {
		$anexos = busca_filtro_tabla("a.*,d.estado", "anexos a,documento d", "a.documento_iddocumento=d.iddocumento and d.iddocumento=" . $iddocumento . " AND a.formato=" . $idformato . " AND a.campos_formato=" . $idcampo, "", $conn);
	}
	if ($anexos["numcampos"] > 0) {
	    $impedir=0;
	    $conf=busca_filtro_tabla("valor","configuracion","tipo='anexos' and nombre='impedir_eliminar'","",$conn);
	    if($conf["numcampos"] && $conf[0]["valor"]==1){
	        $impedir=1;
	    }
		if (!isset($_REQUEST["idfunc"])) {
			$idfunc = usuario_actual("id");
		} else {
			$func = busca_filtro_tabla("idfuncionario", "funcionario", "funcionario_codigo=" . $_REQUEST["idfunc"], "", $conn);
			$idfunc = $func[0][0];
		}
		$array_estados=array('ACTIVO');// Por si necesitan agregar mas estados
		$arreglo_anexos = array();
		for ($i = 0; $i < $anexos["numcampos"]; $i++) {
        if(in_array($anexos[$i]["estado"],$array_estados) || $impedir==0){
		        $arreglo_anexos[] = acciones_anexos_usuario($idfunc, $anexos[$i]["idanexos"], $limita_accion, $i);
		    }else{// aplica solo a los subidos por el formato
		        if($anexos[$i]["campos_formato"]=="" || $anexos[$i]["campos_formato"]==0){
		          $arreglo_anexos[] = acciones_anexos_usuario($idfunc, $anexos[$i]["idanexos"], $limita_accion, $i); 
		        }else{
		          $arreglo_anexos[] = acciones_anexos_usuario($idfunc, $anexos[$i]["idanexos"], "DESCARGAR|ICONO|ENCABEZADO", $i); 
		        }
		    }
		}
		if (in_array("ENCABEZADO", explode("|", $limita_accion)) && $arreglo_anexos) {
			$tabla .= '<table>';
			$tabla .= '<tr><td class="encabezado_list" colspan="4">Anexos Digitales</td></tr>';
			$tabla .= '<tr><td style="text-align:right">';
			$tabla .= implode('</td></tr><tr><td style="text-align:right">', $arreglo_anexos);
			$tabla .= '</td></tr>';
			$tabla .= '</table>';
		} else {
			$tabla .= implode(", ", $arreglo_anexos);
		}
	} else {
		$tabla = "";
	}
	return ($tabla);
}

/**
 * Recibe el id del anexo y opcinalmente el id del binario para descargar archivos o desde la bd respectivamente
 * @param int $id
 * @param string $tipo_al
 */
function descargar_archivo($id,$tipo_al=NULL) {
	global $conn;

	if (! $tipo_al) { // Si no se solicita directamente el origen (BD O ARCHIVO ) se busca en configuracion cual se va a descargar
     	$config = busca_filtro_tabla("valor","configuracion","nombre='tipo_almacenamiento'","",$conn);
       if($config["numcampos"])
         $tipo_al=$config[0]['valor'];
        else 
         $tipo_al="archivo"; // Si no encuentra el registro en configuracion almacena en archivo
     }

	if ($tipo_al == "archivo") {
    $datos=busca_filtro_tabla("","anexos","idanexos=".$id,"",$conn);

		if (! $datos["numcampos"]) {
       alerta('problema con el archivo anexo','error',4000);
		} else {
      $file=$datos[0]["ruta"];  
      }

		$arr_alm = StorageUtils::resolver_ruta($file);
		$almacenamiento = $arr_alm["clase"];
		$fs = $almacenamiento->get_filesystem();

		if (!$fs->has($arr_alm["ruta"])) {
			return;
		}

		$archivo = $fs->get($arr_alm["ruta"]);
  	header("Content-Type: application/octet-stream");
		header("Content-Size: " . $archivo->getSize());
  	header("Content-Disposition: attachment; filename=\"".html_entity_decode($datos[0]["etiqueta"])."\"");
		header("Content-Length: " . $archivo->getSize());
  	header("Content-transfer-encoding: binary");
		echo $archivo->getContent();
		exit();
	} elseif ($tipo_al == "db") { // almacenamiento binario
		$anexo = busca_filtro_tabla("ruta", "anexos", "idanexos='$id'", "", $conn);
    $archivo=busca_filtro_tabla("nombre_original,datos","binario","idbinario=".$anexo[0]["ruta"],"",$conn);

       $nomb_limpio = ereg_replace("[^A-Za-z0-9._]", "",$archivo[0]['nombre_original']);
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment; filename=".$nomb_limpio); 	
        echo $archivo[0]['datos'];
		exit();
   }
  }

/*Esta funcion vincula un archivo ya existente en $ruta_origen en tipo se define si se hace una copia del mismo o se crea solamente el enlace*/
function vincular_archivo($idcampo,$idformato,$iddoc,$ruta_origen,$ruta_destino="",$nombre="",$tipo=0){
global $conn;
$resultado=NULL;
$larchivos=array();
$campo=busca_filtro_tabla("A.*,B.nombre AS formato,B.nombre_tabla","campos_formato A,formato B","A.formato_idformato=B.idformato AND idcampos_formato IN(".implode(",",$idcampo).") AND etiqueta_html='archivo'","",$conn);
if($campo["numcampos"]){
  $config = busca_filtro_tabla("valor","configuracion","nombre='tipo_almacenamiento'","",$conn);
  if($config["numcampos"]){
  	$tipo_almacenamiento=$config[0]["valor"];
  }
  else
     $tipo_almacenamiento="archivo"; // Si no encuentra el registro en configuracion almacena en archivo
  for($i=0;$i<$campo["numcampos"];$i++){
    echo($ruta_origen."<br />");
    if(is_file($ruta_origen) && filesize($ruta_origen)){

        $datos_anexo=pathinfo($ruta_origen);
        if($nombre=="")
          $nombre=$datos_anexo["filename"];
        $temp_filename = time().".".$datos_anexo["extension"];
        $dir_anexos=selecciona_ruta_anexos($campo[$i]["formato"],$iddoc,$tipo_almacenamiento,$ruta_destino);
        if (file_exists($dir_anexos . $temp_filename)){
          $tmpVar = 1;
  	  		while(file_exists($dir_anexos. $tmpVar . '_' . $temp_filename)){
  				  $tmpVar++;
  	   		}
          $temp_filename=$tmpVar . '_' . $temp_filename;
        }
        if(is_file($ruta_origen) && is_dir($dir_anexos))
          $resultado=copy($ruta_origen,$dir_anexos.$temp_filename);
        if($resultado){
          echo("Archivos Copiados a:".$dir_anexos);
          if($tipo_almacenamiento=="archivo"){ // Los anexos estan guardados en archivos
            $sql="INSERT INTO anexos(documento_iddocumento,ruta,tipo,etiqueta,formato,campos_formato,fecha_anexo) values(".$iddoc.",'".$dir_anexos.$temp_filename."','".$datos_anexo["extension"]."','".$nombre."'".",".$idformato.",".$campo[$i]["idcampos_formato"].",".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').")";
            phpmkr_query(($sql),$conn) or alerta("No se puede Adicionar el Anexo ".$ruta_origen,'error',4000);
            $idanexo=phpmkr_insert_id();
            //echo("<br />SQL:".$sql."<br />");
          }
          elseif($tipo_almacenamiento=="db"){
            phpmkr_query("INSERT INTO binario(nombre_original) VALUES ('$nombre')", $conn);
          	$idbin = phpmkr_insert_id();
          	$fcont=fopen($ruta_db_superior.$dir_anexos.$temp_filename,"rb");
          	$cont=fread($fcont,filesize($ruta_db_superior.$dir_anexos.$temp_filename));
          	if(guardar_lob("datos","binario","idbinario=$idbin",$cont,$ruta_origen,$conn)){
          	 phpmkr_query("INSERT INTO anexos(ruta,documento_iddocumento,tipo,etiqueta,formato,campos_formato,fecha_anexo) VALUES ('$idbin',".$iddoc.",'".$datos_anexo["extension"]."','".$nombre."',".$idformato.",".$campo[$i]["idcampos_formato"].",".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').")", $conn);
          	 $idanexo=phpmkr_insert_id();
            	if($idanexo){
                unlink($dir_anexos.$temp_filename); // Se elimina el temporal .. el blob se almaceno correctamente si se desea una copia tipo debe estar en 0

            }
            else {
              alerta("No se puede Adicionar el Anexo ".$ruta_origen,'error',4000);
              return(FALSE);
            }

          	}
          }
          if($idanexo && !$tipo){
              unlink($ruta_origen); // Se elimina el temporal .. el blob se almaceno correctamente si se desea una copia tipo debe estar en 0

          }
          if(!$idanexo){
            alerta("No se puede Adicionar el Anexo ".$ruta_origen,'error',4000);
            return(FALSE);
          }
          if($idanexo)
            array_push($larchivos,$idanexo);
        }
        else {
          alerta("Se ha generado un error al tratar de copiar el archivo ".$nombre." a la carpeta ".$dir_anexos,'error',4000);
          return(FALSE);
        }
    }
  }
  $sql="UPDATE ".$campo[0]["nombre_tabla"]." SET ".$campo[0]["nombre"]." = '".implode(",",$larchivos)."' WHERE id".$campo[0]["nombre_tabla"]."=".$iddoc;
  phpmkr_query($sql,$conn);
}
return TRUE;
}

function cargar_archivo($iddoc, $permisos_anexos, $formato = NULL, $campo = NULL) {
	global $conn;

	$resultado = NULL;
	$larchivos = array();
	$permisos = array();
	$aux_permisos = explode("|", $permisos_anexos);

	$max_salida = 10;
	$ruta_db_superior = $ruta = "";
	while ($max_salida > 0) {
		if (is_file($ruta . "db.php")) {
			$ruta_db_superior = $ruta;
		}
		$ruta .= "../";
		$max_salida--;
	}

	if ($ruta_db_superior == "")
		$salir = "../" . $ruta_db_superior;
	else
		$salir = $ruta_db_superior;

	for($i = 0; $i < count($aux_permisos); $i ++) {
		$fila = explode(";", $aux_permisos[$i]);
		$permisos[$fila[0]]["propio"] = @$fila[1];
		$permisos[$fila[0]]["dependencia"] = @$fila[2];
		$permisos[$fila[0]]["cargo"] = @$fila[3];
		$permisos[$fila[0]]["total"] = @$fila[4];
	}

	$config = busca_filtro_tabla("valor", "configuracion", "nombre='tipo_almacenamiento'", "", $conn);
	if ($config["numcampos"]) {
		$tipo_almacenamiento = $config[0]["valor"];
	} else {
		$tipo_almacenamiento = "archivos";
	}
	if ($tipo_almacenamiento == "archivo") {
		$tipo_almacenamiento = "archivos";
	}
	$almacenamiento = new SaiaStorage($tipo_almacenamiento);
	for ($j = 0; @$_FILES['anexos']['name'][$j]; $j++) {
		if (is_uploaded_file($_FILES['anexos']['tmp_name'][$j]) && $_FILES['anexos']['size'][$j]) {
			$nombre = htmlentities(decodifica_encabezado($_FILES['anexos']['name'][$j]));
			$datos_anexo = pathinfo($_FILES['anexos']['name'][$j]);
			$temp_filename = uniqid() . "." . $datos_anexo["extension"];
			$dir_anexos = selecciona_ruta_anexos2($iddoc, $tipo_almacenamiento);

			/*
			 * if (!is_dir($dir_anexos))
			 * mkdir($salir . $dir_anexos, 0777);
			 */

			if (is_file($_FILES['anexos']['tmp_name'][$j])) {
				$resultado = $almacenamiento->copiar_contenido_externo($_FILES['anexos']['tmp_name'][$j], $dir_anexos . $temp_filename);
				// $resultado = rename($_FILES['anexos']['tmp_name'][$j], $dir_anexos . $temp_filename);
				// chmod($dir_anexos.$temp_filename,PERMISOS_ARCHIVOS);
			}
			if ($resultado) {
				if ($tipo_almacenamiento == "archivos") {
					$dir_anexos_1 = array(
							"servidor" => $almacenamiento->get_ruta_servidor(),
							"ruta" => $dir_anexos . $temp_filename
					);
					/*
					 * if ($dir_anexos_1 == '../')
					 * $dir_anexos = substr($dir_anexos, 3);
					 */
					if ($formato != NULL && $campo != NULL) {
						$sql1 = "INSERT INTO anexos(documento_iddocumento,ruta,tipo,etiqueta,formato,campos_formato,fecha_anexo) values(" . $iddoc . ",'" . json_encode($dir_anexos_1) . "','" . $datos_anexo["extension"] . "','" . $nombre . "'" . "," . $formato . "," . $campo . "," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ")";
					} else {
						$sql1 = "INSERT INTO anexos(documento_iddocumento,ruta,tipo,etiqueta,fecha_anexo) values(" . $iddoc . ",'" . json_encode($dir_anexos_1) . "','" . $datos_anexo["extension"] . "','" . $nombre . "'" . "," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ")";
					}
					//phpmkr_query($sql1, $conn) or alerta("No se puede Adicionar el Anexo " . $_FILES['anexos']['name'][$j], 'error', 4000);
					phpmkr_query($sql1, $conn) or die($sql1);
					$idanexo = phpmkr_insert_id();
				} elseif ($tipo_almacenamiento == "db") {
					phpmkr_query("INSERT INTO binario(nombre_original) VALUES ('$nombre')", $conn);
					$idbin = phpmkr_insert_id();
					$fcont = fopen($salir . $dir_anexos . $temp_filename, "rb");
					$cont = fread($fcont, filesize($ruta_db_superior . $dir_anexos . $temp_filename));
					if (guardar_lob("datos", "binario", "idbinario=$idbin", $cont, "archivo", $conn)) {

						$sql = "INSERT INTO anexos(ruta,documento_iddocumento,tipo,etiqueta,formato,campos_formato,fecha_anexo) VALUES ('$idbin'," . $iddoc . ",'" . $datos_anexo["extension"] . "','" . $nombre . "','" . $formato . "','" . $campo . "'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ")";
						phpmkr_query($sql, $conn);
						$idanexo = phpmkr_insert_id();
						if ($idanexo) {
							// EN EL MOMENTO SE HACE ALMACENAMIENTO DUAL
							//unlink($dir_anexos.$temp_filename); // Se elimina el temporal .. el blob se almaceno correctamente
						} else
							alerta("No se puede Adicionar el Anexo " . $_FILES['anexos']['name'][$j],'error',4000);
					}
				}
				if ($idanexo) {
					if (array_key_exists($nombre, $permisos)) {
						$propio = $permisos[$nombre]["propio"];
						$dependencia = $permisos[$nombre]["dependencia"];
						$cargo = $permisos[$nombre]["cargo"];
						$total = $permisos[$nombre]["total"];
					} else {
						$propio = "lem";
						$dependencia = "";
						$cargo = "";
						$total = "l";
					}
					$sql_permiso = "insert into permiso_anexo(anexos_idanexos,idpropietario,caracteristica_propio,caracteristica_dependencia,caracteristica_cargo,caracteristica_total) values('$idanexo','" . usuario_actual("idfuncionario") . "','$propio','$dependencia','$cargo','$total')";
					phpmkr_query($sql_permiso, $conn);
				}
			}
		}
	}
	return;
}

function cargar_archivo_formato($idcampo,$idformato,$iddoc){
global $conn;
$resultado=NULL;
$larchivos=array();
	$permisos = array();
	$aux_permisos = explode("|", $_REQUEST["permisos_anexos"]);

$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
	while($max_salida > 0) {
		if (is_file($ruta . "db.php")) {
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}

	for($i = 0; $i < count($aux_permisos); $i ++) {
		$fila = explode(";", $aux_permisos[$i]);
		$permisos[$fila[0]]["propio"] = @$fila[1];
		$permisos[$fila[0]]["dependencia"] = @$fila[2];
		$permisos[$fila[0]]["cargo"] = @$fila[3];
		$permisos[$fila[0]]["total"] = @$fila[4];
   }

//die();
$campo=busca_filtro_tabla("A.*,B.nombre AS formato,B.nombre_tabla","campos_formato A,formato B","A.formato_idformato=B.idformato AND idcampos_formato IN(".implode(",",$idcampo).") AND etiqueta_html='archivo'","",$conn);

if($campo["numcampos"]){
  $config = busca_filtro_tabla("valor","configuracion","nombre='tipo_almacenamiento'","",$conn);
  if($config["numcampos"]){
  	$tipo_almacenamiento=$config[0]["valor"];
		} else {
			$tipo_almacenamiento = "archivos"; // Si no encuentra el registro en configuracion almacena en archivo
  }
		if ($tipo_almacenamiento == "archivo") {
			$tipo_almacenamiento = "archivos";
		}
		$almacenamiento = new SaiaStorage($tipo_almacenamiento);
		//print_r($campo); echo "<br>";
		//print_r($_FILES);die();
  for($i=0;$i<$campo["numcampos"];$i++){
    for($j=0;$_FILES[$campo[$i]["nombre"]]['name'][$j];$j++){
				$nombre = htmlentities(decodifica_encabezado($_FILES[$campo[$i]["nombre"]]['name'][$j]));
      if(is_uploaded_file($_FILES[$campo[$i]["nombre"]]['tmp_name'][$j]) && $_FILES[$campo[$i]["nombre"]]['size'][$j]){
					$datos_anexo = pathinfo($nombre);
					$temp_filename = uniqid() . "." . $datos_anexo["extension"];
					$dir_anexos = selecciona_ruta_anexos2($iddoc, $tipo_almacenamiento);
       
					//print_r(is_file($_FILES[$campo[$i]["nombre"]]['tmp_name'][$j]));die();
					if (is_file($_FILES[$campo[$i]["nombre"]]['tmp_name'][$j])) {
						$resultado = $almacenamiento->copiar_contenido_externo($_FILES[$campo[$i]["nombre"]]['tmp_name'][$j], $dir_anexos . $temp_filename);
						//print_r($resultado);die();
						//$resultado = copy($_FILES[$campo[$i]["nombre"]]['tmp_name'][$j], $dir_anexos . $temp_filename);
					}
        if($resultado){
						if ($tipo_almacenamiento == "archivos") { // Los anexos estan guardados en archivos
							$dir_anexos_1 = array(
									"servidor" => $almacenamiento->get_ruta_servidor(),
									"ruta" => $dir_anexos . $temp_filename
							);
							$sql1 = "INSERT INTO anexos(documento_iddocumento,ruta,tipo,etiqueta,formato,campos_formato,fecha_anexo) values(" . $iddoc . ",'" . json_encode($dir_anexos_1) . "','" . $datos_anexo["extension"] . "','" . $nombre . "'" . "," . $idformato . "," . $campo[$i]["idcampos_formato"] . "," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ")";
							// die($sql1);
							//phpmkr_query(($sql1), $conn) or alerta("No se puede Adicionar el Anexo " . $nombre, 'error', 4000);
							phpmkr_query($sql1) or die($sql1);
            $idanexo=phpmkr_insert_id();
            //echo("<br />SQL:".$sql."<br />");
						} elseif ($tipo_almacenamiento == "db") {
            phpmkr_query("INSERT INTO binario(nombre_original) VALUES ('$nombre')", $conn);
            $idbin = phpmkr_insert_id();
          	$fcont=fopen($ruta_db_superior.$dir_anexos.$temp_filename,"rb");
          	$cont=fread($fcont,filesize($ruta_db_superior.$dir_anexos.$temp_filename));

//function guardar_lob($campo,$tabla,$condicion,$contenido,$tipo,$conn,$log=1)
		if(guardar_lob("datos","binario","idbinario=$idbin",$cont,"archivo",$conn)){
          	 phpmkr_query("INSERT INTO anexos(ruta,documento_iddocumento,tipo,etiqueta,formato,campos_formato,fecha_anexo) VALUES ('$idbin',".$iddoc.",'".$datos_anexo["extension"]."','".$nombre."',".$idformato.",".$campo[$i]["idcampos_formato"].",".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').")", $conn);
          	 $idanexo=phpmkr_insert_id();
          	 if($idanexo){
			  // EN EL MOMENTO SE HACE ALMACENAMIENTO DUAL NO SE BORRA EL ARCHIVO
              //unlink($dir_anexos.$temp_filename); // Se elimina el temporal .. el blob se almaceno correctamente
								} else
									alerta("No se puede Adicionar el Anexo xx" . $nombre, 'error', 4000);
          	}
          }
          if($idanexo){
            $update="UPDATE ".$campo[$i]["nombre_tabla"]." SET ".$campo[$i]["nombre"]."=".$idanexo." WHERE id".$campo[$i]["nombre_tabla"]."=".$iddoc;
            phpmkr_query($update);
            array_push($larchivos,$idanexo);
             
							if (array_key_exists($nombre, $permisos)) {
								$propio = $permisos[$nombre]["propio"];
               $dependencia=$permisos[$nombre]["dependencia"];
               $cargo=$permisos[$nombre]["cargo"];
               $total=$permisos[$nombre]["total"];
							} else {
								$propio = "lem";
               $dependencia="";
               $cargo="";
               $total="l";
              }  
            $sql_permiso="insert into permiso_anexo(anexos_idanexos,idpropietario,caracteristica_propio,caracteristica_dependencia,caracteristica_cargo,caracteristica_total) values('$idanexo','".usuario_actual("idfuncionario")."','$propio','$dependencia','$cargo','$total')";
            phpmkr_query($sql_permiso,$conn);
          }
					} else {
          alerta("!Se ha generado un error al tratar de copiar el archivo ".$nombre,'error',4000);
        }
      }
    }
  }
		$sql1 = "UPDATE " . $campo[0]["nombre_tabla"] . " SET " . $campo[0]["nombre"] . " = '" . implode(",", $larchivos) . "' WHERE id" . $campo[0]["nombre_tabla"] . "=" . $iddoc;
		phpmkr_query($sql1, $conn);
}
return;
}

function selecciona_ruta_anexos_old($formato, $iddoc, $almacenamiento, $ruta="") {
	global $conn;
	global $ruta_db_superior;
	$ruta_anexos=ruta_almacenamiento("archivos");
	include_once($ruta_db_superior . "pantallas/lib/librerias_archivo.php");
	$formato_ruta = aplicar_plantilla_ruta_documento($iddoc);
	//$dir=$ruta_anexos.$datos_doc[0]["estado"]."/".$datos_doc[0]["fecha"]."/".$iddoc."/anexos";
	$dir=$ruta_anexos . $formato_ruta . "/anexos";
	
	if($almacenamiento=="archivo") {
	   if($ruta=="") {
	        $ruta=$dir."/";
	    }
	} else {
	  if($ruta=="")
	    $ruta=RUTA_DISCO."/anexos/temporal/";
	}
	if(verifica_ruta($ruta)) {
	  return($ruta);
	}
	return(FALSE);
}

function selecciona_ruta_anexos2($iddoc, $almacenamiento, $ruta="") {
	global $conn;
	global $ruta_db_superior;
	// $ruta_anexos=ruta_almacenamiento("archivos");
	include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");
	$formato_ruta = aplicar_plantilla_ruta_documento($iddoc);
	// $dir=$ruta_anexos.$datos_doc[0]["estado"]."/".$datos_doc[0]["fecha"]."/".$iddoc."/anexos";
	$dir = $formato_ruta . "/anexos";

	if ($almacenamiento == "archivos") {
		if ($ruta == "") {
			$ruta = $dir . "/";
		}
	} else {
		if ($ruta == "") {
			$ruta = RUTA_DISCO . "/anexos/temporal/";
		}
	}
	return ($ruta);
}


function verifica_ruta($ruta) {
	//$ruta = RUTA_DISCO."/".$ruta;
	if(!is_dir($ruta)) {
	  if(!mkdir($ruta, 0777, true)) {
	   alerta("La carpeta ".$ruta." No se ha podido Crear.",'error',4000);
	   return(FALSE);
	  }
	}
	if(is_dir($ruta)) {
	  return(true);
	} else {
	  return(true);
	}
}


function borrar($idanexo) {
  global $conn,$ruta_db_superior;
  $config = busca_filtro_tabla("valor","configuracion","nombre='tipo_almacenamiento'","",$conn);
  $anexo=busca_filtro_tabla("","anexos","idanexos=".$idanexo,"",$conn);
  if($anexo["numcampos"]>0)
		if ($anexo[0]['idbinario'] != '' && $anexo[0]['idbinario'] != NULL) {// Evita errores si el binario no fue bien almacenado y no se asocio
       $sql1="DELETE FROM binario WHERE idbinario=".$anexo[0]['idbinario'];
        phpmkr_query($sql1,$conn); 
     }  
		/*
	 * $pos=substr_count($_SERVER["PHP_SELF"],"/"); // Se busca la posicion relatia respecto a la RAIZ
	 * $relativo_raiz='';
	 * for($i=0;$i<$pos-2;$i++)
	 * $relativo_raiz.='../';
	 * $file=$relativo_raiz.$anexo[0]["ruta"];
	 */
	$arr_origen = StorageUtils::resolver_ruta($anexo[0]["ruta"]);
   //hago copia del archivo en la carpeta backup/eliminados
   $info=busca_filtro_tabla("","anexos","idanexos=".$idanexo,"",$conn);
	$alm_eliminados = new SaiaStorage(RUTA_BACKUP_ELIMINADOS);

	$carpeta_eliminados = $info[0]["documento_iddocumento"];
   $nombre=$carpeta_eliminados."/".date("Y-m-d_H_i_s")."_".$info[0]["etiqueta"];
   
	$alm_origen = $arr_origen["clase"];

	if ($alm_origen->get_filesystem()->has($arr_origen["ruta"])) {
		//rename($file, $ruta_db_superior . $nombre);
		//$nombre_anexo=basename($arr_origen["ruta"]);
		$resultado=$alm_origen->copiar_contenido($alm_eliminados, $arr_origen["ruta"], $nombre);
		$alm_origen->get_filesystem()->delete($arr_origen["ruta"]);
	}
    
    $sql2="DELETE FROM anexos WHERE idanexos=".$idanexo; 
    phpmkr_query($sql2,$conn); 
    
    $x_detalle= "Identificador: ".$info[0]["idanexos"]." ,Nombre: ".$info[0]["etiqueta"];
    registrar_accion_digitalizacion($info[0]["documento_iddocumento"],'ELIMINACION ANEXO',$x_detalle);
}  

function eliminar_archivo($idanexo,$idcampo,$idformato,$iddoc){
global $conn;
$formato=busca_filtro_tabla("B.*,A.nombre_tabla","formato A,campos_formato B","A.idformato=B.formato_idformato AND B.idcampos_formato=".$idcampo,"",$conn);
if($formato["numcampos"]){
  $anexos=busca_filtro_tabla("","anexos","formato=".$idformato." AND documento_iddocumento=".$iddoc." AND campos_formato=".$idcampo,"",$conn);
  if($anexos){
    $arreglo1=extrae_campo($anexos,"idanexos","U");
    $arreglo2=explode(",",$idanexo);
    $actualizados=array_diff($arreglo1,$arreglo2);
    //$anexos=
   // print_r($arreglo2);
    if(count($arreglo2)){
      for($i=0;$i<count($arreglo2);$i++){
       $sql="DELETE FROM anexos WHERE idanexos =".$idanexo;
	//phpmkr_query($sql,$conn);
	echo $sql;
	// Borro los Permisos
	$sql="DELETE FROM permiso_anexo WHERE anexos_idanexos =".$idanexo;
	//phpmkr_query($sql,$conn);
	echo $sql;
      }
      $sql="UPDATE ".$formato[0]["nombre_tabla"]." SET ".$formato[0]["nombre"]."='".implode("','",$actualizados)."' WHERE id".$formato[0]["nombre_tabla"]."=".$iddoc;
      //echo $sql; die();
      phpmkr_query($sql,$conn);
    }
  }
}

}

if(isset($_REQUEST["ft_funcion"])&& trim($_REQUEST["ft_funcion"])<>""){
  ////Validar la unificacion de los nombres para generar un 'dominio' de nombres
  if(isset($_REQUEST["ft_parametros"]) && trim($_REQUEST["ft_parametros"])<>""){
    $parametros=str_replace("'","",str_replace("\\","",strtolower($_REQUEST["ft_parametros"])));
  }
  else $parametros="";
  $funcion=str_replace("'","",str_replace("\\","",strtolower($_REQUEST["ft_funcion"])));
  if(function_exists($funcion))
    call_user_func_array($funcion,explode(",",$parametros));
}
function listar_anexos_ver_descargar($idformato,$iddoc,$idcampo='',$tipo_mostrar='',$retorno=0){
	global $ruta_db_superior,$conn;

    $condicion_icampo='';
    if($idcampo!=''){
        $condicion_icampo=" AND campos_formato='".$idcampo."'";
    }
	$anexos=busca_filtro_tabla("","anexos","documento_iddocumento=".$iddoc.$condicion_icampo,"",$conn);
	$tabla='';
	if($anexos['numcampos']){
	    $array_extensiones_ver=array('jpg','pdf','png');
		$tabla='<ul>';
	    for($j=0;$j<$anexos['numcampos'];$j++){
	        if(in_array(strtolower($anexos[$j]['tipo']),$array_extensiones_ver)){
	            $href='';
	            if($tipo_mostrar!=5){
	            	require_once($ruta_db_superior.'StorageUtils.php');
					require_once($ruta_db_superior.'filesystem/SaiaStorage.php');
					$tipo_almacenamiento = new SaiaStorage("archivos");
					$ruta_imagen=json_decode($anexos[$j]['ruta']);	
					if(is_object($ruta_imagen)){
						if($tipo_almacenamiento->get_filesystem()->has($ruta_imagen->ruta)){
							$ruta64 = base64_encode($anexos[$j]["ruta"]);
							$ruta_abrir = $ruta_db_superior."filesystem/mostrar_binario.php?ruta=$ruta64";
							$href=$ruta_abrir;
						}
					}					  
	            }
	            $tabla.="<li><a href='".$href."' target='_blank'>".$anexos[$j]['etiqueta']."</a></li>";
	        }else{
	            $href='';
	            if($tipo_mostrar!=5){
	                $href=$ruta_db_superior.'anexosdigitales/parsea_accion_archivo.php?idanexo='.$anexos[$j]['idanexos'].'&accion=descargar';
	            }     
	            $tabla.='<li><a title="Descargar" href="'.$href.'" border="0px">'.$anexos[$j]['etiqueta'].'</a></li>';
	        }
	    }
		$tabla.='</ul>';
	}
    if($retorno){
	    return($tabla);
	}else{
	    echo($tabla);	
	}
}



?>
