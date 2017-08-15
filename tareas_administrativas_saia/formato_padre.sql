SELECT T2.idformato, T2.nombre,T2.etiqueta
FROM (
    SELECT
        @r AS _id,
        (SELECT @r := cod_padre FROM formato WHERE idformato = _id) AS parent_id,
        @l := @l + 1 AS lvl
    FROM
        (SELECT @r := 313, @l := 0) vars,
        formato m
    WHERE @r <> 0) T1
JOIN formato T2
ON T1._id = T2.idformato
ORDER BY T1.lvl DESC;

