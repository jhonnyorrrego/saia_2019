<?php

class CamposFormato extends Model
{
    protected $idcampos_formato;
    protected $formato_idformato;
    protected $autoguardado;
    protected $fila_visible;
    protected $longitud_vis;
    protected $valor;
    protected $ayuda;
    protected $obligatoriedad;
    protected $orden;
    protected $acciones;
    protected $nombre;
    protected $etiqueta;
    protected $tipo_dato;
    protected $longitud;
    protected $predeterminado;
    protected $etiqueta_html;
    protected $mascara;
    protected $adicionales;
    protected $placeholder;
    protected $estilo;
    protected $opciones;
    protected $banderas;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        // set the safe attributes to update and consult
        $safeDbAttributes = [
            'formato_idformato',
            'autoguardado',
            'fila_visible',
            'longitud_vis',
            'valor',
            'ayuda',
            'obligatoriedad',
            'orden',
            'acciones',
            'nombre',
            'etiqueta',
            'tipo_dato',
            'longitud',
            'predeterminado',
            'etiqueta_html',
            'mascara',
            'adicionales',
            'placeholder',
            'estilo',
            'opciones',
            'banderas'
        ];

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => []
        ];
    }

    /**
     * crea un campo de nucleo
     *
     * @param string $field
     * @param object $Formato
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-06
     */
    public static function createDefaultField($field, $Formato)
    {
        switch ($field) {
            case 'documento_iddocumento':
                self::createDocumentField($Formato->getPK());
                break;
            case 'dependencia':
                self::createDependencieField($Formato->getPK());
                break;
            case 'encabezado':
                self::createHeaderField($Formato->getPK());
                break;
            case 'firma':
                self::createFirmField($Formato->getPK());
                break;
            default:
                $id = strpos($field, 'idft_') === 0;
                $parentId = strpos($field, 'ft_') === 0;

                if ($id) {
                    self::createIdentificatorField($Formato);
                } else if ($parentId) {
                    self::createParentField($Formato);
                } else {
                    throw new Exception("Campo por defecto indefinido", 1);
                }

                break;
        }
    }

    /**
     * crea el campo documento_iddocumento de un formato
     *
     * @param integer $formatId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-06
     */
    public static function createDocumentField($formatId)
    {
        CamposFormato::newRecord([
            'formato_idformato' => $formatId,
            'nombre' => 'documento_iddocumento',
            'etiqueta' => 'DOCUMENTO ASOCIADO',
            'tipo_dato' => \Doctrine\DBAL\Types\Type::INTEGER,
            'longitud' => '11',
            'obligatoriedad' => '1',
            'banderas' => 'i',
            'acciones' => 'e',
            'etiqueta_html' => 'hidden'
        ]);
    }

    /**
     * crea el campo dependencia de un formato
     *
     * @param integer $formatId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-06
     */
    public static function createDependencieField($formatId)
    {
        CamposFormato::newRecord([
            'formato_idformato' => $formatId,
            'nombre' => 'dependencia',
            'etiqueta' => 'DEPENDENCIA DEL CREADOR DEL DOCUMENTO',
            'tipo_dato' => \Doctrine\DBAL\Types\Type::INTEGER,
            'longitud' => '11',
            'obligatoriedad' => '1',
            'banderas' => 'i',
            'acciones' => 'a,e',
            'etiqueta_html' => 'hidden',
            'valor' => '{*buscar_dependencia*}',
            'orden' => 1
        ]);
    }

    /**
     * creaa el campo encabezado de un formato
     *
     * @param integer $formatId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public static function createHeaderField($formatId)
    {
        CamposFormato::newRecord([
            'formato_idformato' => $formatId,
            'nombre' => 'encabezado',
            'etiqueta' => 'ENCABEZADO',
            'tipo_dato' => \Doctrine\DBAL\Types\Type::INTEGER,
            'longitud' => '11',
            'obligatoriedad' => '1',
            'acciones' => 'a,e',
            'etiqueta_html' => 'hidden',
            'predeterminado' => 1
        ]);
    }

    /**
     * creaa el campo firma de un formato
     *
     * @param integer $formatId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public static function createFirmField($formatId)
    {
        CamposFormato::newRecord([
            'formato_idformato' => $formatId,
            'nombre' => 'firma',
            'etiqueta' => 'FIRMAS DIGITALES',
            'tipo_dato' => \Doctrine\DBAL\Types\Type::INTEGER,
            'longitud' => '11',
            'obligatoriedad' => '1',
            'acciones' => 'a,e',
            'etiqueta_html' => 'hidden',
            'predeterminado' => 1
        ]);
    }

    /**
     * creaa el campo firma de un formato
     *
     * @param object $Formato
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-06
     */
    public static function createIdentificatorField($Formato)
    {
        CamposFormato::newRecord([
            'formato_idformato' => $Formato->getPK(),
            'nombre' => "id{$Formato->nombre_tabla}",
            'etiqueta' => $Formato->nombre,
            'tipo_dato' => \Doctrine\DBAL\Types\Type::INTEGER,
            'longitud' => '11',
            'obligatoriedad' => '1',
            'banderas' => 'ai,pk',
            'acciones' => 'a,e',
            'etiqueta_html' => 'hidden'
        ]);
    }

    /**
     * creaa el campo firma de un formato
     *
     * @param object $Formato
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-06
     */
    public static function createParentField($Formato)
    {
        $Parent = $Formato->getParent();
        CamposFormato::newRecord([
            'formato_idformato' => $Formato->getPK(),
            'nombre' => $Parent->nombre_tabla,
            'etiqueta' => $Parent->nombre,
            'tipo_dato' => \Doctrine\DBAL\Types\Type::INTEGER,
            'longitud' => '11',
            'obligatoriedad' => '1',
            'valor' => $Parent->getPK(),
            'banderas' => 'i',
            'acciones' => 'a,e',
            'etiqueta_html' => 'hidden'
        ]);
    }
}
