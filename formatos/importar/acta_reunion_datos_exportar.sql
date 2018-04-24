INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo,permite_imprimir,firma_crt,pos_firma_crt,logo_firma_crt,pos_logo_firma_crt) VALUES('acta_reunion','Acta de Reuni&oacute;n','0','246','ft_acta_reunion','mostrar_acta_reunion.php','editar_acta_reunion.php','adicionar_acta_reunion.php','','','','1','<table class="table table-bordered" style="width: 100%; font-size: 10px; text-align: left;" border="1" cellpadding="3">
<tbody>
<tr>
<td style="width: 20%;"><strong>Acta N&deg;</strong></td>
<td style="width: 20%;">{*mostrar_numero_convocatoria*}</td>
<td style="width: 20%;"><strong>Fecha Creaci&oacute;n</strong></td>
<td style="width: 20%;">{*mostrar_fecha_creacion_acta*}</td>
<td style="width: 20%; text-align: center;" rowspan="3">{*mostrar_codigo_qr*}</td>
</tr>
<tr>
<td><strong>Fecha de Reuni&oacute;n</strong></td>
<td style="text-align: left;">{*fecha_comite*}</td>
<td><strong>Estado</strong></td>
<td>{*botones_estado_acta*}</td>
</tr>
<tr>
<td><strong>Tipo de Reuni&oacute;n</strong></td>
<td>{*ver_tipo_reunion*}</td>
<td><strong>Confidencialidad</strong></td>
<td>{*confidencialidad*}</td>
</tr>
<tr>
<td><strong>Anexos del Acta</strong></td>
<td colspan="4">{*soporte_acta*}</td>
</tr>
</tbody>
</table>
<p>{*mostrar_asistentes_acta*}</p>
<p>{*mostrar_item_invitado*}</p>
<p>{*temas_acta*}</p>
<p>{*mostrar_conclusiones*}</p>
<p>{*tareas_acta*}</p>
<p>{*mostrar_estado_proceso*}</p>','','15,20,35,20','0','Letter','mpdf','1','1','','0','0','0','0','','11','m','300000','0','0','0','0','2,3','0','1','0','0','1','','','','')||
