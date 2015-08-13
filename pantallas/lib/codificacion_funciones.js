function htmlentities(txt)
{
pares = new Array();
pares[0] = new Array("<?php echo utf8_encode('�'); ?>", "&aacute;");
pares[1] = new Array("<?php echo utf8_encode('�'); ?>", "&eacute;");
pares[2] = new Array("<?php echo utf8_encode('�'); ?>", "&iacute;");
pares[3] = new Array("<?php echo utf8_encode('�'); ?>", "&oacute;");
pares[4] = new Array("<?php echo utf8_encode('�'); ?>", "&uacute;");
pares[5] = new Array("<?php echo utf8_encode('�'); ?>", "&Aacute;");
pares[6] = new Array("<?php echo utf8_encode('�'); ?>", "&Eacute;");
pares[7] = new Array("<?php echo utf8_encode('�'); ?>", "&Iacute;");
pares[8] = new Array("<?php echo utf8_encode('�'); ?>", "&Oacute;");
pares[9] = new Array("<?php echo utf8_encode('�'); ?>", "&Uacute;");
pares[10] = new Array("<?php echo utf8_encode('�'); ?>", "&ntilde;");
pares[11] = new Array("<?php echo utf8_encode('�'); ?>", "&Ntilde;");
pares[12] = new Array("<?php echo utf8_encode('�'); ?>", "&uuml;");
pares[13] = new Array("<?php echo utf8_encode('�'); ?>", "&Uuml;");
pares[14] = new Array(/ñ/g, "&ntilde;");

for (var i = 0; i < 15; i ++)
 {
  txt = txt.replace(pares[i][0], pares[i][1]);
 }
 return txt;
}