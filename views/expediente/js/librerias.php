<script>
$(document).ready(function(){
  var baseUrl = $("script[data-baseurl]").data('baseurl');

  var getPanelId= function(){
    let documentFrame = parent.$("#iframe_workspace").contents();
    let indexPanelId = parent.$(".k-focus").attr("id").replace("kp", "");
    return indexPanelId-1;
  }

    // Informacion del expediente
  $(document).on("click", ".infoExp", function () {
    let idexp=$(this).data("id");

    let options = {
      url: `${baseUrl}views/expediente/informacion.php`,
      params: {
        idexpediente:idexp
      }, 
      size: "modal-lg",
      title: "",
      centerAlign: false,
      buttons: {}
    };
    top.topModal(options);
  
  });

// Creacion de tomo del expediente

  $(document).on("click",".tomoExp",function(){
    let idexp=$(this).data("id");
    
    top.confirm({
      drag: false,
      overlay: true,
      close: false,
      type: 'warning',
      message: 'Está seguro de crear el tomo?',
      position: 'center',
      timeout: 0,
      buttons: [
        [
          '<button><b>SI</b></button>',
          function (instance, toast) {
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            $.ajax({
              type : 'POST',
              url: `${baseUrl}app/expediente/ejecutar_acciones.php`,
              data: {
                nameInstance:'ExpedienteController',
                methodInstance:'createTomoExpedienteCont',
                idexpediente:idexp
              },
              dataType: 'json',
              success: function(response){
                if(response.exito){
                  top.notification({
                    message : "Tomo creado",
                    type : "success",
                    duration : 3000
                  });
                  window.location.reload();
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
          },
          true
        ],
        [
          '<button>NO</button>',
          function (instance, toast) {
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
          }
        ],
      ]
    });
    
  });

 //Eliminar el expediente
  $(document).on("click",".delExp",function(){
    var idexp=$(this).data("id");
    
    top.confirm({
      drag: false,
      overlay: true,
      close: false,
      type: 'error',
      message: 'Está seguro de eliminar el expediente?',
      position: 'center',
      timeout: 0,
      buttons: [
        [
          '<button><b>SI</b></button>',
          function (instance, toast) {
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            $.ajax({
              type : 'POST',
              url: `${baseUrl}app/expediente/ejecutar_acciones.php`,
              data: {
                nameInstance:'ExpedienteController',
                methodInstance:'deleteExpedienteCont',
                idexpediente:idexp
              },
              dataType: 'json',
              success: function(response){
                if(response.exito){
                  $("#table").bootstrapTable('remove', {field: 'id',values: [idexp]});
                  top.notification({
                    message : "Expediente eliminado",
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

          },
          true
        ],
        [
          '<button>NO</button>',
          function (instance, toast) {
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
          }
        ],
      ]
    });
  });


  //Crar acceso directo al expediente
 $(document).on("click",".directExp",function(){
    let idexp=$(this).data("id");

    top.confirm({
      drag: false,
      overlay: true,
      close: false,
      type: 'warning',
      message: 'Está seguro de crear el acceso directo?',
      position: 'center',
      timeout: 0,
      buttons: [
        [
          '<button><b>SI</b></button>',
          function (instance, toast) {
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
              $.ajax({
                type : 'POST',
                url: `${baseUrl}app/expediente/ejecutar_acciones.php`,
                data: {
                  nameInstance:'ExpedienteController',
                  methodInstance:'directExpedienteCont',
                  idexpediente:idexp
                },
                dataType: 'json',
                success: function(response){
                  if(response.exito){
                    top.notification({
                      message : response.message,
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
          },
          true
        ],
        [
          '<button>NO</button>',
          function (instance, toast) {
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
          }
        ],
      ]
    });    
  });

 //Eliminar el acceso directo
 $(document).on("click",".delDirectoExp",function(){
    let idexp=$(this).data("id");

    top.confirm({
      drag: false,
      overlay: true,
      close: false,
      type: 'warning',
      message: 'Está seguro de eliminar el acceso directo?',
      position: 'center',
      timeout: 0,
      buttons: [
        [
          '<button><b>SI</b></button>',
          function (instance, toast) {
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            $.ajax({
              type : 'POST',
              url: `${baseUrl}app/expediente/ejecutar_acciones.php`,
              data: {
                nameInstance:'ExpedienteController',
                methodInstance:'deleteDirectExpedienteCont',
                idexpediente:idexp
              },
              dataType: 'json',
              success: function(response){
                if(response.exito){
                  $("#table").bootstrapTable(
                    'remove', {
                      field: 'id',
                      values: [idexp]
                    }
                  );
                  top.notification({
                    message : response.message,
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

          },
          true
        ],
        [
          '<button>NO</button>',
          function (instance, toast) {
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
          }
        ],
      ]
    });
  });


  //Papelera Restaurar 
 $(document).on("click",".restore",function(){
    var id=$(this).data("id");
    var tabla=$(this).data("tabla");
    var key=$(this).data("key");

    let eti='el expediente?';
    let params={
      nameInstance:'ExpedienteController',
      methodInstance:'restoreExpedienteCont',
      idexpediente:id
    };
    if(tabla=='caja'){
      eti='la caja?';
      params={
        nameInstance:'CajaController',
        methodInstance:'restoreCajaCont',
        idcaja:id
      };
    }

    top.confirm({
      drag: false,
      overlay: true,
      close: false,
      type: 'warning',
      message: 'Está seguro de restaurar '+eti,
      position: 'center',
      timeout: 0,
      buttons: [
        [
          '<button><b>SI</b></button>',
          function (instance, toast) {
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            $.ajax({
              type : 'POST',
              url: `${baseUrl}app/expediente/ejecutar_acciones.php`,
              data: params,
              dataType: 'json',
              success: function(response){
                if(response.exito){
                  $("#table").bootstrapTable('remove', {field: 'id',values: [key]});
                  top.notification({
                    message : response.message,
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
            
          },
          true
        ],
        [
          '<button>NO</button>',
          function (instance, toast) {
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
          }
        ],
      ]
    });
  });

  //Papelera Eliminar Definitivamente 
 $(document).on("click",".delDef",function(){
    var id=$(this).data("id");
    var tabla=$(this).data("tabla");
    var key=$(this).data("key");

    let eti='el expediente?';
    let params={
      nameInstance:'ExpedienteController',
      methodInstance:'deleteDefExpedienteCont',
      idexpediente:id
    };
    if(tabla=='caja'){
      eti='la caja?';
      params={
        nameInstance:'CajaController',
        methodInstance:'deleteDefCajaCont',
        idcaja:id
      };
    }

    top.confirm({
      drag: false,
      overlay: true,
      close: false,
      type: 'error',
      title:'Eliminar definitivamente!',
      message: 'Una vez eliminado NO se podrá restaurar, esta seguro de eliminar '+eti,
      position: 'center',
      timeout: 0,
      buttons: [
        [
          '<button><b>SI</b></button>',
          function (instance, toast) {
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            $.ajax({
              type : 'POST',
              url: `${baseUrl}app/expediente/ejecutar_acciones.php`,
              data: params,
              dataType: 'json',
              success: function(response){
                if(response.exito){
                  $("#table").bootstrapTable(
                    'remove', {
                      field: 'id',values: [key]
                    }
                  );
                  top.notification({
                    message : response.message,
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
            
          },
          true
        ],
        [
          '<button>NO</button>',
          function (instance, toast) {
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
          }
        ],
      ]
    });
  });

  // adicionar expediente
  $(document).on("click", "#addExpediente", function() {
    let idexp=$(this).data("id");
      let options = {
        url: `${baseUrl}views/expediente/adicionar_expediente.php`,
        params: {
          codPadre:idexp,
          panelId:getPanelId()
        },
        size: "modal-lg",
        title: "ADICIONAR EXPEDIENTE/SEPARADOR",
        centerAlign: false,
        buttons: {}
      };
      top.topModal(options);
  });

  $(document).on("click", "#addDocumentExp", function() {
    let idexp=$(this).data("id");
      let options = {
        url: `${baseUrl}formatos/vincular_doc_expedie/adicionar_vincular_doc_expedie.php`,
        params: {
          idexpediente:idexp
        },
        size: "modal-lg",
        title: "",
        centerAlign: false,
        buttons: {}
      };
      top.topModal(options);
  });

//Eliminar el documento del expediente (tipo 2)
 $(document).on("click",".delDoc",function(){
    let iddocExp=$(this).data("id");

    top.confirm({
      drag: false,
      overlay: true,
      close: false,
      type: 'warning',
      message: 'Está seguro de eliminar el vinculo con el expediente?',
      position: 'center',
      timeout: 0,
      buttons: [
        [
          '<button><b>SI</b></button>',
          function (instance, toast) {
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            $.ajax({
              type : 'POST',
              url: `${baseUrl}app/expediente/ejecutar_acciones.php`,
              data: {
                nameInstance:'ExpedienteController',
                methodInstance:'deleteExpDocController',
                iddocExp:iddocExp
              },
              dataType: 'json',
              success: function(response){
                if(response.exito){
                  $("#table").bootstrapTable(
                    'remove', {
                      field: 'id',
                      values: [iddocExp]
                    }
                  );
                  top.notification({
                    message : response.message,
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

          },
          true
        ],
        [
          '<button>NO</button>',
          function (instance, toast) {
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
          }
        ],
      ]
    });
  });

  /*// Compartir documento
  $(document).on("click","#shareExp,.shareExp",function(){
    let idcomp=$(this).data("componente");
    if($(this).attr("id")=="shareExp"){
      if($(".selExp > .icon-check").length){
        let ids=[];
        let i=0;
        $(".icon-check").each(function() {
          ids[i]=$(this).parent().data("id");
          i++;
        });
        
       $("#iframe_detalle").attr({
          'src':'<?= $ruta_db_superior ?>pantallas/expediente/asignar_permiso_expediente.php?opcion=2&ids='+ids+'&idbusqueda_componente='+idcomp
        });
      }else{
        alert("Seleccione por lo menos un expediente");
      }
    }else{
      let idexp=$(this).data("id");     

      $("#iframe_detalle").attr({
        'src':'<?= $ruta_db_superior ?>pantallas/expediente/asignar_permiso_expediente.php?opcion=1&idexpediente='+idexp+'&idbusqueda_componente='+idcomp
      });  
    }
  });*/




});
</script>