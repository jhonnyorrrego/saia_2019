<?php
session_start();
include_once("db.php");

if(!isset($_REQUEST["fecha_inicio"]))
{include_once("header.php");
 include_once("calendario/calendario.php");
 ?>
 <script type="text/javascript" src="js/jquery.js"></script>
 <script type="text/javascript" src="js/jquery.validate.js"></script>
 <script>
  $().ready(function() {
	$('#form1').validate();	
});
 </script>
 <br><b>Ver documentos Anulados que se crearon entre</b><br><br>
 <form id="form1" action="anuladoslist.php" method="post">
 <table>
 <tr>
 <td class="encabezado">FECHA INICIO</td>
 <td><input readonly="true" type="text" name="fecha_inicio" id="fecha_inicio" class="required">
 <?php selector_fecha("fecha_inicio","form1","Y-m-d",date("m"),date("Y"),"default.css","","AD:VALOR","VENTANA",FALSE,false); ?>
 </td>
 </tr>
 <tr>
 <td class="encabezado">FECHA FIN</td>
 <td><input readonly="true"  type="text" name="fecha_fin" id="fecha_fin" class="required">
 <?php selector_fecha("fecha_fin","form1","Y-m-d",date("m"),date("Y"),"default.css","","AD:VALOR","VENTANA",FALSE,false); ?>
 </td>
 </tr>
 <tr>
 <td colspan=2><input type="submit" value="Ir al listado"></td>
 </tr>
 </table>
 </form>
 <?php
 include_once("footer.php");
}
else{
global $conn;
$datos=busca_filtro_tabla("","busquedas","etiqueta='Anulados'","",$conn);
$modulo=busca_filtro_tabla("","modulo","nombre='documentos_anulados'","",$conn);
abrir_url($modulo[0]["enlace"],"centro");
$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=".$datos[0]["idbusquedas"],"",$conn);
if($funciones["numcampos"])
{for($i=0;$i<$funciones["numcampos"];$i++)
    {$id_func[]=$funciones[$i]["idfunciones_busqueda"];
    }
 $id_func=implode(",",$id_func);
}

$datos[0]["codigo"]=str_replace("/*filtro*/"," and ".fecha_db_obtener("fecha","Y-m-d")."<='".$_REQUEST["fecha_fin"]."' and ".fecha_db_obtener("fecha","Y-m-d").">='".$_REQUEST["fecha_inicio"]."'",$datos[0]["codigo"]);
//die($datos[0]["codigo"]);
if($datos["numcampos"])
  {  
?>
<form name=form1 action="buscador/index.php" method="get">
<input type="hidden" name="busqueda" value="busqueda">
<input type="hidden" name="func_busqueda" value="<?php echo $id_func; ?>">
<input type="hidden" name="llave" value="<?php echo $datos[0]["llave"]; ?>">
<input type="hidden" name="registros" value="10">
<input type="hidden" name="tablas" value="tablas">
<input type="hidden" name="ordenar" value="<?php echo $datos[0]["ordenado"]; ?>">
<input type="hidden" name="orden" value="<?php echo $datos[0]["orden"]; ?>">
<input type="hidden" name="tabla" value="documento">
<input type="hidden" name="grafico" value="<?php echo $datos[0]["grafico"]; ?>">
<input type="hidden" name="subtitulo" value="<?php echo $datos[0]["subtitulo"]; ?>">
<input type="hidden" name="totales" value="<?php echo $datos[0]["totales"]; ?>">
<input type="hidden" name="sql" value="<?php echo rawurlencode($datos[0]["codigo"]); ?>">
<input type="hidden" name="adicionales" value="pantalla,anulados;fecha_inicio,<?php echo $_REQUEST["fecha_inicio"]; ?>;fecha_fin,<?php echo $_REQUEST["fecha_fin"]; ?>">
<input type="image" src="<?php echo PROTOCOLO_CONEXION.RUTA_PDF."/imagenes/cargando.gif"; ?>">
</form>  
<script>
form1.submit();
</script>
<?php  
  }die();
}  
?>

