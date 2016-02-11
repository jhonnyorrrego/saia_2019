<?php
include_once("../db.php");
//include_once("librerias/funciones_archivo.php");
$cont=0;
$incluidos=array();
if(@$_REQUEST["idformato"])
  $idformato=$_REQUEST["idformato"];
else {
  alerta("por favor seleccione un Formato a Generar",'error',5000); 
  redirecciona("formatolist.php");
}  
switch(@$_REQUEST["genera"]){
  case "formato":
    generar_formato($idformato);
    redireacciona("formatolist.php");
  break;
  case "tabla":
    generar_tabla($idformato);
    redirecciona("campos_formatolist.php?idformato=".$idformato);
  break;  
}  
switch(@$_REQUEST["crea"]){
    case "mostrar":
      crear_formato_mostrar($idformato);
      redirecciona("funciones_formatolist.php?idformato=".$idformato);
    break;
    case "adicionar":
      crear_formato_ae($idformato,"adicionar");
      redirecciona("funciones_formatolist.php?idformato=".$idformato);
    break;
    case "editar":
      crear_formato_ae($idformato,"editar");
      redirecciona("funciones_formatolist.php?idformato=".$idformato);
    break;
    case "eliminar":
      crear_formato_mostrar($idformato,"eliminar");
      redirecciona("funciones_formatolist.php?idformato=".$idformato);
    break;
  }
function generar_tabla($idformato){
  global $sql,$conn;
  $sql_tabla="";
  $lcampos=array();
  $idesta=0;
  $iddocesta=0;
  $formato=busca_filtro_tabla("*","formato A","A.idformato=".$idformato,"",$conn);
  if($formato["numcampos"]){
    $campos=busca_filtro_tabla("*","campos_formato A","A.formato_idformato=".$idformato,"",$conn);
    if(MOTOR=="MySql"){
      $datos_tabla=ejecuta_filtro_tabla("DESCRIBE ".$formato[0]["nombre_tabla"],$conn);
    }
    else if(MOTOR=="Oracle"){
      $datos_tabla=ejecuta_filtro_tabla("SELECT column_name AS Field FROM user_tab_columns WHERE table_name='".strtoupper($formato[0]["nombre_tabla"])."' ORDER BY column_name ASC",$conn);
    }
    $tabla_esta=$datos_tabla["numcampos"];
    if($datos_tabla["numcampos"])    
      $campos_tabla=extrae_campo($datos_tabla,"Field","U"); //esto es para saber si existe el campo o no.
    else $campos_tabla=array();  
    //print_r($campos_tabla);
    $pos=busca_filtro_tabla("nombre","campos_formato","formato_idformato=$idformato and nombre='id".$formato[0]["nombre_tabla"]."'","",$conn);
    if(!$pos["numcampos"]){
      $sqlid="INSERT INTO campos_formato(formato_idformato,nombre,etiqueta,tipo_dato,longitud,obligatoriedad,banderas,acciones,etiqueta_html) VALUES('".$idformato."','id".$formato[0]["nombre_tabla"]."','".strtoupper($formato[0]["nombre"])."','INT','11','1','ai,pk','a,e','hidden')";
      phpmkr_query($sqlid,$conn)or die($sqlid);
      }
    $pos=busca_filtro_tabla("nombre","campos_formato","formato_idformato=$idformato and nombre='documento_iddocumento'","",$conn);
    if(!$pos["numcampos"] && !$formato[0]["item"] ){
      $sqldoc="INSERT INTO campos_formato(formato_idformato,nombre,etiqueta,tipo_dato,longitud,obligatoriedad,banderas,acciones,etiqueta_html) VALUES('".$idformato."','documento_iddocumento','DOCUMENTO ASOCIADO','INT','11','1','i','a,e','hidden')";
      phpmkr_query($sqldoc,$conn)or die($sqldoc);  
     }
    $pos=busca_filtro_tabla("nombre","campos_formato","formato_idformato=$idformato and nombre='dependencia'","",$conn);
    if(!$pos["numcampos"] && !$formato[0]["item"]){
     $sqldoc="INSERT INTO campos_formato(formato_idformato,nombre,etiqueta,tipo_dato,longitud,obligatoriedad,banderas,acciones,etiqueta_html,valor) VALUES('".$idformato."','dependencia','DEPENDENCIA DEL CREADOR DEL DOCUMENTO','INT','11','1','i','a,e','hidden','{*buscar_dependencia*}')";
      phpmkr_query($sqldoc,$conn)or die($sqldoc);    
      }
    $pos=busca_filtro_tabla("nombre","campos_formato","formato_idformato=$idformato and nombre='encabezado'","",$conn);
    if(!$pos["numcampos"] && !$formato[0]["item"]){
      $sqldoc="INSERT INTO campos_formato(formato_idformato,nombre,etiqueta,tipo_dato,longitud,obligatoriedad,banderas,acciones,etiqueta_html,valor,predeterminado) VALUES('".$idformato."','encabezado','ENCABEZADO','INT','11','1','i','a,e','hidden',1,1)";
      phpmkr_query($sqldoc,$conn)or die($sqldoc); 
      }
    $pos=busca_filtro_tabla("nombre","campos_formato","formato_idformato=$idformato and nombre='firma'","",$conn);
    if(!$pos["numcampos"] && !$formato[0]["item"]){
      $sqldoc="INSERT INTO campos_formato(formato_idformato,nombre,etiqueta,tipo_dato,longitud,obligatoriedad,banderas,acciones,etiqueta_html,valor) VALUES('".$idformato."','firma','FIRMAS DIGITALES','INT','11','1','i','a,e','hidden',1)";
      phpmkr_query($sqldoc,$conn)or die($sqldoc);
      }
      $campos=busca_filtro_tabla("*","campos_formato A","A.formato_idformato=".$idformato,"",$conn);
    if(!$tabla_esta){
      $sql_tabla="CREATE TABLE ".$formato[0]["nombre_tabla"]."(";
    }
    else elimina_indices_tabla($formato[0]["nombre_tabla"]);
    for($i=0;$i<$campos["numcampos"];$i++){
      $dato_campo=crear_campo($campos[$i],$formato[0]["nombre_tabla"]);
      //echo $i."  ".$dato_campo."<br />";
      if($dato_campo && $dato_campo<>""){
        if(!$tabla_esta){
          array_push($lcampos,$dato_campo);
        }
        else{
          $pos=array_search(strtolower($campos[$i]["nombre"]),$campos_tabla);
          $dato="";
          if(MOTOR=="MySql"){
            if($pos===false)
              $dato="ALTER TABLE ".$formato[0]["nombre_tabla"]." ADD ".$dato_campo;
            else
              $dato="ALTER TABLE ".$formato[0]["nombre_tabla"]." MODIFY ".$dato_campo;
            if($dato!="")
              phpmkr_query($dato,$conn->Conn->conn);
          }
          else if(MOTOR=="Oracle"){
            if($pos===false)
              $dato="ALTER TABLE ".$formato[0]["nombre_tabla"]." ADD ".$dato_campo;
            else
              $dato="ALTER TABLE ".$formato[0]["nombre_tabla"]." MODIFY ".$dato_campo;
            //echo $dato;
            ejecuta_sql($dato,$conn);
            //echo phpmkr_error();
          }
        }
      }
    }
    
    if(!$campos["numcampos"]){
      alerta("Problemas al Generar la tabla, No existen Campos",'error',4000);
      return(false);
    }
    if(!$tabla_esta){
      $sql_tabla.=implode(",",$lcampos);
      $sql_tabla.=") ";
      if(phpmkr_query($sql_tabla,$conn)){
        alerta("Tabla ".$formato[0]["nombre_tabla"]." Generada con Exito",'success',4000);
        crear_indices_tabla($formato[0]["idformato"]);
       // die();
      }
      else{
        die("No es posible Generar la tabla en el Formato ".$sql_tabla."<br />".phpmkr_error());
        return(false);
      }
    }
    else {
      crear_indices_tabla($formato[0]["idformato"]);
    }
  }
  else{
    alerta("No es posible Generar la tabla en el Formato",'error',4000);
    return(false);
  }
//die();
} 
function elimina_indices_tabla($tabla){
global $conn;
$tabla=strtoupper($tabla);
if(MOTOR=="MySql"){
  $indices=ejecuta_filtro_tabla("SHOW INDEX FROM ".$tabla,$conn);
  for($i=0;$i<$indices["numcampos"];$i++){
    elimina_indice($tabla,$indices[$i]);
  }
}
else if(MOTOR == "Oracle"){
  $envio=array();
  $sql2="select ai.INDEX_NAME AS column_name, ai.UNIQUENESS AS Key_name FROM all_indexes ai WHERE ai.TABLE_OWNER='".DB."' AND ai.table_name = '".$tabla."'";
  $indices=ejecuta_filtro_tabla($sql2,$conn);
  //print_r($indices);
  for($i=0;$i<$indices["numcampos"];$i++){
    array_push($envio,array("Key_name"=>$indices[$i]["key_name"],"Column_name"=>$indices[$i]["column_name"]));
  }
  $sql2="SELECT cols.column_name AS Column_name, cons.constraint_type AS Key_name FROM all_constraints cons, all_cons_columns cols WHERE cons.constraint_type = 'P' AND cons.constraint_name = cols.constraint_name AND cons.owner = cols.owner AND cons.owner='".DB."' AND cols.table_name='".$tabla."' ORDER BY cols.table_name, cols.position";
  $primaria=ejecuta_filtro_tabla($sql2,$conn);
  //print_r($primaria);
  //echo("<br />".$sql2."<br />");
  for($i=0;$i<$primaria["numcampos"];$i++){
    array_push($envio,array("Key_name"=>"PRIMARY","Column_name"=>$primaria[$i]["Column_name"]));
  }
  $numero_indices=count($envio);
  //print_r($envio);
  for($i=0;$i<$numero_indices;$i++){
    elimina_indice($tabla,$envio[$i]);
  }
}
return;
}
/*
Se le debe enviar campo como arreglo que debe contener los siguentes parametros:
Key_name:Nombre o tipo de LLave de la llave.
Column_name: Nombre de la Columna.

Tabla define la tabla donde se debe hacer el cambio.
*/
function elimina_indice($tabla,$campo){
global $conn;
if(MOTOR=="MySql"){
  if($campo["Key_name"]=="PRIMARY"){
    $sql="ALTER TABLE ".$tabla." DROP PRIMARY KEY";
    phpmkr_query($sql,$conn);
    $sql="ALTER TABLE ".$tabla." CHANGE ".$campo["Column_name"]." ".$campo["Column_name"]." INT( 11 ) NOT NULL";
    phpmkr_query($sql,$conn);
    //echo($sql."<br />");
  }
  $sql="DROP INDEX ".$campo["Column_name"]." ON ".$tabla;
  phpmkr_query($sql,$conn);
  //echo($sql."<br />");
}
else if(MOTOR=="Oracle"){
  if($campo["Key_name"]=="PRIMARY"){
    $sql="ALTER TABLE ".$tabla." DROP PRIMARY KEY DROP INDEX";
    phpmkr_query($sql,$conn);
    //echo($sql."<br />");
  }
  if($campo["Key_name"]=="UNIQUE"){
    $sql="ALTER TABLE ".$tabla." DROP UNIQUE U_".$campo["Column_name"]." DROP INDEX";
    phpmkr_query($sql,$conn);
    //echo($sql."<br />");
  }
  if($campo["Key_name"]=="NONUNIQUE"){
    $sql="ALTER TABLE ".$tabla." DROP UNIQUE U_".$campo["Column_name"]." DROP INDEX";
    phpmkr_query($sql,$conn);
    //echo($sql."<br />");
  }
}
//echo($sql);
return;
}
function es_indice($campo,$tabla,$indice){
global $conn;
/*CAMBIO:Pilas Falta que envie la tabla esto es solo para mostrar el SQL*/
$indice=ejecuta_filtro_tabla("SHOW INDEX FROM ".$tabla." WHERE Column_name LIKE '".$campo."'",$conn);
if(!$indice["numcampos"])
  return(false);
return(true);
}
function crear_indices_tabla($formato){
global $conn;
$campos=busca_filtro_tabla("","campos_formato","formato_idformato=".$formato." AND (banderas IS NOT NULL OR banderas<>'')","",$conn);
$tabla=busca_filtro_tabla("nombre_tabla","formato","idformato=".$formato,"",$conn);
for($i=0;$i<$campos["numcampos"];$i++)
   crear_indice($campos[$i]["banderas"],$campos[$i]["nombre"],$tabla[0]["nombre_tabla"]);
}

function crear_indice($todas_banderas,$nombre_campo,$nombre_tabla)
{global $conn;
$nombre_tabla=strtoupper($nombre_tabla);
$nombre_campo=strtoupper($nombre_campo);
//echo $nombre_campo."<br />";
$banderas=explode(",",$todas_banderas);
for($j=0;$j<count($banderas);$j++){
  if(MOTOR=="Oracle"){
  // echo $banderas[$j]."<br /><br />";
    switch(strtolower($banderas[$j])){
      case "pk":
          //if(es_indice($nombre_campo,$nombre_tabla,"pk")){
            $sql2="SELECT LAST_NUMBER AS ULTIMO FROM all_sequences WHERE sequence_owner='".DB."' AND sequence_name='".$nombre_tabla."_SEQ'";
            $siguiente=ejecuta_filtro_tabla($sql2,$conn);
            if($siguiente["numcampos"]){
              $inicio=$siguiente[0];
              $dato="DROP SEQUENCE ".$nombre_tabla."_SEQ";
              ejecuta_filtro_tabla($dato,$conn);
            }
            if(!@$inicio)
              $inicio=1;
            //echo("<br />".$sql2."<br />");
            //print_r($conn);
            //print_r($siguiente);
            $dato="CREATE INDEX PK_".$nombre_campo." ON ".$nombre_tabla."(".$nombre_campo.") LOGGING TABLESPACE ".DB." PCTFREE 10 INITRANS 2 MAXTRANS 255 STORAGE (INITIAL 128K MINEXTENTS 1 MAXEXTENTS 2147483645 PCTINCREASE 0 BUFFER_POOL DEFAULT) NOPARALLEL";
            //echo $dato."<br /><br />";
            ejecuta_filtro_tabla($dato,$conn);
          //  die(phpmkr_error());
            $dato="CREATE SEQUENCE ".$nombre_tabla."_SEQ START WITH ".$inicio." MAXVALUE 999999999999999999999999 MINVALUE 0  NOCYCLE CACHE 20 NOORDER";
            //echo $dato."<br /><br />";
            ejecuta_filtro_tabla($dato,$conn);
            $dato="CREATE OR REPLACE TRIGGER TRG_".$nombre_tabla." BEFORE INSERT OR UPDATE ON ".$nombre_tabla." FOR EACH ROW BEGIN IF INSERTING AND :NEW.".$nombre_campo." IS NULL THEN SELECT ".$nombre_tabla."_SEQ.NEXTVAL INTO :NEW.".$nombre_campo." FROM DUAL; END IF; END;";
            //echo $dato."<br /><br />";
            ejecuta_filtro_tabla($dato,$conn);
          //}
      break;
      case "u":
        //if(es_indice($nombre_campo,$nombre_tabla,"u")){
          $dato="ALTER TABLE ".$nombre_tabla." ADD CONSTRAINT U_".$nombre_campo." UNIQUE( ".$nombre_campo." )";
          ejecuta_filtro_tabla($dato,$conn);
          //echo $dato."<br /><br />";
        //}
      break;
      case "i":
        //if(es_indice($nombre_campo,$nombre_tabla,"i")){

          $dato="CREATE INDEX I_".substr($nombre_tabla,0,7)."_".substr($nombre_campo,0,7)." ON ".$nombre_tabla." (".$nombre_campo.") LOGGING TABLESPACE ".DB." PCTFREE 10 INITRANS 2 MAXTRANS 255 STORAGE (INITIAL 128K MINEXTENTS 1 MAXEXTENTS 2147483645 PCTINCREASE 0 BUFFER_POOL DEFAULT) NOPARALLEL;";
          //echo $dato."<br /><br />";
          ejecuta_sql($dato,$conn);
        //}
      break;
    }
  }
  else if(MOTOR=="MySql"){
    switch(strtolower($banderas[$j])){
      case "pk":
        //if(!es_indice($nombre_campo,$nombre_tabla,"pk")){
          $dato="ALTER TABLE ".$nombre_tabla." ADD PRIMARY KEY ( ".$nombre_campo.")";
          ejecuta_sql($dato,$conn);
          $dato="ALTER TABLE ".$nombre_tabla." CHANGE ".strtolower($nombre_campo)." ".strtolower($nombre_campo)." INT(11) NOT NULL AUTO_INCREMENT ";
          ejecuta_sql($dato,$conn);
        //}
      break;
      case "u":
        //if(!es_indice($nombre_campo,$nombre_tabla,"u")){
          $dato="ALTER TABLE ".$nombre_tabla." ADD UNIQUE( ".$nombre_campo." )";
          ejecuta_sql($dato,$conn);
        //}
      break;
      case "i":
        //if(!es_indice($nombre_campo,$nombre_tabla,"i")){
          $dato="ALTER TABLE ".$nombre_tabla." ADD INDEX ( ".$nombre_campo." )";
          ejecuta_sql($dato,$conn);
        //}
      break;
    }
  }
}
//echo "<br /><br /><br />";
//die();
}
/*Estas funciones debe ir en db.php o en SQL por su proceso directo con la base de datos validar la ocurrencia de crear tabla*/
function crear_campo($datos_campo,$tabla,$estructura_campo=null){
global $conn;
$campo="";

  if($datos_campo["nombre"]){
    if(!is_numeric($datos_campo["nombre"]))
      $campo.=strtolower(str_replace(" ","_",trim($datos_campo["nombre"])));
    else return (false);
  }
  switch(strtoupper(@$datos_campo["tipo_dato"])){
    case "NUMBER":
      if(MOTOR=="MySql"){
        $campo.=" decimal ";
        if($datos_campo["longitud"]){
          $campo.=" (".intval($datos_campo["longitud"]).",0) ";
        }
        else{
          $campo.=" (10,0) ";
        }  
      }
      else if(MOTOR=="Oracle"){
        $campo.=" NUMBER ";
        if($datos_campo["longitud"]){
          $campo.=" (".intval($datos_campo["longitud"]).") ";
        }
        else{
          $campo.=" (11) ";
        }          
      }
      if($datos_campo["predeterminado"]){
        $campo.=" DEFAULT '".intval($datos_campo["predeterminado"])."' ";
      }      
    break;
    case "DOUBLE":
      if(MOTOR=="MySql"){
        $campo.=" double ";
        if($datos_campo["longitud"]){
          $campo.=" (".intval($datos_campo["longitud"]).") ";
        }
        else{
          $campo.="";
        }  
      }
      else if(MOTOR=="Oracle"){
        $campo.=" FLOAT ";
        if($datos_campo["longitud"]){
          $campo.=" (".intval($datos_campo["longitud"]).") ";
        }
        else{
          $campo.="";
        }          
      }
      if($datos_campo["predeterminado"]){
        $campo.=" DEFAULT '".intval($datos_campo["predeterminado"])."' ";
      }      
    break;
    case "CHAR":
        $campo.=" char ";
        if($datos_campo["longitud"]){
          $campo.=" (".maximo_valor(intval($datos_campo["longitud"]),255).") ";
        }
        else{
          $campo.=" (10) ";
        }  
      if($datos_campo["predeterminado"]){
        $campo.=" DEFAULT '".maximo_valor(intval($datos_campo["predeterminado"]),255)."' ";
      }
    break;
    case "VARCHAR":
      if(MOTOR=="MySql"){
        $campo.=" varchar ";
        if($datos_campo["longitud"]){
          $campo.=" (".maximo_valor(intval($datos_campo["longitud"]),255).") ";
        }
        else{
          $campo.=" (255) ";
        }  
      }
      else if(MOTOR=="Oracle"){
        $campo.=" VARCHAR2 ";
        if($datos_campo["longitud"]){
          $campo.=" (".maximo_valor(intval($datos_campo["longitud"]),40000).") ";
        }
        else{
          $campo.=" (255) ";
        }          
      }
      if($datos_campo["predeterminado"]){
        $campo.=" DEFAULT '".intval($datos_campo["predeterminado"])."' ";
      }
    break;
    case "TEXT":
      if(MOTOR=="MySql"){
        $campo.=" text ";
      }
      else if(MOTOR=="Oracle"){
        if($datos_campo["longitud"]<=4000)
          $campo.=" VARCHAR2(".intval($datos["longitud"]).")";
        else{ 
          $campo.=" BLOB ";
          $campo.=" DEFAULT EMPTY_BLOB()";
        }  
      }
    break;
    /*Pilas falta organizar bien lo de las fechas*/
    case "DATE":
      if(MOTOR=="MySql"){
        $campo.=" date ";
        if(strtolower($datos_campo["predeterminado"])=="now");
/*        else if($datos_campo["predeterminado"]<>"")
          $campo.=" DEFAULT '".$datos_campo["predeterminado"]."'";
        else
        $campo.=" DEFAULT '0000-00-00'";*/
      }
      else if(MOTOR=="Oracle"){
        $campo.=" DATE ";
        //if(strtolower($datos_campo["predeterminado"])=="now"){
          $campo.=" DEFAULT  SYSDATE";
        /*}
        else if($datos_campo["predeterminado"]<>"")
          $campo.=" DEFAULT '".$datos_campo["predeterminado"]."'";
        else $campo.=" DEFAULT TO_DATE('0000-00-00','yyyy-mm-dd')";*/
      }
    break;
    case "TIME":
    if(MOTOR=="MySql"){
        $campo.=" time ";
      }
      else if(MOTOR=="Oracle"){
        $campo.=" varchar2 DEFAULT to_char(sysdate,'hh24:mi:ss') ";
      }
    break;
    case "DATETIME":
     if(MOTOR=="MySql"){
        $campo.=" DATETIME ";
      }
      else if(MOTOR=="Oracle"){
        $campo.=" DATE ";
          $campo.=" DEFAULT  SYSDATE";
      }
    break;
    case "BLOB":
      if(MOTOR=="MySql"){
        $campo.=" blob ";
      }
      else if(MOTOR=="Oracle"){
        $campo.=" BLOB ";
        $campo.=" DEFAULT EMPTY_BLOB()";
      }      
    break;
    default:
      if(MOTOR=="MySql"){
        $campo.=" int ";
        if($datos_campo["longitud"]){
          $campo.=" (".intval($datos_campo["longitud"]).") ";
        }
        else{
          $campo.=" (11) ";
          $sql="UPDATE campos_formato SET longitud=11 WHERE idcampos_formato=".$datos_campo["idcampos_formato"];
          ejecuta_sql($sql,$conn);
        }  
      }
      else if(MOTOR=="Oracle"){
        $campo.=" NUMBER ";
        if($datos_campo["longitud"]){
          $campo.=" (".intval($datos_campo["longitud"]).") ";
        }
        else{
          $campo.=" (11) ";
          $sql="UPDATE campos_formato SET longitud=11 WHERE idcampos_formato=".$datos_campo["idcampos_formato"];
          ejecuta_sql($sql,$conn);
        }          
      }
      if($datos_campo["predeterminado"]){
        $campo.=" DEFAULT '".intval($datos_campo["predeterminado"])."' ";
      }
    break;
  }
  if($estructura_campo["nulo"]<>$datos_campo["obligatoriedad"]){
    if(!$datos_campo["obligatoriedad"] ){
      $campo.=" NULL ";
    }
    else {
      $campo.=" NOT NULL ";
    }
  }
 return($campo);  
} 

function maximo_valor($valor,$maximo){
  if($valor>$maximo || $valor=="NULL")
    return($maximo);
  else return($valor);  
}

function crear_formato_mostrar($idformato,$tipo="mostrar"){
  global $sql,$conn;
  $formato=busca_filtro_tabla("*","formato A","A.idformato=".$idformato,"",$conn);
  $includes='';
  $texto='';
  $enlace="";
  if($formato["numcampos"]){
    //$datos=busca_filtro_tabla("","campos_formato","etiqueta_html LIKE 'detalle' AND valor=".$idformato,"",$conn);
    
    if(strpos($formato[0]["banderas"],"nd")!==false){
      //$enlace='<a href="detalles_'.$formato[0]["ruta_mostrar"].'?idformato='.$idformato.'&iddoc=<?php echo($_REQUEST["iddoc"]); ?'.'>" target="centro"> Detalles</a>';
    if(strpos($formato[0]["banderas"],"acordeon")!==false){
      $texto.='<frameset cols="410,*" >';
      $texto.='<frame name="formato_detalles" id="formato_detalles" src="../librerias/formato_detalles.php?idformato='.$idformato.'&iddoc=<?php echo($_REQUEST['."'"."iddoc"."'".']); ? >" marginwidth="0" marginheight="0" scrolling="no" >';
    }
    else{
      $texto.='<frameset cols="250,*" >';
      $texto.='<frame name="formato_detalles" id="formato_detalles" src="../arboles/arbolformato_documento.php?idformato='.$idformato.'&iddoc=<?php echo($_REQUEST['."'"."iddoc"."'".']); ? >" marginwidth="0" marginheight="0" scrolling="auto" >';
    }
  $texto.='
  <frame name="detalles" src="" border="0" marginwidth="20px" marginheight="10" scrolling="auto">
</frameset>';
      $contenido_detalles=$texto;
      if(!crear_archivo($formato[0]["nombre"]."/detalles_".$formato[0]["ruta_mostrar"],$contenido_detalles)){
        alerta("No es posible crear el Archivo de detalles",'error',4000);
      }
      $texto='';
      $includes.=incluir_libreria("estilo.css","estilos");
    }
    $texto.='<tr><td>';
    $texto.=$formato[0]["cuerpo"];
    $texto.='</td></tr>';
    $includes.='<?php $idformato='.$formato[0]["idformato"].' ?'.'>';
    $librerias=array();
    $lfunciones=array();
    $funciones=busca_filtro_tabla("*","funciones_formato A","A.formato LIKE '".$idformato."' OR A.formato LIKE '%,".$idformato.",%' OR A.formato LIKE '%,".$idformato."' OR A.formato LIKE '".$idformato.",%' AND A.acciones LIKE '%m%'","",$conn);
    $campos=busca_filtro_tabla("*","campos_formato A","A.formato_idformato=".$idformato,"",$conn);
    $lcampos=extrae_campo($campos,"nombre","U");
    for($i=0;$i<$campos["numcampos"];$i++){
      switch($campos[$i]["etiqueta_html"]){
        case "autocompletar":
          $parametros=explode(";",$campos[$i]["valor"]);
          $texto=str_replace("{*".$campos[$i]["nombre"]."*}","<?php busca_campo("."'".$parametros[0]."','".$parametros[1]."','".$parametros[2]."',mostrar_valor_campo('".$campos[$i]["nombre"]."','".$idformato."',$"."_REQUEST['iddoc'],1)); ?".">",$texto);
        break;
        case "archivo":
          $includes.=incluir_libreria("funciones_archivo.php","librerias");
          $includes.=incluir_libreria("funciones_formatos.js","javascript");
          $texto=str_replace("{*".$campos[$i]["nombre"]."*}","<?php listar_anexos('".$campos[$i]["idcampos_formato"]."','".$idformato."',$"."_REQUEST['iddoc'],0); ?".">",$texto);
        break;
        default:
          $texto=str_replace("{*".$campos[$i]["nombre"]."*}",arma_funcion("mostrar_valor_campo","'".$campos[$i]["nombre"]."',$idformato","mostrar"),$texto);
        break;
        case "item":
          $texto=str_replace("{*listado_detalles_".str_replace("id","",$campos[$i]["nombre"])."*}",arma_funcion("buscar_listado_formato","'".$formato[0]["nombre"]."',".$campos[$i]["valor"],"mostrar"),$texto);
        break;
        case "arbol":
          //$texto=str_replace("{*".$campos[$i]["nombre"]."*}",$campo[$i]["valor"],$texto);
          //$texto.='<div id="seleccionados">'.arma_funcion("mostrar_seleccionados",$idformato.",".$campos[$h]["idcampos_formato"],"mostrar").'</div>';
          $nombre_funcion=str_replace("*}","",str_replace("{*","",$campos[$i]["valor"]));
          
          $texto=str_replace("{*".$campos[$i]["nombre"]."*}",arma_funcion('mostrar_seleccionados',$formato[0]["idformato"].','.$campos[$i]["idcampos_formato"],"mostrar"),$texto);
          //die($texto);
          //array_push($lfunciones,$nombre_funcion);
        break;
      }
    }
    $lfunciones=array();

    for($i=0;$i<$funciones["numcampos"];$i++)
    { 
      $ruta_orig="";  
      $formato_orig=explode(",",$funciones[$i]["formato"]);
      if($formato_orig[0]!=$idformato )
           {//busco el nombre del formato inicial
            $dato_formato_orig=busca_filtro_tabla("nombre","formato","idformato=".$formato_orig[0],"",$conn);
            if($dato_formato_orig["numcampos"]&& ($dato_formato_orig[0]["nombre"]<>$formato[0]["nombre"]))
                {
                $eslibreria=strpos($funciones[$i]["ruta"],"../librerias/");
                if($eslibreria===false){
                  $eslibreria=strpos($funciones[$i]["ruta"],"../class_transferencia");
                }
                 //si el archivo existe dentro de la carpeta del archivo inicial
                 if(is_file($dato_formato_orig[0]["nombre"]."/".$funciones[$i]["ruta"]) && $eslibreria===false)
                    {$includes.=incluir("../".$dato_formato_orig[0]["nombre"]."/".$funciones[$i]["ruta"],"librerias");
                    }
                 elseif(is_file($funciones[$i]["ruta"]) && $eslibreria===false)
                    {//si el archivo existe en la ruta especificada partiendo de la raiz

                     $includes.=incluir("../".$funciones[$i]["ruta"],"librerias");
                    }
                 else if($eslibreria===false)//si no existe en ninguna de las dos
                    {//trato de crearlo dentro de la carpeta del formato actual
                     alerta("Las funciones del Formato ".$dato_formato_orig[0]["nombre"]."/".$funciones[$i]["ruta"]." son requeridas  no se han encontrado",'error',4000);
                     if(crear_archivo($dato_formato_orig[0]["nombre"]."/".$funciones[$i]["ruta"]))
                        {
                          $includes.=incluir($dato_formato_orig[0]["nombre"]."/".$funciones[$i]["ruta"],"librerias");
                        }
                     else alerta("No es posible generar el archivo ".$dato_formato_orig[0]["nombre"]."/".$funciones[$i]["ruta"],'error',4000);
                    }
                }
           }
        else //$ruta_orig=$formato[0]["nombre"]; 
           {//si el archivo existe dentro de la carpeta del formato actual
                 if(is_file($formato[0]["nombre"]."/".$funciones[$i]["ruta"]))
                    {
                     $includes.=incluir($funciones[$i]["ruta"],"librerias");
                    }
                 elseif(is_file($funciones[$i]["ruta"]))
                    {//si el archivo existe en la ruta especificada partiendo de la raiz
                     $includes.=incluir("../".$funciones[$i]["ruta"],"librerias");
                    }   
                 else//si no existe en ninguna de las dos
                    {//trato de crearlo dentro de la carpeta del formato actual
                     if(crear_archivo($formato[0]["nombre"]."/".$funciones[$i]["ruta"]))
                        {
                          $includes.=incluir($funciones[$i]["ruta"],"librerias");
                        } 
                     else alerta("No es posible generar el archivo ".$formato[0]["nombre"]."/".$funciones[$i]["ruta"],'error',4000);
                    } 
           } 
      if(!in_array($funciones[$i]["nombre_funcion"],$lfunciones)){
        if($funciones[$i]["parametros"]<>"")
           $parametros=$idformato.",".$funciones[$i]["parametros"];
        else
           $parametros=$idformato;
          if(strpos($funciones[$i]["acciones"],"m")!==false)
            $texto=str_replace($funciones[$i]["nombre"],arma_funcion($funciones[$i]["nombre_funcion"],$parametros,"mostrar"),$texto);
          else
            $texto=str_replace($funciones[$i]["nombre"],"",$texto);
      }
    }
    if($tipo=="eliminar"){
      $includes.=incluir_libreria("funciones_eliminar.php","librerias");
      $texto.='<tr>
                <td>
                  <form action="../librerias/funciones_eliminar.php" method="post"><input type="hidden" name="ejecutar" value="1">
                    <input type="hidden" name="ejecutar" value="1">
                    <input type="hidden" name="idformato" value="<?php echo(@$_REQUEST["idformato"]);?'.'>">
                    <input type="hidden" name="iddoc" value="<?php echo(@$_REQUEST["iddoc"]);?'.'>">
                    <input type="hidden" name="llave" value="<?php echo(@$_REQUEST["llave"]);?'.'>">
                    <input type="submit" value="Confirmar Borrado">
                  </form>
                </td>
              </tr>
              <tr>';
    }
    if($formato[0]["librerias"] && $formato[0]["librerias"]<>""){
      $includes.=incluir($formato[0]["librerias"],"librerias",1);
    }
    $includes.=incluir_libreria("funciones_generales.php","librerias");
    $includes.=incluir_libreria("header.php","librerias");
    $includes.=incluir("../../class_transferencia.php","librerias");
    $includes.=incluir_libreria("estilo.css","estilos");
    $contenido=$includes.$texto.$enlace.incluir_libreria("footer.php","librerias");
    if($tipo=="eliminar"){
      $mostrar=crear_archivo($formato[0]["nombre"]."/eliminar_".$formato[0]["nombre"].".php",$contenido);
    }
    else{
      $mostrar=crear_archivo($formato[0]["nombre"]."/".$formato[0]["ruta_mostrar"],$contenido);
    }
    if($mostrar<>"")
      alerta("Formato Creado con exito por favor verificar la carpeta ".dirname($mostrar),'success',4000);   
  }
  else alerta("No es posible generar el Formato",'error',4000);  
}

function crear_formato_ae($idformato,$accion){
  global $sql,$conn;
  $datos_detalles["numcampos"]=0;
  $texto="";
  $includes="";
  $obligatorio="";
  $formato=busca_filtro_tabla("*","formato A","A.idformato=".$idformato,"",$conn);
  if($formato["numcampos"]){
  if($formato[0]["item"])
      {$action='../librerias/funciones_item.php';
      }
  elseif($formato[0]["detalle"])
      {$action='../librerias/funciones_detalle.php';
      }
  else
      $action='../../class_transferencia.php';   
    $texto.='<body bgcolor="#F5F5F5" ><form name="formulario_formato" id="formulario_formatos" method="post" action="'.$action.'" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" class="tabla_borde" border="1">';
  
  if(!$formato[0]["item"])
     {$texto.='<tr><td colspan="2" class="encabezado_list">'.strtoupper($formato[0]["etiqueta"]).'<?php datos_documento(@$_REQUEST["iddoc"]); ?'.'></td></tr>';
     }  
    $librerias=array();
    if($formato[0]["librerias"] && $formato[0]["librerias"]<>""){
      $includes.=incluir($formato[0]["librerias"],"librerias",1);
    }
    $includes.=incluir_libreria("funciones_generales.php","librerias");
    $includes.=incluir_libreria("estilo.css","estilos");
    $includes.=incluir_libreria("funciones_formatos.js","javascript");
    $includes.=incluir("../../js/jquery.js","javascript");
    if($formato[0]["estilos"] && $formato[0]["estilos"]<>""){
      $includes.=incluir($formato[0]["estilos"],"estilos",1);
    }
    if($formato[0]["javascript"] && $formato[0]["javascript"]<>""){
      $includes.=incluir($formato[0]["javascript"],"javascript",1);
    }
    $arboles=0;
    $dependientes=0;
    $mascaras=0;
    $textareas=0;
    $autocompletar=0;
    $fecha=0;
    $archivo=0;
    $lista_enmascarados="";
    $formato_enlace=0;
    $lista_formato_enlace="";
    $listado_campos=array();
    $unico=array(); 
    $campos=busca_filtro_tabla("*","campos_formato A","A.acciones like '%".$accion[0]."%' and A.formato_idformato=".$idformato,"orden ASC",$conn);
    //funciones creadas para el formato, pero que corresponden a nombres de campos
    $fun_campos=array();
    for($h=0;$h<$campos["numcampos"];$h++)
    {
     if($campos[$h]["etiqueta_html"]=="arbol")
        $arboles=1;
     elseif($campos[$h]["etiqueta_html"]=="textarea")
        $textareas=1;
     if($campos[$h]["obligatoriedad"]){     
        $obligatorio='obligatorio="obligatorio"';
        $obliga="*";
     }   
     else{
        $obligatorio='obligatorio=""';
        $obliga="";  
     }  
     if($campos[$h]["banderas"]!=""){
        $bandera_unico=strpos("u",$campos[$h]["banderas"]);
        if($bandera_unico!==false){
          array_push($unico,array($campos[$h]["nombre"],$campos[$h]["idcampos_formato"]));        
          $obligatorio='obligatorio="obligatorio"';
          $obliga="(*)";
        }     
     }              
     if(strpos($campos[$h]["valor"],"*}")>0)
         {$nombre_func=str_replace("{*","",$campos[$h]["valor"]);
          $nombre_func=str_replace("*}","",$nombre_func);
          $texto.='<tr>
                     <td class="encabezado" width="20%" title="'.$campos[$h]["ayuda"].'">'.strtoupper($campos[$h]["etiqueta"]).$obliga.'</td>
                     ';   
          $parametros="$idformato,".$campos[$h]["idcampos_formato"];       
          $texto.=arma_funcion($nombre_func,$parametros,$accion)."</tr>";  
          array_push($fun_campos,$nombre_func);
         }
     else    
         {        
           if($accion=='adicionar')
               $valor='<?php echo(validar_valor_campo('.$campos[$h]["idcampos_formato"].')); ? >';
           elseif($accion=="editar")
               {if($formato[0]["detalle"])
                   $valor="<?php echo(mostrar_valor_campo('".$campos[$h]["nombre"]."',$idformato,$"."_REQUEST['item'])); ? >";
                else
                   $valor="<?php echo(mostrar_valor_campo('".$campos[$h]["nombre"]."',$idformato,$"."_REQUEST['iddoc'])); ? >";
               }
           switch($campos[$h]["etiqueta_html"])
           {
              case "password":
                $texto.='<tr>
                     <td class="encabezado" width="20%" title="'.$campos[$h]["ayuda"].'">'.strtoupper($campos[$h]["etiqueta"]).$obliga.'</td>
                     <td class="celda_transparente"><input type="password" name="'.$campos[$h]["nombre"].'" '.$obligatorio.' value="'.$valor.'"></td>
                    </tr>';                  
              break;
              case "textarea":
                $texto.='<tr>
                     <td class="encabezado" width="20%" title="'.$campos[$h]["ayuda"].'">'.strtoupper($campos[$h]["etiqueta"]).$obliga.'</td>
                     <td class="celda_transparente"><textarea name="'.$campos[$h]["nombre"].'" '.$obligatorio.' cols="53" rows="3">'.$valor.'</textarea></td>
                    </tr>';   
                $textareas++;         
              break;
              case "fecha":
                if($campos[$h]["tipo_dato"]=="DATE"){
                  $texto.='<tr>
                       <td class="encabezado" width="20%" title="'.$campos[$h]["ayuda"].'">'.strtoupper($campos[$h]["etiqueta"]).$obliga.'</td><td colspan="2" class="celda_transparente"><span class="phpmaker"><input type="text" name="'.$campos[$h]["nombre"].'" id="'.$campos[$h]["nombre"].'" tipo="fecha" value="';
                  if($accion=="adicionar"){      
                    if($campos[$h]["predeterminado"]=="now()")
                      $texto.='<?php echo(date("Y-m-d")); ?'.'>';
                    else 
                      $texto.='<?php echo(date("0000-00-00")); ?'.'>';
                  }   
                  else                     
                    $texto.="<?php mostrar_valor_campo('".$campos[$h]["nombre"]."',$idformato,$"."_REQUEST['iddoc']); ?".">";	
                  $texto.='"><?php selector_fecha("'.$campos[$h]["nombre"].'","formulario_formato","Y-m-d","'.date('m').'","'.date('Y').'","ceramique.css","../../","AD:VALOR"); ?'.'></span></font></td>';                             
                  $fecha++;
                  $mascaras++;
                  $lista_enmascarados.="
                    $('#".$campos[$h]["nombre"]."').mask('9999-99-99',{
                        completed:function(){
                          $.ajax({
                            type:'POST',
                            url:'../librerias/validar_fecha.php',
                            data:'formato=%Y-%m-%d&valor='+this.val(),
                            success: function(datos,exito){
                              if(datos==0){
                                alert('Fecha no valida');
                                this.focus();
                              }  
                            }
                          });                        
                        }
                      });";
                }
                else if($campos[$h]["tipo_dato"]=="DATETIME"){                                   
                  $texto.='<tr>
                    <td class="encabezado" width="20%" title="'.$campos[$h]["ayuda"].'">'.strtoupper($campos[$h]["etiqueta"]).$obliga.'</td><td class="celda_transparente"><input type="text" name="'.$campos[$h]["nombre"].'" id="'.$campos[$h]["nombre"].'" value="';
                  if($accion=="adicionar"){
                    if($campos[$h]["predeterminado"]=="now()")
                      $texto.='<?php echo(date("Y-m-d H:i:s")); ?'.'>';
                    else 
                      $texto.='<?php echo(date("0000-00-00 00:00:00")); ?'.'>';  
                  }   
                  else
                    $texto.="<?php mostrar_valor_campo('".$campos[$h]["nombre"]."',$idformato,$"."_REQUEST['iddoc']); ?".">";	
                  $texto.='"><?php selector_fecha("'.$campos[$h]["nombre"].'","formulario_formato","Y-m-d H:i","'.date('m').'","'.date('Y').'","ceramique.css","../../","AD:VALOR"); ?'.'></td>';
                  $fecha++;
                  $mascaras++;
                  $lista_enmascarados.="
                    $('#".$campos[$h]["nombre"]."').mask('9999-99-99 99:99',{
                        completed:function(){
                          $.ajax({
                            type:'POST',
                            url:'../librerias/validar_fecha.php',
                            data:'formato=%Y-%m-%d %H:%s:00&valor='+this.val()+':00',
                            success: function(datos,exito){
                              if(datos==0){
                                alert('Fecha no valida');
                                this.focus();
                              }  
                            }
                          });                        
                        }
                      });";
                }
                else alerta("No esta definido su formato de Fecha",'error',4000);                                                                         
              break;              
              case "radio":
              /* En los campos de este tipo se debe validar que valor contenga un listado con las siguentes caracteristicas*/
                $texto.='<tr>
                     <td class="encabezado" width="20%" title="'.$campos[$h]["ayuda"].'">'.strtoupper($campos[$h]["etiqueta"]).$obliga.'</td>';  
                /*if($accion=='adicionar')
                   {$texto.='<td class="celda_normal"><?php echo genera_campo_listados('.$campos[$h]["idcampos_formato"].'); ?'.'></td></tr>';
                   } 
                if($accion=='editar')*/
                   $texto.='<td class="celda_transparente">'.arma_funcion("genera_campo_listados_editar",$idformato.",".$campos[$h]["idcampos_formato"],'editar').'</td></tr>';
              break;        
              case "checkbox":
                $texto.='<tr>
                  <td class="encabezado" width="20%" title="'.$campos[$h]["ayuda"].'">'.strtoupper($campos[$h]["etiqueta"]).$obliga.'</td>';
                /*if($accion=='adicionar'){
                  $texto.='<td class="celda_normal"><?php echo genera_campo_listados('.$campos[$h]["idcampos_formato"].'); ?'.'></td></tr>';
                }               
                if($accion=='editar')*/
                  $texto.='<td class="celda_transparente">'.arma_funcion("genera_campo_listados_editar",$idformato.",".$campos[$h]["idcampos_formato"],'editar').'</td></tr>';
              break;
              case "select":
                $texto.='<tr>
                     <td class="encabezado" width="20%" title="'.$campos[$h]["ayuda"].'">'.strtoupper($campos[$h]["etiqueta"]).$obliga.'</td>';
                /*if($accion=='adicionar')
                   $texto.='<td class="celda_normal"><?php echo genera_campo_listados('.$campos[$h]["idcampos_formato"].'); ?'.'></td></tr>';
                if($accion=='editar')*/
                   $texto.='<td class="celda_transparente">'.arma_funcion("genera_campo_listados_editar",$idformato.",".$campos[$h]["idcampos_formato"],'editar').'</td></tr>';
              break;
              case "dependientes":
              //parametros: 0-idcampo padre; 1-consulta sql; 2-order by
                $parametros=explode(";",$campos[$h]["valor"]);
                $padre=busca_filtro_tabla("","campos_formato","idcampos_formato=".$parametros[0],"",$conn);
                $datos_padre=ejecuta_filtro_tabla($padre[0]["valor"],$conn);
                $texto.="<script>var c_".$campos[$h]["nombre"]." = new DynamicOptionList();
                 c_".$campos[$h]["nombre"].".addDependentFields('".$padre[0]["nombre"]."','".$campos[$h]["nombre"]."');</script>";
                $texto.='<tr>
                     <td class="encabezado" width="20%" title="'.$campos[$h]["ayuda"].'">'.strtoupper($campos[$h]["etiqueta"]).$obliga.'</td><?php echo genera_campo_listados('.$campos[$h]["idcampos_formato"].'); ?'.'>';
                if($accion=='adicionar')
                   {$texto.='<td class="celda_transparente">
                            <select name="'.$campos[$h]["nombre"].'" id="'.$campos[$h]["nombre"].'">
                            <option value="">Seleccionar...</option>
                            <script type="text/javascript"> c_'.$campos[$h]["nombre"].'.printOptions("'.$padre[0]["nombre"].'");</script>
                            </select></td></tr>'; 
                    }        
                if($accion=='editar')
                   $texto.='<td class="celda_transparente"></td></tr>';
                $dependientes++;                          
              break;
              case "archivo":
              //
                $texto.='<tr>
                     <td class="encabezado" width="20%" title="'.$campos[$h]["ayuda"].'">'.strtoupper($campos[$h]["etiqueta"]).$obliga.'</td>
                     <td class="celda_transparente">';
                $texto.='<input type="file" name="'.$campos[$h]["nombre"].'[]" class="multi">';
                if($accion=="editar"){
                  /*SE DEBEN LISTAR TODOS LOS ANEXOS Y PERMITIR BORRARLOS CON UN AGREGA BOTON*/
                  $texto.='<?php listar_anexos('.$campos[$h]["idcampos_formato"].",".$campos[$h]["formato_idformato"].", $"."_REQUEST['iddoc'],0,1); ?".">";
                 }
                echo '</td></tr>';

                $archivo++;
              break;
              case "tarea":
                //parametros:id de la tarea
                $texto.='<tr>
                  <td class="encabezado" width="20%" title="'.$campos[$h]["ayuda"].'">'.strtoupper($campos[$h]["etiqueta"]).$obliga.'</td><td class="celda_transparente"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input type="hidden" name="tarea_'.$campos[$h]["nombre"].'" value="'.$campos[$h]["valor"].'"><input type="text" name="'.$campos[$h]["nombre"].'" id="'.$campos[$h]["nombre"].'" value="';
                if($accion=="adicionar"){
                  if($campos[$h]["predeterminado"]=="now()")
                    $texto.='<?php echo(date("Y-m-d H:i:s")); ?'.'>';
                  else
                    $texto.='<?php echo(date("0000-00-00 00:00:00")); ?'.'>';
                }
                else
                  $texto.="<?php mostrar_valor_campo('".$campos[$h]["nombre"]."',$idformato,$"."_REQUEST['iddoc']); ?".">";
                $texto.='"><?php selector_fecha("'.$campos[$h]["nombre"].'","formulario_formato","Y-m-d H:i","'.date('m').'","'.date('Y').'","ceramique.css","../../","AD:VALOR"); ?'.'></span></font></td>';
                $fecha++;
                $mascaras++;
                $lista_enmascarados.="
                  $('#".$campos[$h]["nombre"]."').mask('9999-99-99 99:99',{
                      completed:function(){
                        $.ajax({
                          type:'POST',
                          url:'../librerias/validar_fecha.php',
                          data:'formato=%Y-%m-%d %H:%s:00&valor='+this.val()+':00',
                          success: function(datos,exito){
                            if(datos==0){
                              alert('Fecha no valida');
                              this.focus();
                            }
                          }
                        });
                      }
                    });";
              break;
              case "hidden":
                $texto.='<input type="hidden" name="'.$campos[$h]["nombre"].'" id="'.$campos[$h]["nombre"].'" value="'.$valor.'">';
              break;
              case "autocompletar":
                //parametros:tabla;campo_mostrar;campo_guardar
                $parametros=explode(";",$campos[$h]["valor"]);
                $texto.='<tr>
                  <td class="encabezado" width="20%" title="'.$campos[$h]["ayuda"].'">'.strtoupper($campos[$h]["etiqueta"]).$obliga.'</td>
                  <td class="celda_transparente">
                  <input type="hidden" name="'.$campos[$h]["nombre"].'" id="nombre'.$autocompletar.'" value="" >
                  <div class="celda_transparente" id="lista'.$autocompletar.'" onmouseout="v=1;" onmouseover="v=0;" >
                  <input type="text" size="53" name="mostrar'.$autocompletar.'" id="auto'.$autocompletar.'" value="" autocomplete=off onkeyup="if(Teclados(event,'.$autocompletar.') == 1){ document.getElementById('."'nombre".$autocompletar."'".').value='."''".';
                  autocompletar('.$autocompletar.',mostrar'.$autocompletar.'.value,'."'".$parametros[0]."'".','."'".$parametros[1]."'".','."'".$parametros[2]."'".'); document.getElementById('."'".'comple'.$autocompletar."'".').style.display='."'block'".';}" 
                  onkeydown = "ParaelTab(event,'.$autocompletar.');" onfocus="document.getElementById('."'comple".$autocompletar."'".').style.display='."'block'".';">
                  </div>
                  <div class="celda_transparente" id="comple'.$autocompletar.'" style="position:absolute" onmouseout="document.getElementById('."'comple".$autocompletar."'".').style.display='."'none'".';"></div>
                  </td>';   
                $autocompletar++;              
              break;
              case "etiqueta":
                $texto.='<tr>
                   <td class="encabezado" width="20%" title="'.$campos[$h]["ayuda"].'">'.strtoupper($campos[$h]["etiqueta"]).$obliga.'</td>
                   <td class="celda_transparente"><label>'.$valor.'</label><input type="hidden" name="'.$campos[$h]["nombre"].'" value="'.$valor.'"></td>
                  </tr>'; 
              break;
              case "arbol":
                /*En campss valor se deben almacenar los siguientes datos:
                arreglo[0]:ruta de el xml
                arreglo[1]=1=> checkbox;arreglo[1]=2=>radiobutton
                arreglo[2] Modo calcular numero de nodos hijo
                arreglo[3] Forma de carga 0=>autoloading; 1=>smartXML
                arreglo[4] Busqueda
                arreglo[5] Almacenar 0=>iddato 1=>valordato
                */
                $arreglo=explode(";",$campos[$h]["valor"]);
                //print_r($arreglo);
                /*print_r($campos[$h]);
                die("<br />".$campos[$h]["nombre"]."<br />".$campos[$h]["valor"]);*/
                if(isset($arreglo) && $arreglo[0]!=""){
                  $ruta="\"".$arreglo[0]."\"";
                }
                else{
                 $ruta="\"../arboles/test_dependencia.xml\"";
                 $arreglo[1]=0;
                 $arreglo[2]=0;
                 $arreglo[3]=0;
                 $arreglo[4]=1;
                }
                 $texto.='<tr>
                   <td class="encabezado" width="20%" title="'.$campos[$h]["ayuda"].'">'.strtoupper($campos[$h]["etiqueta"]).$obliga.'</td>';
                 $texto.='<td bgcolor="#F5F5F5"><div id="esperando_'.$campos[$h]["nombre"].'"><img src="../../imagenes/cargando.gif"></div>';
                 $texto.='<div id="seleccionados">'.arma_funcion("mostrar_seleccionados",$idformato.",".$campos[$h]["idcampos_formato"],"mostrar").'</div>
                          <br />  Buscar: <input type="text" id="stext_'.$campos[$h]["nombre"].'" width="200px" size="25"><br>';
                 if($arreglo[4]){
                   $texto.='<a href="javascript:void(0)" onclick="tree_'.$campos[$h]["nombre"].'.findItem(document.getElementById(\'stext_'.$campos[$h]["nombre"].'\').value,0,1)"> Buscar</a>  |
                          <a href="javascript:void(0)" onclick="tree_'.$campos[$h]["nombre"].'.findItem(document.getElementById(\'stext_'.$campos[$h]["nombre"].'\').value)"> Siguiente</a>  |
                          <a href="javascript:void(0)" onclick="tree_'.$campos[$h]["nombre"].'.findItem(document.getElementById(\'stext_'.$campos[$h]["nombre"].'\').value,1)"> Anterior</a><br /><br />
                ';
                }
                $texto.='<div id="treeboxbox_'.$campos[$h]["nombre"].'" height="90%"></div>';
                //miro si ya estan incluidas las librerias del arbol
                  $texto.= '<input type="hidden" name="'.$campos[$h]["nombre"].'" id="'.$campos[$h]["nombre"].'" ';
                  if($campos[$h]["obligatoriedad"])
                      $texto.='obligatorio="obligatorio" ';
                  else
                      $texto.='obligatorio="" ';
                  if($accion=="editar"){
                    $texto.=' value="'.arma_funcion("cargar_seleccionados",$idformato.",".$campos[$h]["idcampos_formato"].",1","mostrar").'" >';
                  }
                  else $texto.=' value="" >';
                  $texto.='<script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_'.$campos[$h]["nombre"].'=new dhtmlXTreeObject("treeboxbox_'.$campos[$h]["nombre"].'","100%","100%",0);
                			tree_'.$campos[$h]["nombre"].'.setImagePath("../../imgs/");
                			tree_'.$campos[$h]["nombre"].'.enableIEImageFix(true);';
                	if($arreglo[1]==1){
                		  $texto.='tree_'.$campos[$h]["nombre"].'.enableCheckBoxes(1);
                			tree_'.$campos[$h]["nombre"].'.enableThreeStateCheckboxes(1);';
                	}
                	else if($arreglo[1]==2){
                    $texto.='tree_'.$campos[$h]["nombre"].'.enableCheckBoxes(1);
                      tree_'.$campos[$h]["nombre"].'.enableRadioButtons(true);
                      tree_'.$campos[$h]["nombre"].'.enableThreeStateCheckboxes(1);';
                      
                  }
                  /*if($arreglo[2]){
                  	$texto.='tree_'.$campos[$h]["nombre"].'.setChildCalcMode("child");';
                  }*/
                	  $texto.='tree_'.$campos[$h]["nombre"].'.setOnLoadingStart(cargando_'.$campos[$h]["nombre"].');
                      tree_'.$campos[$h]["nombre"].'.setOnLoadingEnd(fin_cargando_'.$campos[$h]["nombre"].');';
                  if($arreglo[3]){
                    $texto.='tree_'.$campos[$h]["nombre"].'.enableSmartXMLParsing(true);';
                  }
                  else
                    $texto.='tree_'.$campos[$h]["nombre"].'.setXMLAutoLoading("'.$ruta.'");';
                  if($accion=="editar"){
                    $ruta.=",checkear_arbol";
                  }
                	$texto.='tree_'.$campos[$h]["nombre"].'.loadXML('.$ruta.');
                      tree_'.$campos[$h]["nombre"].'.setOnCheckHandler(onNodeSelect_'.$campos[$h]["nombre"].');
                      function onNodeSelect_'.$campos[$h]["nombre"].'(nodeId)
                      {valor_'.$campos[$h]["nombre"].'=document.getElementById("'.$campos[$h]["nombre"].'");
                       pos=nodeId.indexOf("_");
                       if(pos!=-1)
                        nodeId=nodeId.substr(0,pos);';
                  if($arreglo[1]==2){
                    $texto.='
                       cerrar=valor_'.$campos[$h]["nombre"].'.value;
                       tree_'.$campos[$h]["nombre"].'.setCheck(cerrar,false);
                       valor_'.$campos[$h]["nombre"].'.value=nodeId;
                      }';
                  }
                  else {
                    $texto.='
                       valor_'.$campos[$h]["nombre"].'.value=tree_'.$campos[$h]["nombre"].'.getAllChecked();
                       valor_'.$campos[$h]["nombre"].'.value+="|"+tree_'.$campos[$h]["nombre"].'.getAllPartiallyChecked();
                      }';
                  }
                  $texto.="
                      function fin_cargando_".$campos[$h]["nombre"]."() {
                        if (browserType == \"gecko\" )
                           document.poppedLayer =
                               eval('document.getElementById(\"esperando_".$campos[$h]["nombre"]."\")');
                        else if (browserType == \"ie\")
                           document.poppedLayer =
                              eval('document.getElementById(\"esperando_".$campos[$h]["nombre"]."\")');
                        else
                           document.poppedLayer =
                              eval('document.layers[\"esperando_".$campos[$h]["nombre"]."\"]');
                        document.poppedLayer.style.visibility = \"hidden\";
                      }

                      function cargando_".$campos[$h]["nombre"]."() {
                        if (browserType == \"gecko\" )
                           document.poppedLayer =
                               eval('document.getElementById(\"esperando_".$campos[$h]["nombre"]."\")');
                        else if (browserType == \"ie\")
                           document.poppedLayer =
                              eval('document.getElementById(\"esperando_".$campos[$h]["nombre"]."\")');
                        else
                           document.poppedLayer =
                               eval('document.layers[\"esperando_".$campos[$h]["nombre"]."\"]');
                        document.poppedLayer.style.visibility = \"visible\";
                      }
                	";
              if($accion=="editar"){
                $texto.="
                  function checkear_arbol(){
                  ".arma_funcion("cargar_seleccionados",$idformato.",".$campos[$h]["idcampos_formato"].",0","editar")."\n}\n";
              }
             	$texto.="--></script>";
              $texto.= '</td></tr>';
              $arboles++;
              break;
              case "detalle":
                if($accion=="adicionar"){
                  $padre=busca_filtro_tabla("nombre_tabla","formato A","idformato=".$campos[$h]["valor"],"",$conn);
                  if($padre["numcampos"]){
                    $texto.='<?php if($_REQUEST["padre"]) {?'.'><input type="hidden"  name="'.$padre[0]["nombre_tabla"].'" '.$obligatorio.' value="<?php echo $_REQUEST["padre"]; ?'.'>">'.'<?php } ?'.'>';
                    $texto.='<?php if($_REQUEST["anterior"]) {?'.'><input type="hidden"  name="'.$padre[0]["nombre_tabla"].'" '.$obligatorio.' value="<?php echo $_REQUEST["anterior"]; ?'.'>">'.'<?php }  else {listar_select_padres('.$padre[0]["nombre_tabla"].');} ?'.'>';
                  }
                }
              break;
              case "item":
                $datos_detalle=busca_filtro_tabla("","formato","idformato=".$campos[$h]["valor"],"",$conn);
                if($accion=="adicionar")
                 {$texto.='<tr>
                   <td class="encabezado" width="20%" title="'.$campos[$h]["ayuda"].'">'.strtoupper($campos[$h]["etiqueta"]).$obliga.'</td>';  
                  $texto.= '<td  class="celda_transparente"><input type="hidden" name="'.$campos[$h]["nombre"].'" id="'.$campos[$h]["nombre"].'" '.$obligatorio.' >
                 <iframe name="listar_'.$campos[$h]["nombre"].'" id="listar_'.$campos[$h]["nombre"].'"  src="../librerias/funciones_item.php?accion=vacio" width=100% height=100px class=phpmkr border=0 frameborder="0" y framespacing="0" > </iframe>';
                 }
              elseif($accion=="editar")
                 {$lista_campos= busca_filtro_tabla("nombre","campos_formato","formato_idformato=".$campos[$h]["valor"]." and acciones like '%a%' and etiqueta_html<>'hidden'","",$conn);
                  $campos_tabla=array();

                  for($cont=0;$cont<$lista_campos["numcampos"];$cont++)
                     $campos_tabla[]=$lista_campos[$cont]["nombre"];

                  $texto.='<tr>
                   <td class="encabezado" width="20%" title="'.$campos[$h]["ayuda"].'">'.strtoupper($campos[$h]["etiqueta"]).$obliga.'</td>';
                  $texto.= '<td><input type="hidden" name="'.$campos[$h]["nombre"].'" id="'.$campos[$h]["nombre"].'" '.$obligatorio.' value="<?php echo(mostrar_valor_campo("'.$campos[$h]["nombre"].'",'.$idformato.',$'.'_REQUEST["iddoc"])); ?'.'>">
                 <iframe name="listar_'.$campos[$h]["nombre"].'" id="listar_'.$campos[$h]["nombre"].'" src="../librerias/funciones_item.php?accion=listar_item&tabla='.$datos_detalle[0]["nombre_tabla"].'&campos='.implode(",",$campos_tabla).'&campo='.$campos[$h]["nombre"].'&formato='.$datos_detalle[0]["nombre"].'&padre='.$campos[$h]["nombre"].'&seleccionados=<?php echo mostrar_valor_campo("'.$campos[$h]["nombre"].'",'.$idformato.',$'.'_REQUEST["iddoc"]); ?'.'>" width=100% height=100px class=phpmkr border=0 frameborder="0" y framespacing="0">
                  </iframe>';
                 }  
                  $texto.='<?php $anterior=""; if(@$_REQUEST["anterior"]) $anterior="&anterior=".$_REQUEST["anterior"]; ?'.'><iframe name="frame_'.$campos[$h]["nombre"].'" id="frame_'.$campos[$h]["nombre"].'" src="../librerias/funciones_item.php?accion=llamar_pagina&direccion=<?php echo urlencode("../'.$datos_detalle[0]["nombre"]."/adicionar_".$datos_detalle[0]["nombre"].'.php?padre='.$campos[$h]["nombre"].'$anterior"); ?'.'>';
                  $texto.= '" width=100% height=190px class=phpmkr border=0 frameborder="0" y framespacing="0">
                  </iframe>
                       </td>'; 
                  $texto.='</tr>'; 
              break;
              case "enlace_formato":
              /* Se debe enviar un arreglo con las siguientes caracteristicas :
              arreglo[0]=enlace formato 1->SI 0->NO
              arreglo[1]=idformato o url;
              */
              $relleno=$campos[$h]["valor"];
              if($relleno!=""){
                $arr_relleno=explode(";",$relleno);
                if($arr_relleno[0]){
                  $formato_enlazado=busca_filtro_tabla("A.nombre AS nombre_formato,A.ruta_adicionar,B.*","formato A,campos_formato B","A.idformato=B.formato_idformato AND A.idformato=".$arr_relleno[0],"",$conn);
                  if($formato_enlazado["numcampos"]){
                    $ruta='../'.$formato_enlazado[0]["nombre_formato"]."/".$formato_enlazado[0]["ruta_adicionar"]."?retornar_campo=".$campos[$h]["nombre"];
                  }
                }
                else
                  $ruta=$arr_relleno[1];
                $texto.='<tr>
                         <td class="encabezado" width="20%" title="'.$campos[$h]["ayuda"].'">'.strtoupper($campos[$h]["etiqueta"]).$obliga.'</td>
                         <td class="celda_transparente"><input type="text" size="'.$maximo.'"  maxleng="'.$campos[$h]["longitud"].'" id="'.$campos[$h]["nombre"].'" name="'.$campos[$h]["nombre"].'" '.$obligatorio.' value="'.$valor.'">
                         <a href="'.$ruta.'" onclick="'."return hs.htmlExpand(this, { objectType: 'iframe' } )".'"><img src="../../botones/formatos/adicionar.gif" target="_top"></a>
                        </td>
                        </tr>';
                $formato_enlace++;
              }
              break;
              default: //text
                $maximo=maximo_valor($campos[$h]["longitud"],"100");
                $texto.='<tr>
                     <td class="encabezado" width="20%" title="'.$campos[$h]["ayuda"].'">'.strtoupper($campos[$h]["etiqueta"]).$obliga.'</td>
                     <td class="celda_transparente"><input type="text" size="'.$maximo.'"  maxleng="'.$campos[$h]["longitud"].'" id="'.$campos[$h]["nombre"].'" name="'.$campos[$h]["nombre"].'" '.$obligatorio.' value="'.$valor.'"></td>
                    </tr>';
                if($campos[$h]["mascara"]!=""){
                  $mascaras++;
                  $lista_enmascarados.="$('#".$campos[$h]["nombre"]."').mask('".$campos[$h]["mascara"]."');";      
                }   
              break;
        }  
       }   
       array_push($listado_campos,"'".$campos[$h]["nombre"]."'");
    }
//******************************************************************************************
    $wheref="(A.formato LIKE '".$idformato."' OR A.formato LIKE '%,".$idformato.",%' OR A.formato LIKE '%,".$idformato."' OR A.formato LIKE '".$idformato.",%') AND A.acciones LIKE '%".strtolower($accion[0])."%'";
    if(count($listado_campos)){
      $wheref.="AND nombre_funcion NOT IN(".implode(",",$listado_campos).")";
    }
    $funciones=busca_filtro_tabla("*","funciones_formato A",$wheref,"idfunciones_formato asc",$conn);

    for($i=0;$i<$funciones["numcampos"];$i++)
    { 
         $ruta_orig="";  
         //saco el primer formato de la lista de la funcion (formato inicial)
         $formato_orig=explode(",",$funciones[$i]["formato"]);
         //si el formato actual es distinto del formato inicial
         if($formato_orig[0]!=$idformato)
           {//busco el nombre del formato inicial
            $dato_formato_orig=busca_filtro_tabla("nombre","formato","idformato=".$formato_orig[0],"",$conn);
            if($dato_formato_orig["numcampos"])
                {
                 // $ruta_orig=$dato_formato_orig[0]["nombre"];
                 //si el archivo existe dentro de la carpeta del archivo inicial
                 if(is_file($dato_formato_orig[0]["nombre"]."/".$funciones[$i]["ruta"]))
                    {$includes.=incluir("../".$dato_formato_orig[0]["nombre"]."/".$funciones[$i]["ruta"],"librerias");
                    }
                 elseif(is_file($funciones[$i]["ruta"]))
                    {//si el archivo existe en la ruta especificada partiendo de la raiz
                     $includes.=incluir("../".$funciones[$i]["ruta"],"librerias");
                    }   
                 else//si no existe en ninguna de las dos
                    {//trato de crearlo dentro de la carpeta del formato actual
                     if(crear_archivo($formato[0]["nombre"]."/".$funciones[$i]["ruta"]))
                        {
                          $includes.=incluir($funciones[$i]["ruta"],"librerias");
                        } 
                     else alerta("No es posible generar el archivo ".$formato[0]["nombre_tabla"]."/".$funciones[$i]["ruta"],'error',4000);  
                    }   
                }
           } 
        else //$ruta_orig=$formato[0]["nombre"]; 
           {//si el archivo existe dentro de la carpeta del formato actual
                 if(is_file($formato[0]["nombre"]."/".$funciones[$i]["ruta"]))
                    {$includes.=incluir($funciones[$i]["ruta"],"librerias");
                    }
                 elseif(is_file($funciones[$i]["ruta"]))
                    {//si el archivo existe en la ruta especificada partiendo de la raiz
                     $includes.=incluir("../".$funciones[$i]["ruta"],"librerias");
                    }   
                 else//si no existe en ninguna de las dos
                    {//trato de crearlo dentro de la carpeta del formato actual
                     if(crear_archivo($formato[0]["nombre"]."/".$funciones[$i]["ruta"]))
                        {
                          $includes.=incluir($funciones[$i]["ruta"],"librerias");
                        } 
                     else alerta("No es posible generar el archivo ".$formato[0]["nombre_tabla"]."/".$funciones[$i]["ruta"],'error',4000);  
                       
                    } 
           } 
       if(!in_array($funciones[$i]["nombre_funcion"],$fun_campos))      
         {$parametros="$idformato,NULL";    
          $texto.=arma_funcion($funciones[$i]["nombre_funcion"],$parametros,$accion);
         } 
    }
    //******************************************************************************************  
    $campo_descripcion = busca_filtro_tabla("","campos_formato","formato_idformato=".$idformato." AND acciones LIKE '%p%'","",$conn);
    if($campo_descripcion["numcampos"]){
     if($accion=='adicionar')
       $valor=$campo_descripcion[0]["idcampos_formato"];
     elseif($accion=="editar")
     {if($formato[0]["detalle"])
         $valor="<?php echo(".$campo_descripcion[0]["idcampos_formato"]."); ? >";
      else
         $valor="<?php echo(".$campo_descripcion[0]["idcampos_formato"]."); ? >";
     }
      $texto.='<input type="hidden" name="campo_descripcion" value="'.$valor.'">';
    } 
    else alerta("Recuerde asignar el campo que sera almacenado como descripcion del documento",'error',4000);     
    if($accion=="editar")
       $texto.='<input type="hidden" name="formato" value="'.$idformato.'">';
    if($formato[0]["detalle"])
       {
        $texto.='<input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?'.'>">';
        $texto.='<input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?'.'>">';
        if($accion=="adicionar"){
             $texto.='<input type="hidden" name="accion" value="guardar_detalle" >';
        }      
        elseif($accion=="editar")
             {$texto.='<input type="hidden" name="accion" value="editar" >';      
              $texto.='<input type="hidden" name="item" value="<?php echo $_'.'REQUEST["item"]; ?'.'>" >'; 
              $texto.='<input type="hidden" name="anterior" value="<?php echo $_'.'REQUEST["campo"]; ?'.'>" >'; 
             }
       } 
    if($formato[0]["item"])
       {$texto.='<input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?'.'>"><input type="hidden" name="formato" value="'.$formato[0]["nombre"].'">';
        if($accion=="adicionar"){
             $texto.='<input type="hidden" name="accion" value="guardar_item" >';
        }      
        elseif($accion=="editar")
             {$texto.='<input type="hidden" name="accion" value="editar" >';      
              $texto.='<input type="hidden" name="item" value="<?php echo $_'.'REQUEST["item"]; ?'.'>" >'; 
              $texto.='<input type="hidden" name="anterior" value="<?php echo $_'.'REQUEST["campo"]; ?'.'>" >'; 
             }
       }    
    $texto.="<tr><td colspan='2'>".arma_funcion("submit_formato_plantilla",$idformato,$accion);
    $texto.='</td></tr></table></form></body>';
    $includes.=incluir("../../js/title2note.js","javascript");
    if($arboles){
      $includes.=incluir("../../js/dhtmlXCommon.js","javascript");
      $includes.=incluir("../../js/dhtmlXTree.js","javascript");
      $includes.=incluir("../../css/dhtmlXTree.css","estilos");
    }
    if($autocompletar){
      $includes.=incluir("../librerias/funciones_autocompletar.js","javascript");
    }     
    if($textareas){
      $includes.=incluir_libreria("header_formato.php","librerias");
    }
    if($fecha){
      $includes.=incluir("../calendario/calendario.php","librerias");
    }
     $enmascarar.='
      <script type="text/javascript">jQuery.noConflict();(function($) {
        ';
     $enmascarar.='
        $(window).unload(function(){
 /*         validar_formato();
          if(!confirm("Desea Enviar los datos?")){
            window.location.href="#";
            alert($("form").serialize());
          }
          else{
            validar_formato();
          }*/
        });
        $(document).ready(function(){
      // run code
        '."$('#".$campos[0]["nombre"]."').focus();";
     $enmascarar.='});
        })(jQuery);
      </script>';
    $numero_unicos=count($unico);    
    if($numero_unicos){
      $listado=array();
      $enmascarar.='
        <script type="text/javascript">jQuery.noConflict();(function($) {
          $(function() {';      
      for($k;$k<$numero_unicos;$k++){
        $enmascarar.="$('#".$unico[0][0]."').blur(function(){
              $.ajax({
                type:'POST',
                url:'../librerias/validar_unico.php',
                data:'nombre=".$unico[0][0]."&valor=this.val()&tabla=".$formato[0]["nombre_tabla"]."',
                success: function(datos,exito){
                  if(datos==0){
                    alert('El campo ".$unico[0][0]." debe Ser unico');
                    $('#".$unico[0][0]."').focus();
                  }  
                }
              });
            })";       
      }
       $enmascarar.='});
          })(jQuery);
        </script>'; 
    }
    if($mascaras){
      $includes.=incluir("../../js/jquery.maskedinput.js","javascript");
      $enmascarar.='
              <script type="text/javascript">jQuery.noConflict();(function($) {
                $(function() {'.$lista_enmascarados.'});
                })(jQuery);
              </script>';   
    }
    if($archivo){
      $includes.=incluir("../../js/jquery.MultiFile.js","javascript");
      $includes.=incluir_libreria("funciones_archivo.php","librerias");
    }
    if($formato_enlace){
      $includes.=incluir("../../js/highslide-with-html.js","javascript");
      $listado_formato_enlace.='<script type="text/javascript">
    hs.graphicsDir = '."'../../images/highslide/'
    hs.outlineType = 'rounded-white';
    hs.outlineWhileAnimating = true;
</script>";
      $listado_formato_enlace.='<style type="text/css">
* {
    font-family: Verdana, Helvetica;
    font-size: 10pt;
}
.highslide-html {
    background-color: white;
}
.highslide-html-blur {
}
.highslide-html-content {
	position: absolute;
    display: none;
}
.highslide-loading {
    display: block;
	color: black;
	font-size: 8pt;
	font-family: sans-serif;
	font-weight: bold;
    text-decoration: none;
	padding: 2px;
	border: 1px solid black;
    background-color: white;

    padding-left: 22px;
    background-image: url(../../images/highslide/loader.white.gif);
    background-repeat: no-repeat;
    background-position: 3px 1px;
}
a.highslide-credits,
a.highslide-credits i {
    padding: 2px;
    color: silver;
    text-decoration: none;
	font-size: 10px;
}
a.highslide-credits:hover,
a.highslide-credits:hover i {
    color: white;
    background-color: gray;
}


/* Styles for the popup */
.highslide-wrapper {
	background-color: white;
}
.highslide-wrapper .highslide-html-content {
    width: 400px;
    padding: 5px;
}
.highslide-wrapper .highslide-header div {
}
.highslide-wrapper .highslide-header ul {
	margin: 0;
	padding: 0;
	text-align: right;
}
.highslide-wrapper .highslide-header ul li {
	display: inline;
	padding-left: 1em;
}
.highslide-wrapper .highslide-header ul li.highslide-previous, .highslide-wrapper .highslide-header ul li.highslide-next {
	display: none;
}
.highslide-wrapper .highslide-header a {
	font-weight: bold;
	color: gray;
	text-transform: uppercase;
	text-decoration: none;
}
.highslide-wrapper .highslide-header a:hover {
	color: black;
}
.highslide-wrapper .highslide-header .highslide-move a {
	cursor: move;
}
.highslide-wrapper .highslide-footer {
	height: 11px;
}
.highslide-wrapper .highslide-footer .highslide-resize {
	float: right;
	height: 11px;
	width: 11px;
	background: url(../../images/highslide/resize.gif);
}
.highslide-wrapper .highslide-body {
}
.highslide-move {
    cursor: move;
}
.highslide-resize {
    cursor: nw-resize;
}

/* These must be the last of the Highslide rules */
.highslide-display-block {
    display: block;
}
.highslide-display-none {
    display: none;
}
</style>';
    }
    if($formato[0]["detalle"]){
      $texto.='<script>
                //var alto=window.document.body.scrollHeight+window.document.body.offsetHeight;
                var alto=window.document.body.scrollWidth;
                parent.document.getElementById(window.name).width=alto+"px"; 
                var alto=window.document.body.scrollHeight;
                parent.document.getElementById(window.name).height=alto+5+"px";                    
              </script>';
    }
    $contenido="<html><title>.:".strtoupper($accion." ".$formato[0]["etiqueta"]).":.</title><head>".$includes.$enmascarar.$listado_formato_enlace."</head>".$texto."</html>";

    $mostrar=crear_archivo($formato[0]["nombre"]."/".$formato[0]["ruta_".$accion],$contenido);
    if($mostrar<>"")
      alerta("Formato Creado con exito por favor verificar la carpeta ".dirname($mostrar),'success',4000);   
  }
  else alerta("No es posible generar el Formato",'error',4000);  
}
/*
Se le envia
cad=cadena a incluir
tipo=Tipo de libreria a incluir librerias->php, javascript->js,estilos->css
eval=Si debe crear el archivo o no  
*/
function incluir($cad,$tipo,$eval=0){
global $incluidos;
  $includes="";
  //$cad=str_replace("../","",$cad);
  $lib=explode(",",$cad);
  switch($tipo){
    case "librerias":    
      $texto1='<?php include_once("';
      $texto2='"); ? >';
    break;
    case "javascript":
      $texto1='<script type="text/javascript" src="';
      $texto2='"></script>';
    break;
    case "estilos":
      $texto1='<link type="text/css" rel="stylesheet" media="screen" href="';
      $texto2='">';
    break;
    default:
      return(""); //retorna un vacio si no existe el tipo
    break;
  }
  for($j=0;$j<count($lib);$j++){
    $pos=array_search($texto1.$lib[$j].$texto2,$incluidos);
    if($pos===false){
      if(!is_file($lib[$j])&$eval){
        if(crear_archivo($lib[$j])){
          $includes.=$texto1.$lib[$j].$texto2;
        }
        else {
          alerta("Problemas al generar el Formato en ".$lib[$j],'error',5000);
          return("");
        }    
      }
      else {
        $includes.=$texto1.$lib[$j].$texto2;
      } 
    array_push($incluidos,$texto1.$lib[$j].$texto2);
    }
  } 
return($includes);  
}
function incluir_libreria($nombre,$tipo){
$includes="";
  if(!is_file("librerias/".$nombre)){
    if(crear_archivo("librerias/".$nombre)){
      $includes.=incluir("../librerias/".$nombre,$tipo);
    }
    else alerta("No es posible generar el archivo ".$nombre,'error',4000);
  }  
  else $includes.=incluir("../librerias/".$nombre,$tipo);
return($includes);  
}
function arma_funcion($nombre,$parametros,$accion){
if($parametros<>"" && $accion<>"adicionar")
   $parametros.=",";
if($accion=="mostrar")
  $texto="<?php ".$nombre."(".$parametros."$"."_REQUEST['iddoc']);? >";
elseif($accion=="adicionar")
  $texto="<?php ".$nombre."(".$parametros.");? >";
elseif($accion=="editar")  
  $texto="<?php ".$nombre."(".$parametros."$"."_REQUEST['iddoc']);? >";
return($texto);
}    

function generar_formato($idformato){
  global $sql,$conn;
  $formato=busca_filtro_tabla("*","formato A","A.idformato=".$idformato,"",$conn);
  $lcampos="";
  $regs=array();
  $regs1=array();
  
  if($formato["numcampos"]){
    $texto=$formato[0]["cuerpo"].$formato[0]["encabezado"].$formato[0]["pie_pagina"];
    $texto=str_replace("listado_detalles_","id",$texto);
    $resultado=preg_match_all( '({\*([a-z]+[0-9]*[_]*[a-z]*[0-9]*)+\*})' ,$texto, $regs );
    $campos=array_unique($regs[0]);
    $campos_editar=array();
    $campos_edit=array();
    $campos_adicionar=array();
    $campos_otrosf=array();
    if($campos){
      /*Busco el listado de las funciones para compararlas con los campos que se van a ingresar*/
      $lcampos=busca_filtro_tabla("*","funciones_formato A","A.nombre IN('".implode("','",$campos)."')","",$conn);
      for($i=0;$i<$lcampos["numcampos"];$i++){
        $pos=array_search($lcampos[$i]["nombre"],$campos);
        if($pos!==false){
          array_push($campos_editar,$lcampos[$i]["idfunciones_formato"]);
          $eval=strpos($lcampos[$i]["formato"],$idformato);
          
          if($eval===false){
            array_push($campos_otrosf,$lcampos[$i]["idfunciones_formato"]);
            //$lib_general=strpos($lcampos[$i]["ruta"],"../librerias/funciones_generales.php");
            /*if($lib_general===false){*/
              $sqlf="UPDATE funciones_formato SET formato=".concatener_cadena_sql(array("formato","','",$idformato))." WHERE idfunciones_formato=".$lcampos[$i]["idfunciones_formato"];
              phpmkr_query($sqlf,$conn) or error("Falla Al Ejecutar ".$sqlf." <br /> Al Generar el Formato.");
            //}  
          }  
        }  
        array_push($campos_edit,$lcampos[$i]["nombre"]);
      }
      $listado=busca_filtro_tabla("*","campos_formato A","A.formato_idformato=".$idformato,"",$conn);
      for($i=0;$i<$listado["numcampos"];$i++){
        array_push($campos_edit,"{*".$listado[$i]["nombre"]."*}");
      }
      
      $campos_adicionar=array_diff($campos,$campos_edit);
      sort($campos_adicionar);
    }
    else alerta("El formato no posee Parametros si esta seguro continue con el Proceso de lo contrario haga Click en Listar Formato y Luego Editelo",'error',6000);
  }  
$tadd="";
$ted="";  
$tod="";
$tadd.=implode(",",$campos_adicionar);
$ted.=implode(",",$campos_editar);
$tod.=implode(",",$campos_otrosf);
if($campos_otrosf<>""){
  alerta("Existen otros Formatos Vinculados",'success',4000);
}
redirecciona("funciones_formatoadd.php?adicionar=".$tadd."&editar=".$ted."&idformato=".$idformato);
}

?>
