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
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
?><?php
global $conn;
$fecha_actual = date("Y-m-d h:i:s");
$fecha_actual2 = date("Y-m-d");
$funcionario = usuario_actual("funcionario_codigo");

$hoy_dias = busca_filtro_tabla(suma_fechas(fecha_db_almacenar($fecha_actual2),-1,"DAY"));

$hoy = busca_filtro_tabla("a.*,documento_iddocumento,".resta_fechas(fecha_db_almacenar($fecha_actual,"a.fecha_creacion"))."as dias_pendientes","asignacion b,documento a","b.entidad_identidad=1 and b.llave_entidad=$funcionario and b.estado='PENDIENTE' and b.tarea_idtarea=2 and ".resta_fechas(fecha_db_almacenar($fecha_actual),fecha_db_almacenar("a.fecha_creacion"))."=0  or ".resta_fechas(fecha_db_almacenar($fecha_actual),fecha_db_almacenar("a.fecha_creacion"))."=1 and documento_iddocumento=iddocumento","",$conn);
print_r($hoy);
$texto .= '<table border="1px" style="border-collapse:collapse" width="100%">';
$texto .= '<tr><td colspan="4" class="encabezado" style="text-align:center" title="Los siguientes son los pendientes de hoy y ayer, en la columna dias si es igual a 0 es de hoy">
<strong>PENDIENTES DE HOY Y AYER<br><br>Dias entre '.$hoy_dias[0][0].' y '.$fecha_actual2.'</strong></td></tr>
<tr><td class="encabezado" style="text-align:center" width="10px">Numero</td>
<td class="encabezado">Descripcion</td>
<td class="encabezado" style="text-align:center">Plantilla</td>
<td class="encabezado" width="60px">Dias</td>
</tr>';
if($hoy["numcampos"] == 0)
  $texto .= '<tr><td colspan="4">No se encontraron pendientes</td></tr>';
for($i=0;$i<$hoy["numcampos"];$i++){
   $texto .= '<tr>';
    $texto .= '<td style="text-align:center">'.$hoy[$i]["numero"].'</td>';
    $texto .= '<td>'.$hoy[$i]["descripcion"].'</td>';
    //$texto .= '<td>'.$hoy[$i]["estado"].'</td>';
    $texto .= '<td style="text-align:center">'.$hoy[$i]["plantilla"].'</td>';
    $texto .= '<td>'.$hoy[$i]["dias_pendientes"].'</td>';
    //$texto .= '<td><a href="http://'.RUTA_PDF.'/ordenar.php?accion=mostrar&mostrar_formato=1&key='.$hoy[$i]["iddocumento"].'">DETALLES</a></td>';
    $texto .= '</tr>';
  
}
$texto .= '</table>';
$texto .= '<hr width="100%" align="left">';

$semana_dias1 = busca_filtro_tabla(suma_fechas("'$fecha_actual2'",-2,"DAY"));
$semana_dias2 = busca_filtro_tabla(suma_fechas("'$fecha_actual2'",-7,"DAY"));

$semana = busca_filtro_tabla("a.*,documento_iddocumento,".resta_fechas("'$fecha_actual'","a.fecha_creacion")."as dias_pendientes","asignacion b,documento a","b.entidad_identidad=1 and b.llave_entidad=$funcionario and b.estado='PENDIENTE' and b.tarea_idtarea=2 and ".resta_fechas("'$fecha_actual'","a.fecha_creacion").">=2 and ".resta_fechas("'$fecha_actual'","a.fecha_creacion")."<8 and documento_iddocumento=iddocumento","",$conn);

$texto .= '<table border="1px" style="border-collapse:collapse" width="100%">';
$texto .= '<tr><td colspan="4" class="encabezado" style="text-align:center" title="Documentos pendientes desde hace 2 dias hasta 7 dias atras">
<strong>PENDIENTES DE UNA SEMANA<br><br>Dias entre '.$semana_dias2[0][0].' y '.$semana_dias1[0][0].'</strong></td></tr>
<tr><td class="encabezado" style="text-align:center" width="10px">Numero</td>
<td class="encabezado">Descripcion</td><td class="encabezado">Plantilla</td>
<td class="encabezado" width="60px"">Dias</td></tr>';
if($semana["numcampos"] == 0)
  $texto .= '<tr><td colspan="4">No se encontraron pendientes del rango de hace 2 dias hasta 7 dias</td></tr>';
for($i=0;$i<$semana["numcampos"];$i++){
   $texto .= '<tr>';
    $texto .= '<td style="text-align:center">'.$semana[$i]["numero"].'</td>';
    $texto .= '<td>'.$semana[$i]["descripcion"].'</td>';
    //$texto .= '<td>'.$semana[$i]["estado"].'</td>';
    $texto .= '<td>'.$semana[$i]["plantilla"].'</td>';
    $texto .= '<td>'.$semana[$i]["dias_pendientes"].'</td>';
    //$texto .= '<td><a href="http://'.RUTA_PDF.'/ordenar.php?accion=mostrar&mostrar_formato=1&key='.$semana[$i]["iddocumento"].'">DETALLES</a></td>';
    $texto .= '</tr>';
  
}

$texto .= '</table>';
$texto .= '<hr width="100%" align="left">';

$mes_dias1 = busca_filtro_tabla(suma_fechas("'$fecha_actual2'",-8,"DAY"));
$mes_dias2 = busca_filtro_tabla(suma_fechas("'$fecha_actual2'",-30,"DAY"));

$mes = busca_filtro_tabla("a.*,documento_iddocumento,".resta_fechas("'$fecha_actual'","a.fecha_creacion")."as dias_pendientes","asignacion b,documento a","b.entidad_identidad=1 and b.llave_entidad=$funcionario and b.estado='PENDIENTE' and b.tarea_idtarea=2 and ".resta_fechas("'$fecha_actual'","a.fecha_creacion").">=8 and ".resta_fechas("'$fecha_actual'","a.fecha_creacion")."<31 and documento_iddocumento=iddocumento","",$conn);

$texto .= '<table border="1px" style="border-collapse:collapse" width="100%">';
$texto .= '<tr><td colspan="4" class="encabezado" style="text-align:center" title="Documentos pendientes desde hace 8 dias hasta 30 dias atras">
<strong>PENDIENTES DE UN MES<br><br>Dias entre '.$mes_dias2[0][0].' y '.$mes_dias1[0][0].'</strong></td></tr>
<tr><td class="encabezado" style="text-align:center" width="10px">Numero</td>
<td class="encabezado">Descripcion</td><td class="encabezado">Plantilla</td>
<td class="encabezado" width="60px">Dias</td></tr>';
if($mes["numcampos"] == 0)
  $texto .= '<tr><td colspan="4">No se encontraron pendientes del rango de hace 8 dias hasta 30 dias atras</td></tr>';
for($i=0;$i<$mes["numcampos"];$i++){
   $texto .= '<tr>';
    $texto .= '<td style="text-align:center">'.$mes[$i]["numero"].'</td>';
    $texto .= '<td>'.$mes[$i]["descripcion"].'</td>';
    //$texto .= '<td>'.$mes[$i]["estado"].'</td>';
    $texto .= '<td>'.$mes[$i]["plantilla"].'</td>';
    $texto .= '<td>'.$mes[$i]["dias_pendientes"].'</td>';
    //$texto .= '<td><a href="http://'.RUTA_PDF.'/ordenar.php?accion=mostrar&mostrar_formato=1&key='.$mes[$i]["iddocumento"].'">DETALLES</a></td>';
    $texto .= '</tr>';
  
}

$texto .= '</table>';
$texto .= '<hr width="100%" align="left">';

$mas = busca_filtro_tabla("a.*,documento_iddocumento,".resta_fechas("'$fecha_actual'","a.fecha_creacion")."as dias_pendientes","asignacion b,documento a","b.entidad_identidad=1 and b.llave_entidad=$funcionario and b.estado='PENDIENTE' and b.tarea_idtarea=2 and ".resta_fechas("'$fecha_actual'","a.fecha_creacion").">=31 and documento_iddocumento=iddocumento","",$conn);

$texto .= '<table border="1px" style="border-collapse:collapse" width="100%">';
$texto .= '<tr><td class="encabezado" colspan="3" style="text-align:center" title="Documentos pendientes mayor a 31 dias"><strong>PENDIENTES MAS DE UN MES</strong></td></tr><tr><td class="encabezado" width="30px">Cantidad</td>';
$texto .= '<td>'.$mas["numcampos"].'</td><td><a href="pendienteslist.php">Ir a pendientes</a></td></tr>';
               
echo $texto;



?>