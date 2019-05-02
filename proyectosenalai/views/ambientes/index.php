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

        <h1 style="text-align:center"> Ambientes</h1>


        </div>


        

        <br>

    <?php if (  $_SESSION['Roles_idRoles'] == 4   ){ ?>
        <div id="div1">

        <div class="form-actions">
            <a href="<?php echo constant('URL')?>ambientes/registrarAmbientes"><button type="button" class="btn btn-primary">Agregar un nuevo ambiente <span class="glyphicon glyphicon-level-up"></span></button></a>
        </div>
    <?php } ?>
        <table id="table_id" class="display">
    <thead>
        <tr>
            <?php if (  $_SESSION['Roles_idRoles'] == 4   ){ ?>
        <th>CAMBIAR ESTADO</th>
        <th>EDITAR</th>
            <?php } ?>
        <th>ELEMENTOS</th>
        <th>UBICACION</th>
        <th>NUMERO AMBIENTE</th>
        <th>DOCUMENTO CUENTADANTE</th>
        <th>NOMBRE CUENTADANTE</th>
        <th>CELULAR CUENTADANTE</th>
        <th>ESTADO</th>    
        </tr>
    </thead>
    <tbody>
   <?php foreach($this->query as  $fila) { ?>
        <tr>

            <?php if (  $_SESSION['Roles_idRoles'] == 4   ) { ?>

                        <?php if ($fila['Estado_Ambientes_idEstado_Ambientes'] == 1) { ?>
                            <td> <a onclick="return confirm('¿Estas seguro?');" href='ambientes/inhabilitarambiente/<?php echo $fila['idAmbientes']?>'><button type='button' class='btn btn-success'>Disponible</button></a> </td>
                            
                        <?php }else  { ?>
                        <td> <a onclick="return confirm('¿Estas seguro?');" href='ambientes/habilitarambiente/<?php echo $fila['idAmbientes']?>'><button type='button' class='btn btn-danger'>Ocupado</button></a> </td>
                        <?php } ?>

           

                       <td> <a href='ambientes/actualizarambientes/<?php echo $fila['idAmbientes']?>'><button type='button' class='btn btn-warning'><span class='glyphicon glyphicon-edit'></span></button></a> </td>
            <?php } ?>
                       <td> <a href='ambientes/elementosAmbiente/<?php echo $fila['idAmbientes']?>'><button type='button' class='btn btn-info'><span class='glyphicon glyphicon-list-alt'></span></button></a> </td>

                        <td><?php echo $fila['NombreUbicacion'] ?></td>
                        <td><?php echo $fila['Numero_Ambiente'] ?></td>
                        <td><?php echo $fila['Numero_Documento'] ?></td>
                        <td><?php echo $fila['Nombre'] ?></td>
                        <td><?php echo $fila['Numero_Celular'] ?></td>
                        <td><?php echo $fila['NombreEstadoA'] ?></td>
            
        </tr>
   <?php } ?>    

    </tbody>
</table>


        </div>          



    </section>





    <br>
    <br>
    <br>

    <?php require('views/plantilla/footer.php')  ?>
    <script src="<?php echo constant('URL');?>public/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo constant('URL');?>public/js/bootstrap.min.js"></script>
    <script src="<?php echo constant('URL');?>DataTables/datatables.js"></script>
    <script>$(document).ready( function () {
    $('#table_id').DataTable();
} );</script>

</body>

</html>

