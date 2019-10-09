<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class SendMailController
{
    /**
     * identifica los tipos de destinos correo electronico
     */
    const DESTINATION_TYPE_EMAIL = 1;

    /**
     * identifica los tipos de destinos idfuncionario
     */
    const DESTINATION_TYPE_USERID = 2;

    /**
     * identifica los tipo de archivo
     * que provienen de la base de datos
     */
    const ATTACHMENT_TYPE_JSON = 1;

    /**
     * identifica los tipo de archivo
     * que provienen de una ruta raltiva
     */
    const ATTACHMENT_TYPE_ROUTE = 2;

    /**
     * almacena la instancia de PHPMailer
     *
     * @var PHPMailer
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-09
     */
    protected $PHPMailer;

    /**
     * almacena el asunto
     *
     * @var strign
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-09
     */
    protected $subject;

    /**
     * almacena el cuerpo
     *
     * @var string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-09
     */
    protected $body;

    /**
     * almacena los correos destinatarios
     *
     * @var array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-09
     */
    protected $destinations;

    /**
     * almacena los correos de las copias
     *
     * @var array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-09
     */
    protected $copyDestinations;

    /**
     * almacena los correos de las copias ocultas
     *
     * @var array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-09
     */
    protected $hiddenCopyDestinations;

    /**
     * almacena los anexos
     *
     * @var array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-09
     */
    protected $attachments;

    /**
     * define las propiedades subject y body
     *
     * @param string $subject
     * @param string $body
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-09
     */
    public function __construct($subject, $body)
    {
        $this->PHPMailer = new PHPMailer();
        $this->destinations = [];
        $this->copyDestinations = [];
        $this->hiddenCopyDestinations = [];
        $this->attachments = [];
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * obtiene la instancia del PHPMailer
     * con la que se realizara el envio
     *
     * @return PHPMailer
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-09
     */
    public function getInstance()
    {
        return $this->PHPMailer;
    }

    /**
     * actualiza la instancia de PHPMailer
     *
     * @param PHPMailer $instance
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-09
     */
    public function setInstance($instance)
    {
        if ($instance instanceof PHPMailer) {
            return $this->PHPMailer = $instance;
        } else {
            throw new Exception("la instancia suministrada no es instancia de PHPMailer", 1);
        }
    }

    /**
     * define los destinos
     *
     * @param integer $type DESTINATION_TYPE_USERID,DESTINATION_TYPE_EMAIL
     * @param array $destinations
     * @param boolean $keep mantiene los valores anteriores
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-09
     */
    public function setDestinations($type, $destinations, $keep = false)
    {
        if ($type == self::DESTINATION_TYPE_USERID) {
            $destinations = self::getEmailsFromUsers($destinations);
        }

        if ($keep) {
            $destinations = array_unique(array_merge($this->destinations, $destinations));
        }

        return $this->destinations = $destinations;
    }

    /**
     * obtiene los destinos
     *
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-09
     */
    public function getDestinations()
    {
        return $this->destinations;
    }

    /**
     * define las copias
     *
     * @param integer $type DESTINATION_TYPE_USERID,DESTINATION_TYPE_EMAIL
     * @param array $destinations
     * @param boolean $keep mantiene los valores anteriores
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-09
     */
    public function setCopyDestinations($type, $destinations, $keep = false)
    {
        if ($type == self::DESTINATION_TYPE_USERID) {
            $destinations = self::getEmailsFromUsers($destinations);
        }

        if ($keep) {
            $destinations = array_unique(array_merge($this->copyDestinations, $destinations));
        }

        return $this->copyDestinations = $destinations;
    }

    /**
     * obtiene las copias
     *
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-09
     */
    public function getCopyDestinations()
    {
        return $this->copyDestinations;
    }


    /**
     * define las copias
     *
     * @param integer $type DESTINATION_TYPE_USERID,DESTINATION_TYPE_EMAIL
     * @param array $destinations
     * @param boolean $keep mantiene los valores anteriores
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-09
     */
    public function setHiddenCopyDestinations($type, $destinations, $keep = false)
    {
        if ($type == self::DESTINATION_TYPE_USERID) {
            $destinations = self::getEmailsFromUsers($destinations);
        }

        if ($keep) {
            $destinations = array_unique(array_merge($this->hiddenCopyDestinations, $destinations));
        }

        return $this->hiddenCopyDestinations = $destinations;
    }

    /**
     * obtiene las copias ocultas
     *
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-09
     */
    public function getHiddenCopyDestinations()
    {
        return $this->hiddenCopyDestinations;
    }

    /**
     * define los anexos
     *
     * @param integer $type
     * @param array $files
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-09
     */
    public function setAttachments($type, $files, $keep = false)
    {
        $attachments = [];
        foreach ($files as $file) {
            switch ($type) {
                case self::ATTACHMENT_TYPE_JSON:
                    $content = StorageUtils::get_file_content($file);

                    if ($content !== false) {
                        $label = Anexo::getNameFromJson($file);
                        $attachments[] = [
                            'name' => $label,
                            'content' => $content
                        ];
                    }
                    break;
                case self::ATTACHMENT_TYPE_ROUTE:
                    $content = file_get_contents($file);

                    if ($content !== false) {
                        $label = basename($file);
                        $attachments[] = [
                            'name' => $label,
                            'content' => $content
                        ];
                    }
                    break;
                default:
                    throw new Exception("Se debe definir la fuente del anexo", 1);
                    break;
            }
        }

        if ($keep) {
            $attachments = array_merge($this->attachments, $attachments);
        }

        return $this->attachments = $attachments;
    }

    /**
     * obtiene los anexos
     *
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-09
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * realiza el envio basado en la instancia de PHPMailer
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-09
     */
    public function send()
    {
        $mail = $this->getInstance();

        try {
            $configuration = self::getConfiguration();

            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            $mail->Host = $configuration->host;
            $mail->Username = $configuration->user;
            $mail->Password = $configuration->password;
            $mail->Port = $configuration->port;
            $mail->setFrom($configuration->user, $configuration->user);

            //definiendo los destinos
            $destinations = $this->getDestinations();

            if (!$destinations) {
                throw new Exception("Se debe definir el destino", 1);
            }

            foreach ($this->getDestinations() as $value) {
                $mail->addAddress($value);
            }

            //definiendo las copias
            foreach ($this->getCopyDestinations() as $value) {
                $mail->addCC($value);
            }

            //definiendo las copias ocultas
            foreach ($this->getHiddenCopyDestinations() as $value) {
                $mail->addBCC($value);
            }

            //definiendo los anexos
            foreach ($this->getAttachments() as $file) {
                $mail->AddStringAttachment($file['content'], $file['name']);
            }

            $mail->isHTML(true);
            $mail->Subject = $this->subject;
            $mail->Body = $this->body;
            var_dump($mail);
            //	return 123;
            return $mail->send();
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    /**
     * obtiene los valores configurables
     *
     * @return object
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-09
     */
    public static function getConfiguration()
    {
        $Response = (object) [
            'host' => '',
            'user' => '',
            'password' => '',
            'port' => '',
        ];

        $configurations = Configuracion::findByNames([
            'servidor_correo',
            'correo_notificacion',
            'clave_correo_notificacion',
            'puerto_correo_salida'
        ]);

        foreach ($configurations as $key => $Configuracion) {
            switch ($Configuracion->nombre) {
                case 'servidor_correo':
                    $Response->host = $Configuracion->getValue();
                    break;
                case 'correo_notificacion':
                    $Response->user = $Configuracion->getValue();
                    break;
                case 'clave_correo_notificacion':
                    $Response->password = $Configuracion->getValue();
                    break;
                case 'puerto_correo_salida':
                    $Response->port = $Configuracion->getValue();
                    break;
            }
        }

        return $Response;
    }

    /**
     * obtiene los correos de una lista de idfuncionarios
     *
     * @param array $users
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-09
     */
    public static function getEmailsFromUsers($users)
    {
        $data = [];
        $rows = Model::getQueryBuilder()
            ->select('email')
            ->from('funcionario')
            ->where('idfuncionario in (:list)')
            ->setParameter('list', $users, \Doctrine\DBAL\Connection::PARAM_STR_ARRAY)
            ->execute()->fetchAll();

        foreach ($rows as $row) {
            $data[] = $row['email'];
        }

        return $data;
    }
}
