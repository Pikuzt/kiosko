<!DOCTYPE html>
<html lang="en">
<?php
require_once dirname(__FILE__) . '/../Controller/almacenes.php';

?>

<head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <!-- Bootstrap CSS -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

          <title>Document</title>
</head>

<style>
          body {
                    padding: 0;
                    margin: 0;
                    background-image: url("./assets/img/fondo.jpg");

                    /* background-color: black; */
          }

          .bg-teclado {
                    background-color: white;
                    box-shadow: 7px 7px 15px #592A08;
                    border: 1px solid #ccc;
                    border-radius: 10px;
          }
</style>

<body>
          <main class="pac-main  mt-5 ">
                    <section class="pac-logo container  ">
                              <div class="row bg-teclado ">
                                        <div class="col-12 ">

                                                  <div class="col-12  text-center">
                                                            <img class="pac-img-logo" src="./assets/img/logo2.png" width="200" height="100" alt="">
                                                  </div>
                                                  <div class="row  mt-5 p-2">
                                                            <div class="col-12 ">
                                                                      <small id="helpId2" class="form-text text-muted">Almacen</small>
                                                                      <select class=" form-control form-control-sm custom-select mr-sm-2" id="almacen" aria-describedby="helpId2" onchange="ponleFocus()">
                                                                                <option value=""> Seleccion un opcion
                                                                                </option>
                                                                                <?php foreach ($dataAlmacen['datosAlmacen'] as $key => $value) : ?>

                                                                                          <?php if (strcmp($value->CNOMBREALMACEN, '(Ninguno)                                                   ') === 0) : ?>
                                                                                          <?php else : ?>
                                                                                                    <option value="<?php echo $value->CNOMBREALMACEN; ?>">
                                                                                                              <?php echo $value->CNOMBREALMACEN; ?>
                                                                                                    </option>
                                                                                          <?php endif; ?>
                                                                                <?php endforeach; ?>
                                                                      </select>
                                                            </div>

                                                            <div class="col-12 mt-3">
                                                                      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                                                <small id="helpId" class="form-text text-muted">Lector de codigo de barras</small>
                                                                                <input type="text" class="form-control" id="codigo" aria-describedby="helpId" placeholder="">

                                                                      </div>
                                                            </div>

                                                            <div class="col-12 mt-2">
                                                                      <hr>
                                                            </div>

                                                            <div class="col-12" id="resultado_contenido">
                                                                      <div class="row">

                                                                                <div class="col-12 col-sm-12 col-xl-8 col-lg-8 col-md-8 text-center" style="display: none" id="carga">
                                                                                          <strong>Loading...</strong>
                                                                                          <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                                                                                </div>




                                                                                <div class="col-12 col-sm-12 col-xl-8 col-lg-8 col-md-8 text-left" style="display: none" id="contenido_producto">
                                                                                          <div class="col-12 text-center"><strong id="titulo"> Titulo </strong></div>
                                                                                          <div class="col-12 d-flex justify-content-around text-center align-items-center">
                                                                                                    <div>Codigo: <br> <small class="text-muted" id="codigoResultado"></small></div>
                                                                                                    <div>Almacen: <br> <small class="text-muted" id="almacenProducto"></small></div>
                                                                                                    <div>Disponibles: <br> <small class="text-muted" id="existenciaProductoActual"></small>
                                                                                                    </div>
                                                                                          </div>
                                                                                          <div class="col-12 d-flex justify-content-around text-center align-items-center">
                                                                                                    <div>Sucursales en Xalapa: <br> <small class="text-muted" id="sucursalXalapa"></small>
                                                                                                    </div>
                                                                                                    <div>Sucursales en Veracruz: <br> <small class="text-muted" id="sucursalVeracruz"></small></div>
                                                                                                    <div>Precio Especial: <br> <small class="text-muted" id="precioEspecial"></small>
                                                                                                    </div>
                                                                                          </div>
                                                                                </div>


                                                                                <div class="col-12 col-sm-12 col-xl-4 col-lg-4 col-md-4 text-center" style="display: none" id="contenido_img">
                                                                                          <img src="/assets/img/01BAUMDIGBRAVIT.jpg" width="60%" height="auto" class="p-1 img-fluid rounded-start" alt="">
                                                                                </div>


                                                                      </div>
                                                            </div>


                                                            <div class="col-12" id="resultado_contenido_error" style="display:none">
                                                                      <div class="alert alert-success" role="alert">
                                                                                Producto no registrado
                                                                      </div>
                                                            </div>

                                                  </div>

                    </section>
          </main>
          <script>
                    /*LEctor */
                    document.addEventListener("DOMContentLoaded", () => {
                              const $codigo = document.querySelector("#codigo");
                              let almacenL = document.querySelector('#almacen');
                              $codigo.addEventListener("keydown", evento => {
                                        if (evento.keyCode === 13) {
                                                  document.getElementById('carga').style.display = 'block';
                                                  document.getElementById('contenido_producto').style.display = 'none';
                                                  document.getElementById('contenido_img').style.display = 'none';                                                  
                                                  const codigoDeBarras = $codigo.value;
                                                  const codigoAlmacen = almacenL.value;                             


                                                  if (codigoAlmacen.length <= 0) {
                                                            alert('Seleccione un almacen');
                                                  } else {
                                                            buscarProductoEscaneo(codigoDeBarras, codigoAlmacen);
                                                            // Limpiar el campo
                                                            $codigo.value = "";
                                                  }
                                        }
                              });
                    });


                    function buscarProductoEscaneo(valor, nombreAlmacen) {
                              // let valor = document.getElementById('serie').value;
                              // console.log(valor);
                              document.getElementById('carga').style.display = 'block';
                              document.getElementById('contenido_producto').style.display = 'none';
                              document.getElementById('contenido_img').style.display = 'none';
                              fetch('Controller/BusquedaController.php', {
                                                  method: 'POST',
                                                  headers: {
                                                            'Accept': 'application/json',
                                                            'Content-Type': 'application/json'
                                                  },
                                                  body: JSON.stringify({
                                                            code: valor,
                                                            almacen: nombreAlmacen
                                                  })
                                        })
                                        .then(response => response.json())
                                        .then(datos)
                                        .catch(error => console.log('error', error));
                    }



                    function datos(jsonResponse) {
                              document.getElementById('carga').style.display = 'none';
                              document.getElementById('contenido_producto').style.display = 'block';
                              document.getElementById('contenido_img').style.display = 'block';
                              if (jsonResponse.status == 200) {
                                        document.getElementById('contenido_producto').style.display = 'block';
                                        document.getElementById('resultado_contenido_error').style.display = 'none';
                                        let data = jsonResponse.datosProductos[0];
                                        let productos = jsonResponse.datosProductosAlmacen[0];
                                        // console.log(productos);
                                        document.getElementById('titulo').innerHTML = data.CNOMBREPRODUCTO;
                                        document.getElementById('codigoResultado').innerHTML = data.CCODIGOPRODUCTO;
                                        document.getElementById('almacenProducto').innerHTML = productos.ALMACEN;
                                        document.getElementById('existenciaProductoActual').innerHTML = productos.EXISTENCIA;
                                        document.getElementById('sucursalXalapa').innerHTML = '$' + parseFloat(productos.sucursales_Xalapa).toFixed(
                                                  2);
                                        document.getElementById('sucursalVeracruz').innerHTML = '$' + parseFloat(productos.sucursales_veracruz)
                                                  .toFixed(
                                                            2);
                                        // document.getElementById('mayoreoVeracruz').innerHTML = parseFloat(productos.sucursales_veracruz).toFixed(2);
                                        document.getElementById('precioEspecial').innerHTML = '$' + parseFloat(productos.precio_especial).toFixed(
                                                  2);



                                        // console.log('200');

                              } else {
                                        document.getElementById('contenido_producto').style.display = 'none';
                                        document.getElementById('resultado_contenido_error').style.display = 'block';
                              }
                    }

                    function ponleFocus() {
                             let alamacen= document.getElementById('almacen').value;
                             if (alamacen.length != 0){
                              document.getElementById("codigo").focus();
                             }


                             
                    }
          </script>
</body>



</html>