<?php

namespace Gaufrette\Adapter;

use Gaufrette\Adapter;
use Gaufrette\File;
use Gaufrette\Filesystem;
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
use Gaufrette\Exception;

/**
 * Ftp adapter
 *
 * @package Gaufrette
<<<<<<< HEAD
=======

/**
 * Ftp adapter.
 *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
 * @author  Antoine Hérault <antoine.herault@gmail.com>
 */
class Ftp implements Adapter,
                     FileFactory,
<<<<<<< HEAD
<<<<<<< HEAD
                     ListKeysAware
=======
                     ListKeysAware,
                     SizeCalculator
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
                     ListKeysAware
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
{
    protected $connection = null;
    protected $directory;
    protected $host;
    protected $port;
    protected $username;
    protected $password;
    protected $passive;
    protected $create;
    protected $mode;
    protected $ssl;
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
    protected $fileData = array();

    /**
     * Constructor
     *
<<<<<<< HEAD
=======
    protected $timeout;
    protected $fileData = array();
    protected $utf8;

    /**
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * @param string $directory The directory to use in the ftp server
     * @param string $host      The host of the ftp server
     * @param array  $options   The options like port, username, password, passive, create, mode
     */
    public function __construct($directory, $host, $options = array())
    {
        if (!extension_loaded('ftp')) {
            throw new \RuntimeException('Unable to use Gaufrette\Adapter\Ftp as the FTP extension is not available.');
        }

        $this->directory = (string) $directory;
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        $this->host      = $host;
        $this->port      = isset($options['port']) ? $options['port'] : 21;
        $this->username  = isset($options['username']) ? $options['username'] : null;
        $this->password  = isset($options['password']) ? $options['password'] : null;
        $this->passive   = isset($options['passive']) ? $options['passive'] : false;
        $this->create    = isset($options['create']) ? $options['create'] : false;
        $this->mode      = isset($options['mode']) ? $options['mode'] : FTP_BINARY;
        $this->ssl       = isset($options['ssl']) ? $options['ssl'] : false;
    }

    /**
     * {@inheritDoc}
<<<<<<< HEAD
=======
        $this->host = $host;
        $this->port = isset($options['port']) ? $options['port'] : 21;
        $this->username = isset($options['username']) ? $options['username'] : null;
        $this->password = isset($options['password']) ? $options['password'] : null;
        $this->passive = isset($options['passive']) ? $options['passive'] : false;
        $this->create = isset($options['create']) ? $options['create'] : false;
        $this->mode = isset($options['mode']) ? $options['mode'] : FTP_BINARY;
        $this->ssl = isset($options['ssl']) ? $options['ssl'] : false;
        $this->timeout = isset($options['timeout']) ? $options['timeout'] : 90;
        $this->utf8 = isset($options['utf8']) ? $options['utf8'] : false;
    }

    /**
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function read($key)
    {
        $this->ensureDirectoryExists($this->directory, $this->create);

        $temp = fopen('php://temp', 'r+');

        if (!ftp_fget($this->getConnection(), $temp, $this->computePath($key), $this->mode)) {
            return false;
        }

        rewind($temp);
        $contents = stream_get_contents($temp);
        fclose($temp);

        return $contents;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function write($key, $content)
    {
        $this->ensureDirectoryExists($this->directory, $this->create);

        $path = $this->computePath($key);
<<<<<<< HEAD
<<<<<<< HEAD
        $directory = dirname($path);
=======
        $directory = \Gaufrette\Util\Path::dirname($path);
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
        $directory = dirname($path);
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889

        $this->ensureDirectoryExists($directory, true);

        $temp = fopen('php://temp', 'r+');
        $size = fwrite($temp, $content);
        rewind($temp);

        if (!ftp_fput($this->getConnection(), $path, $temp, $this->mode)) {
            fclose($temp);

            return false;
        }

        fclose($temp);

        return $size;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function rename($sourceKey, $targetKey)
    {
        $this->ensureDirectoryExists($this->directory, $this->create);

        $sourcePath = $this->computePath($sourceKey);
        $targetPath = $this->computePath($targetKey);

<<<<<<< HEAD
<<<<<<< HEAD
        $this->ensureDirectoryExists(dirname($targetPath), true);
=======
        $this->ensureDirectoryExists(\Gaufrette\Util\Path::dirname($targetPath));
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
        $this->ensureDirectoryExists(dirname($targetPath), true);
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889

        return ftp_rename($this->getConnection(), $sourcePath, $targetPath);
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function exists($key)
    {
        $this->ensureDirectoryExists($this->directory, $this->create);

        $file  = $this->computePath($key);
<<<<<<< HEAD
<<<<<<< HEAD
        $lines = ftp_rawlist($this->getConnection(), '-al ' . dirname($file));
=======
        $lines = ftp_rawlist($this->getConnection(), '-al ' . \Gaufrette\Util\Path::dirname($file));
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
        $lines = ftp_rawlist($this->getConnection(), '-al ' . dirname($file));
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889

        if (false === $lines) {
            return false;
        }

        $pattern = '{(?<!->) '.preg_quote(basename($file)).'( -> |$)}m';
        foreach ($lines as $line) {
            if (preg_match($pattern, $line)) {
                return true;
            }
        }

        return false;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function keys()
    {
        $this->ensureDirectoryExists($this->directory, $this->create);

        $keys = $this->fetchKeys();

        return $keys['keys'];
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function listKeys($prefix = '')
    {
        $this->ensureDirectoryExists($this->directory, $this->create);

        preg_match('/(.*?)[^\/]*$/', $prefix, $match);
        $directory = rtrim($match[1], '/');

        $keys = $this->fetchKeys($directory, false);

        if ($directory === $prefix) {
            return $keys;
        }

        $filteredKeys = array();
        foreach (array('keys', 'dirs') as $hash) {
            $filteredKeys[$hash] = array();
            foreach ($keys[$hash] as $key) {
                if (0 === strpos($key, $prefix)) {
                    $filteredKeys[$hash][] = $key;
                }
            }
        }

        return $filteredKeys;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function mtime($key)
    {
        $this->ensureDirectoryExists($this->directory, $this->create);

        $mtime = ftp_mdtm($this->getConnection(), $this->computePath($key));

        // the server does not support this function
        if (-1 === $mtime) {
            throw new \RuntimeException('Server does not support ftp_mdtm function.');
        }

        return $mtime;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function delete($key)
    {
        $this->ensureDirectoryExists($this->directory, $this->create);

        if ($this->isDirectory($key)) {
            return ftp_rmdir($this->getConnection(), $this->computePath($key));
        }

        return ftp_delete($this->getConnection(), $this->computePath($key));
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function isDirectory($key)
    {
        $this->ensureDirectoryExists($this->directory, $this->create);

        return $this->isDir($this->computePath($key));
    }

    /**
     * Lists files from the specified directory. If a pattern is
     * specified, it only returns files matching it.
     *
     * @param string $directory The path of the directory to list from
     *
     * @return array An array of keys and dirs
     */
    public function listDirectory($directory = '')
    {
        $this->ensureDirectoryExists($this->directory, $this->create);

        $directory = preg_replace('/^[\/]*([^\/].*)$/', '/$1', $directory);

        $items = $this->parseRawlist(
<<<<<<< HEAD
<<<<<<< HEAD
            ftp_rawlist($this->getConnection(), '-al ' . $this->directory . $directory ) ? : array()
=======
            ftp_rawlist($this->getConnection(), '-al '.$this->directory.$directory) ?: array()
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
            ftp_rawlist($this->getConnection(), '-al ' . $this->directory . $directory ) ? : array()
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        );

        $fileData = $dirs = array();
        foreach ($items as $itemData) {
<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======

>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
            if ('..' === $itemData['name'] || '.' === $itemData['name']) {
                continue;
            }

            $item = array(
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
                'name'  => $itemData['name'],
                'path'  => trim(($directory ? $directory . '/' : '') . $itemData['name'], '/'),
                'time'  => $itemData['time'],
                'size'  => $itemData['size'],
<<<<<<< HEAD
=======
                'name' => $itemData['name'],
                'path' => trim(($directory ? $directory.'/' : '').$itemData['name'], '/'),
                'time' => $itemData['time'],
                'size' => $itemData['size'],
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
            );

            if ('-' === substr($itemData['perms'], 0, 1)) {
                $fileData[$item['path']] = $item;
            } elseif ('d' === substr($itemData['perms'], 0, 1)) {
                $dirs[] = $item['path'];
            }
        }

        $this->fileData = array_merge($fileData, $this->fileData);

        return array(
<<<<<<< HEAD
<<<<<<< HEAD
           'keys'   => array_keys($fileData),
           'dirs'   => $dirs
=======
           'keys' => array_keys($fileData),
           'dirs' => $dirs,
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
           'keys'   => array_keys($fileData),
           'dirs'   => $dirs
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        );
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function createFile($key, Filesystem $filesystem)
    {
        $this->ensureDirectoryExists($this->directory, $this->create);

        $file = new File($key, $filesystem);

        if (!array_key_exists($key, $this->fileData)) {
<<<<<<< HEAD
<<<<<<< HEAD
            $directory = dirname($key) == '.' ? '' : dirname($key);
=======
            $dirname = \Gaufrette\Util\Path::dirname($key);
            $directory = $dirname == '.' ? '' : $dirname;
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
            $directory = dirname($key) == '.' ? '' : dirname($key);
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
            $this->listDirectory($directory);
        }

        if (isset($this->fileData[$key])) {
            $fileData = $this->fileData[$key];

            $file->setName($fileData['name']);
            $file->setSize($fileData['size']);
        }

        return $file;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Ensures the specified directory exists. If it does not, and the create
     * parameter is set to TRUE, it tries to create it
     *
     * @param string  $directory
     * @param boolean $create    Whether to create the directory if it does not
     *                         exist
<<<<<<< HEAD
=======
     * @param string $key
     *
     * @return int
     *
     * @throws \RuntimeException
     */
    public function size($key)
    {
        $this->ensureDirectoryExists($this->directory, $this->create);

        if (-1 === $size = ftp_size($this->connection, $key)) {
            throw new \RuntimeException(sprintf('Unable to fetch the size of "%s".', $key));
        }

        return $size;
    }

    /**
     * Ensures the specified directory exists. If it does not, and the create
     * parameter is set to TRUE, it tries to create it.
     *
     * @param string $directory
     * @param bool   $create    Whether to create the directory if it does not
     *                          exist
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @throws RuntimeException if the directory does not exist and could not
     *                          be created
     */
    protected function ensureDirectoryExists($directory, $create = false)
    {
        if (!$this->isDir($directory)) {
            if (!$create) {
                throw new \RuntimeException(sprintf('The directory \'%s\' does not exist.', $directory));
            }

            $this->createDirectory($directory);
        }
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Creates the specified directory and its parent directories
=======
     * Creates the specified directory and its parent directories.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Creates the specified directory and its parent directories
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @param string $directory Directory to create
     *
     * @throws RuntimeException if the directory could not be created
     */
    protected function createDirectory($directory)
    {
        // create parent directory if needed
<<<<<<< HEAD
<<<<<<< HEAD
        $parent = dirname($directory);
=======
        $parent = \Gaufrette\Util\Path::dirname($directory);
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
        $parent = dirname($directory);
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        if (!$this->isDir($parent)) {
            $this->createDirectory($parent);
        }

        // create the specified directory
        $created = ftp_mkdir($this->getConnection(), $directory);
        if (false === $created) {
            throw new \RuntimeException(sprintf('Could not create the \'%s\' directory.', $directory));
        }
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * @param  string  $directory - full directory path
     * @return boolean
=======
     * @param string $directory - full directory path
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * @param  string  $directory - full directory path
     * @return boolean
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    private function isDir($directory)
    {
        if ('/' === $directory) {
            return true;
        }

        if (!@ftp_chdir($this->getConnection(), $directory)) {
            return false;
        }

        // change directory again to return in the base directory
        ftp_chdir($this->getConnection(), $this->directory);

        return true;
    }

    private function fetchKeys($directory = '', $onlyKeys = true)
    {
        $directory = preg_replace('/^[\/]*([^\/].*)$/', '/$1', $directory);

<<<<<<< HEAD
<<<<<<< HEAD
        $lines = ftp_rawlist($this->getConnection(), '-alR '. $this->directory . $directory);
=======
        $lines = ftp_rawlist($this->getConnection(), '-alR '.$this->directory.$directory);
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
        $lines = ftp_rawlist($this->getConnection(), '-alR '. $this->directory . $directory);
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889

        if (false === $lines) {
            return array('keys' => array(), 'dirs' => array());
        }

<<<<<<< HEAD
<<<<<<< HEAD
        $regexDir = '/'.preg_quote($this->directory . $directory, '/').'\/?(.+):$/u';
=======
        $regexDir = '/'.preg_quote($this->directory.$directory, '/').'\/?(.+):$/u';
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
        $regexDir = '/'.preg_quote($this->directory . $directory, '/').'\/?(.+):$/u';
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        $regexItem = '/^(?:([d\-\d])\S+)\s+\S+(?:(?:\s+\S+){5})?\s+(\S+)\s+(.+?)$/';

        $prevLine = null;
        $directories = array();
        $keys = array('keys' => array(), 'dirs' => array());

        foreach ((array) $lines as $line) {
            if ('' === $prevLine && preg_match($regexDir, $line, $match)) {
                $directory = $match[1];
                unset($directories[$directory]);
                if ($onlyKeys) {
                    $keys = array(
                        'keys' => array_merge($keys['keys'], $keys['dirs']),
<<<<<<< HEAD
<<<<<<< HEAD
                        'dirs' => array()
=======
                        'dirs' => array(),
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
                        'dirs' => array()
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
                    );
                }
            } elseif (preg_match($regexItem, $line, $tokens)) {
                $name = $tokens[3];

                if ('.' === $name || '..' === $name) {
                    continue;
                }

<<<<<<< HEAD
<<<<<<< HEAD
                $path = ltrim($directory . '/' . $name, '/');
=======
                $path = ltrim($directory.'/'.$name, '/');
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
                $path = ltrim($directory . '/' . $name, '/');
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889

                if ('d' === $tokens[1] || '<dir>' === $tokens[2]) {
                    $keys['dirs'][] = $path;
                    $directories[$path] = true;
                } else {
                    $keys['keys'][] = $path;
                }
            }
            $prevLine = $line;
        }

        if ($onlyKeys) {
            $keys = array(
                'keys' => array_merge($keys['keys'], $keys['dirs']),
<<<<<<< HEAD
<<<<<<< HEAD
                'dirs' => array()
=======
                'dirs' => array(),
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
                'dirs' => array()
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
            );
        }

        foreach (array_keys($directories) as $directory) {
            $keys = array_merge_recursive($keys, $this->fetchKeys($directory, $onlyKeys));
        }

        return $keys;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Parses the given raw list
=======
     * Parses the given raw list.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Parses the given raw list
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @param array $rawlist
     *
     * @return array
     */
    private function parseRawlist(array $rawlist)
    {
        $parsed = array();
        foreach ($rawlist as $line) {
            $infos = preg_split("/[\s]+/", $line, 9);

            if ($this->isLinuxListing($infos)) {
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
                $infos[7] = (strrpos($infos[7], ':') != 2 ) ? ($infos[7] . ' 00:00') : (date('Y') . ' ' . $infos[7]);
                if ('total' !== $infos[0]) {
                    $parsed[] = array(
                        'perms' => $infos[0],
                        'num'   => $infos[1],
                        'size'  => $infos[4],
                        'time'  => strtotime($infos[5] . ' ' . $infos[6] . '. ' . $infos[7]),
                        'name'  => $infos[8]
                    );
                }
            } else {
                $isDir = (boolean) ('<dir>' === $infos[2]);
                $parsed[] = array(
                    'perms' => $isDir ? 'd' : '-',
                    'num'   => '',
                    'size'  => $isDir ? '' : $infos[2],
                    'time'  => strtotime($infos[0] . ' ' . $infos[1]),
                    'name'  => $infos[3]
<<<<<<< HEAD
=======
                $infos[7] = (strrpos($infos[7], ':') != 2) ? ($infos[7].' 00:00') : (date('Y').' '.$infos[7]);
                if ('total' !== $infos[0]) {
                    $parsed[] = array(
                        'perms' => $infos[0],
                        'num' => $infos[1],
                        'size' => $infos[4],
                        'time' => strtotime($infos[5].' '.$infos[6].'. '.$infos[7]),
                        'name' => $infos[8],
                    );
                }
            } elseif (count($infos) >= 4) {
                $isDir = (boolean) ('<dir>' === $infos[2]);
                $parsed[] = array(
                    'perms' => $isDir ? 'd' : '-',
                    'num' => '',
                    'size' => $isDir ? '' : $infos[2],
                    'time' => strtotime($infos[0].' '.$infos[1]),
                    'name' => $infos[3],
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
                );
            }
        }

        return $parsed;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Computes the path for the given key
=======
     * Computes the path for the given key.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Computes the path for the given key
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @param string $key
     */
    private function computePath($key)
    {
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        return rtrim($this->directory, '/') . '/' . $key;
    }

    /**
     * Indicates whether the adapter has an open ftp connection
     *
     * @return boolean
<<<<<<< HEAD
=======
        return rtrim($this->directory, '/').'/'.$key;
    }

    /**
     * Indicates whether the adapter has an open ftp connection.
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    private function isConnected()
    {
        return is_resource($this->connection);
    }

    /**
     * Returns an opened ftp connection resource. If the connection is not
<<<<<<< HEAD
<<<<<<< HEAD
     * already opened, it open it before
=======
     * already opened, it open it before.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * already opened, it open it before
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @return resource The ftp connection
     */
    private function getConnection()
    {
        if (!$this->isConnected()) {
            $this->connect();
        }

        return $this->connection;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Opens the adapter's ftp connection
=======
     * Opens the adapter's ftp connection.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Opens the adapter's ftp connection
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @throws RuntimeException if could not connect
     */
    private function connect()
    {
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        // open ftp connection
        if (!$this->ssl) {
            $this->connection = ftp_connect($this->host, $this->port);
        } else {
            if(function_exists('ftp_ssl_connect')) {
                $this->connection = ftp_ssl_connect($this->host, $this->port);        
            } else {
                throw new \RuntimeException('This Server Has No SSL-FTP Available.');
            }
        }
<<<<<<< HEAD
=======
        if ($this->ssl && !function_exists('ftp_ssl_connect')) {
            throw new \RuntimeException('This Server Has No SSL-FTP Available.');
        }

        // open ftp connection
        if (!$this->ssl) {
            $this->connection = ftp_connect($this->host, $this->port, $this->timeout);
        } else {
            $this->connection = ftp_ssl_connect($this->host, $this->port, $this->timeout);
        }

        if (PHP_VERSION_ID >= 50600) {
            ftp_set_option($this->connection, FTP_USEPASVADDRESS, false);
        }

>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        if (!$this->connection) {
            throw new \RuntimeException(sprintf('Could not connect to \'%s\' (port: %s).', $this->host, $this->port));
        }

<<<<<<< HEAD
<<<<<<< HEAD
        $username = $this->username ? : 'anonymous';
        $password = $this->password ? : '';
=======
        $username = $this->username ?: 'anonymous';
        $password = $this->password ?: '';
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
        $username = $this->username ? : 'anonymous';
        $password = $this->password ? : '';
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889

        // login ftp user
        if (!@ftp_login($this->connection, $username, $password)) {
            $this->close();
            throw new \RuntimeException(sprintf('Could not login as %s.', $username));
        }

        // switch to passive mode if needed
        if ($this->passive && !ftp_pasv($this->connection, true)) {
            $this->close();
            throw new \RuntimeException('Could not turn passive mode on.');
        }

<<<<<<< HEAD
<<<<<<< HEAD
=======
        // enable utf8 mode if configured
        if($this->utf8 == true) {
            ftp_raw($this->connection, "OPTS UTF8 ON");
        }

>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        // ensure the adapter's directory exists
        if ('/' !== $this->directory) {
            try {
                $this->ensureDirectoryExists($this->directory, $this->create);
            } catch (\RuntimeException $e) {
                $this->close();
                throw $e;
            }

            // change the current directory for the adapter's directory
            if (!ftp_chdir($this->connection, $this->directory)) {
                $this->close();
                throw new \RuntimeException(sprintf('Could not change current directory for the \'%s\' directory.', $this->directory));
            }
        }
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Closes the adapter's ftp connection
=======
     * Closes the adapter's ftp connection.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Closes the adapter's ftp connection
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    private function close()
    {
        if ($this->isConnected()) {
            ftp_close($this->connection);
        }
    }

    private function isLinuxListing($info)
    {
        return count($info) >= 9;
    }
}
