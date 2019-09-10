<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."class.funcionarios.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
//include_once($ruta_db_superior."app/documento/class_transferencia.php");
$pasos_anteriores=array();
$nivel=0;
/*
 * $entidad=Recibe la entidad.
 * $llave_entidad=Recibe la llave de la entidad enviada.
 * 
 * Se encarga de mostrar el valor equivalente de la entidad.
 * ejemplo: $entidad=cargo, $llave_entidad=1
 * La funcion retorna en un arreglo $datos_retorno["nombre"]=Administrador saia, $datos_retorno["id"]=1
 * $datos_retorno["numcampos"]
 */
function buscar_entidad_asignada($entidad,$llave_entidad){    
global $conn;
$entidad1=busca_filtro_tabla("","entidad","identidad=".$entidad,"",$conn);
$datos_retorno=array();
if($entidad1["numcampos"]){
    if($entidad==3){
        $dato_entidad=busca_filtro_tabla("","ejecutor A,datos_ejecutor B","B.ejecutor_idejecutor=A.idejecutor AND B.iddatos_ejecutor=".$llave_entidad,"",$conn);    
    }    
    else if($entidad==1){
        $dato_entidad=busca_filtro_tabla("",$entidad1[0]["nombre"],"funcionario_codigo IN(".$llave_entidad.")","",$conn);
    }
    else
        $dato_entidad=busca_filtro_tabla("",$entidad1[0]["nombre"],"id".$entidad1[0]["nombre"]." IN(".$llave_entidad.")","",$conn);        
    $datos_temp=array();
    if($dato_entidad["numcampos"]){
        switch($entidad){
            case 1://Funcionarios
                $datos_retorno["id"]=$llave_entidad;
                for($i=0;$i<$dato_entidad["numcampos"];$i++){
                  array_push($datos_temp,$dato_entidad[$i]["nombres"]." ".$dato_entidad[$i]["apellidos"]);        
                }
                $datos_retorno["nombre"]=implode(", ",$datos_temp);
            break;
            case 2://dependencia
                $datos_retorno["id"]=$llave_entidad;
                for($i=0;$i<$dato_entidad["numcampos"];$i++){
                  array_push($datos_temp,$dato_entidad[$i]["nombre"]);        
                }
                $datos_retorno["nombre"]=implode(", ",$datos_temp);
            break;
            case 3://ejecutor
                $datos_retorno["id"]=$llave_entidad;
                $datos_retorno["nombre"]=$dato_entidad[0]["nombre"]."Nit: ".$dato_entidad[0]["nit"]." (".$dato_entidad[0]["empresa"].")";
            break;
            case 4://cargo
                $datos_retorno["id"]=$llave_entidad;
                for($i=0;$i<$dato_entidad["numcampos"];$i++){
                  array_push($datos_temp,$dato_entidad[$i]["nombre"]);        
                }
                $datos_retorno["nombre"]=implode(", ",$datos_temp);
            break;
            case 5://dependencia cargo
            break;
        }
     }
    return($datos_retorno);
}
else 
    return(array("numcampos"=>0));    
}
//Con el documento ubico el paso y se busca el paso siguiente, con la accion se llama según la accion que se ejecute, por ejemplo adicionar, editar, eliminar,transferir,aprobar,etc. El tipo de terminacion define como se va a terminar la actividad 1 por una accion del sistema 2 de forma manual

/*
 * $iddocumento=Iddocumento
 * $accion=Nombre de la accion de la tabla accion
 * $tipo_terminacion= 1:accion del sistema, 2: De forma manual.
 * $paso_documento= es idpaso_documento de la tabla paso_documento.
 * $idactividad=idpaso_actividad de la actividad que se requiere terminar.
 * 
 * Funcion encargada de terminar una actividad en un paso, sea de manera manual o de manera automatica.
 */  
function terminar_actividad_paso($iddocumento,$accion,$tipo_terminacion=1,$paso_documento=0,$idactividad=0){
  global $conn;
  //$listado_acciones_paso='';
  $listado_acciones_paso=array();
  $sql2='';
  
  //error("INICIA TERMINAR ACTIVIDAD PASO--->");
 //Se adiciona para validar que el paso actual sea una respuesta del paso anterior para que el paso actual actualice el iddocumento
 

 
if($accion=="adicionar"){

  //Se consulta la informacion del documento actual para sacar los pasos y las actividades vinculadas
  $formato=busca_filtro_tabla("","formato A, documento B, paso_actividad C, accion D","A.nombre=lower(B.plantilla) AND A.idformato=C.formato_idformato AND C.accion_idaccion = D.idaccion AND D.nombre='".$accion."' AND B.iddocumento=".$iddocumento." AND C.estado=1","",$conn);
  if($formato["numcampos"]){
    for($i=0;$i<$formato["numcampos"];$i++){
      //Se sacan todos los pasos pendientes o devueltos que esten relacionados con el usuario actual y que tengan relacion con los pasos del documento actual
      //Estado 4 en paso_documento = pendiente y 7= devuelto
      $paso_doc=busca_filtro_tabla("","paso_documento A,paso_actividad C","A.paso_idpaso=C.paso_idpaso AND C.estado=1 AND A.paso_idpaso=".$formato[$i]["paso_idpaso"]." AND A.estado_paso_documento IN(4,7) AND (C.llave_entidad=-1) AND C.formato_idformato=".$formato[$i]["idformato"],"",$conn);
      if(!$paso_doc["numcampos"]){
        //error("SI NO EXISTE PASO DOCUMENTO--->");
        $paso_doc=busca_filtro_tabla("","paso_documento A,paso_actividad C, vfuncionario_dc B","A.paso_idpaso=C.paso_idpaso AND C.estado=1 AND A.paso_idpaso=".$formato[$i]["paso_idpaso"]." AND A.estado_paso_documento IN(4,7) AND (C.llave_entidad=B.idcargo AND B.funcionario_codigo=".$_SESSION["usuario_actual"].") AND C.formato_idformato=".$formato[$i]["idformato"],"",$conn);
      }
      if($paso_doc["numcampos"]){
        $paso_doc_terminado["numcampos"]=0;
        if($formato[$i]["paso_anterior"]){
          //error("PASO DOC TEMP-->");
          $paso_doc_temp=busca_filtro_tabla("","paso_documento A, respuesta B","A.documento_iddocumento=B.origen AND B.destino=".$iddocumento." AND A.paso_idpaso=".$formato[$i]["paso_anterior"],"B.idrespuesta DESC",$conn);
          if($paso_doc_temp["numcampos"]){
            //error("PASO DOC TERMINADO 1-->");
            $paso_doc_terminado=busca_filtro_tabla("","paso_documento A, paso_actividad B","B.estado=1 AND A.paso_idpaso=B.paso_idpaso AND A.diagram_iddiagram_instance=".$paso_doc_temp[0]["diagram_iddiagram_instance"]." AND B.formato_idformato=".$formato[$i]["formato_idformato"]." AND A.estado_paso_documento>3","",$conn);
            $sql2="UPDATE paso_documento SET documento_iddocumento=".$iddocumento." WHERE idpaso_documento=".$paso_doc_terminado[0]["idpaso_documento"];
          }
        }
        else if($_REQUEST["anterior"]){
          //error("PASO DOC TERMINADO 2-->");
          $paso_doc_terminado=busca_filtro_tabla("","paso_documento A, respuesta B","A.documento_iddocumento=B.origen AND A.documento_iddocumento=".$_REQUEST["anterior"]." AND A.paso_idpaso=".$formato[$i]["paso_idpaso"]." AND A.estado_paso_documento>3","B.idrespuesta DESC",$conn);
          $sql2="UPDATE paso_documento SET documento_iddocumento=".$iddocumento." WHERE idpaso_documento=".$paso_doc_terminado[0]["idpaso_documento"];
        }
        if($paso_doc_terminado["numcampos"] && $sql2!=''){
          //error("SQL PASO DOC TERMINADO --->");
          phpmkr_query($sql2);
        }  
      }
    }
  }
}   
if($accion!="" && $tipo_terminacion==1){
	

//La condicion c.estado_paso_documento>4 es para verificar que el paso no este terminado o cerrado
  if($iddocumento){
      
    //error("LISATDO ACCIONES 1");
    $listado_acciones_paso=busca_filtro_tabla("B.idpaso_actividad, A.idaccion, C.idpaso_documento, B.entidad_identidad, B.llave_entidad, C.diagram_iddiagram_instance, B.paso_idpaso,C.documento_iddocumento, B.formato_idformato", "accion A, paso_actividad B, paso_documento C","A.idaccion=B.accion_idaccion AND B.paso_idpaso=C.paso_idpaso AND C.documento_iddocumento=".$iddocumento." AND A.nombre='".$accion."' AND C.estado_paso_documento>3 AND B.estado=1","B.orden",$conn);
  }               
}
else if($paso_documento && $idactividad){
				  
	
  //error("LISATDO ACCIONES 2--->");
 // $listado_acciones_paso=busca_filtro_tabla("B.idpaso_actividad,B.accion_idaccion AS idaccion,C.idpaso_documento,B.entidad_identidad,B.llave_entidad,C.diagram_iddiagram_instance,B.paso_idpaso,C.documento_iddocumento, B.formato_idformato"," paso_actividad B, paso_documento C"," B.paso_idpaso=C.paso_idpaso AND C.idpaso_documento=".$paso_documento." AND B.idpaso_actividad=".$idactividad." AND C.estado_paso_documento>3 AND B.estado=1","B.orden",$conn);
  $listado_acciones_paso=busca_filtro_tabla("B.idpaso_actividad,B.accion_idaccion AS idaccion,C.idpaso_documento,B.entidad_identidad,B.llave_entidad,C.diagram_iddiagram_instance,B.paso_idpaso,C.documento_iddocumento, B.formato_idformato"," paso_actividad B, paso_documento C"," B.paso_idpaso=C.paso_idpaso AND C.idpaso_documento=".$paso_documento." AND B.idpaso_actividad=".$idactividad." AND C.estado_paso_documento>=3 AND B.estado=1","B.orden",$conn);
  
  
}
else{

  return (0);
}
if(!$listado_acciones_paso["numcampos"] && $accion=='confirmar'){
	
    //error("LISTADO ACCIONES 2--->");
    $listado_acciones_paso=busca_filtro_tabla("B.idpaso_actividad, A.idaccion, C.idpaso_documento, B.entidad_identidad, B.llave_entidad, C.diagram_iddiagram_instance, B.paso_idpaso,C.documento_iddocumento, B.formato_idformato", "accion A, paso_actividad B, paso_documento C","A.idaccion=B.accion_idaccion AND B.paso_idpaso=C.paso_idpaso AND C.documento_iddocumento=".$iddocumento." AND (A.nombre='aprobar' OR A.nombre='confirmar') AND C.estado_paso_documento>3 AND B.estado=1","B.orden",$conn);
    if($listado_acciones_paso["numcampos"])
        $accion='aprobar';
}
for($i=0;$i<@$listado_acciones_paso["numcampos"];$i++){
  	//VALIDA SI LA ACTIVIDAD LA REALIZA CUALQUIER USUARIO PARA QUE PERMITA TERMINAR LA ACTIVIDAD	
    $verifica_funcionario=verificar_existencia_funcionario($listado_acciones_paso[$i]["entidad_identidad"],$listado_acciones_paso[$i]["llave_entidad"],$_SESSION["usuario_actual"]);
    //----------------------------------------------------
    if($verifica_funcionario && $accion=="adicionar"){
        ///Adicionar aqui la ruta 
        $formato_nuevo=busca_filtro_tabla("B.idformato","documento A,formato B","lower(A.plantilla)=lower(B.nombre) AND A.iddocumento=".$iddocumento,"",$conn);
        //error("TERMINADA AL ADICIONAR-->".print_r($formato_nuevo,true).$verifica_funcionario."-->".$accion);
        generar_ruta_documento($formato_nuevo[0]["idformato"],$iddocumento);
    }
    if($accion=='transferir'){
      $buzon=busca_filtro_tabla("","buzon_salida","archivo_idarchivo=".$iddocumento." AND nombre NOT LIKE 'ELIMINA_%'","idtransferencia DESC",$conn);
      //error("TERMINADA AL TRANSFERIR BUZON-->".print_r($buzon,true)."-->".$verifica_funcionario."-->".$accion);
      if($buzon["numcampos"]){
        if($buzon[0]["origen"]==$buzon[0]["destino"]){
          $verifica_funcionario=false;  
        }
      }
      else{
        $verifica_funcionario=false;
      }
	  
	  
	  
	  
    }
    
    
    
    
	
    if($accion=='aprobar'){
        //error("ACCION APROBAR");
        $ruta=busca_filtro_tabla("","buzon_entrada A, ruta B","A.ruta_idruta=B.idruta AND A.archivo_idarchivo=".$iddocumento." AND A.nombre='POR_APROBAR' AND A.origen=-1 AND A.activo=1 AND A.destino=".usuario_actual("funcionario_codigo"),"B.orden ASC",$conn);
        $radicador_salida=busca_filtro_tabla("","configuracion a, vfuncionario_dc b","a.nombre='radicador_salida' and valor=b.login","",$conn);
        //error("ELIMINA TODAS LAS RUTAS PENDIENTES CON ORIGEN -1 (Sin ruta asignada)");
        $sql1="delete from ruta where origen=-1 and documento_iddocumento=".$iddocumento;
        phpmkr_query($sql1);
        $sql2="delete from buzon_entrada where destino=-1 and archivo_idarchivo=".$iddocumento;
        phpmkr_query($sql2);
        //error("ACTUALIZA LA ULTIMA RUTA CON EL USUARIO RADICADOR");
        $ruta1=busca_filtro_tabla("","ruta a","a.documento_iddocumento=".$iddocumento." and destino=-1","",$conn);
        $sql3="update ruta set destino=".$radicador_salida[0]["funcionario_codigo"]." where idruta=".$ruta1[0]["idruta"];
        phpmkr_query($sql3);
        $sql4="UPDATE buzon_entrada SET origen=".$radicador_salida[0]["funcionario_codigo"]." WHERE idtransferencia=".$ruta[0]["idtransferencia"]." AND nombre='POR_APROBAR'";
        phpmkr_query($sql4);
        
    }		
	
	
	
	if(($accion=='confirmar' || $accion=='aprobar') && $listado_acciones_paso[$i]['llave_entidad']==-2){ //funcionario tomado de un campo  
	    $datos_apaso_actividad=busca_filtro_tabla("","paso_actividad","idpaso_actividad=".$listado_acciones_paso[$i]['idpaso_actividad'],"",$conn);
	                
	   $condicion=generar_condicion_funcionario_tomado_campo($datos_apaso_actividad[0]["fk_campos_formato"],$datos_apaso_actividad[0]["formato_anterior"]);
	   $funcionario=busca_filtro_tabla("","vfuncionario_dc",$condicion." AND estado_dc=1 AND estado=1","",$conn);

	   	if($funcionario[0]['login']==usuario_actual('login')){
	   	     $verifica_funcionario=1;
	   	}else{
	   	    $verifica_funcionario=0;
	   	}
	}
	
    if($verifica_funcionario){
      $terminada_actual=verificar_instancia_terminada($listado_acciones_paso[$i]["idpaso_actividad"],$iddocumento,$_SESSION["usuario_actual"],$tipo_terminacion);
      //error("TERMINADA ACTUAL-->".print_r($terminada_actual, true));
      if($terminada_actual["numcampos"]){
        return($terminada_actual[0]["idpaso_instancia_terminada"]);
      }
      //error("TERMINAR PASO INSTANCIA");
      $sql_accion="INSERT INTO paso_instancia_terminada(actividad_idpaso_actividad,documento_iddocumento,responsable,fecha,tipo_terminacion) VALUES(".$listado_acciones_paso[$i]["idpaso_actividad"].",".$iddocumento.",".$_SESSION["usuario_actual"].",".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").",".$tipo_terminacion.")";
      phpmkr_query($sql_accion);
      $idterminacion=phpmkr_insert_id();
      //escribe_log('entra antes de verificar_terminacion_paso con idterminacion='.$idterminacion.'<br>');
      if(verificar_terminacion_paso($listado_acciones_paso[$i]["paso_idpaso"],$iddocumento)){
      	//escribe_log('entra despues de verificar_terminacion_paso<br>'); 
        //iniciar_paso_siguiente($idpaso_documento,$anterior,$documento){
        finalizar_paralelos($listado_acciones_paso[$i]["diagram_iddiagram_instance"],$listado_acciones_paso[$i]["paso_idpaso"],$iddocumento);
        $paso_siguiente=iniciar_paso_siguiente($listado_acciones_paso[$i]["idpaso_documento"],$listado_acciones_paso[$i]["documento_iddocumento"],$iddocumento,$accion);
        //escribe_log($paso_siguiente);
        //escribe_log('entra a paso_siguinte<br>');
        if($paso_siguiente==2){
          //error('entra paso siguiente=2 para cerrar el flujo');
          $sql_cerrar_flujo="UPDATE diagram_instance SET estado_diagram_instance=2 WHERE iddiagram_instance=".$listado_acciones_paso[$i]["diagram_iddiagram_instance"]; 
          phpmkr_query($sql_cerrar_flujo);
    //escribe_log('ejecuta'.$sql_cerrar_flujo.'<br>');
    //escribe_log('Paso siguiente=2',$tipo_terminacion);
          return($idterminacion);
        }
        else if($paso_siguiente==1){
          $documento=$listado_acciones_paso[$i]["documento_iddocumento"];
          //error('entra paso siguiente=1 para responder adicionar o radicar');
          if($accion=="responder" || $accion=='adicionar' || $accion=="radicar"){          
            $respuesta=busca_filtro_tabla("","respuesta","origen=".$listado_acciones_paso[$i]["documento_iddocumento"],"",$conn); 
            //si es una respuesta de un documento del paso anterior, actualiza el paso actual con el id del nuevo documento
            if($respuesta["numcampos"]){
              $paso_siguiente=busca_filtro_tabla("B.idpaso_documento","paso_enlace A,paso_documento B","A.destino=B.paso_idpaso AND A.origen=".$listado_acciones_paso[$i]["paso_idpaso"]." AND B.documento_iddocumento=".$listado_acciones_paso[$i]["documento_iddocumento"]." AND tipo_origen='bpmn_tarea'","",$conn);
    	        //error("PASO siguiente para respuesta de documentos");
              $sql_responder="UPDATE paso_documento SET documento_iddocumento=".$respuesta[0]["destino"]." WHERE idpaso_documento=".$paso_siguiente[0]["idpaso_documento"];
              $documento=$respuesta[0]["destino"];
              phpmkr_query($sql_responder);
              //escribe_log("sqsl responder ".$sql_responder."<br>",$tipo_terminacion);
            } 
          }
          //Pasos Siguientes Insertados
          //error("return idterminacion ".$idterminacion." paso_siguiente=1"); 
          return($idterminacion);
        } 
        else if(!$paso_siguiente==0){
          //Existe error
          //error("Retorno error ");
          return (0);
        }
      }
      else{
        $sql="UPDATE paso_documento SET estado_paso_documento=6 WHERE idpaso_documento=".$listado_acciones_paso[$i]["idpaso_documento"];
    //echo'entra UPDATE PASO documento estado=6<br>';
      }
      //error("return idterminacion".$idterminacion);
      
      return($idterminacion);
    }
}
//escribe_log("0",$tipo_terminacion);
return (0);
}
function listado_pasos_anteriores_admin($idpaso,$tipo_paso="bpmn_tarea"){
  global $pasos_anteriores,$nivel;
  $nivel++;
  $paso_anterior=busca_filtro_tabla("","paso_enlace B","B.destino=".$idpaso." AND B.origen<>-1 AND tipo_destino='".$tipo_paso."'","",$conn);
 
  if($nivel<50){
    //TODO: Verificar los condicionales para que hagan el salto
    if($paso_anterior["numcampos"] ){
      for($i=0;$i<$paso_anterior["numcampos"];$i++){
        if($paso_anterior[$i]["tipo_origen"]=='bpmn_tarea')
          array_push($pasos_anteriores,$paso_anterior[$i]["origen"]);  
        listado_pasos_anteriores_admin($paso_anterior[$i]["origen"],$paso_anterior[$i]["tipo_origen"]);
      }
    }
    else{
      $paso_anterior=busca_filtro_tabla("","paso_enlace B","B.destino=".$idpaso." AND B.origen<>-1 AND tipo_destino='".$tipo_paso."'","",$conn);
      if($paso_anterior["numcampos"]){
        for($i=0;$i<$paso_anterior["numcampos"];$i++){
          if($paso_anterior[$i]["tipo_origen"]=='bpmn_tarea')
            array_push($pasos_anteriores,$paso_anterior[$i]["origen"]);  
          listado_pasos_anteriores_admin($paso_anterior[$i]["origen"],$paso_anterior[$i]["tipo_origen"]);
        }
      } 
    }
  }
  return(array_unique($pasos_anteriores));    
}
function verificar_instancia_terminada($idpaso_actividad,$iddocumento,$usuario,$tipo_terminacion=1){
  $terminacion=busca_filtro_tabla("","paso_instancia_terminada","actividad_idpaso_actividad=".$idpaso_actividad." AND documento_iddocumento=".$iddocumento." AND responsable=".$usuario." AND tipo_terminacion=".$tipo_terminacion,"",$conn);
 return($terminacion); 
}
function terminar_actividad_manual($idpaso_documento,$terminacion,$observaciones){
  $fieldList=array();
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($observaciones) : $observaciones; 
  $theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
  $fieldList["observaciones"] = $theValue;
  $fieldList["documento_idpaso_documento"] = $idpaso_documento;
  $fieldList["instancia_idpaso_instancia"] = $terminacion;
  $fieldList["funcionario_codigo"] = $_SESSION["usuario_actual"];
  $fieldList["fecha_justificacion"] = fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s");
  // insert into database
  $strsql = "INSERT INTO paso_inst_terminacion (";
  $strsql .= implode(",", array_keys($fieldList));
  $strsql .= ") VALUES (";
  $strsql .= implode(",", array_values($fieldList));
  $strsql .= ")";
  phpmkr_query($strsql);
  $idterminacion_manual=phpmkr_insert_id();
  return($idterminacion_manual);
}
function finalizar_paralelos($iddiagram_instance, $idpaso,$iddocumento){
  $sql="UPDATE paso_documento SET diagram_iddiagram_instance=-".$iddiagram_instance." WHERE paso_idpaso<>".$idpaso." AND diagram_iddiagram_instance=".$iddiagram_instance." AND (estado_paso_documento=4 OR estado_paso_documento=7)";
  phpmkr_query($sql);
}

/*
 * $idpaso=Idpaso;
 * $iddocumento=iddocumento
 */  
//Verifica todos el paso que tenga el documento X y el paso Y que no este cancelado para sacar el diagrama y poder compararlo con los hermanos y verificar el estado del paso y actualizarlo si es necesario el menor que 3 es porque estado 1 es ejecutado, estado 2 es cerrado y estado 3 es cancelado
function verificar_terminacion_paso($idpaso,$iddocumento){
  $paso_documento=busca_filtro_tabla("","paso_documento","paso_idpaso=".$idpaso." AND documento_iddocumento=".$iddocumento,"",$conn);
  $pasos_flujo=busca_filtro_tabla("","paso_documento","diagram_iddiagram_instance=".$paso_documento[0]["idpaso_documento"],"",$conn);
  //Sacamos el paso del documento para conocer el estado 
  if($paso_documento["numcampos"] && $paso_documento[0]["estado_paso_documento"]>3){
    $actividad_terminada=busca_filtro_tabla("","paso_instancia_terminada A,paso_actividad B","B.estado=1 AND A.actividad_idpaso_actividad=B.idpaso_actividad AND B.paso_idpaso=".$idpaso." AND documento_iddocumento=".$iddocumento,"",$conn);
    $lactividades=extrae_campo($actividad_terminada,"actividad_idpaso_actividad");
    $condicion_actividad="";
    if($actividad_terminada["numcampos"]){
      $condicion_actividades=" AND idpaso_actividad NOT IN(".implode(",",$lactividades).")";
    }
    $pasos_restrictivos=busca_filtro_tabla("","paso_actividad","paso_idpaso=".$idpaso." AND restrictivo=1 AND estado=1".$condicion_actividades,"",$conn);
   
    if($pasos_restrictivos["numcampos"]){
      return(false);
    }
    else{      
      $pasos_no_restrictivos=busca_filtro_tabla("","paso_actividad","paso_idpaso=".$idpaso." AND restrictivo=0 AND estado=1 ".$condicion_actividades,"",$conn);
      if($pasos_no_restrictivos["numcampos"]){
        $sql_terminacion_ejecutado="UPDATE paso_documento SET estado_paso_documento=1 WHERE idpaso_documento=".$paso_documento[0]["idpaso_documento"];
        phpmkr_query($sql_terminacion_ejecutado);
      }
      else{
        /*Se cierra el paso porque se terminan las actividades del paso*/
        $sql_terminacion_cerrados="UPDATE paso_documento SET estado_paso_documento=2 WHERE idpaso_documento=".$paso_documento[0]["idpaso_documento"];
        phpmkr_query($sql_terminacion_cerrados);
      } 
      return (true);
    }
  } 
  return(false);    
}

/*
 * $iddocumento=Iddocumento
 * $idflujo=iddiagram
 * 
 * Funcion llamada de app/documento/class_transferencia.php y db.php, Se encarga de iniciar un flujo del documento.
 */
function iniciar_flujo($iddocumento,$idflujo){
global $conn;
  if(!$idflujo){
    $documento=busca_filtro_tabla("","documento A, formato B","lower(A.plantilla)=lower(B.nombre) AND A.iddocumento=".$iddocumento,"",$conn);
    //TODO: se debe cambiar en toda parte para que valide el radicar en lugar del adicionar para adicionar los formatos, debido a que primero hace transferencias antes de adicionar y los procesos no quedan funcionalmente correctos  
    $flujo=busca_filtro_tabla("B.diagram_iddiagram","paso B, paso_actividad C, accion D, paso_enlace E, vfuncionario_dc F","C.estado=1 AND B.idpaso=C.paso_idpaso AND C.accion_idaccion=D.idaccion AND D.nombre='adicionar' AND C.formato_idformato=".$documento[0]["idformato"]." AND E.destino=B.idpaso AND E.origen=-1 AND ((C.llave_entidad=F.idcargo OR C.llave_entidad=-1) AND F.funcionario_codigo=".usuario_actual("funcionario_codigo").")","",$conn);
    //TODO: Aqui se debe validar que el idflujo llegue como un arreglo en caso de que existan varios formatos vinculados a varios flujos.  Se debe validar que el usuario que inicia el flujo sea el encargado de adicionar el formato y que una de las acciones del paso inicial sea adicionar el formato actual
    if($flujo["numcampos"]){
       $idflujo=$flujo[0]["diagram_iddiagram"];
    }
  }
  if($idflujo && $iddocumento){
    //en la condicion de paso_enlace -1 es el nodo de inicio y -2 es el nodo final
    $datos_enlace=busca_filtro_tabla("DISTINCT A.idpaso,A.posicion","paso A, paso_enlace B","A.diagram_iddiagram=".$idflujo." AND A.idpaso=B.destino AND B.origen=-1","",$conn);
    if($datos_enlace["numcampos"]){
      $idpaso=$datos_enlace[0]["idpaso"];
    }
    if($idpaso && $idflujo && $iddocumento){
      $fecha=date("Y-m-d H:i:s");
      $sql_diagram="INSERT INTO diagram_instance(diagram_iddiagram,fecha,funcionario_codigo,estado_diagram_instance) VALUES(".$idflujo.",".fecha_db_almacenar($fecha,"Y-m-d H:i:s").",".$_SESSION["usuario_actual"].",4)";
      phpmkr_query($sql_diagram);
      $iddiagram=phpmkr_insert_id();
      vincular_documento_paso($iddiagram,$idpaso,$iddocumento);
    }
  }
}
/*
 * $idpaso_documento=idpaso_documento
 * $documento=iddocumento
 * 
 * Despues de terminar una actividad, esta funcion valida cual es el paso a seguir, si encuentra un paso siguiente, realiza un registro sobre paso_documento y lo pone en estado pendiente.
 */
function iniciar_paso_siguiente($idpaso_documento,$documento,$iddoc,$accion){
    if(@$idpaso_documento){
        $paso_anterior=busca_filtro_tabla("","paso_documento A,paso B","A.paso_idpaso=B.idpaso AND A.idpaso_documento=".$idpaso_documento,"",$conn);
        if($paso_anterior["numcampos"]){
            if(!$documento){
              $documento=$paso_anterior[0]["documento_iddocumento"];
            }
            $paso_siguiente=busca_filtro_tabla("A.destino, A.tipo_destino, A.diagram_iddiagram","paso_enlace A","A.origen=".$paso_anterior[0]["paso_idpaso"]." AND A.destino<>-2 AND tipo_origen='bpmn_tarea'","",$conn);
            if($paso_siguiente["numcampos"]){
              //Existen Mas pasos
              //TODO: VErificar si existen pasos y condicionales para enviar error
              if($paso_siguiente[0]["tipo_destino"]=="bpmn_condicional"){
                $condicional=$paso_siguiente;
                $paso_siguiente= busca_filtro_tabla("A.destino","paso_enlace A","A.origen=".$paso_siguiente[0]["destino"]." AND A.destino<>-2 AND A.tipo_origen='bpmn_condicional' AND A.tipo_destino='bpmn_tarea' AND diagram_iddiagram=".$paso_siguiente[0]["diagram_iddiagram"],"",$conn);
                $paso_siguiente=validar_condicional_paso_siguiente($condicional,$paso_siguiente,$idpaso_documento,$documento,$paso_anterior[0]["diagram_iddiagram_instance"]);
                
              }
              if($paso_siguiente["numcampos"]){
                $pasos_evaluar=array();
                for($i=0;$i<$paso_siguiente["numcampos"];$i++){
                  $sql2="INSERT INTO paso_documento(paso_idpaso,documento_iddocumento,fecha_asignacion,diagram_iddiagram_instance,estado_paso_documento) VALUES(".$paso_siguiente[$i]["destino"].",".$documento.",".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").",".$paso_anterior[0]["diagram_iddiagram_instance"].",4)";
                  phpmkr_query($sql2);
                  $idpaso_documento=phpmkr_insert_id();
                  array_push($pasos_evaluar,$idpaso_documento);
                }
                //error("PASOS A EVALUAR RUTA: ".print_r($pasos_evaluar,true));
                //error("DOCUMENTO A EVALUAR RUTA:".$documento);
				//error("PASO ANTERIOR:".print_r($paso_anterior,true));
				
                if(count($pasos_evaluar)){
                    //TODO: validar que se puede hacer para las rutas paralelas aqui se debe hacer 
                    validar_ruta_documento_flujo($documento,$pasos_evaluar,$paso_anterior,$accion);
                }
                return(1);
              }
              else{
                //No existen mas pasos verificar si se devuelve un error porque no existen tareas posteriores a un condicional
                return(2);
              }
            }
            else{
              //No existen mas pasos o existen pasos y condicionales 
              return(2);
            }   
        }
        else{
            return(false);
        }
    }    
return(false);   
}
/*
 * $paso_siguiente=busca_filtro_tabla de lo que sigue al paso posterior al condicional
 * $iddocumento=iddocumento
 * $idpaso_documento= paso_documento en caso de poseerlo
 * 
 * Funcion encagada de excluir los pasos que se pueden ejecutar despues de ejecutar el condicional, el retorno sera el mismo paso_siguiente con los valores excluidos 
 */
function validar_ruta_documento_flujo($iddoc,$pasos_evaluar,$paso_anterior,$accion){
    //error("VALIDAR RUTA DOCUMENTO PASO RUTA");
    $dato_paso_ruta=busca_filtro_tabla("","paso_documento C, paso_actividad A, accion B","A.estado=1 AND A.accion_idaccion=B.idaccion AND A.paso_idpaso=C.paso_idpaso AND C.idpaso_documento IN(".implode(",",$pasos_evaluar).") AND (B.nombre='aprobar' OR nombre='confirmar')","",$conn);
    
    
    if($dato_paso_ruta["numcampos"]){
        //error("RUTA 1");
        $ruta1=busca_filtro_tabla("","buzon_entrada A, ruta B","A.ruta_idruta=B.idruta AND A.archivo_idarchivo=".$iddoc." AND A.nombre='POR_APROBAR' AND A.origen=-1 AND A.destino=".usuario_actual("funcionario_codigo"),"B.orden ASC",$conn);
        if(!$ruta1["numcampos"]){
            //verifica el ultimo funcionario de la ruta pendiente por asignar si no encuentra el usuario actual
            //error("RUTA 1 NO EXISTE ");
            $funcionario_ultima_ruta=busca_filtro_tabla("","buzon_entrada","archivo_idarchivo=".$iddoc." AND nombre='POR_APROBAR'  AND destino<>-1 AND origen=-1","idtransferencia DESC",$conn);
            $ruta1=busca_filtro_tabla("","buzon_entrada A, ruta B","A.ruta_idruta=B.idruta AND A.archivo_idarchivo=".$iddoc." AND A.nombre='POR_APROBAR' AND A.origen=-1 AND A.destino=".$funcionario_ultima_ruta[0]["destino"],"B.orden ASC",$conn);
        }
        
        if($ruta1["numcampos"]){
          for($i=0;$i<$ruta1["numcampos"];$i++){
              //error("RUTA 2");
              $ruta2=busca_filtro_tabla("","ruta A","A.idruta>".$ruta1[$i]["idruta"]." AND A.orden=".($ruta1[$i]["orden"]+1)." AND A.documento_iddocumento=".$iddoc." AND A.tipo='ACTIVO'","",$conn);
              //Se debe actualizar la ruta para que tome el dato del paso y haga las actualizaciones necesarias
              if($ruta2["numcampos"]){
                  //error("EXISTE RUTA 2 Y EL FUNCIONARIO ESTA ACTIVO");
                 // print_r($dato_paso_ruta);die();
                  if($dato_paso_ruta[0]["llave_entidad"]==-2){
                    $condicion=generar_condicion_funcionario_tomado_campo($dato_paso_ruta[0]["fk_campos_formato"],$dato_paso_ruta[0]["formato_anterior"]);
                    $funcionario=busca_filtro_tabla("","vfuncionario_dc",$condicion." AND estado_dc=1 AND estado=1","",$conn);

                  }else{
                      $funcionario=busca_filtro_tabla("","vfuncionario_dc","idcargo=".$dato_paso_ruta[0]["llave_entidad"]." AND estado_dc=1 AND estado=1","",$conn);
                  } //fin llave_entidad -2

                  //Verificar que pasa cuando se tienen varios funcionarios con el mismo cargo 
                  //Se actualiza la ruta se modifica el destino por el funcionario asignado en la actividad por medio del cargo y el origen en la ruta siguiente
                  //error("ACTUALIZA RUTA ");
                  $sql2="UPDATE ruta SET destino=".$funcionario[0]["iddependencia_cargo"]." , tipo_destino=5 WHERE idruta=".$ruta1[0]["ruta_idruta"];
                  phpmkr_query($sql2);
                  $sql2="UPDATE ruta SET origen=".$funcionario[0]["iddependencia_cargo"]." , tipo_origen=5 WHERE idruta=".$ruta2[0]["idruta"];
                  phpmkr_query($sql2);
                  //Se actualiza el buzon de entrada, el origen con el funcionario asignado en la actividad por medio del cargo y el destino en la ruta siguiente
                  //error("ACTUALIZA BUZON ENTRADA");
                  $sql2="UPDATE buzon_entrada SET origen=".$funcionario[0]["funcionario_codigo"]." WHERE idtransferencia=".$ruta1[0]["idtransferencia"]." AND nombre='POR_APROBAR'";
                  phpmkr_query($sql2);
                  $sql2="UPDATE buzon_entrada SET destino=".$funcionario[0]["funcionario_codigo"]." WHERE ruta_idruta=".$ruta2[0]["idruta"]." AND nombre='POR_APROBAR'";
                  phpmkr_query($sql2);
				  
				
 				  $sql3="UPDATE buzon_salida SET destino='".$funcionario[0]["funcionario_codigo"]."' WHERE archivo_idarchivo=".$iddoc." AND ruta_idruta=".$ruta1[0]['ruta_idruta'];
				  phpmkr_query($sql3);
				  
				 
				  
              }
          }
          ///insert asignacion
          //error("INSERTA ASIGNACION PARA QUE QUEDE PENDIENTE EL DOCUMENTO VINCULADO CON LA RUTA");
          $sql2="INSERT INTO asignacion(entidad_identidad,llave_entidad,documento_iddocumento,fecha_inicial)VALUES(1,".$funcionario[0]["funcionario_codigo"].",".$iddoc.",".fecha_db_almacenar("","Y-m-d H:i:s").")"; 
          phpmkr_query($sql2);
          //echo(" SQL ASIGNACION: <br>".$sql2."<hr>");
        }
        
        
    }
    else if($accion=='aprobar'){
        //error("ACCION APROBAR");
        $ruta=busca_filtro_tabla("","buzon_entrada A, ruta B","A.ruta_idruta=B.idruta AND A.archivo_idarchivo=".$iddoc." AND A.nombre='POR_APROBAR' AND A.origen=-1 AND A.activo=1 AND A.destino=".usuario_actual("funcionario_codigo"),"B.orden ASC",$conn);
        $radicador_salida=busca_filtro_tabla("","configuracion a, vfuncionario_dc b","a.nombre='radicador_salida' and valor=b.login","",$conn);
        //error("ELIMINA TODAS LAS RUTAS PENDIENTES CON ORIGEN -1 (Sin ruta asignada)");
        $sql1="delete from ruta where origen=-1 and documento_iddocumento=".$iddoc;
        phpmkr_query($sql1);
        $sql2="delete from buzon_entrada where destino=-1 and archivo_idarchivo=".$iddoc;
        phpmkr_query($sql2);
        //error("ACTUALIZA LA ULTIMA RUTA CON EL USUARIO RADICADOR");
        $ruta1=busca_filtro_tabla("","ruta a","a.documento_iddocumento=".$iddoc." and destino=-1","",$conn);
        $sql3="update ruta set destino=".$radicador_salida[0]["funcionario_codigo"]." where idruta=".$ruta1[0]["idruta"];
        phpmkr_query($sql3);
        $sql4="UPDATE buzon_entrada SET origen=".$radicador_salida[0]["funcionario_codigo"]." WHERE idtransferencia=".$ruta[0]["idtransferencia"]." AND nombre='POR_APROBAR'";
        phpmkr_query($sql4);
        
    }
    //die("PRUEBA RUTA");
    return(0);
}

 
/*
 * $condicional=busca_filtro_tabla de paso_enlace que continua tiene el diagrama, tipo_destino y destino
 * $paso_siguiente=busca_filtro_tabla de lo que sigue al paso posterior al condicional
 * $iddocumento=iddocumento
 * $idpaso_documento= paso_documento en caso de poseerlo
 * 
 * Funcion encagada de excluir los pasos que se pueden ejecutar despues de ejecutar el condicional, el retorno sera el mismo paso_siguiente con los valores excluidos 
 */
function validar_condicional_paso_siguiente($condicional,$paso_siguiente,$idpaso_documento,$documento,$diagram_instance){
 //Entra si estan iniciadas todas las tareas siguientes y se deben filtrar por medio de los condicionales
  $condicional_admin=busca_filtro_tabla("","paso_condicional_admin A","A.estado=1 AND A.fk_paso_condicional=".$condicional[0]["destino"],"",$conn);
  $incluir_condicional=array();
  if($condicional_admin["numcampos"]){
    //Buscar todos los documentos que se han ejecutado y no estan devueltos o cancelados, para validar los campos y formatos e identificar si se deben habilitar las tareaas o no de los pasos siguientes
    for($i=0;$i<$condicional_admin["numcampos"];$i++){
      $tareas=busca_filtro_tabla("A.*,B.*,C.*,D.nombre_tabla","paso_documento A, paso_actividad B, campos_formato C, formato D","C.formato_idformato=D.idformato AND A.paso_idpaso=B.paso_idpaso AND A.diagram_iddiagram_instance=".$diagram_instance." AND A.estado_paso_documento NOT IN(3,7,0) AND B.formato_idformato=C.formato_idformato AND B.estado=1 AND C.idcampos_formato=".$condicional_admin[$i]["fk_campos_formato"],"",$conn);
      if($tareas["numcampos"]){
        $tabla=busca_filtro_tabla($tareas[0]["nombre"],$tareas[0]["nombre_tabla"],"documento_iddocumento=".$tareas[0]["documento_iddocumento"],"",$conn);
        if($tabla["numcampos"]){
          $evaluacion=eval("return(".$tabla[0][$tareas[0]["nombre"]].$condicional_admin[$i]["comparacion"].$condicional_admin[$i]["valor"].");");
          if($evaluacion){
            $incluir_condicional=explode(",",$condicional_admin[$i]["habilitar_pasos_si"]);
          }
          else{
            $incluir_condicional=explode(",",$condicional_admin[$i]["habilitar_pasos_no"]);  
          }
        }
      }
    }
    $retorno=array();
    $contador_incluidos=count($incluir_condicional);
    $incluir_condicional=array_unique($incluir_condicional);
    for($i=0;$i<$paso_siguiente["numcampos"];$i++){
      if(in_array($paso_siguiente[$i]["destino"],$incluir_condicional)||!$contador_incluidos){
        array_push($retorno,array("destino"=>$paso_siguiente[$i]["destino"]));
        //$contador_incluidos++;
      }
    }
  } 
$retorno["numcampos"]=count($retorno);
return($retorno);
}
/*
 * $iddiagram_instance=iddiagram_instance
 * $idpaso=idpaso
 * $iddocumento=iddocumento
 * 
 * Despues de iniciar un flujo se llama a esta funcion para realizar las inserciones necesarias sobre la tabla paso_documento
 */
function vincular_documento_paso($iddiagram_instance,$idpaso,$iddocumento){
  global $conn;
  $paso_documento=busca_filtro_tabla("","paso_documento","paso_idpaso=".$idpaso." AND documento_iddocumento=".$iddocumento." AND diagram_iddiagram_instance=".$iddiagram_instance,"",$conn);
  if(!$paso_documento["numcampos"]){
    $sql_paso="INSERT INTO paso_documento(paso_idpaso,documento_iddocumento,fecha_asignacion,diagram_iddiagram_instance,estado_paso_documento) VALUES(".$idpaso.",".$iddocumento.",".fecha_db_almacenar(@$fecha,"Y-m-d H:i:s").",".$iddiagram_instance.",4)";
    phpmkr_query($sql_paso);
  }
  else{
    $paso_origen=busca_filtro_tabla("","paso_enlace","destino=".$idpaso." AND origen=-1","",$conn);
    if(!$paso_origen["numcampos"]){
      $sql_paso="UPDATE paso_documento SET documento_iddocumento=".$iddocumento.",estado_paso_documento=4 WHERE paso_idpaso=".$idpaso." AND diagram_iddiagram_instance=".$iddiagram_instance;
      phpmkr_query($sql_paso);
    }
    else{
      alerta("Esta tratando de vincular el origen del flujo y esto no es posible");
    }  
    //alerta("Esta intentando vincular un documento a un proceso que ya se encuentra en proceso de ejecucion y no es posible debe desvincular el documento y tratar de vincularlo de nuevo .");
  }      
return;
}
/*
<Clase>
<Nombre>ejecutar_acciones_actividad</Nombre> 
<Parametros>$idactividad: Identificador de la actividad a la cual se le desean mostrar las acciones</Parametros>
<Responsabilidades>Generar los enlaces a cada una de las actividades que vienen relacionadas con cada uno de los objetos y las acciones que se encuentran vinculadas con ellos por ejemplo adicionar->formato, aprobar->documento, transferir->serie,etc..Estas acciones deben de validarse con cada uno de los permisos a cada uno de los funcionarios para cada uno de los usuarios comparado con el usuario actual<Responsabilidades>
<Notas></Notas> 
<Excepciones></Excepciones>
<Salida>Muestra los enlaces para acceder a las acciones de la actividad</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function ejecutar_acciones_actividad($idactividad,$documento,$idpaso_documento,$devueltos){
global $ruta_db_superior,$conn;
$texto='';        
$boton_accion=$ruta_db_superior.'botones/workflow/sin_accion.png';
$cancelado = busca_filtro_tabla("","paso_documento a,diagram_instance b","idpaso_documento=".$idpaso_documento." and diagram_iddiagram_instance=iddiagram_instance and estado_diagram_instance=3","",$conn);
if(!$idpaso_documento){
  return;
}
if($cancelado["numcampos"] > 0){
  return ("Actividades bloqueadas por cancelaci&oacute;n del flujo");
}
if($devueltos){
  $texto.=("Documento devuelto.");
}

$actividad=busca_filtro_tabla("","paso_actividad A","A.estado=1 AND A.idpaso_actividad=".$idactividad,"",$conn);
if($actividad["numcampos"]){
  //Si llave de entidad tiene el valor de -1 cualquiera lo puede ejecutar, se modifica la funcion en class.funcionario
  $puede_ejecutar=verificar_existencia_funcionario($actividad[0]["entidad_identidad"],$actividad[0]["llave_entidad"],$_SESSION["usuario_actual"]);
  if($actividad[0]["tipo"]==1 &&$puede_ejecutar){
      $accion=busca_filtro_tabla("","accion A, modulo B","A.modulo_idmodulo = B.idmodulo AND A.idaccion=".$actividad[0]["accion_idaccion"],"",$conn);
      if($accion["numcampos"]){
          //$texto.="<img src='".$ruta_db_superior.$accion[0]["boton"]."'>";
          if($documento!=-1 && $idpaso_documento!=-1)
            $enlace=str_replace("@key@",$documento,$ruta_db_superior.$accion[0]["enlace"]."&idpaso_documento=".$idpaso_documento."&idpaso_actividad=".$idactividad);
          else
            $enlace="#";  
          $texto.=agrega_boton_paso($ruta_db_superior.$accion[0]["imagen"],$enlace,"_parent",$accion[0]["etiqueta"],$accion[0]["nombre"],1);
      }
      else{
          //$texto.="<img src='".$ruta_db_superior.$boton_accion."'>";
      }
  }
  else{
      //$texto.="<img src='".$ruta_db_superior.$boton_accion."'>";       
  }
if($documento!=-1 && $idpaso_documento!=-1 && $puede_ejecutar){
    if($actividad[0]["tipo"] == 0){     
        $texto.='&nbsp;<a href="'."terminar_actividad_paso_manual.php?idactividad=".$idactividad."&idpaso_documento=".$idpaso_documento."&documento=".$documento.'" target="'."_self".'"><img width=16 height=16 src="'.$ruta_db_superior."botones/workflow/terminar_actividad_paso_manual.png".'" title="'."Terminar Actividad de forma manual".'" class="" alt="'."Terminar Actividad de forma manual".'" border="0"  hspace="0" vspace="0" ></a>&nbsp;';
    }
}
}

return(str_replace("@actividad_paso@",$idactividad,$texto));
}
/*
 * Se encarga de agregar el boton de eliminar actividad en el listado de actividades de un paso.
 * 
 * $idactividad_paso=idpaso_actividad
 */
function acciones_edicion_actividad($idactividad_paso){
global $ruta_db_superior;
  //($imagen="../../botones/configuracion/default.gif",$dir="#",$destino="_self",$texto="",$modulo="",$retorno=0){
$texto=agrega_boton_paso("","#","_self","Eliminar","eliminar_actividad",1);
}
/*
 * $idactividad=idpaso_actividad
 * $idpaso_instancia_terminada=idpaso_instancia_terminada
 * $idpaso_documento=idpaso_documento
 * 
 * Encargado de mostrar el boton de devolucion, si el documento ya fue devuelto, saldra un boton de restaurar la actividad del paso. Esto sale al momento en que un documento se vincula a un flujo.
 */
function mostrar_acciones_actividad($idactividad,$idpaso_instancia_terminada=0,$idpaso_documento=0,$devuelto=0){
global $ruta_db_superior,$conn;
$texto='';
/*
 * @ devuelto define si es necesario devolver la actividad, es decir restaurar el estado y adicionar las notas redirecciona a la restauracion de la actividad
 * */    
if($devuelto){  
  $texto.="<a href='rehacer_actividad_paso.php?idpaso_documento=".$idpaso_documento."&idpaso_instancia_terminada=".$idpaso_instancia_terminada."'><img src='".$ruta_db_superior."images/panel_inferior_pasos/rehacer_flujo.png' title='Restaurar actividad del paso' alt='Restaurar actividad del paso'></a>";
  return $texto;
}
//TODO : Validaciones para las personas que puedan hacer la devolucion en este momento cualquier persona puede devolver.
if($idpaso_instancia_terminada &&$idpaso_documento){
  $texto.="<a href='devolver_actividad_paso.php?idpaso_instancia_terminada=".$idpaso_instancia_terminada."&idpaso_documento=".$idpaso_documento."'><img src='".$ruta_db_superior."images/panel_inferior_pasos/devolver_flujo.png' class='' title='Generar devolucion de la actividad' alt='Generar devolucion de la actividad'></a>"; 
}
return(str_replace("@actividad_paso@",$idactividad,$texto));
}
function vencimiento_actividad($idactividad,$iddocumento){
    
}
/*
 * $idpaso_documento=idpaso_documento
 * 
 * Muestra informacion general del estado del flujo.
 */
function estado_paso_documento($idpaso_documento){
global $conn,$ruta_db_superior;
//PILAS: Se cambia el include de calendario por la libreria de fechas de pantallas y por ende la funcion dias_habilies por dias_habiles_listado 
//include_once("../calendario/calendario.php");
include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");
$paso=busca_filtro_tabla("A.idpaso_documento, A.estado_paso_documento,B.diagram_iddiagram,B.plazo_paso, ".fecha_db_obtener("fecha_asignacion","Y-m-d H:i:s")." AS fecha_asignacion,B.nombre_paso, A.fecha_limite, B.idpaso, A.documento_iddocumento","paso_documento A,paso B","A.paso_idpaso=B.idpaso AND A.idpaso_documento=".$idpaso_documento."","fecha_asignacion DESC",$conn);
$plazo=explode("@",$paso[0]["plazo_paso"]);

$fecha_final=$paso[0]["fecha_limite"];
$diferencia=fecha_atrasada('',$fecha_final);
if($paso[0]["estado_paso_documento"]>3){
  //Verifica si el estado del paso del documento es Pendiente(4) o Iniciado(6) y esta atrasado actualiza el estado del paso
  if($diferencia && in_array($paso[0]["estado_paso_documento"],array(4,6))){
    $sql_paso="UPDATE paso_documento SET estado_paso_documento=5 WHERE idpaso_documento=".$idpaso_documento;
    phpmkr_query($sql_paso);
    $paso[0]["estado_paso_documento"]=5;
  }
  if(!$diferencia && $paso[0]["estado_paso_documento"]==5){
    $sql_paso="UPDATE paso_documento SET estado_paso_documento=4 WHERE idpaso_documento=".$idpaso_documento;
    phpmkr_query($sql_paso);
    $paso[0]["estado_paso_documento"]=4;
  }
} 
$terminados=busca_filtro_tabla("count(*) AS terminados","paso_instancia_terminada A, paso_actividad B","A.actividad_idpaso_actividad=B.idpaso_actividad AND B.paso_idpaso=".$paso[0]["idpaso"]." AND A.documento_iddocumento=".$paso[0]["documento_iddocumento"]." AND A.estado_actividad<3 AND B.estado=1","",$conn);
$actividades=busca_filtro_tabla("count(*) AS cant, restrictivo","paso_actividad","paso_idpaso=".$paso[0]["idpaso"]." AND estado=1","GROUP BY restrictivo ORDER BY restrictivo",$conn);
$actividades=busca_filtro_tabla("count(*) AS cant, restrictivo","paso_actividad","paso_idpaso=".$paso[0]["idpaso"]." AND estado=1","GROUP BY restrictivo ORDER BY restrictivo",$conn);
$estado="";
$devuelto=0;
$paso["restrictivas"]=0;
$paso["opcionales"]=0;
for($i=0;$i<$actividades["numcampos"];$i++){
  if($actividades[$i]["restrictivo"]==1)
    $paso["restrictivas"]+=$actividades[$i]["cant"];
  if($actividades[$i]["restrictivo"]==0)
    $paso["opcionales"]+=$actividades[$i]["cant"];  
  
}
if($paso[0]["estado_actividad"]==7){
  $devuelto++;
}
$peso=explode("@",$paso[0]["plazo_paso"]);
$total_restrictivos+=$peso[0];
$total_paso+=$peso[1];
$paso["terminados"]=$terminados[0]["terminados"];
$paso["devueltos"]=$devuelto;  
$paso["fecha_final"]=$fecha_final;
$paso["plazo_restrictivos"]=$total_restrictivos;
$paso["plazo_total"]=$total_paso;
return($paso);
}
/*
 * $idpaso_documento=idpaso_documento
 * 
 * Muestra informacion detallada del estado del flujo.
 */
function estado_flujo_instancia($idpaso_documento){
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
include_once($ruta_db_superior."calendario/calendario.php");
$paso_documento=busca_filtro_tabla("","paso_documento","idpaso_documento=".$idpaso_documento." AND estado_paso_documento<>0","idpaso_documento DESC",$conn);
 /*1,Ejecutado(#99FF66);2,Cerrado(#99FF66),3,Cancelado;4,Pendiente(#FFFF66);5,Atrasado(#FF3333);6,Iniciado( #FFFF66)*/ 
$flujo=busca_filtro_tabla("A.idpaso_documento, A.estado_paso_documento,B.diagram_iddiagram,B.plazo_paso, ".fecha_db_obtener("fecha_asignacion","Y-m-d H:i:s")." AS fecha_asignacion, C.estado_diagram_instance, C.fecha AS fecha_diagram,B.nombre_paso,C.iddiagram_instance,paso_idpaso,A.documento_iddocumento","paso_documento A,paso B, diagram_instance C","A.paso_idpaso=B.idpaso AND A.diagram_iddiagram_instance=C.iddiagram_instance AND A.diagram_iddiagram_instance=".$paso_documento[0]["diagram_iddiagram_instance"]." AND estado_paso_documento<>7 AND estado_paso_documento<>3 AND estado_paso_documento<>0","idpaso_documento DESC",$conn);
$plazo=explode("@",$flujo[0]["plazo_paso"]);
$fecha_final=dias_habiles_listado(($plazo[0]/24),"Y-m-d",$flujo[0]["fecha_asignacion"]);
$fecha_fina2=dias_habiles_listado((($plazo[0]/24)),"Y-m-d",$flujo[0]["fecha_asignacion"]);
$hoy=date("Y-m-d H:i:s");
$diferencia=compara_fechas($fecha_final,$hoy);
if($flujo[0]["estado_paso_documento"]>3){
  //Verifica si el estado del paso del documento es Pendiente(4) o Iniciado(6) y esta atrasado actualiza el estado del paso
  if(@$diferencia["tiempo"] && in_array($flujo[0]["estado_paso_documento"],array(4,6))){
    $sql_paso="UPDATE paso_documento SET estado_paso_documento=5 WHERE idpaso_documento=".$idpaso_documento;
    phpmkr_query($sql_paso);
    $flujo[0]["estado_paso_documento"]=5;
  }
}     
$estado="";
$estadod="";
$pasos_flujo=busca_filtro_tabla("","paso","diagram_iddiagram=".$flujo[0]["diagram_iddiagram"],"",$conn);
$pasos_devueltos=busca_filtro_tabla("idpaso_documento","paso_documento","diagram_iddiagram_instance=".$paso_documento[0]["diagram_iddiagram_instance"]." AND estado_paso_documento=7","",$conn);
$total_restrictivos=0;
$total_paso=0;
for($i=0;$i<$pasos_flujo["numcampos"];$i++){
  $peso=explode("@",$pasos_flujo[$i]["plazo_paso"]);
  $total_restrictivos+=$peso[0];
  $total_paso+=$peso[1];
}
$fecha_final_diagram=dias_habiles_listado((($total_restrictivos)/24),"Y-m-d",@$flujo[0]["fecha_diagram_instance"]);
$diferenciad=compara_fechas($fecha_final_diagram,$hoy);
if($flujo[0]["estado_diagram_instance"]>3){
  if(@$diferenciad["tiempo"]&& in_array($flujo[0]["estado_paso_documento"],array(4,6))){
    $sql_diagram="UPDATE diagram_instance SET estado_diagram_instance=5 WHERE iddiagram_instance=".$flujo[0]["diagram_iddiagram"];
    phpmkr_query($sql_diagram);
    $flujo[0]["estado_diagram_instance"]=5;
  }
}
if($flujo["numcampos"] && !in_array($flujo[0]["estado_paso_documento"],array(1,2))){
  $flujo["numcampos"]--;
}      
if($pasos_flujo["numcampos"]){
  $porcentaje=round((($flujo["numcampos"])*100)/$pasos_flujo["numcampos"],2);
}
else 
  $porcentaje=0;
$flujo["devueltos"]=$pasos_devueltos["numcampos"];  
$flujo["porcentaje"]=$porcentaje;
$flujo["pasos_flujo"]=$pasos_flujo["numcampos"];
$flujo["fecha_final_diagrama"]=$fecha_final_diagram;
$flujo["fecha_final_paso"]=$fecha_final;
$flujo["diferencia"]=$diferencia;
$flujo["diferenciad"]=$diferenciad;
$flujo["fecha_final_paso"]=$fecha_fina2;
return($flujo);
}
/*
 * $idpaso=idpaso
 * 
 * Encargado de realizar el calculo para llenar el campo plazo_paso, el que me define el plazo de un paso.
 */
function calcular_plazo_paso($idpaso){
global $conn;
  $fecha=date("Y-m-d H:i:s");
  $fecha_restrictivo="";
  $fecha_total="";
  $actividades_paso=busca_filtro_tabla("","paso_actividad","estado=1 AND paso_idpaso=".$idpaso,"restrictivo DESC",$conn);
  $fecha_temp=$fecha;
  for($i=0;$i<$actividades_paso["numcampos"];$i++){
    if($actividades_paso[$i]["restrictivo"]){
      $fecha_act=ejecuta_filtro_tabla("SELECT ".fecha_db_obtener(suma_fechas("'".$fecha_temp."'",$actividades_paso[$i]["plazo"],$actividades_paso[$i]["tipo_plazo"]),"Y-m-d H:i:s")." AS fecha",$conn);
      if($fecha_act["numcampos"]){
        $fecha_temp=$fecha_act[0]["fecha"];
      }
    $fecha_restrictivo=$fecha_temp;
    $fecha_total=$fecha_restrictivo;  
    }
    else{
      $fecha_act=ejecuta_filtro_tabla("SELECT ".fecha_db_obtener(suma_fechas("'".$fecha_temp."'",$actividades_paso[$i]["plazo"],$actividades_paso[$i]["tipo_plazo"]),"Y-m-d H:i:s")." AS fecha",$conn);
      if($fecha_act["numcampos"]){
        $fecha_temp=$fecha_act[0]["fecha"];
      }
    $fecha_total=$fecha_temp; 
    }
  }
if($fecha_restrictivo!="" && $fecha_total!=""){
  $dato_fecha=ejecuta_filtro_tabla("SELECT ".resta_horas("'".$fecha_restrictivo."'","'".$fecha."'")." AS fecha",$conn);
  if($fecha_restrictivo !=$fecha_total){
    $dato_fecha_total=ejecuta_filtro_tabla("SELECT ".resta_horas("'".$fecha_total."'","'".$fecha."'")." AS fecha",$conn);
  }
  else{
    $dato_fecha_total=$dato_fecha;
  }
  $fecha1=array();
  $dato1=explode(":",$dato_fecha[0]["fecha"]);
  $dato2=explode(":",$dato_fecha_total[0]["fecha"]);
  $sql_plazo="UPDATE paso SET plazo_paso='".$dato1[0]."@".$dato2[0]."' WHERE idpaso=".$idpaso;
  phpmkr_query($sql_plazo);
}  
}
/*
 * $idflujo=iddiagram
 * 
 * Funcion intermedia que se encarga de consultar los pasos de un diagrama, y llama a la funcion que calcula el plazo de cada paso.
 */
function calcular_plazo_flujo($idflujo){
$flujo=busca_filtro_tabla("","paso","diagram_iddiagram=".$idflujo,"",$conn);
  for($i=0;$i<$flujo["numcampos"];$i++){
    calcular_plazo_paso($flujo[$i]["idpaso"]);
  }
}
/*
 * Calcula el plazo de todos los pasos que existen de todos los diagramas.
 */
function calcular_plazo_flujos(){
$flujos=busca_filtro_tabla("","diagram","public=1","",$conn);
for($i=0;$i<$flujos["numcampos"];$i++){
  calcular_plazo_flujo($flujos[$i]["id"]);
}
}
/*
 * @name devolver_paso_documento: Devuelve los pasos de los pasos desde el paso_origen hasta el paso_final con las observaciones para la instancia del diagrama
 * @param paso_origen: paso donde inicia la devolucion es decir el ultimo paso del flujo
 * @param paso_final: Paso donde finaliza la devolucion es decir el paso hasta donde se debe devolver
 * @param observaciones: Observaciones que se deben adjuntar en la devolucion de cada caso 
 * @param diagram_instance: Instancia del flujo que se debe devolver
*/
function devolver_paso_documento($paso_origen,$paso_final,$observaciones,$diagram_instance){
  $pasos_flujo=busca_filtro_tabla("","paso_documento A, paso_enlace C","A.paso_idpaso=C.origen AND A.diagram_iddiagram_instance=".$diagram_instance,"origen",$conn);
  $arreglo_pasos=array();
  $cargar_pasos=0;
  for($i=0;$i<$pasos_flujo["numcampos"];$i++){
    if($pasos_flujo[$i]["idpaso_documento"]==$paso_final){
      $cargar_pasos=1;
    }
    if($cargar_pasos==1){
      devolver_actividades_paso($pasos_flujo[$i]["idpaso_documento"],$pasos_flujo[$i]["paso_idpaso"],$pasos_flujo[$i]["documento_iddocumento"], $observaciones);
    }
    if($pasos_flujo[$i]["idpaso_documento"]==$paso_origen){
      $cargar_pasos=0;
      break;
    }
  }
}
/*
 * Funcion utilizadas para realizar la revolucion de una actividad. Estas no funcionan de manera correcta
 */
function devolver_actividades_paso($idpaso_documento,$idpaso,$documento,$observaciones){
  $actividades=busca_filtro_tabla("","paso_instancia_terminada A, paso_actividad B","B.estado=1 AND A.actividad_idpaso_actividad=B.idpaso_actividad AND A.documento_documento=".$documento." AND B.paso_idpaso=".$idpaso ,"",$conn);
  for ($i=0; $i < $actividades["numcampos"] ; $i++) {
    devolver_actividad_paso($actividades[$i]["idpaso_instancia_terminada"], $actividades[$i]["estado_actividad"], $observaciones,0);
  }
  $sql1="UPDATE paso_documento SET estado_paso_documento=7 WHERE idpaso_estado_documento=".$idpaso_documento;
  phpmkr_query($sql1);
  return(true);
}
/*
 * Funcion utilizadas para realizar la revolucion de una actividad. Estas no funcionan de manera correcta
 */
function devolver_actividad_paso($idinstancia_terminada,$estado_original,$observaciones,$idpaso_documento,$paso){
  global $conn;  
  $sql0="UPDATE paso_instancia_terminada SET estado_actividad =7 WHERE idpaso_instancia=".$idinstancia_terminada;
  phpmkr_query($sql0,$conn); 
  $sql1="INSERT INTO paso_instancia_rastro(instancia_idpaso_instancia, funcionario_codigo, estado_original,estado_final,fecha_cambio, observaciones) VALUES(".$idinstancia_terminada.",".$_SESSION["usuario_actual"].",".$estado_original.",7,'".date("Y-m-d H:i:s")."','".$observaciones."')";
  phpmkr_query($sql1,$conn);    
  if($paso){
     $paso_documento=busca_filtro_tabla("","estado_paso_documento","idpaso_documento=".$idpaso_documento,"",$conn);
    $sql2="UPDATE paso_documento SET estado_paso_documento=7 WHERE idpaso_documento=".$idpaso_documento;
    phpmkr_query($sql2,$conn);
    $sql1="INSERT INTO paso_rastro(documento_idpaso_documento, funcionario_codigo, estado_original,estado_final,fecha_cambio, observaciones) VALUES(".$idpaso_documento.",".$_SESSION["usuario_actual"].",".$paso_documento[0]["estado_paso_documento"].",7,'".date("Y-m-d H:i:s")."','".$observaciones."')";
    phpmkr_query($sql1,$conn);
  }
}
/*
 * $idpaso_instancia=idpaso_instancia
 * $observaciones=Observaciones que se tienen al rehacer una actividad.
 * $idpaso_documento=Idpaso_documento
 * 
 * Funcion llamada desde /workflow/rehacer_actividad_paso.php para rehacer una actividad devuelta.
 */
function rehacer_actividad_paso($idpaso_instancia,$observaciones,$idpaso_documento){
   global $conn;
   //$paso_documento=busca_filtro_tabla("","paso_documento","idpaso_documento=".$idpaso_documento,"",$conn);
   $instancia_paso=busca_filtro_tabla("","paso_instancia_rastro","instancia_idpaso_instancia=".$idpaso_instancia,"idpaso_instancia_rastro DESC",$conn); 
   $estado_paso=$instancia_paso[0]["estado_original"];
   $sql0="UPDATE paso_instancia_terminada SET estado_actividad =".$estado_paso." WHERE idpaso_instancia=".$idpaso_instancia;
  phpmkr_query($sql0,$conn);
   $sql1="INSERT INTO paso_instancia_rastro(instancia_idpaso_instancia, funcionario_codigo, estado_original,estado_final,fecha_cambio, observaciones) VALUES(".$idpaso_instancia.",".$_SESSION["usuario_actual"].",7,".$estado_paso.",'".date("Y-m-d H:i:s")."','".$observaciones."')";
  phpmkr_query($sql1,$conn);
  validar_estado_paso($idpaso_instancia,$idpaso_documento);  
}
/*
 * 
 */
function validar_estado_paso($idpaso_instancia,$idpaso_documento){   
$paso_documento=busca_filtro_tabla("","paso_documento A,paso_actividad B,paso_instancia_terminada C","B.estado=1 AND A.paso_idpaso=B.paso_idpaso AND A.documento_iddocumento=C.documento_iddocumento AND idpaso_documento=".$idpaso_documento."","",$conn);
///se adiciona validacion para que no haga nada si el paso esta excluido
if($paso_documento["numcampos"] && $paso_documento[0]["estado_paso_documento"]){
  return;
}
$actividades_paso=busca_filtro_tabla("","paso_actividad B,paso A","B.estado=1 AND A.idpaso=B.paso_idpaso AND B.paso_idpaso=".$paso_documento[0]["paso_idpaso"],"",$conn);

$devuelto=0;
$restrictivo=0;
$no_restrictivo=0;
for($i=0;$i<$paso_documento["numcampos"];$i++){
  if($paso_documento[$i]["estado_actividad"]==7)
    $devuelto++;
  if($paso_documento[$i]["restrictivo"]==1)
    $restrictivo++;
  if($paso_documento[$i]["restrictivo"]==0)
    $no_restrictivo++;    
}
for($i=0;$i<$actividades_paso["numcampos"];$i++){
  if($actividades_paso[$i]["restrictivo"]==1)
    $restrictivo--;
  if($actividades_paso[$i]["restrictivo"]==0)
    $no_restrictivo--;    
}

if($devuelto){
  $estado=7;  
}
if($restrictivo==0){
  if($no_restrictivo<=0){
    $estado=1;
  }
  else{
    $estado=2;
  }
}
else{ 
  $plazo=explode("@",$actividades_paso[0]["plazo_paso"]);
  include_once("../calendario/calendario.php");
  $fecha_final=dias_habiles_listado(($plazo[0]/24),"Y-m-d",$paso_documento[0]["fecha_asignacion"]);
  $hoy=date("Y-m-d H:i:s");
  $diferencia=compara_fechas($fecha_final,$hoy);
  if($diferencia["tiempo"] && in_array($actividades_paso[0]["estado_paso_documento"],array(4,6,7))){
    $estado=5;
  }
  else{
    $estado=4;
  }
} 
if($estado!=7){
  $sql1="INSERT INTO paso_rastro(documento_idpaso_documento, funcionario_codigo, estado_original,estado_final,fecha_cambio, observaciones) VALUES(".$idpaso_documento.",".$_SESSION["usuario_actual"].",".$paso_documento[0]["estado_paso_documento"].",".$estado.",'".date("Y-m-d H:i:s")."','".$observaciones."')";
  phpmkr_query($sql1,$conn);
}
$sql2="UPDATE paso_documento SET estado_paso_documento=1 WHERE idpaso_documento=".$idpaso_documento;
phpmkr_query($sql2,$conn);    
}
/*TODO: PASAR A class_transferencia*/
/*
 * $documento=iddocumento
 * $funcionario_codigo= un funcionario_codigo o varios separados por coma(,)
 * $funcionarios_excluidos=un funcionario_codigo o varios separados por coma(,)
 * 
 * Retorna el listado de usuarios que tienen relacion con el documento.
 */
function documento_transferido($documento,$funcionario_codigo, $funcionarios_excluidos){
  global $conn;
  $condicion="A.destino=B.funcionario_codigo AND A.archivo_idarchivo=".$documento." AND A.destino IN(".$funcionario_codigo.")";
  if($funcionarios_excluidos) 
    $condicion.=" AND A.destino NOT IN(".$funcionarios_excluidos.")";
  $asignados2=busca_filtro_tabla("B.nombres, B.apellidos, B.funcionario_codigo","buzon_salida A, funcionario B",$condicion,"GROUP BY B.nombres, B.apellidos, B.funcionario_codigo",$conn);
  return($asignados2);
}
/*
 * $documento=iddocumento
 * $funcionario_codigo=funcionario_codigo
 * 
 * Retorna arreglo en caso de que exista, del registro en pendientes del documento del usuario enviado.
 */
function documento_asignado($documento,$funcionario_codigo){
  global $conn;
  $asignados2=busca_filtro_tabla("","asignacion A, funcionario B","A.llave_entidad=B.funcionario_codigo AND A.documento_iddocumento=".$documento." AND A.llave_entidad =".$funcionario_codigo,"B.funcionario_codigo",$conn);
  return($asignados2);
}
/*
 * $idpaso_documento=idpaso_documento
 * 
 * Se encarga de cancelar todo un flujo, dejandolo inactivo. Como consecuencia, el documento no sigue fluyendo en el flujo.
 */
function cancelar_flujo($idpaso_documento){
  global $conn;
  $datos = busca_filtro_tabla("","paso_documento a, diagram_instance b","a.diagram_iddiagram_instance=b.iddiagram_instance and a.idpaso_documento=".$idpaso_documento,"");
  $fecha_cambio = fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s");
  //--------------------------Cancelando flujo-----------------------------------------------
  $sql = "UPDATE diagram_instance SET estado_diagram_instance='3' WHERE iddiagram_instance=".$datos[0]["iddiagram_instance"];
  phpmkr_query($sql,$conn);

  //------------------------Cancelando los pasos en la tabla paso documento---------------------------
  $sql = "UPDATE paso_documento SET estado_paso_documento='3' WHERE diagram_iddiagram_instance=".$datos[0]["iddiagram_instance"];
  
  phpmkr_query($sql,$conn);
  //------------------------Cancelando actividades del flujo-------------------------------------
  for($i=0;$i<$datos["numcampos"];$i++){
    $sql = "INSERT INTO paso_rastro (documento_idpaso_documento,funcionario_codigo,estado_original,estado_final,fecha_cambio) values('".$datos[$i]["idpaso_documento"]."','".usuario_actual("funcionario_codigo")."','".$datos[$i]["estado_paso_documento"]."','3',".$fecha_cambio.")";
    phpmkr_query($sql,$conn);
    
    $actividad = busca_filtro_tabla("","paso_actividad","estado=1 AND paso_idpaso=".$datos[$i]["paso_idpaso"],"",$conn);
    for($j=0;$j<$actividad["numcampos"];$j++){
      $verificando = busca_filtro_tabla("","paso_instancia_terminada","actividad_idpaso_actividad=".$actividad[$j]["idpaso_actividad"]." and documento_iddocumento=".$datos[$i]["documento_iddocumento"],"",$conn);
      if($verificando["numcampos"] > 0){
        $sql = "UPDATE paso_instancia_terminada SET estado_actividad='3' WHERE idpaso_instancia=".$verificando[$j]["idpaso_instancia"];
        phpmkr_query($sql,$conn);
      }
    }
  }
}

function cancelar_paso($idpaso_documento,$idpaso){
 
  
} 
/*
 * $iddoc=iddocumento
 * 
 * Funcion llamda desde app/documento/class_transferencia.php, primero se valida que si el documento pertenece a un flujo, entonces se llama a esta funcion. Muestra formulario para realizar devolucion de actividades. (Todo lo que tiene que ver con devolucion aun no funciona como deberia funcionar.)
 */
function formulario_devolver($iddoc){
  global $conn,$ruta_db_superior;
  $pasos_relacionados = busca_filtro_tabla("b.descripcion as nom_activi,a.*,c.*,b.*","paso_instancia_terminada a,paso_actividad b, paso c","documento_iddocumento=".$iddoc." AND estado_actividad=1 AND b.estado=1 AND actividad_idpaso_actividad=idpaso_actividad AND paso_idpaso=idpaso","idpaso_instancia asc",$conn);
  $pasos = busca_filtro_tabla("distinct(idpaso)","paso_instancia_terminada a,paso_actividad b, paso c","documento_iddocumento=".$iddoc." AND estado_actividad=1 AND actividad_idpaso_actividad=idpaso_actividad AND paso_idpaso=idpaso AND b.estado=1","idpaso_instancia asc",$conn);
  $retorno .= '
  <script src="'.$ruta_db_superior.'/js/jquery.js"></script>
  <script>
  function llenar_indice(i){
    var a = $("#indice"+i).attr("checked");
    var seleccionados = $("#seleccionados").val();
    if(a == true){
      if(seleccionados != ""){
        $("#seleccionados").val($("#seleccionados").val()+i+",");
      }
      else{
        $("#seleccionados").val(i+",");
      }
    }
    else if(a == undefined){
      var explod = seleccionados.split(",");
      var string = "";
      for(var j=0;j<explod.length;j++){
        if(explod[j] != i && explod[j]){
          string += explod[j]+",";
        }
      }
      $("#seleccionados").val(string);
    }
    
  }
  </script>';
  $retorno .= '
  <table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
    <!--tr>
      <td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;"></span></td>
    </tr-->';
  $actividades = 0;
  for($i=0;$i<$pasos["numcampos"];$i++){
    $nombre_paso = busca_filtro_tabla("","paso","idpaso=".$pasos[$i]["idpaso"],"",$conn);
    $retorno .= '<tr>
      <td class="encabezado" colspan="2" style="text-align:center"><span class="phpmaker" style="color: #FFFFFF;">'.$pasos_relacionados[$i]["nombre_paso"].'</span></td>
    </tr>
    ';
    for($j=0;$j<$pasos_relacionados["numcampos"];$j++){
      if($pasos_relacionados[$j]["paso_idpaso"] == $pasos[$i]["idpaso"]){
        $paso_documento = busca_filtro_tabla("idpaso_documento","paso_documento","documento_iddocumento=".$pasos_relacionados[$j]["documento_iddocumento"]." AND paso_idpaso=".$pasos_relacionados[$j]["paso_idpaso"],"",$conn);
        $retorno .= '<tr>
        <td bgcolor="#F5F5F5"><span class="phpmaker">
        '.$pasos_relacionados[$j]["nom_activi"].'
        </span>
        </td>
        <td bgcolor="#F5F5F5">
        <input type="checkbox" id="indice'.$actividades.'" onclick="llenar_indice('.$actividades.');" name="actividad[]" value="'.$pasos_relacionados[$j]["idpaso_actividad"].'"></td>
        </tr>
        <input type="hidden" name="idpaso_instancia[]" value="'.$pasos_relacionados[$j]["idpaso_instancia"].'">
        <input type="hidden" name="estado_original[]" value="'.$pasos_relacionados[$j]["estado_actividad"].'">
        <input type="hidden" name="idpaso_documento[]" value="'.$paso_documento[0]["idpaso_documento"].'">
        <input type="hidden" name="paso" value="devolver">
        ';
        $actividades++;
      }
    }
  }
  $retorno .= '
  <input type="hidden" name="cantidad_actividades" value="'.$actividades.'">
  <input type="hidden" name="seleccionados" id="seleccionados" value="">
    <tr>
    </tr>
  </table>
  <br>
  ';
  return $retorno;
}
/**
 *@responsable_paso es quien o quienes ejecutaron la acción en el paso  
 **/
function responsable_paso($idpaso_documento){
  global $conn;
  $funcionario_responsable = busca_filtro_tabla("CONCAT(A.nombres,CONCAT(' ',A.apellidos)) AS nombre","funcionario A, paso_instancia_terminada B, paso_documento C","A.idfuncionario=B.responsable AND B.documento_iddocumento=C.documento_iddocumento AND C.idpaso_documento=".$idpaso_documento,"",$conn);
  return($funcionario_responsable[0]['nombre']);
}
/**
 *@asignados_paso es quien o quienes se han configurado para ejecutaron en la administarción del paso  
 **/

function asignados_paso($idpaso){
  global $conn; 
  return("Funcion pendiente asignados y reasignar");
}

function reasignar_orden_actividades_paso($idpaso){
  global $conn;
  $actividades=busca_filtro_tabla("","paso_actividad","paso_idpaso=".$idpaso." AND estado=1","orden",$conn);
  for($i=0;$i<$actividades["numcampos"];$i++){
    $sql2="UPDATE paso_actividad SET orden=".($i+1)." WHERE idpaso_actividad=".$actividades["$i"]["idpaso_actividad"];
    phpmkr_query($sql2);
  }
}
function imprimir_estado_paso_documento($estado){
  //1,Ejecutado;2,Cerrado,3,Cancelado;4,Pendiente;5,Atrasado;6,Iniciado
  $texto='';
  switch ($estado) {
    case '1':
      $texto='<span class="label label-success">Terminado</label>';
    break;
    case '2':
      $texto='<span class="label label-success">Terminado</label>';
    break;
    case '3':
      $texto='<span class="label label-important">Cancelado</label>';
    break;
    case '4':
      $texto='<span class="label label-warning">Pendiente</label>';
    break;
    case '5':
      $texto='<span class="label label-important">Vencido</label>';
    break;
    case '6':
      $texto='<span class="label label-warning">Pendiente</label>';
    break;
  }
  return($texto);
}

function paso_anterior($idpaso,$iddiagram,$iddoc=0){
	global $conn;
	$paso_enlace=busca_filtro_tabla("a.origen,a.tipo_origen","paso_enlace a","a.diagram_iddiagram='".$iddiagram."' AND a.destino='".$idpaso."'","idpaso_enlace",$conn);
	if($paso_enlace['numcampos']){
		if($paso_enlace[0]['tipo_origen']!='bpmn_condicional'){
			if($paso_enlace[0]['origen']!='-1'){
				return $paso_enlace[0]['origen'];
			}else{
				return(0); 
			}		
		}else{
			if($iddoc!=0){
				$paso_referencia=busca_filtro_tabla("","paso_documento","documento_iddocumento=".$iddoc." AND paso_idpaso=".$idpaso,"paso_idpaso ASC",$conn);	
				$paso_condicionado=busca_filtro_tabla("","paso_documento","documento_iddocumento=".$iddoc." AND idpaso_documento<".$paso_referencia[0]['idpaso_documento'],"idpaso_documento ASC",$conn);	
				if($paso_condicionado['numcampos']){
					return $paso_condicionado[ $paso_condicionado['numcampos']-1 ]['paso_idpaso'];
				}				
			}		
			return $idpaso_anterior=paso_anterior($paso_enlace[0]['origen'],$iddiagram,$iddoc);
		}		
	}else{
		return(0); 
	}	
}




function generar_condicion_funcionario_tomado_campo($fk_campos_formato,$formato_anterior){
	global $conn;
	
	
	$vector_idformato_idpaso_actividad=explode('|',$formato_anterior);
    $vector_idformato_idpaso_actividad=array_map('intval',$vector_idformato_idpaso_actividad);
	$condicion=0;
    $datos_formato_ruta=busca_filtro_tabla("b.nombre,b.banderas,a.nombre_tabla","formato a,campos_formato b","b.idcampos_formato=".$fk_campos_formato."  AND a.idformato=b.formato_idformato AND a.idformato=".$vector_idformato_idpaso_actividad[0],"",$conn);  
     
    if($datos_formato_ruta['numcampos']){
        $paso_actividad_documento=busca_filtro_tabla("b.documento_iddocumento","paso_actividad a,paso_documento b","a.estado=1 AND b.estado_paso_documento IN(1,2) AND a.paso_idpaso=b.paso_idpaso AND a.formato_idformato=".$vector_idformato_idpaso_actividad[0]." AND a.idpaso_actividad=".$vector_idformato_idpaso_actividad[1],"idpaso_documento DESC",$conn);
        
        
		$consulta_valor_campo=busca_filtro_tabla($datos_formato_ruta[0]['nombre'],$datos_formato_ruta[0]['nombre_tabla'],"documento_iddocumento=".$paso_actividad_documento[0]['documento_iddocumento'],"",$conn);
                         
        $valor_campo_ruta=$consulta_valor_campo[0][$datos_formato_ruta[0]['nombre']];
                      
        if($valor_campo_ruta){
			$vector_banderas=explode(',',$datos_formato_ruta[0]['banderas']);
            $vector_banderas_validar=array('ffc','fdc','fid','fc');//funcionario_codigo,iddependencia_cargo,idfuncionario,idcargo
            $bandera_validar='';
            for($i=0;$i<count($vector_banderas_validar);$i++){
				if(in_array($vector_banderas_validar[$i],$vector_banderas)){
                    $bandera_validar=$vector_banderas_validar[$i];
                    $i=count($vector_banderas_validar); //corto el ciclo
                }
            }
                            
            if($bandera_validar!=''){
				switch($bandera_validar){
                                    case 'ffc': //funcionario_codigo
                                        $condicion="funcionario_codigo='".$valor_campo_ruta."'";
                                        break;
                                    case 'fdc': //iddependencia_cargo
                                        $condicion="iddependencia_cargo='".$valor_campo_ruta."'";
                                        break;
                                    case 'fid': //idfuncionario
                                        $condicion="idfuncionario='".$valor_campo_ruta."'";
                                        break;
                                    case 'cargo': //idcargo
                                        $condicion="idcargo='".$valor_campo_ruta."'";
                                        break;                                        
                }
                
                               
            }
                            
        }
                        
                        
    } //fin $datos_formato_ruta['numcampos']	    
	
	return($condicion);
}


?>