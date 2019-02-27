<script>
$(document).ready(function(){
  var baseUrl = $("script[data-baseurl]").data('baseurl');

    // Informacion de la caja
    $(document).on("click", ".infoCaja", function () {
      let idcaja=$(this).data("id");

      let options = {
        url: `${baseUrl}views/caja/informacion.php`,
        params: {
          idcaja:idcaja
        }, 
        size: "modal-lg",
        title: "",
        centerAlign: false,
        buttons: {}
      };
      top.topModal(options);
    
    });

  // Eliminar la Caja

  $(document).on("click",".delCaja",function(){
    let idcaja=$(this).data("id");
    let idcomp=$(this).data("componente");
    colorWell(idcaja);
    $("#iframe_detalle").attr({
      'src':'<?= $ruta_db_superior ?>pantallas/caja/eliminar_caja.php?idcaja='+idcaja+'&idbusqueda_componente='+idcomp
    });  
  });
  
});
</script>
