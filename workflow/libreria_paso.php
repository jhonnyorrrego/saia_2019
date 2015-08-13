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
//include_once($ruta_db_superior."class_transferencia.php");
/*
<Clase>
<Nombre>agrega_boton_paso</Nombre> 
<Parametros>$nombre:tipo de enlace por boton o texto; $imagen:ruta de la imagen para el enlace; $dir:ruta del archivo (href) o accion(javascript); $destino:tipo de frame; $texto:etiqueta que se muestra; $acceso:valor 1 (No se utiliza este parametro);$modulo:nombre del modulo;$click:opcional, sentencias de javascript</Parametros>
<Responsabilidades>Permite el acceso en el sistema de un modulo dependiendo si tiene los permisos<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida>Muestra el enlace o boton para acceder el m�dulo</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function agrega_boton_paso($imagen="../../botones/configuracion/default.gif",$dir="#",$destino="_self",$texto="",$modulo="",$retorno=0){
global $usuactual,$conn; 
$ok=FALSE; 
$retornar="";
if($modulo!=""){
  $perm=new PERMISO();
  $ok=$perm->acceso_modulo_perfil($modulo);
}
if($ok){  
  $retornar='&nbsp;<a href="'.$dir.'" target="'.$destino.'"><img width=16 height=16 src="'.$imagen.'" title="'.@$texto.'" class="tooltip_saia" alt="'.$texto.'" border="0"  hspace="0" vspace="0" ></a>&nbsp;';
}
if($retornar){
    if($retorno)
        return($retornar);
    else 
        echo($retornar);    
}
return(FALSE);
}
/*
<Clase>
<Nombre>menu_paso</Nombre> 
<Parametros>$idpaso:Id del paso del cual se quiere generar el menu</Parametros>
<Responsabilidades>Genera el menu con cada una de las actividades del paso seleccionado y las restricciones de acceso sobre el usuario actual<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida>Men�</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
<TODO>Validar los permisos del paso para el usuario actual</TODO>
</Clase>
*/
function menu_pasos($idpaso,$idpaso_documento=0){
global $ruta_db_superior,$conn;
if($idpaso_documento){
  $paso=busca_filtro_tabla("","paso_documento A,paso B","A.paso_idpaso=B.idpaso AND A.idpaso_documento=".$idpaso_documento,"",$conn);
}
else{
  $paso=busca_filtro_tabla("","paso B"," B.idpaso=".$idpaso,"",$conn);
}
$texto='
<style>           
  ul {
  	padding: 0; 
    margin: 0 0 0 30 ;
  	width: 80%;
  	list-style: none;
  	border-top: 1px solid #fff; /*--Gives the bevel feel on the panel--*/
  	font-size: 1.1em;
  }
  ul li{
  	padding: 0; margin: 0;
  	float: left;
  	position: relative;
  }
  ul li a{
  	padding: 5px;
  	float: left;
  	text-indent: -9999px;
  	height: 16px; width: 16px;
  	text-decoration: none;
  	color: #333;
  	position: relative;
  }
  html ul li a:hover{	background-color: #fff; }
  html ul li a.active { /*--Active state when subpanel is open--*/
  	background-color: #fff;
  	height: 17px;
  	margin-top: -2px; /*--Push it up 2px to attach the active button to subpanel--*/
  	border: 1px solid #555;
  	border-top: none;
  	z-index: 200; /*--Keeps the active area on top of the subpanel--*/
  	position: relative;
  }
  a.inicio{	
  	background: url('.$ruta_db_superior.'images/panel_inferior_pasos/house_go.png) no-repeat center center;
  }
  a.home{	
  	background: url('.$ruta_db_superior.'images/panel_inferior_pasos/home.png) no-repeat center center;
  }
  a.profile{	background: url('.$ruta_db_superior.'images/panel_inferior_pasos/user.png) no-repeat center center;  }
   a.previo_paso{	background: url('.$ruta_db_superior.'images/panel_inferior_pasos/preview.jpg) no-repeat center center;  }
    a.siguiente_paso{	background: url('.$ruta_db_superior.'images/panel_inferior_pasos/next.jpg) no-repeat center center;  }
  a.contacts{	background: url('.$ruta_db_superior.'images/panel_inferior_pasos/address_book.png) no-repeat center center; }
  a.playlist{	background: url('.$ruta_db_superior.'images/panel_inferior_pasos/document_music_playlist.png) no-repeat center center; }
  a.cerrar_paso{	background: url('.$ruta_db_superior.'images/panel_inferior_pasos/close.png) no-repeat center center; }
  a.messages{	background: url('.$ruta_db_superior.'images/panel_inferior_pasos/mail.png) no-repeat center center; }
  a.terminar_flujo{	background: url('.$ruta_db_superior.'images/panel_inferior_pasos/cross.png) no-repeat center center; }
  a.editprofile{	background: url('.$ruta_db_superior.'images/panel_inferior_pasos/wrench_screwdriver.png) no-repeat center center; }
  a.devolver_paso{  background: url('.$ruta_db_superior.'images/panel_inferior_pasos/devolver_flujo.png) no-repeat center center; }
  a.reemplazar_responsable{  background: url('.$ruta_db_superior.'images/panel_inferior_pasos/reemplazo.png) no-repeat center center; }  
  a small {  /*--panel tool tip styles--*/
  	text-align: center;
  	width: 70px;
  	background: url('.$ruta_db_superior.'images/panel_inferior_pasos/pop_arrow.gif) no-repeat center bottom;
  	padding: 15px 5px 11px;
  	display: none; /*--Hide by default--*/
  	color: #fff;
  	font-size: 9px;
  	text-indent: 0;
  }
  a:hover small{
  	display: block; /*--Show on hover--*/
  	position: absolute;
  	top: 15px; /*--Position tooltip 35px above the list item--*/
  	left: 50%; 
  	margin-left: -40px; /*--Center the tooltip--*/
  	z-index: 9999;
  }
  ul li div a { /*--Reset link style for subpanel links--*/
  	text-indent: 0;
  	width: auto;
  	height: auto;
  	padding: 0;
  	float: none;
  	color: #00629a;
  	position: static;
  }
  ul li div a:hover {	text-decoration: underline; } /*--Reset link style for subpanel links--*/
  .highslide-html-content{
    height:300px
    overflow:auto;    
  } 
</style>';
echo($texto);
echo("Paso: ".$paso[0]["nombre_paso"]);
?>     
<ul id="mainpanel">
	<li><a href="<?php echo($ruta_db_superior);?>workflow/mapeo_diagrama.php?idpaso_documento=<?php echo($paso[0]["idpaso_documento"]); ?>" class="inicio" target="centro">Inicio <small>Inicio</small></a></li>
	   
  <li><a href="<?php echo($ruta_db_superior);?>workflow/actividades_paso_usuario.php?idpaso_documento=<?php echo($paso[0]["idpaso_documento"]); ?>&idpaso=<?php echo($paso[0]["paso_idpaso"]); ?>&documento=<?php echo($paso[0]["documento_iddocumento"]); ?>&diagrama=<?php echo($paso[0]["diagram_iddiagram_instance"]); ?>"  class="contacts">Actividades <small>Actividades</small></a></li>
  <li><a href="<?php echo($ruta_db_superior); ?>workflow/mostrar_paso.php?idpaso=<?php echo($idpaso_documento); ?>" class="home">Detalles <small>Detalles</small></a></li>
  <?php if($paso["numcampos"] && $idpaso_documento){ ?>
  <li><a href="<?php echo($ruta_db_superior); ?>workflow/objetos_paso.php?idpaso=<?php echo($idpaso_documento); ?>" class="playlist">Documento<small>Documento</small></a></li>
  <li><a href="<?php echo($ruta_db_superior); ?>transferenciaadd.php?idpaso_documento=<?php echo($paso[0]["idpaso_documento"]); ?>&key=<?php echo($paso[0]["documento_iddocumento"]); ?>" class="profile">Transferir<small>Transferir</small></a></li>
  <!--li><a href="configurar_paso.php?idpaso=<?php echo($idpaso_documento)?>" class="editprofile">Configurar<small>Configurar</small></a></li-->
  <li><a href="<?php echo($ruta_db_superior); ?>workflow/comentarios_paso.php?idpaso=<?php echo($idpaso_documento); ?>" class="messages">Rastro<small>Rastro</small></a></li>
  
  <!--li><a href="<?php echo($ruta_db_superior);?>workflow/devolver_paso.php?idpaso_documento=<?php echo($idpaso_documento)?>" class="devolver_paso">Devolver<small>Devolver</small></a></li-->
  <li><a href="<?php echo($ruta_db_superior); ?>workflow/reemplazar_responsable.php?idpaso_documento=<?php echo($idpaso_documento); ?>" class="reemplazar_responsable">Reemplazar<small>Reemplazar</small></a></li>
  <li><a href="<?php echo($ruta_db_superior); ?>workflow/terminar_flujo.php?idpaso_documento=<?php echo($idpaso_documento); ?>" class="terminar_flujo">Cancelar flujo<small>Cancelar flujo</small></a></li>
  
  
    <?php  if($paso[0]["estado_paso_documento"]>3){?>
      
    <?php } ?>  
  <?php } ?>          
</ul> <br>
<?php
}
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
    //print_r($dato_entidad);    
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
//Con el documento ubico el paso y se busca el paso siguiente, con la accion se llama según la accion que se ejecute, por ejemplo adicionar, editar, eliminar,transferir,apronar,etc. El tipo de terminacion define como se va a terminar la actividad 1 por una accion del sistema 2 de forma manual  
function terminar_actividad_paso($iddocumento,$accion,$tipo_terminacion=1,$paso_documento=0,$idactividad=0){
	global $conn;
//alerta($accion);
if($accion!="" && $tipo_terminacion==1){ 
//La condicion c.estado_paso_documento>4 es para verificar que el paso no este terminado o cerrado
	if($iddocumento){
  $listado_acciones_paso=busca_filtro_tabla("B.idpaso_actividad,A.idaccion,C.idpaso_documento,B.entidad_identidad,B.llave_entidad,C.diagram_iddiagram_instance, B.paso_idpaso,C.documento_iddocumento","accion A, paso_actividad B, paso_documento C","A.idaccion=B.accion_idaccion AND B.paso_idpaso=C.paso_idpaso AND C.documento_iddocumento=".$iddocumento." AND A.nombre='".$accion."' AND C.estado_paso_documento>3","",$conn);   
	}               
}
else if($paso_documento && $tipo_terminacion==2 && $idactividad){
  $listado_acciones_paso=busca_filtro_tabla("B.idpaso_actividad,B.accion_idaccion AS idaccion,C.idpaso_documento,B.entidad_identidad,B.llave_entidad,C.diagram_iddiagram_instance,B.paso_idpaso,C.documento_iddocumento"," paso_actividad B, paso_documento C"," B.paso_idpaso=C.paso_idpaso AND C.idpaso_documento=".$paso_documento." AND B.idpaso_actividad=".$idactividad." AND C.estado_paso_documento>3","",$conn);
  //print_r($listado_acciones_paso);
}
else{
  return (0);
}                                              
for($i=0;$i<@$listado_acciones_paso["numcampos"];$i++){
    if(verificar_existencia_funcionario($listado_acciones_paso[$i]["entidad_identidad"],$listado_acciones_paso[$i]["llave_entidad"],$_SESSION["usuario_actual"])){    
        $sql_accion="INSERT INTO paso_instancia_terminada(actividad_idpaso_actividad,documento_iddocumento,responsable,fecha,tipo_terminacion) VALUES(".$listado_acciones_paso[$i]["idpaso_actividad"].",".$iddocumento.",".$_SESSION["usuario_actual"].",".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").",".$tipo_terminacion.")";
        //die($sql_accion);
        phpmkr_query($sql_accion);
        $idterminacion=phpmkr_insert_id();
        if(verificar_terminacion_paso($listado_acciones_paso[$i]["paso_idpaso"],$iddocumento)){
          //iniciar_paso_siguiente($idpaso_documento,$anterior,$documento){
          $paso_siguiente=iniciar_paso_siguiente($listado_acciones_paso[$i]["idpaso_documento"],$listado_acciones_paso[$i]["documento_iddocumento"],$iddocumento);
          if($paso_siguiente==2){
            //Actualizar para Cerrar el FLujo
            $sql_cerrar_flujo="UPDATE diagram_instance SET estado_diagram_instance=2 WHERE iddiagram_instance=".$listado_acciones_paso[$i]["diagram_iddiagram_instance"]; 
            phpmkr_query($sql_cerrar_flujo);
            return($idterminacion);
          }
          else if($paso_siguiente==1){
            $doc=$listado_acciones_paso[$i]["documento_iddocumento"];
            if($accion=="responder"){          
              $respuesta=busca_filtro_tabla("","respuesta","origen=".$listado_acciones_paso[$i]["documento_iddocumento"],"",$conn); 
              if($respuesta["numcampos"]){
                $paso_siguiente=busca_filtro_tabla("B.idpaso_documento","paso_enlace A,paso_documento B","A.destino=B.paso_idpaso AND A.origen=".$listado_acciones_paso[$i]["paso_idpaso"]." AND B.documento_iddocumento=".$listado_acciones_paso[$i]["documento_iddocumento"],"",$conn);
                //print_r($paso_siguiente);              
                $sql_responder="UPDATE paso_documento SET documento_iddocumento=".$respuesta[0]["destino"]." WHERE idpaso_documento=".$paso_siguiente[0]["idpaso_documento"];
                $doc=$respuesta[0]["destino"];
                phpmkr_query($sql_responder);
                //die($sql_responder);
              } 
            }
            //Pasos Siguientes Insertados 
            //alerta("Un nuevo paso fue iniciado en el diagrama");
            /*$datos["archivo_idarchivo"]=$doc;
            $datos["nombre"]="TRANSFERIDO";
            $datos["tipo_destino"]=1;
            $datos["tipo"]="";
            $destino_tramite[]=$listado_acciones_paso[$i]["llave_entidad"];        
            transferir_archivo_prueba($datos,$destino_tramite,"","");*/
            return($idterminacion);
          } 
          else if(!$paso_siguiente==0){
            //Existe error
            return (0);
            //alerta("Existe un error en al terminar la actividad por favor intente de nuevo o registre la actividad como terminada en el flujo ");
          }
        }
        else{
          $sql="UPDATE paso_documento SET estado_paso_documento=6 WHERE idpaso_documento=".$listado_acciones_paso[$i]["idpaso_documento"];
        }
      return($idterminacion);
    }
}
return (0);
}
function verificar_terminacion_paso($idpaso,$iddocumento){
  //Verifica todos el paso que tenga el documento X y el paso Y que no este cancelado para sacar el diagrama y poder compararlo con los hermanos y verificar el estado del paso y actualizarlo si es necesario eñ menor que 3 es porque estado 1 es ejecutado, estado 2 es cerrado y estado 3 es cancelado 
  $paso_documento=busca_filtro_tabla("","paso_documento","paso_idpaso=".$idpaso." AND documento_iddocumento=".$iddocumento,"",$conn);
  $pasos_flujo=busca_filtro_tabla("","paso_documento","diagram_iddiagram_instance=".$paso_documento[0]["idpaso_documento"],"",$conn);

  //Sacamos el paso del documento para conocer el estado 
  if($paso_documento["numcampos"] && $paso_documento[0]["estado_paso_documento"]>3){
    $actividad_terminada=busca_filtro_tabla("","paso_instancia_terminada A,paso_actividad B","A.actividad_idpaso_actividad=B.idpaso_actividad AND B.paso_idpaso=".$idpaso." AND documento_iddocumento=".$iddocumento,"",$conn);
    $lactividades=extrae_campo($actividad_terminada,"actividad_idpaso_actividad");
    $condicion_actividad="";
    if($actividad_terminada["numcampos"]){
      $condicion_actividades=" AND idpaso_actividad NOT IN(".implode(",",$lactividades).")";
    }
    $pasos_restrictivos=busca_filtro_tabla("","paso_actividad","paso_idpaso=".$idpaso." AND restrictivo=1".$condicion_actividades,"",$conn);
    if($pasos_restrictivos["numcampos"]){
      return(false);
    }
    else{      
      $pasos_no_restrictivos=busca_filtro_tabla("","paso_actividad","paso_idpaso=".$idpaso." AND restrictivo=1".$condicion_actividades,"",$conn);
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
function iniciar_flujo($iddocumento,$idflujo){
global $conn;
  if($idflujo && $iddocumento){
        //en la condicion de paso_enlace -1 es el nodo de inicio y -2 es el nodo final
        $datos_enlace=busca_filtro_tabla("DISTINCT A.idpaso,A.posicion","paso A, paso_enlace B","A.diagram_iddiagram=".$idflujo." AND A.idpaso=B.destino AND B.origen=-1","",$conn);
        //print_r($datos_enlace);
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
    else{
        alerta("No es posible crear el flujo por favor vincule el documento de forma manual");
    } 
}
function iniciar_paso_siguiente($idpaso_documento,$documento){
    if(@$idpaso_documento){
        $paso_anterior=busca_filtro_tabla("","paso_documento A,paso B","A.paso_idpaso=B.idpaso AND A.idpaso_documento=".$idpaso_documento,"",$conn);
        if($paso_anterior["numcampos"]){
            if(!$documento){
              $documento=$paso_anterior[0]["documento_iddocumento"];
            }
            $paso_siguiente=busca_filtro_tabla("A.destino","paso_enlace A","A.origen=".$paso_anterior[0]["paso_idpaso"]." AND A.destino<>-2","",$conn);
            for($i=0;$i<$paso_siguiente["numcampos"];$i++){
              $sql2="INSERT INTO paso_documento(paso_idpaso,documento_iddocumento,fecha_asignacion,diagram_iddiagram_instance,estado_paso_documento) VALUES(".$paso_siguiente[$i]["destino"].",".$documento.",".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").",".$paso_anterior[0]["diagram_iddiagram_instance"].",4)";
              phpmkr_query($sql2);
            }    
            if($paso_siguiente["numcampos"]){
              //Existen Mas pasos
              return(1);
            }
            else{
              //No existen mas pasos   
              return(2);
            }   
        }
        else{
            return(false);
        }
    }    
return(false);   
}
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
<Nombre>mostrar_acciones_actividad</Nombre> 
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

$actividad=busca_filtro_tabla("","paso_actividad A"," A.idpaso_actividad=".$idactividad,"",$conn);
if($actividad["numcampos"]){
$puede_ejecutar=verificar_existencia_funcionario($actividad[0]["entidad_identidad"],$actividad[0]["llave_entidad"],$_SESSION["usuario_actual"]);
    if($actividad[0]["tipo"]==1 &&$puede_ejecutar){
        $accion=busca_filtro_tabla("","accion A, modulo B","A.modulo_idmodulo = B.idmodulo AND A.idaccion=".$actividad[0]["accion_idaccion"],"",$conn);
        //print_r($accion);
        if($accion["numcampos"]){
            //$texto.="<img src='".$ruta_db_superior.$accion[0]["boton"]."'>";
            if($documento!=-1 && $idpaso_documento!=-1)
              $enlace=str_replace("@key@",$documento,$ruta_db_superior.$accion[0]["enlace"]."&idpaso_documento=".$idpaso_documento."&idpaso_actividad=".$idactividad);
            else
              $enlace="#";  
            $texto.=agrega_boton_paso($ruta_db_superior.$accion[0]["imagen"],$enlace,"centro",$accion[0]["etiqueta"],$accion[0]["nombre"],1);
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
        $texto.=agrega_boton_paso($ruta_db_superior."botones/workflow/terminar_actividad_paso_manual.png","terminar_actividad_paso_manual.php?idactividad=".$idactividad."&idpaso_documento=".$idpaso_documento."&documento=".$documento,"_self","Terminar Actividad de forma manual","terminar_actividad_paso_manual",1);
    }
}
}

return(str_replace("@actividad_paso@",$idactividad,$texto));
}
function acciones_edicion_actividad($idactividad_paso){
global $ruta_db_superior;
  //($imagen="../../botones/configuracion/default.gif",$dir="#",$destino="_self",$texto="",$modulo="",$retorno=0){
$texto=agrega_boton_paso("","#","_self","Eliminar","eliminar_actividad",1);
}
function mostrar_acciones_actividad($idactividad,$idpaso_instancia_terminada=0,$idpaso_documento=0,$devuelto=0){
global $ruta_db_superior,$conn;
$texto='';
//echo($devuelto."--".$idpaso_instancia_terminada."--->".$idpaso_documento);
/*
 * @ devuelto define si es necesario devolver la actividad, es decir restaurar el estado y adicionar las notas redirecciona a la restauracion de la actividad
 * */    
if($devuelto){  
  $texto.="<a href='rehacer_actividad_paso.php?idpaso_documento=".$idpaso_documento."&idpaso_instancia_terminada=".$idpaso_instancia_terminada."'><img src='".$ruta_db_superior."images/panel_inferior_pasos/rehacer_flujo.png' title='Restaurar actividad del paso' alt='Restaurar actividad del paso'></a>";
  return $texto;
}
$actividad=busca_filtro_tabla("","paso_actividad A","A.idpaso_actividad=".$idactividad,"",$conn);
if($actividad["numcampos"]){
    if($actividad[0]["tipo"]==1){
        $accion=busca_filtro_tabla("","accion A,modulo B","A.modulo_idmodulo=B.idmodulo AND A.idaccion=".$actividad[0]["accion_idaccion"],"",$conn);
        if($accion["numcampos"]){
            //$texto.="<img src='".$ruta_db_superior.$accion[0]["boton"]."'>";
            //$texto.=agrega_boton_paso($ruta_db_superior.$accion[0]["imagen"],"#","_self",$accion[0]["etiqueta"],$accion[0]["nombre"],1);
        }
        else{
            //$texto.="<img src='".$ruta_db_superior."botones/workflow/terminar_actividad_paso_manual.png' class='tooltip_saia'  title='Terminar actividad del paso de forma manual' alt='Terminar actividad del paso de forma manual'>";
        }
    }
    else{
        //$texto.=agrega_boton2("","botones/workflow/terminar_actividad_paso_manual.png","","","","","terminar_actividad_paso_manual","",1);
        //$texto.="<img src='".$ruta_db_superior."botones/workflow/terminar_actividad_paso_manual.png' class='tooltip_saia' title='Terminar actividad del paso de forma manual' alt='Terminar actividad del paso de forma manual'>";
    }
}    
//TODO : Validaciones para las personas que puedan hacer la devolucion en este momento cualquier persona puede devolver.
if($idpaso_instancia_terminada &&$idpaso_documento){
  $texto.="<a href='devolver_actividad_paso.php?idpaso_instancia_terminada=".$idpaso_instancia_terminada."&idpaso_documento=".$idpaso_documento."'><img src='".$ruta_db_superior."images/panel_inferior_pasos/devolver_flujo.png' class='tooltip_saia' title='Generar devolucion de la actividad' alt='Generar devolucion de la actividad'></a>"; 
}
return(str_replace("@actividad_paso@",$idactividad,$texto));
}
function vencimiento_actividad($idactividad,$iddocumento){
    
}
function estado_paso_documento($idpaso_documento){
global $conn;
include_once("../calendario/calendario.php");
$paso=busca_filtro_tabla("A.idpaso_documento, A.estado_paso_documento,B.diagram_iddiagram,B.plazo_paso, ".fecha_db_obtener("fecha_asignacion","Y-m-d H:i:s")." AS fecha_asignacion,B.nombre_paso","paso_documento A,paso B","A.paso_idpaso=B.idpaso AND A.idpaso_documento=".$idpaso_documento."","fecha_asignacion DESC",$conn);
$plazo=explode("@",$paso[0]["plazo_paso"]);
$fecha_final=dias_habiles(($plazo[0]/24),"Y-m-d",$paso[0]["fecha_asignacion"]);
$hoy=date("Y-m-d H:i:s");
$diferencia=compara_fechas($fecha_final,$hoy);
if($paso[0]["estado_paso_documento"]>3){
  //Verifica si el estado del paso del documento es Pendiente(4) o Iniciado(6) y esta atrasado actualiza el estado del paso
  if($diferencia["tiempo"] && in_array($paso[0]["estado_paso_documento"],array(4,6))){
    $sql_paso="UPDATE paso_documento SET estado_paso_documento=5 WHERE idpaso_documento=".$idpaso_documento;
    phpmkr_query($sql_paso);
    $paso[0]["estado_paso_documento"]=5;
  }
}     
$estado="";
$devuelto=0;
if($paso[0]["estado_actividad"]==7){
  $devuelto++;
}
$peso=explode("@",$paso[0]["plazo_paso"]);
$total_restrictivos+=$peso[0];
$total_paso+=$peso[1];
$paso["devueltos"]=$devuelto;  
$paso["fecha_final"]=$fecha_final;
$paso["diferencia"]=$diferencia;
$paso["plazo_restrictivos"]=$total_restrictivos;
$paso["plazo_total"]=$total_paso;
return($paso);
}
function estado_flujo_instancia($idpaso_documento){
global $conn,$ruta_db_superior;
include_once($ruta_db_superior."calendario/calendario.php");
$paso_documento=busca_filtro_tabla("","paso_documento","idpaso_documento=".$idpaso_documento,"idpaso_documento DESC",$conn);
//print_r($paso_documento);
 /*1,Ejecutado(#99FF66);2,Cerrado(#99FF66),3,Cancelado;4,Pendiente(#FFFF66);5,Atrasado(#FF3333);6,Iniciado( #FFFF66)*/ 
$flujo=busca_filtro_tabla("A.idpaso_documento, A.estado_paso_documento,B.diagram_iddiagram,B.plazo_paso, ".fecha_db_obtener("fecha_asignacion","Y-m-d H:i:s")." AS fecha_asignacion, C.estado_diagram_instance, C.fecha AS fecha_diagram,B.nombre_paso,C.iddiagram_instance,paso_idpaso,A.documento_iddocumento","paso_documento A,paso B, diagram_instance C","A.paso_idpaso=B.idpaso AND A.diagram_iddiagram_instance=C.iddiagram_instance AND A.diagram_iddiagram_instance=".$paso_documento[0]["diagram_iddiagram_instance"]." AND estado_paso_documento<>7","idpaso_documento DESC",$conn);
$plazo=explode("@",$flujo[0]["plazo_paso"]);
$fecha_final=dias_habiles(($plazo[0]/24),"Y-m-d",$flujo[0]["fecha_asignacion"]);
$fecha_fina2=dias_habiles((($plazo[0]/24)),"Y-m-d",$flujo[0]["fecha_asignacion"]);
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
$fecha_final_diagram=dias_habiles((($total_restrictivos)/24),"Y-m-d",@$flujo[0]["fecha_diagram_instance"]);
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
if($pasos_flujo["numcampos"])
  $porcentaje=round((($flujo["numcampos"])*100)/$pasos_flujo["numcampos"],2);
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
function calcular_plazo_flujo($idflujo){
$flujo=busca_filtro_tabla("","paso","diagram_iddiagram=".$idflujo,"",$conn);
  for($i=0;$i<$flujo["numcampos"];$i++){
    calcular_plazo_paso($flujo[$i]["idpaso"]);
  }
}
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
function devolver_actividades_paso($idpaso_documento,$idpaso,$documento,$observaciones){
  $actividades=busca_filtro_tabla("","paso_instancia_terminada A, paso_actividad B","A.actividad_idpaso_actividad=B.idpaso_actividad AND A.documento_documento=".$documento." AND B.paso_idpaso=".$idpaso ,"",$conn);
  for ($i=0; $i < $actividades["numcampos"] ; $i++) {
    devolver_actividad_paso($actividades[$i]["idpaso_instancia_terminada"], $actividades[$i]["estado_actividad"], $observaciones,0);
  }
  $sql1="UPDATE paso_documento SET estado_paso_documento=7 WHERE idpaso_estado_documento=".$idpaso_documento;
  phpmkr_query($sql1);
  return(true);
}
function devolver_actividad_paso($idinstancia_terminada,$estado_original,$observaciones,$idpaso_documento,$paso){
  global $conn;  
  $sql0="UPDATE paso_instancia_terminada SET estado_actividad =7 WHERE idpaso_instancia=".$idinstancia_terminada;
  //echo "-->".$sql0."<br>";
  phpmkr_query($sql0,$conn); 
  $sql1="INSERT INTO paso_instancia_rastro(instancia_idpaso_instancia, funcionario_codigo, estado_original,estado_final,fecha_cambio, observaciones) VALUES(".$idinstancia_terminada.",".$_SESSION["usuario_actual"].",".$estado_original.",7,'".date("Y-m-d H:i:s")."','".$observaciones."')";
  //echo "-->".$sql1."<br>";
  phpmkr_query($sql1,$conn);    
  if($paso){
     $paso_documento=busca_filtro_tabla("","estado_paso_documento","idpaso_documento=".$idpaso_documento,"",$conn);
    $sql2="UPDATE paso_documento SET estado_paso_documento=7 WHERE idpaso_documento=".$idpaso_documento;
    phpmkr_query($sql2,$conn);
    $sql1="INSERT INTO paso_rastro(documento_idpaso_documento, funcionario_codigo, estado_original,estado_final,fecha_cambio, observaciones) VALUES(".$idpaso_documento.",".$_SESSION["usuario_actual"].",".$paso_documento[0]["estado_paso_documento"].",7,'".date("Y-m-d H:i:s")."','".$observaciones."')";
    phpmkr_query($sql1,$conn);
    //echo "-->".$sql2."<br>";
  }
}
function rehacer_actividad_paso($idpaso_instancia,$observaciones,$idpaso_documento){
   global $conn;
   //$paso_documento=busca_filtro_tabla("","paso_documento","idpaso_documento=".$idpaso_documento,"",$conn);
   $instancia_paso=busca_filtro_tabla("","paso_instancia_rastro","instancia_idpaso_instancia=".$idpaso_instancia,"idpaso_instancia_rastro DESC",$conn); 
   //print_r($instancia_paso);
   $estado_paso=$instancia_paso[0]["estado_original"];
   $sql0="UPDATE paso_instancia_terminada SET estado_actividad =".$estado_paso." WHERE idpaso_instancia=".$idpaso_instancia;
  phpmkr_query($sql0,$conn);
  //echo($sql0."<br>"); 
   $sql1="INSERT INTO paso_instancia_rastro(instancia_idpaso_instancia, funcionario_codigo, estado_original,estado_final,fecha_cambio, observaciones) VALUES(".$idpaso_instancia.",".$_SESSION["usuario_actual"].",7,".$estado_paso.",'".date("Y-m-d H:i:s")."','".$observaciones."')";
  phpmkr_query($sql1,$conn);
  //echo($sql1."<br>"); 
  //print_r($paso_documento);
  validar_estado_paso($idpaso_instancia,$idpaso_documento);  
}
function validar_estado_paso($idpaso_instancia,$idpaso_documento){   
$paso_documento=busca_filtro_tabla("","paso_documento A,paso_actividad B,paso_instancia_terminada C","A.paso_idpaso=B.paso_idpaso AND A.documento_iddocumento=C.documento_iddocumento AND idpaso_documento=".$idpaso_documento."","",$conn);
$actividades_paso=busca_filtro_tabla("","paso_actividad B,paso A","A.idpaso=B.paso_idpaso AND B.paso_idpaso=".$paso_documento[0]["paso_idpaso"],"",$conn);

$devuelto=0;
$restrictivo=0;
$no_restrictivo=0;
//print_r($paso_documento);
for($i=0;$i<$paso_documento["numcampos"];$i++){
  if($paso_documento[$i]["estado_actividad"]==7)
    $devuelto++;
  if($paso_documento[$i]["restrictivo"]==1)
    $restrictivo++;
  if($paso_documento[$i]["restrictivo"]==0)
    $no_restrictivo++;    
}
//echo("<br>++>".$restrictivo);
for($i=0;$i<$actividades_paso["numcampos"];$i++){
  if($actividades_paso[$i]["restrictivo"]==1)
    $restrictivo--;
  if($actividades_paso[$i]["restrictivo"]==0)
    $no_restrictivo--;    
}

//echo("<br>--->".$restrictivo);
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
  $fecha_final=dias_habiles(($plazo[0]/24),"Y-m-d",$paso_documento[0]["fecha_asignacion"]);
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
//$sql2="UPDATE paso_documento SET estado_paso_documento=".$estado." WHERE idpaso_documento=".$idpaso_documento;
//echo $sql2;
phpmkr_query($sql2,$conn);    
}
/*TODO: PASAR A class_transferencia*/
function documento_transferido($documento,$funcionario_codigo, $funcionarios_excluidos){
  global $conn;
  $condicion="A.destino=B.funcionario_codigo AND A.archivo_idarchivo=".$documento." AND A.destino IN(".$funcionario_codigo.")";
  if($funcionarios_excluidos) 
    $condicion.=" AND A.destino NOT IN(".$funcionarios_excluidos.")";
  $asignados2=busca_filtro_tabla("B.nombres, B.apellidos, B.funcionario_codigo","buzon_salida A, funcionario B",$condicion,"GROUP BY B.nombres, B.apellidos, B.funcionario_codigo",$conn);
  return($asignados2);
}
function documento_asignado($documento,$funcionario_codigo){
  global $conn;
  $asignados2=busca_filtro_tabla("","asignacion A, funcionario B","A.llave_entidad=B.funcionario_codigo AND A.documento_iddocumento=".$documento." AND A.llave_entidad =".$funcionario_codigo,"B.funcionario_codigo",$conn);
  return($asignados2);
}
function cancelar_flujo($idpaso_documento){
	global $conn;
	$datos = estado_flujo_instancia($idpaso_documento);
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
		
		$actividad = busca_filtro_tabla("","paso_actividad","paso_idpaso=".$datos[$i]["paso_idpaso"],"",$conn);
		for($j=0;$j<$actividad["numcampos"];$j++){
			$verificando = busca_filtro_tabla("","paso_instancia_terminada","actividad_idpaso_actividad=".$actividad[$j]["idpaso_actividad"]." and documento_iddocumento=".$datos[$i]["documento_iddocumento"],"",$conn);
			if($verificando["numcampos"] > 0){
				$sql = "UPDATE paso_instancia_terminada SET estado_actividad='3' WHERE idpaso_instancia=".$verificando[$j]["idpaso_instancia"];
				phpmkr_query($sql,$conn);
			}
		}
	}
}
function formulario_devolver($iddoc){
	global $conn,$ruta_db_superior;
	$pasos_relacionados = busca_filtro_tabla("b.descripcion as nom_activi,a.*,c.*,b.*","paso_instancia_terminada a,paso_actividad b, paso c","documento_iddocumento=".$iddoc." AND estado_actividad=1 AND actividad_idpaso_actividad=idpaso_actividad AND paso_idpaso=idpaso","idpaso_instancia asc",$conn);
	//print_r($pasos_relacionados);
	$pasos = busca_filtro_tabla("distinct(idpaso)","paso_instancia_terminada a,paso_actividad b, paso c","documento_iddocumento=".$iddoc." AND estado_actividad=1 AND actividad_idpaso_actividad=idpaso_actividad AND paso_idpaso=idpaso","idpaso_instancia asc",$conn);
	//print_r($pasos);
	
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
?>