<?php
include_once("../../db.php");
$datos=busca_filtro_tabla("","busquedas","lower(etiqueta) like 'mis seguimientos'","",$conn);

$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=".$datos[0]["idbusquedas"],"",$conn);
if($funciones<>"")
  {for($i=0; $i<$funciones["numcampos"]; $i++)
      {$id_func[]=$funciones[$i]["idfunciones_busqueda"];
      }
   $id_func=implode(",",$id_func);
  }
$usu=usuario_actual("funcionario_codigo");
$datos[0]["codigo"]=str_replace("/*filtro*/"," and (responsable_seguimiento like '$usu' or responsable_seguimiento like '%,$usu' or responsable_seguimiento like '$usu,%' or responsable_seguimiento like '%,$usu,%')",$datos[0]["codigo"]);
//die($datos[0]["codigo"]);
if($datos["numcampos"])
  {
?>
<form name=form1 action="../../buscador/index.php" method="post">
<input type="hidden" name="busqueda" value="busqueda">
<input type="hidden" name="func_busqueda" value="<?php echo $id_func; ?>">
<input type="hidden" name="llave" value="<?php echo $datos[0]["llave"]; ?>">
<input type="hidden" name="registros" value="10">
<input type="hidden" name="tablas" value="tablas">
<input type="hidden" name="tabla" value="ft_seguimiento,documento">
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
  }
?>
