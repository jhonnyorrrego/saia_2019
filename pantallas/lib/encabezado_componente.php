<?php
function cantidad_pendientes($idcomponente){
  $texto='<span id="resumen_componente_'.$idcomponente.'" class="resumen_componente" llave="'.$idcomponente.'">-</span>';
  return($texto);
}
?>
<script type="text/javascript">
$("document").ready(function(){
  $.each($(".resumen_componente"),function(){
    var llave=$(this).attr("llave");
    var $resumen=$(this);
    $.ajax({
      type:'POST',
      url: "busquedas/servidor_busqueda.php",
      data: "idbusqueda_componente="+llave+"&page=0&rows=1&actual_row=0",
      success: function(html){
        if(html){          
          var objeto=jQuery.parseJSON(html);          
          $resumen.html("("+objeto.records+")");                                                               
        }
        else{ 
          $resumen.html();          
        }
      }
    });
  });
});
</script>