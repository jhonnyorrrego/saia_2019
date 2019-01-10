INSERT INTO campos_formato (formato_idformato,nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible) VALUES 
(421,'estado_documento','ESTADO DEL DOCUMENTO','VARCHAR','255',0,NULL,'a','','','','hidden',25,NULL,NULL,0,1)
,(421,'serie_idserie','TIPO DOCUMENTAL','INT','11',0,NULL,'a','Facturas de Obras','2621',NULL,'hidden',17,NULL,NULL,0,1)
,(421,'idft_facturas_obras','FACTURAS_OBRAS','INT','11',1,NULL,'a,e',NULL,NULL,'ai,pk','hidden',23,NULL,NULL,0,1)
,(421,'documento_iddocumento','DOCUMENTO ASOCIADO','INT','11',1,NULL,'a,e',NULL,NULL,'i','hidden',22,NULL,NULL,0,1)
,(421,'dependencia','VENTANILLA DEL CREADOR DEL DOCUMENTO','INT','11',1,'{*buscar_dependencia*}','a,e',NULL,NULL,'i,fdc','hidden',1,NULL,NULL,0,1)
,(421,'encabezado','ENCABEZADO','INT','11',1,NULL,'a,e',NULL,'1',NULL,'hidden',21,NULL,NULL,0,1)
,(421,'firma','FIRMAS DIGITALES','INT','11',1,NULL,'a,e',NULL,'1','','hidden',24,NULL,NULL,0,1)
,(421,'fecha_radicacion','FECHA DE RADICACI&Oacute;N','DATETIME',NULL,1,'{*fecha_formato*}','a,e,b',NULL,NULL,NULL,'fecha',2,NULL,NULL,0,1)
,(421,'fecha_factura','FECHA DE LA FACTURA','DATE',NULL,0,NULL,'a,e,b',NULL,NULL,NULL,'fecha',4,NULL,NULL,0,1)
,(421,'numero_factura','N&Uacute;MERO DE FACTURA','VARCHAR','255',0,NULL,'a,e,p,d,b',NULL,NULL,NULL,'text',5,NULL,NULL,0,1)
;
INSERT INTO campos_formato (formato_idformato,nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible) VALUES 
(421,'concepto_factura','CONCEPTO DE LA FACTURA','TEXT',NULL,1,'sin_tiny','a,e,b',NULL,NULL,NULL,'textarea',6,NULL,NULL,0,1)
,(421,'valor_factura','VALOR DE LA FACTURA','VARCHAR','30',1,NULL,'a,e,b',NULL,NULL,NULL,'text',7,NULL,NULL,0,1)
,(421,'vence_factura','VENCIMIENTO DE LA FACTURA','DATE',NULL,1,'{*fecha_formato*}','a,e,b',NULL,NULL,NULL,'fecha',8,NULL,NULL,0,1)
,(421,'numero_guia','N&Uacute;MERO DE GU&Iacute;A','VARCHAR','50',0,NULL,'a,e,b',NULL,NULL,NULL,'text',10,NULL,NULL,0,1)
,(421,'empresa_trans','EMPRESA TRANSPORTADORA','INT','11',0,'select idcf_empresa_trans as id, nombre from cf_empresa_trans where estado=1','a,e,b',NULL,NULL,NULL,'select',11,NULL,NULL,0,1)
,(421,'numero_folios','N&Uacute;MERO DE FOLIOS','VARCHAR','50',0,NULL,'a,e,b',NULL,NULL,NULL,'text',12,NULL,NULL,0,1)
,(421,'anexos_fisicos','ANEXOS F&Iacute;SICOS','TEXT',NULL,0,'sin_tiny','a,e,b',NULL,NULL,NULL,'textarea',13,NULL,NULL,0,1)
,(421,'anexos_digitales','ANEXOS DIGITALES','VARCHAR','255',0,NULL,'a,e,b',NULL,NULL,NULL,'archivo',14,NULL,NULL,0,1)
,(421,'persona_natural','PERSONA NATURAL/JURIDICA','INT','11',1,'unico@nombre,identificacion@cargo,empresa,direccion,telefono,email,titulo,ciudad','a,e,b',NULL,NULL,NULL,'ejecutor',15,NULL,NULL,0,1)
,(421,'destino','DESTINO','INT','11',1,'1;pantallas/funcionario/carga_campo_autocompletar.php','a,e,b',NULL,NULL,NULL,'autocompletar',16,NULL,NULL,0,1)
;
INSERT INTO campos_formato (formato_idformato,nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible) VALUES 
(421,'copia','COPIA ELECTR&Oacute;NICA A','VARCHAR','255',0,'../../test_funcionario.php?rol=1&sin_padre=1;1;0;0;1;0;5','a,e,b',NULL,NULL,NULL,'arbol',18,NULL,NULL,0,1)
,(421,'fecha_pago','FECHA DE PAGO','DATE',NULL,0,NULL,'b',NULL,NULL,NULL,'fecha',9,NULL,NULL,0,1)
,(421,'func_fecha_pago','Funcionario','INT','11',0,NULL,'b',NULL,NULL,'fid','text',19,NULL,NULL,0,1)
,(421,'fecha_accion_pago','FECHA ACCION PAGO','DATE',NULL,0,NULL,'b',NULL,NULL,NULL,'fecha',20,NULL,NULL,0,1)
,(421,'numero_radicado','N&Uacute;MERO DE RADICADO','INT','11',0,'{*mostrar_radicado_obra*}','a,e,b',NULL,NULL,NULL,'hidden',3,NULL,NULL,0,1)
;