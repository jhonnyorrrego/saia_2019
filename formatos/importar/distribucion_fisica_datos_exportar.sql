INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('distribucion_fisica','Distribuci&Atilde;&sup3;n F&Atilde;&shy;sica','0','92','ft_distribucion_fisica','mostrar_distribucion_fisica.php','editar_distribucion_fisica.php','adicionar_distribucion_fisica.php','','','','1','<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 30%;">Fecha</td>
<td>{*fecha_documento*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Mensajero</td>
<td>{*nombre_mensajero*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Estado</td>
<td>{*nivel_urgencia*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Destino</td>
<td>{*destino*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Observaciones</td>
<td>{*observaciones*}</td>
</tr>
</tbody>
</table>
<p>{*mostrar_estado_proceso*}</p>','','15,20,30,20','0','Letter','pdf','1','0','','1','0','0','990','','10','e','300000','0','','0','0','2,13','0','','1','1')||
