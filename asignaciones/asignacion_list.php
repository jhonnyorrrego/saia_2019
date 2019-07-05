<?php
session_start();
include_once("../db.php");
global $conn;
function unir_resultados($r1,$r2)
{
 
  foreach ($r2 as $nr) {
  	
  	array_push($r1,$nr);
  	
  }
 $r1["numcampos"]+=$r2["numcampos"];
  
 return($r1); 
}

$datos=busca_filtro_tabla("","busquedas","idbusquedas=46","",$conn);

//$datos = unir_resultados($datos,$datos_cargo);

$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=46","",$conn);
if($funciones["numcampos"])
{for($i=0;$i<$funciones["numcampos"];$i++)
    {$id_func[]=$funciones[$i]["idfunciones_busqueda"];
    }
 $id_func=implode(",",$id_func);
}

if($datos["numcampos"])
  {  
?>
<form name=form1 action="../buscador/index.php" method="get">
<input type="hidden" name="busqueda" value="busqueda">
<input type="hidden" name="func_busqueda" value="<?php echo $id_func; ?>">
<input type="hidden" name="llave" value="<?php echo $datos[0]["llave"]; ?>">
<input type="hidden" name="registros" value="10">
<input type="hidden" name="tablas" value="tablas">
<input type="hidden" name="ordenar" value="<?php echo $datos[0]["ordenado"]; ?>">
<input type="hidden" name="orden" value="<?php echo $datos[0]["orden"]; ?>">
<input type="hidden" name="tabla" value="documento">
<input type="hidden" name="grafico" value="<?php echo $datos[0]["grafico"]; ?>">
<input type="hidden" name="subtitulo" value="<?php echo $datos[0]["subtitulo"]; ?>">
<input type="hidden" name="totales" value="<?php echo $datos[0]["totales"]; ?>">
<input type="hidden" name="sql" value="<?php echo $datos[0]["codigo"]; ?>">
<input type="image" src="<?php echo "/".RUTA_SCRIPT."/assets/images/cargando.gif"; ?>">
</form>  
<script>
form1.submit();
</script>
<?php  
  }die();
/*
 * 
 * 
 * 
SELECT A.idasignacion AS k, A.fecha_inicial AS Inicio, A.fecha_final AS Fin, T.descripcion AS descripcion
FROM asignacion_entidad AE, dependencia_cargo DC, asignacion A, tarea T
WHERE DC.estado = '1'
AND DC.funcionario_idfuncionario = '1'
AND DC.cargo_idcargo = AE.llave_entidad
AND AE.entidad_identidad = '4'
AND AE.asignacion_idasignacion = A.idasignacion
AND A.tarea_idtarea = T.idtarea
*/
  ?>

