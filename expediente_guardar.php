<?php
include_once("db.php");
include_once("pantallas/expediente/librerias.php");

if(@$_REQUEST['fecha_limite'] && @$_REQUEST['fecha_limite']!='0000-00-00' ){
    print_r($_REQUEST['fecha_limite']);
}

if($_REQUEST["iddoc"])  //si estoy llenando desde la pantalla del menu intermedio del documento
{$expedientes=explode(",",$_REQUEST["expedientes"]);
 if(is_array($expedientes)&&$_REQUEST["iddoc"]&&@$_REQUEST["accion"]!=4)
  {if($_REQUEST["accion"]==3) //mover a otro expediente
      {phpmkr_query("delete from expediente_doc where expediente_idexpediente='".$_REQUEST["expediente_actual"]."' and documento_iddocumento in (".$_REQUEST["iddoc"].")"); 
       $_REQUEST["accion"]=1;
      }
   
   foreach($expedientes as $fila){
   	if($fila<>""){
   		$documentos=explode(",",$_REQUEST["iddoc"]);
			$cant=count($documentos);
			for($i=0;$i<$cant;$i++){
	   		if($_REQUEST["accion"]==1){ //adicionar a un expediente
	   			$busqueda=busca_filtro_tabla("","expediente_doc A","A.expediente_idexpediente=".$fila." AND documento_iddocumento=".$documentos[$i],"",$conn);
					if(!$busqueda["numcampos"]){
	      		phpmkr_query("insert into expediente_doc(expediente_idexpediente,documento_iddocumento,fecha) values('$fila','".$documentos[$i]."',".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").")");
						//terminar_actividad_flujo($documentos[$i]);
					}
				}
	      elseif($_REQUEST["accion"]==0){ //quitar de un expediente
	      	phpmkr_query("delete from expediente_doc where expediente_idexpediente='$fila' and documento_iddocumento='".$documentos[$i]."'");
				}
	    }
		 }
    }
	 	alerta("Accion realizada");
    if(@$_REQUEST["pantalla"]=="listado")
      redirecciona("expediente_detalles.php?key=".$_REQUEST["expediente_actual"]); 
    else
      redirecciona("expediente_llenar.php?iddoc=".$_REQUEST["iddoc"]);  
  }
	else if(@$_REQUEST["accion"]==4){ //Guarda en los expedientes seleccionados
		$expedientes=$_REQUEST["expedientes"];
		$expedientes=explode(",",$expedientes);
		$expedientes=array_filter($expedientes);
		
		$expediente_almacenado=busca_filtro_tabla("A.expediente_idexpediente","expediente_doc A","A.documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
		$expedientes_doc=extrae_campo($expediente_almacenado,"expediente_idexpediente");
		
		$quitar=array_diff($expedientes_doc,$expedientes);
		$quitar=array_merge($quitar);
		
		$adicionales=array_diff($expedientes,$expedientes_doc);
		$adicionales=array_merge($adicionales);
		
		$cantidad_eliminar=count($quitar);
 		$cantidad_adicionar=count($adicionales);
 		
 		if($cantidad_eliminar){
 			$expedientes_asignados=arreglo_expedientes_asignados();
 			$nuevos_quitar=array_intersect($quitar, $expedientes_asignados);
		 	$sql1="DELETE FROM expediente_doc WHERE documento_iddocumento=".$_REQUEST["iddoc"]." AND expediente_idexpediente IN(".implode(",",$nuevos_quitar).")";
			 phpmkr_query($sql1);
		}
		if($cantidad_adicionar){
			for($i=0;$i<$cantidad_adicionar;$i++){
		 		$sql1="INSERT INTO expediente_doc (documento_iddocumento,expediente_idexpediente,fecha) VALUES(".$_REQUEST["iddoc"].",".$adicionales[$i].",".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").")";
				phpmkr_query($sql1);
		 	}
		}
	}
	alerta("Accion realizada");
	//terminar_actividad_flujo($_REQUEST["iddoc"]);
  if(@$_REQUEST["pantalla"]=="listado")
    redirecciona("expediente_detalles.php?key=".$_REQUEST["expediente_actual"]); 
  else
    redirecciona("expediente_llenar.php?iddoc=".$_REQUEST["iddoc"]);  
}
else{//si estoy llenando desde el expediente
$documentos=explode(",",$_REQUEST["docs"]);
$idexp=$_REQUEST["idexpediente"];
if(is_array($documentos)&&$idexp)
  {foreach($documentos as $fila)
     {if($fila<>"")
        phpmkr_query("insert into expediente_doc(expediente_idexpediente,documento_iddocumento,fecha) values('$idexp','$fila',".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").")");
     }
    redirecciona("expediente_detalles.php?key=$idexp");
  }
}  
function terminar_actividad_flujo($iddoc){
	global $conn;
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
	include_once($ruta_db_superior."workflow/libreria_paso.php");
	
	$paso_documento=busca_filtro_tabla("","paso_documento A","documento_iddocumento=".$iddoc,"idpaso_documento desc",$conn);
	if($paso_documento["numcampos"]){
		terminar_actividad_paso($iddoc,'',2,$paso_documento[0]["idpaso_documento"],7);
	}
}
?>