    <?php

    class SerieAddController
    {
        private $fk_serie_version;
        private $classSerie;
        private $classSerieDep;
        private $estadoVersion;
        private $tableName;

        private $newData;

        private $row;


        public function __construct(array $request)
        {
            if ($request['tableName'] == 'serie') {

                $this->classSerie = 'Serie';
                $this->classSerieDep = 'SerieDependencia';
                $this->fk_serie_version = SerieVersion::getCurrentVersion()->getPK();
                $this->estadoVersion = 1;
            } else {

                $this->classSerie = 'SerieTemp';
                $this->classSerieDep = 'SerieDependenciaTemp';
                $this->fk_serie_version = SerieVersion::getTempVersion()->getPK();
                $this->estadoVersion = 2;
            }

            $this->tableName = $request['tableName'];
            $this->row = $request['serie'];
        }

        public function createSerie(): bool
        {
            $this->newData = $this->validateData();

            return  $this->save();
        }

        private function validateData(): array
        {

            if (empty($this->row['tipo']) && empty($this->row['subserie'])) {
                $this->error("Por favor ingrese la subserie o el tipo documental");
            }

            if ($this->row['idserie'] == -1) {

                $this->validateFieldSerieSub($this->row, 1, 0);

                $data = [
                    'newSerie' => 1,
                    'iddependencia' => $this->row['dependencia'],
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
            } else {
                $data['newSerie'] = 0;
                $data['idserie'] = $this->row['idserie'];

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

            if ($data['idserie'] == -1 && !empty($data['subserie'])) {

                if (HelperSerie::existCodSerie($this->tableName, $data['codigo'], 1)) {
                    $this->error("El código ingresado: ({$data['codigo']}) ya existe");
                }
            } else {
                $existSerie = HelperSerie::validateSerieDependencia(
                    $this->tableName,
                    $type,
                    $data['codigo'],
                    $data['dependencia'],
                    $idseriePadre
                );

                if ($existSerie) {
                    if ($type == 1) {
                        $this->error("El código ingresado: ({$data['codigo']}) ya existe, o ya se encuentra vinculado a la dependencia");
                    } else {
                        $this->error("El código ingresado: ({$data['codigo']}) ya se encuentra vinculado a la dependencia");
                    }
                }
            }
        }

        private function validateSubserie(): array
        {
            $dataSubserie = [];

            foreach ($this->row['subserie'] as $subserie) {

                if (empty($subserie['tipo'])) {
                    $this->error("Por favor ingrese el tipo documental");
                }

                if ($subserie['idsubserie'] == -1) {

                    if ($this->row['idserie'] != -1) {
                        $this->validateFieldSerieSub($subserie, 2, $this->row['idserie']);
                    } else {
                        if (
                            empty($subserie['codigo']) || empty($subserie['nombre'])
                        ) {
                            $this->error("Por favor ingrese el codigo y nombre de la serie/subserie");
                        }
                    }

                    $sub = [
                        'newSubserie' => 1,
                        'iddependencia' => $subserie['dependencia'],
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
                    $sub['children']['tipo'] = $this->validateTipo($subserie['tipo']);
                    $dataSubserie[] = $sub;
                } else {

                    $SerieDependencia = new $this->classSerieDep($subserie['idserie_dependencia']);
                    if (
                        $SerieDependencia->fk_dependencia != $subserie['dependencia']
                        || $SerieDependencia->fk_serie != $subserie['idsubserie']
                    ) {
                        $this->error("Los datos no coinciden con los registrados");
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

        private function validateTipo($dataTipo): array
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

        private function save(): bool
        {
            $serie = $this->newData;

            $children = $serie['children'];
            if ($serie['newSerie'] == 1) {

                $insertSerieDep = 1;
                if (!$serie['iddependencia'] && !empty($children['subserie'])) {
                    $insertSerieDep = 0;
                    if (HelperSerie::existCodSerie($this->tableName, $serie['codigo'], 1)) {
                        $this->error("El código ingresado: ({$serie['codigo']}) ya existe");
                    }
                } else {
                    $existSerie = HelperSerie::validateSerieDependencia(
                        $this->tableName,
                        1,
                        $serie['codigo'],
                        $serie['iddependencia']
                    );

                    if ($existSerie) {
                        $this->error("El código ingresado: (Serie => {$serie['codigo']}) se encuentra repetido en el formulario");
                    }
                }

                unset($serie['children'], $serie['newSerie']);

                $serie['fk_serie_version'] = $this->fk_serie_version;
                if (!$idserie = $this->classSerie::newRecord($serie)) {
                    $this->error("Error al guardar la serie");
                }

                if ($insertSerieDep) {
                    $attributesDep = [
                        'fk_serie' => $idserie,
                        'fk_dependencia' => $serie['iddependencia'],
                        'estado' => 1
                    ];

                    if (!$this->classSerieDep::newRecord($attributesDep)) {
                        $this->error("Error al guardar la relación dependencia/serie");
                    }
                }
            } else {
                $idserie = $serie['idserie'];
            }

            foreach ($children as $subserieTipo => $data) {

                if ($subserieTipo == 'subserie') {

                    foreach ($data as $subserie) {

                        $childrenSub = $subserie['children']['tipo'];
                        if ($subserie['newSubserie'] == 1) {

                            $existSerie = HelperSerie::validateSerieDependencia(
                                $this->tableName,
                                2,
                                $subserie['codigo'],
                                $subserie['iddependencia'],
                                $idserie
                            );

                            if ($existSerie) {
                                $this->error("El código ingresado: (Subserie => {$subserie['codigo']}) se encuentra repetido en el formulario");
                            }

                            unset($subserie['children'], $subserie['newSerie']);

                            $subserie['fk_serie_version'] = $this->fk_serie_version;
                            $subserie['cod_padre'] = $idserie;

                            if (!$idsubserie = $this->classSerie::newRecord($subserie)) {
                                $this->error('Error al guardar la subserie');
                            }

                            $attributesDep = [
                                'fk_serie' => $idsubserie,
                                'fk_dependencia' => $subserie['iddependencia'],
                                'estado' => 1
                            ];

                            if (!$this->classSerieDep::newRecord($attributesDep)) {
                                $this->error("Error al guardar la relación subserie/dependencia");
                            }

                            if (!HelperSerie::existSerieDep($this->tableName, $idserie, $subserie['iddependencia'])) {
                                $attributesDep = [
                                    'fk_serie' => $idserie,
                                    'fk_dependencia' => $subserie['iddependencia'],
                                    'estado' => 1
                                ];

                                if (!$this->classSerieDep::newRecord($attributesDep)) {
                                    $this->error("Error al guardar la relación Serie/dependencia");
                                }
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

            TRDVersionController::removeTemporalFile($this->estadoVersion);

            return true;
        }

        private function saveTipo($data, $idpadre): bool
        {
            foreach ($data as $tipo) {

                $tipo['cod_padre'] = $idpadre;
                $tipo['fk_serie_version'] = $this->fk_serie_version;

                if (!$this->classSerie::newRecord($tipo)) {
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
