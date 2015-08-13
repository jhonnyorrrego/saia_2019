<?php include_once("../memorando/../carta/funciones.php"); ?>
<?php include_once("funciones.php"); ?>
<?php include_once("../memorando/funciones.php"); ?>
<?php include_once("../librerias/funciones_generales.php"); ?>
<?php include_once("../librerias/header.php"); ?>
<?php include_once("../../class_transferencia.php"); ?>
<tr><td>
    <p>Asunto: 
      <?php mostrar_valor_campo('asunto',4,$_REQUEST['iddoc']);?>
    </p>
    <p>Contenido: 
      <?php mostrar_valor_campo('contenido',4,$_REQUEST['iddoc']);?>
    </p></td>
</tr>
<?php include_once("../librerias/footer.php"); ?>