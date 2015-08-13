<?php
session_start();
include_once("db.php");
global $conn;
$datos=busca_filtro_tabla("A.*",DB.".busquedas A","idbusquedas=95","",$conn);
$funciones=busca_filtro_tabla("idfunciones_busqueda",DB.".funciones_busqueda","busquedas_idbusqueda=95","",$conn);

if($funciones["numcampos"]>0)
  {for($i=0;$i<$funciones["numcampos"];$i++)
      {
        $id_func[]=$funciones[$i]["idfunciones_busqueda"];
      }
   $id_func=implode(",",$id_func);
  }

$_REQUEST["estado"]=str_replace('?cmd=resetall','',$_REQUEST["estado"]);
if($datos["numcampos"]>0)
  {  
   if(strncmp ( $_REQUEST["estado"], "pensionado", 7)==0)
    {  $datos[0]["codigo"]=str_replace("activo","jubilado",$datos[0]["codigo"]);      
    }
   if(strncmp ( $_REQUEST["estado"], "retirado", 7)==0)
      $datos[0]["codigo"]=str_replace("activo","retirado",$datos[0]["codigo"]);         
  ?>
<form name=form1 action="buscador/index.php" method="post">
<input type="hidden" name="busqueda" value="busqueda">
<input type="hidden" name="func_busqueda" value="<?php echo $id_func; ?>">
<input type="hidden" name="llave" value="<?php echo $datos[0]["llave"]; ?>">
<input type="hidden" name="ordenar" value="<?php echo $datos[0]["ordenado"]; ?>">
<input type="hidden" name="orden" value="<?php echo $datos[0]["orden"]; ?>">
<input type="hidden" name="registros" value="10">
<input type="hidden" name="tipo_listado" value="<?php echo $_REQUEST["tipo_listado"]; ?>">
<input type="hidden" name="tablas" value="tablas">
<input type="hidden" name="tabla" value="documento,ft_hoja_vida">
<input type="hidden" name="grafico" value="<?php echo $datos[0]["grafico"]; ?>">
<input type="hidden" name="subtitulo" value="<?php echo $datos[0]["subtitulo"]; ?>">
<input type="hidden" name="totales" value="<?php echo $datos[0]["totales"]; ?>">
<input type="hidden" name="adicionales" value="estado,<?php echo $_REQUEST["estado"]; ?>;filtro,funcionario">
<input type="hidden" name="sql" value="<?php echo str_replace('"',"'",$datos[0]["codigo"]); ?>">
<input type="submit" name="" disabled value="Cargando...">
</form>  
<script>
form1.submit();
</script>
<?php  
  }
?>
