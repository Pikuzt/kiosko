<?php
require_once dirname(__FILE__) . '/../config/conn.php';

class mModal
{

       public function busqueda($valor, $almacen)
       {

              $resultAlmacen = array_merge($this->getBusquedadB1($valor, $almacen), $this->getBusquedadB2($valor, $almacen));
              // var_dump($this->getBusquedadB1($valor, $almacen));

              if ($resultAlmacen) {
                     return $array = [
                            'success' => true,
                            'message' => 'Datos Producto obtenidos correctamente',
                            'datosProductos' => $this->getProductosB1($valor),
                            'datosProductosAlmacen' => $resultAlmacen,
                            'status' => 200
                     ];
              } else {
                     return $array = [
                            'success' => true,
                            'message' => 'Datos no optenidos correctamente',
                            'datosProductos' => [],
                            'datosProductosAlmacen' => [],
                            'status' => 400
                     ];
              }

              // $datosDasededatos1 = $this->getBusquedadB1($valor, $almacen);
       }




       public function getProductosB1($valor)
       {
              $conexion = new DB();
              $conexion = $conexion->conn();
              $sql = "
                           select * from (admProductos inner join admUnidadesMedidaPeso on
                           admProductos.CIDUNIDADBASE = admUnidadesMedidaPeso.CIDUNIDAD)
                           inner join admClasificacionesValores dbo_admClasificacionesValores ON
                           admProductos.CIDVALORCLASIFICACION1 = dbo_admClasificacionesValores.CIDVALORCLASIFICACION
                           where admProductos.CCODIGOPRODUCTO = '$valor' or admProductos.CCODALTERN ='$valor';
                           ";

              $query = $conexion->prepare($sql);
              $query->execute();
              return $result = $query->fetchAll(PDO::FETCH_OBJ);
       }

       public function getProductosB2($valor)
       {
              $conexion = new DB();
              $conexion = $conexion->Base2();
              $sql = "
                           select * from (admProductos inner join admUnidadesMedidaPeso on
                           admProductos.CIDUNIDADBASE = admUnidadesMedidaPeso.CIDUNIDAD)
                           inner join admClasificacionesValores dbo_admClasificacionesValores ON
                           admProductos.CIDVALORCLASIFICACION1 = dbo_admClasificacionesValores.CIDVALORCLASIFICACION
                           where admProductos.CCODIGOPRODUCTO = '$valor' 
                           or admProductos.CCODALTERN ='$valor';";

              $query = $conexion->prepare($sql);
              $query->execute();
              return $result = $query->fetchAll(PDO::FETCH_OBJ);
       }


       public function getBusquedadB1($valor, $almacen)
       {
              $conexion = new DB();
              $conexion = $conexion->conn();






              $sql2 = "
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
              ) >= 0
              and aE.CEJERCICIO = year(Getdate())
              and aA.CNOMBREALMACEN = '$almacen'
              and ap.CSTATUSPRODUCTO = 1              
                              
              ";


              $CCODIGOPRODUCTO = "and aP.CCODIGOPRODUCTO = '$valor'; ";
              $CCODALTERN = "and aP.CCODALTERN = '$valor' ;";
              if (is_numeric($valor)) {
                     $query = $sql2 . $CCODALTERN;
              } else {
                     $query = $sql2 . $CCODIGOPRODUCTO;
              }

              // var_dump($query);
              // var_dump(is_numeric($valor));

              $queryAlmacen = $conexion->prepare($query);
              $queryAlmacen->execute();
              $resultAlmacen = $queryAlmacen->fetchAll(PDO::FETCH_OBJ);

              // var_dump($resultAlmacen);
              return $resultAlmacen;
       }


       public function getBusquedadB2($valor, $almacen)
       {

              $conexion = new DB();
              $conexion = $conexion->Base2();

              $sql2 = "
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
    ) >= 0
    and aE.CEJERCICIO = year(Getdate())
    and aA.CNOMBREALMACEN = '$almacen'
    and ap.CSTATUSPRODUCTO = 1
          
                    ";


                    $CCODIGOPRODUCTO = "and aP.CCODIGOPRODUCTO = '$valor'; ";
                    $CCODALTERN = "and aP.CCODALTERN = '$valor' ;";
                    if (is_numeric($valor)) {
                           $query = $sql2 . $CCODALTERN;
                    } else {
                           $query = $sql2 . $CCODIGOPRODUCTO;
                    }

                     // var_dump($query);
              // var_dump(is_numeric($valor));

              $queryAlmacen = $conexion->prepare($query);
              $queryAlmacen->execute();
              $resultAlmacen = $queryAlmacen->fetchAll(PDO::FETCH_OBJ);
              // var_dump($sql2);
              return $resultAlmacen;
       }


       public function getAlmacen()
       {
              return $array = [
                     'success' => true,
                     'message' => 'Datos Producto obtenidos correctamente',
                     'datosAlmacen' => array_merge($this->getAlmacenB1(), $this->getAlmacenB2()),
                     'status' => 200
              ];
       }


       public function getAlmacenB1()
       {
              $conexion = new DB();
              $conexion = $conexion->conn();
              $sql = " select CNOMBREALMACEN from admAlmacenes;";


              $query = $conexion->prepare($sql);
              $query->execute();
              return $result = $query->fetchAll(PDO::FETCH_OBJ);
       }

       public function getAlmacenB2()
       {
              $conexion = new DB();
              $conexion = $conexion->Base2();
              $sql = " select CNOMBREALMACEN from admAlmacenes;";


              $query = $conexion->prepare($sql);
              $query->execute();
              return $result = $query->fetchAll(PDO::FETCH_OBJ);
       }
}