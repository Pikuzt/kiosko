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

                        <div class="col-7 mt-3">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <!-- <small id="helpId" class="form-text text-muted">Lector de codigo de barras</small> -->
                                <div class="col-4  text-center p-4" id="resultado">

                                    <p id="resultado"></p>
                                    <div id="contenedor"></div>

                                </div>
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

    <script src="https://unpkg.com/quagga@0.12.1/dist/quagga.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
        /*Camara */
        document.addEventListener("DOMContentLoaded", () => {
            const $resultados = document.querySelector("#resultado");
            document.getElementById('resultado_contenido').style.display = 'none';
            Quagga.init({
                inputStream: {
                    constraints: {
                        width: 400,
                        height: 400,
                    },
                    name: "Live",
                    type: "LiveStream",
                    target: document.querySelector('#contenedor'), // Pasar el elemento del DOM
                },
                decoder: {
                    readers: [
                        "code_128_reader",
                        "ean_reader",
                        "ean_8_reader",
                        "code_39_reader",
                        "code_39_vin_reader",
                        "codabar_reader",
                        "upc_reader",
                        "upc_e_reader",
                        "i2of5_reader"
                    ],
                    debug: {
                        showCanvas: true,
                        showPatches: true,
                        showFoundPatches: true,
                        showSkeleton: true,
                        showLabels: true,
                        showPatchLabels: true,
                        showRemainingPatchLabels: true,
                        boxFromPatches: {
                            showTransformed: true,
                            showTransformedBox: true,
                            showBB: true
                        }
                    }
                }
            }, function(err) {
                if (err) {
                    console.log(err);
                    return
                }

                console.log("Iniciado correctamente");
                Quagga.start();
                _scannerIsRunning = true;
            });

            Quagga.onProcessed(function(result) {
                var drawingCtx = Quagga.canvas.ctx.overlay,
                    drawingCanvas = Quagga.canvas.dom.overlay;

                if (result) {
                    if (result.boxes) {
                        drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                        result.boxes.filter(function(box) {
                            return box !== result.box;
                        }).forEach(function(box) {
                            Quagga.ImageDebug.drawPath(box, {
                                x: 0,
                                y: 1
                            }, drawingCtx, {
                                color: "green",
                                lineWidth: 2
                            });
                        });
                    }

                    if (result.box) {
                        Quagga.ImageDebug.drawPath(result.box, {
                            x: 0,
                            y: 1
                        }, drawingCtx, {
                            color: "#00F",
                            lineWidth: 2
                        });
                    }

                    if (result.codeResult && result.codeResult.code) {
                        Quagga.ImageDebug.drawPath(result.line, {
                            x: 'x',
                            y: 'y'
                        }, drawingCtx, {
                            color: 'red',
                            lineWidth: 3
                        });
                    }
                }
            });

            Quagga.onDetected((data) => {
                $resultados.textContent = data.codeResult.code;
                // Imprimimos todo el data para que puedas depurar
                //console.log(data);
                let almacen = document.getElementById('almacen').value;

                fetch('Controller/BusquedaController.php', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            code: data.codeResult.code,
                            almacen: almacen
                        })
                    })
                    .then(response => response.json())
                    .then(datos)
                    .catch(error => console.log('error', error));
            });
        });







        function datos(jsonResponse) {
            document.getElementById('carga').style.display = 'none';
            document.getElementById('contenido_producto').style.display = 'block';
            document.getElementById('contenido_img').style.display = 'block';
            if (jsonResponse.status == 200) {
                document.getElementById('contenido_producto').style.display = 'block';
                document.getElementById('resultado_contenido_error').style.display = 'none';
                let data = jsonResponse.datosProductos[0];
                let productos = jsonResponse.datosProductosAlmacen[0];
                console.log(productos);
                let imgAsignada = './assets/img/'+data.CCODIGOPRODUCTO+'.png'
                imgProducto.src = imgAsignada
                // console.log("Contenido",imgProducto.src = imgAsignada,'Direccion',imgAsignada)
                
                document.getElementById('titulo').innerHTML = data.CNOMBREPRODUCTO;
                document.getElementById('codigoResultado').innerHTML = data.CCODIGOPRODUCTO;
                document.getElementById('almacenProducto').innerHTML = productos.ALMACEN;
                document.getElementById('existenciaProductoActual').innerHTML = productos.EXISTENCIA;
                document.getElementById('sucursalXalapa').innerHTML = '$' + iva(productos.sucursales_Xalapa);
                document.getElementById('sucursalVeracruz').innerHTML = '$' +iva(productos.sucursales_veracruz);
                // document.getElementById('mayoreoVeracruz').innerHTML = parseFloat(productos.sucursales_veracruz).toFixed(2);
                document.getElementById('precioEspecial').innerHTML = '$' + iva(productos.precio_especial);




                // console.log('200');

            } else {
                document.getElementById('contenido_producto').style.display = 'none';
                document.getElementById('resultado_contenido_error').style.display = 'block';
            }
        }

        function ponleFocus() {
            let alamacen = document.getElementById('almacen').value;
            if (alamacen.length != 0) {
                document.getElementById("codigo").focus();
            }



        }

        function iva(Precio){
            //  console.log(Precio)
            let M_iva = parseFloat(Precio).toFixed(2)*0.16
            let TotalFinal = parseFloat(Precio) + parseFloat(M_iva)

            // console.log('Presio:',parseFloat(Precio))
            // console.log('iva:',M_iva)
            // console.log('total:', parseFloat(Precio) + parseFloat(M_iva))
            // return parseFloat(Precio) + parseFloat(M_iva).toFixed(2)
            return TotalFinal.toFixed(2)
        }
    </script>
</body>



</html>