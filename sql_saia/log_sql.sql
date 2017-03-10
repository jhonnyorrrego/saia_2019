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


