<?php
include_once("../db.php");
include_once("../header.php");
//include_once("calendario/calendario.php");
?>
<script type="text/javascript" src="../popcalendar.js"></script>
<script type="text/javascript">
</script>
<style>
ul{
  margin-left:20px;
}
li{
  margin-top:10px;
}
</style>
<?php
//print_r($_REQUEST);
if(@$_REQUEST["exportar"]){
  formulario_exportar();
}
else
  formulario();
if(@$_REQUEST["funcionario"])
 busqueda();

function busqueda()
{
 global $conn;
 $fun = @$_REQUEST["funcionario"];
 $fecha_inicial = @$_POST["x_fecha_ingreso"]." 07:00:00";
 $fecha_final = @$_POST["y_fecha_ingreso"]." 22:00:00";
 $datos = array();
 $datos_total = array();
 $busq = busca_filtro_tabla("distinct archivo_idarchivo,fecha","buzon_salida","destino='$fun' and fecha >= ".fecha_db_almacenar($fecha_inicial,'Y-m-d H:i:s')." and fecha <= ".fecha_db_almacenar($fecha_final,'Y-m-d H:i:s')." and nombre in ('TRANSFERIDO','REVISADO','DEVOLUCION','TRAMITE','APROBADO','RESPONDIDO')","GROUP BY archivo_idarchivo,fecha ORDER BY fecha DESC",$conn);   
 if($busq["numcampos"]>1000){
  alerta("Solo seran mostrados 1000 de los ".$busq["numcampos"]." registros encontrados ");
 }
 if($busq["numcampos"]>0)
 for($i=0; $i<$busq["numcampos"] && $i<1000; $i++)
 {
  $doc = busca_filtro_tabla("numero,fecha,descripcion,ejecutor,plantilla,municipio_idmunicipio","documento","iddocumento=".$busq[$i]["archivo_idarchivo"],"",$conn);  
  $datos["iddocumento"] = $busq[$i]["archivo_idarchivo"];
  $datos["numero"] = $doc[0]["numero"];
  $datos["fecha_creacion"] = $doc[0]["fecha"];
  $datos["fecha_llega"]= $busq[$i]["fecha"];
  $datos["descripcion"]=$doc[0]["descripcion"];
  if($doc[0]["plantilla"]!="")
  { $origen = busca_filtro_tabla("nombre,nombres,apellidos","dependencia,dependencia_cargo,funcionario","iddependencia=dependencia_iddependencia and funcionario_idfuncionario=idfuncionario and funcionario_codigo=".$doc[0]["ejecutor"],"",$conn);  
    //$remitente = busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=".$doc[0]["ejecutor"],"",$conn);    
    $datos["remitente"]= "I-".$origen[0]["nombres"]." ".$origen[0]["apellidos"];
  }
  else 
  {
  	if($doc[0]["municipio_idmunicipio"]!='')
  		$origen = busca_filtro_tabla("nombre","municipio","idmunicipio=".$doc[0]["municipio_idmunicipio"],"",$conn);  
    $remitente = busca_filtro_tabla("nombre","datos_ejecutor,ejecutor","ejecutor_idejecutor=idejecutor and iddatos_ejecutor=".$doc[0]["ejecutor"],"",$conn);    
    $datos["remitente"]="E-".$remitente[0]["nombre"];
  } 
  $datos["origen"] = $origen[0]["nombre"];
  $respuesta = busca_filtro_tabla("*","respuesta","origen=".$busq[$i]["archivo_idarchivo"],"",$conn);
  $inf_respuesta="";
  if($respuesta["numcampos"]>0){
   for($j=0; $j<$respuesta["numcampos"]; $j++)
   { $doc_r = busca_filtro_tabla("numero,descripcion","documento","iddocumento=".$respuesta[$j]["destino"],"",$conn);
     $inf_respuesta .= "<ul class='lista'><li>Fecha : ".$respuesta[$j]["fecha"]." </li><li>Numero: ".$doc_r[0]["numero"]."</li><li>Asunto: ".strip_tags($doc_r[0]["descripcion"])."</li><li> Formato:".$respuesta[$j]["plantilla"]."</li></ul>";
     $inf_respuesta.="<br /><br />";
   }
  }
  else
    $inf_respuesta=" No tiene respuesta";
   $datos["respuesta"]=$inf_respuesta;
   $asig = busca_filtro_tabla("fecha,destino,nombre","buzon_salida","archivo_idarchivo=".$busq[$i]["archivo_idarchivo"]." and origen='".$fun."' and nombre in ('TRANSFERIDO','REVISADO','DEVOLUCION','TRAMITE','APROBADO','RESPONDIDO') AND fecha > ".fecha_db_almacenar($busq[$i]["fecha"],'Y-m-d H:i:s'),"idtransferencia",$conn);
   //print_r($asig);
   $nombre_d = "";
   if($asig["numcampos"]>0)
   {
    $nombre_d.="<ul>";
    for($j=0; $j<$asig["numcampos"]; $j++)
    {
     $destino = busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=".$asig[$j]["destino"],"",$conn);
     $nombre_d .= "<li>".$destino[0]["nombres"]." ".$destino[0]["apellidos"]."<br />(".$asig[$j]["fecha"].")</li>";
    }
    $nombre_d.="</ul>";
   }
   else
    $nombre_d = "No se ha asignado el documento."; 
   $datos["asignado"]= $nombre_d;    
  array_push($datos_total,$datos);  
 }
 $datos_total["total"]=$busq["numcampos"]; 
 mostrar_reporte($datos_total);
}

function mostrar_reporte($datos)
{
 if($datos["total"]>0) 
 {echo "<table border='1' style='border-collapse:collapse;' width='100%'><tr class='encabezado_list' >
       <td>Fecha Creacion</td><td>Fecha Recibido</td><td>Numero Radicado</td><td>Descripcion</td>
       <td>Remitente</td><td>Origen del Documento</td><td>Asignado a</td><td>Respondido</td></tr>";
 for($i=0; $i<$datos["total"]; $i++)
  {
   echo "<tr align='center' valign='top'><td>".$datos[$i]["fecha_creacion"]."</td><td align='center'>".$datos[$i]["fecha_llega"]."</td><td>".$datos[$i]["numero"]."</td><td align='left'>".$datos[$i]["descripcion"]."</td><td align='left'>".$datos[$i]["remitente"]."</td><td align='center'>".$datos[$i]["origen"]."</td><td align='left'>".$datos[$i]["asignado"]."</td><td align='left'>".$datos[$i]["respuesta"]."</td></tr>";
  }
 echo "</table>";  
 }
 return true; 
}
?>
<script type="text/javascript">
function validar(f)
{
 if(f.funcionario.value=='')
 { alert("Por favor seleccione la funcionario");
   return false; 
 }
 if(f.x_fecha_ingreso.value == f.y_fecha_ingreso.value)
 { alert("Las fechas no pueden ser iguales");
   return false;   
 }
 if(f.x_fecha_ingreso.value == '' || f.y_fecha_ingreso.value =='')
 { alert("Por favor seleccionar las fechas en las que se desea buscar");
   return false;   
 }  
 return true;
}
</script>
<?php
function formulario()
{ 
 global $conn;
 echo "<form name='reporte' id='reporte' action='prueba.php' method='POST' onSubmit='return validar(this);'>";
 $func = busca_filtro_tabla("idfuncionario,funcionario_codigo as cod,nombres,apellidos,estado","funcionario","","estado DESC,nombres ASC",$conn);
 //print_r($func);
 echo '<span class="internos"><img class="imagen_internos" src="../botones/configuracion/LUPA2.png" border="0">&nbsp;&nbsp;DOCUMENTOS POR FUNCIONARIO</span><center>&nbsp;&nbsp;&nbsp;<a href="reporte.php">Estad&iacute;sticas por Dependencias</a></center><br><br />';
 echo "<table border='0' width='100%'><tr><td class='encabezado'>DOCUMENTOS ENVIADOS AL FUNCIONARIO</td><td bgcolor='#f5f5f5' colspan='3'>
        <select name='funcionario' id='funcionario' ><option>Seleccionar...</option>";
 for($i=0; $i<$func["numcampos"]; $i++)
 {
  echo "<option value='".$func[$i]["cod"]."'";
  if(@$_REQUEST["funcionario"]==$func[$i]["cod"]){
    echo(" SELECTED ");
  }
  echo ">".$func[$i]["nombres"]." ".$func[$i]["apellidos"]."</option>";
 }
 echo "</select></td></tr>";
  if(@$_REQUEST["x_fecha_ingreso"])
    $fecha_x=@$_REQUEST["x_fecha_ingreso"];
  else $fecha_x=date("Y-m-d");
  if(@$_REQUEST["y_fecha_ingreso"])
    $fecha_y=@$_REQUEST["y_fecha_ingreso"];
  else $fecha_y=date("Y-m-d");

 ?>
 <tr>
      <td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA DE INGRESO AL SISTEMA</span></td>
      <td bgcolor="#F5F5F5"><span class="phpmaker">
      <input type="hidden" name="z_fecha_ingreso[]" value=">=,','">
      <label >ENTRE</label>      
     </td>
<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_fecha_ingreso" id="x_fecha_ingreso" value="<?php echo(escapeshellcmd($fecha_x));?>" size="22">&nbsp;<input type="image" src="../images/ew_calendar.gif" alt="Escoger Fecha" onClick="popUpCalendar(this, this.form.x_fecha_ingreso,'yyyy-mm-dd');return false;">
&nbsp;
<?php //selector_fecha("x_fecha_ingreso","reporte","Y-m-d H:i:s",date("m"),date("Y"),"default.css","","AD:VALOR","VENTANA",false,false,7,00,"AM"); ?>
&nbsp;&nbsp;&nbsp;
  <input type="hidden" name="z_fecha_ingreso[]" value="<=,','">
  <label >Y</label>  
&nbsp;&nbsp;&nbsp;
<input type="text" name="y_fecha_ingreso" id="y_fecha_ingreso" value="<?php echo(escapeshellcmd ($fecha_y));?>" size="22">&nbsp;<input type="image" src="../images/ew_calendar.gif" alt="Escoger Fecha" onClick="popUpCalendar(this, this.form.y_fecha_ingreso,'yyyy-mm-dd');return false;">
&nbsp;
<?php //selector_fecha("y_fecha_ingreso","reporte","Y-m-d H:i:s",date("m"),date("Y"),"default.css","","AD:VALOR","VENTANA",false,false,12,00,"PM"); ?>
</span></td>
</tr> 
<tr>
<td colspan="3" align="center">
  Exportar a Exel? <input type="checkbox" name="exportar" value="1" ><br /><input type="submit" name="Action" id="Action" value="Buscar">
</td>
 <?php
 echo "</table></form>";
}
function formulario_exportar(){
if($_REQUEST["x_fecha_ingreso"])
  $fecha_x=@$_REQUEST["x_fecha_ingreso"];
else $fecha_x=date("Y-m-d H:i:s");
if($_REQUEST["y_fecha_ingreso"])
  $fecha_y=@$_REQUEST["y_fecha_ingreso"];
else $fecha_y=date("Y-m-d H:i:s");
$func = busca_filtro_tabla("idfuncionario,funcionario_codigo as cod,nombres,apellidos","funcionario","funcionario_codigo=".$_REQUEST["funcionario"],"",$conn);
//print_r($func);
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=".$func[0]["nombres"]."_".$func[0]["apellidos"]."(".$fecha_x."-".$fecha_y.").xls");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
 echo "<table border='0' width='100%'><tr><td class='encabezado'>DOCUMENTOS ENVIADOS AL FUNCIONARIO</td><td bgcolor='#f5f5f5' colspan='3'>".$func[0]["nombres"]." ".$func[0]["apellidos"]."</td></tr>";

 ?>
 <tr>
      <td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA DE INGRESO AL SISTEMA</span></td>
      <td bgcolor="#F5F5F5"><span class="phpmaker">
      <label >ENTRE</label>
     </td>
<td bgcolor="#F5F5F5" colspan="2">
<label><?php echo($fecha_x)?></label>
&nbsp;&nbsp;&nbsp;
  <label >Y</label>
&nbsp;&nbsp;&nbsp;
<label><?php echo(@$fecha_y)?></label>
&nbsp;
</span></td>
</tr></table>
<?php
}
include_once("../footer.php");
?>
