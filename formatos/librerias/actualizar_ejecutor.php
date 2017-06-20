<?php
include_once("../../db.php");
foreach($_REQUEST AS $key=>$valor){
    if($valor=='undefined'){
        unset($_REQUEST[$key]);
    }
}
/*
Si la identificacion llega y es valida se mira si existe alg�n ejecutor que
la tenga asignada, si es asi, se actualizan los datos de la tabla ejecutor
con los que vengan del formulario, de lo contrario se crea
un registro nuevo en la tabla ejecutor
*/
$condicion="";
$insertado=0;
if(@$_REQUEST["nombre"]){
  $nombre=trim(str_replace(",","",@$_REQUEST["nombre"]));
}
if(@$_REQUEST["identificacion"]){
  $identificacion=trim(str_replace(",","",@$_REQUEST["identificacion"]));
}
$ejecutor["numcampos"]=0;

if(trim(@$_REQUEST["identificacion"])<>"")
{$ejecutor=busca_filtro_tabla("","ejecutor","identificacion LIKE '".@$identificacion."'" ,"",$conn);

 if(!$ejecutor["numcampos"])
   {$ejecutor=busca_filtro_tabla("","ejecutor","lower(nombre) LIKE lower('".@$nombre."') and (identificacion is null or identificacion='')","",$conn);
   }

}
elseif(trim(@$_REQUEST["nombre"])<>"")
  $ejecutor=busca_filtro_tabla("","ejecutor","lower(nombre) LIKE lower('".@$nombre."')","",$conn);

if($ejecutor["numcampos"]){
  $otros="";
  if(isset($_REQUEST["tipo_documento"])&&$_REQUEST["tipo_documento"]<>""&&$_REQUEST["tipo_documento"]<>"undefined")
     $otros.=",tipo_documento=".$_REQUEST["tipo_documento"];
  if(isset($_REQUEST["lugar_expedicion"])&&$_REQUEST["lugar_expedicion"]&&$_REQUEST["lugar_expedicion"]<>"undefined")
     $otros.=",lugar_expedicion='".$_REQUEST["lugar_expedicion"]."'";
  if(isset($_REQUEST["identificacion"])&&$_REQUEST["identificacion"]&&$_REQUEST["identificacion"]<>"undefined")
     $otros.=",identificacion='".$_REQUEST["identificacion"]."'";
  if(isset($_REQUEST["tipo_ejecutor"])&&$_REQUEST["tipo_ejecutor"]&&$_REQUEST["tipo_ejecutor"]<>"undefined")
     $otros.=",tipo_ejecutor='".$_REQUEST["tipo_ejecutor"]."'";
  /*if(isset($_REQUEST["codigo"])&&$_REQUEST["codigo"]){
  	$datos = busca_filtro_tabla("","datos_ejecutor","ejecutor_idejecutor=".$ejecutor[0]["idejecutor"],"",$conn);

  if($datos["numcampos"] > 0)
  		phpmkr_query("UPDATE datos_ejecutor SET codigo=".$_REQUEST["codigo"]." where ejecutor_idejecutor=".$ejecutor[0]["idejecutor"]);
  }   */

  $sql="UPDATE ejecutor SET nombre ='".@$_REQUEST["nombre"]."'".$otros." WHERE idejecutor=".$ejecutor[0]["idejecutor"];

  phpmkr_query($sql,$conn);
  $idejecutor=$ejecutor[0]["idejecutor"];
}
else{
  $sql="INSERT INTO ejecutor(nombre,identificacion)VALUES('".@$nombre."','".@$identificacion."')";

//  die($sql);
  phpmkr_query($sql,$conn);
  $idejecutor=phpmkr_insert_id();
  if(isset($_REQUEST["lugar_expedicion"])&&$_REQUEST["lugar_expedicion"])
    phpmkr_query("update ejecutor set lugar_expedicion='".$_REQUEST["lugar_expedicion"]."' where idejecutor=$idejecutor",$conn);

  if(isset($_REQUEST["tipo_documento"])&&$_REQUEST["tipo_documento"])
    phpmkr_query("update ejecutor set tipo_documento='".$_REQUEST["tipo_documento"]."' where idejecutor=$idejecutor",$conn);

  /*if(isset($_REQUEST["codigo"])&&$_REQUEST["codigo"]){
  	$datos = busca_filtro_tabla("","datos_ejecutor","ejecutor_idejecutor=".$idejecutor,"",$conn);
  	if($datos["numcampos"] > 0)
  		phpmkr_query("UPDATE datos_ejecutor SET codigo=".$_REQUEST["codigo"]." where ejecutor_idejecutor=".$idejecutor);
  } */
  $insertado=1;
}
/*
se busca con el idejecutor si ya existen datos en la tabla datos_ejecutor,
*/
$campos_ejecutor=explode(",",$_REQUEST["campos"]);
$campos_excluidos=array("nombre","identificacion");
$campos_ejecutor=array_diff($campos_ejecutor,$campos_excluidos);
sort($campos_ejecutor);
$campos_todos=array("direccion","telefono","email","cargo","empresa","ciudad","titulo","codigo");

$condicion_actualiza="";
for($i=0;$i<count($campos_ejecutor);$i++){
  if(isset($_REQUEST[$campos_ejecutor[$i]])){
   $_REQUEST[$campos_ejecutor[$i]]=decodifica_encabezado(htmlentities($_REQUEST[$campos_ejecutor[$i]]));
   if($campos_ejecutor[$i]=="fecha_nacimiento")
    $condicion_actualiza.=' AND '.fecha_db_obtener($campos_ejecutor[$i],"Y-m-d")."='".$_REQUEST[$campos_ejecutor[$i]]."'";
   elseif($_REQUEST[$campos_ejecutor[$i]])
    $condicion_actualiza.=' AND '.$campos_ejecutor[$i]."='".$_REQUEST[$campos_ejecutor[$i]]."'";
   else {
    $condicion_actualiza.=' AND ('.$campos_ejecutor[$i]." IS NULL or ".$campos_ejecutor[$i]."='')";
   }
  }
}
$datos_ejecutor=busca_filtro_tabla("","datos_ejecutor","ejecutor_idejecutor=".$idejecutor.$condicion_actualiza,"",$conn);
//print_r($datos_ejecutor); die();
if((!$datos_ejecutor["numcampos"] ||$insertado) && $condicion_actualiza!=""){$datos_ejecutor=busca_filtro_tabla("","datos_ejecutor","ejecutor_idejecutor=".$idejecutor,"iddatos_ejecutor desc",$conn);

  $campos=array();
  $valores=array();
  if(!isset($_REQUEST["ciudad"])|| strtolower($_REQUEST["ciudad"])=="undefined")
    {$config=busca_filtro_tabla("valor","configuracion","lower(nombre) like 'ciudad'","",$conn);
     if($config["numcampos"])
        $_REQUEST["ciudad"]=$config[0][0];
     else
        $_REQUEST["ciudad"]=658;
    }
  for($i=0;$i<=count($campos_todos);$i++){
    if($campos_todos[$i]<>"fecha_nacimiento")
     {if(isset($_REQUEST[$campos_todos[$i]])&&in_array($campos_todos[$i],$campos_ejecutor)){
        array_push($valores,$_REQUEST[$campos_todos[$i]]);
        array_push($campos,$campos_todos[$i]);
        $actualizado=1;
      }
      elseif($datos_ejecutor["numcampos"] && $datos_ejecutor[0][$campos_todos[$i]]<>"")
       {array_push($valores,$datos_ejecutor[0][$campos_todos[$i]]);
        array_push($campos,$campos_todos[$i]);
       }
     }
  }

  if($actualizado){
    $valor_insertar="'".implode("','",$valores)."',";
    $campos_insertar=implode(",",$campos).",";
  }
  /*********fecha de nacimiento ***********/
 /* if(isset($_REQUEST["fecha_nacimiento"])&&$_REQUEST["fecha_nacimiento"]<>"0000-00-00"&&$_REQUEST["fecha_nacimiento"]<>""&&$_REQUEST["fecha_nacimiento"]<>"undefined"&&$actualizado)
    {$valor_insertar.=fecha_db_almacenar($_REQUEST["fecha_nacimiento"],"Y-m-d").",";
     $campos_insertar.="fecha_nacimiento,";
    }
  elseif($datos_ejecutor["numcampos"] && $datos_ejecutor[0][$campos_ejecutor[$i]]<>"0000-00-00"&&$actualizado)
    {$valor_insertar.=fecha_db_almacenar($datos_ejecutor[0][$campos_ejecutor[$i]],"Y-m-d").",";
     $campos_insertar.="fecha_nacimiento,";
    } */
  /*****************************************/

  //print_r($_REQUEST);
  $sql='INSERT INTO datos_ejecutor('.$campos_insertar."ejecutor_idejecutor,fecha) VALUES(".$valor_insertar.$idejecutor.",".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").")";
  //echo "<br />$sql<br />";
  phpmkr_query($sql,$conn);
  $iddatos_ejecutor=phpmkr_insert_id();
  if(isset($_REQUEST["codigo"])&&$_REQUEST["codigo"]){
  	$datos = busca_filtro_tabla("","datos_ejecutor","ejecutor_idejecutor=".$idejecutor,"",$conn);
  	if($datos["numcampos"] > 0)
  		phpmkr_query("UPDATE datos_ejecutor SET codigo=".$_REQUEST["codigo"]." where ejecutor_idejecutor=".$idejecutor);
  }
}
else if($datos_ejecutor["numcampos"]){
  $iddatos_ejecutor=$datos_ejecutor[0]["iddatos_ejecutor"];
}
/*Pilas Validad que si se haga la accion*/
echo($iddatos_ejecutor.'|'.delimita($nombre,50));

//echo('<div id="'.$iddatos_ejecutor.'" class="rotulo_ejecutor"><div class="rotulo_nombre"><b>Nombre : </b>'.delimita($nombre,50).'</div><div class="rotulo_documento"> <b>Documento : </b>'.$identificacion.'</div><div class="rotulo_accion"><a href="eliminar_ejecutor.php?iddatos_ejecutor='.$iddatos_ejecutor.'"><img border="0px" src="../../imagenes/delete.gif"></a></div></div>');
?>
