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
     print_r($permiso_formato);
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
           alerta( "El primer Permiso debe asignar el propietario del formato, ",'error',4000);
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

function asignar_permiso_anexo($idanexo,$tipo,$permiso=NULL,$idpropietario=NULL)
{ global $conn; 
  $anexo=busca_filtro_tabla("","anexos","idanexos=".$idanexo,"",$conn);

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
		$sql="UPDATE permiso_anexo set ".$tipo."='".$permiso."' WHERE anexos_idanexos=".$idanexo;
	        //echo $sql; 
		phpmkr_query($sql,$conn);
	       }
	}
     elseif($idpropietario!=NULL&&$tipo=="CARACTERISTICA_PROPIO")  // Se creea el permiso por primera vez 
        {  //Asigna un permiso inicial  normalmente $tipo="CARACTERISTICA_PROPIO" por que es quien lo crea
   	    
	   $sql="INSERT INTO permiso_anexo(anexos_idanexos,idpropietario,$tipo) VALUES ($idanexo,$idpropietario,'$permiso')";
	   //echo $sql;
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
	  {   // Permisos totales  y permiso del cargo
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
function acciones_anexos_usuario($idfunc,$idanexo,$limita_accion=NULL)
{
  global $conn;
  
  global $ruta_db_superior;
$ruta=$ruta_db_superior;
//FILTRO VISUAL NO TIENE QUE VER CON PERMISOS REALES ES LO QUE SE PUEDE VISUALIZAR POR EJEMPLO EN EL MOSTRAR SOLO SE MUESTRA  DESCARGAR SIN ICONOS
 if($limita_accion!=NULL)    
   $limita_accion=explode("|",$limita_accion);
  else 
   $limita_accion=array("PERMISOS","ELIMINAR","DESCARGAR","ICONO","EDITAR"); 
  
 $anexo=busca_filtro_tabla("","anexos","idanexos=".$idanexo,"",$conn);

  if($anexo["numcampos"]>0)
   {
     
	 //OBTIENE LOS PERMISOS REALES    
    $permisos=func_permiso_anexo($idfunc,$idanexo);
  
    $arper1=str_split($permisos);
    //print_r($arper1); 
     $resultado=""; 
     if(in_array("ICONO",$limita_accion))
      $resultado.="<td>".html_entity_decode($anexo[0]["etiqueta"])."</td>";
     if (in_array ("l", $arper1)&&in_array("DESCARGAR",$limita_accion)) // Simpre se muestra la opcion de descarga  
	{ 
	  if(in_array("ICONO",$limita_accion)) // IMPRIME CON ICONOS 	
	   $resultado.='<td><a href="'.$ruta.'anexosdigitales/parsea_accion_archivo.php?idanexo='.$idanexo.'&accion=descargar" ><img src="'.$ruta.'botones/anexos/application.png" /></a><td>';
          else  // ES SOLO LA OPCION DE DESCARGA SE IMPRIME EL LINK CON EL NOMBRE DEL ARCHIVO
	   $resultado.='<td><a href="'.$ruta.'anexosdigitales/parsea_accion_archivo.php?idanexo='.$idanexo.'&accion=descargar" >'.html_entity_decode($anexo[0]["etiqueta"]).'</a><td>';
         	
	}
     if (in_array ("e", $arper1)&&in_array("ELIMINAR",$limita_accion)) // Verifica el permismo y que no se pida solo mostrar la opcion de descarga
	{  if(in_array("ICONO",$limita_accion)) //enlace con icono
   	    { 
		$objeto='<img name="permisos" src="'.$ruta.'botones/anexos/application_delete.png">';    
	    }
	   else 
	   {   
	       $objeto="Eliminar";
	    }
	     $resultado.= '<td><div class="textwrapper">
		<a href="'.$ruta.'anexosdigitales/borrar_anexos.php?idanexo='.$idanexo.'" id="el_'.$idanexo.'" class="highslide" onclick="return hs.htmlExpand( this, {
		objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
		outlineWhileAnimating: true, preserveContent: false, width: 250 } )">'.$objeto.'</a>
		</div></td>';
	 }
     //	alerta("OP".$limita_accion);
     
     $datos_permisos=$permiso_anexo=busca_filtro_tabla("","permiso_anexo","permiso_anexo.anexos_idanexos=".$idanexo,"",$conn);
     if($datos_permisos["numcampos"]>0) 
      { 
	   if(in_array("ICONO",$limita_accion)) //enlace con icono
   	   { 
	       $objeto='<img name="permisos" src="'.$ruta.'botones/anexos/application_key.png">';    
	    }
	   else 
	   { 
	      $objeto="Permisos";
	    }
	    if($datos_permisos[0]["idpropietario"]==$idfunc&&in_array("PERMISOS",$limita_accion)) // Si es el propietario ademas se agrega el permiso para modificar permisos
	      {
	        $resultado.= '<td><div class="textwrapper">
		<a href="anexosdigitales/anexos_permiso_add.php?idanexo='.$idanexo.'" id="el_'.$idanexo.'" class="highslide" onclick="return hs.htmlExpand( this, {
		objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
		outlineWhileAnimating: true, preserveContent: false, width: 250 } )">'.$objeto.'</a>
		</div></td>';
	      }
      }
    
    } // Fin if solo_descarga 
   
return ($resultado);
}


// Genera uan tabla con los anexos acciones para documentos o formatos 
function listar_anexos_documento($iddocumento,$idformato=NULL,$idcampo=NULL,$tipo=NULL,$limita_accion=NULL)
{  global $conn;

   $idfunc=usuario_actual("funcionario_codigo");

 if(!$limita_accion)
  $limita_accion="DESCARGAR|ELIMINAR|PERMISOS|ICONO|ENCABEZADO|EDITAR";

   if(!$idformato&&!$idcampo) // Se muestran todos los anexos
     $anexos=busca_filtro_tabla("*","anexos","documento_iddocumento=".$iddocumento,"",$conn);
   else 
    {
     $anexos=busca_filtro_tabla("*","anexos","documento_iddocumento=".$iddocumento." AND formato=".$idformato." AND campos_formato=".$idcampo,"",$conn);
    }   

   if($anexos["numcampos"]>0)
     {  if(in_array("ENCABEZADO",explode("|",$limita_accion)))
          $tabla='<table border="0" cellspacing=0 cellpadding=0><tr><td>Anexos :</td></tr>';
        else 
	        $tabla='<table border="0" cellspacing=0 cellpadding=0>';
	   for($i=0;$i<$anexos["numcampos"];$i++)
	    {  $tabla.="<tr>";
	      // $tabla.="<td>".html_entity_decode($anexos[$i]["etiqueta"])."</td>";
	       if($tipo<>5)
	        $tabla.=acciones_anexos_usuario($idfunc,$anexos[$i]["idanexos"],$limita_accion);
	       $tabla.="</tr>";
	    
	    }
	    $tabla.="</table>";
     }
  else 
    $tabla="";   	    

  return($tabla);
}


function descargar_archivo($id,$tipo_al=NULL)   //Recibe el id del anexo y opcinalmente el id del binario para descargar archivos o desde la bd respectivamente
{  global $conn;
   if(!$tipo_al) // Si no se solicita directamente el origen (BD O ARCHIVO ) se busca en configuracion cual se va a descargar
     { $config = busca_filtro_tabla("valor","configuracion","nombre='tipo_almacenamiento'","",$conn);
       if($config["numcampos"])
         $tipo_al=$config[0]['valor'];
        else 
         $tipo_al="archivo"; // Si no encuentra el registro en configuracion almacena en archivo
     }
       
  if($tipo_al=="archivo")
   {
    $datos=busca_filtro_tabla("","anexos","idanexos=".$id,"",$conn);
  
    if(!$datos["numcampos"])
       alerta('problema con el archivo anexo','error',4000);
    else
    $file=$datos[0]["ruta"];  
    
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

     $file=$ruta_db_superior.$file; 
     //echo $file; die();  
    if (!is_file($file)) { return; }

  	header("Content-Type: application/octet-stream");
  	header("Content-Size: ".filesize($file));
  	header("Content-Disposition: attachment; filename=\"".html_entity_decode($datos[0]["etiqueta"])."\"");
  	header("Content-Length: ".filesize($file));
  	header("Content-transfer-encoding: binary");
  	@readfile($file);
  	exit;
   }
   elseif($tipo_al=="binario")// almacenamiento binario
   {
       $archivo=busca_filtro_tabla("datos,nombre_original","binario","idbinario=".$id,"",$conn);
       $nomb_limpio = ereg_replace("[^A-Za-z0-9._]", "",$archivo[0]['nombre_original']);
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment; filename=".$nomb_limpio); 	
        echo $archivo[0]['datos'];
        exit;
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
            $sql="INSERT INTO anexos(documento_iddocumento,ruta,tipo,etiqueta,formato,campos_formato) values(".$iddoc.",'".$dir_anexos.$temp_filename."','".$datos_anexo["extension"]."','".$nombre."'".",".$idformato.",".$campo[$i]["idcampos_formato"].")";
            phpmkr_query(htmlentities($sql),$conn) or alerta("No se puede Adicionar el Anexo ".$ruta_origen,'error',4000);
            $idanexo=phpmkr_insert_id();
            //echo("<br />SQL:".$sql."<br />");
          }
          elseif($tipo_almacenamiento=="db"){
            phpmkr_query("INSERT INTO binario(nombre_original) VALUES ('$nombre')", $conn);
          	$idbin = phpmkr_insert_id();
          	$fcont=fopen($dir_anexos.$temp_filename,"rb");
          	$cont=fread($fcont,filesize($dir_anexos.$temp_filename));
          	if(guardar_lob("datos","binario","idbinario=$idbin",$cont,$ruta_origen,$conn)){
          	 phpmkr_query("INSERT INTO anexos(ruta,documento_iddocumento,tipo,etiqueta,formato,campos_formato) VALUES ('$idbin',".$iddoc.",'".$datos_anexo["extension"]."','".$nombre."',".$idformato.",".$campo[$i]["idcampos_formato"].")", $conn);
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


function cargar_archivo($iddoc,$permisos_anexos,$formato=NULL,$campo=NULL)
{
global $conn;

$resultado=NULL;
$larchivos=array();
$permisos=array();
$aux_permisos=explode("|",$permisos_anexos);
$pos=substr_count($_SERVER["PHP_SELF"],"/");
$salir=str_repeat("../",$pos-3);    

for($i=0;$i<count($aux_permisos);$i++)
   {$fila=explode(";",$aux_permisos[$i]);
    $permisos[$fila[0]]["propio"]=$fila[1];
    $permisos[$fila[0]]["dependencia"]=$fila[2];
    $permisos[$fila[0]]["cargo"]=$fila[3];
    $permisos[$fila[0]]["total"]=$fila[4];    
   }

$config = busca_filtro_tabla("valor","configuracion","nombre='tipo_almacenamiento'","",$conn);
if($config["numcampos"]){
    $tipo_almacenamiento=$config[0]["valor"];
  }
  else
    $tipo_almacenamiento="archivo"; // Si no encuentra el registro en configuracion almacena en archivo

    for($j=0;$_FILES['anexos']['name'][$j];$j++){
      if(is_uploaded_file($_FILES['anexos']['tmp_name'][$j]) && $_FILES['anexos']['size'][$j]){
        $nombre=$_FILES['anexos']['name'][$j];
	$datos_anexo=pathinfo($_FILES['anexos']['name'][$j]);
        $temp_filename = time().".".$datos_anexo["extension"];
        $dir_anexos=selecciona_ruta_anexos("",$iddoc,$tipo_almacenamiento); // Ruta para descarga ..
	$dir_anexos_tmp=$dir_anexos; 
	$dir_anexos=$dir_anexos;
  if(!is_dir($salir.$dir_anexos))
     mkdir($salir.$dir_anexos,0777);    
     
        if (file_exists($salir.$dir_anexos . $temp_filename)){
          $tmpVar = 1;
  	  		while(file_exists($salir.$dir_anexos. $tmpVar . '_' . $temp_filename)){
  				  $tmpVar++;
  	   		}
          $temp_filename=$tmpVar . '_' . $temp_filename;
        }
      
        if(is_file($_FILES['anexos']['tmp_name'][$j]) && is_dir($salir.$dir_anexos))
          $resultado=rename($_FILES['anexos']['tmp_name'][$j],$salir.$dir_anexos.$temp_filename);
       
        if($resultado){
          if($tipo_almacenamiento=="archivo"){ // Los anexos estan guardados en archivos
 	   if($formato!=NULL&&$campo!=NULL)
   	     $sql="INSERT INTO anexos(documento_iddocumento,ruta,tipo,etiqueta,formato,campos_formato) values(".$iddoc.",'".$dir_anexos.$temp_filename."','".$datos_anexo["extension"]."','".$nombre."'".",".$formato.",".$campo.")";
     	    else 
	     $sql="INSERT INTO anexos(documento_iddocumento,ruta,tipo,etiqueta) values(".$iddoc.",'".$dir_anexos.$temp_filename."','".$datos_anexo["extension"]."','".$nombre."'".")";
	   //die($sql);
	    phpmkr_query(htmlentities($sql),$conn) or alerta("No se puede Adicionar el Anexo ".$_FILES['anexos']['name'][$j],'error',4000);
            $idanexo=phpmkr_insert_id();
           // echo("<br />SQL:".$sql."<br />");
          }
          elseif($tipo_almacenamiento=="db"){
            phpmkr_query("INSERT INTO binario(nombre_original) VALUES ('$nombre')", $conn);
            $idbin = phpmkr_insert_id();
            $fcont=fopen($dir_anexos.$temp_filename,"rb");
            $cont=fread($fcont,filesize($dir_anexos.$temp_filename));
	    if(guardar_lob("datos","binario","idbinario=$idbin",$cont,$_FILES['anexos'][$j],$conn)){
          	 phpmkr_query("INSERT INTO anexos(ruta,documento_iddocumento,tipo,etiqueta,formato,campos_formato) VALUES ('$idbin',".$iddoc.",'".$datos_anexo["extension"]."','".$nombre."',".$idformato.",".$campo[$i]["idcampos_formato"].")", $conn);
          	 $idanexo=phpmkr_insert_id();
          	 if($idanexo){
			 // EN EL MOMENTO SE HACE ALMACENAMIENTO DUAL
              //unlink($dir_anexos.$temp_filename); // Se elimina el temporal .. el blob se almaceno correctamente
             }
             else alerta("No se puede Adicionar el Anexo ".$_FILES['anexos']['name'][$j],'error',4000);
          	}
          }
          if($idanexo){ // SE ASIGNAN LOS PERMISOS
          
            if(array_key_exists ($nombre , $permisos ))
              {$propio=$permisos[$nombre]["propio"];
               $dependencia=$permisos[$nombre]["dependencia"];
               $cargo=$permisos[$nombre]["cargo"];
               $total=$permisos[$nombre]["total"];
              }
            else
              {$propio="le";
               $dependencia="";
               $cargo="";
               $total="l";
              }  
            $sql_permiso="insert into permiso_anexo(anexos_idanexos,idpropietario,caracteristica_propio,caracteristica_dependencia,caracteristica_cargo,caracteristica_total) values('$idanexo','".usuario_actual("idfuncionario")."','$propio','$dependencia','$cargo','$total')";
            phpmkr_query($sql_permiso,$conn);
          
          }
        }
        else {
          alerta("Se ha generado un error al tratar de copiar el archivo ".$nombre,'error',4000);
        }
      } // Fin  if is uploaded
    } // Fin for
 
return;
}

function cargar_archivo_formato($idcampo,$idformato,$iddoc){
global $conn;
$resultado=NULL;
$larchivos=array();
//819,3,77
$permisos=array();
$aux_permisos=explode("|",$_REQUEST["permisos_anexos"]);

for($i=0;$i<count($aux_permisos);$i++)
   {$fila=explode(";",$aux_permisos[$i]);
    $permisos[$fila[0]]["propio"]=$fila[1];
    $permisos[$fila[0]]["dependencia"]=$fila[2];
    $permisos[$fila[0]]["cargo"]=$fila[3];
    $permisos[$fila[0]]["total"]=$fila[4];    
   }

//die();
$campo=busca_filtro_tabla("A.*,B.nombre AS formato,B.nombre_tabla","campos_formato A,formato B","A.formato_idformato=B.idformato AND idcampos_formato IN(".implode(",",$idcampo).") AND etiqueta_html='archivo'","",$conn);
if($campo["numcampos"]){
  $config = busca_filtro_tabla("valor","configuracion","nombre='tipo_almacenamiento'","",$conn);
  if($config["numcampos"]){
  	$tipo_almacenamiento=$config[0]["valor"];
  }
  else
     $tipo_almacenamiento="archivo"; // Si no encuentra el registro en configuracion almacena en archivo
  for($i=0;$i<$campo["numcampos"];$i++){
    for($j=0;$_FILES[$campo[$i]["nombre"]]['name'][$j];$j++){
      if(is_uploaded_file($_FILES[$campo[$i]["nombre"]]['tmp_name'][$j]) && $_FILES[$campo[$i]["nombre"]]['size'][$j]){
        $nombre=$_FILES[$campo[$i]["nombre"]]['name'][$j];
        $datos_anexo=pathinfo($_FILES[$campo[$i]["nombre"]]['name'][$j]);
        $temp_filename = time().".".$datos_anexo["extension"];
        $dir_anexos=selecciona_ruta_anexos($campo[$i]["formato"],$iddoc,$tipo_almacenamiento);
        if (file_exists($dir_anexos . $temp_filename)){
          $tmpVar = 1;
  	  		while(file_exists($dir_anexos. $tmpVar . '_' . $temp_filename)){
  				  $tmpVar++;
  	   		}
          $temp_filename=$tmpVar . '_' . $temp_filename;
        }
        if(is_file($_FILES[$campo[$i]["nombre"]]['tmp_name'][$j]) && is_dir($dir_anexos))
          $resultado=copy($_FILES[$campo[$i]["nombre"]]['tmp_name'][$j],$dir_anexos.$temp_filename);
        if($resultado){
          if($tipo_almacenamiento=="archivo"){ // Los anexos estan guardados en archivos
            $sql="INSERT INTO anexos(documento_iddocumento,ruta,tipo,etiqueta,formato,campos_formato) values(".$iddoc.",'".$dir_anexos.$temp_filename."','".$datos_anexo["extension"]."','".$nombre."'".",".$idformato.",".$campo[$i]["idcampos_formato"].")";
            //die($sql);
	    phpmkr_query(htmlentities($sql),$conn) or alerta("No se puede Adicionar el Anexo ".$_FILES[$campo[$i]["nombre"]]['name'][$j],'error',4000);
            $idanexo=phpmkr_insert_id();
            //echo("<br />SQL:".$sql."<br />");
          }
          elseif($tipo_almacenamiento=="db"){
            phpmkr_query("INSERT INTO binario(nombre_original) VALUES ('$nombre')", $conn);
          	$idbin = phpmkr_insert_id();
          	$fcont=fopen($dir_anexos.$temp_filename,"rb");
          	$cont=fread($fcont,filesize($dir_anexos.$temp_filename));
		if(guardar_lob("datos","binario","idbinario=$idbin",$cont,$_FILES[$campo[$i]["nombre"]][$j],$conn)){
          	 phpmkr_query("INSERT INTO anexos(ruta,documento_iddocumento,tipo,etiqueta,formato,campos_formato) VALUES ('$idbin',".$iddoc.",'".$datos_anexo["extension"]."','".$nombre."',".$idformato.",".$campo[$i]["idcampos_formato"].")", $conn);
          	 $idanexo=phpmkr_insert_id();
          	 if($idanexo){
			  // EN EL MOMENTO SE HACE ALMACENAMIENTO DUAL NO SE BORRA EL ARCHIVO
              //unlink($dir_anexos.$temp_filename); // Se elimina el temporal .. el blob se almaceno correctamente
             }
             else alerta("No se puede Adicionar el Anexo xx".$_FILES[$campo[$i]["nombre"]]['name'][$j],'error',4000);
          	}
          }
          if($idanexo){
            $update="UPDATE ".$campo[$i]["nombre_tabla"]." SET ".$campo[$i]["nombre"]."=".$idanexo." WHERE id".$campo[$i]["nombre_tabla"]."=".$iddoc;
            phpmkr_query($update);
            array_push($larchivos,$idanexo);
             
            if(array_key_exists ($nombre , $permisos ))
              {$propio=$permisos[$nombre]["propio"];
               $dependencia=$permisos[$nombre]["dependencia"];
               $cargo=$permisos[$nombre]["cargo"];
               $total=$permisos[$nombre]["total"];
              }
            else
              {$propio="le";
               $dependencia="";
               $cargo="";
               $total="l";
              }  
            $sql_permiso="insert into permiso_anexo(anexos_idanexos,idpropietario,caracteristica_propio,caracteristica_dependencia,caracteristica_cargo,caracteristica_total) values('$idanexo','".usuario_actual("idfuncionario")."','$propio','$dependencia','$cargo','$total')";
            phpmkr_query($sql_permiso,$conn);
          
          }
        }
        else {
          alerta("Se ha generado un error al tratar de copiar el archivo ".$nombre,'error',4000);
        }
      }
    }
  }
  $sql="UPDATE ".$campo[0]["nombre_tabla"]." SET ".$campo[0]["nombre"]." = '".implode(",",$larchivos)."' WHERE id".$campo[0]["nombre_tabla"]."=".$iddoc;
  phpmkr_query($sql,$conn);
}
return;
}

function selecciona_ruta_anexos($formato,$iddoc,$almacenamiento,$ruta=""){

    	
if($almacenamiento=="archivo"){
  if($ruta=="")
    { if($formato!="")  //ES UNA ANEXO ASOCIADO A UN FORMATO 	  
        $ruta=RUTA_DISCO."/anexos/".$formato."/".$iddoc."/";
      else 
        $ruta=RUTA_DISCO."/anexos/".$iddoc."/"; 
    }	
}
else {
  if($ruta=="")
    $ruta=RUTA_DISCO."/anexos/temporal/";
}
if(verifica_ruta($ruta)){
  return($ruta);
}
return(FALSE);
}

function verifica_ruta($ruta){
$directorios=explode("/",$ruta);
$cont=count($directorios);
$dir1="";
for($i=0;$i<$cont;$i++){
  $dir1.=$directorios[$i]."/";
  if(!is_dir($dir1) && $directorios[$i]!=".." && $directorios[$i]!="."){
    if(mkdir($dir1,0777))
      $exito=TRUE;
    else{
     alerta("La carpeta ".$ruta." No se ha podido Crear.",'error',4000);
     return(FALSE);
    }
  }
}
if(is_dir($dir1)){
  return(TRUE);
}
else{
  return(FALSE);
}
}


function borrar($idanexo) 
{  
  global $conn;
  $config = busca_filtro_tabla("valor","configuracion","nombre='tipo_almacenamiento'","",$conn);
  $anexo=busca_filtro_tabla("","anexos","idanexos=".$idanexo,"",$conn);
  if($anexo["numcampos"]>0)
   if($anexo[0]['idbinario']!=''&&$anexo[0]['idbinario']!=NULL) // Evita errores si el binario no fue bien almacenado y no se asocio
     {
       $sql1="DELETE FROM binario WHERE idbinario=".$anexo[0]['idbinario'];
        phpmkr_query($sql1,$conn); 
     }  
  $pos=substr_count($_SERVER["PHP_SELF"],"/"); // Se busca la posicion relatia respecto a la RAIZ
  $relativo_raiz='';
  for($i=0;$i<$pos-2;$i++)
     $relativo_raiz.='../';
   $file=$relativo_raiz.$anexo[0]["ruta"]; 
   if(is_file($file))  
     unlink($file);
    $sql2="DELETE FROM anexos WHERE idanexos=".$idanexo; 
    phpmkr_query($sql2,$conn); 
   
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
      echo $sql; die();
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
?>
