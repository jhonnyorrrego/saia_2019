<?php
class EventoNotificacion extends Model
{

	use TFlujo;

	protected $idevento_notificacion;
	protected $evento;

	const EVENTO_CAMBIO_ESTADO = 1;	// Al cambiar de estado
	const EVENTO_CREAR_FORMATO = 2;	// Al crear un registro nuevo
	const EVENTO_RADICAD_DOCUMENTO = 3;	// Al radicarse o publicarse un documento

	function __construct($id = null)
	{
		parent::__construct($id);
	}

	protected function defineAttributes()
	{
		$this->dbAttributes = (object) [
			'safe' => [
				"evento"
			],
			"table" => "wf_evento_notificacion",
			"primary" => "idevento_notificacion"
		];
	}
}
