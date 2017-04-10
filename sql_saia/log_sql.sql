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
UPDATE  modulo SET  enlace =  'pantallas/busquedas/consulta_busqueda.php',enlace_pantalla =  '1' WHERE  idmodulo =17;
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