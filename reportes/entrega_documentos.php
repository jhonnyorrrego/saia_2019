<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", true); 
header("Pragma: no-cache"); 
$max_salida=10;
 // Previene algun posible ciclo infinito limitando a 10 los ../
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

if(isset($_REQUEST["fecha_inicial"])&&$_REQUEST["fecha_inicial"]&&isset($_REQUEST["fecha_final"])&&$_REQUEST["fecha_final"])
{
if ($_REQUEST["export"] == "excel") 
  {
  	header('Content-Type: application/vnd.ms-excel');
  	header("Content-Disposition: attachment; filename=documentos_entregados.xls");
  	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  }
if ($_REQUEST["export"] == "word") 
  {
  	header('Content-Type: application/vnd.ms-word');
  	header("Content-Disposition: attachment; filename=documentos_entregados.doc");
  	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  }
  
 
include_once($ruta_db_superior."db.php");
//include_once($ruta_db_superior."header.php");
//include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
if ($_REQUEST["export"] == "pdf") 
  {
    redirecciona($ruta_db_superior."html2ps/public_html/demo/html2ps.php?entrega_documentos=1&fecha_inicial=".str_replace(" ","__",str_replace(":","_",$_REQUEST["fecha_inicial"]))."&fecha_final=".str_replace(" ","__",str_replace(":","_",$_REQUEST["fecha_final"])));
    die(); 
  }  

include_once($ruta_db_superior."formatos/librerias/encabezado_pie_pagina.php");
$documentos=busca_filtro_tabla(fecha_db_obtener("d.fecha","Y-m-d H:i:s")." as fecha,d.descripcion,d.numero,lower(nombre) as nombre,iddocumento,descripcion_anexo","documento d,datos_ejecutor,ejecutor","estado<>'ELIMINADO'  and tipo_radicado=1 and ejecutor=iddatos_ejecutor and ejecutor_idejecutor=idejecutor and ".fecha_db_obtener("d.fecha","Y-m-d H:i").">='".str_replace("_",":",str_replace("__"," ",$_REQUEST["fecha_inicial"]))."' and ".fecha_db_obtener("d.fecha","Y-m-d H:i")."<='".str_replace("_",":",str_replace("__"," ",$_REQUEST["fecha_final"]))."'","d.fecha asc",$conn);   
$config = busca_filtro_tabla("valor","configuracion","nombre='color_encabezado'","",$conn); 
echo"<style>.encabezado_list { 
       background-color:".$config[0]["valor"]."; 
       color:white ; 
       vertical-align:middle;
       text-align: center;
       font-weight: bold;	
       }</style>";
?>
<body>
<?php

if(!isset($_REQUEST["entrega_documentos"]))
{echo'<table width="100%" style="border-collapse:collapse;font-family:verdana;font-size:8pt" border="1"><tr>
  <td width="60%" rowspan="2" colspan="3" align="center" valign="middle">'.logo_empresa().'</td>
  <td align="center" colspan="5"><b>SUBGERENCIA ADMINISTRATIVA Y FINANCIERA - GESTION DOCUMENTAL</b>				
</td>
 </tr>
 <tr>
  <td align="center" colspan="6"><b>REGISTRO DE ENTREGA DE DOCUMENTOS</b>				
</td>
 </tr></table><table style="border-collapse:collapse;font-family:verdana;font-size:8pt" width="100%" align="center" border="1">
 ';
}
else
  echo'<table width="100%" style="border-collapse:collapse;font-family:verdana;font-size:8pt" border="1">';
?>
<tr class="encabezado_list">
  <td>FECHA</td>
  <td >No. RADICADO</td>
  <td>OBSERVACIONES</td> 
  <td>REMITENTE</td>
  <td>DESTINATARIO</td>
  <td>DEPENDENCIA</td>
  <td width="20%">RECIBIDO POR<br>(Firma)</td>
  <td width="10%">FECHA</td>
  <td width="5%">HORA</td>
 </tr>
<?php 
for($i=0;$i<$documentos["numcampos"];$i++)
{$entregado=busca_filtro_tabla("lower(nombres) as nombres,lower(apellidos) as apellidos,idfuncionario","buzon_salida,funcionario","nombre='TRANSFERIDO' AND archivo_idarchivo='".$documentos[$i]["iddocumento"]."' and destino=funcionario_codigo","fecha asc",$conn);
 $dependencia=busca_filtro_tabla("lower(dependencia.nombre) as nombre","dependencia_cargo,dependencia","dependencia_iddependencia=iddependencia and dependencia_cargo.estado=1 and dependencia.estado=1 and funcionario_idfuncionario=".$entregado[0]["idfuncionario"],"iddependencia_cargo desc",$conn);
 if($entregado["numcampos"])
   {echo '<tr>
    <td >'.($documentos[$i]["fecha"]).'</td>
    <td >'.strip_tags($documentos[$i]["numero"]." - ".$documentos[$i]["descripcion"]).'</td>
    <td valign="top">'.$documentos[$i]["descripcion_anexo"].'<br/><br/></td> 
    <td >'.ucwords($documentos[$i]["nombre"]).'</td>
    <td >'.ucwords($entregado[0]["nombres"]." ".$entregado[0]["apellidos"]).'</td>
    <td >'.ucwords($dependencia[0]["nombre"]).'</td>
    <td ></td>
    <td ></td>
    <td ></td>
    </tr>';
  }  
}  
?> 
</table>
</body>
<?php 
}
else    
{
 include_once($ruta_db_superior."header.php");
 include_once($ruta_db_superior."calendario/calendario.php");   
?>
<script type="text/javascript" src="<? echo $ruta_db_superior; ?>js/jquery.js"></script>
<script type="text/javascript" src="<? echo $ruta_db_superior; ?>js/jquery.validate.js"></script>
<script type='text/javascript'>
  $().ready(function() {
	$('#form1').validate();	
});
</script>
<br><br><b>FORMULARIO DE REGISTRO DE ENTREGA DE DOCUMENTOS</b><br><br>
<form name="form1" id="form1" action="entrega_documentos.php" method="post">
<table >
 <tr>
  <td class="encabezado">Fecha inicial</td>
  <td><input type="text" readonly="true" name="fecha_inicial"  id="fecha_inicial" value="0000-00-00 00:00">&nbsp;&nbsp;<a href="javascript:showcalendar('fecha_inicial','form1','Y-m-d H:i','../calendario/selec_fecha.php?nombre_campo=fecha_inicial&nombre_form=form1&formato=Y-m-d H:i&anio=<?php echo date('Y');?>&mes=<?php echo date('m');?>&css=default.css&adicionales_tarea=AD:VALOR',220,225)" ><img src="../calendario/activecalendar/data/img/calendar.gif" border="0" alt="Elija Fecha" /></td>
 </tr>
 <tr>
  <td class="encabezado">Fecha Final</td>
  <td><input type="text" readonly="true" name="fecha_final"  id="fecha_final" value="0000-00-00 00:00">&nbsp;&nbsp;<a href="javascript:showcalendar('fecha_final','form1','Y-m-d H:i','../calendario/selec_fecha.php?nombre_campo=fecha_final&nombre_form=form1&formato=Y-m-d H:i&anio=<?php echo date('Y');?>&mes=<?php echo date('m');?>&css=default.css&adicionales_tarea=AD:VALOR',220,225)" ><img src="../calendario/activecalendar/data/img/calendar.gif" border="0" alt="Elija Fecha" />
  </td>
 </tr>
 <tr>
  <td colspan="2">
  <input type='radio' value='excel' name='export' >Excel&nbsp;&nbsp;
  <input type='radio' value='word' name='export' >Word&nbsp;&nbsp;
  <input type='radio' value='pdf' name='export' >Pdf&nbsp;&nbsp;
 </tr>
 <tr>
  <td colspan="2"><input type="submit" value="Continuar" ></td>
 </tr>
</table>
</form>
<?php  
include_once($ruta_db_superior."footer.php"); 
}                   
?>