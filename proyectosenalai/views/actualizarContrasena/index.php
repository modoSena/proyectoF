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
<body>
    <?php include('views/plantilla/header.php') ?>
    <div class="container">
<form class="form"  id="formularioActualizarContrasena"  >
<h2 style="text-align: center; font-family: fantasy;">Actualizar Contraseña</h2>
  <br>
              <div class="form-group">
    <label for="">Contraseña Actual</label>
      <input type="password" name="contrasenaActual" id="contrasenaActual" class="form-control input-lg" placeholder="Ingrese contraseña actual" tabindex="3" >
    </div> 
         <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
                  <div class="form-group">
        <label for="">Nueva Contrasena</label>
              <input type="password" name="nuevaContrasena" id="nuevaContrasena" class="form-control input-lg" placeholder="ingrese contraseña" tabindex="3" >
            </div>          
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6">       
            <div class="form-group">
        <label for="">Repite Contrasena</label>
              <input type="password" name="nuevaContrasena2" id="nuevaContrasena2" class="form-control input-lg" placeholder="Repita contraseña" tabindex="3" >
            </div>
                    
      </div>
       </div>
   <hr/>
    <div class="row">
      <div  class="col-xs-6 col-md-6">
       <input type="hidden" name="envioActualizarContrasena">
                <input id="submitActualizarContrasena" name="submitActualizarContrasena" type="button" value="Aceptar" class="btn btn-primary btn-block btn-lg" tabindex="7" >
              </div>

      <div  class="col-xs-6 col-md-6">
      <a href="<?php echo constant('URL')?>bienvenido" class="btn btn-primary btn-block btn-lg">Cancelar</a>
      </div>
    </div>
    <div id ="alert"><img class="loading" id="loading" src="<? echo constant('URL')?>public/img/loading.gif" alt=""> <span id="mensajes"> </span></div>        
</form>
</div>
<br>
<!-- MODAL exito ---->
<div data-backdrop="static" data-keyboard="false" class="modal fade" id="modalExiotActualizarContrasena" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">
      <form id="verificarcontrasena">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle">Éxito</h2>
      </div>
      <div class="modal-body">
            <p for="">Su contraseña ha sido cambiada correctamente </p>
      </div>
      <div class="modal-footer">
      <a href="<?php echo constant('URL')?>bienvenido" class="btn btn-primary">Aceptar</a>
      </div>
      </form>
    </div>
  </div>
</div>
    <?php include('views/plantilla/footer.php') ?>
    <script src="<?php echo constant('URL');?>public/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo constant('URL');?>public/js/bootstrap.min.js"></script>
</body>
</html>
<script>
$(function () {
        console.log('jquery funciona')  ;
        $('#submitActualizarContrasena').click(function () {

           $.ajax({
               url:'<?php echo constant('URL')?>actualizarContrasena/validarDatos',
               type:'POST',
               data:$("#formularioActualizarContrasena").serialize(),
               beforeSend: function() {
                $('#loading').show();
                $('#mensajes').html('procesando datos');
            },
               success:function (respuesta) {
                $('#loading').hide();
                $('#mensajes').html('');
                
          
                  if (respuesta == 1) {
                    $('#modalExiotActualizarContrasena').modal("show");
                      
                  }else{
                    $('#mensajes').html(respuesta);
                  }
               }
           })
        }) 
       }
       )
</script>