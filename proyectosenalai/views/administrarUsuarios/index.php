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
        <h1 style="text-align:center; font-family: fantasy;">Administrar Usuarios</h1>
        <br>
       <div  id='div1'>
       <div class="form-actions">
            <a href="administrarUsuarios/registrarUsuarios"><button type="button" class="btn btn-primary">Agregar Usuario <span class="glyphicon glyphicon-level-up"></span></button></a>
        </div>
                <table id="table_id" class="display">
            <thead>
                <tr>
               <th>Cambiar Estado</th>
               <th>Editar</th>
               <th>Tipo Documento</th>
               <th>Núm. Documento</th>
               <th>Nombres</th>
               <th>Primer Apellido</th>
               <th>Segundo Apellido</th>
               <th>Sexo</th>
               <th>Email</th>
               <th>Municipio</th>
               <th>Dirección</th>
               <th>Celular</th>
               <th>Tel.</th>
               <th>Programa</th>
               <th>Ficha</th>
               <th>Usuario</th>
               <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($this->query as  $fila) { ?>
              <tr>
              <?php if ($fila['Estado_idEstado'] == 1) { ?>
              <td>   <a onclick="return confirm('¿Estas seguro?');" href='administrarUsuarios/inhabilitarUsuario/<?php echo $fila['idPersona']?>'><button type='button' class='btn btn-success'>Activo</button></a> </td>
              <?php } else  { ?>
              
              <td> <a  onclick="return confirm('¿Estas seguro?');" href='administrarUsuarios/habilitarUsuario/<?php echo $fila['idPersona']?>'><button type='button' class='btn btn-danger'>Inactivo</button></a> </td>
              <?php } ?>

              <td> <a href='administrarUsuarios/actualizarUsuarios/<?php echo $fila['idPersona']?>'><button type='button' class='btn btn-warning'><span class='glyphicon glyphicon-edit'></span></button></a> </td>   
              <td><?php echo $fila['Tipo_Documento']  ?></td>
               <td> <?php echo $fila['Numero_Documento'] ?></td>
               <td><?php echo $fila['Nombre'] ?></td>
               <td><?php echo $fila['Apellido_Primero'] ?></td>
               <td><?php echo $fila['Apellido_Segundo'] ?></td>
               <td><?php echo $fila['NombreSexo'] ?></td>  
               <td><?php echo $fila['Email'] ?></td> 
               <td><?php echo $fila['NombreCiudad'] ?></td>     
               <td><?php echo $fila['Direccion'] ?></td>
               <td><?php echo $fila['Numero_Celular'] ?></td>
               <td><?php echo $fila['Telefono'] ?> </td> 
               <td><?php echo $fila['NombrePrograma'] ?></td>
               <td><?php echo $fila['Numero_Ficha'] ?></td>
               <td><?php echo $fila['Usuario'] ?></td>
               <td><?php echo $fila['NombreRoles'] ?></td>
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
    <script src="<?php echo constant('URL');?>DataTables/datatables.js"></script>
    <script src="<?php echo constant('URL');?>public/js/bootstrap.min.js"></script>
    <script>$(document).ready( function () {
    $('#table_id').DataTable();
} );</script>
</body>
</html>