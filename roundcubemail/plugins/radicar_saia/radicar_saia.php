<?php
/**
 * Radicacion SAIA
 */
class radicar_saia extends rcube_plugin{
  public $task = 'mail';
  private $charset = 'ASCII';
  function init(){
    $rcmail = rcmail::get_instance();

    $this->register_action('plugin.radicar_saia', array($this, 'request_action'));
    //$this->add_hook('storage_init', array($this, 'storage_init'));

    if ($rcmail->action == '' || $rcmail->action == 'show') {
      $skin_path = $this->local_skin_path();
      $this->include_script('radicar_saia.js');
      /*if (is_file($this->home . "/$skin_path/radicar_saia.css"))
        $this->include_stylesheet("$skin_path/radicar_saia.css");*/
      $this->add_texts('localization', true);
      $this->charset = $rcmail->config->get('radicar_saia_charset', RCUBE_CHARSET);
      $this->add_button(array(
        'type' => 'link',
        'label' => 'buttontext',
        'command' => 'plugin.radicar_saia',
        'class' => 'button buttonPas junk disabled',
        'classact' => 'button junk',
        'title' => 'buttontitle',
        'domain' => 'radicar_saia'), 'toolbar');
    }
  }

  /*function storage_init($args){
    $flags = array(
      'JUNK'    => 'Junk',
      'NONJUNK' => 'NonJunk',
    );

    // register message flags
    $args['message_flags'] = array_merge((array)$args['message_flags'], $flags);

    return $args;
  }*/

  function request_action(){
    $max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
    $ruta_db_superior=$ruta="";
    while($max_salida>0){
      if(is_file($ruta."db.php")){
        $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
      }
      $ruta.="../";
      $max_salida--;
    }
    global $conn;
    include_once($ruta_db_superior."db.php");
    $this->add_texts('localization');

    $rcmail  = rcmail::get_instance();
    $storage = $rcmail->get_storage();
    $dato_correo=array();
    $tempfiles=array();
    foreach (rcmail::get_uids() as $mbox => $uids) {
      $message = new rcube_message($uids[0]);
      rcmail_check_safe($message);
      $dato_correo["asunto"]=$message->subject;
      $dato_correo["fecha_oficio_entrada"]=date("Y-m-d H:i:s",$message->headers->timestamp);
      $dato_correo["from"]=$message->headers->from;
	    $dato_correo["tipo_radicado"]=$mbox;
      $dato_correo["to"]=$message->headers->to."-".$message->headers->cc."--".$message->headers->cco;
      $temp_dir  = $rcmail->config->get('temp_dir');
      foreach ($message->attachments as $part) {
        $pid      = $part->mime_id;
        $part     = $message->mime_parts[$pid];
        $filename = $part->filename;
        if ($filename === null || $filename === '') {
            $ext      = (array) rcube_mime::get_mime_extensions($part->mimetype);
            $ext      = array_shift($ext);
            $filename = $rcmail->gettext('messagepart') . ' ' . $pid;
            if ($ext) {
                $filename .= '.' . $ext;
            }
        }
        $tmpfn       =$temp_dir."/".uniqid ()."_|_".$this->_convert_filename($filename);
        $tmpfp       = fopen($tmpfn, 'w');
        $tempfiles[] = $tmpfn;
        $message->get_part_body($part->mime_id, false, 0, $tmpfp);
        fclose($tmpfp);
      }
      $tmpfn       =$temp_dir."/".uniqid ()."_|_mail.eml";
      $tmpfp       = fopen($tmpfn, 'w');
      $storage->get_raw_body($uids[0],$tmpfp);
      fclose($tmpfp);
      $tempfiles[] = $tmpfn;
      $dato_correo["anexos"]=implode(",",$tempfiles);
    }
    $rcmail->output->command('display_message', $this->gettext('reportedasradicado'), 'confirmation');
    $rcmail->dato_correo=$dato_correo;
    $configuracion=busca_filtro_tabla("","configuracion","tipo='correo' AND nombre='formato_correo'","",$conn);
    $ruta_formato='formatos/correo_saia/adicionar_correo_saia.php';
    if($configuracion["numcampos"]){
      $ruta_formato=$configuracion[0]["valor"];
    }
    $rcmail->output->command('redirect', $ruta_db_superior.$ruta_formato."?datos_correo=".json_encode($dato_correo), '');
    $rcmail->output->send();
  }
  private function _convert_filename($str){
    $str = rcube_charset::convert($str, RCUBE_CHARSET, $this->charset);
    return strtr($str, array(':' => '', '/' => '-'));
  } 
}
