<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
        break;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'controllers/autoload.php';

class NotificationWebSocket
{
    private $host;
    private $port;
    private $null = null;
    private $changed;
    private $socket;
    private $clients = [];
    private $activeUsers = [];


    function __construct($host = 'localhost', $port = 1000)
    {
        $this->host = $host;
        $this->port = $port;

        $this->init();
    }

    public function init()
    {
        $this->createSocket();
        //start endless loop, so that our script doesn't stop
        while (true) {
            $this->checkNewConnections();
            $this->checkChanges();
            $this->sendNotifications();
        }
        // close the listening socket
        socket_close($this->socket);
    }

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
        $this->clients = [
            'default' => (object)[
                'socket' => $this->socket
            ]
        ];
    }

    public function checkNewConnections()
    {
        //manage multipal connections
        $this->changed = [];
        foreach ($this->clients as $data) {
            $this->changed[] = $data->socket;
        }
        //returns the socket resources in $changed array
        socket_select($this->changed, $this->null, $this->null, 0, 10);
        //check for new socket
        if (in_array($this->socket, $this->changed)) {
            $socket_new = socket_accept($this->socket); //accpet new socket
            $this->clients['new-' . count($this->clients)] = (object)[
                'socket' => $socket_new //add socket to client array
            ];

            $header = socket_read($socket_new, 1024); //read data sent by the socket
            $this->perform_handshaking($header, $socket_new, $this->host, $this->port); //perform websocket handshake

            socket_getpeername($socket_new, $ip); //get ip address of connected socket
            $response = $this->mask(json_encode(array('type' => 'system', 'message' => $ip . ' connected'))); //prepare json data
            $this->sendMessage($response, $socket_new); //notify all users about new connection

            //make room for new socket
            $found_socket = array_search($this->socket, $this->changed);
            unset($this->changed[$found_socket]);
        }
    }

    public function checkChanges()
    {
        //loop through all connected sockets
        foreach ($this->changed as $changed_socket) {
            //check for any incomming data
            while (socket_recv($changed_socket, $buf, 1024, 0) >= 1) {
                $received_text = $this->unmask($buf); //unmask data
                $this->processCommunication($changed_socket, $received_text);
                break 2; //exist this loop
            }

            $buf = @socket_read($changed_socket, 1024, PHP_NORMAL_READ);
            if ($buf === false) { // check disconnected client

                foreach ($this->clients as $clientName => $data) {
                    if ($data->socket == $changed_socket) {
                        // remove client for $clients array
                        socket_getpeername($changed_socket, $ip);
                        unset($this->clients[$clientName]);
                        break;
                    }
                }
            }
        }
    }

    public function sendNotifications()
    {
        if (!$this->activeUsers) {
            return;
        }

        $userList = implode(',', $this->activeUsers);
        $sql = <<<SQL
            SELECT destino,count(*) as total 
            FROM notificacion
            WHERE
                destino in ({$userList}) AND
                notificado = 0
            GROUP BY destino
SQL;
        $data = StaticSql::search($sql);

        foreach ($data as $value) {
            foreach ($this->clients as $data) {
                if ($data->userData->key == $value['destino']) {
                    $message = $this->mask(json_encode($value));
                    $this->sendMessage($message, $data->socket); //send data
                }
            }
        }

        $sql = <<<SQL
            UPDATE notificacion
            SET notificado = 1
            WHERE
                destino in ({$userList}) AND
                notificado = 0
SQL;
        StaticSql::query($sql);

        sleep(5);
    }

    public function processCommunication($socket, $data)
    {
        $inputData = json_decode($data); //json decode 

        foreach ($this->clients as $clientName => $data) {
            if ($data->socket == $socket) {
                if (!isset($data->userData) && $inputData->userData) {
                    $response = $this->setUserData($clientName, $inputData);
                }
                break;
            }
        }

        if (isset($response)) {
            //prepare data to be sent to client
            $response_text = $this->mask(json_encode($response));
            $this->sendMessage($response_text, $socket); //send data
        }
    }

    public function setUserData($clientName, $inputData)
    {
        $this->activeUsers[] = $inputData->userData->key;
        $this->activeUsers = array_unique($this->activeUsers);
        $this->clients[$clientName]->userData = $inputData->userData;

        return [
            'success' => $this->clients[$clientName]->userData ? 1 : 0,
            'message' => 'Informacion actualizada'
        ];
    }

    public function sendMessage($msg, $socket)
    {
        @socket_write($socket, $msg, strlen($msg));
        return true;
    }

    //Unmask incoming framed message
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

    //Encode message for transfer to client.
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

    //handshake new client.
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
            "WebSocket-Location: ws://$host:$port/demo/shout.php\r\n" .
            "Sec-WebSocket-Accept:$secAccept\r\n\r\n";
        socket_write($client_conn, $upgrade, strlen($upgrade));
    }
}

new NotificationWebSocket();
