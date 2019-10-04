<?php

class ExternalUserGeneratorController extends ComponentFormGeneratorController implements IComponentGenerator
{
    /**
     * ambito de tipo para persona natural
     * usado para visualizar campos del formulario
     */
    const SCOPE_NATURAL = 1;

    /**
     * ambito de tipo para persona juridica
     * usado para visualizar campos del formulario
     */
    const SCOPE_LEGAL = 2;

    /**
     * ambito para ambos tipo. natural juridica
     * usado para visualizar campos del formulario
     */
    const SCOPE_BOTH = 3;

    /**
     * configuracion de los campos para del formulario
     */
    const FIELDS = [
        [
            'name' => 'tipo',
            'label' =>  'Tipo de tecero',
            'required' => true,
            'scope' => self::SCOPE_BOTH
        ],
        [
            'name' => 'nombre',
            'label' => 'Nombre',
            'required' => true,
            'scope' => self::SCOPE_BOTH
        ],
        [
            'name' => 'tipo_identificacion',
            'label' => 'Tipo de identificación',
            'required' => true,
            'scope' => self::SCOPE_BOTH
        ],
        [
            'name' => 'identificacion',
            'label' => 'Identificación',
            'required' => true,
            'scope' => self::SCOPE_BOTH
        ],
        [
            'name' => 'titulo',
            'label' => 'Titulo',
            'required' => false,
            'scope' => self::SCOPE_NATURAL
        ],
        [
            'name' => 'direccion',
            'label' => 'Dirección',
            'required' => false,
            'scope' => self::SCOPE_BOTH
        ],
        [
            'name' => 'telefono',
            'label' => 'Teléfono',
            'required' => false,
            'scope' => self::SCOPE_BOTH
        ],
        [
            'name' => 'correo',
            'label' => 'Correo electronico',
            'required' => false,
            'scope' => self::SCOPE_BOTH
        ],
        [
            'name' => 'sede',
            'label' => 'Sede',
            'required' => false,
            'scope' => self::SCOPE_LEGAL
        ],
        [
            'name' => 'ciudad',
            'label' => 'Ciudad',
            'required' => false,
            'scope' => self::SCOPE_BOTH
        ],
        [
            'name' => 'cargo',
            'label' => 'Cargo',
            'required' => false,
            'scope' => self::SCOPE_NATURAL
        ],
        [
            'name' => 'empresa',
            'label' => 'Empresa',
            'required' => false,
            'scope' => self::SCOPE_LEGAL
        ],
    ];

    public function __construct($Formato, $CamposFormato, $scope)
    {
        return parent::__construct($Formato, $CamposFormato, $scope);
    }

    /**
     * genera un componente en ambito de adicion
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-25
     */
    public function generateAditionComponent()
    {
        $content = <<<HTML
            <div class="form-group form-group-default form-group-default-select2">
                <label for="{$this->CamposFormato->nombre}">{$this->getLabel()}</label>
                <select class="form-control" id="{$this->CamposFormato->nombre}" multiple="multiple"></select>
            </div>
            <script>
                $(function(){
                    var select = $("#{$this->CamposFormato->nombre}");
                    select.select2({
                        minimumInputLength: 3,
                        language: 'es',
                        ajax: {
                            url: `<?= \$ruta_db_superior ?>app/tercero/autocompletar.php`,
                            dataType: 'json',
                            data: function(params) {
                                return {
                                    term: params.term,
                                    key: localStorage.getItem('key'),
                                    token: localStorage.getItem('token')
                                };
                            },
                            processResults: function(response) {
                                let options = response.data.length ? response.data : [{id: 9999, text: 'Crear tercero', showModal: true}];
                                return { results: options} 
                            }
                        }                        
                    }).on('select2:selecting', function (e) {
                        let data = e.params.args.data;

                        if(data.showModal){
                            e.preventDefault();

                            top.topModal({
                                url: 'views/tercero/formulario.php',
                                params: {
                                    fieldId : {$this->CamposFormato->getPK()}
                                }, //parametros a enviar a url
                                title: 'Tercero', //titulo
                                buttons: {
                                    success: {
                                        label: 'Enviar',
                                        class: 'btn btn-complete'
                                    },
                                    cancel: {
                                        label: 'Cerrar',
                                        class: 'btn btn-danger'
                                    }
                                },
                                onSuccess: function(data) {
                                    select.select2('close');
                                    var option = new Option(data.text, data.id, true, true);
                                    select.append(option).trigger('change');
                                    top.closeTopModal();
                                }
                            })
                        }
                    });
                });
            </script>
HTML;

        return $content;
    }

    /**
     * genera un componente en ambito de edicion
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-25
     */
    public function generateEditionComponente()
    {
        return $this->generateAditionComponent();
    }

    /**
     * muestra el valor almacenado en un documento
     * de un componente especifico
     *
     * @param CamposFormato $CamposFormato
     * @param integer $documentId
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-26
     */
    public static function showValue($CamposFormato, $documentId)
    {
        return parent::showValue($CamposFormato, $documentId);
    }

    /**
     * obtiene un array nombre => etiqueta de los campos
     *
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-04
     */
    public static function getFieldsLabel()
    {
        $fields = [];

        foreach (self::FIELDS as $field) {
            $fields[$field['name']] = $field['label'];
        }

        return $fields;
    }


    /**
     * genera el schema del componente
     *
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-04
     */
    public static function getSchema($CamposFormato)
    {
        $fields = self::getFieldsLabel();
        return [
            "schema" => [
                "title" => "",
                "description" => "Editar propiedades",
                "type" => "object",
                "properties" => [
                    "fs_etiqueta" => [
                        "type" => "string",
                        "title" => "Etiqueta del campo",
                        "maxLength" => 255,
                        "required" => true
                    ],
                    "fs_opciones" => [
                        "type" => "object",
                        "title" => "",
                        "properties" => [
                            "tipo" => [
                                "type" => "string",
                                "title" => "Selecci&#243;n",
                                "required" => true,
                                "enum" => ["multiple", "unico"]
                            ],
                            "adicional" => [
                                "title" => "Informaci&#243;n adicional",
                                "type" => "string",
                                "minItems" => 1,
                                "enum" => array_keys($fields)
                            ]
                        ]
                    ],
                    "fs_acciones" => [
                        "type" => "boolean"
                    ],
                    "fs_obligatoriedad" => [
                        "type" => "boolean"
                    ],
                    "fs_ayuda" => [
                        "type" => "string",
                        "title" => "Ayuda para el usuario"
                    ]
                ]
            ],
            "options" => [
                "fields" => [
                    "fs_opciones" => [
                        "fields" => [
                            "tipo" => [
                                "type" => "radio",
                                "vertical" => false,
                                "removeDefaultNone" => true,
                                "optionLabels" => ["M&#250;ltiple", "Simple"]
                            ],
                            "adicional" => [
                                "type" => "checkbox",
                                "sort" => false,
                                "optionLabels" => array_values($fields)
                            ]
                        ]
                    ],
                    "fs_obligatoriedad" => [
                        "type" => "checkbox",
                        "rightLabel" => "Obligatorio"
                    ],
                    "fs_acciones" => [
                        "type" => "checkbox",
                        "rightLabel" => "Incluirse en la descripci&#243;n del formato"
                    ],
                    "fs_ayuda" => [
                        "rows" => 3,
                        "type" => "textarea"
                    ]
                ]
            ]
        ];
    }
}
