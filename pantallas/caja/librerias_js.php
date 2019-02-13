<script>
$(document).ready(function(){
  
  // Informacion de la caja

  $(document).on("click",".infoCaja",function(){
    let idcaja=$(this).data("id");
    let idcomp=$(this).data("componente");
    $("[id^='resultado_pantalla_']").removeClass("alert-warning");
    $('#resultado_pantalla_'+idcaja).addClass("alert-warning");
    $("#iframe_detalle").attr({
      'src':'<?=$ruta_db_superior?>pantallas/caja/detalles_caja.php?idcaja='+idcaja+'&idbusqueda_componente='+idcomp
    });  
  });

  // Editar la Caja

  $(document).on("click",".editCaja",function(){
    let idcaja=$(this).data("id");
    let idcomp=$(this).data("componente");
    $("#iframe_detalle").attr({
      'src':'<?= $ruta_db_superior ?>pantallas/caja/editar_caja.php?idcaja='+idcaja+'&idbusqueda_componente='+idcomp
    });  
  });

  // Eliminar la Caja

  $(document).on("click",".delCaja",function(){
    let idcaja=$(this).data("id");
    let idcomp=$(this).data("componente");
    $("#iframe_detalle").attr({
      'src':'<?= $ruta_db_superior ?>pantallas/caja/eliminar_caja.php?idcaja='+idcaja+'&idbusqueda_componente='+idcomp
    });  
  });

  // vincular a serie

  $(document).on("click",".vinCaja",function(){
    let idcaja=$(this).data("id");
    let idcomp=$(this).data("componente");
    $("#iframe_detalle").attr({
      'src':'<?= $ruta_db_superior ?>pantallas/caja/asignar_entidadserie.php?idcaja='+idcaja+'&idbusqueda_componente='+idcomp
    });  
  });
  
});
</script>
