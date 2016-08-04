[{
"content": "$${1:variable}=busca_filtro_tabla(${2:''},${3:''},${4:''},${5:''},${6:conn});",
"name": "busca_filtro_tabla",
"tabTrigger": "saia_bft"
},{
"content": "$${1:max_salida} = 6; $${1:ruta_db_superior} = $${1:ruta} = ''; while ($${1:max_salida} > 0) {if (is_file($${1:ruta} . 'db.php')) {$${1:ruta_db_superior} = $${1:ruta};}$${1:ruta}.='../';$${1:max_salida}--;}\n\ninclude_once($${1:ruta_db_superior} . 'db.php');",
"name": "ruta_superior",
"tabTrigger": "saia_ruta"
}]