<?php
declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190813121421 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {   
        $formato = array(
            array('idformato' => '1','nombre' => 'carta','etiqueta' => 'Comunicaci&oacute;n Externa','cod_padre' => '0','contador_idcontador' => '2','nombre_tabla' => 'ft_carta','ruta_mostrar' => 'mostrar_carta.php','ruta_editar' => 'editar_carta.php','ruta_adicionar' => 'adicionar_carta.php','librerias' => '','estilos' => '','javascript' => '','encabezado' => '3','cuerpo' => '<table border="0" cellspacing="0" style="width:100%">
              <tbody>
                  <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                  </tr>
                  <tr>
                      <td>{*ciudad*}, {*mostrar_fecha*}</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                  </tr>
                  <tr>
                      <td style="width:60%"><br />
                      <br />
                      {*mostrar_destinos*}</td>
                      <td colspan="2" rowspan="3" style="text-align:center; width:40%">{*mostrar_codigo_qr*}
                      <p><br />
                      No.{*formato_radicado_enviada*}</p>
                      </td>
                  </tr>
                  <tr>
                      <td>&nbsp;</td>
                  </tr>
                  <tr>
                      <td>&nbsp;</td>
                  </tr>
                  <tr>
                      <td colspan="3">&nbsp;
                      <p>ASUNTO: &nbsp; &nbsp; {*asunto*}</p>
                      </td>
                  </tr>
                  <tr>
                      <td colspan="3">&nbsp;</td>
                  </tr>
                  <tr>
                      <td colspan="3">&nbsp;</td>
                  </tr>
                  <tr>
                      <td colspan="3">Cordial saludo:</td>
                  </tr>
                  <tr>
                      <td colspan="3">
                      <p>&nbsp;</p>
          
                      <p>{*contenido*}</p>
                      </td>
                  </tr>
                  <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                  </tr>
                  <tr>
                      <td>&nbsp;Atentamente,</td>
                      <td>&nbsp;</td>
                  </tr>
                  <tr>
                      <td colspan="3" style="height:120px">
                      <p>{*mostrar_estado_proceso*}</p>
          
                      <p>{*mostrar_anexos_externa*}<br />
                      {*mostrar_copias_comunicacion_ext*}</p>
                      </td>
                  </tr>
                  <tr>
                      <td colspan="3">
                      <p>Proyect&oacute;: {*iniciales*}</p>
          
                      <p>ANEXOS DIGITALES{*anexos_digitales*}</p>
                      </td>
                  </tr>
              </tbody>
          </table>
          
          <p>&nbsp;</p>
          
          <p>&nbsp;</p>
          ','pie_pagina' => '9','margenes' => '25,25,25,25','orientacion' => '0','papel' => 'Letter','exportar' => 'mpdf','funcionario_idfuncionario' => '1','fecha' => '2019-08-13 07:56:21','mostrar' => '1','imagen' => NULL,'detalle' => '0','tipo_edicion' => '0','item' => '0','serie_idserie' => '86','ayuda' => '','font_size' => '12','banderas' => 'r','tiempo_autoguardado' => '300000','mostrar_pdf' => '1','orden' => '0','enter2tab' => '0','firma_digital' => '0','fk_categoria_formato' => '2,3,5','flujo_idflujo' => '0','funcion_predeterminada' => '','paginar' => '1','pertenece_nucleo' => '1','permite_imprimir' => '1','firma_crt' => '../almacenamiento/firmas_crt/carta/21617.crt','pos_firma_crt' => '180,88,15,15','logo_firma_crt' => NULL,'pos_logo_firma_crt' => '180,90,15,0','descripcion_formato' => 'Descripcion comunicacion','proceso_pertenece' => '0','version' => '1','documentacion' => '5d4445222091e','mostrar_tipodoc_pdf' => '0','publicar' => '1'),
            array('idformato' => '2','nombre' => 'memorando','etiqueta' => 'Comunicaci&oacute;n Interna','cod_padre' => '0','contador_idcontador' => '3','nombre_tabla' => 'ft_memorando','ruta_mostrar' => 'mostrar_memorando.php','ruta_editar' => 'editar_memorando.php','ruta_adicionar' => 'adicionar_memorando.php','librerias' => '','estilos' => '','javascript' => '','encabezado' => '3','cuerpo' => '<table border="0" cellspacing="0" style="border-collapse:collapse; width:100%">
              <tbody>
                  <tr>
                      <td colspan="2">&nbsp;</td>
                      <td>&nbsp;</td>
                  </tr>
                  <tr>
                      <td colspan="2">&nbsp;</td>
                      <td>&nbsp;</td>
                  </tr>
                  <tr>
                      <td colspan="2">{*ciudad*}, {*mostrar_fecha*}</td>
                      <td>&nbsp;</td>
                  </tr>
                  <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                  </tr>
                  <tr>
                      <td><br />
                      DE:</td>
                      <td><br />
                      {*mostrar_origen*}</td>
                      <td rowspan="5" style="text-align:center; width:40%">{*mostrar_codigo_qr*}<br />
                      <br />
                      <span>No. {*formato_radicado_interno*}</span></td>
                  </tr>
                  <tr>
                      <td style="width:12%">PARA:</td>
                      <td style="width:48%">{*lista_destinos*}&nbsp;</td>
                  </tr>
                  <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                  </tr>
                  <tr>
                      <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                      <td>ASUNTO:</td>
                      <td>{*asunto*}</td>
                  </tr>
                  <tr>
                      <td colspan="3" style="height:80px">
                      <p><br />
                      Cordial saludo:</p>
          
                      <p>&nbsp;</p>
                      </td>
                  </tr>
                  <tr>
                      <td colspan="3">{*contenido*}</td>
                  </tr>
                  <tr>
                      <td colspan="3">&nbsp;</td>
                  </tr>
                  <tr>
                      <td colspan="3">Atentamente,&nbsp;</td>
                  </tr>
                  <tr>
                      <td align="left" colspan="3">
                      <p>{*mostrar_estado_proceso*}</p>
          
                      <p>{*mostrar_anexos*}<br />
                      {*mostrar_copias_memo*}<br />
                      Proyect&oacute;: {*mostrar_iniciales*}</p>
                      </td>
                  </tr>
              </tbody>
          </table>
          ','pie_pagina' => '4','margenes' => '25,25,25,25','orientacion' => '0','papel' => 'Letter','exportar' => 'mpdf','funcionario_idfuncionario' => '1','fecha' => '2019-08-13 07:56:24','mostrar' => '1','imagen' => '','detalle' => '0','tipo_edicion' => '0','item' => '0','serie_idserie' => '86','ayuda' => 'Documento informativo de comunicaci&oacute;n interna','font_size' => '11','banderas' => 'r','tiempo_autoguardado' => '300000','mostrar_pdf' => '1','orden' => '0','enter2tab' => '0','firma_digital' => '0','fk_categoria_formato' => '2,5','flujo_idflujo' => '0','funcion_predeterminada' => '','paginar' => '1','pertenece_nucleo' => '1','permite_imprimir' => '1','firma_crt' => NULL,'pos_firma_crt' => NULL,'logo_firma_crt' => NULL,'pos_logo_firma_crt' => NULL,'descripcion_formato' => 'D','proceso_pertenece' => '0','version' => '0','documentacion' => '5d48203fc5195','mostrar_tipodoc_pdf' => '0','publicar' => '1'),
            array('idformato' => '3','nombre' => 'radicacion_entrada','etiqueta' => 'Radicaci&oacute;n de Correspondencia','cod_padre' => '0','contador_idcontador' => '1','nombre_tabla' => 'ft_radicacion_entrada','ruta_mostrar' => 'mostrar_radicacion_entrada.php','ruta_editar' => 'editar_radicacion_entrada.php','ruta_adicionar' => 'adicionar_radicacion_entrada.php','librerias' => '','estilos' => '','javascript' => '','encabezado' => '13','cuerpo' => '<p><span>{*llenar_datos_funcion*}</span></p>
          
          <p>{*mostrar_informacion_general_radicacion*}</p>
          
          <div>{*mostrar_item_destino_radicacion*}</div>
          
          <p>{*mostrar_copia_electronica*}</p>
          
          <p>{*mostrar_estado_proceso*}</p>
          ','pie_pagina' => '9','margenes' => '25,25,25,25','orientacion' => '0','papel' => 'Letter','exportar' => 'mpdf','funcionario_idfuncionario' => '1','fecha' => '2019-08-13 07:56:31','mostrar' => '1','imagen' => '','detalle' => '0','tipo_edicion' => '0','item' => '0','serie_idserie' => '86','ayuda' => '','font_size' => '11','banderas' => 'e,r','tiempo_autoguardado' => '300000','mostrar_pdf' => '0','orden' => '0','enter2tab' => '0','firma_digital' => '0','fk_categoria_formato' => '1','flujo_idflujo' => '0','funcion_predeterminada' => '','paginar' => '1','pertenece_nucleo' => '1','permite_imprimir' => '1','firma_crt' => NULL,'pos_firma_crt' => NULL,'logo_firma_crt' => NULL,'pos_logo_firma_crt' => NULL,'descripcion_formato' => 'ASD','proceso_pertenece' => '0','version' => '0','documentacion' => '5d4ca023e1e8d','mostrar_tipodoc_pdf' => '0','publicar' => '1'),
            array('idformato' => '348','nombre' => 'correo_saia','etiqueta' => 'Correo SAIA','cod_padre' => '0','contador_idcontador' => '2','nombre_tabla' => 'ft_correo_saia','ruta_mostrar' => 'mostrar_correo_saia.php','ruta_editar' => 'editar_correo_saia.php','ruta_adicionar' => 'adicionar_correo_saia.php','librerias' => NULL,'estilos' => NULL,'javascript' => NULL,'encabezado' => '1','cuerpo' => '<table style="width: 100%;" border="1" cellspacing="0">
          <tbody>
          <tr>
          <td class="encabezado_list" style="text-align: left;">Asunto</td>
          <td style="text-align: left;">&nbsp;{*asunto*}</td>
          </tr>
          <tr>
          <td class="encabezado_list" style="text-align: left;">Fecha Oficio Entrada</td>
          <td style="text-align: left;">&nbsp;{*fecha_oficio_entrada*}</td>
          </tr>
          <tr>
          <td class="encabezado_list" style="text-align: left;">De</td>
          <td style="text-align: left;">&nbsp;{*de*}</td>
          </tr>
          <tr>
          <td class="encabezado_list" style="text-align: left;">Para</td>
          <td style="text-align: left;">&nbsp;{*para*}</td>
          </tr>
          <tr>
          <td class="encabezado_list" style="text-align: left;">Transferido</td>
          <td style="text-align: left;">&nbsp;{*transferencia_correo*}</td>
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
          <p>{*mostrar_estado_proceso*}</p>
          <p>{*mostrar_anexos_correo*}</p>','pie_pagina' => '','margenes' => '15,20,30,20','orientacion' => '0','papel' => 'A4','exportar' => 'mpdf','funcionario_idfuncionario' => '1','fecha' => '2019-07-31 13:49:35','mostrar' => '0','imagen' => NULL,'detalle' => '0','tipo_edicion' => '0','item' => '0','serie_idserie' => '0','ayuda' => NULL,'font_size' => '11','banderas' => 'e','tiempo_autoguardado' => '300000','mostrar_pdf' => '0','orden' => NULL,'enter2tab' => '0','firma_digital' => '0','fk_categoria_formato' => '2,3','flujo_idflujo' => '0','funcion_predeterminada' => '','paginar' => '1','pertenece_nucleo' => '1','permite_imprimir' => '1','firma_crt' => NULL,'pos_firma_crt' => NULL,'logo_firma_crt' => NULL,'pos_logo_firma_crt' => NULL,'descripcion_formato' => NULL,'proceso_pertenece' => '0','version' => '0','documentacion' => NULL,'mostrar_tipodoc_pdf' => '0','publicar' => '1'),
            array('idformato' => '352','nombre' => 'despacho_fisico','etiqueta' => 'Despacho fisico','cod_padre' => '0','contador_idcontador' => '4','nombre_tabla' => 'ft_despacho_fisico','ruta_mostrar' => 'mostrar_despacho_fisico.php','ruta_editar' => 'editar_despacho_fisico.php','ruta_adicionar' => 'adicionar_despacho_fisico.php','librerias' => NULL,'estilos' => NULL,'javascript' => NULL,'encabezado' => '5','cuerpo' => '<p>{*mostrar_seleccionados_despacho*}</p>
          ','pie_pagina' => '','margenes' => '15,20,30,20','orientacion' => '1','papel' => 'A4','exportar' => 'mpdf','funcionario_idfuncionario' => '1','fecha' => '2019-07-31 13:49:35','mostrar' => '1','imagen' => NULL,'detalle' => '0','tipo_edicion' => '0','item' => '0','serie_idserie' => '0','ayuda' => NULL,'font_size' => '11','banderas' => 'e','tiempo_autoguardado' => '300000','mostrar_pdf' => '0','orden' => NULL,'enter2tab' => '0','firma_digital' => '0','fk_categoria_formato' => '2,3','flujo_idflujo' => '0','funcion_predeterminada' => '','paginar' => '1','pertenece_nucleo' => '1','permite_imprimir' => '1','firma_crt' => NULL,'pos_firma_crt' => NULL,'logo_firma_crt' => NULL,'pos_logo_firma_crt' => NULL,'descripcion_formato' => NULL,'proceso_pertenece' => '0','version' => '0','documentacion' => NULL,'mostrar_tipodoc_pdf' => '0','publicar' => '1'),
            array('idformato' => '353','nombre' => 'despacho_ingresados','etiqueta' => 'Entrega interna','cod_padre' => '0','contador_idcontador' => '4','nombre_tabla' => 'ft_despacho_ingresados','ruta_mostrar' => 'mostrar_despacho_ingresados.php','ruta_editar' => 'editar_despacho_ingresados.php','ruta_adicionar' => 'adicionar_despacho_ingresados.php','librerias' => '','estilos' => NULL,'javascript' => NULL,'encabezado' => '14','cuerpo' => '<table align="center" border="1" cellspacing="0" style="position:relative; top:0px; width:100%">
              <tbody>
                  <tr>
                      <td style="width:30%"><strong>Auxiliar de mensajer&iacute;a:</strong></td>
                      <td style="width:50%"><strong>Tipo de Mensajer&iacute;a:</strong>{*tipo_mensajero*}</td>
                      <td style="width:20%"><strong>Recorrido:</strong>{*tipo_recorrido*}</td>
                  </tr>
              </tbody>
          </table>
          <p style="height:20px"></p>
          <p>{*mostrar_seleccionados_entrega*}</p>
          ','pie_pagina' => '4','margenes' => '25,25,25,25','orientacion' => '1','papel' => 'Letter','exportar' => 'mpdf','funcionario_idfuncionario' => '1','fecha' => '2019-08-13 07:57:05','mostrar' => '1','imagen' => NULL,'detalle' => '0','tipo_edicion' => '1','item' => '0','serie_idserie' => '86','ayuda' => NULL,'font_size' => '11','banderas' => 'e,r','tiempo_autoguardado' => '300000','mostrar_pdf' => '1','orden' => NULL,'enter2tab' => '0','firma_digital' => '0','fk_categoria_formato' => '2,3','flujo_idflujo' => '0','funcion_predeterminada' => '','paginar' => '1','pertenece_nucleo' => '1','permite_imprimir' => '1','firma_crt' => NULL,'pos_firma_crt' => NULL,'logo_firma_crt' => NULL,'pos_logo_firma_crt' => NULL,'descripcion_formato' => '.','proceso_pertenece' => '0','version' => '0','documentacion' => '5d4834b6362d8','mostrar_tipodoc_pdf' => '0','publicar' => '1'),
            array('idformato' => '404','nombre' => 'ruta_distribucion','etiqueta' => 'Rutas de Distribuci&oacute;n','cod_padre' => '0','contador_idcontador' => '4','nombre_tabla' => 'ft_ruta_distribucion','ruta_mostrar' => 'mostrar_ruta_distribucion.php','ruta_editar' => 'editar_ruta_distribucion.php','ruta_adicionar' => 'adicionar_ruta_distribucion.php','librerias' => '','estilos' => NULL,'javascript' => NULL,'encabezado' => '15','cuerpo' => '<table border="0" cellspacing="0" style="margin-top:30px; width:100%">
              <tbody>
                  <tr>
                      <td style="width:70%">&nbsp;</td>
                      <td style="text-align:center; width:30%">
                      <p style="font-size:80%">RUTA DE DISTRIBUCI&Oacute;N<br />
                      <br />
                      {*mostrar_codigo_qr*}<br />
                      <br />
                      No.{*formato_numero*}</p>
                      </td>
                  </tr>
              </tbody>
          </table>
          
          <p><strong>FECHA: </strong> {*fecha_ruta_distribuc*} <strong>&nbsp;</strong></p>
          
          <p><strong>NOMBRE DE LA RUTA: </strong> {*nombre_ruta*}</p>
          
          <p><strong>DESCRIPCI&Oacute;N DE LA RUTA: </strong> {*descripcion_ruta*}</p>
          
          <p>&nbsp;</p>
          
          <p>&nbsp;</p>
          
          <p><strong>DEPENDENCIAS DE LA RUTA</strong></p>
          
          <p>{*mostrar_datos_dependencias_ruta*}</p>
          
          <p>&nbsp;</p>
          
          <p><strong>MENSAJEROS DE LA RUTA</strong></p>
          
          <p>{*mostrar_datos_funcionarios_ruta*}</p>
          ','pie_pagina' => '9','margenes' => '15,20,30,20','orientacion' => '0','papel' => 'Letter','exportar' => 'mpdf','funcionario_idfuncionario' => '1','fecha' => '2019-08-13 07:57:28','mostrar' => '1','imagen' => NULL,'detalle' => '0','tipo_edicion' => '1','item' => '0','serie_idserie' => '86','ayuda' => NULL,'font_size' => '11','banderas' => 'r','tiempo_autoguardado' => '300000','mostrar_pdf' => '1','orden' => NULL,'enter2tab' => '0','firma_digital' => '0','fk_categoria_formato' => '2,3','flujo_idflujo' => '0','funcion_predeterminada' => '','paginar' => '0','pertenece_nucleo' => '1','permite_imprimir' => '1','firma_crt' => NULL,'pos_firma_crt' => NULL,'logo_firma_crt' => NULL,'pos_logo_firma_crt' => NULL,'descripcion_formato' => 'Rutas de distribuci&oacute;n.','proceso_pertenece' => '0','version' => '0','documentacion' => '5d4c9e2bd9263','mostrar_tipodoc_pdf' => '0','publicar' => '1'),
            array('idformato' => '405','nombre' => 'dependencias_ruta','etiqueta' => 'Dependencias de la Ruta','cod_padre' => '404','contador_idcontador' => '4','nombre_tabla' => 'ft_dependencias_ruta','ruta_mostrar' => 'mostrar_dependencias_ruta.php','ruta_editar' => 'editar_dependencias_ruta.php','ruta_adicionar' => 'adicionar_dependencias_ruta.php','librerias' => '','estilos' => NULL,'javascript' => NULL,'encabezado' => '13','cuerpo' => '<p><table></table></p>
          ','pie_pagina' => '','margenes' => '15,20,30,20','orientacion' => '0','papel' => 'A4','exportar' => 'mpdf','funcionario_idfuncionario' => '1','fecha' => '2019-08-13 07:57:31','mostrar' => '1','imagen' => NULL,'detalle' => '0','tipo_edicion' => '0','item' => '1','serie_idserie' => '86','ayuda' => NULL,'font_size' => '11','banderas' => 'r','tiempo_autoguardado' => '300000','mostrar_pdf' => '0','orden' => NULL,'enter2tab' => '0','firma_digital' => '0','fk_categoria_formato' => '','flujo_idflujo' => '0','funcion_predeterminada' => '','paginar' => '1','pertenece_nucleo' => '1','permite_imprimir' => '1','firma_crt' => NULL,'pos_firma_crt' => NULL,'logo_firma_crt' => NULL,'pos_logo_firma_crt' => NULL,'descripcion_formato' => 'dependencia de la ruta','proceso_pertenece' => '0','version' => '0','documentacion' => '5d4c903ba7b43','mostrar_tipodoc_pdf' => '0','publicar' => '1'),
            array('idformato' => '406','nombre' => 'funcionarios_ruta','etiqueta' => 'Funcionarios de la ruta','cod_padre' => '404','contador_idcontador' => '4','nombre_tabla' => 'ft_funcionarios_ruta','ruta_mostrar' => 'mostrar_funcionarios_ruta.php','ruta_editar' => 'editar_funcionarios_ruta.php','ruta_adicionar' => 'adicionar_funcionarios_ruta.php','librerias' => '','estilos' => NULL,'javascript' => NULL,'encabezado' => NULL,'cuerpo' => NULL,'pie_pagina' => NULL,'margenes' => '15,20,30,20','orientacion' => '0','papel' => 'A4','exportar' => 'mpdf','funcionario_idfuncionario' => '1','fecha' => '2019-08-13 07:57:33','mostrar' => '1','imagen' => NULL,'detalle' => '0','tipo_edicion' => '0','item' => '1','serie_idserie' => '86','ayuda' => NULL,'font_size' => '11','banderas' => 'r','tiempo_autoguardado' => '300000','mostrar_pdf' => '1','orden' => NULL,'enter2tab' => '0','firma_digital' => '0','fk_categoria_formato' => '','flujo_idflujo' => '0','funcion_predeterminada' => '','paginar' => '1','pertenece_nucleo' => '1','permite_imprimir' => '1','firma_crt' => NULL,'pos_firma_crt' => NULL,'logo_firma_crt' => NULL,'pos_logo_firma_crt' => NULL,'descripcion_formato' => 'funcionarios de la ruta','proceso_pertenece' => '0','version' => '0','documentacion' => '5d4c90f8da0ba','mostrar_tipodoc_pdf' => '0','publicar' => '1'),
            array('idformato' => '407','nombre' => 'item_despacho_ingres','etiqueta' => 'Item despacho ingresados','cod_padre' => '353','contador_idcontador' => '4','nombre_tabla' => 'ft_item_despacho_ingres','ruta_mostrar' => 'mostrar_item_despacho_ingres.php','ruta_editar' => 'editar_item_despacho_ingres.php','ruta_adicionar' => 'adicionar_item_despacho_ingres.php','librerias' => NULL,'estilos' => NULL,'javascript' => NULL,'encabezado' => '1','cuerpo' => '','pie_pagina' => '','margenes' => '15,20,30,20','orientacion' => '0','papel' => 'A4','exportar' => 'mpdf','funcionario_idfuncionario' => '1','fecha' => '2019-07-31 13:49:35','mostrar' => '0','imagen' => NULL,'detalle' => '0','tipo_edicion' => '0','item' => '1','serie_idserie' => '0','ayuda' => NULL,'font_size' => '11','banderas' => 'm','tiempo_autoguardado' => '300000','mostrar_pdf' => '0','orden' => NULL,'enter2tab' => '0','firma_digital' => '0','fk_categoria_formato' => NULL,'flujo_idflujo' => '0','funcion_predeterminada' => '','paginar' => '1','pertenece_nucleo' => '1','permite_imprimir' => '1','firma_crt' => NULL,'pos_firma_crt' => NULL,'logo_firma_crt' => NULL,'pos_logo_firma_crt' => NULL,'descripcion_formato' => NULL,'proceso_pertenece' => '0','version' => '0','documentacion' => NULL,'mostrar_tipodoc_pdf' => '0','publicar' => '0'),
            array('idformato' => '411','nombre' => 'novedad_despacho','etiqueta' => 'Novedad Despacho Mensajeros','cod_padre' => '353','contador_idcontador' => '4','nombre_tabla' => 'ft_novedad_despacho','ruta_mostrar' => 'mostrar_novedad_despacho.php','ruta_editar' => 'editar_novedad_despacho.php','ruta_adicionar' => 'adicionar_novedad_despacho.php','librerias' => NULL,'estilos' => NULL,'javascript' => NULL,'encabezado' => '1','cuerpo' => '<table class="table table-bordered" style="width: 100%;" border="1">
          <tbody>
          <tr>
          <td>FECHA DE NOVEDAD:</td>
          <td>{*fecha_novedad*}</td>
          </tr>
          <tr>
          <td>ITEMS DE PLANILLA:</td>
          <td>{*mostrar_numero_item_novedad*}</td>
          </tr>
          <tr>
          <td>NOVEDAD:</td>
          <td>{*novedad*}</td>
          </tr>
          <tr>
          <td>OBSERVACIONES:</td>
          <td>{*observaciones*}</td>
          </tr>
          <tr>
          <td>ANEXOS / SOPORTE DE ENTREGA:</td>
          <td>{*mostrar_novedad_despacho_anexo_soporte*}</td>
          </tr>
          </tbody>
          </table>
          <p>{*mostrar_estado_proceso*}</p>','pie_pagina' => '','margenes' => '10,10,20,10','orientacion' => '0','papel' => 'A5','exportar' => 'mpdf','funcionario_idfuncionario' => '1','fecha' => '2019-07-31 13:49:35','mostrar' => '0','imagen' => NULL,'detalle' => '1','tipo_edicion' => '0','item' => '0','serie_idserie' => '0','ayuda' => NULL,'font_size' => '11','banderas' => 'e','tiempo_autoguardado' => '300000','mostrar_pdf' => '0','orden' => NULL,'enter2tab' => '0','firma_digital' => '0','fk_categoria_formato' => '','flujo_idflujo' => '0','funcion_predeterminada' => '','paginar' => '1','pertenece_nucleo' => '1','permite_imprimir' => '1','firma_crt' => NULL,'pos_firma_crt' => NULL,'logo_firma_crt' => NULL,'pos_logo_firma_crt' => NULL,'descripcion_formato' => NULL,'proceso_pertenece' => '0','version' => '0','documentacion' => NULL,'mostrar_tipodoc_pdf' => '0','publicar' => '0'),
            array('idformato' => '422','nombre' => 'facturas_obras','etiqueta' => 'RADICACI&Oacute;N FACTURAS DE OBRA','cod_padre' => '0','contador_idcontador' => '1','nombre_tabla' => 'ft_facturas_obras','ruta_mostrar' => 'mostrar_facturas_obras.php','ruta_editar' => 'editar_facturas_obras.php','ruta_adicionar' => 'adicionar_facturas_obras.php','librerias' => '','estilos' => NULL,'javascript' => NULL,'encabezado' => '1','cuerpo' => '<p>{*cargar_datos_rad_obras*}</p>
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
          <p>{*mostrar_estado_proceso*}</p>','pie_pagina' => '','margenes' => '15,20,30,20','orientacion' => '0','papel' => 'A4','exportar' => 'mpdf','funcionario_idfuncionario' => '1','fecha' => '2019-08-13 07:57:59','mostrar' => '1','imagen' => NULL,'detalle' => '0','tipo_edicion' => '0','item' => '0','serie_idserie' => '86','ayuda' => NULL,'font_size' => '8','banderas' => 'e,r','tiempo_autoguardado' => '300000','mostrar_pdf' => '0','orden' => NULL,'enter2tab' => '0','firma_digital' => '0','fk_categoria_formato' => '1','flujo_idflujo' => '0','funcion_predeterminada' => '','paginar' => '1','pertenece_nucleo' => '1','permite_imprimir' => '1','firma_crt' => NULL,'pos_firma_crt' => NULL,'logo_firma_crt' => NULL,'pos_logo_firma_crt' => NULL,'descripcion_formato' => 'ghdf','proceso_pertenece' => '0','version' => '0','documentacion' => '5d422362b3f25','mostrar_tipodoc_pdf' => '0','publicar' => '0'),
            array('idformato' => '424','nombre' => 'radicacion_facturas','etiqueta' => 'Radicaci&oacute;n de Facturas','cod_padre' => '0','contador_idcontador' => '1','nombre_tabla' => 'ft_radicacion_facturas','ruta_mostrar' => 'mostrar_radicacion_facturas.php','ruta_editar' => 'editar_radicacion_facturas.php','ruta_adicionar' => 'adicionar_radicacion_facturas.php','librerias' => NULL,'estilos' => '','javascript' => '','encabezado' => '1','cuerpo' => '<table class="table table-bordered" style="width: 100%;" border="1">
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
          <p>{*mostrar_estado_proceso*}</p>','pie_pagina' => '','margenes' => '15,20,30,20','orientacion' => '0','papel' => 'Letter','exportar' => 'mpdf','funcionario_idfuncionario' => '1','fecha' => '2019-07-31 13:49:35','mostrar' => '0','imagen' => '','detalle' => '0','tipo_edicion' => '0','item' => '0','serie_idserie' => '0','ayuda' => '','font_size' => '11','banderas' => 'e','tiempo_autoguardado' => '300000','mostrar_pdf' => '0','orden' => '3','enter2tab' => '0','firma_digital' => '0','fk_categoria_formato' => '1','flujo_idflujo' => '0','funcion_predeterminada' => '2','paginar' => '0','pertenece_nucleo' => '1','permite_imprimir' => '1','firma_crt' => NULL,'pos_firma_crt' => NULL,'logo_firma_crt' => NULL,'pos_logo_firma_crt' => NULL,'descripcion_formato' => NULL,'proceso_pertenece' => '0','version' => '0','documentacion' => NULL,'mostrar_tipodoc_pdf' => '0','publicar' => '0'),
            array('idformato' => '425','nombre' => 'item_facturas','etiqueta' => 'Clasificacion de factura','cod_padre' => '424','contador_idcontador' => '4','nombre_tabla' => 'ft_item_facturas','ruta_mostrar' => 'mostrar_item_facturas.php','ruta_editar' => 'editar_item_facturas.php','ruta_adicionar' => 'adicionar_item_facturas.php','librerias' => '','estilos' => '','javascript' => '','encabezado' => '','cuerpo' => '','pie_pagina' => '','margenes' => '15,20,30,20','orientacion' => '0','papel' => 'Letter','exportar' => 'mpdf','funcionario_idfuncionario' => '1','fecha' => '2019-07-31 13:49:35','mostrar' => '0','imagen' => '','detalle' => '0','tipo_edicion' => '0','item' => '1','serie_idserie' => '0','ayuda' => '','font_size' => '11','banderas' => 'm','tiempo_autoguardado' => '300000','mostrar_pdf' => '1','orden' => '0','enter2tab' => '0','firma_digital' => '0','fk_categoria_formato' => NULL,'flujo_idflujo' => '0','funcion_predeterminada' => '','paginar' => '1','pertenece_nucleo' => '1','permite_imprimir' => '1','firma_crt' => NULL,'pos_firma_crt' => NULL,'logo_firma_crt' => NULL,'pos_logo_firma_crt' => NULL,'descripcion_formato' => NULL,'proceso_pertenece' => '0','version' => '0','documentacion' => NULL,'mostrar_tipodoc_pdf' => '0','publicar' => '0'),
            array('idformato' => '438','nombre' => 'factura_electronica','etiqueta' => 'Factura electr&oacute;nica','cod_padre' => '0','contador_idcontador' => '4','nombre_tabla' => 'ft_factura_electronica','ruta_mostrar' => 'mostrar_factura_electronica.php','ruta_editar' => 'editar_factura_electronica.php','ruta_adicionar' => 'adicionar_factura_electronica.php','librerias' => NULL,'estilos' => NULL,'javascript' => NULL,'encabezado' => '0','cuerpo' => '<table border="0" cellpadding="1" cellspacing="1" style="width:100%">
              <tbody>
                  <tr>
                      <td>{*mostrar_datos_factura*}</td>
                      <td style="width:20%">FACTURA ELECTR&Oacute;NICA</td>
                  </tr>
                  <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                  </tr>
                  <tr>
                      <td>
                      <p>{*fecha_creacion*}</p>
                      </td>
                      <td>{*mostrar_codigo_qr*}</td>
                  </tr>
              </tbody>
          </table>
          <p>&nbsp;</p>
          <p>{*mostrar_detalle_factura*}</p>
          ','pie_pagina' => '','margenes' => '15,20,15,30','orientacion' => '0','papel' => 'A4','exportar' => 'mpdf','funcionario_idfuncionario' => '1','fecha' => '2019-07-31 13:49:35','mostrar' => '1','imagen' => NULL,'detalle' => '0','tipo_edicion' => '1','item' => '0','serie_idserie' => '0','ayuda' => NULL,'font_size' => '11','banderas' => 'm','tiempo_autoguardado' => '300000','mostrar_pdf' => '0','orden' => NULL,'enter2tab' => '0','firma_digital' => '0','fk_categoria_formato' => '2,3','flujo_idflujo' => '0','funcion_predeterminada' => '','paginar' => '1','pertenece_nucleo' => '1','permite_imprimir' => '1','firma_crt' => NULL,'pos_firma_crt' => NULL,'logo_firma_crt' => NULL,'pos_logo_firma_crt' => NULL,'descripcion_formato' => NULL,'proceso_pertenece' => '0','version' => '0','documentacion' => NULL,'mostrar_tipodoc_pdf' => '0','publicar' => '1'),
            array('idformato' => '439','nombre' => 'ite_factur_electronica','etiqueta' => 'Item Factura Electr&oacute;nica','cod_padre' => '438','contador_idcontador' => '4','nombre_tabla' => 'ft_ite_factur_electronica','ruta_mostrar' => 'mostrar_ite_factur_electronica.php','ruta_editar' => 'editar_ite_factur_electronica.php','ruta_adicionar' => 'adicionar_ite_factur_electronica.php','librerias' => '','estilos' => NULL,'javascript' => NULL,'encabezado' => NULL,'cuerpo' => NULL,'pie_pagina' => NULL,'margenes' => '25,25,25,25','orientacion' => '0','papel' => 'Letter','exportar' => 'mpdf','funcionario_idfuncionario' => '1','fecha' => '2019-07-31 13:49:35','mostrar' => '1','imagen' => NULL,'detalle' => '0','tipo_edicion' => '0','item' => '1','serie_idserie' => '54','ayuda' => NULL,'font_size' => '11','banderas' => 'r','tiempo_autoguardado' => '300000','mostrar_pdf' => '0','orden' => NULL,'enter2tab' => '0','firma_digital' => '0','fk_categoria_formato' => '2,3','flujo_idflujo' => '0','funcion_predeterminada' => '','paginar' => '0','pertenece_nucleo' => '1','permite_imprimir' => '1','firma_crt' => NULL,'pos_firma_crt' => NULL,'logo_firma_crt' => NULL,'pos_logo_firma_crt' => NULL,'descripcion_formato' => 'Item Factura Electr&oacute;nica','proceso_pertenece' => '0','version' => '1','documentacion' => '5c6dc81af0810','mostrar_tipodoc_pdf' => '0','publicar' => '0')
          );

        for($i=0; $i < count($formato); $i++){
            $this->connection->insert('formato', $formato[$i]);
        }


        $encabezado_formato = array(
            array('idencabezado_formato' => '1','contenido' => '<table align="center" border="1" cellspacing="0" style="border-collapse:collapse; width:100%">
              <tbody>
                  <tr>
                      <td style="border-color:#b6b8b7; text-align:center; width:30%">{*nombre_empresa*}</td>
                      <td style="border-color:#b6b8b7; text-align:center; vertical-align:middle; width:40%"><strong>{*nombre_formato*}</strong></td>
                      <td style="border-color:#b6b8b7; text-align:center; vertical-align:middle; width:30%">{*logo_empresa*}</td>
                  </tr>
              </tbody>
          </table>
          ','etiqueta' => 'Encabezado estandar con borde'),
            array('idencabezado_formato' => '2','contenido' => '<table style="border-collapse: collapse; width: 100%;" border="0" align="center">
          <tbody>
          <tr>
          <td style="text-align: center; width: 30%;">&nbsp;Fecha: 16/09/2016</td>
          <td style="text-align: center; width: 40%;" rowspan="3" valign="middle"><strong>{*nombre_formato*}</strong></td>
          <td style="text-align: center; width: 30%;" rowspan="3" valign="middle">{*logo_empresa*}</td>
          </tr>
          <tr>
          <td style="text-align: center;">{*nombre_empresa*}</td>
          </tr>
          <tr>
          <td style="text-align: center;">&nbsp;Edici&oacute;n No 01&nbsp;</td>
          </tr>
          </tbody>
          </table>','etiqueta' => 'Encabezado estandar sin borde'),
            array('idencabezado_formato' => '3','contenido' => '<table align="center" border="0" cellspacing="0" style="border-collapse:collapse; width:100%">
              <tbody>
                  <tr>
                      <td colspan="2" style="height:70px">&nbsp;</td>
                  </tr>
                  <tr>
                      <td style="vertical-align:middle; width:60%">{*logo_empresa*}</td>
                      <td style="text-align:center; vertical-align:middle">&nbsp;</td>
                  </tr>
                  <tr>
                      <td style="vertical-align:middle">{*nombre_empresa*}</td>
                      <td style="text-align:center; vertical-align:middle">{*nombre_formato*}</td>
                  </tr>
                  <tr>
                      <td style="vertical-align:middle">&nbsp;</td>
                      <td style="text-align:center; vertical-align:middle">&nbsp;</td>
                  </tr>
              </tbody>
          </table>
          ','etiqueta' => 'Encabezado Comunicaciones'),
            array('idencabezado_formato' => '4','contenido' => '<table border="0" style="width:100%">
              <tbody>
                  <tr>
                      <td style="text-align:center">____________________________________________________________________</td>
                  </tr>
                  <tr>
                      <td style="text-align:center">Calle 77 No. 25-33 PBX (57) 1 777 2233 | <a href="http://www.cerok.com" target="_blank">www.suempresa.com</a> | Bogot&aacute;, Colombia</td>
                  </tr>
                  <tr>
                      <td style="text-align:right"><span style="font-size:8px">GDC-FT-008. Versi&oacute;n:001</span></td>
                  </tr>
              </tbody>
          </table>
          ','etiqueta' => 'Pie Comunicaciones'),
            array('idencabezado_formato' => '5','contenido' => '<p style="text-align:right">Pagina {PAGENO}</p>
          
          <table border="1" cellspacing="0" style="border-collapse:collapse; width:100%">
              <tbody>
                  <tr>
                      <td style="text-align:center; width:27.75%">
                      <p><br />
                      {*logo_empresa*}</p>
          
                      <p>{*nombre_empresa*}</p>
                      </td>
                      <td style="text-align:center; width:58.8%">
                      <p><br />
                      <br />
                      <strong>PLANILLA DE MENSAJERIA</strong></p>
          
                      <p><strong>Fecha:&nbsp;</strong>{*fecha_planilla*}</p>
                      </td>
                      <td style="text-align:center; width:13%"><br />
                      <br />
                      {*mostrar_codigo_qr_encabezado*}</td>
                  </tr>
                  <tr>
                      <td>
                      <p style="text-align:center"><strong>Auxiliar de Mensajer&iacute;a:&nbsp;</strong>{*mensajero_entrega_interna*}{*ruta_entrega_interna*}</p>
                      </td>
                      <td><strong>Recorrido del Dia: </strong>{*recorrido*}<strong> - Fecha </strong></td>
                      <td style="text-align:center">&nbsp;</td>
                  </tr>
              </tbody>
          </table>
          ','etiqueta' => 'Encabezado Despacho'),
            array('idencabezado_formato' => '9','contenido' => '<table style="border-collapse: collapse; width: 100%;" border="0" align="center">
          <tbody>
          <tr>
          <td style="text-align: center; width: 100%;" valign="middle">______________________________________________________________________</td>
          </tr>
          <tr>
          <td style="text-align: center;">Calle 77 No. 25-33&nbsp;PBX (57) 1 777 2233 |&nbsp;<a href="http://www.cerok.com" target="_blank">www.suempresa.com</a>&nbsp;| Bogot&aacute;, Colombia</td>
          </tr>
          </tbody>
          </table>','etiqueta' => 'Pie de p&aacute;gina general'),
            array('idencabezado_formato' => '11','contenido' => '<table align="center" border="1" cellspacing="0" style="border-collapse:collapse; height:31px; width:705px">
              <tbody>
                  <tr>
                      <td style="border-color:#b6b8b7; text-align:center; vertical-align:middle; width:30%"><strong>{*nombre_empresa*}</strong>&nbsp;</td>
                      <td style="border-color:#b6b8b7; text-align:center; vertical-align:middle; width:40%"><strong>{*nombre_formato*}</strong></td>
                      <td style="border-color:#b6b8b7; text-align:center; vertical-align:middle; width:30%">{*logo_empresa*}</td>
                  </tr>
              </tbody>
          </table>
          ','etiqueta' => 'Encabezado Basico'),
            array('idencabezado_formato' => '12','contenido' => '<table align="center" border="0" cellspacing="0" style="border-collapse:collapse; width:100%">
              <tbody>
                  <tr>
                      <td style="border-color:#b6b8b7; text-align:left; vertical-align:middle; width:30%">
                      <p>{*logo_empresa*}</p>
          
                      <p><strong>{*nombre_empresa*}</strong>&nbsp;</p>
          
                      <p>Tel&eacute;fono: xxx</p>
                      </td>
                      <td style="border-color:#b6b8b7; text-align:center; vertical-align:middle; width:50%">&nbsp;</td>
                      <td style="border-color:#b6b8b7; text-align:center; vertical-align:middle; width:20%">
                      <p>&nbsp;</p>
          
                      <p style="margin-left:20px"><strong>{*nombre_formato*}</strong></p>
          
                      <p>&nbsp;</p>
                      </td>
                  </tr>
              </tbody>
          </table>
          ','etiqueta' => 'encabezado radicacion'),
            array('idencabezado_formato' => '13','contenido' => '<div class="row">
          <div class="col-md-12">
          <table border="0" cellpadding="1" cellspacing="1" style="width:100%">
              <tbody>
                  <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
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
                      <td style="width:50%">{*logo_empresa*}</td>
                      <td>&nbsp;</td>
                  </tr>
                  <tr>
                      <td style="width:50%">{*nombre_empresa*}</td>
                      <td>&nbsp;</td>
                  </tr>
              </tbody>
          </table>
          </div>
          </div>
          ','etiqueta' => 'Encabezado de Distribucion'),
            array('idencabezado_formato' => '14','contenido' => '<p style="text-align:right">P&aacute;gina&nbsp;{*mostrar_num_pagina*} de {*mostrar_total_paginas*}</p>
          
          <table align="center" border="1" cellspacing="0" style="width:100%">
              <tbody>
                  <tr>
                      <td style="text-align:center; vertical-align:middle; width:30%">
                      <p>{*logo_empresa*}<br />
                      {*nombre_empresa*}</p>
                      </td>
                      <td style="text-align:center; vertical-align:middle; width:50%">
                      <p>{*nombre_formato*}</p>
          
                      <p><strong>Fecha: </strong><br />
                      {*fecha_entrega*}</p>
                      </td>
                      <td style="text-align:center; vertical-align:middle; width:20%">
                      <p>&nbsp;</p>
          
                      <p>{*mostrar_codigo_qr*}</p>
          
                      <p>No.{*formato_numero*}</p>
          
                      <p>&nbsp;</p>
                      </td>
                  </tr>
              </tbody>
          </table>
          
          <p>&nbsp;</p>
          ','etiqueta' => 'Encabezado Entrega Interna'),
            array('idencabezado_formato' => '15','contenido' => '<table align="center" border="0" cellspacing="0" style="border-collapse:collapse; width:100%">
              <tbody>
                  <tr>
                      <td style="height:70px; vertical-align:middle">&nbsp;</td>
                      <td style="text-align:center; vertical-align:middle">&nbsp;</td>
                  </tr>
                  <tr>
                      <td style="vertical-align:middle">{*logo_empresa*}</td>
                      <td rowspan="1" style="text-align:center; vertical-align:middle">&nbsp;</td>
                  </tr>
                  <tr>
                      <td style="vertical-align:middle">{*nombre_empresa*}&nbsp;</td>
                      <td style="text-align:right; vertical-align:middle">&nbsp;</td>
                  </tr>
              </tbody>
          </table>
          
          <p>&nbsp;</p>
          ','etiqueta' => 'Encabezado Rutas de Distribucion')
          );

        for($i=0; $i < count($encabezado_formato); $i++){
            $this->connection->insert('encabezado_formato', $encabezado_formato[$i]);
        }  

        $this->connection->executeQuery('update formato set serie_idserie = 1');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }  
}
