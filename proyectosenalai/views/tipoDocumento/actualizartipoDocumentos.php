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
</head><title>Sena L.A.I</title>
<body>
<?php include('views/plantilla/header.php') ?>
<br>
<div class="container">

<form class="form" id="ActualizartipoDocumento" >
  
<h2 style="text-align: center; font-family: fantasy;">Actualizar Tipo Documento</h2>

<hr style=" height: 1px;background-color: black;">

<div class="form-group">

			 <label for="">Nombre tipo documento</label>
				<input type="text" name="Tipo_Documento" value="<?php echo $this->valores['Tipo_Documento']?>" id="Tipo_Documento" class="form-control " placeholder=" " tabindex="3" >
</div> 

            <input type="hidden"  value="<?php echo $this->valores['idTipo_Documento'] ?>" name="idTipo_Documento">

<div class="row">
				<div  class="col-xs-6 col-md-6">
				 <input type="hidden" name="envioActualizotipoDocumento">
				   <input id="submittipoDocumento" name="submittipoDocumento" type="button" value="Actualizar" class="btn btn-primary btn-block btn-lg" tabindex="7" >
				</div>

				<div  class="col-xs-6 col-md-6">
				<a href="<?php echo constant('URL')?>tipoDocumento" class="btn btn-primary btn-block btn-lg">Cancelar</a>
				</div>
			</div>
		
			<div id ="alert"><img class="loading" id="loading" src="<? echo constant('URL')?>public/img/loading.gif" alt=""> <span id="mensajes"> </span></div>  
</div>      
</form>
</div>
    
 <!-- MODAL exito AL ACTUALIZAR TIPO DOCUMENTO ---->
<div data-backdrop="static" data-keyboard="false" class="modal fade" id="modalExitoActualizotipoDocumento" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
  
      <div class="modal-content">
       
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLongTitle">Tipo documento actualizado con éxito</h2>
        </div>
        <div class="modal-body">
              <p for="">Se ha actualizado el tipo documento</p> 
        </div>
        <div class="modal-footer">
				
                <a href="<?php echo constant('URL')?>tipoDocumento/actualizartipoDocumentos/<?php echo $this->idTipo_Documento ?>" class="btn btn-primary">Aceptar</a>
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
    $('#submittipoDocumento').click(function () {

       $.ajax({
           url:'<?php echo constant('URL')?>tipoDocumento/actualizartipoDocumento',
           type:'POST',
           data:$("#ActualizartipoDocumento").serialize(),
           beforeSend: function() {
            $('#loading').show();
            $('#mensajes').html('procesando datos');
        },
           success:function (respuesta) {
            $('#loading').hide();
              if (respuesta == 1) {
                $('#modalExitoActualizotipoDocumento').modal("show");
                  
              }else{
                $('#mensajes').html(respuesta);
              }
           }
       })
    }) 
   }
   
   )

</script>