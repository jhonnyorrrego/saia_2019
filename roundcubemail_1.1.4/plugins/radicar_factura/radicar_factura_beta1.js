/**
 * Radicar SAIA plugin script
 *
 */

function rcmail_radicar_factura(prop){
  if (!rcmail.env.uid && (!rcmail.message_list || !rcmail.message_list.get_selection().length))
    return;
  
    var uids = rcmail.env.uid ? rcmail.env.uid : rcmail.message_list.get_selection().join(','), lock = rcmail.set_busy(true, 'loading');

    rcmail.http_post('plugin.radicar_factura', '_uid='+uids+'&_mbox='+urlencode(rcmail.env.mailbox), lock);
}

// callback for app-onload event
if (window.rcmail) {
  rcmail.addEventListener('init', function(evt) {
    // register command (directly enable in message view mode)
    rcmail.register_command('plugin.radicar_factura', rcmail_radicar_factura, rcmail.env.uid);
    
    // add event-listener to message list
    if (rcmail.message_list)
      rcmail.message_list.addEventListener('select', function(list){
        rcmail.enable_command('plugin.radicar_factura', list.get_selection().length > 0);
      });
  });
  rcmail.addEventListener('plugin.procesar_respuesta', procesarRespuesta);
  
}

function procesarRespuesta(respuesta) {
	alert("Hola mundo");
	console.log(respuesta);
}
