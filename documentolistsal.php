<?php
session_start();
include_once("db.php");
global $conn;

$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}

if(isset($_REQUEST["generar_consecutivo"]) && $_REQUEST["generar_consecutivo"]!='')
 {
  $doc=generar_ingreso("radicacion_salida");
  $_REQUEST["estado"]='INICIADO';
  redirecciona("colilla.php?generar_consecutivo=radicacion_salida&enlace=pantallas/buscador_principal.php?idbusqueda=10");//colilla.php?key=$doc&enlace=documentolistsal.php?estado=INICIADO
  die();
 }
if(isset($_REQUEST["estado"]))
{
	$datos=busca_filtro_tabla("","busquedas","idbusquedas=63","",$conn);
  $funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=63","idfunciones_busqueda",$conn);
  if($funciones["numcampos"])
   {for($i=0;$i<$funciones["numcampos"];$i++)
       {$id_func[]=$funciones[$i]["idfunciones_busqueda"];
       }
    $id_func=implode(",",$id_func);
   }
}
else
{
	$modulo=busca_filtro_tabla("","modulo","nombre='lsalidas'","",$conn);
	abrir_url($ruta_db_superior.$modulo[0]["enlace"],"_parent");
 $datos=busca_filtro_tabla("","busquedas","idbusquedas=15","",$conn);
 $funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=15","idfunciones_busqueda",$conn);
  if($funciones["numcampos"])
   {for($i=0;$i<$funciones["numcampos"];$i++)
       {$id_func[]=$funciones[$i]["idfunciones_busqueda"];
       }
    $id_func=implode(",",$id_func);
   }
}
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
<!--input type="hidden" name="tabla" value="documento,serie"-->
<?php
if(isset($_REQUEST["estado"]))
  echo '<input type="hidden" name="tabla" value="documento">';
else  
  echo '<input type="hidden" name="tabla" value="documento,serie">';
?>  
<input type="hidden" name="grafico" value="<?php echo $datos[0]["grafico"]; ?>">
<input type="hidden" name="subtitulo" value="<?php echo $datos[0]["subtitulo"]; ?>">
<input type="hidden" name="totales" value="<?php echo $datos[0]["totales"]; ?>">
<!--input type="hidden" name="adicionales" value="tipo_radicado,2;pantalla,ejecutados"-->
<input type="hidden" name="sql" value="<?php echo rawurlencode($datos[0]["codigo"]); ?>">
<input type="image" src="<?php echo PROTOCOLO_CONEXION.RUTA_PDF."/imagenes/cargando.gif"; ?>">
<?php
if(isset($_REQUEST["estado"]))
  echo '<input type="hidden" name="adicionales" value="pantalla,ejecutados;tipo_radicado,2">';
else
  echo '<input type="hidden" name="adicionales" value="pantalla,ejecutados;tipo_radicado,2">';  
?>
</form>  
<script>
form1.submit();
</script>
<?php  
  }die(); 
?>
