<!--
//editor de texto para mostrar en los formatos
-->
<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
?>
<script language="javascript" type="text/javascript" src="<?php echo $ruta_db_superior; ?>tinymce34/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
<!--
	// Notice: The simple theme does not use all options some of them are limited to the advanced theme
tinyMCE.init({
mode : "textareas",
theme : "advanced",
language : "es",
editor_selector: "tiny_avanzado",
plugins : "advimage,spellchecker,table,advhr,advimage,advlink,insertdatetime,searchreplace,contextmenu,paste,directionality,noneditable,xhtmlxtras,plantillas_saia,style,pagebreak,jbimages,tablegrid",
theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,forecolor,backcolor,plantillas_saia,|,code",
theme_advanced_buttons2 : "cut,copy,paste,pastetext,|,search,replace,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,sub,sup",
theme_advanced_buttons3 : "jbimages,spellchecker,tablegrid,|,removeformat,visualaid,|,charmap,|,pagebreak",
spellchecker_languages : "+Espa=es,Ingles=en",
theme_advanced_toolbar_location : "top",
theme_advanced_toolbar_align : "left",
theme_advanced_statusbar_location : "bottom",
theme_advanced_resizing : true,
tab_focus : ':prev,:next',
external_image_list_url : "librerias/image_list.js",
content_css : "librerias/estilo.css",
height:"300px",
width:"350px",
theme_advanced_path : false
});  
tinyMCE.init({
mode : "textareas",
theme : "advanced",
language : "es",
editor_selector: "tiny_formatos",
plugins : "formatos,spellchecker,pagebreak,style,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,image,cleanup,code,|,forecolor,backcolor",
theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,|,iespell,spellchecker,|,fullscreen",
spellchecker_languages : "+Espa=es,Ingles=en",
theme_advanced_buttons4 : "visualchars,pagebreak,|,insertimage,formatos",
theme_advanced_toolbar_location : "top",
theme_advanced_toolbar_align : "left",
theme_advanced_statusbar_location : "bottom",
theme_advanced_resizing : true,tab_focus : ':prev,:next',
external_image_list_url : "librerias/image_list.js",
content_css : "librerias/estilo.css",
height:"300px",
width:"350px",
theme_advanced_path : false
});
tinyMCE.init({
mode : "textareas",
theme : "advanced",
language : "es",
editor_selector: "tiny_basico",
plugins : "paste,spellchecker",
theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,forecolor,backcolor,plantillas_saia,|,image,code",
theme_advanced_buttons2 : "cut,copy,paste,pastetext,|,bullist,numlist",
theme_advanced_buttons3 : "",
theme_advanced_toolbar_location : "top",
theme_advanced_toolbar_align : "left",
theme_advanced_statusbar_location : "bottom",
theme_advanced_resizing : true,
tab_focus : ':prev,:next',
spellchecker_languages : "+Espa=es,Ingles=en",
external_image_list_url : "librerias/image_list.js",
content_css : "librerias/estilo.css",
height:"200px",
width:"350px",
theme_advanced_path : false
});

tinyMCE.init({
mode : "textareas",
theme : "advanced",
language : "es",
editor_selector : "tiny_noeditor",
theme_advanced_buttons1 : "",
theme_advanced_buttons2 : "",
theme_advanced_buttons3 : "",
theme_advanced_statusbar_location : "bottom",
theme_advanced_resizing : true,
tab_focus : ':prev,:next',
height:"200px",
width:"350px",
theme_advanced_path : false
});
tinyMCE.init({
mode : "textareas",
theme : "advanced",
language : "es",
editor_selector : "tiny_buscador",
theme_advanced_buttons1 : "",
theme_advanced_buttons2 : "",
theme_advanced_buttons3 : "",
theme_advanced_statusbar_location : "bottom",
theme_advanced_resizing : true,
tab_focus : ':prev,:next',
height:"200px",
width:"350px",
theme_advanced_path : false
});
tinyMCE.init({
mode : "textareas",
theme : "advanced",
language : "es",
editor_selector : "tiny_",
theme_advanced_buttons1 : "",
theme_advanced_buttons2 : "",
theme_advanced_buttons3 : "",
theme_advanced_statusbar_location : "bottom",
theme_advanced_resizing : true,
tab_focus : ':prev,:next',
height:"200px",
width:"350px",
theme_advanced_path : false
});
function htmlentities(txt)
{
pares = new Array();
pares[0] = new Array("<?php echo utf8_encode('á'); ?>", "&aacute;");
pares[1] = new Array("<?php echo utf8_encode('é'); ?>", "&eacute;");
pares[2] = new Array("<?php echo utf8_encode('í'); ?>", "&iacute;");
pares[3] = new Array("<?php echo utf8_encode('ó'); ?>", "&oacute;");
pares[4] = new Array("<?php echo utf8_encode('ú'); ?>", "&uacute;");
pares[5] = new Array("<?php echo utf8_encode('Á'); ?>", "&Aacute;");
pares[6] = new Array("<?php echo utf8_encode('É'); ?>", "&Eacute;");
pares[7] = new Array("<?php echo utf8_encode('Í'); ?>", "&Iacute;");
pares[8] = new Array("<?php echo utf8_encode('Ó'); ?>", "&Oacute;");
pares[9] = new Array("<?php echo utf8_encode('Ú'); ?>", "&Uacute;");
pares[10] = new Array("<?php echo utf8_encode('ñ'); ?>", "&ntilde;");
pares[11] = new Array("<?php echo utf8_encode('Ñ'); ?>", "&Ntilde;");
pares[12] = new Array("<?php echo utf8_encode('Ü'); ?>", "&uuml;");
pares[13] = new Array("<?php echo utf8_encode('ü'); ?>", "&Uuml;");
pares[14] = new Array(/ñ/g, "&ntilde;");

for (var i = 0; i < 15; i ++)
 {
  txt = txt.replace(pares[i][0], pares[i][1]);
 }
 return txt;
}
document.body.onmousedown = function(event) {
  if (event.which == null){
    if(event.button == 4){
      return false;
    }
  }
  else {
    if(event.which == 2){
      return false;
    }
  }     
}
-->
</script>
<style>
label.error{color:red}
</style>
