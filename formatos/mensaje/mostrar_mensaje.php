<?php include_once("../memorando/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table border="1" cellspacing="0" width="100%" >
<tbody>
<tr>
<td  class="encabezado" style="border: windowtext 0.5pt solid;" valign="top" scope="col"><strong>Asunto:</strong></td>
<td  style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('asunto',41,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; "><strong>Remitente:</strong></td>
<td  style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('remitente_mensaje',41,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; " valign="top"><strong>Destinatario:</strong></td>
<td  style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('destinatario',41,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; " valign="top"><strong>Copia:</strong></td>
<td  style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('copia',41,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; "><strong>Fecha:</strong></td>
<td  style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('fecha_mensaje',41,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  style=" border: windowtext 0.5pt solid; border: #ffffff 0.5pt solid;" colspan="2"><br /><?php mostrar_valor_campo('contenido',41,$_REQUEST['iddoc']);?></td>
</tr>
<tr><td colspan="2"><?php mostrar_anexos_memo(41,$_REQUEST['iddoc']);?></td></tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer.php"); ?>