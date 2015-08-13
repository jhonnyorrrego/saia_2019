DELIMITER $$

$$

DELIMITER ;

CREATE TABLE IF NOT EXISTS accion (
  idaccion int(11) NOT NULL auto_increment,
  nombre varchar(255) collate utf8_unicode_ci NOT NULL,
  ruta varchar(255) collate utf8_unicode_ci NOT NULL,
  funcion varchar(255) collate utf8_unicode_ci NOT NULL,
  parametros varchar(255) collate utf8_unicode_ci default NULL,
  descripcion text collate utf8_unicode_ci NOT NULL,
  boton varchar(255) collate utf8_unicode_ci default NULL,
  modulo_idmodulo int(11) NOT NULL,
  PRIMARY KEY  (idaccion)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS almacenamiento (
  idalmacenamiento int(11) NOT NULL auto_increment,
  documento_iddocumento int(11) NOT NULL default '0',
  folder_idfolder int(11) NOT NULL default '0',
  soporte varchar(255) collate utf8_unicode_ci default NULL,
  num_folios int(11) default NULL,
  anexos varchar(255) collate utf8_unicode_ci default NULL,
  deterioro varchar(255) collate utf8_unicode_ci default NULL,
  responsable int(11) NOT NULL default '0',
  registro_entrada datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (idalmacenamiento)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS anexos (
  idanexos int(11) NOT NULL auto_increment,
  documento_iddocumento int(11) NOT NULL default '0',
  ruta varchar(100) collate utf8_unicode_ci NOT NULL default '',
  etiqueta varchar(255) collate utf8_unicode_ci default NULL,
  tipo varchar(255) collate utf8_unicode_ci default 'BASE',
  formato tinyint(4) default NULL,
  campos_formato int(4) default NULL,
  idbinario int(11) default NULL,
  PRIMARY KEY  (idanexos),
  KEY documento_iddocumento (documento_iddocumento)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

DROP TRIGGER IF EXISTS adicionar_accion_anexo;
DELIMITER //
CREATE TRIGGER adicionar_accion_anexo AFTER INSERT ON anexos
 FOR EACH ROW BEGIN
DECLARE accion INT;
SET accion=(SELECT idaccion FROM accion WHERE nombre ='adicionar_anexo');
IF(accion) THEN
INSERT INTO documento_accion(documento_iddocumento,accion_idaccion,fecha) VALUES(new.documento_iddocumento,accion ,date_format(now(),'%Y-%m-%d %H:%i:%s'));
END IF;
END
//
DELIMITER ;

CREATE TABLE IF NOT EXISTS asignacion (
  idasignacion int(11) NOT NULL auto_increment,
  tarea_idtarea int(11) NOT NULL,
  fecha_inicial datetime NOT NULL,
  fecha_final datetime NOT NULL default '0000-00-00 00:00:00',
  documento_iddocumento int(11) NOT NULL,
  serie_idserie int(11) NOT NULL,
  estado enum('PENDIENTE','EJECUTADA','VENCIDA') collate utf8_unicode_ci NOT NULL default 'PENDIENTE',
  entidad_identidad int(11) NOT NULL,
  llave_entidad int(11) NOT NULL,
  reprograma tinyint(4) default NULL,
  tipo_reprograma varchar(10) collate utf8_unicode_ci default NULL,
  descripcion varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (idasignacion)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS asignacion_entidad (
  idasignacion_entidad int(11) NOT NULL auto_increment,
  entidad_identidad int(11) NOT NULL default '0',
  llave_entidad int(11) NOT NULL default '0',
  asignacion_idasignacion int(11) NOT NULL,
  PRIMARY KEY  (idasignacion_entidad),
  KEY documento_iddocumento (asignacion_idasignacion)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS asignacion_terminar (
  idasignacion_terminar int(11) NOT NULL auto_increment,
  asignacion_idasignacion int(11) NOT NULL,
  justificacion varchar(512) collate utf8_unicode_ci NOT NULL,
  fecha_terminacion datetime NOT NULL,
  funcionario_codigo int(11) NOT NULL,
  tarea_idtarea int(11) NOT NULL,
  fecha_inicial datetime NOT NULL,
  fecha_final datetime NOT NULL default '0000-00-00 00:00:00',
  documento_iddocumento int(11) NOT NULL,
  serie_idserie int(11) NOT NULL,
  estado enum('PENDIENTE','EJECUTADA','VENCIDA') collate utf8_unicode_ci NOT NULL default 'PENDIENTE',
  entidad_identidad int(11) NOT NULL,
  llave_entidad int(11) NOT NULL,
  reprograma tinyint(4) default NULL,
  tipo_reprograma varchar(10) collate utf8_unicode_ci default NULL,
  descripcion varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (idasignacion_terminar)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS autoguardado (
  idautoguardado int(11) NOT NULL auto_increment,
  contenido text character set utf8 collate utf8_unicode_ci,
  formato varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  usuario int(11) NOT NULL,
  campo varchar(255) character set utf8 collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (idautoguardado)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS binario (
  idbinario int(11) NOT NULL auto_increment,
  nombre_original varchar(255) collate utf8_unicode_ci default NULL,
  datos mediumblob,
  fecha_creacion timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (idbinario)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS busqueda (
  idbusqueda int(11) NOT NULL auto_increment,
  nombre varchar(255) default NULL,
  etiqueta varchar(255) default NULL,
  estado int(11) default '1',
  ancho int(11) default '200',
  campos text,
  llave varchar(255) default NULL,
  tablas varchar(255) default NULL,
  ruta_libreria varchar(255) default NULL,
  ruta_libreria_pantalla varchar(255) default NULL,
  cantidad_registros int(11) default '30',
  tiempo_refrescar int(11) default '500',
  ruta_visualizacion varchar(255) default 'pantallas/busqueda/componentes_busqueda.php',
  tipo_busqueda int(11) default '1',
  PRIMARY KEY  (idbusqueda)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS busqueda_componente (
  idbusqueda_componente int(11) NOT NULL auto_increment,
  busqueda_idbusqueda int(11) default NULL,
  tipo int(11) default NULL,
  conector int(11) default NULL,
  url varchar(255) default NULL,
  etiqueta varchar(255) default NULL,
  nombre varchar(255) default NULL,
  orden int(11) default NULL,
  info text,
  encabezado_componente varchar(255) default NULL,
  estado int(11) default '1',
  ancho int(11) default '320',
  cargar int(10) default '1',
  campos_adicionales varchar(255) default NULL,
  tablas_adicionales varchar(255) default NULL,
  ordenado_por varchar(255) default NULL,
  direccion varchar(5) default NULL,
  agrupado_por varchar(255) default NULL,
  busqueda_avanzada varchar(255) default NULL,
  acciones_seleccionados varchar(255) default NULL,
  modulo_idmodulo int(10) default NULL,
  PRIMARY KEY  (idbusqueda_componente)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS busqueda_condicion (
  idbusqueda_condicion int(11) NOT NULL auto_increment,
  busqueda_idbusqueda int(11) default NULL,
  fk_busqueda_componente int(11) default NULL,
  codigo_where text,
  etiqueta_condicion varchar(255) default NULL,
  PRIMARY KEY  (idbusqueda_condicion)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS busqueda_condicion_enlace (
  idbusqueda_condicion_enlace int(11) NOT NULL auto_increment,
  fk_busqueda_condicion int(11) default NULL,
  cod_padre int(11) default NULL,
  comparacion varchar(10) default NULL,
  orden int(11) default NULL,
  estado int(10) default '1',
  PRIMARY KEY  (idbusqueda_condicion_enlace)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS busqueda_filtro (
  idbusqueda_filtro int(11) NOT NULL auto_increment,
  fk_busqueda_componente int(11) NOT NULL,
  funcionario_idfuncionario int(11) NOT NULL,
  tabla_adicional varchar(255) NOT NULL,
  where_adicional varchar(255) NOT NULL,
  PRIMARY KEY  (idbusqueda_filtro)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS busqueda_filtro_temp (
  idbusqueda_filtro_temp int(11) NOT NULL auto_increment,
  fk_busqueda_componente int(11) default NULL,
  funcionario_idfuncionario int(11) default NULL,
  fecha date default NULL,
  detalle text,
  PRIMARY KEY  (idbusqueda_filtro_temp)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS buzon_entrada (
  idtransferencia int(11) unsigned NOT NULL auto_increment,
  archivo_idarchivo int(11) NOT NULL default '0',
  nombre enum('LEIDO','RESPONDIDO','TERMINADO','VERIFICACION','DELEGADO','BORRADOR','COPIA','HISTORICO','GESTION','CENTRAL','BLOQUEADO','RECHAZADO','POR_APROBAR','RECEPCION','PRODUCCION','DISTRIBUCION','CONSULTA','RETENCION','ALMACENAMIENTO','RECUPERACION','PRESERVACION','DISPOSICION FINAL','REVISADO','APROBADO','DEVOLUCION','TRAMITE','TRANSFERIDO','ELIMINA_LEIDO','ELIMINA_COPIA','ELIMINA_BLOQUEADO','ELIMINA_RECHAZADO','ELIMINA_POR_APROBAR','ELIMINA_REVISADO','ELIMINA_APROBADO','ELIMINA_DEVOLUCION','ELIMINA_TRANSFERIDO','ELIMINA_BORRADOR','ELIMINA_VERIFICACION','ELIMINA_TERMINADO','ELIMINADO') collate utf8_unicode_ci NOT NULL default 'RECEPCION',
  destino varchar(20) collate utf8_unicode_ci default NULL,
  tipo_destino int(11) default NULL,
  fecha datetime NOT NULL default '0000-00-00 00:00:00',
  respuesta date default NULL,
  origen varchar(255) collate utf8_unicode_ci NOT NULL default '',
  tipo_origen int(11) default NULL,
  notas text collate utf8_unicode_ci,
  transferencia_descripcion text collate utf8_unicode_ci,
  tipo enum('ARCHIVO','DOCUMENTO') collate utf8_unicode_ci NOT NULL default 'ARCHIVO',
  activo tinyint(4) NOT NULL default '0',
  ruta_idruta int(11) NOT NULL default '0',
  ver_notas varchar(1) collate utf8_unicode_ci default '0',
  PRIMARY KEY  (idtransferencia),
  KEY destino (destino),
  KEY archivo_idarchivo (archivo_idarchivo),
  KEY origen (origen)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS buzon_salida (
  idtransferencia int(11) unsigned NOT NULL auto_increment,
  archivo_idarchivo int(11) NOT NULL default '0',
  nombre enum('LEIDO','BLOQUEADO','RESPONDIDO','TERMINADO','VERIFICACION','DELEGADO','BORRADOR','COPIA','HISTORICO','GESTION','CENTRAL','TRANSFERIDO','TRAMITE','RECHAZADO','PENDIENTE','RECEPCION','PRODUCCION','DISTRIBUCION','CONSULTA','RETENCION','ALMACENAMIENTO','RECUPERACION','PRESERVACION','DISPOSICION FINAL','REVISADO','APROBADO','DEVOLUCION','ELIMINA_LEIDO','ELIMINA_COPIA','ELIMINA_BLOQUEADO','ELIMINA_RECHAZADO','ELIMINA_POR_APROBAR','ELIMINA_REVISADO','ELIMINA_APROBADO','ELIMINA_DEVOLUCION','ELIMINA_TRANSFERIDO','ELIMINA_BORRADOR','ELIMINA_VERIFICACION','ELIMINA_TERMINADO','ELIMINADO') collate utf8_unicode_ci NOT NULL default 'RECEPCION',
  destino varchar(20) collate utf8_unicode_ci default NULL,
  tipo_destino int(11) default NULL,
  fecha datetime NOT NULL default '0000-00-00 00:00:00',
  respuesta date default NULL,
  origen varchar(255) collate utf8_unicode_ci NOT NULL default '',
  tipo_origen int(11) default NULL,
  notas text collate utf8_unicode_ci,
  transferencia_descripcion text collate utf8_unicode_ci,
  tipo enum('ARCHIVO','DOCUMENTO') collate utf8_unicode_ci NOT NULL default 'ARCHIVO',
  ruta_idruta int(11) NOT NULL default '0',
  ver_notas varchar(1) collate utf8_unicode_ci default '0',
  PRIMARY KEY  (idtransferencia),
  KEY destino (destino),
  KEY archivo_idarchivo (archivo_idarchivo),
  KEY origen (origen)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS caja (
  idcaja int(11) NOT NULL auto_increment,
  numero int(11) NOT NULL default '0',
  ubicacion varchar(255) collate utf8_unicode_ci NOT NULL default '',
  estanteria varchar(255) collate utf8_unicode_ci NOT NULL default '',
  nivel int(11) NOT NULL default '0',
  panel int(11) NOT NULL default '0',
  material varchar(255) collate utf8_unicode_ci NOT NULL default '',
  seguridad varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (idcaja)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS campos_formato (
  idcampos_formato int(11) NOT NULL auto_increment,
  formato_idformato int(11) NOT NULL default '0',
  nombre varchar(255) collate utf8_unicode_ci NOT NULL default '',
  etiqueta varchar(255) collate utf8_unicode_ci NOT NULL default '',
  tipo_dato varchar(255) collate utf8_unicode_ci NOT NULL default '',
  longitud varchar(255) collate utf8_unicode_ci default NULL,
  obligatoriedad tinyint(1) NOT NULL default '0',
  valor text collate utf8_unicode_ci,
  acciones varchar(10) collate utf8_unicode_ci default 'a,e,b',
  ayuda text collate utf8_unicode_ci,
  predeterminado varchar(255) collate utf8_unicode_ci default NULL,
  banderas varchar(50) collate utf8_unicode_ci default NULL,
  etiqueta_html varchar(255) collate utf8_unicode_ci NOT NULL default 'text',
  orden tinyint(3) NOT NULL default '0',
  mascara varchar(255) collate utf8_unicode_ci default NULL,
  adicionales varchar(255) collate utf8_unicode_ci default NULL,
  autoguardado int(11) NOT NULL default '0',
  fila_visible int(11) default '1',
  PRIMARY KEY  (idcampos_formato),
  KEY formato_idformato (formato_idformato)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS caracteristica (
  idcaracteristica int(10) unsigned NOT NULL auto_increment,
  pantalla_idpantalla int(10) unsigned NOT NULL default '0',
  componente_pantalla_idpantalla int(10) unsigned NOT NULL default '0',
  componente_idcomponente int(10) unsigned NOT NULL default '0',
  nombre varchar(100) collate utf8_unicode_ci default NULL,
  valor varchar(255) collate utf8_unicode_ci default NULL,
  categoria varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (idcaracteristica,pantalla_idpantalla,componente_pantalla_idpantalla,componente_idcomponente),
  KEY caracteristica_FKIndex2 (componente_idcomponente,componente_pantalla_idpantalla)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS caracteristicas_campos (
  idcaracteristicas_campos int(11) NOT NULL auto_increment,
  tipo_caracteristica varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL default 'validacion',
  valor varchar(255) character set utf8 collate utf8_unicode_ci default NULL,
  idcampos_formato int(11) NOT NULL,
  PRIMARY KEY  (idcaracteristicas_campos)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS caracteristica_p (
  idcaracteristica int(11) NOT NULL auto_increment,
  pantalla_idpantalla int(11) NOT NULL default '0',
  nombre varchar(30) collate utf8_unicode_ci NOT NULL default '',
  valor varchar(200) collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (idcaracteristica,pantalla_idpantalla)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS cargo (
  idcargo int(11) NOT NULL auto_increment,
  nombre varchar(255) collate utf8_unicode_ci NOT NULL default '',
  cod_padre int(11) default NULL,
  estado tinyint(2) NOT NULL default '1',
  codigo_cargo int(11) default NULL,
  tipo tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (idcargo)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS carrusel (
  idcarrusel int(11) NOT NULL auto_increment,
  nombre varchar(255) NOT NULL,
  autoplay varchar(255) NOT NULL default 'true',
  delay varchar(255) NOT NULL default '3000',
  startstopped varchar(255) NOT NULL default 'false',
  animationtime varchar(255) NOT NULL default '600',
  buildnavigation varchar(255) NOT NULL default 'true',
  pauseonhover varchar(255) NOT NULL default 'true',
  starttext varchar(255) NOT NULL default 'Iniciar',
  stoptext varchar(255) NOT NULL default 'Detener',
  easing varchar(255) NOT NULL default 'easeInOutExpo',
  fecha_inicio date NOT NULL,
  fecha_fin date NOT NULL,
  ancho int(11) NOT NULL,
  alto int(11) NOT NULL,
  css varchar(2000) NOT NULL,
  PRIMARY KEY  (idcarrusel)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS categoria_formato (
  idcategoria_formato int(11) NOT NULL auto_increment,
  nombre varchar(255) NOT NULL,
  cod_padre int(11) default NULL,
  estado int(11) NOT NULL COMMENT '1,Activo;2,Inactivo',
  PRIMARY KEY  (idcategoria_formato)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS comentario_img (
  idcomentario_img int(10) NOT NULL AUTO_INCREMENT,
  documento_iddocumento int(10) NOT NULL DEFAULT '0',
  tipo enum('CARTA','PLANTILLA','FACTURA','PAGINA') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'PAGINA',
  pagina int(10) NOT NULL DEFAULT '0',
  comentario text COLLATE utf8_unicode_ci NOT NULL,
  posx int(4) NOT NULL DEFAULT '0',
  posy int(4) NOT NULL DEFAULT '0',
  funcionario varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  fecha datetime NOT NULL,
  PRIMARY KEY (idcomentario_img)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

DROP TRIGGER IF EXISTS adicionar_accion_pot_it;
DELIMITER //
CREATE TRIGGER adicionar_accion_pot_it AFTER INSERT ON comentario_img
 FOR EACH ROW BEGIN
DECLARE accion INT;
SET accion=(SELECT idaccion FROM accion WHERE nombre ='adicionar_nota');
IF(accion) THEN
INSERT INTO documento_accion(documento_iddocumento,accion_idaccion,fecha) VALUES(new.documento_iddocumento,accion ,date_format(now(),'%Y-%m-%d %H:%i:%s'));
END IF;
END
//
DELIMITER ;

CREATE TABLE IF NOT EXISTS configuracion (
  idconfiguracion int(11) NOT NULL auto_increment,
  nombre varchar(255) collate utf8_unicode_ci NOT NULL default '',
  valor varchar(255) collate utf8_unicode_ci default NULL,
  tipo varchar(255) collate utf8_unicode_ci NOT NULL default '',
  fecha timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (idconfiguracion)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS contador (
  idcontador int(11) NOT NULL auto_increment,
  consecutivo int(11) NOT NULL default '1',
  nombre varchar(100) collate utf8_unicode_ci NOT NULL default '',
  reiniciar_cambio_anio int(11) NOT NULL default '0',
  etiqueta_contador varchar(255) collate utf8_unicode_ci default NULL,
  post varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (idcontador)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS contenidos_carrusel (
  idcontenidos_carrusel int(11) NOT NULL auto_increment,
  carrusel_idcarrusel int(11) NOT NULL,
  contenido text NOT NULL,
  nombre varchar(255) NOT NULL,
  orden int(11) NOT NULL default '0',
  fecha_inicio date NOT NULL,
  fecha_fin date NOT NULL,
  preview text NOT NULL,
  imagen varchar(255) default NULL,
  miniatura varchar(255) NOT NULL,
  align varchar(20) default 'left',
  PRIMARY KEY  (idcontenidos_carrusel)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS correo_usuario (
  idcorreo_usuario int(11) NOT NULL auto_increment,
  para text NOT NULL,
  de text NOT NULL,
  asunto text,
  fecha datetime NOT NULL,
  idcorreo int(11) NOT NULL,
  funcionario varchar(255) NOT NULL,
  codificacion varchar(255) NOT NULL,
  estado varchar(255) NOT NULL,
  PRIMARY KEY  (idcorreo_usuario)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS datos_ejecutor (
  iddatos_ejecutor int(11) NOT NULL auto_increment,
  ejecutor_idejecutor int(11) NOT NULL,
  direccion varchar(255) collate utf8_unicode_ci default NULL,
  telefono varchar(50) collate utf8_unicode_ci default NULL,
  cargo varchar(255) collate utf8_unicode_ci default NULL,
  ciudad int(11) default NULL,
  titulo varchar(50) collate utf8_unicode_ci default 'Se&ntilde;or',
  empresa varchar(255) collate utf8_unicode_ci default NULL,
  fecha timestamp NOT NULL default CURRENT_TIMESTAMP,
  email varchar(255) collate utf8_unicode_ci default NULL,
  codigo varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (iddatos_ejecutor)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS departamento (
  nombre varchar(255) collate utf8_unicode_ci NOT NULL default '',
  iddepartamento int(11) NOT NULL auto_increment,
  pais_idpais int(11) NOT NULL default '1',
  PRIMARY KEY  (iddepartamento)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS dependencia (
  iddependencia int(11) NOT NULL auto_increment,
  codigo varchar(50) collate utf8_unicode_ci default NULL,
  nombre varchar(255) collate utf8_unicode_ci NOT NULL default '',
  fecha_ingreso timestamp NOT NULL default CURRENT_TIMESTAMP,
  cod_padre int(11) default NULL,
  tipo int(11) NOT NULL default '1',
  estado tinyint(2) NOT NULL default '1',
  codigo_tabla varchar(10) collate utf8_unicode_ci default NULL,
  extension varchar(20) collate utf8_unicode_ci default NULL,
  ubicacion_dependencia text collate utf8_unicode_ci,
  logo blob,
  PRIMARY KEY  (iddependencia)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS dependencia_cargo (
  iddependencia_cargo int(11) NOT NULL auto_increment,
  funcionario_idfuncionario int(11) NOT NULL default '0',
  dependencia_iddependencia int(11) NOT NULL default '0',
  cargo_idcargo int(11) NOT NULL default '0',
  estado tinyint(2) NOT NULL default '1',
  fecha_inicial timestamp NOT NULL default '2006-12-31 21:00:00',
  fecha_final timestamp NOT NULL default '2010-12-31 21:00:00',
  fecha_ingreso timestamp NOT NULL default CURRENT_TIMESTAMP,
  tipo tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (iddependencia_cargo)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS diagram (
  id int(10) unsigned NOT NULL auto_increment,
  hash varchar(6) NOT NULL,
  title varchar(255) default NULL,
  description text,
  publico tinyint(1) default '1',
  createdDate datetime NOT NULL,
  lastUpdate datetime NOT NULL,
  tamano int(10) unsigned default NULL COMMENT 'The size of diagram in bytes',
  PRIMARY KEY  (id),
  UNIQUE KEY uniqueHash (hash)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS diagramdata (
  diagramId int(10) unsigned NOT NULL,
  type enum('dia','svg','jpg','png') NOT NULL,
  fileName varchar(255) default NULL,
  fileSize int(10) unsigned default NULL COMMENT 'Tama&ntilde;o del diagrama',
  lastUpdate datetime NOT NULL,
  PRIMARY KEY  (diagramId,type)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS diagram_closed (
  iddiagram_closed int(11) NOT NULL auto_increment,
  diagram_iddiagram_instance int(11) NOT NULL,
  documento_idpaso_documento int(11) NOT NULL,
  funcionario_codigo int(11) NOT NULL,
  fecha datetime NOT NULL,
  estado_original int(11) NOT NULL,
  estado_final int(11) NOT NULL,
  observaciones text NOT NULL,
  PRIMARY KEY  (iddiagram_closed)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS diagram_finished (
  iddiagram_instance int(11) NOT NULL auto_increment,
  diagram_iddiagram int(11) NOT NULL,
  fecha int(11) NOT NULL,
  funcionario_codigo int(11) NOT NULL,
  observaciones text,
  PRIMARY KEY  (iddiagram_instance)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS diagram_history (
  iddiagram_history int(11) NOT NULL auto_increment,
  ruta_imagen varchar(255) NOT NULL,
  fecha datetime NOT NULL,
  responsable int(11) NOT NULL,
  diagram_iddiagram int(11) NOT NULL,
  PRIMARY KEY  (iddiagram_history)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS diagram_instance (
  iddiagram_instance int(11) NOT NULL auto_increment,
  diagram_iddiagram int(11) NOT NULL,
  fecha datetime NOT NULL,
  funcionario_codigo int(11) NOT NULL,
  estado_diagram_instance int(11) NOT NULL default '0' COMMENT '1,Ejecutado;2,Cerrado,3,Cancelado;4,Pendiente;5,Atrasado;6,Iniciado',
  PRIMARY KEY  (iddiagram_instance)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS digitalizacion (
  iddigitalizacion int(11) NOT NULL auto_increment,
  documento_iddocumento int(11) NOT NULL,
  fecha datetime NOT NULL,
  accion varchar(255) NOT NULL,
  funcionario varchar(255) NOT NULL,
  justificacion text,
  PRIMARY KEY  (iddigitalizacion),
  KEY documento_iddocumento (documento_iddocumento)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS documento (
  iddocumento int(14) NOT NULL auto_increment,
  numero varchar(50) collate utf8_unicode_ci NOT NULL default '',
  serie int(11) NOT NULL default '0',
  fecha timestamp NOT NULL default '0000-00-00 00:00:00',
  ejecutor int(11) NOT NULL default '0',
  descripcion text collate utf8_unicode_ci,
  paginas int(4) default '1',
  municipio_idmunicipio int(11) NOT NULL default '658',
  pdf varchar(255) collate utf8_unicode_ci default NULL,
  tipo_radicado int(11) NOT NULL default '0',
  estado enum('INICIADO','TRAMITE','HISTORICO','APROBADO','PERMANENTE','GESTION','CENTRAL','RECHAZADO','ACTIVO','TERMINADO','PROGRAMADO','INACTIVO','ELIMINADO') collate utf8_unicode_ci NOT NULL default 'INICIADO',
  fecha_oficio date default NULL,
  oficio varchar(20) collate utf8_unicode_ci default NULL,
  anexo enum('PAPEL','FAX','CONSIGNACION','CONSIGNACION ORIGINAL','DISKETES','CD-ROM','DVD','VIDEO','MICROFILMINAS') collate utf8_unicode_ci default NULL,
  descripcion_anexo text collate utf8_unicode_ci,
  dias tinyint(4) default NULL,
  almacenado tinyint(1) NOT NULL default '0',
  plantilla varchar(30) collate utf8_unicode_ci NOT NULL,
  activa_admin tinyint(1) NOT NULL default '0',
  fecha_creacion timestamp NULL default NULL,
  responsable int(11) default NULL,
  guia varchar(50) collate utf8_unicode_ci default NULL,
  guia_empresa int(11) default NULL,
  tipo_despacho varchar(255) collate utf8_unicode_ci default NULL,
  tipo_ejecutor int(1) default NULL,
  formato_idformato int(11) default NULL,
  PRIMARY KEY  (iddocumento),
  KEY serie (serie,fecha,tipo_radicado,estado),
  KEY municipio (municipio_idmunicipio),
  KEY fecha (fecha),
  KEY estado (estado),
  KEY ejecutor (ejecutor),
  FULLTEXT KEY numero (numero),
  FULLTEXT KEY plantilla_2 (plantilla)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 CHECKSUM=1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS documento_accion (
  iddocumento_accion int(11) NOT NULL auto_increment,
  accion_idaccion int(11) default NULL,
  documento_iddocumento int(11) default NULL,
  fecha datetime default NULL,
  PRIMARY KEY  (iddocumento_accion)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS documento_etiqueta (
  iddocumento_etiqueta int(11) NOT NULL auto_increment,
  etiqueta_idetiqueta int(11) NOT NULL,
  documento_iddocumento int(11) NOT NULL,
  fecha timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (iddocumento_etiqueta),
  KEY etiqueta_idetiqueta (etiqueta_idetiqueta),
  KEY documento_iddocumento (documento_iddocumento)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS documento_vinculados (
  iddocumento_vinculados int(11) NOT NULL auto_increment,
  documento_origen int(11) NOT NULL,
  documento_destino int(11) NOT NULL,
  fecha datetime NOT NULL,
  funcionario_idfuncionario int(11) NOT NULL,
  observaciones text character set latin1,
  PRIMARY KEY  (iddocumento_vinculados)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS ejecutor (
  idejecutor int(11) NOT NULL auto_increment,
  identificacion varchar(50) collate utf8_unicode_ci default NULL,
  nombre varchar(255) collate utf8_unicode_ci NOT NULL default '',
  fecha_ingreso timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (idejecutor),
  FULLTEXT KEY nombre (nombre)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=0 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS encabezado_formato (
  idencabezado_formato int(11) NOT NULL auto_increment,
  contenido text collate utf8_unicode_ci NOT NULL,
  etiqueta varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (idencabezado_formato)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS entidad (
  identidad int(11) NOT NULL auto_increment,
  nombre varchar(255) collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (identidad)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS entidad_expediente (
  identidad_expediente int(11) NOT NULL auto_increment,
  entidad_identidad int(11) NOT NULL default '0',
  expediente_idexpediente int(11) NOT NULL default '0',
  llave_entidad int(11) NOT NULL default '0',
  estado varchar(255) NOT NULL default '1',
  permiso varchar(255) character set utf8 collate utf8_unicode_ci default NULL,
  fecha date default NULL,
  PRIMARY KEY  (identidad_expediente)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS entidad_pretexto (
  identidad_pretexto int(11) NOT NULL auto_increment,
  pretexto_idpretexto int(11) NOT NULL default '0',
  entidad_identidad int(11) NOT NULL default '0',
  llave_entidad int(11) NOT NULL default '1',
  estado int(11) NOT NULL default '0',
  fecha datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (identidad_pretexto)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS entidad_serie (
  identidad_serie int(11) NOT NULL auto_increment,
  entidad_identidad int(11) NOT NULL default '0',
  serie_idserie int(11) NOT NULL default '0',
  llave_entidad int(11) NOT NULL default '0',
  estado varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL default '1',
  tipo varchar(1) character set utf8 collate utf8_unicode_ci NOT NULL default '0',
  fecha date default NULL,
  PRIMARY KEY  (identidad_serie)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS error (
  iderror int(11) NOT NULL auto_increment,
  funcionario_idfuncionario int(11) NOT NULL default '0',
  codigo_error text collate utf8_unicode_ci NOT NULL,
  archivo varchar(255) collate utf8_unicode_ci NOT NULL default '',
  origen varchar(255) collate utf8_unicode_ci NOT NULL default '',
  fecha datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (iderror)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS estadisticas_saia_size (
  idestadisticas_saia_size int(11) NOT NULL auto_increment,
  tamanio varchar(255) NOT NULL,
  fecha_inicial datetime NOT NULL,
  fecha_final datetime NOT NULL,
  descripcion varchar(255) NOT NULL,
  observaciones varchar(255) NOT NULL,
  fecha_registro datetime NOT NULL,
  PRIMARY KEY  (idestadisticas_saia_size)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS etiqueta (
  idetiqueta int(11) NOT NULL auto_increment,
  nombre varchar(255) NOT NULL,
  funcionario varchar(255) NOT NULL,
  privada_saia int(11) NOT NULL default '0',
  PRIMARY KEY  (idetiqueta)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS evento (
  idevento int(11) NOT NULL auto_increment,
  funcionario_codigo varchar(20) collate utf8_unicode_ci NOT NULL default '',
  fecha datetime default '0000-00-00 00:00:00',
  evento enum('ADICIONAR','MODIFICAR','ELIMINAR') collate utf8_unicode_ci NOT NULL default 'ADICIONAR',
  tabla_e varchar(30) collate utf8_unicode_ci NOT NULL,
  estado char(1) collate utf8_unicode_ci default NULL,
  registro_id int(11) NOT NULL default '0',
  detalle text collate utf8_unicode_ci NOT NULL,
  codigo_sql text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (idevento),
  KEY realiza (funcionario_codigo)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS expediente (
  idexpediente int(11) NOT NULL auto_increment,
  nombre varchar(255) collate utf8_unicode_ci NOT NULL default '',
  fecha timestamp NOT NULL default '0000-00-00 00:00:00',
  descripcion text collate utf8_unicode_ci,
  codigo varchar(255) collate utf8_unicode_ci NULL,
  cod_padre int(11) default NULL,
  propietario varchar(255) collate utf8_unicode_ci NOT NULL,
  ver_todos tinyint(1) NOT NULL,
  editar_todos tinyint(1) NOT NULL,
  PRIMARY KEY  (idexpediente)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS expediente_doc (
  idexpediente_doc int(11) NOT NULL auto_increment,
  expediente_idexpediente int(11) NOT NULL default '0',
  documento_iddocumento int(11) NOT NULL default '0',
  fecha timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (idexpediente_doc)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS filtro_grafica (
  idfiltro_grafica int(11) NOT NULL auto_increment,
  grafica_idgrafica int(11) NOT NULL,
  campo varchar(255) collate utf8_unicode_ci NOT NULL,
  etiqueta_html varchar(255) collate utf8_unicode_ci NOT NULL,
  codigo_sql varchar(2000) collate utf8_unicode_ci default NULL,
  etiqueta varchar(255) collate utf8_unicode_ci NOT NULL,
  tipo_dato varchar(255) collate utf8_unicode_ci NOT NULL default 'varchar',
  PRIMARY KEY  (idfiltro_grafica)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS filtro_reporte (
  idfiltro_reporte int(11) NOT NULL auto_increment,
  reporte_idreporte int(11) NOT NULL,
  campo varchar(255) collate utf8_unicode_ci NOT NULL,
  etiqueta_html varchar(255) collate utf8_unicode_ci NOT NULL,
  codigo_sql varchar(2000) collate utf8_unicode_ci default NULL,
  etiqueta varchar(255) collate utf8_unicode_ci NOT NULL,
  tipo_dato varchar(255) collate utf8_unicode_ci NOT NULL default 'varchar',
  PRIMARY KEY  (idfiltro_reporte)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS folder (
  idfolder int(11) NOT NULL auto_increment,
  caja_idcaja int(11) NOT NULL default '0',
  serie_idserie int(11) NOT NULL default '0',
  etiqueta varchar(255) collate utf8_unicode_ci NOT NULL default '',
  titulo varchar(255) collate utf8_unicode_ci default NULL,
  estado varchar(255) collate utf8_unicode_ci NOT NULL,
  descripcion text collate utf8_unicode_ci,
  autor int(11) NOT NULL,
  seguridad varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (idfolder)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS formato (
  idformato int(11) NOT NULL auto_increment,
  nombre varchar(255) collate utf8_unicode_ci NOT NULL default '',
  etiqueta varchar(255) collate utf8_unicode_ci NOT NULL default '',
  cod_padre int(11) NOT NULL default '0',
  contador_idcontador int(11) default '0',
  nombre_tabla varchar(255) collate utf8_unicode_ci NOT NULL default '',
  ruta_mostrar varchar(255) collate utf8_unicode_ci NOT NULL default '',
  ruta_editar varchar(255) character set utf8 collate utf8_roman_ci NOT NULL default '',
  ruta_adicionar varchar(255) collate utf8_unicode_ci NOT NULL default '',
  librerias varchar(255) collate utf8_unicode_ci default NULL,
  estilos varchar(255) collate utf8_unicode_ci default NULL,
  javascript varchar(255) collate utf8_unicode_ci default NULL,
  encabezado text collate utf8_unicode_ci,
  cuerpo text collate utf8_unicode_ci,
  pie_pagina text collate utf8_unicode_ci,
  margenes varchar(50) collate utf8_unicode_ci NOT NULL default '30,30,30,30',
  orientacion varchar(50) collate utf8_unicode_ci default NULL,
  papel varchar(50) collate utf8_unicode_ci default 'letter',
  exportar varchar(255) collate utf8_unicode_ci default 'pdf',
  funcionario_idfuncionario int(11) NOT NULL default '0',
  fecha timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  mostrar varchar(1) collate utf8_unicode_ci NOT NULL default '1',
  imagen varchar(255) collate utf8_unicode_ci default NULL,
  detalle varchar(1) collate utf8_unicode_ci NOT NULL default '0',
  tipo_edicion tinyint(1) NOT NULL default '0',
  item varchar(1) collate utf8_unicode_ci NOT NULL default '0',
  serie_idserie int(11) NOT NULL,
  ayuda varchar(400) collate utf8_unicode_ci default NULL,
  font_size varchar(5) collate utf8_unicode_ci NOT NULL default '12',
  banderas varchar(255) collate utf8_unicode_ci NOT NULL default 'm',
  tiempo_autoguardado varchar(20) collate utf8_unicode_ci NOT NULL default '300000',
  mostrar_pdf int(11) NOT NULL default '1',
  orden int(11) default NULL,
  enter2tab tinyint(1) NOT NULL default '0',
  firma_digital int(11) NOT NULL,
  fk_categoria_formato varchar(255) collate utf8_unicode_ci default NULL,
  flujo_idflujo int(11) default NULL,
  funcion_predeterminada varchar(255) collate utf8_unicode_ci default NULL COMMENT '1,varios responsables;2,Digitalizacion;3,Anexos',
  PRIMARY KEY  (idformato)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS funcion (
  idfuncion int(10) unsigned NOT NULL auto_increment,
  componente_pantalla_idpantalla int(10) unsigned NOT NULL default '0',
  componente_idcomponente int(10) unsigned NOT NULL default '0',
  pantalla_idpantalla int(10) unsigned NOT NULL default '0',
  nombre varchar(255) collate utf8_unicode_ci NOT NULL default '',
  parametros text collate utf8_unicode_ci,
  retorno varchar(255) collate utf8_unicode_ci default NULL,
  clase varchar(255) collate utf8_unicode_ci NOT NULL default '',
  accion varchar(100) collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (idfuncion)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS funcionario (
  idfuncionario int(11) NOT NULL AUTO_INCREMENT,
  funcionario_codigo int(11) NOT NULL DEFAULT '0',
  login varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  nombres varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  apellidos varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  firma mediumblob,
  estado int(11) NOT NULL DEFAULT '1',
  fecha_ingreso timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  clave varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  nit varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  perfil tinyint(2) NOT NULL DEFAULT '6',
  debe_firmar tinyint(1) NOT NULL DEFAULT '1',
  tipo varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  ultimo_pwd datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  mensajeria char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  email varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  sistema tinyint(1) NOT NULL DEFAULT '1',
  email_contrasena varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  direccion varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  telefono varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  acceso_web varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (idfuncionario),
  UNIQUE KEY funcionario_codigo (funcionario_codigo)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=0 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS funciones_formato (
  idfunciones_formato int(11) NOT NULL auto_increment,
  nombre varchar(255) collate utf8_unicode_ci NOT NULL default '',
  nombre_funcion varchar(255) collate utf8_unicode_ci NOT NULL default '',
  parametros varchar(255) collate utf8_unicode_ci default NULL,
  etiqueta varchar(255) collate utf8_unicode_ci NOT NULL default '',
  descripcion varchar(255) collate utf8_unicode_ci default NULL,
  ruta varchar(255) collate utf8_unicode_ci NOT NULL default '',
  formato varchar(255) collate utf8_unicode_ci NOT NULL default '',
  acciones varchar(10) collate utf8_unicode_ci default 'm',
  PRIMARY KEY  (idfunciones_formato)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS funciones_formato_accion (
  idfunciones_formato_accion int(11) NOT NULL auto_increment,
  idfunciones_formato int(11) NOT NULL,
  accion_idaccion int(11) NOT NULL,
  formato_idformato int(11) NOT NULL,
  momento varchar(20) collate utf8_unicode_ci NOT NULL default 'ANTERIOR',
  estado int(1) NOT NULL default '1',
  orden int(11) NOT NULL default '1',
  PRIMARY KEY  (idfunciones_formato_accion)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS funciones_paso (
  idfunciones_paso int(11) NOT NULL auto_increment,
  nombre varchar(255) NOT NULL,
  parametros varchar(255) NOT NULL,
  libreria varchar(255) NOT NULL,
  PRIMARY KEY  (idfunciones_paso)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS funciones_paso_accion (
  idfunciones_paso_accion int(11) NOT NULL auto_increment,
  accion_idaccion int(11) NOT NULL,
  paso_idfunciones_paso int(11) NOT NULL,
  PRIMARY KEY  (idfunciones_paso_accion)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS grafico (
  idgrafico int(11) NOT NULL auto_increment,
  etiqueta varchar(255) collate utf8_unicode_ci default NULL,
  etiquetax varchar(255) collate utf8_unicode_ci default NULL,
  etiquetay varchar(255) collate utf8_unicode_ci default NULL,
  ancho int(11) default '300',
  alto int(11) default '400',
  mascaras varchar(4000) collate utf8_unicode_ci default NULL,
  presicion_dato int(11) default '2',
  prefijo varchar(255) collate utf8_unicode_ci default NULL,
  estado int(11) default '1',
  nombre varchar(255) collate utf8_unicode_ci NOT NULL default '',
  modulo_idmodulo int(11) default NULL,
  direccion_titulo int(11) default '0',
  etiquetay2 varchar(255) collate utf8_unicode_ci default NULL,
  tipo_grafico varchar(255) collate utf8_unicode_ci NOT NULL,
  sql_grafico text collate utf8_unicode_ci,
  espacio_inferior int(11) NOT NULL default '0',
  mostrar_valores tinyint(1) NOT NULL default '1',
  libreria varchar(20) collate utf8_unicode_ci NOT NULL default 'fusioncharts',
  PRIMARY KEY  (idgrafico)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS grafico_serie (
  idgrafico_serie int(11) NOT NULL auto_increment,
  codigo_sql text NOT NULL,
  tipo varchar(255) NOT NULL,
  nombre varchar(255) NOT NULL,
  grafico_idgrafico int(11) NOT NULL,
  PRIMARY KEY  (idgrafico_serie)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS log_acceso (
  idlog_acceso int(11) NOT NULL auto_increment,
  login varchar(100) collate utf8_unicode_ci NOT NULL default '',
  iplocal varchar(30) collate utf8_unicode_ci NOT NULL,
  ipremota varchar(50) collate utf8_unicode_ci default NULL,
  exito tinyint(4) NOT NULL default '0',
  fecha timestamp NOT NULL default CURRENT_TIMESTAMP,
  fecha_cierre datetime default NULL,
  funcionario_idfuncionario int(11) default NULL,
  idsesion_php varchar(255) collate utf8_unicode_ci NOT NULL default '',
  sesion_php text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (idlog_acceso)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS mensaje_formato (
  idmensaje_formato int(11) NOT NULL auto_increment,
  formato_idformato int(11) NOT NULL,
  campo_mensaje varchar(255) NOT NULL,
  campo_formato varchar(255) NOT NULL,
  PRIMARY KEY  (idmensaje_formato)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS modulo (
  idmodulo int(11) NOT NULL auto_increment,
  nombre varchar(255) collate utf8_unicode_ci NOT NULL default '',
  tipo varchar(255) collate utf8_unicode_ci NOT NULL default 'secundario',
  imagen varchar(255) collate utf8_unicode_ci NOT NULL default 'botones/configuracion/default.gif',
  etiqueta varchar(255) collate utf8_unicode_ci NOT NULL default '',
  enlace varchar(255) collate utf8_unicode_ci NOT NULL default '',
  destino varchar(255) collate utf8_unicode_ci NOT NULL default 'centro',
  cod_padre int(11) default NULL,
  orden tinyint(3) NOT NULL default '1',
  ayuda text collate utf8_unicode_ci NOT NULL,
  parametros varchar(255) collate utf8_unicode_ci default NULL,
  busqueda_idbusqueda int(11) default NULL,
  permiso_admin tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (idmodulo)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS municipio (
  idmunicipio int(11) NOT NULL auto_increment,
  nombre varchar(255) collate utf8_unicode_ci NOT NULL default '',
  departamento_iddepartamento int(11) NOT NULL default '0',
  PRIMARY KEY  (idmunicipio)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS municipio_exterior (
  idmunicipio_exterior int(11) NOT NULL auto_increment,
  nombre varchar(255) collate utf8_unicode_ci NOT NULL,
  departamento_iddepartamento int(11) NOT NULL,
  PRIMARY KEY  (idmunicipio_exterior)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS pagina (
  consecutivo int(11) NOT NULL auto_increment,
  id_documento int(11) NOT NULL default '0',
  imagen varchar(255) collate utf8_unicode_ci default NULL,
  pagina int(4) NOT NULL default '1',
  ruta varchar(255) collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (consecutivo)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS pais (
  idpais int(11) NOT NULL auto_increment,
  nombre varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (idpais)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS pantalla (
  idpantalla int(10) unsigned NOT NULL auto_increment,
  nombre varchar(255) collate utf8_unicode_ci default NULL,
  ancho double default NULL,
  alto double default NULL,
  estado enum('A','M','L','V','I','E') collate utf8_unicode_ci default NULL,
  db varchar(50) collate utf8_unicode_ci NOT NULL default '',
  tabla varchar(50) collate utf8_unicode_ci NOT NULL default '',
  idactual int(11) NOT NULL default '0',
  PRIMARY KEY  (idpantalla)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS paso (
  idpaso int(11) NOT NULL auto_increment,
  descripcion text character set utf8 collate utf8_unicode_ci NOT NULL,
  responsable text character set utf8 collate utf8_unicode_ci NOT NULL,
  nombre_paso varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  estado int(1) NOT NULL default '1' COMMENT 'Define si el paso esta o no activo 1 ctivo , 0  Inactivo',
  idfigura int(11) NOT NULL,
  diagram_iddiagram int(11) NOT NULL,
  posicion varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  plazo_paso varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (idpaso)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS paso_actividad (
  idpaso_actividad int(11) NOT NULL auto_increment,
  descripcion text character set utf8 collate utf8_unicode_ci NOT NULL,
  restrictivo int(11) NOT NULL,
  estado int(11) NOT NULL default '1' COMMENT 'Activo,inactivo',
  paso_idpaso int(11) NOT NULL,
  orden int(11) NOT NULL,
  tipo int(11) NOT NULL default '1' COMMENT 'Sistema,Manual',
  entidad_identidad int(11) NOT NULL,
  llave_entidad varchar(255) NOT NULL,
  paso_objeto_idpaso_objeto int(11) default NULL,
  accion_idaccion int(11) default NULL,
  formato_idformato varchar(255) default NULL,
  plazo int(11) NOT NULL default '24',
  tipo_plazo varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL default 'hour' COMMENT 'Los tipos deben ser hour,minute,day,month,year',
  PRIMARY KEY  (idpaso_actividad)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS paso_actividad_anexo (
  idpaso_actividad_anexo int(11) NOT NULL auto_increment,
  documento_iddocumento int(11) NOT NULL,
  etiqueta varchar(255) NOT NULL,
  ruta varchar(255) NOT NULL,
  tipo varchar(255) NOT NULL,
  PRIMARY KEY  (idpaso_actividad_anexo)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS paso_actividad_funciones (
  idpaso_actividad_funciones int(11) NOT NULL auto_increment,
  paso_idfunciones_paso int(11) NOT NULL,
  paso_idpaso int(11) NOT NULL,
  actividad_idpaso_actividad int(11) NOT NULL,
  accion_idaccion int(11) default NULL,
  PRIMARY KEY  (idpaso_actividad_funciones),
  KEY funciones_paso_idfunciones_paso (paso_idfunciones_paso),
  KEY paso_idpaso (paso_idpaso),
  KEY paso_actividad_idpaso_actividad (actividad_idpaso_actividad)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS paso_actividad_programacion (
  idpaso_actividad_programacion int(11) NOT NULL auto_increment,
  inicio datetime NOT NULL,
  meses varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  dias varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  expirar datetime default NULL,
  estado int(11) NOT NULL default '1',
  actividad_idpaso_actividad int(11) NOT NULL,
  PRIMARY KEY  (idpaso_actividad_programacion)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS paso_devolucion (
  idpaso_devolucion int(11) NOT NULL auto_increment,
  fecha datetime NOT NULL,
  funcionario_idfuncionario int(11) NOT NULL,
  documento_iddocumento int(11) NOT NULL,
  idpaso_antiguo_pendiente int(11) NOT NULL,
  idpaso_nuevo_pendiente int(11) NOT NULL,
  PRIMARY KEY  (idpaso_devolucion)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS paso_documento (
  idpaso_documento int(11) NOT NULL auto_increment,
  paso_idpaso int(11) NOT NULL,
  documento_iddocumento int(11) NOT NULL,
  fecha_asignacion datetime NOT NULL,
  diagram_iddiagram_instance int(11) NOT NULL,
  estado_paso_documento int(11) NOT NULL default '0' COMMENT '1,Ejecutado;2,Cerrado,3,Cancelado;4,Pendiente;5,Atrasado;6,Iniciado',
  PRIMARY KEY  (idpaso_documento)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS paso_enlace (
  idpaso_enlace int(11) NOT NULL auto_increment,
  origen varchar(255) default NULL,
  destino int(11) default NULL,
  diagram_iddiagram int(11) NOT NULL,
  idconector int(11) NOT NULL,
  PRIMARY KEY  (idpaso_enlace)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS paso_enlace_temporal (
  idpaso_enlace_temporal int(11) NOT NULL auto_increment,
  origen varchar(255) default NULL,
  destino int(11) default NULL,
  diagram_iddiagram int(11) NOT NULL,
  idconector int(11) NOT NULL,
  PRIMARY KEY  (idpaso_enlace_temporal)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS paso_instancia_pendiente (
  idpaso_instancia int(11) NOT NULL auto_increment,
  actividad_idpaso_actividad int(11) NOT NULL,
  responsable text NOT NULL COMMENT 'Quien debe realizar la accion funcionario',
  fecha datetime NOT NULL,
  documento_iddocumento int(15) default NULL,
  PRIMARY KEY  (idpaso_instancia),
  KEY documento_iddocumento (documento_iddocumento)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS paso_instancia_rastro (
  idpaso_instancia_rastro int(11) NOT NULL auto_increment,
  instancia_idpaso_instancia int(11) NOT NULL,
  funcionario_codigo int(11) NOT NULL,
  estado_original int(11) NOT NULL,
  estado_final int(11) NOT NULL,
  fecha_cambio datetime NOT NULL,
  observaciones text,
  PRIMARY KEY  (idpaso_instancia_rastro)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS paso_instancia_terminada (
  idpaso_instancia int(11) NOT NULL auto_increment,
  actividad_idpaso_actividad int(11) NOT NULL,
  documento_iddocumento int(11) default NULL,
  responsable int(11) NOT NULL COMMENT 'Quien realiza la accion funcionario',
  fecha datetime NOT NULL,
  tipo_terminacion int(1) NOT NULL default '1',
  estado_actividad int(11) NOT NULL default '1' COMMENT '1,Ejecutado;2,Cerrado,3,Cancelado;4,Pendiente;5,Atrasado;6,Iniciado;7,Devuelto',
  PRIMARY KEY  (idpaso_instancia)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS paso_inst_terminacion (
  idpaso_inst_terminacion int(11) NOT NULL auto_increment,
  documento_idpaso_documento int(11) NOT NULL,
  instancia_idpaso_instancia int(11) NOT NULL,
  funcionario_codigo int(11) NOT NULL,
  fecha_justificacion datetime NOT NULL,
  observaciones text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (idpaso_inst_terminacion)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS paso_rastro (
  idpaso_rastro int(11) NOT NULL auto_increment,
  documento_idpaso_documento int(11) NOT NULL,
  funcionario_codigo int(11) NOT NULL,
  estado_original int(11) NOT NULL,
  estado_final int(11) NOT NULL,
  fecha_cambio datetime NOT NULL,
  observaciones text,
  PRIMARY KEY  (idpaso_rastro)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS paso_temporal (
  idpaso_temporal int(11) NOT NULL auto_increment,
  nombre_paso varchar(255) NOT NULL,
  figura_idfigura int(11) NOT NULL,
  diagram_iddiagram int(11) NOT NULL,
  posicion varchar(255) NOT NULL,
  PRIMARY KEY  (idpaso_temporal)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS perfil (
  idperfil int(11) NOT NULL auto_increment,
  nombre varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL default 'GENERAL',
  PRIMARY KEY  (idperfil)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS permiso (
  idpermiso int(11) NOT NULL auto_increment,
  funcionario_idfuncionario int(11) NOT NULL default '0',
  accion int(11) default NULL,
  modulo_idmodulo int(11) NOT NULL default '0',
  caracteristica_propio varchar(15) collate utf8_unicode_ci default NULL,
  caracteristica_grupo varchar(15) collate utf8_unicode_ci default NULL,
  caracteristica_total varchar(15) collate utf8_unicode_ci default NULL,
  tipo tinyint(3) NOT NULL default '1',
  PRIMARY KEY  (idpermiso)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS permiso_anexo (
  idpermiso_anexo int(11) NOT NULL auto_increment,
  anexos_idanexos int(11) NOT NULL default '0',
  idpropietario int(11) default '0',
  caracteristica_propio varchar(8) character set latin1 default NULL,
  caracteristica_dependencia varchar(8) character set latin1 default NULL,
  caracteristica_cargo varchar(8) character set latin1 default NULL,
  caracteristica_total varchar(8) character set latin1 default NULL,
  PRIMARY KEY  (idpermiso_anexo)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS permiso_documento (
  idpermiso_documento int(11) NOT NULL auto_increment,
  funcionario int(11) NOT NULL default '0',
  documento_iddocumento int(11) NOT NULL default '0',
  permisos varchar(15) character set utf8 collate utf8_unicode_ci default NULL,
  fecha timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (idpermiso_documento),
  KEY doc (documento_iddocumento),
  KEY func (funcionario)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS permiso_formato (
  idpermiso_formato int(11) NOT NULL auto_increment,
  formato_idformato int(11) NOT NULL default '0',
  idpropietario int(11) NOT NULL default '0',
  caracteristica_propio varchar(8) collate utf8_unicode_ci default NULL,
  caracteristica_dependencia varchar(8) collate utf8_unicode_ci default NULL,
  caracteristica_cargo varchar(8) collate utf8_unicode_ci default NULL,
  caracteristica_total varchar(8) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (idpermiso_formato)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS permiso_perfil (
  idpermiso_perfil int(11) NOT NULL auto_increment,
  modulo_idmodulo int(11) NOT NULL default '0',
  perfil_idperfil int(11) NOT NULL default '0',
  caracteristica_propio varchar(15) default NULL,
  caracteristica_grupo varchar(15) default NULL,
  caracteristica_total varchar(15) default NULL,
  PRIMARY KEY  (idpermiso_perfil)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS pretexto (
  idpretexto int(11) NOT NULL auto_increment,
  contenido longtext collate utf8_unicode_ci NOT NULL,
  ayuda varchar(1000) collate utf8_unicode_ci NOT NULL,
  imagen varchar(255) collate utf8_unicode_ci NOT NULL,
  asunto varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (idpretexto)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS prioridad_documento (
  idprioridad_documento int(11) NOT NULL auto_increment,
  documento_iddocumento int(11) NOT NULL,
  funcionario_idfuncionario int(11) NOT NULL,
  fecha_asignacion datetime NOT NULL,
  prioridad int(11) NOT NULL,
  PRIMARY KEY  (idprioridad_documento)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS reemplazo (
  idreemplazo int(11) NOT NULL auto_increment,
  antiguo int(11) NOT NULL default '0',
  nuevo int(11) NOT NULL default '0',
  fecha_inicio timestamp NOT NULL default '0000-00-00 00:00:00',
  fecha_fin timestamp NULL default NULL,
  cargo_nuevo int(11) NOT NULL default '0',
  activo char(1) collate utf8_unicode_ci NOT NULL default '1',
  PRIMARY KEY  (idreemplazo)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS reporte (
  idreporte int(11) NOT NULL auto_increment,
  nombre varchar(255) collate utf8_unicode_ci NOT NULL default '',
  sql_reporte varchar(3000) collate utf8_unicode_ci NOT NULL,
  nombre_archivo varchar(255) collate utf8_unicode_ci default 'reporte',
  estado int(11) NOT NULL default '1',
  mascaras varchar(3000) collate utf8_unicode_ci default NULL,
  modulo_idmodulo int(11) NOT NULL default '0',
  campos_texto varchar(2000) collate utf8_unicode_ci default NULL,
  campos_numero varchar(2000) collate utf8_unicode_ci default NULL,
  tipo_ordenamiento varchar(4) collate utf8_unicode_ci default NULL,
  campo_ordenamiento varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (idreporte)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS respuesta (
  idrespuesta int(11) NOT NULL auto_increment,
  fecha datetime NOT NULL default '0000-00-00 00:00:00',
  destino int(11) NOT NULL default '0',
  origen int(11) NOT NULL default '0',
  idbuzon int(11) NOT NULL default '0',
  plantilla varchar(30) character set latin1 NOT NULL default 'CARTA',
  PRIMARY KEY  (idrespuesta)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS ruta (
  idruta int(11) NOT NULL auto_increment,
  origen int(11) NOT NULL default '0',
  tipo enum('ACTIVO','INACTIVO') collate utf8_unicode_ci NOT NULL default 'ACTIVO',
  destino int(11) NOT NULL default '0',
  idtipo_documental int(11) default NULL,
  condicion_transferencia enum('RECEPCION','PRODUCCION','DISTRIBUCION','CONSULTA','POR_APROBAR','RETENCION','ALMACENAMIENTO','RECUPERACION','PRESERVACION','DISPOSICION FINAL','REVISADO','APROBADO','TRANSFERIDO') collate utf8_unicode_ci default NULL,
  documento_iddocumento int(11) default NULL,
  fecha timestamp NULL default CURRENT_TIMESTAMP,
  transferencia_idtransferencia int(11) default NULL,
  orden int(11) NOT NULL default '0',
  tipo_origen int(11) NOT NULL default '0',
  tipo_destino int(11) NOT NULL default '0',
  obligatorio tinyint(1) NOT NULL default '1',
  restrictivo tinyint(1) NOT NULL default '0',
  idenlace_nodo int(11) default NULL,
  clase tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (idruta),
  KEY origen (origen),
  KEY destino (destino)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS serie (
  idserie int(11) NOT NULL auto_increment,
  nombre varchar(255) collate utf8_unicode_ci NOT NULL default '',
  cod_padre int(11) default NULL,
  dias_entrega int(11) NOT NULL default '8',
  codigo varchar(20) collate utf8_unicode_ci default NULL,
  tipo_entidad int(2) default NULL,
  llave_entidad varchar(100) collate utf8_unicode_ci default NULL,
  retencion_gestion tinyint(3) NOT NULL default '3',
  retencion_central tinyint(3) NOT NULL default '5',
  conservacion enum('TOTAL','ELIMINACION') collate utf8_unicode_ci default NULL,
  digitalizacion tinyint(1) default NULL,
  seleccion tinyint(1) default NULL,
  otro varchar(255) collate utf8_unicode_ci default NULL,
  procedimiento text collate utf8_unicode_ci,
  copia tinyint(2) NOT NULL default '0',
  tipo tinyint(4) NOT NULL default '0',
  clase tinyint(4) default '1',
  estado tinyint(4) NOT NULL default '1',
  categoria int(11) NOT NULL default '2',
  PRIMARY KEY  (idserie)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS tarea (
  idtarea int(11) NOT NULL auto_increment,
  nombre varchar(255) collate utf8_unicode_ci NOT NULL,
  fecha datetime default NULL,
  tiempo_respuesta int(11) default '0' COMMENT 'tiempo en horas',
  descripcion varchar(300) collate utf8_unicode_ci default NULL,
  reprograma tinyint(4) default NULL,
  tipo_reprograma varchar(30) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (idtarea)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS tareas (
  idtareas int(11) NOT NULL auto_increment,
  etiqueta varchar(255) NOT NULL,
  fecha_vencimiento datetime NOT NULL,
  asignada_por int(11) NOT NULL,
  asignada_a varchar(255) NOT NULL,
  documento_iddocumento int(11) default NULL,
  orden int(11) default NULL,
  PRIMARY KEY  (idtareas)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS tareas_buzon (
  idtareas_buzon int(11) NOT NULL auto_increment,
  terminado_por int(11) NOT NULL,
  descripcion_estado text NOT NULL,
  fecha_estado datetime NOT NULL,
  tareas_idtareas int(11) NOT NULL,
  estado int(11) NOT NULL default '1' COMMENT '1,TERMINADA',
  PRIMARY KEY  (idtareas_buzon)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS userdiagram (
  userId int(10) unsigned NOT NULL,
  diagramId int(10) unsigned NOT NULL,
  invitedDate datetime NOT NULL ,
  acceptedDate datetime NOT NULL ,
  status enum('accepted','kickedof') default 'accepted',
  nivel enum('editor','author') default 'editor' ,
  PRIMARY KEY  (userId,diagramId),
  KEY cst_userdiagram_diagram (diagramId)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS user_workflow (
  id int(10) unsigned NOT NULL auto_increment,
  account varchar(128) default NULL,
  email varchar(128) default NULL,
  password varchar(128) default NULL,
  name varchar(128) default NULL,
  createdDate datetime NOT NULL,
  lastLoginDate datetime default NULL,
  lastLoginIP char(40) default NULL,
  lastBrowserType varchar(255) default NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY uniqueEmail (email),
  UNIQUE KEY uniqueAccount (account)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS vista_formato (
  idvista_formato int(11) NOT NULL auto_increment,
  nombre varchar(255) collate utf8_unicode_ci NOT NULL default '',
  etiqueta varchar(255) collate utf8_unicode_ci NOT NULL default '',
  formato_padre int(11) NOT NULL default '0',
  ruta_mostrar varchar(255) collate utf8_unicode_ci NOT NULL default '',
  librerias varchar(255) collate utf8_unicode_ci default NULL,
  estilos varchar(255) collate utf8_unicode_ci default NULL,
  javascript varchar(255) collate utf8_unicode_ci default NULL,
  encabezado text collate utf8_unicode_ci,
  cuerpo text collate utf8_unicode_ci,
  pie_pagina text collate utf8_unicode_ci,
  margenes varchar(50) collate utf8_unicode_ci NOT NULL default '30,30,30,30',
  orientacion varchar(50) collate utf8_unicode_ci default NULL,
  papel varchar(50) collate utf8_unicode_ci default 'letter',
  exportar varchar(255) collate utf8_unicode_ci default 'pdf',
  funcionario_idfuncionario int(11) NOT NULL default '0',
  fecha timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  imagen varchar(255) collate utf8_unicode_ci default NULL,
  ayuda varchar(400) collate utf8_unicode_ci default NULL,
  font_size varchar(4) collate utf8_unicode_ci NOT NULL default '12',
  banderas varchar(255) collate utf8_unicode_ci NOT NULL default 'm',
  PRIMARY KEY  (idvista_formato),
  KEY nombre (nombre),
  FULLTEXT KEY nombre_2 (nombre)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS valmacenamiento;

CREATE VIEW valmacenamiento AS select A.idcaja AS idcaja,A.estanteria AS estanteria,A.material AS material,A.nivel AS nivel,A.numero AS numero,A.panel AS panel,A.seguridad AS seguridad_caja,A.ubicacion AS ubicacion,B.idfolder AS idfolder,B.caja_idcaja AS caja_idcaja,B.serie_idserie AS serie_idserie,B.etiqueta AS etiqueta,B.titulo AS titulo,B.estado AS estado,B.descripcion AS descripcion,B.autor AS autor,B.seguridad AS seguridad,C.idalmacenamiento AS idalmacenamiento,C.documento_iddocumento AS documento_iddocumento,C.folder_idfolder AS folder_idfolder,C.soporte AS soporte,C.num_folios AS num_folios,C.anexos AS anexos,C.deterioro AS deterioro,C.responsable AS responsable,C.registro_entrada AS registro_entrada from ((caja A join folder B) join almacenamiento C) where ((A.idcaja = B.caja_idcaja) and (B.idfolder = C.folder_idfolder));

DROP TABLE IF EXISTS vdocumento;

CREATE VIEW vdocumento AS select A.iddocumento AS iddocumento,A.estado AS estado,A.descripcion AS descripcion,B.nombre AS serie,A.fecha AS fecha,A.tipo_radicado AS tipo_radicado,A.plantilla AS plantilla from (documento A join serie B) where (A.serie = B.idserie);

DROP TABLE IF EXISTS vejecutor;

CREATE VIEW vejecutor AS select A.idejecutor AS idejecutor,A.identificacion AS identificacion,A.nombre AS nombre,A.fecha_ingreso AS fecha_ingreso,B.iddatos_ejecutor AS iddatos_ejecutor,B.ejecutor_idejecutor AS ejecutor_idejecutor,B.direccion AS direccion,B.telefono AS telefono,B.cargo AS cargo,B.ciudad AS ciudad,B.titulo AS titulo,B.empresa AS empresa,B.fecha AS fecha,B.email AS email,B.codigo AS codigo,C.nombre AS ciudad_ejecutor from ((ejecutor A join datos_ejecutor B) join municipio C) where ((A.idejecutor = B.ejecutor_idejecutor) and (B.ciudad = C.idmunicipio));

DROP TABLE IF EXISTS vexpediente;

CREATE VIEW vexpediente AS select A.idexpediente AS idexpediente,A.nombre AS nombre,A.fecha AS fecha,A.descripcion AS descripcion,A.codigo AS codigo,A.cod_padre AS cod_padre,A.propietario AS propietario,A.ver_todos AS ver_todos,A.editar_todos AS editar_todos,B.idexpediente_doc AS idexpediente_doc,B.documento_iddocumento AS documento_iddocumento,B.fecha AS fecha_ed from (expediente A join expediente_doc B) where (A.idexpediente = B.expediente_idexpediente) group by A.idexpediente;

DROP TABLE IF EXISTS vfuncionario_dc;

CREATE VIEW vfuncionario_dc AS select b.idfuncionario AS idfuncionario,b.funcionario_codigo AS funcionario_codigo,b.login AS login,b.nombres AS nombres,b.apellidos AS apellidos,b.firma AS firma,b.estado AS estado,b.fecha_ingreso AS fecha_ingreso,b.clave AS clave,b.nit AS nit,b.perfil AS perfil,b.debe_firmar AS debe_firmar,b.mensajeria AS mensajeria,b.email AS email,b.sistema AS sistema,b.tipo AS tipo,b.ultimo_pwd AS ultimo_pwd,b.direccion AS direccion,b.telefono AS telefono,c.nombre AS cargo,c.idcargo AS idcargo,a.nombre AS dependencia,a.estado AS estado_dep,a.codigo AS codigo,a.tipo AS tipo_dep,a.iddependencia AS iddependencia,a.fecha_ingreso AS creacion_dep,a.cod_padre AS cod_padre,a.extension AS extension,a.ubicacion_dependencia AS ubicacion_dependencia,a.logo AS logo,d.iddependencia_cargo AS iddependencia_cargo,d.estado AS estado_dc,d.fecha_inicial AS fecha_inicial,d.fecha_final AS fecha_final,d.fecha_ingreso AS creacion_dc,d.tipo AS tipo_dc from (((dependencia a join funcionario b) join cargo c) join dependencia_cargo d) where ((a.iddependencia = d.dependencia_iddependencia) and (b.idfuncionario = d.funcionario_idfuncionario) and (c.idcargo = d.cargo_idcargo));