<?php
$currentFolder = dirname(__FILE__);


class Diagram {

	public $id;
	public $hash;
	public $title;
	public $description;
	public $publico;
	public $createdDate;
	public $lastUpdate;
	public $tamano;

	function loadFromSQL($row) {
		$this->id = is_null($row['id']) ? null : htmlentities(stripslashes($row['id']));
		$this->hash = is_null($row['hash']) ? null : htmlentities(stripslashes($row['hash']));
		$this->title = is_null($row['title']) ? null : htmlentities(stripslashes($row['title']));
		$this->description = is_null($row['description']) ? null : htmlentities(stripslashes($row['description']));
		$this->publico = is_null($row['publico']) ? null : htmlentities(stripslashes($row['publico']));
		$this->createdDate = is_null(@$row['createdDate']) ? null : htmlentities(stripslashes($row['createdDate']));
		$this->lastUpdate = is_null(@$row['lastUpdate']) ? null : htmlentities(stripslashes($row['lastUpdate']));
		$this->tamano = is_null($row['tamano']) ? null : htmlentities(stripslashes($row['tamano']));
	}
}

class Diagramdata {
	const TYPE_DIA = 'dia';
	const TYPE_SVG = 'svg';
	const TYPE_JPG = 'jpg';
	const TYPE_PNG = 'png';

	public $diagramId;
	public $type;
	public $fileName;
	public $fileSize;
	public $lastUpdate;

	function loadFromSQL($row) {
		$this->diagramId = is_null($row['diagramId']) ? null : htmlentities(stripslashes($row['diagramId']));
		$this->type = is_null($row['type']) ? null : htmlentities(stripslashes($row['type']));
		$this->fileName = is_null($row['fileName']) ? null : htmlentities(stripslashes($row['fileName']));
		$this->fileSize = is_null($row['fileSize']) ? null : htmlentities(stripslashes($row['fileSize']));
		$this->lastUpdate = is_null($row['lastUpdate']) ? null : htmlentities(stripslashes($row['lastUpdate']));
	}
}

class Invitation {

	public $token;
	public $email;
	public $createdOn;
	public $diagramId;
	public $userId;

	function loadFromSQL($row) {
		$this->token = is_null($row['token']) ? null : htmlentities(stripslashes($row['token']));
		$this->email = is_null($row['email']) ? null : htmlentities(stripslashes($row['email']));
		$this->createdOn = is_null($row['createdOn']) ? null : htmlentities(stripslashes($row['createdOn']));
		$this->diagramId = is_null($row['diagramId']) ? null : htmlentities(stripslashes($row['diagramId']));
		$this->userId = is_null($row['userId']) ? null : htmlentities(stripslashes($row['userId']));
	}
}

class User {

	public $id;
	public $account;
	public $email;
	public $password;
	public $name;
	public $createdDate;
	public $lastLoginDate;
	public $lastLoginIP;
	public $lastBrowserType;

	function loadFromSQL($row) {
		$this->id = is_null($row['id']) ? null : htmlentities(stripslashes($row['id']));
		$this->account = is_null($row['account']) ? null : htmlentities(stripslashes($row['account']));
		$this->email = is_null($row['email']) ? null : htmlentities(stripslashes($row['email']));
		$this->password = is_null($row['password']) ? null : htmlentities(stripslashes($row['password']));
		$this->name = is_null($row['name']) ? null : htmlentities(stripslashes($row['name']));
		$this->createdDate = is_null(@$row['createdDate']) ? null : htmlentities(stripslashes($row['createdDate']));
		$this->lastLoginDate = is_null(@$row['lastLoginDate']) ? null : htmlentities(stripslashes($row['lastLoginDate']));
		$this->lastLoginIP = is_null(@$row['lastLoginIP']) ? null : htmlentities(stripslashes($row['lastLoginIP']));
		$this->lastBrowserType = is_null(@$row['lastBrowserType']) ? null : htmlentities(stripslashes($row['lastBrowserType']));
	}
}

class Userdiagram {
	const STATUS_ACCEPTED = 'accepted';
	const STATUS_KICKEDOF = 'kickedof';
	const LEVEL_EDITOR = 'editor';
	const LEVEL_AUTHOR = 'author';

	public $userId;
	public $diagramId;
	public $invitedDate;
	public $acceptedDate;
	public $status;
	public $nivel;

	function loadFromSQL($row) {
		$this->userId = is_null(@$row['userId']) ? null : htmlentities(stripslashes($row['userId']));
		$this->diagramId = is_null(@$row['diagramId']) ? null : htmlentities(stripslashes($row['diagramId']));
		$this->invitedDate = is_null(@$row['invitedDate']) ? null : htmlentities(stripslashes($row['invitedDate']));
		$this->acceptedDate = is_null(@$row['acceptedDate']) ? null : htmlentities(stripslashes($row['acceptedDate']));
		$this->status = is_null($row['status']) ? null : htmlentities(stripslashes($row['status']));
		$this->nivel = is_null($row['nivel']) ? null : htmlentities(stripslashes($row['nivel']));
	}
}
?>