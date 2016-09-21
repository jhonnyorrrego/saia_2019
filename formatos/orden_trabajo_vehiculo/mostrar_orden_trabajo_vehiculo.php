<?php include_once("funciones.php"); ?><?php include_once("../confir_negoci_vehiculo/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; ; width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 25%; text-align: center;">&nbsp;<?php mostrar_logo_empresa(262,$_REQUEST['iddoc']);?></td>
<td style="font-weight: bold; text-align: center; width: 50%; font-size: 8pt;">ORDEN DE TRABAJO</td>
<td style="font-weight: bold; text-align: center; font-size: 8pt;">Versi&oacute;n 5<br />FTO - 05<br />-</td>
</tr>
</tbody>
</table>
<table style="border-collapse: collapse; font-size: 8pt; width: 100%;" border="0">
<tbody>
<tr>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
<table style="border-collapse: collapse; font-size: 8pt; width: 100%;" border="1">
<tbody>
<tr>
<td><?php mostrar_info_orden_trabajo(262,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>
<table style="border-collapse: collapse; font-size: 8pt; width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 60%;"><?php mostrar_info_orden_vehiculo(262,$_REQUEST['iddoc']);?></td>
<td style="text-align: center;"><?php guia_imagen(262,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table style="border-collapse: collapse; font-size: 8pt; width: 100%;" border="1">
<tbody>
<tr>
<td style="text-align: center; font-weight: bold;">MOTIVO DEL SERVICIO</td>
</tr>
<tr>
<td><?php mostrar_valor_campo('motivo_servicio',262,$_REQUEST['iddoc']);?><br /><?php descripcion_problema(262,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: center; font-weight: bold;">INVENTARIO</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="text-align: justify; font-size: 7pt;">INFORMACI&Oacute;N ADICIONAL:<br /><br />&ldquo;La alineaci&oacute;n de direcci&oacute;n y balanceo de llantas debe ser realizado por el propietario del veh&iacute;culo cada diez ml kilometros siguiendo las recomendaciones del fabricante.<br />Estimado cliente usted tiene derecho a presentarnos Peticiones, Quejas o Reclamos por el presunto incumplimiento de los t&eacute;rminos y condiciones de la Garant&iacute;a de los productos o servicios adquiridos. En este establecimiento hemos implementado un mecanismo de atenci&oacute;n y tr&aacute;mite de PQR&rsquo;s. Acuda al responsable local de PQR&acute;s quien le ayudar&aacute; en la recepci&oacute;n y tr&aacute;mite de la PQR, que responderemos en un t&eacute;rmino de 7 d&iacute;as calendario (no hay que presentarla personalmente o a trav&eacute;s de abogado). Las normas de protecci&oacute;n al consumidor relacionadas con los derechos que le asisten se encuentran en los art&iacute;culos 11,12,13 y 29 del Decreto 3466 de 1982 y en el Titulo Circular &Uacute;nica de la SIC. Le informamos que nuestra L&iacute;nea de atenci&oacute;n al cliente es: (6)7676767 Ext. 19 o Cel.: 3160060666&rdquo;</td>
</tr>
</tbody>
</table>
<table style="border-collapse: collapse; font-size: 8pt; width: 100%;" border="1">
<tbody>
<tr>
<td style="text-align: center; font-weight: bold;">PLANEACI&Oacute;N DE OT</td>
</tr>
<tr>
<td><?php mostrar_orden_ot(262,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: justify; font-size: 7pt;">CONDICIONES: 1. Los materiales y piezas son suministrados por la empresa salvo estipulaci&oacute;n de lo contrario 2. Los riesgos y peligros del veh&iacute;culo entregado para reparaci&oacute;n a la empresa pertenecen exclusiva y totalmente al due&ntilde;o del veh&iacute;culo durante todo el tiempo que este permanezca en los talleres de la empresa desde el momento de la entrega del veh&iacute;culo para su reparaci&oacute;n y no desde la aprobaci&oacute;n que imparta a dicha reparaci&oacute;n , pues para el efecto renuncia expresamente al beneficio que se trata en el inciso segundo del art&iacute;culo 2053 del c&oacute;digo civil <br />en concordancia con los art&iacute;culos 1064, inciso cuarto y 2057 &iacute;dem. 3. SU ORGANIZACION queda autorizada para hacer las pruebas necesarias al veh&iacute;culo fuera del taller. 4.la empresa no responde en ning&uacute;n caso por objetos que no sean reportados durante la recepci&oacute;n del veh&iacute;culo. 5. En caso de fuerza mayor o en caso fortuito, la empresa no responde por p&eacute;rdida o deterioro de los veh&iacute;culos o de los objetos dejados a su cuidado. 6. La empresa queda facultada para ejercer el derecho de retenci&oacute;n del veh&iacute;culo mientras est&eacute; pendiente la cancelaci&oacute;n de la factura. 7. De conformidad con el inciso 2do del par&aacute;grafo del art&iacute;culo 18 de la ley 1480 del 2011; SU ORGANIZACION&nbsp;se reserva la facultad de cobrar al cliente a t&iacute;tulo de bodegaje la suma de un salario minino diario legal vigente SMDLV por cada d&iacute;a en que el veh&iacute;culo objet&oacute; de la presente O.T permanezca en las instalaciones de SU ORGANIZACION S.A sin ser reclamado. El bodegaje que se genere ser&aacute; contado desde la fecha de facturaci&oacute;n de los servicios prestados y hasta cuando se haga entrega material y efectiva a la persona que corresponda de veh&iacute;culo objet&oacute; de la presente O.T. 8. Es entendido que quien contrata y ordena el trabajo descrito es el propietario del veh&iacute;culo o en su defecto ser&aacute; autorizado por el due&ntilde;o del mismo quien conoce y acepta &iacute;ntegramente estas condiciones que son parte &iacute;ntegramente del contrato que se celebra y que consta en este documento. 9. En repuestos el&eacute;ctricos y de inyecci&oacute;n no hay garant&iacute;a.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><?php mostrar_info_firmas(262,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="font-weight: bold;">LLAMADAS REQUERIDAS</td>
</tr>
<tr>
<td><?php mostrar_valor_campo('llamadas_requeridas',262,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: justify; font-size: 7pt;">Estimado cliente, conserve este desprendible, es la c&eacute;dula de su veh&iacute;culo y ser&aacute; reclamada para entregar el mismo. Si env&iacute;a a otra persona a recogerlo, favor enviar su c&eacute;dula y firma autorizada.<br /><br /><?php mostrar_autorizacion_orden(262,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>