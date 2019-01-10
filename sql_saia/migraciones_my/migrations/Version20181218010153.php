<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181218010153 extends AbstractMigration {
	
	private $campos_correo= array(
			array("nombre" => 'serie_idserie', "etiqueta" => 'SERIE DOCUMENTAL', "tipo_dato" => 'INT', "longitud" => '11', "obligatoriedad" => 1, "valor" => '11', "acciones" => 'a', "ayuda" => 'Correo SAIA', "predeterminado" => '11', "banderas" => 'fk', "etiqueta_html" => 'hidden', "orden" => 7, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'asunto', "etiqueta" => 'Asunto', "tipo_dato" => 'VARCHAR', "longitud" => '255', "obligatoriedad" => 1, "valor" => null, "acciones" => 'a,e,p,b', "ayuda" => 'Asunto del correo', "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'text', "orden" => 8, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'de', "etiqueta" => 'De', "tipo_dato" => 'VARCHAR', "longitud" => '255', "obligatoriedad" => 1, "valor" => null, "acciones" => 'a,e,b', "ayuda" => 'Remitente del correo', "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'text', "orden" => 10, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'para', "etiqueta" => 'Para', "tipo_dato" => 'TEXT', "longitud" => null, "obligatoriedad" => 1, "valor" => null, "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'text', "orden" => 11, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'anexos', "etiqueta" => 'Anexos', "tipo_dato" => 'TEXT', "longitud" => null, "obligatoriedad" => 0, "valor" => null, "acciones" => 'a,e,b', "ayuda" => 'Anexos del correo', "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'hidden', "orden" => 15, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'idft_correo_saia', "etiqueta" => 'CORREO_SAIA', "tipo_dato" => 'INT', "longitud" => '11', "obligatoriedad" => 1, "valor" => null, "acciones" => 'a,e', "ayuda" => null, "predeterminado" => null, "banderas" => 'ai,pk', "etiqueta_html" => 'hidden', "orden" => 2, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'documento_iddocumento', "etiqueta" => 'DOCUMENTO ASOCIADO', "tipo_dato" => 'INT', "longitud" => '11', "obligatoriedad" => 1, "valor" => null, "acciones" => 'a,e', "ayuda" => null, "predeterminado" => null, "banderas" => 'i', "etiqueta_html" => 'hidden', "orden" => 3, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'dependencia', "etiqueta" => 'DEPENDENCIA DEL CREADOR DEL DOCUMENTO', "tipo_dato" => 'INT', "longitud" => '11', "obligatoriedad" => 1, "valor" => '{*buscar_dependencia*}', "acciones" => 'a,e', "ayuda" => null, "predeterminado" => null, "banderas" => 'i', "etiqueta_html" => 'hidden', "orden" => 6, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'encabezado', "etiqueta" => 'ENCABEZADO', "tipo_dato" => 'INT', "longitud" => '11', "obligatoriedad" => 1, "valor" => null, "acciones" => 'a,e', "ayuda" => null, "predeterminado" => '1', "banderas" => null, "etiqueta_html" => 'hidden', "orden" => 4, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'firma', "etiqueta" => 'FIRMAS DIGITALES', "tipo_dato" => 'INT', "longitud" => '11', "obligatoriedad" => 1, "valor" => null, "acciones" => 'a,e', "ayuda" => null, "predeterminado" => '1', "banderas" => '', "etiqueta_html" => 'hidden', "orden" => 5, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'fecha_oficio_entrada', "etiqueta" => 'Fecha Oficio Entrada', "tipo_dato" => 'DATETIME', "longitud" => null, "obligatoriedad" => 1, "valor" => null, "acciones" => 'a,e,b', "ayuda" => 'Fecha de entrada del oficio', "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'fecha', "orden" => 9, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'comentario', "etiqueta" => 'Comentario', "tipo_dato" => 'VARCHAR', "longitud" => '255', "obligatoriedad" => 0, "valor" => null, "acciones" => 'a,e,b', "ayuda" => 'Comentario del correo', "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'textarea', "orden" => 14, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'transferencia_correo', "etiqueta" => 'Transferir', "tipo_dato" => 'TEXT', "longitud" => null, "obligatoriedad" => 0, "valor" => '1;pantallas/funcionario/carga_campo_autocompletar.php', "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'autocompletar', "orden" => 12, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'copia_correo', "etiqueta" => 'Con Copia', "tipo_dato" => 'VARCHAR', "longitud" => '255', "obligatoriedad" => 0, "valor" => '../../test_funcionario.php?rol=1;1;0;0;1;0;5', "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'arbol', "orden" => 13, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'estado_documento', "etiqueta" => 'ESTADO DEL DOCUMENTO', "tipo_dato" => 'INT', "longitud" => '11', "obligatoriedad" => 1, "valor" => null, "acciones" => 'a,e', "ayuda" => null, "predeterminado" => '1', "banderas" => '', "etiqueta_html" => 'hidden', "orden" => 1, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'no_factura', "etiqueta" => 'No. de Factura', "tipo_dato" => 'VARCHAR', "longitud" => '255', "obligatoriedad" => 0, "valor" => null, "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'hidden', "orden" => 16, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'nit_proveedor', "etiqueta" => 'No. Nit Proveedor', "tipo_dato" => 'VARCHAR', "longitud" => '255', "obligatoriedad" => 0, "valor" => null, "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'hidden', "orden" => 17, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'centro_costo', "etiqueta" => 'Centro de Costos', "tipo_dato" => 'VARCHAR', "longitud" => '255', "obligatoriedad" => 0, "valor" => null, "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'hidden', "orden" => 18, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'adjunto_imagen', "etiqueta" => 'Adjunto Imagen', "tipo_dato" => 'VARCHAR', "longitud" => '255', "obligatoriedad" => 0, "valor" => null, "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'hidden', "orden" => 19, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'ingresar_datos_factu', "etiqueta" => 'ingresar_datos_factu', "tipo_dato" => 'INT', "longitud" => '11', "obligatoriedad" => 0, "valor" => null, "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => '1', "banderas" => null, "etiqueta_html" => 'hidden', "orden" => 0, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'fecha_datos', "etiqueta" => 'fecha_datos', "tipo_dato" => 'DATETIME', "longitud" => null, "obligatoriedad" => 0, "valor" => null, "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'hidden', "orden" => 0, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'responsable_datos_fa', "etiqueta" => 'responsable_datos_fa', "tipo_dato" => 'VARCHAR', "longitud" => '255', "obligatoriedad" => 0, "valor" => null, "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'hidden', "orden" => 0, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'uid_correo', "etiqueta" => 'Uid Correo', "tipo_dato" => 'VARCHAR', "longitud" => '255', "obligatoriedad" => 0, "valor" => null, "acciones" => 'a', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'hidden', "orden" => 0, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'buzon_correo', "etiqueta" => 'Buzon Origen', "tipo_dato" => 'VARCHAR', "longitud" => '255', "obligatoriedad" => 0, "valor" => null, "acciones" => 'a', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'hidden', "orden" => 0, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'fecha_factura', "etiqueta" => 'Fecha factura', "tipo_dato" => 'DATE', "longitud" => null, "obligatoriedad" => 0, "valor" => null, "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'hidden', "orden" => 0, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'cant_dias', "etiqueta" => 'Cantidad d&iacute;as de pago', "tipo_dato" => 'INT', "longitud" => '11', "obligatoriedad" => 0, "valor" => null, "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'hidden', "orden" => 0, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'fecha_venc_fact', "etiqueta" => 'Fecha vencimiento factura', "tipo_dato" => 'DATE', "longitud" => null, "obligatoriedad" => 0, "valor" => null, "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'hidden', "orden" => 0, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'concepto_fact', "etiqueta" => 'Concepto de la factura', "tipo_dato" => 'TEXT', "longitud" => null, "obligatoriedad" => 0, "valor" => null, "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'hidden', "orden" => 0, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'valor_factura', "etiqueta" => 'Valor de la Factura', "tipo_dato" => 'VARCHAR', "longitud" => '255', "obligatoriedad" => 0, "valor" => null, "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'hidden', "orden" => 0, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'pago_desde', "etiqueta" => 'Fecha de pago desde', "tipo_dato" => 'INT', "longitud" => '11', "obligatoriedad" => 0, "valor" => null, "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'hidden', "orden" => 0, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
	);
	
	private $campos_factura = array(
			array("nombre" => 'estado_documento', "etiqueta" => 'ESTADO DEL DOCUMENTO', "tipo_dato" => 'VARCHAR', "longitud" => '255', "obligatoriedad" => 0, "valor" => null, "acciones" => 'a', "ayuda" => '', "predeterminado" => '', "banderas" => '', "etiqueta_html" => 'hidden', "orden" => 25, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'serie_idserie', "etiqueta" => 'TIPO DOCUMENTAL', "tipo_dato" => 'INT', "longitud" => '11', "obligatoriedad" => 0, "valor" => null, "acciones" => 'a', "ayuda" => 'Facturas de Obras', "predeterminado" => '2621', "banderas" => null, "etiqueta_html" => 'hidden', "orden" => 17, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'idft_facturas_obras', "etiqueta" => 'FACTURAS_OBRAS', "tipo_dato" => 'INT', "longitud" => '11', "obligatoriedad" => 1, "valor" => null, "acciones" => 'a,e', "ayuda" => null, "predeterminado" => null, "banderas" => 'ai,pk', "etiqueta_html" => 'hidden', "orden" => 23, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'documento_iddocumento', "etiqueta" => 'DOCUMENTO ASOCIADO', "tipo_dato" => 'INT', "longitud" => '11', "obligatoriedad" => 1, "valor" => null, "acciones" => 'a,e', "ayuda" => null, "predeterminado" => null, "banderas" => 'i', "etiqueta_html" => 'hidden', "orden" => 22, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'dependencia', "etiqueta" => 'VENTANILLA DEL CREADOR DEL DOCUMENTO', "tipo_dato" => 'INT', "longitud" => '11', "obligatoriedad" => 1, "valor" => '{*buscar_dependencia*}', "acciones" => 'a,e', "ayuda" => null, "predeterminado" => null, "banderas" => 'i,fdc', "etiqueta_html" => 'hidden', "orden" => 1, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'encabezado', "etiqueta" => 'ENCABEZADO', "tipo_dato" => 'INT', "longitud" => '11', "obligatoriedad" => 1, "valor" => null, "acciones" => 'a,e', "ayuda" => null, "predeterminado" => '1', "banderas" => null, "etiqueta_html" => 'hidden', "orden" => 21, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'firma', "etiqueta" => 'FIRMAS DIGITALES', "tipo_dato" => 'INT', "longitud" => '11', "obligatoriedad" => 1, "valor" => null, "acciones" => 'a,e', "ayuda" => null, "predeterminado" => '1', "banderas" => '', "etiqueta_html" => 'hidden', "orden" => 24, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'fecha_radicacion', "etiqueta" => 'FECHA DE RADICACI&Oacute;N', "tipo_dato" => 'DATETIME', "longitud" => null, "obligatoriedad" => 1, "valor" => '{*fecha_formato*}', "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'fecha', "orden" => 2, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'fecha_factura', "etiqueta" => 'FECHA DE LA FACTURA', "tipo_dato" => 'DATE', "longitud" => null, "obligatoriedad" => 0, "valor" => null, "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'fecha', "orden" => 4, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'numero_factura', "etiqueta" => 'N&Uacute;MERO DE FACTURA', "tipo_dato" => 'VARCHAR', "longitud" => '255', "obligatoriedad" => 0, "valor" => null, "acciones" => 'a,e,p,d,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'text', "orden" => 5, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'concepto_factura', "etiqueta" => 'CONCEPTO DE LA FACTURA', "tipo_dato" => 'TEXT', "longitud" => null, "obligatoriedad" => 1, "valor" => 'sin_tiny', "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'textarea', "orden" => 6, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'valor_factura', "etiqueta" => 'VALOR DE LA FACTURA', "tipo_dato" => 'VARCHAR', "longitud" => '30', "obligatoriedad" => 1, "valor" => null, "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'text', "orden" => 7, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'vence_factura', "etiqueta" => 'VENCIMIENTO DE LA FACTURA', "tipo_dato" => 'DATE', "longitud" => null, "obligatoriedad" => 1, "valor" => '{*fecha_formato*}', "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'fecha', "orden" => 8, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'numero_guia', "etiqueta" => 'N&Uacute;MERO DE GU&Iacute;A', "tipo_dato" => 'VARCHAR', "longitud" => '50', "obligatoriedad" => 0, "valor" => null, "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'text', "orden" => 10, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'empresa_trans', "etiqueta" => 'EMPRESA TRANSPORTADORA', "tipo_dato" => 'INT', "longitud" => '11', "obligatoriedad" => 0, "valor" => 'select idcf_empresa_trans as id, nombre from cf_empresa_trans where estado=1', "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'select', "orden" => 11, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'numero_folios', "etiqueta" => 'N&Uacute;MERO DE FOLIOS', "tipo_dato" => 'VARCHAR', "longitud" => '50', "obligatoriedad" => 0, "valor" => null, "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'text', "orden" => 12, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'anexos_fisicos', "etiqueta" => 'ANEXOS F&Iacute;SICOS', "tipo_dato" => 'TEXT', "longitud" => null, "obligatoriedad" => 0, "valor" => 'sin_tiny', "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'textarea', "orden" => 13, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'anexos_digitales', "etiqueta" => 'ANEXOS DIGITALES', "tipo_dato" => 'VARCHAR', "longitud" => '255', "obligatoriedad" => 0, "valor" => null, "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'archivo', "orden" => 14, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'persona_natural', "etiqueta" => 'PERSONA NATURAL/JURIDICA', "tipo_dato" => 'INT', "longitud" => '11', "obligatoriedad" => 1, "valor" => 'unico@nombre,identificacion@cargo,empresa,direccion,telefono,email,titulo,ciudad', "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'ejecutor', "orden" => 15, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'destino', "etiqueta" => 'DESTINO', "tipo_dato" => 'INT', "longitud" => '11', "obligatoriedad" => 1, "valor" => '1;pantallas/funcionario/carga_campo_autocompletar.php', "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'autocompletar', "orden" => 16, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'copia', "etiqueta" => 'COPIA ELECTR&Oacute;NICA A', "tipo_dato" => 'VARCHAR', "longitud" => '255', "obligatoriedad" => 0, "valor" => '../../test_funcionario.php?rol=1&sin_padre=1;1;0;0;1;0;5', "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'arbol', "orden" => 18, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'fecha_pago', "etiqueta" => 'FECHA DE PAGO', "tipo_dato" => 'DATE', "longitud" => null, "obligatoriedad" => 0, "valor" => null, "acciones" => 'b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'fecha', "orden" => 9, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'func_fecha_pago', "etiqueta" => 'Funcionario', "tipo_dato" => 'INT', "longitud" => '11', "obligatoriedad" => 0, "valor" => null, "acciones" => 'b', "ayuda" => null, "predeterminado" => null, "banderas" => 'fid', "etiqueta_html" => 'text', "orden" => 19, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'fecha_accion_pago', "etiqueta" => 'FECHA ACCION PAGO', "tipo_dato" => 'DATE', "longitud" => null, "obligatoriedad" => 0, "valor" => null, "acciones" => 'b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'fecha', "orden" => 20, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
			, array("nombre" => 'numero_radicado', "etiqueta" => 'N&Uacute;MERO DE RADICADO', "tipo_dato" => 'INT', "longitud" => '11', "obligatoriedad" => 0, "valor" => '{*mostrar_radicado_obra*}', "acciones" => 'a,e,b', "ayuda" => null, "predeterminado" => null, "banderas" => null, "etiqueta_html" => 'hidden', "orden" => 3, "mascara" => null, "adicionales" => null, "autoguardado" => 0, "fila_visible" => 1)
	);
	
	private $formato_correo = array(			
"nombre" =>     'correo_saia',
"etiqueta" =>   'Correo SAIA',
"cod_padre" =>  0,
"contador_idcontador" => 1,
"nombre_tabla" =>  'ft_correo_saia',
"ruta_mostrar" =>  'mostrar_correo_saia.php',
"ruta_editar" =>   'editar_correo_saia.php',
"ruta_adicionar" => 'adicionar_correo_saia.php',
"librerias" =>  NULL,
"estilos" =>    NULL,
"javascript" => NULL,
"encabezado" => '1',
"cuerpo" =>  '<table style="width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 30%;">Asunto</td>
<td style="text-align: left;">&nbsp;{*asunto*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Fecha Oficio Entrada</td>
<td style="text-align: left;">&nbsp;{*mostrar_fecha_oficio_entrada*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">De</td>
<td style="text-align: left;">&nbsp;{*de*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Para</td>
<td style="text-align: left;">&nbsp;{*mostrar_para*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Transferido</td>
<td style="text-align: left;">&nbsp;{*mostrar_transferencia_correo*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Con copia</td>
<td style="text-align: left;">&nbsp;{*copia_correo*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Comentario</td>
<td style="text-align: left;">&nbsp;{*comentario*}</td>
</tr>
</tbody>
</table>
<p>{*ingresar_datos_factura*}</p>
<p>{*mostrar_estado_proceso*}</p>
<p>{*ver_anexos_documento*}</p>',
"pie_pagina" =>  '',
"margenes" =>    '15,20,30,20',
"orientacion" => '0',
"papel" =>       'A4',
"exportar" =>    'tcpdf',
"funcionario_idfuncionario" => 1,
"fecha" =>        '2017-07-25 17:49:43.310',
"mostrar" =>      '0',
"imagen" =>       NULL,
"detalle" =>      '0',
"tipo_edicion" => 0,
"item" => '0',
"serie_idserie" => 11,
"ayuda" => NULL,
"font_size" => '9',
"banderas" =>  'e',
"tiempo_autoguardado" =>       '300000',
"mostrar_pdf" =>               0,
"orden" =>                     NULL,
"enter2tab" =>                 0,
"firma_digital" =>             0,
"fk_categoria_formato" =>      '2',
"flujo_idflujo" =>             0,
"funcion_predeterminada" =>    '',
"paginar" =>                   '1',
"pertenece_nucleo" =>          1,
"permite_imprimir" =>          1);
	
	private $formato_factura = array("nombre" => 'facturas_obras',
			"etiqueta" => 'RADICACI&Oacute;N FACTURAS DE OBRA',
			"cod_padre" => 0, "contador_idcontador" => 1, "nombre_tabla" => 'ft_facturas_obras',
			"ruta_mostrar" => 'mostrar_facturas_obras.php', "ruta_editar" => 'editar_facturas_obras.php', "ruta_adicionar" => 'adicionar_facturas_obras.php',
			"librerias" => NULL, "estilos" => NULL,"javascript" => NULL, "encabezado" => '1',
			"cuerpo" => '<p>{*cargar_datos_rad_obras*}</p>
<table class="table table-bordered" style="width: 100%;" border="1">
<tbody>
<tr>
<td><strong>Fecha de radicaci&oacute;n:</strong></td>
<td>{*fecha_radicacion*}</td>
<td style="text-align: center;" rowspan="3" colspan="2">{*ver_qr_rad_obras*}</td>
</tr>
<tr>
<td><strong><strong>N&uacute;mero de la factura:</strong></strong></td>
<td>{*numero_factura*}</td>
</tr>
<tr>
<td><strong>Valor de la factura:</strong></td>
<td>{*mostrar_valor_factura*}</td>
</tr>
<tr>
<td style="width: 30%;"><strong>Concepto de la factura:</strong></td>
<td style="width: 25%;">{*concepto_factura*}</td>
<td style="width: 20%;"><strong>Tipo documental:</strong></td>
<td style="width: 25%;">{*ver_tipo_doc*}</td>
</tr>
<tr>
<td><strong>Vencimiento de la factura:</strong></td>
<td>{*color_vence_factura*}</td>
<td><strong>N&uacute;mero de Gu&iacute;a:</strong></td>
<td>{*numero_guia*}</td>
</tr>
<tr>
<td><strong>Empresa Transportadora:</strong></td>
<td>{*empresa_trans*}</td>
<td><strong>N&uacute;mero de folios:</strong></td>
<td>{*numero_folios*}</td>
</tr>
<tr>
<td><strong><strong>Anexos digitales:</strong></strong></td>
<td>{*anexos_digitales*}</td>
<td><strong>Anexos fisicos:</strong></td>
<td>{*anexos_fisicos*}</td>
</tr>
<tr>
<td style="vertical-align: middle;"><strong>Persona Natural/Jur&iacute;dica:</strong></td>
<td>{*persona_natural*}</td>
<td style="vertical-align: middle;"><strong>Fecha de pago:</strong></td>
<td>{*ver_fecha_pago*}</td>
</tr>
<tr>
<td style="vertical-align: middle;"><strong>Destino:</strong></td>
<td colspan="3">{*mostrar_destino_facturas_obras*}</td>
</tr>
<tr>
<td style="vertical-align: middle;"><strong>Copia electr&oacute;nica:</strong></td>
<td colspan="3">{*copia*}</td>
</tr>
</tbody>
</table>
<p>{*mostrar_listado_distribucion_documento*}</p>
<p>{*mostrar_estado_proceso*}</p>',
			"pie_pagina" => '',"margenes" => '15,20,30,20', "orientacion" => '0', "papel" => 'A4', "exportar" => 'tcpdf',
			"funcionario_idfuncionario" => 1, "fecha" => '2017-08-14 08:54:57.483', "mostrar" => '0', "imagen" => NULL,
			"detalle" => '0', "tipo_edicion" => 0,"item" => '0',"serie_idserie" => 2621,"ayuda" => NULL,"font_size" => '9',
			"banderas" => 'e', "tiempo_autoguardado" => '300000', "mostrar_pdf" => 0, "orden" => NULL, "enter2tab" => 0,
			"firma_digital" => 0,"fk_categoria_formato" => '1',"flujo_idflujo" => 0, "funcion_predeterminada" => '2',"paginar"=>'1',
			"pertenece_nucleo" => 0,"permite_imprimir" => 1);

	public function getDescription() {
		return 'Crear formatos correo_saia y facturas_obras';
	}
	
	public function preUp(Schema $schema) {
		date_default_timezone_set("America/Bogota");
		
		if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
			$this->platform->registerDoctrineTypeMapping('enum', 'string');
		}
	}
	
	/**
	 *
	 * @param Schema $schema
	 */
	public function up(Schema $schema) {
		if (!$schema->hasTable("dt_datos_correo")) {
			$table = $schema->createTable("dt_datos_correo");
			$table->addColumn("iddt_datos_correo", "integer", ["length" => 11, 'autoincrement' => true, "notnull" => true]);
			$table->addColumn("idgrupo", "string", ["length" =>255 , "notnull" => true]);
			$table->addColumn("uid", "integer", ["length" => 11, "notnull" => true]);
			$table->addColumn("asunto", "string", ["length" =>255 , "notnull" => true]);
			$table->addColumn("fecha_oficio_entrada", "datetime", ["notnull" => false]);
			$table->addColumn("de", "string", ["length" =>255 , "notnull" => false]);
			$table->addColumn("buzon_email", "string", ["length" =>255 , "notnull" => false]);
			$table->addColumn("para", "text", ["notnull" => false]);
			$table->addColumn("anexos", "text", ["notnull" => false]);
			$table->addColumn("comentario", "text", ["notnull" => false]);
			$table->addColumn("transferir", "string", ["length" =>255 , "notnull" => false]);
			$table->addColumn("copia", "string", ["length" =>255 , "notnull" => false]);
			$table->addColumn("iddoc_rad", "integer", ["length" => 11, "notnull" => false]);
			$table->addColumn("numero_rad", "integer", ["length" => 11, "notnull" => false]);
			$table->setPrimaryKey(["iddt_datos_correo"]);
		}
		$conn = $this->connection;
		
		$idfmt_correo = $conn->fetchColumn("select idformato from formato where nombre = :nombre", [
				'nombre' => "correo_saia"
		]);
		
		if(empty($idfmt_correo)) {
			$idfmt_correo = $this->guardar_formato($this->formato_correo);
		}
		if(!empty($idfmt_correo)) {
			$conn->beginTransaction();
			
			foreach ($this->campos_correo as $value) {
				$this->guardar_campo($idfmt_correo, $value);
			}
			$conn->commit();
		}

		$idfmt_factura = $conn->fetchColumn("select idformato from formato where nombre = :nombre", [
				'nombre' => "facturas_obras"
		]);
		
		if(empty($idfmt_factura)) {
			$idfmt_factura = $this->guardar_formato($this->formato_factura);
		}
		if(!empty($idfmt_factura)) {
			$conn->beginTransaction();
			
			foreach ($this->campos_factura as $value) {
				$this->guardar_campo($idfmt_factura, $value);
			}
			$conn->commit();
		}
		
	}

	public function preDown(Schema $schema) {
		date_default_timezone_set("America/Bogota");
		
		if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
			$this->platform->registerDoctrineTypeMapping('enum', 'string');
		}
	}
	
	/**
	 *
	 * @param Schema $schema
	 */
	public function down(Schema $schema) {
		// this down() migration is auto-generated, please modify it to your needs
	}
	
	private function guardar_busqueda($datos) {
		if (empty($datos)) {
			return false;
		}
		
		$conn = $this->connection;
		
		$result = $conn->fetchAll("select idbusqueda from busqueda where nombre = :nombre", [
				'nombre' => $datos["nombre"]
		]);
		
		$idbusq = null;
		if (!empty($result)) {
			$idbusq = $result[0]["idbusqueda"];
		} else {
			$resp = $conn->insert('busqueda', $datos);
			
			if (empty($resp)) {
				$conn->rollBack();
				print_r($conn->errorInfo());
				die("Fallo la creacion de la busqueda");
			}
			$idbusq = $conn->lastInsertId();
		}
		return $idbusq;
	}
	
	private function guardar_componente($datos) {
		if (empty($datos)) {
			return false;
		}
		
		$conn = $this->connection;
		
		$result = $conn->fetchAll("select idbusqueda_componente from busqueda_componente where nombre = :nombre", [
				'nombre' => $datos["nombre"]
		]);
		
		$idbusq = null;
		if (!empty($result)) {
			$idbusq = $result[0]["idbusqueda_componente"];
		} else {
			$resp = $conn->insert('busqueda_componente', $datos);
			
			if (empty($resp)) {
				$conn->rollBack();
				print_r($conn->errorInfo());
				die("Fallo la creacion de la busqueda_componente");
			}
			$idbusq = $conn->lastInsertId();
		}
		return $idbusq;
	}
	
	private function guardar_condicion($datos) {
		if (empty($datos)) {
			return false;
		}
		
		$conn = $this->connection;
		
		$result = $conn->fetchAll("select idbusqueda_condicion from busqueda_condicion where etiqueta_condicion  = :etiqueta_condicion", [
				'etiqueta_condicion' => $datos["etiqueta_condicion"]
		]);
		
		$idbusq = null;
		if (!empty($result)) {
			$idbusq = $result[0]["idbusqueda_condicion"];
		} else {
			$resp = $conn->insert('busqueda_condicion', $datos);
			
			if (empty($resp)) {
				$conn->rollBack();
				print_r($conn->errorInfo());
				die("Fallo la creacion de la busqueda_condicion");
			}
			$idbusq = $conn->lastInsertId();
		}
		return $idbusq;
	}
	
	private function guardar_modulo($datos) {
		if (empty($datos)) {
			return false;
		}
		
		$conn = $this->connection;
		
		$result = $conn->fetchAll("select idmodulo from modulo where nombre = :nombre", [
				'nombre' => $datos["nombre"]
		]);
		
		$idmodulo = null;
		if (!empty($result)) {
			$idmodulo = $result[0]["idmodulo"];
		} else {
			$resp = $conn->insert('modulo', $datos);
			
			if (empty($resp)) {
				$conn->rollBack();
				print_r($conn->errorInfo());
				die("Fallo la creacion del modulo");
			}
			$idmodulo = $conn->lastInsertId();
		}
		return $idmodulo;
	}

	private function guardar_formato($datos) {
		if (empty($datos)) {
			return false;
		}
		
		$conn = $this->connection;
		
		$idbusq = $conn->fetchColumn("select idformato from formato where nombre = :nombre", [
				'nombre' => $datos["nombre"]
		]);
		
		if (!empty($idbusq)) {
			$cond = ["idformato" => $idbusq];
			//$datos["formato_idformato"] = $idformato;
			$resp = $conn->update('formato', $datos, $cond);
		} else {
			$resp = $conn->insert('formato', $datos);
			
			if (empty($resp)) {
				$conn->rollBack();
				print_r($conn->errorInfo());
				die("Fallo la creacion del campo_formato");
			}
			$idbusq = $conn->lastInsertId();
		}
		return $idbusq;
	}
	
	private function guardar_campo($idformato, $datos) {
		if (empty($datos)) {
			return false;
		}
		
		$conn = $this->connection;
		
		$idbusq = $conn->fetchColumn("select idcampos_formato from campos_formato where nombre = :nombre and formato_idformato = :idformato", [
				'nombre' => $datos["nombre"],
				'idformato' => $idformato
		]);
		
		if (!empty($idbusq)) {
			$cond = ["idcampos_formato" => $idbusq];
			//$datos["formato_idformato"] = $idformato;
			$resp = $conn->update('campos_formato', $datos, $cond);
		} else {
			$datos["formato_idformato"] = $idformato;
			$resp = $conn->insert('campos_formato', $datos);
			
			if (empty($resp)) {
				$conn->rollBack();
				print_r($conn->errorInfo());
				die("Fallo la creacion del campo_formato");
			}
			$idbusq = $conn->lastInsertId();
		}
		return $idbusq;
	}
	
}
