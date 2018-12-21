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
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "class_transferencia.php");
include_once ($ruta_db_superior . FORMATOS_SAIA . "/librerias/funciones_formatos_generales.php");
include_once ($ruta_db_superior . "pantallas/qr/librerias.php");

function generar_ingreso_formato($nombre_formato) {
	global $conn;
	$retorno = array("exito" => 0);

	$nombre_radicado = $nombre_formato;
	
	if ($nombre_formato == 'radicacion_salida') {
		$nombre_formato = 'radicacion_entrada';
		$entrad=0;
	}else if($nombre_formato == 'radicacion_entrada'){
		$entrad=1;
	}
	$formato = busca_filtro_tabla("f.*,cf.nombre as nombre_campo, cf.*", "formato f, campos_formato cf", "f.nombre='" . $nombre_formato . "' AND f.idformato=cf.formato_idformato AND cf.obligatoriedad=1 and cf.nombre not in ('encabezado','firma','dependencia','documento_iddocumento','serie_idserie','idft_" . $nombre_formato . "') and cf.etiqueta_html not in ('etiqueta','archivo')", "", $conn);
	if ($formato["numcampos"]) {
		$contador_exc=array("radicacion_entrada","radicacion_salida");
		if(!in_array($nombre_formato, $contador_exc)){
			$contador=busca_filtro_tabla("nombre","contador","idcontador=".$formato[0]["contador_idcontador"],"",$conn);
			if($contador["numcampos"]){
				$nombre_radicado=$contador[0]["nombre"];
			}else{
				$retorno['msn'] = "Error al consultar el tipo de radicado";
				return $retorno;
			}
		}
		$dependencia = busca_filtro_tabla("funcionario_codigo,iddependencia_cargo,login", "vfuncionario_dc", "idfuncionario=" . usuario_actual("idfuncionario") . " AND estado_dc=1", "", $conn);
		if ($dependencia["numcampos"]) {
			for ($i = 0; $i < $formato["numcampos"]; $i++) {
				if (strtolower($formato[$i]["tipo_dato"]) == 'date') {
					$_REQUEST[$formato[$i]["nombre_campo"]] = date('Y-m-d');
				} else if (strtolower($formato[$i]["tipo_dato"]) == 'datetime') {
					$_REQUEST[$formato[$i]["nombre_campo"]] = date('Y-m-d H:i:s');
				} else if (strtolower($formato[$i]["tipo_dato"]) == 'varchar' || strtolower($formato[$i]["tipo_dato"]) == 'text') {
					$_REQUEST[$formato[$i]["nombre_campo"]] = '-';
				} else {
					$_REQUEST[$formato[$i]["nombre_campo"]] = 0;
				}
			}
			if($nombre_formato=="radicacion_entrada"){
				if($entrad==1){
					$_REQUEST["tipo_origen"]=1;
				}else{
					$_REQUEST["tipo_origen"]=2;
				}
			}
			
			$campos = array();
			$campos_formato = busca_filtro_tabla("idcampos_formato", "formato f, campos_formato cf", "f.nombre='" . $nombre_formato . "' AND f.idformato=cf.formato_idformato AND (acciones like 'p' or acciones like '%,p' or acciones like 'p,%' or acciones like '%,p,%')", "", $conn);
			if ($campos_formato["numcampos"]) {
				$campos = extrae_campo($campos_formato, "idcampos_formato");
			}
			$_REQUEST["encabezado"] = 1;
			$_REQUEST["firma"] = 1;
			$_REQUEST["funcion"] = "radicar_plantilla";

			$_REQUEST["dependencia"] = $dependencia[0]["iddependencia_cargo"];
			$_REQUEST["campo_descripcion"] = implode(",", $campos);
			$_REQUEST["tipo_radicado"] = $nombre_radicado;
			$_REQUEST["tabla"] = $formato[0]["nombre_tabla"];
			$_REQUEST["formato"] = $nombre_formato;
			$_REQUEST["idformato"] = $formato[0]["idformato"];
			$_REQUEST["ejecutor"] = $dependencia[0]["funcionario_codigo"];
			$_REQUEST["serie_idserie"] = $formato[0]["serie_idserie"];
			$_REQUEST["fecha_almacenar"] = date('Y-m-d');			
			$_REQUEST["descripcion"] = ($_REQUEST["descripcion_general"]);

			$_POST = $_REQUEST;
			$_REQUEST["no_redirecciona"] = 1;
			$_REQUEST["radicacion_rapida"] = 1;

			$iddoc = radicar_plantilla();
			if ($iddoc == 0 || $iddoc == "" || !$iddoc) {
				$retorno["iddoc"] = false;
				$retorno['msn'] = "Error al Guardar la informacion (iddoc)";
			} else {
				$documento = busca_filtro_tabla("A.*,B.numero", $formato[0]["nombre_tabla"] . " A,documento B", "A.documento_iddocumento=B.iddocumento AND A.documento_iddocumento=" . $iddoc, "", $conn);
				if ($documento["numcampos"]) {
					$retorno['exito'] = 1;
				} else {
					$retorno['msn'] = "Error al Guardar la informacion (ft)";
				}
			}
		} else {
			$retorno['msn'] = "Actualmente NO tiene roles activos, NO se permite radicar";
		}
	} else {
		$retorno['msn'] = "No se encuentra el Formato a radicar, por favor contacte con el administrador";
	}

	$retorno["iddoc"] = $iddoc;
	return $retorno;
}

function validar_confirmacion_salida($consecutivo, $enlace, $enlace2) {
	global $conn;
	$enlace_redireccion = $enlace;
	$enlace = str_replace("|", "&", $enlace);
	?>
	<script>
		//var ingreso=confirm("Esta seguro de generar un nuevo radicado?");
		ingreso=1;
		if(ingreso){
			window.open("colilla.php?consecutivo=<?php echo $consecutivo;?>&salidas=1&target=_self&enlace=<?php echo $enlace_redireccion;?>&descripcion_general=<?php echo $_REQUEST['descripcion_general'];?>","_self"); 
		}else{
			window.open("<?php echo $enlace2;?>","_self");
		}
	</script>
	<?php
	die();
}

function validar_confirmacion() {
	global $conn;
	$cantidad = busca_filtro_tabla("", "configuracion a", "a.nombre='cantidad_confirmacion'", "", $conn);
	$por_ingresar = busca_filtro_tabla("count(*) as cant", "documento a", "lower(a.estado)='iniciado' AND a.tipo_radicado=1", "", $conn);

	if (($por_ingresar[0]["cant"] + 1) > $cantidad[0]["valor"]) {
		$datos_url = array();
		foreach ($_REQUEST as $clave => $valor) {
			if ($clave != 'validar')
				$datos_url[] = $clave . "=" . $valor;
		}
		$cadena = implode("&", $datos_url);
		?>
		<script>
			var ingreso=confirm("Esta seguro de generar un nuevo radicado?");
			if(ingreso){
				window.open("colilla.php?<?php echo $cadena; ?>&target=_self&descripcion_general=<?php echo $_REQUEST['descripcion_general'];?>","_self");
			}else{
				window.open("<?php echo $enlace;?>","_self");
			}
		</script>
		<?php
		die();
	} else {
		return;
	}
}
if (@$_REQUEST["validar"])
	validar_confirmacion();
clearstatcache();
$no_cache = md5(time());
$doc = FALSE;
if (@$_REQUEST["doc"] || @$_REQUEST["key"]) {
	$doc = @$_REQUEST["key"];
	if (@$_REQUEST["doc"]) {
		$doc = $_REQUEST["doc"];
	}
} else {
	if (@$_REQUEST["generar_consecutivo"]) {
		validar_confirmacion_salida($_REQUEST["generar_consecutivo"], $_REQUEST["enlace"], $_REQUEST["enlace2"]);
	} else if (@$_REQUEST["consecutivo"] && @$_REQUEST["salidas"]) {
		$formato = $_REQUEST["consecutivo"];
	} else {
		$formato = 'radicacion_entrada';
	}
	$info_retorno=generar_ingreso_formato($formato);
	if($info_retorno["exito"]==1){
		$doc =$info_retorno["iddoc"]; 
	}else{
		alerta($info_retorno["msn"]);
		volver();
		die();
	}
}
$plantilla = busca_filtro_tabla("", "documento a, formato b", "lower(plantilla)=b.nombre AND iddocumento=" . $doc, "", $conn);
$datos = busca_filtro_tabla("dependencia,numero,tipo_radicado," . fecha_db_obtener("A.fecha", 'Y-m-d H:i') . " AS fecha_oracle,A.descripcion,lower(plantilla) AS plantilla,ejecutor,paginas,A.iddocumento,A.estado", "documento A, " . $plantilla[0]["nombre_tabla"] . " B", "A.iddocumento=$doc AND A.iddocumento=B.documento_iddocumento", "", $conn);
$dependencia_creador=busca_filtro_tabla("b.codigo,a.nombres,a.apellidos","vfuncionario_dc a, dependencia b","b.iddependencia=a.iddependencia AND a.iddependencia_cargo=".$datos[0]['dependencia'],"",$conn);

$ejecutor["numcampos"] = '';
$atras = "1";
if (@$_REQUEST["enlace"]) {
	$_REQUEST["enlace"] = str_replace("|", "&", $_REQUEST["enlace"]);
	if (strpos($_REQUEST["enlace"], '?') > 0) {
		$enlace = $_REQUEST["enlace"] . "&key=" . $doc;
	} else {
		$enlace = $_REQUEST["enlace"] . "?key=" . $doc;
	}
} else {
	if ($datos[0]["plantilla"]) {
		$plantilla = busca_filtro_tabla("B.*", "documento A,formato B", "'" . strtolower($datos[0]["plantilla"]) . "'=lower(B.nombre) AND A.iddocumento=" . $doc . " AND lower(A.plantilla)=lower(B.nombre)", "", $conn);
		$enlace = $ruta_db_superior . FORMATOS_CLIENTE . $plantilla[0]["nombre"] . "/mostrar_" . $plantilla[0]["nombre"] . ".php?iddoc=$doc&idformato=" . $plantilla[0]["idformato"];
	} else if (isset($_REQUEST["pagina"])) {
		$atras = 2;
	} else {
		$atras = 1;
	}
}

if (@$_REQUEST["enlace2"] != '') {
	$enlace .= '&enlace2=' . $_REQUEST["enlace2"];
}
if ($_REQUEST["defecto"]) {
	$enlace .= "&defecto=" . $_REQUEST["defecto"];
}
if ($_REQUEST["mostrar_formato"]) {
	$enlace .= "&mostrar_formato=" . $_REQUEST["mostrar_formato"];
}
if ($doc <> FALSE) {
	$ejecutor = busca_filtro_tabla("nombre AS nombre, empresa", "ejecutor A,datos_ejecutor B", "A.idejecutor=B.ejecutor_idejecutor AND iddatos_ejecutor=" . $datos[0]["ejecutor"], "", $conn);
	$radicador1 = busca_filtro_tabla("nombres,apellidos", "digitalizacion,funcionario", "funcionario=funcionario_codigo and documento_iddocumento=$doc", "", $conn);
	$radicador = busca_filtro_tabla("destino,D.nombre,B.nombres, B.apellidos", "buzon_salida A,funcionario B,dependencia_cargo C,dependencia D", "A.destino=B.funcionario_codigo AND B.idfuncionario=C.funcionario_idfuncionario AND C.dependencia_iddependencia=D.iddependencia AND A.archivo_idarchivo=$doc AND A.nombre='TRANSFERIDO'", "A.idtransferencia ASC", $conn);
	$responsable = busca_filtro_tabla("B.nombres,B.apellidos", "documento A,funcionario B", "A.ejecutor=B.funcionario_codigo AND iddocumento=" . $doc, "", $conn);

	if ($radicador["numcampos"]) {
		$usu = $radicador[0]["nombre"];
	} else {
		if (strtolower($datos[0]["plantilla"]) == 'radicacion_entrada') {
			$destino_radicacion = busca_filtro_tabla("b.funcionario_codigo", "ft_radicacion_entrada a, vfuncionario_dc b", "a.destino=b.iddependencia_cargo AND a.documento_iddocumento=" . $doc, "", $conn);
			$fun_destino = busca_filtro_tabla("nombres,apellidos", "funcionario", "funcionario_codigo=" . $destino_radicacion[0]['funcionario_codigo'], "", $conn);

			if ($fun_destino['numcampos']) {
				$usu = $nombre_fun_destino = ucwords(strtolower(codifica_encabezado(html_entity_decode($fun_destino[0]["nombres"] . " " . $fun_destino[0]["apellidos"]))));
			} else {
				$usu = "RADICACION";
			}
		} else {
			$usu = "RADICACION";
		}
	}

	if ($datos[0]["tipo_radicado"] == 1) {
		$numero_folios = busca_filtro_tabla("", "ft_radicacion_entrada", "documento_iddocumento=" . $doc, "", $conn);
		$tipo_radicacion = 'E';
		if ($ejecutor["numcampos"])
			$origen = ucwords(strtolower($responsable[0]["nombres"] . " " . $responsable[0]["apellidos"]));
		else
			$origen = ucwords(strtolower($responsable[0]["nombres"] . " " . $responsable[0]["apellidos"]));
		$destino = $usu;

	} else if ($datos[0]["tipo_radicado"] == 2) {
		$numero_folios = busca_filtro_tabla("", "ft_radicacion_entrada", "documento_iddocumento=" . $doc, "", $conn);
		$tipo_radicacion = 'I';
		$origen = ucwords(strtolower($responsable[0]["nombres"] . " " . $responsable[0]["apellidos"]));
		$destino = $ejecutor[0]["nombre"];
	} else {
		$origen = ucwords(strtolower($responsable[0]["nombres"] . " " . $responsable[0]["apellidos"]));
		$destino = $radicador[0]["nombres"] . " " . $radicador[0]["apellidos"];
	}


  $distribuciones=busca_filtro_tabla("tipo_origen,origen,tipo_destino,destino","distribucion","documento_iddocumento=".$doc,"",$conn);
  if($distribuciones['numcampos']){
  	include_once($ruta_db_superior.'distribucion/funciones_distribucion.php');				

	$origen=retornar_origen_destino_distribucion($distribuciones[0]['tipo_origen'],$distribuciones[0]['origen']);
	$destino=retornar_origen_destino_distribucion($distribuciones[0]['tipo_destino'],$distribuciones[0]['destino']);

  } //fin if $distribuciones['numcampos']


	$anexos = busca_filtro_tabla("count(*) AS cantidad", "anexos", "documento_iddocumento=" . $doc, "", $conn);
	$paginas = busca_filtro_tabla("count(*) AS paginas", "pagina", "id_documento=" . $doc, "", $conn);
	$configuracion = busca_filtro_tabla("*", "configuracion A", "A.tipo='impresion'", "", $conn);
	$imprime = 0;
	for ($i = 0; $i < $configuracion["numcampos"]; $i++) {
		if ($configuracion[$i]["nombre"] == "colilla")
			$imprime = $configuracion[$i]["valor"];
	}
	$web_empresa = "";
	$nombre_empresa = "EMPRESA";
	$logo_empresa = "";
	$datos_fecha = $datos[0]['fecha_oracle'];
	$info_fec=explode(" ",$datos_fecha);
	$fecha=date_parse($info_fec[0]);
	$datos_numero = $datos[0]['numero'];
	$datos_asunto = $datos[0]['descripcion'];
	$codigo_empresa = '';
	if ($datos["numcampos"] && $imprime) {
		$tipo_r = busca_filtro_tabla("idcontador,etiqueta_contador", "contador", "idcontador=" . $datos[0]["tipo_radicado"], "", $conn);
		$empresa = busca_filtro_tabla("A.nombre, A.valor", "configuracion A", "A.tipo='empresa'", "A.nombre", $conn);

		for ($i = 0; $i < $empresa["numcampos"]; $i++) {
			switch($empresa[$i]["nombre"]) {
				case "nombre" :
					$nombre_empresa = $empresa[$i]["valor"];
					break;
				case "logo" :
					$logo_empresa = $empresa[$i]["valor"];
					break;
				case "logo_colilla" :
					$logo_colilla=$empresa[$i]["valor"];
					break;
				case "web" :
					$web_empresa = $empresa[$i]["valor"];
					break;
				case "codigo_empresa" :
					$codigo_empresa = $empresa[$i]["valor"];
					break;
				default :
					break;
			}
		}
		if (@$_REQUEST["target"]) {
			$target = $_REQUEST["target"];
		} else {
			$target = "centro";
		}
		
		$qr="";
        $tamano_qr=70;
		if($_REQUEST['colilla_vertical']==1){
		    $tamano_qr=30;
        }
		if($datos[0]["numero"]){
			$qr=mostrar_codigo_qr(0, $doc, 1, 40, 40);
		}
		
		$validar_impresion = busca_filtro_tabla("valor", "configuracion", "lower(nombre) LIKE'imprimir_colilla_automatico'", "", $conn);
		if ($validar_impresion[0]['valor'] == 1) {
			$imprimir_colilla = 'onLoad="imprime(' . $atras . ')"';
		} else {
			abrir_url($enlace, '_self');
		}
?>
<html>
	<head>
		<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.9.1.custom.min.css" />
		<script src="js/jquery-1.8.2.js"></script>    
		<script src="js/jquery-ui-1.8rc3.custom.min.js"></script> 
		
		<style type="text/css">
			td {
				font-family: VERDANA;
				font-size: 6px;
				height: 0px;
				border: 0px solid;
				vertical-align: top;
				padding-left: 1px;
			}
            .colilla-vertical {
                writing-mode: vertical-lr;
            }



		</style>
		<script language="javascript">
			function comando_documento(sComando) {
				if (!document.execCommand) {
					alert("Función no disponible en su explorador");
					return false;
				}
				document.execCommand(sComando);
			}
			function imprime(atras) {
				window.focus();
				var url = "<?php echo $enlace; ?>"; 
				window.print();
				if (url != "") {
					window.open("<?php echo $enlace; ?>","<?php echo $target; ?>","scrollbars=no");
				} else {
					window.history.go(-atras);
				}
			}
		</script>
	</head>
    <?php
        if($_REQUEST['colilla_vertical']==1) {
            ?>
            ?>
            <body <?php echo(@$imprimir_colilla); ?> ><br/>
            <div class="colilla-vertical">
                <table align="right" border="0px" cellspacing="0" cellpadding="2"
                       style="border-collapse:collapse; margin-right: 5px;">
                    <tr>
                        <td><?php echo($qr); ?></td>

                        <!--?php echo ($logo_colilla!="") ? '<img src="'.$logo_colilla.'" style="width:140;height:20;"><br/><br/>' : '' ; ?-->
                        <td>
                            <?php
                            if (@$datos[0]['estado'] == 'INICIADO' && strtolower($datos[0]["plantilla"]) == 'radicacion_entrada') {
                                $origen = ucwords(strtolower($dependencia_creador[0]["nombres"] . " " . $dependencia_creador[0]["apellidos"]));
                                $datos_radicacion_entrada = busca_filtro_tabla("tipo_origen", "ft_radicacion_entrada", "documento_iddocumento=" . $doc, "", $conn);
                                if ($datos_radicacion_entrada[0]['tipo_origen'] == 1 || @$_REQUEST['radicado_rapido'] == 'radicacion_entrada') {
                                    ?>
                                    <b>Recibido Por: <?php echo($origen); ?></b><br/>
                                    <?php
                                } else {
                                    ?>
                                    <b>Origen: <?php echo($origen); ?></b><br/>
                                    <?php
                                }
                            } else {
                                if (strtolower($datos[0]["plantilla"]) == 'radicacion_entrada') {
                                    $datos_radicacion_entrada = busca_filtro_tabla("tipo_origen", "ft_radicacion_entrada", "documento_iddocumento=" . $doc, "", $conn);
                                    if ($datos_radicacion_entrada[0]['tipo_origen'] == 1) {
                                        $origen = ucwords(strtolower($dependencia_creador[0]["nombres"] . " " . $dependencia_creador[0]["apellidos"]));
                                        ?>
                                        <b>Recibido Por: <?php echo($origen); ?></b><br/>
                                        <?php
                                    } else {
                                        ?>
                                        <b>Origen: <?php echo($origen); ?></b><br/>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <b>Origen: <?php echo($origen); ?></b><br/>
                                    <?php
                                }
                            }
                            ?>
                            <?php if ((($datos[0]["tipo_radicado"] == 1 || $datos[0]["tipo_radicado"] == 2) && $datos[0]['plantilla'] == 'radicacion_entrada') || $datos[0]['plantilla'] == 'pqrsf') { ?>
                                <b><?php
                                    if (@$_REQUEST['descripcion_general']) {
                                        $suspensivos = '';
                                        $cadena = codifica_encabezado(html_entity_decode(@$_REQUEST["descripcion_general"]));
                                        if (strlen($cadena) > 30) {
                                            $suspensivos = '...';
                                        }
                                        echo "Asunto: " . substr($cadena, 0, 30) . $suspensivos;
                                    } else {
                                        $suspensivos = '';
                                        $cadena = codifica_encabezado(html_entity_decode(@$datos[0]["descripcion"]));
                                        if (strlen($cadena) > 30) {
                                            $suspensivos = '...';
                                        }
                                        echo substr($cadena, 0, 60) . $suspensivos;
                                    } ?></b><br/>
                            <?php } ?>
                            <b>Fecha: <?php echo $datos_fecha; ?></b><br/>
                            <?php if ($datos[0]["tipo_radicado"] == 1 || $datos[0]["tipo_radicado"] == 2 && $datos[0]['plantilla'] != 'pqrsf') { ?>
                                <b><span style="font-size: 7px">Rad: <?php echo($info_fec[0] . "-" . $datos[0]["numero"] . "-" . $tipo_radicacion); ?></span></b>
                            <?php } else { ?>
                                <b><span style="font-size: 7px">Rad: <?php echo($dependencia_creador[0]['codigo'] . "-" . $datos[0]["numero"] . "-" . $fecha["year"]); ?></span></b>
                            <?php } ?><br/>
                            <strong><?php echo($nombre_empresa); ?></strong>
                        </td>
                        <td>
                            <strong><span>El radicado no implica su aceptaci&oacute;n</b></span></strong><br>
                            <?php
                            if (@$datos[0]['estado'] != 'INICIADO' && strtolower($datos[0]["plantilla"]) != 'radicacion_entrada') {
                                ?>
                                <b>Destino: <?php echo substr(codifica_encabezado(html_entity_decode($destino)), 0, 22) . "..."; ?></b>
                                <?php
                            }
                            ?>


                        <td>
                    </tr>
                </table>
            </div>
            </body>
            <?php
        }else{
        ?>
    <body <?php echo(@$imprimir_colilla); ?>><br/>
    <table align="right" border="0px" cellspacing="0" cellpadding="0"
           style="border-collapse:collapse; margin-right: 5px;">
        <tr>
            <td><?php echo($qr); ?></td>
            <td><strong><?php echo($nombre_empresa); ?></strong><br/><br/>
                <!--?php echo ($logo_colilla!="") ? '<img src="'.$logo_colilla.'" style="width:140;height:20;"><br/><br/>' : '' ; ?-->
                <?php if ($datos[0]["tipo_radicado"] == 1 || $datos[0]["tipo_radicado"] == 2 && $datos[0]['plantilla'] != 'pqrsf') { ?>
                    <b><span style="font-size: 7px">Rad: <?php echo($info_fec[0] . "-" . $datos[0]["numero"] . "-" . $tipo_radicacion); ?></span></b>
                <?php } else { ?>
                    <b><span style="font-size: 7px">Rad: <?php echo($dependencia_creador[0]['codigo'] . "-" . $datos[0]["numero"] . "-" . $fecha["year"]); ?></span></b>
                <?php } ?><br/>
                <b>Fecha: <?php echo $datos_fecha; ?></b><br/>

                <?php if ((($datos[0]["tipo_radicado"] == 1 || $datos[0]["tipo_radicado"] == 2) && $datos[0]['plantilla'] == 'radicacion_entrada') || $datos[0]['plantilla'] == 'pqrsf') { ?>
                    <b><?php
                        if (@$_REQUEST['descripcion_general']) {
                            $suspensivos = '';
                            $cadena = codifica_encabezado(html_entity_decode(@$_REQUEST["descripcion_general"]));
                            if (strlen($cadena) > 30) {
                                $suspensivos = '...';
                            }
                            echo "Asunto: " . substr($cadena, 0, 30) . $suspensivos;
                        } else {
                            $suspensivos = '';
                            $cadena = codifica_encabezado(html_entity_decode(@$datos[0]["descripcion"]));
                            if (strlen($cadena) > 30) {
                                $suspensivos = '...';
                            }
                            echo substr($cadena, 0, 60) . $suspensivos;
                        } ?></b><br/>
                <?php }

                if (@$datos[0]['estado'] == 'INICIADO' && strtolower($datos[0]["plantilla"]) == 'radicacion_entrada') {
                    $origen = ucwords(strtolower($dependencia_creador[0]["nombres"] . " " . $dependencia_creador[0]["apellidos"]));
                    $datos_radicacion_entrada = busca_filtro_tabla("tipo_origen", "ft_radicacion_entrada", "documento_iddocumento=" . $doc, "", $conn);
                    if ($datos_radicacion_entrada[0]['tipo_origen'] == 1 || @$_REQUEST['radicado_rapido'] == 'radicacion_entrada') {
                        ?>
                        <b>Recibido Por: <?php echo($origen); ?></b><br/>
                        <?php
                    } else {
                        ?>
                        <b>Origen: <?php echo($origen); ?></b><br/>
                        <?php
                    }
                } else {
                    if (strtolower($datos[0]["plantilla"]) == 'radicacion_entrada') {
                        $datos_radicacion_entrada = busca_filtro_tabla("tipo_origen", "ft_radicacion_entrada", "documento_iddocumento=" . $doc, "", $conn);
                        if ($datos_radicacion_entrada[0]['tipo_origen'] == 1) {
                            $origen = ucwords(strtolower($dependencia_creador[0]["nombres"] . " " . $dependencia_creador[0]["apellidos"]));
                            ?>
                            <b>Recibido Por: <?php echo($origen); ?></b><br/>
                            <?php
                        } else {
                            ?>
                            <b>Origen: <?php echo($origen); ?></b><br/>
                            <?php
                        }
                    } else {
                        ?>
                        <b>Origen: <?php echo($origen); ?></b><br/>
                        <?php
                    }
                }
                if (@$datos[0]['estado'] != 'INICIADO' && strtolower($datos[0]["plantilla"]) != 'radicacion_entrada') {
                    ?>
                    <b>Destino: <?php echo substr(codifica_encabezado(html_entity_decode($destino)), 0, 22) . "..."; ?></b>
                    <?php
                }
                ?>
            </td>
        </tr>

        <tr>
            <td colspan="2"><br/>
                <center><b><span style="font-size: 8px">El radicado no implica su aceptaci&oacute;n</b></span></center>
            </td>
        </tr>
    </table>
        </body><?php
    }
        ?>
</html>
<?php
	}
}
?>
