<?php
session_start();
include_once("db.php");
global $conn;

if(isset($_REQUEST["etiqueta"])&&$_REQUEST["etiqueta"])
  $etiqueta_busqueda='documentos_por_etiqueta';
else
  $etiqueta_busqueda='documentos_sin_etiqueta';
    
$datos=busca_filtro_tabla("","busquedas","etiqueta like '$etiqueta_busqueda'","",$conn);
$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=".$datos[0]["idbusquedas"],"orden asc",$conn);
if($funciones["numcampos"])
{for($i=0;$i<$funciones["numcampos"];$i++)
    {$id_func[]=$funciones[$i]["idfunciones_busqueda"];
    }
 $id_func=implode(",",$id_func);
}

if(strpos($datos[0]["codigo"],"/*etiqueta*/"))
   {$datos[0]["codigo"]=str_replace("/*etiqueta*/",$_REQUEST["etiqueta"],$datos[0]["codigo"]);
    $etiqueta=busca_filtro_tabla("nombre","etiqueta","idetiqueta=".$_REQUEST["etiqueta"],"",$conn);
    $nombre_etiqueta=$etiqueta[0][0];
   }
else
  $nombre_etiqueta="";  
//die($datos[0]["codigo"]);    
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
<input type="hidden" name="adicionales" value="filtro,funcionario;pantalla,etiquetados;etiqueta,<?php echo $nombre_etiqueta; ?>">
<input type="hidden" name="orden" value="<?php echo $datos[0]["orden"]; ?>">
<input type="hidden" name="tabla" value="documento">
<input type="hidden" name="grafico" value="<?php echo $datos[0]["grafico"]; ?>">
<input type="hidden" name="subtitulo" value="<?php echo $datos[0]["subtitulo"]; ?>">
<input type="hidden" name="totales" value="<?php echo $datos[0]["totales"]; ?>">
<input type="hidden" name="sql" value="<?php echo $datos[0]["codigo"]; ?>">
<input type="image" src="<?php echo PROTOCOLO_CONEXION.RUTA_PDF."/imagenes/cargando.gif"; ?>">
</form>

<script>
form1.submit();
</script>
<?php  
  }die();
?>
