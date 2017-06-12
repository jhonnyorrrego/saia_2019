<?php
  include_once("../../db.php");
  include_once("funciones.php"); ?>
<?php include_once("../librerias/header.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p><?php mostrar_encabezado_plan(1,$_REQUEST['iddoc']);?><script type="text/javascript" src="../../js/jquery.js"></script><?php
  
  global $conn;
  $iddoc =$_REQUEST['iddoc'];
  
  $datos = busca_filtro_tabla("",DB.".ft_plan_mejoramiento","documento_iddocumento=".$iddoc,"",$conn);
  $alcance = busca_filtro_tabla("secretarias,procesos_vinculados","ft_hallazgo a","a.ft_plan_mejoramiento=".$datos[0]["idft_plan_mejoramiento"],"",$conn);

    $secretarias = explode(",",$alcance[0]["secretarias"]);
    $secre = "";
    foreach($secretarias as $dependencias){
      if($dependencias != ""){
        $dato = busca_filtro_tabla("nombre","dependencia","iddependencia=".$dependencias,"",$conn);
        $secre .= ucwords(strtolower($dato[0]['nombre']));
      }
    }
    
    $proceso = explode(",",$alcance[0]["procesos_vinculados"]);
    $procesos = "";
    foreach($proceso as $proc){
      if($proc != ""){
        $dato = busca_filtro_tabla("alcance","ft_proceso","idft_proceso=".$proc,"",$conn);
        $procesos .= $dato[0]['alcance'];
      }
    }

  
  echo '<head>

     <style type="text/css">
      .phpmaker 
       {
       font-family: Verdana,Tahoma,arial; 
       font-size: 9px; 
       color:#000000;
       /*text-transform:Uppercase;*/
       } 
       .encabezado 
       {
       background-color:#006600; 
       color:white ; 
       padding:10px; 
       text-align: left;	
       } 
       .encabezado_list 
       { 
       background-color:#006600; 
       color:white ; 
       vertical-align:middle;
       text-align: center;
       font-weight: bold;	
       }
       </style>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style> body, table { font-size:12pt; font-family:arial; } </style></head><table  border="0" id="tabla1" width="100%"" bgcolor="white" ><tr ><td><div style="width:30mm; height:40mm;">&nbsp;</div></td><td><div id="encabezado" style="background-color:white;"><table style="font-family: verdana; height: 88px; font-size: 9pt;" border="0" width="100%">
<tbody>
<tr>
<td style="text-align: left; width: 30%; font-size: smaller;" valign="middle"><p><img src="'.PROTOCOLO_CONEXION.RUTA_PDF.'/Apps/CEROK/saia1.06/imagenes/logob.jpg" alt="Logo" height="90" /></p></td>

</tr>
<tr>
<td style="text-align: left;"><strong>DIRECCION CONTROL INTERNO</strong></td>
<td style="text-align: right;"></td>
</tr>
</tbody>
</table><table border="0" width="100%">
<tbody>
<tr>
<td style="text-align: center;"><strong><br>ANEXO PLAN DE MEJORAMIENTO</strong></td>
</tr>
</tbody>
</table>
<p style="text-align: left;"><br /><br><strong>DESCRIPCI&Oacute;N DE LA AUDITORIA:</strong>'.html_entity_decode($datos[0]["descripcion_plan"],ENT_NOQUOTES, 'UTF-8').'<br><strong>FECHA DE SUSCRIPCI&Oacute;N:</strong> '.$datos[0]["fecha_suscripcion"].'<br /><br><strong>OBJETIVO GENERAL:</strong> '.html_entity_decode($datos[0]["objetivo"],ENT_NOQUOTES, 'UTF-8').'<br /><br><strong>OBJETIVOS ESPECIFICOS: </strong><br />'.html_entity_decode($datos[0]["objetivos_especificos"],ENT_NOQUOTES, 'UTF-8').'<br /><strong>ALCANCE:</strong><br /><br>'.$secre.'</p>'.$procesos.'</tbody></table>';

include_once("../librerias/footer.php");
?>