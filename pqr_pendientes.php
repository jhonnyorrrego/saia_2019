<?php
include_once("db.php");
global $conn;
if($_REQUEST["tipo"]=="pendientes")
  $idbusqueda=86;
elseif($_REQUEST["tipo"]=="todos")
  $idbusqueda=87;
elseif($_REQUEST["tipo"]=="todos_usuario")
  $idbusqueda=88; 

$datos=busca_filtro_tabla("","busquedas","idbusquedas=$idbusqueda","",$conn);
$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=86","",$conn);

if($funciones["numcampos"])
  {for($i=0; $i<$funciones["numcampos"]; $i++)
      {$id_func[]=$funciones[$i]["idfunciones_busqueda"];
      }
   $id_func=implode(",",$id_func);
  }
//print_r($conn);
//$datos[0]["codigo"]=str_replace("/*para_idfunci*/",usuario_actual("funcionario_codigo"),$datos[0]["codigo"]);
/*$rs=OCIParse($conn->Conn->conn,$datos[0]["codigo"]);

if(!@OCIExecute($rs,OCI_COMMIT_ON_SUCCESS))
  print_r(OCIError ($rs));
die(); */
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
<input type="hidden" name="tabla" value="ft_pqr,documento">
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
