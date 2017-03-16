<?php 
include_once("db.php");
include_once("class.funcionarios.php");
include_once("formatos/librerias/header_formato.php");
  /*header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
  header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
  header("Cache-Control: post-check=0, pre-check=0", false); 
  header("Pragma: no-cache"); // HTTP/1.0*/
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
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
		lleno=EW_checkMyForm(window.document.documentoeditsal);
		if(lleno!==false)
		  {$.ajax({
        type:'POST',
        url:'formatos/librerias/actualizar_ejecutor.php',
        data:'nombre='+$("#auto1").val()+
        '&identificacion='+$("#auto2").val()+
        '&cargo='+$("#x_cargoejecutor").val()+
        '&empresa='+$("#x_empresaejecutor").val()+
        '&direccion='+$("#x_direccionejecutor").val()+
        '&telefono='+$("#x_telefonoejecutor").val()+
        '&email='+$("#x_emailejecutor").val()+
        '&campos=nombre,identificacion,cargo,empresa,direccion,telefono,email',
        success: function(datos,exito){
          valores=datos.split('|');
          $("#ejecutor").val(valores[0]);
          $("#documentoeditsal").submit();
        }
      });
      }
	});
});
////////////////////////////////////////////////////////////////////////////////////////////////////////////
</script>
<?php    
include_once("phpmkrfn.php");

// Initialize common variables
$x_iddocumento = Null;
$x_numero = Null;
$x_serie = Null;
$x_fecha = Null;
$x_ejecutor = Null;
$x_ejecutor2 = Null;
$x_ejecutor3 = Null;
$x_descripcion = Null;
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
$x_tipo_despacho= Null;
$x_mensajero = Null;
$x_plantilla= Null;
?>
<?php
$sKey = @$_GET["key"];
//echo($sKey);
if (($sKey == "") || ($sKey == NULL)) { $sKey = @$_POST["key"]; }
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_edit"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
} else {
	// Get fields from form
	$x_numero = @$_POST["x_numero"];
	$x_serie = @$_POST["serie"];
	$x_fecha = @$_POST["x_fecha"];	
		/////////////////Nuevos para el ejecutor////////////////////////
  	$x_nitejecutor2 = @$_POST["x_nitejecutor2"];
    $x_cargoejecutor = @$_POST["x_cargoejecutor"];
    $x_ciudadejecutor = @$_POST["x_ciudadejecutor"];
    $x_direccionejecutor = @$_POST["x_direccionejecutor"];
    $x_telefonoejecutor = @$_POST["x_telefonoejecutor"];
  	$x_empresaejecutor = @$_POST["x_empresaejecutor"];
    $x_emailejecutor = @$_POST["x_emailejecutor"]; 
    ////////////////////////////////////////////////////////////
  if(isset($_POST["x_funcionario_idfuncionario"])&&$_POST["x_funcionario_idfuncionario"]<>"")
	 $x_ejecutor = @$_POST["x_funcionario_idfuncionario"];
  else if(isset($_POST["x_ejecutor2"])&&$_POST["x_ejecutor2"]<>"")
	{
	 if(!$x_tipoejecutor){
	   $x_tipoejecutor=3;
	 }   	
	 $nombre=htmlspecialchars_decode(html_entity_decode((trim($_POST["x_ejecutor2"]))));
   //$value=$_POST["x_ejecutor2"];
   $value = $_POST["ejecutor"];
	 $x_ejecutor=ad_ejecutor($value,$x_tipoejecutor,$nombre);
	}
	else if(isset($_POST["x_ejecutor3"])&&$_POST["x_ejecutor3"]<>"")
	 $x_ejecutor = @$_POST["x_ejecutor3"];
	else if(isset($_POST["x_nombre1"])||$_POST["x_nombre1"]<>"") 
    {
    $value=strtolower(trim($_POST["x_nombre1"]));
	  $x_ejecutor=ad_ejecutor($value,1,"");
    }	
  $x_descripcion = @$_POST["x_descripcion"];
	$x_paginas = @$_POST["x_paginas"];
	
	$x_dependencia_iddependencia = @$_POST["x_dependencia_iddependencia"];
	$x_dependencia_iddependencia = split("#",$x_dependencia_iddependencia);
	
  $x_municipio_idmunicipio = @$_POST["municipio"];	
  if($x_municipio_idmunicipio==NULL)
	   $x_municipio_idmunicipio=658;
	$x_escaneo=@$_POST["x_escaneo"];
	$x_tipo_despacho = @$_POST["x_tipo_despacho"];
  $x_mensajero = @$_POST["x_mensajero"];
  $x_anexo = @$_POST["x_anexo"];
  $x_descripcion_anexo = @$_POST["x_descripcion_anexo"];
}
if (($sKey == "") || (($sKey == NULL))) {
	//ob_end_clean();
	$_SESSION["ewmsg"] = " NO SE ENCUENTRAN REGISTROS POR= " . $sKey;
	redirecciona("documentolistsal.php");
}
if($sAction<>'U')
  LoadData($sKey,$conn);
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = " NO SE ENCUENTRAN REGISTROS POR= " . $sKey;
			redirecciona("documentolistsal.php");
		}
		break;
	case "U": // Update     	   
		if (EditData($sKey,$conn)) { // Update Record based on key		  
			$_SESSION["ewmsg"] = "EDICION EXITOSA PARA EL REGISTRO = " . $sKey;
			if($sKey)
			 $docu=$sKey;
			else $docu=$sKey;
			redirecciona("documentolistsal.php");
			if($x_escaneo==1)
			{
			$location="paginaadd.php?radicacion=".$docu."&key=".$docu;
			}
			redirecciona($location);
		}
		break;
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

function EW_checkMyForm(EW_this) {
if(EW_this.estado.value == 'INICIADO')
 { 
  var list_funcionario = tree3.getAllChecked();  
  var funcionario = list_funcionario.split(",");
  if(funcionario.length!=1)
  {
    alert("Se debe elegir solo una dependencia responsable");
		return false;  
  }
  if(list_funcionario=="")
  {
    alert("Se debe seleccionar una dependencia responsable");
		return false;  
  }          
  document.documentoeditsal.x_dependencia_iddependencia.value=list_funcionario;
 }
if (EW_this.x_ejecutor2 && !EW_hasValue(EW_this.x_ejecutor2, "TEXT" )) {
     if ((EW_this.ejecutor && !EW_hasValue(EW_this.ejecutor, "TEXT" ))) {	
	       alert("POR FAVOR INGRESE EL CAMPO REQUERIDO - DESTINATARIO O NOMBRE Y APELLIDO A QUIEN ENVIA EL DOCUMENTO");
    return false; }
}		
if (EW_this.x_descripcion && !EW_hasValue(EW_this.x_descripcion, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_descripcion, "TEXT", "POR FAVOR INGRESE EL CAMPO REQUERIDO - ASUNTO DEL DOCUMENTO"))
		return false;
}		

return true;
}

-->
</script>
<script type="text/javascript" src="popcalendar.js"></script>
<script type="text/javascript" src="js/dynamicoptionlist.js"></script>
<body onLoad="initDynamicOptionLists()">
<!--p><span class="phpmaker">EDITAR ENTIDAD/TABLA: DOCUMENTOS<br><br><a href="documentolistsal.php">DOCUMENTOS RADICADOS DE SALIDA</a></span></p-->
<form name="documentoeditsal" id="documentoeditsal" action="documentoeditsal.php" method="post" onSubmit="return EW_checkMyForm(this);">
  <p> <font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
    <input type="hidden" name="a_edit" value="U">
    <input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
    </font>
  <table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
    <!--tr> 
      <td class="encabezado"><span  style="color: #FFFFFF;">N�MERO 
        DE RADICACION</span></td>
      <td bgcolor="#F5F5F5"><span > 
        <input type="text" name="x_numero" id="x_numero" size="30" maxlength="50" value="<?php echo htmlspecialchars(@$x_numero) ?>">
        </span></td>
    </tr-->
    <tr> 
      <td width="209" class="encabezado"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">FECHA</span></font></td>
      <td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span > 
        <?php if (!($x_fecha != NULL) || ($x_fecha == "")) { $x_fecha = date('Y/m/d H:i:s');} // Set default value ?>
        <?php echo date('Y/m/d H:i:s'); ?> 
        <input type="hidden" name="x_fecha" value="<?php echo FormatDateTime(@$x_fecha,0); ?>">
        &nbsp; </span></font></td>
      <td width="135" class="encabezado"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">NUMERO 
        DE RADICADO</span></font></td>
      <td width="127" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $x_numero; ?></font></td>
    </tr>
    <tr> 
      <td class="encabezado" title="Ciudad a la cual pertenece la persona natural o jur&iacute;dica a la que se le env&iacute;a el documento."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF">CIUDAD DESTINO </span></font></td>
      <td colspan="4" bgcolor="#F5F5F5"> <font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php if(isset($_REQUEST["estado"])) {?>
       <input type="hidden" name="estado" value="INICIADO">           
        <?php  
         $pais1 = busca_filtro_tabla("*","pais","","nombre",$conn);
         echo "Pais: "; echo "<select name='pais' id='pais'><option>Seleccionar  ...</option>";
         for($i=0; $i<$pais1["numcampos"]; $i++)
         {if($pais1[$i]["idpais"]==1)
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
      </select>&nbsp;&nbsp;<a href="municipioadd.php">otro</a>      
  <?php }
   else
     { 
     echo '<input type="hidden" name="estado" value="NORMAL">';
     $municipio = busca_tabla("municipio",$x_municipio);
          //print_r($municipio);
          if($municipio["numcampos"]){          
            $departamento = busca_tabla("departamento",$municipio[0]["departamento_iddepartamento"]);
           echo $municipio[0]["nombre"]." - ".$departamento[0]["nombre"];
           }
      }           
   ?>
   </td>
    </tr>
    <tr> 
        <td class="encabezado" title="Utilizar el esc&aacute;ner para digitalizar el documento que se est&aacute; radicando"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">RESPONSABLE DEL DOCUMENTO *
        </span></font></td>        
		   <?php
       if(isset($_REQUEST["estado"])) 
         { ?>
          <head>
<meta name="KEYWORDS" content="dhtmlxtree, dhtml tree, javascript tree, javascript, DHTML, tree, tree menu, checkbox tree, checkboxes, dynamical loading, xml, AJAX, API, cross-browser, checkbox, XHTML, compatible, treeview, navigation, menu, tree control, script, javascript navigation, web-site, dynamic, javascript tree menu, dhtml tree menu, dynamic tree, folder tree, item, node, asp, .net, jsp, cold fusion, custom tag, loading, widget, checkbox, drag, drop, drag and drop, component, html, scand">
<meta name="DESCRIPTION" content="Cross-browser DHTML tree menu with XML support and powerful API. This JavaScript Tree Menu has built-in checkboxes and allows you to create advanced checkbox tree.">
</head>	
  <link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>        
        <td bgcolor="#F5F5F5" colspan="4" ><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
Buscar: <input type="text" id="stext_responsable" width="200px" size="25">
<a href="javascript:void(0)" onclick="tree3.findItem((document.getElementById('stext_responsable').value),1)"><img src="botones/general/anterior.png"border="0px"></a>
<a href="javascript:void(0)" onclick="tree3.findItem((document.getElementById('stext_responsable').value),0,1)"><img src="botones/general/buscar.png" alt="Buscar" border="0px"></a>
    <a href="javascript:void(0)" onclick="tree3.findItem((document.getElementById('stext_responsable').value))"> <img src="botones/general/siguiente.png" alt="Buscar Siguiente" border="0px"></a><br />
                <div id="treeboxbox_tree3"></div>
	              <script type="text/javascript">
                <!--
                tree3=new dhtmlXTreeObject("treeboxbox_tree3","100%","100%",0);
			          tree3.setImagePath("imgs/");
          			tree3.enableIEImageFix(true);
          			tree3.enableCheckBoxes(1);
          			//tree3.setXMLAutoLoading("test_serie.php?tabla=dependencia&estado=activos");
          			tree3.loadXML("test_serie.php?tabla=dependencia&estado=activos");
	              -->					
	              </script>
	              <input type="hidden" name="x_dependencia_iddependencia" id="x_dependencia_iddependencia">
        <?php
         }
        else
        { echo '<td bgcolor="#F5F5F5" colspan="4" ><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">';
          if($x_plantilla=="")
             {$codigo=$x_dependencia_iddependencia;
              $dep=busca_filtro_tabla("nombre","dependencia A","A.iddependencia=".$codigo,"",$conn);
              echo ucwords($dep[0]["nombre"]);
              //print_r($dep);
             }
          else
             {$codigo=$x_ejecutor;
              $dep=busca_filtro_tabla("nombres,apellidos","funcionario A","A.funcionario_codigo=".$codigo,"",$conn);
              echo ucwords($dep[0]["nombres"]." ".$dep[0]["apellidos"]);
             }
            if(!$dep["numcampos"])
              echo("RESPONSABLE NO DEFINIDO");
          }    
          ?>      
        </td>       
    <tr> 
              <td class="encabezado"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">CLASIFICACI&Oacute;N DEL DOCUMENTO</span></font></td>
      <td colspan="4" bgcolor="#F5F5F5"> 
      <?php        
  if (!($x_serie != NULL) || ($x_serie == "")||($x_serie==0)) 
  { 
     $x_serie = "";               
     $nombreSerie="seleccionar";
  } // Set default value
  else 
  {
    $nombre_serie = busca_filtro_tabla("nombre,idserie","serie","idserie=".$x_serie,"",$conn);
    $nombreSerie=$nombre_serie[0]["nombre"];
  }  
 
echo $nombreSerie."<br />";                                             
 include_once("formatos/librerias/header_formato.php");
?>  
<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
Buscar: <input type="text" id="stext_serie" width="200px" size="25">
<a href="javascript:void(0)" onclick="tree_serie.findItem((document.getElementById('stext_serie').value),1)"><img src="botones/general/anterior.png" alt="Buscar Anterior" border="0px"></a>
<a href="javascript:void(0)" onclick="tree_serie.findItem((document.getElementById('stext_serie').value),0,1)"><img src="botones/general/buscar.png" alt="Buscar" border="0px"></a>
    <a href="javascript:void(0)" onclick="tree_serie.findItem((document.getElementById('stext_serie').value))"><img src="botones/general/siguiente.png" alt="Buscar Siguiente" border="0px"></a>  
    <br />
    <div id="esperando_serie"><img src="imagenes/cargando.gif"></div>
    <div id="treeboxbox_serie" height="100%"></div>
    <input type="hidden" name="serie" id="serie" obligatorio="obligatorio"  value="" >
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
                			tree_serie.enableIEImageFix(true);
                      tree_serie.enableCheckBoxes(1);
                      tree_serie.enableRadioButtons(true);
                      tree_serie.enableThreeStateCheckboxes(1);
                      tree_serie.setOnLoadingStart(cargando_serie);
                      tree_serie.setOnLoadingEnd(fin_cargando_serie);
                      tree_serie.enableSmartXMLParsing(true);
                      //tree_serie.setXMLAutoLoading("test_serie.php?tabla=serie&estado=1");
                      tree_serie.loadXML("test_serie.php?tabla=serie&estado=1&seleccionado=<?php echo $x_serie; ?>");
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
                               eval('document.getElementById("esperando_serie")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_serie")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_serie"]');
                        document.poppedLayer.style.display = "none";
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
                        document.poppedLayer.style.display = "";
                      }
                	--></script>
	<input type="hidden" name="x_serie" id="x_serie" value="<?php echo $x_serie; ?>">
        </span> </td>
    </tr>
    <?php 
    if(isset($_REQUEST["estado"]))
    {
     ?>
      <!--Esto es para los ejecutores, en la parte de energia quedan diferentes-->
      <tr> <td class="encabezado" title="Persona jur&iacute;dica (empresa) a la que se env&iacute;a el documento"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF">EMPRESA-PERSONA 
          JUR&Iacute;DICA/NATURAL DESTINATARIO*</span></font></td>
        <td colspan="2" bgcolor="#F5F5F5"> <font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"> 
          <?php if (!($x_dependencia_destino != NULL) || ($x_dependencia_destino == "")) { $x_dependencia_destino = 0;} // Set default value ?>  
        <input type="hidden" name="ejecutor" id="ejecutor" value="">
        <input type="text" size=53 name="x_ejecutor2" id="auto1" ></div>
        </td> 
       <td class="encabezado" title="NIT de la persona jur&iacute;dica (empresa) a la que se env&iacute;a el documento"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF">NIT EMPRESA-PERSONA 
          JUR&Iacute;DICA/NATURAL</span></font></td>
        <td bgcolor="#F5F5F5"> <font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"> 
          <?php if (!($x_dependencia_destino != NULL) || ($x_dependencia_destino == "")) { $x_dependencia_destino = 0;} // Set default value 
		?>
          <input type="text" name="x_nitejecutor2" id="auto2" >
        </td>       
      </tr>      
        <tr>
        <td class="encabezado" title="Cargo de la persona a la que se env&iacute;a el documento"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">CARGO DEL DESTINATARIO</span></font></td>
        <td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <div id="div_eje_cargo"><input type="text" name="x_cargoejecutor" id="x_cargoejecutor" size=53 value=""></div>
        </font></td>
                <!--td class="encabezado" title="Ciudad del Remitente."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">CIUDAD EJECUTOR</span></font></td>
        <td  bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <div id="div_eje_ciudad"><input type="text" name="x_ciudadejecutor" id="x_ciudadejecutor"  value=""></div>
        </font></td-->
        <td class="encabezado" title="Tel&eacute;fono del destinatario a quien se dirige el documento"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">TEL&Eacute;FONO DESTINATARIO</span></font></td>
        <td bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <div id="div_eje_telefono"><input type="text" name="x_telefonoejecutor" id="x_telefonoejecutor" value=""></div>
        </font></td>         
        </tr>
           <tr>
        <td class="encabezado" title="Empresa del destinatario"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">EMPRESA DESTINATARIO</span></font></td>
        <td colspan="4" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <div id="div_eje_empresa"><input type="text" name="x_empresaejecutor" id="x_empresaejecutor" size=100 value=""></div>
        </font></td>        
        </tr> 
        <tr>
          <td class="encabezado" title="Direccion del destinatario.">
            <font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
              <span  style="color: #FFFFFF;">
                DIRECCI&Oacute;N DESTINATARIO
              </span>
            </font></td>
          <td colspan="2" bgcolor="#F5F5F5">
            <font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
              <div id="div_eje_direccion">
                <input type="text" name="x_direccionejecutor" id="x_direccionejecutor" size=53 value="">
              </div>
            </font></td> 
            <td class="encabezado" title="Email del ejecutor">
            <font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
              <span  style="color: #FFFFFF;">
                EMAIL DESTINATARIO
              </span>
            </font></td>
          <td colspan="1" bgcolor="#F5F5F5">
            <font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
              <div id="div_eje_email">
                <input type="text" name="x_emailejecutor" id="x_emailejecutor" size=53 value="">
              </div>
            </font></td> 
        </tr>    
      <!-------------------------------------------------------------------------------------------------------->
     <?php
    }
    else { ?>
    <tr> 
      <td class="encabezado"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF">EMPRESA-PERSONA DESTINO<br> 
        (JURIDICA O NATURAL)</span></font></td>
      <td colspan="4" bgcolor="#F5F5F5"> <font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"> 
        <?php
              echo ejecutor();
		?>       
		 <input type="hidden" name="x_ejecutor" value="<?php echo $ejecutor[0]["idejecutor"]; ?>">
        </font></tr>
   <?php } ?>     
    <tr> 
      <td height="62" class="encabezado"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF;">DESCRIPCI&Oacute;N 
        O ASUNTO *</span></font></td>
      <td colspan="4" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span > 
        <textarea cols="65" rows="5" id="x_descripcion" name="x_descripcion"><?php echo @$x_descripcion; ?></textarea>
        </span></font></td>
    </tr>
       <tr> 
        <td class="encabezado" title="Seleccione el tipo de Env&iacute;o: Mensajer&iacute;a Externa, Mensajer&iacute;a Interna o Entrega Personal"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span>
        <span  style="color: #FFFFFF;">TIPO DE MENSAJER&Iacute;A</span>
            </font>
        </td>
        <td colspan=3 bgcolor="#F5F5F5">
          <font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <span >  
          Mensajer&iacute;a Externa 
          <input type="radio" name="x_tipo_despacho" value="1" <?php if($x_tipo_despacho==1) echo("checked='1'"); ?> OnClick="muestra_mensajero(0);"><br />
          Mensajer&iacute;a Interna
          <input type="radio" name="x_tipo_despacho" value="2" <?php if($x_tipo_despacho==2) echo("checked='1'"); ?> OnClick="muestra_mensajero(1);"><br />
          Entrega Personal&nbsp;&nbsp;&nbsp;
          <input type="radio" name="x_tipo_despacho" value="3" <?php if($x_tipo_despacho==3) echo("checked='1'"); ?> OnClick='muestra_mensajero(0);'>                
          </span></font></td>
          <td bgcolor="#F5F5F5">
          <div name="mensajero" id="mensajero" style="visibility:hidden">
              <?php
              $nmensajeros=0;  
              $mensajero=array();
              $mensajero=busca_funcionarios("cargo","mensajero");
              if($mensajero)
                $nmensajeros=count($mensajero);
              if($nmensajeros){
                echo('Mensajeros <br><select name="x_mensajero" id="x_mensajero">');
                for($i=0;$i<$nmensajeros;$i++){
                $dato_mensajero=busca_filtro_tabla("A.idfuncionario,".concatenar_cadena_sql(array("A.nombres","' '","A.apellidos"))." AS nombres","funcionario A","A.idfuncionario=".$mensajero[$i]." AND estado=1","",$conn);
                //redirecciona(implode("-",$dato_mensajero));
                if($dato_mensajero["numcampos"])              
                  echo("<option value=".$dato_mensajero[0]["idfuncionario"].">".$dato_mensajero[0]["nombres"]."</option>");
                }
                echo('</select>');
              }
              else echo("No se han asignado Mensajeros Internos");
              ?>
          </div>
         </td> 
      </tr>

    <tr> 
      <td class="encabezado" title="Utilizar el esc&aacute;ner para digitalizar el documento que se est&aacute; radicando"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">CONTINUAR </span></font></td>
      <!--td bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span> 
        SI 
        <input type="radio" name="x_escaneo" value=1>
        NO 
        <input type="radio" name="x_escaneo" value=0 CHECKED>
        </span></font></td-->
      <td colspan="4" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span> 
<input type="button" name="Action" id="Action" value="CONTINUAR">
        </span></font></td>
    </tr>
  </table>
</form>
<?php include ("footer.php") ?>
<?php

//------------------------------------------------------------------------------

function municipio()
{
global $x_municipio;
global $conn;
//echo $x_municipio;
$_municipio="";
$filtro="A.idmunicipio=".$x_municipio;
//echo $filtro;
$id_municipio=busca_filtro_tabla('A.nombre','municipio A',$filtro,'',$conn);
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
$filtro="idejecutor=ejecutor_idejecutor and iddatos_ejecutor=".$x_ejecutor;
$id_ejecutor=busca_filtro_tabla('',"datos_ejecutor A,ejecutor",$filtro,'',$conn);

if($id_ejecutor["numcampos"]>0)
 {
  $sTmp.= "<table>";
	$sTmp .= "<tr><td><b>NOMBRE</b></td><td>".$id_ejecutor[0]["nombre"]."</td></tr>";
  $sTmp .= "<tr><td><b>IDENTIFICACI&Oacute;N</b></td><td>".$id_ejecutor[0]["identificacion"]."</td></tr>";      
  $sTmp .= "<tr><td><b>CARGO</b></td><td>".$id_ejecutor[0]["cargo"]."</td></tr>";
  $sTmp .= "<tr><td><b>DIRECCI&Oacute;N</b></td><td>".$id_ejecutor[0]["direccion"]."</td></tr>";
  $sTmp .= "<tr><td><b>TEL&Eacute;FONO</b></td><td>".$id_ejecutor[0]["telefono"]."</td></tr>";
  $sTmp.= "</table>";
 } 
else
  $sTmp="";    
return($sTmp);
}

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
	global $x_paginas;
	global $x_municipio;
	global $x_dependencia_iddependencia,$x_tipo_despacho,$x_plantilla;

	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT A.* FROM documento A";
	$sSql .= " WHERE A.iddocumento = " . $sKeyWrk;
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
	$sSql;
	$rs = phpmkr_query($sSql,$conn) or error("PROBLEMAS AL EJECUTAR LA B�SQUEDA" . phpmkr_error() . ' SQL:' . $sSql);
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;
		//$row = phpmkr_fetch_array($rs);
    //print_r($row);
		// Get the field contents
			$x_iddocumento = $row["iddocumento"];
		$x_numero = $row["numero"];
		$x_serie = $row["serie"];
		$x_fecha = $row["fecha"];
		$x_ejecutor = $row["ejecutor"];
		//else if($row["ejecutor_destino"])  $GLOBALS["x_ejecutor"] = $row["ejecutor_destino"];
		$x_descripcion = $row["descripcion"];
		$x_paginas = $row["paginas"];
		$x_plantilla = $row["plantilla"];
		$x_municipio = $row["municipio_idmunicipio"];
		$x_dependencia_iddependencia = $row["responsable"];//substr($row["entregado"],2,(strlen($row["entregado"])-1));
		$x_tipo_despacho=$row["tipo_despacho"];

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

function EditData($sKey,$conn)
{
	global $_SESSION;
	global $_POST;
	global $_POST_FILES;
	global $_ENV;
	global $x_descripcion,$x_tipo_despacho,$x_ejecutor;
  global $x_dependencia_iddependencia,$x_plantilla,$x_mensajero;

	// Open record
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM documento A";
	$sSql .= " WHERE A.iddocumento = " . $sKeyWrk;
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
  $rs = phpmkr_query($sSql,$conn) or error("PROBLEMAS AL EJECUTAR LA B�SQUEDA" . phpmkr_error() . ' SQL:' . $sSql);
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$EditData = false; // Update Failed
	}else{
	//print_r($_REQUEST);
   if(isset($_POST["estado"]) && $_POST["estado"]=='INICIADO')
    { $sql = "UPDATE documento SET  municipio_idmunicipio=658, responsable=".$_POST["x_dependencia_iddependencia"].", ejecutor='$x_ejecutor', serie='".$_REQUEST["serie"]."', descripcion ='".$x_descripcion."',tipo_despacho='".$x_tipo_despacho."',estado='APROBADO' WHERE iddocumento=".$sKeyWrk;      
    } 
   else    	
    $sql = "UPDATE documento SET serie='".$_REQUEST["x_serie"]."', descripcion ='".$x_descripcion."',tipo_despacho='".$x_tipo_despacho."' WHERE iddocumento=".$sKeyWrk;
    //die($sql);
phpmkr_query($sql,$conn)or error("NO SE ACTUALIZ� LA DESCIPCION DEL DOCUMENTO");
    $salida=busca_filtro_tabla("","salidas","documento_iddocumento=".$sKeyWrk,"",$conn);
    if($salida["numcampos"])
    	{$sql="delete from salidas where documento_iddocumento=".$sKeyWrk;
    	 phpmkr_query($sql);
    	}  
    if($x_tipo_despacho==2)
      {
       $sql="INSERT INTO salidas(documento_iddocumento,responsable) VALUES(".$sKeyWrk.",'".$x_mensajero."')";
       phpmkr_query($sql,$conn);
      }	///tipo de despacho personal
    elseif($x_tipo_despacho==3)
      {
       $sql="INSERT INTO salidas(documento_iddocumento,responsable) VALUES(".$sKeyWrk.",'".$_REQUEST["x_ejecutor"]."')";
       phpmkr_query($sql,$conn);
      } 
	 $EditData = true;
	}
  return $EditData;
}
function ad_nombre($cad,$tipo)
{
global $conn;
	$value=strtoupper($cad);
	$rs=phpmkr_query("SELECT * FROM nombre A WHERE A.valor ='".$value."' AND tipo='$tipo'" ,$conn)or error("NO SE ENCONTRO NOMBRE");;
      if(phpmkr_num_rows($rs)>0){
       $campo=phpmkr_fetch_array($rs)or error("CAMPO VACIO EN NOMBRE");
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
   
  $x_identificacion = ($x_identificacion != "") ?  "identificacion='".$x_identificacion."'"  :  'identificacion is NULL';  
  $x_nitejecutor2 = ($x_nitejecutor2 != "") ?  $x_nitejecutor2  :  '';  
  
  $condicion=($x_nitejecutor2 != "") ?  "identificacion='".$x_nitejecutor2."'"  :  "(identificacion is NULL or identificacion='')";
     
  $campo = busca_filtro_tabla("idejecutor","ejecutor,datos_ejecutor","ejecutor_idejecutor=idejecutor and iddatos_ejecutor='$value' and nombre like '".($nombre)."' and $condicion","",$conn);
 
  if($campo["numcampos"]>0)
  {
  $repetido = busca_filtro_tabla("iddatos_ejecutor","ejecutor,datos_ejecutor","idejecutor=ejecutor_idejecutor and iddatos_ejecutor=$value and cargo='".(($x_cargoejecutor))."' and direccion='".(($x_direccionejecutor))."' and email='".(($x_emailejecutor))."' and telefono='".(($x_telefonoejecutor))."' and empresa='".(($x_empresaejecutor))."'","",$conn);
       
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
      
    phpmkr_query("INSERT INTO datos_ejecutor(ejecutor_idejecutor,telefono,fecha,cargo,direccion,email,titulo,empresa,ciudad) VALUES(".$campo[0]["idejecutor"].",'".$x_telefonoejecutor."',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",'".$x_cargoejecutor."','$x_direccionejecutor','$x_emailejecutor','$titulo','$x_empresaejecutor','$ciudad')",$conn) or error("NO SE INSERTO EJECUTOR");         

   return(phpmkr_insert_id());
   }
  }
  else 
  {   
    phpmkr_query("INSERT INTO ejecutor(nombre,identificacion,fecha_ingreso) VALUES('".($nombre)."','".$x_nitejecutor2."',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').")",$conn) or error("NO SE INSERTO EJECUTOR");
    $idejecutor=phpmkr_insert_id();
    phpmkr_query("INSERT INTO datos_ejecutor(ejecutor_idejecutor,telefono,fecha,cargo,direccion,email,empresa) VALUES(".$idejecutor.",'".$x_telefonoejecutor."',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",'".$x_cargoejecutor."','$x_direccionejecutor','$x_emailejecutor','$x_empresaejecutor')",$conn) or error("NO SE INSERTO EJECUTOR"); 
     return(phpmkr_insert_id());    
     } 
 return false;
}
function genera_campo_listados()
{
global $conn;
$confdep = busca_filtro_tabla("valor","configuracion","nombre='departamento'","idconfiguracion",$conn);
$confciu = busca_filtro_tabla("valor","configuracion","nombre='ciudad'","idconfiguracion",$conn);
$defaultm=$confciu[0]["valor"];
$defaultd=$confdep[0]["valor"];
$pais = busca_filtro_tabla("*","pais","","nombre",$conn);
  $texto="<script>";
  for($i=0;$i<$pais["numcampos"];$i++)
      {$dep=busca_filtro_tabla("*","departamento","pais_idpais=".$pais[$i]["idpais"],"nombre",$conn);      
       for($j=0;$j<$dep["numcampos"];$j++)
          {
           $texto.=  'c_departamento.forValue("'.$pais[$i]["idpais"].'").addOptionsTextValue("'.codifica_encabezado(html_entity_decode($dep[$j]["nombre"])).'","'.$dep[$j]["iddepartamento"].'");';           
           if($dep[$j]["iddepartamento"]==$defaultd)
             $texto.="c_departamento.forValue(".$pais[$i][0].").setDefaultOptions('".$dep[$j]["iddepartamento"]."');"; 
           $mun = busca_filtro_tabla("*","municipio","departamento_iddepartamento=".$dep[$j]["iddepartamento"],limpiar_cadena_sql("nombre")." asc",$conn);         
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
<script>
function muestra_mensajero(op){
if(op==1)
  document.getElementById("mensajero").style.visibility="visible";
else   
  document.getElementById("mensajero").style.visibility="hidden";
}
</script>
