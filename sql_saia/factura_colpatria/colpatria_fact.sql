USE [saia]
GO
/****** Object:  Table [dbo].[dt_datos_correo]    Script Date: 17/12/2018 14:39:10 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[dt_datos_correo](
	[iddt_datos_correo] [int] IDENTITY(1,1) NOT NULL,
	[idgrupo] [nvarchar](255) NOT NULL,
	[uid] [int] NOT NULL,
	[asunto] [nvarchar](255) NOT NULL,
	[fecha_oficio_entrada] [datetime] NULL,
	[de] [nvarchar](255) NULL,
	[buzon_email] [nvarchar](255) NULL,
	[para] [text] NULL,
	[anexos] [text] NULL,
	[comentario] [text] NULL,
	[transferir] [nvarchar](255) NULL,
	[copia] [nvarchar](255) NULL,
	[iddoc_rad] [int] NULL,
	[numero_rad] [int] NULL,
 CONSTRAINT [dt_datos_correo_pk] PRIMARY KEY CLUSTERED 
(
	[iddt_datos_correo] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ft_correo_saia]    Script Date: 17/12/2018 14:39:10 ******/
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
/****** Object:  Table [dbo].[ft_facturas_obras]    Script Date: 17/12/2018 14:39:10 ******/
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
ALTER TABLE [dbo].[dt_datos_correo] ADD  DEFAULT (NULL) FOR [fecha_oficio_entrada]
GO
ALTER TABLE [dbo].[dt_datos_correo] ADD  DEFAULT ((0)) FOR [iddoc_rad]
GO
ALTER TABLE [dbo].[dt_datos_correo] ADD  DEFAULT ((0)) FOR [numero_rad]
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
