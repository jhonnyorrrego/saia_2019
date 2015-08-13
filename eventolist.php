<?php
include_once("db.php");
global $conn;

if(isset($_GET["archivo"]) && $_GET["archivo"]!="")
 {$dia=date("d");
  $mes=date("m");
  $anio=date("Y");
  
  $mes=$mes-1;
  if($mes<=0)
   {$mes=12+$mes;
    $anio--;
   }
  if($mes<10)
    $mes="0".$mes;
  $fecha="'".$anio."-".$mes."-".$dia."'";
  $eventos=busca_filtro_tabla("","evento",fecha_db_obtener("fecha","Y-m-d")."<='".date("Y-m-d")."' and ".fecha_db_obtener("fecha","Y-m-d").">=$fecha","",$conn);
  header('Content-Type: application/vnd.ms-excel');
  header("Content-Disposition: attachment; filename=log_ultimo_mes.xls");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  echo "<table border='1'><tr bgcolor='gray'><td>IDENTIFICADOR</td><td>USUARIO</td><td>FECHA</td><td>TABLA</td><td>EVENTO</td><td>DETALLE</td><td>CODIGO</td><td>ID DEL REGISTRO</td></tr>";
  for($i=0;$i<$eventos["numcampos"];$i++)
    {$funcionario=busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=".$eventos[$i]["funcionario_codigo"],"",$conn);
     echo "<tr><td>".$eventos[$i]["idevento"]."</td><td>".$funcionario[0]["nombres"]." ".$funcionario[0]["apellidos"]."</td><td>".$eventos[$i]["fecha"]."</td><td>".$eventos[$i]["tabla_e"]."</td><td>".$eventos[$i]["evento"]."</td><td>".$eventos[$i]["detalle"]."</td><td>".$eventos[$i]["codigo_sql"]."</td><td>".$eventos[$i]["registro_id"]."</td></tr>";
    }
  echo "</table>";  
  exit();
 }
$datos=busca_filtro_tabla("","busquedas","idbusquedas=8","",$conn);
$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=8","",$conn);
if($funciones<>"")
  {for($i=0; $i<$funciones["numcampos"]; $i++)
      {$id_func[]=$funciones[$i]["idfunciones_busqueda"];
      }
   $id_func=implode(",",$id_func);
  }
  

if($datos<>"")
  {
?>
<form name=form1 action="buscador/index.php" method="post">
<input type="hidden" name="busqueda" value="busqueda">
<input type="hidden" name="func_busqueda" value="<?php echo $id_func; ?>">
<input type="hidden" name="llave" value="<?php echo $datos[0]["llave"]; ?>">
<input type="hidden" name="registros" value="10">
<input type="hidden" name="tablas" value="tablas">
<input type="hidden" name="tabla" value="evento">
<input type="hidden" name="ordenar" value="<?php echo $datos[0]["ordenado"]; ?>">
<input type="hidden" name="orden" value="<?php echo $datos[0]["orden"]; ?>">
<input type="hidden" name="grafico" value="<?php echo $datos[0]["grafico"]; ?>">
<input type="hidden" name="subtitulo" value="<?php echo $datos[0]["subtitulo"]; ?>">
<input type="hidden" name="totales" value="<?php echo $datos[0]["totales"]; ?>">
<input type="hidden" name="sql" value="<?php echo str_replace('"',"'",$datos[0]["codigo"]); ?>">
<input type="image" src=<?php echo PROTOCOLO_CONEXION.RUTA_PDF."/imagenes/cargando.gif"; ?>">
</form>  
<script>
form1.submit();
</script>
<?php  
  }
?>
