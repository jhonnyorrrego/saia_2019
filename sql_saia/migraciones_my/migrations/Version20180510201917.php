<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180510201917 extends AbstractMigration {

    /**
     *
     * @param Schema $schema
     */
    public function up(Schema $schema) {
        date_default_timezone_set("America/Bogota");
        $this->platform->registerDoctrineTypeMapping('enum', 'string');
        $table = $schema->getTable('pantalla');
        $this->abortIf(!$table, 'No ha configurado este SAIA para pantallas');
        $table->addColumn("cuerpo_pantalla", "text", [
            'collate' => 'utf8_unicode_ci',
            'charset' => 'utf8',
            "notnull" => false
        ]);
        $table->addColumn("accion_eliminar", "integer", [
            "length" => 11,
            "notnull" => true,
            "default" => 2
        ]);
        
        $conn = $this->connection;

        $conn->beginTransaction();
                 
        $modulo = [
            'pertenece_nucleo' => 1,
            'nombre' => 'pantallas',
            'tipo' => 'secundario',
            'imagen' => 'botones/principal/admin_formatos.png',
            'etiqueta' => 'Admin. Pantallas',
            'enlace' => ' ',
            'destino' => 'centro',
            'cod_padre' => 2,
            'orden' => 1,
            'ayuda' => 'Permite generar pantallas y particularmente formatos',
            'parametros' => '',
            'busqueda_idbusqueda' => 0,
            'permiso_admin' => 1,
            'busqueda' => '',
            'enlace_pantalla' => 0
        ];

        $idmodulo = $this->guardar_modulo($modulo);
        
        $busqueda = [
          'nombre' => 'pantallas',
          'etiqueta' => 'Pantallas',
          'estado' => '1',
          'campos' => '',
          'llave' => 'A.idpantalla',
          'tablas' => '',
          'ruta_libreria' => 'pantallas/pantallas/librerias.php',
          'ruta_libreria_pantalla' => '',
          'cantidad_registros' => 20,
          'tiempo_refrescar' => 500,
          'ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php',
          'tipo_busqueda' => 1,
          'elastic' => 0
        ];

        $idbusq = $this->guardar_busqueda($busqueda);

        $componente1 = [
          'busqueda_idbusqueda' => $idbusq,
          'tipo' => '3',
          'conector' => '2',
          'url' => 'pantallas/busquedas/consulta_busqueda.php',
          'etiqueta' => 'Listar pantallas',
          'nombre' => 'listado_pantallas',
          'orden' => 2,
          'info' => '<div id=\'resultado_pantalla_{*idpantalla*}\' class=\'well\'><table style="width:40%;font-size:8pt;font-family:arial;border-collapse:collapse" border="1px"><tr><td style="width:20%">Nombre</td><td style="text-align:center;width:20%">Pdf</td></tr><tr><td><b><a class="kenlace_saia" enlace="pantallas/generador/generador_pantalla.php?idpantalla={*idpantalla*}" conector=\'iframe\' titulo=\'Pantalla {*etiqueta*}\' style="cursor:pointer">{*etiqueta*}-{*idpantalla*}</a></b></td><td style="text-align:center">{*pdf_funcion@idpantalla*}</td></tr></table></div>',
          'exportar' => NULL,
          'encabezado_componente' => '',
          'estado' => 2,
          'cargar' => 2,
          'campos_adicionales' => 'A.nombre,A.librerias,A.etiqueta,A.funcionario_idfuncionario,A.ayuda,A.banderas,A.tiempo_autoguardado',
          'tablas_adicionales' => 'pantalla A',
          'ordenado_por' => 'A.etiqueta',
          'direccion' => 'ASC',
          'agrupado_por' => '',
          'busqueda_avanzada' => '',
          'acciones_seleccionados' => '',
          'modulo_idmodulo' => $idmodulo,
          'menu_busqueda_superior' => 'menu_superior_adicionar@'.$idbusq,
          'enlace_adicionar' => NULL
        ];

        $idcmp1 = $this->guardar_componente($componente1);

        $cond1 = [
            "fk_busqueda_componente" => $idcmp1,
            "codigo_where" => "1=1",
            "etiqueta_condicion" => "condicion_listado_pantallas"
        ];

        $resp1 = $this->guardar_condicion($cond1);
        
        $enlace_modulo = 'pantallas/buscador_principal.php?idbusqueda='.$idbusq.'&cmd=resetall';
        
        $datos_mod = [
            'enlace' => $enlace_modulo
        ];
        $ident_mod = [
            'idmodulo' => $idmodulo
        ];
        $resp = $conn->update('modulo', $datos_mod, $ident_mod);
        
        
        $conn->commit();

    }

    public function postUp(Schema $schema) {
        
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        date_default_timezone_set("America/Bogota");
        $this->platform->registerDoctrineTypeMapping('enum', 'string');
        $table = $schema->getTable('pantalla');
        $table->dropColumn("cuerpo_pantalla");
        $table->dropColumn("accion_eliminar");
    }
    private function guardar_busqueda($datos) {
        if (empty($datos)) {
            return false;
        }

        $conn = $this->connection;

        $result = $conn->fetchAll("select idbusqueda from busqueda where nombre = :nombre", [
            'nombre' => $datos["nombre"]
        ]);

        $idbusq = null;
        if (!empty($result)) {
            $idbusq = $result[0]["idbusqueda"];
        } else {
            $resp = $conn->insert('busqueda', $datos);

            if (empty($resp)) {
                $conn->rollBack();
                print_r($conn->errorInfo());
                die("Fallo la creacion de la busqueda");
            }
            $idbusq = $conn->lastInsertId();
        }
        return $idbusq;
    }

    private function guardar_componente($datos) {
        if (empty($datos)) {
            return false;
        }

        $conn = $this->connection;

        $result = $conn->fetchAll("select idbusqueda_componente from busqueda_componente where nombre = :nombre", [
            'nombre' => $datos["nombre"]
        ]);

        $idbusq = null;
        if (!empty($result)) {
            $idbusq = $result[0]["idbusqueda_componente"];
        } else {
            $resp = $conn->insert('busqueda_componente', $datos);

            if (empty($resp)) {
                $conn->rollBack();
                print_r($conn->errorInfo());
                die("Fallo la creacion de la busqueda_componente");
            }
            $idbusq = $conn->lastInsertId();
        }
        return $idbusq;
    }

    private function guardar_condicion($datos) {
        if (empty($datos)) {
            return false;
        }

        $conn = $this->connection;

        $result = $conn->fetchAll("select idbusqueda_condicion from busqueda_condicion where etiqueta_condicion  = :etiqueta_condicion", [
            'etiqueta_condicion' => $datos["etiqueta_condicion"]
        ]);

        $idbusq = null;
        if (!empty($result)) {
            $idbusq = $result[0]["idbusqueda_condicion"];
        } else {
            $resp = $conn->insert('busqueda_condicion', $datos);

            if (empty($resp)) {
                $conn->rollBack();
                print_r($conn->errorInfo());
                die("Fallo la creacion de la busqueda_condicion");
            }
            $idbusq = $conn->lastInsertId();
        }
        return $idbusq;
    }
    
    private function guardar_modulo($datos) {
        if (empty($datos)) {
            return false;
        }

        $conn = $this->connection;

        $result = $conn->fetchAll("select idmodulo from modulo where nombre = :nombre", [
            'nombre' => $datos["nombre"]
        ]);

        $idmodulo = null;
        if (!empty($result)) {
            $idmodulo = $result[0]["idmodulo"];
        } else {
            $resp = $conn->insert('modulo', $datos);

            if (empty($resp)) {
                $conn->rollBack();
                print_r($conn->errorInfo());
                die("Fallo la creacion del modulo");
            }
            $idmodulo = $conn->lastInsertId();
        }
        return $idmodulo;
    }

}
