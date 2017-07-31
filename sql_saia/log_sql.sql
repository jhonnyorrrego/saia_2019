/*
 * LOG SQL SAIA
 * Este archivo se usa para almacenar todos los cambios en estructura y contenido de la base de datos de saia.
 * Esto con el fin de poder versionar la base de datos a medida que se va desarrollando.
 * Si se necesita pasar un desarrollo nuevo se debe verificar el ultimo commit del desarrollo en cuestion por medio de git, ahi se podra observar hasta que linea se inserto en este archivo, para pasar los correspondientes sql a la nueva BD.
 */

/* ------------------------------------- */

ALTER TABLE serie ADD tvd INT( 11 ) NULL DEFAULT  '0';

/* ------------------------------------- */

CREATE OR REPLACE VIEW vdependencia_serie AS select concat(d.codigo,'.',s.codigo) AS orden_dependencia_serie,d.nombre AS dependencia,s.idserie AS idserie,d.iddependencia AS iddependencia,s.nombre AS nombre,(case s.estado when 1 then 'Activo' else 'Inactivo' end) AS estado,s.codigo AS codigo,(case s.tipo when 1 then 'Serie' when 2 then 'Subserie' else 'Tipo documental' end) AS tipo,s.tipo AS tipo_serie,s.retencion_gestion AS retencion_gestion,s.retencion_central AS retencion_central,s.conservacion AS conservacion,s.seleccion AS seleccion,s.digitalizacion AS digitalizacion,s.procedimiento AS procedimiento,s.tvd from ((serie s join dependencia d) join entidad_serie e) where ((e.serie_idserie = s.idserie) and (e.llave_entidad = d.iddependencia) and (s.categoria = 2) and (d.tipo = 1));

UPDATE  busqueda_condicion SET  codigo_where =  'tipo_serie<>3 and tipo_serie<>0 AND tvd=0' WHERE idbusqueda_condicion =214;

UPDATE  busqueda_condicion SET  codigo_where =  'tipo_serie<>0  AND tvd=0  {*condicion_adicional_series*}' WHERE idbusqueda_condicion =215;

UPDATE  busqueda_condicion SET  codigo_where =  'tipo<>3 and tipo<>0 AND tvd=0' WHERE idbusqueda_condicion =228;

/* ------------------------------------- */

UPDATE busqueda_componente SET  info =  '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*} <br><br><div>{*descripcion*}</div><br><div><b>Etiqueta:</b> {*mostrar_nombre_etiquetas@iddocumento*}</div><br>
{*mostrar_fecha_limite_documento@fecha_limite*}{*barra_inferior_documento@iddocumento,numero*}</div>' WHERE  idbusqueda_componente =229;

/* ------------------------------------- */

UPDATE  busqueda_componente SET  info =  '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha_inicial,plantilla,iddocumento*} <br><br><div>{*descripcion*}</div><br><br>{*barra_inferior_documento@iddocumento,numero*}</div>' WHERE  idbusqueda_componente =7;


UPDATE  busqueda_componente SET  info =  '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<br><br><div>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>' WHERE  idbusqueda_componente =239;

UPDATE  busqueda_componente SET  info =  '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<div><br>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>' WHERE  idbusqueda_componente =33;

UPDATE  busqueda_componente SET  info =  '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha_inicial,plantilla,iddocumento*}<br><br><div>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>' WHERE  idbusqueda_componente =12;

UPDATE  busqueda_componente SET  info =  '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha_inicial,plantilla,iddocumento*}<br><br><div>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>' WHERE  idbusqueda_componente =13;

UPDATE  busqueda_componente SET  info =  '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<br><br><div>{*descripcion*}</div><br><br>{*barra_inferior_documento@iddocumento,numero*}</div>' WHERE  idbusqueda_componente =14;

UPDATE  busqueda_componente SET  info =  '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<br><br><div>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>' WHERE  idbusqueda_componente =16;

UPDATE  busqueda_componente SET  info =  '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<br><br><div>{*descripcion*}</div><br><br>{*barra_inferior_documento@iddocumento,numero*}</div>' WHERE  idbusqueda_componente =17;

UPDATE  busqueda_componente SET  info =  '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<br><br><div>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>' WHERE  idbusqueda_componente =18;

UPDATE  busqueda_componente SET  info =  '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<br><br><div>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>' WHERE  idbusqueda_componente =23;

UPDATE  busqueda_componente SET  info =  '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<div><br>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>' WHERE  idbusqueda_componente =104;

UPDATE  busqueda_componente SET  info =  '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<br><br><div>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>' WHERE  idbusqueda_componente =105;

UPDATE  busqueda_componente SET  info =  '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<div><br><br>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>' WHERE  idbusqueda_componente =93;

UPDATE  busqueda_componente SET  info =  '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<div><br><br>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>' WHERE  idbusqueda_componente =94;

UPDATE  busqueda_componente SET  info =  '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<div><br>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>' WHERE  idbusqueda_componente =96;

UPDATE  busqueda_componente SET  info =  '<div id="resultado_pantalla_{*idexpediente*}" class="well"><b>{*origen_documento_expediente@iddocumento,numero,ejecutor,tipo_radicado,estado_doc,serie_doc,tipo_ejecutor*}</b>{*fecha_creacion_documento_expediente@fecha_doc,plantilla,iddocumento*}<br><br><div class=''descripcion_documento''>{*obtener_descripcion@descripcion_doc*}</div><div class=''row-fluid''>
{*barra_inferior_documento_expediente@iddocumento,numero,idexpediente*}</div></div>' WHERE  idbusqueda_componente =111;

UPDATE  busqueda_componente SET  info =  '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha_inicial,plantilla,iddocumento*}<div><br>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>' WHERE  idbusqueda_componente =159;

UPDATE  busqueda_componente SET  info =  '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*} <br><br><div>{*descripcion*}</div><br><div><b>Etiqueta:</b> {*mostrar_nombre_etiquetas@iddocumento*}</div><br>
{*barra_inferior_documento@iddocumento,numero*}</div>' WHERE  idbusqueda_componente =229;

UPDATE  busqueda_componente SET  info =  '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<br><br><div>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>' WHERE  idbusqueda_componente =243;

UPDATE  busqueda_componente SET  info =  '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<br><br><div>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>' WHERE  idbusqueda_componente =280;

CREATE TABLE documento_limite (
	iddocumento_limite INT(10) NOT NULL auto_increment,
	fecha_cambio datetime NOT NULL,
	fecha_limite date NOT NULL,
	funcionario_idfuncionario INT(11) NOT NULL,
	documento_iddocumento INT(11) NOT NULL,
	observaciones TEXT NOT NULL,
	PRIMARY KEY( iddocumento_limite )
);	

/* ------------------------------------- */

UPDATE  busqueda_condicion SET  codigo_where = 'lower(d.estado)=''aprobado'' AND a.despachado=1 AND a.documento_iddocumento=d.iddocumento AND a.idft_radicacion_entrada=b.ft_radicacion_entrada AND a.tipo_destino IN(1,2) AND estado_item=1 {*condicion_adicional*}' WHERE  idbusqueda_condicion =213;

UPDATE  busqueda_condicion SET  codigo_where = 'lower(d.estado)=''aprobado'' AND a.despachado=1 AND a.documento_iddocumento=d.iddocumento AND a.idft_radicacion_entrada=b.ft_radicacion_entrada AND a.tipo_destino IN(1,2) AND estado_item=2 {*condicion_adicional*}' WHERE  idbusqueda_condicion =223;

UPDATE  busqueda_condicion SET  codigo_where = 'lower(d.estado)=''aprobado'' AND a.despachado=1 AND a.documento_iddocumento=d.iddocumento AND a.idft_radicacion_entrada=b.ft_radicacion_entrada AND a.tipo_destino IN(1,2) AND estado_item=3 {*condicion_adicional*}' WHERE  idbusqueda_condicion =224;

/* ------------------------------------- */

ALTER TABLE  configuracion ADD  encrypt INT NULL DEFAULT  '0'

UPDATE  busqueda_componente SET  info =  '<div>{*barra_superior_configuracion@idconfiguracion*}<br>
<b>Nombre: </b>{*nombre*}<br>
<b>Valor: </b>{*mostrar_valor_configuracion_encrypt@valor,encrypt*}<br>
<b>Tipo: </b>{*tipo*}<br>
<b>Fecha: </b>{*fecha*}
</div>' WHERE  idbusqueda_componente =84;

UPDATE  busqueda SET  campos =  'A.nombre,A.valor,A.tipo,A.fecha,A.encrypt' WHERE  idbusqueda =19;

UPDATE  configuracion SET  encrypt =  '1' WHERE  idconfiguracion =15;

UPDATE  configuracion SET  encrypt =  '1' WHERE  idconfiguracion =85;

UPDATE  configuracion SET  encrypt =  '1' WHERE  idconfiguracion =11;

/* ------------------------------------- */

UPDATE  busqueda_componente SET  acciones_seleccionados =  'vincular_documentos,carga_soporte_ingresados,transferir_docs' WHERE  idbusqueda_componente =18;
UPDATE  busqueda_componente SET  acciones_seleccionados =  'despachar_doc,despachar_fisico_doc,vincular_documentos,transferir_docs' WHERE  idbusqueda_componente =23;
UPDATE  busqueda_componente SET  acciones_seleccionados =  'vincular_documentos,transferir_docs' WHERE  idbusqueda_componente =239;
UPDATE  busqueda_componente SET  acciones_seleccionados =  'vincular_documentos,transferir_docs' WHERE  idbusqueda_componente =105;

/* ------------------------------------- */

CREATE TABLE IF NOT EXISTS version_notas (
  idversion_notas int(11) NOT NULL AUTO_INCREMENT,
  fecha datetime NOT NULL,
  funcionario_idfuncionario int(11) NOT NULL,
  observaciones text NOT NULL,
  fk_idversion_documento int(11) NOT NULL,
  PRIMARY KEY (idversion_notas)
);	

/* ------------------------------------- */

//VERIFICAR LOS IDS

INSERT INTO  busqueda ( idbusqueda ,nombre ,etiqueta ,estado ,ancho ,campos ,llave ,tablas ,ruta_libreria ,ruta_libreria_pantalla ,cantidad_registros ,tiempo_refrescar ,ruta_visualizacion ,tipo_busqueda ,badge_cantidades) VALUES (NULL ,  'radicacion_rapida_kaiten',  'Radicaci&oacute;n Rapida',  '1',  '200',  NULL, NULL , NULL , NULL , NULL ,  '30',  '500', 'formatos/radicacion_entrada/radicacion_rapida.php?idcategoria_formato=1&cmd=resetall',  '1', NULL);

INSERT INTO  busqueda_componente (idbusqueda_componente ,busqueda_idbusqueda ,tipo ,conector ,url ,etiqueta ,nombre ,orden ,info ,exportar ,exportar_encabezado ,encabezado_componente ,estado ,ancho ,cargar ,campos_adicionales ,tablas_adicionales ,ordenado_por ,direccion ,agrupado_por ,busqueda_avanzada ,acciones_seleccionados ,modulo_idmodulo ,menu_busqueda_superior ,enlace_adicionar ,encabezado_grillas) VALUES (
NULL ,  '107',  '2',  '2',  'formatos/radicacion_entrada/radicacion_rapida.php?idcategoria_formato=1&cmd=resetall',  'Radicaci&oacute;n Rapida',  'radicacion_rapida_kaiten',  '1', NULL , NULL , NULL , NULL ,  '2', '320',  '2', NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL);

UPDATE  modulo SET  enlace =  'pantallas/buscador_principal.php?idbusqueda=107' WHERE  idmodulo =24;

-----------
UPDATE modulo SET etiqueta='Acciones P&aacute;ginas del documento' WHERE nombre='ordenar_pag'
-----------
ALTER TABLE  `ejecutor` ADD  `tipo_ejecutor` INT NOT NULL DEFAULT  '1'
-----------
//VERIFICAR LOS IDS
ALTER TABLE  modulo ADD  pertenece_nucleo INT NOT NULL DEFAULT  '0' AFTER  idmodulo;	

INSERT INTO  modulo (idmodulo ,pertenece_nucleo ,nombre ,tipo ,imagen ,etiqueta ,enlace ,enlace_mobil ,destino ,cod_padre ,orden ,ayuda ,parametros ,busqueda_idbusqueda ,permiso_admin ,busqueda) VALUES (NULL ,  '1',  'permiso_radicacion_externa',  'secundario',  'botones/configuracion/default.gif',  'Radicaci&oacute;n Externa',  '#', NULL ,  '_self',  '6',  '0', 'Modulo creado para dar permiso a un funcionario si desean que realice radicaciones de origen externo', NULL ,  '0',  '0',  '');


----------

UPDATE  busqueda_condicion SET  codigo_where = 'lower(a.estado) not in(''eliminado'') AND  a.iddocumento=b.documento_iddocumento and b.etiqueta_idetiqueta=d.idetiqueta {*filtro_categoria@categoria*}  {*filtro_funcionario_etiquetados@funcionario*}' WHERE  `busqueda_condicion`.`idbusqueda_condicion` =183;

UPDATE busqueda_componente SET tablas_adicionales='documento_etiqueta b, etiqueta d' WHERE nombre LIkE 'documentos_etiquetados';

---------

UPDATE modulo SET  etiqueta =  'Opciones de la p&aacute;gina' WHERE  nombre ='ordenar_pag';

---------

ALTER TABLE  `modulo` ADD  `enlace_pantalla` INT( 11 ) NULL DEFAULT  '0'


----------------

UPDATE  modulo SET  enlace =  'formatos/radicacion_entrada/radicacion_rapida.php?idcategoria_formato=1',enlace_pantalla =  '1' WHERE  idmodulo =24;
UPDATE  modulo SET  enlace =  'cargo.php',enlace_pantalla =  '1' WHERE  idmodulo =12;
UPDATE  modulo SET  enlace =  'permiso_perfiladd.php',enlace_pantalla =  '1' WHERE  idmodulo =17;
UPDATE  modulo SET  enlace =  'rutalist.php',enlace_pantalla =  '1' WHERE idmodulo =63;
UPDATE  modulo SET  enlace =  'calendario/festivos_list.php',enlace_pantalla =  '1' WHERE idmodulo =200;
UPDATE  modulo SET  enlace =  'pantallas/logo/adicionar_logo.php',enlace_pantalla =  '1' WHERE  idmodulo =1188;
UPDATE  modulo SET  enlace =  'carrusel/sliderconfig.php',enlace_pantalla =  '1' WHERE idmodulo =821;
UPDATE  modulo SET  enlace =  'noticia_index/noticia_detalles.php',enlace_pantalla =  '1' WHERE  idmodulo =1402;
UPDATE  modulo SET  enlace_pantalla =  '1' WHERE  idmodulo =1641;
UPDATE  modulo SET  enlace_pantalla =  '1' WHERE idmodulo =1552;
UPDATE  modulo SET  enlace_pantalla =  '1' WHERE idmodulo =1522;
UPDATE  modulo SET  enlace_pantalla =  '1' WHERE  idmodulo =1141;
UPDATE  modulo SET  enlace_pantalla =  '1' WHERE  idmodulo =1142;
UPDATE  modulo SET  enlace =  'dependencia.php',enlace_pantalla =  '1' WHERE  idmodulo =16;
UPDATE  modulo SET  enlace =  'serielist.php',enlace_pantalla =  '1' WHERE  idmodulo =14;
UPDATE  modulo SET  enlace ='calidad_macro.php?from_modulo_calidad=1',enlace_pantalla =  '1' WHERE  idmodulo =202;


---------------
INSERT INTO busqueda_componente (idbusqueda_componente, busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre,orden, info,exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas) VALUES (NULL, '49', '3', '2', 'busquedas/consulta_busqueda.php', 'Vinculado  por el funcionario', 'documentos_relacionados_a', '1', '<div class="row-fluid"><div class="pull-left tooltip_saia_abajo" title="{*etiqueta*}">{*numero*}-{*obtener_descripcion_informacion@descripcion*}</div><div class=''pull-right''><a href="#" enlace=''ordenar.php?key={*documento_origen*}&mostrar_formato=1'' conector=''iframe''  titulo="Documento No.{*numero*}" class=''kenlace_saia pull-left'' ><i class=''icon-download tooltip_saia_izquierda'' title=''Ver documento''></i></a></div></div>
</div>', NULL, NULL, NULL, '1', '320', '1', 'F.fecha,F.documento_origen,F.documento_destino,F.funcionario_idfuncionario,F.observaciones,A.ejecutor,A.numero,A.iddocumento,A.descripcion', 'documento_vinculados F, documento A', 'F.fecha', 'DESC', NULL, NULL, NULL, NULL, NULL, NULL, NULL);


INSERT INTO busqueda_condicion (idbusqueda_condicion, busqueda_idbusqueda, fk_busqueda_componente, codigo_where, etiqueta_condicion) VALUES (NULL, NULL, '291', 'F.documento_origen=A.iddocumento AND F.documento_destino={*obtener_iddocumento*}', 'condicion_documentos_vinculados_a');

--------------
UPDATE busqueda_componente set direccion='ASC' WHERE direccion IS NULL;
--------------
delete modulo WHERE  nombre='indicadores_funcionario' and tipo='secundario' and etiqueta='Indicadores funcionario' and enlace='pantallas/buscador_principal.php?idbusqueda=1&default_componente=indicadores_funcionario';

UPDATE modulo SET etiqueta='Reporte usuarios' WHERE nombre='reporte_acceso_usuarios'; 

-------------
UPDATE formato SET etiqueta='Comunicaci&oacute;n Externa (WORD)' WHERE nombre='oficio_word' AND mostrar_pdf=2;
UPDATE modulo SET etiqueta='Comunicaci&oacute;n Externa (WORD)' WHERE nombre='oficio_word';
UPDATE modulo SET etiqueta='Crear Comunicaci&oacute;n Externa (WORD)' WHERE nombre='crear_oficio_word';
INSERT INTO serie ( nombre, cod_padre, dias_entrega, codigo, tipo_entidad, llave_entidad, retencion_gestion, retencion_central, conservacion, digitalizacion, seleccion, otro, procedimiento, copia, tipo, clase, estado, categoria, orden, tipo_expediente, tvd) VALUES ('Comunicaci&oacute;n Externa (WORD)', NULL, 8, NULL, NULL, NULL, 3, 5, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, 3, NULL, NULL, 0);
-------------
INSERT INTO modulo (pertenece_nucleo, nombre, tipo, imagen, etiqueta, enlace, enlace_mobil, destino, cod_padre, orden, ayuda, parametros, busqueda_idbusqueda, permiso_admin, busqueda, enlace_pantalla) VALUES 
(1, 'permiso_expedientes_gestion', 'secundario', 'botones/principal/defaut.png', 'Permiso Gesti&oacute;n', '#', NULL, '_self', 45, 0, '', '', 0, 0, '', 0),
(1, 'permiso_expedientes_central', 'secundario', 'botones/principal/defaut.png', 'Permiso Central', '#', NULL, '_self', 45, 0, '', '', 0, 0, '', 0),
(1, 'permiso_expedientes_historico', 'secundario', 'botones/principal/defaut.png', 'Permiso Hist&oacute;rico', '#', NULL, '_self', 45, 0, '', '', 0, 0, '', 0),
(1, 'permiso_expedientes_cajas', 'secundario', 'botones/principal/defaut.png', 'Permiso Cajas', '#', NULL, '_self', 45, 0, '', '', 0, 0, '', 0);

UPDATE  busqueda_componente SET  modulo_idmodulo =  '1644' WHERE  idbusqueda_componente =110;
UPDATE  busqueda_componente SET  modulo_idmodulo =  '1645' WHERE  idbusqueda_componente =10;
UPDATE  busqueda_componente SET  modulo_idmodulo =  '1646' WHERE  idbusqueda_componente =9;
UPDATE  busqueda_componente SET  modulo_idmodulo =  '1647' WHERE  idbusqueda_componente =160;
------------

UPDATE  busqueda_componente SET  direccion =  'DESC' WHERE  idbusqueda_componente =7;
UPDATE  busqueda_componente SET  ordenado_por =  'B.fecha_inicial',direccion='DESC' WHERE  idbusqueda_componente =12;
UPDATE  busqueda_componente SET  ordenado_por =  'B.fecha_inicial',direccion =  'DESC' WHERE  idbusqueda_componente =13;
UPDATE  busqueda_componente SET  direccion =  'DESC' WHERE  idbusqueda_componente =16;
UPDATE  busqueda_componente SET  direccion =  'DESC' WHERE  idbusqueda_componente =18;
UPDATE  busqueda_componente SET  direccion =  'DESC' WHERE  idbusqueda_componente =23;

----------

INSERT INTO campos_formato (formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, mascara, adicionales, autoguardado, fila_visible) VALUES
(305, 'estado_radicado', 'estado_radicado', 'INT', '11', 0, NULL, 'a,e,b', NULL, '1', NULL, 'hidden', 0, NULL, NULL, 0, 1);

INSERT INTO funciones_formato (nombre, nombre_funcion, parametros, etiqueta, descripcion, ruta, formato, acciones) VALUES
('{*cambiar_estado_iniciado_pqrsf*}', 'cambiar_estado_iniciado_pqrsf', NULL, 'cambiar_estado_iniciado_pqrsf', '', 'funciones.php', '305', ''),
('{*enlace_llenar_datos_radicacion_rapida_pqrsf*}', 'enlace_llenar_datos_radicacion_rapida_pqrsf', NULL, 'enlace_llenar_datos_radicacion_rapida_pqrsf', '', 'funciones.php', '305', 'm'),
('{*cambiar_estado_aprobado_pqrsf*}', 'cambiar_estado_aprobado_pqrsf', NULL, 'cambiar_estado_aprobado_pqrsf', '', 'funciones.php', '305', '');

INSERT INTO funciones_formato_accion (idfunciones_formato,accion_idaccion, formato_idformato, momento, estado, orden) VALUES
(934,3, 305, 'POSTERIOR', 1, 1),
(936,5, 305, 'POSTERIOR', 1, 1);

UPDATE formato SET cuerpo='<p style="text-align: left;">{*enlace_llenar_datos_radicacion_rapida_pqrsf*}</p>
<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="text-align: left; width: 20%;"><strong>&nbsp;Estado PQRSF</strong></td>
<td style="text-align: left; width: 25%;">&nbsp;{*estado_reporte*}</td>
<td style="text-align: left; width: 20%;">&nbsp;<strong>Fecha Cambio Estado</strong></td>
<td style="text-align: left; width: 15%;">&nbsp;{*ver_fecha_reporte*}</td>
<td style="text-align: center; width: 20%;" rowspan="5">{*generar_qr_pqrsf*}</td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;Tipo Comentario:</strong></td>
<td style="text-align: left;" colspan="3">&nbsp;{*tipo*}<strong></strong></td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;Nombre Completo:</strong></td>
<td>&nbsp;{*nombre*}</td>
<td>&nbsp;<strong>Documento:</strong></td>
<td>&nbsp;{*documento*}</td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;Email:&nbsp;</strong></td>
<td style="text-align: left;">&nbsp;{*email*}</td>
<td style="text-align: left;">&nbsp;<strong>Telefono o Celular:</strong></td>
<td style="text-align: left;">&nbsp;{*telefono*}</td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;<strong>Rol en la Insitucion:</strong></strong></td>
<td style="text-align: left;" colspan="3">&nbsp;{*rol_institucion*}</td>
</tr>
<tr>
<td style="text-align: left;" colspan="5"><strong>&nbsp;Comentario:</strong></td>
</tr>
<tr>
<td colspan="5">&nbsp;{*comentarios*}</td>
</tr>
<tr>
<td colspan="5">&nbsp;<strong>Documento Soporte del Comentario:&nbsp;</strong>{*mostrar_anexos_pqrsf*}<strong></strong></td>
</tr>
</tbody>
</table>
<p>{*mostrar_datos_hijos*}</p>
<p>{*mostrar_estado_proceso*}</p>' WHERE idformato=305;

DELETE FROM campos_formato WHERE nombre='iniciativa_publica' AND formato_idformato=305;
DELETE FROM campos_formato WHERE nombre='sector_iniciativa' AND formato_idformato=305;
DELETE FROM campos_formato WHERE nombre='cluster' AND formato_idformato=305;
DELETE FROM campos_formato WHERE nombre='region' AND formato_idformato=305;

--------------------------
UPDATE campos_formato SET  ayuda ='Comunicaci&oacute;n Externa (WORD)',predeterminado='1332' WHERE  idcampos_formato =4796;
--------------------------
UPDATE  busqueda_condicion SET  codigo_where = 'F.documento_destino=A.iddocumento AND F.documento_origen={*obtener_iddocumento*} AND lower(A.estado) NOT IN(''eliminado'',''anulado'')' WHERE  idbusqueda_condicion =131;

UPDATE  busqueda_condicion SET  codigo_where =  'G.destino=A.iddocumento AND G.origen={*obtener_iddocumento*} AND lower(A.estado) NOT IN(''eliminado'',''anulado'')' WHERE  idbusqueda_condicion =133;

UPDATE  busqueda_condicion SET  codigo_where = 'F.documento_origen=A.iddocumento AND F.documento_destino={*obtener_iddocumento*} AND lower(A.estado) NOT IN(''eliminado'',''anulado'')' WHERE  idbusqueda_condicion =229;
--------------------------
INSERT INTO busqueda_componente (busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas) VALUES
(7, 3, 2, 'pantallas/busquedas/consulta_busqueda_documento.php', 'pendiente por ingresar PQRSF', 'pendientes_ingresar_pqrsf', 1, '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<br><br><div>{*descripcion*}</div><br><br>\r\n{*barra_inferior_documento@iddocumento,numero*}</div>', '', NULL, NULL, 1, 320, 2, NULL, 'ft_pqrsf B', 'A.fecha', 'DESC', NULL, NULL, 'vincular_documentos', NULL, NULL, NULL, NULL);

INSERT INTO  busqueda_condicion (busqueda_idbusqueda ,fk_busqueda_componente ,codigo_where ,etiqueta_condicion) VALUES (NULL ,  '298',  'lower(a.estado)=''iniciado'' AND a.iddocumento=b.documento_iddocumento', NULL);

---------------------------
//MODIFICACIONES BD POSTERIOR AL PASO DE BASE DE DATOS DE MYSQL A ORACLE (ERRORES DETECTADOS DURANTE EL PASO DE BD)

ALTER TABLE  accion CHANGE  ruta  ruta VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL

ALTER TABLE  accion CHANGE  funcion  funcion VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL

ALTER TABLE  asignacion CHANGE  fecha_inicial  fecha_inicial DATETIME NULL

ALTER TABLE  busquedas CHANGE  tipo  tipo VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT  ''

ALTER TABLE  buzon_entrada CHANGE  fecha  fecha DATETIME NULL DEFAULT  '0000-00-00 00:00:00'

ALTER TABLE  calendario_saia CHANGE  fecha  fecha DATE NULL DEFAULT  '0000-00-00'

ALTER TABLE  calendario_saia CHANGE  estilo  estilo VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL

ALTER TABLE  calendario_saia CHANGE  adicionar_evento  adicionar_evento VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL

ALTER TABLE  configuracion CHANGE  fecha  fecha TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP

ALTER TABLE  configuracion CHANGE  tipo  tipo VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT  ''

ALTER TABLE  contenidos_carrusel CHANGE  miniatura  miniatura VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL

ALTER TABLE  funcionario CHANGE  mensajeria  mensajeria CHAR( 1 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL

ALTER TABLE  funcionario CHANGE  ultimo_pwd  ultimo_pwd DATETIME NULL DEFAULT  '0000-00-00 00:00:00'

ALTER TABLE  funcionario CHANGE  fecha_ingreso  fecha_ingreso TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP

ALTER TABLE  funcionario_editor CHANGE  email_contrasena  email_contrasena VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL

ALTER TABLE  funciones_paso CHANGE  parametros  parametros VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL

ALTER TABLE  modulo CHANGE  imagen  imagen VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT  'botones/configuracion/default.gif'

ALTER TABLE  paso CHANGE  posicion  posicion VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL

ALTER TABLE  paso CHANGE  plazo_paso  plazo_paso VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL

ALTER TABLE  paso_condicional CHANGE  etiqueta  etiqueta VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL

ALTER TABLE  tareas_listado CHANGE  prioridad  prioridad VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL

ALTER TABLE  tareas_planeadas CHANGE  fecha_planeada  fecha_planeada DATETIME NULL

UPDATE buzon_entrada SET origen='-1' WHERE origen='';

UPDATE  funciones_formato SET  etiqueta =  'Ver campo estado' WHERE  idfunciones_formato =694;

UPDATE funciones_formato_accion SET momento='ANTERIOR' WHERE momento ='';

UPDATE modulo SET enlace='#' WHERE enlace='';


CREATE OR REPLACE VIEW vdependencia_serie AS select concat(d.codigo,'.',s.codigo) AS orden_dependencia_serie,d.nombre AS dependencia,s.idserie AS idserie,d.iddependencia AS iddependencia,s.nombre AS nombre,(case s.estado when 1 then 'Activo' else 'Inactivo' end) AS estado,s.codigo AS codigo,(case s.tipo when 1 then 'Serie' when 2 then 'Subserie' else 'Tipo documental' end) AS tipo,s.tipo AS tipo_serie,s.retencion_gestion AS retencion_gestion,s.retencion_central AS retencion_central,s.conservacion AS conservacion,s.seleccion AS seleccion,s.digitalizacion AS digitalizacion,s.procedimiento AS procedimiento,s.tvd AS tvd from serie s , dependencia d , entidad_serie e where ((e.serie_idserie = s.idserie) and (e.llave_entidad = d.iddependencia) and (s.categoria = 2) and (d.tipo = 1));

CREATE OR REPLACE VIEW vdocumento AS select A.iddocumento AS iddocumento,A.estado AS estado,A.descripcion AS descripcion,B.nombre AS serie,A.fecha AS fecha,A.tipo_radicado AS tipo_radicado,A.plantilla AS plantilla from documento A , serie B where (A.serie = B.idserie);
---------------------------

UPDATE  campos_formato SET  tipo_dato =  'VARCHAR' WHERE  idcampos_formato =5065;

UPDATE  campos_formato SET  longitud =  '255' WHERE  idcampos_formato =5065;

UPDATE  campos_formato SET  tipo_dato =  'VARCHAR' WHERE  idcampos_formato =5039;

UPDATE  campos_formato SET  longitud =  '255' WHERE  idcampos_formato =5039;

CREATE OR REPLACE VIEW vexpediente AS select A.idexpediente AS idexpediente,A.nombre AS nombre,A.fecha AS fecha,A.descripcion AS descripcion,A.codigo AS codigo,A.cod_padre AS cod_padre,A.propietario AS propietario,A.ver_todos AS ver_todos,A.editar_todos AS editar_todos,B.idexpediente_doc AS idexpediente_doc,B.documento_iddocumento AS documento_iddocumento,B.fecha AS fecha_ed from expediente A , expediente_doc B where (A.idexpediente = B.expediente_idexpediente) group by A.idexpediente;

CREATE OR REPLACE VIEW vreporte_inventario AS select documento_iddocumento AS documento_iddocumento,ubicacion AS ubicacion,numero_caja AS numero_caja,fecha_extrema_inicia AS fecha_extrema_inicia,fecha_extrema_final AS fecha_extrema_final,folios AS folios,observaciones AS observaciones from ft_inventario_retirados union select documento_iddocumento AS documento_iddocumento,ubicacion AS ubicacion,numero_caja AS numero_caja,fecha_extrema_inicia AS fecha_extrema_inicia,fecha_extrema_final AS fecha_extrema_final,folios AS folios,observaciones AS observaciones from ft_inventario_jubilados;

ALTER TABLE  contenidos_carrusel CHANGE  contenido  contenido TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL;

UPDATE  busqueda_condicion SET  codigo_where =  'a.cod_padre IS NULL OR a.cod_padre='''' OR cod_padre=0' WHERE idbusqueda_condicion=118;

----------------------------

UPDATE  campos_formato SET  valor =  '../../test.php?iddependencia=75&rol=1&agrupar=1;1;0;1;1;0;0' WHERE  idcampos_formato=4999;

----------------------------

UPDATE busqueda_componente SET info='Radicado|{*ver_items@iddocumento,numero,fecha_radicacion_entrada,tipo_radicado*}|center|-|No. Item|{*numero_item*}|center|-|Tramite|{*mostrar_tramite_radicacion@idft_destino_radicacion,tipo_mensajeria,estado_recogida*}|center|-|Mensajero|{*mostrar_mensajeros_dependencia@idft_destino_radicacion*}|center|-|Planilla Asociada|{*planilla_mensajero@idft_destino_radicacion,mensajero_encargado*}|center|-|Generar planilla|{*planilla_mensajero2@idft_destino_radicacion,mensajero_encargado*}|center|-|Finalizar Tr&aacute;mite|{*aceptar_recepcion@idft_destino_radicacion*}|center|-|Tipo de origen|{*mostrar_tipo_origen_reporte@tipo_origen*}|center|-|Fecha de Radicaci&oacute;n|{*fecha_radicacion_entrada*}|center|-|Asunto|{*descripcion*}|left|-|Origen|{*mostrar_origen_reporte@idft_radicacion_entrada*}|center|-|Destino|{*mostrar_destino_reporte@idft_destino_radicacion*}|center|-|Observaciones|{*observacion_destino*}|left|-|Ruta|{*mostrar_ruta_reporte@idft_destino_radicacion*}|left|-|Descripci&oacute;n o Asunto|{*descripcion*}|center|-|Estado|{*estado_item*}|center' WHERE idbusqueda_componente=281;	

----------------------------
INSERT INTO funciones_formato_accion (idfunciones_formato_accion, idfunciones_formato, accion_idaccion, formato_idformato, momento, estado, orden) VALUES
(300, 609, 5, 305, 'POSTERIOR', 1, 1);
----------------------------
UPDATE campos_formato SET acciones=NULL WHERE idcampos_formato=34 AND formato_idformato=2;
DELETE FROM funciones_formato WHERE nombre_funcion='seleccionar_origen';
----------------------------
UPDATE modulo SET tipo='secundario' WHERE  nombre='radicacion_entrada_formulario' AND tipo='1';
----------------------------
CREATE TABLE IF NOT EXISTS cf_empresa_trans (
  idcf_empresa_trans int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(255) DEFAULT NULL,
  valor varchar(255) DEFAULT NULL,
  cod_padre varchar(255) DEFAULT NULL,
  descripcion varchar(255) DEFAULT NULL,
  tipo varchar(255) DEFAULT NULL,
  categoria varchar(255) DEFAULT NULL,
  estado int(11) DEFAULT NULL,
  PRIMARY KEY (idcf_empresa_trans)
);

UPDATE busqueda SET nombre='configuracion',etiqueta='Configuracion',estado=1,ancho=200,campos='',llave='',tablas='',ruta_libreria='pantallas/configuracion/librerias.php,pantallas/admin_cf/librerias.php',ruta_libreria_pantalla=NULL,cantidad_registros=10,tiempo_refrescar=500,ruta_visualizacion='pantallas/busquedas/consulta_busqueda_reporte.php',tipo_busqueda=2,badge_cantidades=NULL WHERE idbusqueda=19

UPDATE busqueda_componente SET busqueda_idbusqueda=19, tipo=3, conector=2, url='pantallas/busquedas/consulta_busqueda_reporte.php', etiqueta='Configuracion', nombre='configuracion', orden=1, info='Nombre|{*nombre*}|center|-|Valor|{*mostrar_valor_configuracion_encrypt@valor,encrypt*}|center|-|Tipo|{*tipo*}|center|-|Fecha|{*fecha*}|center|-|Acciones|{*barra_superior_configuracion@idconfiguracion*}|center', exportar=NULL, exportar_encabezado=NULL, encabezado_componente='', estado=2, ancho=320, cargar=2, campos_adicionales='A.idconfiguracion,A.nombre,A.valor,A.tipo,A.fecha,A.encrypt', tablas_adicionales='configuracion A', ordenado_por='A.nombre', direccion='ASC', agrupado_por=NULL, busqueda_avanzada='pantallas/configuracion/busqueda_avanzada_configuracion.php', acciones_seleccionados=NULL, modulo_idmodulo=NULL, menu_busqueda_superior=NULL, enlace_adicionar='configuracionadd.php', encabezado_grillas=NULL WHERE idbusqueda_componente=84

INSERT INTO busqueda_componente (busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas) VALUES
(19, 3, 2, 'pantallas/busquedas/consulta_busqueda_reporte.php', 'Empresas Transportadoras', 'cf_empresa_trans', 2, 'Nombre|{*nombre*}|center|-|Valor|{*valor*}|center|-|Categoria|{*categoria*}|center|-|Estado|{*estado*}|center|-|Acciones|{*barra_superior_cf@idcf_empresa_trans,nombre_tabla*}|center', NULL, NULL, '', 2, 320, 2, 'idcf_empresa_trans,nombre,valor,categoria, case estado when 1 then ''activo'' else ''inactivo'' end as estado, ''cf_empresa_trans'' as nombre_tabla', 'cf_empresa_trans', 'nombre', 'ASC', NULL, 'pantallas/admin_cf/busqueda_avanzada_cf.php?tabla=cf_empresa_trans&idbusqueda_componente=299', NULL, NULL, NULL, 'pantallas/admin_cf/pantalla_cf_adicionar.php?tabla=cf_empresa_trans', NULL);

INSERT INTO busqueda_condicion (busqueda_idbusqueda, fk_busqueda_componente, codigo_where, etiqueta_condicion) VALUES
(NULL, 299, '1=1', 'cf_empresa_trans');

UPDATE  campos_formato SET  valor =  'SELECT idcf_empresa_trans as id, nombre as nombre FROM cf_empresa_trans WHERE estado=1' WHERE  idcampos_formato =5084 AND formato_idformato=3;
----------------------------
ALTER TABLE  asignacion CHANGE  serie_idserie  serie_idserie INT( 11 ) NULL;
----------------------------
ALTER TABLE  formato ADD  permite_imprimir INT( 11 ) NULL DEFAULT  '1';
----------------------------
UPDATE  campos_formato SET  valor =  'select iddependencia_cargo AS id, concat(nombres,'' '',apellidos) AS nombre from vfuncionario_dc where lower(cargo)=''mensajero'' AND estado_dc=1' WHERE idcampos_formato =5005;

UPDATE campos_formato SET valor='select iddependencia_cargo AS id, concat(nombres,'' '',apellidos) AS nombre from vfuncionario_dc where lower(cargo)=''mensajero'' AND estado_dc=1', etiqueta_html='select' WHERE idcampos_formato=4999;
----------------------------
UPDATE  campos_formato SET  obligatoriedad =  '0' WHERE  idcampos_formato=5088;
----------------------------
UPDATE  busqueda_componente SET  busqueda_avanzada =  'pantallas/configuracion/busqueda_avanzada_configuracion.php?idbusqueda_componente=84' WHERE  idbusqueda_componente=84;
----------------------------
CREATE TABLE IF NOT EXISTS tarea_dig (
  idtarea_dig int(11) NOT NULL AUTO_INCREMENT,
  idfuncionario int(11) NOT NULL,
  iddocumento int(11) NOT NULL,
  estado int(11) NOT NULL DEFAULT '1',
  fecha datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  direccion_ip varchar(20) DEFAULT NULL,
  PRIMARY KEY (idtarea_dig)
);
----------------------------
//Se modifica la pantalla en la que se ejecuta la funcion mostrar_solicitante del formato solicitud prestamo
update funciones_formato set acciones='e' where nombre_funcion='mostrar_solicitante';

-- CREAR TABLA DE CONFIGURACION PARA INDICES NECESARIOS DIFERENTES A ID<TABLA>, DOCUMENTO_IDDOCUMENTO
CREATE TABLE IF NOT EXISTS cf_indice_saia(
	idcf_indice_saia int(11) NOT NULL AUTO_INCREMENT,
	tablespace_name varchar(255) NOT NULL,
       	table_name varchar(255) NOT NULL,
       	column_name varchar(255) NOT NULL,
	PRIMARY KEY (idcf_indice_saia)
);
-- -------------------------------
INSERT INTO  configuracion (nombre ,valor ,tipo ,fecha ,encrypt) VALUES ('tipo_ftp','sftp','ftp',CURRENT_TIMESTAMP ,'0');

-- ------------------------------
// OJO CON "IP_LOCAL_DE_DONDE_SE_EJECUTA_LA_TAREA_PROGRAMADA"
INSERT INTO configuracion(nombre,valor,tipo,fecha,encrypt) VALUES ('ip_valida_ws','IP_LOCAL_DE_DONDE_SE_EJECUTA_LA_TAREA_PROGRAMADA','empresa',CURRENT_TIMESTAMP ,'0');

-- ------------------------------

insert into encabezado_formato (idencabezado_formato,contenido,etiqueta) values (47,'<table style="border-collapse: collapse; width: 115%;" border="0">
<tbody>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td style="border-collapse: collapse; width: 6.3%;">&nbsp;</td>
<td style="border-collapse: collapse; width: 102.8%;">
<table style="border-collapse: collapse; width: 102.8%;" border="1">
<tbody>
<tr>
<td style="text-align: center; width: 27.75%;"><span><br />{*logo_empresa*}</span></td>
<td style="text-align: center; width: 58.8%;"><strong><br />PLANILLA DE MENSAJERIA - DIVISON DE ADMINISTRACION DE BIENES Y SERVICIOS - SECCION DE GESTION DOCUMENTAL</strong></td>
<td style="text-align: center; width: 13%;"><br /><br />{*qr_entrega_interna*}</td>
</tr>
<tr>
<td><strong>Auxiliar de Oficina:&nbsp;</strong>{*mensajero_entrega_interna*}</td>
<td><strong>Recorrido del Dia: </strong>{*recorrido*}<strong> - Fecha Planilla:&nbsp;</strong>{*fecha_planilla*}</td>
<td style="text-align: center;">Pagina ##PAGE## de ##PAGES##</td>
</tr>
</tbody>
</table>
</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td style="border-collapse: collapse; width: 6.3%;">&nbsp;</td>
<td colspan="5">
<table style="border-collapse: collapse;" border="1">
<tbody>
<tr>
<td style="text-align: center; width: 4.8%;"><strong>TRAMITE</strong></td>
<td style="text-align: center; width: 2%;"><strong>TIPO</strong></td>
<td style="text-align: center; width: 2.1%;"><strong>Rad. Item</strong></td>
<td style="text-align: center; width: 3.5%;"><strong>FECHA DE RECIBO</strong></td>
<td style="text-align: center; width: 6.8%;"><strong>ORIGEN</strong></td>
<td style="text-align: center; width: 10.3%;"><strong>DESTINO</strong></td>
<td style="text-align: center; width: 10.4%;"><strong>ASUNTO</strong></td>
<td style="text-align: center; width: 6.9%;"><strong>NOTAS</strong></td>
<td style="text-align: center; width: 10.2%;"><strong>FIRMA DE QUIEN RECIBE</strong></td>
<td style="text-align: center; width: 11.84%;"><strong>OBSERVACIONES</strong></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>','encabezado_despacho');

update formato set margenes='15,20,52,20',encabezado=47 where idformato=353;

INSERT INTO `funciones_formato` (`nombre`, `nombre_funcion`, `parametros`, `etiqueta`, `descripcion`, `ruta`, `formato`, `acciones`) VALUES
('{*mensajero_entrega_interna*}', 'mensajero_entrega_interna', NULL, 'mensajero_entrega_interna', '', 'funciones.php', '353', 'm'),
('{*recorrido*}', 'recorrido', NULL, 'recorrido', '', 'funciones.php', '353', 'm'),
('{*fecha_planilla*}', 'fecha_planilla', NULL, 'fecha_planilla', '', 'funciones.php', '353', 'm'),
('{*qr_entrega_interna*}', 'qr_entrega_interna', NULL, 'qr_entrega_interna', NULL, 'funciones.php', '353', 'm');

-- ------------------------------------------------------------------------------------------------------------------
UPDATE campos_formato SET valor='1,Servicio de Mensajeria;3,Entrega personal/Medios Propios del &Aacute;rea' WHERE  nombre='tipo_mensajeria' AND formato_idformato=3;


INSERT INTO campos_formato (idcampos_formato, formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, mascara, adicionales, autoguardado, fila_visible) VALUES (NULL, '403', 'tipo_mensajero', 'tipo_mensajero', 'VARCHAR', '255', '0', NULL, 'a,e,b', NULL, 'i', NULL, 'hidden', '0', NULL, NULL, '0', '1');


INSERT INTO campos_formato (idcampos_formato, formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, mascara, adicionales, autoguardado, fila_visible) VALUES (NULL, '353', 'tipo_mensajero', 'tipo_mensajero', 'VARCHAR', '255', '0', NULL, 'a,e,b', NULL, 'i', NULL, 'hidden', '0', NULL, NULL, '0', '1');


	--   DESPUES DE GENERAR LOS FORMATOS INVOLUCRADOS CORRER --------------------------------------------


	UPDATE ft_despacho_ingresados SET tipo_mensajero='i' WHERE tipo_mensajero='0';
	UPDATE ft_destino_radicacion SET tipo_mensajero='i' WHERE tipo_mensajero='0';


-- ----------------------------------------------------------------

	UPDATE `saia_release1`.`busqueda_componente` SET `info` = 'Radicado|{*ver_items@iddocumento,numero,fecha_radicacion_entrada,tipo_radicado*}|center|-|No. Item|{*numero_item*}|center|-|Estado|{*mostrar_estado_destino_radicacion@idft_destino_radicacion*}|center|-|Diligencia|{*mostrar_tramite_radicacion@idft_destino_radicacion,tipo_mensajeria,estado_recogida*}|center|-|Ruta|{*mostrar_ruta_reporte@idft_destino_radicacion*}|center|-|Mensajero|{*mostrar_mensajeros_dependencia@idft_destino_radicacion*}|center|-|Planilla Asociada|{*planilla_mensajero@idft_destino_radicacion,mensajero_encargado*}|center|-|Acci&oacute;n|{*generar_accion_destino_radicacion@idft_destino_radicacion,mensajero_encargado,estado_item*}|center|-|Origen|{*mostrar_origen_reporte@idft_radicacion_entrada*}|center|-|Destino|{*mostrar_destino_reporte@idft_destino_radicacion*}|center|-|Fecha de Radicaci&oacute;n|{*fecha_radicacion_entrada*}|center|-|Asunto|{*descripcion*}|left|-|Observaciones|{*observacion_destino*}|left' WHERE `busqueda_componente`.`idbusqueda_componente` = 279;
	
	UPDATE `saia_release1`.`busqueda_componente` SET `info` = 'Radicado|{*ver_items@iddocumento,numero,fecha_radicacion_entrada,tipo_radicado*}|center|-|No. Item|{*numero_item*}|center|-|Estado|{*mostrar_estado_destino_radicacion@idft_destino_radicacion*}|center|-|Diligencia|{*mostrar_tramite_radicacion@idft_destino_radicacion,tipo_mensajeria,estado_recogida*}|center|-|Ruta|{*mostrar_ruta_reporte@idft_destino_radicacion*}|center|-|Mensajero|{*mostrar_mensajeros_dependencia@idft_destino_radicacion*}|center|-|Planilla Asociada|{*planilla_mensajero@idft_destino_radicacion,mensajero_encargado*}|center|-|Acci&oacute;n|{*generar_accion_destino_radicacion_endistribucion@idft_destino_radicacion,mensajero_encargado,estado_item*}|center|-|Origen|{*mostrar_origen_reporte@idft_radicacion_entrada*}|center|-|Destino|{*mostrar_destino_reporte@idft_destino_radicacion*}|center|-|Fecha de Radicaci&oacute;n|{*fecha_radicacion_entrada*}|center|-|Asunto|{*descripcion*}|left|-|Observaciones|{*observacion_destino*}|left' WHERE `busqueda_componente`.`idbusqueda_componente` = 281;	
	
	UPDATE  `saia_release1`.`busqueda_componente` SET  `info` = 'Radicado|{*ver_items@iddocumento,numero,fecha_radicacion_entrada,tipo_radicado*}|center|-|No. Item|{*numero_item*}|center|-|Estado|{*mostrar_estado_destino_radicacion@idft_destino_radicacion*}|center|-|Diligencia|{*mostrar_tramite_radicacion@idft_destino_radicacion,tipo_mensajeria,estado_recogida*}|center|-|Ruta|{*mostrar_ruta_reporte@idft_destino_radicacion*}|center|-|Mensajero|{*mostrar_mensajeros_dependencia@idft_destino_radicacion,estado_item*}|center|-|Planilla Asociada|{*planilla_mensajero@idft_destino_radicacion,mensajero_encargado*}|center|-|Origen|{*mostrar_origen_reporte@idft_radicacion_entrada*}|center|-|Destino|{*mostrar_destino_reporte@idft_destino_radicacion*}|center|-|Fecha de Radicaci&oacute;n|{*fecha_radicacion_entrada*}|center|-|Asunto|{*descripcion*}|left|-|Observaciones|{*observacion_destino*}|left' WHERE  `busqueda_componente`.`idbusqueda_componente` =282;
	
	-- ---------------
	
	UPDATE  `saia_release1`.`busqueda_componente` SET  `acciones_seleccionados` =  'filtrar_mensajero,select_finalizar_generar_item' WHERE  `busqueda_componente`.`idbusqueda_componente` =279;
	UPDATE  `saia_release1`.`busqueda_componente` SET  `acciones_seleccionados` =  'filtrar_mensajero,select_finalizar_generar_item' WHERE  `busqueda_componente`.`idbusqueda_componente` =281;

	INSERT INTO `saia_release1`.`cargo` (`idcargo`, `nombre`, `cod_padre`, `estado`, `codigo_cargo`, `tipo`, `tipo_cargo`) VALUES (NULL, 'ADMINISTRADOR DE MENSAJER&Iacute;A', '82', '1', '', '1', '2');
-- ----------------------------------------------------------------

UPDATE campos_formato SET tipo_dato='TEXT', longitud=NULL WHERE nombre='asignar_dependencias' AND formato_idformato=404;	

-- ----------------------------------------------------------------

UPDATE formato SET exportar='tcpdf';

-- ----------------------------------------------------------------

UPDATE encabezado_formato SET contenido='

<table style="border-collapse: collapse; width: 102.8%;" border="1">
<tbody>
<tr>
<td style="text-align: center; width: 27.75%;"><span><br />{*logo_empresa*}</span></td>
<td style="text-align: center; width: 58.8%;"><strong><br /><br />PLANILLA DE MENSAJERIA<br />DIVISON DE ADMINISTRACION DE BIENES Y SERVICIOS - SECCION DE GESTION DOCUMENTAL</strong></td>
<td style="text-align: center; width: 13%;"><br /><br />{*qr_entrega_interna*}</td>
</tr>
<tr>
<td><strong>Auxiliar de Oficina:&nbsp;</strong>{*mensajero_entrega_interna*}</td>
<td><strong>Recorrido del Dia: </strong>{*recorrido*}<strong> - Fecha Planilla:&nbsp;</strong>{*fecha_planilla*}</td>
<td style="text-align: center;">Pagina {PAGENO}</td>
</tr>
</tbody>
</table>' WHERE etiqueta='encabezado_despacho';

-- -----------------------------------------------------------------
UPDATE formato SET exportar='mpdf' WHERE nombre='despacho_ingresados';
-- ----------------------------------------------------------------
UPDATE campos_formato SET tipo_dato='TEXT', longitud=NULL WHERE nombre IN('destino','copia_a') AND formato_idformato=3;
-- ----------------------------------------------------------------
UPDATE busqueda SET cantidad_registros = '100' WHERE idbusqueda = 103;
-- ----------------------------------------------------------------
