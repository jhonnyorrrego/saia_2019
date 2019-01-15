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
                                    <title>.:adicionar Clasificacion de factura:.</title>
                                    <meta name="viewport"
                                    	content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
                                    <meta name="apple-mobile-web-app-capable" content="yes">
                                    <meta name="apple-touch-fullscreen" content="yes">
                                    <meta name="apple-mobile-web-app-status-bar-style" content="default">
                                    <meta content="" name="description" />
                                    <meta content="" name="Cero K" /> <?php include_once($ruta_db_superior . "assets/librerias.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once('../librerias/funciones_formatos_generales.php'); ?><?php include_once('../radicacion_facturas/funciones.php'); ?><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../formatos/librerias/funciones_acciones.php'); ?><?= pace() ?>
                        <?= jquery() ?>
                        <?= bootstrap() ?>
                        <?= breakpoint() ?>
                        <?= toastr() ?>
                        <?= icons() ?>
                        <?= moment() ?><?= validate() ?><script type="text/javascript" src="<?= $ruta_db_superior ?>js/title2note.js"></script><script type="text/javascript" src="<?= $ruta_db_superior ?>js/dhtmlXCommon.js"></script><script type="text/javascript" src="<?= $ruta_db_superior ?>js/dhtmlXTree.js"></script><?php include_once('../../formatos/librerias/header_formato.php'); ?><link rel="STYLESHEET" type="text/css" href="<?= $ruta_db_superior ?>css/dhtmlXTree.css">
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
                            <div class="card-body"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" class="form-horizontal" role="form" autocomplete="off" method="post" action="<?= $ruta_db_superior ?>formatos/librerias/funciones_item.php" enctype="multipart/form-data"><input type="hidden" name="transferido" value="<?php echo(validar_valor_campo(7066)); ?>"><input type="hidden" name="posterior_adicionar" value="<?php echo(validar_valor_campo(7062)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(7065)); ?>"><?php listar_select_padres(); ?><div class="form-group" id="tr_dependencia"><label class="etiqueta_campo" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</label><?php buscar_dependencia(425,7055);?></div><div class="form-group" id="tr_clasificacion_fact">
				                        <label class="etiqueta_campo" title="">CLASIFICACI&Oacute;N*</label>
                                     <?php genera_campo_listados_editar(425,7054,$_REQUEST['iddoc']);?></div><div class="form-group" id="tr_pago_desde">
				                        <label class="etiqueta_campo" title="">PAGO REALIZADO DESDE*</label>
                                     <?php genera_campo_listados_editar(425,7061,$_REQUEST['iddoc']);?></div><div class="form-group" id="tr_no_convenio">
                     <label class="etiqueta_campo" title="">NOMBRE CONVENIO</label>
                     <input class="form-control"  maxlength="255"   tabindex='1'  type="text"  size="100" id="no_convenio" name="no_convenio"  value="<?php echo(validar_valor_campo(7059)); ?>">
                    </div><div class="form-group" id="tr_valor_factura">
                     <label class="etiqueta_campo" title="">VALOR DE LA FACTURA*</label>
                     <input class="form-control"  maxlength="11"  class="required"   tabindex='2'  type="text"  size="100" id="valor_factura" name="valor_factura"  value="<?php echo(validar_valor_campo(7067)); ?>">
                    </div><div class="form-group" id="tr_fecha_programada">
<label class="etiqueta_campo" title="">FECHA PROGRAMADA DE PAGO*</label>
<div class="input-group">
<input  tabindex="3 " type="text" class="form-control"  id="fecha_programada" name="fecha_programada">
<span class="input-group-text"><i class="fa fa-calendar"></i></span>
</div>
<script type="text/javascript">
            $(function () {
                var configuracion={"format":"L","locale":"es","useCurrent":true};
                $("#fecha_programada").datetimepicker(configuracion);
                $("#content_container").height($(window).height());
            });
        </script>
</div><div class="form-group" id="tr_prioridad">
				                        <label class="etiqueta_campo" title="1,Baja;2,Media;3,Alta">PRIORIDAD</label>
                                     <?php genera_campo_listados_editar(425,7063,$_REQUEST['iddoc']);?></div><div class="form-group" id="tr_numero_orden">
                     <label class="etiqueta_campo" title="">N&Uacute;MERO ORDEN COMPRA / CONTRATO*</label>
                     <input class="form-control"  maxlength="255"  class="required"   tabindex='4'  type="text"  size="100" id="numero_orden" name="numero_orden"  value="<?php echo(validar_valor_campo(7060)); ?>">
                    </div><div class="form-group" id="tr_responsable">
                                <label class="etiqueta_campo" title="">Responsable*</label><div class="form-control"><div id="seleccionados"><?php if(isset($_REQUEST["iddoc"])){mostrar_seleccionados(425,7064,'5',$_REQUEST['iddoc']);}?></div><br/>Buscar: <input  tabindex='5'  type="text" id="stext_responsable" width="200px" size="25" onblur="closetree_responsable()"> <input type="hidden" id="idclosetree_responsable">
                                <a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value),0,1)">
                                    <img src="../../botones/general/buscar.png"border="0px">
                                </a>
                                    <a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value),1)">
                                        <img src="../../botones/general/anterior.png"border="0px">
                                    </a>
                                <a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value))">
                                    <img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="responsable" id="responsable"   value="" ><label style="display:none" class="error" for="responsable">Campo obligatorio.</label><div id="esperando_responsable">
                                    <img src="../../imagenes/cargando.gif">
                                </div>
                                <div id="treeboxbox_responsable" height="90%"></div><script type="text/javascript">
                                var browserType;
                                if (document.layers) {browserType = "nn4"}
                                if (document.all) {browserType = "ie"}
                                if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                                    browserType= "gecko"
                                }
                                tree_responsable=new dhtmlXTreeObject("treeboxbox_responsable","100%","100%",0);
                                tree_responsable.setImagePath("../../imgs/");
                                tree_responsable.enableTreeImages("false");
                                tree_responsable.enableTreeLines("false");
                                tree_responsable.enableIEImageFix(true);tree_responsable.enableCheckBoxes(1);
                                    tree_responsable.enableRadioButtons(true);
                                    tree_responsable.enableSingleRadioMode(true);tree_responsable.setOnLoadingStart(cargando_responsable);
                                tree_responsable.setOnLoadingEnd(fin_cargando_responsable);tree_responsable.enableSmartXMLParsing(true);tree_responsable.loadXML("../../test.php?rol=1&sin_padre=1");tree_responsable.setOnCheckHandler(onNodeSelect_responsable);
                                    function onNodeSelect_responsable(nodeId) {
                                        valor_destino=document.getElementById("responsable");
                                        if(tree_responsable.isItemChecked(nodeId)){
                                            if(valor_destino.value!=="")
                                            tree_responsable.setCheck(valor_destino.value,false);

                                            valor_destino.value=nodeId.split(/[_.]/)[0];
                                        }else{
                                            valor_destino.value="";
                                        }
                                    }function fin_cargando_responsable() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_responsable")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_responsable")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_responsable"]');
                                    }
                                    document.poppedLayer.style.display = "none";
                                }

                                function cargando_responsable() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_responsable")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_responsable")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_responsable"]');
                                    }
                                    document.poppedLayer.style.display = "";
                                }</script></div></div><input type="hidden" name="idft_item_facturas" value="<?php echo(validar_valor_campo(7058)); ?>"><div "form-group"><label>ACCION A SEGUIR LUEGO DE GUARDAR</label><input type="radio" name="opcion_item" id="opcion_item1" value="adicionar">Adicionar otro&nbsp;&nbsp;<input type="radio" id="opcion_item2" name="opcion_item" value="terminar" checked>Terminar</div><?php digitalizar_formato(425,NULL);?><?php validar_digitalizacion_formato(425,NULL);?><?php add_edit(425,NULL);?><?php mostrar_radicado_factura(425,NULL);?><?php autocompletar_convenio_clasificacion(425,NULL);?><?php add_edit_item_facturas(425,NULL);?><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="item_facturas"><input type="hidden" name="accion" value="guardar_item" ><tr><td colspan='2'><?php submit_formato(425);?></td></tr></table></form></body>
                		</html>