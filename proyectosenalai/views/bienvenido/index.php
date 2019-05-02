<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL');?>public/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL');?>public/css/footer.css">
    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL');?>public/css/login.css">
    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL');?>public/css/bienvenido.css">
    <link rel="icon" href="<?php echo constant('URL');?>public/img/sena.png">
</head>
<title>Sena L.A.I</title>
<div class="cuadroentradas">
    <div class="container-entrada">
        <div class="mision">
            <img class="logo" src="<?php echo constant('URL');?>public/img/lsena.png" alt="">
            <h1>Misión</h1>
            <p>
                El SENA está  encargado de cumplir la función que le corresponde al Estado de invertir en el desarrollo social y
                técnico de los trabajadores colombianos, ofreciendo y ejecutando la formación profesional integral, para la
                incorporación y el desarrollo de las personas en actividades productivas que contribuyan al desarrollo social,
                económico y tecnológico del país.
            </p>
            <h1>Visión</h1>
            <p>
                En el 2018 el SENA será reconocido por la efectividad de su gestión, sus aportes al empleo decente y a ​la
                generación de ingresos, impactando la productividad de las personas y de las empresas; que incidirán
                ​positivamente en el desarrollo de las regiones como contribución a una Colombia educada, equitativa y en paz.
            </p>
        </div>
    </div>
</div>
<body>
    <?php include('views/plantilla/header.php') ?>
    <?php include('views/plantilla/footer.php') ?>
    <script src="<?php echo constant('URL');?>public/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo constant('URL');?>public/js/bootstrap.min.js"></script>
</body>
</html>