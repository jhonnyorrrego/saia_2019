INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada) VALUES('radicacion_facturas','Radicaci&oacute;n de Facturas','0','121','ft_radicacion_facturas','mostrar_radicacion_facturas.php','editar_radicacion_facturas.php','adicionar_radicacion_facturas.php','','','','','<table style="width: 100%; border-collapse: collapse; font-size: 10pt;" border="1">
<tbody>
<tr>
<td><strong>Tipo de documento:</strong></td>
<td>{*tipo_documento*}</td>
<td><strong>Codigo Organizacion:</strong></td>
<td>{*mostrar_codigo_organizacion*}</td>
</tr>
<tr>
<td><strong>Fecha de Expedicion:</strong></td>
<td>{*fecha_expedicion*}</td>
<td><strong>Fecha de Vencimiento:</strong></td>
<td>{*fecha_vencimiento*}</td>
</tr>
<tr>
<td><strong>Proveedor:</strong></td>
<td>{*proveedor*}&nbsp;&nbsp;</td>
<td><strong>Detalle Factura:</strong></td>
<td>{*detalle_factura*}</td>
</tr>
<tr>
<td><strong>Numero Factura:</strong></td>
<td>{*numero_factura*}</td>
<td><strong>Valor Factura:</strong></td>
<td>{*ver_valor_factura*}</td>
</tr>
<tr>
<td><strong>Responsable OP:</strong></td>
<td>{*ver_responsable_op*}</td>
<td><strong>Guia:</strong></td>
<td>{*guia*}</td>
</tr>
<tr>
<td><strong>Empresa Guia:</strong></td>
<td>{*empresa_guia*}</td>
<td><strong>Anexos:</strong></td>
<td>{*ver_adjuntar*}</td>
</tr>
</tbody>
</table>
<p>{*mostrar_imagenes_factura*}</p>
<p>{*mostrar_estado_proceso*}</p>
<p>&nbsp;</p>
<p>{*ordenes_compra_vinculadas*}</p>','','15,20,30,20','0','Letter','pdf','1','1','','0','0','0','1024','','12','e','300000','0','','0','0','1','0','2')||
