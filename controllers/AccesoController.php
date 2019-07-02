<?php 

class AccesoController
{
    /**
     * asigna los permisos iniciales  a los anexos
     *
     * @param int $type constante del modelo Acceso. Acceso::TIPO_VER
     * @param int $typeId identificador del registro. idanexo
     * @param int $userId id del usuario al que se le asignaran los permisos
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-03-18
     */
    public static function setFullAccess($type, $typeId, $userId = 0)
    {
        $userId = $userId ? $userId : $_SESSION['idfuncionario'];

        $data = [
            'tipo_relacion' => $type,
            'id_relacion' => $typeId,
            'fk_funcionario' => $userId,
            'fecha' => date('Y-m-d H:i:s')
        ];

        $public = Acceso::newRecord([
            'accion' => Acceso::ACCION_VER_PUBLICO,
            'fk_funcionario' => Funcionario::RADICADOR_SALIDA
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
