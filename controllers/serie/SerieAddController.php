    <?php

    class SerieAddController
    {
        public $request;
        public $iddependencia;
        public $row;
        public $newData;

        use TTRD;

        public function __construct(array $request)
        {
            $this->request = $request;
            $this->iddependencia = $request['dependencia'];
        }

        public function createSerie()
        {
            $response = false;
            if (
                !empty($this->request['serie'])
                &&
                !empty($this->iddependencia)
            ) {

                $newData = [];
                foreach ($this->request['serie'] as $row) {
                    $this->row = $row;
                    $newData[] = $this->validateData();
                }

                $this->newData = $newData;
                $response = $this->save();
            } else {
                $this->error("Por favor ingrese la serie");
            }
            return $response;
        }

        private function validateData()
        {
            if ($this->row['idserie'] == -1) {

                $this->validateFieldSerieSub($this->row, 1);

                $data = [
                    'cod_padre' => 0,
                    'nombre' => $this->row['nombre'],
                    'codigo' => $this->row['codigo'],
                    'tipo' => 1
                ];

                if (!empty($this->row['tipo'])) {

                    if (
                        empty($this->row['disposicion'])
                    ) {
                        $this->error("Por favor ingrese la disposición");
                    }

                    $otherData = [
                        'retencion_gestion' => (int) $this->row['gestion'],
                        'retencion_central' => (int) $this->row['central'],
                        'procedimiento' => $this->row['procedimiento'],
                        'dis_eliminacion' => ($this->row['disposicion'] == 'E') ? 1 : 0,
                        'dis_conservacion' => ($this->row['disposicion'] == 'CT') ? 1 : 0,
                        'dis_seleccion' => ($this->row['disposicion'] == 'S') ? 1 : 0,
                        'dis_microfilma' => (empty($this->row['microfilma'])) ? 0 : 1
                    ];

                    $data = array_merge($data, $otherData);

                    $data['children']['tipo'] = $this->validateTipo($this->row['tipo']);
                } else {
                    $data['children']['subserie'] = $this->validateSubserie();
                }

                $data['newSerie'] = 1;
            } else {
                $data['newSerie'] = 0;
                $data['idserie'] = $this->row['idserie'];

                if (empty($this->row['tipo']) && empty($this->row['subserie'])) {
                    $this->error("Por favor ingrese la subserie o el tipo documental");
                }

                if (!empty($this->row['tipo'])) {
                    $data['children']['tipo'] = $this->validateTipo($this->row['tipo']);
                } else {
                    $data['children']['subserie'] = $this->validateSubserie();
                }
            }
            return $data;
        }

        private function validateFieldSerieSub(array $data, int $type, int $idseriePadre = 0)
        {
            if (
                empty($data['codigo']) || empty($data['nombre'])
            ) {
                $this->error("Por favor ingrese el codigo y nombre de la serie/subserie");
            }

            if (empty($data['tipo']) && empty($data['subserie'])) {
                $this->error("Por favor ingrese la subserie o el tipo documental");
            }

            if ($idseriePadre) {
                $existSerie = $this->validateSerieDependencia(
                    $type,
                    $data['codigo'],
                    $this->iddependencia,
                    $idseriePadre
                );
            } else {
                $existSerie = $this->validateSerieDependencia(
                    $type,
                    $data['codigo'],
                    $this->iddependencia
                );
            }

            if ($existSerie) {
                $this->error("El código ingresado: ({$data['codigo']}) ya se encuentra asignado a la dependencia");
            }
        }

        public function validateSubserie()
        {
            $dataSubserie = [];

            foreach ($this->row['subserie'] as $subserie) {

                if ($subserie['idsubserie'] == -1) {

                    if ($this->row['idserie'] != -1) {
                        $this->validateFieldSerieSub($subserie, 2, $this->row['idserie']);
                    } else {
                        $this->validateFieldSerieSub($subserie, 2);
                    }

                    $sub = [
                        'cod_padre' => 0,
                        'nombre' => $subserie['nombre'],
                        'codigo' => $subserie['codigo'],
                        'tipo' => 2,
                        'retencion_gestion' => (int) $subserie['gestion'],
                        'retencion_central' => (int) $subserie['central'],
                        'procedimiento' => $subserie['procedimiento'],
                        'dis_eliminacion' => ($subserie['disposicion'] == 'E') ? 1 : 0,
                        'dis_conservacion' => ($subserie['disposicion'] == 'CT') ? 1 : 0,
                        'dis_seleccion' => ($subserie['disposicion'] == 'S') ? 1 : 0,
                        'dis_microfilma' => (empty($subserie['microfilma'])) ? 0 : 1
                    ];
                    $sub['newSubserie'] = 1;
                    $sub['children']['tipo'] = $this->validateTipo($subserie['tipo']);
                    $dataSubserie[] = $sub;
                } else {
                    if (empty($subserie['tipo'])) {
                        $this->error("Por favor ingrese el tipo documental");
                    }
                    $dataSubserie[] = [
                        'newSubserie' => 0,
                        'idsubserie' => $subserie['idsubserie'],
                        'children' => [
                            'tipo' => $this->validateTipo($subserie['tipo'])
                        ]
                    ];
                }
            }
            return $dataSubserie;
        }

        public function validateTipo($dataTipo)
        {
            $tipo = [];
            foreach ($dataTipo as $tipoDocumental) {

                if (
                    empty($tipoDocumental['nombre']) || empty($tipoDocumental['soporte'])
                ) {
                    $this->error("Por favor ingrese el nombre/soporte al tipo documental'");
                }

                $tipoSub = [
                    'cod_padre' => 0,
                    'nombre' => $tipoDocumental['nombre'],
                    'codigo' => 0,
                    'tipo' => 3,
                    'dias_respuesta' => (int) $tipoDocumental['dias_respuesta'],
                    'sop_papel' => (in_array('P', $tipoDocumental['soporte']) !== false)
                        ? 1 : 0,
                    'sop_electronico' => (in_array('EL', $tipoDocumental['soporte']) !== false)
                        ? 1 : 0,
                ];

                $tipo[] = $tipoSub;
            }
            return $tipo;
        }

        private function save()
        {
            foreach ($this->newData as $serie) {

                $children = $serie['children'];
                if ($serie['newSerie'] == 1) {

                    $existSerie = $this->validateSerieDependencia(
                        1,
                        $serie['codigo'],
                        $this->iddependencia
                    );
                    if ($existSerie) {
                        $this->error("El código ingresado: (Serie => {$serie['codigo']}) se encuentra repetido en el formulario");
                    }

                    unset($serie['children'], $serie['newSerie']);
                    if (!$idserie = Serie::newRecord($serie)) {
                        $this->error("Error al guardar la serie");
                    }

                    $attributesDep = [
                        'fk_serie' => $idserie,
                        'fk_dependencia' => $this->iddependencia,
                        'estado' => 1
                    ];
                    if (!SerieDependencia::newRecord($attributesDep)) {
                        $this->error("Error al guardar la relación dependencia/serie");
                    }
                } else {
                    $idserie = $serie['idserie'];
                }

                foreach ($children as $subserieTipo => $data) {

                    if ($subserieTipo == 'subserie') {

                        foreach ($data as $subserie) {

                            $childrenSub = $subserie['children']['tipo'];
                            if ($subserie['newSubserie'] == 1) {

                                $existSerie = $this->validateSerieDependencia(
                                    2,
                                    $subserie['codigo'],
                                    $this->iddependencia,
                                    $idserie
                                );

                                if ($existSerie) {
                                    $this->error("El código ingresado: (Subserie => {$subserie['codigo']}) se encuentra repetido en el formulario");
                                }
                                unset($subserie['children'], $subserie['newSerie']);

                                $subserie['cod_padre'] = $idserie;
                                if (!$idsubserie = Serie::newRecord($subserie)) {
                                    $this->error('Error al guardar la subserie');
                                }
                                $attributesDep = [
                                    'fk_serie' => $idsubserie,
                                    'fk_dependencia' => $this->iddependencia,
                                    'estado' => 1
                                ];
                                if (!SerieDependencia::newRecord($attributesDep)) {
                                    $this->error("Error al guardar la relación dependencia/subserie");
                                }
                            } else {
                                $idsubserie = $subserie['idsubserie'];
                            }
                            $this->saveTipo($childrenSub, $idsubserie);
                        }
                    } else { //tipo
                        $this->saveTipo($data, $idserie);
                    }
                }
            }

            TRDVersionController::removeTemporalFile(1);

            return true;
        }

        private function saveTipo($data, $idpadre)
        {
            foreach ($data as $tipo) {
                $tipo['cod_padre'] = $idpadre;
                if (!Serie::newRecord($tipo)) {
                    $this->error('Error al guardar el tipo documental');
                }
            }
            return true;
        }

        private function error($mensaje)
        {
            throw new Exception($mensaje, 1);
        }
    }
