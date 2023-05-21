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
                        <!-- <div class="col-12 ">
                            <small id="helpId2" class="form-text text-muted">Almacen</small>
                            <select class=" form-control form-control-sm custom-select mr-sm-2" id="almacen" aria-describedby="helpId2" required>
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
                        </div> -->



                        <!-- <div class="col-12 mt-3">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <small id="helpId" class="form-text text-muted">Codigo</small>
                                <input type="text" class="form-control" name="serie" id="serie"
                                    aria-describedby="helpId" placeholder="" require>
                                <button type="button" onclick="buscarProducto()"
                                    class="btn btn-outline-primary">Buscar</button>

                            </div>
                        </div> -->

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

                                    <div class="col-12 text-center">
                                        <div>Codigo: <br> <small class="text-muted" id="codigoResultado"></small></div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-around text-center align-items-center">

                                        <div>Sucursales en Xalapa: <br> <small class="text-muted" id="sucursalXalapa"></small>
                                        </div>
                                        <div>Sucursales en Veracruz: <br> <small class="text-muted" id="sucursalVeracruz"></small></div>
                                        <div>Precio Especial: <br> <small class="text-muted" id="precioEspecial"></small>
                                        </div>
                                        <hr>
                                    </div>

                                    <style>
                                        .scrodd {
                                            height: 250px;
                                            line-height: 1em;
                                            overflow-x: hidden;
                                            overflow-y: scroll;
                                            width: 100%;
                                            border: 1px solid;
                                        }
                                    </style>

                                    <div class="col-12 d-flex justify-content-around text-center align-items-center">




                                        <div class="col-12 text-center table-responsive scrodd">

                                            <table class="table table-hover">

                                                <thead>
                                                    <tr>
                                                        <th scope="col">Almacen</th>
                                                        <th scope="col">Piezas</th>
                                                        <th scope="col">Activo</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tblDatos"></tbody>
                                            </table>
                                        </div>




                                        <!-- <div>Almacen: <br> <small class="text-muted" id="almacenProducto"></small></div> -->

                                    </div>

                                </div>


                                <div class="col-12 col-sm-12 col-xl-4 col-lg-4 col-md-4 text-center " style="display: none" id="contenido_img">
                                    <img src="./assets/img/01BAUMDIGBRAVIT.jpg" width="60%" height="auto" class="p-1 img-fluid rounded-start img-contenido" alt="">
                                </div>


                            </div>
                        </div>
                        <div class="col-12" id="resultado_contenido_error" style="display:none">
                            <div class="alert alert-success" role="alert">
                                Producto no registrado
                            </div>
                        </div>
                        <style>
                        .drawingBuffer {
                            width: 1px;
    
                          
                            }

                            video {
                                max-width: 324px;
                            }
                        </style>

                        <div class="col-12" id="resultado"></div>
                        <div class="col-12" id="camera"></div>

                        


                        

                    </div>

        </section>
    </main>


    <script src="./quagga.min.js"></script>
    <script>
        Quagga.init({
            inputStream: {
                constraints: {
                        width: 300,
                        height: 300,
                    },
                name: "Live",
                type: "LiveStream",
                target: document.querySelector('#camera') // Or '#yourElement' (optional)
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
                ]
            }
        }, function(err) {
            if (err) {
                console.log(err);
                return
            }
            console.log("Initialization finished. Ready to start");
            Quagga.start();
        });

        Quagga.onDetected(function(data) {

            let almacen = 'muestra';
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
                        code: data.codeResult.code,
                        almacen: almacen
                    })
                })
                .then(response => response.json())
                .then(datos)
                .catch(error => console.log('error', error));


            console.log(data.codeResult.code);
            document.querySelector('#resultado').innerText = data.codeResult.code;
        });
    </script>
    <script>
        function buscarProducto() {
            let valor = document.getElementById('serie').value;
            let almacen = 'muestra';


            //  almacen='muestra'




            if (valor.length <= 0) {
                alert('favor de registra un numero de serie');
            } else {
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
                            almacen: almacen
                        })
                    })
                    .then(response => response.json())
                    .then(datos)
                    .catch(error => console.log('error', error));
            }


        }

        function datos(jsonResponse) {
            document.getElementById('carga').style.display = 'none';
            document.getElementById('contenido_producto').style.display = 'block';
            document.getElementById('contenido_img').style.display = 'block';

            if (jsonResponse.status == 200) {
                document.getElementById('contenido_producto').style.display = 'block';
                document.getElementById('contenido_img').style.display = 'block';
                document.getElementById('resultado_contenido_error').style.display = 'none';
                var imgProducto = document.querySelector(".img-contenido");



                let data = jsonResponse.datosProductos[0];
                let productos = jsonResponse.datosProductosAlmacen[0];
                let tabla = jsonResponse.tablaDatosAlmacen;

                let imgAsignada = './assets/img/' + productos.codigo + '.png'
                // console.log("Contenido",imgProducto.src = imgAsignada,'Direccion',imgAsignada)


                // console.log("precio con iva:",iva(productos.sucursales_Xalapa) );

                console.log(productos);
                imgProducto.src = imgAsignada
                document.getElementById('titulo').innerHTML = productos.NOMBRE;
                document.getElementById('codigoResultado').innerHTML = productos.codigo;

                // document.getElementById('almacenProducto').innerHTML = productos.ALMACEN;
                // document.getElementById('existenciaProductoActual').innerHTML = productos.EXISTENCIA;
                document.getElementById('sucursalXalapa').innerHTML = '$' + iva(productos.sucursales_Xalapa);
                document.getElementById('sucursalVeracruz').innerHTML = '$' + iva(productos.sucursales_veracruz);
                // document.getElementById('mayoreoVeracruz').innerHTML = parseFloat(productos.sucursales_veracruz).toFixed(2);
                document.getElementById('precioEspecial').innerHTML = '$' + iva(productos.precio_especial);


                console.log('datos de tabla', tabla)
                const thead = document.querySelectorAll('tbody');
                const filas = document.querySelectorAll('tbody > tr')

                var table3 = document.getElementById('tblDatos');
                var rowCount = table3.rows.length;
                console.log(rowCount);

                if (rowCount > 0) {

                    for (i = 0; i < tabla.length; i++) {
                        table3.deleteRow(0)
                    }
                }

                for (let i = 0; i < tabla.length; i++) {
                    let filaActual = document.getElementById('tblDatos').insertRow(i);
                    for (let j = 0; j < 3; j++) {
                        let celda = filaActual.insertCell(j);
                        if (j == 0) {
                            celda.innerHTML = tabla[i].almacen;
                        }
                        if (j == 1) {
                            celda.innerHTML = tabla[i].disponibles;
                        }
                        if (j == 2) {
                            celda.innerHTML = (tabla[i].status == 1) ? 'si' : 'no';
                        }
                    }
                }
            } else {
                document.getElementById('contenido_producto').style.display = 'none';
                document.getElementById('contenido_img').style.display = 'none';
                document.getElementById('resultado_contenido_error').style.display = 'block';

                // contenido_img
            }



        }


        function iva(Precio) {
            //  console.log(Precio)
            let M_iva = parseFloat(Precio).toFixed(2) * 0.16
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