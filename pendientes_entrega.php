<?php
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
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."calendario/calendario.php");
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
include_once($ruta_db_superior."funciones.php");
?><?php
global $conn;
//---------Saco la fecha actual ----------------
$fecha_actual = date("Y-m-d");
//---------Saco la fecha futura un dia mas para ponerla en el encabezado ---------------
$hoy = busca_filtro_tabla(suma_fechas("'$fecha_actual'",1,"DAY"));

//---------Saco el funcionario codigo para que en la siguiente consulta sacar sus pendientes -----------------
$funcionario = usuario_actual("funcionario_codigo");
//---------Consulta para sacar los pendientes del funcionario----------------------
$doc = busca_filtro_tabla("b.*","asignacion a, documento b","a.entidad_identidad=1 and a.llave_entidad=$funcionario and a.estado='PENDIENTE' and a.tarea_idtarea=2 and b.iddocumento=documento_iddocumento","",$conn);

//----- $texto: Variable que contiene todo el cuerpo del documento la cual se imprime de ultimo.
$texto .= '<table border="1px" style="border-collapse:collapse" width="100%">';
$texto .= '<tr><td colspan="4" class="encabezado" style="text-align:center"
 title="Los siguientes son los pendientes h&aacute;biles de hoy y ma&ntilde;ana">
 <strong>PENDIENTES H&Aacute;BILES DE HOY Y MA&Ntilde;ANA<br><br>Dias mayor a '.$fecha_actual.' y menor a '.$hoy[0][0].'</strong></td></tr>
<tr><td class="encabezado" style="text-align:center" width="10px">Numero</td>
<td class="encabezado">Descripcion</td>
<td class="encabezado">Plantilla</td>
<td class="encabezado" width="60px">Dias habiles</td>
</tr>';

$datos = null;
for($i=0;$i<$doc["numcampos"];$i++){
  $valor = fecha_respuesta($doc[$i]["iddocumento"]);
  
  if($valor == "No Asignado (Urgente)")
    $valor[0] = 0;
  else{
    $valor = explode("<br>",$valor);
    $valor = explode("Dias",$valor[1]);
  }  

  if($valor[0] == 0 || $valor[0] == 1){
    $texto .= '<tr>';
    $texto .= '<td style="text-align:center">'.$doc[$i]["numero"].'</td>';
    $texto .= '<td>'.$doc[$i]["descripcion"].'</td>';
    //$texto .= '<td>'.$doc[$i]["estado"].'</td>';
    $texto .= '<td>'.$doc[$i]["plantilla"].'</td>';
    $texto .= '<td>No Asignado (Urgente)</td>';
    $texto .= '</tr>';
    $datos = true;
  } 
}
if($datos == null)
  $texto .= '<tr><td colspan="4">No se encontraron datos</td></tr>';
$texto .= "</table>";
$texto .= '<hr width="100%" align="left">';

$semana1 = busca_filtro_tabla(suma_fechas("'$fecha_actual'",2,"DAY"));
$semana2 = busca_filtro_tabla(suma_fechas("'$fecha_actual'",7,"DAY"));

$texto .= '<table border="1px" style="border-collapse:collapse" width="100%">';
$texto .= '<tr><td colspan="4" class="encabezado" style="text-align:center" title="Los siguientes son los pendientes h&aacute;biles de 2 dias hasta 7 dias despues">
<strong>PENDIENTES H&Aacute;BILES HASTA UNA SEMANA<br><br>Dias mayor a '.$semana1[0][0].' y menor a '.$semana2[0][0].'</strong></td></tr>
<tr><td class="encabezado" style="text-align:center" width="10px">Numero</td>
<td class="encabezado">Descripcion</td>
<td class="encabezado">Plantilla</td>
<td class="encabezado" width="60px">Dias habiles</td></tr>';
$datos = null;
for($i=0;$i<$doc["numcampos"];$i++){
  $valor = fecha_respuesta($doc[$i]["iddocumento"]);
  
  if($valor == "No Asignado (Urgente)")
    $valor[0] = 0;
  else{
    $valor = explode("<br>",$valor);
    $valor = explode("Dias",$valor[1]);
  }  

  if($valor[0] >= 2 && $valor[0] < 8){
    $texto .= '<tr>';
    $texto .= '<td style="text-align:center">'.$doc[$i]["numero"].'</td>';
    $texto .= '<td>'.$doc[$i]["descripcion"].'</td>';
    //$texto .= '<td>'.$doc[$i]["estado"].'</td>';
    $texto .= '<td>'.$doc[$i]["plantilla"].'</td>';
    $texto .= '<td>'.$valor[0].'</td>';
    $texto .= '</tr>';
    $datos = true;
  } 
}
if($datos == null)
  $texto .= '<tr><td colspan="4">No se encontraron datos</td></tr>';
$texto .= "</table>";
$texto .= '<hr width="100%" align="left">';

$mes1 = busca_filtro_tabla(suma_fechas("'$fecha_actual'",8,"DAY"));
$mes2 = busca_filtro_tabla(suma_fechas("'$fecha_actual'",30,"DAY"));

$texto .= '<table border="1px" style="border-collapse:collapse" width="100%">';
$texto .= '<tr><td colspan="4" class="encabezado" style="text-align:center" title="Los siguientes son los pendientes h&aacute;biles de 8 dias hasta 30 dias despues">
<strong>PENDIENTES H&Aacute;BILES HASTA UN MES<br><br>Dias mayor a '.$mes1[0][0].' y menor a '.$mes2[0][0].'</strong></td></tr>
<tr><td class="encabezado" style="text-align:center" width="10px">Numero</td>
<td class="encabezado">Descripcion</td>
<td class="encabezado">Plantilla</td><td class="encabezado" width="60px">Dias habiles</td></tr>';
$datos = null;
for($i=0;$i<$doc["numcampos"];$i++){
  $valor = fecha_respuesta($doc[$i]["iddocumento"]);
  
  if($valor == "No Asignado (Urgente)")
    $valor[0] = 0;
  else{
    $valor = explode("<br>",$valor);
    $valor = explode("Dias",$valor[1]);
  }  

  if($valor[0] >= 8 && $valor[0] < 31){
    $texto .= '<tr>';
    $texto .= '<td style="text-align:center">'.$doc[$i]["numero"].'</td>';
    $texto .= '<td>'.$doc[$i]["descripcion"].'</td>';
    //$texto .= '<td>'.$doc[$i]["estado"].'</td>';
    $texto .= '<td>'.$doc[$i]["plantilla"].'</td>';
    $texto .= '<td>'.$valor[0].'</td>';
    $texto .= '</tr>';
    $datos = true;
  } 
}
if($datos == null)
  $texto .= '<tr><td colspan="4">No se encontraron datos</td></tr>';
$texto .= "</table>";

$mayor = busca_filtro_tabla(suma_fechas("'$fecha_actual'",31,"DAY"));

$texto .= '<hr width="100%" align="left">';

$texto .= '<table border="1px" style="border-collapse:collapse" width="100%">';
$texto .= '<tr><td colspan="4" class="encabezado" style="text-align:center" title="Los siguientes son los pendientes h&aacute;biles mas de 31 dias">
<strong>PENDIENTES H&Aacute;BILES MAS DE UN MES<br><br>Dias mayor a '.$mayor[0][0].'</strong></td>
            </tr><tr><td class="encabezado" style="text-align:center" width="10px">Numero</td>
            <td class="encabezado">Descripcion</td>
            <td class="encabezado">Plantilla</td>
            <td class="encabezado" width="60px">Dias habiles</td></tr>';

$datos = null;
for($i=0;$i<$doc["numcampos"];$i++){
  $valor = fecha_respuesta($doc[$i]["iddocumento"]);
  
  if($valor == "No Asignado (Urgente)")
    $valor[0] = 0;
  else{
    $valor = explode("<br>",$valor);
    $valor = explode("Dias",$valor[1]);
  }  

  if($valor[0] >= 31){
    $texto .= '<tr>';
    $texto .= '<td style="text-align:center">'.$doc[$i]["numero"].'</td>';
    $texto .= '<td>'.$doc[$i]["descripcion"].'</td>';
    //$texto .= '<td>'.$doc[$i]["estado"].'</td>';
    $texto .= '<td>'.$doc[$i]["plantilla"].'</td>';
    $texto .= '<td>'.$valor[0].'</td>';
    $texto .= '</tr>';
    $datos = true;
  } 
}
if($datos == null)
  $texto .= '<tr><td colspan="4">No se encontraron datos</td></tr>';
$texto .= "</table>";

echo $texto;


?>