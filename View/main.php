<!DOCTYPE html>
<html lang="en">

<head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <!-- <link rel="stylesheet" href="./style.css"> -->

          <!-- <link rel="stylesheet" href="style.css"> -->
          <!-- Bootstrap CSS -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

          <title>Kiosko</title>
</head>

<style>
          body {
                    padding: 0;
                    margin: 0;
                    background-image: url("./assets/img/fondo.jpg");

                    /* background-color: black; */
          }

          .pac-cadr-botton {
                    width: 150px;
                    height: 250px;
                    border-radius: 10px;
                    background-color: #fc9699;
                    color: #ffff;
                    position: relative;
                    left: 30%;


          }

          .pac-img-card {
                    max-width: 70%;
                    width: 100%;
                    position: relative;
          }

          .pac-text-title {
                    background-color: #ffffff;
                    width: 100%;
                    color: #000;
                    margin: 0;
                    padding: 0;
                    border-radius: 10px 10px 0px 0px;

          }

          .pac-img-logo {
                    max-width: 20%;
                    width: 70px;
                    height: 50px;
                    padding: 0;
                    margin: 0;
                    position: relative;
                    top: 0;
          }

          .pac-logo {
                    width: 100%;
                    background-color: #ffff;
          }
</style>

<body>
          <main class="pac-main">
                    <section class="pac-logo ">
                              <img class="pac-img-logo" src="./assets/img/img_logo.webp" alt=""> MEDIPAC

                    </section>
                    <section class="pac-menu-principal  mt-5">
                              <!-- <img src="./assets/img/fondo.jpg"> -->

                              <div class="container">
                                        <div class="row">
                                                  <div class="col-12 col-sm-12 col-xl-4 col-lg-4 col-md-4 text-center">
                                                            <a href="./teclado.php" class="">
                                                                      <div class="pac-cadr-botton  mt-5 text-center center-block ">
                                                                                <div class="pac-text-title">Teclado </div>
                                                                                <img class="pac-img-card mt-5" src="./assets/img/mecanografia.png" alt="">
                                                                      </div>
                                                            </a>

                                                  </div>

                                                  <div class="col-12 col-sm-12 col-xl-4 col-lg-4 col-md-4">
                                                            <a href="./camara.php" class="">
                                                                      <div class="pac-cadr-botton  mt-5 text-center center-block">
                                                                                <div class="pac-text-title">Camara </div>
                                                                                <img class="pac-img-card mt-5" src="./assets/img/lente.png" alt="">
                                                                      </div>
                                                            </a>
                                                  </div>

                                                  <div class="col-12 col-sm-12 col-xl-4 col-lg-4 col-md-4">
                                                            <a href="./laser.php" class="">
                                                                      <div class="pac-cadr-botton  mt-5 text-center center-block">
                                                                                <div class="pac-text-title">Escaner </div>
                                                                                <img class="pac-img-card mt-5" src="./assets/img/escaner.png" alt="">
                                                                      </div>
                                                            </a>
                                                  </div>

                                        </div>
                              </div>
                    </section>
          </main>


</body>

<script>



</script>

</html>