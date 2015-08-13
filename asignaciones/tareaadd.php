<?php
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
  header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
  header("Cache-Control: post-check=0, pre-check=0", false); 
  header("Pragma: no-cache"); // HTTP/1.0 
  //sesion();
 //session_start();

include_once("../db.php");
include_once("funciones.php");
//Obtengo el resultado enciado del formulario
if(@$_POST) // llegan datos del formulario  y los procesa
{
  $control=NULL;
   if(@$_REQUEST["x_destino"]){
    $responsable=$_REQUEST["x_destino"];
   }
   else 
    $responsable=NULL;
   $respuesta=$_REQUEST["respuesta"]*$_REQUEST["unidad"];
   $idtarea=adicionar_tarea($_REQUEST["nombre"],$_REQUEST["descripcion"],$respuesta,$_REQUEST["padre"],$control,$responsable,$_REQUEST["x_periodicidad"],$_REQUEST["x_tipo_periodicidad"]);
   if($idtarea){
    switch(@$_REQUEST["control"]){
      case 0: 
         $enlace="tarealist.php?cmd=resetall";
         break;
      case 1:
        $enlace="tareaadd.php";
      break;
      case 2:
        $enlace="control.php?idtarea=".$idtarea;
      break;
      case 3:
        $enlace="asignar_tarea.php?idtarea=".$idtarea;
        if(@$_REQUEST["iddoc"]){
          $enlace.="&iddoc=".$_REQUEST["iddoc"];
        }
        if(@$_REQUEST["idserie"]){
          $enlace.="&idserie=".$_REQUEST["idserie"];
        }
      break;
    }
   } 
   else{
     alerta("Error al crear la tarea");
     $enlace="tarealist.php";
   }  
   redirecciona($enlace);
}
else 
{ // Imprime el formulario para ingresar datos !
?>
<?php include_once ("../header.php"); ?>
<script type="text/javascript" src="../js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="../js/dhtmlXTree.js"></script>
<script language="javascript" type="text/javascript">

function EW_checkMyForm(EW_this) {

var list_arbol=tree2.getAllChecked();
var responsables = list_arbol.split(",");

if(responsables && responsables.length){
  EW_this.x_destino.value=list_arbol;
  //alert(list_arbol);
}

if (EW_this.nombre.value == "") {
	this.alert("POR FAVOR INGRESE EL CAMPO REQUERIDO - NOMBRE DE LA TAREA");
	 return false;
}
if (EW_this.descripcion.value == "") {
	this.alert("POR FAVOR INGRESE EL CAMPO REQUERIDO - DESCRIPCION");
	 return false;
}
if(EW_this.x_destino.value==""){
  alert("Por favor ingrese el campo requerido - responsable(s) de la tarea");
  return(false);
}

if (EW_this.lista_acciones[0].selected == "") {
	this.alert("POR FAVOR INGRESE EL CAMPO REQUERIDO - TIPO DE ACCION");
	 return false;
}

if (EW_this.x_tipo_periodicidad.selected == "") {
	this.alert("POR FAVOR INGRESE EL CAMPO REQUERIDO - TIPO PERIODICIDAD");
	 return false;
	 }
if (EW_this.x_periodicidad.value == "") {
	this.alert("POR FAVOR INGRESE EL CAMPO REQUERIDO - PERIODICIDAD");
	 return false;	 
}

return true;
}
</script>

  <form name="tareaadd" id="tareaadd" action="tareaadd.php"  method="POST" onSubmit="return(EW_checkMyForm(this)) " >
     <table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
       <tr> 
        <td width="188" class="encabezado"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">Nombre</span></font></td>
        <td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input type="text" name="nombre" id="nombre" size="30" value="" ?></span></font></td>
       </tr>
       <tr> 
        <td width="188" class="encabezado"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">Descripci&oacute;n</span></font></td>
        <td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><textarea name="descripcion" id="descripcion" cols="30"></textarea></span></font></td>
       </tr>
       <tr> 
        <td width="188" title="Tiempo en horas (dias=numer*24 mes=numero*720) que transcurre entre la fecha y hora de asignacion de la tarea y la ejecucion del control o anuncio a Funcionario con nivel de jerarquia superior" class="encabezado"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">Tiempo Limite de Respuesta</span></font></td>
        <td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span >
        <input type="text" name="respuesta" value="0">
	        <select name="unidad">
	        <option value="1">Horas</option>
	        <option value="24">Dias</option>
	        <option value="720">Mes(30dias)</option>
	        </select>
         </span></font>
         </td>
        </tr>
	   <tr>
            <td class="encabezado">Periodicidad</td>
            <td bgcolor="#F5F5F5">
              <input type="text" name="x_periodicidad" id="x_periodicidad" size="5" value="0">
              <select name="x_tipo_periodicidad">
                <option value="hour" selected >Hora(s)</option>
                <option value="day">D&iacute;a(s)</option>
                <option value="month">Mes(es)</option>
                <option value="year">A&ntilde;o(s)</option>
              </select> 
            </td>
	        </tr>
       <tr>
         <td width="188" title="Personas a las que se les debe asignar las Tareas" class="encabezado"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">Funcionarios/Dependencias Responsables</span></font></td>
         <td bgcolor="#F5F5F5">
         <input type="hidden" name="x_destino" id="x_destino" value="">
         <div id="treeboxbox_treeresp"> </div>
            <script type="text/javascript">
              tree2=new dhtmlXTreeObject("treeboxbox_treeresp","100%","100%",0);
              tree2.setImagePath("../imgs/");
              tree2.enableIEImageFix(true);
              tree2.enableCheckBoxes(1);
              tree2.enableThreeStateCheckboxes(true);
              tree2.setXMLAutoLoading("../test.php");
              tree2.loadXML("../test.php");
            </script>
         </td>
       </tr>
       <tr>
        <td width="188" title="Acciones a seguir luego de Crear la Tarea" class="encabezado"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">Continuar con </span></font></td>
        <td bgcolor="#F5F5F5">
          <input type="radio" name="control" value="0" checked="true">Ir al Listado<br>
          <input type="radio" name="control" value="1" >Adicionar Otra Tarea<br>
          <input type="radio" name="control" value="2" >Adicionar control a la Tarea<br>
          <?php if(@$_REQUEST["iddoc"] || @$_REQUEST["idserie"]){ ?>
            <input type="radio" name="control" value="3" >Asignar Tarea<br>
          <?php } ?>
        </td>
       </tr>
      </table><br>
  <input type="submit" name="Action" id="Action" value="CONTINUAR" class="buttonSubmit">      
  </form>
<?php } //Fin del else de impresion de formularios 
?>
<?php include ("../footer.php") ?>
