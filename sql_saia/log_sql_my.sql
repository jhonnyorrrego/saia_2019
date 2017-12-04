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

-- VERIFICAR LOS IDS

INSERT INTO  busqueda ( idbusqueda ,nombre ,etiqueta ,estado ,ancho ,campos ,llave ,tablas ,ruta_libreria ,ruta_libreria_pantalla ,cantidad_registros ,tiempo_refrescar ,ruta_visualizacion ,tipo_busqueda ,badge_cantidades) VALUES (NULL ,  'radicacion_rapida_kaiten',  'Radicaci&oacute;n Rapida',  '1',  '200',  NULL, NULL , NULL , NULL , NULL ,  '30',  '500', 'formatos/radicacion_entrada/radicacion_rapida.php?idcategoria_formato=1&cmd=resetall',  '1', NULL);

INSERT INTO  busqueda_componente (idbusqueda_componente ,busqueda_idbusqueda ,tipo ,conector ,url ,etiqueta ,nombre ,orden ,info ,exportar ,exportar_encabezado ,encabezado_componente ,estado ,ancho ,cargar ,campos_adicionales ,tablas_adicionales ,ordenado_por ,direccion ,agrupado_por ,busqueda_avanzada ,acciones_seleccionados ,modulo_idmodulo ,menu_busqueda_superior ,enlace_adicionar ,encabezado_grillas) VALUES (
NULL ,  '107',  '2',  '2',  'formatos/radicacion_entrada/radicacion_rapida.php?idcategoria_formato=1&cmd=resetall',  'Radicaci&oacute;n Rapida',  'radicacion_rapida_kaiten',  '1', NULL , NULL , NULL , NULL ,  '2', '320',  '2', NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL);

UPDATE  modulo SET  enlace =  'pantallas/buscador_principal.php?idbusqueda=107' WHERE  idmodulo =24;

-----------
UPDATE modulo SET etiqueta='Acciones P&aacute;ginas del documento' WHERE nombre='ordenar_pag'
-----------
ALTER TABLE  ejecutor ADD  tipo_ejecutor INT NOT NULL DEFAULT  '1'
-----------
-- VERIFICAR LOS IDS
ALTER TABLE  modulo ADD  pertenece_nucleo INT NOT NULL DEFAULT  '0' AFTER  idmodulo;	

INSERT INTO  modulo (idmodulo ,pertenece_nucleo ,nombre ,tipo ,imagen ,etiqueta ,enlace ,enlace_mobil ,destino ,cod_padre ,orden ,ayuda ,parametros ,busqueda_idbusqueda ,permiso_admin ,busqueda) VALUES (NULL ,  '1',  'permiso_radicacion_externa',  'secundario',  'botones/configuracion/default.gif',  'Radicaci&oacute;n Externa',  '#', NULL ,  '_self',  '6',  '0', 'Modulo creado para dar permiso a un funcionario si desean que realice radicaciones de origen externo', NULL ,  '0',  '0',  '');


----------

UPDATE  busqueda_condicion SET  codigo_where = 'lower(a.estado) not in(''eliminado'') AND  a.iddocumento=b.documento_iddocumento and b.etiqueta_idetiqueta=d.idetiqueta {*filtro_categoria@categoria*}  {*filtro_funcionario_etiquetados@funcionario*}' WHERE  busqueda_condicion.idbusqueda_condicion =183;

UPDATE busqueda_componente SET tablas_adicionales='documento_etiqueta b, etiqueta d' WHERE nombre LIkE 'documentos_etiquetados';

---------

UPDATE modulo SET  etiqueta =  'Opciones de la p&aacute;gina' WHERE  nombre ='ordenar_pag';

---------

ALTER TABLE  modulo ADD  enlace_pantalla INT( 11 ) NULL DEFAULT  '0'


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
-- MODIFICACIONES BD POSTERIOR AL PASO DE BASE DE DATOS DE MYSQL A ORACLE (ERRORES DETECTADOS DURANTE EL PASO DE BD)

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
-- Se modifica la pantalla en la que se ejecuta la funcion mostrar_solicitante del formato solicitud prestamo
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
--  OJO CON "IP_LOCAL_DE_DONDE_SE_EJECUTA_LA_TAREA_PROGRAMADA"
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

INSERT INTO funciones_formato (nombre, nombre_funcion, parametros, etiqueta, descripcion, ruta, formato, acciones) VALUES
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

	UPDATE saia_release1.busqueda_componente SET info = 'Radicado|{*ver_items@iddocumento,numero,fecha_radicacion_entrada,tipo_radicado*}|center|-|No. Item|{*numero_item*}|center|-|Estado|{*mostrar_estado_destino_radicacion@idft_destino_radicacion*}|center|-|Diligencia|{*mostrar_tramite_radicacion@idft_destino_radicacion,tipo_mensajeria,estado_recogida*}|center|-|Ruta|{*mostrar_ruta_reporte@idft_destino_radicacion*}|center|-|Mensajero|{*mostrar_mensajeros_dependencia@idft_destino_radicacion*}|center|-|Planilla Asociada|{*planilla_mensajero@idft_destino_radicacion,mensajero_encargado*}|center|-|Acci&oacute;n|{*generar_accion_destino_radicacion@idft_destino_radicacion,mensajero_encargado,estado_item*}|center|-|Origen|{*mostrar_origen_reporte@idft_radicacion_entrada*}|center|-|Destino|{*mostrar_destino_reporte@idft_destino_radicacion*}|center|-|Fecha de Radicaci&oacute;n|{*fecha_radicacion_entrada*}|center|-|Asunto|{*descripcion*}|left|-|Observaciones|{*observacion_destino*}|left' WHERE busqueda_componente.idbusqueda_componente = 279;
	
	UPDATE saia_release1.busqueda_componente SET info = 'Radicado|{*ver_items@iddocumento,numero,fecha_radicacion_entrada,tipo_radicado*}|center|-|No. Item|{*numero_item*}|center|-|Estado|{*mostrar_estado_destino_radicacion@idft_destino_radicacion*}|center|-|Diligencia|{*mostrar_tramite_radicacion@idft_destino_radicacion,tipo_mensajeria,estado_recogida*}|center|-|Ruta|{*mostrar_ruta_reporte@idft_destino_radicacion*}|center|-|Mensajero|{*mostrar_mensajeros_dependencia@idft_destino_radicacion*}|center|-|Planilla Asociada|{*planilla_mensajero@idft_destino_radicacion,mensajero_encargado*}|center|-|Acci&oacute;n|{*generar_accion_destino_radicacion_endistribucion@idft_destino_radicacion,mensajero_encargado,estado_item*}|center|-|Origen|{*mostrar_origen_reporte@idft_radicacion_entrada*}|center|-|Destino|{*mostrar_destino_reporte@idft_destino_radicacion*}|center|-|Fecha de Radicaci&oacute;n|{*fecha_radicacion_entrada*}|center|-|Asunto|{*descripcion*}|left|-|Observaciones|{*observacion_destino*}|left' WHERE busqueda_componente.idbusqueda_componente = 281;	
	
	UPDATE  saia_release1.busqueda_componente SET  info = 'Radicado|{*ver_items@iddocumento,numero,fecha_radicacion_entrada,tipo_radicado*}|center|-|No. Item|{*numero_item*}|center|-|Estado|{*mostrar_estado_destino_radicacion@idft_destino_radicacion*}|center|-|Diligencia|{*mostrar_tramite_radicacion@idft_destino_radicacion,tipo_mensajeria,estado_recogida*}|center|-|Ruta|{*mostrar_ruta_reporte@idft_destino_radicacion*}|center|-|Mensajero|{*mostrar_mensajeros_dependencia@idft_destino_radicacion,estado_item*}|center|-|Planilla Asociada|{*planilla_mensajero@idft_destino_radicacion,mensajero_encargado*}|center|-|Origen|{*mostrar_origen_reporte@idft_radicacion_entrada*}|center|-|Destino|{*mostrar_destino_reporte@idft_destino_radicacion*}|center|-|Fecha de Radicaci&oacute;n|{*fecha_radicacion_entrada*}|center|-|Asunto|{*descripcion*}|left|-|Observaciones|{*observacion_destino*}|left' WHERE  busqueda_componente.idbusqueda_componente =282;
	
	-- ---------------
	
	UPDATE  saia_release1.busqueda_componente SET  acciones_seleccionados =  'filtrar_mensajero,select_finalizar_generar_item' WHERE  busqueda_componente.idbusqueda_componente =279;
	UPDATE  saia_release1.busqueda_componente SET  acciones_seleccionados =  'filtrar_mensajero,select_finalizar_generar_item' WHERE  busqueda_componente.idbusqueda_componente =281;

	INSERT INTO saia_release1.cargo (idcargo, nombre, cod_padre, estado, codigo_cargo, tipo, tipo_cargo) VALUES (NULL, 'ADMINISTRADOR DE MENSAJER&Iacute;A', '82', '1', '', '1', '2');
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
	INSERT INTO campos_formato ( formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, mascara, adicionales, autoguardado, fila_visible) VALUES
(403, 'ruta_origen', 'ruta_origen', 'INT', '11', 0, NULL, 'a,e,b', NULL, NULL, NULL, 'hidden', 0, NULL, NULL, 0, 1),
(403, 'ruta_destino', 'ruta_destino', 'INT', '11', 0, NULL, 'a,e,b', NULL, NULL, NULL, 'hidden', 0, NULL, NULL, 0, 1);
-- ----------------------------------------------------------------
UPDATE campos_formato SET etiqueta_html = 'hidden' WHERE nombre='origen_externo' AND formato_idformato=403;
UPDATE campos_formato SET valor = NULL WHERE nombre='origen_externo' AND formato_idformato=403;

UPDATE campos_formato SET etiqueta_html = 'hidden' WHERE nombre='nombre_origen' AND formato_idformato=403;
UPDATE campos_formato SET valor = NULL WHERE nombre='nombre_origen' AND formato_idformato=403;
-- ----------------------------------------------------------------
INSERT INTO funciones_formato_accion (idfunciones_formato_accion,idfunciones_formato,accion_idaccion,formato_idformato,momento,estado,orden) VALUES (NULL, '902', '5', '3', 'POSTERIOR', '1', '7'); -- valida_tipo_destino_entrada, posterios al editar
-- ----------------------------------------------------------------
UPDATE busqueda_componente SET busqueda_avanzada = 'formatos/radicacion_entrada/busqueda_reporte.php?idbusqueda_componente=282' WHERE idbusqueda_componente = 282;
-- ----------------------------------------------------------------
UPDATE funciones_formato_accion SET orden=16 WHERE  accion_idaccion=3 AND idfunciones_formato=902 AND formato_idformato=3;
UPDATE funciones_formato_accion SET orden=15 WHERE  accion_idaccion=5 AND idfunciones_formato=902 AND formato_idformato=3;
-- ----------------------------------------------------------------
-- ====================================================
CAMBIOS DE COMPATIBILIDAD PARA MIGRACIONES DE SAIA DESDE MYSQL A OTROS MOTORES
-- ====================================================
update ft_prueba_compras set fecha_solicitud = null where fecha_solicitud = '0000-00-00';
update caja set fecha_extrema_i = null where fecha_extrema_i = '0000-00-00';
update calendario_saia set fecha = null where fecha = '0000-00-00';
update buzon_entrada set fecha = null where fecha = '0000-00-00 00:00:00.000000';
update ft_procedimiento set fecha_nomina = null where fecha_nomina  = '0000-00-00';
update ft_ruta_distribucion set fecha_ruta_distribuc = null where fecha_ruta_distribuc = '0000-00-00';
update tareas_planeadas set fecha_planeada = null where fecha_planeada = '0000-00-00 00:00:00.000000';
update ft_dependencias_ruta set fecha_item_dependenc = null where fecha_item_dependenc = '0000-00-00';
update asignacion set fecha_final = null where fecha_final = '0000-00-00 00:00:00.000000';
update funcionario set fecha_fin_inactivo = null where fecha_fin_inactivo = '0000-00-00';
update entidad_pretexto set fecha = null where fecha = '0000-00-00 00:00:00.000000';
update ft_proceso set fecha = null where fecha = '0000-00-00';
update expediente set fecha_extrema_i = null where fecha_extrema_i = '0000-00-00';
update ft_novedad_despacho set fecha_novedad = '1970-01-01' where fecha_novedad = '0000-00-00 00:00:00.000000';
update expediente set fecha_extrema_f = null where fecha_extrema_f = '0000-00-00';
update caja set fecha_extrema_f = null where fecha_extrema_f = '0000-00-00';
update tareas_planeadas set fecha_planeada_fin = null where fecha_planeada_fin = '0000-00-00 00:00:00.000000';
update ft_ruta_distribucion set fecha_ruta_distribuc = '1970-01-01' where 'fecha_ruta_distribuc' = '0000-00-00';
update ft_dependencias_ruta set fecha_item_dependenc = '1970-01-01' where fecha_item_dependenc = '0000-00-00';
UPDATE diagramdata SET type = 'dia' WHERE type = '';

ALTER TABLE asignacion CHANGE fecha_final fecha_final DATETIME NULL;
ALTER TABLE almacenamiento CHANGE registro_entrada registro_entrada DATETIME NOT NULL;
ALTER TABLE buzon_entrada CHANGE fecha fecha DATETIME NULL;
ALTER TABLE buzon_salida CHANGE fecha fecha DATETIME NOT NULL;
ALTER TABLE calendario_saia CHANGE fecha fecha DATE NULL;
ALTER TABLE entidad_pretexto CHANGE fecha fecha DATETIME NULL;
ALTER TABLE error CHANGE fecha fecha DATETIME NOT NULL;
ALTER TABLE evento CHANGE fecha fecha DATETIME NULL;
ALTER TABLE expediente CHANGE fecha fecha TIMESTAMP NOT NULL;
ALTER TABLE expediente_doc CHANGE fecha fecha TIMESTAMP NOT NULL;
ALTER TABLE ft_procedimiento CHANGE fecha_nomina fecha_nomina DATE NULL;
ALTER TABLE ft_proceso CHANGE fecha fecha DATE NULL;
ALTER TABLE ft_prueba_compras CHANGE fecha_solicitud fecha_solicitud DATE NULL;
ALTER TABLE funcionario CHANGE ultimo_pwd ultimo_pwd DATETIME NULL;
ALTER TABLE funcionario_editor CHANGE fecha_ingreso fecha_ingreso DATETIME NOT NULL;
ALTER TABLE funcionario_editor CHANGE ultimo_pwd ultimo_pwd DATETIME NOT NULL;
ALTER TABLE log_acceso_editor CHANGE fecha fecha DATETIME NOT NULL;
ALTER TABLE reemplazo CHANGE fecha_inicio fecha_inicio TIMESTAMP NOT NULL;
ALTER TABLE reemplazo_saia CHANGE fecha_inicio fecha_inicio DATE NOT NULL;
ALTER TABLE respuesta CHANGE fecha fecha DATETIME NOT NULL;
ALTER TABLE tareas_planeadas CHANGE fecha_planeada_fin fecha_planeada_fin DATETIME NULL;
ALTER TABLE documento DROP pantalla_idpantalla;

-- ---------------------------------------------------------------- 
-- NUEVA DISTRIBUCION 

CREATE TABLE distribucion (
  iddistribucion int(11) NOT NULL,
  origen int(11) NOT NULL,
  tipo_origen int(11) NOT NULL,
  ruta_origen int(11) DEFAULT NULL,
  mensajero_origen int(11) DEFAULT '0',
  destino int(11) NOT NULL,
  tipo_destino int(11) NOT NULL,
  ruta_destino int(11) DEFAULT NULL,
  mensajero_destino int(11) DEFAULT '0',
  mensajero_empresad int(11) DEFAULT '0',
  documento_iddocumento int(11) NOT NULL,
  numero_distribucion varchar(255) NOT NULL,
  estado_distribucion int(11) NOT NULL DEFAULT '0',
  estado_recogida int(11) NOT NULL,
  fecha_creacion datetime NOT NULL,
  finaliza_rol int(11) NULL,
  finaliza_fecha datetime NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE distribucion
  ADD PRIMARY KEY (iddistribucion);
  
ALTER TABLE distribucion
  MODIFY iddistribucion int(11) NOT NULL AUTO_INCREMENT;  


INSERT INTO busqueda (idbusqueda, nombre, etiqueta, estado, ancho, campos, llave, tablas, ruta_libreria, ruta_libreria_pantalla, cantidad_registros, tiempo_refrescar, ruta_visualizacion, tipo_busqueda, badge_cantidades) VALUES
(109, 'reporte_distribucion_general', 'Distribuci&oacute;n', 1, 200, 'a.iddistribucion,a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,a.estado_distribucion,a.estado_recogida,a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,b.descripcion', 'a.iddistribucion', 'distribucion a, documento b', 'distribucion/funciones_distribucion.php', 'distribucion/funciones_distribucion_js.php', 100, 500, 'pantallas/busquedas/consulta_busqueda_reporte.php', 2, NULL);

INSERT INTO busqueda_componente (idbusqueda_componente, busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas) VALUES
(303, 109, 3, 2, 'pantallas/busquedas/consulta_busqueda_reporte.php', '1. Entregas Interna a ventanilla', 'reporte_distribucion_general_sinrecogida', 1, 'Radicado|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Diligencia|{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}|center|80|-|Ruta|{*mostrar_nombre_ruta_distribucion@tipo_origen,estado_recogida,ruta_origen,ruta_destino,tipo_destino*}|center|-|Mensajero|{*select_mensajeros_ruta_distribucion@iddistribucion*}|center|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Acci&oacute;n|{*generar_check_accion_distribucion@iddistribucion*}|center|80|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|center|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|center|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left', NULL, NULL, NULL, 2, 600, 1, '', '', 'iddistribucion', 'DESC', NULL, 'distribucion/busqueda_distribucion.php?idbusqueda_componente=303', 'filtro_mensajero_distribucion,opciones_acciones_distribucion,filtro_ventanilla_radicacion', 1655, NULL, NULL, NULL),
(302, 109, 3, 2, 'pantallas/busquedas/consulta_busqueda_reporte.php', '4. Finalizado', 'reporte_distribucion_general_finalizado', 4, 'Radicado|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|center|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|center|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left', NULL, NULL, NULL, 2, 600, 1, '', '', 'iddistribucion', 'DESC', NULL, 'distribucion/busqueda_distribucion.php?idbusqueda_componente=302', '', NULL, NULL, NULL, NULL),
(301, 109, 3, 2, 'pantallas/busquedas/consulta_busqueda_reporte.php', '3. En distribuci&oacute;n', 'reporte_distribucion_general_endistribucion', 3, 'Radicado|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Diligencia|{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}|center|80|-|Ruta|{*mostrar_nombre_ruta_distribucion@tipo_origen,estado_recogida,ruta_origen,ruta_destino,tipo_destino*}|center|-|Mensajero|{*select_mensajeros_ruta_distribucion@iddistribucion*}|center|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Acci&oacute;n|{*generar_check_accion_distribucion@iddistribucion*}|center|80|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|center|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|center|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left', NULL, NULL, NULL, 2, 600, 1, '', '', 'iddistribucion', 'DESC', NULL, 'distribucion/busqueda_distribucion.php?idbusqueda_componente=301', 'filtro_mensajero_distribucion,opciones_acciones_distribucion,filtro_ventanilla_radicacion', NULL, NULL, NULL, NULL),
(300, 109, 3, 2, 'pantallas/busquedas/consulta_busqueda_reporte.php', '2. Por Distribuir', 'reporte_distribucion_general_pordistribuir', 2, 'Radicado|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Diligencia|{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}|center|80|-|Ruta|{*mostrar_nombre_ruta_distribucion@tipo_origen,estado_recogida,ruta_origen,ruta_destino,tipo_destino*}|center|-|Mensajero|{*select_mensajeros_ruta_distribucion@iddistribucion*}|center|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Acci&oacute;n|{*generar_check_accion_distribucion@iddistribucion*}|center|80|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|center|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|center|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left', NULL, NULL, NULL, 2, 600, 1, '', '', 'iddistribucion', 'DESC', NULL, 'distribucion/busqueda_distribucion.php?idbusqueda_componente=300', 'filtro_mensajero_distribucion,opciones_acciones_distribucion,filtro_ventanilla_radicacion', NULL, NULL, NULL, NULL);

INSERT INTO busqueda_condicion (idbusqueda_condicion, busqueda_idbusqueda, fk_busqueda_componente, codigo_where, etiqueta_condicion) VALUES
(238, NULL, 303, 'a.documento_iddocumento=b.iddocumento AND lower(b.estado)=\'aprobado\' AND a.estado_distribucion=0 {*condicion_adicional_distribucion*}', 'condicion_reporte_distribucion_general_sinrecogida'),
(237, NULL, 302, 'a.documento_iddocumento=b.iddocumento AND lower(b.estado)=\'aprobado\' AND a.estado_distribucion=3 {*condicion_adicional_distribucion*}', 'condicion_reporte_distribucion_general_finalizado'),
(236, NULL, 301, 'a.documento_iddocumento=b.iddocumento AND lower(b.estado)=\'aprobado\' AND a.estado_distribucion=2 {*condicion_adicional_distribucion*}', 'condicion_reporte_distribucion_general_endistribucion'),
(235, NULL, 300, 'a.documento_iddocumento=b.iddocumento AND lower(b.estado)=\'aprobado\' AND a.estado_distribucion=1 {*condicion_adicional_distribucion*}', 'condicion_reporte_distribucion_general_pordistribuir');

DELETE FROM funciones_formato WHERE idfunciones_formato=904; -- subir_planilla_despacho_ingresados
DELETE FROM funciones_formato_accion WHERE idfunciones_formato=904; -- subir_planilla_despacho_ingresados - POSTERIOR A SUBIR ANEXO

INSERT INTO funciones_formato (idfunciones_formato, nombre, nombre_funcion, parametros, etiqueta, descripcion, ruta, formato, acciones) VALUES (942, '{*vincular_dependencia_ruta_distribucion*}', 'vincular_dependencia_ruta_distribucion', NULL, 'vincular_dependencia_ruta_distribucion', '', 'funciones.php', '404', '');
INSERT INTO funciones_formato_accion (idfunciones_formato_accion, idfunciones_formato, accion_idaccion, formato_idformato, momento, estado, orden) VALUES (NULL, '942', '3', '404', 'POSTERIOR', '1', '2'); -- vincular_dependencia_ruta_distribucion POSTERIOR A APROBAR formato: ruta_distribucion

UPDATE funciones_formato_accion SET accion_idaccion = '3' WHERE idfunciones_formato_accion = 283; -- ingresar_item_destino_radicacion POSTERIOR AL APROBAR.

INSERT INTO campos_formato (formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, mascara, adicionales, autoguardado, fila_visible) VALUES
(3, 'requiere_recogida', 'Requiere recogida?', 'INT', '11', 0, '0,No;1,Si', 'a,e,b', NULL, '1', NULL, 'radio', 18, NULL, NULL, 0, 1); -- campo requiere recogida formato radicacion_entrada

INSERT INTO modulo (idmodulo, pertenece_nucleo, nombre, tipo, imagen, etiqueta, enlace, enlace_mobil, destino, cod_padre, orden, ayuda, parametros, busqueda_idbusqueda, permiso_admin, busqueda, enlace_pantalla) VALUES (1654, '0', 'reporte_distribucion_documentos', 'secundario', 'botones/principal/distribucion.png', 'Distribuci&oacute;n', 'pantallas/buscador_principal.php?idbusqueda=109', NULL, 'centro', '1', '8', '', '', '1', '0', '1', '0'); -- NUEVO MODULO DE DISTRIBUCION

INSERT INTO modulo (idmodulo,pertenece_nucleo, nombre, tipo, imagen, etiqueta, enlace, enlace_mobil, destino, cod_padre, orden, ayuda, parametros, busqueda_idbusqueda, permiso_admin, busqueda, enlace_pantalla) VALUES
(1655,0, 'permiso_reporte_distribucion_general_sinrecogida', 'secundario', 'botones/principal/defaut.png', 'Visualizar 1. Entregas Interna a ventanilla', '#', NULL, 'centro', 1654, 1, '', '', 0, 0, '1', 0); -- PERMISO PARA VER COMPONENTE 1. Entregas Interna a ventanilla

UPDATE busqueda_componente SET modulo_idmodulo = '1655' WHERE busqueda_componente.idbusqueda_componente = 303; -- modulo permiso_reporte_distribucion_general_sinrecogida al componente reporte_distribucion_general_sinrecogida

INSERT INTO funciones_formato (idfunciones_formato, nombre, nombre_funcion, parametros, etiqueta, descripcion, ruta, formato, acciones) VALUES
(943, '{*mostrar_listado_distribucion_documento*}', 'mostrar_listado_distribucion_documento', '', 'mostrar_listado_distribucion_documento', NULL, '../../distribucion/funciones_distribucion.php', '', 'm'); -- FUNCION PARA MOSTRAR DISTRIBUCIONES EN CADA PLANTILLA DONDE SE REQUIERA


DELETE FROM modulo WHERE nombre='reporte_radicacion_correspondencia';  -- SE ELIMINA EL MODULO ANTIGUO DE DISTRIBUCION

INSERT INTO cargo (idcargo, nombre, cod_padre, estado, codigo_cargo, tipo, tipo_cargo) VALUES
(82, 'mensajero', 0, 1, NULL, 1, 1),
(253, 'mensajero externo', 82, 1, NULL, 1, 1),
(254, 'ADMINISTRADOR DE MENSAJER&Iacute;A', 82, 1, 0, 1, 2);  -- CARGOS REQUERIDOS EN LA NUEVA DISTRIBUCION


INSERT INTO funciones_formato (nombre, nombre_funcion, parametros, etiqueta, descripcion, ruta, formato, acciones) VALUES
('{*validar_nombre_ruta_distribucion*}', 'validar_nombre_ruta_distribucion', NULL, 'validar_nombre_ruta_distribucion', '', 'funciones.php', '404', 'a,e');

UPDATE campos_formato SET acciones = 'a,e,b,p,d' WHERE formato_idformato=404 AND nombre='nombre_ruta';

-- CREACION DE CF cf_ventanilla

CREATE TABLE cf_ventanilla (
  idcf_ventanilla int(11) NOT NULL,
  nombre varchar(255) DEFAULT NULL,
  valor varchar(255) DEFAULT NULL,
  cod_padre varchar(255) DEFAULT NULL,
  descripcion varchar(255) DEFAULT NULL,
  tipo varchar(255) DEFAULT NULL,
  categoria varchar(255) DEFAULT NULL,
  estado int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE cf_ventanilla
  ADD PRIMARY KEY (idcf_ventanilla);
  
ALTER TABLE cf_ventanilla
  MODIFY idcf_ventanilla int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

INSERT INTO busqueda_componente (idbusqueda_componente, busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas) VALUES (NULL, '19', '3', '2', 'pantallas/busquedas/consulta_busqueda_reporte.php', 'Ventanillas de Radicaci&oacute;n', 'cf_ventanilla', '2', 'Nombre|{*nombre*}|center|-|Valor|{*valor*}|center|-|Categoria|{*categoria*}|center|-|Estado|{*estado*}|center|-|Acciones|{*barra_superior_cf@idcf_ventanilla,nombre_tabla*}|center', NULL, NULL, '', '2', '320', '2', 'idcf_ventanilla,nombre,valor,categoria, case estado when 1 then \'activo\' else \'inactivo\' end as estado, \'cf_ventanilla\' as nombre_tabla', 'cf_ventanilla', 'nombre', 'ASC', NULL, 'pantallas/admin_cf/busqueda_avanzada_cf.php?tabla=cf_ventanilla&idbusqueda_componente=322', NULL, NULL, NULL, 'pantallas/admin_cf/pantalla_cf_adicionar.php?tabla=cf_ventanilla', NULL);

INSERT INTO busqueda_condicion (idbusqueda_condicion, busqueda_idbusqueda, fk_busqueda_componente, codigo_where, etiqueta_condicion) VALUES (NULL, NULL, '322', '1=1', 'cf_ventanilla');

-- ALMACENANDO LA VENTANILLA DEL FUNCIONARIO Y DOCUMENTOS
ALTER TABLE funcionario ADD ventanilla_radicacion INT(11) NULL AFTER foto_cordenadas;
ALTER TABLE documento ADD ventanilla_radicacion INT(11) NULL DEFAULT '0' AFTER fecha_limite;
ALTER TABLE distribucion DROP ventanilla;

-- MODIFICACION REPORTE POR INGRESAR DISTRIBUCION
UPDATE busqueda SET ruta_libreria = 'pantallas/documento/librerias.php,pantallas/documento/librerias_pendientes_entrada.php,distribucion/funciones_distribucion.php' WHERE idbusqueda = 7;
UPDATE busqueda_componente SET tablas_adicionales = 'ft_radicacion_entrada b' WHERE idbusqueda_componente = 16;
UPDATE busqueda_componente SET tablas_adicionales = 'ft_radicacion_entrada b' WHERE idbusqueda_componente = 280;
UPDATE busqueda_condicion SET codigo_where = 'lower(a.estado)=''iniciado'' AND a.tipo_radicado=1 AND a.iddocumento=b.documento_iddocumento {*condicion_por_ingresar_ventanilla_distribucion*}' WHERE idbusqueda_condicion = 13;
UPDATE busqueda_condicion SET codigo_where = 'lower(A.estado)=''iniciado'' AND A.tipo_radicado=2 AND a.iddocumento=b.documento_iddocumento {*condicion_por_ingresar_ventanilla_distribucion*}' WHERE idbusqueda_condicion = 222;
UPDATE busqueda_condicion SET codigo_where = 'lower(a.estado)=''iniciado'' AND a.iddocumento=b.documento_iddocumento {*condicion_por_ingresar_ventanilla_distribucion*}' WHERE idbusqueda_condicion = 233;

-- MODIFICACION REPORTE INGRESADOS DISTRIBUCION

UPDATE busqueda SET tablas = 'documento a' WHERE idbusqueda = 9;
UPDATE busqueda SET ruta_libreria = 'pantallas/documento/librerias.php,pantallas/documento/librerias_flujo.php,pantallas/documento/librerias_transferencias.php,pantallas/documento/librerias_tramitados.php,distribucion/funciones_distribucion.php' WHERE idbusqueda = 9;
UPDATE busqueda_componente SET tablas_adicionales = 'ft_radicacion_entrada b' WHERE busqueda_componente.idbusqueda_componente = 18;
UPDATE busqueda_componente SET tablas_adicionales = 'ft_radicacion_entrada b' WHERE busqueda_componente.idbusqueda_componente = 23;
UPDATE busqueda_condicion SET codigo_where = 'lower(a.estado)=''aprobado'' and a.tipo_radicado=1 and a.iddocumento=b.documento_iddocumento {*condicion_por_ingresar_ventanilla_distribucion*}' WHERE idbusqueda_condicion = 15;
UPDATE busqueda_condicion SET codigo_where = 'lower(a.estado)=''aprobado'' and a.tipo_radicado=2 and a.iddocumento=b.documento_iddocumento {*condicion_por_ingresar_ventanilla_distribucion*}' WHERE idbusqueda_condicion = 18;

-- FIN NUEVA DISTRIBUCION 
-- ---------------------------------------------------------------- 
-- FORMATO carta, ADAPTACION PARA QUE HAGA DISTRIBUCION

INSERT INTO campos_formato (formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, mascara, adicionales, autoguardado, fila_visible) VALUES
(1, 'tipo_mensajeria', 'TIPO DE MENSAJER&Iacute;A', 'INT', '11', 0, '1,Servicio de Mensajer&iacute;a;3,Entrega personal/Medios Propios del &Aacute;rea', 'a,e,b', NULL, '1', NULL, 'radio', 11, NULL, NULL, 0, 1),
(1, 'requiere_recogida', 'Requiere recogida?', 'INT', '11', 0, '0,No;1,Si', 'a,e,b', NULL, '1', NULL, 'radio', 10, NULL, NULL, 0, 1); -- CAMPOS REQUIERE RECOGIDA Y TIPO MENSAJERIA

INSERT INTO funciones_formato (idfunciones_formato, nombre, nombre_funcion, parametros, etiqueta, descripcion, ruta, formato, acciones) VALUES
(944, '{*vincular_distribucion_carta*}', 'vincular_distribucion_carta', NULL, 'vincular_distribucion_carta', 'vincula el formato carta a la distribucion', 'funciones.php', '1', '');

INSERT INTO funciones_formato_accion (idfunciones_formato_accion, idfunciones_formato, accion_idaccion, formato_idformato, momento, estado, orden) VALUES
(303, 944, 3, 1, 'POSTERIOR', 1, 8);

UPDATE funciones_formato SET formato = '1' WHERE funciones_formato.idfunciones_formato = 943; -- se vincula la funcion mostrar_listado_distribucion_documento al formato carta

UPDATE formato SET cuerpo='<table style="width: 100%; border-collapse: collapse;" border="0">
<tbody>
<tr>
<td colspan="2">{*ciudad*}, {*mostrar_fecha*}</td>
<td style="text-align: right;" rowspan="4">{*mostrar_qr_carta*}<br /><span style="font-size: 8pt;">{*formato_radicado_enviada*}</span></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="2">{*mostrar_destinos*}</td>
</tr>
<tr>
<td colspan="3"><br />
<p>ASUNTO: &nbsp; &nbsp; {*asunto*}</p>
</td>
</tr>
<tr>
<td colspan="3" width="100%">
<p>&nbsp;<br />Cordial saludo:</p>
<p>{*contenido*}</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;Atentamente,</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3">&nbsp;{*mostrar_estado_proceso*}</td>
</tr>
<tr>
<td colspan="3">{*mostrar_anexos_externa*}{*tamanio_texto_anexos_ext*}<br />{*mostrar_copias_comunicacion_ext*}Proyect&oacute;: {*iniciales*}</td>
</tr>
</tbody>
</table>' WHERE idformato=1; -- SE INCLUYE EN EL CUERPO DE LA CARTA EL RESUMEN DE LAS DISTRIBUCIONES

-- <<<FIN>>> FORMATO carta, ADAPTACION PARA QUE HAGA DISTRIBUCION
-- ---------------------------------------------------------------- 
-- ---------------------------------------------------------------- 
-- ---------------------------------------------------------------- 
-- FORMATO pqrsf, ADAPTACION PARA QUE HAGA DISTRIBUCION

INSERT INTO funciones_formato (idfunciones_formato, nombre, nombre_funcion, parametros, etiqueta, descripcion, ruta, formato, acciones) VALUES
(945, '{*vincular_distribucion_pqrsf*}', 'vincular_distribucion_pqrsf', NULL, 'vincular_distribucion_pqrsf', 'Vincula una pqrsf a la distribucion', 'funciones.php', '305', '');

INSERT INTO funciones_formato_accion (idfunciones_formato_accion, idfunciones_formato, accion_idaccion, formato_idformato, momento, estado, orden) VALUES
(304, 945, 3, 305, 'POSTERIOR', 1, 1); -- FUNCION POSTERIOR AL APROBAR PARA QUE VINCULE LA DISTRIBUCION

UPDATE funciones_formato SET formato = '1,305' WHERE funciones_formato.idfunciones_formato = 943; -- se vincula la funcion mostrar_listado_distribucion_documento al formato pqrsf

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
<p>{*mostrar_listado_distribucion_documento*}</p>
<p>{*mostrar_estado_proceso*}</p>' WHERE idformato=305; -- SE INCLUYE EN EL CUERPO DE LA PQRSF EL RESUMEN DE LAS DISTRIBUCIONES

INSERT INTO campos_formato (formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, mascara, adicionales, autoguardado, fila_visible) VALUES
( 305, 'remitente_origen', 'remitente_origen', 'INT', '11', 0, NULL, 'a,e,b', NULL, NULL, NULL, 'hidden', 0, NULL, NULL, 0, 1);


-- <<FIN>> FORMATO pqrsf, ADAPTACION PARA QUE HAGA DISTRIBUCION
-- ---------------------------------------------------------------- 
-- ---------------------------------------------------------------- 
-- ---------------------------------------------------------------- 
-- FORMATO respuesta_pqrsf, ADAPTACION PARA QUE HAGA DISTRIBUCION


INSERT INTO campos_formato (formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, mascara, adicionales, autoguardado, fila_visible) VALUES
(307, 'requiere_recogida', 'Requiere recogida?', 'INT', '11', 0, '0,No;1,Si', 'a,e,b', NULL, '1', NULL, 'radio', 4, NULL, NULL, 0, 1),
(307, 'tipo_mensajeria', 'TIPO DE MENSAJER&Iacute;A', 'INT', '11', 0, '1,Servicio de Mensajer&iacute;a;3,Entrega personal/Medios Propios del &Aacute;rea', 'a,e,b', NULL, '1', NULL, 'radio', 5, NULL, NULL, 0, 1);
-- CAMPOS REQUIERE RECOGIDA Y TIPO MENSAJERIA

INSERT INTO funciones_formato (idfunciones_formato, nombre, nombre_funcion, parametros, etiqueta, descripcion, ruta, formato, acciones) VALUES
(946,'{*vincular_distribucion_respuesta_pqrsf*}', 'vincular_distribucion_respuesta_pqrsf', NULL, 'vincular_distribucion_respuesta_pqrsf', 'Vincula las respuestas pqrsf a la distribucion', 'funciones.php', '307', '');

INSERT INTO funciones_formato_accion (idfunciones_formato_accion, idfunciones_formato, accion_idaccion, formato_idformato, momento, estado, orden) VALUES
(305, 946, 3, 307, 'POSTERIOR', 1, 5); -- POSTERIOR AL APROBAR vincular_distribucion_respuesta_pqrsf()

UPDATE funciones_formato SET formato = '1,305,307' WHERE funciones_formato.idfunciones_formato = 943; -- vinculo mostrar_listado_distribucion_documento al formato respuesta_pqrsf

UPDATE formato SET cuerpo='<p>{*mostrar_informacion_pqrsf_padre*}</p>
<p>&nbsp;</p>
<p>{*mostrar_listado_distribucion_documento*}</p>
<p>&nbsp;</p>
<p>{*mostrar_estado_proceso*}</p>' WHERE idformato=307; -- funcion mostrar_listado_distribucion_documento en el cuerpo de respuesta_pqrsf

-- <<FIN>> FORMATO respuesta_pqrsf, ADAPTACION PARA QUE HAGA DISTRIBUCION
-- ---------------------------------------------------------------- 

-- Indices unicos en funcionario
ALTER TABLE funcionario ADD UNIQUE(funcionario_codigo);
ALTER TABLE funcionario ADD UNIQUE(login);

-- Revision uso de tablas

-- INICIO MIGRACION Version20170921185120.php
ALTER TABLE busqueda ADD UNIQUE(nombre);

DELETE FROM busqueda_componente WHERE busqueda_componente.idbusqueda_componente = 106;
DELETE FROM busqueda_componente WHERE busqueda_componente.idbusqueda_componente = 161;
DELETE FROM busqueda_componente WHERE busqueda_componente.idbusqueda_componente = 151;
DELETE FROM busqueda_componente WHERE busqueda_componente.idbusqueda_componente = 152;
DELETE FROM busqueda WHERE busqueda.idbusqueda = 18;
DELETE FROM busqueda WHERE busqueda.idbusqueda = 45;
DELETE FROM busqueda_componente WHERE busqueda_componente.idbusqueda_componente = 139;
DELETE FROM busqueda_componente WHERE busqueda_componente.idbusqueda_componente = 184;
UPDATE busqueda_componente SET nombre = 'listado_documentos_avanzado' WHERE busqueda_componente.idbusqueda_componente = 33;
UPDATE busqueda_componente SET nombre = 'listado_documentos_activar' WHERE busqueda_componente.idbusqueda_componente = 92;
UPDATE busqueda_componente SET nombre = 'pendiente_ingresar' WHERE busqueda_componente.idbusqueda_componente = 280;

ALTER TABLE busqueda_componente ADD UNIQUE(nombre);

DELETE FROM modulo WHERE modulo.idmodulo = 1140;

ALTER TABLE modulo ADD UNIQUE(nombre);

ALTER TABLE busqueda_grafico ADD nombre VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;

UPDATE busqueda_grafico SET nombre=LOWER(REPLACE(trim(etiqueta), ' ', '_'));
UPDATE busqueda_grafico SET nombre=LOWER(REPLACE(nombre, '__', '_'));
UPDATE busqueda_grafico SET nombre=LOWER(REPLACE(nombre, '''', ''));
UPDATE busqueda_grafico SET nombre=LOWER(REPLACE(nombre, '_de_', '_'));
UPDATE busqueda_grafico SET nombre=LOWER(REPLACE(nombre, '_y_', '_'));
UPDATE busqueda_grafico SET nombre=LOWER(REPLACE(nombre, '_en_', '_'));
UPDATE busqueda_grafico SET nombre=LOWER(REPLACE(nombre, '_el_', '_'));
UPDATE busqueda_grafico SET nombre=LOWER(REPLACE(nombre, '_la_', '_'));
ALTER TABLE busqueda_grafico CHANGE nombre nombre VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE campos_formato ADD UNIQUE ix_campos_formato_formato (formato_idformato, nombre);

DROP TABLE  caracteristica;

DELETE FROM contador WHERE contador.idcontador = 5;
ALTER TABLE contador ADD UNIQUE(nombre);

delete from contador where idcontador in (
SELECT idcontador FROM contador c, formato f 
WHERE c.nombre = f.nombre
and f.pertenece_nucleo=0);

DROP PROCEDURE sp_asignar_radicado;

DELIMITER$$;
CREATE PROCEDURE sp_asignar_radicado(IN iddoc INT, IN tipo INT, IN funcionario INT)
BEGIN
DECLARE valor VARCHAR(50);
DECLARE sentencia VARCHAR(2000); 
SELECT consecutivo INTO valor FROM contador WHERE idcontador=tipo;
UPDATE documento SET numero=valor WHERE iddocumento=iddoc;
UPDATE contador SET consecutivo=consecutivo+1 WHERE idcontador=tipo;
set sentencia = concat('UPDATE documento SET numero=', valor, ' WHERE iddocumento=',iddoc);
INSERT INTO evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado, codigo_sql, detalle) VALUES(funcionario, CURRENT_TIMESTAMP, 'MODIFICAR', 'documento', valor, 0,sentencia,null);
set sentencia = concat('UPDATE contador SET consecutivo=', valor+1, ' WHERE idcontador=',tipo);
INSERT INTO evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado, codigo_sql, detalle) VALUES(funcionario, CURRENT_TIMESTAMP, 'MODIFICAR', 'contador', valor+1, 0,sentencia,null);
END$$
DELIMITER ;

drop table if exists(correo_usuario);
drop table if exists(dependencia2);

-- FIN MIGRACION Version20170921185120.php

-- INICIO MIGRACION Version20170926223831.php
INSERT INTO busqueda
(idbusqueda, nombre, etiqueta, estado, ancho, campos, llave, tablas, ruta_libreria, ruta_libreria_pantalla, cantidad_registros, tiempo_refrescar, ruta_visualizacion, tipo_busqueda, badge_cantidades)
VALUES(114, 'hallazgos2', 'Hallazgos', 1, 200, 'fecha,numero,descripcion', 'iddocumento', 'documento a,ft_hallazgo b', 'pantallas/hallazgos/librerias_hallazgos.php', 'pantallas/hallazgos/adicionales_js.php', 20, 500, 'pantallas/busquedas/consulta_busqueda_reporte.php', 2, NULL);
INSERT INTO busqueda
(idbusqueda, nombre, etiqueta, estado, ancho, campos, llave, tablas, ruta_libreria, ruta_libreria_pantalla, cantidad_registros, tiempo_refrescar, ruta_visualizacion, tipo_busqueda, badge_cantidades)
VALUES(113, 'planes_mejoramiento1', 'Planes Mejoramiento', 1, 200, 'numero,fecha,descripcion', 'iddocumento', 'documento A,ft_plan_mejoramiento B', 'pantallas/planes_mejoramiento/librerias_planes_mejoramiento.php', 'pantallas/planes_mejoramiento/adicionales_js.php', 20, 500, 'pantallas/busquedas/consulta_busqueda_reporte.php', 2, NULL);

INSERT INTO busqueda_componente
(idbusqueda_componente, busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas)
VALUES(318, 113, 3, 2, 'pantallas/busquedas/consulta_busqueda_reporte.php', 'Planes Mejoramiento', 'planes_mejoramiento1', 1, 'Documento Numero|{*numero*}|center|-|Documento Fecha|{*fecha*}|center|-|Documento Descripcion|{*descripcion*}|center', NULL, NULL, NULL, 2, 320, 2, NULL, NULL, 'ORDER BY fecha', 'desc', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO busqueda_componente
(idbusqueda_componente, busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas)
VALUES(319, 114, 3, 2, 'pantallas/busquedas/consulta_busqueda_reporte.php', 'Hallazgos', 'hallazgos2', 1, 'Documento Fecha|{*fecha*}|center|-|Documento Numero|{*numero*}|center|-|Documento Descripcion|{*descripcion*}|center', NULL, NULL, NULL, 2, 320, 2, NULL, NULL, 'ORDER BY documento__fecha', 'desc', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

INSERT INTO busqueda_condicion
(idbusqueda_condicion, busqueda_idbusqueda, fk_busqueda_componente, codigo_where, etiqueta_condicion)
VALUES(243, NULL, 318, 'A.estado<>''ELIMINADO'' and documento_iddocumento=iddocumento {*tipo_plan*} {*filtro*}', 'condicion_planes_mejoramiento1');
INSERT INTO busqueda_condicion
(idbusqueda_condicion, busqueda_idbusqueda, fk_busqueda_componente, codigo_where, etiqueta_condicion)
VALUES(244, NULL, 319, 'b.documento_iddocumento=a.iddocumento {*codigo_sql*}', 'condicion_hallazgos2');


drop table if exists(campos);

drop table if exists(busquedas);

-- FIN MIGRACION Version20170926223831.php

-- INICIO DESARROLLO NUEVO REPORTE EXPEDIENTES 20171005

INSERT INTO busqueda (idbusqueda, nombre, etiqueta, estado, ancho, campos, llave, tablas, ruta_libreria, ruta_libreria_pantalla, cantidad_registros, tiempo_refrescar, ruta_visualizacion, tipo_busqueda, badge_cantidades) VALUES
(115, 'reporte_expediente_grid', 'Reporte expediente grid', 1, 200, 'a.fecha,a.nombre,a.descripcion,a.cod_arbol,a.estado_cierre,a.nombre_serie,a.propietario', 'a.idexpediente ', 'vexpediente_serie a', 'pantallas/expediente/funciones_reporte_grid.php', 'pantallas/expediente/funciones_reporte_grid_js.php', 30, 500, 'pantallas/busquedas/consulta_busqueda_reporte.php', 2, NULL);

INSERT INTO busqueda_componente (idbusqueda_componente, busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas) VALUES
(320, 115, 3, 2, 'pantallas/busquedas/consulta_busqueda_reporte.php', 'Reporte expediente grid', 'reporte_expediente_grid_exp', 2, 'fecha|{*fecha*}|left|200|-|nombre|{*nombre*}|left|200|-|descripcion|{*descripcion*}|left|200|-|cod_arbol|{*cod_arbol*}|left|200|-|estado_cierre|{*estado_cierre*}|left|200|-|nombre_serie|{*nombre_serie*}|left|200|-|propietario|{*propietario*}|left', NULL, NULL, NULL, 1, 320, 2, NULL, NULL, '', '', NULL, '', '', NULL, NULL, NULL, NULL);

INSERT INTO busqueda_condicion (idbusqueda_condicion, busqueda_idbusqueda, fk_busqueda_componente, codigo_where, etiqueta_condicion) VALUES
(245, NULL, 320, '1=1 {*filtro_cod_arbol*}', 'condicion_reporte_expediente_grid');

INSERT INTO modulo (idmodulo, pertenece_nucleo, nombre, tipo, imagen, etiqueta, enlace, enlace_mobil, destino, cod_padre, orden, ayuda, parametros, busqueda_idbusqueda, permiso_admin, busqueda, enlace_pantalla) 
VALUES (1660, '0', 'modulo_reporte_expediente_grid', 'secundario', 'botones/principal/defaut.png', 'Reporte Expedientes Grid', 'pantallas/buscador_principal.php?idbusqueda=115', NULL, 'centro', '1057', '1', '', '', '0', '0', '1', '0');


INSERT INTO busqueda (idbusqueda, nombre, etiqueta, estado, ancho, campos, llave, tablas, ruta_libreria, ruta_libreria_pantalla, cantidad_registros, tiempo_refrescar, ruta_visualizacion, tipo_busqueda, badge_cantidades) 
VALUES (116, 'reporte_docs_expediente_grid', 'Reporte Docs Expediente Grid', '1', '200', 'a.expediente_idexpediente,a.documento_iddocumento,a.fecha', 'a.idexpediente_doc', 'expediente_doc a', 'pantallas/expediente/funciones_reporte_grid.php', 'pantallas/expediente/funciones_reporte_grid_js.php', '30', '500', 'pantallas/busquedas/consulta_busqueda_reporte.php', '2', NULL);

INSERT INTO busqueda_componente (idbusqueda_componente, busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas) 
VALUES (321, '116', '3', '2', 'pantallas/busquedas/consulta_busqueda_reporte.php', 'Reporte Docs Expediente Grid', 'reporte_docs_expediente_grid_exp', '2', 'expediente_idexpediente|{*expediente_idexpediente*}|left|200|-|documento_iddocumento|{*documento_iddocumento*}|left|200|-|fecha|{*fecha*}|left', NULL, NULL, NULL, '1', '320', '2', NULL, NULL, '', '', NULL, '', NULL, NULL, NULL, NULL, NULL);

INSERT INTO busqueda_condicion (idbusqueda_condicion, busqueda_idbusqueda, fk_busqueda_componente, codigo_where, etiqueta_condicion) 
VALUES (246, NULL, '321', '1=1 {*filtro_expediente_doc*}', 'condicion_reporte_docs_expediente_grid');

CREATE OR REPLACE VIEW vexpediente_serie  AS 
select a.propietario AS propietario,c.nombre AS nombre_serie,a.fecha AS fecha,a.nombre AS nombre,a.descripcion AS descripcion,a.cod_arbol AS cod_arbol,a.cod_padre AS cod_padre,a.estado_archivo AS estado_archivo,a.fk_idcaja AS fk_idcaja,a.estado_cierre AS estado_cierre,a.idexpediente AS idexpediente,b.entidad_identidad AS identidad_exp,b.llave_entidad AS llave_exp,d.entidad_identidad AS identidad_ser,d.llave_entidad AS llave_ser,d.estado AS estado_entidad_serie,a.prox_estado_archivo AS prox_estado_archivo,a.fecha_extrema_i,a.fecha_extrema_f,a.no_unidad_conservacion,a.no_folios,a.no_carpeta,a.soporte,a.notas_transf,a.tomo_no
from expediente a 
left join entidad_expediente b on a.idexpediente = b.expediente_idexpediente
left join serie c on a.serie_idserie = c.idserie
left join entidad_serie d on c.idserie = d.serie_idserie;

update busqueda
set campos = 'a.fecha,a.nombre,a.descripcion,a.cod_arbol,a.estado_cierre,a.nombre_serie,a.propietario,a.fecha_extrema_i,a.fecha_extrema_f,a.no_unidad_conservacion,a.no_folios,a.no_carpeta,a.soporte,a.notas_transf,a.tomo_no'
where idbusqueda = 115;

update busqueda_componente
set info = 'CODIGO|{*cod_arbol*}|left|200|-|Nombre de la serie subserie o asuntos|{*descripcion*}|left|200|-|Fecha Extrema Inicial|{*fecha_extrema_i*}|left|200|-|Fecha Extrema Final|{*fecha_extrema_f*}|left|200|-|Unidad de conservacion|{*no_unidad_conservacion*}|left|200|-|Folios|{*no_folios*}|left|200|-|Soporte|{*soporte*}|left|200|-|Notas|{*notas_transf*}|left'
where idbusqueda_componente=320;

-- FIN DESARROLLO NUEVO REPORTE EXPEDIENTES 20171005

-- --------------------------------------------------------------------
-- REPORTE DE PRESTAMO ANIDADO AL REPORTE DE ARCHIVO(ESPEDIENTES)

INSERT INTO modulo (idmodulo, pertenece_nucleo, nombre, tipo, imagen, etiqueta, enlace, enlace_mobil, destino, cod_padre, orden, ayuda, parametros, busqueda_idbusqueda, permiso_admin, busqueda, enlace_pantalla) VALUES
(1666, 0, 'modulo_reporte_expedientes_prestamo', 'secundario', 'botones/principal/defaut.png', 'Prestamo', 'pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=203', NULL, '_self', 0, 5, '', '', 0, 0, '1', 0);

INSERT INTO busqueda_componente (idbusqueda_componente, busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas) VALUES
(324, 37, 4, 2, 'pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=203', 'Prestamo', 'enlace_reporte_prestamo', 6, '', NULL, NULL, '', 2, 320, 2, NULL, '', '', '', '', '', '', 1666, '', NULL, NULL);

-- --------------------------------------------------------------------
-- DESARROLLO USUARIOS RECURRENTES, ANDRES AGUDELO TRAIDO DE EDUP

INSERT INTO configuracion (nombre, valor, tipo, fecha, encrypt) VALUES
('usuarios_concurrentes', '8b1af8960920cda5c6254b87385f081d', 'empresa', '2017-09-25 20:16:46', 1);

CREATE OR REPLACE VIEW vusuarios_concurrentes AS select f.funcionario_codigo AS funcionario_codigo,f.nit AS nit,concat(f.nombres,' ',f.apellidos) AS nombre_completo,f.login AS login,count(l.login) AS cant_conexiones from (log_acceso l join funcionario f on((f.login = l.login))) where ((f.login not in ('cerok','mensajero','radicador_web','radicador_salida')) and (l.exito = 1) and isnull(l.fecha_cierre)) group by f.funcionario_codigo,f.nit,f.nombres,f.apellidos,f.login;


INSERT INTO busqueda (idbusqueda, nombre, etiqueta, estado, ancho, campos, llave, tablas, ruta_libreria, ruta_libreria_pantalla, cantidad_registros, tiempo_refrescar, ruta_visualizacion, tipo_busqueda, badge_cantidades) VALUES
(120, 'usuarios_concurrentes', 'Reporte Usuario Concurrentes', 1, 200, 'nit,nombre_completo,login,cant_conexiones', 'funcionario_codigo', NULL, NULL, NULL, 30, 500, 'pantallas/busquedas/consulta_busqueda_reporte.php', 2, NULL);

INSERT INTO busqueda_componente (busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas) VALUES
(120, 3, 2, 'pantallas/busquedas/consulta_busqueda_reporte.php', 'Reporte Usuario Concurrentes', 'usuarios_conectados_concurrentes', 1, 'Identificacion|{*nit*}|left|-|Nombres|{*nombre_completo*}|left|-|Login|{*login*}|left|-|Conexiones|{*cant_conexiones*}|center', NULL, NULL, NULL, 2, 320, 2, NULL, 'vusuarios_concurrentes', 'nombre_completo', 'ASC', 'funcionario_codigo,nit,nombre_completo,login', 'pantallas/funcionario/filtros_usu_recurrentes.php?idbusqueda_componente=304', NULL, 1667, NULL, NULL, NULL);


INSERT INTO modulo (idmodulo, pertenece_nucleo, nombre, tipo, imagen, etiqueta, enlace, enlace_mobil, destino, cod_padre, orden, ayuda, parametros, busqueda_idbusqueda, permiso_admin, busqueda, enlace_pantalla) VALUES
(1667, 0, 'reporte_usuarios_concurrentes', 'secundario', 'botones/principal/reportes.png', 'Usuarios Concurrentes', 'pantallas/buscador_principal.php?idbusqueda=120', NULL, 'centro', 1057, 22, '-', '', 0, 0, '1', 0);

-- --------------------------------------------------------------------
-- -----------------ACTUALIZACION REPORTE reporte_radicacion_correspondencia_dependencias CON LA NUEVA DISTRIBUCION--------------

UPDATE busqueda SET etiqueta = 'Reporte de Correspondencia' WHERE idbusqueda = 105;
UPDATE busqueda SET campos = 'd.numero,d.ventanilla_radicacion' WHERE idbusqueda = 105;

UPDATE busqueda_componente SET etiqueta = 'Correspondencia' WHERE idbusqueda_componente = 284;
UPDATE busqueda_componente SET etiqueta = 'Indicadores de Correspondencia' WHERE idbusqueda_componente = 285;

UPDATE busqueda_componente SET tablas_adicionales = 'ft_radicacion_entrada a, distribucion b, vfuncionario_dc c' WHERE idbusqueda_componente = 284;

UPDATE busqueda_componente SET campos_adicionales = 'a.tipo_origen,a.idft_radicacion_entrada,a.fecha_radicacion_entrada,a.descripcion,a.descripcion_general,b.iddistribucion,b.mensajero_destino,b.numero_distribucion,b.finaliza_fecha,CASE b.estado_distribucion WHEN 0 THEN ''RADICADO EN VENTANILLA'' WHEN 1 THEN ''POR DISTRIBUIR'' WHEN 2 THEN ''EN DISTRIBUCI&Oacute;N'' ELSE ''FINALIZADO'' END as estado_distribucion,a.fecha_radicacion_entrada,d.tipo_radicado,c.dependencia' WHERE idbusqueda_componente = 284;

UPDATE busqueda_componente SET info = 'Radicado|{*ver_items@iddocumento,numero,fecha_radicacion_entrada,tipo_radicado*}|center|-|No. Item|{*numero_distribucion*}|center|-|Ventanilla|{*mopstrar_nombre_ventanilla_radicacion@ventanilla_radicacion*}|center|-|Tipo de origen|{*mostrar_tipo_origen_reporte@tipo_origen*}|center|-|Fecha de Radicaci&oacute;n|{*fecha_radicacion_entrada*}|center|-|Asunto|{*descripcion*}|left|-|Origen|{*mostrar_origen_reporte@iddistribucion*}|center|-|Destino|{*mostrar_destino_reporte@iddistribucion*}|center|-|Ruta|{*mostrar_ruta_reporte@iddistribucion*}|left|-|Descripci&oacute;n o Asunto|{*descripcion*}|center|-|Estado|{*estado_distribucion*}|center' WHERE idbusqueda_componente = 284;

UPDATE busqueda_condicion SET codigo_where = 'lower(d.estado)=''aprobado'' AND a.documento_iddocumento=d.iddocumento AND a.documento_iddocumento=b.documento_iddocumento AND a.tipo_destino=2 AND b.destino=c.iddependencia_cargo AND b.tipo_destino=1 {*condicion_adicional_indicadores*}' WHERE idbusqueda_condicion = 226;

UPDATE busqueda_grafico_serie SET valor = 'count(b.destino)' WHERE idbusqueda_grafico_serie = 29;

UPDATE busqueda_grafico_serie SET valor = 'count(b.destino)' WHERE idbusqueda_grafico_serie = 30;


-- ------------------------------------------------------------------------
-- DESARROLLO OPCIONES PRINCIPALES DE SAIA BAJO PERMISO <andres.agudelo>

INSERT INTO modulo (idmodulo, pertenece_nucleo, nombre, tipo, imagen, etiqueta, enlace, enlace_mobil, destino, cod_padre, orden, ayuda, parametros, busqueda_idbusqueda, permiso_admin, busqueda, enlace_pantalla) VALUES
(1668, 1, 'centro_notificaciones', '1', 'botones/principal/defaut.png', '7. CENTRO DE NOTIFICACIONES', 'auxiliar2.php?modulo=1668', NULL, 'menu', 0, 1, '', '', 0, 0, '1', 0),
(1669, 1, 'mis_tareas', 'secundario', 'botones/principal/defaut.png', 'Mis Tareas', '#', NULL, '#', 1668, 1, '', '', 0, 0, '1', 0),
(1670, 1, 'mis_tareas_avanzadas', 'secundario', 'botones/principal/defaut.png', 'Mis Tareas (Av)', '#', NULL, '#', 1668, 2, '', '', 0, 0, '1', 0);

-- ------------------------------------------------------------------------
-- DESARROLLO PERMISOS ADMIN EN MODULOS <andres.agudelo>
INSERT INTO busqueda_condicion (busqueda_idbusqueda, fk_busqueda_componente, codigo_where, etiqueta_condicion) VALUES
(NULL, 30, '{*filtro_modulo_admin*}', 'condicion_modulo');
-- ------------------------------------------------------------------------
-- DESARROLLO - CORRECCION DOCUMENTO VINCULADOS COMO RESPUESTA <andres.agudelo>

DELETE FROM busqueda_componente WHERE idbusqueda_componente IN(165,167,291);
DELETE FROM busqueda_condicion WHERE idbusqueda_condicion IN(131,133,229);

INSERT INTO busqueda_componente (idbusqueda_componente, busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas) VALUES
(165, 49, 3, 2, 'busquedas/consulta_busqueda.php', 'Vinculados como respuesta', 'documentos_respuesta', 1, '<div class="row-fluid"><div class="pull-left tootltip_saia_abajo">{*numero*}-{*obtener_descripcion_informacion@descripcion*}</div><div class=''pull-right''><a href="#" enlace=''ordenar.php?key={*iddocumento*}&mostrar_formato=1'' conector=''iframe''  titulo="Documento No.{*numero*}" class=''kenlace_saia pull-left'' ><i class=''icon-download tooltip_saia_izquierda'' title=''Ver documento''></i></a></div></div>', NULL, NULL, NULL, 1, 320, 1, 'G.fecha, G.origen,A.numero,A.ejecutor,A.descripcion,A.iddocumento,A.plantilla', 'respuesta G, documento A', 'G.fecha', 'DESC', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(167, 49, 3, 2, 'busquedas/consulta_busqueda.php', 'asociado a', 'documentos_relacionados', 1, '<div class="row-fluid"><div class="pull-left tootltip_saia_abajo">{*numero*}-{*obtener_descripcion_informacion@descripcion*}</div><div class=''pull-right''><a href="#" enlace=''ordenar.php?key={*iddocumento*}&mostrar_formato=1'' conector=''iframe''  titulo="Documento No.{*numero*}" class=''kenlace_saia pull-left'' ><i class=''icon-download tooltip_saia_izquierda'' title=''Ver documento''></i></a></div></div>', NULL, NULL, NULL, 1, 320, 1, 'G.fecha, G.origen,A.numero,A.ejecutor,A.descripcion,A.iddocumento,A.plantilla', 'respuesta G, documento A', 'G.fecha', 'DESC', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(291, 49, 3, 2, 'busquedas/consulta_busqueda.php', 'Vinculado  por el funcionario', 'documentos_relacionados_a', 1, '<div class="row-fluid"><div class="pull-left tooltip_saia_abajo">{*numero*}-{*obtener_descripcion_informacion@descripcion*}</div><div class=''pull-right''><a href="#" enlace=''ordenar.php?key={*iddocumento*}&mostrar_formato=1'' conector=''iframe''  titulo="Documento No.{*numero*}" class=''kenlace_saia pull-left'' ><i class=''icon-download tooltip_saia_izquierda'' title=''Ver documento''></i></a></div></div>\n</div>', NULL, NULL, NULL, 1, 320, 1, 'F.fecha,F.documento_origen,F.documento_destino,F.funcionario_idfuncionario,F.observaciones,A.ejecutor,A.numero,A.iddocumento,A.descripcion', 'documento_vinculados F, documento A', 'F.fecha', 'DESC', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(328, 49, 3, 2, 'busquedas/consulta_busqueda.php', 'Vinculado  por el funcionario', 'documentos_relacionados_dest', 1, '<div class="row-fluid"><div class="pull-left tooltip_saia_abajo">{*numero*}-{*obtener_descripcion_informacion@descripcion*}</div><div class=''pull-right''><a href="#" enlace=''ordenar.php?key={*iddocumento*}&mostrar_formato=1'' conector=''iframe''  titulo="Documento No.{*numero*}" class=''kenlace_saia pull-left'' ><i class=''icon-download tooltip_saia_izquierda'' title=''Ver documento''></i></a></div></div>\n</div>', NULL, NULL, NULL, 1, 320, 1, 'F.fecha,F.documento_origen,F.documento_destino,F.funcionario_idfuncionario,F.observaciones,A.ejecutor,A.numero,A.iddocumento,A.descripcion', 'documento_vinculados F, documento A', 'F.fecha', 'DESC', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

INSERT INTO busqueda_condicion (idbusqueda_condicion, busqueda_idbusqueda, fk_busqueda_componente, codigo_where, etiqueta_condicion) VALUES
(131, NULL, 167, 'G.origen=A.iddocumento AND G.destino={*obtener_iddocumento*} AND lower(A.estado) NOT IN(''eliminado'',''anulado'')', 'documento asociados'),
(133, NULL, 165, 'G.destino=A.iddocumento AND G.origen={*obtener_iddocumento*} AND lower(A.estado) NOT IN(''eliminado'',''anulado'')', 'documentos como respuesta'),
(229, NULL, 291, 'F.documento_destino=A.iddocumento AND F.documento_origen={*obtener_iddocumento*} AND lower(A.estado) NOT IN(''eliminado'',''anulado'')', 'documentos vinculados por el funcionario'),
(251, NULL, 328, 'F.documento_origen=A.iddocumento AND F.documento_destino={*obtener_iddocumento*} AND lower(A.estado) NOT IN(''eliminado'',''anulado'')', 'documentos vinculados por el funcionario (Destino)');
-- ------------------------------------------------------------------------
-- ------------------------------------------------------------------------
-- ------------------------------------------------------------------------
-- CORRECCION DESARROLLO REMITENTES, REPORTE

CREATE OR REPLACE VIEW vejecutor  AS  select A.idejecutor AS idejecutor,A.identificacion AS identificacion,A.nombre AS nombre,A.fecha_ingreso AS fecha_ingreso,A.estado AS estado,B.iddatos_ejecutor AS iddatos_ejecutor,B.ejecutor_idejecutor AS ejecutor_idejecutor,B.direccion AS direccion,B.telefono AS telefono,B.cargo AS cargo,B.ciudad AS ciudad,B.titulo AS titulo,B.empresa AS empresa,B.fecha AS fecha,B.email AS email,B.codigo AS codigo,C.nombre AS ciudad_ejecutor,A.tipo_ejecutor from ((ejecutor A left join datos_ejecutor B on((A.idejecutor = B.ejecutor_idejecutor))) left join municipio C on((B.ciudad = C.idmunicipio))) ;

UPDATE busqueda SET campos = 'a.nombre,a.identificacion,a.fecha_ingreso,a.tipo_ejecutor' WHERE idbusqueda = 101 AND nombre='ejecutor';

UPDATE busqueda_componente SET info = '<div class="row"><div class="span5">{*mostrar_nombre@nombre,idejecutor,tipo_ejecutor*}<br/><b>Identificaci&oacute;n:</b> {*identificacion*}<br/><b>Fecha de ingreso:</b> {*fecha_ingreso*}</div><div class="span3"><b>Contacto:</b> {*empresa*}<br/><b>Cargo:</b> {*cargo*}<br/><b>Email:</b> {*email*}</div><div class="span4"><b>Direcci&oacute;n:</b> {*direccion*}<br/><b>Tel&eacute;fono:</b> {*telefono*}<br/><b>Ciudad:</b> {*ciudad_ejecutor*}</div></div>{*barra_inferior_remitente@idejecutor*}' WHERE idbusqueda_componente = 276 AND nombre='remitentes';
-- ------------------------------------------------------------------------
-- ------------------------------------------------------------------------
-- ------------------------------------------------------------------------
-- NUEVO BUZON DE PROCESO (ENVIADOS), TRAIDO DE AGUAS Y AGUAS ACTUALIZACION 2017 <ricardo.posada>
update busqueda set campos='c.estado, MAX(c.fecha) AS fecha, c.descripcion, c.plantilla, c.numero, c.serie, c.tipo_ejecutor, c.tipo_radicado, c.fecha_limite, c.ejecutor',llave='c.iddocumento',tablas='documento c JOIN buzon_salida a ON c.iddocumento=a.archivo_idarchivo',ruta_visualizacion='pantallas/busquedas/consulta_busqueda_documento.php' where idbusqueda=5;

update busqueda_componente set 	url='pantallas/busquedas/consulta_busqueda_documento.php',info='<div>{*origen_documento2@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor,ejecutor,plantilla*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<br><br><div>{*descripcion*}</div><br><br>{*barra_inferior_documento@iddocumento,numero*}</div>', ordenado_por='fecha', agrupado_por='c.estado, c.descripcion, c.plantilla, c.numero, c.serie, c.tipo_ejecutor, c.tipo_radicado, c.fecha_limite,c.iddocumento, c.ejecutor' where idbusqueda_componente=14;

update busqueda_condicion set codigo_where='(c.iddocumento NOT IN(SELECT documento_iddocumento FROM asignacion WHERE llave_entidad={*usuario_actual_buzon*}) AND a.origen ={*usuario_actual_buzon*} AND lower(a.nombre) NOT LIKE ''elimina%'' AND lower(a.nombre) NOT IN(''leido'') AND lower(c.estado) NOT IN(''eliminado'',''gestion'',''central'',''historico''))' where idbusqueda_condicion=19;
-- ------------------------------------------------------------------------
-- ------------------------------------------------------------------------
-- ------------------------------------------------------------------------
