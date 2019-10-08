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
            'label' => 'Nombre Completo',
            'required' => true,
            'scope' => self::SCOPE_BOTH
        ],
        [
            'name' => 'tipo_identificacion',
            'label' => 'Tipo de identificación',
            'required' => false,
            'scope' => self::SCOPE_NATURAL
        ],
        [
            'name' => 'identificacion',
            'label' => 'Identificación',
            'required' => false,
            'scope' => self::SCOPE_BOTH
        ],
        [
            'name' => 'ciudad',
            'label' => 'Ciudad',
            'required' => false,
            'scope' => self::SCOPE_BOTH
        ],
        [
            'name' => 'titulo',
            'label' => 'Título',
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
        $requiredClass = $this->getRequiredClass();
        $options = json_decode($this->CamposFormato->opciones);

        if ($options->tipo != 'multiple') {
            $unique = <<<JS
                select.val(null).trigger('change');
JS;
        } else {
            $unique = "";
        }

        $content = <<<HTML
            <div class='form-group form-group-default form-group-default-select2 {$requiredClass}' id='group_{$this->CamposFormato->nombre}'>
                <label title='{$this->CamposFormato->ayuda}'>{$this->getLabel()}</label>
                <select class="full-width" id='{$this->CamposFormato->nombre}' multiple="multiple" {$requiredClass} ></select>
                <input type="hidden" name="{$this->CamposFormato->nombre}">
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
                        {$unique}
                        let data = e.params.args.data;

                        if(data.showModal){
                            e.preventDefault();

                            openModal();
                        }
                    }).on('change', function(){
                        let value = $(this).val().join(',');
                        $("[name='{$this->CamposFormato->nombre}']").val(value);
                    });

                    $(document)
                        .off('click', '.select2-selection__choice')
                        .on('click', '.select2-selection__choice', function (e){
                            if($(e.target).hasClass('select2-selection__choice__remove')){
                                return;
                            }

                            let title = $(this).attr('title');
                            let item = select.select2('data').find(i => i.text == title);
                            openModal(item, $(this));
                        });

                    function openModal(item = 0, selectedNode = null){
                        top.topModal({
                            url: 'views/tercero/formulario.php',
                            params: {
                                fieldId : {$this->CamposFormato->getPK()},
                                id: item.id
                            },
                            title: 'Tercero',
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
                                if(selectedNode){
                                    selectedNode.find('span').trigger('click');
                                }

                                select.select2('close');
                                var option = new Option(data.text, data.id, true, true);
                                select.append(option).trigger('change');
                                top.closeTopModal();
                            }
                        });
                    }
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
        $text = $this->generateAditionComponent();
        $text .= <<<HTML
            <script>
                $(function(){
                    var select = $("#{$this->CamposFormato->nombre}");
                    var selected = "<?= \$ft['{$this->CamposFormato->nombre}'] ?>".split(',');
                    
                    selected.forEach(id => {
                        $.ajax({
                            type: 'POST',
                            dataType: 'json',
                            url: '<?= \$ruta_db_superior ?>app/tercero/autocompletar.php',
                            data: {
                                defaultUser: id,
                                key: localStorage.getItem('key'),
                                token: localStorage.getItem('token')
                            },
                            success: function(response) {
                                response.data.forEach(u => {
                                    var option = new Option(u.text, u.id, true, true);
                                    select
                                        .append(option)
                                        .trigger('change');
                                });
                            }
                        });
                    })
                });
            </script>
HTML;
        return $text;
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
