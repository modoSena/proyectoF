<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL');?>public/css/login.css">
    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL');?>public/css/footer.css">
    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL');?>public/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL');?>public/css/tableUsuario.css">
    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL');?>DataTables/datatables.css">
    <link rel="icon" href="<?php echo constant('URL');?>public/img/sena.png">
    <title>Sena L.A.I</title>
</head>
<body>
    <?php require('views/plantilla/header.php')  ?>
    <br><br>
    <section class="principal">
        <h1 style="text-align:center; font-family: fantasy;">Elementos prestados</h1>
        </div>
        <br>
        <div id="div1">
        <table id="table_id" class="display">
    <thead>
        <tr>
              <th>Fecha Inicial</th>
              <th>Jornada</th>
              <th>Placa Equipo</th>
              <th>Número Serial</th>
              <th>Tipo Elemento</th>
              <th>Descripción Elemento</th>
              <th>Ubicación</th>
              <th>Número Ambiente</th>
        </tr>
    </thead>
    <tbody>
    <?php  foreach($this->query as  $fila) { ?>
        <tr>
    
              <td><?php echo $fila['Fecha_inicial'] ?></td>
              <td><?php echo $fila['tipoJornada'] ?></td>
              <td><?php echo $fila['Placa_Equipo'] ?></td> 
              <td><?php echo $fila['Numero_Serial'] ?></td> 
              <td><?php echo $fila['NombreTipoElemento'] ?></td>
              <td><?php echo $fila['Descripcion'] ?></td> 
              <td><?php echo $fila['NombreUbicacion'] ?></td> 
              <td><?php echo $fila['Numero_Ambiente'] ?></td> 
        </tr>
    <?php } ?>
    </tbody>
</table>
        </div>          
    </section>
    <?php require('views/plantilla/footer.php')  ?>
    <script src="<?php echo constant('URL');?>public/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo constant('URL');?>public/js/bootstrap.min.js"></script>
    <script src="<?php echo constant('URL');?>DataTables/datatables.js"></script>
    <script>$(document).ready( function () {
    $('#table_id').DataTable();
} );</script>
</body>
</html>