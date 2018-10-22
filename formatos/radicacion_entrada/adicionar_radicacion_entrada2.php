<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }
    
    $ruta .= '../';
    $max_salida --;
}

include_once $ruta_db_superior . '<?= $ruta_db_superior ?>assets/theme/assets/librerias.php';
?>
<!DOCTYPE html>
<html>

<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>.:ADICIONAR RADICACI&Oacute;N DE CORRESPONDENCIA:.</title>
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta content="" name="description" />
<meta content="" name="Cero K" />
    <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap3-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-tag/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
    <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css" />
    <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" media="screen">
    <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/summernote/css/summernote.css" rel="stylesheet" type="text/css" media="screen">
    <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" media="screen">
    <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" media="screen">
    <link class="main-stylesheet" href="<?= $ruta_db_superior ?>assets/theme/pages/css/pages.css" rel="stylesheet" type="text/css" />';
    <link class="main-stylesheet" href="<?= $ruta_db_superior ?>assets/theme/pages/js/pages.js" rel="stylesheet" type="text/css" />';

    <link href="<?= $ruta_db_superior ?>assets/theme/pages/css/pages-icons.css" rel="stylesheet" type="text/css">
</head>
<html>

<script type="text/javascript"
	src="<?= $ruta_db_superior ?>formatos/librerias/funciones_formatos.js"></script>
<?php include_once("<?= $ruta_db_superior ?>formatos/carta/funciones.php"); ?>
<?php include_once("funciones.php"); ?>
<?php include_once("<?= $ruta_db_superior ?>librerias/funciones_formatos_generales.php"); ?>
<?php include_once("<?= $ruta_db_superior ?>formatos/librerias/funciones_generales.php"); ?>
<?php include_once("<?= $ruta_db_superior ?>formatos/librerias/funciones_acciones.php"); ?>
<?php include_once("<?= $ruta_db_superior ?>formatos/librerias/estilo_formulario.php"); ?>
<?php include_once("<?= $ruta_db_superior ?>formatos/librerias/header_formato.php"); ?>


<script type="text/javascript"
	src="<?= $ruta_db_superior ?>js/title2note.js"></script>
<script type="text/javascript"
	src="<?= $ruta_db_superior ?>js/dhtmlXCommon.js"></script>
<script type="text/javascript"
	src="<?= $ruta_db_superior ?>js/dhtmlXTree.js"></script>
<link rel="STYLESHEET" type="text/css"
	href="<?= $ruta_db_superior ?>css/dhtmlXTree.css">
<script type="text/javascript"
	src="<?= $ruta_db_superior ?>dropzone/dist/dropzone.js"></script>
<?php include_once("<?= $ruta_db_superior ?>anexosdigitales/funciones_archivo.php"); ?><script
	type="text/javascript"
	src="<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css"
	href="<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/highslide.css" />
</style>
<link href="<?= $ruta_db_superior ?>dropzone/dist/dropzone_saia.css"
	type="text/css" rel="stylesheet" />
<script type='text/javascript'> hs.graphicsDir = '<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/graphics/'; hs.outlineType = 'rounded-white';</script>

</head>
<div class=" container-fluid   container-fixed-lg">
	<!-- START card -->
	<div class="card card-transparent">
		<div class="card-header "></div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-10">
					<h3>RADICACIÓN DE CORRESPONDENCIA</h3>
					<form name="formulario_formatos" id="formulario_formatos"
						class="form-horizontal" role="form" autocomplete="off"
						method="post"
						action="<?= $ruta_db_superior ?>class_transferencia.php"
						enctype="multipart/form-data">
						<div class="form-group row">
							<label for="fname" class="col-md-3 control-label">DEPENDENCIA DEL
								CREADOR DEL DOCUMENTO*</label>
							<div class="col-md-9">
								<input class="required" type="hidden" value="1" id="dependencia"
									name="dependencia"> <label for="fname"
									class="col-md-9 control-label">SU ORGANIZACION - (Administrador
									de Mensajería)</label>
							</div>
						</div>
						<p class="m-t-10">DATOS GENERALES</p>
						<div class="form-group row">
							<label class="col-md-3 control-label">FECHA DOCUMENTO ENTRADA</label>

							<div class="input-group date col-md-9 p-l-0">
								<input type="text" class="form-control"
									id="fecha_oficio_entrada" name="fecha_oficio_entrada">
								<div class="input-group-append ">
									<span class="input-group-text"><i class="fa fa-calendar"></i></span>
								</div>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-3 control-label">Your gender</label>
							<div class="col-md-9">
								<div class="radio radio-success">
									<input type="radio" value="male" name="optionyes" id="male"> <label
										for="male">Male</label> <input type="radio" checked="checked"
										value="female" name="optionyes" id="female"> <label
										for="female">Female</label>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 control-label">Work</label>
							<div class="col-md-9">
								<p>Have you Worked at page Inc. before, Or joined the Pages
									Supirior Club?</p>
								<p class="hint-text small">If yes State which Place, if yes note
									date and Job CODE / Membership Number</p>
								<div class="row">
									<div class="col-md-5">
										<input type="text" class="form-control" required>
									</div>
									<div class="col-md-5 sm-m-t-10">
										<input type="text" placeholder="Code/Number"
											class="form-control">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="position" class="col-md-3 control-label">Position
								applying for</label>
							<div class="col-md-9">
								<input type="text" class="form-control" id="position"
									placeholder="Designation" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="name" class="col-md-3 control-label">Description</label>
							<div class="col-md-9">
								<textarea class="form-control" id="name"
									placeholder="Briefly Describe your Abilities"></textarea>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-3">
								<p>I hereby certify that the information above is true and
									accurate.</p>
							</div>
							<div class="col-md-9">
								<button class="btn btn-success" type="submit">Submit</button>
								<button class="btn btn-default">
									<i class="pg-close"></i> Clear
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- END card -->
</div>
<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/popper/umd/popper.min.js" type="text/javascript"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-actual/jquery.actual.min.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script type="text/javascript" src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/classie/classie.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap3-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script type="text/javascript" src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-autonumeric/autoNumeric.js"></script>
    <script type="text/javascript" src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/dropzone.min.js"></script>
    <script type="text/javascript" src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js"></script>
    <script type="text/javascript" src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-inputmask/jquery.inputmask.min.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-form-wizard/js/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/summernote/js/summernote.min.js" type="text/javascript"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/moment/moment.min.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-typehead/typeahead.bundle.min.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-typehead/typeahead.jquery.min.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/handlebars/handlebars-v4.0.5.js"></script>
    <!-- END VENDOR JS -->
    <!-- BEGIN CORE TEMPLATE JS -->
    <!-- BEGIN CORE TEMPLATE JS -->

    <!-- END CORE TEMPLATE JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/js/scripts.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->
    <!-- END CORE TEMPLATE JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/js/form_elements.js" type="text/javascript"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/js/scripts.js" type="text/javascript"></script>