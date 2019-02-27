<?php
declare(strict_types = 1);
namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190226200312 extends AbstractMigration {

    private $funciones_formato = [
        [
            "nombre" => "{*mostrar_datos_factura*}",
            "nombre_funcion" => "mostrar_datos_factura",
            "parametros" => null,
            "etiqueta" => "mostrar_datos_factura",
            "descripcion" => "",
            "ruta" => "funciones.php",
            "acciones" => "m"
        ],
        [
            "nombre" => "{*mostrar_detalle_factura*}",
            "nombre_funcion" => "mostrar_detalle_factura",
            "parametros" => null,
            "etiqueta" => "mostrar_detalle_factura",
            "descripcion" => "",
            "ruta" => "funciones.php",
            "acciones" => "m"
        ]
        ];

    private $cuerpo = '<table border="0" cellpadding="1" cellspacing="1" style="width:100%">
	<tbody>
		<tr>
			<td>{*mostrar_datos_factura*}</td>
			<td style="width:20%">FACTURA ELECTR&Oacute;NICA</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
			<p>{*fecha_creacion*}</p>
			</td>
			<td>{*mostrar_codigo_qr*}</td>
		</tr>
	</tbody>
</table>
<p>&nbsp;</p>
<p>{*mostrar_detalle_factura*}</p>
';

    public function getDescription(): string {
        return 'Funciones formato factura electronica';
    }

    public function preUp(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function up(Schema $schema): void {
        $conn = $this->connection;

        $idfmt = $conn->fetchColumn("select idformato from formato where nombre = :nombre", [
            'nombre' => "factura_electronica"
        ]);
        if (!empty($idfmt)) {
            foreach ($this->funciones_formato as $fila) {
                $idff = $this->guardar("funciones_formato", $fila, "nombre_funcion");
                if(!empty($idff)) {
                    $idffe = $conn->fetchColumn("select idfunciones_formato_enlace from funciones_formato_enlace where funciones_formato_fk = :funcion AND formato_idformato = :formato", [
                        'funcion' => $idff,
                        'formato' => $idfmt
                    ]);
                    if(empty($idffe)) {
                        $datos = ["funciones_formato_fk" => $idff, "formato_idformato" => $idfmt];
                        $resp = $conn->insert("funciones_formato_enlace", $datos);
                    }
                }
            }
            $cond = ["idformato" => $idfmt];

            $resp = $conn->update("formato", ["cuerpo" => $this->cuerpo], $cond);

        }

    }

    public function postUp(Schema $schema): void {
        $conn = $this->connection;
        $idfmt = $conn->fetchColumn("select idformato from formato where nombre = :nombre", [
            'nombre' => "factura_electronica"
        ]);

        $result = $conn->fetchAll("select idfunciones_formato from funciones_formato where nombre_funcion IN ('mostrar_codigo_qr', 'fecha_creacion')");

        if (!empty($result) && !empty($idfmt)) {
            foreach ($result as $row) {
                $idffe = $conn->fetchColumn("select idfunciones_formato_enlace from funciones_formato_enlace where funciones_formato_fk = :funcion AND formato_idformato = :formato", [
                    'funcion' => $row["idfunciones_formato"],
                    'formato' => $idfmt
                ]);
                if(empty($idffe)) {
                    $datos = ["funciones_formato_fk" => $row["idfunciones_formato"], "formato_idformato" => $idfmt];
                    $resp = $conn->insert("funciones_formato_enlace", $datos);
                }
            }
        }
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
    }

    private function guardar($tabla, $datos, $campo_nombre = "nombre", $idname = null) {
        $conn = $this->connection;

        if (empty($idname)) {
            $idname = "id$tabla";
        }
        $idreg = $conn->fetchColumn("select $idname from $tabla where $campo_nombre = :nombre", [
            'nombre' => $datos[$campo_nombre]
        ]);

        if (!empty($idreg)) {
            $cond = [$idname => $idreg];
            //$datos["formato_idformato"] = $idformato;
            $resp = $conn->update($tabla, $datos, $cond);
        } else {
            $resp = $conn->insert($tabla, $datos);

            if (empty($resp)) {
                $conn->rollBack();
                print_r($conn->errorInfo());
                die("Fallo la creacion del $tabla");
            }
            $idreg = $conn->lastInsertId();
        }
        return $idreg;
    }

}
