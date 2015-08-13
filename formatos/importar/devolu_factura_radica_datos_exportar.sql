INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada) VALUES('devolu_factura_radica','Devoluci&oacute;n Factura','0','123','ft_devolu_factura_radica','mostrar_devolu_factura_radica.php','editar_devolu_factura_radica.php','adicionar_devolu_factura_radica.php','','','','1','<table style="border-collapse: collapse; ; width: 100%;" border="0">
<tbody>
<tr>
<td>Se&ntilde;or(es):<br /><strong>{*mostrar_informacion_proveedor*}</strong><br /><br /><br /></td>
</tr>
<tr>
<td>A continuaci&oacute;n se colocan las observaciones de la devoluci&oacute;n de la factura<br /><strong>{*observaciones*}</strong><br /><br /></td>
</tr>
<tr>
<td>
<p>La forma de envio ser&aacute; la siguiente:<br /><strong>{*forma_envio*}</strong></p>
</td>
</tr>
<tr>
<td>&nbsp;<br /><strong>{*muestra_anexos_devolucion*}</strong></td>
</tr>
<tr>
<td><br />Atentamente,<br />{*mostrar_estado_proceso*}</td>
</tr>
</tbody>
</table>
<p><br /><br /></p>','','15,20,30,20','0','Letter','pdf','1','0','','1','0','0','1031','','12','m','300000','0','','0','0','2','0','')||
