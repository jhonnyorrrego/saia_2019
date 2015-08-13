<html>
  <title>.:EDITAR CARTA:.
  </title>
  <head>
    <?php include_once("../librerias/funciones_generales.php"); ?>
    <?php include_once("../librerias/estilo_formulario.php"); ?>
<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
    <?php include_once("funciones.php"); ?>
<script type="text/javascript" src="../../js/title2note.js"></script>
<script type="text/javascript" src="../../js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="../../js/dhtmlXTree.js"></script>
    <style type="text/css" media="screen" src="../../css/dhtmlXTree.css">
    </style>
    <?php include_once("../librerias/header_formato.php"); ?>
  </head>
  <body bgcolor="#F5F5F5">
    <form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data">
      <table width="100%" cellspacing="1" cellpadding="4">
        <tr>
          <td colspan="2" class="encabezado_list">CARTA</td>
        </tr>
        <input type="hidden" name="idft_carta" value="<?php echo(mostrar_valor_campo('idft_carta',4,$_REQUEST['iddoc'])); ?>">
        <input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',4,$_REQUEST['iddoc'])); ?>">
        <input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',4,$_REQUEST['iddoc'])); ?>">
        <tr>                     
          <td class="encabezado" width="20%" title="">TIPO DE DOCUMENTO*</td>                     
          <?php arbol_serie_nuevo(4,70,$_REQUEST['iddoc']);?>
        </tr>
        <tr>                     
          <td class="encabezado" width="20%" title="Fecha en la que fue Creada la Carta.">FECHA DE CREACION*</td>                     
          <?php fecha_formato(4,57,$_REQUEST['iddoc']);?>
        </tr>
        <tr>                     
          <td class="encabezado" width="20%" title="">DESTINOS*</td>                     
          <td bgcolor="#F5F5F5">                                         
            <input type="hidden" maxlenght="2000"  class="required"  name="destinos" obligatorio="obligatorio" value="<?php echo(mostrar_valor_campo('destinos',4,$_REQUEST['iddoc'])); ?>">
            <?php componente_ejecutor("72",$_REQUEST["iddoc"]); ?></td>
        </tr>
        <tr>                     
          <td class="encabezado" width="20%" title="">ASUNTO*</td>                     
          <td bgcolor="#F5F5F5">
            <input    type="text" size="100" id="asunto" name="asunto" obligatorio="obligatorio" value="<?php echo(mostrar_valor_campo('asunto',4,$_REQUEST['iddoc'])); ?>"></td>                    
        </tr>
        <tr>                     
          <td class="encabezado" width="20%" title="">CONTENIDO*</td>                     
          <td bgcolor="#F5F5F5">
<textarea name="contenido" obligatorio="obligatorio" cols="53" rows="3"><?php echo(mostrar_valor_campo('contenido',4,$_REQUEST['iddoc'])); ?></textarea></td>                    
        </tr>
        <tr>                     
          <td class="encabezado" width="20%" title="Despedida de la Carta, Atentamente, Cordialmente, ...">DESPEDIDA</td>                     
          <?php despedida(4,61,$_REQUEST['iddoc']);?>
        </tr>
        <tr>                     
          <td class="encabezado" width="20%" title="Personas a quienes se les Envia Copia de la Carta">CON COPIA A</td>                     
          <td bgcolor="#F5F5F5">                   
            <input type="hidden" maxlenght="3000"  name="copia" value="<?php echo(mostrar_valor_campo('copia',4,$_REQUEST['iddoc'])); ?>">
            <?php componente_ejecutor("60",$_REQUEST["iddoc"]); ?></td>
        </tr>
        <tr>                     
          <td class="encabezado" width="20%" title="">CON COPIA INTERNA A</td>                     
          <?php arbol_copia_interna(4,74,$_REQUEST['iddoc']);?>                     
        </tr>
        <tr>                     
          <td class="encabezado" width="20%" title="Persona que Genera la Carta ">PREPARÓ*</td>                     
          <?php iniciales(4,59,$_REQUEST['iddoc']);?>
        </tr>
        <tr>                     
          <td class="encabezado" width="20%" title="Listado con Los Anexos de la Carta">ANEXOS</td>                     
          <?php anexos_fisicos(4,58,$_REQUEST['iddoc']);?>
        </tr>
        <input type="hidden" name="campo_descripcion" value="<?php echo('73'); ?>">
        <input type="hidden" name="formato" value="4">
        <tr>
          <td colspan='2'>
            <?php submit_formato(4,$_REQUEST['iddoc']);?></td>
        </tr>
      </table>
    </form>
  </body>
</html>
<?php include_once("../librerias/footer_plantilla.php");?>
