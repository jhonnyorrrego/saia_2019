<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

if (!isset($_REQUEST["iddoc"])) {
    return false;
}

include_once $ruta_db_superior . 'controllers/autoload.php';
include_once $ruta_db_superior . "views/documento/encabezado.php";

if (!PermisoController::moduleAccess("editar_paginas")) {
    return false;
}
$iddocumento = $_REQUEST["iddoc"];
?>
<!DOCTYPE >
<html>
	<head>
		<style>
			#sortable {
				list-style-type: none;
				margin: 0;
				padding: 0;
				width: 100%;
				border: 0px;
			}
			#sortable li {
				margin: 0.4em;
				padding: 3px;
				float: left;
				width: 90px !important;
				height: auto !important;
				text-align: center;
				border: 0px;
			}
		</style>
	</head>
	<body>
		<div class="container-fluid bg-master-lightest px-4">
			<div class="row sticky-top pt-2 bg-master-lightest px-3">
				<?=plantilla($iddocumento); ?>
			</div>
			<div class="row">
				<div class="col-12">
					<a data-toggle="modal" data-target="#confirm" class="btn btn-mini float-right"><i class="fa fa-save"></i></a>
					<a style="display: none" id="confirmDelete" data-toggle="modal" data-target="#deletePagina"></a>
				</div>
			</div>
			<hr/>

			<div class="row">
				<div class="col-12">
					<div id="infoPagina"></div>

					<!-- Modal -->
					<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">¿Esta seguro de guardar los cambios?</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body"></div>
								<div class="modal-footer">
									<button id="btn-cancel" type="button" class="btn btn-danger" data-dismiss="modal">
										Cancelar
									</button>
									<button id="btn-save" type="button" class="btn btn-complete" data-dismiss="modal">
										Guardar
									</button>
								</div>
							</div>
						</div>
					</div>
					<!-- Termina Modal -->

					<!-- Modal Delete-->
					<div class="modal fade" id="deletePagina" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">¿Est&aacute; seguro de eliminar la p&aacute;gina?</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body deletePagina"></div>
								<div class="modal-footer">
									<button id="btn-cancelPagina" data-id="" type="button" class="btn btn-danger" data-dismiss="modal">
										Cancelar
									</button>
									<button id="btn-deletePagina" data-id="" type="button" class="btn btn-complete" data-dismiss="modal">
										Eliminar
									</button>
								</div>
							</div>
						</div>
					</div>
					<!-- Termina Modal -->
				</div>
			</div>

		</div>
		<script src="<?= $ruta_db_superior; ?>assets/theme/assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
		<script>
			$(document).ready(function() {
                var iddoc=parseInt(<?=$iddocumento; ?>);
				var baseUrl = $("#baseUrl", window.top.document).data('baseurl');
				var sort = new Array();
				var del = new Array();
				var y = 0;

				var listarPaginas = function() {
					sort = new Array();
					del = new Array();
					y = 0;
					$.ajax({
						url : baseUrl + 'app/pagina/obtenerpagina.php',
						data : {
							iddoc : iddoc
						},
						type : 'post',
						dataType : 'html',
						success : function(data) {
							$("#infoPagina").empty().html(data);
							$("#sortable").sortable();
							$("#sortable").disableSelection();
						},
						error : function() {
                            top.notification({
                                message: 'No es posible cargar la informaci&oacute;n',
                                type: 'error',
                                title: 'Error!'
                            });
						}
					});
				}
				listarPaginas();

				$(document).on("dblclick", ".img", function() {
					let
					src = $(this).attr("src");
					let
					idimg = $(this).data("id");
					$("#btn-cancelPagina,#btn-deletePagina").attr("data-id", idimg);
					$(".deletePagina").empty().html('<br/><img class="img-thumbnail" src="' + src + '" />');
					$("#confirmDelete").trigger("click");
				});

				$(document).on("click", "#btn-deletePagina", function() {
					let	id = $(this).attr("data-id");
					del[y] = {
						"id" : id
					};
					y++;
					$("#" + id).remove();
				});

				$(document).on("click", "#btn-save", function() {
					let	x = 0;
					$.each($("#sortable >li"), function(i, val) {
						sort[x] = {
							"id" : $(this).attr("id"),
							"pagina" : i + 1
						};
						x++;
					});
					let	info = {
						ordenar : $.extend({}, sort),
						eliminar : $.extend({}, del)
					};
					$.ajax({
						url : baseUrl + 'app/pagina/actualizarpagina.php',
						data : info,
						type : 'post',
						dataType : 'json',
						success : function(data) {
							if (data.success == 1) {
                                top.notification({
                                    message: data.message,
                                    type: 'success'
                                });
								listarPaginas();
							} else {
                                top.notification({
                                    message: data.message,
                                    type: 'error',
                                    title: 'Error!'
                                });
							}
						},
						error : function() {
                            top.notification({
                                message: 'No es posible actualizar la informaci&oacute;n',
                                type: 'error',
                                title: 'Error!'
                            });
						}
					});
				});
			});
		</script>
	</body>
</html>