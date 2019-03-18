<?php 

class AccesoController
{
    /**
     * asigna los permisos iniciales  a los anexos
     *
     * @param int $type constante del modelo Acceso. Acceso::TIPO_VER
     * @param int $typeId identificador del registro. idanexo
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-03-18
     */
    public static function setFullFileAccess($type, $typeId)
    {
        $Funcionario = Funcionario::findByAttributes([
            'login' => 'radicador_salida'
        ]);

        $data = [
            'tipo_relacion' => $type,
            'id_relacion' => $typeId,
            'fk_funcionario' => $_SESSION['idfuncionario'],
            'fecha' => date('Y-m-d H:i:s')
        ];

        $public = Acceso::newRecord([
            'accion' => Acceso::ACCION_VER_PUBLICO,
            'fk_funcionario' => $Funcionario->getPK()
        ] + $data);
        $see = Acceso::newRecord([
            'accion' => Acceso::ACCION_VER
        ] + $data);
        $edit = Acceso::newRecord([
            'accion' => Acceso::ACCION_EDITAR
        ] + $data);
        $delete = Acceso::newRecord([
            'accion' => Acceso::ACCION_ELIMINAR
        ] + $data);

        return $public && $see && $edit && $delete;
    }
}
