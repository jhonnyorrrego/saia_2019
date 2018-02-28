// Genera clases php
../vendor/bin/doctrine orm:convert-mapping --namespace="Saia\\" --force --from-database annotation ./ruta_salida

//Genera archivos xml. Mas rapido
../vendor/bin/doctrine orm:convert-mapping --namespace="Saia\\" --force --from-database xml ./ruta_salida

//Genera las entidades
../vendor/bin/doctrine orm:generate-entities aqui/

//Recrear la bdd desde el ORM
../vendor/bin/doctrine orm:schema-tool:create

//Validar el squema contra el ORM
../vendor/bin/doctrine orm:validate-schema

//Peligroso, recrea los objetos en bdd
../vendor/bin/doctrine orm:schema-tool:update --force --full-database