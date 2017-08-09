update funciones_formato
set ruta = replace(ruta, '../librerias/', '../../formatos/librerias/')
where ruta like '../librerias/%';

update `modulo` set enlace = replace(enlace, 'formatos/', 'formatos_cliente/')  
WHERE nombre in (select nombre from formato);

update `modulo` set enlace = replace(enlace, 'formatos/', 'formatos_cliente/')  
WHERE nombre in (select concat('crear_',nombre) from formato);

update `modulo` set enlace = replace(enlace, 'formatos/', 'formatos_cliente/') 
where enlace like 'formatos/%/%' and enlace not like 'formatos/arboles%';

update `busqueda_componente` set busqueda_avanzada = replace(busqueda_avanzada, 'formatos/', 'formatos_cliente/') 
where busqueda_avanzada like 'formatos/%/%' and busqueda_avanzada not like 'formatos/arboles%';

update `busqueda` set ruta_libreria = replace(ruta_libreria, 'formatos/', 'formatos_cliente/') 
where ruta_libreria like 'formatos/%/%' and ruta_libreria not like 'formatos/arboles%';

update `busqueda` set ruta_libreria_pantalla = replace(ruta_libreria_pantalla, 'formatos/', 'formatos_cliente/') 
where ruta_libreria_pantalla like 'formatos/%/%' and ruta_libreria_pantalla not like 'formatos/arboles%';
