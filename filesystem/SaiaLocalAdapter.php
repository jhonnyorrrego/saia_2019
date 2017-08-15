<?php
namespace Gaufrette\Adapter;

class SaiaLocalAdapter extends Local {

	public function getDirectory() {
		return $this->directory;
	}

	public function ensureDirectoryExists($directory, $create = false) {
		parent::ensureDirectoryExists($directory, $create);
	}

	public function createDirectory($directory) {
		parent::createDirectory($directory);
	}

}