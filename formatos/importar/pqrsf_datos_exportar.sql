INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('pqrsf','PQRSF','0','1','ft_pqrsf','mostrar_pqrsf.php','editar_pqrsf.php','adicionar_pqrsf.php','','','','1','<p style="text-align: right;">&nbsp;<span>{*generar_qr_pqrsf*}</span></p>
<p>&nbsp;</p>
<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="text-align: left; width: 30%;"><strong>&nbsp;Estado PQRSF</strong></td>
<td style="text-align: left; width: 20%;">&nbsp;{*estado_reporte*}</td>
<td style="text-align: left; width: 30%;">&nbsp;<strong>Fecha Cambio Estado</strong></td>
<td style="text-align: left; width: 20%;">&nbsp;{*ver_fecha_reporte*}</td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;Tipo Comentario:</strong></td>
<td style="text-align: left;" colspan="3">&nbsp;{*tipo*}<strong></strong></td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;Nombre Completo:</strong></td>
<td>&nbsp;{*nombre*}</td>
<td>&nbsp;<strong>Documento:</strong></td>
<td>&nbsp;{*documento*}</td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;Email:&nbsp;</strong></td>
<td style="text-align: left;">&nbsp;{*email*}</td>
<td style="text-align: left;">&nbsp;<strong>Telefono o Celular:</strong></td>
<td style="text-align: left;">&nbsp;{*telefono*}</td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;<strong>Rol en la Insitucion:</strong></strong></td>
<td style="text-align: left;" colspan="3">&nbsp;{*rol_institucion*}</td>
</tr>
<tr>
<td style="text-align: left;" colspan="4"><strong>&nbsp;Comentario:</strong></td>
</tr>
<tr>
<td colspan="4">&nbsp;{*comentarios*}</td>
</tr>
<tr>
<td colspan="4">&nbsp;<strong>Documento Soporte del Comentario:&nbsp;</strong>{*mostrar_anexos_pqrsf*}<strong></strong></td>
</tr>
</tbody>
</table>
<p>{*mostrar_datos_hijos*}</p>
<p>{*mostrar_estado_proceso*}</p>','','15,20,35,20','0','A4','pdf','1','1','','0','0','0','1032','','10','e','300000','0','','0','0','1,7','0','','1','1')||
