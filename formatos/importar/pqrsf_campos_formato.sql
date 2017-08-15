INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('serie_idserie','SERIE DOCUMENTAL','INT','11','1','','a','PQRSF','1032','fk','hidden','24','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('anexos','Documento Soporte Comentario','VARCHAR','255','0','','a,e,b','','','','archivo','16','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('comentarios','Comentarios','TEXT','','1','','a,e,b','','','','textarea','11','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('documento','Documento','VARCHAR','255','0','','a,e,b','','','','text','6','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('email','Email','VARCHAR','255','1','','a,e,b','','','','text','7','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('estado_reporte','estado','INT','11','0','1,Pendiente;2,Asignado;3,Entregado;4,Verificado','a,e,b','','1','','hidden','17','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('estado_verificacion','Verificacion','INT','11','0','1,En proceso;2,Satisfecho;3,Insatisfecho','a,e,b','','1','','hidden','18','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('funcionario_reporte','Funcionario Reporte','INT','11','0','','a,e,b','','','','hidden','20','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('nombre','Nombre Completos','VARCHAR','255','1','','a,e,p,d,b','','','','text','5','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('rol_institucion','Rol en la Institucion','INT','1','1','1,Cliente;2,Empleado Activo;3,Ex&shy;empleado;4,Proveedor;5,Usuario general','a,e,b','','','','select','9','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('telefono','Telefono o Celular','VARCHAR','255','0','','a,e,b','','','','text','8','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('tipo','Tipo Comentario','VARCHAR','255','1','1,Peticion;2,Queja;3,Reclamo;4,Sugerencias;5,Felicitaciones','a,e,b','','','','radio','10','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('idft_pqrsf','PQRSF','INT','11','1','','a,e','','','ai,pk','hidden','21','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('documento_iddocumento','DOCUMENTO ASOCIADO','INT','11','1','','a,e','','','i','hidden','22','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('dependencia','DEPENDENCIA DEL CREADOR DEL DOCUMENTO','INT','11','1','{*buscar_dependencia*}','a,e','','','i','hidden','2','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('encabezado','ENCABEZADO','INT','11','1','','a,e','','1','','hidden','1','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('firma','FIRMAS DIGITALES','INT','11','1','','a,e','','1','','hidden','23','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('numero_radicado','n&uacute;mero de radicado','VARCHAR','255','0','{*mostrar_radicado_pqrsf*}','a','','','','text','3','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('sector_iniciativa','Sector de la iniciativa','INT','11','0','SELECT a.idserie AS id, a.nombre AS nombre FROM serie a, serie b WHERE a.estado=1 AND a.cod_padre=b.idserie AND b.nombre like 'Sector de la iniciativa'','a,e,b','','','','hidden','13','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('cluster','Cluster','VARCHAR','255','0','Servicior;select a.idserie as id,a.nombre as nombre from serie a, serie b where a.estado=1 and a.cod_padre=b.idserie and b.nombre like 'Cluster' order by nombre| Cluster; select idserie as id,nombre from serie where cod_padre=','a,e,b','','','','hidden','14','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('iniciativa_publica','Iniciativa p&uacute;blica','VARCHAR','255','0','Iniciativa;select a.idserie as id,a.nombre as nombre from serie a, serie b where a.estado=1 and a.cod_padre=b.idserie and b.nombre like 'Iniciativas publicas' order by nombre| Proyecto; select idserie as id,nombre from serie where cod_padre=','a,e,b','','','','hidden','12','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('region','region','VARCHAR','255','0','Region;select a.idserie as id,a.nombre as nombre from serie a, serie b where a.estado=1 and a.cod_padre=b.idserie and b.nombre like 'Region' order by nombre| Zona; select idserie as id,nombre from serie where cod_padre=','a,e,b','','','','hidden','15','','','0','1','|-formato_idformato-|')||
INSERT INTO campos_formato(nombre,etiqueta,tipo_dato,longitud,obligatoriedad,valor,acciones,ayuda,predeterminado,banderas,etiqueta_html,orden,mascara,adicionales,autoguardado,fila_visible,formato_idformato) VALUES('estado_documento','ESTADO DEL DOCUMENTO','INT','11','1','','a,e','','1','','hidden','0','','','0','1','|-formato_idformato-|')||
