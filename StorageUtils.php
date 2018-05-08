<?php
require_once ("define.php");

require ('vendor/autoload.php');
require_once 'filesystem/SaiaLocalAdapter.php';
require_once 'filesystem/SaiaStorage.php';

use Gaufrette\Adapter\SaiaLocalAdapter as Local;
use Gaufrette\Filesystem;
use Aws\S3\S3Client;
use Gaufrette\Adapter\AwsS3 as AwsS3Adapter;
use Gaufrette\Adapter\GoogleCloudStorage;
use Gaufrette\Adapter\InMemory;
use Gaufrette\StreamWrapper;

use Stringy\Stringy as String;
use Stringy\StaticStringy as StringUtils;

use Imagine\Image\Palette\RGB;
use Imagine\Image\Box;

class StorageUtils {
	const LOCAL = 'local://';
	const NETWORK = 'net://';
	const GOOGLE = 'gc://';
	const S3 = 's3://';
	const FTP = 'ftp://';

	const SEPARADOR = "/";
	//DIRECTORY_SEPARATOR

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
			case 'configuracion' :
				$server_path = RUTA_CONFIGURACION;
				break;
			case 'backup' :
				$server_path = RUTA_BACKUPS;
				break;
			case 'bpmn' :
				$server_path = RUTA_ARCHIVOS_BPMN;
				break;
			case 'ayuda' :
				$server_path = RUTA_AYUDA;
				break;
			default :
				//Usar el tipo. Ej. BACKUP
				$server_path = $tipo;
		}
		
		$filesystem = static::ensure_dir_exists($server_path);
		if ($cadena) {
			return $filesystem -> getAdapter() -> getDirectory();
		}
		return $filesystem;
	}

	/**
	 *
	 * @param string $vector_ruta.
	 *        	cadena json con la sintaxis: {servidor:"local://ruta/al/servidor", ruta:"ruta/al/archivo.ext"}
	 * @return binary (contenido del archivo)
	 */
	public static function get_binary_file($vector_ruta, $img_blanco = true) {
		$pdf = @$_REQUEST["tipo"] == 5;
		$tipo_pdf = $_REQUEST['tipo_pdf'];
		$resolver_ruta = static::resolver_ruta($vector_ruta);
		$ruta = $resolver_ruta['ruta'];
		$tipo_almacenamiento = $resolver_ruta['clase'];
		try {
			$type = $tipo_almacenamiento -> get_filesystem() -> mimeType($ruta);
		} catch (Exception $le) {
			$type = false;
		}

		if ($tipo_almacenamiento -> get_filesystem() -> has($ruta)) {
			$contenido_binario = $tipo_almacenamiento -> get_filesystem() -> read($ruta);
		} else if ($img_blanco) {
			$imagine = new Imagine\Gd\Imagine();
			$size = new Imagine\Image\Box(100, 100);
			$image = $imagine -> create($size);
			$contenido_binario = $image -> get("png");
		} else {
			return false;
		}
		if (!$type) {
			$finfo = new finfo(FILEINFO_MIME_TYPE);
			$type = $finfo -> buffer($contenido_binario);
		}
		switch ($type) {
			case 'image/png' :
			case 'image/jpeg' :
				if ($pdf) {
					if ($tipo_pdf == 'tcpdf') {
						$wtf = "@";
					} else if ($tipo_pdf == 'mpdf') {
						$wtf = "data:$type;base64,";
					}
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
		$contenido_binario = false;
		$resolver_ruta = static::resolver_ruta($vector_ruta);
		if ($resolver_ruta["error"] === false) {
			$ruta = $resolver_ruta['ruta'];
			$clase = $resolver_ruta['clase'];
			$contenido_binario = $clase -> get_filesystem() -> read($ruta);
		}
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
		$storage_type = $str_path -> first($str_path -> indexOf("://")) -> ensureRight("://");
		$path = $str_path -> removeLeft($storage_type);

		switch ($storage_type) {
			case self::LOCAL :
			case self::NETWORK :
				if (StringUtils::startsWith($path, "..")) {
					$path = String::create($path) -> trimLeft(".." . self::SEPARADOR) -> removeRight(self::SEPARADOR) -> ensureLeft(self::SEPARADOR);
					$adapter = new Local($root . $path, true, 0777);
				} else {
					$adapter = new Local($path, true, 0777);
				}
				break;
			case self::GOOGLE :
				$adapter = obtener_google_adapter();
				break;
			case self::S3 :
				$s3client = new S3Client([
				'credentials' => [
				'key' => KEY_AWS,
				'secret' => SECRET_AWS, ],
				'version' => 'latest',
				'region' => REGION_AWS, ]);
				$path = String::create($path) -> removeRight(StorageUtils::SEPARADOR);
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
		$resp = array("error" => true);

		$ruta = String::create($path);

		$almacenamiento = null;
		if ($ruta -> isJson()) {
			$rutaj = json_decode($path);
			/*$ruta_resuelta = static::parsear_ruta_servidor($rutaj->servidor);
			 $rutaj->servidor = (string)$ruta_resuelta["servidor"];
			 if(!empty($ruta_resuelta["ruta"])) {
			 $ruta_compuesta = String::create($ruta_resuelta["ruta"]);
			 $rutaj->ruta = (string)$ruta_compuesta->ensureRight(static::SEPARADOR)->append($rutaj->ruta);
			 }*/
			$almacenamiento = SaiaStorage::con_ruta_servidor($rutaj -> servidor);
			$resp["servidor"] = $rutaj -> servidor;
			$resp["ruta"] = (string)$rutaj -> ruta;
			$resp["error"] = false;
			//print_r($resp);die("<==== Resuelta");
		} else {
			$resp["mensaje"] = "la cadena '$path' no es json";
			$constantes = array();
			foreach (get_defined_constants() as $k => $value) {
				if ($k === "RUTA_DISCO") {
					continue;
				}
				if (substr($k, 0, 5) === "RUTA_") {
					$constantes[$k] = $value;
				}
			}

			$str_path = String::create($path);
			$posibles = array();
			foreach ($constantes as $key => $value) {
				if ($str_path -> startsWith($value)) {
					$posibles[] = $value;
				} else {
					$str_const = String::create($value);
					if ($str_const -> contains("://")) {
						$storage_type = $str_const -> first($str_const -> indexOf("://")) -> ensureRight("://");
						$otra_ruta = $str_const -> removeLeft($storage_type);
						if ($str_path -> startsWith($otra_ruta)) {
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
				$ruta_resuelta = static::parsear_ruta_servidor($mejor_opcion);

				$ruta_compuesta = (string)$str_path -> removeLeft($mejor_opcion);
				if (!empty($ruta_resuelta["ruta"])) {
					$ruta_compuesta = String::create($ruta_resuelta["ruta"]);
				}

				$almacenamiento = new SaiaStorage($ruta_resuelta["servidor"]);
				$resp["servidor"] = $mejor_opcion;
				$resp["ruta"] = $ruta_compuesta;
				$resp["error"] = false;
			} else {
				$resp["mensaje"] = "No se encontro la ruta_servidor";
			}
		}
		$resp["clase"] = $almacenamiento;
		return $resp;
	}

	/**
	 *
	 * @param string $ruta_servidor
	 * @return string[]
	 */
	private static function parsear_ruta_servidor($ruta_servidor) {
		//debug_print_backtrace();
		$str_ruta = String::create($ruta_servidor);
		$storage_type = $str_ruta -> first($str_ruta -> indexOf("://")) -> ensureRight("://");
		$str_ruta = $str_ruta -> removeLeft($storage_type);
		$rutas = $str_ruta -> removeLeft(static::SEPARADOR) -> split(static::SEPARADOR);
		$rutas = array_filter($rutas);
		$resto = "";
		$ruta_srv = "";
		if (empty($rutas)) {
			$ruta_srv = $ruta_servidor;
		} else {
			$prefijo_servidor = "";
			//Tener en cuenta la letra de la unidad si esta en la raiz
			if (SO == "Windows") {
				if (preg_match("/^([a-zA-Z]:)/", $str_ruta, $unidad)) {
					$str_ruta = String::create(preg_replace("/^[a-zA-Z]:/", '', $str_ruta));
					if ($str_ruta -> startsWith(StorageUtils::SEPARADOR)) {
						$prefijo_servidor = $unidad[0] . StorageUtils::SEPARADOR;
					}
				}
			} else {
				if ($str_ruta -> startsWith(StorageUtils::SEPARADOR)) {
					$prefijo_servidor = StorageUtils::SEPARADOR;
				}
			}

			$ruta_srv = String::create($rutas[0]) -> prepend($prefijo_servidor) -> prepend($storage_type);
			if (count($rutas) > 1) {
				unset($rutas[0]);
				$resto = implode(static::SEPARADOR, $rutas);
				$resto = String::create($resto) -> removeRight(static::SEPARADOR);
			}
		}
		$resp = array(
			"servidor" => (string)$ruta_srv,
			"ruta" => (string)$resto
		);
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
		if (!empty($prefix)) {
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
		if (defined("RUTA_ABS_SAIA")) {
			return RUTA_ABS_SAIA;
		}
		$abspath = __DIR__;
		$docRoot = rtrim($_SERVER['DOCUMENT_ROOT'], self::SEPARADOR);
		$dir = substr($abspath, strlen($docRoot));

		$app_root = $docRoot;

		$rutas = new ArrayObject(explode(self::SEPARADOR, ltrim($dir, self::SEPARADOR)));
		for ($it = $rutas -> getIterator(); $it -> valid(); $it -> next()) {
			$app_root .= self::SEPARADOR . $it -> current();
			if (is_file($app_root . self::SEPARADOR . "db.php")) {
				break;
			}
		}
		if (!defined("RUTA_ABS_SAIA")) {
			define("RUTA_ABS_SAIA", $app_root);
		}

		return $app_root;
	}

	public static function get_memory_filesystem($root, $scheme = null) {
		$memory_filesystem = new Filesystem(new InMemory( array()));

		$filesystemMap = StreamWrapper::getFilesystemMap();
		$filesystemMap -> set($root, $memory_filesystem);
		StreamWrapper::register($scheme);
		return $memory_filesystem;
	}
}
?>