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
    <title>Sena L.A.I</title>
</head>
<body>
    <?php require('views/plantilla/header.php')  ?>
    <br><br>
    <section class="principal">
        <h1 style="text-align:center"> Programas </h1>
        </div>
        <div class="form-actions">
            <a href="<?php echo constant('URL');?>programa/registrarProgramas"><button type="button" class="btn btn-primary">Agregar un nuevo programa <span class="glyphicon glyphicon-level-up"></span></button></a>
        </div>
        <br>
        <div id="div1">
        <table id="table_id" class="display">
    <thead>
        <tr>
                  <th>EDITAR</th>        
                  <th>NOMBRE PROGRAMA</th>
        </tr>
    </thead>
    <tbody>
    <?php  foreach($this->query as  $fila) { ?>
        <tr>
        <td> <a href='programa/actualizarProgramas/<?php echo $fila['idPrograma']?>'><button type='button' class='btn btn-warning'><span class='glyphicon glyphicon-edit'></span></button></a> </td>   
               <td><?php echo $fila['NombrePrograma'] ?></td> 
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