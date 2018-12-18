INSERT INTO formato (nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,fecha,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo,permite_imprimir) VALUES 
('correo_saia','Correo SAIA',0,1,'ft_correo_saia','mostrar_correo_saia.php','editar_correo_saia.php','adicionar_correo_saia.php',NULL,NULL,NULL,'1','<table style="width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 30%;">Asunto</td>
<td style="text-align: left;">&nbsp;{*asunto*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Fecha Oficio Entrada</td>
<td style="text-align: left;">&nbsp;{*mostrar_fecha_oficio_entrada*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">De</td>
<td style="text-align: left;">&nbsp;{*de*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Para</td>
<td style="text-align: left;">&nbsp;{*mostrar_para*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Transferido</td>
<td style="text-align: left;">&nbsp;{*mostrar_transferencia_correo*}</td>
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
<p>{*ingresar_datos_factura*}</p>
<p>{*mostrar_estado_proceso*}</p>
<p>{*ver_anexos_documento*}</p>','','15,20,30,20','0','A4','tcpdf',1,'2017-07-25 17:49:43.310','0',NULL,'0',0,'0',11,NULL,'9','e','300000',0,NULL,0,0,'2',0,'','1',1,1)
;