<?php

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
// Initialize common variables
$x_idactividad_paso = Null;
$x_descripcion = Null;
$x_accion_idaccion = Null;
$x_paso_idpaso= Null;
$x_restrictivo = Null;
$x_estado= Null;
$x_orden = Null;
$x_tipo = Null;
$x_tipo_entidad = Null;
$x_llave_entidad = Null;
$x_plazo = 24;
$x_tipo_plazo= Null;
$x_modulo = Null;
$x_llave_accion = Null;

include ("../db.php");
include ("libreria_paso.php");
include ("../formatos/librerias/estilo_formulario.php");
include ("../formatos/librerias/header_formato.php");

// Get action
$sAction = @$_POST["a_add"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sKey = @$_GET["key"];
	$sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;
	if ($sKey <> "") {
		$sAction = "C"; // Copy record
	}
	else
	{
		$sAction = "I"; // Display blank record
	}
}
else
{
	// Get fields from form
  $x_idactividad_paso = @$_POST["x_idactividad_paso"];
  $x_descripcion = @$_POST["x_descripcion"];
  $x_paso_idpaso = @$_POST["paso_idpaso"];
  $x_accion_idaccion = @$_POST["x_accion_idaccion"];
  $x_restrictivo = @$_POST["x_restrictivo"];
  $x_estado= @$_POST["x_estado"];
  $x_orden = @$_POST["x_orden"];
  $x_tipo = @$_POST["x_tipo"];
  $x_tipo_entidad = @$_POST["tipo_entidad"];
  $x_llave_entidad = @$_POST["x_llave_entidad"];
  $x_plazo = @$_POST["x_plazo"];
  $x_tipo_plazo = @$_POST["x_tipo_plazo"];
  $x_modulo = @$_POST["x_modulo"];
  $x_llave_accion = @$_POST["x_llave_accion"];
}

switch ($sAction)
{
	case "A": // Add
		if (AddData($conn)) { // Add New Record
		  calcular_plazo_paso($x_paso_idpaso);
			redirecciona("actividades_paso.php?idpaso=".$_REQUEST["paso_idpaso"]);
			exit();
		}
		break;
}
?>

<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript" src="../js/cmxforms.js"></script>
<script type="text/javascript" src="../js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="../js/dhtmlXTree.js"></script>
<link rel="STYLESHEET" type="text/css" href="../css/dhtmlXTree.css">
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {
var list_funcionarios=0;  
var tipo_entidad=$('#tipo_entidad').val();
if(tipo_entidad==1){
   list_funcionarios = tree1.getAllChecked();
}
if(tipo_entidad==2){
   list_funcionarios = tree2.getAllChecked();      
}
if(tipo_entidad==4){
  list_funcionarios = tree4.getAllChecked(); 
}   
var funcionarios = list_funcionarios.split(",");
var func ="";
for(i=0; i<funcionarios.length; i++)
{ if(funcionarios[i]!="")     
   {     
    aux_ruta =funcionarios[i].indexOf("%");            
    if(aux_ruta != -1)
     { ruta=funcionarios[i].substring(aux_ruta+1);
       funcionarios[i]=funcionarios[i].substring(0,aux_ruta);         
     }   
    if(func=="")  
      func = funcionarios[i];
    else
      func += ","+funcionarios[i];
   }        
}
document.adicionar_actividad_paso.x_llave_entidad.value=func; 
if(EW_this.x_llave_entidad && EW_this.x_llave_entidad.value == ""){ 
  alert("Por favor ingresar un funcionario o dependencia destino para transferir el documento");
	return false;
}

 

if (EW_this.x_descripcion && !EW_hasValue(EW_this.x_descripcion, "TEXT" )) {

	if (!EW_onError(EW_this, EW_this.x_descripcion, "TEXT", "Por favor ingrese los campos requeridos - descripcion"))

		return false;

}

var list_modulo = tree3.getAllChecked();  

document.getElementById('x_modulo').value=list_modulo;    

return true;

}

function valores_entidad(identidad){
  if(identidad!=""){
    $.ajax({url: "arbol_entidades.php" ,
      data:"entidad="+identidad+"<?php if(@$_REQUEST['tipo_entidad']) echo '&tipo_entidad='.$_REQUEST['tipo_entidad'] ; if(@$_REQUEST['llave_entidad']) echo '&llave_entidad='.$_REQUEST['llave_entidad']; ?>",
      type: "POST",
      success: function(msg){
      $("#sub_entidad").html(msg);
    }});        
  }       
}

//-->

</script>

<p>&nbsp;&nbsp;ADICIONAR ACTIVIDADES AL PASO<br><br><a href="actividades_paso.php?idpaso=<?php echo($_REQUEST["paso_idpaso"]);?>">Regresar al listado</a></p>

<form name="adicionar_actividad_paso" id="adicionar_actividad_paso" action="adicionar_actividad_paso.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_add" value="A">    
<input type="hidden" name="paso_idpaso" id="paso_idpaso" value="<?php echo(@$_REQUEST["paso_idpaso"]);?>">   
<input type="hidden" name="x_llave_entidad" value="<?php echo(@$_REQUEST["llave_entidad"]);?>">
<input type="hidden" name="x_llave_accion" id="x_llave_accion">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC" width="95%">
	<tr>
		<td class="encabezado" title="Descripcion de la actividad."><span class="phpmaker" style="color: #FFFFFF;">DESCRIPCION</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_descripcion" id="x_descripcion" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_descripcion) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Por favor seleccione el tipo de restriccion de la actividad, es decir el paso se cumple si y solo si la actividad se cumple o el paso se cumple sin importar si la accion se cumple o no.">
      <span class="phpmaker" style="color: #FFFFFF;">RESTRICTIVA </span>
    </td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
      SI <input type="radio" name="x_restrictivo" id="x_restrictivo" value="1" checked="true">
      NO <input type="radio" name="x_restrictivo" id="x_restrictivo" value="0"></span>
    </td>
	</tr>
  	<tr>
		<td class="encabezado" title="Por favor seleccione el estado de la actividad es decir si la actividad se encuentra activa o inactiva.">
      <span class="phpmaker" style="color: #FFFFFF;">ESTADO</span>
    </td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
      ACTIVA <input type="radio" name="x_estado" id="x_estado" value="1" checked="true">
      INACTIVA <input type="radio" name="x_estado" id="x_estado" value="0"></span>
    </td>
	</tr>
    <tr>
		<td class="encabezado" title="Por favor seleccione el orden en el que se debe ejecutar la actividad.">
      <span class="phpmaker" style="color: #FFFFFF;">ORDEN</span>
    </td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">       
         <select name="x_orden" id="x_orden">
          <option value='0'>Posterior a</option>
          <?php
            $orden=busca_filtro_tabla("descripcion,orden","paso_actividad","paso_idpaso=".$_REQUEST["paso_idpaso"],"orden DESC",$conn);
          for($i=0;$i<$orden["numcampos"];$i++)
            echo "<option value='".($orden[$i]["orden"]+1)."' >".delimita($orden[$i]["descripcion"],50)."</option>";
          ?>
        </select>
            </span>
        </td>
	</tr>	
	<tr>
	   <td class="encabezado" title="Por favor seleccione el tipo de Actividad entre el Sistema (Actividad que se debe ejecutar si el sistema realiza la actividad seleccionada) y Manual(Actividad que se debe ejecutar y confirmar de forma manual- La accion como tal se debe terminar de forma manual).">
        <span class="phpmaker" style="color: #FFFFFF;">TIPO</span>
       </td>
	   <td bgcolor="#F5F5F5"><span class="phpmaker">
        Sistema <input type="radio" name="x_tipo" id="x_tipo" value="1" checked="true">
        Manual <input type="radio" name="x_tipo" id="x_tipo" value="0">
        </span>
       </td>
	</tr>
    <tr>
		<td class="encabezado" title="Por favor seleccione la actividad interna del sistema relacionada con una actividad por ejemplo al adicionar un documento, al generar un numero de radicado, al editar un documento, al aprobar un documento, al eliminar un documento, al leer el documento, etc.."><span class="phpmaker" style="color: #FFFFFF;">ACCION INTERNA DEL SISTEMA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
      <select name="x_accion_idaccion" id="x_accion_idaccion">
      <option value='0'>Seleccionar...</option>
      <?php
      $accion=busca_filtro_tabla("idaccion,nombre","accion","","lower(nombre)",$conn);
      for($i=0;$i<$accion["numcampos"];$i++)
        echo "<option value='".$accion[$i]["idaccion"]."' >".$accion[$i]["nombre"]."</option>";
      ?>

      </select> 
<script>
	$("#x_accion_idaccion").change(function(){
		var accion = $("#x_accion_idaccion").val();
		crear_arbol(accion);
	});
	function crear_arbol(accion){
		$.post('funciones_acciones_paso.php',{idaccion : accion,accion : 'responder',campo : 'llave'},function(data){
			ruta_xmlx = 'test_formatos.php';
			$("#mostrar").html('');
			$("#mostrar").html(data);
			$("#mostrar").show();
		});
	}
	function llenar_valor_llave(){
		$("#x_llave_accion").val($("#llave").val());
		document.adicionar_actividad_paso.submit();
	}
	</script>
</span>
<br><div id="mostrar" style="display:none"></div>
</td>

	</tr>	

    <tr>

		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TIPO DE RESPONSABLE*</span>

        </td>

        <td bgcolor="#F5F5F5"><span class="phpmaker">

          <?php

          $entidad = busca_filtro_tabla("*","entidad","","nombre",$conn);
          $select_entidad = "<select class='required' name='tipo_entidad' id='tipo_entidad' onchange='valores_entidad(this.value);'><option value=''>Seleccionar..</option>";
          if($entidad["numcampos"]>0)
          for($i=0; $i<$entidad["numcampos"]; $i++)
          { 
           if($entidad[$i]["identidad"]!=3 && $entidad[$i]["identidad"]!=5)
           //if($entidad[$i]["identidad"]==1) 
            {$select_entidad.="<option value=".$entidad[$i]["identidad"];
             if($entidad[$i]["identidad"]==@$_REQUEST["tipo_entidad"])
                $select_entidad.=" selected ";
             $select_entidad.=">".ucfirst($entidad[$i]["nombre"])."</option>";
            } 
          }
          if(@$_REQUEST["tipo_entidad"])
            echo '<script>valores_entidad("'.$_REQUEST["tipo_entidad"].'");</script>';
          $select_entidad.="</select>";
          echo $select_entidad;
          ?>     
        </td>
    </tr>	 
    <tr>
        <td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">RESPONSABLE*</span></td>
        <td bgcolor="#F5F5F5"><span class="phpmaker">
          <div id="sub_entidad">
          </div></span> 
        </td>
    </tr>
    <tr>
        <td class="encabezado" title="Plazo para que la tarea se ejecute antes de reportarse como vencida"><span class="phpmaker" style="color: #FFFFFF;">PLAZO DE EJECUCION</span></td>
        <td bgcolor="#F5F5F5"><span class="phpmaker">
            <input type="text" name="x_plazo" id="x_plazo" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_plazo) ?>"> 
            <select name="x_tipo_plazo" id="x_tipo_plazo">
              <!--option name="minuto" value="minute">Minuto(s)</option-->
              <option value="hour" selected>Hora(s)</option>
              <option value="day">D&iacute;a(s)</option>
              <option value="month">Mes(es)</option>
              <option value="year">A&ntilde;o(s)</option>
            </select>   
            </span>
        </td>
    </tr>
    <!--tr>
        <td class="encabezado" title="M&oacute;dulo para mostrar en el flujo para ejecutar la acci&oacute;n"><span class="phpmaker" style="color: #FFFFFF;">M&oacute;dulo para ejecutar la actividad</span></td>
        <td bgcolor="#F5F5F5">
            <input type="hidden" name="x_modulo" id="x_modulo" value="<?php echo htmlspecialchars(@$x_modulo) ?>">

            <link rel="STYLESHEET" type="text/css" href="../css/dhtmlXTree.css">

            <script type="text/javascript" src="../js/dhtmlXCommon.js"></script>

            <script type="text/javascript" src="../js/dhtmlXTree.js"></script>

            <br />

            Buscar:<br><input type="text" id="stext_3" width="200px" size="20">      

            <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value,1)">

            <img src="../botones/general/anterior.png" border="0px" alt="Anterior"></a>

            <a href="../javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value,0,1)">

            <img src="../botones/general/buscar.png" border="0px" alt="Buscar"></a>

            <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value)">

            <img src="../botones/general/siguiente.png" border="0px" alt="Siguiente"></a>  

            <br /><div id="esperando_serie">

            <img src="../imagenes/cargando.gif"></div>

            <div id="treeboxbox_tree3"></div>

            <script type="text/javascript">

              var browserType;

              if (document.layers) {browserType = "nn4"}

              if (document.all) {browserType = "ie"}

              if (window.navigator.userAgent.toLowerCase().match("gecko")) {

                 browserType= "gecko"

              }

              tree3=new dhtmlXTreeObject("treeboxbox_tree3","100%","100%",0);

              tree3.setImagePath("../imgs/");

              tree3.enableIEImageFix(true);

              //tree3.enableCheckBoxes(1);

              tree3.enableRadioButtons(true);

              tree3.setOnLoadingStart(cargando_serie);

              tree3.setOnLoadingEnd(fin_cargando_serie);

              tree3.loadXML("../test_serie.php?tabla=modulo&sin_padre=1");

              tree3.setOnCheckHandler(onNodeSelect_modulo);

              function onNodeSelect_modulo(nodeId){

                valor_destino=document.getElementById("x_modulo");

                if(tree3.isItemChecked(nodeId)){

                    if(valor_destino.value!=="")

                        tree3.setCheck(valor_destino.value,false);

                    if(nodeId.indexOf("_")!=-1)

                        nodeId=nodeId.substr(0,nodeId.indexOf("_"));

                    valor_destino.value=nodeId;

                }

                else{

                    valor_destino.value="";

                }

              } 

              function fin_cargando_serie() {

                if (browserType == "gecko" )

                   document.poppedLayer =

                       eval('document.getElementById("esperando_serie")');

                else if (browserType == "ie")

                   document.poppedLayer =

                      eval('document.getElementById("esperando_serie")');

                else

                   document.poppedLayer =

                      eval('document.layers["esperando_serie"]');

                document.poppedLayer.style.visibility = "hidden";

              }

        

              function cargando_serie() {

                if (browserType == "gecko" )

                   document.poppedLayer =

                       eval('document.getElementById("esperando_serie")');

                else if (browserType == "ie")

                   document.poppedLayer =

                      eval('document.getElementById("esperando_serie")');

                else

                   document.poppedLayer =

                       eval('document.layers["esperando_serie"]');

                document.poppedLayer.style.visibility = "visible";

              } 

                    

            </script>    

        </td>

    </tr-->    

</table>

<input type="button" name="Action" value="Adicionar" onclick="llenar_valor_llave();">

</form>

<?php



/*

<Clase>

<Nombre>LoadData

<Parametros>sKey-id del cargo a buscar;conn-objeto de conexion con la base de datos

<Responsabilidades>Verificar si un cargo existe o no en la bd

<Notas>

<Excepciones>

<Salida>

<Pre-condiciones>

<Post-condiciones>

*/

function LoadData($sKey,$conn){
global $x_idactividad_paso,$x_descripcion, $x_accion_idaccion, $x_paso_idpaso, $x_restrictivo, 
$x_estado ,$x_orden , $x_tipo, $x_tipo_entidad, $x_llave_entidad, $x_palzo, $x_tipo_plazo,$x_modulo,$x_llave_accion; 

$datos=busca_filtro_tabla("","actividad_paso","idactividad_paso=".$sKey,"",$conn);
if($datos["numcampos"]){
  $LoadData=true;
  $x_idactividad_paso = $datos[0]["idactividad_paso"];
  $x_descripcion = $datos[0]["descripcion"];
  $x_accion_idaccion = $datos[0]["accion_idaccion"];
  $x_paso_idpaso= $datos[0]["paso_idpaso"];
  $x_restrictivo = $datos[0]["restrictivo"];
  $x_estado= $datos[0]["estado"];
  $x_orden = $datos[0]["orden"];
  $x_tipo = $datos[0]["tipo"];
  $x_tipo_entidad = $datos[0]["entidad_identidad"];
  $x_llave_entidad = $datos[0]["llave_entidad"];
  $x_plazo = $datos[0]["plazo"];
  $x_tipo_plazo = $datos[0]["tipo_plazo"];
  $x_llave_accion = $datos[0]["x_llave_accion"];

  //$x_modulo =$datos[0]["modulo_idmodulo"]; 
}

else{
  $LoadData=false;
}
	return $LoadData;
}
?>
<?php

/*

<Clase>
<Nombre>AddData
<Parametros>$conn-objeto de conexion con la base de datos
<Responsabilidades>insertar los datos de un cargo nuevo en la base de datos
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function AddData($conn){
global $x_idactividad_paso,$x_descripcion, $x_accion_idaccion, $x_paso_idpaso, $x_restrictivo, 
$x_estado ,$x_orden , $x_tipo, $x_tipo_entidad, $x_llave_entidad, $x_plazo, $x_tipo_plazo, $x_modulo,$x_llave_accion; 

	// Field nombre
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_descripcion) : $x_descripcion; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["descripcion"] = $theValue;
	// Field paso
	$theValue = ($x_paso_idpaso != "") ? $x_paso_idpaso : "NULL";
	$fieldList["paso_idpaso"] = $theValue;
	// Field nombre
	$theValue = ($x_accion_idaccion!= "") ? $x_accion_idaccion : "NULL";
	$fieldList["accion_idaccion"] = $theValue;
	// Field llave accion
	$theValue = ($x_llave_accion != "") ? $x_llave_accion : "NULL";
	$fieldList["formato_idformato"] = $theValue;
	// Field nombre
	$theValue = ($x_restrictivo != "") ? $x_restrictivo : 1;
	$fieldList["restrictivo"] = $theValue;
	// Field nombre
	$theValue = ($x_estado != "") ? $x_estado : 1;
	$fieldList["estado"] = $theValue;	// Field nombre
	// Field nombre
	$theValue = ($x_orden!= "") ? $x_orden : 0;
	$fieldList["orden"] = $theValue;
	// Field nombre
	$theValue = ($x_tipo!= "") ? $x_tipo : 1;
	$fieldList["tipo"] = $theValue;
	// Field nombre
	$theValue = ($x_tipo_entidad!= "") ? $x_tipo_entidad : 1;
	$fieldList["entidad_identidad"] = $theValue;
	// Field nombre
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_llave_entidad) : $x_llave_entidad; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["llave_entidad"] = $theValue;
    // Field nombre
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($x_plazo) : $x_plazo; 
    $fieldList["plazo"] = $theValue;
    // Field nombre
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($x_tipo_plazo) : $x_tipo_plazo; 
    $theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
    $fieldList["tipo_plazo"] = $theValue;
    // Field nombre
    /*$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_modulo) : $x_modulo; 
    $theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
    $fieldList["modulo_idmodulo"] = $theValue;*/
	// insert into database
	$strsql = "INSERT INTO paso_actividad(";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";
	phpmkr_query($strsql, $conn) or die("Fall&oacute; la b&uacute;squeda" . phpmkr_error() . ' SQL:' . $strsql);
	$adicionar=busca_filtro_tabla("","accion","idaccion=".@$_REQUEST["x_accion_idaccion"]." AND nombre like 'adicionar'","",$conn);
	if($adicionar["numcampos"]>0 && @$_REQUEST["llave"]!=''){
		$idflujo=busca_filtro_tabla("","paso","idpaso=".$fieldList["paso_idpaso"],"",$conn);
		generar_campo($_REQUEST["llave"],$idflujo[0]["diagram_iddiagram"]);
	}
	return true;
}
function generar_campo($idformato,$idflujo){
	$buscar_campo=busca_filtro_tabla("","campos_formato A","formato_idformato=".$idformato." AND nombre='idflujo'","",$conn);
	
	if($buscar_campo["numcampos"]==0){
		$campo="INSERT INTO campos_formato(formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, acciones, predeterminado, etiqueta_html, orden) VALUES(".$idformato.",'idflujo', 'idflujo', 'VARCHAR', '255', 0, 'a,e,b', '".$idflujo."', 'hidden', 0)";
	}
	else{
		$campo="UPDATE campos_formato SET formato_idformato=".$idformato.", nombre='idflujo', etiqueta='idflujo', tipo_dato='VARCHAR', longitud='255', obligatoriedad='0', acciones='a,e,b', predeterminado='".$idflujo."', etiqueta_html='hidden' WHERE idcampos_formato=".$buscar_campo[0]["idcampos_formato"];
	}
	phpmkr_query($campo);
}
?>

