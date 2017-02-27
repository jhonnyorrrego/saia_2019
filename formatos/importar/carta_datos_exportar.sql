INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('carta','Comunicacion externa','0','2','ft_carta','mostrar_carta.php','editar_carta.php','adicionar_carta.php','','','','1','<table style="width: 100%; border-collapse: collapse;" border="0">
<tbody>
<tr>
<td style="width: 60%;">&nbsp;</td>
<td style="text-align: center; width: 20%;">&nbsp;</td>
<td style="text-align: left; width: 20%;">&nbsp;</td>
</tr>
<tr>
<td>{*ciudad*}, {*mostrar_fecha*}<br /><br /><br />{*mostrar_destinos*}</td>
<td colspan="2">
<table style="width: 100%; border-collapse: collapse;" border="0">
<tbody>
<tr>
<td style="width: 2%; border-left-style: solid; border-top-style: solid;">&nbsp;</td>
<td style="width: 41%; border-top-style: solid;">&nbsp;</td>
<td style="width: 3%; border-top-style: solid;">&nbsp;</td>
<td style="width: 52%; border-top-style: solid;">&nbsp;</td>
<td style="width: 2%; border-right-style: solid; border-top-style: solid;">&nbsp;</td>
</tr>
<tr>
<td style="border-left-style: solid;">&nbsp;</td>
<td style="padding-right: 10px; border-bottom-style: solid;" rowspan="3">{*mostrar_qr_carta*}&nbsp;</td>
<td>&nbsp;</td>
<td style="font-size: 7pt; padding: 10px; border-bottom-style: solid;" rowspan="3"><br /><br /> <span style="font-size: 7pt;">{*mostrar_datos_radicacion*}</span></td>
<td style="border-right-style: solid;">&nbsp;</td>
</tr>
<tr>
<td style="border-left-style: solid;">&nbsp;</td>
<td>&nbsp;</td>
<td style="border-right-style: solid;">&nbsp;</td>
</tr>
<tr>
<td style="border-left-style: solid; border-bottom-style: solid;">&nbsp;</td>
<td style="border-bottom-style: solid;">&nbsp;</td>
<td style="border-right-style: solid; border-bottom-style: solid;">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table style="; width: 100%; font-family: Arial;" border="0" cellspacing="0">
<tbody>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><br /><br />Asunto: {*asunto*}&nbsp;</td>
</tr>
<tr>
<td><br /><br />Cordial saludo:&nbsp;</td>
</tr>
<tr>
<td>{*contenido*}&nbsp;</td>
</tr>
<tr>
<td><br /><br />Atentamente,&nbsp;</td>
</tr>
<tr>
<td><br />{*mostrar_estado_proceso*}&nbsp; <span style="width: 30%; text-align: right;">&nbsp;</span></td>
</tr>
<tr>
<td><br />{*mostrar_anexos_externa*}{*tamanio_texto_anexos_ext*}{*mostrar_copias_comunicacion_ext*}Transcriptor: {*iniciales*}</td>
</tr>
</tbody>
</table>','5','27,21,40,27','0','Letter','pdf','1','1','','0','0','0','5','','12','r','300000','1','0','0','0','2,5','0','1','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('memorando','Comunicacion Interna','0','4','ft_memorando','mostrar_memorando.php','editar_memorando.php','adicionar_memorando.php','','','','1','<table style="width: 100%; border-collapse: collapse;" border="0">
<tbody>
<tr>
<td style="width: 70%;">&nbsp;</td>
<td style="width: 20%; text-align: center;">&nbsp;</td>
<td style="text-align: left; width: 10%;">&nbsp;</td>
</tr>
<tr>
<td style="width: 70%;">{*ciudad*}, {*mostrar_fecha*}</td>
<td style="width: 30%; text-align: center;" rowspan="3" colspan="2">
<table style="width: 100%; border-collapse: collapse;" border="0">
<tbody>
<tr>
<td style="width: 5%; border-left-style: solid; border-top-style: solid;">&nbsp;</td>
<td style="width: 42%; border-top-style: solid;">&nbsp;</td>
<td style="width: 50%; border-top-style: solid;">&nbsp;</td>
<td style="width: 3%; border-right-style: solid; border-top-style: solid;">&nbsp;</td>
</tr>
<tr>
<td style="border-left-style: solid;">&nbsp;</td>
<td rowspan="3">{*mostrar_qr_interna*}</td>
<td>&nbsp;</td>
<td style="border-right-style: solid;">&nbsp;</td>
</tr>
<tr>
<td style="border-left-style: solid;">&nbsp;</td>
<td style="font-size: 8pt;">&nbsp;Radicaci&oacute;n No: {*formato_numero*}&nbsp;</td>
<td style="border-right-style: solid;">&nbsp;</td>
</tr>
<tr>
<td style="border-left-style: solid;">&nbsp;</td>
<td>&nbsp;</td>
<td style="border-right-style: solid;">&nbsp;</td>
</tr>
<tr>
<td style="border-left-style: solid; border-bottom-style: solid;">&nbsp;</td>
<td style="border-bottom-style: solid;">&nbsp;</td>
<td style="border-bottom-style: solid;">&nbsp;</td>
<td style="border-right-style: solid; border-bottom-style: solid;">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td colspan="1">&nbsp;</td>
</tr>
<tr>
<td colspan="1">&nbsp;</td>
</tr>
<tr>
<td colspan="3">&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" valign="top" width="10%">PARA:</td>
<td colspan="2" valign="top" width="80%">{*lista_destinos*}</td>
</tr>
<tr>
<td valign="top">&nbsp;</td>
<td colspan="2" valign="top">&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" valign="top" width="10%">DE:</td>
<td colspan="2" valign="top" width="90%">{*mostrar_origen*}</td>
</tr>
<tr>
<td valign="top">&nbsp;</td>
<td colspan="2" valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="top">&nbsp;</td>
<td colspan="2" valign="top">&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" valign="top" width="10%">ASUNTO:</td>
<td colspan="2" width="90%">{*asunto*}</td>
</tr>
<tr>
<td style="text-align: left;" valign="top" width="10%">&nbsp;</td>
<td colspan="2" width="90%">&nbsp;</td>
</tr>
</tbody>
</table>
<table style="font-size: 18px; font-family: arial; width: 100%;" border="0" cellspacing="0">
<tbody>
<tr>
<td>Cordial saludo:</td>
</tr>
<tr>
<td>{*contenido*}</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>Atentamente,</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>
<p>{*mostrar_estado_proceso*}</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>{*mostrar_anexos*}{*mostrar_copias_memo*}<span>Transcriptor: {*mostrar_iniciales*}</span></td>
</tr>
</tbody>
</table>','','27,21,40,27','0','Letter','','1','1','','0','0','0','1','Documento informativo de comunicaci&oacute;n interna','12','m','300000','1','0','0','0','2,10','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('radicacion_entrada','Radicacion de Correspondencia','0','1','ft_radicacion_entrada','mostrar_radicacion_entrada.php','editar_radicacion_entrada.php','adicionar_radicacion_entrada.php','','','','1','<p>{*llenar_datos_funcion*}</p>
<p style="text-align: center;"><strong>INFORMACI&Oacute;N GENERAL</strong></p>
<p style="text-align: center;">{*mostrar_informacion_general_radicacion*}</p>
<p style="text-align: center;"><strong>INFORMACI&Oacute;N ORIGEN</strong></p>
<table class="table table-bordered" style="width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 25%;"><strong>Tipo de Origen:</strong></td>
<td>{*tipo_origen*}&nbsp;&nbsp;</td>
</tr>
<tr>
<td><strong>Origen:</strong></td>
<td>{*obtener_informacion_proveedor*}</td>
</tr>
</tbody>
</table>
<p style="text-align: center;"><strong><strong>INFORMACI&Oacute;N DESTINO</strong><br /></strong></p>
<p style="text-align: center;"><span>{*mostrar_informacion_destino_radicacion*}</span>&nbsp;</p>
<p>{*imagenes_digitalizadas_funcion*}{*mostrar_item_destino_radicacion*}</p>
<p>{*mostrar_estado_proceso*}</p>','','15,20,30,20','0','A4','','533','0','','0','0','0','2','','9','e','300000','0','0','0','0','1,14','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('novedad_despacho','Novedad Despacho Mensajeros','0','227','ft_novedad_despacho','mostrar_novedad_despacho.php','editar_novedad_despacho.php','adicionar_novedad_despacho.php','','','','1','<table style="border-collapse: collapse; ; width: 100%;" border="1">
<tbody>
<tr>
<td>Radicado Item:</td>
<td>{*mostrar_numero_item_novedad*}</td>
</tr>
<tr>
<td>Novedad:</td>
<td>{*novedad*}</td>
</tr>
<tr>
<td>Observaciones:</td>
<td>{*observaciones*}</td>
</tr>
</tbody>
</table>','','15,20,30,20','0','A5','pdf','1','0','','1','0','0','1215','','9','e','300000','0','','0','0','2,14','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('ruta_distribucion','Rutas de Distribuci&oacute;n','0','220','ft_ruta_distribucion','mostrar_ruta_distribucion.php','editar_ruta_distribucion.php','adicionar_ruta_distribucion.php','','','','1','<p><br /><br /></p>
<table style="width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 20%;"><strong>&nbsp;Fecha</strong></td>
<td>&nbsp;{*fecha_ruta_distribuc*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><strong>&nbsp;Nombre de la Ruta&nbsp;</strong></td>
<td>&nbsp;{*nombre_ruta*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">&nbsp;Descripci&oacute;n Ruta&nbsp;</td>
<td>&nbsp;{*descripcion_ruta*}&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p>{*enlace_item_dependencias_ruta*}&nbsp;</p>
<p>{*mostrar_datos_dependencias_ruta*}</p>
<p>&nbsp;</p>
<p>{*enlace_item_funcionarios_ruta*}</p>
<p>{*mostrar_datos_funcionarios_ruta*}</p>
<p>{*mostrar_estado_proceso*}</p>','','15,20,30,20','0','A4','pdf','1','1','','0','1','0','1280','','9','m','300000','0','','0','0','2,13','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('destino_radicacion','destino_radicacion','0','218','ft_destino_radicacion','mostrar_destino_radicacion.php','editar_destino_radicacion.php','adicionar_destino_radicacion.php','','','','','','','15,20,30,20','0','A4','pdf','1','1','','0','0','1','1279','','9','m','300000','1','','0','0','2','0','','1','0')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('funcionarios_ruta','Funcionarios de la ruta','0','222','ft_funcionarios_ruta','mostrar_funcionarios_ruta.php','editar_funcionarios_ruta.php','adicionar_funcionarios_ruta.php','','','','','','','15,20,30,20','0','A4','pdf','1','1','','0','0','1','1282','','9','m','300000','1','','0','0','2','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('dependencias_ruta','Dependencias de la Ruta','0','221','ft_dependencias_ruta','mostrar_dependencias_ruta.php','editar_dependencias_ruta.php','adicionar_dependencias_ruta.php','','','','','','','15,20,30,20','0','A4','pdf','1','1','','0','0','1','1281','','9','m','300000','0','','0','0','2','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('proceso','Proceso','0','8','ft_proceso','mostrar_proceso.php','editar_proceso.php','adicionar_proceso.php','','','','2','<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table style="width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado" style="font-size: 10pt; border: #000000 1px solid;">
<p>Responsable</p>
</td>
<td class="celda_transparente" style="font-size: 10pt; border: #000000 1px solid;" colspan="2">{*responsable*} {*icono_detalles*}</td>
</tr>
<tr>
<td class="encabezado" style="font-size: 10pt; border: #000000 1px solid;">L&iacute;der</td>
<td class="celda_transparente" style="font-size: 10pt; border: #000000 1px solid;" colspan="2">{*lider_proceso*}</td>
</tr>
<tr>
<td class="encabezado" style="font-size: 10pt; border: #000000 1px solid;">Objetivo</td>
<td class="celda_transparente" style="font-size: 10pt; border: #000000 1px solid;" colspan="2">{*objetivo*}</td>
</tr>
<tr>
<td class="encabezado" style="font-size: 10pt; border: #000000 1px solid;">Alcance</td>
<td class="celda_transparente" style="font-size: 10pt; border: #000000 1px solid;" colspan="2">{*alcance*}</td>
</tr>
<tr>
<td class="encabezado" style="font-size: 10pt; border: #000000 1px solid;">Dependencias participantes:</td>
<td class="celda_transparente" style="font-size: 10pt; border: #000000 1px solid;" colspan="2">{*dependencias_partici*}</td>
</tr>
<tr>
<td style="font-size: 10pt;" colspan="3">{*link_cuadro_mando*}</td>
</tr>
<tr>
<td class="encabezado" style="text-align: center; font-size: 10pt;" colspan="2">Riesgos del Proceso</td>
<td class="encabezado" style="text-align: center; font-size: 10pt;">Listados Maestros</td>
</tr>
<tr>
<td class="celda_transparente" style="font-size: 10pt; border: #000000 1px solid;" colspan="2">&nbsp;{*enlace_riesgos*}</td>
<td class="celda_transparente" style="font-size: 10pt; border: #000000 1px solid;">{*listado_maestro_documentos*}</td>
</tr>
<tr>
<td class="encabezado_list" colspan="3" valign="top">Politicas de Operacion de Proceso</td>
</tr>
<tr>
<td style="font-size: 10pt; text-align: center;" colspan="3">{*listar_politicas_proceso*}</td>
</tr>
<tr>
<td class="celda_transparente" style="font-size: 10pt; border: #000000 1px solid;" colspan="3">Anexos: <br />{*mostrar_anexos_anexos_proceso*}</td>
</tr>
<tr>
<td class="celda_transparente" style="font-size: 10pt; border: #000000 1px solid;" colspan="3">{*aprobacion*}</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>','','15,20,30,20','0','Letter','pdf','1','1','','0','1','0','8','','9','e','300000','0','','0','0','2,15','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('clasificacion_pqrsf','1. Clasificacion PQRSF','0','125','ft_clasificacion_pqrsf','mostrar_clasificacion_pqrsf.php','editar_clasificacion_pqrsf.php','adicionar_clasificacion_pqrsf.php','','','','20','<table style="border-collapse: collapse; font-size: 10pt; width: 100%;" border="1">
<tbody>
<tr>
<td style="text-align: left;"><strong>Clasificacion del Reclamo</strong></td>
<td>&nbsp;{*serie*}</td>
</tr>
<tr>
<td style="text-align: left; width: 30%;"><strong>Resonsable:&nbsp;</strong></td>
<td style="text-align: left; width: 70%;">&nbsp;{*ver_responsable*}</td>
</tr>
<tr>
<td style="text-align: left;" colspan="2"><strong>Observaciones:</strong></td>
</tr>
<tr>
<td colspan="2">{*observaciones*}</td>
</tr>
</tbody>
</table>
<p>{*mostrar_estado_proceso*}</p>','','15,20,35,20','0','Letter','pdf','1','0','','0','0','0','1033','','12','e','300000','0','','0','0','2,7','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('respuesta_pqrsf','2. Respuesta PQRSF','0','3','ft_respuesta_pqrsf','mostrar_respuesta_pqrsf.php','editar_respuesta_pqrsf.php','adicionar_respuesta_pqrsf.php','','','','20','<p>{*mostrar_informacion_pqrsf_padre*}</p>
<p>&nbsp;</p>
<p>{*mostrar_estado_proceso*}</p>','','15,20,35,20','0','Letter','pdf','1','0','','1','0','0','1036','','12','m','300000','0','','0','0','2,7','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('vincular_doc_expedie','Vincular documentos a un expediente','0','130','ft_vincular_doc_expedie','mostrar_vincular_doc_expedie.php','editar_vincular_doc_expedie.php','adicionar_vincular_doc_expedie.php','','','','','<table style="border-collapse: collapse; width: 100%; font-size: 10pt;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 30%;">Fecha</td>
<td>{*fecha_documento_funcion*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Asunto</td>
<td>{*asunto*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Serie</td>
<td>{*serie_idserie*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Anexo</td>
<td>{*anexos*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Observaciones</td>
<td>{*observaciones*}</td>
</tr>
</tbody>
</table>
<p>{*mostrar_estado_proceso*}</p>','','15,20,30,20','0','A4','pdf','1','1','','0','1','0','1045','','9','e','300000','0','','0','0','2,13','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('analisis_pqrsf','Planeacion - Analisis de Causas','0','131','ft_analisis_pqrsf','mostrar_analisis_pqrsf.php','editar_analisis_pqrsf.php','adicionar_analisis_pqrsf.php','','','','20','<p>{*transferir_responsa*}</p>
<table style="border-collapse: collapse; font-size: 12px; width: 100%;" border="1">
<tbody>
<tr>
<td style="text-align: left;"><strong>&nbsp;Analisis de Causas</strong></td>
<td>&nbsp;{*analisis_causas*}</td>
</tr>
</tbody>
</table>
<p>{*mostrar_item*}</p>
<p>{*mostrar_estado_proceso*}</p>','','15,20,30,20','0','A4','pdf','1','1','','0','0','0','1047','','9','m','300000','0','','0','0','2,13','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('item_causas_pqrsf','Items Analisis de Causas PQRSF','0','132','ft_item_causas_pqrsf','mostrar_item_causas_pqrsf.php','editar_item_causas_pqrsf.php','adicionar_item_causas_pqrsf.php','','','','20','<table style="border-collapse: collapse; font-size: 12px; width: 100%;" border="1">
<tbody>
<tr>
<td style="text-align: left;"><strong>&nbsp;Accion</strong></td>
<td>&nbsp;{*accion_causa*}</td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;Resonsable:&nbsp;</strong></td>
<td style="text-align: left;">&nbsp;{*responsable*}</td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;Fecha Limite:</strong></td>
<td style="text-align: left;">&nbsp;{*fecha_limite*}</td>
</tr>
</tbody>
</table>','','15,20,30,20','0','A4','pdf','1','0','','0','0','1','1049','','9','m','300000','0','','0','0','2,13','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('reservar_documento','Reservar','0','142','ft_reservar_documento','mostrar_reservar_documento.php','editar_reservar_documento.php','adicionar_reservar_documento.php','','','','1','<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 30%;"><strong>Fecha de solicitud</strong></td>
<td style="width: 70%;">{*fecha_solicitud*}</td>
</tr>
<tr>
<td><strong>Desde</strong></td>
<td>{*desde*}</td>
</tr>
<tr>
<td><strong>Hasta</strong></td>
<td>{*hasta*}</td>
</tr>
<tr>
<td><strong>Solicitar a</strong></td>
<td>{*solicitar_a*}</td>
</tr>
<tr>
<td colspan="2"><strong>Observaciones</strong></td>
</tr>
<tr>
<td colspan="2">{*observaciones*}</td>
</tr>
</tbody>
</table>
<p>{*mostrar_estado_proceso*}</p>','','15,20,30,20','0','A4','pdf','1','0','','1','0','0','1108','','9','e','300000','0','','0','0','2,13','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('entrega_prestamo','Entrega de Pr&amp;eacute;stamo','0','229','ft_entrega_prestamo','mostrar_entrega_prestamo.php','editar_entrega_prestamo.php','adicionar_entrega_prestamo.php','','','','1','1','','15,20,40,20','0','A4','pdf','1','0','','1','0','0','1289','','12','e','300000','0','','0','0','2,13','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('prueba_confir_apru','Prueba (confirma - aprueba)','0','226','ft_prueba_confir_apru','mostrar_prueba_confir_apru.php','editar_prueba_confir_apru.php','adicionar_prueba_confir_apru.php','','','','','1','','15,20,30,20','0','A4','pdf','1','1','','0','0','0','0','','9','m','300000','1','','0','0','2,13','0','','1','0')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('solicitud_prestamo','Solicitud de Prestamo de documentos','0','228','ft_solicitud_prestamo','mostrar_solicitud_prestamo.php','editar_solicitud_prestamo.php','adicionar_solicitud_prestamo.php','','','','1','1','','15,20,40,20','0','A4','pdf','1','1','','0','0','0','1289','','12','m','300000','1','','0','0','2,13','0','1','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('inventario_jubilados','INVENTARIO JUBILADOS','0','225','ft_inventario_jubilados','mostrar_inventario_jubilados.php','editar_inventario_jubilados.php','adicionar_inventario_jubilados.php','','','','42','1','','15,20,30,20','0','A4','pdf','1','1','','0','0','0','1293','','9','e','300000','1','','0','0','2,20','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('calificacion_qrsf','Calificacion PQRSF','0','166','ft_calificacion_qrsf','mostrar_calificacion_qrsf.php','editar_calificacion_qrsf.php','adicionar_calificacion_qrsf.php','','','','1','<table style="; width: 100%;" border="0">
<tbody>
<tr>
<td class="encabezado">Fecha</td>
<td>&nbsp;{*fecha_aprobacion*}</td>
</tr>
<tr>
<td class="encabezado">Calificaci&oacute;n</td>
<td>{*calificacion_pqrsf*}</td>
</tr>
<tr>
<td class="encabezado">Descripci&oacute;n</td>
<td>&nbsp;{*descripcion*}</td>
</tr>
</tbody>
</table>','12','15,20,30,20','0','A4','pdf','1','1','','1','0','0','1195','','9','e','300000','1','','0','0','7','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('transferencia_doc','Transferencia documental','0','167','ft_transferencia_doc','mostrar_transferencia_doc.php','editar_transferencia_doc.php','adicionar_transferencia_doc.php','','','','1','<table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 30%;"><strong>UNIDAD ADMINISTRATIVA</strong></td>
<td style="width: 70%;">{*mostrar_unidad_admin_transf*}</td>
</tr>
<tr>
<td><strong>OFICINA PRODUCTORA</strong></td>
<td>{*mostrar_oficina_productora_transf*}</td>
</tr>
<tr>
<td><strong>OBSERVACIONES</strong></td>
<td>{*observaciones*}</td>
</tr>
<tr>
<td><strong>ANEXOS</strong></td>
<td>{*anexos*}</td>
</tr>
</tbody>
</table>
<p>{*expedientes_vinculados_funcion*}&nbsp;</p>
<p>{*mostrar_estado_proceso*}</p>','','15,15,35,20','1','A4','pdf','1','0','','0','0','0','1196','','9','m','300000','0','','0','0','2,13','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('correo_saia','Correo SAIA','0','1','ft_correo_saia','mostrar_correo_saia.php','editar_correo_saia.php','adicionar_correo_saia.php','','','','1','<table style="width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left;">Asunto</td>
<td style="text-align: left;">&nbsp;{*asunto*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Fecha Oficio Entrada</td>
<td style="text-align: left;">&nbsp;{*fecha_oficio_entrada*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">De</td>
<td style="text-align: left;">&nbsp;{*de*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Para</td>
<td style="text-align: left;">&nbsp;{*para*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Transferido</td>
<td style="text-align: left;">&nbsp;{*transferencia_correo*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Con copia</td>
<td style="text-align: left;">&nbsp;{*copia_correo*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Comentario</td>
<td style="text-align: left;">&nbsp;{*comentario*}</td>
</tr>
</tbody>
</table>
<p>{*mostrar_estado_proceso*}</p>
<p>{*mostrar_anexos_correo*}</p>','','15,20,30,20','0','A4','pdf','1','0','','0','0','0','1210','','9','e','300000','0','','0','0','2','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('despacho_fisico','Despacho fisico','0','176','ft_despacho_fisico','mostrar_despacho_fisico.php','editar_despacho_fisico.php','adicionar_despacho_fisico.php','','','','','<p>{*mostrar_seleccionados_despacho*}</p>','','15,20,30,20','1','A4','pdf','1','1','','0','0','0','1214','','10','e','300000','0','','0','0','2,13','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('despacho_ingresados','Entrega interna','0','177','ft_despacho_ingresados','mostrar_despacho_ingresados.php','editar_despacho_ingresados.php','adicionar_despacho_ingresados.php','','','','','<p>{*mostrar_seleccionados_entrega*}</p>','','15,20,30,20','0','A4','pdf','1','0','','0','1','0','1215','','9','e','300000','0','','0','0','2,13','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('macroproceso_calidad','Macroproceso','0','180','ft_macroproceso_calidad','mostrar_macroproceso_calidad.php','editar_macroproceso_calidad.php','adicionar_macroproceso_calidad.php','','','','33','<table style="width: 100%; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left;">Nombre</td>
<td>{*nombre*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Descripcion</td>
<td>{*des_formato*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Caracterizacion</td>
<td>{*caracterizacion*}</td>
</tr>
</tbody>
</table>
<p>{*mostrar_estado_proceso*}</p>','','15,20,40,20','0','Letter','pdf','1','1','','0','0','0','1232','','12','m','300000','0','0','0','0','2,16','0','1','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('procedimiento','Procedimiento','0','182','ft_procedimiento','mostrar_procedimiento.php','editar_procedimiento.php','adicionar_procedimiento.php','','','','','<table style="border-collapse: collapse; ; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left;">Fecha vigencia</td>
<td>{*fecha_nomina*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Nombre</td>
<td>{*nombre*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Estado</td>
<td>{*estado*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Secretarias</td>
<td>{*secretarias*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Anexos</td>
<td>{*mostrar_anexos_anexos_procedimiento*}</td>
</tr>
</tbody>
</table>','','30,30,50,30','0','Letter','pdf','1','1','','0','1','0','1234','','10','m','300000','0','0','0','0','','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('plan_calidad','Planes de Calidad','0','184','ft_plan_calidad','mostrar_plan_calidad.php','editar_plan_calidad.php','adicionar_plan_calidad.php','','','','','<table style="width: 100%; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left;">Nombre</td>
<td>{*nombre*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Estado</td>
<td>{*estado*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Soporte</td>
<td>{*mostrar_anexos_soporte_plan_calidad*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Secretarias Vinculadas</td>
<td>{*secretarias*}</td>
</tr>
</tbody>
</table>','','30,30,30,30','0','Letter','','1','0','','0','1','0','1236','','10','m','300000','0','0','0','0','','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('prog_calidad','Programas','0','185','ft_prog_calidad','mostrar_prog_calidad.php','editar_prog_calidad.php','adicionar_prog_calidad.php','','','','','<table style="width: 100%; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left;">Nombre</td>
<td>{*nombre*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Estado</td>
<td>{*estado*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Anexos</td>
<td>{*mostrar_anexos_anexos_prog_calidad*}</td>
</tr>
</tbody>
</table>','','15,20,30,20','0','Letter','pdf','1','1','','1','0','0','645','','9','m','300000','0','0','0','0','','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('formato','Formatos','0','188','ft_formato','mostrar_formato.php','editar_formato.php','adicionar_formato.php','','','','','<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="width: 20%; text-align: left;" valign="top">Nombre:</td>
<td>{*nombre*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;" valign="top">Documento Soporte:</td>
<td>&nbsp;{*mostrar_anexos_soporte_formato*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Secretarias Participantes:</td>
<td>{*secretarias*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Estado</td>
<td>{*estado*}</td>
</tr>
</tbody>
</table>','','30,30,30,30','0','Letter','','1','0','','0','1','0','1239','','10','m','300000','0','0','0','0','','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('otros_calidad','Otros Documentos Calidad','0','189','ft_otros_calidad','mostrar_otros_calidad.php','editar_otros_calidad.php','adicionar_otros_calidad.php','','','','','<table style="width: 100%; border-collapse: collapse;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left;" valign="top">Nombre:</td>
<td>{*nombre*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;" valign="top">Estado:</td>
<td>&nbsp;{*estado*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;" valign="top">Documento Soporte:</td>
<td>&nbsp;{*mostrar_anexos_soporte_otros_calidad*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Secretaria a la que Pertenece:</td>
<td>
<p>{*secretarias*}</p>
</td>
</tr>
</tbody>
</table>','','30,30,30,30','0','Letter','','1','0','','0','1','0','1240','','9','m','300000','0','0','0','0','','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('instructivo','Instructivos','0','192','ft_instructivo','mostrar_instructivo.php','editar_instructivo.php','adicionar_instructivo.php','','','','','<table style="width: 100%; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left;">Nombre</td>
<td>{*nombre*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Estado</td>
<td>{*estado*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Soporte</td>
<td>{*mostrar_anexos_soporte_instructivo*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Secretarias Vinculadas</td>
<td>{*secretarias*}</td>
</tr>
</tbody>
</table>','','30,30,30,30','0','Letter','','1','0','','0','1','0','1243','','10','m','300000','0','0','0','0','','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('contexto_extrategico','Contexto estrategico','0','193','ft_contexto_extrategico','mostrar_contexto_extrategico.php','editar_contexto_extrategico.php','adicionar_contexto_extrategico.php','','','','','<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td>
<p align="center"><strong>CONTEXTO ESTRAT&Eacute;GICO</strong></p>
</td>
</tr>
<tr>
<td>
<p>PROCESO:&nbsp;{*proceso*}</p>
</td>
</tr>
<tr>
<td>
<p>OBJETIVO:&nbsp;{*mostrar_objetivo_contexto_estrategico*}</p>
</td>
</tr>
</tbody>
</table>
<p>{*adiconar_factores_contexto*}</p>
<p>{*mostrar_estado_proceso*}</p>','','15,20,30,20','0','Letter','','1','1','','1','1','0','1244','','12','m','300000','0','0','0','0','2','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('indicadores_calidad','Indicador(es) de Calidad','0','194','ft_indicadores_calidad','mostrar_indicadores_calidad.php','editar_indicadores_calidad.php','adicionar_indicadores_calidad.php','','','','33','<p>Fecha de creaci&oacute;n: {*mostrar_fecha*}</p>
<table style="text-align: center; width: 100%; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left;">Dependencia:</td>
<td style="text-align: left;">{*dependencia_indicador*}</td>
<td class="encabezado_list" style="text-align: left;">Proceso:</td>
<td style="text-align: left;">{*nombre_padre*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Nombre Indicador:</td>
<td style="text-align: left;">{*nombre*}</td>
<td class="encabezado_list" style="text-align: left;">Fuente de Datos:</td>
<td style="text-align: left;">{*mostrar_fuente_datos*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Objetivo de Calidad:</td>
<td style="text-align: left;">{*mostrar_objetivo_calidad_indicador*}</td>
<td class="encabezado_list" style="text-align: left;">Responsable del an&aacute;lisis:</td>
<td style="text-align: left;">{*responsable_analisis*}</td>
</tr>
</tbody>
</table>
<p>{*formula_calculo*} <br /> {*resultados_indicador*}</p>','','10,10,40,20','0','Letter','','1','0','','1','0','0','1245','','9','m','300000','0','0','0','0','','0','','0','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('hijo_prueba','hijo_prueba','0','230','ft_hijo_prueba','mostrar_hijo_prueba.php','editar_hijo_prueba.php','adicionar_hijo_prueba.php','','','','','<p>mostrar hijo</p>','','15,20,30,20','0','A4','pdf','1','1','','0','0','0','1267','','9','e','300000','0','','0','0','2','0','','1','0')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('plan_mejoramiento','Plan de Mejoramiento','0','197','ft_plan_mejoramiento','mostrar_plan_mejoramiento.php','editar_plan_mejoramiento.php','adicionar_plan_mejoramiento.php','','','','','<p>&nbsp;</p>
<table style="border-collapse: collapse; font-size: 10pt; width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado" style="text-align: center;" colspan="4"><strong>PLAN DE MEJORAMIENTO&nbsp; {*tipo_plan*}</strong></td>
</tr>
<tr>
<td class="encabezado" style="text-align: left;" colspan="4">No. {*formato_numero*}</td>
</tr>
<tr>
<td class="encabezado">Fecha de Suscripci&oacute;n:</td>
<td align="left">{*fecha_suscripcion*}</td>
<td class="encabezado">Tipo de Auditor&iacute;a:</td>
<td>{*tipo_auditoria*}</td>
</tr>
<tr>
<td class="encabezado">Objetivo General:</td>
<td>{*objetivo*}</td>
<td class="encabezado">Descripci&oacute;n:</td>
<td>{*descripcion_plan*}</td>
</tr>
<tr>
<td class="encabezado">Objetivos Espec&iacute;ficos:</td>
<td>{*objetivos_especificos*}</td>
<td class="encabezado">Fecha Recepci&oacute;n Informe Final:</td>
<td align="left">{*fecha_informe*} {*mostrar_adjuntos*}</td>
</tr>
<tr>
<td class="encabezado" valign="top">Observaciones:</td>
<td>{*observaciones*}</td>
<td class="encabezado">Per&iacute;odo Evaluado:</td>
<td align="left">{*periodo_evaluado*}</td>
</tr>
<tr>
<td class="encabezado">Auditor</td>
<td>{*auditor*}</td>
<td class="encabezado">Descripci&oacute;n Auditor Otros/Autoevaluaci&oacute;n/Retroalimentaci&oacute;n cliente</td>
<td align="left">{*descripcion_otros*}</td>
</tr>
</tbody>
</table>
<p>{*mostrar_link_reporte*}</p>
<p>{*estado_del_plan*}</p>
<p>{*listar_hallazgo_plan_mejoramiento*}</p>
<table style="font-size: 6pt; width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado">Elaborado por:</td>
<td>{*elaborado_por*}</td>
<td class="encabezado">Revisado Por:</td>
<td>{*revisado_por*}</td>
<td class="encabezado">Aprobado Por:</td>
<td>{*aprobado_por*}</td>
</tr>
</tbody>
</table>
<p><span style="font-size: x-small;"><span style="font-size: small;">{*ver_campo_estado*}</span><br /></span></p>','','4,2,5,5','1','Legal','pdf','1','1','','0','0','0','1248','','10','e','300000','0','0','0','0','2,18','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('formula_indicador','Formula del indicador','0','199','ft_formula_indicador','mostrar_formula_indicador.php','editar_formula_indicador.php','adicionar_formula_indicador.php','','','','33','<table style="width: 100%; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left;" width="30%">F&oacute;rmula:</td>
<td>{*nombre*} {*validar_formula_mostrar*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Unidad:</td>
<td>{*unidad*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Periocidad:</td>
<td>{*periocidad*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Naturaleza:</td>
<td>{*naturaleza*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Descripci&oacute;n de Variables de la Formula</td>
<td>{*observacion*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;" valign="top">Rango en el cual el resultado se considera Satisfactorio</td>
<td>{*rango_colores*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;" valign="top">La mejora es creciente o decreciente?</td>
<td>{*tipo_rango*}</td>
</tr>
</tbody>
</table>','','10,10,40,20','0','Letter','','1','0','','0','0','0','1114','','9','m','300000','0','0','0','0','','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('variable_indicador','Variables Indicador','0','200','ft_variable_indicador','mostrar_variable_indicador.php','editar_variable_indicador.php','adicionar_variable_indicador.php','','','','33','<table style="width: 100%; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left;" valign="top">Nombre:</td>
<td>{*nombre*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;" valign="top">Descripci&oacute;n:</td>
<td>{*descripcion*}</td>
</tr>
</tbody>
</table>','','15,20,30,20','0','Letter','pdf','1','0','','1','0','0','1261','','9','e','300000','0','0','0','0','','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('seguimiento_indicador','Seguimiento Indicador','0','201','ft_seguimiento_indicador','mostrar_seguimiento_indicador.php','editar_seguimiento_indicador.php','adicionar_seguimiento_indicador.php','','','','','<p>{*enlace_planes*}</p>
<table style="width: 100%; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left;">Fecha Seguimiento:</td>
<td>{*fecha_seguimiento*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Datos de&nbsp;la Formula:</td>
<td>
<p>{*mostrar_variables*}</p>
</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Linea Base:</td>
<td>{*linea_base*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Meta:</td>
<td>{*meta_indicador_actual*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">An&aacute;lisis de datos:</td>
<td>{*observaciones*}</td>
</tr>
</tbody>
</table>
<p>{*mostrar_estado_proceso*}</p>','','10,10,30,20','0','Letter','','1','0','','1','0','0','1260','','9','m','300000','0','0','0','0','','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('bases_calidad','Bases de Calidad','0','204','ft_bases_calidad','mostrar_bases_calidad.php','editar_bases_calidad.php','adicionar_bases_calidad.php','','','','1','<table style="width: 100%; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left;">Tipo</td>
<td>{*tipo_base_calidad*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Versi&oacute;n</td>
<td>{*version_base_calidad*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Descripci&oacute;n</td>
<td>{*descripcion_base*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Estado</td>
<td>{*estado_base_calidad*}{*mostrar_anexos_soporte*}</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p>{*mostrar_estado_proceso*}</p>','','15,20,30,20','0','A4','pdf','1','1','','0','0','0','1251','','9','m','300000','0','','0','0','2,17','0','1','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('control_documentos','Solicitud de elaboraci&amp;oacute;n, modificaci&amp;oacute;n, eliminaci&amp;oacute;n de documentos','0','196','ft_control_documentos','mostrar_control_documentos.php','editar_control_documentos.php','adicionar_control_documentos.php','','','','37','<p>&nbsp;</p>
<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="text-align: center;" colspan="2"><span style="font-size: small;"><strong>Solicitud No. {*obtener_numero_solicitud*}&nbsp;</strong></span></td>
</tr>
<tr>
<td><strong>Nombre del solicitante:</strong></td>
<td>&nbsp;{*obtener_nombre_solicitante*} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td>
</tr>
<tr>
<td><strong>Fecha de la solicitud:</strong></td>
<td>&nbsp;{*obtener_fecha_solicitud_control_documento*}</td>
</tr>
<tr>
<td><strong>Serie documental</strong></td>
<td>&nbsp;{*serie_doc_control*}</td>
</tr>
<tr>
<td><strong>Tipo de solicitud:</strong></td>
<td>&nbsp;{*tipo_solicitud*}</td>
</tr>
<tr>
<td><strong><strong>Nombre del documento</strong></strong></td>
<td>&nbsp;{*nombre_documento*}</td>
</tr>
<tr>
<td><strong>Documento de calidad vinculado:</strong></td>
<td>&nbsp;{*obtener_documento_calidad*}</td>
</tr>
<tr>
<td><strong>Proceso Vinculado:</strong></td>
<td>&nbsp;{*obtener_proceso_vinculado*}</td>
</tr>
<tr>
<td><strong>Pasa de versi&oacute;n:</strong></td>
<td>&nbsp;{*obtener_version_documento*}</td>
</tr>
<tr>
<td style="text-align: left;" colspan="2" valign="top"><strong>Justificaci&oacute;n:</strong><br />{*justificacion*}</td>
</tr>
<tr>
<td colspan="2"><strong><strong><strong>Propuesta:</strong><br /></strong></strong>{*propuesta*}</td>
</tr>
<tr>
<td>&nbsp;<strong>Anexos:</strong></td>
<td>&nbsp;{*mostrar_anexos_memo*}</td>
</tr>
<tr>
<td colspan="2">&nbsp;<br />{*mostrar_estado_proceso*}&nbsp;</td>
</tr>
</tbody>
</table>
<p>{*confirmar_control_documentos*}</p>
<p>{*mostrar_firma_confirmacion_documento*}</p>
<p>{*aprobar_control_documentos*}</p>','','15,20,30,20','0','Letter','pdf','1','1','','0','0','0','1247','','12','m','300000','0','0','0','0','2,21','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('hallazgo','Hallazgo Plan de Mejoramiento','0','198','ft_hallazgo','mostrar_hallazgo.php','editar_hallazgo.php','adicionar_hallazgo.php','','','','','<p>&nbsp;{*mostrar_ft_gestion_calid_funcion*}</p>
<table style="width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: center;" valign="top"><strong>Datos Plan de mejoramiento</strong></td>
</tr>
<tr>
<td style="text-align: center;">{*detalles_padre*}<br />{*editar_hallazgo*}</td>
</tr>
</tbody>
</table>
<table style="width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado" valign="top">Radicado del plan vinculado</td>
<td colspan="2">&nbsp;{*radicado_plan*}</td>
</tr>
<tr>
<td class="encabezado" valign="top">Clase de Observaci&oacute;n</td>
<td class="celda_transparente" colspan="2">&nbsp;{*clase_observacion*}</td>
</tr>
<tr>
<td class="encabezado" valign="top">Deficiencia</td>
<td class="celda_transparente" colspan="2">&nbsp;{*deficiencia*}{*mostrar_correcion*}</td>
</tr>
<tr>
<td class="encabezado" valign="top">Causas</td>
<td class="celda_transparente" colspan="2">&nbsp;{*causas*}</td>
</tr>
<tr>
<td class="encabezado" valign="top">Area Responsable</td>
<td class="celda_transparente" colspan="2">&nbsp;{*secretarias*}</td>
</tr>
<tr>
<td class="encabezado" valign="top">Procesos Involucrados</td>
<td class="celda_transparente" colspan="2">&nbsp;{*procesos_vinculados_funcion*}</td>
</tr>
<tr>
<td class="encabezado" valign="top">Acci&oacute;n de Mejoramiento</td>
<td class="celda_transparente" colspan="2">&nbsp;{*accion_mejoramiento*}</td>
</tr>
<tr>
<td class="encabezado" valign="top">Responsables de Mejoramiento</td>
<td class="celda_transparente" colspan="2">
<p>&nbsp;{*modificar_responsable_mejoramiento*}&nbsp;</p>
<p>{*responsables*}</p>
</td>
</tr>
<tr>
<td class="encabezado" valign="top">Tiempo Programado Para Cumplimiento</td>
<td class="celda_transparente" colspan="2">&nbsp;{*tiempo_cumplimiento*}</td>
</tr>
<tr>
<td class="encabezado" valign="top">Mecanismo de Seguimiento Interno</td>
<td class="celda_transparente" colspan="2">&nbsp;{*mecanismo_interno*}</td>
</tr>
<tr>
<td class="encabezado" valign="top">Tiempo Programado Para Seguimiento</td>
<td class="celda_transparente" colspan="2">&nbsp;{*tiempo_seguimiento*}</td>
</tr>
<tr>
<td class="encabezado" valign="top">Responsable del Seguimiento</td>
<td class="celda_transparente">
<p>&nbsp;{*modificar_responsable_seguimiento*}&nbsp;</p>
<p>{*responsable_seguimiento*}</p>
</td>
</tr>
<tr>
<td class="encabezado" valign="top">Indicador de Acci&oacute;n de Cumplimiento</td>
<td class="celda_transparente" colspan="2">&nbsp;{*indicador_cumplimiento*}</td>
</tr>
<tr>
<td class="encabezado" valign="top">Observaciones</td>
<td class="celda_transparente" colspan="2">&nbsp;{*observaciones*}</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p>{*mostrar_estado_proceso*}</p>
<p>{*notificar_responsable_mejoramiento*}</p>
<p>{*notificar_responsable_cumplimiento*}</p>','','30,30,30,30','0','Letter','pdf','1','0','','0','0','0','1249','','10','e','300000','0','0','0','0','','0','','0','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('seguimiento','Reporte de Avance Acciones','0','208','ft_seguimiento','mostrar_seguimiento.php','editar_seguimiento.php','adicionar_seguimiento.php','','','','41','<table style="width: 100%;" border="0">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: center;" valign="top"><strong>Datos Hallazgo</strong></td>
</tr>
<tr>
<td style="text-align: center;">{*detalles_padre*}</td>
</tr>
</tbody>
</table>
<table style="width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado" style="width: 20%;" valign="top">Fecha</td>
<td class="celda_transparente" style="width: 80%;" valign="top">{*mostrar_fecha_seguimiento_plan_mejoramiento*}</td>
</tr>
<tr>
<td class="encabezado" valign="top">Porcentaje de Avance</td>
<td class="celda_transparente" valign="top">{*porcentaje*} %</td>
</tr>
<tr>
<td class="encabezado" valign="top">Logros alcanzados</td>
<td class="celda_transparente" valign="top">{*logros_alcanzados*}</td>
</tr>
<tr>
<td class="encabezado" valign="top">Observaciones</td>
<td class="celda_transparente" valign="top">{*observaciones*}</td>
</tr>
<tr>
<td class="encabezado" valign="top">Evidencia documental Adjunta</td>
<td>{*mostrar_anexos_seguimientop*}</td>
</tr>
</tbody>
</table>
<p>{*mostrar_estado_proceso*}</p>','','30,30,30,30','0','Letter','pdf','1','0','','0','0','0','1265','','10','e','300000','0','0','0','0','','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('informe_contraloria','Informe Seguimiento','0','209','ft_informe_contraloria','mostrar_informe_contraloria.php','editar_informe_contraloria.php','adicionar_informe_contraloria.php','','','','','<table style="width: 100%; border-collapse: collapse;" border="0">
<tbody>
<tr>
<td style="width: 2%;">&nbsp;</td>
<td style="width: 93%;">
<table style="width: 100%; border-collapse: collapse;" border="2">
<tbody>
<tr>
<td style="text-align: center;">
<table style="; width: 100%;" border="0">
<tbody>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="text-align: center;">
<p>&nbsp;</p>
<p><strong>INFORME DE SEGUIMIENTO AL PLAN DE MEJORAMIENTO</strong></p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
<td style="width: 5%;">&nbsp;</td>
</tr>
</tbody>
</table>
<p style="text-align: left;">&nbsp;{*link_agregar_campos*}</p>
<table>
<tbody>
<tr>
<td style="width: 2%;">&nbsp;</td>
<td style="width: 93%;">
<table style="border-collapse: collapse; width: 100%; attr-margin-left: 200; attr-margin-top: 5; table-width-pdf: 1176px !important;" border="2" cellpadding="5">
<tbody>
<tr>
<td class="encabezado" style="width: 30%;"><span><span>NUMERO DE PLAN</span></span></td>
<td style="width: 70%;"><span>{*radicado_plan*}</span></td>
</tr>
<tr>
<td class="encabezado" style="width: 30%;"><span><span><span>PROCESO AUDITADO</span></span></span></td>
<td style="width: 70%;"><span><span>{*proceso_auditado*}</span></span></td>
</tr>
<tr>
<td class="encabezado"><span>NOMBRE DEL JEFE DE CONTROL INTERNO</span></td>
<td><span>{*mostrar_nombre_jefe_control*}</span></td>
</tr>
<tr>
<td class="encabezado"><span>FECHA SUSCRIPCION DEL PLAN DE MEJORAMIENTO</span></td>
<td><span>{*suscripcion_plan*}</span></td>
</tr>
<tr>
<td class="encabezado"><span>FECHA DE SEGUIMIENTO A COMPROMISOS</span></td>
<td><span>{*fecha_compromisos*}</span></td>
</tr>
<tr>
<td colspan="2"><span><strong>RESULTADOS DE SEGUIMIENTO Y CONTROL</strong>&nbsp;</span></td>
</tr>
<tr>
<td class="encabezado"><span>CUMPLIMIENTO DEL OBJETIVO GENERAL DEL PLAN</span></td>
<td><span>{*cumplimiento_general*}</span></td>
</tr>
<tr>
<td class="encabezado"><span>CUMPLIMIENTO DE LOS OBJETIVOS ESPECIFICOS</span></td>
<td><span>{*cumplimiento_especificos*}{*codificacion_especifica*}</span></td>
</tr>
<tr>
<td class="encabezado" style="width: 30%;"><span>PORCENTAJE DE CUMPLIMIENTO DEL PLAN</span></td>
<td style="width: 70%;"><span>{*cumplimiento_plan*}</span></td>
</tr>
<tr>
<td class="encabezado"><span>CONCLUSIONES</span></td>
<td><span>{*conclusiones*}&nbsp;</span></td>
</tr>
</tbody>
</table>
</td>
<td style="width: 5%;">&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p>{*mostrar_plan_mejoramiento_completo*}</p>','','2,2,5,5','1','Legal','pdf','1','0','','0','0','0','1266','','10','m','300000','0','0','0','0','','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('control_riesgos','1. Valoracion Controles Riesgos','0','210','ft_control_riesgos','mostrar_control_riesgos.php','editar_control_riesgos.php','adicionar_control_riesgos.php','','','','42','<p>&nbsp;{*botones_valoracion_riesgos*}</p>
<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="width: 30%; text-align: left;">Fecha</td>
<td style="width: 70%;">{*fecha_valoracion*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Descripci&oacute;n</td>
<td>{*descripcion_control*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Tipo de control</td>
<td>{*tipo_control*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: center;" colspan="2">DESPLAZAMIENTO PARA EJERCER EL CONTROL</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">1. Posee una herramienta para ejercer el control?</td>
<td>{*herramienta_ejercer*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">2. Existen manuales, instructivos o procedimientos para el manejo de la herramienta?</td>
<td>{*procedimiento_herramienta*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">3. En el tiempo que lleva la herramienta, ha demostrado ser efectiva?</td>
<td>{*herramienta_efectiva*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">4. Estan definidos los responsables de la ejecuci&oacute;n del control y del seguimiento?</td>
<td>{*responsables_ejecucion*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">5. La frecuencia de la ejecuci&oacute;n del control y seguimiento es adecuado?</td>
<td>&nbsp;{*frecuencia_ejecucion*}</td>
</tr>
</tbody>
</table>','','15,20,50,20','0','Letter','pdf','1','0','','0','1','0','1267','','12','m','300000','0','0','0','0','','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('acciones_riesgo','2. Acciones','0','211','ft_acciones_riesgo','mostrar_acciones_riesgo.php','editar_acciones_riesgo.php','adicionar_acciones_riesgo.php','','','','43','<p>{*botones_acciones_riesgos*}</p>
<table style="border-collapse: collapse; width: 100%;" border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="encabezado">Fecha</td>
<td>{*fecha_acciones_riesgo*}</td>
</tr>
<tr>
<td class="encabezado">Control</td>
<td>{*mostrar_valor_control*}</td>
</tr>
<tr>
<td class="encabezado">Accion</td>
<td>{*acciones_accion*}</td>
</tr>
<tr>
<td class="encabezado">Reponsables</td>
<td>{*reponsables*}</td>
</tr>
<tr>
<td class="encabezado">Indicador</td>
<td>{*indicador*}</td>
</tr>
<tr>
<td class="encabezado"><span><span>Fecha de Suscripci&oacute;n de la Acci&oacute;n</span></span></td>
<td>&nbsp;{*fecha_subscripcion_accion*}</td>
</tr>
<tr>
<td class="encabezado"><span>Fecha de Cumplimiento</span></td>
<td>&nbsp;{*fecha_accion_cumplimiento*}</td>
</tr>
<tr>
<td class="encabezado"><span><span>Opciones Administraci&oacute;n del Riesgo</span></span></td>
<td>&nbsp;{*opcio_admin_riesgo*}</td>
</tr>
</tbody>
</table>
<p>{*mostrar_estado_proceso*}</p>','','15,20,40,20','0','Letter','pdf','1','0','','1','0','0','1268','','10','e','300000','0','0','0','0','','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('monitoreo_revision','3. Monitoreo y Revision','0','212','ft_monitoreo_revision','mostrar_monitoreo_revision.php','editar_monitoreo_revision.php','adicionar_monitoreo_revision.php','','','','34','<p>&nbsp;{*editar_documento_responsable_direccion_control_interno*}</p>
<table style="border-collapse: collapse;" border="1">
<tbody>
<tr>
<td class="encabezado">FECHA</td>
<td style="width: 350px;">&nbsp;{*fecha_monitoreo*}</td>
</tr>
<tr>
<td class="encabezado">RIESGO Nro</td>
<td>&nbsp;{*numero_riesgo*}</td>
</tr>
<tr>
<td class="encabezado">NOMBRE DEL RIESGO</td>
<td>&nbsp;{*nombre_riesgo*}</td>
</tr>
<tr>
<td class="encabezado">SE REALIZARON CAMBIOS EN LA <strong><em>IDENTIFICACION DEL RIESGO?</em></strong></td>
<td>&nbsp;{*cambio_identificacion*}</td>
</tr>
<tr>
<td class="encabezado">DESCRIPCI&Oacute;N DE LOS CAMBIOS</td>
<td>&nbsp;{*descripcion_cambio*}</td>
</tr>
<tr>
<td class="encabezado">SE REALIZARON CAMBIOS EN EL <strong><em>ANALISIS DEL RIESGO?</em></strong></td>
<td>&nbsp;{*cambios_analisis*}</td>
</tr>
<tr>
<td class="encabezado">DESCRIPCI&Oacute;N DE LOS CAMBIOS</td>
<td>&nbsp;{*descripcion_analisis*}</td>
</tr>
<tr>
<td class="encabezado">SE EVALUARON LOS CONTROLES EXISTENTES?</td>
<td>&nbsp;{*mostrar_controles_existentes_riesgo*}</td>
</tr>
<tr>
<td class="encabezado">RESULTADOS DE LA EVALUACI&Oacute;N</td>
<td>&nbsp;{*resultado_evaluacion*}</td>
</tr>
<tr>
<td class="encabezado">SE CUMPLIERON LAS ACCIONES PROPUESTAS?</td>
<td>&nbsp;{*mostrar_acciones_propuestas_riesgo*}</td>
</tr>
<tr>
<td class="encabezado">LOGROS ALCANZADOS Y/O OBSERVACIONES</td>
<td>&nbsp;{*logros_alcanzados*}</td>
</tr>
<tr>
<td class="encabezado">SE IMPLEMENTARON NUEVOS CONTROLES?</td>
<td>&nbsp;{*controles_nuevos*}</td>
</tr>
<tr>
<td class="encabezado">DESCRIPCI&Oacute;N DEL NUEVO(S) CONTROL(ES)</td>
<td>&nbsp;{*descripcion_ncontrol*}</td>
</tr>
<tr>
<td class="encabezado">EVIDENCIA(S) DOCUMENTAL</td>
<td>{*mostrar_anexos_memo*}</td>
</tr>
<tr>
<td class="encabezado">OBSERVACIONES GENERALES</td>
<td>{*observaciones_generales*}&nbsp;</td>
</tr>
</tbody>
</table>
<p>{*mostrar_estado_proceso*}</p>','','15,20,40,20','0','Letter','pdf','1','0','','1','0','0','1269','','12','m','300000','0','0','0','0','2','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('item_despacho_ingres','Item despacho ingresados','0','223','ft_item_despacho_ingres','mostrar_item_despacho_ingres.php','editar_item_despacho_ingres.php','adicionar_item_despacho_ingres.php','','','','','','','15,20,30,20','0','A4','pdf','1','0','','0','0','1','1290','','12','m','300000','0','','0','0','2','0','','1','1')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('flujos_padre','flujos padre','0','216','ft_flujos_padre','mostrar_flujos_padre.php','editar_flujos_padre.php','adicionar_flujos_padre.php','','','','','<p>{*arbol_fun*}</p>','','15,20,30,20','0','A4','pdf','1','1','','0','0','0','1276','','9','m','300000','0','','0','0','2,13','0','','1','0')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('flujos_hijo','flujos hijo','0','217','ft_flujos_hijo','mostrar_flujos_hijo.php','editar_flujos_hijo.php','adicionar_flujos_hijo.php','','','','','','','15,20,30,20','0','A4','pdf','1','0','','0','0','0','1277','','9','m','300000','0','','0','0','2,13','0','','1','0')||
INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('oficio_word','Oficio Word','0','215','ft_oficio_word','mostrar_oficio_word.php','editar_oficio_word.php','adicionar_oficio_word.php','','','','','<table style="width: 100%;" border="0" cellspacing="0">
<tbody>
<tr>
<td colspan="2">
<p><span style="font-family: arial, helvetica, sans-serif; font-size: medium;">{*mostrar_estado_proceso*}</span></p>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>{*mostrar_mensaje_error_pdf*}</p>','','15,20,30,20','0','A4','pdf','1','1','','0','0','0','1275','','9','m','300000','2','','0','0','2,13','0','1','1','1')||
