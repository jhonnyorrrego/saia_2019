<?php
require_once "StorageUtils.php";
require_once 'SaiaLocalAdapter.php';

use Gaufrette\Filesystem;
use Aws\S3\S3Client;
use Gaufrette\Adapter\AwsS3 as AwsS3Adapter;
use Gaufrette\Adapter\GoogleCloudStorage;
use Gaufrette\Adapter\Ftp as FtpAdapter;

use Stringy\Stringy;
use Stringy\StaticStringy as StringUtils;
use Gaufrette\Adapter\SaiaLocalAdapter as Local;

class SaiaStorage
{

    private $tipo;

    private $adapter;

    private $filesystem;

    private $ruta_servidor;

    private $opciones_ftp;

    public function __construct($tipo = null)
    {
        $this->tipo = $tipo;
        if ($tipo) {
            $this->__init();
        }
    }

    /**
     * Debe devolver la ruta de almacenamiento, asegurando que el directorio exista
     *
     * @param unknown $tipo
     * @return string
     */
    public function __init()
    {
        $path = "";
        switch ($this->tipo) {
            case 'archivos':
                $server_path = RUTA_ARCHIVOS;
                break;
            case 'pdf':
                $server_path = RUTA_PDFS;
                break;
            case 'imagenes':
                $server_path = RUTA_IMAGENES;
                break;
            case 'versiones':
                $server_path = RUTA_VERSIONES;
                break;
            case 'configuracion':
                $server_path = RUTA_CONFIGURACION;
                break;
            case 'backup':
                $server_path = RUTA_BACKUP;
                break;
            case 'bpmn':
                $server_path = RUTA_ARCHIVOS_BPMN;
                break;
            case 'anexos_tareas':
                $server_path = RUTA_ANEXOS_TAREAS;
                break;
            case 'anexos_flujos':
                $server_path = RUTA_ANEXOS_FLUJOS;
                break;
            default:
                // Usar el tipo. Ej. BACKUP
                $server_path = $this->tipo;
        }
        $this->resolver_adaptador($server_path);
    }

    public function resolver_adaptador($server_path)
    {
        $str_path = Stringy::create($server_path);
        $storage_type = $str_path->first($str_path->indexOf("://"))->ensureRight("://");

        $ruta_resuelta = $server_path;
        // $path = $str_path->removeLeft($storage_type);
        $path = Stringy::create($server_path)->removeLeft($storage_type);
        // print_r($path);die();
        switch ($storage_type) {
            case StorageUtils::LOCAL:
            case StorageUtils::NETWORK:
                $root = $_SERVER["DOCUMENT_ROOT"] . StorageUtils::SEPARADOR . CONTENEDOR_SAIA;
                if (StringUtils::startsWith($path, "..")) {
                    $path = $path->trimLeft(".." . StorageUtils::SEPARADOR)
                        ->removeRight(StorageUtils::SEPARADOR)
                        ->ensureLeft(StorageUtils::SEPARADOR);
                    $this->adapter = new Local($root . $path, true, 0777);
                } else {
                    $this->adapter = new Local($path, true, 0777);
                }
                break;
            case StorageUtils::GOOGLE:
                $this->adapter = $this->obtener_google_adapter();
                break;
            case StorageUtils::S3:
                $s3client = new S3Client([
                    'credentials' => [
                        'key' => KEY_AWS,
                        'secret' => SECRET_AWS
                    ],
                    'version' => 'latest',
                    'region' => REGION_AWS
                ]);
                $path = $path->removeRight(StorageUtils::SEPARADOR);
                $rutas = $path->split('/', 2);
                $balde = $path;
                $opciones = array(
                    'create' => false,
                    'directory' => '',
                    'acl' => 'private'
                );
                if (count($rutas)) {
                    $balde = $rutas[0]->__toString();
                    if (count($rutas) > 1) {
                        $rutas = explode('/', $path->__toString());
                        unset($rutas[0]);
                        $opciones['directory'] = implode("/", $rutas);
                    }
                }
                $this->adapter = new AwsS3Adapter($s3client, $balde, $opciones);
                break;
            case StorageUtils::FTP:
                if (empty($this->opciones_ftp)) {
                    throw new \Exception("No ha definido las opciones para FTP");
                }
                $datos_ftp = parse_url($server_path);
                if (empty($datos_ftp["path"]) || empty($datos_ftp["host"])) {
                    throw new \Exception("No ha definido las opciones para FTP");
                }
                // $datos_ftp["scheme"]; // ftp
                if (!empty($datos_ftp["user"])) {
                    $this->opciones_ftp['username'] = $datos_ftp["user"];
                }
                if (!empty($datos_ftp["pass"])) {
                    $this->opciones_ftp['password'] = $datos_ftp["pass"];
                }
                if (!empty($datos_ftp["port"])) {
                    $this->opciones_ftp['port'] = $datos_ftp["port"];
                }
                $this->adapter = new FtpAdapter($datos_ftp["path"], $datos_ftp["host"], $this->opciones_ftp);
                $ruta_resuelta = $datos_ftp["scheme"] . "://" . $datos_ftp["host"] . "/" . $datos_ftp["path"];
                break;
            default:
                $this->adapter = new Local($path, true, 0777);
                break;
        }
        $this->ruta_servidor = $ruta_resuelta;

        if ($this->adapter) {
            $this->filesystem = new Filesystem($this->adapter);
        }
    }

    /**
     * Segundo constructor a partir de una ruta_servidor
     *
     * @param unknown $server_path
     * @return SaiaStorage
     */
    public static function con_ruta_servidor($server_path)
    {
        // debug_print_backtrace();
        $instance = new self();
        $instance->resolver_adaptador($server_path);
        return $instance;
    }

    /**
     * Guarda $contenido del archivo $temp en el almacenamiento especificado por $tipo y en la ruta $ruta_recurso
     *
     * @param string $ruta_recurso
     * @param string $temp
     * @param string $md5
     * @return string|number
     */
    public function almacenar_recurso($ruta_recurso, $temp, $md5 = false)
    {
        // print_r($filesystem);die();
        $adapter = new Local(dirname($temp));
        $content = $adapter->read(basename($temp));
        $numbytes = $this->filesystem->write($ruta_recurso, $content, true);
        if ($md5) {
            $checksum = $this->filesystem->checksum($ruta_recurso);
            return $checksum;
        }
        return $numbytes;
    }

    /**
     * Guarda $contenido en el almacenamiento especificado por $tipo y en la ruta $ruta_recurso
     *
     * @param unknown $tipo
     * @param unknown $ruta_recurso
     * @param unknown $contenido
     * @return integer Numero de bytes que fueron escriton en el archvio $ruta_recurso
     */
    public function almacenar_contenido($ruta_recurso, $contenido)
    {
        // print_r($filesystem);die();
        return $this->filesystem->write($ruta_recurso, $contenido, true);
    }

    /**
     * Copia el contenido desde una ruta externa al almacenamiento $tipo_destino en la ruta indicada por $ruta_recurso
     *
     * @param string $ruta_origen
     * @param string $ruta_recurso
     *            ruta relativa al recurso dentro del almacenamiento
     * @return number. Cantidad de bytes escritos
     */
    public function copiar_contenido_externo($ruta_origen, $ruta_recurso)
    {
        $contenido = file_get_contents($ruta_origen);
        $num_bytes = $this->filesystem->write($ruta_recurso, $contenido, true);
        return $num_bytes;
    }

    /**
     * Copia desde este almacenamiento el contenido de ruta_origen al alm_destino en ruta_destino
     *
     * @param unknown $alm_destino
     * @param unknown $ruta_origen
     * @param unknown $ruta_destino
     */
    public function copiar_contenido($alm_destino, $ruta_origen, $ruta_destino)
    {
        if ($this->filesystem->has($ruta_origen)) {
            $content = $this->filesystem->read($ruta_origen);
            $numbytes = $alm_destino->filesystem->write($ruta_destino, $content, true);
            return $numbytes;
        } else {
            return false;
        }
    }

    private function completar_ruta($filesystem1, $ruta_origen)
    {
        $ruta1 = Stringy::create($filesystem1->getAdapter()->getDirectory())->ensureRight(StorageUtils::SEPARADOR);
        $ruta2 = Stringy::create(dirname($ruta_origen))->removeLeft(StorageUtils::SEPARADOR);
        $adapter = new Local($ruta1->append($ruta2));
        return $adapter;
    }

    public function eliminar($ruta_origen)
    {
        if ($this->filesystem->has($ruta_origen)) {
            return $content = $this->filesystem->delete($ruta_origen);
        }
        return false;
    }

    public function renombrar($sourceKey, $targetKey)
    {
        if ($this->filesystem->has($sourceKey)) {
            $this->filesystem->rename($sourceKey, $targetKey);
        }
    }

    /**
     * verifica si el archivo existe en la ruta especificada dentro de este almacenamiento
     *
     * @param string $sourceKey
     * @return boolean
     */
    public function existe_archivo($sourceKey)
    {
        return $this->filesystem->has($sourceKey);
    }

    /**
     * Devuelve el filesystem de este almacenamiento
     *
     * @return \Gaufrette\Filesystem
     */
    public function get_filesystem()
    {
        return $this->filesystem;
    }

    /**
     * Devuelve la ruta absoluta usada por el almacenamiento
     *
     * @return string
     */
    public function get_ruta()
    {
        return $this->adapter->getDirectory();
    }

    /**
     * Devuelve la ruta relativa
     *
     * @return string
     */
    public function get_ruta_servidor()
    {
        $cad = Stringy::create($this->ruta_servidor)->ensureRight(StorageUtils::SEPARADOR);
        return (string) $cad;
    }

    private function obtener_google_adapter()
    {
        $client = new \Google_Client();
        $client->setClientId('xxxxxxxxxxxxxxx.apps.googleusercontent.com');
        $client->setApplicationName('Gaufrette');

        $cred = new \Google_Auth_AssertionCredentials('xxxxxxxxxxxxxxx@developer.gserviceaccount.com', array(
            \Google_Service_Storage::DEVSTORAGE_FULL_CONTROL
        ), file_get_contents('key.p12'));
        $client->setAssertionCredentials($cred);
        if ($client->getAuth()->isAccessTokenExpired()) {
            $client->getAuth()->refreshTokenWithAssertion($cred);
        }

        $service = new \Google_Service_Storage($client);
        $adapter = new Gaufrette\Adapter\GoogleCloudStorage($service, $config['gcsBucket'], array(
            'acl' => 'public'
        ), true);
        return $adapter;
    }

    public function set_opciones_ftp($opciones_ftp)
    {
        $this->opciones_ftp = $opciones_ftp;
    }
}
