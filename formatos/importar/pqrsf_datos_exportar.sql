INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo,permite_imprimir,firma_crt,pos_firma_crt,logo_firma_crt,pos_logo_firma_crt) VALUES('pqrsf','Peticiones Quejas Reclamos Solicitudes Felicitaciones','0','1','ft_pqrsf','mostrar_pqrsf.php','editar_pqrsf.php','adicionar_pqrsf.php','','','','1','<p style="text-align: left;">{*enlace_llenar_datos_radicacion_rapida_pqrsf*}</p>
<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="text-align: left; width: 20%;"><strong>&nbsp;Estado PQRSF</strong></td>
<td style="text-align: left; width: 25%;">&nbsp;{*estado_reporte*}</td>
<td style="text-align: left; width: 20%;">&nbsp;<strong>Fecha Cambio Estado</strong></td>
<td style="text-align: left; width: 15%;">&nbsp;{*ver_fecha_reporte*}</td>
<td style="text-align: center; width: 20%;" rowspan="5">{*mostrar_codigo_qr*}</td>
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
<td style="text-align: left;" colspan="5"><strong>&nbsp;Comentario:</strong>&nbsp;{*comentarios*}</td>
</tr>
<tr>
<td colspan="5">&nbsp;<strong>Documento Soporte del Comentario:&nbsp;</strong>{*anexos*}</td>
</tr>
</tbody>
</table>
<p><br />{*mostrar_datos_hijos*}</p>
<p>{*mostrar_listado_distribucion_documento*}</p>
<p>{*mostrar_estado_proceso*}</p>','9','15,20,15,15','0','Letter','mpdf','1','1','','0','0','0','0','','11','e','300000','0','','0','0','1','0','','1','1','1','','','','')||
