<?php
require_once dirname(__FILE__) . '/../Controller/almacenes.php';

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <?php
  //include dirname(__FILE__) . '/../Controller/BusquedaController.php';


  ?>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>

<style>
  body {
    background-color: '#f7f4f9';
  }

  #contenedor video {
    max-width: 100%;
    width: 100%;
  }

  #contenedor {
    max-width: 100%;
    position: relative;
  }

  canvas {
    max-width: 100%;
  }

  canvas.drawingBuffer {
    position: absolute;
    top: 0;
    left: 0;
  }

  .contenedor-precio {}
</style>

<body>
  <header>
    <nav class="navbar navbar-light " style="background-color: #ef4242;">
      <div class="container-fluid ">
        <a class="navbar-brand" href="#" style="color: rgb(255 255 255);">
          <img src="./assets/img/img_logo.webp" alt="" width="50" height="50" class="d-inline-block align-text-top">
          MediPac
        </a>
      </div>
    </nav>
  </header>



  <main>
    <div class=" container-fluid">
      <div class="row">
        <div class="col-12">
          <form>
            <div class="form-row align-items-center">
              <div class="col-auto my-1">
                <label class="mr-sm-2" for="inlineFormCustomSelect">Almacen</label>
                <select class="custom-select mr-sm-2" id="almacen">
                  <?php foreach ($dataAlmacen['datosAlmacen'] as $key => $value) : ?>
                    <option value="<?php echo $value->CNOMBREALMACEN ?>"><?php echo $value->CNOMBREALMACEN ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </form>
        </div>
        <div class="col-12 p-2 m-2">
          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Escribir Codigo
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <small id="helpId" class="form-text text-muted">Codigo</small>
                    <input type="text" class="form-control" name="serie" id="serie" aria-describedby="helpId" placeholder="">
                    <button type="button" onclick="miFunc()" class="btn btn-outline-primary">Buscar</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo" onClick='ponleFocus()'>
                <button class="accordion-button collapsed" onClick='ponleFocus()' type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Escanear codigo
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <small id="helpId" class="form-text text-muted">Lector de codigo de barras</small>
                    <input type="text" class="form-control" id="codigo" aria-describedby="helpId" placeholder="">
                  </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Escanear codigo con camara
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <div class="col-12  text-center p-4">

                    <p id="resultado"></p>
                    <div id="contenedor"></div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>



        <div class="col-12" id="resultado_contenido_error" style="display:none">
          <div class="alert alert-success" role="alert">
           Producto no registrado
          </div>
        </div>


        <div class="col-12" id="resultado_contenido" style="display:block">
          <div class="row">
            <div class=" col container contenedor-precio p-2 m-2 d-flex justify-content-center">
              <div class="row">
                <div class=" col-12 card mb-3" style="max-width: 540px;">
                  <div class="row g-0">
                    <div class="col-md-4">
                      <img src="/assets/img/01BAUMDIGBRAVIT.jpg" width="90%" height="auto" class="p-1 img-fluid rounded-start" alt="">
                    </div>
                    <div class="col-12">
                      <div class="card-body">
                        <h5 class="card-title" id="titulo">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Codigo:
                          <small class="text-muted" id="codigoResultado"></small>
                        </h6>
                        <h6 class="card-subtitle mb-2 text-muted">Existencias por almacen o tienda:
                          <small class="text-muted" id="descripcion"></small>
                        </h6>
                        <div class=" col-12 table-responsive">
                          <table class="table">
                            <thead>
                              <tr>

                                <th scope="col">Alamacen</th>
                                <th scope="col">Disponibles</th>
                                <th scope="col">Sucursales en Xalapa</th>
                                <th scope="col">Sucursales en Veracruz</th>
                                <th scope="col">Mayoreo Veracruz</th>
                                <th scope="col">Precio Especial</th>
                              </tr>
                            </thead>
                            <tbody id="cuerpoTabla">


                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>




              </div>

            </div>
          </div>
        </div>

        <!--
            <div class="col-8" id="resultado_contenido" style="display:block">
              <div class="row">
                <div class=" col-12 container contenedor-precio p-2 m-2">
                 
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4	col-xxl-4 p-0 m-0">
                      <img src="/assets/img/01BAUMDIGBRAVIT.jpg" width="90%" height="auto" class="p-1 rounded-top" alt="">
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8	col-xxl-8  text-end">
                      <div class="row">
                        <div class="col-sm-12" id="titulo">
                        </div>
                        <div class="col-sm-12" id="codigo">
                        </div>
                        <div class="col-sm-12" id="unidad">
                        </div>
                        <div class="col-sm-12" id="clasificacion">
                        </div>
                        <div class="col-sm-12" id="descripcion">
                        </div>
                      </div>
                    </div>
                  
                </div>

              </div>
            </div>

-->

      </div>


    </div>
    </div>

  </main>



  <script src="https://unpkg.com/quagga@0.12.1/dist/quagga.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->


  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const $resultados = document.querySelector("#resultado");
      document.getElementById('resultado_contenido').style.display = 'none';
      Quagga.init({
        inputStream: {
          constraints: {
            width: 800,
            height: 500,
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





    function miFunc() {

      let valor = document.getElementById('serie').value;
      let almacen = document.getElementById('almacen').value;

      // console.log(valor);
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

    function miFuncParametros(valor, nombreAlmacen) {

      // let valor = document.getElementById('serie').value;

      // console.log(valor);
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

      if (jsonResponse.status == 200) {
        document.getElementById('resultado_contenido').style.display = 'block';
        document.getElementById('resultado_contenido_error').style.display = 'none';
        console.log(parseFloat(jsonResponse.datosProductosAlmacen[0].precio_especial).toFixed(2))

        let data = jsonResponse.datosProductos[0];
        document.getElementById('titulo').innerHTML = data.CNOMBREPRODUCTO;
        document.getElementById('codigoResultado').innerHTML = data.CCODIGOPRODUCTO;

        const $cuerpoTabla = document.querySelector("#cuerpoTabla");
       // $cuerpoTabla.removeChild($tr);
        let productos = jsonResponse.datosProductosAlmacen;


        productos.forEach(producto => {

          console.log(parseFloat(producto.mayoreo_Veracruz).toFixed(2))
          // Crear un <tr>
          const $tr = document.createElement("tr");
          // Creamos el <td> de nombre y lo adjuntamos a tr
          let $tdNombre = document.createElement("td");
          $tdNombre.textContent = producto.ALMACEN; // el textContent del td es el nombre
          $tr.appendChild($tdNombre);
          // El td de precio

          // El td del código
          let $tdCodigo = document.createElement("td");
          $tdCodigo.textContent = producto.EXISTENCIA;
          $tr.appendChild($tdCodigo);

          let $tdSucVer = document.createElement("td");
          $tdSucVer.textContent = parseFloat(producto.mayoreo_Veracruz).toFixed(2);
          $tr.appendChild($tdSucVer);

          let $tdPrecioEspecial = document.createElement("td");
          $tdPrecioEspecial.textContent = parseFloat(producto.precio_especial).toFixed(2);
          $tr.appendChild($tdPrecioEspecial);

          let $tdsucxalapa = document.createElement("td");
          $tdsucxalapa.textContent = parseFloat(producto.sucursales_Xalapa).toFixed(2);
          $tr.appendChild($tdsucxalapa);

          let $sucursales_veracruz = document.createElement("td");
          $sucursales_veracruz.textContent = parseFloat(producto.sucursales_veracruz).toFixed(2);
          $tr.appendChild($sucursales_veracruz);
          // Finalmente agregamos el <tr> al cuerpo de la tabla
          
          $cuerpoTabla.appendChild($tr);
          // Y el ciclo se repite hasta que se termina de recorrer todo el arreglo
        });
      } else {

        document.getElementById('resultado_contenido').style.display = 'none';
        document.getElementById('resultado_contenido_error').style.display = 'block';
       
      }


    }



    /*LEctor */
    document.addEventListener("DOMContentLoaded", () => {
      const $codigo = document.querySelector("#codigo");
      let almacenL = document.querySelector('#almacen');

      



      $codigo.addEventListener("keydown", evento => {
        if (evento.keyCode === 13) {
          // El lector ya terminó de leer
          // $codigo.value = "";
          const codigoDeBarras = $codigo.value;
          const codigoAlmacen = almacenL.value;
          // Aquí ya podemos hacer algo con el código. Yo solo lo imprimiré
          console.log("Tenemos un código de barras:");
          console.log(codigoDeBarras);
          console.log(codigoAlmacen);
          miFuncParametros(codigoDeBarras, codigoAlmacen);


          // Limpiar el campo
          $codigo.value = "";
        }
      });
    });

    function ponleFocus() {
      document.getElementById("codigo").focus();
    }
  </script>
</body>

</html>