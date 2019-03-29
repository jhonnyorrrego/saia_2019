function notificacion_saia(message ,type, location, duration){
  top.notification({
    message: message,
    type: type,
    duration: duration
  });
}