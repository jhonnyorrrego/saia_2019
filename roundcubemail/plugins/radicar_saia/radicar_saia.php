<?php

/**
 * Radicacion SAIA
 */
class radicar_saia extends rcube_plugin
{

    public $task = 'mail';

    private $charset = 'ASCII';

    function init()
    {
        $rcmail = rcmail::get_instance();

        $this->register_action('plugin.radicar_saia', array(
            $this,
            'request_action'
        ));
        // $this->add_hook('storage_init', array($this, 'storage_init'));

        if ($rcmail->action == '' || $rcmail->action == 'show') {
            $skin_path = $this->local_skin_path();
            $this->include_script('radicar_saia.js');
            /*
             * if (is_file($this->home . "/$skin_path/radicar_saia.css"))
             * $this->include_stylesheet("$skin_path/radicar_saia.css");
             */
            $this->add_texts('localization', true);
            $this->charset = $rcmail->config->get('radicar_saia_charset', RCUBE_CHARSET);
            $this->add_button(array(
                'type' => 'link',
                'label' => 'buttontext',
                'command' => 'plugin.radicar_saia',
                'class' => 'button buttonPas junk disabled',
                'classact' => 'button junk',
                'title' => 'buttontitle',
                'domain' => 'radicar_saia'
            ), 'toolbar');
        }
    }

    function request_action()
    {
        $max_salida = 10;
        $ruta_db_superior = $ruta = "";
        while ($max_salida > 0) {
            if (is_file($ruta . "db.php")) {
                $ruta_db_superior = $ruta;
            }
            $ruta .= "../";
            $max_salida--;
        }
        
        include_once($ruta_db_superior . "core/autoload.php");
        $this->add_texts('localization');

        $rcmail = rcmail::get_instance();
        $storage = $rcmail->get_storage();

        $ids_buzones = rcmail::get_uids();
        $info_correo = array();
        $i = 0;
        foreach ($ids_buzones as $mbox => $uids) {
            foreach ($uids as $idcorreo) {
                $tempfiles = array();
                $dato_correo = array();
                $message = new rcube_message($idcorreo);
                rcmail_check_safe($message);
                $dato_correo["asunto"] = $message->subject;
                $dato_correo["fecha_oficio_entrada"] = date("Y-m-d H:i:s", $message->headers->timestamp);
                $dato_correo["from"] = $message->headers->from;
                $dato_correo["buzon"] = $mbox;
                $dato_correo["uid"] = $idcorreo;
                $dato_correo["to"] = $message->headers->to . "-" . $message->headers->cc . "--" . $message->headers->cco;

                $temp_dir = $rcmail->config->get('temp_dir');
                foreach ($message->attachments as $part) {
                    $pid = $part->mime_id;
                    $part = $message->mime_parts[$pid];
                    $filename = $part->filename;
                    if ($filename === null || $filename === '') {
                        $ext = (array) rcube_mime::get_mime_extensions($part->mimetype);
                        $ext = array_shift($ext);
                        $filename = $rcmail->gettext('messagepart') . ' ' . $pid;
                        if ($ext) {
                            $filename .= '.' . $ext;
                        }
                    }
                    $tmpfn = $temp_dir . "/" . uniqid() . "---" . $this->_convert_filename($filename);
                    $tmpfp = fopen($tmpfn, 'w');
                    $tempfiles[] = $tmpfn;
                    $message->get_part_body($part->mime_id, false, 0, $tmpfp);
                    fclose($tmpfp);
                }
                $tmpfn = $temp_dir . "/" . uniqid() . "_|_mail.eml";
                $tmpfp = fopen($tmpfn, 'w');
                $storage->get_raw_body($idcorreo, $tmpfp);
                fclose($tmpfp);
                $tempfiles[] = $tmpfn;
                $dato_correo["anexos"] = implode(",", $tempfiles);
                $info_correo[$i] = $dato_correo;
                $i++;
            }
        }
        $Funcionario = new Funcionario(funcionario::RADICADOR_WEB);
        $SessionController = new SessionController($Funcionario);
        //logear_funcionario_webservice("radicador_web");
        $idgrupo = uniqid();
        $search = array("<", ">", "&", '"');
        $replace = array("", "", "", "");
        for ($j = 0; $j < $i; $j++) {
            if (preg_match_all("/<([^>]*)>/", $info_correo[$j]["to"], $output_array)) {
                $to = implode(",", $output_array[1]);
            } else {
                $to = $info_correo[$j]["to"];
            }

            $valores = array(
                "idgrupo" => "'$idgrupo'",
                "uid" => $info_correo[$j]["uid"],
                "asunto" => "'" . htmlentities($info_correo[$j]["asunto"]) . "'",
                "fecha_oficio_entrada" => fecha_db_almacenar($info_correo[$j]["fecha_oficio_entrada"], "Y-m-d H:i:s"),
                "de" => "'" . htmlentities(str_replace($search, $replace, $info_correo[$j]["from"])) . "'",
                "buzon_email" => "'" . $info_correo[$j]["buzon"] . "'",
                "para" => "'$to'",
                "anexos" => "'" . $info_correo[$j]["anexos"] . "'"
            );

            $insert = "INSERT INTO dt_datos_correo (" . explode(", ", array_keys($valores)) . ") VALUES (" . explode(", ", array_values($valores)) .  ")";
            phpmkr_query($insert) or die("Error al ingresar el registro del correo");
        }
        unset($_SESSION["LOGIN" . LLAVE_SAIA]);
        unset($_SESSION["usuario_actual"]);
        unset($_SESSION["idfuncionario"]);
        unset($_SESSION["conexion_remota"]);

        $ruta_formato = 'formatos/correo_saia/';
        $configuracion = busca_filtro_tabla("valor", "configuracion", "tipo='correo' AND nombre='formato_correo'", "");
        if ($configuracion["numcampos"]) {
            $ruta_formato = $configuracion[0]["valor"];
        }
        if ($i > 1) {
            $rcmail->output->command('redirect', $ruta_db_superior . $ruta_formato . "radicar_correo_masivo.php?formulario=1&idgrupo=" . $idgrupo, '');
        } else {
            $rcmail->output->command('redirect', $ruta_db_superior . $ruta_formato . "adicionar_correo_saia.php?idgrupo=" . $idgrupo . "&cant_reg=" . $i, '');
        }
        $rcmail->output->send();
    }

    private function _convert_filename($str)
    {
        $str = rcube_charset::convert($str, RCUBE_CHARSET, $this->charset);
        return strtr($str, array(
            ':' => '',
            '/' => '-'
        ));
    }
}
