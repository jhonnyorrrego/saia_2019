<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
?>
<link href="<?php echo($ruta_db_superior);?>css/jquery.bubblepopup.css" rel="stylesheet" type="text/css" />
<script src="<?php echo($ruta_db_superior);?>js/jquery-1.4.2.js" type="text/javascript"></script>
<script src="<?php echo($ruta_db_superior);?>js/jquery.bubblepopup.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
$(document).ready(function(){
  $('.tooltip_saia').CreateBubblePopup({
    position: 'right',
    align: 'center',
    width: 250,
    innerHtml: '<img src="<?php echo($ruta_db_superior); ?>images/loading.gif" style="border:0px; vertical-align:middle; margin-right:10px; display:inline;" />Cargando!',
    innerHtmlStyle: { color:'#000000', 'text-align':'center' },
    themeName: 'azure',
    themePath: '<?php echo($ruta_db_superior); ?>images/jquerybubblepopup'
  });
  $('.tooltip_saia').mouseover(function(){
    var button = $(this) ;
    button.SetBubblePopupInnerHtml( button.attr("alt"), true); 
  }); 
});
//-->
</script>