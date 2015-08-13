<?php
session_start();
include_once("db.php");

global $conn;
//$buscar=new Sql($conn->Obtener_Conexion(),$conn->Motor);
$datos=busca_filtro_tabla("","busquedas","idbusquedas=96","",$conn);
$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=96","orden asc",$conn);
if($funciones["numcampos"])
{for($i=0;$i<$funciones["numcampos"];$i++)
    {$id_func[]=$funciones[$i]["idfunciones_busqueda"];
    }
 $id_func=implode(",",$id_func);
}
         
if($datos["numcampos"])
  {  
?>
<form name=form1 action="buscador/index.php" method="post">
<input type="hidden" name="busqueda" value="busqueda">
<input type="hidden" name="func_busqueda" value="<?php echo $id_func; ?>">
<input type="hidden" name="llave" value="<?php echo $datos[0]["llave"]; ?>">
<input type="hidden" name="registros" value="20">
<input type="hidden" name="tablas" value="tablas">
<input type="hidden" name="ordenar" value="<?php echo $datos[0]["ordenado"]; ?>">
<input type="hidden" name="adicionales" value="no_encabezado,1">
<input type="hidden" name="orden" value="<?php echo $datos[0]["orden"]; ?>">
<input type="hidden" name="tabla" value="">
<input type="hidden" name="grafico" value="<?php echo $datos[0]["grafico"]; ?>">
<input type="hidden" name="subtitulo" value="<?php echo $datos[0]["subtitulo"]; ?>">
<input type="hidden" name="totales" value="<?php echo $datos[0]["totales"]; ?>">
<input type="hidden" name="sql" value="<?php echo $datos[0]["codigo"]; ?>">
<input type="image" src=<?php echo PROTOCOLO_CONEXION.RUTA_PDF."/imagenes/cargando.gif"; ?>">
</form>

<script>
form1.submit();
</script>
<?php  
  }die();
?>
