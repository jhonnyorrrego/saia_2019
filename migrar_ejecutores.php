<?php
include_once("db.php");
$id = $_GET["id"];
if($id<50800)
{
$i=0;
//$ejecutores=busca_filtro_tabla("","ejecutor2","","",$conn);
$ejecutores=busca_filtro_tabla(fecha_db_obtener('fecha_ingreso','Y-m-d H:i:s')."as fecha, ejecutor2.* ","ejecutor2","idejecutor=".$id,"",$conn);
$cuantos=$ejecutores["numcampos"];
$nombre='';
$identificacion='identificacion';
$idejecutor=$id;
if($ejecutores[0]["identificacion"]=="")
 $iden = ' IS NULL';
else
 $iden = "= '".$ejecutores[0]["identificacion"]."'"; 
$existe = busca_filtro_tabla("idejecutor","ejecutor",limpiar_cadena_sql("nombre")." like ".limpiar_cadena_sql($ejecutores[0]["nombre"])." and identificacion".$iden,"",$conn);
if($existe["numcampos"]>0)
  $idejecutor_nuevo = $existe[0]["idejecutor"];
else
   {$conn->Ejecutar_Sql("insert into ejecutor(nombre,identificacion,fecha_ingreso) values('".$ejecutores[$i]["nombre"]."','".$ejecutores[$i]["identificacion"]."',".fecha_db_almacenar($ejecutores[$i]["fecha"],'Y-m-d H:i:s').")");
      $idejecutor_nuevo=$conn->ultimo_insert();    
   }           
   $sql="insert into datos_ejecutor(ejecutor_idejecutor,direccion,telefono,cargo,ciudad,titulo,empresa,fecha) values('".$idejecutor_nuevo."','".$ejecutores[$i]["direccion"]."','".$ejecutores[$i]["telefono"]."','".$ejecutores[$i]["cargo"]."','".$ejecutores[$i]["ciudad"]."','".$ejecutores[$i]["titulo"]."','".$ejecutores[$i]["empresa"]."',".fecha_db_almacenar($ejecutores[$i]["fecha"],'Y-m-d H:i:s').")";
   $conn->Ejecutar_Sql($sql);
   $iddatos_ejecutor=$conn->ultimo_insert();     
   //para el ejecutor de los documentos
   $sql="update documento set ejecutor='".$iddatos_ejecutor."' where ejecutor='".$idejecutor."' and plantilla is null AND estado<>'ELIMINADO'";
   $conn->Ejecutar_Sql($sql);
   //para los despachos
   $sql="update salidas set responsable='".$iddatos_ejecutor."' where responsable='".$idejecutor."' and (tipo_despacho=3 or tipo_despacho=1)";
   $conn->Ejecutar_Sql($sql);
   $sql="update salidas set empresa='".$iddatos_ejecutor."' where empresa='".$idejecutor."' and (tipo_despacho=3 or tipo_despacho=1)";
   $conn->Ejecutar_Sql($sql);
   //para los destinos de las cartas
   $sql="update ft_carta set destinos=REGEXP_REPLACE(destinos,'(.+,)($idejecutor)(,.+)','\1$iddatos_ejecutor\3')";
   $conn->Ejecutar_Sql($sql);
   
   $sql="UPDATE ft_carta set destinos=REGEXP_REPLACE(destinos,'(^$idejecutor,)','$iddatos_ejecutor,')";    
   $conn->Ejecutar_Sql($sql);
   $sql="UPDATE ft_carta set destinos=REGEXP_REPLACE(destinos,'(^".$idejecutor."$)','$iddatos_ejecutor')";       
   $conn->Ejecutar_Sql($sql);   
   $sql="update ft_carta set destinos=REGEXP_REPLACE(destinos,'(,$idejecutor^)',',$iddatos_ejecutor')";
   $conn->Ejecutar_Sql($sql);
//para las copias de las cartas
   $sql="update ft_carta set copia=REGEXP_REPLACE(copia,'(.+,)($idejecutor)(,.+)','\1$iddatos_ejecutor\3')";
   $conn->Ejecutar_Sql($sql);
   $sql="update ft_carta set copia=REGEXP_REPLACE(copia,'(^$idejecutor,)','$iddatos_ejecutor,')";
   $conn->Ejecutar_Sql($sql);
   $sql="UPDATE ft_carta set copia=REGEXP_REPLACE(copia,'(^".$idejecutor."$)','$iddatos_ejecutor')";   
   $conn->Ejecutar_Sql($sql);
   $sql="update ft_carta set copia=REGEXP_REPLACE(copia,'(,$idejecutor^)',',$iddatos_ejecutor')";
   $conn->Ejecutar_Sql($sql); 
++$id;

redirecciona("migrar_ejecutores.php?id=".$id);  
}
else
 die("Fin"); 
?>
