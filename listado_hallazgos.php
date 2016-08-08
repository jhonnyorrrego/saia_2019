<?php
include_once("db.php");
$datos=busca_filtro_tabla("","busquedas","etiqueta like 'hallazgos'","",$conn);
$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=".$datos[0]["idbusquedas"],"",$conn);
if($funciones<>"")
  {for($i=0; $i<$funciones["numcampos"]; $i++)
      {$id_func[]=$funciones[$i]["idfunciones_busqueda"];
      }
   $id_func=implode(",",$id_func);
  }
$dep_funcionario=busca_filtro_tabla("dependencia_iddependencia","dependencia_cargo","funcionario_idfuncionario='".usuario_actual("idfuncionario")."' and estado=1","",$conn);  
$dependencias=extrae_campo($dep_funcionario,"dependencia_iddependencia","U");
$filtro_dep=" ";
foreach($dependencias as $fila)
  $filtro_dep.=" or b.responsables like '".$fila."#' ";
$codigo=" AND (b.responsables LIKE'".usuario_actual("funcionario_codigo")."' OR b.responsables LIKE '%,".usuario_actual("funcionario_codigo")."' OR b.responsables LIKE '".usuario_actual("funcionario_codigo").",%' OR b.responsables LIKE '%,".usuario_actual("funcionario_codigo").",%' $filtro_dep)";

if(isset($_REQUEST["tipo"])&&$_REQUEST["tipo"]=="pendiente")
{$datos[0]["codigo"]="SELECT key,documento__fecha,documento__descripcion FROM (SELECT a.iddocumento AS key,".fecha_db_obtener("a.fecha","Y-m-d H:i:s")." as documento__fecha, a.numero AS documento__numero,a.descripcion AS documento__descripcion,COUNT (*) OVER () total_rows,ROW_NUMBER () OVER (ORDER BY a.fecha desc) filas 
FROM documento a,ft_hallazgo b where b.documento_iddocumento=a.iddocumento and idft_hallazgo not in(SELECT idft_hallazgo FROM documento a,ft_hallazgo b,ft_seguimiento c WHERE c.ft_hallazgo=idft_hallazgo and idft_seguimiento in(select max(idft_seguimiento) from ft_seguimiento d where d.ft_hallazgo=b.idft_hallazgo) and c.porcentaje>=100 and b.documento_iddocumento=a.iddocumento) /*codigo_sql*/ and a.estado<>'ELIMINADO')";
}

if(isset($_REQUEST["tipo"])&&$_REQUEST["tipo"]=="terminados")
{$datos[0]["codigo"]="SELECT key,documento__fecha,documento__descripcion,porcentaje, logros, observaciones FROM (SELECT a.iddocumento AS key,".fecha_db_obtener("a.fecha","Y-m-d H:i:s")." as documento__fecha, a.numero AS documento__numero,a.descripcion AS documento__descripcion,c.porcentaje as porcentaje,c.logros_alcanzados as logros, c.observaciones as observaciones,COUNT (*) OVER () total_rows,ROW_NUMBER () OVER (ORDER BY a.fecha desc) filas FROM documento a,ft_hallazgo b,ft_seguimiento c WHERE c.ft_hallazgo=idft_hallazgo and idft_seguimiento in(select max(idft_seguimiento) from ft_seguimiento d where d.ft_hallazgo=b.idft_hallazgo) and c.porcentaje>=100 and b.documento_iddocumento=a.iddocumento  and a.estado<>'ELIMINADO' /*codigo_sql*/) ";
}

if(isset($_REQUEST["tipo"])&&$_REQUEST["tipo"]=="dependencia")
  $codigo=" and (secretarias like '%,".$_REQUEST["dependencia"]."' or secretarias like '".$_REQUEST["dependencia"].",%' or secretarias like '%,".$_REQUEST["dependencia"].",%' or secretarias like '".$_REQUEST["dependencia"]."') ";

$datos[0]["codigo"]=str_replace("/*codigo_sql*/",$codigo,$datos[0]["codigo"]);



//die($datos[0]["codigo"]);
//$hallazgo=busca_filtro_tabla("","ft_hallazgo","1=1","","",$conn);
//print_r($hallazgo);
//die();

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
<input type="hidden" name="tabla" value="ft_hallazgo,documento">
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