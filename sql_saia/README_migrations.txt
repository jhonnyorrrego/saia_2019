En las carpetas migraciones_[my|ora|mssql|pg] Editar/Crear el archivo migrations.yml con los siguientes datos

name: Migrations
migrations_namespace: Migrations
table_name: migrations
migrations_directory: migrations

En las carpetas migracioes_[my|ora|mssql|pg] Editar/Crear el archivo migrations-db.php con los datos de conexión a bdd
<?php
return [
    'dbname' => 'saia_release1',
    'user' => 'saia',
    'password' => 'clave',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];

Desde la carpeta migracioes_[my|ora|mssql|pg] (migracioes_my) ejecutar
../../vendor/bin/doctrine-migrations migrations:generate

En windows:
php ../../vendor/doctrine/migrations/bin/doctrine-migrations.php migrations:generate

Se creará en la carpeta migrations un archivo Version<fecha_actual_con_hora>.php

Modificar el archivo usando como plantilla : migrations/VersionPlantilla.php

En el archivo migrations/VersionPlantilla.php se muestran ejemplos de ejecución de SQL y como agregar otros métodos de soporte para function up(Schema $schema)

Una vez modificada la clase que se genera, se debe ejecutar
../../vendor/bin/doctrine-migrations migrations:migrate 

En windows:
php ../../vendor/doctrine/migrations/bin/doctrine-migrations.php migrations:migrate


Opcionalmente se puede pasar el parámetro --write-sql para generar un .sql de las sentencias ejecutadas.

DEVOLVER UNA MIGRACION

../../vendor/bin/doctrine-migrations migrations:execute YYYYMMDDHHMMSS --down


Resumen:

1. Use el command de consola para generar la migracion (/ruta_saia/vendor/bin/doctrine-migrations migrations:generate)
2. Modifique la migración para cambiar la estructura de la base de datos (tablas, campos, etc).
3. Use el metodo postUp para modificar los datos (insert, update, delete)
4. Haga todos los drop al final del metodo postUp
5. Si es posible ejecute consultas SQL simples para migrar los datos
   Si un simple SQL no puede hacer el trabajo, use PHP dentro del metodo postUp ejecutando consultas con Doctrine\DBAL\Connection ($this->connection)
6. Ejecute las migraciones (/ruta_saia/vendor/bin/doctrine-migrations migrations:migrate)

