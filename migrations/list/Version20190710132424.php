<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190710132424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->insert('busqueda', array(
            'nombre' => 'busqueda_general',
            'etiqueta' => 'busqueda general',
            'estado' => '1',
            'campos' => 'a.fecha,a.estado,a.ejecutor,a.serie,a.descripcion,a.pdf,a.tipo_radicado,a.plantilla,a.numero,a.tipo_ejecutor,a.fecha_limite',
            'llave' => 'a.iddocumento',
            'tablas' => 'documento a',
            'ruta_libreria' => 'pantallas/documento/librerias.php,pantallas/documento/librerias_flujo.php,pantallas/documento/librerias_transferencias.php,pantallas/documento/librerias_busqueda_avanzada.php',
            'ruta_libreria_pantalla' => 'pantallas/documento/adicionales_js.php',
            'cantidad_registros' => '20',
            'ruta_visualizacion' => 'pantallas/documento/busqueda_avanzada_documento.php?idbusqueda_componente=33',
            'tipo_busqueda' => '1'
        ));
        $busqueda = $this->connection->fetchAll("select idbusqueda from busqueda where nombre='busqueda_general'");

        $this->connection->insert('busqueda_componente', [
            'busqueda_idbusqueda' => $busqueda[0]['idbusqueda'],
            'tipo' => '3',
            'conector' => '2',
            'url' => 'pantallas/busquedas/consulta_busqueda_documento.php',
            'etiqueta' => 'Busqueda general',
            'nombre' => 'busqueda_general',
            'orden' => '1',
            'info' => 'numero|{*numero*}|center|-|descripcion|{*descripcion*}|center|-|fecha|{*fecha*}',
            'exportar_encabezado' => NULL,
            'encabezado_componente' => '',
            'estado' => '2',
            'ancho' => '470',
            'cargar' => '2',
            'campos_adicionales' => NULL,
            'tablas_adicionales' => 'buzon_salida z, formato c',
            'ordenado_por' => 'a.fecha',
            'direccion' => 'ASC',
            'agrupado_por' => 'a.iddocumento',
            'busqueda_avanzada' => 'views/buzones/busqueda_general.php',
            'acciones_seleccionados' => '',
            'modulo_idmodulo' => '0',
            'menu_busqueda_superior' => NULL,
            'enlace_adicionar' => NULL,
            'encabezado_grillas' => NULL
        ]);
        $busqueda_componente = $this->connection->fetchAll("select idbusqueda_componente from busqueda_componente where nombre='busqueda_general'");

        $this->connection->insert('busqueda_condicion', [
            'busqueda_idbusqueda' => 0,
            'fk_busqueda_componente' => $busqueda_componente[0]['idbusqueda_componente'],
            'codigo_where' => "lower(a.estado)<>'eliminado' AND a.iddocumento=z.archivo_idarchivo {*filtrar_funcionario@funcionario*} AND lower(a.plantilla)=c.nombre {*filtro_categoria@categoria*}",
            'etiqueta_condicion' => "busqueda_general"
        ]);

        $modulo = $this->connection->fetchAll("select idmodulo from modulo where nombre ='documento'");
        $this->connection->insert('modulo', [
            'pertenece_nucleo' => 1,
            'nombre' => 'busqueda_general',
            'tipo' => 2,
            'imagen' => 'fa fa-th',
            'etiqueta' => 'Busqueda general',
            'enlace' => 'views/buzones/grilla.php?idbusqueda_componente=' . $busqueda_componente[0]['idbusqueda_componente'],
            'cod_padre' => $modulo[0]['idmodulo'],
            'orden' => 6
        ]);
    }

    public function down(Schema $schema): void
    {
        $this->connection->delete('busqueda', [
            'nombre' => 'busqueda_general'
        ]);

        $this->connection->delete('busqueda_componente', [
            'nombre' => 'busqueda_general'
        ]);

        $this->connection->delete('busqueda_condicion', [
            'etiqueta_condicion' => 'busqueda_general'
        ]);

        $this->connection->delete('modulo', [
            'nombre' => 'busqueda_general'
        ]);
    }
}
