<?php
include_once("db.php");
global $conn;
$datos=busca_filtro_tabla("","busquedas","etiqueta like 'Ingresos'","",$conn);
$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=".$datos[0]["idbusquedas"],"",$conn);
if($funciones<>"")
  {for($i=0; $i<$funciones["numcampos"]; $i++)
      {$id_func[]=$funciones[$i]["idfunciones_busqueda"];
      }
   $id_func=implode(",",$id_func);
  }
if(isset($_REQUEST["ejecutor"])&&$_REQUEST["ejecutor"])
 {$datos[0]["codigo"]=str_replace("/*filtro*/"," AND destinos in(select iddatos_ejecutor from ejecutor,datos_ejecutor where ejecutor_idejecutor=idejecutor and idejecutor=".$_REQUEST["ejecutor"].")",$datos[0]["codigo"]);
 }
if(isset($_REQUEST["elemento"])&&$_REQUEST["elemento"])
 {$datos[0]["codigo"]="SELECT key, documento__numero, documento__fecha FROM(SELECT A.iddocumento as key, A.numero as documento__numero,to_char(A.fecha,'yyyy-mm-dd hh24:mi:ss') as documento__fecha,
 COUNT(*) OVER () total_rows, ROW_NUMBER() OVER (ORDER BY A.fecha desc) FILAS FROM documento A,
ft_ingreso_elementos B WHERE B.documento_iddocumento=A.iddocumento and A.iddocumento in(select distinct ft_ingreso_elementos from acceso_elemento c,ft_item_elemento_ingreso d where (c.fecha_salida is null or c.fecha_ingreso is null) and c.documento_iddocumento=d.documento_iddocumento and d.codigo_elemento like '".$_REQUEST["elemento"]."') 
 )";
 }
if($datos<>"")
  {  

  ?>
<form name=form1 action="buscador/index.php" method="post">
<input type="hidden" name="busqueda" value="busqueda">
<input type="hidden" name="func_busqueda" value="<?php echo $id_func; ?>">
<input type="hidden" name="llave" value="<?php echo $datos[0]["llave"]; ?>">
<input type="hidden" name="orden" value="<?php echo $datos[0]["orden"]; ?>">
<input type="hidden" name="ordenar" value="<?php echo $datos[0]["ordenado"]; ?>">
<input type="hidden" name="registros" value="10">
<input type="hidden" name="tablas" value="tablas"> 
<input type="hidden" name="adicionales" value="no_encabezado,1">
<input type="hidden" name="tabla" value="ft_ingreso_elementos,documento">
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
