<html>
<head>
<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
<?php
include_once ("../db.php");
include_once("../header.php");

if(isset($_REQUEST["modo"]))
 $modo=$_REQUEST["modo"];
else 
 $modo="usuario";
 
$descripcion="";
$fecha_inicial="";
$fecha_final="";
$reprograma="";
$tipo_reprograma="";
$entidad="";
$llave_entidad="";
$iddocumento="";
$idserie="";
$idtarea="";
$estado="";

$control_accion="";
$control_periocidad="";
$control_tipo_periocidad="";
$control_anticipacion="";
$control_tipo_anticipacion;
$control_ejecutar_hasta="";


function cargar_datos_asignacion($idasignacion)
 { 
   global $conn;
   global $descripcion,$fecha_inicial,$fecha_final,$reprograma,$tipo_reprograma,$entidad,$llave_entidad,$iddocumento,$idserie,$idtarea,$estado;

   global $control_accion,$control_periocidad,$control_tipo_periocidad,$control_anticipacion,$control_tipo_anticipacion,$control_ejecutar_hasta;
   
   $asignacion=busca_filtro_tabla("","asignacion","asignacion.idasignacion=".$idasignacion,"",$conn);
        
  if($asignacion["numcampos"]>0)
   {         
       $descripcion=$asignacion[0]["descripcion"];
       $fecha_inicial=$asignacion[0]["fecha_inicial"];
       $fecha_final=$asignacion[0]["fecha_final"];
       $reprograma=$asignacion[0]["reprograma"];
       $tipo_reprograma=$asignacion[0]["tipo_reprograma"];
       $entidad=$asignacion[0]["entidad"];
       $llave_entidad=$asignacion[0]["llave_entidad"];
       $iddocumento=$asignacion[0]["documento_iddocumento"];
       $idserie=$asignacion[0]["serie_idserie"];
       $idtarea=$asignacion[0]["tarea_idtarea"];
       $estado=$asignacion[0]["estado"];
    
       
       $control=busca_filtro_tabla("","control_asignacion","asignacion_idasignacion=".$idasignacion,"",$conn);
      
       if($control["numcampos"]>0)
         { 
	   $control_accion=$control[0]["accion"];
	   $control_periocidad=$control[0]["periocidad"];
	   $control_tipo_periocidad=$control[0]["tipo_periocidad"];	   
	   $control_anticipacion=$control[0]["anticipacion"];
	   $control_tipo_anticipacion=$control[0]["tipo_anticipacion"];
	   $control_ejecutar_hasta=$control[0]["ejecutar_hasta"];
	  
	 }
   }   

 }

 if(isset($_REQUEST["idasignacion"]))
   { 
     cargar_datos_asignacion($_REQUEST["idasignacion"]);
     $idasignacion = $_REQUEST["idasignacion"];
   }
 else 
   {
     alerta("No se encontro una asignacion asociada para editar",'error',4000);
     volver(1);
   }
 

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



?>
<script type="text/javascript" src="../js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="../js/dhtmlXTree.js"></script>
<script language="javascript" type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {
	
//Copia las variables oculta para pasar luego al formulario
//var list_arbol=tree2.getAllChecked();
//var responsables = list_arbol.split(",");       

if(EW_this.x_descripcion.value==""){
  alert("Por favor ingrese el campo requerido - Descripcion");
  return(false);
}
if(EW_this.x_destino.value==""){
  alert("Por favor ingrese el campo requerido - responsable(s) de la tarea");
  return(false);
}
if(EW_this.fecha_final.value=="" || EW_this.fecha_inicial.value==""){
  if(EW_this.fecha_final.value==""){
    alert("Por favor Ingrese el Valor de la Fecha Vencimiento");
    return(false);
  }
  if(EW_this.fecha_inicial.value==""){
    alert("Por favor Ingrese el Valor de la Fecha Inicio");
    return(false);
  }
}
else{
	//alert(EW_this.fecha_final.value+EW_this.fecha_inicial.value);
  if(EW_this.fecha_final.value<EW_this.fecha_inicial.value){
    alert("Por favor Seleccione su fecha de vencimiento MAYOR que la Fecha Inicio");
    return(false);
  }
}
/*if (EW_this.iddoc.value=='' && EW_this.idserie.value=='') {
	this.alert("POR FAVOR SELECCIONE  DATOS para asignar la tarea");
	 return false;
}*/

return true;
}
-->
</script>
</head>
<?php

function asignaciones($iddoc=NULL,$idserie=NULL,$artareas=NULL,$arentidad=NULL,$fecha_ini=NULL,$fecha_fin=NULL,$reprograma=NULL,$tipo_reprograma=NULL,$descripcion=NULL)
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
   	     
  
	//echo("<br />DOC:".$iddoc."<br />Serie:".$idserie."<br />Tarea:".$tarea."<br />Entidad".$identidadf."<br />Fecha I:".$fecha_ini."<br />Fecha F:".$fecha_fin);
	
	if(count($list_entidad3)){
	      $ar_asig1=asignar_tarea_manual($iddoc,$idserie,$tarea,$list_entidad3,$identidadf,$fecha_ini,$fecha_fin,$reprograma,$tipo_reprograma,$descripcion);
	  }

   $listado_asig=implode(",",$ar_asig1);
   
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
      $sql="INSERT INTO control_asignacion(".implode(",",array_keys($campos_control)).", ejecutar_hasta, fecha_actualizacion) VALUES('".implode("','",array_values($campos_control))."',".fecha_db_almacenar(@$_REQUEST["x_control_ejecutar_hasta"],"Y-m-d H:i:s").",".fecha_db_almacenar($fechaf,"Y-m-d H:i:s").")";
      
      //die($sql);
      phpmkr_query($sql,$conn);
    }
  }
}
if(isset($_REQUEST['enviar']) && $_REQUEST['enviar']){ // Verifica INICIAR PROCESAMIENTO o despliegue formulario
  //print_r($_REQUEST);
  $tipo_destino=NULL;// Entidad, Func, Cargo etc
  $list_destinos=NULL; 
  $list_tareas=array();
  $list_entidad=array();

  if(@$_REQUEST['lista_tareas'])
   $tarea=$_REQUEST['lista_tareas']; // Tarea almacenada no es lista
  else 
   $tarea="NULL";
   
  if(@$_REQUEST['x_destino'])  
    $list_entidad=explode(",",$_REQUEST['x_destino']); // lista de destinos asiganados a la tarea
    
  if(@$_REQUEST["fecha_inicial"]){
    $fecha_inicial=$_REQUEST["fecha_inicial"];
  }  
  else $fecha_inicial=NULL;
  if(@$_REQUEST["fecha_final"]){
    $fecha_final=$_REQUEST["fecha_final"];
  }  
  else $fecha_final=NULL;
  
  if(isset($_REQUEST['x_tipo_reprograma']))
   $tipo_reprograma=$_REQUEST['x_tipo_reprograma'];
  else 
   $tipo_reprograma=NULL;
   
   if(isset($_REQUEST['x_descripcion']))
    $descripcion=$_REQUEST['x_descripcion'];
  else 
    $descripcion=NULL;
    
    if(isset($_REQUEST['iddoc']))
     $iddoc=$_REQUEST['iddoc'];

  if(isset($_REQUEST['x_reprograma']))
   $reprograma=$_REQUEST['x_reprograma'];
  else 
   $reprograma=NULL;
  
  if(isset($_REQUEST['idasignacion']))
    $idasignacion=$_REQUEST['idasignacion'];
  else 
    $idasignacion=NULL;
   
  if(isset($_REQUEST['x_control_accion']))
    $control_accion=$_REQUEST['x_control_accion'];
  else 
    $control_accion=NULL;
 
  if(isset($_REQUEST['x_control_periocidad']))
    $control_periocidad=$_REQUEST['x_control_periocidad'];
  else 
    $control_periocidad=NULL;
   
  if(isset($_REQUEST['x_control_tipo_periocidad']))
    $control_tipo_periocidad=$_REQUEST['x_control_tipo_periocidad'];
  else 
    $control_tipo_periocidad=NULL;
    
  if(isset($_REQUEST['x_control_tipo_anticipacion']))
    $control_tipo_anticipacion=$_REQUEST['x_control_tipo_anticipacion'];
  else 
    $control_tipo_anticipacion=NULL;
    
  if(isset($_REQUEST['x_control_anticipacion']))
    $control_anticipacion=$_REQUEST['x_control_anticipacion'];
  else 
    $control_anticipacion=NULL;
    
  if(isset($_REQUEST['x_control_ejecutar_hasta']))
    $control_ejecutar_hasta=$_REQUEST['x_control_ejecutar_hasta'];
  else 
    $control_ejecutar_hasta=NULL;    

global $conn;

$list_entidad = Array();
$list_dep = array();

//print_r($_REQUEST);

foreach($arentidad AS $entidad){ 
  if(!strstr($entidad, '#')){
	  array_push($list_entidad,$entidad);
	}  
	else{	
    array_push($list_dep,str_replace("#","",$entidad));
  }   
}

$sql="UPDATE asignacion set tarea_idtarea='$tarea', fecha_inicial='$fecha_inicial', fecha_final='$fecha_final', reprograma='$reprograma', tipo_reprograma='$tipo_reprograma', descripcion='$descripcion' WHERE idasignacion=$idasignacion"; 
phpmkr_query($sql,$conn) or error("No se Pudo Actualizar la Asignacion ");
$sql="UPDATE control_asignacion set accion='$control_accion', periocidad='$control_periocidad', tipo_periocidad='$control_tipo_periocidad', anticipacion='$control_anticipacion', tipo_anticipacion='$control_tipo_anticipacion', ejecutar_hasta='$control_ejecutar_hasta' WHERE asignacion_idasignacion=$idasignacion"; 
phpmkr_query($sql,$conn) or error("No se Pudo Actualizar el Control la Asignacion ");
abrir_url("asignaciones.php?modo=".$modo,"centro");
//echo $sql;
}

 // Imprime el formulario para ingresar datos !
 /*
$descripcion="";
$fecha_inicial="";
$fecha_final="";
$reprograma="";
$tipo_reprograma="";
$entidad="";
$llave_entidad="";

$control_accion="";
$control_periocidad="";
$control_tipo_periocidad="";
$control_anticipacion="";
$control_tipo_anticipacion
$control_ejecutar_hasta="";*/
?>
<script type="text/javascript" src="../popcalendar.js"></script>
<form name="asignacionadd" id="asignacionadd" action="asignacionedit.php"  method="post" onSubmit="return EW_checkMyForm(this);">
<input type="hidden" name="iddoc" id="iddoc" value="<?php echo $iddocumento; ?>">
<input type="hidden" name="idserie" id="idserie" value="<?php echo @$idserie; ?>">
<input type="hidden" name="estado" id="estado" value="<?php echo @$estado; ?>">
<input type="hidden" name="lista_tareas" id="lista_tareas" value="<?php echo $idtarea;?>" >
<input type="hidden" name="idasignacion" id="idasignacion" value="<?php echo $idasignacion;?>" >
<input type="hidden" name="modo" id="modo" value="<?php echo $modo;?>" >

<table border="1" cellspacing="1" cellpadding="4" bgcolor="FFFFFF" width="100%" align="center" style="border-collapse:collapse;">
<tr>
 <td class="encabezado">Descripcion (*):</td>
<td>
  <input type="text" name="x_descripcion" id="x_descripcion" value="<?php echo $descripcion; ?>" size="40">
 </td>
<tr>

<tr valign="top" width="100px">
    <td class="encabezado">
  		Asignar Responsables(*)
    </td>
    <td class="phpmaker">
    <?php
     $funcionario=busca_filtro_tabla("nombres,login","funcionario","funcionario_codigo=".$llave_entidad,"",$conn);
     ?>
     <label>Notificacion Actual a: <?php echo $funcionario[0]["nombres"]."(".$funcionario[0]["login"].")";?> </label> 
     <br />
      <input type="hidden" name="x_destino" id="x_destino" value="<?php echo @$llave_entidad; ?>">
    </td>
    </tr>
    <tr >
      <td class="encabezado">
  		  Asignar Fechas(*)
      </td>
      <td class="phpmaker">
    	  <?php $anio=date("Y");$mes=date("m");$hoy=date("Y-m-d H:i:s"); ?>
        <table border="0">
          <tr>
            <td width="90px">Inicio (*):</td>
            <td> <input type="text" name="fecha_inicial" value="<?php echo $fecha_inicial; ?>" size="23"><?php selector_fecha("fecha_inicial","asignacionadd","Y-m-d H:i:s",$mes,$anio,"default.css","../","AD:VALOR","VENTANA"); ?></td>
          </tr>
          <tr>
            <td>Vencimiento (*):</td>
            <td> <input type="text" name="fecha_final" value="<?php echo  $fecha_final; ?>" size="23"><?php selector_fecha("fecha_final","asignacionadd","Y-m-d H:i:s",$mes,$anio,"default.css","../","AD:VALOR","VENTANA");  ?></td>
          </tr>
	        <tr>
	         <td>Repetir cada:</td>
           <td><input type="text" name="x_reprograma" id="x_reprograma" size="5" value="<?php echo $reprograma; ?>">
              <select name="x_tipo_reprograma">
	              <option name="ninguna" value="NULL">No se repite</option>
	              <!--option name="minuto" value="minute">Minuto(s)</option>
                <option name="hora" value="hour">Hora(s)</option-->
                <option value="day"  <?php if($tipo_reprograma=="day") echo " selected "?>>D&iacute;a(s)</option>
                <option value="month" <?php if($tipo_reprograma=="month") echo " selected "?>>Mes(es)</option>
                <option value="year"  <?php if($tipo_reprograma=="year") echo " selected "?> >A&ntilde;o(s)</option>
              </select>
            <input type="hidden" name="x_asignacion_idasignacion" id="x_asignacion_idasignacion" value="<?php echo htmlspecialchars(@$x_asignacion_idasignacion); ?>">
            <input type="hidden" name="popup" id="popup" value="<?php echo htmlspecialchars(@$popup); ?>">
<input type="hidden" name="nom_form" id="nom_form" value="<?php echo htmlspecialchars(@$nom_form); ?>">
<input type="hidden" name="nom_campo" id="nom_campo" value="<?php echo htmlspecialchars(@$nom_campo); ?>">
           </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td class="encabezado" id="controles">Asignar Controles</td>
    	<td class="phpmaker">
        <table border="0">
    	    <tr >
            <td width="90px">Accion (*):</td>
            <td >
              <select  id="x_control_accion" name="x_control_accion">
                <option value="">Por Favor Seleccione</option>
                <option value="enviar_correo.php" <?php if($control_accion=="enviar_correo.php") echo " selected "?> >Correo</option>
                <option value="enviar_mensaje.php"<?php if($control_accion=="enviar_mensaje.php") echo " selected "?> >Mensajeria</option>
              </select>
            </td>
          </tr>
           <tr>
            <td>Avisar :</td>
            <td>
              <input type="text" name="x_control_anticipacion" id="x_control_anticipacion" size="5" value="<?php echo $control_anticipacion; ?>">
              <select name="x_control_tipo_anticipacion">
                <option value="minute"      <?php if($control_tipo_anticipacion=="minute") echo " selected " ?> >Minuto(s)</option>
	        <option value="hour"         <?php if($control_tipo_anticipacion=="hour")   echo " selected " ?> >Hora(s)</option>
                <option value="day"         <?php if($control_tipo_anticipacion=="day")    echo " selected " ?> >D&iacute;a(s)</option>
                <option value="month"       <?php if($control_tipo_anticipacion=="month")  echo " selected " ?> >Mes(es)</option>
                <option value="year"        <?php if($control_tipo_anticipacion=="year") echo " selected " ?> >A&ntilde;o(s)</option>
              </select> Antes
            </td>
	        </tr>
            <tr>
            <td>Repite cada :</td>
            <td>
              <input type="text" name="x_control_periocidad" id="x_control_periocidad" size="5" value="<?php echo $control_periocidad; ?>">
              <select name="x_control_tipo_periocidad">
                <option value="NULL">No se repite</option>
		<!--option name="control_minuto" value="minute">Minuto(s)</option>
                <option name="control_hora" value="hour">Hora(s)</option-->
		<option value="minute" <?php if($control_tipo_periocidad=="minute") echo " selected " ?> >Minuto(s)</option>
                <option value="day"    <?php if($control_tipo_periocidad=="day")    echo " selected " ?> >D&iacute;a(s)</option>
                <option value="month"  <?php if($control_tipo_periocidad=="month")  echo " selected " ?> >Mes(es)</option>
                <option value="year"   <?php if($control_tipo_periocidad=="year")   echo " selected " ?> >A&ntilde;o(s)</option>
              </select>
            </td>
          </tr>		
	        <tr>
            <td>Ejecutar Hasta :</td>
            <td>
              <input type="text" name="x_control_ejecutar_hasta" id="x_control_ejecutar_hasta" value="<?php echo  $control_ejecutar_hasta; ?> " size="25">
<?php selector_fecha("x_control_ejecutar_hasta","asignacionadd","Y-m-d H:i:s",date("m"),date("Y"),"default.css","../","AD:VALOR","VENTANA"); ?>
            </td>
	        </tr>
 		    </table>
      </td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#FFFFFF" align="center">
        <input type="submit" name="enviar" id="enviar" value="Continuar">
      </td>
    </tr>
</table>
</form>
</html>
<?php include_once("../footer.php"); ?>