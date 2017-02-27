<?php session_start(); ?>
<?php ob_start(); ?>
<?php

$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if(is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}

include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "formatos/librerias/header_formato.php");
include_once ($ruta_db_superior . "formatos/librerias/funciones.php");
include_once ($ruta_db_superior . "phpmkrfn.php");
include_once ($ruta_db_superior . "librerias_saia.php");
include_once ($ruta_db_superior . "librerias/funciones.php");

include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("key");
desencriptar_sqli('form_info'); 
echo(librerias_jquery());

// Initialize common variables
$x_idformato = Null;
$x_nombre = Null;
$x_etiqueta = Null;
$x_contador_idcontador = Null;
$x_ruta_mostrar = Null;
$x_ruta_editar = Null;
$x_ruta_adicionar = Null;
$x_librerias = Null;
$x_margenes = Null;
$x_orientacion = Null;
$x_papel = Null;
$x_exportar = Null;
$x_tabla = Null;
$x_detalle = Null;
$x_cod_padre = Null;
$x_item = Null;
$x_tipo_edicion = Null;
$x_mostrar = Null;
$x_paginar = Null;
$x_serie_idserie = Null;
$x_banderas = Null;
$x_font_size = Null;
$x_autoguardado = Null;
$x_mostrar_pdf = Null;
$enter2tab = Null;
$x_firma_digital = Null;
$x_flujo_idflujo = Null;
$x_fk_categoria_formato = Null;
$x_funcion_predeterminada = Null;
$x_pertenece_nucleo = Null;

if(isset($_REQUEST["consultar_contador"])) {
	consultar_contador();
	die();
}
?>
<?php



// Get action
$sAction = @$_POST["a_add"];
if(($sAction == "") || ((is_null($sAction)))) {
  $sKey=0;
	$sKey = @$_GET["key"];
	$sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;
	if($sKey != "") {
		$sAction = "C"; // Copy record
	} else {
		$sAction = "I"; // Display blank record
	}
} else {
	// Get fields from form
	$x_idformato = @$_POST["x_idformato"];
	$x_nombre = @$_POST["x_nombre"];
	$x_etiqueta = @$_POST["x_etiqueta"];
	$x_contador_idcontador = @$_POST["x_contador_idcontador"];
	$x_ruta_mostrar = @$_POST["x_ruta_mostrar"];
	$x_ruta_editar = @$_POST["x_ruta_editar"];
	$x_ruta_adicionar = @$_POST["x_ruta_adicionar"];
	$x_librerias = @$_POST["x_librerias"];
	$x_encabezado = @$_POST["x_encabezado"];
	$x_cuerpo = @$_POST["x_cuerpo"];
	$x_pie_pagina = @$_POST["x_pie_pagina"];
	$x_margenes = @$_POST["x_mizq"] . "," . @$_POST["x_mder"] . "," . @$_POST["x_msup"] . "," . @$_POST["x_minf"];
	$x_orientacion = @$_POST["x_orientacion"];
	$x_papel = @$_POST["x_papel"];
	$x_detalle = @$_POST["x_detalle"];
	$x_item = @$_POST["x_item"];
	$x_mostrar = @$_POST["x_mostrar"];
	$x_paginar = @$_POST["x_paginar"];
	$x_exportar = @$_POST["x_exportar"];
	$x_tabla = @$_POST["x_tabla"];
	$x_tipo_edicion = @$_POST["x_tipo_edicion"];
	$x_serie_idserie = @$_POST["x_serie_idserie"];
	$x_serie_banderas = @$_POST["x_banderas"];
	$x_font_size = @$_POST["x_font_size"];
	$x_autoguardado = @$_POST["x_autoguardado"];
	$x_mostrar_pdf = @$_POST["x_mostrar_pdf"];
	$enter2tab = @$_POST["enter2tab"];
	$x_banderas = @$_POST["x_banderas"];
	$x_firma_digital = @$_POST["x_firma_digital"];
	$x_fk_categoria_formato = @$_POST["x_fk_categoria_formato"];
	$x_flujo_idflujo = @$_POST["x_flujo_idflujo"];
	$x_funcion_predeterminada = @$_POST["x_funcion_predeterminada"];
	$x_pertenece_nucleo = @$_POST["x_pertenece_nucleo"];
	if(isset($_POST["x_item"]))
		$x_item = @$_POST["x_item"];
	else
		$x_item = 0;
}
$x_cod_padre = @$_REQUEST["x_cod_padre"];

// $conn = phpmkr_db_connect(HOST, USER, PASS,DB);
switch($sAction) {
	case "C": // Get a record to display
		if(!LoadData($sKey, $conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "No Record Found for Key = " . $sKey;
			// //phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: formatolist.php");
			exit();
		}
		break;
	case "A": // Add
		if($llave = AddData($conn)) { // Add New Record
			$_SESSION["ewmsg"] = "Add New Record Successful";
			// //phpmkr_db_close($conn);
			ob_end_clean();
			if($x_cod_padre) {
				?>
<script type="text/javascript">
					window.parent.location.reload();
				</script>
<?php
			} else {
				redirecciona("detalle_formato.php?idformato=" . $llave . "&default_open=formatos/formatoadd_paso2.php");
				exit();
			}
		}
		break;
}
?>
<?php

include ("header.php");
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript" src="../js/cmxforms.js"></script>
<script type="text/javascript" src="../js/dhtmlXTree.js"></script>
<link rel="STYLESHEET" type="text/css" href="../css/dhtmlXTree.css">
<script type="text/javascript" src="../js/dhtmlXCommon.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<script type="text/javascript">
 $().ready(function() {
 	//Elimina espacios y convierte el texto en minuscula se valida que las teclas presionadas no sean caracteres especiales como flechas shift control y demas
 	$("#x_nombre").keyup(function(tecla){
 		var teclas_no=[16,17,18,20,37,38,39,40,127];
 		if(teclas_no.indexOf(tecla.keyCode)===-1){
 			var texto=$(this).val();
 			texto=texto.replace(/[^a-zA-Z0-9_]/,'');
 			$(this).val(texto.toLowerCase());
 		}
 	});
	// validar los campos del formato
	$('#formatoadd').validate({
		submitHandler: function(form) {
				<?php encriptar_sqli("formatoadd",0,"form_info",$ruta_db_superior);?>
			    form.submit();
			    
			  }
	});
	 	/*Valida que el nombre del campo no este repetido*/
 	$("#x_nombre").change(function(){
 		$.ajax({
           url: "validar_nombres.php?formato="+$("#x_nombre").val(),
           type: "POST",
           success : function(data){
           	if(data==1){
           		$("#action").attr("disabled",true);
           		alert("El formato ya existe. Por favor verifique.");
           	}else{
           		$("#action").attr("disabled",false);
           	}
           }
       	});
 	});
  
});
function actualizar_contador(valor)
{$.ajax({
  url: 'formatoadd.php', 
  data:'consultar_contador=1&idcontador='+valor,
  success: function(data) {
    if(data==1)
      $("#reiniciar_contador").attr("checked",true); 
    else
      $("#reiniciar_contador").attr("checked",false);
  }
 });
}
//-->
</script>
<style type="text/css">
.error {
	color: red;
	font-size: 12px
}
;
</style>
<p>
	<span class="phpmaker">Crear Formato<br> <br>

	</span>
</p>
<form name="formatoadd" id="formatoadd" action="formatoadd.php"
	method="post">
	<p>
		<input type="hidden" name="a_add" value="A">


	</p>
	<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Nombre*</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <input type="text"
					maxlength="20" name="x_nombre" id="x_nombre" class="required"
					value="<?php echo htmlspecialchars(@$x_nombre) ?>">
			</span></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Etiqueta*</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <input type="text"
					name="x_etiqueta" id="x_etiqueta"
					value="<?php echo htmlspecialchars(@$x_etiqueta) ?>"
					class="required">
			</span></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Formato
					Padre</span></td>
			<td bgcolor="#F5F5F5">
				<!--span class="phpmaker">
        <?php
								$formatos = busca_filtro_tabla("idformato,nombre,etiqueta", "formato A", "idformato<>" . $x_idformato, "nombre DESC", $conn);
								if($formatos["numcampos"]) {
									$inicio = '<SELECT name="x_cod_padre"><OPTION value="0">---Pertenece a la ra&iacute;z---</OPTION>';
									$fin = '</SELECT>';
								}
								for($i = 0; $i < $formatos["numcampos"]; $i++) {
									$check = "";
									if($formatos[$i]["idformato"] == $x_cod_padre) {
										$check = "SELECTED";
									}
									$inicio .= '<OPTION value="' . $formatos[$i]["idformato"] . '" ' . $check . ' >' . $formatos[$i]["etiqueta"] . '</OPTION>';
								}
								echo ($inicio . $fin);
								?>
      </span-->
				<div id="esperando_formato">
					<img src="<?php echo($ruta_db_superior);?>imagenes/cargando.gif"
						alt="">
				</div>
				<div id="treeboxbox_tree3" class="arbol_saia"></div> <input
				type="hidden" name="x_cod_padre" value="<?php echo($x_cod_padre);?>"
				id="x_cod_padre"> <script type="text/javascript">
      var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
      tree3=new dhtmlXTreeObject("treeboxbox_tree3","100%","100%",0);
      tree3.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
      tree3.enableIEImageFix(true);
      tree3.enableCheckBoxes(1);
			tree3.enableRadioButtons(true);
      tree3.setOnLoadingStart(cargando_serie);
      tree3.setOnLoadingEnd(fin_cargando_serie);
      tree3.setOnCheckHandler(onNodeSelect_tree3);
      <?php
						if($x_cod_padre) {
							echo ("tree3.setCheck('" . $x_cod_padre . "',true);\n");
						}
						?>
      tree3.loadXML("<?php echo($ruta_db_superior);?>test_serie.php?tabla=formato&seleccionado=<?php echo($x_cod_padre); ?>");
      function onNodeSelect_tree3(nodeId){
        if(nodeId=="<?php echo($x_idformato);?>"){
          alert("No es posible seleccionarse a si mismo como padre");
          tree3.setCheck(nodeId,false);
          return;
        }
        valor_destino=document.getElementById("x_cod_padre");
        if(tree3.isItemChecked(nodeId)){
          if(valor_destino.value!=="")
            tree3.setCheck(valor_destino.value,false);
          if(nodeId.indexOf("_")!=-1)
             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
          valor_destino.value=nodeId;
         }
       else
         {valor_destino.value="";
         }
      }
      function fin_cargando_serie() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_formato")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_formato")');
        else
           document.poppedLayer =
              eval('document.layers["esperando_formato"]');
        document.poppedLayer.style.visibility = "hidden";
      }
      
      function cargando_serie() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_formato")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_formato")');
        else
           document.poppedLayer =
               eval('document.layers["esperando_formato"]');
        document.poppedLayer.style.visibility = "visible";
      }              
    </script>
			</td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Contador</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_contador_idcontador)) || ($x_contador_idcontador == "")) { $x_contador_idcontador = 0;} // Set default value ?>
<?php

$x_contador_idcontadorList = "<select name=\"x_contador_idcontador\" id=\"x_contador_idcontador\" onchange=\"actualizar_contador(this.value)\">";
$x_contador_idcontadorList .= "<option value='0'>Crear Contador</option>";
$sSqlWrk = "SELECT DISTINCT idcontador, nombre FROM contador" . " ORDER BY nombre Asc";
$rswrk = phpmkr_query($sSqlWrk, $conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSqlWrk);
if($rswrk) {
	$rowcntwrk = 0;
	while($datawrk = phpmkr_fetch_array($rswrk)) {
		$x_contador_idcontadorList .= "<option value=\"" . htmlspecialchars($datawrk[0]) . "\"";
		if($datawrk["idcontador"] == @$x_contador_idcontador) {
			$x_contador_idcontadorList .= "' selected";
		}
		$x_contador_idcontadorList .= ">" . $datawrk["nombre"] . "</option>";
		$rowcntwrk++;
	}
}
@phpmkr_free_result($rswrk);
$x_contador_idcontadorList .= "</select>";
echo $x_contador_idcontadorList;
?>
<input type="checkbox" value="1" name="reiniciar_contador"
					id="reiniciar_contador">Reiniciar contador con el cambio de
					a&ntilde;o
			</span></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Serie
					Documental</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
			                
                            <?php
                            /*
								$formatos = busca_filtro_tabla("", "serie A", "1=1", "nombre DESC", $conn);
								if($formatos["numcampos"]) {
									$inicio = '<SELECT name="x_serie_idserie"><OPTION value="0">Sin Serie Documental</OPTION><OPTION value="" selected>Crear Serie Documental</OPTION>';
									$fin = '</SELECT>';
								}
								for($i = 0; $i < $formatos["numcampos"]; $i++) {
									$inicio .= '<OPTION value="' . $formatos[$i]["idserie"] . '">' . $formatos[$i]["nombre"] . "-e" . $formatos[$i]["codigo"] . '</OPTION>';
								}
								echo ($inicio . $fin);
								*/
							?>
					<input type="hidden" name="x_serie_idserie" id="x_serie_idserie">
					<input type="hidden" name="x_serie_idserie_uncheck" id="x_serie_idserie_uncheck">
					 <div id="esperando_serie"><img src="<?php echo($ruta_db_superior);?>imagenes/cargando.gif"></div>
					<div id="tree_serie_idserie" ></div> 
                    <script>
                        

			            tree2=new dhtmlXTreeObject("tree_serie_idserie","100%","100%",0);
			            tree2.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
			            tree2.enableTreeImages(false);
			            tree2.enableIEImageFix(true);
			            tree2.setXMLAutoLoadingBehaviour("id");
			            tree2.enableCheckBoxes(1);
			            tree2.enableRadioButtons(true);
			            tree2.setOnCheckHandler(onNodeSelect_serie_idserie);
			            tree2.setOnLoadingStart(cargando_serie_idserie);
                        tree2.setOnLoadingEnd(fin_cargando_serie_idserie);
		            	tree2.setXMLAutoLoading("<?php echo($ruta_db_superior);?>test_dependencia_serie.php?tabla=dependencia&sin_padre_dependencia=1&sin_padre=1&estado=1&carga_partes_dependencia=1&carga_partes_serie=1&mostrar_nodos=dsa,soc");
			            tree2.loadXML("<?php echo($ruta_db_superior);?>test_dependencia_serie.php?tabla=dependencia&sin_padre_dependencia=1&estado=1&carga_partes_dependencia=1&carga_partes_serie=1&mostrar_nodos=dsa,soc&sin_padre=1");
            			function onNodeSelect_serie_idserie(nodeId){
                            valor_destino=document.getElementById("x_serie_idserie_uncheck");
                            
                            
                            //es tipo_documental?
                            var datos=nodeId.split("-");
                            var datos2=nodeId.split("sub");
                            if(datos[1] || datos2[1]){
                                var dato=datos[1];
                                if(datos2[1]){
                                    dato=datos2[1];
                                }
                                
                            }                           
                            
                            if(tree2.isItemChecked(nodeId)){
                                
                                
                                if(valor_destino.value!==""){
                                    tree2.setCheck(valor_destino.value,false);
                                }
                                  

                                    
                              
                                valor_destino.value=nodeId;
                                $('#x_serie_idserie').val(dato);
                            }else{
                                valor_destino.value="";
                                 $('#x_serie_idserie').val('');
                            }
                            
                            
                        }
                        function fin_cargando_serie_idserie() {
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
            
                        function cargando_serie_idserie() {
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
                    </script>							
							
      </span></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">librer&iacute;as</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <input type="text"
					name="x_librerias" id="x_librerias"
					value="<?php echo htmlspecialchars(@$x_librerias) ?>">
			</span></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Tipo</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <input type="checkbox"
					name="x_item" id="x_item" value="1">Item <input type="checkbox"
					name="x_detalle" id="x_detalle" value="1">Detalle <input
					type="checkbox" name="x_tipo_edicion" id="x_tipo_edicion" value="1">Edicion
					Continua <input type="checkbox" name="x_banderas[]" id="x_banderas"
					value="e">Aprobacion Automatica <input type="checkbox"
					name="x_mostrar" id="x_mostrar" value="1" checked>Mostrar <br> <input
					type="checkbox" name="x_paginar" id="x_paginar" value="1" checked>Paginar
					al mostrar <input type="checkbox" name="x_banderas[]"
					id="x_banderas" value="r">Tomar el asunto del padre al responder<br>
					<!--input type="checkbox" name="x_firma_digital[]" id="x_firma_digital" value="1" >Estampar documento al aprobar-->
			</span></td>
		</tr>
		<tr></tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Tama&ntilde;o
					de letra</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <select
					name="x_font_size" id="x_font_size">
				<?php
				if(!$x_font_size)
					$x_font_size = 9;
				for($i = 7; $i < 31; $i++) {
					echo ('<option value="' . $i . '"');
					if($x_font_size == $i) {
						echo (' selected="selected" ');
					}
					echo ('>' . $i . '</option>');
				}
				?>
			</select>
			</span></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Margenes(Izq,
					Der, Sup, Inf)</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
		<?php

		function combo($seleccionado) {
			$combo_margenes = array(
					'0',
					'5',
					'10',
					'15',
					'20',
					'25',
					'30',
					'35',
					'40',
					'45',
					'50'
			);
			for($i = 0; $i < count($combo_margenes); $i++) {
				echo "<option value='" . $combo_margenes[$i] . "'";
				if($combo_margenes[$i] == $seleccionado)
					echo " selected ";
				echo ">" . $combo_margenes[$i] . "</option>";
			}
		}
		?>
		Izquierda <select name="x_mizq">
		<?php combo("15"); ?>
    </select> Derecha <select name="x_mder">
		<?php combo("20"); ?>    </select> Superior <select name="x_msup">
		<?php combo("30"); ?>    </select> Inferior <select name="x_minf">
		<?php combo("20"); ?>    </select>
			</span></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Usar
					la tecla enter para pasar de un campo a otro</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <input type="radio"
					name="enter2tab" value="0" <?php if(!$enter2tab) echo "checked";?>>No&nbsp;&nbsp;
					<input type="radio" name="enter2tab" value="1"
					<?php if($enter2tab) echo "checked";?>>Si
			</span></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Orientaci&oacute;n</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <input type="radio"
					name="x_orientacion" id="x_orientacion" value="0" checked="true">Vertical
					<input type="radio" name="x_orientacion" id="x_orientacion"
					value="1">Horizontal

			</span></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Tama&ntilde;o
					del Papel</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <select name="x_papel"
					id="x_papel">
						<option value="A4"
							<?php if(@$x_papel=="A4"){echo(' selected="selected"');}?>>A4</option>
						<option value="A5"
							<?php if(@$x_papel=="A5"){echo(' selected="selected"');}?>>Media
							Carta</option>
						<option value="letter"
							<?php if(@$x_papel=="letter"){echo(' selected="selected"');}?>>Carta</option>
						<option value="legal"
							<?php if(@$x_papel=="legal"){echo(' selected="selected"');}?>>Oficio</option>
				</select>
			</span></td>
		</tr>
		<tr>
			<td class="encabezado">Mostrar</td>
			<td bgcolor="#F5F5F5"><input type="radio" name="x_mostrar_pdf"
				value="1" checked> PDF <input type="radio" name="x_mostrar_pdf"
				value="0"> Html <input type="radio" name="x_mostrar_pdf" value="2">
				PDF Word</td>
		</tr>
		<tr>
			<td class="encabezado">Tiempo Autoguardado (ms)*</td>
			<td bgcolor="#F5F5F5"><input type="text" class="required"
				name="x_autoguardado" id="x_autoguardado" value="300000"></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">M&eacute;todo
					Exportar</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_exportar)) || ($x_exportar == "")) { $x_exportar = "pdf";} // Set default value ?>
<?php

$ar_x_exportar = explode(",", @$x_exportar);
$x_exportarChk = "";
$x_exportarChk .= "<input type=\"checkbox\" name=\"x_exportar[]\" value=\"" . htmlspecialchars("pdf") . "\"";
foreach($ar_x_exportar as $cnt_x_exportar) {
	if(trim($cnt_x_exportar) == "pdf") {
		$x_exportarChk .= " checked";
		break;
	}
}
$x_exportarChk .= ">" . "PDF" . EditOptionSeparator(0);
/*
 * $x_exportarChk .= "<input type=\"checkbox\" name=\"x_exportar[]\" value=\"" . htmlspecialchars("xls"). "\"";
 * foreach ($ar_x_exportar as $cnt_x_exportar) {
 * if (trim($cnt_x_exportar) == "xls") {
 * $x_exportarChk .= " checked";
 * break;
 * }
 * }
 * $x_exportarChk .= ">" . "Excel" . EditOptionSeparator(1);
 * $x_exportarChk .= "<input type=\"checkbox\" name=\"x_exportar[]\" value=\"" . htmlspecialchars("word"). "\"";
 * foreach ($ar_x_exportar as $cnt_x_exportar) {
 * if (trim($cnt_x_exportar) == "word") {
 * $x_exportarChk .= " checked";
 * break;
 * }
 * }
 * $x_exportarChk .= ">" . "Word (RTF)" . EditOptionSeparator(2);
 */
echo $x_exportarChk;
?>
</span></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">El
					formato pertenece al n&uacute;cleo</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <input type="radio"
					name="x_pertenece_nucleo" value=0
					<?php if(!$x_pertenece_nucleo) echo "checked";?>>No&nbsp;&nbsp; <input
					type="radio" name="x_pertenece_nucleo" value=1
					<?php if($x_pertenece_nucleo) echo "checked";?>>Si
			</span></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Categor&iacute;a</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo arbol_categorias('x_fk_categoria_formato'); ?></span></td>
		</tr>

		<!--tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Flujo</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<?php
			$select = busca_filtro_tabla("", "diagram", "", "", $conn);
			?>
			<select name="x_flujo_idflujo" id="x_flujo_idflujo"><option value="0">Seleccoine...</option>
			<?php
			for($i = 0; $i < $select["numcampos"]; $i++) {
				echo '<option value="' . $select[$i]["id"] . '">' . $select[$i]["title"] . '</option>';
			}
			?>
			</select>
		</span></td>
	</tr-->
		<tr>
			<input type="hidden" name="x_flujo_idflujo" id="x_flujo_idflujo"
				value="0">
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Funci&oacute;n
					predeterminada</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <input type="checkbox"
					name="x_funcion_predeterminada[]" value="1">Varios responsables <input
					type="checkbox" name="x_funcion_predeterminada[]" value="2">Digitalizaci&oacute;n
					<input type="checkbox" name="x_funcion_predeterminada[]" value="3">Anexos

			</span></td>
		</tr>
	</table>
	<p>
		<input type="submit" name="Action" id="action" value="ADICIONAR">

	</p>
</form>




<?php include ("footer.php")?>
<?php
// //phpmkr_db_close($conn);
?>
<?php

// -------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables
function LoadData($sKey, $conn) {
	global $enter2tab, $x_autoguardado, $x_mostrar_pdf, $x_item, $x_idformato, $x_nombre, $x_etiqueta, $x_contador_idcontador, $x_ruta_mostrar, $x_ruta_editar, $x_ruta_adicionar, $x_librerias, $x_encabezado, $x_cuerpo, $x_pie_pagina, $x_margenes, $x_orientacion, $x_papel, $x_exportar, $x_tabla, $x_detalle, $x_cod_padre, $x_tipo_edicion, $x_serie_idserie, $x_banderas, $x_font_size, $x_firma_digital, $x_fk_categoria_formato, $x_flujo_idflujo, $x_funcion_predeterminada, $x_pertenece_nucleo;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM formato";
	$sSql .= " WHERE idformato = " . $sKeyWrk;
	$sGroupBy = "";
	$sHaving = "";
	$sOrderBy = "";
	if($sGroupBy != "") {
		$sSql .= " GROUP BY " . $sGroupBy;
	}
	if($sHaving != "") {
		$sSql .= " HAVING " . $sHaving;
	}
	if($sOrderBy != "") {
		$sSql .= " ORDER BY " . $sOrderBy;
	}
	$rs = phpmkr_query($sSql, $conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	if(phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	} else {
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);
		
		// Get the field contents
		$x_idformato = $row["idformato"];
		$x_nombre = $row["nombre"];
		$x_etiqueta = $row["etiqueta"];
		$x_contador_idcontador = $row["contador_idcontador"];
		$x_ruta_mostrar = $row["ruta_mostrar"];
		$x_ruta_editar = $row["ruta_editar"];
		$x_ruta_adicionar = $row["ruta_adicionar"];
		$x_librerias = $row["librerias"];
		// $x_encabezado = $row["encabezado"];
		// $x_cuerpo = $row["cuerpo"];
		// $x_pie_pagina = $row["pie_pagina"];
		$x_margenes = $row["margenes"];
		$x_orientacion = $row["orientacion"];
		$x_papel = $row["papel"];
		$x_exportar = $row["exportar"];
		$x_tabla = $row["nombre_tabla"];
		$x_cod_padre = $row["cod_padre"];
		$x_item = $row["item"];
		$x_tipo_edicion = $row["tipo_edicion"];
		$x_serie_idserie = $row["serie_idserie"];
		$x_banderas = explode(",", $row["banderas"]);
		$x_font_size = $row["font_size"];
		$x_autoguardado = $row["tiempo_autoguardado"];
		$x_mostrar_pdf = $row["mostrar_pdf"];
		$enter2tab = $row["enter2tab"];
		$x_fk_categoria_formato = $row["fk_categoria_formato"];
		$x_flujo_idflujo = $row["flujo_idflujo"];
		$x_funcion_predeterminada = $row["funcion_predeterminada"];
		$x_pertenece_nucleo = $row["pertenece_nucleo"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
<?php

// -------------------------------------------------------------------------------
// Function AddData
// - Add Data
// - Variables used: field variables
function AddData($conn) {
	global $enter2tab, $x_autoguardado, $x_mostrar_pdf, $x_item, $x_idformato, $x_nombre, $x_etiqueta, $x_contador_idcontador, $x_ruta_mostrar, $x_ruta_editar, $x_ruta_adicionar, $x_librerias, $x_encabezado, $x_cuerpo, $x_pie_pagina, $x_margenes, $x_orientacion, $x_papel, $x_exportar, $x_tabla, $x_detalle, $x_cod_padre, $x_serie_idserie, $x_banderas, $x_font_size, $x_mostrar, $x_tipo_edicion, $x_firma_digital, $x_fk_categoria_formato, $x_flujo_idflujo, $x_funcion_predeterminada, $x_paginar, $x_pertenece_nucleo;
	
	// Field Banderas
	if(is_array($x_banderas))
		$fieldList["banderas"] = "'" . implode(",", $x_banderas) . "'";
	
	$fieldList["mostrar_pdf"] = $x_mostrar_pdf;
	
	// Field nombre
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["nombre"] = $theValue;
	
	// Field firma_digital
	$theValue = ($x_firma_digital != "") ? intval($x_firma_digital) : 0;
	$fieldList["firma_digital"] = $theValue;
	
	// Field etiqueta
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_etiqueta) : $x_etiqueta;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["etiqueta"] = htmlentities($theValue);
	
	// Field contador_idcontador
	$theValue = ($x_contador_idcontador != 0) ? intval($x_contador_idcontador) : crear_contador($x_nombre);
	$fieldList["contador_idcontador"] = $theValue;
	// reinicio del contador
	if($fieldList["contador_idcontador"]) {
		$reinicio = 0;
		if($_REQUEST["reiniciar_contador"] && $_REQUEST["reiniciar_contador"])
			$reinicio = 1;
		$sql = "update contador set reiniciar_cambio_anio=$reinicio where idcontador=" . $fieldList["contador_idcontador"];
		
		guardar_traza($sql, "ft_" . $x_nombre);
		phpmkr_query($sql, $conn);
	}
	
	// Field Serie_idserie
	if($x_serie_idserie == "") { // crear la serie con el nombre del formato
		//$sql = "insert into serie(nombre,categoria) values('" . $x_etiqueta . "',3)";
		//guardar_traza($sql, $x_nombre);
		//phpmkr_query($sql, $conn);
		//$fieldList["serie_idserie"] = phpmkr_insert_id();
	} else { // otra serie elegida o sin serie
		$theValue = ($x_serie_idserie != 0) ? intval($x_serie_idserie) : 0;
		$fieldList["serie_idserie"] = $theValue;
	}
	$fieldList["tiempo_autoguardado"] = $x_autoguardado;
	
	$x_tabla = "ft_" . $x_nombre;
	$fieldList["nombre_tabla"] = "'" . $x_tabla . "'";
	
	// Field librerias
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_librerias) : $x_librerias;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["librerias"] = $theValue;
	
	// Field margenes
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_margenes) : $x_margenes;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["margenes"] = $theValue;
	// font_size
	$fieldList["font_size"] = $x_font_size;
	$fieldList["enter2tab"] = $enter2tab;
	
	// Field orientacion
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_orientacion) : $x_orientacion;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["orientacion"] = $theValue;
	
	// Field papel
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_papel) : $x_papel;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["papel"] = $theValue;
	
	// Field exportar
	$theValue = implode(",", $x_exportar);
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["exportar"] = $theValue;
	if(!is_dir($x_nombre)) {
		mkdir($x_nombre, 0777);
		$data ="adicionar_".$x_nombre.".php
editar_".$x_nombre.".php
buscar_".$x_nombre.".php
buscar_".$x_nombre."2.php
mostrar_".$x_nombre.".php
detalles_mostrar_".$x_nombre.".php";
		if(intval($x_pertenece_nucleo) == 0) {
			$data = '*';
		}
    		
		
	$fp = fopen($x_nombre . "/.gitignore", 'w+');
    fwrite($fp,$data);
    fclose($fp);
	chmod($x_nombre . "/.gitignore",PERMISOS_ARCHIVOS);		
		/*
		if(!file_put_contents($x_nombre . "/.gitignore", $data)) {
			alerta("No se crea el archivo .gitignore para versionamiento");
		}*/
	}
	
	// Field cod_padre
	$theValue = ($x_cod_padre != 0) ? intval($x_cod_padre) : 0;
	$fieldList["cod_padre"] = $theValue;
	
	// Field Tipo Edicion continua
	$theValue = ($x_tipo_edicion != 0) ? intval($x_tipo_edicion) : 0;
	$fieldList["tipo_edicion"] = $theValue;
	
	$theValue = ($x_mostrar != 0) ? intval($x_mostrar) : 0;
	$fieldList["mostrar"] = $theValue;
	
	// paginar en el mostrar
	$theValue = ($x_paginar != 0) ? intval($x_paginar) : 0;
	$fieldList["paginar"] = $theValue;
	
	// tipo detalle
	$theValue = ($x_detalle != "") ? intval($x_detalle) : 0;
	$fieldList["detalle"] = $theValue;
	// tipo item
	$fieldList["item"] = $x_item;
	
	$fieldList["fk_categoria_formato"] = "'" . $x_fk_categoria_formato . "'";
	$fieldList["flujo_idflujo"] = $x_flujo_idflujo;
	$fieldList["funcion_predeterminada"] = "'" . implode(",", $x_funcion_predeterminada) . "'";
	
	$fieldList["ruta_mostrar"] = "'" . "mostrar_" . $x_nombre . ".php'";
	$fieldList["ruta_editar"] = "'" . "editar_" . $x_nombre . ".php'";
	$fieldList["ruta_adicionar"] = "'" . "adicionar_" . $x_nombre . ".php'";
	$fieldList["funcionario_idfuncionario"] = usuario_actual("funcionario_codigo");
	$fieldList["pertenece_nucleo"] = intval($x_pertenece_nucleo);
	//print_r($fieldList);
	// insert into database
	$strsql = "INSERT INTO formato (";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";
	guardar_traza($strsql, "ft_" . $x_nombre);
	phpmkr_query($strsql, $conn) or die("Falla al ejecutar la busqueda " . phpmkr_error() . ' SQL:' . $strsql);
	
	$idformato = phpmkr_insert_id();
	if($idformato != '') {
		if($x_flujo_idflujo != 0) {
			generar_campo_flujo($idformato, $x_flujo_idflujo);
		}
		if(in_array("1", $x_funcion_predeterminada)) {
			vincular_funcion_responsables($idformato);
		}
		if(in_array("2", $x_funcion_predeterminada)) {
			vincular_funcion_digitalizacion($idformato);
		}
		if(in_array("3", $x_funcion_predeterminada)) {
			vincular_campo_anexo($idformato);
		}
		crear_modulo_formato($idformato);
	}
	
	if($fieldList["cod_padre"] && $idformato) {
		
		$formato_padre = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $fieldList["cod_padre"], "", $conn);
		$strsql = "INSERT INTO campos_formato (formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, banderas, etiqueta_html) VALUES (" . $idformato . ",'" . $formato_padre[0]["nombre_tabla"] . "', " . $fieldList["nombre"] . ", 'INT', 11, 1," . $fieldList["cod_padre"] . ", 'a'," . $fieldList["etiqueta"] . ", 'fk', 'detalle')";
		guardar_traza($strsql, "ft_" . $x_nombre);
		phpmkr_query($strsql, $conn) or die("Falla al Ejecutar la busqueda " . phpmkr_error() . ' SQL:' . $strsql);
	}
	if($idformato && !$fieldList["item"]) {
		$sqlcd = "INSERT INTO campos_formato (formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, predeterminado, acciones, ayuda, banderas, etiqueta_html) VALUES (" . $idformato . ",'estado_documento', 'ESTADO DEL DOCUMENTO', 'VARCHAR', 255, 0,'', 'a','', '', 'hidden')";
		phpmkr_query($sqlcd, $conn) or die("Falla al Ejecutar la busqueda " . phpmkr_error() . ' SQL:' . $strsql);
		
		$strsql = "INSERT INTO campos_formato (formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, predeterminado, acciones, ayuda, banderas, etiqueta_html) VALUES (" . $idformato . ",'serie_idserie', 'SERIE DOCUMENTAL', 'INT', 11, 1," . $fieldList["serie_idserie"] . ", 'a'," . $fieldList["etiqueta"] . ", 'fk', 'hidden')";
		guardar_traza($strsql, "ft_" . $x_nombre);
		phpmkr_query($strsql, $conn) or die("Falla al Ejecutar la busqueda " . phpmkr_error() . ' SQL:' . $strsql);
	}
	
	return $idformato;
}

function crear_contador($contador) {
	global $conn;
	
	$cont = busca_filtro_tabla("*", "contador", "nombre LIKE '" . $contador . "'", "", $conn);
	if(!$cont["numcampos"]) {
		$sql = "INSERT INTO contador(consecutivo, nombre) VALUES(1,'" . $contador . "')";
		guardar_traza($strsql, "ft_" . $contador);
		phpmkr_query($sql, $conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sql);
		return (phpmkr_insert_id());
	} else
		return ($cont[0]["idcontador"]);
}

function consultar_contador() {
	global $conn;
	$contador = busca_filtro_tabla("reiniciar_cambio_anio", "contador", "idcontador=" . $_REQUEST["idcontador"], "", $conn);
	echo $contador[0][0];
}

function arbol_categorias($campo) {
	$entidad = $campo;
	?>
<div><?php /* echo $seleccionados; */ ?></div>
<br>
Buscar:
<input type="text" id="stext<?php echo $entidad; ?>" width="200px"
	size="25">
<a href="javascript:void(0)"
	onclick="stext<?php echo $entidad; ?>.findItem(htmlentities(document.getElementById('stext<?php echo $entidad; ?>').value),1)">
	<img src="../botones/general/anterior.png" alt="Buscar Anterior"
	border="0px">
</a>
<a href="javascript:void(0)"
	onclick="tree<?php echo $entidad; ?>.findItem(htmlentities(document.getElementById('stext<?php echo $entidad; ?>').value),0,1)">
	<img src="../botones/general/buscar.png" alt="Buscar" border="0px">
</a>
<a href="javascript:void(0)"
	onclick="tree<?php echo $entidad; ?>.findItem(htmlentities(document.getElementById('stext<?php echo $entidad; ?>').value))">
	<img src="../botones/general/siguiente.png" alt="Buscar Siguiente"
	border="0px">
</a>
<span></span>
<div id="esperando<?php echo $entidad; ?>">
	<img src="../imagenes/cargando.gif" alt="">
</div>
<div id="treeboxbox<?php echo $entidad; ?>" width="100px" height="100px"></div>
<input type="hidden" class="required" name="<?php echo $campo; ?>"
	id="<?php echo $campo; ?>">
<script type="text/javascript">
		var browserType;
		if (document.layers) {browserType = "nn4"}
		if (document.all) {browserType = "ie"}
		if (window.navigator.userAgent.toLowerCase().match("gecko")) {
			browserType= "gecko"
		}
		tree<?php echo $entidad; ?>=new dhtmlXTreeObject("treeboxbox<?php echo $entidad; ?>","100%","70%",0);
		tree<?php echo $entidad; ?>.setImagePath("../imgs/");
		tree<?php echo $entidad; ?>.enableIEImageFix(true);
		tree<?php echo $entidad; ?>.setOnLoadingStart(cargando<?php echo $entidad; ?>);
		tree<?php echo $entidad; ?>.setOnLoadingEnd(fin_cargando<?php echo $entidad; ?>);
		tree<?php echo $entidad; ?>.enableCheckBoxes(1);
		<?php if($entidad==1 || $entidad==2){?>
			tree<?php echo $entidad; ?>.enableThreeStateCheckboxes(true);
		<?php }?>
		tree<?php echo $entidad; ?>.loadXML("../test_categoria.php?tipo=1");
		tree<?php echo $entidad; ?>.setOnCheckHandler(onNodeSelect<?php echo $entidad; ?>);
		function onNodeSelect<?php echo $entidad; ?>(nodeId){
	   		document.getElementById("<?php echo $campo; ?>").value=tree<?php echo $entidad; ?>.getAllChecked();
		}

		function fin_cargando<?php echo $entidad; ?>() {
			if (browserType == "gecko" )
				document.poppedLayer = eval('document.getElementById("esperando<?php echo $entidad; ?>")');
			else if (browserType == "ie")
				document.poppedLayer = eval('document.getElementById("esperando<?php echo $entidad; ?>")');
			else
				document.poppedLayer = eval('document.layers["esperando<?php echo $entidad; ?>"]');
		document.poppedLayer.style.display = "none";
		document.getElementById('<?php echo $campo; ?>').value=tree<?php echo $entidad; ?>.getAllChecked();
		}

		function cargando<?php echo $entidad; ?>() {
		if (browserType == "gecko" )
		document.poppedLayer =
		eval('document.getElementById("esperando<?php echo $entidad; ?>")');
		else if (browserType == "ie")
		document.poppedLayer =
		eval('document.getElementById("esperando<?php echo $entidad; ?>")');
		else
		document.poppedLayer =
		eval('document.layers["esperando<?php echo $entidad; ?>"]');
		document.poppedLayer.style.display = "";
		}
                    
                    --></script>



<?php
}

function generar_campo_flujo($idformato, $idflujo) {
	$buscar_campo = busca_filtro_tabla("", "campos_formato A", "formato_idformato=" . $idformato . " AND nombre='idflujo'", "", $conn);
	
	if($buscar_campo["numcampos"] == 0) {
		$campo = "INSERT INTO campos_formato(formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, acciones, predeterminado, etiqueta_html, orden, valor) VALUES(" . $idformato . ",'idflujo', 'idflujo', 'VARCHAR', '255', 0, 'a,e,b', '" . $idflujo . "', 'select', 0, 'Select id,title as nombre from diagram order by nombre')";
		// Se deja el comentario para la modificacion de los flujos
		// guardar_traza($campo);
	} else {
		$campo = "UPDATE campos_formato SET formato_idformato=" . $idformato . ", nombre='idflujo', etiqueta='idflujo', tipo_dato='VARCHAR', longitud='255', obligatoriedad='0', acciones='a,e,b', predeterminado='" . $idflujo . "', etiqueta_html='select', valor='Select id,title as nombre from diagram order by nombre' WHERE idcampos_formato=" . $buscar_campo[0]["idcampos_formato"];
		// Se dejea el comentario para la modificacion de los flujos
		// guardar_traza($campo);
	}
	phpmkr_query($campo, $conn);
}

function vincular_funcion_responsables($idformato) {
	global $conn;
	$formato = busca_filtro_tabla("", "formato", "idformato=" . $idformato, "", $conn);
	$buscar_funcion = busca_filtro_tabla("", "funciones_formato A", "nombre_funcion='asignar_responsables'", "", $conn);
	if($buscar_funcion["numcampos"] == 0) {
		$nueva_funcion = "INSERT INTO funciones_formato (nombre,nombre_funcion,etiqueta,descripcion, ruta, formato, acciones) VALUES ('{*asignar_responsables*}','asignar_responsables','asignar_responsables','asignar_responsables', 'funciones.php','" . $idformato . "','a')";
		guardar_traza($nueva_funcion, $formato[0]["nombre_tabla"]);
		phpmkr_query($nueva_funcion, $conn);
	}
	$buscar_funcion = busca_filtro_tabla("", "funciones_formato A", "nombre_funcion='asignar_responsables'", "", $conn);
	if(!in_array($idformato, explode(",", $buscar_funcion[0]["formato"]))) {
		$sql = "UPDATE funciones_formato SET formato='" . $buscar_funcion[0]["formato"] . "," . $idformato . "' WHERE idfunciones_formato=" . $buscar_funcion[0]["idfunciones_formato"];
	}
	guardar_traza($sql, $formato[0]["nombre_tabla"]);
	phpmkr_query($sql, $conn);
}

function vincular_funcion_digitalizacion($idformato) {
	global $conn;
	$formato = busca_filtro_tabla("", "formato", "idformato=" . $idformato, "", $conn);
	// --Vinculando funcion al adicionar de digitalizar
	$buscar_funcion = busca_filtro_tabla("", "funciones_formato A", "nombre_funcion='digitalizar_formato'", "", $conn);
	if($buscar_funcion["numcampos"] == 0) {
		$nueva_funcion = "INSERT INTO funciones_formato (nombre,nombre_funcion,etiqueta,descripcion, ruta, formato, acciones) VALUES ('{*digitalizar_formato*}','digitalizar_formato','digitalizar_formato','digitalizar_formato', '../librerias/funciones_formatos_generales.php','" . $idformato . "','a,e')";
		guardar_traza($nueva_funcion, $formato[0]["nombre_tabla"]);
		phpmkr_query($nueva_funcion, $conn);
	}
	$buscar_funcion = busca_filtro_tabla("", "funciones_formato A", "nombre_funcion='digitalizar_formato'", "", $conn);
	if(!in_array($idformato, explode(",", $buscar_funcion[0]["formato"]))) {
		$sql = "UPDATE funciones_formato SET formato='" . $buscar_funcion[0]["formato"] . "," . $idformato . "' WHERE idfunciones_formato=" . $buscar_funcion[0]["idfunciones_formato"];
	}
	guardar_traza($sql, $formato[0]["nombre_tabla"]);
	phpmkr_query($sql, $conn);
	
	// ---Vinculando funcion de validacion al digitalizar
	$buscar_funcion = busca_filtro_tabla("", "funciones_formato A", "nombre_funcion='validar_digitalizacion_formato'", "", $conn);
	if($buscar_funcion["numcampos"] == 0) {
		$nueva_funcion = "INSERT INTO funciones_formato (nombre,nombre_funcion,etiqueta,descripcion, ruta, formato, acciones) VALUES ('{*validar_digitalizacion_formato*}', 'validar_digitalizacion_formato', 'validar_digitalizacion_formato', 'validar_digitalizacion_formato', '../librerias/funciones_formatos_generales.php', '" . $idformato . "','')";
		guardar_traza($nueva_funcion, $formato[0]["nombre_tabla"]);
		phpmkr_query($nueva_funcion, $conn);
	}
	$buscar_funcion = busca_filtro_tabla("", "funciones_formato A", "nombre_funcion='validar_digitalizacion_formato'", "", $conn);
	if(!in_array($idformato, explode(",", $buscar_funcion[0]["formato"]))) {
		$sql = "UPDATE funciones_formato SET formato='" . $buscar_funcion[0]["formato"] . "," . $idformato . "' WHERE idfunciones_formato=" . $buscar_funcion[0]["idfunciones_formato"];
		guardar_traza($sql, $formato[0]["nombre_tabla"]);
		phpmkr_query($sql, $conn);
	}
	
	// Vinculando la accion de validar la digitalizar posterior a la accion correspondiente.
	if(in_array("e", $x_banderas)) {
		$accion = busca_filtro_tabla("", "accion", "nombre='aprobar'", "", $conn);
	} else {
		$accion = busca_filtro_tabla("", "accion", "nombre='adicionar'", "", $conn);
	}
	$buscar_funcion_accion = busca_filtro_tabla("", "funciones_formato_accion", "idfunciones_formato=" . $buscar_funcion[0]["idfunciones_formato"] . " AND formato_idformato=" . $idformato, "", $conn);
	if($buscar_funcion_accion["numcampos"] == 0) {
		$accion_digita = "INSERT INTO funciones_formato_accion (idfunciones_formato, accion_idaccion, formato_idformato, momento, estado, orden) VALUES(" . $buscar_funcion[0]["idfunciones_formato"] . "," . $accion[0]["idaccion"] . ", " . $idformato . ", 'POSTERIOR',1,1)";
	} else {
		$accion_digita = "UPDATE funciones_formato_accion SET idfunciones_formato=" . $buscar_funcion[0]["idfunciones_formato"] . ", accion_idaccion=" . $accion[0]["idaccion"] . ", formato_idformato=" . $idformato . ", momento='POSTERIOR', estado=1, orden=1 WHERE idfunciones_formato_accion=" . $buscar_funcion_accion[0]["idfunciones_formato_accion"];
	}
	guardar_traza($accion_digita, $formato[0]["nombre_tabla"]);
	phpmkr_query($accion_digita, $conn);
}

function vincular_campo_anexo($idformato) {
	global $conn;
	$formato = busca_filtro_tabla("", "formato", "idformato=" . $idformato, "", $conn);
	$buscar_campo = busca_filtro_tabla("", "campos_formato A", "formato_idformato=" . $idformato . " AND nombre='anexo_formato'", "", $conn);
	
	if($buscar_campo["numcampos"] == 0) {
		$campo = "INSERT INTO campos_formato(formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, acciones, predeterminado, etiqueta_html, orden, valor) VALUES(" . $idformato . ",'anexo_formato', 'Anexos digitales', 'VARCHAR', '255', 0, 'a,e,b', '" . $idflujo . "', 'archivo', 0, '')";
	} else {
		$campo = "UPDATE campos_formato SET formato_idformato=" . $idformato . ", nombre='anexo_formato', etiqueta='Anexos digitales', tipo_dato='VARCHAR', longitud='255', obligatoriedad='0', acciones='a,e,b', predeterminado='" . $idflujo . "', etiqueta_html='archivo', valor='' WHERE idcampos_formato=" . $buscar_campo[0]["idcampos_formato"];
	}
	guardar_traza($campo, $formato[0]["nombre_tabla"]);
	phpmkr_query($campo);
}

function crear_modulo_formato($idformato) {
	global $conn;
	$datos_formato = busca_filtro_tabla("nombre,etiqueta,cod_padre,nombre_tabla,ruta_mostrar", "formato", "idformato=" . $idformato, "", $conn);
	$modulo_formato = busca_filtro_tabla("", "modulo", "nombre = 'modulo_formatos'", "", $conn);
	if($modulo_formato["numcampos"]) {
		$submodulo_formato = busca_filtro_tabla("", "modulo", "nombre ='" . $datos_formato[0]["nombre"] . "'", "", $conn);
		if(!$submodulo_formato["numcampos"]) {
			$padre = busca_filtro_tabla("idmodulo", "formato A, modulo B", "idformato=" . $datos_formato[0]["cod_padre"] . " AND lower(A.nombre)=(B.nombre)", "", $conn);
			if($padre["numcampos"] > 0) {
				$papa = $padre[0]["idmodulo"];
			} else {
				$papa = $modulo_formato[0]["idmodulo"];
			}
			$sql = "INSERT INTO modulo(nombre,tipo,imagen,etiqueta,enlace,destino,cod_padre,orden,ayuda,busqueda) VALUES ('" . $datos_formato[0]["nombre"] . "','secundario','botones/formatos/modulo.gif','" . $datos_formato[0]["etiqueta"] . "','formatos/" . $datos_formato[0]["ruta_mostrar"] . "','centro','" . $papa . "','1','Permite administrar el formato " . $datos_formato[0]["etiqueta"] . ".',1)";
			
			guardar_traza($sql, $datos_formato[0]["nombre_tabla"]);
			phpmkr_query($sql, $conn);
			$modulo_id = phpmkr_insert_id();
			$sql = "INSERT INTO permiso(funcionario_idfuncionario,modulo_idmodulo) VALUES('" . usuario_actual("id") . "'," . $modulo_id . ")";
			guardar_traza($sql, $datos_formato[0]["nombre_tabla"]);
			phpmkr_query($sql, $conn);
		} else {
			$padre = busca_filtro_tabla("idmodulo", "formato A, modulo B", "idformato=" . $datos_formato[0]["cod_padre"] . " AND lower(A.nombre)=(B.nombre)", "", $conn);
			if($padre["numcampos"] > 0) {
				$papa = $padre[0]["idmodulo"];
			} else {
				$papa = $modulo_formato[0]["idmodulo"];
			}
			$sql = "update modulo set nombre='" . $datos_formato[0]["nombre"] . "',etiqueta='" . $datos_formato[0]["etiqueta"] . "',cod_padre='" . $papa . "' where idmodulo=" . $submodulo_formato[0]["idmodulo"];
			guardar_traza($sql, $datos_formato[0]["nombre_tabla"]);
			phpmkr_query($sql, $conn);
		}
	}
	$modulo_crear = busca_filtro_tabla("", "modulo", "nombre = 'creacion_formatos'", "", $conn);
	if($modulo_crear["numcampos"]) {
		$submodulo_formato = busca_filtro_tabla("", "modulo", "nombre = 'crear_" . $datos_formato[0]["nombre"] . "'", "", $conn);
		if(!$submodulo_formato["numcampos"]) {
			$sql = "INSERT INTO modulo(nombre,tipo,imagen,etiqueta,enlace,destino,cod_padre,orden,ayuda) VALUES ('crear_" . $datos_formato[0]["nombre"] . "','secundario','botones/formatos/modulo.gif','Crear " . $datos_formato[0]["etiqueta"] . "','formatos/" . $datos_formato[0]["ruta_adicionar"] . "','centro','" . $modulo_crear[0]["idmodulo"] . "','1','Permite crear " . $datos_formato[0]["etiqueta"] . ".')";
			// /die($sql);
			guardar_traza($sql, $formato[0]["nombre_tabla"]);
			phpmkr_query($sql, $conn);
		}
	}
}
?>
