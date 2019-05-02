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

        <h1 style="text-align:center"> Elementos </h1>


        </div>


        
        <div class="form-actions">
            <a href="<?php echo constant('URL');?>elementos/registrarElementos"><button type="button" class="btn btn-primary">Agregar un nuevo elemento <span class="glyphicon glyphicon-level-up"></span></button></a>
        </div>

        <br>


        <div id="div1">
        <table id="table_id" class="display">
    <thead>
        <tr>
    
                  <th>CAMBIAR ESTADO</th>        
                  <th>REPORTAR NOVEDAD</th>
                  <th>VER NOVEDADES</th>
                  <th>UBICACIÓN</th>
                  <th>NUMERO AMBIENTE</th>
                  <th>NUMERO SERIAL</th>
                  <th>PLACA EQUIPO</th>
                  <th>MARCA</th>
                  <th>TIPO ELEMENTO</th>
                  <th>FECHA ENTRADA(SISTEMA)</th>
                  <th>FECHA SALIDA(SISTEMA)</th>
                  <th>ESTADO</th>

        </tr>
    </thead>
    <tbody>
    <?php  foreach($this->query as  $fila) { ?>
        <tr>


                 <?php if ($fila['Estado_Elementos_idEstado_Elementos'] == 1) { ?>
                    <td> <a onclick="return confirm('¿Estas seguro?');"  href='<?php echo constant('URL');?>elementos/inhabilitarElemento/<?php echo $fila['idAmbientes']?> '><button type='button' class='btn btn-success'>Activo</button></a> </td>
                    
                  <?php }else  { ?>
                    <td> <a onclick="return confirm('¿Estas seguro?');"  href='<?php echo constant('URL');?>elementos/inhabilitarElemento/<?php echo $fila['idAmbientes']?>'><button type='button' class='btn btn-danger'>Inactivo</button></a> </td>
                  <?php } ?>
        








               <td> <button  onclick="obtenerid(<?php echo $fila['idElementos']?>)" type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal"><span class='glyphicon glyphicon-file'></span></button> </td>
               <td> <button  onclick="buscar_datos(<?php echo $fila['idElementos']?>)" type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2"><span class='glyphicon glyphicon-eye-open'></span></button> </td>

               <td><?php echo $fila['NombreUbicacion'] ?></td> 
               <td><?php echo $fila['Numero_Ambiente'] ?></td> 
               <td><?php echo $fila['Numero_Serial'] ?></td>         
               <td><?php echo $fila['Placa_Equipo'] ?></td>
               <td><?php echo $fila['Marca'] ?></td>
               <td><?php echo $fila['NombreTipoElemento'] ?></td>
               <td><?php echo $fila['Fecha_Entrada'] ?></td>
               <td><?php echo $fila['Fecha_Salida'] ?></td>
               <td><?php echo $fila['NombreEstado'] ?></td>
                

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

