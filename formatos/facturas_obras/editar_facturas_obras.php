<?php
                    $max_salida = 10;
                    $ruta_db_superior = $ruta = "";

                    while ($max_salida > 0) {
                        if (is_file($ruta . "db.php")) {
                            $ruta_db_superior = $ruta;
                        }

                        $ruta .= "../";
                        $max_salida --;
                    }

                    ?>
                        <!DOCTYPE html>
                            <html>
                                <head>
                                    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
                                    <meta charset="utf-8" />
                                    <title>.:EDITAR RADICACI&Oacute;N FACTURAS DE OBRA:.</title>
                                    <meta name="viewport"
                                    	content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
                                    <meta name="apple-mobile-web-app-capable" content="yes">
                                    <meta name="apple-touch-fullscreen" content="yes">
                                    <meta name="apple-mobile-web-app-status-bar-style" content="default">
                                    <meta content="" name="description" />
                                    <meta content="" name="Cero K" /> <?php include_once($ruta_db_superior . "assets/librerias.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../formatos/librerias/funciones_acciones.php'); ?><?php include_once('../../formatos/librerias/header_formato.php'); ?><?= pace() ?>
                        <?= jquery() ?>
                        <?= bootstrap() ?>
                        <?= icons() ?>
                        <?= moment() ?><?= validate() ?><script type="text/javascript" src="<?= $ruta_db_superior ?>js/title2note.js"></script><script type="text/javascript" src="<?= $ruta_db_superior ?>js/dhtmlXCommon.js"></script><script type="text/javascript" src="<?= $ruta_db_superior ?>js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="<?= $ruta_db_superior ?>css/dhtmlXTree.css"><link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>css/selectize.css"/><script type="text/javascript" src="<?= $ruta_db_superior ?>js/selectize.js"></script><script type="text/javascript" src="<?= $ruta_db_superior ?>dropzone/dist/dropzone.js"></script><?php include_once('<?=  ?>anexosdigitales/funciones_archivo.php'); ?><script type="text/javascript" src="<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/highslide.css" /></style><link href="<?= $ruta_db_superior ?>dropzone/dist/dropzone_saia.css" type="text/css" rel="stylesheet" /><script type="text/javascript"> hs.graphicsDir = "<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/graphics/"; hs.outlineType = "rounded-white";</script>
                	<link
                                	href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.css"
                                	rel="stylesheet" type="text/css" media="screen" />
                                <link
                                	href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/css/select2.min.css"
                                	rel="stylesheet" type="text/css" media="screen" />
                                <link
                                	href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/switchery/css/switchery.min.css"
                                	rel="stylesheet" type="text/css" media="screen" />
                                <link class="main-stylesheet"
                                	href="<?= $ruta_db_superior ?>assets/theme/pages/css/pages.css"
                                	rel="stylesheet" type="text/css" />
                                <link
                                	href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/font-awesome/css/font-awesome.css"
                                	rel="stylesheet" type="text/css" />
                                <link
                                	href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css"
                                	rel="stylesheet" type="text/css" media="screen">
                                <script
                                	src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-validation/js/jquery.validate.min.js"
                                	type="text/javascript"></script>
                                <script
                                    src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/js/select2.full.min.js"
                                    type="text/javascript"></script>

                                <link rel="stylesheet"
                                    href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/css/select2.min.css"  type="text/css" media="screen" />
                                <script
                                	src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script> 
                                <script
                                	src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/js/locales/es.js"></script> 
                	</head>
                	<div class="container-fluid container-fixed-lg col-lg-8" style="overflow: auto;" id="content_container">
                    	<!-- START card -->
                    	<div class="card card-default">
                            <div class="card-body"><center><h4 class="text-black">RADICACIÓN FACTURAS DE OBRA</h4></center><?php llama_funcion_accion(@$_REQUEST["iddoc"],422,"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" role="form" autocomplete="off" method="post" action="<?= $ruta_db_superior ?>class_transferencia.php"" enctype="multipart/form-data"><div class="form-group" id="tr_dependencia"><label title="">VENTANILLA DEL CREADOR DEL DOCUMENTO*</label><?php buscar_dependencia(422,6974,$_REQUEST['iddoc']);?></div><div class="form-group" id="tr_fecha_radicacion"><label title="">FECHA DE RADICACI&Oacute;N*</label><?php fecha_formato(422,6977,$_REQUEST['iddoc']);?></div><div class="form-group" id="tr_numero_radicado"><label title="">N&Uacute;MERO DE RADICADO</label><?php mostrar_radicado_obra(422,6994,$_REQUEST['iddoc']);?></div><div class="form-group  id="tr_fecha_factura">
<label title="">FECHA DE LA FACTURA</label>
<div class="input-group">
<input  tabindex="1 " type="text" class="form-control"  id="fecha_factura"   name="fecha_factura">
<span class="input-group-text"><i class="fa fa-calendar"></i></span>
</div>
<script type="text/javascript">
            $(function () {
                var configuracion={"defaultDate":"<?php echo(mostrar_valor_campo('fecha_factura',422,$_REQUEST['iddoc'])); ?>","format":"YYYY-MM-DD","locale":"es","useCurrent":true};
                $("#fecha_factura").datetimepicker(configuracion);
                $("#content_container").height($(window).height());
            });
        </script>
</div><div class="form-group form-group-default "  id="tr_numero_factura">
                                        <label title="">N&Uacute;MERO DE FACTURA</label>
                                        <input class="form-control"  maxlength="255"   tabindex='2'  type="text"  size="100" id="numero_factura" name="numero_factura"  value="<?php echo(mostrar_valor_campo('numero_factura',422,$_REQUEST['iddoc'])); ?>">
                                       </div><div class="form-group" id="tr_concepto_factura">
                                        <label title="">CONCEPTO DE LA FACTURA*</label>
                                        <div class="celda_transparente">
                                        <textarea  tabindex='3'  name="concepto_factura" id="concepto_factura" cols="53" rows="3" class="form-control tiny_sin_tiny required"><?php echo(mostrar_valor_campo('concepto_factura',422,$_REQUEST['iddoc'])); ?></textarea></div></div><div class="form-group form-group-default required"  id="tr_valor_factura">
                                        <label title="">VALOR DE LA FACTURA</label>
                                        <input class="form-control"  maxlength="30"  class="required"   tabindex='4'  type="text"  size="100" id="valor_factura" name="valor_factura" required value="<?php echo(mostrar_valor_campo('valor_factura',422,$_REQUEST['iddoc'])); ?>">
                                       </div><div class="form-group" id="tr_vence_factura"><label title="">VENCIMIENTO DE LA FACTURA*</label><?php fecha_formato(422,6982,$_REQUEST['iddoc']);?></div><div class="form-group form-group-default required"  id="tr_numero_guia">
                                        <label title="">N&Uacute;MERO DE GU&Iacute;A</label>
                                        <input class="form-control"  maxlength="50"   tabindex='5'  type="text"  size="100" id="numero_guia" name="numero_guia" required value="<?php echo(mostrar_valor_campo('numero_guia',422,$_REQUEST['iddoc'])); ?>">
                                       </div><div class="form-group" id="tr_empresa_trans">
                                        <label title="">EMPRESA TRANSPORTADORA</label><?php genera_campo_listados_editar(422,6984,$_REQUEST['iddoc']);?></div><div class="form-group form-group-default required"  id="tr_numero_folios">
                                        <label title="">N&Uacute;MERO DE FOLIOS</label>
                                        <input class="form-control"  maxlength="50"   tabindex='6'  type="text"  size="100" id="numero_folios" name="numero_folios" required value="<?php echo(mostrar_valor_campo('numero_folios',422,$_REQUEST['iddoc'])); ?>">
                                       </div><div class="form-group" id="tr_anexos_fisicos">
                                        <label title="">ANEXOS F&Iacute;SICOS</label>
                                        <div class="celda_transparente">
                                        <textarea  tabindex='7'  name="anexos_fisicos" id="anexos_fisicos" cols="53" rows="3" class="form-control tiny_sin_tiny"><?php echo(mostrar_valor_campo('anexos_fisicos',422,$_REQUEST['iddoc'])); ?></textarea></div></div><div class="form-group" id="tr_anexos_digitales">
                                        <label title="">ANEXOS DIGITALES</label>
                                        <div class="tools">
                                             <a class="collapse" href="javascript:;"></a>
                                             <a class="config" data-toggle="modal" href="#grid-config"></a>
                                             <a class="reload" href="javascript:;"></a>
                                             <a class="remove" href="javascript:;"></a>
                                       </div>
                                       <div class="card-body no-scroll no-padding"><?php echo '<div class="textwrapper">
                                            <a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=422&idcampo=6987" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
                                            objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
                                            outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
                                            </div>'; ?></div></div><div class="form-group" id="tr_persona_natural">
                                        <label title="">PERSONA NATURAL/JURIDICA*</label>
                                        <input type="hidden" maxlength="11"  class="required"  name="persona_natural" id="persona_natural" value="<?php echo(mostrar_valor_campo('persona_natural',422,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("6988",@$_REQUEST["iddoc"]); ?></div><div class="form-group" id="tr_destino">
                                       <label title="">DESTINO*</label><input type="text" class="form-control" name="destino" id="destino" value="" data-data='<?php echo(mostrar_autocompletar('destino', 422, $_REQUEST['iddoc'])); ?>'required></div>
    <script>
    $(document).ready(function(){
	$("[name='destino']").selectize({
	    valueField: "value",
	    labelField: "text",
	    searchField: "text",
	persist: false,
	createOnBlur: true,
	create: false,
	maxItems: null,
	load: function(query, callback) {
	        if (!query.length) return callback();
	        $.ajax({
	            url: "../../autocompletar.php",
	            type: "POST",
	            dataType: "json",
	            data: {
	                consulta: "eyJjYW1wb2lkIjoiZnVuY2lvbmFyaW9fY29kaWdvIiwiY2FtcG90ZXh0byI6WyJub21icmVzIiwiYXBlbGxpZG9zIl0sInRhYmxhcyI6WyJmdW5jaW9uYXJpbyJdLCJjb25kaWNpb24iOiJlc3RhZG89MSIsIm9yZGVuIjoiIn0=",
	                valor: query,
	            },
	            error: function() {
	                callback();
	            },
	            success: function(res) {
	                callback(res);
	            }
	        });
	    }
	});
    });</script><div class="form-group" id="tr_copia">
                                <label title="">COPIA ELECTR&Oacute;NICA A</label><div class="form-control"><div id="seleccionados"><?php if(isset($_REQUEST["iddoc"])){mostrar_seleccionados(422,6990,'5',$_REQUEST['iddoc']);}?></div><br/>Buscar: <input  tabindex='9'  type="text" id="stext_copia" width="200px" size="25" onblur="closetree_copia()"> <input type="hidden" id="idclosetree_copia">
                                <a href="javascript:void(0)" onclick="buscar_nodo_copia('tree_copia')">
                                    <img src="../../botones/general/buscar.png"border="0px">
                                </a>
                                    <a href="javascript:void(0)" onclick="tree_copia.findItem((document.getElementById('stext_copia').value),1)">
                                        <img src="../../botones/general/anterior.png"border="0px">
                                    </a>
                                <a href="javascript:void(0)" onclick="tree_copia.findItem((document.getElementById('stext_copia').value))">
                                    <img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  name="copia" id="copia"   value="<?php if(isset($_REQUEST["iddoc"])){cargar_seleccionados(422,6990,1,$_REQUEST['iddoc']);}?>" ><div id="esperando_copia">
                                    <img src="../../imagenes/cargando.gif">
                                </div>
                                <div id="treeboxbox_copia" height="90%"></div><script type="text/javascript">
                                var browserType;
                                if (document.layers) {browserType = "nn4"}
                                if (document.all) {browserType = "ie"}
                                if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                                    browserType= "gecko"
                                }
                                tree_copia=new dhtmlXTreeObject("treeboxbox_copia","100%","100%",0);
                                tree_copia.setImagePath("../../imgs/");
                                tree_copia.enableTreeImages("false");
                                tree_copia.enableTreeLines("false");
                                tree_copia.enableIEImageFix(true);tree_copia.enableCheckBoxes(1);
                                    tree_copia.enableThreeStateCheckboxes(1);tree_copia.setOnLoadingStart(cargando_copia);
                                tree_copia.setOnLoadingEnd(fin_cargando_copia);tree_copia.setXMLAutoLoading("../../test_funcionario.php?rol=1&sin_padre=1&cargar_partes=1");tree_copia.loadXML("../../test_funcionario.php?rol=1&sin_padre=1&cargar_partes=1",checkear_arbol);tree_copia.setOnCheckHandler(onNodeSelect_copia);

                                    function onNodeSelect_copia(nodeId){
                                        valor_destino=document.getElementById("copia");
                                        destinos=tree_copia.getAllChecked();
                                        nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                                        nuevo=nuevo.replace(/\,$/gi,"");
                                        vector=destinos.split(",");
                                        for(i=0;i<vector.length;i++){
                                            if(vector[i].indexOf("_")!=-1){
                                                vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                                            }
                                            nuevo=vector.join(",");
                                            if(vector[i].indexOf("#")!=-1){
                                                hijos=tree_copia.getAllSubItems(vector[i]);
                                                hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                                                hijos=hijos.replace(/\,$/gi,"");
                                                vectorh=hijos.split(",");

                                                for(h=0;h<vectorh.length;h++){
                                                    if(vectorh[h].indexOf("_")!=-1)
                                                    vectorh[h]=vectorh[h].substr(0,vectorh[h].indexOf("_"));
                                                    nuevo=eliminarItem(nuevo,vectorh[h]);
                                                }
                                            }
                                        }
                                        nuevo=nuevo.replace(/\,{2,}(d)*/gi,",");
                                        nuevo=nuevo.replace(/\,$/gi,"");
                                        valor_destino.value=nuevo;
                                    }<script>

                function buscar_nodo_copia() {
                    $.ajax({
                        type : 'POST',
                        url : '../../test_funcionario_buscar.php',
                        dataType : 'json',
                        data : {
                            nombre : $('#stext_copia').val(),
                            tabla : 'dependencia'
                        },
                        success : function(data) {
                            if(data['error']){
                                alert(data['mensaje']);
}
                            else{
                                tree_copia.attachEvent('onOpenDynamicEnd', function(){
                                    tree_copia.selectItem('1#',false,false);
                                    tree_copia.clearSelection();
                                    for(var i=0;i<data['numcampos_func'];i++){
                                        tree_copia.selectItem(data['funcionarios'][i],false,true);
                                    }
                                    for(var i=0;i<data['numcampos_dep'];i++){
                                        tree_copia.selectItem(data['dependencias'][i],false,true);
                                    }
                                });
                                tree_copia.openItemsDynamic(data['datos'],true);
                            }
                        }
                    });
                }
                </script>function closetree_copia() {
                                    var bus_ant=document.getElementById('idclosetree_copia').value;
                                    var bus_actual=document.getElementById('stext_copia').value.trim();
                                    if(bus_actual!=''){
                                        if(bus_actual!=bus_ant){
                                            document.getElementById('idclosetree_copia').value=bus_actual;
                                            tree_copia.closeAllItems('1#');
                                        }
                                    }
                                }function fin_cargando_copia() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_copia")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_copia")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_copia"]');
                                    }
                                    document.poppedLayer.style.display = "none";
                                }

                                function cargando_copia() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_copia")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_copia")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_copia"]');
                                    }
                                    document.poppedLayer.style.display = "";
                                }function checkear_arbol(){
                                        vector2="<?php if(isset($_REQUEST["iddoc"])){cargar_seleccionados(422,6990,1,$_REQUEST['iddoc']);}?>";
                                        vector2=vector2.split(",");
                                        for(m=0;m<vector2.length;m++) {
                                            tree_copia.setCheck(vector2[m],true);
                                        }
                                    }
</script></div></div><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',422,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',422,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_facturas_obras" value="<?php echo(mostrar_valor_campo('idft_facturas_obras',422,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',422,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('6979'); ?>"><input type="hidden" name="formato" value="422"><tr><td colspan='2'><?php submit_formato(422,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''><input type='hidden' name='form_uuid'       id='form_uuid'       value='<?php echo (uniqid("-") . "-" . uniqid());?>'></form></body><script type='text/javascript'>
            var upload_url = '../../dropzone/cargar_archivos_formato.php';
            var mensaje = 'Arrastre aquiï¿½ los archivos';
            Dropzone.autoDiscover = false;
            var lista_archivos = new Object();
            $(document).ready(function () {
                Dropzone.autoDiscover = false;
                $('.saia_dz').each(function () {
                    var idformato = $(this).attr('data-idformato');
                	var idcampo = $(this).attr('id');
                	var paramName = $(this).attr('data-nombre-campo');
                	var idcampoFormato = $(this).attr('data-idcampo-formato');
                	var extensiones = $(this).attr('data-extensiones');
                	var multiple_text = $(this).attr('data-multiple');
                	var multiple = false;
                	var form_uuid = $('#form_uuid').val();
                	var maxFiles = 1;
                	if(multiple_text == 'multiple') {
                	multiple = true;
                	maxFiles = 10;
                	}
                    var opciones = {
                        maxFilesize: 2,
                    	ignoreHiddenFiles : true,
                    	maxFiles : maxFiles,
                    	acceptedFiles: extensiones,
                   	addRemoveLinks: true,
                   	dictRemoveFile: 'Quitar anexo',
                   	dictMaxFilesExceeded : 'No puede subir mas archivos',
                   	dictResponseError : 'El servidor respondio con codigo {{statusCode}}',
                	uploadMultiple: multiple,
                    	url: upload_url,
                    	paramName : paramName,
                    	params : {
                        	idformato : idformato,
                        	idcampo_formato : idcampoFormato,
                        	nombre_campo : paramName,
                        	uuid : form_uuid
                        },
                        removedfile : function(file) {
                            if(lista_archivos && lista_archivos[file.upload.uuid]) {
                            	$.ajax({
                            	url: upload_url,
                            	type: 'POST',
                            	data: {
                                	accion:'eliminar_temporal',
                                    	idformato : idformato,
                                    	idcampo_formato : idcampoFormato,
                                	archivo: lista_archivos[file.upload.uuid]}
                            	});
                            }
                            if (file.previewElement != null && file.previewElement.parentNode != null) {
                                file.previewElement.parentNode.removeChild(file.previewElement);
                            	delete lista_archivos[file.upload.uuid];
                            	$('#'+paramName).val(Object.values(lista_archivos).join());
                            }
                            return this._updateMaxFilesReachedClass();
                        },
                        success : function(file, response) {
                        	for (var key in response) {
                            	if(Array.isArray(response[key])) {
                                	for(var i=0; i < response[key].length; i++) {
                                	archivo=response[key][i];
                                    	if(archivo.original_name == file.upload.filename) {
                                    	lista_archivos[file.upload.uuid] = archivo.id;
                                    	}
                                	}
                            	} else {
                            	if(response[key].original_name == file.upload.filename) {
                                	lista_archivos[file.upload.uuid] = response[key].id;
                            	}
                            	}
                        	}
                        	$('#'+paramName).val(Object.values(lista_archivos).join());
                            if($('#dz_campo_'+idcampoFormato).find('label.error').length) {
                                $('#dz_campo_'+idcampoFormato).find('label.error').remove()
                            }
                        }
                    };
                    $(this).dropzone(opciones);
                    $(this).addClass('dropzone');
                });
            });</script>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $(".form-group.form-group-default").click(function() {
                                    $(this).find("input").focus();
                                });

                                if (!this.initFormGroupDefaultRun) {
                                    $("body").on("focus", ".form-group.form-group-default :input", function() {
                                        $(".form-group.form-group-default").removeClass("focused");
                                        $(this).parents(".form-group").addClass("focused");
                                    });

                                    $("body").on("blur", ".form-group.form-group-default :input", function() {
                                        $(this).parents(".form-group").removeClass("focused");
                                        if ($(this).val()) {
                                            $(this).closest(".form-group").find("label").addClass("fade");
                                        } else {
                                            $(this).closest(".form-group").find("label").removeClass("fade");
                                        }
                                    });

                                    // Only run the above code once.
                                    this.initFormGroupDefaultRun = true;
                                }

                                $(".form-group.form-group-default .checkbox, .form-group.form-group-default .radio").hover(function() {
                                    $(this).parents(".form-group").addClass("focused");
                                }, function() {
                                    $(this).parents(".form-group").removeClass("focused");
                                });
                                
                            });
                        </script>
                	</html><?php include_once($ruta_db_superior . FORMATOS_SAIA . "librerias/footer_plantilla.php");?>