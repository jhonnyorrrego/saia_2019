<?php
$vistas = array("mysql" => [
    "vdependencia_serie" => "select concat(d.codigo,'.',s.codigo) AS orden_dependencia_serie,d.nombre AS dependencia,s.idserie AS idserie,d.iddependencia AS iddependencia,s.nombre AS nombre,(case s.estado when 1 then 'Activo' else 'Inactivo' end) AS estado,s.codigo AS codigo,(case s.tipo when 1 then 'Serie' when 2 then 'Subserie' else 'Tipo documental' end) AS tipo,s.tipo AS tipo_serie,s.retencion_gestion AS retencion_gestion,s.retencion_central AS retencion_central,s.conservacion AS conservacion,s.seleccion AS seleccion,s.digitalizacion AS digitalizacion,s.procedimiento AS procedimiento,s.tvd AS tvd from serie s join entidad_serie e on e.serie_idserie = s.idserie join dependencia d on e.llave_entidad = d.iddependencia where s.categoria = 2 and d.tipo = 1",
    "vdocumento" => "select A.iddocumento AS iddocumento,A.estado AS estado,A.descripcion AS descripcion,B.nombre AS serie,A.fecha AS fecha,A.tipo_radicado AS tipo_radicado,A.plantilla AS plantilla from documento A join serie B where A.serie = B.idserie",
    "vdocumentos_pendientes" => "select A.iddocumento AS iddocumento,A.numero AS numero,A.descripcion AS descripcion,A.fecha_creacion AS fecha_creacion,A.serie AS serie,A.estado AS estado,B.llave_entidad AS llave_entidad,A.plantilla AS plantilla from asignacion B join documento A on A.iddocumento = B.documento_iddocumento where A.estado <> 'ELIMINADO' and B.tarea_idtarea = 2 group by A.iddocumento,A.numero,A.descripcion,A.fecha_creacion,A.serie,A.estado,B.llave_entidad,A.plantilla",
    "vdocumentos_proceso" => "select A.fecha_limite AS fecha_limite,A.iddocumento AS iddocumento,A.numero AS numero,A.descripcion AS descripcion,A.plantilla AS plantilla,A.fecha AS fecha,A.estado AS estado,A.serie AS serie,A.tipo_ejecutor AS tipo_ejecutor,A.tipo_radicado AS tipo_radicado from documento A left join vdocumentos_pendientes C on A.iddocumento = C.iddocumento where A.estado not in ('GESTION','CENTRAL','HISTORICO','INICIADO','ANULADO','ELIMINADO') and C.iddocumento is not null group by A.iddocumento,A.numero,A.descripcion,A.plantilla,A.fecha,A.estado,A.serie,A.tipo_ejecutor",
    "vejecutor" => "select A.idejecutor AS idejecutor,A.identificacion AS identificacion,A.nombre AS nombre,A.fecha_ingreso AS fecha_ingreso,A.estado AS estado,B.iddatos_ejecutor AS iddatos_ejecutor,B.ejecutor_idejecutor AS ejecutor_idejecutor,B.direccion AS direccion,B.telefono AS telefono,B.cargo AS cargo,B.ciudad AS ciudad,B.titulo AS titulo,B.empresa AS empresa,B.fecha AS fecha,B.email AS email,B.codigo AS codigo,C.nombre AS ciudad_ejecutor,A.tipo_ejecutor AS tipo_ejecutor from ejecutor A left join datos_ejecutor B on A.idejecutor = B.ejecutor_idejecutor left join municipio C on B.ciudad = C.idmunicipio",
    "vexpediente_serie" => "select a.propietario AS propietario,c.nombre AS nombre_serie,a.fecha AS fecha,a.nombre AS nombre,a.codigo_numero AS codigo_numero,a.descripcion AS descripcion,a.cod_arbol AS cod_arbol,a.cod_padre AS cod_padre,a.estado_archivo AS estado_archivo,a.fk_idcaja AS fk_idcaja,a.estado_cierre AS estado_cierre,a.idexpediente AS idexpediente,b.entidad_identidad AS identidad_exp,b.llave_entidad AS llave_exp,d.entidad_identidad AS identidad_ser,d.llave_entidad AS llave_ser,d.estado AS estado_entidad_serie,a.prox_estado_archivo AS prox_estado_archivo,a.fecha_extrema_i AS fecha_extrema_i,a.fecha_extrema_f AS fecha_extrema_f,a.no_unidad_conservacion AS no_unidad_conservacion,a.no_folios AS no_folios,a.no_carpeta AS no_carpeta,a.soporte AS soporte,a.notas_transf AS notas_transf,a.tomo_no AS tomo_no,a.agrupador AS agrupador,a.indice_uno AS indice_uno,a.indice_dos AS indice_dos,a.indice_tres AS indice_tres from expediente a left join entidad_expediente b on a.idexpediente = b.expediente_idexpediente left join serie c on a.serie_idserie = c.idserie left join entidad_serie d on c.idserie = d.serie_idserie",
    "vfuncionario_dc" => "select b.idfuncionario AS idfuncionario,b.funcionario_codigo AS funcionario_codigo,b.login AS login,b.nombres AS nombres,b.apellidos AS apellidos,b.firma AS firma,b.estado AS estado,b.fecha_ingreso AS fecha_ingreso,b.clave AS clave,b.nit AS nit,b.perfil AS perfil,b.debe_firmar AS debe_firmar,b.mensajeria AS mensajeria,b.email AS email,b.sistema AS sistema,b.tipo AS tipo,b.ultimo_pwd AS ultimo_pwd,b.direccion AS direccion,b.telefono AS telefono,c.nombre AS cargo,c.idcargo AS idcargo,c.tipo_cargo AS tipo_cargo,a.nombre AS dependencia,a.estado AS estado_dep,a.codigo AS codigo,a.tipo AS tipo_dep,a.iddependencia AS iddependencia,a.fecha_ingreso AS creacion_dep,a.cod_padre AS cod_padre,a.extension AS extension,a.ubicacion_dependencia AS ubicacion_dependencia,a.logo AS logo,d.iddependencia_cargo AS iddependencia_cargo,d.estado AS estado_dc,d.fecha_inicial AS fecha_inicial,d.fecha_final AS fecha_final,d.fecha_ingreso AS creacion_dc,d.tipo AS tipo_dc from dependencia a join funcionario b join cargo c join dependencia_cargo d where a.iddependencia = d.dependencia_iddependencia and b.idfuncionario = d.funcionario_idfuncionario and c.idcargo = d.cargo_idcargo",
    "vpantalla_formato" => "select formato.mostrar_pdf AS mostrar_pdf,formato.nombre_tabla AS nombre_tabla,formato.idformato AS idformato,formato.nombre AS nombre,formato.etiqueta AS etiqueta,formato.ruta_adicionar AS ruta_adicionar,formato.ruta_mostrar AS ruta_mostrar,formato.mostrar AS mostrar,formato.cod_padre AS cod_padre,formato.fk_categoria_formato AS fk_categoria_formato,'F' AS formato_pantalla from formato union select '' AS mostrar_pdf,pantalla.nombre AS nombre_tabla,pantalla.idpantalla AS idformato,pantalla.nombre AS nombre,pantalla.etiqueta AS etiqueta,concat('adicionar_',pantalla.nombre,'.php') AS ruta_adicionar,concat('mostrar_',pantalla.nombre,'.php') AS ruta_mostrar,1 AS mostrar,pantalla.cod_padre AS cod_padre,pantalla.fk_idpantalla_categoria AS fk_categoria_formato,'P' AS formato_pantalla from pantalla where pantalla.tipo_pantalla = 2 and (isnull(pantalla.cod_padre) or (pantalla.cod_padre = 0))",
    "vreporte_inventario" => "select ft_inventario_retirados.documento_iddocumento AS documento_iddocumento,ft_inventario_retirados.ubicacion AS ubicacion,ft_inventario_retirados.numero_caja AS numero_caja,ft_inventario_retirados.fecha_extrema_inicia AS fecha_extrema_inicia,ft_inventario_retirados.fecha_extrema_final AS fecha_extrema_final,ft_inventario_retirados.folios AS folios,ft_inventario_retirados.observaciones AS observaciones from ft_inventario_retirados union select ft_inventario_jubilados.documento_iddocumento AS documento_iddocumento,ft_inventario_jubilados.ubicacion AS ubicacion,ft_inventario_jubilados.numero_caja AS numero_caja,ft_inventario_jubilados.fecha_extrema_inicia AS fecha_extrema_inicia,ft_inventario_jubilados.fecha_extrema_final AS fecha_extrema_final,ft_inventario_jubilados.folios AS folios,ft_inventario_jubilados.observaciones AS observaciones from ft_inventario_jubilados",
    "vusuarios_concurrentes" => "select f.funcionario_codigo AS funcionario_codigo,f.nit AS nit,concat(f.nombres,' ',f.apellidos) AS nombre_completo,f.login AS login,count(l.login) AS cant_conexiones from log_acceso l join funcionario f on f.login = l.login where f.login not in ('cerok','mensajero','radicador_web','radicador_salida') and l.exito = 1 and isnull(l.fecha_cierre) group by f.funcionario_codigo,f.nit,f.nombres,f.apellidos,f.login"
    ],
    "oracle" => [
        "vdependencia_serie" => "select d.codigo || '.' || s.codigo AS orden_dependencia_serie,d.nombre AS dependencia,s.idserie AS idserie,d.iddependencia AS iddependencia,s.nombre AS nombre,(case s.estado when 1 then 'Activo' else 'Inactivo' end) AS estado,s.codigo AS codigo,(case s.tipo when 1 then 'Serie' when 2 then 'Subserie' else 'Tipo documental' end) AS tipo,s.tipo AS tipo_serie,s.retencion_gestion AS retencion_gestion,s.retencion_central AS retencion_central,s.conservacion AS conservacion,s.seleccion AS seleccion,s.digitalizacion AS digitalizacion,s.procedimiento AS procedimiento,s.tvd AS tvd from serie s join entidad_serie e on e.serie_idserie = s.idserie join dependencia d on e.llave_entidad = d.iddependencia where s.categoria = 2 and d.tipo = 1",
        "vdocumento" => "select A.iddocumento AS iddocumento,A.estado AS estado,A.descripcion AS descripcion,B.nombre AS serie,A.fecha AS fecha,A.tipo_radicado AS tipo_radicado,A.plantilla AS plantilla from documento A join serie B on A.serie = B.idserie",
        "vdocumentos_pendientes" => "select A.iddocumento AS iddocumento,A.numero AS numero,TO_CHAR(A.descripcion) AS descripcion,A.fecha_creacion AS fecha_creacion,A.serie AS serie,A.estado AS estado,B.llave_entidad AS llave_entidad,A.plantilla AS plantilla from asignacion B join documento A on A.iddocumento = B.documento_iddocumento where A.estado <> 'ELIMINADO' and B.tarea_idtarea = 2",
        "vdocumentos_proceso" => "select A.fecha_limite AS fecha_limite,A.iddocumento AS iddocumento,A.numero AS numero,to_char(A.descripcion) AS descripcion,A.plantilla AS plantilla,A.fecha AS fecha,A.estado AS estado,A.serie AS serie,A.tipo_ejecutor AS tipo_ejecutor,A.tipo_radicado AS tipo_radicado from documento A left join asignacion C on A.iddocumento = C.documento_iddocumento where A.estado not in ('GESTION','CENTRAL','HISTORICO','INICIADO','ANULADO','ELIMINADO') and C.documento_iddocumento is not null",
        "vejecutor" => "select A.idejecutor AS idejecutor,A.identificacion AS identificacion,A.nombre AS nombre,A.fecha_ingreso AS fecha_ingreso,A.estado AS estado,B.iddatos_ejecutor AS iddatos_ejecutor,B.ejecutor_idejecutor AS ejecutor_idejecutor,B.direccion AS direccion,B.telefono AS telefono,B.cargo AS cargo,B.ciudad AS ciudad,B.titulo AS titulo,B.empresa AS empresa,B.fecha AS fecha,B.email AS email,B.codigo AS codigo,C.nombre AS ciudad_ejecutor,A.tipo_ejecutor AS tipo_ejecutor from ejecutor A left join datos_ejecutor B on A.idejecutor = B.ejecutor_idejecutor left join municipio C on B.ciudad = C.idmunicipio",
        "vexpediente_serie" => "select a.propietario AS propietario,c.nombre AS nombre_serie,a.fecha AS fecha,a.nombre AS nombre,a.codigo_numero AS codigo_numero,a.descripcion AS descripcion,a.cod_arbol AS cod_arbol,a.cod_padre AS cod_padre,a.estado_archivo AS estado_archivo,a.fk_idcaja AS fk_idcaja,a.estado_cierre AS estado_cierre,a.idexpediente AS idexpediente,b.entidad_identidad AS identidad_exp,b.llave_entidad AS llave_exp,d.entidad_identidad AS identidad_ser,d.llave_entidad AS llave_ser,d.estado AS estado_entidad_serie,a.prox_estado_archivo AS prox_estado_archivo,a.fecha_extrema_i AS fecha_extrema_i,a.fecha_extrema_f AS fecha_extrema_f,a.no_unidad_conservacion AS no_unidad_conservacion,a.no_folios AS no_folios,a.no_carpeta AS no_carpeta,a.soporte AS soporte,a.notas_transf AS notas_transf,a.tomo_no AS tomo_no,a.agrupador AS agrupador,a.indice_uno AS indice_uno,a.indice_dos AS indice_dos,a.indice_tres AS indice_tres from expediente a left join entidad_expediente b on a.idexpediente = b.expediente_idexpediente left join serie c on a.serie_idserie = c.idserie left join entidad_serie d on c.idserie = d.serie_idserie",
        "vfuncionario_dc" => "SELECT b.idfuncionario AS idfuncionario, b.funcionario_codigo AS funcionario_codigo, b.login AS login, b.nombres AS nombres, b.apellidos AS apellidos, b.firma AS firma, b.estado AS estado, b.fecha_ingreso AS fecha_ingreso, b.clave AS clave, b.nit AS nit, b.perfil AS perfil, b.debe_firmar AS debe_firmar, b.mensajeria AS mensajeria, b.email AS email, b.sistema AS sistema, b.tipo AS tipo, b.ultimo_pwd AS ultimo_pwd, b.direccion AS direccion, b.telefono AS telefono, c.nombre AS cargo, c.idcargo AS idcargo, c.tipo_cargo AS tipo_cargo, a.nombre AS dependencia, a.estado AS estado_dep, a.codigo AS codigo, a.tipo AS tipo_dep, a.iddependencia AS iddependencia, a.fecha_ingreso AS creacion_dep, a.cod_padre AS cod_padre, a.extension AS extension, a.ubicacion_dependencia AS ubicacion_dependencia, a.logo AS logo, d.iddependencia_cargo AS iddependencia_cargo, d.estado AS estado_dc, d.fecha_inicial AS fecha_inicial, d.fecha_final AS fecha_final, d.fecha_ingreso AS creacion_dc, d.tipo AS tipo_dc FROM dependencia a, funcionario b, cargo c, dependencia_cargo d WHERE a.iddependencia = d.dependencia_iddependencia AND b.idfuncionario = d.funcionario_idfuncionario AND c.idcargo = d.cargo_idcargo",
        "vpantalla_formato" => "select mostrar_pdf,nombre_tabla,idformato,nombre,etiqueta,ruta_adicionar, ruta_mostrar,mostrar,cod_padre,fk_categoria_formato,'F' AS formato_pantalla from formato union select null AS mostrar_pdf,nombre,idpantalla,nombre,etiqueta,'adicionar_' || nombre || '.php' AS ruta_adicionar, 'mostrar_' || pantalla.nombre ||'.php' AS ruta_mostrar,'1' AS mostrar,pantalla.cod_padre AS cod_padre,fk_idpantalla_categoria AS fk_categoria_formato,'P' AS formato_pantalla from pantalla where pantalla.tipo_pantalla = 2 and (pantalla.cod_padre is null or pantalla.cod_padre = 0)",
        "vreporte_inventario" => "select ft_inventario_retirados.documento_iddocumento AS documento_iddocumento,ft_inventario_retirados.ubicacion AS ubicacion,ft_inventario_retirados.numero_caja AS numero_caja,ft_inventario_retirados.fecha_extrema_inicia AS fecha_extrema_inicia,ft_inventario_retirados.fecha_extrema_final AS fecha_extrema_final,ft_inventario_retirados.folios AS folios,ft_inventario_retirados.observaciones AS observaciones from ft_inventario_retirados union select ft_inventario_jubilados.documento_iddocumento AS documento_iddocumento,ft_inventario_jubilados.ubicacion AS ubicacion,ft_inventario_jubilados.numero_caja AS numero_caja,ft_inventario_jubilados.fecha_extrema_inicia AS fecha_extrema_inicia,ft_inventario_jubilados.fecha_extrema_final AS fecha_extrema_final,ft_inventario_jubilados.folios AS folios,ft_inventario_jubilados.observaciones AS observaciones from ft_inventario_jubilados",
        "vusuarios_concurrentes" => "select f.funcionario_codigo AS funcionario_codigo,f.nit AS nit,f.nombres || ' ' || f.apellidos AS nombre_completo,f.login AS login,count(l.login) AS cant_conexiones from log_acceso l join funcionario f on f.login = l.login where f.login not in ('cerok','mensajero','radicador_web','radicador_salida') and l.exito = 1 and l.fecha_cierre is null group by f.funcionario_codigo,f.nit,f.nombres,f.apellidos,f.login"
    ]
);
/*
 * "MySql",
 * "Oracle",
 * "SqlServer",
 * "MSSql",
 * "Postgres"
 */
$procs = [
    "mysql" => [
        "sp_asignar_radicado" => "CREATE PROCEDURE sp_asignar_radicado(IN iddoc INT, IN tipo INT, IN funcionario INT)
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
END"
    ],
    "oracle" => [
        "SP_ASIGNAR_RADICADO" => "CREATE OR REPLACE PROCEDURE SP_ASIGNAR_RADICADO (iddoc INT, tipo INT, funcionario INT)
  is
  un_valor number(10);
  un_numero number(10);
  sentencia_doc CLOB;
  sentencia_cont CLOB;
  BEGIN
  SELECT consecutivo INTO un_valor FROM contador WHERE idcontador=tipo;
  UPDATE documento SET numero=un_valor WHERE iddocumento=iddoc;
  un_numero := un_valor;
  un_valor := un_valor+1;
  UPDATE contador SET consecutivo=un_valor WHERE idcontador=tipo;
  sentencia_doc  := 'UPDATE documento SET numero=' || un_numero || ' WHERE iddocumento='  || iddoc;
  sentencia_cont := 'UPDATE contador  SET consecutivo=' || un_valor || ' WHERE idcontador=' || tipo;
  INSERT INTO evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado, codigo_sql) VALUES(to_char(funcionario), CURRENT_TIMESTAMP, 'MODIFICAR', 'documento', un_valor, 0, sentencia_doc);
  INSERT INTO evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado, codigo_sql) VALUES(to_char(funcionario), CURRENT_TIMESTAMP, 'MODIFICAR', 'contador', un_valor, 0, sentencia_cont);
  END;"
    ],
    "sqlserver" => [
        "sp_asignar_radicado" => "CREATE PROCEDURE [dbo].[sp_asignar_radicado]
   @iddoc int,
   @tipo int
   @funcionario int
AS
   BEGIN
      SET  XACT_ABORT  ON
      SET  NOCOUNT  ON
      DECLARE
         @valor nvarchar(50)
      DECLARE @sentencia nvarchar(2000)
      SELECT @valor = CAST(contador.consecutivo AS varchar(50)) FROM dbo.contador WHERE contador.idcontador = @tipo

      UPDATE dbo.documento SET numero = @valor WHERE documento.iddocumento = @iddoc

      UPDATE dbo.contador SET consecutivo = contador.consecutivo + 1 WHERE contador.idcontador = @tipo

      SET @sentencia = concat('UPDATE documento SET numero=', @valor, ' WHERE iddocumento=',@iddoc)
      INSERT INTO dbo.evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado, codigo_sql, detalle) VALUES(@funcionario, CURRENT_TIMESTAMP, 'MODIFICAR', 'documento', @valor, 0, @sentencia, null);
      SET @sentencia = concat('UPDATE contador SET consecutivo=', @valor+1, ' WHERE idcontador=',@tipo);
      INSERT INTO dbo.evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado, codigo_sql, detalle) VALUES(@funcionario, CURRENT_TIMESTAMP, 'MODIFICAR', 'contador', @valor+1, 0, @sentencia,null);
   END"
    ],
    "postgres" => [
        "sp_asignar_radicado" => "CREATE OR REPLACE FUNCTION public.sp_asignar_radicado(
	iddoc integer,
	tipo integer,
	funcionario integer)
    RETURNS void
    LANGUAGE 'plpgsql'" . 'AS $BODY$' . "
DECLARE valor integer;
sentencia VARCHAR(2000);
BEGIN
SELECT consecutivo INTO valor FROM contador WHERE idcontador=tipo;
UPDATE documento SET numero=valor WHERE iddocumento=iddoc;
UPDATE contador SET consecutivo=consecutivo+1 WHERE idcontador=tipo;
sentencia = concat('UPDATE documento SET numero=', valor, ' WHERE iddocumento=',iddoc);
INSERT INTO evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado, codigo_sql, detalle) VALUES(funcionario, CURRENT_TIMESTAMP, 'MODIFICAR', 'documento', valor, 0,sentencia,null);
sentencia = ('UPDATE contador SET consecutivo=', valor+1, ' WHERE idcontador=',tipo);
INSERT INTO evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado, codigo_sql, detalle) VALUES(funcionario, CURRENT_TIMESTAMP, 'MODIFICAR', 'contador', valor+1, 0,sentencia,null);
END;"
    ]
];
