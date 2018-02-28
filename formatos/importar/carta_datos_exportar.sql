INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo,permite_imprimir,firma_crt,pos_firma_crt,logo_firma_crt,pos_logo_firma_crt) VALUES('carta','COMUNICACI&Oacute;N EXTERNA','0','2','ft_carta','mostrar_carta.php','editar_carta.php','adicionar_carta.php','','','','44','<table style="width: 100%; border-collapse: collapse;" border="0">
<tbody>
<tr>
<td colspan="2">{*ciudad*}, {*mostrar_fecha*}</td>
<td style="text-align: right;" rowspan="4">{*mostrar_qr_carta*}<br /><span style="font-size: 8pt;">{*formato_radicado_enviada*}</span></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="2">{*mostrar_destinos*}</td>
</tr>
<tr>
<td colspan="3"><br />
<p>ASUNTO: &nbsp; &nbsp; {*asunto*}</p>
</td>
</tr>
<tr>
<td colspan="3" width="100%">
<p>&nbsp;<br />Cordial saludo:</p>
<p>{*contenido*}</p>
</td>
</tr>
<tr>
<td colspan="3" width="100%">
<p><br />{*mostrar_listado_distribucion_documento*}</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;Atentamente,</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3">&nbsp;{*mostrar_estado_proceso*}</td>
</tr>
<tr>
<td colspan="3">{*mostrar_anexos_externa*}{*tamanio_texto_anexos_ext*}<br />{*mostrar_copias_comunicacion_ext*}Proyect&oacute;: {*iniciales*}</td>
</tr>
</tbody>
</table>','21','27,21,40,27','0','Letter','tcpdf','1','1','','0','0','0','5','','12','r','300000','1','0','0','0','2,5','0','1','1','1','1','../almacenamiento/firmas_crt/carta/21617.crt','180,88,15,15','','180,90,15,0')||
