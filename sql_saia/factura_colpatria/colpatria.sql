USE [saia]
GO
/****** Object:  Table [dbo].[campos_formato]    Script Date: 14/12/2018 11:25:56 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[campos_formato](
	[idcampos_formato] [int] IDENTITY(5188,1) NOT NULL,
	[formato_idformato] [int] NOT NULL,
	[nombre] [nvarchar](255) NOT NULL,
	[etiqueta] [nvarchar](255) NOT NULL,
	[tipo_dato] [nvarchar](255) NOT NULL,
	[longitud] [nvarchar](255) NULL,
	[obligatoriedad] [smallint] NOT NULL,
	[valor] [nvarchar](max) NULL,
	[acciones] [nvarchar](10) NULL,
	[ayuda] [nvarchar](max) NULL,
	[predeterminado] [nvarchar](255) NULL,
	[banderas] [nvarchar](50) NULL,
	[etiqueta_html] [nvarchar](255) NOT NULL,
	[orden] [smallint] NOT NULL,
	[mascara] [nvarchar](255) NULL,
	[adicionales] [nvarchar](255) NULL,
	[autoguardado] [int] NOT NULL,
	[fila_visible] [int] NULL,
 CONSTRAINT [campos_formato_pk] PRIMARY KEY CLUSTERED 
(
	[idcampos_formato] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[formato]    Script Date: 14/12/2018 11:25:56 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[formato](
	[idformato] [int] IDENTITY(420,1) NOT NULL,
	[nombre] [nvarchar](255) NOT NULL,
	[etiqueta] [nvarchar](255) NOT NULL,
	[cod_padre] [int] NOT NULL,
	[contador_idcontador] [int] NULL,
	[nombre_tabla] [nvarchar](255) NOT NULL,
	[ruta_mostrar] [nvarchar](255) NOT NULL,
	[ruta_editar] [nvarchar](255) NOT NULL,
	[ruta_adicionar] [nvarchar](255) NOT NULL,
	[librerias] [nvarchar](255) NULL,
	[estilos] [nvarchar](255) NULL,
	[javascript] [nvarchar](255) NULL,
	[encabezado] [nvarchar](max) NULL,
	[cuerpo] [nvarchar](max) NULL,
	[pie_pagina] [nvarchar](max) NULL,
	[margenes] [nvarchar](50) NOT NULL,
	[orientacion] [nvarchar](50) NULL,
	[papel] [nvarchar](50) NULL,
	[exportar] [nvarchar](255) NULL,
	[funcionario_idfuncionario] [int] NOT NULL,
	[fecha] [datetime] NOT NULL,
	[mostrar] [nvarchar](1) NOT NULL,
	[imagen] [nvarchar](255) NULL,
	[detalle] [nvarchar](1) NOT NULL,
	[tipo_edicion] [smallint] NOT NULL,
	[item] [nvarchar](1) NOT NULL,
	[serie_idserie] [int] NOT NULL,
	[ayuda] [nvarchar](400) NULL,
	[font_size] [nvarchar](5) NOT NULL,
	[banderas] [nvarchar](255) NOT NULL,
	[tiempo_autoguardado] [nvarchar](20) NOT NULL,
	[mostrar_pdf] [int] NOT NULL,
	[orden] [int] NULL,
	[enter2tab] [smallint] NOT NULL,
	[firma_digital] [int] NOT NULL,
	[fk_categoria_formato] [nvarchar](255) NULL,
	[flujo_idflujo] [int] NULL,
	[funcion_predeterminada] [nvarchar](255) NULL,
	[paginar] [nvarchar](1) NOT NULL,
	[pertenece_nucleo] [int] NOT NULL,
	[permite_imprimir] [int] NULL,
 CONSTRAINT [formato_pk] PRIMARY KEY CLUSTERED 
(
	[idformato] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ft_correo_saia]    Script Date: 14/12/2018 11:25:57 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ft_correo_saia](
	[serie_idserie] [int] NULL,
	[asunto] [varchar](255) NULL,
	[de] [varchar](255) NULL,
	[para] [text] NULL,
	[anexos] [text] NULL,
	[idft_correo_saia] [int] IDENTITY(1,1) NOT NULL,
	[documento_iddocumento] [int] NULL,
	[dependencia] [int] NULL,
	[encabezado] [int] NULL,
	[firma] [int] NULL,
	[fecha_oficio_entrada] [datetime] NULL,
	[comentario] [varchar](255) NULL,
	[transferencia_correo] [int] NULL,
	[copia_correo] [varchar](255) NULL,
	[estado_documento] [int] NULL,
	[no_factura] [varchar](255) NULL,
	[nit_proveedor] [varchar](255) NULL,
	[centro_costo] [varchar](255) NULL,
	[adjunto_imagen] [varchar](255) NULL,
	[ingresar_datos_factu] [int] NULL,
	[fecha_datos] [datetime] NULL,
	[responsable_datos_fa] [varchar](255) NULL,
	[uid_correo] [varchar](255) NULL,
	[buzon_correo] [varchar](255) NULL,
	[fecha_factura] [datetime] NULL,
	[cant_dias] [int] NULL,
	[fecha_venc_fact] [datetime] NULL,
	[concepto_fact] [text] NULL,
	[valor_factura] [varchar](255) NULL,
	[pago_desde] [int] NULL,
 CONSTRAINT [PK_IDFT_CORREO_SAIA_4458] PRIMARY KEY CLUSTERED 
(
	[idft_correo_saia] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ft_facturas_obras]    Script Date: 14/12/2018 11:25:57 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ft_facturas_obras](
	[estado_documento] [varchar](255) NULL,
	[serie_idserie] [int] NULL,
	[idft_facturas_obras] [int] IDENTITY(1,1) NOT NULL,
	[documento_iddocumento] [int] NULL,
	[dependencia] [int] NULL,
	[encabezado] [int] NULL,
	[firma] [int] NULL,
	[fecha_radicacion] [datetime] NULL,
	[fecha_factura] [datetime] NULL,
	[numero_factura] [varchar](255) NULL,
	[concepto_factura] [text] NULL,
	[valor_factura] [varchar](30) NULL,
	[vence_factura] [datetime] NULL,
	[numero_guia] [varchar](50) NULL,
	[empresa_trans] [int] NULL,
	[numero_folios] [varchar](50) NULL,
	[anexos_fisicos] [text] NULL,
	[anexos_digitales] [varchar](255) NULL,
	[persona_natural] [int] NULL,
	[destino] [int] NULL,
	[copia] [varchar](255) NULL,
	[fecha_pago] [datetime] NULL,
	[func_fecha_pago] [int] NULL,
	[fecha_accion_pago] [datetime] NULL,
	[numero_radicado] [int] NULL,
 CONSTRAINT [PK_IDFT_FACTURAS_OBRAS_6802] PRIMARY KEY CLUSTERED 
(
	[idft_facturas_obras] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[modulo]    Script Date: 14/12/2018 11:25:57 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[modulo](
	[idmodulo] [int] IDENTITY(1650,1) NOT NULL,
	[pertenece_nucleo] [int] NOT NULL,
	[nombre] [nvarchar](255) NOT NULL,
	[tipo] [nvarchar](255) NOT NULL,
	[imagen] [nvarchar](255) NULL,
	[etiqueta] [nvarchar](255) NOT NULL,
	[enlace] [nvarchar](255) NOT NULL,
	[enlace_mobil] [nvarchar](255) NULL,
	[destino] [nvarchar](255) NOT NULL,
	[cod_padre] [int] NULL,
	[orden] [smallint] NOT NULL,
	[ayuda] [nvarchar](max) NOT NULL,
	[parametros] [nvarchar](255) NULL,
	[busqueda_idbusqueda] [int] NULL,
	[permiso_admin] [smallint] NOT NULL,
	[busqueda] [nvarchar](5) NULL,
	[enlace_pantalla] [int] NULL,
 CONSTRAINT [modulo_pk] PRIMARY KEY CLUSTERED 
(
	[idmodulo] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[rcmail_cache]    Script Date: 14/12/2018 11:25:57 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[rcmail_cache](
	[user_id] [bigint] NOT NULL,
	[cache_key] [nvarchar](128) NOT NULL,
	[created] [datetime2](0) NOT NULL,
	[expires] [datetime2](0) NULL,
	[data] [nvarchar](max) NOT NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[rcmail_cache_index]    Script Date: 14/12/2018 11:25:57 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[rcmail_cache_index](
	[user_id] [bigint] NOT NULL,
	[mailbox] [nvarchar](255) NOT NULL,
	[expires] [datetime2](0) NULL,
	[valid] [smallint] NOT NULL,
	[data] [nvarchar](max) NOT NULL,
 CONSTRAINT [PK_rcmail_cache_index_user_id] PRIMARY KEY CLUSTERED 
(
	[user_id] ASC,
	[mailbox] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[rcmail_cache_messages]    Script Date: 14/12/2018 11:25:58 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[rcmail_cache_messages](
	[user_id] [bigint] NOT NULL,
	[mailbox] [nvarchar](255) NOT NULL,
	[uid] [bigint] NOT NULL,
	[expires] [datetime2](0) NULL,
	[data] [nvarchar](max) NOT NULL,
	[flags] [int] NOT NULL,
 CONSTRAINT [PK_rcmail_cache_messages_user_id] PRIMARY KEY CLUSTERED 
(
	[user_id] ASC,
	[mailbox] ASC,
	[uid] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[rcmail_cache_shared]    Script Date: 14/12/2018 11:25:58 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[rcmail_cache_shared](
	[cache_key] [nvarchar](255) NOT NULL,
	[created] [datetime2](0) NOT NULL,
	[expires] [datetime2](0) NULL,
	[data] [nvarchar](max) NOT NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[rcmail_cache_thread]    Script Date: 14/12/2018 11:25:58 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[rcmail_cache_thread](
	[user_id] [bigint] NOT NULL,
	[mailbox] [nvarchar](255) NOT NULL,
	[expires] [datetime2](0) NULL,
	[data] [nvarchar](max) NOT NULL,
 CONSTRAINT [PK_rcmail_cache_thread_user_id] PRIMARY KEY CLUSTERED 
(
	[user_id] ASC,
	[mailbox] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[rcmail_contactgroupmembers]    Script Date: 14/12/2018 11:25:58 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[rcmail_contactgroupmembers](
	[contactgroup_id] [bigint] NOT NULL,
	[contact_id] [bigint] NOT NULL,
	[created] [datetime2](0) NOT NULL,
 CONSTRAINT [PK_rcmail_contactgroupmembers_contactgroup_id] PRIMARY KEY CLUSTERED 
(
	[contactgroup_id] ASC,
	[contact_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[rcmail_contactgroups]    Script Date: 14/12/2018 11:25:58 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[rcmail_contactgroups](
	[contactgroup_id] [bigint] IDENTITY(1,1) NOT NULL,
	[user_id] [bigint] NOT NULL,
	[changed] [datetime2](0) NOT NULL,
	[del] [smallint] NOT NULL,
	[name] [nvarchar](128) NOT NULL,
 CONSTRAINT [PK_rcmail_contactgroups_contactgroup_id] PRIMARY KEY CLUSTERED 
(
	[contactgroup_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[rcmail_contacts]    Script Date: 14/12/2018 11:25:58 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[rcmail_contacts](
	[contact_id] [bigint] IDENTITY(1,1) NOT NULL,
	[changed] [datetime2](0) NOT NULL,
	[del] [smallint] NOT NULL,
	[name] [nvarchar](128) NOT NULL,
	[email] [nvarchar](max) NOT NULL,
	[firstname] [nvarchar](128) NOT NULL,
	[surname] [nvarchar](128) NOT NULL,
	[vcard] [nvarchar](max) NULL,
	[words] [nvarchar](max) NULL,
	[user_id] [bigint] NOT NULL,
 CONSTRAINT [PK_rcmail_contacts_contact_id] PRIMARY KEY CLUSTERED 
(
	[contact_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[rcmail_dictionary]    Script Date: 14/12/2018 11:25:59 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[rcmail_dictionary](
	[user_id] [bigint] NULL,
	[language] [nvarchar](5) NOT NULL,
	[data] [nvarchar](max) NOT NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[rcmail_identities]    Script Date: 14/12/2018 11:25:59 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[rcmail_identities](
	[identity_id] [bigint] IDENTITY(1,1) NOT NULL,
	[user_id] [bigint] NOT NULL,
	[changed] [datetime2](0) NOT NULL,
	[del] [smallint] NOT NULL,
	[standard] [smallint] NOT NULL,
	[name] [nvarchar](128) NOT NULL,
	[organization] [nvarchar](128) NOT NULL,
	[email] [nvarchar](128) NOT NULL,
	[reply-to] [nvarchar](128) NOT NULL,
	[bcc] [nvarchar](128) NOT NULL,
	[signature] [nvarchar](max) NULL,
	[html_signature] [smallint] NOT NULL,
 CONSTRAINT [PK_rcmail_identities_identity_id] PRIMARY KEY CLUSTERED 
(
	[identity_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[rcmail_pop3fetcher_accounts]    Script Date: 14/12/2018 11:25:59 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[rcmail_pop3fetcher_accounts](
	[pop3fetcher_id] [int] IDENTITY(1,1) NOT NULL,
	[pop3fetcher_email] [varchar](128) NOT NULL,
	[pop3fetcher_username] [varchar](128) NOT NULL,
	[pop3fetcher_password] [varchar](128) NOT NULL,
	[pop3fetcher_serveraddress] [varchar](128) NOT NULL,
	[pop3fetcher_serverport] [varchar](128) NOT NULL,
	[pop3fetcher_ssl] [varchar](10) NULL,
	[pop3fetcher_leaveacopyonserver] [int] NULL,
	[user_id] [int] NOT NULL,
	[last_check] [int] NOT NULL,
	[last_uidl] [varchar](70) NULL,
	[update_lock] [int] NOT NULL,
	[pop3fetcher_provider] [varchar](128) NULL,
	[default_folder] [varchar](128) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[rcmail_searches]    Script Date: 14/12/2018 11:25:59 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[rcmail_searches](
	[search_id] [bigint] IDENTITY(1,1) NOT NULL,
	[user_id] [bigint] NOT NULL,
	[type] [int] NOT NULL,
	[name] [nvarchar](128) NOT NULL,
	[data] [nvarchar](max) NULL,
 CONSTRAINT [PK_rcmail_searches_search_id] PRIMARY KEY CLUSTERED 
(
	[search_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[rcmail_session]    Script Date: 14/12/2018 11:25:59 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[rcmail_session](
	[sess_id] [nvarchar](128) NOT NULL,
	[created] [datetime2](0) NOT NULL,
	[changed] [datetime2](0) NOT NULL,
	[ip] [nvarchar](40) NOT NULL,
	[vars] [nvarchar](max) NOT NULL,
 CONSTRAINT [PK_rcmail_session_sess_id] PRIMARY KEY CLUSTERED 
(
	[sess_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[rcmail_system]    Script Date: 14/12/2018 11:25:59 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[rcmail_system](
	[name] [nvarchar](64) NOT NULL,
	[value] [nvarchar](max) NULL,
 CONSTRAINT [PK_rcmail_system_name] PRIMARY KEY CLUSTERED 
(
	[name] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[rcmail_users]    Script Date: 14/12/2018 11:26:00 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[rcmail_users](
	[user_id] [bigint] IDENTITY(1,1) NOT NULL,
	[username] [nvarchar](128) NOT NULL,
	[mail_host] [nvarchar](128) NOT NULL,
	[created] [datetime2](0) NOT NULL,
	[last_login] [datetime2](0) NULL,
	[language] [nvarchar](5) NULL,
	[preferences] [nvarchar](max) NULL,
 CONSTRAINT [PK_rcmail_users_user_id] PRIMARY KEY CLUSTERED 
(
	[user_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
ALTER TABLE [dbo].[campos_formato] ADD  DEFAULT ((0)) FOR [formato_idformato]
GO
ALTER TABLE [dbo].[campos_formato] ADD  DEFAULT (N'') FOR [nombre]
GO
ALTER TABLE [dbo].[campos_formato] ADD  DEFAULT (N'') FOR [etiqueta]
GO
ALTER TABLE [dbo].[campos_formato] ADD  DEFAULT (N'') FOR [tipo_dato]
GO
ALTER TABLE [dbo].[campos_formato] ADD  DEFAULT (NULL) FOR [longitud]
GO
ALTER TABLE [dbo].[campos_formato] ADD  DEFAULT ((0)) FOR [obligatoriedad]
GO
ALTER TABLE [dbo].[campos_formato] ADD  DEFAULT (N'a,e,b') FOR [acciones]
GO
ALTER TABLE [dbo].[campos_formato] ADD  DEFAULT (NULL) FOR [predeterminado]
GO
ALTER TABLE [dbo].[campos_formato] ADD  DEFAULT (NULL) FOR [banderas]
GO
ALTER TABLE [dbo].[campos_formato] ADD  DEFAULT (N'text') FOR [etiqueta_html]
GO
ALTER TABLE [dbo].[campos_formato] ADD  DEFAULT ((0)) FOR [orden]
GO
ALTER TABLE [dbo].[campos_formato] ADD  DEFAULT (NULL) FOR [mascara]
GO
ALTER TABLE [dbo].[campos_formato] ADD  DEFAULT (NULL) FOR [adicionales]
GO
ALTER TABLE [dbo].[campos_formato] ADD  DEFAULT ((0)) FOR [autoguardado]
GO
ALTER TABLE [dbo].[campos_formato] ADD  DEFAULT ((1)) FOR [fila_visible]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (N'') FOR [nombre]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (N'') FOR [etiqueta]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT ((0)) FOR [cod_padre]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT ((0)) FOR [contador_idcontador]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (N'') FOR [nombre_tabla]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (N'') FOR [ruta_mostrar]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (N'') FOR [ruta_editar]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (N'') FOR [ruta_adicionar]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (NULL) FOR [librerias]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (NULL) FOR [estilos]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (NULL) FOR [javascript]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (N'30,30,30,30') FOR [margenes]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (NULL) FOR [orientacion]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (N'letter') FOR [papel]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (N'pdf') FOR [exportar]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT ((0)) FOR [funcionario_idfuncionario]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (getdate()) FOR [fecha]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (N'1') FOR [mostrar]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (NULL) FOR [imagen]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (N'0') FOR [detalle]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT ((0)) FOR [tipo_edicion]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (N'0') FOR [item]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (NULL) FOR [ayuda]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (N'12') FOR [font_size]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (N'm') FOR [banderas]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (N'300000') FOR [tiempo_autoguardado]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT ((1)) FOR [mostrar_pdf]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (NULL) FOR [orden]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT ((0)) FOR [enter2tab]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (NULL) FOR [fk_categoria_formato]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (NULL) FOR [flujo_idflujo]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (NULL) FOR [funcion_predeterminada]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT (N'1') FOR [paginar]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT ((0)) FOR [pertenece_nucleo]
GO
ALTER TABLE [dbo].[formato] ADD  DEFAULT ((1)) FOR [permite_imprimir]
GO
ALTER TABLE [dbo].[ft_correo_saia] ADD  DEFAULT ('11') FOR [serie_idserie]
GO
ALTER TABLE [dbo].[ft_correo_saia] ADD  DEFAULT ('1') FOR [encabezado]
GO
ALTER TABLE [dbo].[ft_correo_saia] ADD  DEFAULT ('1') FOR [firma]
GO
ALTER TABLE [dbo].[ft_correo_saia] ADD  DEFAULT (getdate()) FOR [fecha_oficio_entrada]
GO
ALTER TABLE [dbo].[ft_correo_saia] ADD  DEFAULT ('1') FOR [estado_documento]
GO
ALTER TABLE [dbo].[ft_correo_saia] ADD  DEFAULT ('1') FOR [ingresar_datos_factu]
GO
ALTER TABLE [dbo].[ft_correo_saia] ADD  DEFAULT (getdate()) FOR [fecha_datos]
GO
ALTER TABLE [dbo].[ft_correo_saia] ADD  DEFAULT (getdate()) FOR [fecha_factura]
GO
ALTER TABLE [dbo].[ft_correo_saia] ADD  DEFAULT (getdate()) FOR [fecha_venc_fact]
GO
ALTER TABLE [dbo].[ft_facturas_obras] ADD  DEFAULT ('2621') FOR [serie_idserie]
GO
ALTER TABLE [dbo].[ft_facturas_obras] ADD  DEFAULT ('1') FOR [encabezado]
GO
ALTER TABLE [dbo].[ft_facturas_obras] ADD  DEFAULT ('1') FOR [firma]
GO
ALTER TABLE [dbo].[ft_facturas_obras] ADD  DEFAULT (getdate()) FOR [fecha_radicacion]
GO
ALTER TABLE [dbo].[ft_facturas_obras] ADD  DEFAULT (getdate()) FOR [fecha_factura]
GO
ALTER TABLE [dbo].[ft_facturas_obras] ADD  DEFAULT (getdate()) FOR [vence_factura]
GO
ALTER TABLE [dbo].[ft_facturas_obras] ADD  DEFAULT (getdate()) FOR [fecha_pago]
GO
ALTER TABLE [dbo].[ft_facturas_obras] ADD  DEFAULT (getdate()) FOR [fecha_accion_pago]
GO
ALTER TABLE [dbo].[modulo] ADD  DEFAULT ((0)) FOR [pertenece_nucleo]
GO
ALTER TABLE [dbo].[modulo] ADD  DEFAULT (N'') FOR [nombre]
GO
ALTER TABLE [dbo].[modulo] ADD  DEFAULT (N'secundario') FOR [tipo]
GO
ALTER TABLE [dbo].[modulo] ADD  DEFAULT (N'botones/configuracion/default.gif') FOR [imagen]
GO
ALTER TABLE [dbo].[modulo] ADD  DEFAULT (N'') FOR [etiqueta]
GO
ALTER TABLE [dbo].[modulo] ADD  DEFAULT (N'') FOR [enlace]
GO
ALTER TABLE [dbo].[modulo] ADD  DEFAULT (NULL) FOR [enlace_mobil]
GO
ALTER TABLE [dbo].[modulo] ADD  DEFAULT (N'centro') FOR [destino]
GO
ALTER TABLE [dbo].[modulo] ADD  DEFAULT (NULL) FOR [cod_padre]
GO
ALTER TABLE [dbo].[modulo] ADD  DEFAULT ((1)) FOR [orden]
GO
ALTER TABLE [dbo].[modulo] ADD  DEFAULT (NULL) FOR [parametros]
GO
ALTER TABLE [dbo].[modulo] ADD  DEFAULT (NULL) FOR [busqueda_idbusqueda]
GO
ALTER TABLE [dbo].[modulo] ADD  DEFAULT ((0)) FOR [permiso_admin]
GO
ALTER TABLE [dbo].[modulo] ADD  DEFAULT (N'1') FOR [busqueda]
GO
ALTER TABLE [dbo].[modulo] ADD  DEFAULT ((0)) FOR [enlace_pantalla]
GO
ALTER TABLE [dbo].[rcmail_cache] ADD  DEFAULT ('1000-01-01 00:00:00') FOR [created]
GO
ALTER TABLE [dbo].[rcmail_cache] ADD  DEFAULT (NULL) FOR [expires]
GO
ALTER TABLE [dbo].[rcmail_cache_index] ADD  DEFAULT (NULL) FOR [expires]
GO
ALTER TABLE [dbo].[rcmail_cache_index] ADD  DEFAULT ((0)) FOR [valid]
GO
ALTER TABLE [dbo].[rcmail_cache_messages] ADD  DEFAULT ((0)) FOR [uid]
GO
ALTER TABLE [dbo].[rcmail_cache_messages] ADD  DEFAULT (NULL) FOR [expires]
GO
ALTER TABLE [dbo].[rcmail_cache_messages] ADD  DEFAULT ((0)) FOR [flags]
GO
ALTER TABLE [dbo].[rcmail_cache_shared] ADD  DEFAULT ('1000-01-01 00:00:00') FOR [created]
GO
ALTER TABLE [dbo].[rcmail_cache_shared] ADD  DEFAULT (NULL) FOR [expires]
GO
ALTER TABLE [dbo].[rcmail_cache_thread] ADD  DEFAULT (NULL) FOR [expires]
GO
ALTER TABLE [dbo].[rcmail_contactgroupmembers] ADD  DEFAULT ('1000-01-01 00:00:00') FOR [created]
GO
ALTER TABLE [dbo].[rcmail_contactgroups] ADD  DEFAULT ('1000-01-01 00:00:00') FOR [changed]
GO
ALTER TABLE [dbo].[rcmail_contactgroups] ADD  DEFAULT ((0)) FOR [del]
GO
ALTER TABLE [dbo].[rcmail_contactgroups] ADD  DEFAULT (N'') FOR [name]
GO
ALTER TABLE [dbo].[rcmail_contacts] ADD  DEFAULT ('1000-01-01 00:00:00') FOR [changed]
GO
ALTER TABLE [dbo].[rcmail_contacts] ADD  DEFAULT ((0)) FOR [del]
GO
ALTER TABLE [dbo].[rcmail_contacts] ADD  DEFAULT (N'') FOR [name]
GO
ALTER TABLE [dbo].[rcmail_contacts] ADD  DEFAULT (N'') FOR [firstname]
GO
ALTER TABLE [dbo].[rcmail_contacts] ADD  DEFAULT (N'') FOR [surname]
GO
ALTER TABLE [dbo].[rcmail_dictionary] ADD  DEFAULT (NULL) FOR [user_id]
GO
ALTER TABLE [dbo].[rcmail_identities] ADD  DEFAULT ('1000-01-01 00:00:00') FOR [changed]
GO
ALTER TABLE [dbo].[rcmail_identities] ADD  DEFAULT ((0)) FOR [del]
GO
ALTER TABLE [dbo].[rcmail_identities] ADD  DEFAULT ((0)) FOR [standard]
GO
ALTER TABLE [dbo].[rcmail_identities] ADD  DEFAULT (N'') FOR [organization]
GO
ALTER TABLE [dbo].[rcmail_identities] ADD  DEFAULT (N'') FOR [reply-to]
GO
ALTER TABLE [dbo].[rcmail_identities] ADD  DEFAULT (N'') FOR [bcc]
GO
ALTER TABLE [dbo].[rcmail_identities] ADD  DEFAULT ((0)) FOR [html_signature]
GO
ALTER TABLE [dbo].[rcmail_pop3fetcher_accounts] ADD  DEFAULT ((0)) FOR [pop3fetcher_ssl]
GO
ALTER TABLE [dbo].[rcmail_pop3fetcher_accounts] ADD  DEFAULT ((0)) FOR [pop3fetcher_leaveacopyonserver]
GO
ALTER TABLE [dbo].[rcmail_pop3fetcher_accounts] ADD  DEFAULT ((0)) FOR [user_id]
GO
ALTER TABLE [dbo].[rcmail_pop3fetcher_accounts] ADD  DEFAULT ((0)) FOR [last_check]
GO
ALTER TABLE [dbo].[rcmail_pop3fetcher_accounts] ADD  DEFAULT (NULL) FOR [last_uidl]
GO
ALTER TABLE [dbo].[rcmail_pop3fetcher_accounts] ADD  DEFAULT ((0)) FOR [update_lock]
GO
ALTER TABLE [dbo].[rcmail_pop3fetcher_accounts] ADD  DEFAULT (NULL) FOR [pop3fetcher_provider]
GO
ALTER TABLE [dbo].[rcmail_pop3fetcher_accounts] ADD  DEFAULT (NULL) FOR [default_folder]
GO
ALTER TABLE [dbo].[rcmail_searches] ADD  DEFAULT ((0)) FOR [type]
GO
ALTER TABLE [dbo].[rcmail_session] ADD  DEFAULT ('1000-01-01 00:00:00') FOR [created]
GO
ALTER TABLE [dbo].[rcmail_session] ADD  DEFAULT ('1000-01-01 00:00:00') FOR [changed]
GO
ALTER TABLE [dbo].[rcmail_users] ADD  DEFAULT ('1000-01-01 00:00:00') FOR [created]
GO
ALTER TABLE [dbo].[rcmail_users] ADD  DEFAULT (NULL) FOR [last_login]
GO
ALTER TABLE [dbo].[rcmail_users] ADD  DEFAULT (NULL) FOR [language]
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'saia_colpatria.campos_formato' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'campos_formato'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'saia_colpatria.formato' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'formato'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'saia_colpatria.modulo' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'modulo'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'saia_colpatria.rcmail_cache' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'rcmail_cache'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'saia_colpatria.rcmail_cache_index' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'rcmail_cache_index'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'saia_colpatria.rcmail_cache_messages' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'rcmail_cache_messages'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'saia_colpatria.rcmail_cache_shared' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'rcmail_cache_shared'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'saia_colpatria.rcmail_cache_thread' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'rcmail_cache_thread'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'saia_colpatria.rcmail_contactgroupmembers' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'rcmail_contactgroupmembers'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'saia_colpatria.rcmail_contactgroups' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'rcmail_contactgroups'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'saia_colpatria.rcmail_contacts' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'rcmail_contacts'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'saia_colpatria.rcmail_dictionary' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'rcmail_dictionary'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'saia_colpatria.rcmail_identities' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'rcmail_identities'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'saia_colpatria.rcmail_searches' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'rcmail_searches'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'saia_colpatria.rcmail_session' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'rcmail_session'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'saia_colpatria.rcmail_system' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'rcmail_system'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'saia_colpatria.rcmail_users' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'rcmail_users'
GO
