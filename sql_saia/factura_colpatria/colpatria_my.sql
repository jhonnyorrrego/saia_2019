DROP TABLE IF EXISTS dt_datos_correo;
CREATE TABLE dt_datos_correo(
	iddt_datos_correo int NOT NULL AUTO_INCREMENT,
	idgrupo nvarchar(255) NOT NULL,
	uid int NOT NULL,
	asunto nvarchar(255) NOT NULL,
	fecha_oficio_entrada datetime default CURRENT_TIMESTAMP,
	de nvarchar(255) NULL,
	buzon_email nvarchar(255) NULL,
	para text NULL,
	anexos text NULL,
	comentario text NULL,
	transferir nvarchar(255) NULL,
	copia nvarchar(255) NULL,
	iddoc_rad int NULL,
	numero_rad int NULL,
 CONSTRAINT dt_datos_correo_pk PRIMARY KEY(
	iddt_datos_correo 
)
);

DROP TABLE IF EXISTS ft_correo_saia;
CREATE TABLE ft_correo_saia(
	serie_idserie int NULL,
	asunto varchar(255) NULL,
	de varchar(255) NULL,
	para text NULL,
	anexos text NULL,
	idft_correo_saia int NOT NULL AUTO_INCREMENT,
	documento_iddocumento int NULL,
	dependencia int NULL,
	encabezado int NULL,
	firma int NULL,
	fecha_oficio_entrada datetime default CURRENT_TIMESTAMP,
	comentario varchar(255) NULL,
	transferencia_correo int NULL,
	copia_correo varchar(255) NULL,
	estado_documento int NULL,
	no_factura varchar(255) NULL,
	nit_proveedor varchar(255) NULL,
	centro_costo varchar(255) NULL,
	adjunto_imagen varchar(255) NULL,
	ingresar_datos_factu int NULL,
	fecha_datos datetime default CURRENT_TIMESTAMP,
	responsable_datos_fa varchar(255) NULL,
	uid_correo varchar(255) NULL,
	buzon_correo varchar(255) NULL,
	fecha_factura datetime default CURRENT_TIMESTAMP,
	cant_dias int NULL,
	fecha_venc_fact datetime default CURRENT_TIMESTAMP,
	concepto_fact text NULL,
	valor_factura varchar(255) NULL,
	pago_desde int NULL,
 CONSTRAINT PK_IDFT_CORREO_SAIA PRIMARY KEY (
	idft_correo_saia
)
);

DROP TABLE IF EXISTS ft_facturas_obras;
CREATE TABLE ft_facturas_obras(
	estado_documento varchar(255) NULL,
	serie_idserie int NULL,
	idft_facturas_obras int NOT NULL AUTO_INCREMENT,
	documento_iddocumento int NULL,
	dependencia int NULL,
	encabezado int NULL,
	firma int NULL,
	fecha_radicacion datetime default CURRENT_TIMESTAMP,
	fecha_factura datetime default CURRENT_TIMESTAMP,
	numero_factura varchar(255) NULL,
	concepto_factura text NULL,
	valor_factura varchar(30) NULL,
	vence_factura datetime default CURRENT_TIMESTAMP,
	numero_guia varchar(50) NULL,
	empresa_trans int NULL,
	numero_folios varchar(50) NULL,
	anexos_fisicos text NULL,
	anexos_digitales varchar(255) NULL,
	persona_natural int NULL,
	destino int NULL,
	copia varchar(255) NULL,
	fecha_pago datetime default CURRENT_TIMESTAMP,
	func_fecha_pago int NULL,
	fecha_accion_pago datetime default CURRENT_TIMESTAMP,
	numero_radicado int NULL,
 CONSTRAINT PK_IDFT_FACTURAS_OBRAS PRIMARY KEY (
	idft_facturas_obras 
)
);

ALTER TABLE ft_correo_saia ALTER serie_idserie SET DEFAULT 11;
ALTER TABLE ft_correo_saia ALTER encabezado SET DEFAULT 1;
ALTER TABLE ft_correo_saia ALTER firma SET DEFAULT 1;
ALTER TABLE ft_correo_saia ALTER estado_documento SET DEFAULT 1;
ALTER TABLE ft_correo_saia ALTER ingresar_datos_factu SET DEFAULT 1;
ALTER TABLE ft_facturas_obras ALTER serie_idserie SET DEFAULT 2621;
ALTER TABLE ft_facturas_obras ALTER encabezado SET DEFAULT 1;
ALTER TABLE ft_facturas_obras ALTER firma SET DEFAULT 1;
ALTER TABLE dt_datos_correo ALTER fecha_oficio_entrada SET DEFAULT NULL;
ALTER TABLE dt_datos_correo ALTER iddoc_rad SET DEFAULT 0;
ALTER TABLE dt_datos_correo ALTER numero_rad SET DEFAULT 0;
