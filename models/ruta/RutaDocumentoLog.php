<?php

class RutaDocumentoLog extends LogConnection
{
    protected $idruta_documento_log;
    protected $fk_log;
    protected $fk_ruta_documento;

    function __construct($id = null)
    {
        parent::__construct($id);
    }
}
