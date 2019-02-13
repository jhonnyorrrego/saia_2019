<script>
  //Eliminar la caja
 $(document).on("click",".delCaja",function(){
    let idcaja=$(this).data("id");
    if(confirm("Esta seguro de eliminar la caja?")){
      $.ajax({
        type : 'POST',
        async:false,
        url: "<?= $ruta_db_superior ?>pantallas/ejecutar_acciones.php",
        data: {nameInstance:'CajaController',methodInstance:'deleteCajaCont',idcaja:idcaja},
        dataType: 'json',
        success: function(response){
          if(response.exito){
            $("#resultado_pantalla_"+idcaja).remove();
            top.notification({
              message : "Caja eliminada",
              type : "success",
              duration : 3000
            });
          }else{
            top.notification({
              message : response.message,
              type : "error",
              duration : 3000
            });
          }
        },
        error : function() {
          top.notification({
            message : "Error al procesar la solicitud",
            type : "error",
            duration : 3000
          });
        }
      });
    }
  });
</script>