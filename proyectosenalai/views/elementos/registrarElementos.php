<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL');?>public/css/footer.css">
    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL');?>public/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL')?>public/css/login.css">
    <link rel="stylesheet"  type="text/css" href="<?php echo constant('URL')?>public/css/tableUsuario.css">
    <link rel="icon" href="<?php echo constant('URL');?>public/img/sena.png">
</head><title>Sena L.A.I</title>
<body>
<?php include('views/plantilla/header.php') ?>
<br>
<div class="container">
<form class="form" id="registrarElemento" >
<h2 style="text-align: center; font-family: fantasy;">Registrar un elemento</h2>
<hr style=" height: 1px;background-color: black;">
<div class="form-group">
<div class="form-group">
			 <label for="">Número Serial</label>
				<input type="text" name="Numero_Serial" id="Numero_Serial" class="form-control" placeholder=" " tabindex="3" >
            </div> 
<div class="form-group">
			 <label for="">Placa Equipo</label>
				<input type="text" name="Placa_Equipo" id="Placa_Equipo" class="form-control " placeholder=" " tabindex="3" >
                <label for="">Descripción Equipo</label>
				<input type="text" name="Descripcion" id="Descripcion" class="form-control " placeholder=" " tabindex="3" >

            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <label>Tipo Elemento</label>
                    <select class='form-control' id='idTipo_Elementos' name='idTipo_Elementos'>
                        <option value="">selecciona:</option>
                        <?php foreach ($this->consultarTipoEquipos as $resultado) { ?>
                        <option value="<?php echo $resultado['idTipo_Elementos']; ?>">
                            <?php echo $resultado['NombreTipoElemento']; ?> </option>
                        <?php } ?>
                    </select>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                    <label>Marca</label>
                    <select class='form-control' id='marca' name='marca'>
                        <option value="">selecciona:</option>
                        <?php foreach ($this->consultarMarca as $resultado) { ?>
                        <option value="<?php echo $resultado['idMarcas']; ?>">
                            <?php echo $resultado['Marca']; ?> </option>
                        <?php } ?>
                    </select>
                    </div>
                </div>
            </div>

            <center><p>Nota: Si no selecciona una ubicación, por defecto su ubicación inicial sera el ambiente 1 de torre sur</p></center>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Ubicación</label>
                        <select class='form-control' id='ubicacion' name='ubicacion'>
                            <option value="2">selecciona:</option>
                            <?php foreach ( $this->consultarUbicacion as $resultado) { ?>
                            <option value="<?php echo $resultado['idUbicacion']; ?>">
                                <?php echo $resultado['NombreUbicacion']; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group" id="ambiente">
                        <label>Número Ambiente</label>
                        <select class='form-control' id='ambiente' name='ambiente'>
                            <option value="1">Primero selecciona una ubicación</option>
                        </select>
                    </div>
                </div>
            </div>
<div class="row">
				<div  class="col-xs-6 col-md-6">

				 <input type="hidden" name="envioRegistroElemento">

				   <input id="submitElemento" name="submitElemento" type="button" value="Registrar" class="btn btn-primary btn-block btn-lg" tabindex="7" >
				</div>

				<div  class="col-xs-6 col-md-6">
				<a href="<?php echo constant('URL')?>elementos" class="btn btn-primary btn-block btn-lg">Cancelar</a>
				</div>
			</div>
		
			<div id ="alert"><img class="loading" id="loading" src="<? echo constant('URL')?>public/img/loading.gif" alt=""> <span id="mensajes"> </span></div>  
</div>          
</form>
</div>
 <!-- MODAL exito AL REGISTRAR ELEMENTO ---->
<div data-backdrop="static" data-keyboard="false" class="modal fade" id="modalExitoRegistroElemento" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLongTitle">Elemento Registrado con Éxito</h2>
        </div>
        <div class="modal-body">
              <p for="">Se ha registrado el elemento</p>
        </div>
        <div class="modal-footer">
                <a href="<?php echo constant('URL')?>elementos" class="btn btn-primary">Aceptar</a>
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
    $('#submitElemento').click(function () {

       $.ajax({
           url:'<?php echo constant('URL')?>elementos/registrarElemento',
           type:'POST',
           data:$("#registrarElemento").serialize(),
           beforeSend: function() {
            $('#loading').show();
            $('#mensajes').html('procesando datos');
        },
           success:function (respuesta) {
            $('#loading').hide();
              if (respuesta == 1) {
                $('#modalExitoRegistroElemento').modal("show");
                  
              }else{
                $('#mensajes').html(respuesta);
              }
           }
       })
    }) 
   }
   )


   function buscar_datos(consulta){
    $.ajax({
		url:'<?php echo constant('URL')?>elementos/ambientesPorUbicacion' ,
		type: 'POST' ,
		dataType: 'html',
		data: {consulta: consulta},
	})
	.done(function(respuesta){
		$("#ambiente").html(respuesta);
	})
	.fail(function(){
		console.log("error");
	});
}
$('select#ubicacion').on('change',function(){
    var valor = $(this).val();
   if (valor != "") {
       buscar_datos(valor);
   }

});
</script>