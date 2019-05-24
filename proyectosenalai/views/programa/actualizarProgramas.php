<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL')?>public/css/bootstrap.css">
    <link rel="stylesheet"  type="text/css" href="<?php echo constant('URL')?>public/css/header.css">
    <link rel="stylesheet"  type="text/css" href="<?php echo constant('URL')?>public/css/footer.css">
    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL')?>public/css/login.css">
    <link rel="stylesheet"  type="text/css" href="<?php echo constant('URL')?>public/css/tableUsuario.css">
    <link rel="icon" href="<?php echo constant('URL');?>public/img/sena.png">
</head><title>Sena L.A.I</title>
<body>
<?php include('views/plantilla/header.php') ?>
<br>
<div class="container">
<form class="form" id="ActualizarPrograma" >
<h2 style="text-align: center;">Actúalizar Programa</h2>
<hr style=" height: 1px;background-color: black;">
<div class="form-group">
			 <label for="">Nombre Programa</label>
				<input type="text" name="NombrePrograma" value="<?php echo $this->valores['NombrePrograma']?>" id="NombrePrograma" class="form-control " placeholder=" " tabindex="3" >
</div> 
            <input type="hidden"  value="<?php echo $this->valores['idPrograma'] ?>" name="idPrograma">
<div class="row">
				<div  class="col-xs-6 col-md-6">
				 <input type="hidden" name="envioActualizoPrograma">
				   <input id="submitPrograma" name="submitPrograma" type="button" value="Actúalizar" class="btn btn-primary btn-block btn-lg" tabindex="7" >
				</div>

				<div  class="col-xs-6 col-md-6">
				<a href="<?php echo constant('URL')?>programa" class="btn btn-primary btn-block btn-lg">Cancelar</a>
				</div>
			</div>
		
			<div id ="alert"><img class="loading" id="loading" src="<? echo constant('URL')?>public/img/loading.gif" alt=""> <span id="mensajes"> </span></div>  
</div>      
</form>
</div>
 <!-- MODAL exito AL ACTUALIZAR PROGRAMA ---->
<div data-backdrop="static" data-keyboard="false" class="modal fade" id="modalExitoActualizoPrograma" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
  
      <div class="modal-content">
       
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLongTitle">Programa actúalizado con éxito</h2>
        </div>
        <div class="modal-body">
              <p for="">Se ha actúalizado el programa</p> 
        </div>
        <div class="modal-footer">	
                <a href="<?php echo constant('URL')?>programa/actualizarProgramas/<?php echo $this->idPrograma ?>" class="btn btn-primary">Aceptar</a>
                </div>
        </form>
      </div>
    </div>
  </div>  
<br>
<br>
<br>
<br>
    <?php include('views/plantilla/footer.php')?>
    <script src="<?php echo constant('URL')?>public/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo constant('URL')?>public/js/bootstrap.min.js"></script> 
</body>
</html>
<script>
$(function () {
    console.log('jquery funciona')  ;
    $('#submitPrograma').click(function () {

       $.ajax({
           url:'<?php echo constant('URL')?>programa/actualizarPrograma',
           type:'POST',
           data:$("#ActualizarPrograma").serialize(),
           beforeSend: function() {
            $('#loading').show();
            $('#mensajes').html('procesando datos');
        },
           success:function (respuesta) {
            $('#loading').hide();
              if (respuesta == 1) {
                $('#modalExitoActualizoPrograma').modal("show");
                  
              }else{
                $('#mensajes').html(respuesta);
              }
           }
       })
    }) 
   }
   )
</script>