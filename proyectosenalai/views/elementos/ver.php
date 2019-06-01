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
<br>
<br>
<br>
<?php if ($this->w == "") {
   echo '<h1>'.'no hay nada'.'</h1>'; 
} ?>

  <?php foreach ($this->w as $idelementos ) { ?>
    <?php echo '<h1>'. $idelementos .'</h1>' ;?>
  <?php } ?>
<body>
    <?php include('views/plantilla/header.php') ?>
    <?php include('views/plantilla/footer.php') ?>
    <script src="<?php echo constant('URL');?>public/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo constant('URL');?>public/js/bootstrap.min.js"></script>
</body>
</html>