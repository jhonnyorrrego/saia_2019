<?php
include("db.php");
//actualizar_roles();
actualizar_ciudad();

$iddoc = $_REQUEST["iddoc"];
$doc_entrada = false;
$doc_formato = false;
print_r($_REQUEST);

$doc = busca_filtro_tabla("ejecutor,plantilla","documento","iddocumento=$iddoc","",$conn);
if($doc[0]["plantilla"]!="")
 { $formato = busca_filtro_tabla("destinos,copia","ft_carta","documento_iddocumento=".$iddoc);
   if(strpos($formato[0]["destinos"],',')>0)
   {
    $list_ejecutor = explode(",",$formato[0]["destinos"]);
    for($i=0; $i<count($list_ejecutor); $i++)
     {
      $ejecutor = busca_filtro_tabla("*","ejecutor2","idejecutor like '".$list_ejecutor[$i]."'","",$conn);  
      ejecutor_formato($list_ejecutor[$i],$ejecutor,'destinos');
     }    
   }   
   else
   { $ejecutor = busca_filtro_tabla("*","ejecutor2","idejecutor = ".$formato[0]["destinos"],"",$conn);
   //print_r($ejecutor);
    ejecutor_formato($formato[0]["destinos"],$ejecutor,'destinos');
   }
  if($formato[0]["copia"]!="")  
   { if(strpos($formato[0]["copia"],',')>0)   
     {
    $list_ejecutor = explode(",",$formato[0]["copia"]);
    for($i=0; $i<count($list_ejecutor); $i++)
     {
      $ejecutor = busca_filtro_tabla("*","ejecutor2","idejecutor like '".$list_ejecutor[$i]."'","",$conn);  
      ejecutor_formato($list_ejecutor[$i],$ejecutor,'copia');
     }    
   }
    else
    { $ejecutor = busca_filtro_tabla("*","ejecutor2","idejecutor = ".$formato[0]["copia"],"",$conn);   
  $doc_formato = true;
   ejecutor_formato($formato[0]["copia"],$ejecutor,'copia');
    }
   } 
  die("fin");
 }
else
 {$ejecutor = busca_filtro_tabla("*","ejecutor2","idejecutor=".$doc[0]["ejecutor"],"",$conn);
  $doc_entrada = true;  
 $conn->Ejecutar_Sql("insert into ejecutor(nombre,identificacion,fecha_ingreso) values('".$ejecutor[0]["nombre"]."','".$ejecutor[0]["identificacion"]."',".fecha_db_almacenar($ejecutor[0]["fecha"],'Y-m-d H:i:s').")");
      $idejecutor_nuevo=$conn->ultimo_insert();
 $mun = busca_filtro_tabla("*","municipio","nombre like '".$ejecutor[0]["ciudad"]."'","",$conn);
 if($mun["numcampos"]>0)
  $municipio = $mun[0]["idmunicipio"];
 $sql="insert into datos_ejecutor(ejecutor_idejecutor,direccion,telefono,cargo,ciudad,titulo,empresa,fecha) values('".$idejecutor_nuevo."','".$ejecutor[0]["direccion"]."','".$ejecutor[0]["telefono"]."','".$ejecutor[0]["cargo"]."','".$municipio."','".$ejecutor[$i]["titulo"]."','".$ejecutor[$i]["empresa"]."',".fecha_db_almacenar($ejecutor[$i]["fecha"],'Y-m-d H:i:s').")";
   $conn->Ejecutar_Sql($sql);
   $iddatos_ejecutor=$conn->ultimo_insert();
  $sql = "update documento set ejecutor=$iddatos_ejecutor where iddocumento=$iddoc";
   $conn->Ejecutar_Sql($sql);  
} 

 function ejecutor_formato($idejecutor,$ejecutor,$tipo) 
 { global $conn;   
   global $iddoc;
   //print_r($ejecutor); die();
   $conn->Ejecutar_Sql("insert into ejecutor(nombre,identificacion,fecha_ingreso) values('".$ejecutor[0]["nombre"]."','".$ejecutor[0]["identificacion"]."',".fecha_db_almacenar($ejecutor[0]["fecha"],'Y-m-d H:i:s').")");
      $idejecutor_nuevo=$conn->ultimo_insert();
 //print_r($ejecutor);
 $mun = busca_filtro_tabla("*","municipio","upper(nombre) like '".strtoupper($ejecutor[0]["ciudad"])."'","",$conn);
 //print_r($mun); die();
 if($mun["numcampos"]>0)
  $municipio = $mun[0]["idmunicipio"];
 
 $sql="insert into datos_ejecutor(ejecutor_idejecutor,direccion,telefono,cargo,ciudad,titulo,empresa,fecha) values('".$idejecutor_nuevo."','".$ejecutor[0]["direccion"]."','".$ejecutor[0]["telefono"]."','".$ejecutor[0]["cargo"]."','".$municipio."','".$ejecutor[0]["titulo"]."','".$ejecutor[0]["empresa"]."',".fecha_db_almacenar($ejecutor[0]["fecha"],'Y-m-d H:i:s').")";
   $conn->Ejecutar_Sql($sql);
   $iddatos_ejecutor=$conn->ultimo_insert();   
   $sql = "update ft_carta set $tipo = $iddatos_ejecutor where documento_iddocumento=$iddoc";
   $conn->Ejecutar_Sql($sql);
  //die("fin");
 }
 
function actualizar_ciudad()
{ 
///die("fji");
 global $conn;
  //return true;
 $ejecutor = busca_filtro_tabla("idmunicipio,iddatos_ejecutor,ciudad","datos_ejecutor,municipio","upper(nombre) like upper(ciudad)","ciudad",$conn);
 print_r($ejecutor);
 for($i=0; $i<$ejecutor["numcampos"]; $i++)
  { $sql = "update datos_ejecutor set ciudad = ".$ejecutor[$i]["idmunicipio"]." where iddatos_ejecutor=".$ejecutor[$i]["iddatos_ejecutor"];
   //$conn->Ejecutar_Sql($sql);
   echo $sql."<br />";
   //die();
  }
  die("fin"); 
}

function actualizar_roles()
{ global $conn;
 $rol = busca_filtro_tabla("*","dependencia_cargo","estado=1","",$conn);
 print_r($rol);
 $sql = "UPDATE dependencia_cargo SET fecha_final=".fecha_db_almacenar("2010-01-01","Y:m:d")." where estado=1";
 echo $sql;
 die();
}
 
 //13655,49947  
?>
