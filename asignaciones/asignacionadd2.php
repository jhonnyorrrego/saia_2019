<html>
<head>
<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">


$(document).ready(function(){

	//hide message_body after the first one
	$(".message_list .message_body:gt(-1)").hide();
	$(".message_list .message_body:eq(0)").hide();
	//hide message li after the 5th
	$(".message_list li:gt(2)").hide();


	//toggle message_body
	$(".message_head").click(function(){
		$(this).next(".message_body").slideToggle(500)
		return false;
	});

	//collapse all messages
	$(".collpase_all_message").click(function(){
		$(".message_body").slideUp(500)
		return false;
	});

	//show all messages
	$(".show_all_message").click(function(){
		$(this).hide()
		$(".show_recent_only").show()
		$(".message_list li:gt(4)").slideDown()
		return false;
	});

	//show recent messages only
	$(".show_recent_only").click(function(){
		$(this).hide()
		$(".show_all_message").show()
		$(".message_list li:gt(4)").slideUp()
		return false;
	});

});
</script>
<style type="text/css">

p {
	padding: 0 0 1em;
}
/* message display page */
.message_list {
	list-style: none;
	margin: 0;
	padding: 0;
	width: 383px;
}
.message_list li {
	padding: 0;
	margin: 0;
	background: url(images/message-bar.gif) no-repeat;
}

.encabezado_lista{
	padding: 0;
	margin: 0;
	background: url(images/message-bar.gif) no-repeat;
	right: 10px;
	top: 15px;
}
.message_head {
	padding: 5px 10px;
	cursor: pointer;
	position: relative;
}
.message_head .timestamp {
	color: #666666;
	font-size: 95%;
	position: absolute;
	right: 10px;
	top: 5px;
}
.message_head cite {
	font-size: 100%;
	font-weight: bold;
	font-style: normal;
}
.message_body {
	padding: 5px 10px 15px;
}
.collapse_buttons {
	text-align: right;
	border-top: solid 1px #e4e4e4;
	padding: 5px 0;
	width: 383px;
}
.collapse_buttons a {
	margin-left: 15px;
	float: right;
}
.show_all_message {
	background: url(images/tall-down-arrow.gif) no-repeat right center;
	padding-right: 12px;
}
.show_recent_only {
	display: none;
	background: url(images/tall-up-arrow.gif) no-repeat right center;
	padding-right: 12px;
}
.collpase_all_message {
	background: url(images/collapse-all.gif) no-repeat right center;
	padding-right: 12px;
	color: #666666;
}
</style>
<?php
include_once ("../db.php");
$config = busca_filtro_tabla("valor","configuracion","nombre='color_encabezado'","",$conn);
 if($config["numcampos"])
 {  $style = "
     <style type=\"text/css\">
     <!--INPUT, TEXTAREA, SELECT
     {
        font-family: Verdana,Tahoma,arial;
        font-size: 10px;
        /*text-transform:Uppercase;*/
       }
       .phpmaker
       {
       font-family: Verdana,Tahoma,arial;
       font-size: 9px;
       /*text-transform:Uppercase;*/
       }
       .encabezado
       {
       background-color:".$config[0]["valor"].";
       color:white ;
       padding:10px;
       text-align: left;
       }
       .encabezado_list
       {
       background-color:".$config[0]["valor"].";
       color:white ;
       vertical-align:middle;
       text-align: center;
       font-weight: bold;
       }
       table thead td
       {
		    font-weight:bold;
    		cursor:pointer;
    		background-color:".$config[0]["valor"].";
    		text-align: center;
        font-family: Verdana,Tahoma,arial;
        font-size: 9px;
        /*text-transform:Uppercase;*/
        vertical-align:middle;
    	 }
    	 table tbody td
       {
    		font-family: Verdana,Tahoma,arial;
        font-size: 9px;
    	 }
       -->
       </style>";
  echo $style;
  }

include_once 'funciones.php';
require_once("../calendario/calendario.php");

/*
* Obtencion de parametros
*/

if(isset($_REQUEST['popup'])) //Parametro que indica que esta en una ventana emergente de un formato
{     $nom_form=$_REQUEST['nom_form'];
      $nom_campo=$_REQUEST['nom_campo'];
      $popup=TRUE;
      if(isset($_REQUEST['idtarea']))
	  $idtarea=$_REQUEST['idtarea'];
	else
	  $idtarea=0;
	  $iddoc=0;     // Se acutializa cuando el formato sea generado
	  $idserie=0;
}

else
{       $popup=FALSE;

	if(isset($_REQUEST['idtarea']))
	  $idtarea=$_REQUEST['idtarea'];
	else
	  $idtarea=0;
	if(!isset($_REQUEST['key'])&&!isset($_REQUEST['iddoc']))
	  $iddoc=0;
	else if(isset($_REQUEST['key']))
	  $iddoc=$_REQUEST['key'];
	else if(isset($_REQUEST['iddoc']))
	  $iddoc=$_REQUEST['iddoc'];
	if(!isset($_REQUEST['idserie']))
	  $idserie=0;
	else
	  $idserie=$_REQUEST['idserie'];
	if(!$iddoc && !$idserie){
	  alerta("Las tareas deben ser Asignadas a una Serie o Documento");
	 // redirecciona("../pendienteslist.php?cmd=resetall");
	}
}
include_once("../db.php");

?>
<script type="text/javascript" src="../js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="../js/dhtmlXTree.js"></script>
<script language="javascript" type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {
alert("HH");
//Copia las variables oculta para pasar luego al formulario
var list_arbol=tree2.getAllChecked();
var list_asignar=list_arbol.split(",");
EW_this.x_destino.value=list_asignar;
if(EW_this.fecha_inicial.value!=""){
  if(EW_this_fecha_final.value==""){
    alert("Por favor Ingrese el Valor de la Fecha Final");
    return(false);
  }
}
if(EW_this.fecha_final.value!=""){
  if(EW_this_fecha_inicial.value==""){
    alert("Por favor Ingrese el Valor de la Fecha Inicial");
    return(false);
  }
}

if(EW_this.list_asignar.value=='') {
	this.alert("POR FAVOR INGRESE EL CAMPO REQUERIDO - RESPONSABLE(S) DE LA TAREA");
	 return false;
}

if (EW_this.iddoc.value=='' && EW_this.idserie.value=='') {
	this.alert("POR FAVOR SELECCIONE  DATOS para asignar la tarea");
	 return false;
}

return true;
}
-->
</script>
</head>
<?php

function asignaciones($iddoc=NULL,$idserie=NULL,$artareas=NULL,$arentidad=NULL,$fecha_ini=NULL,$fecha_fin=NULL,$reprograma=NULL,$tipo_reprograma=NULL)
{
global $conn;
$entrada=0;
$list_entidad = Array();
$list_dep = array();
$list_entidad1 = array(); // Funcionarios Predefinidos para la tarea
$list_dep1 = array();  // Dependencias Predefinidas para la tarea
$list_entidad2=array();
$list_dep2=array();

foreach($arentidad AS $entidad){
  if(!strstr($entidad, '#')){
	  array_push($list_entidad,$entidad);
	}
	else{
    array_push($list_dep,str_replace("#","",$entidad));
  }
}
$res=busca_filtro_tabla("*","entidad","nombre='funcionario'","identidad",$conn);
$identidadf=$res[0]['identidad'];
$res=busca_filtro_tabla("*","entidad","nombre='dependencia'","identidad",$conn);
$identidadd=$res[0]['identidad'];
$ntareas=count($artareas);
if(@$_REQUEST["predefinidos"]) // se incluiran los responsables Predefinidos
 {
   $list_entidad1=busca_filtro_tabla("","entidad_tarea","entidad_identidad=".$identidadf." AND tarea_idtarea IN(".implode(",",$artareas).")","",$conn);
   if($list_entidad1["numcampos"]){
       $list_entidad2=extrae_campo($list_entidad1,"llave_entidad","U");
	 }

   $list_dep1=busca_filtro_tabla("","entidad_tarea","entidad_identidad=".$identidadd." AND tarea_idtarea IN(".implode(",",$artareas).")","",$conn);
   if($list_dep1["numcampos"])
   	  {
	   $list_dep2=extrae_campo($list_dep1,"llave_entidad","U");
	  }

$list_entidad3=array_merge((array)$list_entidad,(array)$list_entidad2);
$list_dep3=array_merge((array)$list_dep,(array)$list_dep2);
 }
else
{
	$list_entidad3=$list_entidad;
	$list_dep3=$list_dep;
}
      if(!$fecha_ini)
         {
            $fecha_ini=date("Y-m-d H:i:s");
         }
       if(!$fecha_fin)
         {
            $fecha_fin=date("Y-m-d H:i:s");
         }
	  if(!$fecha_fin || ($fecha_ini>$fecha_fin)) // si la no introdujeron fecha de finalizacion o es invalida
	   	{
	   		$ar_fechaini=date_parse($fecha_ini);
   			$anioinicial=$ar_fechaini["year"];
   	  	$mesinicial=$ar_fechaini["month"];
   			$diainicial=$ar_fechaini["day"];
   			$horainicial=($ar_fechaini["hour"]!="")? $ar_fechaini["hour"]:0;
   			$minutoinicial=($ar_fechaini["minute"]!="")? $ar_fechaini["minute"]:0;
   			$segundoinicial=($ar_fechaini["second"]!="")? $ar_fechaini["second"]:0;
   	    $fecha_fin=date("Y-m-d H:i:s", mktime( $horainicial+($tarea['tiempo_respuesta']), $minutoinicial, $segundoinicial,$mesinicial, $diainicial,$anioinicial));
   	  }

     //}

	/*echo("<br />DOC:".$iddoc."<br />Serie:".$idserie."<br />Tarea:".$tarea."<br />Entidad".$identidadf."<br />Fecha I:".$fecha_ini."<br />Fecha F:".$fecha_fin);
	print_r($list_entidad3);
	print_r($list_dep3);*/
 	  if(count($list_entidad3)){
             $ar_asig1=asignar_tarea_manual($iddoc,$idserie,$tarea,$list_entidad3,$identidadf,$fecha_ini,$fecha_fin,$reprograma,$tipo_reprograma);
	  }
	  if(count($list_dep3)){
	      $ar_asig2=asignar_tarea_manual($iddoc,$idserie,$tarea,$list_dep3,$identidadd,$fecha_ini,$fecha_fin,$reprograma,$tipo_reprograma);
	  }
if(count($ar_asig1)>0){
   $listado_asig=implode(",",$ar_asig1);
   if(count($ar_asig2)>0)
     $listado_asig.=",".implode(",",$ar_asig2);
 }
else
 {
   if(count($ar_asig2)>0)
     $listado_asig=implode(",",$ar_asig2);
 }
return($listado_asig);
}
function asignar_control($idasignacion=0){
  global $conn;
  if($idasignacion){
    $campos_control=array();
    $asignacion=busca_filtro_tabla("","asignacion","idasignacion = ".$idasignacion,"",$conn);
    if($asignacion["numcampos"]){
      $campos_control["asignacion_idasignacion"]=$idasignacion;
      if(@$_REQUEST["x_control_accion"]){
        $campos_control["accion"]=@$_REQUEST["x_control_accion"];
      }
      if(@$_REQUEST["x_control_periocidad"]){
        $campos_control["periocidad"]=@$_REQUEST["x_control_periocidad"];
      }
      if(@$_REQUEST["x_control_tipo_periocidad"]){
        $campos_control["tipo_periocidad"]=@$_REQUEST["x_control_tipo_periocidad"];
      }
      if(@$_REQUEST["x_control_anticipacion"]){
        $campos_control["anticipacion"]=@$_REQUEST["x_control_anticipacion"];
      }
      if(@$_REQUEST["x_control_tipo_anticipacion"]){
        $campos_control["tipo_anticipacion"]=@$_REQUEST["x_control_tipo_anticipacion"];
      }
      $fechaf=actualiza_fechas_tareas($asignacion[0]["fecha_inicial"],0,$campos_control["tipo_periocidad"],$campos_control["anticipacion"],$campos_control["tipo_anticipacion"]);
      $sql="INSERT INTO control_asignacion(".implode(",",array_keys($campos_control)).", fecha_actualizacion) VALUES('".implode("','",array_values($campos_control))."',".fecha_db_almacenar($fechaf,"Y-m-d H:i:s").")";
      phpmkr_query($sql,$conn);
    }
  }
}
if(isset($_POST['enviar']) && $_POST['enviar']){ // Verifica INICIAR PROCESAMIENTO o despliegue formulario
  //print_r($_REQUEST);
  $tipo_destino=NULL;// Entidad, Func, Cargo etc
  $list_destinos=NULL;
  $list_tareas=array();
  $list_entidad=array();

  if(@$_POST['lista_tareas'])
    $list_tareas=explode(",",$_POST['lista_tareas']); // lista de tareas

  if(@$_POST['x_destino'])
    $list_entidad=explode(",",$_POST['x_destino']); // lista de destinos asiganados a la tarea

  if(@$_POST["fecha_inicial"]){
    $fecha_ini=$_POST["fecha_inicial"];
  }
  else $fecha_ini=NULL;
  if(@$_POST["fecha_final"]){
    $fecha_fin=$_POST["fecha_final"];
  }
  else $fecha_fin=NULL;

  if(isset($_REQUEST['x_tipo_reprograma']))
   $tipo_reprograma=$_REQUEST['x_tipo_reprograma'];
  else
   $tipo_reprograma=NULL;

  if(isset($_REQUEST['x_reprograma']))
   $reprograma=$_REQUEST['x_reprograma'];
  else
   $reprograma=NULL;
   $lasignaciones=asignaciones($iddoc,$idserie,$list_tareas,$list_entidad,$fecha_ini,$fecha_fin,$reprograma,$tipo_reprograma);
  if($lasignaciones!=""){ //asignacion de tareas
    $lista_asignaciones=explode(",",$lasignaciones);
    for($i=0;$i<count($lista_asignaciones) && @$_REQUEST["x_control_accion"]!="";$i++){
      asignar_control($lista_asignaciones[$i]);
    }
    alerta("Tareas Adicionadas Exitosamente");
  }
  else alerta("Las Tareas No Fueron Adicionadas");
  if($popup) // Retorna el valor al campo oculto
   {
    echo "<script>
       	 window.opener.document.forms['".$nom_form."'].elements['".$nom_campo."'].value='".$lasignaciones."';
       	 window.opener.document.forms['".$nom_form."'].elements['".str_replace("asig_","",$nom_campo)."'].value='".$fecha_ini."';
	       window.close();
          </script>";
   }

}

 // Imprime el formulario para ingresar datos !
?>
<script type="text/javascript" src="../popcalendar.js"></script>
<div id="principal" scrolling="auto" height="100px">
<form name="asignacionadd" id="asignacionadd" action="asignacionadd.php"  method="post" onSubmit="return EW_checkMyForm(this);">
<input type="hidden" name="x_destino" id="x_destino" value="">
<input type="hidden" name="iddoc" id="iddoc" value="<?php echo @$iddoc; ?>">
<input type="hidden" name="idserie" id="idserie" value="<?php echo @$idserie; ?>">
<input type="hidden" name="lista_tareas" id="lista_tareas" value="">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="FFFFFF" width="100%" align="center">
   <tr valign="top" width="50%" height="300px">
    <td valign="top" width="50%" >
    <ol class="message_list">
    	<li>
    		<p class="message_head" id="resp">Asignar Responsables</p>
        <div class="message_body">
        <div id="treeboxbox_treeresp"> </div>
          <script type="text/javascript">
            tree2=new dhtmlXTreeObject("treeboxbox_treeresp","400px","150px",0);
            tree2.setImagePath("../imgs/");
            tree2.enableIEImageFix(true);
            tree2.enableCheckBoxes(1);
            tree2.enableThreeStateCheckboxes(true);
            tree2.setXMLAutoLoading("../test.php");
            tree2.loadXML("../test.php");
          </script>
        </div>
    	</li>
    	<li>
    		<p class="message_head" id="fechas">Asignar Fechas</p>
    		<div class="message_body"> <?php $anio=date("Y");$mes=date("m");$hoy=date("Y-m-d H:i:s"); ?>
          <table border="0">
      	     <tr><td>Fecha Inicial:</td><td> <input type="text" name="fecha_inicial" value="<?php echo $hoy; ?>"><?php selector_fecha("fecha_inicial","asignacionadd","Y/m/d H:i:s",$mes,$anio,"default.css","../","AD:VALOR","VENTANA"); ?></td><tr>
   		       <tr><td>Fecha Final  :</td><td> <input type="text"
               name="fecha_final" value="<?php echo $hoy; ?>"><?php
               selector_fecha("fecha_final","asignacionadd","Y/m/d H:i:s",$mes,$anio,"default.css","../","AD:VALOR","VENTANA");
               ?></td></tr>
	<tr>
	<td>Repetir cada</td><td>
	<input type="text" name="x_reprograma" id="x_reprograma" size="5" value="<?php
echo $x_reprograma; ?>">
</span>
	<select name="x_tipo_reprograma">
	  <option name="ninguna" value="NULL">No se repite</option>
	  <!--option name="minuto" value="minute">Minuto(s)</option>
		<option name="hora" value="hour">Hora(s)</option-->
    <option value="day">D&iacute;a(s)</option>
    <option value="month">Mes(es)</option>
    <option value="year">A&ntilde;o(s)</option>
  </select>
</span></td>
<input type="hidden" name="x_asignacion_idasignacion" id="x_asignacion_idasignacion" value="<?php echo htmlspecialchars(@$x_asignacion_idasignacion); ?>">
<input type="hidden" name="popup" id="popup" value="<?php echo htmlspecialchars(@$popup); ?>">
<input type="hidden" name="nom_form" id="nom_form" value="<?php echo htmlspecialchars(@$nom_form); ?>">
<input type="hidden" name="nom_campo" id="nom_campo" value="<?php echo htmlspecialchars(@$nom_campo); ?>">
		</tr>
   		    </table>
         </div>
    	</li>
    	<li>
    		<p class="message_head" id="controles">Asignar Controles</p>
    		<div class="message_body">
          <table border="0">
      	    <tr>
              <td>Accion :</td>
              <td>
                <select  id="x_control_accion" name="x_control_accion">
                  <option value="">Por Favor Seleccione</option>
	                <option value="enviar_correo.php">Correo</option>
	                <option value="enviar_mensaje.php">Mensajeria</option>
                </select>
              </td>
            </tr>
   		      <tr>
              <td>Repite cada :</td>
              <td>
                <input type="text" name="x_control_periocidad" id="x_control_periocidad" size="5" value="0">
	              <select name="x_control_tipo_periocidad">
	                <option value="NULL">No se repite</option>
                  <!--option name="control_minuto" value="minute">Minuto(s)</option>
                  <option name="control_hora" value="hour">Hora(s)</option-->
                  <option value="day">D&iacute;a(s)</option>
                  <option value="month">Mes(es)</option>
                  <option value="year">A&ntilde;o(s)</option>
                </select>
                </span>
              </td>
            </tr>
	          <tr>
              <td>Avisar :</td>
              <td>
	              <input type="text" name="x_control_anticipacion" id="x_control_anticipacion" size="5" value="0">
                <select name="x_control_tipo_anticipacion">
	                <option value="minute">Minuto(s)</option>
		              <option value="hour">Hora(s)</option>
                  <option value="day">D&iacute;a(s)</option>
                  <option value="month">Mes(es)</option>
                  <option value="year">A&ntilde;o(s)</option>
                </select> Antes
              </td>
		        </tr>
		        <tr>
              <td>Ejecutar Hasta :</td>
              <td>
                <input type="text" name="x_control_ejecutar_hasta" id="x_control_ejecutar_hasta" value="">
<?php selector_fecha("x_control_ejecutar_hasta","asignacionadd","Y/m/d H:i:s",date("m"),date("Y"),"ceramique.css","../","AD:VALOR","VENTANA"); ?>
              </td>
		        </tr>
   		    </table>
         </div>
    	</li>
    </ol>
    </td>
  </tr>
  <tr>
   <td colspan="2" bgcolor="#FFFFFF" align="center">
     <input type="submit" name="enviar" id="enviar" value="Continuar">
   </td>
  </tr>
</table>
</form>
</div>
</html>
