<?php                        
//$datos=$_REQUEST["datos"];
/*Para radicar items se debe gararntizar que 
  exista un campo items_prefijo que tenga los prefijos que se van a utilizar en los formularios y un doble(2) guiones bajos(__) en el nombre de los campos cada uno de los campos debe ser definido como un arreglo los dose guines bajos son obligatorios 
ejemplo: items_factura__ 
ejemplo completo: items_factura_codigo_cliente
ejemplo definicion html: <input type="text" name="items_factura_codigo_cliente[]">
*/
/*$request=$_REQUEST;
print_r(radicar_documento_remoto($request));*/
function radicar_documento_remoto($request){	                
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
	{
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
if(!@$_SESSION["LOGIN".LLAVE_SAIA]){
  @session_start();
  $_SESSION["LOGIN".LLAVE_SAIA]="radicador_web";
  $_SESSION["usuario_actual"]="123456";
  $_SESSION["conexion_remota"]=1;
}
else{  
  $_SESSION["conexion_remota"]=1;
}    
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."webservice_saia/class.php");
include_once($ruta_db_superior."formatos/librerias/funciones_acciones.php");
$usuactual=$_SESSION["LOGIN".LLAVE_SAIA];         
$iddoc=0;
$respuesta=array();
$respuesta["exito"]=0;
if($request!=''){
  $_POST=$request;
  $_REQUEST=$request;
}
else{
	return($respuesta);	
}                                
$formato=busca_filtro_tabla("idformato,nombre","formato","nombre_tabla='".$_REQUEST["tabla"]."'","",$conn);
if(!isset($_POST["ejecutor"])) {
  $_POST["ejecutor"]=$_SESSION["usuario_actual"];
  $_REQUEST["ejecutor"]=$_SESSION["usuario_actual"];
  $dependencia=busca_filtro_tabla("","vfuncionario_dc","funcionario_codigo='".$_SESSION["usuario_actual"]."'","",$conn);
  $_POST["dependencia"]=$dependencia[0]["iddependencia_cargo"];
  $_REQUEST["dependencia"]=$dependencia[0]["iddependencia_cargo"];
}
$iddoc_rr=radicar_plantilla();
if($iddoc_rr){                
  aprobar($iddoc_rr);  
  //llama_funcion_accion($iddoc_rr,$formato[0]["idformato"],"APROBAR","POSTERIOR");
  $documento=busca_filtro_tabla("A.*,B.numero",$_REQUEST["tabla"]." A,documento B","A.documento_iddocumento=B.iddocumento AND A.documento_iddocumento=".$iddoc_rr,"",$conn);   
} 
else {
  $respuesta["exito"]=0;
  $respuesta["mensaje"]="Existe un problema al crear o vincular el documento";
  return($respuesta);
}

if($documento["numcampos"]){     
  $titems='';  
  if(array_key_exists("prefijo_items",$request)){
    $titems=vincular_items_formato($documento[0]["id".$_REQUEST["tabla"]],$request);
  }  
  /*$servidor_correo=busca_filtro_tabla("valor","configuracion","nombre='servidor_correo_salida'","",$conn); 
  $puerto_correo=busca_filtro_tabla("valor","configuracion","nombre='puerto_servidor_correo'","",$conn);
  $usuario_correo=busca_filtro_tabla("valor","configuracion","nombre='usuario_envio_correo'","",$conn);
  $empresa=busca_filtro_tabla("valor","configuracion","nombre='nombre' AND tipo='empresa'","",$conn);
  $dominio_correo=busca_filtro_tabla("valor","configuracion","nombre='dominio_correo' AND tipo='correo'","",$conn);*/      
  $respuesta["exito"]=1;
  $respuesta["iddocumento"]=$iddoc_rr;
  $respuesta["formato"]=$formato[0]["nombre"];
  $respuesta["documento_numero"]=$documento[0]["numero"];
  $respuesta["mensaje"]="Su documento se radic&oacute; correctamente";
  /*$respuesta["email_solicitante"]=$documento[0]["email_solicitante"];
  $respuesta["servidor_correo_salida"]=$servidor_correo[0]["valor"];
  $respuesta["puerto_correo"]=$puerto_correo[0]["valor"];
  $respuesta["usuario_correo"]=$usuario_correo[0]["valor"];
  $respuesta["empresa"]=$empresa[0]["valor"];
  $respuesta["dominio_correo"]=$dominio_correo[0]["valor"];  */
  
} 
if(@$_SESSION["LOGIN".LLAVE_SAIA]){
 @session_unset();
 @session_destroy();
}
return($respuesta); 
}
function vincular_items_formato($idtabla,$request){
  $texto='';
  $items=explode(",",$request["prefijo_items"]);  
  $litems=array();
  foreach($items AS $kitem=>$vitem){
    $formato=str_replace("item_","ft_",$vitem);
    foreach($request AS $krequest=>$vrequest){
      if(strpos($krequest,$vitem."__")!==FALSE){        
        $campo=str_replace($vitem."__","",$krequest);
        $cant_items=count($vrequest);
        for($i=0;$i<$cant_items;$i++){
          $litems[$formato][$i][$campo]=$vrequest[$i];
        }
      }
    }
  }
  foreach($litems AS $kitem=>$vitem){
    foreach($vitem AS $kregistro=>$vregistro){
      $texto="INSERT INTO ".$kitem."(".$request["tabla"].",";
      $texto.=implode(",",array_keys($vregistro));
      $texto.=") VALUES('".$idtabla."','";
      $texto.=implode("','",array_values($vregistro));
      $texto.="')";
      phpmkr_query($texto);
    }    
  }

return($texto);
}
?>
