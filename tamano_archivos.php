<?php
  include_once("header.php");
  include_once("db.php");
  include_once("calendario/calendario.php");
  include_once("define.php");
  if($_POST['formula'] == "Consultar"){
    set_time_limit(0);
      $fecha_inicio="";
      $fecha_final="";
      $destino_scriptdb="";
      $ruta="../backup";
 
      
      include_once("configuracion_backup.php");
      
      fechas();
  }
  
   function fechas(){
global $fecha_inicio,$fecha_final,$ruta,$destino_scriptdb,$destino_scripts,$destino_paginas,$destino_logs,$destino_anexos;
if(@$_REQUEST["fecha_inicio"])
  $fecha_inicio=$_REQUEST["fecha_inicio"];
if(@$_REQUEST["fecha_final"])
  $fecha_final=$_REQUEST["fecha_final"];
    realizar_copia();
    

    
    /*comprimir($origen_zip,$ruta_bk."/bksaia-".$fecha_copia,1);
    actualiza_configuracion("fecha_backup",date("Y-m-d H:i:s"));*/
}


function realizar_copia(){
global $fecha_inicio,$fecha_final,$items,$destino_scriptdb,$destino_scripts,
  $destino_paginas,$destino_logs,$destino_anexos,$ldocumentos,$extension_zip,$conn,$ruta_bk,$fecha_copia;
 
$where="A.estado NOT IN('ELIMINADO')";
if($fecha_inicio<>""){
  $where.=" AND fecha >='".fecha_out($fecha_inicio)."'";
}
if($fecha_final<>""){
  $where.=" AND fecha <='".fecha_out($fecha_final)."'";
}
if($fecha_inicio<>"" && $fecha_final<>""){
  $ldocumento=busca_filtro_tabla("A.iddocumento,estado,fecha","documento A",$where,"fecha ASC",$conn);
}
else $ldocumento["numcampos"]=0;
/*if($ldocumento["numcampos"]){
  $ldocumentos=extrae_campo($ldocumento,"iddocumento","U");
  //$ldocumentos=extrae_campo($ldocumento,"estado","U");
}
else $ldocumentos="";*/
  
  for($i=0;$i<$ldocumento['numcampos'];$i++){
    echo $ldocumento[$i]['iddocumento']."--".$ldocumento[$i]['estado'];
    $fecha = explode("-",$ldocumento[$i]['fecha']);
    $carpetas = "du -sh ../APROBADO | sort -n";
    $val = exec($carpetas);
    print_r("-------".$val."<br>");
  }
  
return(TRUE);

}  
  
  
  $fecha_uno="2011-01-01 00:00";
  $fecha_dos=date('Y-m-d H:i');
  ?><script type="text/javascript" src="js/jquery.js"></script><script type="text/javascript" src="js/jquery.validate.js"></script><?php
  echo "  <form method='post' name='form1' id='form1'><table width='40%'><tr><td class='encabezado' colspan='2'><center>Informacion</center></td></tr>
  <tr><td class='encabezado' width='25%'>Fecha inicial</td><td><input type='text' readonly='true' name='fecha_inicio'  id='fecha_inicial' value='$fecha_uno'>&nbsp;&nbsp; ";?><a href="javascript:showcalendar('fecha_inicial','form1','Y-m-d H:i','calendario/selec_fecha.php?nombre_campo=fecha_inicial&nombre_form=form1&formato=Y-m-d H:i&anio=<?php echo date('Y');?>&mes=<?php echo date('m');?>&css=default.css&adicionales_tarea=AD:VALOR',220,225)" ><img src="calendario/activecalendar/data/img/calendar.gif" border="0" alt="Elija Fecha" /><?php echo "</td></td></tr><tr><td class='encabezado'>Fecha final</td><td>"; ?><input type="text" readonly="true" name="fecha_final"  id="fecha_final" value="<?php echo $fecha_dos;?>">&nbsp;&nbsp;<a href="javascript:showcalendar('fecha_final','form1','Y-m-d H:i','calendario/selec_fecha.php?nombre_campo=fecha_final&nombre_form=form1&formato=Y-m-d H:i&anio=<?php echo date('Y');?>&mes=<?php echo date('m');?>&css=default.css&adicionales_tarea=AD:VALOR',220,225)" ><img src="calendario/activecalendar/data/img/calendar.gif" border="0" alt="Elija Fecha" /> <?php echo "</td></tr>
  <tr><td><input type='submit' value='Consultar' name='formula'></td></tr>
          </table>";
          
  include_once("footer.php");
?>