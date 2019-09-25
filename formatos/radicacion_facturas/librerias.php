<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once($ruta_db_superior . "db.php");
include_once($ruta_db_superior . "pantallas/lib/librerias_fechas.php");

function numero_facturas($iddoc, $numero)
{


	if ($_REQUEST['info_externo']) {
		$enlace = $numero;
	} else {
		$enlace = "<div class='link kenlace_saia' enlace='ordenar.php?key=" . $iddoc . "&amp;amp;mostrar_formato=1' conector='iframe' titulo='Documento N " . $numero . "'><span class='badge'>" . $numero . "</span></div>";
	}

	return ($enlace);
}

function remitente($remitente)
{


	$remi = busca_filtro_tabla("a.nombre", "ejecutor a,datos_ejecutor b", "a.idejecutor=b.ejecutor_idejecutor and b.iddatos_ejecutor=" . $remitente, "");
	return ($remi[0]['nombre']);
}
function clasificacion($clasificacion)
{

	switch ($clasificacion) {
		case '1':
			$dato = 'Orden de Compra';
			break;
		case '2':
			$dato = 'Contrato';
			break;
		case '3':
			$dato = 'Servicios públicos - Administración';
			break;
		case '4':
			$dato = 'Cuenta de cobro';
			break;
	}
	return ($dato);
}
function estado($estado, $idft)
{

	$item_accion = busca_filtro_tabla("accion", "ft_item_aprobaciones", "ft_radicacion_facturas=" . $idft, "idft_item_aprobaciones desc");

	if ($item_accion['numcampos']) {
		switch ($item_accion[0]['accion']) {
			case 'contabilidad':
				$dato = 'Para aprobacion de contabilidad';
				$estado = 1;
				break;

			case 'presupuesto':
				$dato = 'Para aprobacion de presupuesto';
				$estado = 1;
				break;

			case 'tesoreria':
				$dato = 'Para aprobacion de tesoreria';
				$estado = 1;
				break;

			case 'juridica':
				$dato = 'Para aprobación de jurídica';
				$estado = 1;
				break;

			case 'devolucion_it':
				$dato = 'Devolucion';
				$estado = 2;
				break;

			case 'anulada':
				$dato = 'Anulada';
				$estado = 4;
				break;

			case 'pagada':
				$dato = 'Pagada';
				$estado = 5;
				break;
			default:
				$dato = "En proceso";
				$estado = 1;
				break;
		}
	} else {
		if ($estado == 1) {
			$dato = "Recibida";
		} else if ($estado == 3) {
			$dato = "En proceso";
		}
	}

	$cadena = '';
	if ($estado == 2 || $estado == 4) {
		$cadena .= "<button class='btn btn-danger btn-mini'>" . $dato . "</button>";
	} else if ($estado == 5) {
		$cadena .= "<button class='btn btn-success btn-mini'>" . $dato . "</button>";
	} else {
		$cadena .= "<button class='btn btn-warning btn-mini'>" . $dato . "</button>";
	}
	return ($cadena);
}
function fecha_programa($fecha, $idft)
{
	$cadena = "";

	$padre = busca_filtro_tabla("estado", "ft_radicacion_facturas", "idft_radicacion_facturas=" . $idft, "");
	if ($padre[0]['estado'] == 4 || $padre[0]['estado'] == 5) {
		$item = busca_filtro_tabla("fecha_aprobacion", "ft_item_aprobaciones", "ft_radicacion_facturas=" . $idft, "idft_item_aprobaciones desc");
		$fecha = $item[0]['fecha_aprobacion'];
		if ($padre[0]['estado'] == 4) {
			$cadena .= "<button class='btn btn-danger btn-mini'>" . $item[0]['fecha_aprobacion'] . '</button>';
		} else {
			$cadena .= "<button class='btn btn-success btn-mini'>" . $item[0]['fecha_aprobacion'] . '</button>';
		}
	} else {
		$hoy = date('Y-m-d');
		$dias	= (strtotime($fecha) - strtotime($hoy)) / 86400;
		$dias = floor($dias);

		if ($fecha != 'fecha_programada') {
			if ($dias <= 2) {
				$cadena .= "<button class='btn btn-danger btn-mini'>" . $fecha . '</button>';
			} else if ($dias <= 5) {
				$cadena .= "<button class='btn btn-warning btn-mini'>" . $fecha . '</button>';
			} else {
				$cadena .= "<button class='btn btn-success btn-mini'>" . $fecha . '</button>';
			}
		} else {
			$cadena .= "<button class='btn btn-info btn-mini'>Sin fecha asignada</button>";
		}
	}
	return "<div id='capa_fecha_fin_planeado" . $fecha . "'>" . $cadena . "</div>";
}
function val_factura($valor)
{

	$funcionario = busca_filtro_tabla("", "vfuncionario_dc", "(cargo like 'Aprobador Contabilidad' or cargo like 'Aprobador Tesoreria' or cargo like 'Aprobador Juridica' or cargo like 'Aprobador Presupuesto' or cargo like 'Clasificador factura' or login like 'mavega') and estado=1 and estado_dc=1 and funcionario_codigo=" . SessionController::getValue('usuario_actual'), "");
	if ($funcionario['numcampos'] && is_numeric($valor)) {
		return ("$" . number_format($valor));
	}
}
function check_factura($iddoc, $idft)
{

	$item_accion = busca_filtro_tabla("accion", "ft_item_aprobaciones", "ft_radicacion_facturas=" . $idft, "idft_item_aprobaciones desc");
	$cargo_tesoreria = busca_filtro_tabla("funcionario_codigo", "vfuncionario_dc", "estado=1 and estado_dc=1 and cargo like 'Aprobador Tesoreria' and funcionario_codigo=" . SessionController::getValue('usuario_actual'), "");

	if ($item_accion[0]['accion'] == 'tesoreria' && $cargo_tesoreria['numcampos']) {
		return ("<input type='checkbox' name='iddoc_fact' class='iddoc_fact' id='iddoc_fact' value='" . $iddoc . "'>");
	}
}
function pago_realizado($tipo)
{
	if ($tipo == 1) {
		$dato = 'Gasto Cámara';
	} else if ($tipo == 2) {
		$dato = 'Convenio';
	}
	return ($dato);
}
function contador_recibidas()
{

	$dat = indicador_cont(' and a.estado=1');
	return ($dat);
}
function contador_pagadas()
{

	$dat = indicador_cont(' and a.estado=5');
	return ($dat);
}
function contador_anuladas()
{

	$dat = indicador_cont(' and a.estado=4');
	return ($dat);
}
function contador_proceso()
{

	$dat = indicador_cont(' and a.estado=3');
	return ($dat);
}
function contador_devueltas()
{

	$dat = indicador_cont(' and a.estado=2');
	return ($dat);
}
function indicador_cont($where)
{
	if ($where) {
		$datos = busca_filtro_tabla("count(a.estado) as cont", "ft_radicacion_facturas a,documento b", "a.documento_iddocumento=b.iddocumento and b.estado not in ('ELIMINADO','ANULADO','ACTIVO')" . $where, "");
		$html = '<div style="text-align:center; font-family:Georgia;">';
		$html .= '<span style="line-height: 100px;font-size:60px; font-weight:bold;">' . $datos[0]['cont'] . '</span>';
		$html .= "</div>";
		return ($html);
	}
}
