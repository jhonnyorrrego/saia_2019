<?php
include_once("../db.php");
include_once("../header.php");
if(!isset($_SESSION["LOGIN".LLAVE_SAIA])){
  @session_name();
  @session_start();
  //@ob_start();
}
//include_once("../calendario/calendario.php");
?>
<script type="text/javascript" src="../popcalendar.js"></script>
<style>
ul{
  margin-left:20px;
}
li{
  margin-top:10px;
}
.subtotal{
font-weight:bold;
}
.columna{
width:100px;
}
.columna_principal{
width:400px;
text-align:left;

}
</style>
<?php
//print_r($_REQUEST);
if($_REQUEST["exportar"]){
  formulario_exportar();
}
else
  formulario();
if(@$_REQUEST["dependencia"]){
  if($_REQUEST["dependencia"]!=-1)
   funcionario_dependencia($_REQUEST["dependencia"]);
  //else
  // todas_dependencia();
}
function todas_dependencia()
{
 global $conn;
 $dep = busca_filtro_tabla("iddependencia as id","dependencia","estado=1","",$conn);
 if($dep["numcampos"]>0)
 { echo "<table border='1' style='border-collapse:collapse;' width='100%'><tr class='encabezado_list' >
       <td class='columna_principal'>Dependencia</td><td class='columna'>Transferencias Recibidas</td><td class='columna'>Transferencias Realizadas</td><td class='columna'>Leidos</td><td class='columna'>No Leidos</td><td class='columna'>Pendientes</td><td class='columna'>Revisados</td><td class='columna'>Aprobados</td><td class='columna'>Borrador</td><td class='columna'>Devueltos</td></tr>";
  for($i=0; $i<$dep["numcampos"]; $i++)
    funcionario_dependencia($dep[$i]["id"]);
   echo "</table>";
 }   
}

function funcionario_dependencia($iddependencia)
{
 global $conn,$listado_funcionarios;
 $datos=array();
 $datos_total=array();
 $lfun=array();
 $datos_total["leido"] +=$datos["leido"];
 $datos_total["transferido"] =0;
 $datos_total["no_leido"] =0;
 $datos_total["recibido"] =0;
 $datos_total["borrador"] =0;
 $datos_total["pendiente"]=0;
 $datos_total["revisado"] =0;
 $datos_total["aprobado"] =0;
 $datos_total["devuelto"] =0;
 $fun = busca_filtro_tabla("funcionario_codigo as cod,login,nombres,apellidos,dependencia.nombre AS nom_dependencia","funcionario,dependencia_cargo,dependencia","idfuncionario=funcionario_idfuncionario AND iddependencia=dependencia_iddependencia AND iddependencia=$iddependencia","",$conn);
 if($fun["numcampos"]>0){
   $datos_total["dependencia"]=$fun[0]["nom_dependencia"];
   $datos_total["total"]=$fun["numcampos"];
   for($i=0; $i<$fun["numcampos"]; $i++)
   {
    if(!in_array($fun[$i]["cod"],$lfun)){
      array_push($lfun,$fun[$i]["cod"]);
      $datos = busqueda($fun[$i]["cod"]);
      if(($datos["totalc1"] && $datos["totalc2"])||1)
      {
        $datos["funcionario"]=$fun[$i]["cod"]."-".$fun[$i]["nombres"]." ".$fun[$i]["apellidos"]." (".$fun[$i]["login"].")";        
        $datos_total["leido"] +=$datos["leido"];
        $datos_total["transferido"] +=$datos["transferido"];
        $datos_total["no_leido"] +=$datos["no_leido"];
        $datos_total["recibido"] +=$datos["recibido"];
        $datos_total["borrador"] +=$datos["borrador"];
        $datos_total["pendiente"] +=$datos["pendiente"];
        $datos_total["revisado"] +=$datos["revisado"];
        $datos_total["aprobado"] +=$datos["aprobado"];
        $datos_total["devuelto"] +=$datos["devuelto"];
        array_push($datos_total,$datos);
      }
     }
   }   
 }
 mostrar_reporte($datos_total);
}

function busqueda($fun)
{
 global $conn;
 //$fun = @$_REQUEST["funcionario"];
 $fecha_inicial = @$_POST["x_fecha_ingreso"]." 07:00:00";
 $fecha_final = @$_POST["y_fecha_ingreso"]. " 22:00:00";
 $datos = array();
 $datos_total = array();
 $datos["leido"]=0;
 $datos["devuelto"]=0;
 $datos["borrador"]=0;
 $datos["transferido"]=0;
 $datos["revisado"]=0;
 $datos["aprobado"]=0;
 $datos["transferido"]=0;
 $datos["recibido"]=0;
 $datos["no_leido"]=0;
 $datos["pendiente"]=0;
 $contador1 = busca_filtro_tabla("count(idtransferencia) as total,nombre","buzon_salida","destino = $fun AND nombre in ('LEIDO','TRANSFERIDO','BORRADOR','DEVOLUCION') AND fecha >= ".fecha_db_almacenar($fecha_inicial,'Y-m-d H:i:s')." AND fecha <= ".fecha_db_almacenar($fecha_final,'Y-m-d H:i:s'),"GROUP BY nombre",$conn);  
 //print_r($contador1);
  for($h=0;$h<$contador1["numcampos"];$h++) 
  {
   switch ($contador1[$h]["nombre"])
   {
    case "LEIDO":
      $datos["leido"]=$contador1[$h]["total"];
    break;    
    case "DEVOLUCION":
      $datos["devuelto"]=$contador1[$h]["total"];
    break;
    case "BORRADOR":
      $datos["borrador"]=$contador1[$h]["total"];
    break;
    case "TRANSFERIDO":
      $datos["recibido"]=$contador1[$h]["total"];
    break;   
   }
  } 
    $contador2 = busca_filtro_tabla("count(idtransferencia) as total,nombre","buzon_salida","origen = $fun AND nombre in ('REVISADO','APROBADO','TRANSFERIDO','DEVOLUCION') AND fecha >= ".fecha_db_almacenar($fecha_inicial,'Y-m-d H:i:s')." AND fecha <= ".fecha_db_almacenar($fecha_final,'Y-m-d H:i:s'),"GROUP BY nombre",$conn);
    for($h=0;$h<$contador2["numcampos"];$h++) 
    {
     switch ($contador2[$h]["nombre"])
     {
      case "REVISADO":
        $datos["revisado"]=$contador2[$h]["total"];
      break;    
      case "APROBADO":
        $datos["aprobado"]=$contador2[$h]["total"];
      break;
      case "TRANSFERIDO":
        $datos["transferido"]=$contador2[$h]["total"];
      break;
      case "TRANSFERIDO":
        $datos["recibido"]=$contador2[$h]["total"];
      break;    
     } 
    }
    //print_r($contador1);
   $datos["totalc1"]=$contador1["numcampos"];
   $datos["totalc2"]=$contador1["numcampos"];
   $otros = documentos_pendientes($fun);
   $datos["no_leido"] = $otros["no_leidos"];
   $datos["pendiente"] = $otros["pendientes"]; 
  return $datos;      
}  

function documentos_pendientes($fun)
{ global $conn;
 $fecha_inicial = @$_POST["x_fecha_ingreso"];
 $fecha_final = @$_POST["y_fecha_ingreso"];
 /*
  $doc_usuario="SELECT DISTINCT iddocumento,0 as creado
FROM ".DB.".buzon_entrada,".DB.".documento
WHERE origen ='".$fun."'
AND documento.estado IN ('APROBADO','ACTIVO')
AND buzon_entrada.nombre NOT IN('PRODUCCION','RECHAZADO','BLOQUEADO','POR_APROBAR','VERIFICACION')
AND  archivo_idarchivo=iddocumento AND documento.fecha > TO_DATE('03/01/2008 00:00:00', 'MM/DD/YYYY HH24:MI:SS') AND buzon_entrada.fecha >= ".fecha_db_almacenar($fecha_inicial,'Y-m-d H:i:s')." AND buzon_entrada.fecha <= ".fecha_db_almacenar($fecha_final,'Y-m-d H:i:s')."";
  $rs = $conn->Ejecutar_Sql($doc_usuario); 
  $vector=array();
  while($vector[]=phpmkr_fetch_array($rs));
  //echo($doc_usuario."<br /><br />");
  @phpmkr_free_result($rs);
$enviados="
SELECT e.archivo_idarchivo
FROM ".DB.".buzon_entrada e,".DB.".buzon_salida s
where
e.origen ='".$fun."'
and s.nombre NOT IN('LEIDO','BLOQUEADO')
and e.nombre NOT IN('LEIDO','BLOQUEADO')
and e.origen = s.origen
AND e.archivo_idarchivo = s.archivo_idarchivo and s.fecha >= ".fecha_db_almacenar($fecha_inicial,'Y-m-d H:i:s')." and s.fecha <= ".fecha_db_almacenar($fecha_final,'Y-m-d H:i:s')." and e.fecha >= ".fecha_db_almacenar($fecha_inicial,'Y-m-d H:i:s')." and e.fecha <= ".fecha_db_almacenar($fecha_final,'Y-m-d H:i:s')."
GROUP BY e.archivo_idarchivo
HAVING max( s.fecha ) >= max( e.fecha )";
  $rs2= $conn->Ejecutar_Sql($enviados); 
  //die($enviados);
  $l_enviados=array();
  while($fila=phpmkr_fetch_array($rs2))
    $l_enviados[]=$fila[0];      
  @phpmkr_free_result($rs2);
  
  $no_leidos = 0;  
  foreach($vector as $fila)
        {if(!in_array($fila[0],$l_enviados) && $fila[0]<>"")
          { $resultados[]=$fila[0];
            $leido = busca_filtro_tabla("idtransferencia","buzon_salida","archivo_idarchivo=".$fila[0]." and origen = $fun","",$conn);
            if($leido["numcampos"]>0)
             $no_leidos ++;
          }   
        }
      */
    $no_leidos = 0;     
    $pend = busca_filtro_tabla("documento_iddocumento as id, fecha_inicial","asignacion","tarea_idtarea=2 and llave_entidad=$fun and fecha_inicial >= ".fecha_db_almacenar($fecha_inicial,'Y-m-d H:i:s')." AND fecha_inicial <= ".fecha_db_almacenar($fecha_final,'Y-m-d H:i:s'),"",$conn);
    //print_r($pend);
    for($i=0; $i<$pend["numcampos"]; $i++)
    {  $leido =  busca_filtro_tabla("idtransferencia","buzon_salida","archivo_idarchivo=".$fila[0]." and origen = $fun nombre='LEIDO' and fecha > ".fecha_db_almacenar($pend[$i]["fecha_inicial"],"Y-m-d H:i:s"),"",$conn);
      if(!$leido["numcampos"]>0)
          $no_leidos ++;
     //$resultado[]=$pend[$i]["id"];
    }   
   //$resultados=array_unique($resultados);     
   $datos["pendientes"]=$pend["numcampos"];
   $datos["no_leidos"]=$no_leidos;       
  return ($datos);
}

function mostrar_reporte($datos)
{ // print_r($datos); die("aqui_voy");
 if($datos["total"]>0) 
 {
  if($_REQUEST["dependencia"]!=-1)
  { echo "<table border='1' style='border-collapse:collapse;' width='100%'><tr class='encabezado_list' >
       <td class='columna_principal'>Dependencia</td><td class='columna'>Transferencias Recibidas</td><td class='columna'>Transferencias Realizadas</td><td class='columna'>Leidos</td><td class='columna'>No Leidos</td><td class='columna'>Pendientes</td><td class='columna'>Revisados</td><td class='columna'>Aprobados</td><td class='columna'>Borrador</td><td class='columna'>Devueltos</td></tr>";
  }     
 for($i=0; $i<$datos["total"]; $i++)
  {
   if($i==0)
    echo "<tr align='center' valign='top' class='encabezado_list' style='color:#000000;'><td class='columna_principal'><b>".$datos["dependencia"]."</b></td><td class='columna'>".$datos["recibido"]."</td><td class='columna'>".$datos["transferido"]."</td><td class='columna'>".$datos["leido"]."</td><td class='columna'>".$datos["no_leido"]."</td><td class='columna'>".$datos["pendiente"]."</td><td class='columna'>".$datos["revisado"]."</td><td class='columna'>".$datos["aprobado"]."</td><td class='columna'>".$datos["borrador"]."</td><td class='columna'>".$datos["devuelto"]."</td></tr>";
     
   echo "<tr align='center' valign='top'><td class='columna_principal'>".$datos[$i]["funcionario"]."</td><td class='columna'>".$datos[$i]["recibido"]."</td><td class='columna'>".$datos[$i]["transferido"]."</td><td class='columna'>".$datos[$i]["leido"]."</td><td class='columna'>".$datos[$i]["no_leido"]."</td><td class='columna'>".$datos[$i]["pendiente"]."</td><td class='columna'>".$datos[$i]["revisado"]."</td><td class='columna'>".$datos[$i]["aprobado"]."</td><td class='columna'>".$datos[$i]["borrador"]."</td><td class='columna'>".$datos[$i]["devuelto"]."</td></tr>";
  }
  if($_REQUEST["dependencia"]!=-1)
   echo "</table>";
 }
 return true; 
}
?>
<script type="text/javascript">
function validar(f)
{ 
 if(f.dependencia.value==-1)
 { alert("Por favor seleccione la dependencia");
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
 echo "<form name='reporte' id='reporte' action='reporte.php' method='POST' onSubmit='return validar(this);'>";
 $dep = busca_filtro_tabla("iddependencia,nombre","dependencia","estado=1","",$conn);
  echo '<span class="internos"><img class="imagen_internos" src="../botones/configuracion/LUPA2.png" border="0">&nbsp;&nbsp;DOCUMENTOS POR DEPENDENCIAS</span><center>&nbsp;&nbsp;&nbsp;<a href="prueba.php">Documentos por Funcionarios</a></center><br><br />';
 echo "<table border='0' width='100%'><tr><td class='encabezado'>DEPENDENCIAS</td><td bgcolor='#f5f5f5' colspan='3'>
        <select name='dependencia' id='dependencia' ><option value='-1'>Seleccionar ...</option>";
 for($i=0; $i<$dep["numcampos"]; $i++)
 {
  echo "<option value='".$dep[$i]["iddependencia"]."'";
  if($dep[$i]["iddependencia"]==@$_REQUEST["dependencia"])
    echo(' SELECTED ');  
  echo ">".$dep[$i]["nombre"]."</option>";
 }
 echo "</select></td></tr>";
  if($_REQUEST["x_fecha_ingreso"])
    $fecha_x=@$_REQUEST["x_fecha_ingreso"];
  else $fecha_x=date("Y-m-d");
  if($_REQUEST["y_fecha_ingreso"])
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
<!--input type="text" name="x_fecha_ingreso" id="x_fecha_ingreso" value="<?php echo(escapeshellcmd($fecha_x));?>" size="22"-->
<input type="text" name="x_fecha_ingreso" id="x_fecha_ingreso" value="<?php echo $fecha_x; ?>" size="22">
&nbsp;<input type="image" src="../images/ew_calendar.gif" alt="Escoger Fecha" onClick="popUpCalendar(this, this.form.x_fecha_ingreso,'yyyy-mm-dd');return false;">
&nbsp;
<?php //selector_fecha("x_fecha_ingreso","reporte","Y-m-d H:i:s",date("m"),date("Y"),"default.css","","AD:VALOR","VENTANA",false,false,7,00,"AM"); ?>
&nbsp;&nbsp;&nbsp;
  <input type="hidden" name="z_fecha_ingreso[]" value="<=,','">
  <label >Y</label>  
&nbsp;&nbsp;&nbsp;
<input type="text" name="y_fecha_ingreso" id="y_fecha_ingreso" value="<?php echo $fecha_y; ?>" size="22">
&nbsp;<input type="image" src="../images/ew_calendar.gif" alt="Escoger Fecha" onClick="popUpCalendar(this, this.form.y_fecha_ingreso,'yyyy-mm-dd');return false;">
<!--input type="text" name="y_fecha_ingreso" id="y_fecha_ingreso" value="<?php echo(escapeshellcmd ($fecha_y));?>" size="22"-->
&nbsp;
<?php //selector_fecha("y_fecha_ingreso","reporte","Y-m-d H:i:s",date("m"),date("Y"),"default.css","","AD:VALOR","VENTANA",false,false,12,00,"PM"); ?>
</span></td>
</tr> 
<tr>
<td colspan="3" align="center">
  Exportar a Exel? <input type="checkbox" name="exportar" value="1" ><br />
  <input type="submit" name="Action" id="Action" value="Buscar">
</td>
 <?php
 echo "</table></form>";
}
function formulario_exportar(){
/*if($_REQUEST["x_fecha_ingreso"])
  $fecha_x=@$_REQUEST["x_fecha_ingreso"];
else $fecha_x=date("Y-m-d H:i:s");
if($_REQUEST["y_fecha_ingreso"])
  $fecha_y=@$_REQUEST["y_fecha_ingreso"];
else
*/$fecha_y=date("Y-m-d H:i:s");

header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Pendientes(".$fecha_y.").xls");
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
