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

