<?php
include_once("db.php");
$id = $_GET["id"];
if($id<4950)
{
$codigo = busca_filtro_tabla("funcionario_codigo","funcionario","idfuncionario=".$id,"",$conn);

if($codigo["numcampos"]){
  $fun = $codigo[0]["funcionario_codigo"]; 
  $doc_usuario = " SELECT DISTINCT iddocumento,".fecha_db_obtener('buzon_entrada.fecha','Y-m-d H:i:s')."as fecha,0 as creado
  FROM buzon_entrada,documento
  WHERE origen ='".$fun."'
  AND documento.estado IN ('APROBADO','ACTIVO')
  AND buzon_entrada.nombre NOT IN('PRODUCCION','RECHAZADO','BLOQUEADO','POR_APROBAR','VERIFICACION')
  AND  archivo_idarchivo=iddocumento AND documento.fecha > TO_DATE('03/01/2008 00:00:00', 'MM/DD/YYYY HH24:MI:SS')";
  
  $rs = phpmkr_query($doc_usuario,$conn) or error("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $doc_usuario);
  
  $vector=array();
  echo "ejecutada $doc_usuario";
  while($vector[]=phpmkr_fetch_array($rs));
  @phpmkr_free_result($rs);
  $enviados="
  SELECT e.archivo_idarchivo
  FROM buzon_entrada e,buzon_salida s
  where
  e.origen ='".$fun."'
  and s.nombre NOT IN('LEIDO','BLOQUEADO')
  and e.nombre NOT IN('LEIDO','BLOQUEADO')
  and e.origen = s.origen
  AND e.archivo_idarchivo = s.archivo_idarchivo 
  GROUP BY e.archivo_idarchivo
  HAVING max( s.fecha ) >= max( e.fecha )";
  //echo($sSql."<br /><br />");
   $rs2= phpmkr_query($enviados,$conn) or error("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $enviados);
  $l_enviados=array();
  while($fila=phpmkr_fetch_array($rs2))
    {$l_enviados[]=$fila[0];
    }
  @phpmkr_free_result($rs2); 
  $cont=0;
  foreach($vector as $fila)
    {
     if(!in_array($fila[0],$l_enviados) && $fila[0]<>"")
     { $resultados[]=$fila[0];
       ++$cont;
       $asig = "INSERT INTO asignacion (tarea_idtarea,fecha_inicial,estado,documento_iddocumento,entidad_identidad,llave_entidad) VALUES (2,".fecha_db_almacenar($fila["fecha"],'Y-m-d H:i:s').",'PENDIENTE',".$fila[0].",1,".$fun.")";
       //echo $cont." ".$asig."<br />";
       $conn->Ejecutar_Sql($asig,$conn);
     }
    }
  echo "<br /><br />";    
 
}
++$id; 
redirecciona("migrar_buzones.php?id=".$id); 
}
else
 die("Fin");



  
?>
