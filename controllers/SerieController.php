    <?php

    class SerieController
    {
        public $request;
        public $data;

        use TRDTrait;

        public function __construct(array $request)
        {
            $this->request = $request;
        }

        public function validateFields()
        {
            $stringFields = [
                'dependencia' => 'por favor seleccione la dependencia',
                'serie' => 'por favor seleccione la serie',
                'tipo_documental' => 'por favor ingrese el tipo documental',
                'soporte' => 'por favor ingrese los tipos de soporte',
                'disposicion' => 'por favor ingrese el tipo de disposición'
            ];

            $numberFields = [
                'ret_gestion' => 'por favor ingrese el tiempo de retencion gestión',
                'ret_central' => 'por favor ingrese el tiempo de retencion central',
            ];

            foreach ($stringFields as $field => $textError) {
                if (empty($this->request[$field])) {
                    $this->error($textError);
                }
            }
            foreach ($numberFields as $field => $textError) {

                if ($this->request[$field] == '') {
                    $this->error($textError);
                }
            }

            $this->request['sop_papel'] = (int) in_array('P', $this->request['soporte']);
            $this->request['sop_electronico'] = (int) in_array('EL', $this->request['soporte']);

            $this->request['dis_eliminacion'] = (int) ($this->request['disposicion'] == 'E');
            $this->request['dis_conservacion'] = (int) ($this->request['disposicion'] == 'CT');
            $this->request['dis_seleccion'] = (int) ($this->request['disposicion'] == 'S');

            $this->request['dis_microfilma'] = (int) ($this->request['disposicion2']
                && !$this->request['dis_eliminacion']) ? 1 : 0;

            $serie = $this->getInfoSerie();
            $subserie = $this->getInfoSubserie();
            $tipo = $this->getInfoTipo();

            $data = [
                'iddependencia' => $this->request['dependencia'],
                'serie' => $serie,
                'subserie' => $subserie,
                'tipo' => $tipo
            ];

            $this->data = $data;

            return $this;
        }

        public function getInfoSerie()
        {
            $data = [];

            if ($this->request['serie'] == -1) {

                if (
                    empty($this->request['codigo_serie']) || empty($this->request['nombre_serie'])
                ) {
                    $this->error("Por favor ingrese el codigo y nombre de la serie");
                }

                $data = [
                    'cod_padre' => 0,
                    'nombre' => $this->request['nombre_serie'],
                    'codigo' => $this->request['codigo_serie'],
                    'tipo' => 1,
                ];

                if (!$this->request['subserie']) {
                    $otherData = [
                        'retencion_gestion' => $this->request['ret_gestion'],
                        'retencion_central' => $this->request['ret_central'],
                        'procedimiento' => $this->request['procedimiento'],
                        'sop_papel' => $this->request['sop_papel'],
                        'sop_electronico' => $this->request['sop_electronico'],
                        'dis_eliminacion' => $this->request['dis_eliminacion'],
                        'dis_conservacion' => $this->request['dis_conservacion'],
                        'dis_seleccion' => $this->request['dis_seleccion'],
                        'dis_microfilma' => $this->request['dis_microfilma']
                    ];
                    $data = array_merge($data, $otherData);
                }

                $existSerie = $this->validateDependenciaSerie(
                    1,
                    $this->request['codigo_serie'],
                    $this->request['dependencia']
                );

                if ($existSerie) {
                    $this->error("El código ingresado: ({$this->request['codigo_serie']}) ya se encuentra asignado a la dependencia");
                }

                $data['newSerie'] = 1;
            } else {
                $data['newSerie'] = 0;
                $data['idserie'] = $this->request['serie'];
            }
            return $data;
        }

        public function getInfoSubserie()
        {
            $data = [];
            $data['newSubserie'] = 2;

            if ($this->request['subserie']) {

                if ($this->request['subserie'] == -1) {

                    $data = [
                        'cod_padre' => '?',
                        'nombre' => $this->request['nombre_subserie'],
                        'codigo' => $this->request['codigo_subserie'],
                        'tipo' => 2,
                        'retencion_gestion' => $this->request['ret_gestion'],
                        'retencion_central' => $this->request['ret_central'],
                        'procedimiento' => $this->request['procedimiento'],
                        'sop_papel' => 0,
                        'sop_electronico' => 0,
                        'dis_eliminacion' => $this->request['dis_eliminacion'],
                        'dis_conservacion' => $this->request['dis_conservacion'],
                        'dis_seleccion' => $this->request['dis_seleccion'],
                        'dis_microfilma' => $this->request['dis_microfilma']
                    ];

                    if ($this->request['serie'] == -1) {
                        $existSerie = $this->validateDependenciaSerie(
                            2,
                            $this->request['codigo_subserie'],
                            $this->request['dependencia']
                        );
                    } else {
                        $existSerie = $this->validateDependenciaSerie(
                            2,
                            $this->request['codigo_subserie'],
                            $this->request['dependencia'],
                            $this->request['serie']
                        );
                    }

                    if ($existSerie) {
                        $this->error("El código ingresado: ({$this->request['codigo_subserie']}) ya se encuentra asignado a la dependencia");
                    }

                    $data['newSubserie'] = 1;
                } else {
                    $data['newSubserie'] = 0;
                    $data['idsubserie'] = $this->request['subserie'];
                }
            }

            return $data;
        }

        public function getInfoTipo()
        {
            $data = [
                'cod_padre' => '?',
                'nombre' => $this->request['tipo_documental'],
                'codigo' => 0,
                'tipo' => 3,
                'dias_respuesta' => $this->request['dias_respuesta'] ?
                    $this->request['dias_respuesta'] : 0,
                'sop_papel' => $this->request['sop_papel'],
                'sop_electronico' => $this->request['sop_electronico']
            ];

            return $data;
        }

        public function save()
        {
            $newIdSerie = [];
            $newIdSerieDep = [];

            if ($this->data['serie']['newSerie']) {

                $idserie = Serie::newRecord($this->data['serie']);
                if ($idserie) {

                    $this->data['serie']['idserie'] = $idserie;
                    $newIdSerie[] = $idserie;

                    $attributesDep = [
                        'fk_serie' => $idserie,
                        'fk_dependencia' => $this->data['iddependencia'],
                        'estado' => 1
                    ];

                    $id = DependenciaSerie::newRecord($attributesDep);
                    if (!$id) {

                        $this->deleteData($newIdSerie);
                        $this->errorException("Error al guardar la vinculacion Dependencia/Serie");
                    } else {
                        $newIdSerieDep[] = $id;
                    }
                } else {
                    $this->error("Error al guardar la información de la serie");
                }
            }
            $codPadre = $this->data['serie']['idserie'];


            if ($this->data['subserie']['newSubserie'] != 2) {

                if ($this->data['subserie']['newSubserie']) {

                    $dataSub = array_merge(
                        $this->data['subserie'],
                        ['cod_padre' => $this->data['serie']['idserie']]
                    );

                    $idsubserie = Serie::newRecord($dataSub);
                    if ($idsubserie) {

                        $this->data['subserie']['idsubserie'] = $idsubserie;
                        $newIdSerie[] = $idsubserie;

                        $attributesDep = [
                            'fk_serie' => $idsubserie,
                            'fk_dependencia' => $this->data['iddependencia'],
                            'estado' => 1
                        ];

                        $id = DependenciaSerie::newRecord($attributesDep);
                        if (!$id) {
                            $this->deleteData($newIdSerie, $newIdSerieDep);
                            $this->errorException("Error al guardar la vinculacion Dependencia/Subserie");
                        } else {
                            $newIdSerieDep[] = $id;
                        }
                    } else {
                        $this->deleteData($newIdSerie);
                        $this->error("Error al guardar la información de la subserie");
                    }
                }
                $codPadre = $this->data['subserie']['idsubserie'];
            }

            $dataTipoDoc = array_merge(
                $this->data['tipo'],
                ['cod_padre' => $codPadre]
            );

            if (!Serie::newRecord($dataTipoDoc)) {
                $this->deleteData($newIdSerie, $newIdSerieDep);
                $this->error("Error al guardar la información");
            }

            $response = [
                'success' => 1,
                'add' => (int) $this->request['addother'],
                'data' => [
                    'iddependencia' => $this->data['iddependencia'],
                    'idserie' => $this->data['serie']['idserie'],
                    'idsubserie' => $this->data['subserie']['idsubserie']
                ]
            ];

            return $response;
        }

        public function deleteData(array $newIdSerie, array $newIdSerieDep = [])
        {
            foreach ($newIdSerie as $id) {
                Serie::executeDelete(['idserie' => $id]);
            }

            foreach ($newIdSerieDep as $id) {
                DependenciaSerie::executeDelete(['idserie' => $id]);
            }
            return $this;
        }

        public function error($mensaje)
        {
            throw new Exception($mensaje, 1);
        }
    }
