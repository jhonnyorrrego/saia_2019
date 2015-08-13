<?php
//session_start();
include_once("db.php");
global $conn;
//$id_func = array();
//$id_func1 = "";
$modulo=busca_filtro_tabla("","modulo","nombre='funcionario'","",$conn);
abrir_url($modulo[0]["enlace"],"centro");
$datos=busca_filtro_tabla("","busquedas","idbusquedas=2","",$conn);   //id de la busqueda
$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=2","",$conn);
if($funciones<>"")
  {for($i=0; $i<$funciones["numcampos"]; $i++)
      {$id_func[]=$funciones[$i]["idfunciones_busqueda"];
      }
   $id_func=implode(",",$id_func);
  }
/*function Descargar($ElFichero)
{ 
$TheFile = basename($ElFichero);
header( "Content-Type: application/octet-stream");
header( "Content-Length: ".filesize($ElFichero)); 
header( "Content-Disposition: attachment; filename=".$TheFile); 
readfile($ElFichero); 
}

$archivoIntranet="../usuariosIntranet.txt";
if(isset($_GET["archivo"]) && $_GET["archivo"]!="")
 { Descargar($_GET["archivo"]);
   exit();
 }
else*/
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
<input type="hidden" name="tabla" value="funcionario,perfil">
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
