<?php
include_once("db.php");
include_once("class_transferencia.php");
include_once("formatos/librerias/header_formato.php");
include_once("workflow/libreria_paso.php");
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<script type="text/javascript" src="anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script>
<?php include_once("anexosdigitales/funciones_archivo.php"); ?>
<script type="text/javascript" src="anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="anexosdigitales/highslide-4.0.10/highslide/highslide.css" />    
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
<script type='text/javascript'>
    hs.graphicsDir = 'anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
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
             $("#x_codigoejecutor").val("");
            }
          else
            {$("#x_cargoejecutor").val(vector[0]);
             $("#x_telefonoejecutor").val(vector[1]);
             $("#x_empresaejecutor").val(vector[2]);
             $("#x_direccionejecutor").val(vector[3]);
             $("#x_emailejecutor").val(vector[4]);
             $("#x_codigoejecutor").val(vector[7]);
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
  $("#x_codigoejecutor").keyup(function (event){
   if(event.keyCode<96 || event.keyCode>105)
     {actual=$("#x_codigoejecutor").val();
      if(isNaN(actual)||actual.indexOf(".")>0)
      {if(isNaN(parseInt(actual)))
          $("#x_codigoejecutor").val("");
         else
          $("#x_codigoejecutor").val(parseInt(actual));
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
		lleno=EW_checkMyForm(window.document.documentoadd);
		if(lleno!==false)
		  {$.post(
        "formatos/librerias/actualizar_ejecutor.php",{
        nombre: $("#auto1").val(),
        identificacion: $("#auto2").val(),
        cargo:$("#x_cargoejecutor").val(),
        empresa:$("#x_empresaejecutor").val(),
        direccion:$("#x_direccionejecutor").val(),
        telefono:$("#x_telefonoejecutor").val(),
        codigo:$("#x_codigoejecutor").val(),
        campos:'nombre,identificacion,cargo,empresa,direccion,telefono,email,codigo',
        //campos:'nombre,identificacion,cargo,empresa,direccion,telefono,email',
        email:$("#x_emailejecutor").val()},
        function(datos,exito){
          valores=datos.split('|');
          $("#ejecutor").val(valores[0]);
          $("#documentoadd").submit();
        }
      );
      }
	});
});
</script>
<?php
// Initialize common variables
$x_serial = Null;
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
$x_tipoejecutor =Null;
$x_dependencia_destino=Null;
$x_escaneo= Null;
$x_fecha_oficio = Null;
$x_oficio = Null;
$x_anexo = Null;
$x_descripcion_anexo = Null;
$x_archivos = Null;
$x_dias = Null;
//////////Nuevos para el tratamiento del ejecutor////////////////////
$x_nitejecutor2 = Null;
$x_cargoejecutor = Null;
$x_ciudadejecutor = Null;
$x_direccionejecutor = Null;
$x_telefonoejecutor = Null;
$x_emailejecutor = Null;
$x_empresaejecutor = Null;
$x_codigoejecutor = Null;
///////////////////////////////////////////////////////////////////
$x_funcionario_destino = Null;
$x_flujo = Null;
$x_copia= Null;
include ("phpmkrfn.php"); 
// Get action
$sAction = @$_POST["a_add"];
if (($sAction == "") || (($sAction == NULL))) {
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
{ // Get fields from form
	$x_copia=@$_POST["x_copia"];
	$x_serial = @$_POST["x_serial"];
	$x_numero = @$_POST["x_numero"];
	$x_serie = @$_POST["x_serie"];
	$x_fecha = @$_POST["x_fecha"];
	$x_fecha_oficio = @$_POST["x_fecha_oficio"];
	$x_oficio = @$_POST["x_oficio"];
  $x_tipoejecutor=@$_POST["x_tipoejecutor"];
  $x_anexo = @$_POST["x_anexo"];
  $x_descripcion_anexo = @$_POST["x_descripcion_anexo"];
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
  $x_codigoejecutor = @$_POST["x_codigoejecutor"];
  ////////////////////////////////////////////////////////////
  $x_municipio_idmunicipio = @$_POST["municipio"];
  if($x_municipio_idmunicipio=='otro')
	  $municipio_ext = @$_POST["x_municipio_ext"];    
	if(isset($_POST["x_funcionario_idfuncionario"])&&$_POST["x_funcionario_idfuncionario"]<>"")
	 $x_ejecutor = @$_POST["x_funcionario_idfuncionario"];
  else if(isset($_POST["x_ejecutor2"])&&$_POST["x_ejecutor2"]<>"")
	{$x_ejecutor = @$_POST["ejecutor"];
	}   	
  $x_descripcion = @$_POST["x_descripcion"];
	$x_paginas = @$_POST["x_paginas"]; 
	$x_dependencia_iddependencia = @$_POST["x_dependencia_iddependencia"];
	$x_dependencia_iddependencia = explode("#",$x_dependencia_iddependencia);
	$x_escaneo=@$_POST["x_escaneo"];
	$x_funcionario_destino = @$_POST["x_funcionario_destino"];
	$x_flujo = @$_POST["x_flujo"];
	
	//die("aqui");
}

switch ($sAction)
{
	case "A": // Add
		if ($doc=AddData($conn)) {
			if($x_copia!="")
			  {
					$destinos_copias = array();
					$dep_copias=array(); 
					$destinos_aux=split(",",$x_copia);
					$num_destino = count($destinos_aux);	
					for($i=0; $i<$num_destino; $i++){
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
				  	
					$datos["tipo_destino"]="1";  
				    $datos["archivo_idarchivo"]=$doc;
				    $datos["origen"]=usuario_actual("funcionario_codigo");
				    $datos["nombre"]="COPIA";
				    $datos["tipo"]="";
				    $datos["tipo_origen"]="1"; 
				         
				    transferir_archivo_prueba($datos,$destinos_copias,"");	
				  		 
			 	}
			
			
		  $vector=explode(",",@$x_funcionario_destino); 
      foreach($vector as $fila){
        if(!strpos($fila,"#")){ 
           $lista=array($fila);
          }
        else
          $lista=buscar_funcionarios(str_replace("#","",$fila));
        $datos["tipo_destino"]="1";  
        $datos["archivo_idarchivo"]=$doc;
        $datos["origen"]=usuario_actual("funcionario_codigo");
        $datos["nombre"]="TRANSFERIDO";
        $datos["tipo"]="";
        $datos["tipo_origen"]="1";      
        transferir_archivo_prueba($datos,$lista,"");
		
 
       }    
       // Add New Record		
			if($doc)
			  $docu=$doc;
			else 
			  $docu=$x_serial;
			$location="documentolist.php";
			if($x_escaneo==1)
			  {
			   redirecciona("colilla.php?key=$docu&enlace=paginaadd.php?key=$docu&enlace2=documentolist.php");	
			  }
       else{
       			redirecciona("colilla.php?enlace=".$location."&doc=$docu&pagina=add"); 			
			   //redirecciona("colilla.php?enlace=documentoadd.php&key=$docu");
        }
        }
    redirecciona("documentolist.php");  
	break;
}
?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

-->
</script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {
var list_funcionarios = tree2.getAllChecked();      
var funcionarios = list_funcionarios.split(",");
var func ="";
var copia="";

if(typeof(tree_copia) != 'undefined')
   {
    var copias = tree_copia.getAllChecked();   
    var func_copia = copias.split(",");
    for(i=0; i<func_copia.length; i++)
    {     
     {        
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
document.documentoadd.x_copia.value=copia;
   
EW_this.x_funcionario_destino.value=func;
if (EW_this.x_numero && !EW_hasValue(EW_this.x_numero, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_numero, "TEXT", "POR FAVOR INGRESE EL CAMPO REQUERIDO - NUMERO DE RADICACION."))
		return false;
}
if (EW_this.x_ejecutor2 && !EW_hasValue(EW_this.x_ejecutor2, "TEXT" )) {  
   if (!EW_onError(EW_this, EW_this.x_ejecutor2, "TEXT", "POR FAVOR INGRESE EL CAMPO REQUERIDO - REMITENTE O NOMBRE Y APELLIDO DE QUIEN ENVIA EL DOCUMENTO.")) 		       
    return false; }
/*if (EW_this.x_codigoejecutor && !EW_hasValue(EW_this.x_codigoejecutor, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_codigoejecutor, "TEXT", "POR FAVOR INGRESE EL CAMPO REQUERIDO - CODIGO DE REMITENTE."))
		return false;
}*/
if (EW_this.x_descripcion && !EW_hasValue(EW_this.x_descripcion, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_descripcion, "TEXT", "POR FAVOR INGRESE EL CAMPO REQUERIDO - ASUNTO DEL DOCUMENTO."))
		return false;
}

if (EW_this.x_nitejecutor2 && !EW_checkinteger(EW_this.x_nitejecutor2.value)) {
	if (!EW_onError(EW_this, EW_this.x_nitejecutor2, "TEXT", "Entero Incorrecto - Nit del Remitente"))
		return false; 
}

if(EW_this.x_funcionario_destino && EW_this.x_funcionario_destino.value == ""){
  alert("POR FAVOR INGRESAR UN FUNCIONARIO O DEPENDENCIA DESTINO");
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
{ alert("La fecha del oficio entrante no puede ser mayor que la fecha actual, por favor verifique.");
  return false;
}

return true;
}
-->
</script>
<?php include ("header.php") ?>
<script type="text/javascript" src="popcalendar.js"></script>
<script type="text/javascript" src="js/dynamicoptionlist.js"></script>
<body onLoad="initDynamicOptionLists()">
<font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
<p><span class="internos"><img class="imagen_internos" src="botones/general/radicacion_entrada.png" border="0">&nbsp;&nbsp;RADICACI&Oacute;N DE DOCUMENTOS DE ENTRADA</p>
</font>
<div id="container"> 
  <form name="documentoadd" id="documentoadd" action="documentoadd.php"  method="post" enctype="multipart/form-data" >
    <p> <font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
      <input type="hidden" name="a_add" value="A">
      <input type="hidden" name="x_funcionario_destino" id="x_funcionario_destino">
      <input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''>
      <input type="hidden" name="x_copia" id="x_copia" value="0">
      </font>
    <table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">    
      <tr> 
        <td width="188" class="encabezado" title="Fecha en que se radica o genera el documento."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">FECHA DE RADICACI&Oacute;N</span></font></td>
        <td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span > 
          <?php if (!($x_fecha != NULL) || ($x_fecha == "")) { $x_fecha = date('Y/m/d H:i:s');} // Set default value ?>
          <?php echo date('Y/m/d H:i:s'); ?> 
          <input type="hidden" name="x_fecha" value="<?php echo FormatDateTime(@$x_fecha,0); ?>">
          &nbsp; </span></font></td>
        <td class="encabezado" title="Numero de radicado asignado al documento."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">N&Uacute;MERO 
          DE RADICADO</span></font></td>
        <td bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><?php echo muestra_contador("radicacion_entrada");?></font></td>
      </tr>
      <tr><td class="encabezado" title="Seleccione el tipo de documento de acuerdo a los tipos documentales de la Organizaci&oacute;n."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">TIPO DE DOCUMENTO</span></font></td>
            <td colspan="4" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
  <link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
  <script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTreeNew.js"></script>
	
	
	<span class="phpmaker">
    		  Buscar:<br><input type="text" id="stext_serie" width="200px" size="20">      
          <a href="javascript:void(0)" onclick="tree_serie.findItem(document.getElementById('stext_serie').value,1)">
          <img src="botones/general/anterior.png" border="0px" alt="Anterior"></a>
          <a href="javascript:void(0)" onclick="tree_serie.findItem(document.getElementById('stext_serie').value,0,1)">
          <img src="botones/general/buscar.png" border="0px" alt="Buscar"></a>
          <a href="javascript:void(0)" onclick="tree_serie.findItem(document.getElementById('stext_serie').value)">
          <img src="botones/general/siguiente.png" border="0px" alt="Siguiente"></a><br />
        </span>	
<div id="esperando_serie"><img src="imagenes/cargando.gif"></div>                          
	  <div id="treeboxbox_serie" height="100%"></div>
    <input type="hidden" name="x_serie" id="serie" obligatorio="obligatorio"  value="<?php echo $x_serie; ?>">
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
            tree_serie.setXMLAutoLoading("test_serie_funcionario.php?tabla=serie&categoria=1&estado=1&seleccionado='.$x_serie.'");
            tree_serie.loadXML("test_serie_funcionario.php?tabla=serie&categoria=1&estado=1&seleccionado='. $x_serie.'");
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
         </td>
          </tr>
      <tr> 
        <td class="encabezado" title="Municipio al cual pertenece la persona natural o jur&iacute;dica que env&iacute;a el documento."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF">CIUDAD ORIGEN</span></font></td>
        <td colspan="4" bgcolor="#F5F5F5"><?php  
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
      </select>&nbsp;&nbsp;<a href="municipioadd.php">OTRO</a>         
      </td>  
      </tr>
      <tr> 
        <td width="188" class="encabezado" title="Fecha en la cual el oficio fue emitido y firmado."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">FECHA DE OFICIO ENTRANTE</span></font></td>
        <td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span > 
          <?php if (!($x_fecha_oficio != NULL) || ($x_fecha_oficio == "")) { $x_fecha_oficio = NULL;} // Set default value ?>
          <input type="text" name="x_fecha_oficio" id="x_fecha_oficio" value="<?php echo @$_REQUEST["fecha_oficio"]; ?>" >&nbsp;<input name="image" id="image" type="image" onclick="popUpCalendar(this, this.form.x_fecha_oficio,'yyyy/mm/dd');return false;" src="images/ew_calendar.gif" alt="Seleccione una Fecha" /></span></font></td>
        <td class="encabezado" title="N&uacute;mero externo del oficio, si lo tiene."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">N&Uacute;MERO DE OFICIO ENTRANTE</span></font></td>
        <td bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <input type="text" name="x_oficio" id="x_oficio" value="">
        </font></td>
      </tr>
        <tr>
         <td class="encabezado" title="Nombre de la persona natural o jur&iacute;dica (empresa) que env&iacute;a el documento."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF">PERSONA NATURAL/JUR&Iacute;DICA*</span></font></td>
        <td colspan="2" bgcolor="#F5F5F5"> <font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"> 
          <?php if (!($x_dependencia_destino != NULL) || ($x_dependencia_destino == "")) { $x_dependencia_destino = 0;} // Set default value ?>  
           <input type="hidden" name="ejecutor" id="ejecutor" value="">
           <input type="text" size=53 name="x_ejecutor2" id="auto1" >
        </td> 
        <td class="encabezado" title="Nit o n&uacute;mero de identificaci&oacute;n del remitente."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF">NIT PERSONA  
          NATURAL/JUR&Iacute;DICA</span></font></td>
        <td bgcolor="#F5F5F5"> <font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"> 
          <?php if (!($x_dependencia_destino != NULL) || ($x_dependencia_destino == "")) { $x_dependencia_destino = 0;} // Set default value 
		?>          
           <input type="text" name="x_nitejecutor2" id="auto2">
        </td>       
      </tr>  
        <tr>
        <td class="encabezado" title="Cargo u ocupaci&oacute;n del remitente."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">CARGO REMITENTE</span></font></td>
        <td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <div id="div_eje_cargo"><input type="text" name="x_cargoejecutor" id="x_cargoejecutor" size=53 value=""></div>
        </font></td>                
        <td class="encabezado" title="Tel&eacute;fono del remitente."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">TEL&Eacute;FONO REMITENTE</span></font></td>
        <td bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <div id="div_eje_telefono"><input type="text" name="x_telefonoejecutor" id="x_telefonoejecutor" value=""></div>
        </font></td>         
        </tr>
             <tr>
        <td class="encabezado" title="Organizaci&oacute;n a la que pertenece el remitente."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">EMPRESA REMITENTE</span></font></td>
        <td colspan="4" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <div id="div_eje_empresa"><input type="text" name="x_empresaejecutor" id="x_empresaejecutor" size=53 value=""></div>
        </font></td>        
        </tr>     
        <tr>
        <td class="encabezado" title="Direcci&oacute;n del remitente."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">DIRECCI&Oacute;N REMITENTE</span></font></td>
        <td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <div id="div_eje_direccion"><input type="text" name="x_direccionejecutor" id="x_direccionejecutor" size=53 value=""></div>
        </font></td>       
        <td class="encabezado" title="Correo electr&oacute;nico o email del remitente."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">EMAIL REMITENTE</span></font></td>
        <td bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <div id="div_eje_email"><input type="text" name="x_emailejecutor" id="x_emailejecutor" size=53 value=""></div>
        </font></td> 
        </tr>
        <tr>
        <td class="encabezado" title="C&oacute;digo del remitente."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">C&Oacute;DIGO REMITENTE</span></font></td>
        <td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <div id="div_eje_direccion"><input type="text" name="x_codigoejecutor" id="x_codigoejecutor" size=53 value=""></div>
        </font></td>
        <td bgcolor="#F5F5F5" colspan="2"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"></font></td>        
        </tr>    
      <tr> 
        <td height="62" class="encabezado" title="Breve resumen del contenido del documento."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF;">DESCRIPCI&Oacute;N 
          O ASUNTO *</span></font></td>
        <td colspan="4" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span > 
          <textarea cols="53" rows="3" id="x_descripcion" name="x_descripcion"><?php echo @$_REQUEST["descripcion"];  ?></textarea>
          </span></font></td>
    </tr>
    <tr> 
      <td height="62" class="encabezado" title="D&iacute;as de entrega del documento"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF;">TIEMPO DE RESPUESTA (D&Iacute;AS)</span></font></td>
        <td colspan="4" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span >
        <select id="dias" name="x_dias"><option value="0">..</option>
        <?php
        $dias="";
        for($i=0; $i<10; $i++)
         $dias .= "<option value='".($i+1)."'>".($i+1)."</option>";
        echo $dias;         
        ?>
        </select>
        </span> 
      </td>
    </tr>  	  
    <tr> 
        <td height="65" class="encabezado" title="Tipo de anexos con los que viene documento."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF;">ANEXOS F&Iacute;SICOS</span></font></td>
        <td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span > 
         <select name="x_anexo"><option value=''>Seleccionar...</option>
         <?php    
       
          $lis_anexos = array("CD-ROM","DISKETE","DVD","DOCUMENTO","FAX","REVISTA O LIBRO","VIDEO","OTROS ANEXOS..."); 
          for($i=0; $i<count($lis_anexos); $i++) 	  
        	{
           $anexo_list .= "<option value=\"". $lis_anexos[$i]."\">".$lis_anexos[$i]."</option>";		
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
         <td colspan="4" class="celda_transparente" bgcolor="#F5F5F5"><input type="file" name="anexos[]" class="multi" accept="<?php echo $extensiones;?>"></td>
         
      </tr>
    <tr>
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
    			tree2.loadXML("test.php");
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
      </td>
    </tr>
    <tr>
<td class="encabezado" title="Selecciona un funcionarios, si desea hacer una copia del documento"><span class="phpmaker" style="color: #FFFFFF;">COPIA A </span></td>
	<td bgcolor="#F5F5F5" colspan="4"><span class="phpmaker">
	<div id="treeboxbox_tree_copia"></div>				
	<script type="text/javascript">
  <!--					
			tree_copia=new dhtmlXTreeObject("treeboxbox_tree_copia","100%","100%",0);
			tree_copia.setImagePath("imgs/");
			tree_copia.enableIEImageFix(true);
			tree_copia.enableCheckBoxes(1);
			tree_copia.enableThreeStateCheckboxes(true);
			tree_copia.setXMLAutoLoading("test.php");
			tree_copia.loadXML("test.php");
  -->					
	</script>
	</td></tr>
    <tr> 
        <td height="65" class="encabezado" title="Flujo al que pertenece el documento."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF;">FLUJO O CIRCUITO</span></font></td>
        <td colspan="4" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span > 
         <select name="x_flujo"><option value=''>Seleccionar...</option>
         <?php    
           $flujos="";
           $lista_flujos=busca_filtro_tabla("","diagram","publico=1","",$con);
		   
          for($i=0; $i<$lista_flujos["numcampos"]; $i++){
          	$check = '';
			if($lista_flujos[$i]["id"] == 3){
				$check = "selected";
			}
            $flujos .= "<option value=\"". $lista_flujos[$i]["id"]."\" ".$check.">".$lista_flujos[$i]["title"]."</option>";        
          }
          echo $flujos; 
        //}
         ?> 
          </select></td>
      </tr>
      <tr> 
        <td class="encabezado" title="Utilizar el esc&aacute;ner para digitalizar el documento que se est&aacute; radicando"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">ESCANEAR  FOLIOS DEL DOCUMENTO</span></font></td>
        <td bgcolor="#F5F5F5" colspan="2"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span > 
          SI 
          <input type="radio" name="x_escaneo" value=1  CHECKED>
          NO 
          <input type="radio" name="x_escaneo" value=0>
          </span></font></td>
        <td class="encabezado" ><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">N&Uacute;MERO          FOLIOS DEL DOCUMENTO</span></font>  
        </td>    
        <td bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span > 
          <input type="text" name="x_paginas" id="x_paginas" >
          </span></font>
        </td>
      </tr>    
      <tr>                 
        <td colspan="6" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span > 
          <input type="button" name="Action" id="Action" value="CONTINUAR" class="buttonSubmit">
          </span></font></td>
      </tr>
      <!--input type="hidden" name="x_paginas" value=1-->
	  <?php if(isset($_REQUEST["idmensaje"]))
	  echo '<input type="hidden" name="idmensaje" value="'.$_REQUEST["idmensaje"].'">';
	  ?>      
    </table>
  </form>
<div id="stylesheetTest"></div>  
</div>
<?php include ("footer.php") ?>
<?php

/*
<Clase>
<Nombre>
<Parametros>
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function LoadData($sKey,$conn)
{
	global $_SESSION;
	global $x_serial;
	global $x_numero;
	global $x_serie;
	global $x_fecha;
	global $x_ejecutor;
	global $x_descripcion;
  global $x_descripcion_anexo;
	global $x_municipio;
	global $x_paginas,$x_oficio,$x_fecha_oficio,$x_dias, $x_flujo;
	
	$sKeyWrk = "" . ($sKey) . "";
	$sSql = "SELECT * FROM documento A";
	$sSql .= " WHERE A.serial = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or error("PROBLEMAS AL EJECUTAR LA B�QUEDA" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$x_serial = $row["iddocumento"];
		$x_numero = $row["numero"];
		$x_serie = $row["serie"];
		$x_fecha = $row["fecha"];
		$x_ejecutor = $row["ejecutor"];
		$x_descripcion = $row["descripcion"];
		$x_paginas = $row["paginas"];
		$x_municipio = $row["municipio_idmunicipio"];
		$x_oficio = $row["oficio"];
		$x_fecha_oficio = $row["fecha_oficio"];
		$x_dias = $row["dias"];
		$x_descripcion_anexo = $row["descripcion_anexo"];
		$dato_flujo=busca_filtro_tabla("","paso_documento A,paso B","A.paso_idpaso=B.idpaso AND documento_iddocumento=".$row["iddocumento"],"",$conn);
    if($dato_flujo["numcampos"]){
        $x_flujo=$dato_flujo[0]["diagram_iddiagram"];
    }
    else $x_flujo= Null;
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
<?php
/*
<Clase>
<Nombre>
<Parametros>
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function AddData($conn)
{
	global $_SESSION, $_POST, $_POST_FILES, $_ENV, $x_dependencia_iddependencia, $x_serie;	
	global $x_ejecutor, $x_descripcion, $x_municipio_idmunicipio, $municipio_ext, $x_oficio,$x_fecha_oficio,$x_fecha, $x_anexo,$x_paginas;
	global $x_descripcion_anexo, $x_dias, $x_archivos, $x_funcionario_destino, $x_flujo,$x_copia;
	
	// Add New Record
	$sSql = "SELECT * FROM documento A";
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
	$fieldList=array();
  $destinos=array();
  
  //Genera un envio a la Entidad como minimo....
  $destinos[0]["valor"]=1;
  $destinos[0]["tipo"]="dependencia";

	// Campo serie
	if($x_serie<>"")
	 $fieldList["serie"] = $x_serie;

	// Campo fecha
	/*$theValue = ($x_fecha != "") ?  ConvertDateToMysqlFormat(date('Y/m/d H:i:s'))  :  ConvertDateToMysqlFormat(date('Y/m/d H:i:s'));*/
	$fieldList["fecha"] = fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s');//"TO_DATE('".$theValue."','YYYY-MM-DD HH24:MI:SS')";

	// Campo fecha Oficio
	$theValue = ($x_fecha_oficio != "") ?  ConvertDateToMysqlFormat($x_fecha_oficio) :  ConvertDateToMysqlFormat($x_fecha_oficio);
	if($theValue<>"")
	$fieldList["fecha_oficio"] = fecha_db_almacenar($theValue,'Y-m-d H:i:s');//"TO_DATE('".$theValue."','YYYY-MM-DD HH24:MI:SS')";

  //Campo Numero de Oficio
	$theValue = (!get_magic_quotes_gpc()) ? ($x_oficio) : $x_oficio; 
	$theValue = ($theValue != "") ? $theValue:NULL;
	$fieldList["oficio"] = "'".$theValue."'";
	
  //Campo Ejecutor
// 	$theValue = (!get_magic_quotes_gpc()) ? intval($x_ejecutor) : "NULL"; 
	$fieldList["ejecutor"] = $x_ejecutor;
  	
  
  $ejecutor[0]["valor"]=$x_ejecutor;
	$ejecutor[0]["tipo"]='ejecutor';
	
  // Campo descripcion
	$theValue = str_replace("'","",$x_descripcion);
	$theValue = ($theValue != "") ? "'".$theValue."'":"NULL";
	$fieldList["descripcion"] = $theValue;
	
	 // Campo anexo
	$theValue = str_replace("'","",$x_anexo);
	$theValue = ($theValue != "") ? "'".$theValue."'":"NULL";
	$fieldList["anexo"] = $theValue;
	
	 // Campo descripcion anexo
	$theValue = str_replace("'","",$x_descripcion_anexo);
	$theValue = ($theValue != "") ? "'".$theValue."'":"NULL";
	$fieldList["descripcion_anexo"] = $theValue;
	
	// Campo dias 
	$theValue = str_replace("'","",$x_dias);
	$theValue = ($theValue != "") ? $theValue:"NULL";
	$fieldList["dias"] = $theValue;
	
	// Campo paginas 
	$theValue = str_replace("'","",$x_paginas);
	$theValue = ($theValue != "") ? $theValue:"NULL";
	$fieldList["paginas"] = $theValue;
	
	$fieldList["municipio_idmunicipio"] = $x_municipio_idmunicipio;
  // Campo Municipio_exterior
	if($municipio_ext<>"")
	{$theValue = ($municipio_ext != "") ? intval($municipio_ext) : "NULL";
	 $sql_insert = "INSERT INTO municipio_exterior(nombre,departamento_iddepartamento) VALUE ('$municipio_ext',0)";
	 $id = ejecuta_sql($sql_insert,$conn);
	 $fieldList["municipio_idmunicipio"] = (2000+$id);
	}	
	//print_r($fieldList);die();
  $x_archivos=NULL; // OJO  LOS ARCHIVOS YA NO LOS PROCESA UN IFRAME
  $fieldList["estado"] = "'APROBADO'"; 
  $idpaso=Null;
  $doc=radicar_documento_prueba("radicacion_entrada",$fieldList,$x_archivos,$x_flujo);    
  if(!$doc)
    alerta("No se pudo radicar el documento");
   include_once("anexosdigitales/funciones_archivo.php");
  if(isset($_REQUEST["permisos_anexos"]))
   $permisos=$_REQUEST["permisos_anexos"];
  else 
   $permisos=NULL;
   cargar_archivo($doc,$permisos); // Sube los anexos digitales
  //para asociarlo con el email si existe
  if(isset($_REQUEST["idmensaje"]) && $_REQUEST["idmensaje"]<>"")
  	{$sql="update ft_mensaje set documento_iddocumento=$doc where idft_mensaje=".$_REQUEST["idmensaje"];
	 $rs=phpmkr_query($sql,$conn)or error("No se pudo relacionar el mensaje con el documento.");
	 $sql="update documento set plantilla='MENSAJE',estado='APROBADO' where iddocumento=$doc";
	 $rs=phpmkr_query($sql,$conn)or error("No se pudo actualizar el tipo de plantilla.");
	}	  
	//die("doc: ".$doc);
			
   
  return $doc;
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
      {$dep=busca_filtro_tabla("*","departamento","pais_idpais=".$pais[$i]["idpais"],"nombre asc",$conn);              
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
