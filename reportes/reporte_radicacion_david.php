<?php
include_once("../db.php");
global $conn;
$datos=busca_filtro_tabla("","busquedas","idbusquedas=113","",$conn);   //id de la busqueda
$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=113","orden asc",$conn);

if($funciones["numcampos"])
{for($i=0;$i<$funciones["numcampos"];$i++)
    {$id_func[]=$funciones[$i]["idfunciones_busqueda"];
    }
 $id_func=implode(",",$id_func);
}
/*$filtro='';
if(@$_REQUEST["fechai"])
  $filtro.=" and d.fecha>=".fecha_db_almacenar($_REQUEST["fechai"])." ";
if(@$_REQUEST["fechaf"])
  $filtro.=" and d.fecha<=".fecha_db_almacenar($_REQUEST["fechaf"])." ";
if(@$_REQUEST["responsable"])
  $filtro.=" and dc.iddependencia_cargo=".$_REQUEST["responsable"];*/

//if($filtro<>"")
//{$datos[0]["codigo"]=str_replace("/*filtro*/",$filtro,$datos[0]["codigo"]);
//die($datos[0]["codigo"]);
//}

if($datos<>"")
  {?>
<form name=form1 action="../buscador/index.php" method="post">
<input type="hidden" name="busqueda" value="busqueda">
<input type="hidden" name="func_busqueda" value="<?php echo $id_func; ?>">
<input type="hidden" name="llave" value="<?php echo $datos[0]["llave"]; ?>">
<input type="hidden" name="orden" value="<?php echo $datos[0]["orden"]; ?>">
<input type="hidden" name="ordenar" value="<?php echo $datos[0]["ordenado"]; ?>">
<input type="hidden" name="registros" value="10">
<input type="hidden" name="tablas" value="tablas">
<input type="hidden" name="tabla" value="ft_radicacion_entrada">
<input type="hidden" name="adicionales" value="tipo,<?php echo $_REQUEST["tipo"]; ?>">
<input type="hidden" name="grafico" value="<?php echo $datos[0]["grafico"]; ?>">
<input type="hidden" name="subtitulo" value="<?php echo $datos[0]["subtitulo"]; ?>">
<input type="hidden" name="totales" value="<?php echo $datos[0]["totales"]; ?>">
<input type="hidden" name="sql" value="<?php echo $datos[0]["codigo"];?>">
<input type="image" src="<?php echo "/".RUTA_SCRIPT."/imagenes/cargando.gif"; ?>">
</form>  
<script>
form1.submit();
</script>
<?php  
  }
?>