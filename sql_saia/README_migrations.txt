Editar/Crear el archivo migrations.yml con los siguientes datos

name: Migrations
migrations_namespace: Migrations
table_name: migrations
migrations_directory: migrations

Editar/Crear el archivo migrations-db.php con los datos de conexión a bdd
<?php
return [
    'dbname' => 'saia_release1',
    'user' => 'saia',
    'password' => 'clave',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];

Desde esta carpeta  (sql_saia) ejecutar
../vendor/bin/doctrine-migrations migrations:generate

Se creará en la carpeta migrations un archivo Version<fecha_actual_con_hora>.php

Modificar el archivo usando como plantilla : migrations/VersionPlantilla.php

En el archivo migrations/VersionPlantilla.php se muestran ejemplos de ejecución de SQL y como agregar otros métodos de soporte para function up(Schema $schema)

Una vez modificada la clase que se genera, se debe ejecutar
../vendor/bin/doctrine-migrations migrations:migrate 

Opcionalmente se puede pasar el parámetro --write-sql para generar un .sql de las sentencias ejecutadas.

