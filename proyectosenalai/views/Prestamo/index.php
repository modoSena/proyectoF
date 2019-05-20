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
        <h1 style="text-align:center">Administrar Préstamos</h1>
        </div>
        <div class="form-actions">
            <a href="<?php echo constant('URL');?>Prestamos/addprestamo"><button type="button" class="btn btn-primary">Crear Préstamo</button></a>
        </div>
        <br>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Elementos del préstamo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <td>Placa Equipo</td>
              <td>Descripcion</td>
            </tr>
          </thead>
          <tbody id="listaElementosPrestamo">
            
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <?php if ($_SESSION['Roles_idRoles'] == 3 || $_SESSION['Roles_idRoles'] == 4){ ?>
        <button type="button" class="btn btn-primary" id="btnDevolver">Devolución</button>
      <?php } ?>
      <button class="btn btn-danger" id="btnCancelarPrestamo">Cancelar Préstamo</button>
      </div>
    </div>
  </div>
</div>
        <div id="div1">
          <table class="table table-bordered" id="tblPrestamo">
            <thead>
              <th></th>
              <th>Préstamo</th>
              <th>Fecha Inicial</th>
            </thead>
            <tbody id="listaPrestamos">
                <?php  foreach($this->query as $fila) { ?>
                    <tr>
                        <td><button type="button" class="btn btn-default" id="btnVer" data-id="<?php echo $fila['idPrestamos'] ?>" data-toggle="modal" data-target="#exampleModalCenter">Ver</button></td>
                        <td><?php echo $fila['idPrestamos'] ?></td>
                        <td><?php echo $fila['Fecha_inicial'] ?></td>
                    </tr>
                <?php  }?>
            </tbody>
          </table>
        </div>          
    </section>
    <?php require('views/plantilla/footer.php')  ?>
    <script src="<?php echo constant('URL');?>public/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo constant('URL');?>public/js/bootstrap.min.js"></script>
    <script src="<?php echo constant('URL');?>DataTables/datatables.js"></script>
    <script type="text/javascript">
      var idPrestamo = 0;
        $(document).ready(function(){
            $("#tblPrestamo").DataTable({});
            $("#listaPrestamos button#btnVer").click(function(){
              idPrestamo = $(this).attr('data-id');
              $.ajax({
                  cache: false,
                  type: "POST",
                  url:'<?php echo constant('URL')?>Prestamos/obtenerElementosByPrestamo',
                  data: "Prestamo="+$(this).attr('data-id'),
                  dataType: "json",
                  success: function(R) {
                    $('#listaElementosPrestamo').html('');
                    $.each(R.Objeto, function (i, item) {
                        $('#listaElementosPrestamo').append("<tr><td>"+item.Placa+"</td><td>"+item.Descripcion+"</td></tr>");
                    });
                  }, error: function(jqXHR, textStatus, errorThrown) {

                      console.log('Error en ajax');
                      console.log(jqXHR.responseText);
                      console.log(textStatus);
                      console.log(errorThrown);
                  }
                });
            });
            $("#btnDevolver").click(function(){
              $.ajax({
                  cache: false,
                  type: "POST",
                  url:'<?php echo constant('URL')?>Prestamos/actualizarPrestamo',
                  data: "Prestamo="+idPrestamo+"&Estado=F",
                  dataType: "json",
                  success: function(R) {
                    if (R.Respuesta) {
                      alert(R.Mensaje);
                      $(location).attr('href','<?php echo constant('URL')?>Prestamos/render');
                    }else{
                      alert(R.Mensaje);
                    }
                  }, error: function(jqXHR, textStatus, errorThrown) {

                      console.log('Error en ajax');
                      console.log(jqXHR.responseText);
                      console.log(textStatus);
                      console.log(errorThrown);
                  }
                });
            });
            $("#btnCancelarPrestamo").click(function(){
              $.ajax({
                  cache: false,
                  type: "POST",
                  url:'<?php echo constant('URL')?>Prestamos/actualizarPrestamo',
                  data: "Prestamo="+idPrestamo+"&Estado=C",
                  dataType: "json",
                  success: function(R) {
                    if (R.Respuesta) {
                      alert(R.Mensaje);
                      $(location).attr('href','<?php echo constant('URL')?>Prestamos/render');
                    }else{
                      alert(R.Mensaje);
                    }
                  }, error: function(jqXHR, textStatus, errorThrown) {

                      console.log('Error en ajax');
                      console.log(jqXHR.responseText);
                      console.log(textStatus);
                      console.log(errorThrown);
                  }
                });
            });
        });
    </script>
</body>
</html>