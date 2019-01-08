INSERT INTO formato (nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,fecha,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo,permite_imprimir) VALUES 
('factura_electronica','RADICACI&Oacute;N FACTURA ELECTRONICA',0,1,'ft_factura_electronica','mostrar_factura_electronica.php','editar_factura_electronica.php','adicionar_factura_electronica.php',NULL,NULL,NULL,'1','<p>{*cargar_datos_rad_obras*}</p>
<table class="table table-bordered" style="width: 100%;" border="1">
<tbody>
<tr>
<td><strong>Fecha de radicaci&oacute;n:</strong></td>
<td>{*fecha_radicacion*}</td>
<td style="text-align: center;" rowspan="3" colspan="2">{*ver_qr_rad_obras*}</td>
</tr>
<tr>
<td><strong><strong>N&uacute;mero de la factura:</strong></strong></td>
<td>{*numero_factura*}</td>
</tr>
<tr>
<td><strong>Valor de la factura:</strong></td>
<td>{*mostrar_valor_factura*}</td>
</tr>
<tr>
<td style="width: 30%;"><strong>Concepto de la factura:</strong></td>
<td style="width: 25%;">{*concepto_factura*}</td>
<td style="width: 20%;"><strong>Tipo documental:</strong></td>
<td style="width: 25%;">{*ver_tipo_doc*}</td>
</tr>
<tr>
<td><strong>Vencimiento de la factura:</strong></td>
<td>{*color_vence_factura*}</td>
<td><strong>N&uacute;mero de Gu&iacute;a:</strong></td>
<td>{*numero_guia*}</td>
</tr>
<tr>
<td><strong>Empresa Transportadora:</strong></td>
<td>{*empresa_trans*}</td>
<td><strong>N&uacute;mero de folios:</strong></td>
<td>{*numero_folios*}</td>
</tr>
<tr>
<td><strong><strong>Anexos digitales:</strong></strong></td>
<td>{*anexos_digitales*}</td>
<td><strong>Anexos fisicos:</strong></td>
<td>{*anexos_fisicos*}</td>
</tr>
<tr>
<td style="vertical-align: middle;"><strong>Persona Natural/Jur&iacute;dica:</strong></td>
<td>{*persona_natural*}</td>
<td style="vertical-align: middle;"><strong>Fecha de pago:</strong></td>
<td>{*ver_fecha_pago*}</td>
</tr>
<tr>
<td style="vertical-align: middle;"><strong>Destino:</strong></td>
<td colspan="3">{*mostrar_destino_factura_electronica*}</td>
</tr>
<tr>
<td style="vertical-align: middle;"><strong>Copia electr&oacute;nica:</strong></td>
<td colspan="3">{*copia*}</td>
</tr>
</tbody>
</table>
<p>{*mostrar_listado_distribucion_documento*}</p>
<p>{*mostrar_estado_proceso*}</p>','','15,20,30,20','0','A4','tcpdf',1,'2017-08-14 08:54:57.483','0',NULL,'0',0,'0',2621,NULL,'9','e','300000',0,NULL,0,0,'1',0,'2','1',0,1)
;
