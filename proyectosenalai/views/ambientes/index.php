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
        </div>
        <h1 style="text-align: center;">Administrar Ambientes</h1>
        <br>

    <?php if (  $_SESSION['Roles_idRoles'] == 4   ){ ?>
        <div id="div1">

        <div class="form-actions">
            <a href="<?php echo constant('URL')?>ambientes/registrarAmbientes"><button type="button" class="btn btn-primary">Agregar Ambiente <span class="glyphicon glyphicon-level-up"></span></button></a>
        </div>
    <?php } ?>
        <table id="table_id" class="display">
    <thead>
        <tr>
            <?php if (  $_SESSION['Roles_idRoles'] == 4 ){ ?>
        <th>Cambiar Estado</th>
        <th>Editar Ambiente</th>
        <th>Detalles De Cuentadante</th>
            <?php } ?>
        <th>Elementos</th>
        <th>Ubicación</th>
        <th>Numero Ambiente</th>
        <th>Estado</th>    
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
                       <td> <button   onclick="obtenerid(<?php echo $fila['idAmbientes']?>)" type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal"><span class='glyphicon glyphicon-file'></span></button>
                        <button  onclick="buscar_datos(<?php echo $fila['idAmbientes']?>)" type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2"><span class='glyphicon glyphicon-eye-open'></span></button> </td>
            <?php } ?>
                       <td> <a href='ambientes/elementosAmbiente/<?php echo $fila['idAmbientes']?>'><button type='button' class='btn btn-info'><span class='glyphicon glyphicon-list-alt'></span></button></a> </td>
                        <td><?php echo $fila['NombreUbicacion'] ?></td>
                        <td><?php echo $fila['Numero_Ambiente'] ?></td>
                        <td><?php echo $fila['NombreEstadoA'] ?></td>
            
        </tr>
   <?php } ?>    

    </tbody>
</table>
        </div>          
    </section>
    <!-- Modal  reportar novedad-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nuevo Cuentadante</h4>
      </div>
      <div class="modal-body">
      <form id="registrarCuentadante">
  <div class="form-group">
               <label for="">Documento Cuentadante</label>
               <input type="text" name="cuentadante" id="cuentadante" class="form-control " placeholder=" " tabindex="3" >
              </div> 
              <input type="hidden" id="idd" name="idambiente">
  <div class="row">
                  <div  class="col-xs-6 col-md-6">
  
                   <input type="hidden" name="envioNuevoCuentadante">
  
                     <input onclick="return confirm('¿Estas seguro?');" id="submit" name="submit" type="button" value="Registrar" class="btn btn-primary btn-block btn-lg" tabindex="7" >
                  </div>
  
                  <div  class="col-xs-6 col-md-6">
                  <input  class="btn btn-primary btn-block btn-lg" type="button" data-dismiss="modal"  value="Cancelar">
                  </div>
              </div>
          
              <div id ="alert"><img class="loading" id="loading" src="<? echo constant('URL')?>public/img/loading.gif" alt=""> <span id="mensajes"> </span></div>  
  </div>
  </form>
      </div>
    </div>
  </div>
</div>

    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="myModalLabel">Cuentadante</h2>
      </div>
      <div class="modal-body">
    <div id="table_idy">
    </div>      
      </div>
    </div>
  </div>
</div>
 <!-- MODAL exito AL REPORTRA NOVEDAD ---->
 <div data-backdrop="static" data-keyboard="false" class="modal fade" id="modalExitoRegistroCuentadante" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
  
      <div class="modal-content">
       
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLongTitle">Cuentadante registrado con éxito.</h2>
        </div>
        <div class="modal-body">
        
              <p for="">Se ha registrado el nuevo cuentadante.</p>
  
        </div>
        <div class="modal-footer">
                <a href="<?php echo constant('URL')?>ambientes" class="btn btn-primary">Aceptar</a>
                </div>
      </div>
    </div>
  </div>  
    <br>
    <br>
    <br>
    <?php require('views/plantilla/footer.php')  ?>
    <script src="<?php echo constant('URL');?>public/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo constant('URL');?>public/js/bootstrap.min.js"></script>
    <script src="<?php echo constant('URL');?>DataTables/datatables.js"></script>
    <script > function  obtenerid(id){ $("#idd").val(id);}</script>
    <script>$(document).ready( function () {
    $('#table_id').DataTable();
} );</script>
<script>
$(function () {
    console.log('jquery funciona')  ;
    $('#submit').click(function () {

       $.ajax({
           url:'<?php echo constant('URL')?>ambientes/registrarCuentadantes',
           type:'POST',
           data:$("#registrarCuentadante").serialize(),
           beforeSend: function() {
            $('#loading').show();
            $('#mensajes').html('procesando datos');
        },
           success:function (respuesta) {
            $('#loading').hide();
              if (respuesta == 1) {
                $('#myModal').modal('hide');
                $('#modalExitoRegistroCuentadante').modal("show");
                  
              }else{
                $('#mensajes').html(respuesta);
              }
           }
       })
    }) 
   }
   
   )
</script>
<script>
function buscar_datos(consulta){
    $.ajax({
		url: '<?php echo constant('URL')?>ambientes/consultarCuentadantes' ,
		type: 'POST' ,
		dataType: 'html',
		data: {consulta: consulta},
	})
	.done(function(respuesta){
		$("#table_idy").html(respuesta);
	})
	.fail(function(){
		console.log("error");
	});
}
</script>
</body>
</html>