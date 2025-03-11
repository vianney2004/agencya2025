<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Disponibilidad</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo-mywebsite-urian-viera.svg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i|Roboto+Mono:300,400,700|Roboto+Slab:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="assets/css/material.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/home.css">
    <link rel="stylesheet" href="./assets/css/loader.css">
</head>
<body>
    <header>
      <div class="contenedor_header">
          <ul class="flex-container">
            <li class="flex-item"></li>
            <li class="flex-item">
              <p>
                <strong>
                Disponibilidad - Agencia de Viajes
                </strong>
              </p>
            </li>
            <li class="flex-item"></li>
          </ul>
      </div>
    </header>

    <div id="demo-content">
      <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
      <div id="content"> </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center" style="padding:100px 0px;">
          <h3 class="text-center" style="font-size:40px; color:#333; font-weight:900;">
          REPORTE DE DISPONIBILIDAD
          </h3>
         
        </div>
      </div>
    </div>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <form action="/InicioDeSesion2/fpdf/PruebaV6.php" method="post" accept-charset="utf-8">
              <div class="row">
                <div class="col">
                  <input type="date" name="fecha_ingreso" class="form-control" value="<?php echo date('d-m-Y', time()); ?>" required>
                </div>
                <div class="col">
                  <input type="date" name="fechaFin" class="form-control" value="<?php echo date('d-m-Y', strtotime('+1 day')); ?>" required>
                </div>
                <div class="col">
                  <button type="submit" class="btn btn-danger mb-2">Generar Reporte PDF</button>
                </div>
              </div>
            </form>
          </div>

          <div class="col-md-12 text-center mt-5">     
            <span id="loaderFiltro"></span>
          </div>
          
        </div>
      </div>
    </section>

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="assets/js/material.min.js"></script>
  <script>
  $(function() {
      setTimeout(function(){
        $('body').addClass('loaded');
      }, 1000);

      $("#filtrarDisponibilidad").on("click", function(e){ 
        e.preventDefault();
        
        loaderDisponibilidad(true);

        var f_inicio = $('input[name=fecha_inicio]').val();
        var f_fin = $('input[name=fecha_fin]').val();

        if(f_inicio !="" && f_fin !=""){
          $.post("filtro6.php", {f_inicio: f_inicio, f_fin: f_fin}, function (data) {
            $(".resultadoFiltrarDisponibilidad").html(data);
            loaderDisponibilidad(false);
          });  
        }else{
          $("#loaderDisponibilidad").html('<p style="color:red; font-weight:bold;">Debe seleccionar ambas fechas</p>');
        }
      });

      function loaderDisponibilidad(statusLoader){
        console.log(statusLoader);
        if(statusLoader){
          $("#loaderDisponibilidad").show();
          $("#loaderDisponibilidad").html('<img class="img-fluid" src="assets/img/cargando.svg" style="left:50%; right: 50%; width:50px;">');
        }else{
          $("#loaderDisponibilidad").hide();
        }
      }
  });
  </script>

</body>
</html>
