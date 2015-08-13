INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada) VALUES('orden_pago_factura','Orden de Pago','0','122','ft_orden_pago_factura','mostrar_orden_pago_factura.php','editar_orden_pago_factura.php','adicionar_orden_pago_factura.php','','','','','<p>{*cargar_datos*}</p>
<table style="width: 100%; font-size: 8pt; font-family: arial;" border="0">
<tbody>
<tr>
<td style="width: 20%;"><strong>Fecha Solicitud:</strong></td>
<td style="width: 30%;">{*ver_fecha_solicitud*}</td>
<td style="width: 20%;"><strong>Area Solicitante:</strong></td>
<td style="width: 30%;">{*ver_dependencia_creador*}</td>
</tr>
<tr>
<td><strong>Detalle Factura:</strong></td>
<td colspan="3">{*ver_papa_detalle_factura*}</td>
</tr>
<tr>
<td><strong>Proyecto y/o Programa:</strong></td>
<td colspan="3">&nbsp;</td>
</tr>
<tr>
<td colspan="4">&nbsp;</td>
</tr>
<tr>
<td colspan="4">
<table style="width: 100%; font-size: 8pt; font-family: arial;" border="0">
<tbody>
<tr>
<td style="width: 25%;"><strong>Fecha Factura</strong></td>
<td style="width: 75%;">&nbsp;{*ver_papa_fecha_factura*}</td>
</tr>
<tr>
<td><strong>Nro Factura</strong></td>
<td>&nbsp;{*ver_papa_nro_factura*}</td>
</tr>
<tr>
<td><strong>Valor Factura</strong></td>
<td>&nbsp;{*ver_papa_valor_factura*}</td>
</tr>
<tr>
<td><strong>Nombre del Proveedor</strong>&nbsp;</td>
<td>&nbsp;{*ver_papa_proveedor*}</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td colspan="4">&nbsp;</td>
</tr>
<tr>
<td colspan="4"><span style="text-decoration: underline;">NOTA:</span><br />
<ul>
<li type="disc">Gesti&oacute;n administrativa al realizar la segunda revisi&oacute;n, deber&aacute; devolver al (a la ) supervisor(a) o solicitante los documentos que NO cumplan con el lleno de los requisitos establecidos.</li>
<li type="disc">&Uacute;nicamente se podr&iacute;a radicar en Gesti&oacute;n Financiera los documentos que contengan las dos firmas de revisi&oacute;n con el lleno de los requisitos, de lo contrario ser&aacute;n devueltos al (a la) supervisor(a) o solicitante.</li>
<li type="disc">Se except&uacute;an aquellos documentos autorizados por la tercera firma sin el lleno de los requisitos exigidos.</li>
</ul>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;{*mostrar_estado_proceso*}</p>','','15,20,30,20','0','Letter','pdf','1','0','','1','0','0','1028','','12','m','300000','0','','0','0','2','0','')||
