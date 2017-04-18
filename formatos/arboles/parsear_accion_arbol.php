<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
include ("../../db.php");
include ("../../class_transferencia.php");
// print_r($_REQUEST); die();
// echo("<br /><br />");
$formato["numcampos"] = 0;

if(@$_REQUEST["id"]) {
	$datos = parsea_idformato($_REQUEST["id"]);
	$formato = busca_filtro_tabla("", "formato", "idformato=" . $datos[0], "", $conn);
	// print_r($datos);die();
	if(!$datos[2] && $datos[3] == "mostrar") {
		$datos[3] = "detalle_mostrar";
	}

	if($formato["numcampos"]) {
		$ruta = "";
		$alerta = "existe problema para redireccionar";
		if($datos[1] && $datos[2]) {
			$datos_formato = busca_filtro_tabla("", $formato[0]["nombre_tabla"] . ",documento", "documento_iddocumento=iddocumento and id" . $formato[0]["nombre_tabla"] . "=" . $datos[2], "", $conn);
		}
		// die($datos[3]);
		switch($datos[3]) {
			case "documento_por_vincular":
				$documento = busca_filtro_tabla("", "documento A," . $formato[0]["nombre_tabla"] . " B", "A.iddocumento=B.documento_iddocumento AND B.id" . $formato[0]["nombre_tabla"] . "=" . $datos[2], "", $conn);
				if($documento["numcampos"]) {
					$ruta = RUTA_SAIA . "pantallas/documento/documento_por_vincular.php?iddocumento=" . $documento[0]["iddocumento"];
				}
				break;
			case "documentos_seleccionados":
				$documento = busca_filtro_tabla("", "documento A," . $formato[0]["nombre_tabla"] . " B", "A.iddocumento=B.documento_iddocumento AND B.id" . $formato[0]["nombre_tabla"] . "=" . $datos[2], "", $conn);
				if($documento["numcampos"]) {
					$ruta = RUTA_SAIA . "pantallas/documento/documento_seleccionados.php?iddoc=" . $documento[0]["iddocumento"];
				}
				break;
			case "aprobar":
				include_once (RUTA_SAIA . "class_transferencia.php");
				$documento = busca_filtro_tabla("", "documento A," . $formato[0]["nombre_tabla"] . " B", "A.iddocumento=B.documento_iddocumento AND B.id" . $formato[0]["nombre_tabla"] . "=" . $datos[2], "", $conn);

				if($documento["numcampos"]) {
					if(!$documento[0]["numero"]) {
						aprobar($documento[0]["iddocumento"]);
					} else {
						alerta("El documento ya ha sido aprobado y posee el radicado numero: " . $documento[0]["numero"]);
					}
				}
				break;
			case "mostrar_versiones":
				$ruta = RUTA_SAIA . "versionamiento/listar_versiones.php?key=" . $datos_formato[0]["documento_iddocumento"];
				break;
			case "mostrar_versiones":
				$ruta = RUTA_SAIA . "versionamiento/listar_versiones.php?key=" . $datos_formato[0]["documento_iddocumento"];
				break;
			case "adicionar_etiqueta":
				$ruta = RUTA_SAIA . "etiqueta.php?accion=seleccionar_etiqueta&key=" . $datos_formato[0]["documento_iddocumento"];
				break;
			case "solicitar_anulacion":
				$ruta = RUTA_SAIA . "solicitar_anulacion.php?accion=adicionar&key=" . $datos_formato[0]["documento_iddocumento"];
				break;
			case "permisos_documento":
				$ruta = RUTA_SAIA . "permisos_documento.php?accion=ver&iddoc=" . $datos_formato[0]["documento_iddocumento"];
				break;
			case "crear_version":
				$ruta = RUTA_SAIA . "versionamiento/crear_version.php?key=" . $datos_formato[0]["documento_iddocumento"];
				break;
			case "ver_notas":
				if($datos_formato[0]["estado"] == "ACTIVO" || $formato[0]["mostrar_pdf"] == 0) {
					$ruta = "/" . RUTA_SAIA . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $formato[0]["ruta_mostrar"] . "?iddoc=" . $datos_formato[0]["documento_iddocumento"] . "&idformato=" . $formato[0]["idformato"] . "&ver_notas=1";
				} else {
					$ruta = RUTA_SAIA . "pantallas/notas/ver_notas_documento.php?iddoc=" . $datos_formato[0]["documento_iddocumento"] . "&idformato=" . $formato[0]["idformato"] . "&ver_notas=1";
				}
				break;
			case "vincular_documento":
				$ruta = RUTA_SAIA . "vincular_documentoview.php?iddoc=" . $datos_formato[0]["documento_iddocumento"];
				break;
			case "verificar_flujo_documento":
				$ruta = RUTA_SAIA . "flujos_documento.php?key=" . $datos_formato[0]["documento_iddocumento"];
				break;
			case "navegacion_respuesta":
				$ruta = RUTA_SAIA . "navegacion_respuesta_doc.php?iddoc=" . $datos_formato[0]["documento_iddocumento"];
				break;
			case "notas":
				$ruta = "/" . RUTA_SAIA . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $formato[0]["ruta_mostrar"] . "?iddoc=" . $datos_formato[0]["documento_iddocumento"] . "&idformato=" . $formato[0]["idformato"] . "&ver_notas=1";
				// die($ruta);
				break;
			case "mostrar":
				if($formato[0]["item"]) {
					$ruta = "/" . RUTA_SAIA . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $formato[0]["ruta_mostrar"] . "?iddoc=" . $datos[2] . "&idformato=" . $formato[0]["idformato"];
				} else {
					$descargable = array(
							"instructivo",
							"formato",
							"guia",
							"manual",
							"plan_calidad",
							"otros_calidad",
							"prog_calidad"
					);
					leido(usuario_actual("funcionario_codigo"), $datos_formato[0]["iddocumento"]);
					if(in_array($formato[0]["nombre"], $descargable) && @$_REQUEST['pantalla'] == 'calidad') {
						if($datos_formato["numcampos"]) {

							$anexo = busca_filtro_tabla("", "anexos", "(formato=" . $formato[0]["idformato"] . " AND documento_iddocumento=" . $datos_formato[0]["iddocumento"] . ")", "idanexos desc", $conn);
							if(is_file("../../" . $anexo[0]["ruta"])) {
								$ruta = RUTA_SAIA . $anexo[0]["ruta"];
								redirecciona($ruta);
								die();
							} else {
								alerta("No hay anexos relacionados.");
								$ruta = RUTA_SAIA . "vacio.php";
							}
						} else {
							alerta("Problemas al encontrar el Documento");
						}
					} else {
						$postit = busca_filtro_tabla("count(*)", "comentario_img", "documento_iddocumento=" . $datos_formato[0]["iddocumento"] . " AND tipo='PLANTILLA' AND pagina='" . $datos_formato[0]["iddocumento"] . "'", "", $conn);
						$nota_trans = busca_filtro_tabla("notas", "buzon_salida,funcionario", "funcionario_codigo=origen and destino=" . usuario_actual("funcionario_codigo") . " and notas is not null and nombre in('TRANSFERIDO','DEVOLUCION') and archivo_idarchivo=" . $datos_formato[0]["iddocumento"], "fecha desc", $conn);
						/*
						 * if($postit[0][0] || $nota_trans["numcampos"])
						 * alerta("El documento tiene notas relacionadas, Por favor revise el icono ver notas o el rastro");
						 */
						if($datos_formato["numcampos"]) {
							if($datos_formato[0]["pdf"] && $formato[0]["mostrar_pdf"] == 1) {
								$ruta = "/" . RUTA_SAIA . "pantallas/documento/visor_documento.php?iddoc=" . $datos_formato[0]["documento_iddocumento"];
								redirecciona($ruta . "&rnd=" . rand(0, 100));
							} else {
								if($formato[0]["mostrar_pdf"] == 1) {
									$ruta = "/" . RUTA_SAIA . "pantallas/documento/visor_documento.php?iddoc=" . $datos_formato[0]["documento_iddocumento"] . "&actualizar_pdf=1";
									redirecciona($ruta . "&rnd=" . rand(0, 100));
								} else if($formato[0]["mostrar_pdf"] == 2) {
									$ruta = "/" . RUTA_SAIA . "pantallas/documento/visor_documento.php?pdf_word=1&iddoc=" . $datos_formato[0]["documento_iddocumento"];

									redirecciona($ruta . "&rnd=" . rand(0, 100));
								} else {
									$ruta = "/" . RUTA_SAIA . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $formato[0]["ruta_mostrar"] . "?iddoc=" . $datos_formato[0]["documento_iddocumento"] . "&idformato=" . $formato[0]["idformato"];
								}
								if(!$datos_formato[0]["pdf"] && $formato[0]["mostrar_pdf"] == 1) {
									// $ruta=RUTA_SAIA . "class_impresion.php?iddoc=".$datos_formato[0]["documento_iddocumento"];
								}
							}
							if(is_file("../../" . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $formato[0]["ruta_mostrar"]))
								redirecciona($ruta);
							else if(is_file("../../" . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/previo_" . $formato[0]["ruta_mostrar"]))
								redirecciona("/" . RUTA_SAIA . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/previo_" . $formato[0]["ruta_mostrar"]);
						}
					}
				}
				break;
			case "detalle_mostrar":
			   // print_r("../" . $formato[0]["nombre"] . "/" . "previo_" . $formato[0]["ruta_mostrar"]);die();
				if(is_file("../../" . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . "previo_" . $formato[0]["ruta_mostrar"])) {
					$datos_padre = parsea_idformato($_REQUEST["llave"]);
					$formato2 = busca_filtro_tabla("", "formato", "idformato=" . $datos_padre[0], "", $conn);
					$datos_formato2 = busca_filtro_tabla("", "documento A," . $formato2[0]["nombre_tabla"] . " B", "A.iddocumento=B.documento_iddocumento AND id" . $formato2[0]["nombre_tabla"] . "=" . $datos_padre[2], "", $conn);
					$ruta = "/" . RUTA_SAIA . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . "previo_" . $formato[0]["ruta_mostrar"] . "?llave=" . $_REQUEST["llave"] . "&iddoc=" . $datos_formato2[0]["iddocumento"];
					if(@$_REQUEST["enlace_adicionar_formato"]) {
						$ruta .= "&enlace_adicionar_formato=" . $_REQUEST["enlace_adicionar_formato"] . "&padre=" . $datos_padre[2] . "&formato_padre=" . $datos[0];
					}
				} else
					$ruta = RUTA_SAIA . "vacio.php";
				break;
			case "adicionar":
				if(!$datos[2] && $_REQUEST["llave"] && $datos[0]) {

					$datos_padre = parsea_idformato($_REQUEST["llave"]);
					$formato2 = busca_filtro_tabla("", "formato", "idformato=" . $datos_padre[0], "", $conn);
					$datos_formato2 = busca_filtro_tabla("", "documento A," . $formato2[0]["nombre_tabla"] . " B", "A.iddocumento=B.documento_iddocumento AND id" . $formato2[0]["nombre_tabla"] . "=" . $datos_padre[2], "", $conn);

					if($formato[0]["item"]) {
						$ruta = RUTA_SAIA . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $formato[0]["ruta_adicionar"] . "?padre=" . $datos[1] . "&idformato=" . $datos[0];
					} elseif($datos_formato2["numcampos"] && $datos_formato2[0]["numero"]) {
						if(array_key_exists("documento_iddocumento", $datos_formato2[0]))
							$ruta = RUTA_SAIA . "responder.php?iddoc=" . $datos_padre[2] . "&idformato=" . $datos[0];
					} else if(!@$datos_formato2[0]["numero"]) {
						$alerta = "No se puede responder el documento porque no ha terminado su proceso.";
					}

					if(is_file("../../" . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/previo_" . $formato[0]["ruta_mostrar"])) {
						redirecciona("/" . RUTA_SAIA . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/previo_" . $formato[0]["ruta_mostrar"] . "?padre=" . $datos_formato2[0]["id" . $formato2[0]["nombre_tabla"]] . "&iddoc=" . $datos_formato2[0]["iddocumento"]);
					}
				}
				break;
			case "vincular":
				if($datos[2] && $datos_formato[0]["numero"]) {

					if($datos_formato["numcampos"] && array_key_exists("documento_iddocumento", $datos_formato[0]) && array_key_exists("numero", $datos_formato[0]))
						$ruta = RUTA_SAIA . "responder.php?iddoc=" . $datos_formato[0]["documento_iddocumento"];
					else {
						alerta("El documento debe estar aprobado para poder responderlo.");
						$ruta = RUTA_SAIA . "vacio.php";
					}
				} else {
					alerta("El documento debe estar aprobado para poder responderlo.");
					$ruta = RUTA_SAIA . "vacio.php";
				}
				break;
			case "editar":
				if($datos[2] && is_file("../../" . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $formato[0]["ruta_editar"]))
					if($formato[0]["item"]) {
						$ruta = RUTA_SAIA . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $formato[0]["ruta_editar"] . "?item=" . $datos[2] . "&idformato=" . $datos[0];
					} elseif($datos_formato["numcampos"] && array_key_exists("documento_iddocumento", $datos_formato[0])) {
						$ruta = RUTA_SAIA . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $formato[0]["ruta_editar"] . "?idformato=" . $datos[0] . "&iddoc=" . $datos_formato[0]["documento_iddocumento"];
					}
				break;
			case "actualizar_pdf":
				$ruta = "/" . RUTA_SAIA . "borrar_pdf.php?iddoc=" . $datos_formato[0]["documento_iddocumento"];
				break;
			case "anexos":
				if($datos[2])
					if($datos_formato["numcampos"] && array_key_exists("documento_iddocumento", $datos_formato[0])) {
						$ruta = RUTA_SAIA . "anexosdigitales/anexos_documento.php?key=" . $datos_formato[0]["documento_iddocumento"] . "&no_menu=1&iddoc=" . $datos_formato[0]["documento_iddocumento"];
					}
				break;
			case "tareas":
				if($datos[2])
					if($datos_formato["numcampos"] && array_key_exists("documento_iddocumento", $datos_formato[0])) {
						$ruta = RUTA_SAIA . "asignaciones/asignacionadd.php?key=" . $datos_formato[0]["documento_iddocumento"] . "&no_menu=1&iddoc=" . $datos_formato[0]["documento_iddocumento"];
					}
				break;
			case "mostrar_paginas":
				if($datos[2])
					if($datos_formato["numcampos"] && array_key_exists("documento_iddocumento", $datos_formato[0])) {
						$ruta = RUTA_SAIA . "ordenar.php?key=" . $datos_formato[0]["documento_iddocumento"] . "&accion=mostrar&no_menu=1&iddoc=" . $datos_formato[0]["documento_iddocumento"];
					}
				break;
			case "ordenar_paginas":
				if($datos[2])
					if($datos_formato["numcampos"] && array_key_exists("documento_iddocumento", $datos_formato[0])) {
						$ruta = RUTA_SAIA . "ordenar.php?key=" . $datos_formato[0]["documento_iddocumento"] . "&no_menu=1&iddoc=" . $datos_formato[0]["documento_iddocumento"];
					}
				break;
			case "seleccionar_impresion":
				if($datos[2])
					if($datos_formato["numcampos"] && array_key_exists("documento_iddocumento", $datos_formato[0])) {
						$ruta = RUTA_SAIA . "seleccionar_impresion.php?doc=" . $datos_formato[0]["documento_iddocumento"] . "&no_menu=1&iddoc=" . $datos_formato[0]["documento_iddocumento"];
					}
				break;
			case "enviar_email":
				if($datos_formato[0]["numero"]) {
					if($datos[2])
						if($datos_formato["numcampos"] && array_key_exists("documento_iddocumento", $datos_formato[0])) {
							$ruta = RUTA_SAIA . "email/email_doc.php?formato_enviar=true&iddoc=" . $datos_formato[0]["documento_iddocumento"] . "&no_menu=1";
						}
				} else {
					alerta(codifica_encabezado("El documento debe tener n�mero de radicado para poder enviarlo"));
					$ruta = RUTA_SAIA . "vacio.php";
				}
				break;
			case "despacho":
				if($datos[2])
					if($datos_formato["numcampos"] && array_key_exists("documento_iddocumento", $datos_formato[0])) {
						$ruta = RUTA_SAIA . "despachar_admin.php?doc=" . $datos_formato[0]["documento_iddocumento"] . "&no_menu=1";
					}
				break;
			case "clasificar":
				if($datos[2])
					if($datos_formato["numcampos"] && array_key_exists("documento_iddocumento", $datos_formato[0])) {
						$ruta = RUTA_SAIA . "clasificar.php?origen=view&iddocumento=" . $datos_formato[0]["documento_iddocumento"] . "&no_menu=1";
					}
				break;
			case "expediente":
				if($datos[2])
					if($datos_formato["numcampos"] && array_key_exists("documento_iddocumento", $datos_formato[0])) {
						$ruta = RUTA_SAIA . "expediente_llenar.php?iddoc=" . $datos_formato[0]["documento_iddocumento"] . "&no_menu=1";
					}
				break;
			case "almacenamiento":
				if($datos_formato[0]["numero"]) {
					if($datos[2])
						if($datos_formato["numcampos"] && array_key_exists("documento_iddocumento", $datos_formato[0])) {
							$ruta = RUTA_SAIA . "almacenamientoadd.php?documentos=" . $datos_formato[0]["documento_iddocumento"] . "&no_menu=1";
						}
				} else {
					alerta("No es posible almacenar un documento que no tenga numero de radicado");
					$ruta = RUTA_SAIA . "vacio.php";
				}
				break;
			case "transferir":
				if($datos[2] && strpos($formato[0]["banderas"], "nd") === false) {
					if($datos_formato["numcampos"] && array_key_exists("documento_iddocumento", $datos_formato[0])) {
						$ruta = RUTA_SAIA . "transferenciaadd.php?doc=" . $datos_formato[0]["documento_iddocumento"];
					}
				} else {
					alerta("No se puede realizar el proceso de transferencia");
					volver(1);
				}
				break;
			case "imprime_radicado":
				if($datos[2] && strpos($formato[0]["banderas"], "nd") === false) {
					if($datos_formato["numcampos"] && array_key_exists("documento_iddocumento", $datos_formato[0])) {
						// $ruta=RUTA_SAIA . "colilla.php?doc=".$datos_formato[0]["documento_iddocumento"]."&enlace=vacio.php&target=detalles";
						$ruta = RUTA_SAIA . "colilla.php?doc=" . $datos_formato[0]["documento_iddocumento"] . "&formato=" . $datos[0] . "&target=detalles";
					}
				} else {
					alerta("No se puede generar la Colilla");
					volver(1);
				}
				break;
			case "adicionar_comentario":
				if($datos[2] && strpos($formato[0]["banderas"], "nd") === false) {
					if($datos_formato["numcampos"] && array_key_exists("documento_iddocumento", $datos_formato[0])) {
						$ruta = RUTA_SAIA . "comentario_img.php?accion=adicionar&key=" . $datos_formato[0]["documento_iddocumento"];
					}
				} else {
					alerta("No se puede generar la Colilla");
					volver(1);
				}
				break;
			case "administrar_comentario":
				if($datos[2] && strpos($formato[0]["banderas"], "nd") === false) {
					if($datos_formato["numcampos"] && array_key_exists("documento_iddocumento", $datos_formato[0])) {
						$ruta = RUTA_SAIA . "comentario_img.php?key=" . $datos_formato[0]["documento_iddocumento"];
					}
				} else {
					alerta("No se puede generar la Colilla");
					volver(1);
				}
				break;
			case "adicionar_pagina":
				if($datos_formato[0]["documento_iddocumento"])
					$ruta = RUTA_SAIA . "paginaadd.php?key=" . $datos_formato[0]["documento_iddocumento"];
				break;
			case "seguir":
				if($datos_formato["numcampos"] && array_key_exists("documento_iddocumento", $datos_formato[0])) {
					$ruta = RUTA_SAIA . "doctransflist.php?doc=" . $datos_formato[0]["documento_iddocumento"];
				}
				break;
			case "ordenar_pagina":
				if($datos_formato["numcampos"] && array_key_exists("documento_iddocumento", $datos_formato[0])) {
					$ruta = RUTA_SAIA . "ordenar.php?accion=ordenar&key=" . $datos_formato[0]["documento_iddocumento"];
				}
				break;
			case "eliminar":
				if($formato[0]["item"]) {
					$formato2 = busca_filtro_tabla("", "formato", "idformato=" . $formato[0]["cod_padre"], "", $conn);
					$datos_formato2 = busca_filtro_tabla("", "documento A," . $formato2[0]["nombre_tabla"] . " B", "A.iddocumento=B.documento_iddocumento AND id" . $formato2[0]["nombre_tabla"] . "=" . $datos[4], "", $conn);

					$ruta = "../librerias/funciones_item.php?accion=eliminar_item&tabla=" . $formato[0]["nombre_tabla"] . "&id=" . $datos[2] . "&formato=" . $datos[0] . "&idpadre=" . $datos_formato2[0]["documento_iddocumento"];
				} elseif(!$datos_formato[0]["numero"]) {
					$doc_principal = 0;
					if(!$_REQUEST["llave"])
						$doc_principal = 1;
					if($datos[2]) {
						$ruta = RUTA_SAIA . "documento_borrar.php?iddoc=" . $datos_formato[0]["documento_iddocumento"] . "&doc_principal=$doc_principal";
					}
				} else {
					alerta("El documento no se puede eliminar porque ya se encuentra aprobado.");
					$ruta = RUTA_SAIA . "vacio.php";
				}
				/*
				 * }
				 * else
				 * $alerta="No es posible Eliminar el Documento, Error en ".$formato[0]["nombre"]."/eliminar_".$formato[0]["nombre"].".php";
				 */
				break;
			case "detalles":
				if($datos_formato["numcampos"] && array_key_exists("documento_iddocumento", $datos_formato[0])) {
					$ruta = RUTA_SAIA . "documentoview.php?key=" . $datos_formato[0]["documento_iddocumento"];
				}
				break;
			case "actualiza_arbol":
				$ruta = "test_calidad.php";
				break;
			case "imprimir":
				if($datos_formato["numcampos"] && array_key_exists("documento_iddocumento", $datos_formato[0])) {
					$ruta = RUTA_SAIA . "seleccionar_impresion.php?doc=" . $datos_formato[0]["documento_iddocumento"];
				}
				break;
			case "devolver":
				if($datos_formato["numcampos"] && array_key_exists("documento_iddocumento", $datos_formato[0])) {
					// die($datos_formato[0]["documento_iddocumento"]);
					formato_devolucion($datos_formato[0]["documento_iddocumento"]);
					exit();
				}
				break;
			case "terminar_documento":
				if($datos_formato["numcampos"] && array_key_exists("documento_iddocumento", $datos_formato[0])) {
					$ruta = '../../documentoTerminar.php?doc=' . $datos_formato[0]["documento_iddocumento"];
				}
				break;
			case "ventana_externa":
				$descargable = array(
						"instructivo",
						"formato",
						"guia",
						"manual",
						"plan_calidad",
						"otros_calidad",
						"prog_calidad"
				);
				if(in_array($formato[0]["nombre"], $descargable)) {
					if($datos_formato["numcampos"]) {

						$anexo = busca_filtro_tabla("", "anexos", "(formato=" . $formato[0]["idformato"] . " AND documento_iddocumento=" . $datos_formato[0]["iddocumento"] . ")", "", $conn);

						for($i = 0; $i < $anexo["numcampos"]; $i++) {
							$ruta = RUTA_SAIA . $anexo[$i]["ruta"];
							abrir_url($ruta, "_blank");
						}
					} else {
						alerta("Problemas al encontrar el Documento");
					}
				} else {
					if($datos_formato["numcampos"]) {
						if($datos_formato[0]["pdf"]) {
							$ruta = RUTA_SAIA . $datos_formato[0]["pdf"];
							if(is_file($ruta)) {
								abrir_url($ruta, "_blank");
							} else {
								$ruta = "/" . RUTA_SAIA . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $formato[0]["ruta_mostrar"] . "?iddoc=" . $datos_formato[0]["documento_iddocumento"] . "&idformato=" . $formato[0]["idformato"];
							}
						} else {
							$ruta = "/" . RUTA_SAIA . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $formato[0]["ruta_mostrar"] . "?iddoc=" . $datos_formato[0]["documento_iddocumento"] . "&idformato=" . $formato[0]["idformato"];
						}
						if(is_file("../../" . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $formato[0]["ruta_mostrar"]))
							abrir_url($ruta, "_blank");
						else if(is_file("../../" . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/previo_" . $formato[0]["ruta_mostrar"]))
							abrir_url("/" . RUTA_SAIA . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/previo_" . $formato[0]["ruta_mostrar"], "_blank");
					}
				}
				break;
			case 'vista':
				$vista = busca_filtro_tabla("", "vista_formato", "idvista_formato=" . $datos[4], "", $conn);
				$ruta = "/" . RUTA_SAIA . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $vista[0]["ruta_mostrar"] . "?iddoc=" . $datos_formato[0]["documento_iddocumento"] . "&idformato=" . $formato[0]["idformato"] . "&vista=" . $datos[4];
				redirecciona($ruta);
				break;
		}
		if(strpos($ruta, ".php") !== false) {
			if(strpos($ruta, "?") !== false)
				$ruta .= "&no_menu=1";
			else
				$ruta .= "?no_menu=1";
		}


	} else {
		switch($datos[0]) {
			case "pm":
				$arreglo_pm = explode("-", $_REQUEST["id"]);
				$plan_mejoramiento = busca_filtro_tabla("", "formato", "nombre_tabla='ft_plan_mejoramiento'", "", $conn);
				if($plan_mejoramiento["numcampos"]) {
					switch($arreglo_pm[1]) {
						case "f":
							$redirecciona = true;
							$ruta = "../" . $plan_mejoramiento[0]["nombre"] . "/" . $plan_mejoramiento[0]["nombre"] . "_especifico.php?tipo=2&proceso=" . $arreglo_pm[2];
							break;
						case "i":
							$redirecciona = true;
							$ruta = "../" . $plan_mejoramiento[0]["nombre"] . "/" . $plan_mejoramiento[0]["nombre"] . "_especifico.php?tipo=3&usuario=" . usuario_actual("funcionario_codigo") . "&estado=" . $arreglo_pm[2];
							break;
						default:
							$redirecciona = true;
							$ruta = "../" . $plan_mejoramiento[0]["nombre"] . "/previo_" . $plan_mejoramiento[0]["ruta_mostrar"];
							break;
					}
				}
				break;
			case "anexo":
				$anexo = busca_filtro_tabla("", "anexos", "idanexos=" . $datos[1], "", $conn);
				if($anexo["numcampos"]) {
					$ruta = PROTOCOLO_CONEXION . RUTA_PDF . "/" . $anexo[0]["ruta"];
					abrir_url($ruta, "_blank");
					echo ("Descargando");
				} else {
					echo ("Anexo No encontrado");
				}
				break;
		}
	}
	if($ruta != "" && basename($ruta) != "..")
		redirecciona($ruta);
	else {
		if($alerta != "")
			alerta($alerta);
		redirecciona(RUTA_SAIA . "vacio.php");
	}
} else
	alerta("El formato No se ha podido capturar");

	/*
 * debe retornar un arreglo con el siguiente orden:
 * [0]=>idtabla,[1]=>nombre_tabla,[2]=>campo_descripcion,[3]=>idformato,[4]=>accion,[5]=>llave
 */
function parsea_idformato($id = 0) {
	$arreglo = array();
	if($id) {
		$arreglo = explode("-", $id);
	} else if($_REQUEST["id"]) {
		$arreglo = explode("-", $_REQUEST["id"]);
	} else
		return ($arreglo);
	if($arreglo[2][0] == "r") {
		$arreglo[2] = 0;
	} else if($arreglo[1] == "vista_formato") {
		$_REQUEST["accion"] = "vista";
	}
	if(@$arreglo[3] != "notas") {
		if($_REQUEST["accion"]) {
			$arreglo[3] = $_REQUEST["accion"];
		} else
			$arreglo[3] = "mostrar";
	}
	/*
	 * if(@$_REQUEST["llave"]){
	 * array_push($arreglo,$_REQUEST["llave"]);
	 * }
	 * else
	 * array_push($arreglo,0);
	 */
	return ($arreglo);
}
?>
