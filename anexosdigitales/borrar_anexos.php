<script>
function cerrar(){
if(parent.window.hs) {
		var exp = parent.window.hs.getExpander("el_<?php echo $_REQUEST["idanexo"];?>");
		if (exp) {
			exp.close();
		}
	}
}

function recargar_centro(iddocumento) {
	parent.location.reload();
	if(parent.frames['arbol_formato']) {
		parent.frames['arbol_formato'].postMessage({iddocumento: iddocumento}, "*");
	} else if(parent.parent.frames['arbol_formato']) {
		parent.parent.frames['arbol_formato'].postMessage({iddocumento: iddocumento}, "*");
	} else if(parent.parent.parent.frames['arbol_formato']) {
		parent.parent.parent.frames['arbol_formato'].postMessage({iddocumento: iddocumento}, "*");
	} else {
		console.log("No existe el frame arbol_formato");
	}

}
</script>
<?php
include_once("funciones_archivo.php");

if(isset($_REQUEST["Eliminar"])&&isset($_REQUEST["idanexo"])) // Permisos a una anexo ALMACENADO
{
  $idanexo=$_REQUEST["idanexo"];
  $anexo=busca_filtro_tabla("","anexos","idanexos=".$idanexo,"",$conn);
  if($anexo["numcampos"]>0)
     {
       $idanexo=$_REQUEST["idanexo"];
       $iddocumento = $anexo[0]["documento_iddocumento"];
       borrar($idanexo);
       echo "Anexo Eliminado";
       echo "<script> cerrar(); recargar_centro($iddocumento);</script>";
     }
    else
    {
     echo "No se encontraron los datos del anexo al confirmar la eliminacion";
     }
  exit();
}
elseif(isset($_REQUEST["idanexo"]))// Obtiene el parametro y verifica la existencia del anexo
{  $idanexo=$_REQUEST["idanexo"];
    $anexo=busca_filtro_tabla("","anexos","idanexos=".$idanexo,"",$conn);
    if(!$anexo["numcampos"]>0) // Se recibe un anexo invalido no se imprime el formulario
    { alerta("No se encontraron los datos del anexo a eliminar",'error',4000);
      exit();
     }
 }
else
{
 echo ("No se recibio la informacion del anexo");
  exit();
 }


?>
<html>
<head>
</head>
<style type="text/css">
<!--
body,text,textarea,submit,tr{
font-size:12px; font-family: Verdana,Tahoma,arial;
}
-->
</style>
<form name="borraranexo" id="borraranexo" action="borrar_anexos.php" method="POST">
<b>Confirmar la eliminacion</b>
<table aling="center" >
<tr><td></td></tr>
<tr><td>Archivo : <b> <?php echo $anexo[0]["etiqueta"];?> </b> </td></tr>
<tr><td><input type="hidden" name="idanexo" value="<?php echo $_REQUEST["idanexo"];?>"></td></tr>
<tr><td></td></tr>
<tr><td><input type="submit" name="Eliminar" value="Eliminar"></td><td></td>
</table>
</form>
</html>
