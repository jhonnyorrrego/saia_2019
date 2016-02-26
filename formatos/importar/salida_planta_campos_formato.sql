INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('serie_idserie','SERIE DOCUMENTAL','INT','11','1','','a','ni&Atilde;&plusmn;o acci&Atilde;&sup3;n','1183','fk','hidden','3','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('control_interno','control_interno','VARCHAR','255','0','','a,e,b','','','','hidden','1','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('turno_datos','Turno','VARCHAR','255','0','1,1;2,2;3,3;4,4','a,e,b','','','','select','9','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('hora_salida','Hora Salida','TIME','','1','','a,e,b','','','','fecha','11','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('hora_entrada','Hora Entrada','TIME','','1','','a,e,b','','','','fecha','13','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('motivo_salida','Motivo','VARCHAR','255','1','select idserie as id, nombre from serie where cod_padre=1119 order by idserie','a,e,p,d,b','','','','radio','14','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('motivo_permiso','Motivo Permiso','VARCHAR','255','0','','a,e,b','','','','text','15','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('observaciones','Observaciones','TEXT','','0','','a,e,b','','','','textarea','16','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('idft_salida_planta','SALIDA_PLANTA','INT','11','1','','a,e','','','ai,pk','hidden','4','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('documento_iddocumento','DOCUMENTO ASOCIADO','INT','11','1','','a,e','','','i','hidden','5','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('dependencia','DEPENDENCIA DEL CREADOR DEL DOCUMENTO','INT','11','1','{*buscar_dependencia*}','a,e','','','i','hidden','6','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('encabezado','ENCABEZADO','INT','11','1','','a,e','','1','','hidden','7','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('firma','FIRMAS DIGITALES','INT','11','1','','a,e','','1','','hidden','8','','','0','1','|-formato_idformato-|')||
