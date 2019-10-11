<?php
class ExpedienteController
{
    protected $request;
    protected $Expediente;

    public function __construct($id, $request)
    {
        $this->request = $request;
        $this->Expediente = new Expediente($id);
    }

    public function updateEstadoCierre()
    {
        $response = [
            'message' => '',
            'success' => 1
        ];

        if ($this->Expediente->estado_cierre != $this->request['newEstadoCierre']) {

            $this->Expediente->setAttributes([
                'estado_cierre' => (int) $this->request['newEstadoCierre']
            ]);
            $this->Expediente->descripcion_estado_cierre = $this->request['observacion'];

            $response['success'] = (int) $this->Expediente->update() ? true : false;
        }

        $response['data'] = ExpedienteGetDataController::getInfoExpediente(
            ['idexpediente' => $this->Expediente->getPK()]
        );

        $response['datalist'] = (new Vexpedientes($this->Expediente->getPK()))->getDataRowList();

        return $response;
    }
}
