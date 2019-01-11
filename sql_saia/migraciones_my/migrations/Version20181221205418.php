<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181221205418 extends AbstractMigration {

    private $formato_radicacion_facturas =
        array('nombre' => 'radicacion_facturas','etiqueta' => 'Radicaci&oacute;n de Facturas','cod_padre' => '0','contador_idcontador' => '1','nombre_tabla' => 'ft_radicacion_facturas','ruta_mostrar' => 'mostrar_radicacion_facturas.php','ruta_editar' => 'editar_radicacion_facturas.php','ruta_adicionar' => 'adicionar_radicacion_facturas.php','librerias' => NULL,'estilos' => '','javascript' => '','encabezado' => '1','cuerpo' => '<table class="table table-bordered" style="width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 25%; text-align: center; background-color: #319ecd;" colspan="2"><span style="color: #ffffff;"><strong>INFORMACI&Oacute;N GENERAL</strong></span></td>
</tr>
</tbody>
</table>
<p style="text-align: center;">{*mostrar_informacion_general_factura*}</p>
<p style="text-align: center;">&nbsp;</p>
<table class="table table-bordered" style="width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 25%; text-align: center; background-color: #319ecd;" colspan="2"><span style="color: #ffffff;"><strong>INFORMACI&Oacute;N ORIGEN</strong></span></td>
</tr>
<tr>
<td style="width: 25%;"><strong>Persona natural/juridica</strong></td>
<td style="width: 75%;">&nbsp;{*natural_juridica*}</td>
</tr>
<tr>
<td style="width: 25%;"><strong>Fecha de emision de la factura:</strong></td>
<td style="width: 75%;">&nbsp;{*fecha_emision*}</td>
</tr>
<tr>
<td><strong>Numero de factura:</strong></td>
<td>&nbsp;{*num_factura*}</td>
</tr>
<tr>
<td><strong>Descripcion servicio o producto</strong></td>
<td>&nbsp;{*descripcion*}</td>
</tr>
<tr>
<td><strong>Numero de folios</strong></td>
<td>&nbsp;{*num_folios*}</td>
</tr>
<tr>
<td><strong>Copia electronica a</strong></td>
<td>&nbsp;{*copia_electronica*}</td>
</tr>
<tr>
<td><strong>Estado</strong></td>
<td>&nbsp;{*estado_facturas*}</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p>{*item_factura*}</p>
<p>&nbsp;</p>
<p>{*mostrar_estado_proceso*}</p>','pie_pagina' => '','margenes' => '15,20,30,20','orientacion' => '0','papel' => 'Letter','exportar' => 'tcpdf','funcionario_idfuncionario' => '1','fecha' => '2018-05-24 19:43:23','mostrar' => '0','imagen' => '','detalle' => '0','tipo_edicion' => '0','item' => '0','serie_idserie' => '0','ayuda' => '','font_size' => '11','banderas' => 'e','tiempo_autoguardado' => '300000','mostrar_pdf' => '0','orden' => '3','enter2tab' => '0','firma_digital' => '0','fk_categoria_formato' => '1','flujo_idflujo' => '0','funcion_predeterminada' => '2','paginar' => '0','pertenece_nucleo' => '1','permite_imprimir' => '1','firma_crt' => NULL,'pos_firma_crt' => NULL,'logo_firma_crt' => NULL,'pos_logo_firma_crt' => NULL);
        private $formato_item_facturas =
        array('nombre' => 'item_facturas','etiqueta' => 'Clasificacion de factura','cod_padre' => '473','contador_idcontador' => '4','nombre_tabla' => 'ft_item_facturas','ruta_mostrar' => 'mostrar_item_facturas.php','ruta_editar' => 'editar_item_facturas.php','ruta_adicionar' => 'adicionar_item_facturas.php','librerias' => '','estilos' => '','javascript' => '','encabezado' => '','cuerpo' => '','pie_pagina' => '','margenes' => '15,20,30,20','orientacion' => '0','papel' => 'Letter','exportar' => 'tcpdf','funcionario_idfuncionario' => '1','fecha' => '2018-05-24 19:31:29','mostrar' => '0','imagen' => '','detalle' => '0','tipo_edicion' => '0','item' => '1','serie_idserie' => '0','ayuda' => '','font_size' => '11','banderas' => 'm','tiempo_autoguardado' => '300000','mostrar_pdf' => '1','orden' => '0','enter2tab' => '0','firma_digital' => '0','fk_categoria_formato' => NULL,'flujo_idflujo' => '0','funcion_predeterminada' => '','paginar' => '1','pertenece_nucleo' => '0','permite_imprimir' => '1','firma_crt' => NULL,'pos_firma_crt' => NULL,'logo_firma_crt' => NULL,'pos_logo_firma_crt' => NULL);

    private $campos_radicacion_facturas= array(
        array('nombre' => 'anexos_digitales','etiqueta' => 'ANEXOS DIGITALES','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '0','valor' => '','acciones' => 'a,e,b','ayuda' => '','predeterminado' => '','banderas' => '','etiqueta_html' => 'archivo','orden' => '17','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'anexos_fisicos','etiqueta' => 'ANEXOS F&Iacute;SICOS','tipo_dato' => 'TEXT','longitud' => '','obligatoriedad' => '0','valor' => 'sin_tiny','acciones' => 'a,e,b','ayuda' => '','predeterminado' => '','banderas' => '','etiqueta_html' => 'textarea','orden' => '16','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'copia_electronica','etiqueta' => 'COPIA ELECTR&Oacute;NICA A','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '0','valor' => '../../test.php?rol=1;1;0;1;1;0;5','acciones' => 'a,e,b','ayuda' => '','predeterminado' => '','banderas' => '','etiqueta_html' => 'arbol','orden' => '18','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'dependencia','etiqueta' => 'DEPENDENCIA DEL CREADOR DEL DOCUMENTO','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => '{*buscar_dependencia*}','acciones' => 'a,e','ayuda' => '','predeterminado' => '','banderas' => 'i','etiqueta_html' => 'hidden','orden' => '5','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'descripcion','etiqueta' => 'DESCRIPCI&Oacute;N SERVICIO O PRODUCTO','tipo_dato' => 'TEXT','longitud' => '','obligatoriedad' => '1','valor' => 'sin_tiny','acciones' => 'a,e,b','ayuda' => '','predeterminado' => '','banderas' => '','etiqueta_html' => 'textarea','orden' => '14','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'documento_iddocumento','etiqueta' => 'DOCUMENTO ASOCIADO','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => '','acciones' => 'a,e','ayuda' => '','predeterminado' => '','banderas' => 'i','etiqueta_html' => 'hidden','orden' => '4','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'encabezado','etiqueta' => 'ENCABEZADO','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => '','acciones' => 'a,e','ayuda' => '','predeterminado' => '1','banderas' => '','etiqueta_html' => 'hidden','orden' => '6','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'estado','etiqueta' => 'ESTADO','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '0','valor' => '1,Recibida;2,Devuelta;3,En proceso;4,Anulada;5,Pagada','acciones' => 'a,e,b','ayuda' => '','predeterminado' => '1','banderas' => '','etiqueta_html' => 'hidden','orden' => '11','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'estado_documento','etiqueta' => 'ESTADO DEL DOCUMENTO','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => NULL,'acciones' => 'a,e','ayuda' => NULL,'predeterminado' => '1','banderas' => '','etiqueta_html' => 'hidden','orden' => '0','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'fecha_emision','etiqueta' => 'FECHA DE EMISI&Oacute;N DE LA FACTURA','tipo_dato' => 'DATE','longitud' => '','obligatoriedad' => '0','valor' => '','acciones' => 'a,e,b','ayuda' => '','predeterminado' => '','banderas' => '','etiqueta_html' => 'fecha','orden' => '12','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'fecha_pago','etiqueta' => 'Fecha pago','tipo_dato' => 'DATETIME','longitud' => '','obligatoriedad' => '0','valor' => '','acciones' => 'a,e,b','ayuda' => '','predeterminado' => '','banderas' => '','etiqueta_html' => 'hidden','orden' => '0','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'fecha_radicado','etiqueta' => 'FECHA DE RADICACI&Oacute;N','tipo_dato' => 'DATETIME','longitud' => '','obligatoriedad' => '1','valor' => '','acciones' => 'a,e,b','ayuda' => '','predeterminado' => '','banderas' => '','etiqueta_html' => 'text','orden' => '8','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'firma','etiqueta' => 'FIRMAS DIGITALES','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => '','acciones' => 'a,e','ayuda' => '','predeterminado' => '1','banderas' => '','etiqueta_html' => 'hidden','orden' => '7','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'idft_radicacion_facturas','etiqueta' => 'RADICACION_FACTURAS','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => '','acciones' => 'a,e','ayuda' => '','predeterminado' => '','banderas' => 'ai,pk','etiqueta_html' => 'hidden','orden' => '3','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'natural_juridica','etiqueta' => 'PROVEEDOR','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '1','valor' => 'unico@nombre,identificacion@cargo,empresa,direccion,telefono,email,titulo,ciudad','acciones' => 'a,e,p,d,b','ayuda' => NULL,'predeterminado' => NULL,'banderas' => NULL,'etiqueta_html' => 'ejecutor','orden' => '10','mascara' => NULL,'adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'numero_radicado','etiqueta' => 'N&Uacute;MERO DE RADICADO','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => '{*mostrar_radicado_factura*}','acciones' => 'a,e,b','ayuda' => '','predeterminado' => '','banderas' => '','etiqueta_html' => 'hidden','orden' => '9','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'num_factura','etiqueta' => 'N&Uacute;MERO DE FACTURA','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '0','valor' => '','acciones' => 'a,e,b','ayuda' => '','predeterminado' => '','banderas' => '','etiqueta_html' => 'text','orden' => '13','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'num_folios','etiqueta' => 'N&Uacute;MERO DE FOLIOS','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '0','valor' => '','acciones' => 'a,e,b','ayuda' => '','predeterminado' => '','banderas' => '','etiqueta_html' => 'text','orden' => '15','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'observaciones_check','etiqueta' => 'Observaciones check','tipo_dato' => 'TEXT','longitud' => '','obligatoriedad' => '0','valor' => '','acciones' => 'a,e,b','ayuda' => '','predeterminado' => '','banderas' => '','etiqueta_html' => 'hidden','orden' => '0','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'serie_idserie','etiqueta' => 'SERIE DOCUMENTAL','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => '1472','acciones' => 'a','ayuda' => 'Radicaci&oacute;n de Facturas','predeterminado' => '18696','banderas' => 'fk','etiqueta_html' => 'hidden','orden' => '2','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array(
            "nombre" => "total_factura",
            "etiqueta" => "Total factura",
            "tipo_dato" => "VARCHAR",
            "longitud" => "50",
            "obligatoriedad" => 0,
            "acciones" => "a,e,b",
            "etiqueta_html" => "text",
            "orden" => 0,
            "autoguardado" => 0,
            "fila_visible" => 1
    )
    );

    private $campos_item_facturas= array(
        array('nombre' => 'clasificacion_fact','etiqueta' => 'CLASIFICACI&Oacute;N','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '1','valor' => '1,Orden de Compra;2,Contrato;3,Servicios p&uacute;blicos - Administraci&oacute;n;4,Cuenta de cobro','acciones' => 'a,e,b','ayuda' => '','predeterminado' => '','banderas' => '','etiqueta_html' => 'radio','orden' => '6','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'dependencia','etiqueta' => 'DEPENDENCIA DEL CREADOR DEL DOCUMENTO','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => '{*buscar_dependencia*}','acciones' => 'a,e,b','ayuda' => '','predeterminado' => '','banderas' => '','etiqueta_html' => 'hidden','orden' => '5','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'fecha_programada','etiqueta' => 'FECHA PROGRAMADA DE PAGO','tipo_dato' => 'DATE','longitud' => '','obligatoriedad' => '1','valor' => '','acciones' => 'a,e,b','ayuda' => '','predeterminado' => '','banderas' => '','etiqueta_html' => 'fecha','orden' => '10','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'ft_radicacion_facturas','etiqueta' => 'item_facturas','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => '473','acciones' => 'a','ayuda' => 'Clasificacion de factura','predeterminado' => '','banderas' => 'fk','etiqueta_html' => 'detalle','orden' => '4','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'idft_item_facturas','etiqueta' => 'ITEM_FACTURAS','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => '','acciones' => 'a,e','ayuda' => '','predeterminado' => '','banderas' => 'ai,pk','etiqueta_html' => 'hidden','orden' => '14','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'no_convenio','etiqueta' => 'NOMBRE CONVENIO','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '0','valor' => '','acciones' => 'a,b','ayuda' => '','predeterminado' => '','banderas' => '','etiqueta_html' => 'text','orden' => '8','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'numero_orden','etiqueta' => 'N&Uacute;MERO ORDEN COMPRA / CONTRATO','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '1','valor' => '','acciones' => 'a,e,b','ayuda' => '','predeterminado' => '','banderas' => '','etiqueta_html' => 'text','orden' => '12','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'pago_desde','etiqueta' => 'PAGO REALIZADO DESDE','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => '1,Centros de Costo Principal;2,Centros de Costo Convenio
','acciones' => 'a,e,b','ayuda' => NULL,'predeterminado' => NULL,'banderas' => NULL,'etiqueta_html' => 'radio','orden' => '7','mascara' => NULL,'adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'posterior_adicionar','etiqueta' => 'transferir responder','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '1','valor' => 'transferir_respon','acciones' => 'a,e,b','ayuda' => '','predeterminado' => 'transferir_respon','banderas' => '','etiqueta_html' => 'hidden','orden' => '1','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'prioridad','etiqueta' => 'PRIORIDAD','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '0','valor' => '3,Alta','acciones' => 'a,e,b','ayuda' => '1,Baja;2,Media;3,Alta','predeterminado' => '','banderas' => '','etiqueta_html' => 'radio','orden' => '11','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'responsable','etiqueta' => 'Responsable','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '1','valor' => '../../test.php?rol=1&sin_padre=1;2;0;1;1;0;5','acciones' => 'a,e,b','ayuda' => NULL,'predeterminado' => NULL,'banderas' => NULL,'etiqueta_html' => 'arbol','orden' => '13','mascara' => NULL,'adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'serie_idserie','etiqueta' => 'SERIE DOCUMENTAL','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => '1474','acciones' => 'a','ayuda' => 'Prueba 5 ','predeterminado' => '995','banderas' => 'fk','etiqueta_html' => 'hidden','orden' => '3','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'transferido','etiqueta' => 'Transferido','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '0','valor' => '1,SI;2,NO','acciones' => 'a,e','ayuda' => NULL,'predeterminado' => '2','banderas' => NULL,'etiqueta_html' => 'hidden','orden' => '0','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1'),
        array('nombre' => 'valor_factura','etiqueta' => 'VALOR DE LA FACTURA','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => '','acciones' => 'a,e,b','ayuda' => '','predeterminado' => '','banderas' => '','etiqueta_html' => 'text','orden' => '9','mascara' => '','adicionales' => '','autoguardado' => '0','fila_visible' => '1')
    );

    private $funciones_formato = array(
        array('nombre' => '{*mostrar_estado_proceso*}','nombre_funcion' => 'mostrar_estado_proceso','parametros' => '','etiqueta' => 'Mostrar las Firmas','descripcion' => 'mostrar_estado_proceso','ruta' => '../../class_transferencia.php','formato' => '','acciones' => 'm'),
        array('nombre' => '{*formato_numero*}','nombre_funcion' => 'formato_numero','parametros' => '','etiqueta' => 'formato_numero','descripcion' => 'formato_numero','ruta' => '../librerias/encabezado_pie_pagina.php','formato' => '','acciones' => 'm'),
        array('nombre' => '{*logo_empresa*}','nombre_funcion' => 'logo_empresa','parametros' => '','etiqueta' => 'logo_empresa','descripcion' => 'Logo de la empresa','ruta' => '../librerias/encabezado_pie_pagina.php','formato' => '','acciones' => 'm'),
        array('nombre' => '{*nombre_formato*}','nombre_funcion' => 'nombre_formato','parametros' => NULL,'etiqueta' => 'nombre_formato','descripcion' => 'Nombre del Formato','ruta' => '../librerias/encabezado_pie_pagina.php','formato' => '','acciones' => 'm'),
        array('nombre' => '{*nombre_empresa*}','nombre_funcion' => 'nombre_empresa','parametros' => '','etiqueta' => 'nombre_empresa','descripcion' => 'Nombre de la empresa','ruta' => '../librerias/encabezado_pie_pagina.php','formato' => '','acciones' => 'm'),
        array('nombre' => '{*digitalizar_formato*}','nombre_funcion' => 'digitalizar_formato','parametros' => '','etiqueta' => 'digitalizar_formato','descripcion' => '','ruta' => '../librerias/funciones_formatos_generales.php','formato' => '','acciones' => 'a,e'),
        array('nombre' => '{*genera_colilla_solicitud_pqrs*}','nombre_funcion' => 'genera_colilla_solicitud_pqrs','parametros' => '','etiqueta' => 'genera_colilla_solicitud_pqrs','descripcion' => '','ruta' => 'funciones.php','formato' => '','acciones' => ''),
        array('nombre' => '{*validar_digitalizacion_formato*}','nombre_funcion' => 'validar_digitalizacion_formato','parametros' => '','etiqueta' => 'validar_digitalizacion_formato','descripcion' => 'validar_digitalizacion_formato','ruta' => '../librerias/funciones_formatos_generales.php','formato' => ',473','acciones' => ''),
        array('nombre' => '{*mostrar_informacion_general_factura*}','nombre_funcion' => 'mostrar_informacion_general_factura','parametros' => '','etiqueta' => 'mostrar_informacion_general_factura','descripcion' => '','ruta' => 'funciones.php','formato' => '','acciones' => 'm'),
        array('nombre' => '{*item_factura*}','nombre_funcion' => 'item_factura','parametros' => '','etiqueta' => 'item_factura','descripcion' => '','ruta' => 'funciones.php','formato' => '','acciones' => 'm'),
        array('nombre' => '{*add_edit*}','nombre_funcion' => 'add_edit','parametros' => '','etiqueta' => 'add_edit','descripcion' => NULL,'ruta' => 'funciones.php','formato' => '','acciones' => 'a'),
        array('nombre' => '{*mostrar_radicado_factura*}','nombre_funcion' => 'mostrar_radicado_factura','parametros' => '','etiqueta' => 'mostrar_radicado_factura','descripcion' => '','ruta' => 'funciones.php','formato' => '','acciones' => 'a,e'),
        array('nombre' => '{*transferir_copia*}','nombre_funcion' => 'transferir_copia','parametros' => '','etiqueta' => 'transferir_copia','descripcion' => '','ruta' => 'funciones.php','formato' => '','acciones' => ''),
        array('nombre' => '{*estado_facturas*}','nombre_funcion' => 'estado_facturas','parametros' => '','etiqueta' => 'estado_facturas','descripcion' => '','ruta' => 'funciones.php','formato' => '','acciones' => 'm'),
        array('nombre' => '{*numero_rad_factura*}','nombre_funcion' => 'numero_rad_factura','parametros' => '','etiqueta' => 'numero_rad_factura','descripcion' => '','ruta' => '../librerias/encabezado_pie_pagina.php','formato' => '','acciones' => 'm'),
        array('nombre' => '{*autocompletar_convenio_clasificacion*}','nombre_funcion' => 'autocompletar_convenio_clasificacion','parametros' => '','etiqueta' => 'autocompletar_convenio_clasificacion','descripcion' => '','ruta' => 'funciones.php','formato' => '','acciones' => 'a'),
        array('nombre' => '{*add_edit_item_facturas*}','nombre_funcion' => 'add_edit_item_facturas','parametros' => NULL,'etiqueta' => 'add_edit_item_facturas','descripcion' => '','ruta' => 'funciones.php','formato' => '','acciones' => 'a')
    );

    public function getDescription() {
        return 'Crear formato radicacion_factura';
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
        $conn = $this->connection;
        $conn->beginTransaction();
        $idfmt_factura = $this->guardar_formato($this->formato_radicacion_facturas);

        $this->formato_item_facturas['cod_padre'] = $idfmt_factura;
        $idfmt_item = $this->guardar_formato($this->formato_item_facturas);

        if(!empty($idfmt_factura)) {
            foreach ($this->campos_radicacion_facturas as $value) {
                $this->guardar_campo($idfmt_factura, $value);
            }
        }

        if(!empty($idfmt_item)) {
            foreach ($this->campos_item_facturas as $value) {
                $this->guardar_campo($idfmt_item, $value);
            }
        }

        foreach ($this->funciones_formato as $ff) {
            $idfuncion = $this->guardar_funciones($ff);
            $this->guardar_funcion_fk($idfmt_factura, $idfuncion);
            $this->guardar_funcion_fk($idfmt_item, $idfuncion);
        }
        $conn->commit();
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs
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

    private function guardar_funcion_fk($idformato, $idfuncion) {
        if (empty($idformato) || empty($idfuncion)) {
            return false;
        }
        $conn = $this->connection;

        $idbusq = $conn->fetchColumn("select idfunciones_formato_enlace from funciones_formato_enlace where funciones_formato_fk = :idfuncion and formato_idformato = :idformato", [
            'idfuncion' => $idfuncion,
            'idformato' => $idformato
        ]);

        if (empty($idbusq)) {
            $datos = array('funciones_formato_fk' => $idfuncion, 'formato_idformato' => $idformato);
            $idbusq = $conn->insert('funciones_formato_enlace', $datos);
        }
        return $idbusq;
    }

    private function guardar_funciones($datos) {
        if (empty($datos)) {
            return false;
        }

        $conn = $this->connection;

        $idbusq = $conn->fetchColumn("select idfunciones_formato from funciones_formato where nombre_funcion = :nombre", [
            'nombre' => $datos["nombre_funcion"]
        ]);

        if (empty($idbusq)) {
            $resp = $conn->insert('funciones_formato', $datos);

            if (empty($resp)) {
                $conn->rollBack();
                print_r($conn->errorInfo());
                die("Fallo la creacion de la funcion");
            }
            $idbusq = $conn->lastInsertId();
        }
        return $idbusq;
    }
}
