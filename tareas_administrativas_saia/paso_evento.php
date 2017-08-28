<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta='';
while ($max_salida>0){
  if(is_file($ruta.'db.php')){
    $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
  }
  $ruta.='../';
  $max_salida--;
}
include_once $ruta_db_superior.'db.php';
include_once ($ruta_db_superior . "sql.php");
include_once $ruta_db_superior.'formatos/librerias/funciones_generales.php';
require_once 'src/PHPSQLParser.php';

ini_set("display_errors", true);

$ruta_origen="http://201.236.222.154:82/saia_actualizacion/";
$nombre_origen="saia_produccion";

$fechai=@$_REQUEST["fechai"];//Fecha inicial del evento
$fechaf=@$_REQUEST["fechaf"];//Fecha final del evento

if(!$fechai){
  $fechai='2017-07-04';
}
if(!$fechaf){
  $fechaf='2017-07-04';
}

$fin=1;
for($i=0;$i<$fin;$i++){
	if(!file_exists("eventos/".$nombre_origen."_log_".str_replace("-","_",$fechai).".txt")){
		$archivo=fopen("eventos/".$nombre_origen."_log_".str_replace("-","_",$fechai).".txt",'ab');
		
		$log=$ruta_origen."evento/".$nombre_origen."_log_".str_replace("-","_",$fechai).".txt";
	  	$contenido=file_get_contents($log);
		procesar_evento($contenido,$archivo);
		
		fclose($archivo);
	}
	
	$fechai=suma_fechasphp($fechai,1);
}
if($fechai<=$fechaf){
	abrir_url("paso_evento.php?fechai=".$fechai."&fechaf=".$fechaf,"_self");
}else{
	die("Termina el proceso");
}

function procesar_evento($contenido,$archivo){
	global $conn;
	
	$filas=explode("*|*",$contenido);
	$cant_filas=count($filas);
	for($i=0;$i<$cant_filas;$i++){
		$celdas=explode("|||",$filas[$i]);
		
		$idevento=$celdas[0];
		$funcionario=$celdas[1];
		$fecha=$celdas[2];
		$accion=$celdas[3];
		$tabla=$celdas[4];
		$estado=$celdas[5];
		$detalle=$celdas[6];
		$idregistro=$celdas[7];
		$sql1=$celdas[8];
		
		$sql1='update pretexto set contenido=\'<p style=\\\"text-align: justify;\\\"><span>De la manera m&aacute;s respetuosa, a continuaci&oacute;n me permito adjuntar el listado de las siguientes consignaciones realizadas&nbsp;por los usuarios de los predios encontrados con irregularidad, lo anterior para su tr&aacute;mite y fines pertinentes:</span></p>
<table style=\\\"434px; margin-left: 2.75pt; border-collapse: collapse;\\\" border=\\\"0\\\" cellspacing=\\\"0\\\" cellpadding=\\\"0\\\">

<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; text-align: center; line-height: normal;\\\"><strong><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">ITEM</span></strong></p>
</td>
<td style=\\\"42.5pt; border: solid windowtext 1.0pt; border-left: none; mso-border-top-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; text-align: center; line-height: normal;\\\"><strong><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">SOLICITUD</span></strong></p>
</td>
<td style=\\\"54.35pt; border: solid windowtext 1.0pt; border-left: none; mso-border-top-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; text-align: center; line-height: normal;\\\"><strong><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">CONSIGNACION</span></strong></p>
</td>
<td style=\\\"61.45pt; border: solid windowtext 1.0pt; border-left: none; mso-border-top-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; text-align: center; line-height: normal;\\\"><strong><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">FECHA CONSIGNACI&Oacute;N</span></strong></p>
</td>
<td style=\\\"45.35pt; border: solid windowtext 1.0pt; border-left: none; mso-border-top-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; text-align: center; line-height: normal;\\\"><strong><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">VALOR ACUEDUCTO</span></strong></p>
</td>
<td style=\\\"58.55pt; border: solid windowtext 1.0pt; border-left: none; mso-border-top-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; text-align: center; line-height: normal;\\\"><strong><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">VALOR ALCANTARILLADO</span></strong></p>
</td>
<td style=\\\"41.2pt; border: solid windowtext 1.0pt; border-left: none; mso-border-top-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; text-align: center; line-height: normal;\\\"><strong><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">VALOR TOTAL</span></strong></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">1</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.490.798</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">SIN #</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">09/03/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">108.000</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">72.000</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">180.000</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.544.770</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">SIN #</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">31/05/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">77.160</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">51.440</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">128.600</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">3</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.544.866</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">167364594</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">01/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">60.000</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">40.000</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">100.000</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">4</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.547.498</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">152081642</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">02/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">29.040</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">19.360</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">48.400</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">5</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.547.486</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">97606069</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">06/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">102.840</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">68.560</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">171.400</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">6</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.550.656</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">1346</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">06/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">85.680</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">57.120</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">142.800</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">7</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.547.338</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">15982</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">07/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">120.000</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">80.000</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">200.000</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">8</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.515.185</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">14637</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">09/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">222.963</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">148.642</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">371.605</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">9</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.553.095</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">146579627</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">12/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">76.800</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">51.200</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">128.000</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">10</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.553.569</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">573</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">12/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">111.420</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">74.280</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">185.700</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">11</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.555.169</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">154679213</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">13/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">367.598</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">245.066</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">612.664</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">12</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.555.239</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">97606548</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">13/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">223.050</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">148.700</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">371.750</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">13</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.555.175</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">154971342</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">13/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">9.720</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">6.480</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">16.200</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">14</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.521.104</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">11959</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">20/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">136.920</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">91.280</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">228.200</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">15</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.559.059</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2647</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">21/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">12.000</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">8.000</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">20.000</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">16</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.552.488</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">4580</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">21/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">164.310</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">109.540</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">273.850</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">17</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.552.460</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">167861014</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">21/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">84.000</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">56.000</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">140.000</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">18</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.557.592</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2849</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">22/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">334.840</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">223.226</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">558.066</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">19</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.539.692</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">169523283</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">22/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">127.440</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">84.960</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">212.400</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">20</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.559.612</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">20863</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">22/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">16.200</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">10.800</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">27.000</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">21</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.556.364</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">4928</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">22/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">77.130</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">51.420</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">128.550</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">22</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.554.115</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">136527264</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">27/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">4.834.767</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">3.223.178</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">8.057.945</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">23</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.560.747</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">154734516</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">28/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">179.977</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">119.984</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">299.961</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">24</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.561.199</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">3951</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">28/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">8.100</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">5.400</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">13.500</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">25</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.561.058</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">11863</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">29/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">102.630</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">68.420</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">171.050</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">26</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.559.552</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">4379</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">29/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">119.880</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">79.920</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">199.800</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">27</span></p>
</td>
<td style=\\\"42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">2.561.836</span></p>
</td>
<td style=\\\"54.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">4856</span></p>
</td>
<td style=\\\"61.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">30/06/2017</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">60.000</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">40.000</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">100.000</span></p>
</td>
</tr>
<tr>
<td style=\\\"22.05pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"29\\\">&nbsp;</td>
<td style=\\\"42.5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"57\\\">&nbsp;</td>
<td style=\\\"54.35pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"72\\\">&nbsp;</td>
<td style=\\\"61.45pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"82\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">TOTAL</span></p>
</td>
<td style=\\\"45.35pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"60\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">7.852.465</span></p>
</td>
<td style=\\\"58.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"78\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">5.234.976</span></p>
</td>
<td style=\\\"41.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"55\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 6pt; font-family: Arial, sans-serif;\\\">13.087.441</span></p>
</td>
</tr>

</table>
<br />
<table style=\\\"644px; margin-left: 2.75pt; border-collapse: collapse;\\\" border=\\\"0\\\" cellspacing=\\\"0\\\" cellpadding=\\\"0\\\">

<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; text-align: center; line-height: normal;\\\"><strong><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">ITEM</span></strong></p>
</td>
<td style=\\\"60.9pt; border: solid windowtext 1.0pt; border-left: none; mso-border-top-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; text-align: center; line-height: normal;\\\"><strong><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">SOLICITUD</span></strong></p>
</td>
<td style=\\\"85.9pt; border: solid windowtext 1.0pt; border-left: none; mso-border-top-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; text-align: center; line-height: normal;\\\"><strong><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">CONSIGNACION</span></strong></p>
</td>
<td style=\\\"85.9pt; border: solid windowtext 1.0pt; border-left: none; mso-border-top-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; text-align: center; line-height: normal;\\\"><strong><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">FECHA CONSIGNACI&Oacute;N</span></strong></p>
</td>
<td style=\\\"70.9pt; border: solid windowtext 1.0pt; border-left: none; mso-border-top-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; text-align: center; line-height: normal;\\\"><strong><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">VALOR ACUEDUCTO</span></strong></p>
</td>
<td style=\\\"99.8pt; border: solid windowtext 1.0pt; border-left: none; mso-border-top-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; text-align: center; line-height: normal;\\\"><strong><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">VALOR ALCANTARILLADO</span></strong></p>
</td>
<td style=\\\"48.4pt; border: solid windowtext 1.0pt; border-left: none; mso-border-top-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; text-align: center; line-height: normal;\\\"><strong><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">VALOR TOTAL</span></strong></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">1</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.490.798</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">SIN #</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">09/03/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">108.000</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">72.000</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">180.000</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.544.770</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">SIN #</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">31/05/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">77.160</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">51.440</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">128.600</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">3</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.544.866</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">167364594</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">01/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">60.000</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">40.000</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">100.000</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">4</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.547.498</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">152081642</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">02/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">29.040</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">19.360</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">48.400</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">5</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.547.486</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">97606069</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">06/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">102.840</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">68.560</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">171.400</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">6</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.550.656</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">1346</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">06/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">85.680</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">57.120</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">142.800</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">7</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.547.338</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">15982</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">07/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">120.000</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">80.000</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">200.000</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">8</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.515.185</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">14637</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">09/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">222.963</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">148.642</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">371.605</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">9</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.553.095</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">146579627</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">12/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">76.800</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">51.200</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">128.000</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">10</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.553.569</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">573</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">12/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">111.420</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">74.280</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">185.700</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">11</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.555.169</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">154679213</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">13/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">367.598</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">245.066</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">612.664</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">12</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.555.239</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">97606548</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">13/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">223.050</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">148.700</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">371.750</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">13</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.555.175</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">154971342</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">13/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">9.720</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">6.480</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">16.200</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">14</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.521.104</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">11959</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">20/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">136.920</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">91.280</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">228.200</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">15</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.559.059</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2647</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">21/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">12.000</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">8.000</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">20.000</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">16</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.552.488</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">4580</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">21/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">164.310</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">109.540</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">273.850</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">17</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.552.460</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">167861014</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">21/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">84.000</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">56.000</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">140.000</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">18</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.557.592</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2849</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">22/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">334.840</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">223.226</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">558.066</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">19</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.539.692</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">169523283</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">22/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">127.440</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">84.960</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">212.400</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">20</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.559.612</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">20863</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">22/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">16.200</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">10.800</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">27.000</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">21</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.556.364</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">4928</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">22/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">77.130</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">51.420</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">128.550</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">22</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.554.115</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">136527264</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">27/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">4.834.767</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">3.223.178</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">8.057.945</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">23</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.560.747</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">154734516</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">28/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">179.977</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">119.984</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">299.961</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">24</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.561.199</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">3951</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">28/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">8.100</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">5.400</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">13.500</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">25</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.561.058</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">11863</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">29/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">102.630</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">68.420</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">171.050</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">26</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.559.552</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">4379</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">29/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">119.880</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">79.920</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">199.800</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">27</span></p>
</td>
<td style=\\\"60.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">2.561.836</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">4856</span></p>
</td>
<td style=\\\"85.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">30/06/2017</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">60.000</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">40.000</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">100.000</span></p>
</td>
</tr>
<tr>
<td style=\\\"30.9pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"41\\\">&nbsp;</td>
<td style=\\\"60.9pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"81\\\">&nbsp;</td>
<td style=\\\"85.9pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">&nbsp;</td>
<td style=\\\"85.9pt; border: solid windowtext 1.0pt; border-top: none; mso-border-left-alt: solid windowtext .5pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"115\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">TOTAL</span></p>
</td>
<td style=\\\"70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"95\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">7.852.465</span></p>
</td>
<td style=\\\"99.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"133\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">5.234.976</span></p>
</td>
<td style=\\\"48.4pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-bottom-alt: solid windowtext .5pt; mso-border-right-alt: solid windowtext .5pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 12.75pt;\\\" valign=\\\"bottom\\\" width=\\\"65\\\">
<p style=\\\"margin-bottom: .0001pt; line-height: normal;\\\"><span style=\\\"font-size: 10pt; font-family: Arial, sans-serif;\\\">13.087.441</span></p>
</td>
</tr>

</table>\', imagen=\'1\' where idpretexto=6795';

		$sql1=str_replace(array("DATE_FORMAT(","%Y-%m-%d %H:%i:%s","%Y-%m-%d"), array("TO_DATE(","YYYY-MM-DD HH24:MI:SS","YYYY-MM-DD"), ($sql1));
		
		$tabla="ft_memo";
		$campo_id="idft_memo";
		$idregistro=1;
		$accion='MODIFICAR';
		
		if($accion=='ADICIONAR'){
			$parser = new PHPSQLParser($sql1, true);
			
			$campos=$parser->parsed["INSERT"][0]["columns"];
			$valores=$parser->parsed["VALUES"][0]["data"];
			$cant=count($campos);
			
			$consulta_tabla=busca_filtro_tabla("","user_tab_columns","table_name='".strtoupper($tabla)."'","",$conn);
			
			$nuevos_campos=array();
			$nuevos_valores=array();
			
			$campos_clob=array();
			$valores_clob=array();
			for($i=0;$i<$cant;$i++){
				for($j=0;$j<$consulta_tabla["numcampos"];$j++){
					if($campos[$i]["base_expr"]==strtolower($consulta_tabla[$j]["column_name"])){
						if($valores[$i]["expr_type"]=='function'){
							$nuevos_campos[]=$campos[$i]["base_expr"];
							$nuevos_valores[]=$valores[$i]["base_expr"]."(".$valores[$i]["sub_tree"][0]["base_expr"].",".$valores[$i]["sub_tree"][1]["base_expr"].")";
						}else if($consulta_tabla[$j]["data_type"]=='CLOB' && strlen($valores[$i]["base_expr"])<3996){
							$nuevos_campos[]=$campos[$i]["base_expr"];
							$nuevos_valores[]=$valores[$i]["base_expr"];
						}else if($consulta_tabla[$j]["data_type"]=='CLOB' && strlen($valores[$i]["base_expr"])>=3996){
							$campos_clob[]=$campos[$i]["base_expr"];
							$valores_clob[]=trim($valores[$i]["base_expr"],"'");
						}else{
							$nuevos_campos[]=$campos[$i]["base_expr"];
							$nuevos_valores[]=$valores[$i]["base_expr"];
						}
					}
				}
			}
			
			$nuevos_valores=implode(",",$nuevos_valores);
			$sql1="insert into ".$tabla."(".implode(",",$nuevos_campos).") values(".$nuevos_valores.")";
		}else if($accion=='MODIFICAR'){
			$parser = new PHPSQLParser($sql1, true);
			
			$campos=$parser->parsed["SET"];
			$cant=count($campos);
			
			$nuevos_datos=array();
			
			$campos_clob=array();
			$valores_clob=array();
			for($i=0;$i<$cant;$i++){
				if(strlen($campos[$i]["sub_tree"][2]["base_expr"])>=3996){
					$campos_clob[]=$campos[$i]["sub_tree"][0]["base_expr"];
					$valores_clob[]=trim($campos[$i]["sub_tree"][2]["base_expr"],"'");
				}else{
					$nuevos_datos[]=$campos[$i]["sub_tree"][0]["base_expr"].$campos[$i]["sub_tree"][1]["base_expr"].$campos[$i]["sub_tree"][2]["base_expr"];
				}
			}
			
			$sql1="update ".$tabla." set ".implode(", ",$nuevos_datos)." where ".$parser->parsed["WHERE"][0]["base_expr"].$parser->parsed["WHERE"][1]["base_expr"].$parser->parsed["WHERE"][2]["base_expr"];
		}
		phpmkr_query($sql1);
    
		if($accion=='ADICIONAR'){
			$exito=phpmkr_insert_id();
      
		    if($exito!=$idregistro && $exito){
		    	$campo_id="id".$tabla;
		        if($tabla=='buzon_entrada' || $tabla=='buzon_salida'){
		        	$campo_id="idtransferencia";
		        }else if($tabla=='pagina'){
		        	$campo_id="consecutivo";
		        }else if($tabla=='salidas'){
		          	$campo_id="idsalida";
		        }
		        
		        $sql2="update ".$tabla." set ".$campo_id."='".$idregistro."' where ".$campo_id."=".$exito;
		        phpmkr_query($sql2);
				
				$cant_clob=count($campos_clob);
				if($cant_clob){
					for($i=0;$i<$cant_clob;$i++){
						guardar_lob2($campos_clob[$i], $tabla, $campo_id.'=' . $idregistro, $valores_clob[$i], "texto", $conn);
					}
				}
			}
		}else if($accion=='MODIFICAR'){
			$exito=true;
			
			$cant_clob=count($campos_clob);
			if($cant_clob){
				for($i=0;$i<$cant_clob;$i++){
					guardar_lob2($campos_clob[$i], $tabla, $campo_id.'=' . $idregistro, $valores_clob[$i], "texto", $conn);
				}
			}
		}else{
			$exito=true;
		}
		if($exito){
			$cadena=$idevento."|||".$funcionario."|||".$fecha."|||".$tabla."|||".$accion."|||".$estado."|||".$detalle."|||".$idregistro."|||".$sql1."*|*";
			
			fwrite($archivo,$cadena);
		}
		die();
	}
}
function guardar_lob2($campo, $tabla, $condicion, $contenido, $tipo, $conn, $log = 1) {
	$sql = "SELECT " . $campo . " FROM " . $tabla . " WHERE " . $condicion . " FOR UPDATE";
	$stmt = OCIParse($conn->Conn->conn, $sql) or print_r(OCIError($stmt));
	OCIExecute($stmt, OCI_DEFAULT) or print_r(OCIError($stmt));
	OCIFetchInto($stmt, $row, OCI_ASSOC);
	
	if(!count($row)){  //soluciona el problema del size().
		oci_rollback($conn->Conn->conn);
		oci_free_statement($stmt);
		$clob_blob='clob';
		if($tipo=='archivo'){
			$clob_blob='blob';
		}
    	$up_clob="UPDATE ".$tabla." SET ".$campo."=empty_".$clob_blob."() WHERE ".$condicion;
		$conn->Ejecutar_Sql($up_clob);
	    $stmt = OCIParse($conn->Conn->conn, $sql) or print_r(OCIError ($stmt));
	    OCIExecute($stmt, OCI_DEFAULT) or print_r(OCIError ($stmt));
	    OCIFetchInto($stmt,$row,OCI_ASSOC);		
	}	
	if (FALSE === $row) {
		OCIRollback($conn->Conn->conn);
		alerta("No se pudo modificar el campo.");
		$resultado = FALSE;
	} else { // Now save a value to the LOB
		if ($row[strtoupper($campo)]->size() > 0)
			$contenido_actual = htmlspecialchars_decode($row[strtoupper($campo)]->read($row[strtoupper($campo)]->size()));
		else
			$contenido_actual = "";
		if ($contenido_actual != $contenido) {
			if ($row[strtoupper($campo)]->size() > 0 && !$row[strtoupper($campo)]->truncate()) {
				oci_rollback($conn->Conn->conn);
				alerta("No se pudo modificar el campo.");
				$resultado = FALSE;
			} else {
				if (!$row[strtoupper($campo)]->save(trim((($contenido))))) {
					oci_rollback($conn->Conn->conn);
					$resultado = FALSE;
				} else
					oci_commit($conn->Conn->conn);
					// *********** guardo el log en la base de datos **********************
				preg_match("/.*=(.*)/", strtolower($condicion), $resultados);
			}
		}
		oci_free_statement($stmt);
		$row[strtoupper($campo)]->free();
	}
}
?>