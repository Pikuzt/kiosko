select
    ap.CCOSTOESTANDAR as precio,
    aP.CCODIGOPRODUCTO as codigo,
    aP.CCODALTERN as codigoProvedor,
    aP.CNOMBREPRODUCTO as NOMBRE,
    admExistenciaCosto.CENTRADASPERIODO12 - admExistenciaCosto.CSALIDASPERIODO12 AS EXISTENCIA,
    CCONTROLEXISTENCIA - aP.CEXISTENCIANEGATIVA AS DIFERENCIA,
    Aa.CNOMBREALMACEN AS ALMACEN,
    admExistenciaCosto.CENTRADASPERIODO12,
    admExistenciaCosto.CSALIDASPERIODO12,
    admExistenciaCosto.CIDEJERCICIO,
    aE.CEJERCICIO,
    aP.CIDVALORCLASIFICACION4,
    round(aP.CPRECIO1, 2) as sucursales_Xalapa,
    round(aP.CPRECIO2, 2) as MAYOREO_XALAPA,
    round(aP.CPRECIO4, 2) as sucursales_veracruz,
    round(aP.CPRECIO5, 2) as precio_especial
from
    admExistenciaCosto
    inner join admProductos aP on admExistenciaCosto.CIDPRODUCTO = aP.CIDPRODUCTO
    inner join admAlmacenes aA on admExistenciaCosto.CIDALMACEN = aA.CIDALMACEN
    inner join admEjercicios aE on admExistenciaCosto.CIDEJERCICIO = aE.CIDEJERCICIO
where
    (
        admExistenciaCosto.CENTRADASPERIODO12 - admExistenciaCosto.CSALIDASPERIODO12
    ) > 0
    and aE.CEJERCICIO = year(Getdate())
    and aA.CNOMBREALMACEN = 'ALACIO'
    and ap.CSTATUSPRODUCTO = 1
    and aP.CCODIGOPRODUCTO = '01ANEROID'
    or aP.CCODALTERN = '01ANEROID'