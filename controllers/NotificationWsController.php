<?php
class NotificationWsController
{
    private $host;
    private $port;
    private $null = null;
    private $changed;
    private $socket;
    private $clients = [];

    function __construct($host = 'localhost', $port = 1000)
    {
        $this->host = $host;
        $this->port = $port;
        $this->init();
    }

    /**
     * inicia el proceso
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-22
     */
    public function init()
    {
        $this->createSocket();

        while (true) {
            $this->checkNewConnections();
            $this->checkChanges();
            //en caso de que se requieran notificaciones basadas en consultas
            //$this->sendNotifications(); 
        }
        // close the listening socket
        socket_close($this->socket);
    }

    /**
     * crea el socket inicial
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-22
     */
    public function createSocket()
    {
        //Create TCP/IP sream socket
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        //reuseable port
        socket_set_option($this->socket, SOL_SOCKET, SO_REUSEADDR, 1);

        //bind socket to specified host
        socket_bind($this->socket, 0, $this->port);

        //listen to port
        socket_listen($this->socket);

        //create & add listning socket to the list
        $this->clients[0] = [
            $this->socket
        ];
    }

    /**
     * verifica si hay nuevas conecciones
     * y las vincula 
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-22
     */
    public function checkNewConnections()
    {
        $this->changed = [];
        foreach ($this->clients as $socket) {
            $this->changed = array_merge($this->changed, $socket);
        }

        //returns the socket resources in $changed array
        socket_select($this->changed, $this->null, $this->null, 0, 10);
        //check for new socket        
        if (in_array($this->socket, $this->changed)) {
            $socket_new = socket_accept($this->socket); //accpet new socket
            $this->clients['unknown'][] = $socket_new; //add socket to client array

            $header = socket_read($socket_new, 1024); //read data sent by the socket
            $this->perform_handshaking($header, $socket_new, $this->host, $this->port); //perform websocket handshake

            socket_getpeername($socket_new, $ip); //get ip address of connected socket
            $response = $this->mask(
                json_encode([
                    'type' => 'system',
                    'message' => $ip . ' connected'
                ])
            ); //prepare json data
            $this->sendMessage($response, $socket_new); //notify about new connection

            $found_socket = array_search($this->socket, $this->changed);
            unset($this->changed[$found_socket]);
        }
    }

    /**
     * verifica si hay cambios en el estado de las conexiones
     * o si hay mensajes desde los clientes
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-22
     */
    public function checkChanges()
    {
        //loop through all connected sockets
        foreach ($this->changed as $changed_socket) {
            //check for any incomming data
            while (socket_recv($changed_socket, $buf, 1024, 0) >= 1) {
                $received_text = $this->unmask($buf); //unmask data
                $this->processCommunication($changed_socket, $received_text);
                break 2; //exits this loop
            }

            $buf = @socket_read($changed_socket, 1024, PHP_NORMAL_READ);
            if ($buf === false) { // check disconnected client
                foreach ($this->clients as $clientId => $sockets) {
                    if (!in_array($changed_socket, $sockets)) {
                        continue;
                    }

                    foreach ($sockets as $key => $socket) {
                        if ($socket == $changed_socket) {
                            // remove client for $clients array
                            socket_getpeername($changed_socket, $ip);
                            unset($this->clients[$clientId][$key]);
                            break 2;
                        }
                    }
                }
            }
        }
    }

    /**
     * envia notificaciones cada 5 segundos
     * (simula un tiempo real)
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-22
     */
    public function sendNotifications()
    {
        throw new Exception("Se debe validar el tiempo de 5 segundos", 1);

        if (!$this->getActiveClients()) {
            return;
        }

        $userList = implode(',', $this->getActiveClients());
        $sql = <<<SQL
            SELECT destino,count(*) as total 
            FROM notificacion
            WHERE
                destino in ({$userList}) AND
                notificado = 0
            GROUP BY destino
SQL;
        throw new Exception("ejecutar la consulta", 1);


        foreach ($data as $value) {
            $sockets = $this->clients[$value['destino']];
            foreach ($sockets as $socket) {
                $message = $this->mask(json_encode($value));
                $this->sendMessage($message, $socket); //send data
            }
        }

        $sql = <<<SQL
            UPDATE notificacion
            SET notificado = 1
            WHERE
                destino in ({$userList}) AND
                notificado = 0
SQL;
        throw new Exception("ejecutar el update", 1);


        //sleep(5);
    }

    /**
     * procesa la comunicacion  entrante de un cliente
     *
     * @param [type] $originSocket socket que se comunica
     * @param string $data
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-22
     */
    public function processCommunication($originSocket, $data)
    {
        $inputData = json_decode($data); //json decode 

        switch ($inputData->action) {
            case 'userData':
                $key = array_search($originSocket, $this->clients['unknown']);
                if ($key !== false) {
                    $response = $this->setUserData($key, $inputData);
                    $response_text = $this->mask(json_encode($response));
                    $this->sendMessage($response_text, $originSocket);
                }
                break;
            case 'notifications':
                $messages = $this->createNotifications($inputData);

                foreach ($messages as $clientId => $notifications) {
                    if (array_key_exists($clientId, $this->getActiveClients())) {
                        $destinationSocket = $this->clients[$clientId];
                    }

                    $message = count($notifications) > 1 ?
                        'Tienes nuevas notificaciones' : 'Tienes una nueva notificación';

                    $data = [
                        'message' => $message,
                        'type' => 'notification',
                        'total' => count($notifications)
                    ];

                    $response_text = $this->mask(json_encode($data));
                    $this->sendMessage($response_text, $destinationSocket);
                }

                break;
        }
    }

    /**
     * crea una notificacion basada en la comunicacion
     * de un cliente
     *
     * @param object $data
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-22
     */
    public function createNotifications($params)
    {
        $notifications = CriptoController::decrypt_blowfish($params->data);
        $notifications = json_decode($notifications);

        $messages = [];
        foreach ($notifications as $notification) {
            $notification->id = Notificacion::newRecord([
                'origen' => $notification->origin,
                'destino' => $notification->destination,
                'fecha' => $notification->date,
                'descripcion' => $notification->description,
                'leido' => 0,
                'notificado' => 0,
                'tipo' => $notification->type,
                'tipo_id' => $notification->typeId,
            ]);
            $messages[$notification->destination][] = $notification;
        }

        return $messages;
    }

    /**
     * vincula los sockets con la informacion de los usuarios
     *
     * @param string $clientName
     * @param object $inputData
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-22
     */
    public function setUserData($key, $inputData)
    {
        $token = $inputData->userData->token;
        if (!LogAcceso::checkActiveToken($token)) {
            $response = [
                'success' => 0,
                'type' => 'userData',
                'message' => 'Acceso denegado'
            ];
        } else {
            $socket = $this->clients['unknown'][$key];
            $clientId = $inputData->userData->key;
            $this->clients[$clientId][] = $socket;
            unset($this->clients['unknown'][$key]);

            $success = !$this->clients['unknown'][$key] &&
                in_array($socket, $this->clients[$clientId]);
            $response = [
                'success' => $success,
                'type' => 'userData',
                'message' => 'Informacion actualizada'
            ];
        }

        return $response;
    }

    /**
     * envia un mensaje a un cliente especifico
     *
     * @param string $msg
     * @param void $sockets
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-22
     */
    public function sendMessage($msg, $sockets)
    {
        $sockets = !is_array($sockets) ? [$sockets] : $sockets;

        foreach ($sockets as $socket) {
            @socket_write($socket, $msg, strlen($msg));
        }
        return true;
    }

    /**
     * retorna el listado de usuarios activos
     *
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-22
     */
    public function getActiveClients()
    {
        $clients = array_filter($this->clients, function ($key) {
            return !in_array($key, [0, 'unknown']);
        }, ARRAY_FILTER_USE_KEY);

        return $clients;
    }

    /**
     * decodifica el mensaje recibido
     *
     * @param string $text
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-22
     */
    public function unmask($text)
    {
        $length = ord($text[1]) & 127;
        if ($length == 126) {
            $masks = substr($text, 4, 4);
            $data = substr($text, 8);
        } elseif ($length == 127) {
            $masks = substr($text, 10, 4);
            $data = substr($text, 14);
        } else {
            $masks = substr($text, 2, 4);
            $data = substr($text, 6);
        }
        $text = "";
        for ($i = 0; $i < strlen($data); ++$i) {
            $text .= $data[$i] ^ $masks[$i % 4];
        }
        return $text;
    }

    /**
     * codifica un mensaje para enviar
     *
     * @param string $text
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-22
     */
    public function mask($text)
    {
        $b1 = 0x80 | (0x1 & 0x0f);
        $length = strlen($text);

        if ($length <= 125)
            $header = pack('CC', $b1, $length);
        elseif ($length > 125 && $length < 65536)
            $header = pack('CCn', $b1, 126, $length);
        elseif ($length >= 65536)
            $header = pack('CCNN', $b1, 127, $length);
        return $header . $text;
    }

    /**
     * genera la respuesta para crear la comunicacion
     * con el cliente
     *
     * @param [type] $receved_header
     * @param [type] $client_conn
     * @param string $host
     * @param integer $port
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-22
     */
    public function perform_handshaking($receved_header, $client_conn, $host, $port)
    {
        $headers = array();
        $lines = preg_split("/\r\n/", $receved_header);
        foreach ($lines as $line) {
            $line = chop($line);
            if (preg_match('/\A(\S+): (.*)\z/', $line, $matches)) {
                $headers[$matches[1]] = $matches[2];
            }
        }

        $secKey = $headers['Sec-WebSocket-Key'];
        $secAccept = base64_encode(pack('H*', sha1($secKey . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
        //hand shaking header
        $upgrade  = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" .
            "Upgrade: websocket\r\n" .
            "Connection: Upgrade\r\n" .
            "WebSocket-Origin: $host\r\n" .
            "WebSocket-Location: ws://$host:$port/app/websockets/notificaciones.php\r\n" .
            "Sec-WebSocket-Accept:$secAccept\r\n\r\n";
        socket_write($client_conn, $upgrade, strlen($upgrade));
    }
}
