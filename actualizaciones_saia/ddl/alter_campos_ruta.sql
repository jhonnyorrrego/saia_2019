SELECT * FROM INFORMATION_SCHEMA.COLUMNS 
  WHERE table_name in('anexos', 'anexos_despacho', 'anexos_version', 'caja', 'contenidos_carrusel', 'dependencia', 'documento', 'documento_verificacion', 'expediente', 'funcionario', 'noticia_index', 'pagina', 'paso_acitividad_anexo', 'tareas_listado_anexos', 'version_anexos', 'version_documento', 'version_pagina')
AND COLUMN_NAME in 
('ruta', 'ruta', 'ruta', 'ruta_qr', 'imagen', 'logo', 'pdf', 'ruta_qr', 'ruta_qr', 'foto_original', 'imagen', 'ruta', 'ruta', 'ruta', 'ruta', 'pdf', 'ruta',
'foto_recorte', 'imagen', 'ruta_miniatura')
and TABLE_SCHEMA = 'saia_almacenamiento'
and  	DATA_TYPE like '%varchar%';

SELECT concat('alter table ', TABLE_NAME, ' modify ', COLUMN_NAME, ' varchar(600);') FROM INFORMATION_SCHEMA.COLUMNS 
  WHERE table_name in('anexos', 'anexos_despacho', 'anexos_version', 'caja', 'contenidos_carrusel', 'dependencia', 'documento', 'documento_verificacion', 'expediente', 'funcionario', 'noticia_index', 'pagina', 'paso_acitividad_anexo', 'tareas_listado_anexos', 'version_anexos', 'version_documento', 'version_pagina')
AND COLUMN_NAME in 
('ruta', 'ruta', 'ruta', 'ruta_qr', 'imagen', 'logo', 'pdf', 'ruta_qr', 'ruta_qr', 'foto_original', 'imagen', 'ruta', 'ruta', 'ruta', 'ruta', 'pdf', 'ruta',
'foto_recorte', 'imagen', 'ruta_miniatura')
and TABLE_SCHEMA = 'saia_almacenamiento'
and  	DATA_TYPE like '%varchar%'
and CHARACTER_MAXIMUM_LENGTH < 600;
