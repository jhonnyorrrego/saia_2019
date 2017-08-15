INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('radicacion_salida','Salida','0','2','ft_radicacion_salida','mostrar_radicacion_salida.php','editar_radicacion_salida.php','adicionar_radicacion_salida.php','','','','1','<p>{*llenar_datos_funcion_salida*}</p>
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
<td colspan="3">{*serie_idserie*}<strong></strong></td>
</tr>
<tr>
<td><strong>Persona natural o jur&iacute;dica:</strong></td>
<td colspan="3">{*obtener_informacion_proveedor_salida*}</td>
</tr>
<tr>
<td><strong>Descripci&oacute;n o asunto:</strong></td>
<td colspan="3">{*descripcion_salida*}<strong></strong></td>
</tr>
<tr>
<td><strong>Anexos f&iacute;sicos:</strong></td>
<td>{*anexos_fisicos*}</td>
<td><strong>Descripci&oacute;n de anexos f&iacute;sicos:</strong></td>
<td>{*descripcion_anexos*}</td>
</tr>
<tr>
<td><strong>No. Folios:</strong></td>
<td colspan="3">{*num_folios*}&nbsp;&nbsp;</td>
</tr>
<tr>
<td><strong>Funcionario responsable:</strong></td>
<td colspan="3">{*area_responsable*}<strong></strong></td>
</tr>
</tbody>
</table>','','15,20,30,20','0','Letter','pdf','9','0','','0','0','0','3','','9','e','300000','0','0','0','0','13,3','0','','1','1')||
