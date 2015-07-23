<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ( $max_salida > 0 ) {
    if (is_file ( $ruta . "db.php" )) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida --;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
echo(estilo_bootstrap ());
echo(librerias_jquery("1.7"));
?>
<script type="text/javascript">
$(document).ready(function (){
  var hidWidth;
  var scrollBarWidths = 40;
  
  var widthOfList = function(){
    var itemsWidth = 0;
    $('.lista_tab_editor li').each(function(){
      var itemWidth = $(this).outerWidth();
      itemsWidth+=itemWidth;
    });
    return itemsWidth;
  };
  
  var widthOfHidden = function(){
    return (($('.div_editor').outerWidth())-widthOfList()-getLeftPosi())-scrollBarWidths;
  };
  
  var getLeftPosi = function(){
    return $('.lista_tab_editor').position().left;
  };
  
  var reAdjust = function(){
    if (($('.div_editor').outerWidth()) < widthOfList()) {
      $('.scroller-right').show();
    }
    else {
      $('.scroller-right').hide();
    }
    
    if (getLeftPosi()<0) {
      $('.scroller-left').show();
    }
    else {
      $('.item').animate({left:"-="+getLeftPosi()+"px"},'slow');
      $('.scroller-left').hide();
    }
  }
  reAdjust();
  
  $(window).on('resize',function(e){  
      reAdjust();
  });
  
  $('.scroller-right').click(function() {
    
    $('.scroller-left').fadeIn('slow');
    $('.scroller-right').fadeOut('slow');
    
    $('.lista_tab_editor').animate({left:"+="+widthOfHidden()+"px"},'slow',function(){
  
    });
  });
  
  $('.scroller-left').click(function() {
    $('.scroller-right').fadeIn('slow');
    $('.scroller-left').fadeOut('slow');
    
      $('.lista_tab_editor').animate({left:"-="+getLeftPosi()+"px"},'slow',function(){
      
      });
  }); 
  $("#adicionar_tab").click(function(){
    var numero=$(".tab_editor:last").attr("numero");
    $(".lista_tab_editor").append('<li class="tab_editor" numero="'+numero+'"><a href="#">Tab'+(numero)+'</a></li>');
    $(".tab-content").append('<div class="tab-pane" id="div_tab'+numero+'" >...</div>');
    reAdjust();
  });  
  $(".tab_editor").live("click",function(){
    var numero=$(this).attr("numero");
    $(".tab_editor").removeClass("active");
    $(".tab-pane").removeClass("active");
    $(this).addClass("active");
    $("#div_tab"+numero).addClass("active");
    llamado_pantalla("<?php echo($ruta_db_superior);?>editor_codigo/editor.php","",$("#div_tab"+numero),"editor_"+numero);
  });
});
function llamado_pantalla(ruta,datos,destino,nombre){                
  if(datos!==''){
    ruta+="?"+datos;
  }
  if(nombre === "<?php echo(@$_REQUEST['destino_click']);?>"){      
      ruta = ruta+'&click_clase=<?php echo(@$_REQUEST['click_clase']); ?>';      
      destino.html('<div id="panel_'+nombre+'"><iframe name="'+nombre+'" src="'+ruta+'" width="100%" id="'+nombre+'" frameborder="0"></iframe></div>'); 
  }
  
      destino.html('<div id="panel_'+nombre+'"><iframe name="'+nombre+'" src="'+ruta+'" width="100%" id="'+nombre+'" frameborder="0"></iframe></div>'); 
}
</script>

<div class="btn btn-mini btn-primary" id="adicionar_tab">Adicionar tab</div>
<div class="row-flow">
  <div class="scroller scroller-left"><i class="icon-chevron-left"></i></div>
  <div class="scroller scroller-right"><i class="icon-chevron-right"></i></div>
  <div class="div_editor" id="contendor_editor">
    <ul class="nav nav-tabs lista_tab_editor" id="myTab">
      <li class="active tab_editor" numero="1"><a href="#div_tab1">Tab1</a></li>
      <li class="tab_editor" numero="2"><a href="#div_tab2">Tab2</a></li>
      <li class="tab_editor" numero="3"><a href="#div_tab3">Tab3</a></li>
      <li class="tab_editor" numero="4"><a href="#div_tab4">Tab4</a></li>
      <li class="tab_editor" numero="5"><a href="#div_tab5">Tab4</a></li>
      <li class="tab_editor" numero="6"><a href="#div_tab6">Tab5</a></li>
      <li class="tab_editor" numero="7"><a href="#div_tab7">Tab6</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="div_tab1">...</div>
      <div class="tab-pane" id="div_tab2">...</div>
      <div class="tab-pane" id="div_tab3">...</div>
      <div class="tab-pane" id="div_tab4">...</div>
      <div class="tab-pane" id="div_tab5">...</div>
      <div class="tab-pane" id="div_tab6">...</div>
      <div class="tab-pane" id="div_tab7">...</div>
    </div>
  </div>
</div>