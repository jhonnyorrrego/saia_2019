function htmlentities(txt){
pares = new Array();
pares[0] = new Array("<?php echo utf8_encode('á'); ?>", "&aacute;");
pares[1] = new Array("<?php echo utf8_encode('é'); ?>", "&eacute;");
pares[2] = new Array("<?php echo utf8_encode('í'); ?>", "*");
pares[3] = new Array("<?php echo utf8_encode('ó'); ?>", "&oacute;");
pares[4] = new Array("<?php echo utf8_encode('ú'); ?>", "&uacute;");
pares[5] = new Array("<?php echo utf8_encode('Á'); ?>", "&Aacute;");
pares[6] = new Array("<?php echo utf8_encode('É'); ?>", "&Eacute;");
pares[7] = new Array("<?php echo utf8_encode('Í'); ?>", "&Iacute;");
pares[8] = new Array("<?php echo utf8_encode('Ó'); ?>", "&Oacute;");
pares[9] = new Array("<?php echo utf8_encode('Ú'); ?>", "&Uacute;");
pares[10] = new Array("<?php echo utf8_encode('ñ'); ?>", "&ntilde;");
pares[11] = new Array("<?php echo utf8_encode('Ñ'); ?>", "&Ntilde;");
pares[12] = new Array("<?php echo utf8_encode('ù'); ?>", "&uuml;");
pares[13] = new Array("<?php echo utf8_encode('Ù'); ?>", "&Uuml;");
for (var i = 0; i < 14; i ++){
  txt = txt.replace(pares[i][0], pares[i][1]);
}
return txt;
}