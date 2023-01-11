<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>

<body>
  <header>
    <nav class="navbar navbar-light " style="background-color: #e3f2fd;">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="https://img2.freepng.es/20180514/ucw/kisspng-phoenix-logo-drawing-clip-art-5af979a0124443.8935246015262990400748.jpg" alt="" width="30" height="24" class="d-inline-block align-text-top">
          Titulo
        </a>
      </div>
    </nav>
  </header>


  <style>
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
  </style>
  <main>

    <div class="container-fluid">
      <div class="row">
        <div class="col-6 mt-5">
          <div class="row mb-3">
            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">
              Consulta de articulo
            </label>
            <div class="col-sm-10">
              <input type="email" class="form-control form-control-sm" id="colFormLabelSm" placeholder="">
            </div>
          </div>

          <div class="row mb-3">
            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">
              Pieza
            </label>
            <div class="col-sm-10">
              <input type="email" class="form-control form-control-sm" id="colFormLabelSm" placeholder="">
            </div>
          </div>

          <div class="row mb-3">
            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">
              Proveedor
            </label>
            <div class="col-sm-10">
              <input type="email" class="form-control form-control-sm" id="colFormLabelSm" placeholder="">
            </div>
          </div>

          <div class="row mb-3">
            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">
              Descripcion
            </label>
            <div class="col-sm-10">
              <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                <label for="floatingTextarea2">Comments</label>
              </div>
            </div>
          </div>




        </div>
        <div class="col-6 p-0">
          <img src="https://w.wallhaven.cc/full/9m/wallhaven-9mjoy1.png" class="img-fluid rounded-top" alt="">
        </div>
      </div>
    </div>

  </main>

  <p id="resultado">Aquí aparecerá el código</p>
  <p>A continuación, el contenedor: </p>
  <div id="contenedor"></div>

  <script src="https://unpkg.com/quagga@0.12.1/dist/quagga.min.js"></script>
  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->


  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const $resultados = document.querySelector("#resultado");
      Quagga.init({
        inputStream: {
          constraints: {
            width: 1920,
            height: 1080,
          },
          name: "Live",
          type: "LiveStream",
          target: document.querySelector('#contenedor'), // Pasar el elemento del DOM
        },
        decoder: {
          readers: ["ean_reader"]
        }
      }, function(err) {
        if (err) {
          console.log(err);
          return
        }
        console.log("Iniciado correctamente");
        Quagga.start();
      });

      Quagga.onDetected((data) => {
        $resultados.textContent = data.codeResult.code;
        // Imprimimos todo el data para que puedas depurar
        console.log(data);
      });
    });
  </script>
</body>

</html>