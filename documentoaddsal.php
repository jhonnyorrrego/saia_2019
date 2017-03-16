<?php include_once("db.php");?>
<?php include_once("class_transferencia.php");?>
<?php
//sesion();
 
include_once("class.funcionarios.php");
include_once("formatos/librerias/header_formato.php");
global $conn;
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
		lleno=EW_checkMyForm(window.document.documentoaddsal);
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
        '$codigo='+$("#x_codigoejecutor").val()+
        '&campos=nombre,identificacion,cargo,empresa,direccion,telefono,email,codigo',
        success: function(datos,exito){
          valores=datos.split('|');
          $("#ejecutor").val(valores[0]);
          $("#documentoaddsal").submit();
        }
      });
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
$x_paginas = Null;
$x_destino = Null;
$x_funcionario_idfuncionario=Null;
$x_dependencia_iddependencia=1;
$x_municipio_idmunicipio=Null;
$x_departamento=Null;
$x_nombre1 = Null;
$x_tipoejecutor =Null;
$x_dependencia_destino=Null;
$x_escaneo= Null;
$x_archivos= Null;
$x_anexo = Null;
$x_descripcion_anexo = Null;
$x_tipo_despacho= Null;
$x_mensajero = Null;
$ciudad_empresa = busca_filtro_tabla("c.valor,m.nombre as ciudad","configuracion c, municipio m","c.nombre='ciudad' and m.idmunicipio=c.valor","",$conn);

?>
<?php include ("phpmkrfn.php"); 
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
{
	// Get fields from form
	$x_iddocumento = @$_POST["x_iddocumento"];
	$x_numero = @$_POST["x_numero"];
	$x_serie = @$_POST["x_serie"];
	$x_fecha = @$_POST["x_fecha"];
	$x_archivos = @$_POST["archivos"];
	$x_tipoejecutor=@$_POST["x_tipoejecutor"];
		/////////////////Nuevos para el ejecutor////////////////////////
  	$x_nitejecutor2 = @$_POST["x_nitejecutor2"];
    $x_cargoejecutor = @$_POST["x_cargoejecutor"];
    $x_ciudadejecutor = @$_POST["x_ciudadejecutor"];
    $x_direccionejecutor = @$_POST["x_direccionejecutor"];
    $x_telefonoejecutor = @$_POST["x_telefonoejecutor"];
  	$x_empresaejecutor = @$_POST["x_empresaejecutor"];
  	$x_codigoejecutor = @$_POST["x_codigo"];
    $x_emailejecutor = @$_POST["x_emailejecutor"]; 
    ////////////////////////////////////////////////////////////
  if(isset($_POST["x_funcionario_idfuncionario"])&&$_POST["x_funcionario_idfuncionario"]<>"")
	 $x_ejecutor = @$_POST["x_funcionario_idfuncionario"];
  else if(isset($_POST["x_ejecutor2"])&&$_POST["x_ejecutor2"]<>""){
    $x_ejecutor=$_POST["ejecutor"];
  }   	
  $x_descripcion = @$_POST["x_descripcion"];
	$x_paginas = @$_POST["x_paginas"];
	$x_dependencia_iddependencia = @$_POST["x_dependencia_iddependencia"];
	$x_tipo_despacho = @$_POST["x_tipo_despacho"];
  $x_mensajero = @$_POST["x_mensajero"];
  $x_anexo = @$_POST["x_anexo"];
  $x_descripcion_anexo = @$_POST["x_descripcion_anexo"];	
	
?>
<script language="javascript">
//pila();
</script>
<?php
	$x_municipio_idmunicipio = @$_POST["municipio"];
	if($x_municipio_idmunicipio==NULL)
	   $x_municipio_idmunicipio=$ciudad_empresa[0]["valor"];
	$x_escaneo=@$_POST["x_escaneo"];
}
switch ($sAction)
{
	case "A": // Add
		if ($doc=AddData($conn)) { // Add New Record
      if($doc)
        $docu=$doc;
      else  
        $docu=$x_iddocumento;			
      if($x_escaneo==1){
        $location="colilla.php?enlace=paginaadd.php&key=".$docu;
      }
      else {
        $location="colilla.php?enlace=documentoaddsal.php&key=".$docu;
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
<script language=\"JavaScript1.2\">
var digitos=100 //cantidad de digitos buscados
var puntero=0
var buffer=new Array(digitos) //declaraci�n del array Buffer
var cadena=""

function buscar_op(obj){
   var letra = String.fromCharCode(event.keyCode)
   if(puntero >= digitos){
       cadena="";
       puntero=0;
    }
   //si se presiona la tecla ENTER, borro el array de teclas presionadas y salto a otro objeto...
   if (event.keyCode == 13){
       borrar_buffer();
    }
   //sino busco la cadena tipeada dentro del combo...
   else{
       buffer[puntero]=letra;
       //guardo en la posicion puntero la letra tipeada
       cadena=cadena+buffer[puntero]; //armo una cadena con los datos que van ingresando al array
       puntero++;

       //barro todas las opciones que contiene el combo y las comparo la cadena...
       for (var opcombo=0;opcombo < obj.length;opcombo++){
          if(obj[opcombo].text.substr(0,puntero).toLowerCase()==cadena.toLowerCase()){
          obj.selectedIndex=opcombo;
          }
       }
    }
   event.returnValue = false; //invalida la acci�n de pulsado de tecla para evitar busqueda del primer caracter
}

function borrar_buffer(){
   //inicializa la cadena buscada
    cadena="";
    puntero=0;
}
</script>
<script type="text/javascript">
<!--

function EW_checkMyForm(EW_this) {
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
 document.documentoaddsal.x_dependencia_iddependencia.value=list_funcionario;        	

if (EW_this.x_numero && !EW_hasValue(EW_this.x_numero, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_numero, "TEXT", "POR FAVOR INGRESE EL CAMPO REQUERIDO - NUMERO DE RADICACION."))
		return false;
}
if (EW_this.x_ejecutor2 && !EW_hasValue(EW_this.x_ejecutor2, "TEXT" )) {		
	       alert("POR FAVOR INGRESE EL CAMPO REQUERIDO - EJECUTOR O NOMBRE Y APELLIDO DE QUIEN ENVIA EL DOCUMENTO.");
    return false;
}		
if (EW_this.x_descripcion && !EW_hasValue(EW_this.x_descripcion, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_descripcion, "TEXT", "POR FAVOR INGRESE EL CAMPO REQUERIDO - ASUNTO DEL DOCUMENTO"))
		return false;
}
if(EW_this.x_nom_serie.value=="" && document.getElementById('serie').value!='')
   document.getElementById('x_serie').value=document.getElementById('serie').value;
		
return true;
}

-->
</script>

<script type="text/javascript" src="popcalendar.js"></script>
<script type="text/javascript" src="js/dynamicoptionlist.js"></script>
<body onLoad="initDynamicOptionLists()">
<p><span class="internos"><img class="imagen_internos" src="botones/general/radicacion_salida.png" border="0">&nbsp;&nbsp;RADICACI&Oacute;N DE DOCUMENTOS DE SALIDA</p>
<!--font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span > <a href="documentolistsal.php">IR 
AL LISTADO</a></span> </font-->
<form name="documentoaddsal" id="documentoaddsal" action="documentoaddsal.php" method="post" >
  <p> <font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
    <input type="hidden" name="a_add" value="A">
          <input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''>
    </font>
  <table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
    <!--tr> 
      <td class="encabezado"><span  style="color: #FFFFFF;">NUMERO 
        DE RADICACION</span></td>
      <td bgcolor="#F5F5F5"><span > 
        <input type="text" name="x_numero" id="x_numero" size="30" maxlength="50" value="<?php echo htmlspecialchars(@$x_numero) ?>">
        </span></td>
    </tr-->
    <tr> 
      <td width="209" class="encabezado" title="Fecha en que se genera el documento."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">FECHA DE RADICACI&Oacute;N</span></font></td>
      <td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span > 
        <?php if (!($x_fecha != NULL) || ($x_fecha == "")) { $x_fecha = date('Y/m/d H:i:s');} // Set default value ?>
        <?php echo date('Y/m/d H:i:s'); ?> 
        <input type="hidden" name="x_fecha" value="<?php echo FormatDateTime(@$x_fecha,0); ?>">
        &nbsp; </span></font></td>
      <td width="135" class="encabezado" title="N&uacutemero de radicado asignado al documento"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">N&Uacute;MERO 
        DE RADICADO</span></font></td>
      <td width="127" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><?php echo muestra_contador("radicacion_salida"); ?></font></td>
    </tr>
    <tr> 
      <td class="encabezado" title="Ciudad a la cual pertenece la persona natural o jur&iacute;dica a la que se le env&iacute;a el documento."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF">CIUDAD DESTINO </span></font></td>
      <td colspan="4" bgcolor="#F5F5F5"> <font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"> 
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
      </td>
    </tr>
    <tr> 
              <td class="encabezado" title="Dependencia que es responsable del documento a despachar."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">AREA RESPONSABLE DEL DOCUMENTO *
        </span></font></td>
  <link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>        
        <td bgcolor="#F5F5F5" colspan="4" ><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
Buscar: <input type="text" id="stext_responsable" width="200px" size="25">
<a href="javascript:void(0)" onclick="tree3.findItem((document.getElementById('stext_responsable').value),1)"><img src="botones/general/anterior.png" alt="Buscar Anterior" border="0px"></a>
<a href="javascript:void(0)" onclick="tree3.findItem((document.getElementById('stext_responsable').value),0,1)"><img src="botones/general/buscar.png" alt="Buscar" border="0px"></a>
    <a href="javascript:void(0)" onclick="tree3.findItem((document.getElementById('stext_responsable').value))"><img src="botones/general/siguiente.png" alt="Buscar Siguiente" border="0px"></a>
    <br />
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
        </td>   
    </tr>
		<tr> 
        <td rowspan="2" class="encabezado" title="Seleccione el tipo de documento de acuerdo a los tipos documentales de la Organizaci&oacute;n."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">CLASIFICACI&Oacute;N DEL DOCUMENTO</span></font></td>
        <td colspan="4" bgcolor="#F5F5F5">        
        <meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
	<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">	
	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
Buscar: <input type="text" id="stext_serie" width="200px" size="25">
<a href="javascript:void(0)" onclick="tree_serie.findItem((document.getElementById('stext_serie').value),1)"><img src="botones/general/anterior.png" alt="Buscar Anterior" border="0px"></a></a>
<a href="javascript:void(0)" onclick="tree_serie.findItem((document.getElementById('stext_serie').value),0,1)"><img src="botones/general/buscar.png" alt="Buscar" border="0px"></a>  
    <a href="javascript:void(0)" onclick="tree_serie.findItem((document.getElementById('stext_serie').value))"><img src="botones/general/siguiente.png" alt="Buscar Siguiente" border="0px"></a><br />
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
                      tree_serie.loadXML("test_serie.php?tabla=serie&estado=1");
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
            </td></tr><tr>
         <td colspan="4" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <BR><BR><div id="lista3" onmouseout="v=1;" onmouseover="v=0;">
           <div id="div_nomserie"><input type="text" size=53 name="x_nom_serie" id="auto3" autocomplete=off onkeyup="if(Teclados(event,'3') == 1){ autocompletar('3',auto3.value);Action.disabled=true;}" onkeydown = "ParaelTab(event,'3')" onfocus="document.getElementById('comple3').style.visibility='visible';" onblur="document.getElementById('Action').disabled=false;"></div>
           </div><div id="comple3" name="comple3" style="position:absolute" onmouseout="document.getElementById('comple3').style.display='none';Action.disabled=false;"></div>

               <input type="hidden" name="x_serie" id="x_serie">
               <BR><BR></td></tr>
      <!------------------------------------------------------------------------------------>
      
      
      <!----------------------------------------------------------------------------------------------------------------------->
      <!----------------------------------------------------------------------------------------------------------------------->
      <!--Esto es para los ejecutores, en la parte de energia quedan diferentes-->
      <tr> 
              <td class="encabezado" title="Persona jur&iacute;dica (empresa) a la que se env&iacute;a el documento"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF">EMPRESA-PERSONA 
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
        <tr>
        <td class="encabezado" title="C&oacute;digo del remitente."><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">C&Oacute;DIGO REMITENTE</span></font></td>
        <td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <div id="div_eje_direccion"><input type="text" name="x_codigoejecutor" id="x_codigoejecutor" size=53 value=""></div>
        </font></td>
        <td bgcolor="#F5F5F5" colspan="2"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"></font></td>        
        </tr> 
     
      <!----------------------------------------------------------------------------------------------------------------------->
      <!----------------------------------------------------------------------------------------------------------------------->
    <tr> 
      <td height="62" class="encabezado" title="Breve resumen del contenido del documento"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF;">DESCRIPCI&Oacute;N 
        O ASUNTO *</span></font></td>
      <td colspan="4" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span > 
        <textarea cols="53" rows="3" id="x_descripcion" name="x_descripcion"><?php echo @$x_descripcion; ?></textarea>
        </span></font></td>
    </tr>
   
      <!--tr>
        <td class="encabezado" title="Lista de archivos anexos">
          <font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <span  style="color: #FFFFFF;">ARCHIVOS ANEXOS</span>
          </font>
        </td>
        <td colspan=4 bgcolor="#F5F5F5">
          <font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <span -->
          		  <?php /*
		  if(isset($_REQUEST["archivos"]) && $_REQUEST["archivos"]<>"")
		  	{
         echo "<input type='hidden' name='archivos' id='archivos' value='".$_REQUEST["archivos"]."'>
               <div id='mostrar_archivos'>";
			 $archivos=explode(",",$_REQUEST["archivos"]);
			 foreach($archivos as $fila)          
			 	{echo "<li>$fila</li>";
				}
             echo "</div>";
			 
			}
			else 
			  {echo "<input type='hidden' name='archivos' id='archivos' value=''>
               <div id='mostrar_archivos'></div>";
        }               */
		  ?> </span></font>
      <!--/td>
      </tr-->
            <tr> 
        <td height="65" class="encabezado" title="Tipo de anexos al documento"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF;">ANEXOS AL DOCUMENTO</span></font></td>
        <td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span > 
         <select name="x_anexo"><option value=''>Seleccionar...</option>
         <?php         
         $lis_anexos = array("PAPEL","FAX","CONSIGNACION","CONSIGNACION ORIGINAL", "DISKETES","CD-ROM","DVD","VIDEO","MICROFILMINAS"); 
          for($i=0; $i<count($lis_anexos); $i++) 	  
        	{
           $anexo_list .= "<option value=\"". $lis_anexos[$i]."\">".$lis_anexos[$i]."</option>";		
        	}
          echo $anexo_list;	
        //}
         ?> 
          </select></td></span>
           <td class="encabezado" title="Descripci&oacute;n de los anexos del documento, especificar la cantidad y el estado en que se encuentran los anexos"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">DESCRIPCI&Oacute;N DE ANEXO</span></font></td>
          <td bgcolor="#F5F5F5"><span class="phpmaker">
                    <textarea cols="53" rows="2" id="x_descripcion_anexo" name="x_descripcion_anexo"><?php echo @$x_descripcion_anexo; ?></textarea>
          </span></font></td>
      </tr>
            <tr> 
        <td class="encabezado" title="Seleccione el tipo de env&iacute;o: Mensajer&iacute;a Externa, Mensajer&iacute;a Interna o Entrega Personal"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span>
        <span  style="color: #FFFFFF;">TIPO DE MENSAJER&Iacute;A</span>
            </font>
        </td>
        <td colspan=3 bgcolor="#F5F5F5">
          <font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <span >  
          Mensajer&iacute;a Externa 
          <input type="radio" name="x_tipo_despacho" value="1" CHECKED OnClick="muestra_mensajero(0);"><br />
          Mensajer&iacute;a Interna
          <input type="radio" name="x_tipo_despacho" value="2" OnClick="muestra_mensajero(1);"><br />
          Entrega Personal&nbsp;&nbsp;&nbsp;
          <input type="radio" name="x_tipo_despacho" value="3" OnClick="muestra_mensajero(0);">        
          </span></font></td>
          <td bgcolor="#F5F5F5">
          <div name="mensajero" id="mensajero" style="visibility:hidden;">
              <?php
              $mensajero=array();
              $mensajero=busca_funcionarios("cargo","mensajero");
              $nmensajeros=count($mensajero);
              if($nmensajeros){
                echo('Mensajeros:<br /><br><select name="x_mensajero" id="x_mensajero">');
                for($i=0;$i<$nmensajeros;$i++){
                $dato_mensajero=busca_filtro_tabla("A.idfuncionario,".concatenar_cadena_sql(array("A.nombres","' '","A.apellidos"))." as nombre","funcionario A","A.idfuncionario=".$mensajero[$i],"",$conn);
                //redirecciona(implode("-",$dato_mensajero));
                if($dato_mensajero["numcampos"])              
                  echo("<option value=".$dato_mensajero[0]["idfuncionario"].">".$dato_mensajero[0]["nombre"]."</option>");
                }
                echo('</select>');
              }
              else
                echo "No existen mensajeros registrados.";
              ?>
          </div>
         </td> 
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
	global $x_paginas; 
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
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$x_iddocumento = $row["iddocumento"];
		$x_numero = $row["numero"];
		$x_serie = $row["serie"];
		$x_fecha = $row["fecha"];
		$x_ejecutor = $row["ejecutor"];
		$x_descripcion = $row["descripcion"];
		$x_paginas = $row["paginas"];
			$x_descripcion_anexo = $row["descripcion_anexo"];
		$x_tipo_despacho = $row["tipo_despacho"];

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
	global $_SESSION;
	global $_POST;
	global $_POST_FILES;
	global $_ENV;
  global $x_dependencia_iddependencia;
  global $usuactual; 
  global $x_serie;
	global $x_ejecutor;
	global $x_descripcion;
	global $x_municipio_idmunicipio;
	global $x_archivos;
	global $x_fecha;
	global $x_anexo;
	global $x_descripcion_anexo;
	global $x_tipo_despacho;
	global $x_mensajero,$x_paginas;

	// Add New Record
	$sSql = "SELECT A.* FROM documento A";
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
	$destinos=array();
	$destinos[0]["valor"]=$x_ejecutor;
	$destinos[0]["tipo"]=3; //ejecutor
	
	$ejecutor[0]["valor"]=$x_dependencia_iddependencia;
	$ejecutor[0]["tipo"]='dependencia';

	//print_r($destinos);
		// Campo serie
	$theValue = ($x_serie != "") ? intval($x_serie) : "'0'";
	$fieldList["serie"] = $theValue;

	// Campo fecha
	$theValue = ($x_fecha != "") ? date('Y-m-d H:i:s'):  date('Y-m-d H:i:s');
	$fieldList["fecha"] = fecha_db_almacenar($theValue,"Y-m-d H:i:s");

  
  // Campo descripcion
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_descripcion) : $x_descripcion; 
	$theValue = ($theValue != "") ? $theValue:"NULL";
	$fieldList["descripcion"] = "'".$theValue."'";

	// Campo Municipio
	$theValue = ($x_municipio_idmunicipio != "") ? intval($x_municipio_idmunicipio) : "NULL";
	$fieldList["municipio_idmunicipio"] = $theValue;
	
	// Campo Responsable
	//$responsable=busca_filtro_tabla("idfuncionario","funcionario","funcionario_codigo=".$_SESSION["usuario_actual"],"",$conn);
	$fieldList["responsable"] = $x_dependencia_iddependencia;
	$fieldList["tipo_despacho"] = $x_tipo_despacho;

		 // Campo anexo
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_anexo) : $x_anexo; 
	$theValue = ($theValue != "") ? "'".$theValue."'":"NULL";
	$fieldList["anexo"] = $theValue;
	// Campo Paginas 
	$theValue = str_replace("'","",$x_paginas);
	$theValue = ($theValue != "") ? $theValue:"NULL";
	$fieldList["paginas"] = $theValue;
	 // Campo descripcion anexo
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_descripcion_anexo) : $x_descripcion_anexo; 
	$theValue = ($theValue != "") ? "'".$theValue."'":"NULL";
	$fieldList["descripcion_anexo"] = $theValue;	
	if($ejecutor[0]["tipo"]=="dependencia") 
    $enviar="D(".$ejecutor[0]["valor"].")";
  else if($ejecutor[0]["tipo"]=="ejecutor")
      $enviar="E(".$ejecutor[0]["valor"].")";
  else if($ejecutor[0]["tipo"]=="funcionario")
      $enviar="F(".$ejecutor[0]["valor"].")"; 
  else $enviar="0(".$ejecutor[0]["valor"].")";	
	 	$theValue = (!get_magic_quotes_gpc()) ? intval($x_dependencia_iddependencia) : "NULL"; 
	$fieldList["ejecutor"] = "'".$x_ejecutor."'";	
	
	$doc=radicar_documento_prueba("radicacion_salida",$fieldList,$x_archivos);
	$conf = busca_filtro_tabla("funcionario_codigo","configuracion,funcionario","login like valor and nombre like 'radicador_salida'","",$conn);	
	$destino[0] = $conf[0]["funcionario_codigo"];
	$datos["nombre"]='TRANSFERIDO';
	$datos["archivo_idarchivo"]=$doc;
	$datos["tipo_destino"]=1;	
	transferir_archivo_prueba($datos,$destino,"");
		//$doc=radicar_documento_prueba("prueba",$fieldList,$x_archivos);


	//si el tipo de despacho es personal se cambia el valor del mensajero por el del ejecutor
	///tipo de despacho mensajeria interna
	if($x_tipo_despacho==2){
    $sql="INSERT INTO salidas(documento_iddocumento,responsable,tipo_despacho) VALUES(".$doc.",".$x_mensajero.",'2')";
    phpmkr_query($sql,$conn);
  }	///tipo de despacho personal
  elseif($x_tipo_despacho==3){
    $sql="INSERT INTO salidas(documento_iddocumento,responsable,tipo_despacho) VALUES(".$doc.",".$x_ejecutor.",'3')";
    phpmkr_query($sql,$conn);
  }
  //transferir_archivo_prueba($doc,$destinos[0]["valor"],$fieldList["serie"],$destinos[0]["tipo"],"DOCUMENTO","PRODUCCION","",$enviar);
	 //transferir_archivo($doc,$destino[$i]["valor"],$fieldList["serie"],$destino[$i]["tipo"],"PRODUCCION",$accion,"",$enviar);
	//imprime_error();

  return $doc;
}

function ad_nombre($cad,$tipo)
{
global $conn;
	$value=strtoupper($cad);
	$rs=phpmkr_query("SELECT * FROM nombre A WHERE A.valor ='".$value."' AND A.tipo='$tipo'" ,$conn)or error("NO SE ENCONTRO NOMBRE");;
      if(phpmkr_num_rows($rs)>0){
       $campo=phpmkr_fetch_array($rs)or error("CAMPO VACIO EN NOMBRE");
       return($campo[0]);
      }
      else phpmkr_query("INSERT INTO nombres(valor,tipo) VALUE('".$value."','".$tipo."')",$conn)or error("NO SE INSERTO NOMBRE");
      return(phpmkr_insert_id());
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
