INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada) VALUES('radicacion_entrada','Entrada','0','1','ft_radicacion_entrada','mostrar_radicacion_entrada.php','editar_radicacion_entrada.php','adicionar_radicacion_entrada.php','','','','1','<p>{*llenar_datos_funcion*}</p>
<table style="width: 100%; border-collapse: collapse; font-size: 10pt;" border="1">
<tbody>
<tr>
<td style="width: 20%;"><strong>Fecha de radicaci&oacute;n:</strong></td>
<td>{*mostrar_fecha*}</td>
<td style="width: 20%;"><strong>N&uacute;mero de radicado:</strong></td>
<td>{*formato_numero*}&nbsp;</td>
</tr>
<tr>
<td><strong>Tipo de documento:</strong></td>
<td>{*serie_idserie*}</td>
<td><strong>Fecha de oficio entrante:</strong></td>
<td>{*fecha_oficio_entrada*}</td>
</tr>
<tr>
<td><strong>N&uacute;mero de oficio entrante:</strong></td>
<td colspan="3">{*numero_oficio*}&nbsp;&nbsp;</td>
</tr>
<tr>
<td><strong>Persona natural o jur&iacute;dica:</strong></td>
<td colspan="3">{*obtener_informacion_proveedor*}</td>
</tr>
<tr>
<td><strong>Descripci&oacute;n o asunto:</strong></td>
<td>{*descripcion*}</td>
<td><strong>Tiempo de respuesta (dias):</strong></td>
<td>{*tiempo_respuesta*}</td>
</tr>
<tr>
<td><strong>Anexos f&iacute;sicos:</strong></td>
<td>{*anexos_fisicos*}</td>
<td><strong>Descripci&oacute;n de anexos f&iacute;sicos:</strong></td>
<td>{*descripcion_anexos*}</td>
</tr>
<tr>
<td><strong>Anexos digitales:</strong></td>
<td colspan="3">{*anexos_digitales*}&nbsp;&nbsp;</td>
</tr>
<tr>
<td><strong>Destino:</strong></td>
<td>{*destino*}</td>
<td><strong>Copia a:</strong></td>
<td>{*copia_a*}</td>
</tr>
</tbody>
</table>
<p>{*imagenes_digitalizadas_funcion*}</p>','','15,20,30,20','0','Letter','','533','0','','0','0','0','2','','9','e','300000','0','0','0','0','1','1','')||
