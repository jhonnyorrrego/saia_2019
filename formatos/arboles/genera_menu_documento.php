<?php
  include_once("../../db.php");
 if(isset($_SESSION["LOGIN".LLAVE_SAIA])&&$_SESSION["LOGIN".LLAVE_SAIA]) 
  menu_documento(@$_REQUEST["nodo"]);
  
function menu_documento($nodo=""){
  global $conn;
  $datos=parsea_idformato($_REQUEST["nodo"]);
	$devolver=False;
  $formato=busca_filtro_tabla("","formato","idformato=".$datos[0],"",$conn);
  //print_r($formato);die();
  if($datos[3]=="vista")
    echo("Vista Seleccionada");
  elseif($formato[0]["item"])
    {$datos2=explode("-",$_REQUEST["nodo"]);
    
     $padre=busca_filtro_tabla("d.estado,d.numero,d.iddocumento,d.plantilla","documento d,".$datos2[3],"documento_iddocumento=iddocumento and id".$datos2[3]."=".$datos2[4],"",$conn);
     $fpadre=busca_filtro_tabla("","formato","nombre_tabla='".$datos2[3]."' and lower(nombre)='".strtolower($padre[0]["plantilla"])."'","",$conn);

     $permisos=busca_filtro_tabla("permisos","permiso_documento","funcionario='".usuario_actual("funcionario_codigo")."' and documento_iddocumento='".$padre[0]["iddocumento"]."'","",$conn);
     $v_permisos=explode(",",@$permisos[0]["permisos"]);
          
     if(!$datos[2]&&$padre[0]["estado"]=="ACTIVO")
       agrega_boton2("","../../botones/formatos/adicionar.gif","","","Adicionar un formato de �ste tipo.","","",'seleccion_accion('."'".'adicionar'."'".');');
     else
       {
          if($padre[0]["estado"]=='ACTIVO'){
            if(in_array('e',$v_permisos))
              agrega_boton2("","../../botones/comentarios/eliminar_pagina.png","","","Eliminar Borrador","","eliminar_borrador",'seleccion_accion('."'".'eliminar'."'".');');
          
          }
       }  
    } 
   elseif($formato["numcampos"]){
    /* Aqui lo que se puede hacer solo para los datos del formatos */
	$datos_docu=busca_filtro_tabla("",$formato[0]["nombre_tabla"]." a, documento b","a.id".$formato[0]["nombre_tabla"]."='".$datos[2]."' and a.documento_iddocumento=b.iddocumento","",$conn);
    if($datos[2]){                
      if(strpos($formato[0]["banderas"],"nd")===false)
      {
      	$devolver=true;
      	agrega_boton2("","../../botones/formatos/ver_documento.gif","","","Detalles","","detalles",'seleccion_accion('."'".'detalles'."'".');');
       agrega_boton2("","../../botones/formatos/seguir.gif","","","rastro","","seguimiento",'seleccion_accion('."'".'seguir'."'".');');
	   agrega_boton2("","","","","","","verificar_flujo_documento",'seleccion_accion('."'".'verificar_flujo_documento'."'".');');
       agrega_boton2("","","","","","","mostrar_documentos",'seleccion_accion('."'".'mostrar_paginas'."'".');');
       agrega_boton2("","","","","","","ordenar_pag",'seleccion_accion('."'".'ordenar_paginas'."'".');');
       agrega_boton2("","","","","","","anexos_documento",'seleccion_accion('."'".'anexos'."'".');');
       agrega_boton2("","../../botones/formatos/adicionar_pagina.gif","","","Adicionar Pagina","","adicionar_pag",'seleccion_accion('."'".'adicionar_pagina'."'".');');
       agrega_boton2("","../../botones/formatos/adicionar_pagina.gif","","","Ver Notasaaaaa","","ver_notas",'seleccion_accion('."'".'ver_notas'."'".');');
       
       if(usuario_actual("login")=="cerok")
       	agrega_boton2("","../../botones/formatos/editar.gif","","","Editar","","editar",'seleccion_accion('."'".'editar'."'".');');
       
       if($datos_docu[0]["estado"]=='ACTIVO'||$formato[0]["mostrar_pdf"]==0){
	       agrega_boton2("","","","","","","adicionar_comentario",'seleccion_accion('."'".'adicionar_comentario'."'".');');
	       agrega_boton2("","","","","","","administrar_comentario",'seleccion_accion('."'".'administrar_comentario'."'".');');
       }
       agrega_boton2("","../../botones/formatos/seguir.gif","","","Etiquetar","","adicionar_etiqueta",'seleccion_accion('."'".'adicionar_etiqueta'."'".');');
       agrega_boton2("","../../botones/formatos/transferir.gif","","","Transferir","","transferir",'seleccion_accion('."'".'transferir'."'".');');
       agrega_boton2("","../../botones/formatos/devolver.gif","","","Devolucion","","devolucion",'seleccion_accion('."'".'devolver'."'".');');
       agrega_boton2("","","","","","","clasificar",'seleccion_accion('."'".'clasificar'."'".');');
       
       agrega_boton2("","../../botones/formatos/tareas.gif","","","tareas","","tareas",'seleccion_accion('."'".'tareas'."'".');');
       
       agrega_boton2("","../../botones/formatos/imprimir.gif","","","Imprimir","","imagenes_pdf",'seleccion_accion('."'".'seleccionar_impresion'."'".');');
       agrega_boton2("","../../botones/formatos/imprime_radicado.gif","","","Imprimir Radicado","","imprimir_radicado",'seleccion_accion('."'".'imprime_radicado'."'".');');
       agrega_boton2("","../../botones/formatos/vincular_documentos.png","","","Vincular Documentos","","vincular_documento",'seleccion_accion('."'".'vincular_documento'."'".');');  
       agrega_boton2("","","","","","","expediente",'seleccion_accion('."'".'expediente'."'".');');
       agrega_boton2("","","","","Mostrar Versiones","","mostrar_versiones",'seleccion_accion('."'".'mostrar_versiones'."'".');');  
       agrega_boton2("","","","","Crear Version","","crear_version",'seleccion_accion('."'".'crear_version'."'".');');
	   
	   agrega_boton2("","","","","documento_por_vincular","","documento_por_vincular",'seleccion_accion('."'".'documento_por_vincular'."'".');');
       agrega_boton2("","","","","documentos_seleccionados","","documentos_seleccionados",'seleccion_accion('."'".'documentos_seleccionados'."'".');');                                     
                   
       $documento=true;
      }
      $dato_formato=busca_filtro_tabla("",$formato[0]["nombre_tabla"],"id".$formato[0]["nombre_tabla"]."=".$datos[2],"",$conn);
      if($dato_formato["numcampos"] && $documento){
        $dato_documento=busca_filtro_tabla("","documento","iddocumento=".$dato_formato[0]["documento_iddocumento"],"",$conn);
        if($dato_documento["numcampos"]){
          $paginas=busca_filtro_tabla("","pagina","id_documento=".$dato_documento[0]["iddocumento"],"",$conn);
          
          $ejecutor = busca_filtro_tabla("ejecutor","documento","iddocumento=".$dato_documento[0]["iddocumento"],"",$conn);
           if($ejecutor[0]["ejecutor"]==$_SESSION["usuario_actual"])
             {agrega_boton2("","","","","Permisos","","permisos_documento",'seleccion_accion('."'".'permisos_documento'."'".');');
             }
          
          $permisos=busca_filtro_tabla("permisos","permiso_documento","funcionario='".usuario_actual('funcionario_codigo')."' and documento_iddocumento='".$dato_documento[0]["iddocumento"]."'","",$conn);
          $v_permisos=explode(",",@$permisos[0]["permisos"]);
          // print_r($v_permisos); 
          if($dato_documento[0]["estado"]=='ACTIVO'){
            if(in_array('e',$v_permisos))
              agrega_boton2("","../../botones/comentarios/eliminar_pagina.png","","","Eliminar Borrador","","eliminar_borrador",'seleccion_accion('."'".'eliminar'."'".');');
          
          }
          elseif($dato_documento[0]["numero"]>0)
          {            
           agrega_boton2("","../../botones/formatos/ventana_externa.png","","","Ventana Externa","","ventana_externa",'seleccion_accion('."'".'ventana_externa'."'".');');
           agrega_boton2("","","","","","","terminar_documento",'seleccion_accion('."'".'terminar_documento'."'".');');
           agrega_boton2("","","","","","","enviar_documento_correo",'seleccion_accion('."'".'enviar_email'."'".');');
           agrega_boton2("","","","","","","almacenamiento",'seleccion_accion('."'".'almacenamiento'."'".');');
           agrega_boton2("","../../botones/formatos/vincular.gif","","","","","responder",'seleccion_accion('."'".'vincular'."'".');');
           agrega_boton2("","../../botones/formatos/recrear_pdf.png","","","Actualizar pdf","","regenerar_pdf",'seleccion_accion('."'".'actualizar_pdf'."'".');');
           agrega_boton2("","","","","","","despacho",'seleccion_accion('."'".'despacho'."'".');');
           if($ejecutor[0]["ejecutor"]==$_SESSION["usuario_actual"])
              agrega_boton2("","","","","Solicitar Anulacion","","solicitar_anulacion",'seleccion_accion('."'".'solicitar_anulacion'."'".');');
          } 
        }
      }
    }
    else{
      agrega_boton2("","../../botones/formatos/adicionar.gif","","","Adicionar un formato de �ste tipo.","","",'seleccion_accion('."'".'adicionar'."'".');');
      echo "<script>seleccion_accion('adicionar');</script>";
    }  
    //aqui van las cosas que pueden hacer los formatos sin importar si tienen documentos o no
  }
  $botones_admin=(botones_administrativos($formato,$dato_formato,$devolver));
  echo(implode("",$botones_admin));
}
/*debe retornar un arreglo con el siguiente orden:
[0]=>idtabla,[1]=>nombre_tabla,[2]=>campo_descripcion,[3]=>idformato,[4]=>accion,[5]=>llave
*/
function botones_administrativos($formato,$dato_formato,$devolver){
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
	include_once($ruta_db_superior."class_transferencia.php");
	$texto=array();
	$iddoc=$dato_formato[0]["documento_iddocumento"];
	$usuario_actual=$_SESSION["usuario_actual"];
	$usuario_reemplazo=reemplazo($_SESSION["usuario_actual"],'reemplazo');
	if($usuario_actual!=$usuario_reemplazo){
		$usuario_actual=$usuario_reemplazo;
	}
	
	$responsable=busca_filtro_tabla("destino,estado,plantilla","buzon_entrada,documento","iddocumento=archivo_idarchivo and archivo_idarchivo=".$iddoc,"buzon_entrada.idtransferencia asc",$conn);
	
	$ver_responsables_previo=false;
	$ver_responsables=false;
	$boton_editar=false;
	$boton_confirmar=false;
	$boton_devolucion=false;
	
	$v_permisos=array();
  $permisos=busca_filtro_tabla("","permiso_documento A","A.funcionario='".$usuario_actual."' AND documento_iddocumento=".$iddoc,"",$conn);
  if($permisos["numcampos"]){
  	$v_permisos=explode(",",$permisos[0]["permisos"]);
	}
	
	if($responsable["numcampos"]){
		$formato2=busca_filtro_tabla("","formato A","A.nombre LIKE '".strtolower($responsable[0]["plantilla"])."' AND tipo_edicion=1","",$conn);
		if($responsable[0]["estado"]=="ACTIVO" || $formato2["numcampos"]){
    	if($responsable[0]["estado"]=="ACTIVO"){
      	$ver_responsables_previo=true;
    	}
    	if(in_array("m",$v_permisos)){
      	if(@$_REQUEST["vista"] == ""){
        	$boton_editar=True;
      	}
    	}      
  	}
		
		$actual=busca_filtro_tabla("A.idtransferencia as idtrans,A.destino,A.ruta_idruta","buzon_entrada A","A.activo=1 and A.archivo_idarchivo=".$iddoc." and (A.nombre='POR_APROBAR') and A.destino='".$usuario_actual."'","A.idtransferencia",$conn);
		if($actual["numcampos"]>0){
      $anterior=busca_filtro_tabla("A.idtransferencia,A.ruta_idruta","buzon_entrada A","A.idtransferencia <".$actual[0]["idtrans"]." and A.nombre='POR_APROBAR' and A.activo=1 and A.archivo_idarchivo=".$iddoc." and origen='".$usuario_actual."'","",$conn);
    }
    if($_REQUEST["vista"]==""){
    	$boton_confirmar=true;
   	}
		
		if($responsable["numcampos"]>0 && $responsable[0]["destino"]<>$usuario_actual){
			$boton_devolucion=true;
		}
		
    if(@$actual[0]["destino"]<>$usuario_actual || @$anterior["numcampos"]>0){
    	$ver_responsables=false;
    	if($ver_responsables_previo && in_array("r",$v_permisos)){
      	$ver_responsables=true;
			}
			$boton_confirmar=false;
			$boton_devolucion=false;
    }
   	if($ver_responsables_previo && in_array("r",$v_permisos)){
      if($_REQUEST["vista"]==""){
				$ver_responsables=true;
			}
		}
	}
	
	if($ver_responsables){
		$texto[]=('&nbsp;<a href="../../mostrar_ruta.php?doc='.$iddoc.'" target="detalles"><img width=16 height=16 alt="Ver responsables" title="Ver responsables" border="0"  hspace="0" vspace="0" src="'.$ruta_db_superior.'botones/formatos/ver_responsables.png"></a>&nbsp;');
	}
	if($boton_editar){
		$texto[]=('&nbsp;<a href="../'.$formato[0]["nombre"].'/'.$formato[0]["ruta_editar"].'?iddoc='.$iddoc.'" target="detalles"><img width=16 height=16 alt="Editar" title="Editar" border="0"  hspace="0" vspace="0" src="'.$ruta_db_superior.'botones/formatos/editar_documento.png"></a>&nbsp;');
	}
	if($boton_devolucion && !$devolver){
		$texto[]=('&nbsp;<a href="../../class_transferencia.php?iddoc='.$iddoc.'&funcion=formato_devolucion" target="detalles"><img width=16 height=16 alt="Devolver" title="Devolver" border="0"  hspace="0" vspace="0" src="'.$ruta_db_superior.'botones/intermedio/devolver_documento.png"></a>&nbsp;');
	}
	if($boton_confirmar){
		$texto[]=('&nbsp;<a href="../../class_transferencia.php?iddoc='.$iddoc.'&funcion=aprobar" target="detalles"><img width=16 height=16 alt="Confirmar" title="Confirmar" border="0"  hspace="0" vspace="0" src="'.$ruta_db_superior.'botones/formatos/confirmar.png"></a>&nbsp;');
	}
	return($texto);
}
function parsea_idformato($id=0){
$arreglo=array();
if($id){
  $arreglo=explode("-",$id);
}
else if($_REQUEST["id"]){
  $arreglo=explode("-",$_REQUEST["id"]);
}
else return($arreglo);
if($arreglo[2][0]=="r"){
  $arreglo[2]=0;
}
else if($arreglo[1]=="vista_formato"){
  $arreglo[3]="vista";
  $_REQUEST["accion"]="vista";
}
if(@$_REQUEST["accion"]){
  $arreglo[3]=$_REQUEST["accion"];
}
else
  $arreglo[3]="mostrar";
return($arreglo);
}
?>