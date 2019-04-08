<?php
 /*
<Clase>
<Nombre>PERMISO</Nombre>
<Parametros></Parametros>
<Responsabilidades>Busca los permisos de un funcionario con respecto a un modulo<Responsabilidades>
<Notas>Esta clase busca los permisos por funcionario y por perfil</Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
 */
class PermisoController
{
    public static $instance;

    var $login;
    var $conn;
    var $acceso_propio;
    var $acceso_grupo;
    var $acceso_total;
    var $idfuncionario;
    var $funcionario_codigo;
    var $perfil;

    /*
<Clase>PERMISO
<Nombre>PERMISO
<Parametros>
<Responsabilidades>Inicializar el objeto permiso actual
<Notas>
<Excepciones>No se Puede Encontrar el Funcionario para Permisos. Si no se encuentra el funcionario en la base de datos
<Salida>
<Pre-condiciones>
<Post-condiciones>
     */
    function __construct()
    {
        global $conn;
        
        $this->login = $_SESSION["LOGIN" . LLAVE_SAIA];
        $this->conn = $conn;
        
        if ($this->acceso_root()) {
            $this->idfuncionario = 0;
            $this->funcionario_codigo = 0;
            $this->perfil = 1;
            return (true);
        } else {
            $funcionario = busca_filtro_tabla("A.idfuncionario,A.funcionario_codigo,A.perfil", "funcionario A", "A.login='" . $this->login . "'", "", $this->conn);
            if ($funcionario["numcampos"]) {
                $this->idfuncionario = $funcionario[0]["idfuncionario"];
                $this->funcionario_codigo = $funcionario[0]["funcionario_codigo"];
                $this->perfil = $funcionario[0]["perfil"];
                return (true);
            }
        }
        if (!isset($_SESSION["LOGIN" . LLAVE_SAIA]))
            salir("No se Puede Encontrar el Funcionario para Permisos");
        else
            alerta("No se Puede Encontrar el Funcionario para Permisos");
        return (false);
    }

    /*
<Clase>PERMISO
<Nombre>acceso_root
<Parametros>
<Responsabilidades>buscar el login del administrador
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
     */
    function acceso_root()
    {
        $configuracion = busca_filtro_tabla("A.valor,A.fecha", "configuracion A", "A.tipo='usuario' AND A.nombre='login_administrador'", "", $this->conn);
        if ($configuracion["numcampos"] && $this->login == $configuracion[0]["valor"])
            return (true);
        else return (false);
    }

    /*
<Clase>PERMISO
<Nombre>acceso_usuario_documento
<Parametros>
<Responsabilidades>inicializa el objeto actual con los permisos que tiene dicho usuario para el documento
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
     */
    function acceso_usuario_documento()
    {
        global $sql;
        if ($this->acceso_root()) {
            $this->acceso_total = "l,a,m,e";
            return (true);
        }
        $acceso = busca_filtro_tabla("*", "funcionario A,permiso B,modulo C", "C.nombre='transferir' AND C.idmodulo=B.modulo_idmodulo AND A.idfuncionario=B.funcionario_idfuncionario AND A.login='" . $this->login . "'", "", $this->conn);
        for ($i = 0; $i < $acceso["numcampos"]; $i++) {
            $this->acceso_propio = $acceso[$i]["caracteristica_propio"];
            $this->acceso_grupo = $acceso[$i]["caracteristica_grupo"];
            $this->acceso_total = $acceso[$i]["caracteristica_total"];
        }
        return (true);
    }

    /*
<Clase>PERMISO
<Nombre>permiso_usuario
<Parametros>$tabla: tabla sobre la que se verifica el permiso
            $accion: accion a realizar sobre la tabla
<Responsabilidades>Verificar si el usuario actual tiene permiso para realizar $accion sobre $tabla
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
     */
    function permiso_usuario($tabla, $accion)
    {
        global $sql;
        $permiso["numcampos"] = 0;
        if ($this->acceso_root() && $accion == 1) {
            return (true);
        }
        if (isset($tabla) && $tabla != "" && @$accion != "" && $this->login != "") {
            $permisos = busca_filtro_tabla("*", "funcionario,permiso,modulo", "funcionario.idfuncionario=permiso.funcionario_idfuncionario AND modulo.idmodulo=permiso.modulo_idmodulo AND funcionario.login='" . $this->login . "' and funcionario.estado=1 AND accion='" . $accion . "' AND modulo.nombre='" . $tabla . "'", "", $this->conn);
            if ($permisos["numcampos"]) {
                return (true);
            } else
                return (false);
        } else if (isset($tabla) && $tabla != "") {
            return ($this->acceso_modulo_perfil($tabla));
        }
        return (false);
    }

    /*
<Clase>PERMISO
<Nombre>asignar_usuario
<Parametros>$login1: nuevo login
<Responsabilidades>Asignar un nuevo login al objeto actual
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
     */
    function asignar_usuario($login1)
    {
        $this->login = $login1;
    }

    /*
<Clase>PERMISO
<Nombre>verifica
<Parametros>$clave: clave a verificar
<Responsabilidades>Verifica que el login y la clave de acceso existan y concuerden
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
     */
    function verifica($clave)
    {
        global $sql;
        $dato = busca_filtro_tabla("*", "funcionario A", "A.login='" . $this->login . "' AND A.clave='" . $clave . "'", "", $this->conn);
        if ($dato["numcampos"] > 0)
            return (true);
        return (false);
    }

    /*
<Clase>PERMISO
<Nombre>acceso_modulo
<Parametros>$nombre: nombre del modulo
<Responsabilidades> Verificar que el permiso para el usuario actual en el modulo $nombre existen
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
     */
    function acceso_modulo($nombre)
    {
        $dato = busca_filtro_tabla("modulo.nombre", "permiso,modulo", "permiso.modulo_idmodulo=modulo.idmodulo AND permiso.funcionario_idfuncionario=" . $this->idfuncionario . " AND modulo.nombre='" . $nombre . "'", "", $this->conn);
        if ($dato["numcampos"])
            return (true);
        return (false);
    }

    /*
<Clase>PERMISO
<Nombre>acceso_modulo_perfil
<Parametros>$nombre: nombre modulo
<Responsabilidades>Verifica si el usuario actual posee permisos a un modulo con nombre=nombre en permiso_perfil
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
     */
    function acceso_modulo_perfil($nombre)
    {
        $dato = busca_filtro_tabla("modulo.nombre", "modulo,permiso_perfil", "permiso_perfil.modulo_idmodulo=modulo.idmodulo AND permiso_perfil.perfil_idperfil in(" . $this->perfil . ") AND modulo.nombre='" . $nombre . "'", "", $this->conn);
        if ($this->acceso_root()) {
            return (true);
        }
        if ($dato["numcampos"]) {
            $denegado = $this->permiso_usuario($nombre, '0');
            if ($denegado)
                return (false);
            else
                return (true);
        } else
            return ($this->acceso_modulo($nombre));
    }

    /**
     * Retorna si tiene o no permiso sobre el modulo
     * 
     * @param string $nombreModulo nombre del modulo
     * @return boolean
     * */
    public static function moduleAccess(string $nombreModulo)
    {
        if(!self::$instance){
            self::$instance = new self;
        }

        return (self::$instance)->acceso_modulo_perfil($nombreModulo);
    }
}
