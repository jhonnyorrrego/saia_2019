<?php
/*
<Clase>
<Nombre>devolveradd
<Parametros>
<Responsabilidades>Este archivo se encarga de listar los documentos que aparecen en el sistema como prestados
                   para asi registrar su devolucion, lo hace con checklist, de manera que al chequear
                   el cajon y aceptar puedo ir al formulario de almacenamiento para indicar donde se guardará
                   el documento
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
?>
<?php

?>
<?php include ("db.php") ?>
<?php include ("phpmkrfn.php") ?>
<?php include ("header.php") ?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {
if (EW_this.x_numero && !EW_hasValue(EW_this.x_numero, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_numero, "TEXT", "Por favor ingrese los campos requeridos - numero"))
		return false;
}
return true;
}

//-->
</script>
<p><span class="internos">
RETORNO DE EJEMPLARES<br></span></p>
<form name="aprueba_prestamo" id="aprueba_prestamo" action="aprueba_prestamo.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_add" value="A">
<?php
$prestados = busca_filtro_tabla("B.idsolicitud, A.nombres, A.apellidos, C.descripcion, C.numero, to_char(D.fecha_inicial, 'YYYY/MM/DD HH24:MI:SS') as fecha_inicial, to_char(D.fecha_final, 'YYYY/MM/DD HH24:MI:SS') as fecha_final","funcionario A, solicitud B, documento C, reserva D", "B.investigador_idinvestigador=A.funcionario_codigo AND D.solicitud_idsolicitud=B.idsolicitud AND B.estado='APROBADO' AND B.documento_iddocumento=C.iddocumento", "", $conn);
if($prestados["numcampos"]>0)
{
?>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr class="encabezado_list">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">DEVOLUCION</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">PRESTADO A</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">DOCUMENTO</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">DESDE</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">HASTA</span></td>
	</tr>
  <?php
  for($i=0; $i<$prestados["numcampos"]; $i++)
  {
   	// Colores de las filas alternados
	  $sItemRowClass = " bgcolor=\"#FFFFFF\"";
	  if ($i % 2 <> 0)
		  $sItemRowClass = " bgcolor=\"#F5F5F5\"";
		if(comparaFecha($prestados[$i]["fecha_final"],date("Y-m-d H:i:s"))==2)
		  $sItemRowClass = " bgcolor=\"#fff380\"";
		
		echo "<tr ".$sItemRowClass.">";  
    echo "<td><input type=\"checkbox\" name=\"documentos[]\" value=\"".$prestados[$i]["idsolicitud"]."\"></td>";
    echo "<td>".$prestados[$i]["nombres"]." ".$prestados[$i]["apellidos"]."</td>";
    echo "<td>".$prestados[$i]["numero"]." ".$prestados[$i]["descripcion"]."</td>";
    echo "<td>".$prestados[$i]["fecha_inicial"]."</td>";
    echo "<td>".$prestados[$i]["fecha_final"]."</td>";
    echo "</tr>";
  }
  ?>
</table>
<p>
<input type="button" name="Action" value="Devolver" onclick="llama_almacenamiento()">
<?php
}
else
  echo "No existen documentos en prestamo";
?>

</form>
<?php include ("footer.php") ?>
<script>
/*
<Clase>
<Nombre>llama_almacenamiento
<Parametros>
<Responsabilidades>llama al formulario del almacenamiento pasandole como parametro el listado de documentos 
                  que se van a devolver
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function llama_almacenamiento()
{
  var devueltos = "";
  var vector = document.getElementsByName('documentos[]');
  for(var i=0; i<vector.length; i++)
    if(vector[i].checked==1)
      if(devueltos=="")
        devueltos = vector[i].value;
      else
        devueltos += "," + vector[i].value;
  if(devueltos=="")
    alert('No se ha elegido ningun documento');
  else
    window.location="almacenamientoadd.php?documentos="+devueltos+"&posicion=0&tipo='devolucion'"; 
}
</script>
<?php
/*
<Clase>
<Nombre>comparafecha
<Parametros>$fecha1, $fecha2: fechas a comparar
<Responsabilidades>comparar las dos fechas para determinar cual es mayor o si son iguales
<Notas>retorna 0 si fecha1=fecha2
       retorna 1 si fecha1<fecha2
       retorna 2 si fecha1>fecha2
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function comparaFecha($fecha1, $fecha2)
{
  $an1=substr($fecha1,0,4);
  $an2=substr($fecha2,0,4);
  if($an1>$an2)
    return 2;
  if($an1<$an2)
    return 1;
  $mes1=substr($fecha1,5,2);
  $mes2=substr($fecha2,5,2);
  if($mes1>$mes2)
    return 2;
  if($mes1<$mes2)
    return 1;
  $dia1=substr($fecha1,8,2);
  $dia2=substr($fecha2,8,2);
  if($dia1>$dia2)
    return 2;
  if($dia1<$dia2)
    return 1;
  $hora1=substr($fecha1,11,2);
  $hora2=substr($fecha2,11,2);
  if($hora1>$hora2)
    return 2;
  if($hora1<$hora2)
    return 1;
  $min1=substr($fecha1,14,2);
  $min2=substr($fecha2,14,2);
  if($min1>$min2)
    return 2;
  if($min1<$min2)
    return 1;
  $seg1=substr($fecha1,17,2);
  $seg2=substr($fecha2,17,2);
  if($seg1>$seg2)
    return 2;
  if($seg1<$seg2)
    return 1;
  return 0;
}
?>
