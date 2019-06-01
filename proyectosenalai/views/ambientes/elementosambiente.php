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
        <h1 style="text-align:center; font-family: fantasy;">Elementos Del Ambiente <?php echo $this->query2['Numero_Ambiente'];?></h1>
        <br>
        <div id="div1">
        <table id="table_id" class="display">
    <thead>
        <tr>      
                  <th>Reportar Novedad</th>
                  <th>Ver Novedades</th>
                  <th>Número Serial</th>
                  <th>Placa Equipo</th>
                  <th>Marca</th>
                  <th>TIPO Elemento</th>
                  <th>Fecha </th>
                  <th>Estado</th>
        </tr>
    </thead>
    <tbody>
    <?php  foreach($this->query as  $fila) { ?>
        <tr>
               <td> <button  onclick="obtenerid(<?php echo $fila['idElementos']?>)" type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal"><span class='glyphicon glyphicon-file'></span></button> </td>
               <td> <button  onclick="buscar_datos(<?php echo $fila['idElementos']?>)" type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2"><span class='glyphicon glyphicon-eye-open'></span></button> </td>
               <td><?php echo $fila['Numero_Serial'] ?></td>         
               <td><?php echo $fila['Placa_Equipo'] ?></td>
               <td><?php echo $fila['Marca'] ?></td>
               <td><?php echo $fila['NombreTipoElemento'] ?></td>
               <td><?php echo $fila['Fecha_Novedad'] ?></td>
               <td><?php echo $fila['NombreEstado'] ?></td>
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
        <h4 class="modal-title" id="myModalLabel" style="text-align: center; font-family: fantasy;">Reportar Novedad</h4>
      </div>
      <div class="modal-body">
      <form id="reportarNovedad">
  <div class="form-group">
               <label for="">Novedad</label>
               <textarea name="novedad" id="novedad"class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3"></textarea>
              </div> 
              <input type="hidden" id="idd" name="idElemento">
  <div class="row">
                  <div  class="col-xs-6 col-md-6">
  
                   <input type="hidden" name="envioReportarNovedad">
  
                     <input id="submit" name="submit" type="button" value="Registrar" class="btn btn-primary btn-block btn-lg" tabindex="7" >
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
        <h2 class="modal-title" id="myModalLabel" style="text-align: center; font-family: fantasy;">Novedades reportadas</h2>
      </div>
      <div class="modal-body">
    <div id="table_idy">
    </div> 
      </div>
    </div>
  </div>
</div>
 <!-- MODAL exito AL REPORTRA NOVEDAD ---->
 <div data-backdrop="static" data-keyboard="false" class="modal fade" id="modalExitoReportarNovedad" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
  
      <div class="modal-content">
       
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLongTitle">Novedad reportada con éxito.</h2>
        </div>
        <div class="modal-body">
              <p for="">Se ha enviado la novedad.</p>
        </div>
        <div class="modal-footer">
                <a href="<?php echo constant('URL')?>ambientes/elementosAmbiente/<?php echo $this->idAmbientes ?>" class="btn btn-primary">Aceptar</a>
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
    <script>$(document).ready( function () { $('#table_id').DataTable(); } );</script>
    <script > function  obtenerid(id){ $("#idd").val(id);}</script>
</body>
</html>
<script>
$(function () {
    console.log('jquery funciona')  ;
    $('#submit').click(function () {

       $.ajax({
           url:'<?php echo constant('URL')?>ambientes/registrarNovedad',
           type:'POST',
           data:$("#reportarNovedad").serialize(),
           beforeSend: function() {
            $('#loading').show();
            $('#mensajes').html('procesando datos');
        },
           success:function (respuesta) {
            $('#loading').hide();
              if (respuesta == 1) {
                $('#myModal').modal('hide');
                $('#modalExitoReportarNovedad').modal("show");
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
		url: '<?php echo constant('URL')?>ambientes/consultarNovedades' ,
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


