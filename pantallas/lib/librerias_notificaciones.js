function notificacion_saia(message ,type, location, duration){
  top.notification({
    message: mensaje,
    type: tipo,
    duration: tiempo
  });
}

function cerrar_notificaciones_saia(){  
  top.closeNotifications();
}