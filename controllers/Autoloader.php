<?php
/**
 * Simple Recursive Autoloader
 *
 * A simple autoloader that loads class files recursively starting in the directory
 * where this class resides.  Additional options can be provided to control the naming
 * convention of the class files.
 *
 * @package Autoloader
 * @license http://opensource.org/licenses/MIT  MIT License
 * @author  Rob Dunham <contact@robunham.info>
 */
class Autoloader {
	/**
	 * File extension as a string.
	 * Defaults to ".php".
	 */
	protected $fileExt = '.php';
	/**
	 * The top level directory where recursion will begin.
	 * Defaults to the current
	 * directory.
	 */
	protected $pathTop = __DIR__;
	/**
	 * A placeholder to hold the file iterator so that directory traversal is only
	 * performed once.
	 */
	protected $fileIterator = null;

	protected $rutaSuperior = null;
	
	public function __construct($path, $rutaSuperior = null) {
		$this->pathTop = $path;
		$this->rutaSuperior = $rutaSuperior;
	}
	
	/**
	 * Autoload function for registration with spl_autoload_register
	 *
	 * Looks recursively through project directory and loads class files based on
	 * filename match.
	 *
	 * @param string $className
	 */
	public function loader($className) {
		$directory = new RecursiveDirectoryIterator($this->pathTop, RecursiveDirectoryIterator::SKIP_DOTS);
		if(is_null($this->fileIterator)) {
			$this->fileIterator = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::LEAVES_ONLY);
		}
		$filename = $className . $this->fileExt;
		foreach($this->fileIterator as $file) {
			if(strtolower($file->getFilename()) === strtolower($filename)) {
				if($file->isReadable()) {
					include_once $file->getPathname();
				}
				break;
			}
		}
	}

	/**
	 * Sets the $fileExt property
	 *
	 * @param string $fileExt
	 *        	The file extension used for class files. Default is "php".
	 */
	public function setFileExt($fileExt) {
		$this->fileExt = $fileExt;
	}

	/**
	 * Sets the $path property
	 *
	 * @param string $path
	 *        	The path representing the top level where recursion should
	 *        	begin. Defaults to the current directory.
	 */
	public function setPath($path) {
		$this->pathTop = $path;
	}
}
?>