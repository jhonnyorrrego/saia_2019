<?php 
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
  header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
  header("Cache-Control: post-check=0, pre-check=0", false); 
  header("Pragma: no-cache"); // HTTP/1.0
include_once ("db.php");
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
<script type="text/javascript" src="anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script>
<?php include_once("anexosdigitales/funciones_archivo.php"); ?>
<script type="text/javascript" src="anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="anexosdigitales/highslide-4.0.10/highslide/highslide.css" />    
<script type='text/javascript'>
    hs.graphicsDir = 'anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
    // ESTA VARIABLE PERMITE HALLAR LA RUTA HACIA anexos_permiso_add
    // POR DEFECTO SE IGUALA INTERNAMENTE A '../../anexosdigitales/anexos_permiso_add.php
    var ruta_escape= '';  
</script>

<script language="javascript" type="text/javascript">

////////////////////////////////////////////Autocompletar con jquery /////////////////////////////////////
$().ready(function() {

	function formatItem(row) {
	  llenar_ejecutor("0");
	  $("#ejecutor").val("");
	  $("#x_cargoejecutor").val("");
		return row[1] + " (<strong>Documento: " + row[2] + "</strong>)";
	}
	function formatResult(row) {
		return row[1].replace(/(<.+?>)/gi, '');
	}
  function llenar_ejecutor(idejecutor)
  {$.ajax({
        url: "llenar_ejecutor.php?idejecutor="+idejecutor,
        success: function(datos){
          vector=datos.split("||");
          if(vector.length==1&&vector[0]==0)
            {$("#x_cargoejecutor").val("");
             $("#x_telefonoejecutor").val("");
             $("#x_empresaejecutor").val("");
             $("#x_direccionejecutor").val("");
             $("#x_emailejecutor").val("");
            }
          else
            {$("#x_cargoejecutor").val(vector[0]);
             $("#x_telefonoejecutor").val(vector[1]);
             $("#x_empresaejecutor").val(vector[2]);
             $("#x_direccionejecutor").val(vector[3]);
             $("#x_emailejecutor").val(vector[4]);
            }   
        }
   });
  }
  
	$("#auto1").autocomplete('formatos/librerias/seleccionar_ejecutor.php?tipo=nombre', {
		width: 500,
		max:10,
    scroll: true,
		scrollHeight: 150,
		matchContains: true,
    minChars:4,
    formatItem: formatItem,
    formatResult: function(row) {
		return row[4];
		}
	});
	$("#auto1").result(function(event, data, formatted) {
		if (data){
      $("#auto2").val(data[2]);	
      llenar_ejecutor(data[0]);
		}
		else
		 llenar_ejecutor("0");
	});
	$("#auto2").keyup(function (event){
   if(event.keyCode<96 || event.keyCode>105)
     {actual=$("#auto2").val();
      if(isNaN(actual)||actual.indexOf(".")>0)
      {if(isNaN(parseInt(actual)))
          $("#auto2").val("");
         else
          $("#auto2").val(parseInt(actual));
        } 
     }
  });
	
	$("#auto2").autocomplete('formatos/librerias/seleccionar_ejecutor.php?tipo=identificacion', {
		width: 500,
		max:20,
    scroll: true,
		scrollHeight: 150,
		matchContains: true,
    minChars:4,
    formatItem: formatItem,
    formatResult: function(row) {
		return row[2];
		}
	});
	$("#auto2").result(function(event, data, formatted) {
		if (data){
      $("#auto1").val(data[4]);	
      llenar_ejecutor(data[0]);
		}
		else
		 llenar_ejecutor("0");
	});
	$("#Action").click(function(event, data, formatted) {
		lleno=EW_checkMyForm(window.document.documentoedit);
		if(lleno!==false)
		  {$.post(
        "formatos/librerias/actualizar_ejecutor.php",{
        nombre: $("#auto1").val(),
        identificacion: $("#auto2").val(),
        cargo:$("#x_cargoejecutor").val(),
        empresa:$("#x_empresaejecutor").val(),
        direccion:$("#x_direccionejecutor").val(),
        telefono:$("#x_telefonoejecutor").val(),
        campos:'nombre,identificacion,cargo,empresa,direccion,telefono,email',
        email:$("#x_emailejecutor").val()},
        function(datos,exito){
          valores=datos.split('|');
          $("#ejecutor").val(valores[0]);
          $("#documentoedit").submit();
        }
      );
      }
	});
});
////////////////////////////////////////////////////////////////////////////////////////////////////////////
</script>
<?php
 
// Initialize common variables
$x_iddocumento = Null;
$x_numero = Null;
$x_serie = Null;
$x_fecha = Null;
$x_ejecutor = Null;
$x_ejecutor2 = Null;
$x_ejecutor3 = Null;
$x_descripcion = Null;
$x_dias = Null;
$x_paginas = Null;
$x_destino = Null;
$x_funcionario_idfuncionario=Null;
$x_dependencia_iddependencia=Null;
$x_municipio_idmunicipio=Null;
$x_departamento=Null;
$x_nombre1 = Null;
$x_nombre2 = Null;
$x_apellido1 = Null;
$x_apellido2 = Null;
$x_tipoejecutor =Null;
$x_dependencia_destino=Null;
$x_escaneo= Null;
$x_oficio= Null;
$x_fecha_oficio = Null;
$x_anexo = Null;
$x_descripcion_anexo = Null;
$x_archivos = Null;
$x_archivoalmacenados=Null;
//////////Nuevos para el tratamiento del ejecutor////////////////////
$x_nitejecutor2 = Null;
$x_cargoejecutor = Null;
$x_ciudadejecutor = Null;
$x_direccionejecutor = Null;
$x_telefonoejecutor = Null;
$x_empresaejecutor = Null;
$x_emailejecutor = Null;
///////////////////////////////////////////////////////////////////
$x_funcionario_destino = Null;
$defaultpais =1;
$defaultm=Null;
$defaultd=Null;
///////////////////////////////////////////////////////////////////
$x_funcionario_destino = Null;
$x_flujo = Null;
?>
<?php include ("phpmkrfn.php"); 
$sKey = @$_GET["key"];
if (($sKey == "") || ($sKey == NULL)) { $sKey = @$_POST["key"]; }
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_edit"];
//Codigo para editar un documento antes de enviar la transferencia
 if(isset($_GET["accion"]) && $_GET["accion"]=="editar")
  $sAction="editar";
//Fin de codigo

if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
} elseif($sAction<>"editar") {  
	// Get fields from form    	
	$x_numero = @$_POST["x_numero"];
	$x_serie = @$_POST["x_serie"];	
	$x_fecha = @$_POST["x_fecha"];
  $x_fecha_oficio = @$_POST["x_fecha_oficio"];
	$x_oficio = @$_POST["x_oficio"];
	$x_tipoejecutor=@$_POST["x_tipoejecutor"];
	$x_archivos=@$_POST["archivos"];
	$x_dias = @$_POST["x_dias"];
	
	/////////////////Nuevos para el ejecutor////////////////////////
	$x_nitejecutor2 = @$_POST["x_nitejecutor2"];
  $x_cargoejecutor = @$_POST["x_cargoejecutor"];
  $x_ciudadejecutor = @$_POST["x_ciudadejecutor"];
  $x_direccionejecutor = @$_POST["x_direccionejecutor"];
  $x_telefonoejecutor = @$_POST["x_telefonoejecutor"];
  $x_empresaejecutor = @$_POST["x_empresaejecutor"];
    $x_emailejecutor = @$_POST["x_emailejecutor"];

	////////////////////////////////////////////////////////////
  $x_municipio_idmunicipio = @$_POST["municipio"];
 
	if(isset($_POST["x_funcionario_idfuncionario"])&&$_POST["x_funcionario_idfuncionario"]<>"")
	 $x_ejecutor = @$_POST["x_funcionario_idfuncionario"];
  else if(isset($_POST["x_ejecutor2"])&&$_POST["x_ejecutor2"]<>""){
    $x_ejecutor=$_POST["ejecutor"];
	}
  $x_descripcion = @$_POST["x_descripcion"];  
	$x_paginas = @$_POST["x_paginas"];
	
	$x_dependencia_iddependencia = @$_POST["x_dependencia_iddependencia"];
	$x_dependencia_iddependencia = split("#",$x_dependencia_iddependencia); 
	$x_escaneo=@$_POST["x_escaneo"];
	$x_anexo=@$_POST["x_anexo"]; 
  $x_descripcion_anexo=@$_POST["x_descripcion_anexo"];
  $x_funcionario_destino = @$_POST["x_funcionario_destino"];
	$x_flujo = @$_POST["x_flujo"];
}

if (($sKey == "") || (($sKey == NULL))) {
	$_SESSION["ewmsg"] = " NO SE ENCUENTRAN REGISTROS POR= " . $sKey;
	header("Location: documentolist.php?cmd=reset");
	exit();
}

if(isset($_REQUEST["estado"])&&($_REQUEST["estado"]=="completo"))     
 {//die($sAction);
  if (EditData($sKey,$conn))

  if($x_escaneo==1)
    redirecciona("paginaadd.php?radicacion=".$sKey."&key=".$sKey);    
  else  
   redirecciona("transferenciaadd.php?doc=$sKey");

   
 }

switch ($sAction)
{
  case"editar":
    LoadData($sKey,$conn);
   break; 
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = " NO SE ENCUENTRAN REGISTROS POR= " . $sKey;			
			redirecciona("documentolist.php?cmd=reset");
		}
		break;
	case "U": // Update
		if ($doc = EditData($sKey,$conn)) { // Update Record based on key
			$_SESSION["ewmsg"] = "EDICION EXITOSA PARA EL REGISTRO = " . $sKey;
      if($sKey)
			 $docu=$sKey;
			else $docu=$sKey;
			if(isset($_GET["enlace"])&& $_GET["enlace"])
			   $location=$_GET["enlace"]."?doc=$docu";			
			else
         $location="documentoview.php?key=$docu";
      if($x_escaneo==1)
			{redirecciona("paginaadd.php?key=$sKey&x_enlace=view");			
			}
			redirecciona($location);
		}
		break;
	case "T":
   if(EditData($sKey,$conn)){
      $location="transferenciaadd.php?doc=$sKey";         
			if($x_escaneo==1){
			 $location="paginaadd.php?radicacion=".$sKey."&key=".$sKey;
			}
			redirecciona($location);
   }	
}
?>
<?php include ("header.php") ?>
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
  if(document.getElementById('auto3')=="" && document.getElementById('serie').value!='')
   document.getElementById('x_serie').value=document.getElementById('serie').value;  
  /*if(EW_this.estado.value =="completo" && EW_this.x_funcionario_destino.value=="")
  { 
    alert("Por favor ingresar un funcionario o dependencia destino para transferir el documento.");
		return false;
	} */

if (EW_this.x_numero && !EW_hasValue(EW_this.x_numero, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_numero, "TEXT", "Por favor ingrese el campo requerido - NUMERO DE RADICACION."))
		return false;
}

if (EW_this.x_ejecutor2 && !EW_hasValue(EW_this.x_ejecutor2, "TEXT" )) {	   
   if (!EW_onError(EW_this, EW_this.x_ejecutor2, "TEXT", "Por favor ingrese el campo requerido - NOMBRE DEL REMITENTE DEL DOCUMENTO")) 		       
    return false; }value="NULL"
	
if (EW_this.x_descripcion && !EW_hasValue(EW_this.x_descripcion, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_descripcion, "TEXT", "Por favor ingrese el campo requerido - ASUNTO DEL DOCUMENTO"))
		return false;
}

if (EW_this.x_nitejecutor2 && !EW_checkinteger(EW_this.x_nitejecutor2.value)) {
	if (!EW_onError(EW_this, EW_this.x_nitejecutor2, "TEXT", "Entero Incorrecto - Nit del Remitente"))
		return false; 
}

//Para que el oficio no sea mayor
var dif;
var fecha1 = EW_this.x_fecha_oficio.value;
var fecha= new Date();
var mes = eval(fecha1.substring(5,7)+"-1");
inicio = new Date(fecha1.substring(0,4),mes,fecha1.substring(8,10));
dif = Math.floor((fecha.getTime() - inicio.getTime())/(1000*60*60*24));
if(dif<0)
{ alert("La fecha del oficio entrante no puede ser mayor que la fecha actual. Por favor verifique.");
  return false;
}
return true;
}

-->
</script>
<script type="text/javascript" src="popcalendar.js"></script>
<script type="text/javascript" src="js/dynamicoptionlist.js"></script>
<body onLoad="initDynamicOptionLists()">
<p><span class="internos"><img class="imagen_internos" src="botones/comentarios/editar_documento.png" border="0">&nbsp;&nbsp;EDITAR DOCUMENTOS<br><br>
</span></p>
<form name="documentoedit" id="documentoedit" action="documentoedit.php" method="post" enctype="multipart/form-data" >
<p>
<?php
if(isset($_GET["estado"])&& $_GET["estado"]=="INICIADO")
{
 echo "<input type='hidden' name='estado' value='completo'>";
} 
?>
<input type="hidden" name="a_edit" value="U">
<input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''>
<input type="hidden" name="x_funcionario_destino" id="x_funcionario_destino">
<?php
 if($sAction == "editar")
   { 
   ?> <input type="hidden" name="a_edit" value="T">
   <?php
   } 
?>
<input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
        <table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
          <tr> 
            <td width="188" class="encabezado" title="Fecha en que se radica o genera el documento."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">FECHA DE RADICACI&Oacute;N</span></font></td>
            <td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span > 
              <?php if (!(@$x_fecha != NULL) || (@$x_fecha == "")) { @$x_fecha = date('Y/m/d H:i:s');} // Set default value ?>
              <?php echo $x_fecha; ?> 
              <input type="hidden" name="x_fecha" value="<?php echo FormatDateTime(@$x_fecha,0); ?>">
              &nbsp; </span></font></td>
            <td class="encabezado" title="N&uacutemero de radicado asignado al documento."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">N&Uacute;MERO 
              DE RADICADO</span></font></td>
            <td bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $x_numero;?></font></td>
          </tr>
          <tr> 
            <td class="encabezado" title="Ciudad al cual pertenece la persona natural o jur&iacute;dica que env&iacute;a el documento."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF">CIUDAD ORIGEN </span></font></td>
            <td colspan="4" bgcolor="#F5F5F5"> <font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"> 
              <?php              
         $pais1 = busca_filtro_tabla("*","pais","","nombre",$conn);
         echo "Pais: ";echo "<select name='pais' id='pais'><option>Seleccionar  ...</option>";
         for($i=0; $i<$pais1["numcampos"]; $i++)
         {if($pais1[$i]["idpais"]==$defaultpais)
           echo "<option value='".$pais1[$i]["idpais"]."' selected>".$pais1[$i]["nombre"]."</option>";
          else
           echo "<option value='".$pais1[$i]["idpais"]."'>".$pais1[$i]["nombre"]."</option>";  
         }
         echo "</select>&nbsp;&nbsp;"; ?>
     <script>
     var c_departamento = new DynamicOptionList();
     c_departamento.addDependentFields('pais','departamento','municipio');
     </script>
     <?php echo "Departamento: "; echo genera_campo_listados(); ?>
      <select name="departamento" id="departamento" >                            
       <option value="">Seleccionar...
       </option>                            
       <script type="text/javascript"> c_departamento.printOptions("departamento");</script>                            
      </select>
      <?php echo "Ciudad: ";?>
      <select name="municipio" id="municipio">                            
       <option value="">Seleccionar...
       </option>                            
       <script type="text/javascript"> c_departamento.printOptions("municipio");</script>                            
      </select>&nbsp;&nbsp;<a href="municipioadd.php">OTRO</a>               
            </td>
          </tr>
         <tr> 
        <td width="188" class="encabezado" title="Fecha en la cual el oficio fue emitido y firmado."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">FECHA DE OFICIO ENTRANTE</span></font></td>
        <td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span > 
          <input type="text" name="x_fecha_oficio" id="x_fecha_oficio" value="<?php echo($x_fecha_oficio);?>" >&nbsp;<input id="image" name="image" type="image" onclick="popUpCalendar(this, this.form.x_fecha_oficio,'yyyy/mm/dd');return false;" src="images/ew_calendar.gif" alt="Seleccione una Fecha" /></span></font></td>
        <td class="encabezado" title="N&uacute;mero externo del oficio, si lo tiene."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">N&Uacute;MERO 
          DE OFICIO ENTRANTE</span></font></td>
        <td bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <input type="text" name="x_oficio" id="x_oficio" value="<?php echo($x_oficio);?>">
        </font></td>
      </tr>     
         <!--tr><td rowspan="2" class="encabezado" title="Seleccione el tipo de documento de acuerdo a los tipos documentales de la Organizaci&oacute;n."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">TIPO DE DOCUMENTO</span></font></td>
            <td colspan="4" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
  <link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
  <script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>	
<div id="esperando_serie"><img src="imagenes/cargando.gif"></div>                          
	  <div id="treeboxbox_serie" height="100%"></div>
    <input type="hidden" name="serie" id="serie" obligatorio="obligatorio"  value="<?php echo $x_serie; ?>">
  <?php echo '  
  <script type="text/javascript">
        <!--
            var browserType;
            if (document.layers) {browserType = "nn4"}
            if (document.all) {browserType = "ie"}
            if (window.navigator.userAgent.toLowerCase().match("gecko")) {
               browserType= "gecko"
            }
      			tree_serie=new dhtmlXTreeObject("treeboxbox_serie","100%","100%",0);
      			tree_serie.setImagePath("imgs/");
      			tree_serie.enableIEImageFix(true);tree_serie.enableCheckBoxes(1);
            tree_serie.enableRadioButtons(true);
            tree_serie.enableThreeStateCheckboxes(1);tree_serie.setOnLoadingStart(cargando_serie);
            tree_serie.setOnLoadingEnd(fin_cargando_serie);tree_serie.enableSmartXMLParsing(true);
            tree_serie.setXMLAutoLoading("test_serie.php?tabla=serie&estado=1&seleccionado='.$x_serie.'");
            tree_serie.loadXML("test_serie.php?tabla=serie&estado=1&seleccionado='. $x_serie.'");
            tree_serie.setOnCheckHandler(onNodeSelect_serie);
            
            function onNodeSelect_serie(nodeId)
            {valor_serie=document.getElementById("serie");
             pos=nodeId.indexOf("_");
             if(pos!=-1)
              nodeId=nodeId.substr(0,pos);
             cerrar=valor_serie.value;
             tree_serie.setCheck(cerrar,false);
             valor_serie.value=nodeId;
            }
            function fin_cargando_serie() {
              if (browserType == "gecko" )
                 document.poppedLayer =
                     eval(\'document.getElementById("esperando_serie")\');
              else if (browserType == "ie")
                 document.poppedLayer =
                    eval(\'document.getElementById("esperando_serie")\');
              else
                 document.poppedLayer =
                    eval(\'document.layers["esperando_serie"]\');
              document.poppedLayer.style.visibility = "hidden";
            }

            function cargando_serie() {
              if (browserType == "gecko" )
                 document.poppedLayer =
                     eval(\'document.getElementById("esperando_serie")\');
              else if (browserType == "ie")
                 document.poppedLayer =
                    eval(\'document.getElementById("esperando_serie")\');
              else
                 document.poppedLayer =
                     eval(\'document.layers["esperando_serie"]\');
              document.poppedLayer.style.visibility = "visible";
            }
      	--></script>';
      	?>
         <!--/td>
          </tr></tr><tr>
         <td colspan="4" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <BR>Selecci&oacute;n r&aacute;pida de la clasificaci&oacute;n del documento:<BR><div id="lista3" onmouseout="v=1;" onmouseover="v=0;">
           <div id="div_nomserie"><input type="text" size=53 name="x_nom_serie" id="auto3" autocomplete=off onkeyup="if(Teclados(event,'3') == 1){ autocompletar('3',auto3.value);Action.disabled=true;}" onkeydown = "ParaelTab(event,'3')" onfocus="document.getElementById('comple3').style.visibility='visible';" onblur="document.getElementById('Action').disabled=false;"></div>
           </div><div id="comple3" name="comple3" style="position:absolute" onmouseout="document.getElementById('comple3').style.display='none';Action.disabled=false;"></div>

               <input type="hidden" name="x_serie" id="x_serie">
               <BR><BR></td></tr> 
           <?php  
         $sql_up="select tipo_radicado from documento where iddocumento=".$sKey;
         $consulta=phpmkr_query($sql_up, $conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sql_up);
         $respuesta=phpmkr_fetch_array($consulta);
         if($respuesta[0]==1)
         {
         ?>      
      <!--Esto es para los ejecutores, en la parte de energia quedan diferentes-->
      <tr> 
              <td class="encabezado" title="Nombre de la persona natural o jur&iacute;dica (empresa) que env&iacute;a el documento."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF">PERSONA
          NATURAL/JUR&Iacute;DICA *</span></font></td>
        <td colspan="2" bgcolor="#F5F5F5"> <font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"> 
          <?php if (!($x_dependencia_destino != NULL) || ($x_dependencia_destino == "")) { $x_dependencia_destino = 0;} // Set default value ?>  
          <input type="hidden" name="ejecutor" id="ejecutor" value="<?php echo $x_ejecutor;?>">
          <input type="text" size=53 name="x_ejecutor2" value="<?php echo(ejecutor()); ?>" id="auto1" >
        </td> 
        <td class="encabezado" title="Nit o n&uacute;mero de identificaci&oacute;n del remitente."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF">NIT PERSONA  
          NATURAL/JUR&Iacute;DICA</span></font></td>
        <td bgcolor="#F5F5F5"> <font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"> 
          <?php if (!($x_dependencia_destino != NULL) || ($x_dependencia_destino == "")) { $x_dependencia_destino = 0;} // Set default value 
		?>
          
          <input type="text" name="x_nitejecutor2" id="auto2" value="<?php echo $x_nitejecutor2;?>" >
        </td>       
      </tr>
        <tr>
        <td class="encabezado" title="Cargo u ocupaci&oacute;n del remitente."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">CARGO REMITENTE</span></font></td>
        <td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <div id="div_eje_cargo"><input type="text" name="x_cargoejecutor" id="x_cargoejecutor" size=53 value="<?php echo $x_cargoejecutor;?>"></div>
        </font></td>               
        <td class="encabezado" title="Tel&eacute;fono del remitente."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">TEL&Eacute;FONO EJECUTOR</span></font></td>
        <td bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <div id="div_eje_telefono"><input type="text" name="x_telefonoejecutor" id="x_telefonoejecutor" value="<?php echo $x_telefonoejecutor;?>"></div>
        </font></td>        
        </tr>
            <tr>
      <td class="encabezado" title="Organizaci&oacute;n a la que pertenece el remitente."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF">EMPRESA REMITENTE
          </span></font></td>
          <td bgcolor="#F5F5F5" colspan=4><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <div id="div_eje_empresa"><input type="text" name="x_empresaejecutor" id="x_empresaejecutor" value="<?php echo $x_empresaejecutor;?>" size=53></div>
        </font></td>        
        </tr>
        <tr>
        <td class="encabezado" title="Direcci&oacute;n del remitente."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">DIRECCI&Oacute;N REMITENTE</span></font></td>
     <td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <div id="div_eje_direccion"><input type="text" name="x_direccionejecutor" id="x_direccionejecutor" size=53 value="<?php echo $x_direccionejecutor;?>"></div>
        </font></td>        
        <td class="encabezado" title="Correo electr&oacute;nico o email del remitente."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">EMAIL REMITENTE</span></font></td>
        <td bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <div id="div_eje_email"><input type="text" name="x_emailejecutor" id="x_emailejecutor" size=53 value="<?php echo $x_emailejecutor;?>"></div>
        </font></td> 
        
        </tr>
      <!----------------------------------------------------------------------------------------------------------------------->
        <?php
          }
          ?>
          <tr> 
            <td height="62" class="encabezado" title="Breve resumen del contenido del documento."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF;">DESCRIPCI&Oacute;N 
              O ASUNTO *</span></font></td>
            <td colspan="4" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span > 
              <textarea cols="53" rows="7" id="x_descripcion" name="x_descripcion"><?php echo @$x_descripcion; ?></textarea>
              </span></font></td>
          </tr>    
		    <?php
        if (($x_serie != NULL) && ($x_serie != "")&&($x_serie!=0))       
            {
        ?>
        <tr> 
        <td height="62" class="encabezado" title="D&iacute;as de entrega del documento."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF;">TIEMPO DE RESPUESTA (D&Iacute;AS)</span></font></td>
        <td colspan="4" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span >              
        <select id="dias" name="x_dias"><option value=""></option>
        <?php
        $dias="";
        for($i=0; $i<10; $i++)
         {if($i+1==$x_dias)
            $dias .= "<option value='".($i+1)."' selected>".($i+1)."</option>";
          else
            $dias .= "<option value='".($i+1)."'>".($i+1)."</option>";  
         }
        echo $dias;         
        ?>
        </select>
        </span> 
    </td></tr>  
            <?php
            }
            ?>
		    <tr> 
        <td height="62" class="encabezado" title="Tipo de anexos con los que viene documento."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF;">ANEXOS F&Iacute;SICOS</span></font></td>
        <td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span > 
         <select name="x_anexo"><option value=''>Seleccionar...</option>
<?php
  $lis_anexos = array("CD-ROM","DISKETE","DVD","DOCUMENTO","FAX","REVISTA O LIBRO","VIDEO","OTROS ANEXOS...");  
  for($i=0; $i<count($lis_anexos); $i++) 	  
	{
	 if($lis_anexos[$i]==$x_anexo)
	   $anexo_list .= "<option value=\"". $lis_anexos[$i]."\" SELECTED>".$lis_anexos[$i]."</option>";
   else $anexo_list .= "<option value=\"". $lis_anexos[$i]."\">".$lis_anexos[$i]."</option>";		
	}
  echo $anexo_list;	
//}
         ?> 
            </select></td></span>
           <td class="encabezado" title="Descripci&oacute;n de los anexos del documento, especificar la cantidad y el estado en que se encuentran los anexos."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">DESCRIPCI&Oacute;N DE ANEXOS F&Iacute;SICOS</span></font></td>
          <td bgcolor="#F5F5F5"><span class="phpmaker">
          <textarea cols="53" rows="4" id="x_descripcion_anexo" name="x_descripcion_anexo"><?php echo @$x_descripcion_anexo; ?></textarea>
          </span></font></td>          
      </tr>
      <tr> 
         <td class="encabezado" width="20%" title="Anexos digitales">ANEXOS DIGITALES</td>
         <td class="celda_transparente" colspan="6" bgcolor="#F5F5F5"><input type="file" name="anexos[]" class="multi"accept="<?php echo $extensiones;?>"></td>
         
      </tr>
      <!--tr>
      <td class="encabezado" title="Seleccione a quien va a enviar el documento. Puede seleccionar toda la empresa, toda una dependencia o los funcionarios destino"><span class="phpmaker" style="color: #FFFFFF;">DESTINO*</span>
      </td>
      <td bgcolor="#F5F5F5" colspan="4"><link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
        <script type="text/javascript" src="js/dhtmlXCommon.js"></script>
      	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
        <span class="phpmaker">
    		  Buscar:<br><input type="text" id="stext" width="200px" size="20">      
          <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,1)">
          <img src="botones/general/anterior.png" border="0px" alt="Anterior"></a>
          <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,0,1)">
          <img src="botones/general/buscar.png" border="0px" alt="Buscar"></a>
          <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value)">
          <img src="botones/general/siguiente.png" border="0px" alt="Siguiente"></a><br />
          <br />
        </span>
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
    			tree2.setOnLoadingStart(cargando_func);
          tree2.setOnLoadingEnd(fin_cargando_func);
    			tree2.enableThreeStateCheckboxes(true);
          tree2.enableSmartXMLParsing(true);
    			tree2.loadXML("test.php?key=<?php echo($x_iddocumento);?>");
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
        <!--/script>
      </td>
    </tr-->
    <tr> 
        <td height="65" class="encabezado" title="Flujo al que pertenece el documento."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF;">FLUJO O CIRCUITO</span></font></td>
        <td colspan="4" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span > 
         <select name="x_flujo"><option value=''>Seleccionar...</option>
         <?php    
           $flujos="";
           $lista_flujos=busca_filtro_tabla("","diagram","public=1 AND size>0","",$con);
          for($i=0; $i<$lista_flujos["numcampos"]; $i++){
            $flujos .= "<option value=\"". $lista_flujos[$i]["id"]."\">".$lista_flujos[$i]["title"]."</option>";        
          }
          echo $flujos; 
        //}
         ?> 
          </select></td>
      </tr>
       <tr> 
        <td class="encabezado" title="Utilizar el esc&aacute;ner para digitalizar el documento que se est&aacute; radicando."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">ESCANEAR 
          FOLIOS DEL DOCUMENTO</span></font></td>
        <td bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span > 
          SI 
          <input type="radio" name="x_escaneo" value=1 checked >
          NO 
          <input type="radio" name="x_escaneo" value=0>
          </span></font></td> 
            <td colspan="3" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span > 
              <input type="button" name="Action" id="Action" value="CONTINUAR" class="buttonSubmit">
              </span></font></td>
          </tr>        
        </table>
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	global $_SESSION;
	global $x_iddocumento;
	global $x_numero;
	global $x_serie;
	global $x_fecha;
	global $x_ejecutor;
	global $x_descripcion;
	global $x_municipio_idmunicipio;
	global $x_departamento;
	global $x_paginas,$x_oficio,$x_fecha_oficio,$x_anexo;
	global $anexo;
	global $x_dias;
	global $x_descripcion_anexo;
	global $x_nitejecutor2;
    global $x_cargoejecutor;
    global $x_ciudadejecutor;
    global $x_direccionejecutor;
    global $x_telefonoejecutor;
    global $x_empresaejecutor;
    global $x_archivoalmacenados; 
    global $x_emailejecutor;
    global $defaultd,$defaultm,$defaultpais,$x_flujo;
    global $x_funcionario_destino;
     
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT A.*,".fecha_db_obtener("A.fecha","Y-m-d H:i:s")." as fecha, ".fecha_db_obtener("A.fecha_oficio",'Y-m-d')." as fecha_oficio FROM documento A";
	$sSql .= " WHERE iddocumento = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or error("PROBLEMAS AL EJECUTAR LA BUSQUEDA" . phpmkr_error() . ' SQL:' . $sSql);
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;
		//$row = phpmkr_fetch_array($rs);
//print_r($row);
		// Get the field contents	
		if($row["plantilla"]!="" && !$row["numero"]){
      $formato=busca_filtro_tabla("","formato","nombre LIKE '".$row["plantilla"]."'","",$conn);
      if($formato["numcampos"]){
        redirecciona("formatos/".$formato[0]["nombre"]."/".$formato[0]["ruta_editar"]."?iddoc=".$sKeyWrk);
      }
    }
    else if($row["plantilla"]!="" && $row["numero"]){
      alerta("El documento no puede ser editado porque ya se encuentra aprobado.");
      volver(1);
    }
    if($row["tipo_radicado"]==2 && $row["plantilla"]=="")
      redirecciona("documentoeditsal.php?key=$sKeyWrk");
		$x_iddocumento = $row["iddocumento"];
		$x_numero = $row["numero"];
		$x_serie = $row["serie"];
		$x_fecha = $row["fecha"];
		$x_ejecutor = $row["ejecutor"];
		$x_descripcion = stripslashes($row["descripcion"]);
		$x_paginas = $row["paginas"];
		$x_municipio_idmunicipio = $row["municipio_idmunicipio"];
		$x_oficio = $row["oficio"];
		$x_fecha_oficio = $row["fecha_oficio"];
		$x_dias = $row["dias"];
    $x_anexo=$row["anexo"];
    $x_descripcion_anexo = stripslashes($row["descripcion_anexo"]);
    $datos_ejecutor = busca_filtro_tabla("A.*,identificacion","datos_ejecutor A,ejecutor","idejecutor=A.ejecutor_idejecutor and A.iddatos_ejecutor=".$row["ejecutor"],"",$conn);
    //print_r($datos_ejecutor);
    if($datos_ejecutor["numcampos"]>0)
    {
      $x_nitejecutor2 = $datos_ejecutor[0]["identificacion"];
      $x_cargoejecutor = $datos_ejecutor[0]["cargo"];
      $x_ciudadejecutor = $datos_ejecutor[0]["ciudad"];
      $x_direccionejecutor = $datos_ejecutor[0]["direccion"];
      $x_telefonoejecutor = $datos_ejecutor[0]["telefono"];
      $x_empresaejecutor = $datos_ejecutor[0]["empresa"];
      $x_emailejecutor = $datos_ejecutor[0]["email"];
    } 
    // Listo los archivos anexos ... 
    $arch_anexos = busca_filtro_tabla("etiqueta,ruta","anexos a","a.documento_iddocumento='$sKeyWrk'","etiqueta",$conn);   
     if($n=$arch_anexos["numcampos"])
     {  
     	for($i=0;$i<$n;$i++)
     	{
     		if($arch_anexos[$i]["etiqueta"])
     		 $x_archivoalmacenados.=$arch_anexos[$i]["etiqueta"];
     		else 
     		 $x_archivoalmacenados.=$arch_anexos[$i]["ruta"];
     		  
     	}
     }
  }
  phpmkr_free_result($rs);
  
if($x_municipio_idmunicipio)
{ $defaultm=$x_municipio_idmunicipio;
  $dep = busca_filtro_tabla("idpais,iddepartamento","pais,departamento,municipio","idmunicipio=$x_municipio_idmunicipio and iddepartamento=departamento_iddepartamento and idpais=pais_idpais","",$conn);
  $defaultd=$dep[0]["iddepartamento"];
  $defaultpais = $dep[0]["idpais"];  
}
else
{
$ciudad_empresa = busca_filtro_tabla("valor","configuracion","nombre='ciudad' or nombre='departamento'","nombre",$conn);
$defaultm=$ciudad_empresa[0]["valor"];
$defaultd=$ciudad_empresa[1]["valor"];
}
	$dato_flujo=busca_filtro_tabla("","paso_documento A,paso B","A.paso_idpaso=B.idpaso AND documento_iddocumento=".$row["iddocumento"],"",$conn);
    if($dato_flujo["numcampos"]){
        $x_flujo=$dato_flujo[0]["diagram_iddiagram"];
    }
    else $x_flujo= Null;
    	
	return $LoadData;
}
?>
<?php

//-------------------------------------------------------------------------------
// Function EditData
// - Edit Data based on Key Value sKey
// - Variables used: field variables

function municipio()
{
global $x_municipio_idmunicipio;
global $conn;
//echo $x_municipio;
$_municipio="";
$filtro="idmunicipio=".$x_municipio_idmunicipio;
//echo $filtro;
$id_municipio=busca_filtro_tabla('nombre','municipio',$filtro,'',$conn);
if($id_municipio["numcampos"]>0)
 $_municipio=$id_municipio[0]["nombre"];
//echo $_municipio;
return($_municipio);
}

function ejecutor()
{
global $conn;
global $x_ejecutor;
$_ejecutor="";
$filtro="idejecutor>0 and idejecutor=ejecutor_idejecutor and iddatos_ejecutor=".$x_ejecutor;
$id_ejecutor=busca_filtro_tabla('nombre','ejecutor,datos_ejecutor',$filtro,'',$conn);
//print_r($id_ejecutor);
if($id_ejecutor["numcampos"]>0)
 $_ejecutor=$id_ejecutor[0]["nombre"];
return($_ejecutor);
}

function EditData($sKey,$conn)
{  
	global $_POST;
	global $x_dependencia_iddependencia;
	global $x_serie;	
	global $x_ejecutor;
	global $x_descripcion;
	global $x_municipio_idmunicipio;
	global $x_oficio;
  global $x_fecha_oficio;
  global $x_anexo;
	global $x_descripcion_anexo;
  global $x_archivos;
  global $x_dias;
  global $x_funcionario_destino,$x_flujo;
	// Open record

	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM documento";
	$sSql .= " WHERE iddocumento = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or error("PROBLEMAS AL EJECUTAR LA B SQUEDA" . phpmkr_error() . ' SQL:' . $sSql);
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$EditData = false; // Update Failed
	}else{
 
	// insert into database	
	$fieldList=array();
  $destinos=array();
  if(isset($x_dependencia_iddependencia)){
    for($i=0;$i<count($x_dependencia_iddependencia)-1;$i++){
      $destinos[$i]["valor"]=$x_dependencia_iddependencia[$i];
      $destinos[$i]["tipo"]="dependencia";
    }   
  }   
	// Campo serie	
	if($x_serie != "") 
	 $fieldList["serie"] = $x_serie;

	// Campo fecha Oficio
	$theValue = ($x_fecha_oficio != "") ?  ConvertDateToMysqlFormat($x_fecha_oficio)  :  NULL;
	if($theValue<>"")
	 $fieldList["fecha_oficio"] = fecha_db_almacenar($theValue);
	 

  //Campo Numero de Oficio
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_oficio) : $x_oficio; 
	$theValue = ($theValue != "") ? $theValue:NULL;
	$fieldList["oficio"] = "'".$theValue."'";
	
	//Campo Anexo

	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_anexo) : $x_anexo; 
	$theValue = ($theValue != "") ? $theValue:NULL;
	$fieldList["anexo"] = "'".str_replace("'","",$theValue)."'";

 // Campo descripcion anexo
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_descripcion_anexo) : $x_descripcion_anexo; 
	$theValue = ($theValue != "") ? $theValue: NULL;
	$fieldList["descripcion_anexo"] = "'".str_replace("'","",$theValue)."'";
	
  //Campo Ejecutor 
	   $fieldList["ejecutor"] = $x_ejecutor;
  
  // Campo descripcion
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_descripcion) : $x_descripcion; 
	$theValue = ($theValue != "") ? $theValue:"NULL";
	$fieldList["descripcion"] = "'".str_replace("'","",$theValue)."'";

	// Campo Municipio
	$theValue = ($x_municipio_idmunicipio != "") ? intval($x_municipio_idmunicipio) : "NULL";
	$fieldList["municipio_idmunicipio"] = $theValue;
	// Campo Dias
	$theValue = (@$x_dias != "") ? intval(@$x_dias) : "NULL";
	$fieldList["dias"] = $theValue;
 
  //busco el tipo de radicado del documento
   $sql_up = "select contador.nombre,estado from contador,documento where idcontador=tipo_radicado and iddocumento=".$sKey;
   $consulta=phpmkr_query($sql_up, $conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sql_up);
   $respuesta=phpmkr_fetch_array($consulta);
   $fieldList["estado"] = $respuesta["estado"];
  	// update  	  	
  //print_r($fieldList);
   
  
  include_once("anexosdigitales/funciones_archivo.php");
  if(isset($_REQUEST["permisos_anexos"]))
   $permisos=$_REQUEST["permisos_anexos"];
  else 
   $permisos=NULL;
  
    
  cargar_archivo($sKey,$permisos); // Sube los anexos digitales

 //  ANEXOS FORMA ANTERIOR if(ingresar_documento($sKey,$respuesta["nombre"],$fieldList,$destinos,$x_archivos))
 //print_r($fieldList); die(); 
 $x_archivos=NULL; // Procesamiento anterior de los anexos ..  
  if(ingresar_documento($sKey,$respuesta["nombre"],$fieldList,$destinos,$x_archivos,$x_flujo))
		$EditData = true; // Update Successful
  else $EditData= false;	
  }
	return $EditData;
}
/*
function ad_nombre($cad,$tipo)
{
global $conn;
	$value=strtoupper($cad);
	$rs=phpmkr_query("SELECT * FROM nombre A WHERE A.valor ='".$value."' AND A.tipo='$tipo'" ,$conn)or error("NO SE ENCONTRO NOMBRE");;
		$campo = phpmkr_fetch_array($rs);
	  if ($campo) {      
       return($campo[0]);
      }
      else phpmkr_query("INSERT INTO nombres(valor,tipo) VALUE('".$value."','".$tipo."')",$conn)or error("NO SE INSERTO NOMBRE");
      return(phpmkr_insert_id());
}

function ad_ejecutor($value,$tipo,$nombre)
{
  global $conn;
  global $x_nitejecutor2;
  global $x_cargoejecutor;
  global $x_ciudadejecutor;
  global $x_telefonoejecutor; 
  global $x_empresaejecutor;
  global $x_direccionejecutor;
  global $x_emailejecutor;
  global $x_municipio_idmunicipio;     
  
  $x_nitejecutor2 = ($x_nitejecutor2 != "") ? $x_nitejecutor2  :  "";  
  
  $condicion=($x_nitejecutor2 != "") ?  "identificacion='".$x_nitejecutor2."'"  :  '(identificacion is NULL or identificacion="")';
     
  $campo = busca_filtro_tabla("idejecutor","ejecutor,datos_ejecutor","ejecutor_idejecutor=idejecutor and iddatos_ejecutor=$value and nombre like '".($nombre)."' and $condicion","",$conn);

  if($campo["numcampos"]>0)
  {
   $repetido = busca_filtro_tabla("iddatos_ejecutor","ejecutor,datos_ejecutor","idejecutor=ejecutor_idejecutor and iddatos_ejecutor=$value and cargo='".(($x_cargoejecutor))."' and direccion='".(($x_direccionejecutor))."' and telefono='".(($x_telefonoejecutor))."' and empresa='".(($x_empresaejecutor))."' and email='".(($x_emailejecutor))."'","",$conn);
  // print_r($repetido);
  if($repetido["numcampos"]>0)
     return  ($value);
  else   
   {$datos_viejos = busca_filtro_tabla("","ejecutor,datos_ejecutor","idejecutor=ejecutor_idejecutor and iddatos_ejecutor=$value","",$conn);

    if($datos_viejos[0]["titulo"]<>'')
         $titulo=$datos_viejos[0]["titulo"];
    else
       $titulo="Se&ntilde;or"; 
    
    if($datos_viejos[0]["ciudad"]<>'')
       $ciudad=$datos_viejos[0]["ciudad"];
    else
       $ciudad="";
       
    phpmkr_query("INSERT INTO datos_ejecutor(ejecutor_idejecutor,telefono,fecha,cargo,empresa,direccion,email,ciudad,titulo) VALUES(".$campo[0]["idejecutor"].",'".$x_telefonoejecutor."',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",'".$x_cargoejecutor."','$x_empresaejecutor','$x_direccionejecutor','$x_emailejecutor','$ciudad','$titulo')",$conn) or error("NO SE INSERTO EJECUTOR");         

   return(phpmkr_insert_id());
   }
  }
  else 
  {   
    phpmkr_query("INSERT INTO ejecutor(nombre,identificacion,fecha_ingreso) VALUES('".($nombre)."','".$x_nitejecutor2."',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').")",$conn) or error("NO SE INSERTO EJECUTOR");
    $idejecutor=phpmkr_insert_id();
    phpmkr_query("INSERT INTO datos_ejecutor(ejecutor_idejecutor,telefono,fecha,cargo,direccion,empresa,email) VALUES(".$idejecutor.",'".$x_telefonoejecutor."',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",'".$x_cargoejecutor."','$x_direccionejecutor','$x_empresaejecutor','$x_emailejecutor')",$conn) or error("NO SE INSERTO EJECUTOR"); 
     return(phpmkr_insert_id());    
     } 

 return false;
}

*/
function genera_campo_listados()
{
global $conn;
global $x_municipio_idmunicipio;
global $defaultd,$defaultm,$defaultpais;
$pais = busca_filtro_tabla("*","pais","","nombre",$conn);
  $texto="<script>";
  for($i=0;$i<$pais["numcampos"];$i++)
      {$dep=busca_filtro_tabla("*","departamento","pais_idpais=".$pais[$i]["idpais"],"nombre",$conn);      
       for($j=0;$j<$dep["numcampos"];$j++)
          {
           $texto.=  'c_departamento.forValue("'.$pais[$i]["idpais"].'").addOptionsTextValue("'.codifica_encabezado(html_entity_decode($dep[$j]["nombre"])).'","'.$dep[$j]["iddepartamento"].'");';           
           if($dep[$j]["iddepartamento"]==$defaultd)
             $texto.="c_departamento.forValue(".$pais[$i][0].").setDefaultOptions('".$dep[$j]["iddepartamento"]."');"; 
           $mun = busca_filtro_tabla("*","municipio","departamento_iddepartamento=".$dep[$j]["iddepartamento"], limpiar_cadena_sql('nombre')." asc",$conn);         
           for($k=0; $k<$mun["numcampos"]; $k++)
            { $texto.=  'c_departamento.forValue("'.$pais[$i]["idpais"].'").forValue("'.$dep[$j]["iddepartamento"].'").addOptionsTextValue("'.codifica_encabezado(html_entity_decode($mun[$k]["nombre"])).'","'.$mun[$k]["idmunicipio"].'");';
              if($mun[$k]["idmunicipio"]==$defaultm)
                  $texto.="c_departamento.forValue(".$pais[$i][0].").forValue('".$dep[$j]["iddepartamento"]."').setDefaultOptions(".$mun[$k]["idmunicipio"].");";
            }       
          }
      }
  $texto.="</script>";
return($texto);
}  

?>
