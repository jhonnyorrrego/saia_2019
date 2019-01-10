<?php
@set_time_limit(0);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", true); 
header("Pragma: no-cache");
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");

$texto="";

if($_REQUEST["export"]=="excel"){
  header('Content-Type: application/vnd.ms-excel');
  header("Content-Disposition: attachment; filename=documentos_entregados.xls");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
}
else{
  $texto.="<p align='right'><a href='planilla_control.php?export=excel&docs=".$_REQUEST["docs"]."'><img src='".$ruta_db_superior."enlaces/excel.gif' alt='Excel'></a></p>";
}
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
include_once($ruta_db_superior."pantallas/documento/librerias_tramitados.php");

$documentos=explode(",",@$_REQUEST["docs"]);
$docs=array_filter($documentos);

//if(usuario_actual('login')=='cerok'){
$registros=busca_filtro_tabla("plantilla,iddocumento","documento","iddocumento in(".implode(",",$docs).")","plantilla asc",$conn);
//}

//$documentos=busca_filtro_tabla("r.*,numero,iddocumento,fecha,paginas","ft_radicacion_entrada r,documento A","documento_iddocumento=iddocumento and A.iddocumento in(".implode(",",$docs).")","",$conn);
if(usuario_actual('login')=='cerok'){
  //print_r($registros);
}
//print_r($registros);

if(!isset($_REQUEST["export"])){
  $texto.='<script src="'.$ruta_db_superior.'js/noty/jquery.noty.js" type="text/javascript" charset="utf-8"></script>';
    $texto.='<script src="'.$ruta_db_superior.'js/noty/layouts/topCenter.js" type="text/javascript" charset="utf-8"></script>';
    $texto.='<script src="'.$ruta_db_superior.'js/noty/themes/default.js" type="text/javascript" charset="utf-8"></script>';
    $texto.='<script src="'.$ruta_db_superior.'pantallas/lib/librerias_notificaciones.js" type="text/javascript" charset="utf-8"></script>';
?>
  <script src="<?php echo($ruta_db_superior); ?>js/jquery.js"></script>
  <input type="hidden" id="docs" value="<?php echo(implode(",",$docs)); ?>">
  <script>
  </script>
    <?php
}
$texto.='<table style="border-collapse:collapse;width:100%" border="1px">';
$texto.='<tr>';
$texto.='<td style="text-align:center;" colspan="2" rowspan="2"><img src="'.$ruta_db_superior.'imagenes/logo_demo.jpg"></td>';
$texto.='<td style="text-align:center" colspan="5" rowspan="2"><b>PLANILLA DE CONTROL DE COMUNICACIONES DE LA DEPENDENCIA </b></td>';
$texto.='<td style="text-align:left" colspan="2"><b>C&Oacute;DIGO:</td><td>GDC-FT-003</b></td></tr>';
$texto.='<tr><td colspan="2" style="text-align:left"><b>VERSI&Oacute;N:</b></td> <td> 001</td></tr>';
$texto.='</table>';
$texto.='<br />';
$texto.='<table style="border-collapse:collapse;width:100%" border="1px">';
$texto.='<tr style="height:70px">';
$texto.='<td style="text-align:center"><b>FECHA DE RECIBO(DD/MM/AAAA)</b></td>';
$texto.='<td style="text-align:center"><b>N° RADICADO</b></td>';
$texto.='<td style="text-align:center"><b>FOLIOS</b></td>';
$texto.='<td style="text-align:center"><b>REMITENTE</b></td>';
$texto.='<td style="text-align:center"><b>ASUNTO</b></td>';
$texto.='<td style="text-align:center"><b>FIRMA DE QUIEN RECIBE </b></td>';
$texto.='<td style="text-align:center"><b>OBSERVACIONES</b></td>';
$texto.='<td style="text-align:center"><b>ASIGNADA A (NOMBRE Y FIRMA)</b></td>';
$texto.='<td style="text-align:center"><b>FECHA DE ASIGNACIÓN</b></td>';
$texto.='<td style="text-align:center"><b>FECHA DE RESPUESTA</b></td>';
$texto.='</tr>';
for($i=0;$i<$registros["numcampos"];$i++){
  if($registros[$i]['plantilla']=='RADICACION_ENTRADA'){
    $documentos=busca_filtro_tabla("r.*,numero,iddocumento,fecha,paginas","ft_radicacion_entrada r,documento A","documento_iddocumento=iddocumento and A.iddocumento=".$registros[$i]['iddocumento'],"",$conn); 
    //print_r($documentos);
  }
  if($registros[$i]['plantilla']=='REGISTRO_PQRS'){
    $documentos=busca_filtro_tabla("r.*,numero,iddocumento,fecha,paginas","ft_registro_pqrs r,documento A","documento_iddocumento=iddocumento and A.iddocumento=".$registros[$i]['iddocumento'],"",$conn);  
    //print_r($documentos);
  }
  
  $datos_remitente=busca_filtro_tabla("B.nombre,A.*","datos_ejecutor A, ejecutor B","A.ejecutor_idejecutor=B.idejecutor AND A.iddatos_ejecutor=".$documentos[0]['persona_natural'],"",$conn);
  $datos_destino=busca_filtro_tabla("","vfuncionario_dc","iddependencia_cargo=".$documentos[0]['destino'],"",$conn);
  if($registros[$i]['plantilla']=='REGISTRO_PQRS'){
    $datos_destino=busca_filtro_tabla("","vfuncionario_dc","iddependencia_cargo=".$documentos[0]['destino'],"",$conn);
  }
  $buzon_salida=busca_filtro_tabla("","buzon_salida A","nombre='TRANSFERIDO' and A.archivo_idarchivo=".$documentos[0]["iddocumento"],"fecha asc",$conn);
  $fecha_respuesta=busca_filtro_tabla("","respuesta, documento","estado='APROBADO' and destino=iddocumento and origen=".$documentos[0]["iddocumento"],"",$conn);
  //print_r($fecha_respuesta);
  if($fecha_respuesta['numcampos']>0){
    $fecha=date('d-m-Y', strtotime($fecha_respuesta[0]['fecha']));
  }else{
    $fecha='';
  }
  //print_r($fecha_respuesta);
  //print_r($buzon_salida);
  //echo $datos_remitente[0]["nombre"]."<hr>";
  $texto.='<tr>';
  $texto.='<td style="text-align:center;">'.date('d-m-Y', strtotime($documentos[0]["fecha"])).'</td>';
  $texto.='<td style="text-align:center">'.$documentos[0]["numero"].'</td>';
  $texto.='<td style="text-align:center;">'.$documentos[0]["paginas"].'</td>';
  if($registros[$i]['plantilla']=='RADICACION_ENTRADA'){
    $texto.='<td style="text-align:left;">'.$datos_remitente[0]["nombre"].'</td>';
    $texto.='<td style="text-align:left;">'.$documentos[0]["descripcion"].'</td>';
    $texto.='<td style="text-align:left;">&nbsp;</td>';
    $texto.='<td style="text-align:left;">&nbsp;</td>';
    $texto.='<td style="text-align:center;">'.$datos_destino[0]['nombres']." ".$datos_destino[0]['apellidos'].'</td>';
  }
  else if($registros[$i]['plantilla']=='REGISTRO_PQRS'){
    $texto.='<td style="text-align:left;">'.$documentos[0]["nombre_solicita_pqr"].'</td>';
    $texto.='<td style="text-align:left;">'.$documentos[0]["descripcion_pqr"].'</td>';
    $texto.='<td style="text-align:left;">&nbsp;</td>';
    $texto.='<td style="text-align:left;">&nbsp;</td>';
    $texto.='<td style="text-align:center;">'.$fecha_respuesta[0]['descripcion'].'</td>';
  }
  else{
    $texto.='<td style="text-align:left;">&nbsp;</td>';
    $texto.='<td style="text-align:left;">&nbsp;</td>';
    $texto.='<td style="text-align:left;">&nbsp;</td>';
    $texto.='<td style="text-align:left;">&nbsp;</td>';
    $texto.='<td style="text-align:center;">&nbsp;</td>';
  }
  if($buzon_salida['numcampos']==0){
    $texto.='<td style="text-align:center;"></td>';
  }else{
    $texto.='<td style="text-align:center;">'.date('d-m-Y', strtotime($buzon_salida[0]['fecha'])).'</td>';
  }
  $texto.='<td style="text-align:center;">'.$fecha.'</td>';
  $texto.='</tr>';
}
$texto.='</table>';
echo($texto);
?>