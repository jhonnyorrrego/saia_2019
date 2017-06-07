<<<<<<< HEAD
<?php
require_once ("define.php");

require ('vendor/autoload.php');
require_once 'filesystem/SaiaLocalAdapter.php';
require_once 'filesystem/SaiaStorage.php';

use Gaufrette\Filesystem;

use Stringy\Stringy as String;
use Stringy\StaticStringy as StringUtils;
use Gaufrette\Adapter\SaiaLocalAdapter as Local;

use Gaufrette\Adapter\InMemory;
use Gaufrette\StreamWrapper;

class StorageUtils {
	const LOCAL = 'local://';
	const NETWORK = 'net://';
	const GOOGLE = 'gc://';
	const S3 = 's3://';

	/**
	 * Debe devolver la ruta de almacenamiento, asegurando que el directorio exista
	 *
	 * @param unknown $tipo
	 * @return string
	 */
	public static function get_storage_path($tipo, $cadena = false) {
		$path = "";
		switch ($tipo) {
			case 'archivos' :
				$server_path = RUTA_ARCHIVOS;
				break;
			case 'pdf' :
				$server_path = RUTA_PDFS;
				break;
			case 'imagenes' :
				$server_path = RUTA_IMAGENES;
				break;
			case 'versiones' :
				$server_path = RUTA_VERSIONES;
				break;
			default : // Usar el tipo. Ej. BACKUP
				$server_path = $this->tipo;
		}

		$filesystem = static::ensure_dir_exists($server_path);
		if ($cadena) {
			return $filesystem->getAdapter()->getDirectory();
		}
		return $filesystem;
	}

	/**
	 *
	 * @param string $vector_ruta.
	 *        	cadena json con la sintaxis: {servidor:"local://ruta/al/servidor", ruta:"ruta/al/archivo.ext"}
	 * @return binary (contenido del archivo)
	 */
	public static function get_binary_file($vector_ruta) {
		// print_r($_REQUEST);die();
		$tcpdf = @$_REQUEST["tipo"] == 5;
		$resolver_ruta = static::resolver_ruta($vector_ruta);
		$ruta = $resolver_ruta['ruta'];
		$type = $resolver_ruta['clase']->get_filesystem()->mimeType($ruta);
		$contenido_binario = $resolver_ruta['clase']->get_filesystem()->read($ruta);
		switch ($type) {
			case 'image/png' :
			case 'image/jpeg' :
				if ($tcpdf) {
					$wtf = "@";
				} else {
					$wtf = "data:$type;base64,";
				}
				$contenido_binario = base64_encode($contenido_binario);
				$contenido_binario = $wtf . $contenido_binario;
				break;
		}
		return ($contenido_binario);
	}

	/**
	 * Devuelve el contenido del archivo en un almacenamiento como una cadena binaria
	 * @param unknown $vector_ruta
	 * @return unknown
	 */
	public static function get_file_content($vector_ruta) {
		$resolver_ruta = static::resolver_ruta($vector_ruta);
		$ruta = $resolver_ruta['ruta'];
		$clase = $resolver_ruta['clase'];
		$contenido_binario = $clase->get_filesystem()->read($ruta);
		return ($contenido_binario);
	}

	private static function ensure_dir_exists($destino) {
		$adapter = null;
		$mi_ruta = String::create(__DIR__);
		$root = $_SERVER["DOCUMENT_ROOT"];
		// $resto = $mi_ruta->removeLeft($root)->removeRight(DIRECTORY_SEPARATOR . "saia");
		$resto = DIRECTORY_SEPARATOR . RUTA_SCRIPT;

		$root .= $resto;

		$str_path = String::create($destino);
		$storage_type = $str_path->first($str_path->indexOf("://"))->ensureRight("://");
		$path = $str_path->removeLeft($storage_type);

		switch ($storage_type) {
			case StorageUtils::LOCAL :
			case StorageUtils::NETWORK :
				if (StringUtils::startsWith($path, "..")) {
					$path = String::create($path)->trimLeft(".." . DIRECTORY_SEPARATOR)->removeRight(DIRECTORY_SEPARATOR)->ensureLeft(DIRECTORY_SEPARATOR);
					$adapter = new Local($root . $path, true, 0777);
				} else {
					$adapter = new Local($path, true, 0777);
				}
				break;
			case StorageUtils::GOOGLE :
				$adapter = obtener_google_adapter();
				break;
			case StorageUtils::S3 :
				$s3client = S3Client::factory(array(
						'key' => 'your_key_here',
						'secret' => 'your_secret',
						'version' => 'latest',
						'region' => 'eu-west-1'
				));
				$adapter = new AwsS3Adapter($s3client, $path);
				break;
			default :
				$adapter = new Local($path, true, 0777);
		}
		if ($adapter) {
			return new Filesystem($adapter);
		}
		return null;
	}

	/**
	 * Resuelve el tipo de almacenamiento a partir de una ruta
	 *
	 * @param string $path
	 * @return array con los datos de la ruta
	 */
	public static function resolver_ruta($path) {
		$ruta = json_decode($path);
		$resp = array(
				"error" => true
		);

		$almacenamiento = null;
		if (json_last_error() === JSON_ERROR_NONE) {
			// JSON is valid
			$almacenamiento = SaiaStorage::con_ruta_servidor($ruta->servidor);
			$resp["servidor"] = $ruta->servidor;
			$resp["ruta"] = $ruta->ruta;
			$resp["error"] = false;
		} else {
			$constantes = array();
			foreach (get_defined_constants() as $k => $value) {
				if ($k === "RUTA_DISCO") {
					continue;
				}
				if(substr($k, 0, 5) === "RUTA_") {
					$constantes[$k] = $value;
				}
			}

			$str_path = String::create($path);
			$posibles = array();
			foreach ( $constantes as $key => $value ) {
				if ($str_path->startsWith($value)) {
					$posibles[] = $value;
				} else {
					$str_const = String::create($value);
					if ($str_const->contains("://")) {
						$storage_type = $str_const->first($str_const->indexOf("://"))->ensureRight("://");
						$otra_ruta = $str_const->removeLeft($storage_type);
						if ($str_path->startsWith($otra_ruta)) {
							$posibles[] = $str_const;
						}
					}
				}
			}

			$lengths = array_map('strlen', $posibles);
			$maxLength = max($lengths);
			$index = array_search($maxLength, $lengths);
			if (@$posibles[$index]) {
				$mejor_opcion = $posibles[$index];
				$almacenamiento = new SaiaStorage($mejor_opcion);
				$resp["servidor"] = $mejor_opcion;
				$resp["ruta"] = (string) $str_path->trimLeft($mejor_opcion);
				$resp["error"] = false;
			} else {
				// print_r($path); echo "<br>";print_r($posibles[$index]);echo "<br>";
				// print_r($posibles);die();
				$resp["mensaje"] = "No se encontro la ruta_servidor";
			}
		}
		$resp["clase"] = $almacenamiento;
		return $resp;
	}

	/**
	 * Devuelve un almacenamiento temporal viable.
	 * Si no se encuentra uno en el fs se crear en $usr_temp o en saia/temporal
	 *
	 * @param unknown $prefix
	 * @param unknown $usr_temp
	 * @return boolean
	 */
	public static function obtener_archivo_temporal($prefix, $usr_temp = null) {
		$ruta_db_superior = __DIR__;
		if (! empty($prefix)) {
			$nombre_temporal = uniqid($prefix);
		} else {
			$nombre_temporal = uniqid();
		}
		$archivo_temporal = false;
		if (is_writable(sys_get_temp_dir())) {
			$archivo_temporal = tempnam(sys_get_temp_dir(), $nombre_temporal);
		}
		if ($archivo_temporal === false) {
			// buscar en el sistema una ruta donde se pueda escribir
			if (is_writable(ini_get('upload_tmp_dir'))) {
				$archivo_temporal = tempnam(ini_get('upload_tmp_dir'), $nombre_temporal);
			}
		}
		if ($archivo_temporal === false) {
			if ($usr_temp) {
				if (is_writable($usr_temp)) {
					$archivo_temporal = tempnam($usr_temp, $nombre_temporal);
				}
			} else {
				if (is_writable($ruta_db_superior . DIRECTORY_SEPARATOR . "temporal")) {
					$archivo_temporal = tempnam($ruta_db_superior . DIRECTORY_SEPARATOR . "temporal", $nombre_temporal);
				}
			}
		}
		if ($archivo_temporal === false) {
			$archivo_temporal = tempnam(sys_get_temp_dir(), $nombre_temporal);
		}
		return $archivo_temporal;
	}

	/**
	 * Devuelve
	 * @return string
	 */
	public static function obtener_tempdir() {
		$tempfile = tempnam(sys_get_temp_dir(), '');
		if (file_exists($tempfile)) {
			unlink($tempfile);
		}
		mkdir($tempfile, 0777);
		if (is_dir($tempfile)) {
			return $tempfile;
		}
		return null;
	}

	public static function get_app_root() {
		$abspath = __DIR__;
		$docRoot = rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR);
		$dir = substr($abspath, strlen($docRoot));

		$app_root = $docRoot;

		$rutas = new ArrayObject(explode(DIRECTORY_SEPARATOR, ltrim($dir, DIRECTORY_SEPARATOR)));
		for($it = $rutas->getIterator(); $it->valid(); $it->next()) {
			// echo $it->key() . "=" . $it->current() . "<br>";
			$app_root .= DIRECTORY_SEPARATOR . $it->current();
			if (is_file($app_root . DIRECTORY_SEPARATOR . "db.php")) {
				break;
			}
		}
		return $app_root;
	}

	public static function get_memory_filesystem($root, $scheme = null) {
		$memory_filesystem = new Filesystem(new InMemory(array()));

		$filesystemMap = StreamWrapper::getFilesystemMap();
		$filesystemMap->set($root, $memory_filesystem);
		StreamWrapper::register($scheme);
		return $memory_filesystem;
	}
}
=======
<?php
require_once ("define.php");

require ('vendor/autoload.php');
require_once 'filesystem/SaiaLocalAdapter.php';
require_once 'filesystem/SaiaStorage.php';

use Gaufrette\Filesystem;

use Stringy\Stringy as String;
use Stringy\StaticStringy as StringUtils;
use Gaufrette\Adapter\SaiaLocalAdapter as Local;

use Gaufrette\Adapter\InMemory;
use Gaufrette\StreamWrapper;

class StorageUtils {
	const LOCAL = 'local://';
	const NETWORK = 'net://';
	const GOOGLE = 'gc://';
	const S3 = 's3://';

	const SEPARADOR = "/"; //DIRECTORY_SEPARATOR

	/**
	 * Debe devolver la ruta de almacenamiento, asegurando que el directorio exista
	 *
	 * @param unknown $tipo
	 * @return string
	 */
	public static function get_storage_path($tipo, $cadena = false) {
		$path = "";
		switch ($tipo) {
			case 'archivos' :
				$server_path = RUTA_ARCHIVOS;
				break;
			case 'pdf' :
				$server_path = RUTA_PDFS;
				break;
			case 'imagenes' :
				$server_path = RUTA_IMAGENES;
				break;
			case 'versiones' :
				$server_path = RUTA_VERSIONES;
				break;
			default : // Usar el tipo. Ej. BACKUP
				$server_path = $this->tipo;
		}

		$filesystem = static::ensure_dir_exists($server_path);
		if ($cadena) {
			return $filesystem->getAdapter()->getDirectory();
		}
		return $filesystem;
	}

	/**
	 *
	 * @param string $vector_ruta.
	 *        	cadena json con la sintaxis: {servidor:"local://ruta/al/servidor", ruta:"ruta/al/archivo.ext"}
	 * @return binary (contenido del archivo)
	 */
	public static function get_binary_file($vector_ruta){
		//print_r($_REQUEST);die();
		$tcpdf = @$_REQUEST["tipo"] == 5;
		$resolver_ruta=static::resolver_ruta($vector_ruta);
		$ruta=$resolver_ruta['ruta'];
		$type=$resolver_ruta['clase']->get_filesystem()->mimeType($ruta);
		$contenido_binario = $resolver_ruta['clase']->get_filesystem()->read($ruta);
		switch($type){
			case 'image/png':
			case 'image/jpeg':
				if($tcpdf) {
					$wtf = "@";
				} else {
					$wtf = "data:$type;base64,";
				}
				$contenido_binario=base64_encode($contenido_binario);
				$contenido_binario=$wtf.$contenido_binario;
				break;
		}
		return($contenido_binario);
	}

	/**
	 * Devuelve el contenido del archivo en un almacenamiento como una cadena binaria
	 * @param unknown $vector_ruta
	 * @return unknown
	 */
	public static function get_file_content($vector_ruta) {
		$resolver_ruta = static::resolver_ruta($vector_ruta);
		$ruta = $resolver_ruta['ruta'];
		$clase = $resolver_ruta['clase'];
		$contenido_binario = $clase->get_filesystem()->read($ruta);
		return ($contenido_binario);
	}

	private static function ensure_dir_exists($destino) {
		$adapter = null;
		$mi_ruta = String::create(__DIR__);
		$root = $_SERVER["DOCUMENT_ROOT"];
		// $resto = $mi_ruta->removeLeft($root)->removeRight(self::SEPARADOR . "saia");
		$resto = self::SEPARADOR . RUTA_SCRIPT;

		$root .= $resto;

		$str_path = String::create($destino);
		$storage_type = $str_path->first($str_path->indexOf("://"))->ensureRight("://");
		$path = $str_path->removeLeft($storage_type);

		switch ($storage_type) {
			case self::LOCAL :
			case self::NETWORK :
				if (StringUtils::startsWith($path, "..")) {
					$path = String::create($path)->trimLeft(".." . self::SEPARADOR)->removeRight(self::SEPARADOR)->ensureLeft(self::SEPARADOR);
					$adapter = new Local($root . $path, true, 0777);
				} else {
					$adapter = new Local($path, true, 0777);
				}
				break;
			case self::GOOGLE :
				$adapter = obtener_google_adapter();
				break;
			case self::S3 :
				$s3client = S3Client::factory(array(
						'key' => 'your_key_here',
						'secret' => 'your_secret',
						'version' => 'latest',
						'region' => 'eu-west-1'
				));
				$adapter = new AwsS3Adapter($s3client, $path);
				break;
			default :
				$adapter = new Local($path, true, 0777);
		}
		if ($adapter) {
			return new Filesystem($adapter);
		}
		return null;
	}

	/**
	 * Resuelve el tipo de almacenamiento a partir de una ruta
	 *
	 * @param string $path
	 * @return array con los datos de la ruta
	 */
	public static function resolver_ruta($path) {
		$resp = array(
				"error" => true
		);

		$ruta = String::create($path);

		$almacenamiento = null;
		if ($ruta->isJson()) {
			$rutaj = json_decode($path);
			$almacenamiento = SaiaStorage::con_ruta_servidor($rutaj->servidor);
			$resp["servidor"] = $rutaj->servidor;
			$resp["ruta"] = $rutaj->ruta;
			$resp["error"] = false;
		} else {
			$resp["mensaje"] = "la cadena '$path' no es json" ;
			$constantes = array();
			foreach (get_defined_constants() as $k => $value) {
				if ($k === "RUTA_DISCO") {
					continue;
				}
				if(substr($k, 0, 5) === "RUTA_"){
					$constantes[$k] = $value;
				}
			}

			$str_path = String::create($path);
			$posibles = array();
			foreach ( $constantes as $key => $value ) {
				if ($str_path->startsWith($value)) {
					$posibles[] = $value;
				} else {
					$str_const = String::create($value);
					if($str_const->contains("://")) {
						$storage_type = $str_const->first($str_const->indexOf("://"))->ensureRight("://");
						$otra_ruta = $str_const->removeLeft($storage_type);
						if($str_path->startsWith($otra_ruta)) {
							$posibles[] = $str_const;
						}
					}
				}
			}

			$lengths = array_map('strlen', $posibles);
			$maxLength = max($lengths);
			$index = array_search($maxLength, $lengths);
			if (@$posibles[$index]) {
				$mejor_opcion = $posibles[$index];
				$almacenamiento = new SaiaStorage($mejor_opcion);
				$resp["servidor"] = $mejor_opcion;
				$resp["ruta"] = (string)$str_path->trimLeft($mejor_opcion);
				$resp["error"] = false;
			} else {
				//print_r($path); echo "<br>";print_r($posibles[$index]);echo "<br>";
				//print_r($posibles);die();
				$resp["mensaje"] = "No se encontro la ruta_servidor";
			}
		}
		$resp["clase"] = $almacenamiento;
		return $resp;
	}

	/**
	 * Devuelve un almacenamiento temporal viable.
	 * Si no se encuentra uno en el fs se crear en $usr_temp o en saia/temporal
	 *
	 * @param unknown $prefix
	 * @param unknown $usr_temp
	 * @return boolean
	 */
	public static function obtener_archivo_temporal($prefix, $usr_temp = null) {
		$ruta_db_superior = __DIR__;
		if (! empty($prefix)) {
			$nombre_temporal = uniqid($prefix);
		} else {
			$nombre_temporal = uniqid();
		}
		$archivo_temporal = false;
		if (is_writable(sys_get_temp_dir())) {
			$archivo_temporal = tempnam(sys_get_temp_dir(), $nombre_temporal);
		}
		if ($archivo_temporal === false) {
			// buscar en el sistema una ruta donde se pueda escribir
			if (is_writable(ini_get('upload_tmp_dir'))) {
				$archivo_temporal = tempnam(ini_get('upload_tmp_dir'), $nombre_temporal);
			}
		}
		if ($archivo_temporal === false) {
			if ($usr_temp) {
				if (is_writable($usr_temp)) {
					$archivo_temporal = tempnam($usr_temp, $nombre_temporal);
				}
			} else {
				if (is_writable($ruta_db_superior . self::SEPARADOR . "temporal")) {
					$archivo_temporal = tempnam($ruta_db_superior . self::SEPARADOR . "temporal", $nombre_temporal);
				}
			}
		}
		if ($archivo_temporal === false) {
			$archivo_temporal = tempnam(sys_get_temp_dir(), $nombre_temporal);
		}
		return $archivo_temporal;
	}

	/**
	 * Devuelve
	 * @return string
	 */
	public static function obtener_tempdir() {
		$tempfile = tempnam(sys_get_temp_dir(), '');
		if (file_exists($tempfile)) {
			unlink($tempfile);
		}
		mkdir($tempfile, 0777);
		if (is_dir($tempfile)) {
			return $tempfile;
		}
		return null;
	}

	public static function get_app_root() {
		$abspath = __DIR__;
		$docRoot = rtrim($_SERVER['DOCUMENT_ROOT'], self::SEPARADOR);
		$dir = substr($abspath, strlen($docRoot));

		$app_root = $docRoot;

		$rutas = new ArrayObject(explode(self::SEPARADOR, ltrim($dir, self::SEPARADOR)));
		for($it = $rutas->getIterator(); $it->valid(); $it->next()) {
			// echo $it->key() . "=" . $it->current() . "<br>";
			$app_root .= self::SEPARADOR . $it->current();
			if (is_file($app_root . self::SEPARADOR . "db.php")) {
				break;
			}
		}
		return $app_root;
	}

	public static function get_memory_filesystem($root, $scheme=null) {
		$memory_filesystem = new Filesystem(new InMemory(array()));

		$filesystemMap = StreamWrapper::getFilesystemMap();
		$filesystemMap->set($root, $memory_filesystem);
		StreamWrapper::register($scheme);
		return $memory_filesystem;
	}
}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
