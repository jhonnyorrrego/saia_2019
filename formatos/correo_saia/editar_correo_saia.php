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
                                    <title>.:EDITAR CORREO SAIA:.</title>
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
                        <?= moment() ?><?= validate() ?><script type="text/javascript" src="<?= $ruta_db_superior ?>js/title2note.js"></script><script type="text/javascript" src="<?= $ruta_db_superior ?>js/dhtmlXCommon.js"></script><script type="text/javascript" src="<?= $ruta_db_superior ?>js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="<?= $ruta_db_superior ?>css/dhtmlXTree.css"><link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>css/selectize.css"/><script type="text/javascript" src="<?= $ruta_db_superior ?>js/selectize.js"></script>
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
                            <div class="card-body"><center><h4 class="text-black">CORREO SAIA</h4></center><?php llama_funcion_accion(@$_REQUEST["iddoc"],348,"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" role="form" autocomplete="off" method="post" action="<?= $ruta_db_superior ?>class_transferencia.php"" enctype="multipart/form-data"><input type="hidden" name="ingresar_datos_factu" value="<?php echo(mostrar_valor_campo('ingresar_datos_factu',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="fecha_datos" value="<?php echo(mostrar_valor_campo('fecha_datos',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="responsable_datos_fa" value="<?php echo(mostrar_valor_campo('responsable_datos_fa',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="fecha_factura" value="<?php echo(mostrar_valor_campo('fecha_factura',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="cant_dias" value="<?php echo(mostrar_valor_campo('cant_dias',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="fecha_venc_fact" value="<?php echo(mostrar_valor_campo('fecha_venc_fact',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="concepto_fact" value="<?php echo(mostrar_valor_campo('concepto_fact',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="valor_factura" value="<?php echo(mostrar_valor_campo('valor_factura',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="pago_desde" value="<?php echo(mostrar_valor_campo('pago_desde',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_correo_saia" value="<?php echo(mostrar_valor_campo('idft_correo_saia',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',348,$_REQUEST['iddoc'])); ?>"><div class="form-group" id="tr_dependencia"><label title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</label><?php buscar_dependencia(348,4038,$_REQUEST['iddoc']);?></div><div class="form-group form-group-default required"  id="tr_asunto">
                                        <label title="Asunto del correo">ASUNTO</label>
                                        <input class="form-control"  maxlength="255"  class="required"   tabindex='1'  type="text"  size="100" id="asunto" name="asunto" required value="<?php echo(mostrar_valor_campo('asunto',348,$_REQUEST['iddoc'])); ?>">
                                       </div><div class="form-group form-group form-group-default id="tr_fecha_oficio_entrada">
<label title="Fecha de entrada del oficio">FECHA OFICIO ENTRADA*</label>
<div class="input-group">
<input  tabindex="2 " type="text" class="form-control"  id="fecha_oficio_entrada"  required name="fecha_oficio_entrada">
<span class="input-group-text"><i class="fa fa-calendar"></i></span>
</div>
<script type="text/javascript">
            $(function () {
                var configuracion={"defaultDate":"<?php echo(mostrar_valor_campo('fecha_oficio_entrada',348,$_REQUEST['iddoc'])); ?>","format":"YYYY-MM-DD LT","locale":"es","useCurrent":true};
                $("#fecha_oficio_entrada").datetimepicker(configuracion);
                $("#content_container").height($(window).height());
            });
        </script>
</div><div class="form-group form-group-default required"  id="tr_de">
                                        <label title="Remitente del correo">DE</label>
                                        <input class="form-control"  maxlength="255"  class="required"   tabindex='3'  type="text"  size="100" id="de" name="de" required value="<?php echo(mostrar_valor_campo('de',348,$_REQUEST['iddoc'])); ?>">
                                       </div><div class="form-group form-group-default required"  id="tr_para">
                                        <label title="">PARA</label>
                                        <input class="form-control"   class="required"   tabindex='4'  type="text"  size="100" id="para" name="para" required value="<?php echo(mostrar_valor_campo('para',348,$_REQUEST['iddoc'])); ?>">
                                       </div><div class="form-group" id="tr_transferencia_correo">
                                       <label title="">TRANSFERIR</label><input type="text" class="form-control" name="transferencia_correo" id="transferencia_correo" value="" data-data='<?php echo(mostrar_autocompletar('transferencia_correo', 348, $_REQUEST['iddoc'])); ?>'required></div>
    <script>
    $(document).ready(function(){
	$("[name='transferencia_correo']").selectize({
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
    });</script><div class="form-group" id="tr_copia_correo">
                                <label title="">CON COPIA</label><div class="form-control"><div id="seleccionados"><?php if(isset($_REQUEST["iddoc"])){mostrar_seleccionados(348,4085,'5',$_REQUEST['iddoc']);}?></div><br/>Buscar: <input  tabindex='5'  type="text" id="stext_copia_correo" width="200px" size="25" onblur="closetree_copia_correo()"> <input type="hidden" id="idclosetree_copia_correo">
                                <a href="javascript:void(0)" onclick="buscar_nodo_copia_correo('tree_copia_correo')">
                                    <img src="../../botones/general/buscar.png"border="0px">
                                </a>
                                    <a href="javascript:void(0)" onclick="tree_copia_correo.findItem((document.getElementById('stext_copia_correo').value),1)">
                                        <img src="../../botones/general/anterior.png"border="0px">
                                    </a>
                                <a href="javascript:void(0)" onclick="tree_copia_correo.findItem((document.getElementById('stext_copia_correo').value))">
                                    <img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  name="copia_correo" id="copia_correo"   value="<?php if(isset($_REQUEST["iddoc"])){cargar_seleccionados(348,4085,1,$_REQUEST['iddoc']);}?>" ><div id="esperando_copia_correo">
                                    <img src="../../imagenes/cargando.gif">
                                </div>
                                <div id="treeboxbox_copia_correo" height="90%"></div><script type="text/javascript">
                                var browserType;
                                if (document.layers) {browserType = "nn4"}
                                if (document.all) {browserType = "ie"}
                                if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                                    browserType= "gecko"
                                }
                                tree_copia_correo=new dhtmlXTreeObject("treeboxbox_copia_correo","100%","100%",0);
                                tree_copia_correo.setImagePath("../../imgs/");
                                tree_copia_correo.enableTreeImages("false");
                                tree_copia_correo.enableTreeLines("false");
                                tree_copia_correo.enableIEImageFix(true);tree_copia_correo.enableCheckBoxes(1);
                                    tree_copia_correo.enableThreeStateCheckboxes(1);tree_copia_correo.setOnLoadingStart(cargando_copia_correo);
                                tree_copia_correo.setOnLoadingEnd(fin_cargando_copia_correo);tree_copia_correo.setXMLAutoLoading("../../test_funcionario.php?rol=1&cargar_partes=1");tree_copia_correo.loadXML("../../test_funcionario.php?rol=1&cargar_partes=1",checkear_arbol);tree_copia_correo.setOnCheckHandler(onNodeSelect_copia_correo);

                                    function onNodeSelect_copia_correo(nodeId){
                                        valor_destino=document.getElementById("copia_correo");
                                        destinos=tree_copia_correo.getAllChecked();
                                        nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                                        nuevo=nuevo.replace(/\,$/gi,"");
                                        vector=destinos.split(",");
                                        for(i=0;i<vector.length;i++){
                                            if(vector[i].indexOf("_")!=-1){
                                                vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                                            }
                                            nuevo=vector.join(",");
                                            if(vector[i].indexOf("#")!=-1){
                                                hijos=tree_copia_correo.getAllSubItems(vector[i]);
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

                function buscar_nodo_copia_correo() {
                    $.ajax({
                        type : 'POST',
                        url : '../../test_funcionario_buscar.php',
                        dataType : 'json',
                        data : {
                            nombre : $('#stext_copia_correo').val(),
                            tabla : 'dependencia'
                        },
                        success : function(data) {
                            if(data['error']){
                                alert(data['mensaje']);
}
                            else{
                                tree_copia_correo.attachEvent('onOpenDynamicEnd', function(){
                                    tree_copia_correo.selectItem('1#',false,false);
                                    tree_copia_correo.clearSelection();
                                    for(var i=0;i<data['numcampos_func'];i++){
                                        tree_copia_correo.selectItem(data['funcionarios'][i],false,true);
                                    }
                                    for(var i=0;i<data['numcampos_dep'];i++){
                                        tree_copia_correo.selectItem(data['dependencias'][i],false,true);
                                    }
                                });
                                tree_copia_correo.openItemsDynamic(data['datos'],true);
                            }
                        }
                    });
                }
                </script>function closetree_copia_correo() {
                                    var bus_ant=document.getElementById('idclosetree_copia_correo').value;
                                    var bus_actual=document.getElementById('stext_copia_correo').value.trim();
                                    if(bus_actual!=''){
                                        if(bus_actual!=bus_ant){
                                            document.getElementById('idclosetree_copia_correo').value=bus_actual;
                                            tree_copia_correo.closeAllItems('1#');
                                        }
                                    }
                                }function fin_cargando_copia_correo() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_copia_correo")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_copia_correo")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_copia_correo"]');
                                    }
                                    document.poppedLayer.style.display = "none";
                                }

                                function cargando_copia_correo() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_copia_correo")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_copia_correo")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_copia_correo"]');
                                    }
                                    document.poppedLayer.style.display = "";
                                }function checkear_arbol(){
                                        vector2="<?php if(isset($_REQUEST["iddoc"])){cargar_seleccionados(348,4085,1,$_REQUEST['iddoc']);}?>";
                                        vector2=vector2.split(",");
                                        for(m=0;m<vector2.length;m++) {
                                            tree_copia_correo.setCheck(vector2[m],true);
                                        }
                                    }
</script></div></div><div class="form-group" id="tr_comentario">
                                        <label title="Comentario del correo">COMENTARIO</label>
                                        <div class="celda_transparente">
                                        <textarea  tabindex='6'  name="comentario" id="comentario" cols="53" rows="3" class="form-control tiny_basico"><?php echo(mostrar_valor_campo('comentario',348,$_REQUEST['iddoc'])); ?></textarea></div></div><input type="hidden" name="anexos" value="<?php echo(mostrar_valor_campo('anexos',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="no_factura" value="<?php echo(mostrar_valor_campo('no_factura',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="nit_proveedor" value="<?php echo(mostrar_valor_campo('nit_proveedor',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="centro_costo" value="<?php echo(mostrar_valor_campo('centro_costo',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="adjunto_imagen" value="<?php echo(mostrar_valor_campo('adjunto_imagen',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('4031'); ?>"><input type="hidden" name="formato" value="348"><tr><td colspan='2'><?php submit_formato(348,$_REQUEST['iddoc']);?></td></tr></table></form></body>
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