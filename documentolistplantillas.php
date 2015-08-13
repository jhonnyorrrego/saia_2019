<?php
session_start();
include_once("db.php");
global $conn;
$datos=busca_filtro_tabla("","busquedas","idbusquedas=44","",$conn);
$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=44","idfunciones_busqueda asc",$conn);
if($funciones["numcampos"])
{for($i=0;$i<$funciones["numcampos"];$i++)
    {$id_func[]=$funciones[$i]["idfunciones_busqueda"];
    }
 $id_func=implode(",",$id_func);
}
$plantillas = busca_filtro_tabla("nombre,etiqueta","formato","mostrar=1","etiqueta",$conn);
if($plantillas["numcampos"])
{ for($i=0; $i<$plantillas["numcampos"]; $i++)
    $list_plantillas[] = ucfirst(strtolower($plantillas[$i]["etiqueta"]));
  $list_plantillas=implode("#",$list_plantillas);
}
if(isset($_REQUEST["plantilla_ppal"]))
 $adicional=";plantilla_ppal,".$_REQUEST["plantilla_ppal"];
else
 $adicional=";plantilla_ppal,memorando";
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
<input type="hidden" name="adicionales" value="listado_plantillas,1;pantalla,doc_plantillas;list_plantillas,<?php echo $list_plantillas.$adicional; ?>">
<input type="hidden" name="orden" value="<?php echo $datos[0]["orden"]; ?>">
<input type="hidden" name="tabla" value="documento">
<input type="hidden" name="grafico" value="<?php echo $datos[0]["grafico"]; ?>">
<input type="hidden" name="subtitulo" value="<?php echo $datos[0]["subtitulo"]; ?>">
<input type="hidden" name="totales" value="<?php echo $datos[0]["totales"]; ?>">
<input type="hidden" name="sql" value="<?php echo $datos[0]["codigo"]; ?>">
<input type="image" src="<?php echo "/".RUTA_SCRIPT."/imagenes/cargando.gif"; ?>">
</form> 

<script>
form1.submit();
</script>
<?php  
  }die();
?>
