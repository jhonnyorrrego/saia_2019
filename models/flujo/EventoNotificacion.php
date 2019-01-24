<?php
class EventoNotificacion extends Model {
	
	use TFlujo;
	
	protected $idevento_notificacion;
	protected $evento;

	function __construct($id = null) {
		parent::__construct($id);
	}

	protected function defineAttributes() {
		$this->dbAttributes = (object) [
				'safe' => [
						"evento"
				],
				"table" => "wf_evento_notificacion",
				"primary" => "idevento_notificacion"
		];
	}

	public static function getAll($limit = 0, $asArray = false) {
		if($limit) {
			$records = busca_filtro_tabla_limit($select, $table, $condition, $order, 0, $limit, $conn);
		} else {
			$records = busca_filtro_tabla($select, $table, $condition, $order, $conn);
		}
		if($asArray) {
			$response = $this->convertToArray($records);
		} else if($records['numcampos']) {
			$response = self::convertToObjectCollection($records);
		} else {
			$response = null;
		}

		return $response;
	}
}