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
        <h1 style="text-align:center"> Elementos </h1>
        <div class="form-actions">
            <a href="<?php echo constant('URL');?>elementos/registrarElementos"><button type="button" class="btn btn-primary">Agregar Elemento <span class="glyphicon glyphicon-level-up"></span></button></a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Mover Elementos <i class="glyphicon glyphicon-shopping-cart"></i></button>
        </div>
        <br>
        <div id="div1">
            <form action="<?php echo constant('URL');?>elementos/moverElementos" id="mover" method="POST">
        <table id="table_id" class="display">
    <thead>
        <tr>
                 
                  <th>Cambiar Estado</th>
                  <th>Editar</th>
                  <th>Novedades</th>
                  <th>Detalle Elemento</th>
                  <th>Número Serial</th>
                  <th>Placa Equipo</th>
                  <th>Tipo Elemento</th>
                  <th>Marca</th>
                  <th>Descripción</th>
                  <th>Ubicacion Actual</th>
                  <th>Fecha Entrada(Sistema)</th>
                  <th>Fecha Salida(Sistema)</th>
                  <th>Estado</th>
        </tr>
    </thead>
    <tbody>
    <?php  foreach($this->query as  $fila) { ?>
        <tr>
            
                 <?php if ($fila['Estado_Elementos_idEstado_Elementos'] == 1) { ?>
                    <td> <a onclick="return confirm('¿Estas seguro?');"  href='<?php echo constant('URL');?>elementos/inhabilitarElemento/<?php echo $fila['idElementos']?> '><button type='button' class='btn btn-success'>Activo</button></a> </td>
                    
                  <?php }else  { ?>
                    <td> <a onclick="return confirm('¿Estas seguro?');"  href='<?php echo constant('URL');?>elementos/habilitarElemento/<?php echo $fila['idElementos']?>'><button type='button' class='btn btn-danger'>Inactivo</button></a> </td>
                  <?php } ?>

                <td> <a href='elementos/actualizarElementos/<?php echo $fila['idElementos']?>'><button type='button' class='btn btn-warning'><span class='glyphicon glyphicon-edit'></span></button></a> </td>
               <td> <button  onclick="obtenerid(<?php echo $fila['idElementos']?>)" type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal"><span class='glyphicon glyphicon-file'></span></button> </td>
               <td> <button  onclick="historial(<?php echo $fila['idElementos']?>)" type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2"><span class='glyphicon glyphicon-eye-open'></span></button> </td>

               <td><?php echo $fila['Numero_Serial'] ?></td> 
               <td><?php echo $fila['Placa_Equipo'] ?></td> 
               <td><?php echo $fila['NombreTipoElemento'] ?></td>
               <td><?php echo $fila['Marca'] ?></td>
               <td><?php echo $fila['Descripcion'] ?></td>
               <td><?php echo $fila['NombreUbicacion'].' '.'ambiente'.' '.$fila['Numero_Ambiente'] ?></td>
               <td><?php echo $fila['Fecha_Entrada'] ?></td>
               <td><?php echo $fila['Fecha_Salida'] ?></td>
               <td><?php echo $fila['NombreEstado'] ?></td>
        </tr>
    <?php } ?>
    </tbody>

</table>




</form>
        </div>          
    </section>









    <!-- Modal -->
    <div id="modalElementosMover" data-backdrop="static" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
       
    <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle">Mover Elementos</h2>
        
      </div>
      <div class="modal-body">

      <div id="div1">
            <form  id="moverElementos" method="POST">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Ubicacion</label>
                        <select class='form-control' id='ubicacion' name='ubicacion'>
                            <option value="">selecciona:</option>
                            <?php foreach ( $this->consultarUbicacion as $resultado) { ?>
                            <option value="<?php echo $resultado['idUbicacion']; ?>">
                                <?php echo $resultado['NombreUbicacion']; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group" id="ambiente">
                        <label>Ambiente</label>
                        <select class='form-control' id='ambiente' name='ambiente'>
                            <option value="">Primero selecciona una ubicación</option>
                        </select>
                    </div>
                </div>
            </div>

        <table id="table_idd" class="display">
    <thead>
        <tr>

                         
                  <th>Selecciona</th>

                  <th>Número Serial</th>
                  <th>Placa Equipo</th>
                  <th>Tipo Elemento</th>
                  <th>Marca</th>
                  <th>Descripción</th>
                  <th>Ubicacion Actual</th>
        </tr>
    </thead>
    <tbody>
    <?php  foreach($this->queryy as  $fila) { ?>
        <tr>
            <td><input  type="checkbox" name="idsElementos[]"  value="<?php echo $fila['idDetalleAmbiente'] ?>" id=""></td>



               <td><?php echo $fila['Numero_Serial'] ?></td> 
               <td><?php echo $fila['Placa_Equipo'] ?></td> 
               <td><?php echo $fila['NombreTipoElemento'] ?></td>
               <td><?php echo $fila['Marca'] ?></td>
               <td><?php echo $fila['Descripcion'] ?></td>
               <td><?php echo $fila['NombreUbicacion'].' '.'ambiente'.' '.$fila['Numero_Ambiente'] ?></td>

        </tr>
    <?php } ?>
    </tbody>

</table>

<input type="hidden" name="envioMoverElemento">
<div class="modal-footer">
<a href="<?php echo constant('URL')?>elementos" class="btn btn-primary">Cancelar</a>
        <button type="button" id="submit" name="submit" class="btn btn-primary">Aceptar</button>
        <div id ="alert"><img class="loading" id="loading" src="<? echo constant('URL')?>public/img/loading.gif" alt=""> <span id="mensajes"> </span></div>
      </div>

</form>
        </div>    


      </div>
     
       
      
     
      </div>
  </div>
</div>




    <!-- Modal historial -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="myModalLabel">Historial del Elemento</h2>
      </div>
      <div class="modal-body">


    <div id="table_idy">

    </div>
     
            
      </div>

      

    </div>
  </div>
</div>






    <!-- Modal exito -->
<div  data-backdrop="static" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      ...
    </div>
  </div>
</div>



 <!-- MODAL exito AL ACTUALIZAR Elemento ---->
 <div data-backdrop="static" data-keyboard="false" class="modal fade" id="modalExito" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
  
      <div class="modal-content">
       
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLongTitle">Elementos actúalizados con Éxito</h2>
        </div>
        <div class="modal-body">
              <p for="">Se ha actúalizaron los elementos</p> 
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
    <?php require('views/plantilla/footer.php')  ?>
    <script src="<?php echo constant('URL');?>public/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo constant('URL');?>public/js/bootstrap.min.js"></script>
    <script src="<?php echo constant('URL');?>DataTables/datatables.js"></script>
    <script>$(document).ready( function () {
    $('#table_id').DataTable();
} );</script>
    <script>$(document).ready( function () {
    $('#table_idd').DataTable();
} );</script>
</body>
</html>





<script>



$(function () {
    console.log('jquery funciona')  ;
    $('#submit').click(function () {

       $.ajax({
           url:'<?php echo constant('URL');?>elementos/moverElementos',
           type:'POST',
           data:$("#moverElementos").serialize(),
           beforeSend: function() {
            $('#loading').show();
            $('#mensajes').html('procesando datos');
        },
           success:function (respuesta) {
            $('#loading').hide();
              if (respuesta == 1) {
                $('#modalElementosMover').modal('hide');
                $('#modalExito').modal("show");
                  
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








function historial(consulta){
    $.ajax({
		url: '<?php echo constant('URL')?>elementos/consultarHistorialElemento' ,
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