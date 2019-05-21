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
<div class="form-group">
<form class="form" action="" method="POST" id="addPrestamo">
<h2 style="text-align: center;">Registrar un prestamo</h2>
<hr style=" height: 1px;background-color: black;">
<section class="principal">

        <table class="table">
          <?php if ($_SESSION['Roles_idRoles'] == 3 || $_SESSION['Roles_idRoles'] == 4){ ?>
  <tr>
    <td colspan="2">
      Persona<br>
      <select class="form-control" id="slPersonas" class="form-control"  name="slPersonas">
      </select>
    </td>
  </tr>
<?php } ?>
    <tr>
    <td colspan="2">
      Jornada<br>
      <select class="form-control" id="slJornadas" class="form-control" name="slJornadas">
      </select>
    </td>
  </tr>
  <tr>
    <td colspan="2">Fecha inicial<br><input type="date" name="dtFechaInicial" class="form-control" min="<?php echo date("Y-m-d"); ?>" max="" class="readonly"></td>
  </tr>
  <tr>
    <td>
      Tipo elemento<br>
      <select name="slTipoElemento" id="slTipoElemento" class="form-control">
        <option value="0">Selecione el tipo de elemento...</option>
      </select>
    </td>
    <td> Elementos
      <select name="slElemento" id="slElemento" class="form-control">
        <option value="0">Seleccione el elemento...</option>
      </select>
    </td>
  </tr>
   <tr>
   <td>
      <button type="button" name="btnAgregar" id="btnAgregar" class="btn btn-success">Añadir elemento</button>
    </td>
   </tr>
</table>

<table class="table table-bordered" id="tblElementos">
  <thead>
    <tr>
      <th>Elemento</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody id="listElementos">
    <tr>
      <td colspan="3"><center>No hay elementos añadidos</center></td>
    </tr>
  </tbody>
</table>
<div class="row">
				<div  class="col-xs-6 col-md-6">
        <button type="submit" id="btnGuardar" class="btn btn-primary btn-block btn-lg">Registrar préstamo</button><br><br>
				</div>
				<div  class="col-xs-6 col-md-6">
				<a href="<?php echo constant('URL')?>elementos" class="btn btn-primary btn-block btn-lg">Cancelar</a>
				</div>
			</div>
			
    </section>       
</form>
</div>
</div> 
</div>
 <!-- MODAL exito AL REGISTRAR ELEMENTO ---->
<div data-backdrop="static" data-keyboard="false" class="modal fade" id="modalExitoPrestamo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLongTitle">Prestamo Registrado con Éxito</h2>
        </div>
        <div class="modal-body">
              <p for="">Se ha registrado el elemento</p>
        </div>
        <div class="modal-footer">
                <a href="<?php echo constant('URL')?>elementos/registrarElementos" class="btn btn-primary">Aceptar</a>
                </div>
        </form>
      </div>
    </div>
  </div>  
<br>
<br>
<?php require('views/plantilla/footer.php')  ?>
</body>
<script src="<?php echo constant('URL');?>public/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo constant('URL');?>public/js/bootstrap.min.js"></script>
<script src="<?php echo constant('URL');?>DataTables/datatables.js"></script>
<script type="text/javascript">
  var ArrayTabla = [];
    function cargarTablaElementos(arrayTabla) {
    // Vaciar la tabla
    $('#tblElementos tbody').html('');
    if (ArrayTabla.length > 0) {
      $.each(arrayTabla, function (i, item) {
          $("#tblElementos tbody").append("<tr><td>"+item.nombreElemento+"</td><td><button class='btn btn-danger' onclick='removerItem("+item.idElemento+")'>Eliminar</button></td></tr>");
        
    });
    }else{
      $("#tblElementos tbody").append('<tr><td colspan="3"><center>No hay elementos añadidos</center></td></tr>');
    }
  }
  function removerItem(idElement) {
    $.each(ArrayTabla, function(i, item){
        if (idElement == item.idElemento) {
          ArrayTabla.splice(i,1);
          cargarTablaElementos(ArrayTabla);
          loadLista();
        }
      });
  }
  function existElement(id) {
    var boolExist = false;
    $.each(ArrayTabla, function(i, item){
      if (item.idElemento == id) {
        boolExist = true;
      }
    });
    return boolExist;
  }
  function loadUsuarios(){
    $('#slPersonas').append('<option value="0">Seleccione el usuario...</option>');
      $.ajax({
      cache: false,
      type: "POST",
      url:'<?php echo constant('URL')?>Prestamos/obtenerPersonas',
      dataType: "json",
      success: function(R) {
          $.each(R.Objeto, function(i,item){
            $('#slPersonas').append($('<option>', { 
              value: item.idPersona,
              text : item.Nombre
          })); 
      });
      }, error: function() {

        alert('Error en ajax');
      }
    });
  }
  function loadJornadas(){
    $('#slJornadas').append('<option value="0">Seleccione la Jornada...</option>');
      $.ajax({
      cache: false,
      type: "POST",
      url:'<?php echo constant('URL')?>Prestamos/obtenerJornadas',
      dataType: "json",
      success: function(R) {
          $.each(R.Objeto, function(i,item){
            $('#slJornadas').append($('<option>', { 
              value: item.idJornada,
              text : item.tipoJornada
          })); 
      });
      }, error: function() {

        alert('Error en ajax');
      }
    });
  }
    function loadTipoElementos(){
    $('#slTipoElemento').html('<option value="0">Seleccione Tipo Elemento...</option>');
    $('#slElemento').html('<option value="0">Seleccione el elemento...</option>');
      $.ajax({
      cache: false,
      type: "POST",
      url:'<?php echo constant('URL')?>Prestamos/obtenerTipoElementos',
      dataType: "json",
      success: function(R) {
          $.each(R.Objeto, function(i,item){
            $('#slTipoElemento').append($('<option>', { 
              value: item.idTipo_Elementos,
              text : item.NombreTipoElemento
          })); 
      });
      }, error: function() {

        alert('Error en ajax');
      }
    });
  }
  function loadLista(tipoElemento) {

    $('#slElemento').html('');
    $('#slElemento').append('<option value="0">Seleccione el elemento...</option>');

    var objElementos = null;

    $.ajax({
      async: false,
      cache: false,
      type: "POST",
      url:'<?php echo constant('URL')?>Prestamos/obtenerElementos',
      data: "tipoElemento="+tipoElemento+"&"+$("#addPrestamo").serialize(),
      dataType: "json",
      success: function(R) {
          objElementos = R.Objeto;
      }, error: function(jqXHR, textStatus, errorThrown) {

          console.log('Error en ajax');
          console.log(jqXHR.responseText);
          console.log(textStatus);
          console.log(errorThrown);
      }
    });
    if (ArrayTabla.length > 0) {
      $.each(objElementos, function (i, item) {
        if(!existElement(item.idElemento)){
          $('#slElemento').append($('<option>', { 
            value: item.idElemento,
            text : item.Descripcion + " - " + item.Placa 
          }));
        }
      });
    }else{ 
    $.each(objElementos, function (i, item) {
      $('#slElemento').append($('<option>', { 
        value: item.idElemento,
        text : item.Descripcion + " - " + item.Placa 
      })); 
    });
  }

  
  }

$(document).ready(function(){
  
  // Cargar la lista de elementos
  //loadLista();
  loadUsuarios();
  loadJornadas();
  loadTipoElementos();

  $("#btnAgregar").click(function(){
    if ($("#slElemento option:selected").val() != 0) {
      var ObjTabla = {};
      ObjTabla.idElemento = $("#slElemento option:selected").val();
      ObjTabla.nombreElemento = $("#slElemento option:selected").text();
      ArrayTabla.push(ObjTabla);
      cargarTablaElementos(ArrayTabla);
      loadTipoElementos();
    }else{
      alert('Seleccione un elemento');
    }
        
  });

  $("#slTipoElemento").on("change", function(){
    loadLista($(this).val());
  })

  $("#btnGuardar").click(function(e){
    e.preventDefault();
    var Items = JSON.stringify(ArrayTabla);
    // Validar que existan elementos en la lista
    if (ArrayTabla.length > 0) {
      $.ajax({
        cache: false,
        type: "POST",
        dataType: "json",
        url:'<?php echo constant('URL')?>Prestamos/guardarPrestamo',
        data: "listaElementos="+Items+"&"+$("#addPrestamo").serialize()+"&cantidadElementos="+ArrayTabla.length,
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
    }else{
      alert('Debe añadir al menos un (1) elemento.');
    }
  });

});




$(".readonly").keydown(function(e){
    e.preventDefault();
});
</script>

</html>