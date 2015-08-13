/**
 * @param string mensaje Mensaje a mostrar
 * @param string tipo Estilo de la notificacion error->error,warning->alerta, success->exito
 * @param string ubicacion ""->top_center,
 * @param int tiempo Tiempo del timeout para cerrar la notificacion 0->No cierra la notificacion
 * @todo implementar las demas ubicaciones 
 * 
 */

function notificacion_saia(mensaje,tipo,ubicacion,tiempo){
  if(ubicacion===''){
    ubicacion="topCenter";
  }
  top.noty({text:mensaje, type:tipo, layout:ubicacion,timeout:tiempo});
}
function cerrar_notificaciones_saia(){  
  top.$.noty.closeAll();
}