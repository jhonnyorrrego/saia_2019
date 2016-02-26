INSERT INTO formato(nombre,etiqueta,cod_padre,contador_idcontador,nombre_tabla,ruta_mostrar,ruta_editar,ruta_adicionar,librerias,estilos,javascript,encabezado,cuerpo,pie_pagina,margenes,orientacion,papel,exportar,funcionario_idfuncionario,mostrar,imagen,detalle,tipo_edicion,item,serie_idserie,ayuda,font_size,banderas,tiempo_autoguardado,mostrar_pdf,orden,enter2tab,firma_digital,fk_categoria_formato,flujo_idflujo,funcion_predeterminada,paginar,pertenece_nucleo) VALUES('salida_planta','AUTORIZACION SALIDA DE PLANTA','0','155','ft_salida_planta','mostrar_salida_planta.php','editar_salida_planta.php','adicionar_salida_planta.php','','','','25','<table style="border-collapse: collapse; font-size: 10pt; width: 100%;" border="1" align="center">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: center;" colspan="4">DATOS SOLICITANTE</td>
</tr>
<tr>
<td style="text-align: left;" colspan="2"><strong>NOMBRE Y APELLIDO:</strong>{*mostrar_nombre_apellido_funcionario*}<br />&nbsp;</td>
<td style="text-align: left;"><strong>C&Oacute;DIGO N&Oacute;MINA:</strong>{*mostrar_codigo_nomina_funcionario*}<br />&nbsp;</td>
<td style="text-align: center;" rowspan="2"><strong>TURNO<br /></strong>{*turno_datos*}</td>
</tr>
<tr>
<td style="text-align: left;" colspan="3"><strong>&Aacute;REA / DEPARTAMENTO:</strong>{*mostrar_cargo_dependencia_funcionario*}<br />&nbsp;</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: center;" colspan="4">DATOS ENTRADA / SALIDA</td>
</tr>
<tr>
<td style="text-align: left; width: 150px;"><strong>FECHA:</strong>&nbsp;<br />{*fecha_salida*}</td>
<td style="text-align: left;"><strong>HORA DE SALIDA</strong>:{*hora_salida*}</td>
<td style="text-align: center;" rowspan="2"><strong>TOTAL HORAS:<br /></strong>{*total_horas*}<br /><br /><strong>FECHA Y HORA DE ENTRADA REPORTADA:</strong>{*hora_entrada_reportada*}&nbsp;&nbsp;</td>
<td style="text-align: left;" rowspan="2"><strong>MOTIVO:</strong> {*motivo_salida*}<br /><br /></td>
</tr>
<tr>
<td style="text-align: left;"><strong>FECHA:</strong>&nbsp;<br />{*fecha_entrada*}</td>
<td style="text-align: left;"><strong>HORA DE ENTRADA PLANEADA:</strong>{*hora_entrada*}</td>
</tr>
<tr>
<td style="text-align: left;" colspan="3"><strong>OBSERVACIONES:</strong>&nbsp;{*observaciones*}</td>
<td style="text-align: left;" rowspan="3">
<p><strong>Control Interno:</strong></p>
<p>{*ver_boton_cierre*}</p>
<p>&nbsp;</p>
<p><strong><br /></strong></p>
</td>
</tr>
</tbody>
</table>
<p>C&Oacute;DIGOS: D04: LICENCIA NO REMUNERADA, P30: PERMISO SINDICAL, P31: PERMISO EPS REMUNERADO, P32: POR MATRIMONIO, P33: POR NACIMIENTO, P34: CALAMIDAD DOM&Eacute;STICA, P35: DILIGENCIA EMPRESA.</p>
<p>{*mostrar_estado_proceso*}</p>','','15,20,30,20','0','A4','pdf','1','1','','0','0','0','1183','','9','m','300000','0','','0','0','2,6','0','','1','0')||
