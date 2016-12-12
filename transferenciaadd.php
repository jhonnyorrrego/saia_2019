<?php
if(@$_REQUEST["iddoc"] || @$_REQUEST["key"]){
	if(!@$_REQUEST["iddoc"])$_REQUEST["iddoc"]=@$_REQUEST["key"];
	include_once("pantallas/documento/menu_principal_documento.php");
	menu_principal_documento($_REQUEST["iddoc"]);
}
include_once("db.php");
include_once("class_transferencia.php");
include_once("librerias_saia.php");
echo( librerias_notificaciones() );
$accion_flujo="";
if(@$_REQUEST["idpaso_actividad"] != ''){
	$accion_flujo = '&accion=1';
	$paso = busca_filtro_tabla("B.destino,A.documento_iddocumento","paso_documento A, paso_enlace B","idpaso_documento=".$_REQUEST["idpaso_documento"]." and paso_idpaso=origen","",$conn);

	$actividad = busca_filtro_tabla("","paso_actividad","estado=1 AND orden=0 and paso_idpaso=".$paso[0]["destino"],"",$conn);
	if(!strpos($actividad[0]["llave_entidad"],",")){
		if($actividad[0]["entidad_identidad"] == 1){
			include_once("formatos/librerias/funciones_generales.php");
			$formato = busca_filtro_tabla("","documento A, formato B","iddocumento=".$paso[0]["documento_iddocumento"]." and lower(plantilla)=lower(B.nombre)","",$conn);
			echo ($formato[0]["idformato"].','.$paso[0]["documento_iddocumento"].','.$actividad[0]["llave_entidad"].',3');
			transferencia_automatica($formato[0]["idformato"],$paso[0]["documento_iddocumento"],$actividad[0]["llave_entidad"],3);
			//alerta("El documento ya ha sido enviado a su destino");
			abrir_url("workflow/mapeo_diagrama.php?idpaso_documento=".$_REQUEST["idpaso_documento"],"centro");
		}
	}
	if($actividad[0]["entidad_identidad"] == 2){
		$dependencias = $actividad[0]["llave_entidad"];
		$accion_flujo .=  '&dependencias_flujo='.$actividad[0]["llave_entidad"];
	}
}
/*header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
*/
$ewCurSec = 0; // Initialise

// Initialize common variables
$x_dep = Null;
$x_idtransferencia = Null;
$x_archivo_idarchivo = Null;
$x_nombre = Null;
$x_funcionario_destino = Null;
$x_funcionario_destino1 = Null;
$x_funcionario_destino2 = Null;
$x_funcionario_destino3 = Null;
$x_dependencia_destino = Null;
$x_ejecutor_destino = Null;
$x_fecha = Null;
$x_respuesta = Null;
$x_entregado = Null;
$x_recibido = Null;
$x_notas = Null;
$x_transferencia_descripcion = Null;
$x_tipo = Null;
$x_tipo_destino= Null;
$x_transferir = Null;
$idruta = Null;
$x_serie= Null;
$x_copia= Null;
$x_ver_nota= Null;
$x_tipo_envio = Null;
include ("phpmkrfn.php");
// Get action
if(@$_POST["a_add"]=="carta")
  $sAction="mostrar_carta2.php";
else if(@$_POST["a_add"]=="memorando")
  $sAction="mostrar_memorando.php";
else if(@$_POST["a_add"]=="certificado")
  $sAction="mostrar_certificado.php";
else
  $sAction = @$_POST["a_add"];

if (($sAction == "") || (($sAction == NULL))) {
	$sKey = @$_GET["key"];
	$sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;
	if ($sKey <> "") {
		$sAction = "I"; // Copy record
	}
	else
	{
		$sAction = "I"; // Display blank record
	}

}
else
{ $x_transferir =@$_POST["x_transferir"];
  $x_dep = @$_POST["x_dep"];
	// Get fields from form
	$x_idtransferencia = @$_POST["x_idtransferencia"];
	$x_archivo_idarchivo = @$_POST["x_archivo_idarchivo"];
  $formato_documento=busca_filtro_tabla("","formato,documento","lower(plantilla)=lower(nombre) and iddocumento=".$x_archivo_idarchivo,"",$conn);
  $nombre_formato=$formato_documento[0]["nombre"];
	$x_nombre = @$_POST["x_nombre"];
		if(isset($_POST["x_serie"]))
   $x_serie = @$_POST["x_serie"];
  else
   $x_serie = Null;
	if(isset($_POST["x_funcionario_destino1"]) && $_POST["x_funcionario_destino1"]<>""){
	 $x_funcionario_destino = @$_POST["x_funcionario_destino1"];
	 $x_tipo_destino=1; //FUNCIONARIO
	}
	if(isset($_POST["x_funcionario_destino2"]) && $_POST["x_funcionario_destino2"]<>""){
	 $x_funcionario_destino = @$_POST["x_funcionario_destino2"];
	 $x_tipo_destino=1; //"funcionario";
  }
  if(isset($_POST["x_funcionario_destino3"]) && $_POST["x_funcionario_destino3"]<>""){
	 $x_funcionario_destino = @$_POST["x_funcionario_destino3"];
	 $x_tipo_destino=1; //"funcionario";
  }
	if(isset($_POST["x_dependencia_destino"]) && $_POST["x_dependencia_destino"]<>""){
	 $x_funcionario_destino = @$_POST["x_dependencia_destino"];
	 $x_tipo_destino=2;//"dependencia";
  }
	//$x_dependencia_destino_dep = @$_POST["x_dependencia_destino"];
	$x_funcionario_destino = @$_POST["x_funcionario_destino"];
	$x_tipo_destino=1;//"funcionario";
  $x_ejecutor_destino = @$_POST["x_ejecutor_destino"];
	$x_fecha = @$_POST["x_fecha"];
	$x_respuesta = @$_POST["x_respuesta"];
	$x_entregado = @$_POST["x_entregado"];
	$x_recibido = @$_POST["x_recibido"];
	$x_notas = @$_POST["x_notas"];
	$x_ver_nota = @$_POST["x_ver_nota"];
	$x_transferencia_descripcion = @$_POST["x_transferencia_descripcion"];
	$x_tipo = @$_POST["x_tipo"];
	$x_doc=@$_POST["arch"];
	$idruta=@$_POST["idruta"];
	$x_copia=@$_POST["x_copia"];
	if(@$_POST["x_tipo_envio"]!='')
   $x_tipo_envio = @$_POST["x_tipo_envio"];
  else
   $x_tipo_envio =array();

}
switch ($sAction)
{
	case "C": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registros no encontrados para la Llave = " . $sKey;
			redirecciona("go(-1)");
			exit();
		}
		break;
	case "A": // Add
		if (AddData($conn)) { // Add New Record
			$_SESSION["ewmsg"] = "Adici&oacute;n de nuevo Registro Exitoso";
      if(@$_REQUEST["idpaso_documento"]){
        abrir_url("workflow/mapeo_diagrama.php?idpaso_documento=".$_REQUEST["idpaso_documento"],"centro");
      }
     if($x_transferir == "si")
     { // redirecciona("transferenciaadd.php?doc=".$x_archivo_idarchivo."&dep=".$x_dep);
       redirecciona("ordenar.php?key=7077&accion=mostrar&mostrar_formato=1=$x_archivo_idarchivo");
		  	exit();
     }
     $busca_transferencia=busca_filtro_tabla("A.*","buzon_entrada A","A.archivo_idarchivo=".$x_archivo_idarchivo,"",$conn);
     if($busca_transferencia["numcampos"]){
      $digitalizadores = busca_filtro_tabla("nombre","cargo, funcionario, dependencia_cargo","idcargo=cargo_idcargo AND funcionario_idfuncionario=idfuncionario AND idfuncionario=".usuario_actual("idfuncionario")." AND (UPPER(nombre)='RADICADOR' OR UPPER(nombre)='DIGITALIZADOR')","",$conn);
        if(!isset($_POST["retorno"])&&$digitalizadores["numcampos"]>0)
          redirecciona("documentolist.php?cmd=resetall");
        else
          redirecciona("formatos/".$nombre_formato."/mostrar_".$nombre_formato.".php?iddoc=".$x_archivo_idarchivo."&idformato=".$formato_documento[0]['idformato']);
		  exit();
     }
     else {
      alerta("No se le asign� una transferencia al documento");
      //redirecciona("transferenciaadd.php?doc=".$x_archivo_idarchivo."&dep=".$x_dep);
      redirecciona("formatos/".$nombre_formato."/mostrar_".$nombre_formato.".php?iddoc=".$x_archivo_idarchivo."&idformato=".$formato_documento[0]['idformato']);
     }
		}
		break;
	case "P": // Add
		if (AddData($conn)) { // Add New Record
			$_SESSION["ewmsg"] = "Adicion de nuevo Registro Exitoso";
			exit();
		}
		break;

}

//include_once("formatos/librerias/estilo_formulario.php");
if(!@$_REQUEST["idpaso_documento"]){
  include ("header.php");
  $columnas=45;
}
else {
  $columnas=32;
  menu_pasos(0,@$_REQUEST["idpaso_documento"]);
}
?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator

//-->
</script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this)
{
  var list_funcionarios = tree2.getAllChecked();
  var funcionarios = list_funcionarios.split(",");
  var func ="";
  var copia="";
  var ruta="";
  var aux_ruta;

  if(typeof(tree_copia) != 'undefined'){
    var copias = tree_copia.getAllChecked();
    var func_copia = copias.split(",");
    for(i=0; i<func_copia.length; i++){
    	if(func_copia[i]!=""){
	      if(copia=="")
	        copia = func_copia[i];
	      else
	        copia += ","+func_copia[i];
      }
    }
  }
  for(i=0; i<funcionarios.length; i++){
  	if(funcionarios[i]!=""){
      aux_ruta =funcionarios[i].indexOf("%");
      if(aux_ruta != -1){
      	ruta=funcionarios[i].substring(aux_ruta+1);
        funcionarios[i]=funcionarios[i].substring(0,aux_ruta);
      }
      if(func=="")
        func = funcionarios[i];
      else
        func += ","+funcionarios[i];
     }
  }

  if(ruta!="")
      document.transferenciaadd.idruta.value=ruta;
  document.transferenciaadd.x_funcionario_destino.value=func;
  document.transferenciaadd.x_copia.value=copia;
   if(EW_this.x_funcionario_destino && EW_this.x_funcionario_destino.value == "")
           { //alert("Por favor ingresar un funcionario o dependencia destino para transferir el documento");
               notificacion_saia('<b>ATENCI&Oacute;N</b><br>Por favor ingresar un funcionario o dependencia destino para transferir el documento','warning','',4000);
		        return false;
		       }
  var list_serie = tree3.getAllChecked();
  var serie = list_serie.split(",");
  if(serie.length>1)
  {
    //alert("Se debe elegir solo una serie documental");
    notificacion_saia('<b>ATENCI&Oacute;N</b><br>Se debe elegir solo una serie documental','warning','',4000);
		return false;
  }
  else
    document.getElementById('x_serie').value=list_serie;

return true;
}

function no_palitos(evt)
  {
   evt = (evt) ? evt : event;
   var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
       ((evt.which) ? evt.which : 0));
   if (charCode == 124){
      return false;
   }
   return true;
  }
//-->
</script>
<script type="text/javascript" src="popcalendar.js"></script>
<?php

if(isset($_REQUEST['doc']))
  $x_archivo_idarchivo = $_REQUEST['doc'];
else if(isset($_REQUEST['key']))
  $x_archivo_idarchivo = $_REQUEST['key'];
if(isset($sKey))
 $documento = $sKey;
else
 $documento = $x_archivo_idarchivo;
$seleccionados="";
if(@$_REQUEST["seleccionado"]){
  $seleccionados=$_REQUEST["seleccionado"];
}
if(isset($_REQUEST["mostrar"]))
{
menu_ordenar($_REQUEST["key"]);
}
?>
<br>
<?php if(!@$_REQUEST["idpaso_documento"]){ ?>
<p><span class="internos">TRANSFERIR DOCUMENTOS&nbsp;&nbsp;&nbsp;&nbsp;
</span></p>
<?php }
?>
<form name="transferenciaadd" id="transferenciaadd" action="transferenciaadd.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC"  width="80%">
	<tr>

      <td style="width:20%" class="encabezado" title="Documento al cual le va a ser realizada la transferencia y cambiar su estado"><span class="phpmaker" style="color: #FFFFFF;">DOCUMENTO</span></td>
		<td style="width:60%" bgcolor="#F5F5F5"><span class="phpmaker">
<?php

global $sql;
$arch=busca_filtro_tabla("numero,serie,descripcion,fecha","documento A","A.iddocumento=".$x_archivo_idarchivo,"",$conn);

$x_serie = $arch[0]['serie'];
echo stripslashes($arch[0]['numero']."-".$arch[0]['descripcion']);
$fecha_doc= $arch[0]["fecha"];
// Set default value ?>
</span></td>
	</tr>
	<input type="hidden" name="x_archivo_idarchivo" value="<?php echo $x_archivo_idarchivo; ?>">
	<tr>
		<td class="encabezado" title="Es la fecha del sistema, en la que se est&aacute; realizando la operaci&oacute;n"><span class="phpmaker" style="color: #FFFFFF;">FECHA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!($x_fecha != NULL) || ($x_fecha == "")) { $x_fecha = date("Y-m-d H:i:s");} // Set default value ?>
<input type="hidden" name="x_fecha" id="x_fecha" value="<?php echo $x_fecha; ?>">
<input type="hidden" name="x_doc" id="x_doc" value="<?php echo $arch; ?>">
<?php echo($x_fecha);
if(isset($_POST['usu'])){
$tmp=$_POST['usu'];
}
else if(isset($_GET['usu'])){
$tmp=$_GET['usu'];
}
else $tmp=usuario_actual("funcionario_codigo");
if(isset($_GET['dep'])){
$dep=$_GET['dep'];
}
else $dep=1;
$x_entregado=$tmp;
$x_recibido=$tmp;
?>
<input type="hidden" name="x_dep" value="<?php echo $dep;?>">
<input type="hidden" name="x_respuesta" id="x_respuesta" value="<?php echo FormatDateTime(@$x_respuesta,5); ?>">
<input type="hidden" name="x_entregado" id="x_entregado" value="<?php echo htmlspecialchars(@$x_entregado); ?>">
<input type="hidden" name="x_recibido" id="x_recibido"  value="<?php echo htmlspecialchars(@$x_recibido); ?>">
<input type="hidden" name="x_funcionario_destino" id="x_funcionario_destino">
<input type="hidden" name="x_copia" id="x_copia" value="0">
<input type="hidden" name="idruta" id="idruta">
<input type="hidden" name="idpaso_documento" id="idpaso_documento" value="<?php echo($_REQUEST["idpaso_documento"]);?>">
<input type="hidden" name="retorno" id="retorno" value="<?php echo @$_GET["retorno"]; ?>">
</span>	<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
</td>
	</tr>
<?php if($x_serie==0) { ?>
	<tr>
        <td class="encabezado" title="Seleccione el tipo de documento de acuerdo a los tipos documentales de la entidad"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">CLASIFICACION DEL DOCUMENTO</span></font></td>
        <td  bgcolor="#F5F5F5">
        <input type='hidden' name='x_serie' id='x_serie'/>
        <meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
	<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
			<?php include_once("formatos/librerias/header_formato.php"); ?>
	<input type="hidden" name="serie" id="serie" obligatorio="obligatorio"  value="" >
    <br />
    <?php
			 if($seleccionados!=""){
			   echo("Seleccionados:<br />");
			   $lseleccionados=busca_filtro_tabla("","funcionario","funcionario_codigo=".$seleccionados,"",$conn);
         for($j=0;$j<$lseleccionados["numcampos"];$j++){
           echo($lseleccionados[$j]["nombres"]." ".$lseleccionados[$j]["apellidos"]."(".$lseleccionados[$j]["login"].")<br />");
         }
			 }
			 ?>
      Buscar:<br><input type="text" id="stext_3" width="200px" size="20">
      <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value,1)">
      <img src="botones/general/anterior.png" border="0px" alt="Anterior"></a>
      <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value,0,1)">
      <img src="botones/general/buscar.png" border="0px" alt="Buscar"></a>
      <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value)">
      <img src="botones/general/siguiente.png" border="0px" alt="Siguiente"></a>
    <br /><div id="esperando_serie">
    <img src="imagenes/cargando.gif"></div>
    <div id="treeboxbox_tree3"></div>
	<script type="text/javascript">
  <!--
      var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree3=new dhtmlXTreeObject("treeboxbox_tree3","100%","100%",0);
			tree3.setImagePath("imgs/");
			tree3.enableIEImageFix(true);
			tree3.enableCheckBoxes(1);
			tree3.enableRadioButtons(true);
			tree3.setOnLoadingStart(cargando_serie);
      tree3.setOnLoadingEnd(fin_cargando_serie);
			tree3.enableThreeStateCheckboxes(true);
			tree3.loadXML("test_serie_funcionario.php?seleccionado=<?php echo $x_serie; ?>");
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
	-->
	</script>
            </td>
      </tr>
<?php }
?>
<tr>
<td class="encabezado" title="Seleccione a quien va a enviar el documento. Puede seleccionar toda la empresa, toda una dependencia o los funcionarios destino"><span class="phpmaker" style="color: #FFFFFF;">DESTINO</span></td>
<td bgcolor="#F5F5F5"><link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
			<span class="phpmaker">

			      <br><input type="text" id="stext" width="200px" size="20" placeholder="Buscar">
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,1)">
      <img src="botones/general/anterior.png" border="0px" alt="Anterior"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,0,1)">
      <img src="botones/general/buscar.png" border="0px" alt="Buscar"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value)">
      <img src="botones/general/siguiente.png" border="0px" alt="Siguiente"></a><br />
<br />
         <div id="esperando_func">
    <img src="imagenes/cargando.gif"></div>
				<div id="treeboxbox_tree2"></div>
	<script type="text/javascript">
  <!--
  		var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","100%",0);
			tree2.setImagePath("imgs/");
			tree2.enableIEImageFix(true);
			tree2.enableCheckBoxes(1);
			tree2.enableRadioButtons(true);
			tree2.setOnLoadingStart(cargando_func);
      tree2.setOnLoadingEnd(fin_cargando_func);
			tree2.enableThreeStateCheckboxes(true);
      tree2.enableSmartXMLParsing(true);
			tree2.loadXML("test.php?key=<?php echo($x_archivo_idarchivo.@$accion_flujo);?>&sin_padre=1");
			function fin_cargando_func() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_func")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_func")');
        else
           document.poppedLayer =
              eval('document.layers["esperando_func"]');
        document.poppedLayer.style.display = "none";
      }

      function cargando_func() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_func")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_func")');
        else
           document.poppedLayer =
               eval('document.layers["esperando_func"]');
        document.poppedLayer.style.display = "";
      }
	-->
	</script>
	</td></tr>
  <tr>
<td class="encabezado" title="Selecciona un funcionarios, si desea hacer una copia del documento"><span class="phpmaker" style="color: #FFFFFF;">COPIA A </span></td>
	<td bgcolor="#F5F5F5"><span class="phpmaker">
			<br><input type="text" id="stext1" width="200px" size="20" placeholder="Buscar">
      <a href="javascript:void(0)" onclick="tree_copia.findItem(document.getElementById('stext1').value,1)">
      <img src="botones/general/anterior.png" border="0px" alt="Anterior"></a>
      <a href="javascript:void(0)" onclick="tree_copia.findItem(document.getElementById('stext1').value,0,1)">
      <img src="botones/general/buscar.png" border="0px" alt="Buscar"></a>
      <a href="javascript:void(0)" onclick="tree_copia.findItem(document.getElementById('stext1').value)">
      <img src="botones/general/siguiente.png" border="0px" alt="Siguiente"></a><br />
<br />
         <div id="esperando_tree_copia">
    <img src="imagenes/cargando.gif"></div>
				<div id="treeboxbox_tree_copia"></div>
	<script type="text/javascript">
  <!--
  		var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree_copia=new dhtmlXTreeObject("treeboxbox_tree_copia","100%","100%",0);
			tree_copia.setImagePath("imgs/");
			tree_copia.enableIEImageFix(true);
			tree_copia.enableCheckBoxes(1);
			tree_copia.setOnLoadingStart(cargando_tree_copia);
      tree_copia.setOnLoadingEnd(fin_cargando_tree_copia);
			tree_copia.enableThreeStateCheckboxes(true);
      tree_copia.enableSmartXMLParsing(true);
			tree_copia.loadXML("test.php?key=<?php echo($x_archivo_idarchivo);?>");
			function fin_cargando_tree_copia() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_tree_copia")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_tree_copia")');
        else
           document.poppedLayer =
              eval('document.layers["esperando_tree_copia"]');
        document.poppedLayer.style.display = "none";
      }

      function cargando_tree_copia() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_tree_copia")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_tree_copia")');
        else
           document.poppedLayer =
               eval('document.layers["esperando_tree_copia"]');
        document.poppedLayer.style.display = "";
      }
	-->
	</script>
	</td></tr>
      <?php
        $x_nombre="TRANSFERIDO";
      ?>
      <input type="hidden" name="x_ruta" value="<?php echo htmlspecialchars(@$x_ruta) ?>">
      <input type="hidden" name="x_imprime" value="<?php echo htmlspecialchars(@$x_imprime) ?>">
      <input type="hidden" name="x_nombre" value="<?php echo htmlspecialchars($x_nombre) ?>">
</span>
	<tr>
		<td class="encabezado" title="Espacio para escribir una nota en caso de que sea necesario hacer una aclaraci&oacute;n particular con la transferencia" ><span class="phpmaker" style="color: #FFFFFF;">OBSERVACIONES</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<textarea cols="<?php echo($columnas);?>" rows="4" id="x_notas" name="x_notas"><?php echo @$x_notas; ?></textarea>
</span></td>
	</tr>
		<!--tr>
		<td class="encabezado" title="Enviar documento por otro m&eacute;todo como mensajer&iacute;a instant&aacute;nea, correo electr&oacute;nico externo, correo electr&oacute;nico interno"><span class="phpmaker" style="color: #FFFFFF;">MEDIO DE NOTIFICACI&Oacute;N </span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
      <input type="checkbox" name="x_tipo_envio[]" id="x_tipo_envio" value="msg" >Mensajer&iacute;a Instant&aacute;nea<br />
      <input type="checkbox" name="x_tipo_envio[]" id="x_tipo_envio" value="e-interno">Correo Electr&oacute;nico Interno<br />
    </span>
    </td>
	</tr-->
	<tr>
		<td class="encabezado" title=""><span class="phpmaker" style="color: #FFFFFF;">OBSERVACIONES VISIBLES PARA TODOS?</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type=radio name="x_ver_nota" value="1" id="si" checked>SI<br />
<input type=radio name="x_ver_nota" value="0" id="no">NO
</span></td>
	</tr>
</table>
<p>
<?php
if(@$x_imprime<>1){
?>
<input type="hidden" name="a_add" value="A">
  <input type="button" class="btn btn-mini btn-danger" value="Cancelar" onclick="window.history.back(-1);">
<input type="submit" name="Action" class="btn btn-mini btn-primary"value="Continuar">
<?php }
else {
// La P es de Print
?>
<input type="hidden" name="a_add" value="P">
<input type="submit" name="Action" value="IMPRIMIR">
<?php }?>
</form>
<br /><br /><br /><br />
<?php
if(!@$_REQUEST["idpaso_documento"])
  include ("footer.php");
//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	global $_SESSION;
  global $x_idtransferencia,$x_archivo_idarchivo,$x_nombre,$x_funcionario_destino,$x_dependencia_destino;
	global $x_ejecutor_destino,$x_fecha,$x_respuesta,$x_entregado,$x_recibido,$x_notas,$x_transferencia_descripcion,$x_tipo;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT A.* FROM transferencia A";
	$sSql .= " WHERE A.idtransferencia = " . $sKeyWrk;
	$sGroupBy = "";
	$sHaving = "";
	$sOrderBy = "";
	if ($sGroupBy <> "") {
		$sSql .= " GROUP BY " . $sGroupBy;
	}
	if ($sHaving <> "") {
		$sSql .= " HAVING " . $sHaving;
	}
	if ($sOrderBy <> "") {
		$sSql .= " ORDER BY " . $sOrderBy;
	}
	$rs = phpmkr_query($sSql,$conn) or error("Fall  al Ejecutar la B�squeda" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$x_idtransferencia = $row["idtransferencia"];
		$x_archivo_idarchivo = $row["archivo_idarchivo"];
		$x_nombre = $row["nombre"];
		$x_funcionario_destino = $row["funcionario_destino"];
		$x_dependencia_destino = $row["dependencia_destino"];
		$x_ejecutor_destino = $row["ejecutor_destino"];
		$x_fecha = $row["fecha"];
		$x_respuesta = $row["respuesta"];
		$x_entregado = $row["entregado"];
		$x_recibido = $row["recibido"];
		$x_notas = $row["notas"];
		$x_ver_nota = $row["ver_notas"];
		$x_transferencia_descripcion = $row["transferencia_descripcion"];
		$x_tipo = $row["tipo"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
<?php

//-------------------------------------------------------------------------------
// Function AddData
// - Add Data
// - Variables used: field variables

function AddData($conn)
{
	global $_SESSION,$_POST,$_POST_FILES,$_ENV;
  global $x_idtransferencia,$x_archivo_idarchivo,$x_nombre,$x_funcionario_destino,$x_dependencia_destino,$x_tipo_destino,$idruta,$x_copia,$x_serie;
	global $x_ejecutor_destino,$x_fecha,$x_respuesta,$x_entregado,$x_recibido,$x_notas,$x_ver_nota,$x_transferencia_descripcion,$x_tipo,$x_tipo_envio;	// Add New Record

	$sSql = "SELECT * FROM buzon_entrada A";
	$sSql .= " WHERE 0 = 1";
	$sGroupBy = "";
	$sHaving = "";
	$sOrderBy = "";
	if ($sGroupBy <> "") {
		$sSql .= " GROUP BY " . $sGroupBy;
	}
	if ($sHaving <> "") {
		$sSql .= " HAVING " . $sHaving;
	}
	if ($sOrderBy <> "") {
		$sSql .= " ORDER BY " . $sOrderBy;
	}
  //validacion de la serie del documento, si es diferente de Null se debe modifcar el documento, colocandole la serie documental y la persona quien se lo asigno (Responsable).
  if($x_serie!=Null OR $x_serie!="")
  {
    $sql_up = "update documento set serie=$x_serie, responsable='".usuario_actual("idfuncionario")."' where iddocumento=$x_archivo_idarchivo";
   phpmkr_query($sql_up, $conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sql_up);
  }
	// Field archivo_idarchivo
	$theValue = ($x_archivo_idarchivo != "") ? intval($x_archivo_idarchivo) : "NULL";
	$fieldList["archivo_idarchivo"] = $theValue;

	// Field nombre
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre;
	$theValue = ($theValue != "") ?  $theValue  : "NULL";
	$fieldList["nombre"] = $theValue;

	// Field funcionario_destino
	//echo $x_funcionario_destino; die();
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_funcionario_destino) : $x_funcionario_destino;
	$theValue = ($theValue != "") ?  $theValue : "NULL";
	//$fieldList["funcionario_destino"] = $theValue;
	//para sacar la lista de los funcionarios destinos en caso de que hayan dependencias
  $destinos = array();
  $destinos_aux=split(",",$x_funcionario_destino);
  $dep=array();
	$num_destino = count($destinos_aux);
	for($i=0; $i<$num_destino; $i++)
	{
   $filtro = strpos($destinos_aux[$i],'_');
   if($filtro)
      $destinos_aux[$i]=substr($destinos_aux[$i],0,$filtro);
   $dependencia = strpos($destinos_aux[$i],'#');
   if($dependencia)
      {$dep = buscar_funcionarios(substr($destinos_aux[$i],0,strlen($destinos_aux[$i])-1), $dep);
      }
   else
      array_push($destinos,$destinos_aux[$i]);
   $destinos=array_merge($destinos,$dep);
  }

  $destinos = array_unique($destinos);
  //para sacar la lista de los funcionarios con copias en caso de que hayan dependencias
  if($x_copia!="")
  {
  $destinos_copias = array();
  $dep_copias=array();
  $destinos_aux=explode(",",$x_copia);
	$num_destino = count($destinos_aux);
	for($i=0; $i<$num_destino; $i++)
	{
   $filtro = strpos($destinos_aux[$i],'_');
   if($filtro)
      $destinos_aux[$i]=substr($destinos_aux[$i],0,$filtro);
   $dependencia = strpos($destinos_aux[$i],'#');
   if($dependencia)
      $dep_copias = buscar_funcionarios(substr($destinos_aux[$i],0,strlen($destinos_aux[$i])-1), $dep_copias);
   else
        array_push($destinos_copias,$destinos_aux[$i]);
   $destinos_copias=array_merge($destinos_copias,$dep_copias);
  }
  $destinos_copias = array_unique($destinos_copias);
 }
	// Field fecha
	$theValue = ($x_fecha != "") ?  ConvertDateToMysqlFormat(date("Y-m-d H:i:s")) : NULL;
	$fieldList["fecha"] = $theValue;

	// Field respuesta
	$theValue = ($x_respuesta != "") ?  ConvertDateToMysqlFormat($x_respuesta)  : "NULL";
	$fieldList["respuesta"] = $theValue;

	// Field entregado
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_entregado) : $x_entregado;
	$theValue = ($theValue != "") ?$theValue  : "NULL";
	$fieldList["entregado"] = $theValue;

	// Field recibido
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_recibido) : $x_recibido;
	$theValue = ($theValue != "") ?  $theValue : "NULL";
	$fieldList["recibido"] = $theValue;

	// Field notas
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_notas) : $x_notas;
	$theValue = ($theValue != "") ? $theValue  : NULL;
	$fieldList["notas"] = $theValue;

	//ver notas
  $fieldList["ver_notas"] = $x_ver_nota;

	// Field transferencia_descripcion
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_transferencia_descripcion) : $x_transferencia_descripcion;
	$theValue = ($theValue != "") ? $theValue  : "NULL";
	$fieldList["transferencia_descripcion"] = $theValue;

	// Field tipo
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_tipo) : $x_tipo;
	$theValue = ($theValue != "") ?  $theValue : "NULL";
	$fieldList["tipo"] = $theValue;

	// Field idruta
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($idruta) : $idruta;
	$theValue = ($theValue != "") ?  $theValue : NULL;
	$fieldList["ruta_idruta"] = $theValue;

	$documento = busca_filtro_tabla("","documento","iddocumento=".$fieldList["archivo_idarchivo"],"",$conn);
	$temp="";
	if($documento["numcampos"])
	{ $temp=$documento[0]["serie"];
	  $mensaje = "Acaba de Recibir el Documento: ".$documento[0]["numero"]." Descripcion: ".$documento[0]["descripcion"];
	}
	$datos_adicionales=array();
	$funcionario=array();
	$datos_adicionales["notas"]="'".$fieldList["notas"]."'";

	$fieldList["tipo_destino"]=$x_tipo_destino;
  $fieldList["serie"]=$temp;


  if(in_array("msg",$x_tipo_envio))// Si eligieron mensajeria se verifica si por BD esta permitida
   {
     $mensajeria=busca_filtro_tabla("valor","configuracion","nombre='mensajeria' and valor='1'","",$conn);

     if(!$mensajeria["numcampos"]>0) // Elimino el valor .. por que esta inhabilitada en la configuracion
      {
       $ar_tmp=array("msg");
       $x_tipo_envio = array_diff ($x_tipo_envio,$ar_tmp);
      }
  }

$x_tipo_envio=implode(",",$x_tipo_envio);

  $max_destinos=busca_filtro_tabla("valor","configuracion","nombre='max_transferencias'","",$conn);
  if(!$max_destinos["numcampos"])
    {$max_destinos[0]["valor"]=10;
    }
  if(count($destinos)>$max_destinos[0]["valor"])
    {
    	$permiso=busca_filtro_tabla("","funcionario_validacion a","funcionario_idfuncionario=".usuario_actual('idfuncionario')." and tipo='1'","",$conn);
		if(!$permiso["numcampos"]&&usuario_actual('login')!='cerok'){
			alerta("Usted no puede enviar el documento a mas de ".$max_destinos[0]["valor"]." persona(s)");
	    	redirecciona("transferenciaadd.php?doc=".$fieldList["archivo_idarchivo"]."&no_menu=1");
	    	die();
		}
    echo '
    <form name="confirmar" action="confirmar_transferencia.php" method="post">
    <input type="hidden" name="destinos" value="'.implode(",",$destinos).'">
    <input type="hidden" name="iddoc" value="'.$fieldList["archivo_idarchivo"].'">
    <input type="hidden" name="notas" value="'.$fieldList["notas"].'">
    <input type="hidden" name="x_ver_nota" value="'.$fieldList["ver_notas"].'">
    <input type="hidden" name="tipo_envio" value="'.$x_tipo_envio.'">';
    if(isset($x_copia) && trim($x_copia)<>"")
      echo '<input type="hidden" name="copias" value="'.implode(",",$destinos_copias).'">';
    echo '
    <input type="hidden" name="mensaje" value="'.htmlspecialchars($mensaje).'">
    <input type="submit" disable value="Cargando...">
    </form>
    <script>confirmar.submit();</script>';
    die();
    }
  if(transferir_archivo_prueba($fieldList,$destinos,$datos_adicionales,"documento_view.php?key=".$fieldList["archivo_idarchivo"]))
   {
     $funcionario[]=$x_funcionario_destino;
   }
   if($destinos_copias)
  { $fieldList["nombre"]="COPIA";
      if(transferir_archivo_prueba($fieldList,$destinos_copias,$datos_adicionales,"documento_view.php?key=".$fieldList["archivo_idarchivo"]))
    {$funcionario_copia[]=$x_copia;
    }
  }
  $funcionarios_mensaje=array_merge((array)$funcionario,(array)$funcionario_copia,(array)$destinos);
  $funcionarios_mensaje=array_unique($funcionarios_mensaje);

// Mensajeria

 //enviar_mensaje("origen",$funcionarios_mensaje,$mensaje,$x_tipo_envio);
 return true;
}
?>
