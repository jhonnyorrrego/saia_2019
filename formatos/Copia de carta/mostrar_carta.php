<?php include_once("../memo/funciones.php"); ?>
<?php include_once("../librerias/funciones_generales.php"); ?>
<?php include_once("funciones.php"); ?>
<?php include_once("../librerias/header.php"); ?>
<?php include_once("../../class_transferencia.php"); ?>
<tr>
  <td>
    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tbody>
        <tr>
          <td colspan="2" valign="top">
            <?php ciudad(4,$_REQUEST['iddoc']);?>, 
            <?php mostrar_fecha(4,$_REQUEST['iddoc']);?><br /><br /><br /><br /></td>
        </tr>
      </tbody>
    </table>
    <table border="0" width="100%">
      <tbody>
        <tr>
          <td>
            <?php mostrar_destinos(4,$_REQUEST['iddoc']);?>
            &nbsp;<br /><br /><br /></td>
        </tr>
        <tr>
          <td>
            Asunto:
            <?php mostrar_valor_campo('asunto',4,$_REQUEST['iddoc']);?><br /><br /></td>
        </tr>
      </tbody>
    </table>
    <p>
      <?php mostrar_valor_campo('contenido',4,$_REQUEST['iddoc']);?>
    </p>
    <table border="0" width="100%">
      <tbody>
        <tr>
          <td><br />
            <?php mostrar_valor_campo('despedida',4,$_REQUEST['iddoc']);?></td>
        </tr>
        <tr>
          <td>
            <?php mostrar_estado_proceso(4,$_REQUEST['iddoc'],'mostrar_'.$_REQUEST['plantilla'],$_REQUEST['iddoc']);?></td>
        </tr>
        <tr>
          <td><br /></td>
        </tr>
        <tr>
          <td>
            <?php mostrar_anexos_memo(4,$_REQUEST['iddoc']);?></td>
        </tr>
        <tr>
          <td>
            <?php mostrar_copias_carta(4,$_REQUEST['iddoc']);?></td>
        </tr>
        <tr>
          <td>
            <?php mostrar_preparo(4,$_REQUEST['iddoc']);?></td>
        </tr>
      </tbody>
    </table></td>
</tr>
<?php include_once("../librerias/footer.php"); ?>
