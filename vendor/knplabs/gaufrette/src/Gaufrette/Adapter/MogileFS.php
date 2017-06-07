<?php

namespace Gaufrette\Adapter;

use Gaufrette\Adapter;
use Gaufrette\Util;

/**
 * Adapter for the MogileFS filesystem.
 *
 * @author Mikko Tarvainen 2011 <mtarvainen@gmail.com>
 * @author Antoine Hérault <antoine.herault@gmail.com>
 *
 * Bases partly on Wikimedia MogileFS client code by Jens Frank and Domas Mituzas, 2007.
 * See more: http://svn.wikimedia.org/viewvc/mediawiki/trunk/extensions/MogileClient/
 */
class MogileFS implements Adapter
{
<<<<<<< HEAD
    const ERR_OTHER       = 0;
    const ERR_UNKNOWN_KEY = 1;
    const ERR_EMPTY_FILE  = 2;
    const ERR_NONE_MATCH  = 3;
    const ERR_KEY_EXISTS  = 4;
=======
    const ERR_OTHER = 0;
    const ERR_UNKNOWN_KEY = 1;
    const ERR_EMPTY_FILE = 2;
    const ERR_NONE_MATCH = 3;
    const ERR_KEY_EXISTS = 4;
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744

    protected $domain;
    protected $hosts;
    protected $socket;

    /**
<<<<<<< HEAD
     * Constructor
     *
=======
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     * @param domain MogileFS domain
     * @param hosts  Array of MogileFS trackers
     */
    public function __construct($domain, array $hosts)
    {
        if (strlen($domain) < 1 || count($hosts) < 1) {
            throw new \InvalidArgumentException('Invalid parameters. Given domain is too short or you not given any host.');
        }

        $this->domain = $domain;
<<<<<<< HEAD
        $this->hosts  = $hosts;
    }

    /**
     * {@inheritDoc}
=======
        $this->hosts = $hosts;
    }

    /**
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function read($key)
    {
        $paths = $this->getPaths($key);

        $data = '';

        if ($paths) {
            shuffle($paths);
            foreach ($paths as $path) {
                $fh = fopen($path, 'r');

                if (!$fh) {
                    continue;
                }

                while (!feof($fh)) {
                    $data .= fread($fh, 8192);
                }

                fclose($fh);
                break;
            }
        }

        return $data ?: false;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function write($key, $content, array $metadata = null)
    {
        $closeres = false;

        if (mb_strlen($content) > 0) {
<<<<<<< HEAD
            $res = $this->doRequest("CREATE_OPEN", array("key" => $key, "class" => $metadata['mogile_class']));
=======
            $res = $this->doRequest('CREATE_OPEN', array('key' => $key, 'class' => $metadata['mogile_class']));
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744

            if ($res && preg_match('/^http:\/\/([a-z0-9.-]*):([0-9]*)\/(.*)$/', $res['path'], $matches)) {
                $host = $matches[1];
                $port = $matches[2];
                $path = $matches[3];

                $status = $this->putFile($res['path'], $content);

                if ($status) {
<<<<<<< HEAD
                    $params = array("key" => $key, "class" => $metadata['mogile_class'], "devid" => $res['devid'],
                                    "fid" => $res['fid'], "path" => urldecode($res['path']));
                    $closeres = $this->doRequest("CREATE_CLOSE", $params);
=======
                    $params = array('key' => $key, 'class' => $metadata['mogile_class'], 'devid' => $res['devid'],
                                    'fid' => $res['fid'], 'path' => urldecode($res['path']), );
                    $closeres = $this->doRequest('CREATE_CLOSE', $params);
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
                }
            }
        }

        if (!is_array($closeres)) {
            return false;
        }

        return Util\Size::fromContent($content);
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function delete($key)
    {
        $this->doRequest('DELETE', array('key' => $key));

        return true;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function rename($sourceKey, $targetKey)
    {
        $this->doRequest('RENAME', array(
<<<<<<< HEAD
            'from_key'  => $sourceKey,
            'to_key'    => $targetKey
=======
            'from_key' => $sourceKey,
            'to_key' => $targetKey,
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
        ));

        return true;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function exists($key)
    {
        try {
            $this->getPaths($key);
        } catch (\RuntimeException $e) {
            return false;
        }

        return true;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function keys()
    {
        try {
            $result = $this->doRequest('LIST_KEYS');
        } catch (\RuntimeException $e) {
            if (self::ERR_NONE_MATCH === $e->getCode()) {
                return array();
            }

            throw $e;
        }

        unset($result['key_count'], $result['next_after']);

        return array_values($result);
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function mtime($key)
    {
        return false;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function isDirectory($key)
    {
        return false;
    }

    /**
<<<<<<< HEAD
     * Get available domains and classes from tracker
=======
     * Get available domains and classes from tracker.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @return mixed Array on success, false on failure
     */
    public function getDomains()
    {
        $res = $this->doRequest('GET_DOMAINS');
        if (!$res) {
            return false;
        }

        $domains = array();

<<<<<<< HEAD
        for ($i = 1; $i <= $res['domains']; $i++) {
            $dom = 'domain' . $i;
            $classes = array();

            // Associate classes to current domain (class name => mindevcount)
            for ($j = 1; $j <= $res[$dom.'classes']; $j++) {
                $classes[$res[$dom . 'class' . $j . 'name']] = $res[$dom . 'class' . $j . 'mindevcount'];
=======
        for ($i = 1; $i <= $res['domains']; ++$i) {
            $dom = 'domain'.$i;
            $classes = array();

            // Associate classes to current domain (class name => mindevcount)
            for ($j = 1; $j <= $res[$dom.'classes']; ++$j) {
                $classes[$res[$dom.'class'.$j.'name']] = $res[$dom.'class'.$j.'mindevcount'];
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            }

            $domains[] = array('name' => $res[$dom], 'classes' => $classes);
        }

        return $domains;
    }

    /**
<<<<<<< HEAD
     * Tries to connect MogileFS tracker
=======
     * Tries to connect MogileFS tracker.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @return Socket
     */
    private function connect()
    {
        if ($this->socket) {
            return $this->socket;
        }

        shuffle($this->hosts);

        foreach ($this->hosts as $host) {
            list($ip, $port) = explode(':', $host);
            $this->socket = @fsockopen($ip, $port, $err_no, $err_str, 1);

            if ($this->socket) {
                break;
            }
        }

        if (!$this->socket) {
            throw new \RuntimeException('Unable to connect to the tracker.');
        }

        return $this->socket;
    }

    /**
<<<<<<< HEAD
     * Close connection to MogileFS tracker
     *
     * @return boolean
=======
     * Close connection to MogileFS tracker.
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    private function close()
    {
        if ($this->socket) {
            return fclose($this->socket);
        }

        return true;
    }

    /**
<<<<<<< HEAD
     * Makes request to MogileFS tracker
     *
     * @param cmd Command
     * @param args Array of arguments
=======
     * Makes request to MogileFS tracker.
     *
     * @param cmd Command
     * @param args Array of arguments
     *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     * @return mixed Array on success, false on failure
     */
    private function doRequest($cmd, $args = array())
    {
        clearstatcache();
        $args['domain'] = $this->domain;
        $params = http_build_query($args);

        $this->connect();

        fwrite($this->socket, "{$cmd} {$params}\n");
        $line = fgets($this->socket);

        $words = explode(' ', $line);

        if ($words[0] == 'OK') {
            parse_str(trim($words[1]), $result);
        } else {
            $errorName = empty($words[1]) ? null : $words[1];

            switch ($errorName) {
                case 'unknown_key':
                    $errorCode = static::ERR_UNKNOWN_KEY;
                    break;
                case 'empty_file':
                    $errorCode = static::ERR_EMPTY_FILE;
                    break;
                case 'none_match':
                    $errorCode = static::ERR_NONE_MATCH;
                    break;
                case 'key_exists':
                    $errorCode = static::ERR_KEY_EXISTS;
                    break;
                default:
                    $errorCode = static::ERR_OTHER;
            }

            throw new \RuntimeException(
                sprintf('Error response: %s', $line),
                $errorCode
            );
        }

        return $result;
    }

    /**
<<<<<<< HEAD
     * Get file location at server from MogileFS tracker
     *
     * @param key File key
=======
     * Get file location at server from MogileFS tracker.
     *
     * @param key File key
     *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     * @return mixed Array on success, false on failure
     */
    private function getPaths($key)
    {
<<<<<<< HEAD
        $res = $this->doRequest("GET_PATHS", array("key" => $key));
=======
        $res = $this->doRequest('GET_PATHS', array('key' => $key));
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
        unset($res['paths']);

        return $res;
    }

    /**
<<<<<<< HEAD
     * Sends file to MogileFS tracker
     *
     * @param path Save path at server
     * @param data Data to save
     * @return boolean
=======
     * Sends file to MogileFS tracker.
     *
     * @param path Save path at server
     * @param data Data to save
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    private function putFile($path, $data)
    {
        $info = false;
        $url = parse_url($path);

        $fp = fsockopen($url['host'], $url['port'], $errno, $errstr, 5);
        if (!$fp) {
            return false;
        }

        $buffer = '';
        $b = "\r\n";

        stream_set_blocking($fp, true);
        stream_set_timeout($fp, 30, 200000);

<<<<<<< HEAD
        $out  = "PUT ". $url['path']. " HTTP/1.1". $b;
        $out .= "Host: ". $url['host']. $b;
        $out .= "Content-Length: ". Util\Size::fromContent($data). $b. $b;
        $out .= $data;
        $out .= $b. $b;
=======
        $out = 'PUT '.$url['path'].' HTTP/1.1'.$b;
        $out .= 'Host: '.$url['host'].$b;
        $out .= 'Content-Length: '.Util\Size::fromContent($data).$b.$b;
        $out .= $data;
        $out .= $b.$b;
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
        fwrite($fp, $out);
        fflush($fp);

        stream_set_blocking($fp, true);
        stream_set_timeout($fp, 30, 200000);

        while (!feof($fp) && !$info['timed_out']) {
            $info = stream_get_meta_data($fp);
            $buffer .= fgets($fp, 128);
        }
        fclose($fp);

        return true;
    }

    /**
<<<<<<< HEAD
     * Closes the underlying connection
     */
    public function __destruct() {
      $this->close();
=======
     * Closes the underlying connection.
     */
    public function __destruct()
    {
        $this->close();
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
    }
}
