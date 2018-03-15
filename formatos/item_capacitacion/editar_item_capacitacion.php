<html>
			<title>.:EDITAR ITEM CAPACITACION:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?>
			<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
			<?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../librerias/funciones_acciones.php"); ?>
			<?php include_once("../librerias/estilo_formulario.php"); ?>
			<script type="text/javascript" src="../../js/jquery.js"></script>
			<script type="text/javascript" src="../../js/jquery.validate.js"></script>
			<script type="text/javascript" src="../../js/title2note.js"></script>
			<style>label.error{color:red}</style>
				<script type='text/javascript'>
			  $(document).ready(function(){
			  		$('#formulario_formatos').validate();
				});
				</script> 
			</head>
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_item.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr id="tr_etiqueta2">
                     <td class="encabezado" width="20%" title="" colspan="2" id="etiqueta2"><center>En qu&eacute; le gustar&iacute;a recibir capacitaci&oacute;n?</center></td>
                    </tr><tr id="tr_conocimiento_tecnico">
                     <td class="encabezado" width="20%" title="">CONOCIMIENTOS T&Eacute;CNICOS EN*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="conocimiento_tecnico" name="conocimiento_tecnico"  value="<?php echo(mostrar_valor_campo('conocimiento_tecnico',445,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_etiqueta1">
                     <td class="encabezado" width="20%" title="" colspan="2" id="etiqueta1"><center>En qu&eacute; le gustar&iacute;a recibir capacitaci&oacute;n?</center></td>
                    </tr><tr id="tr_conocimiento_personal">
                     <td class="encabezado" width="20%" title="">CRECIMIENTO PERSONAL EN*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="conocimiento_personal" name="conocimiento_personal"  value="<?php echo(mostrar_valor_campo('conocimiento_personal',445,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><input type="hidden" name="idft_item_capacitacion" value="<?php echo(mostrar_valor_campo('idft_item_capacitacion',445,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="formato" value="445"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="item_capacitacion"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr>
			<td colspan='2'><?php submit_formato(445,$_REQUEST['iddoc']);?></td>
		</tr>
		</table></form>
		</body>
		</html><?php include_once("../librerias/footer_plantilla.php");?>